<?php
/**
 * Created by PhpStorm.
 * User: Linker
 * Date: 2018/3/5
 * Time: 15:26
 */

//登陆判断
session_start();
if (!(isset($_SESSION["admin_id"]) && !empty($_SESSION["admin_id"]) &&
    isset($_SESSION["admin_name"]) && !empty($_SESSION["admin_name"]))
)//登陆判断如果没有登陆，是否需要跳转***oauth_log.php
{
    exit('管理员未登录');//失败返回相关信息
}


//接受上传文件
// 允许上传的图片后缀
$allowedExts = array("xlsx");
$temp = explode(".", $_FILES["file"]["name"]);

$extension = end($temp);     // 获取文件后缀名
if ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
    && ($_FILES["file"]["size"] < 512000)   // 小于 512 kb
    && in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
        move_uploaded_file($_FILES["file"]["tmp_name"], "../temp_file_hub/teacher_info.xlsx");
    }
}
else
{
    exit("非法的文件格式");
}

//处理数据
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


$reader = new Xlsx();
//从xlsx获取数据
$referenceFileName = '../temp_file_hub/xydm.xlsx';
try {
    $spreadsheet = $reader->load($referenceFileName);
} catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
    echo $e->getMessage();
}
try {
    $referenceSheetData_array = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
} catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
    echo $e->getMessage();
}

//去除数据第一列抬头
$referenceSheetData_array = array_slice($referenceSheetData_array, 1, null, true);
//分列
$bjdm_array = array_column($referenceSheetData_array, 'A');//班级代码
$xydm_array = array_column($referenceSheetData_array, 'D');//学院代码
$xymc_array = array_column($referenceSheetData_array, 'E');//学院名称
$xy_array = array_unique(array_combine($xydm_array, $xymc_array));

//从xlsx获取数据
$teacherInfoFile = '../temp_file_hub/teacher_info.xlsx';
try {
    $teacherSheet = $reader->load($teacherInfoFile);
} catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
    echo $e->getMessage();
}
try {
    $teacherInfoSheetData_array = $teacherSheet->getActiveSheet()->toArray(null, true, true, true);
    $teacherInfoSheetData_array = array_slice($teacherInfoSheetData_array, 1, null, true);
} catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
    echo $e->getMessage();
}

//比较函数
function array_compare($a, $b)
{
    if ($a === $b) {
        return 0;
    }
    return ($a > $b) ? 1 : -1;
}

//验证数据
foreach ($teacherInfoSheetData_array as $fec_idx1 => $fec_val1) {
    $dep_no = intval($fec_val1['E']);
    //判断该教师班级代码、学院全称、学院代码是否正确
    if ($fec_val1['G'] == '1') {
        //辅导员
        $info_bjdm_array = explode('][', substr($fec_val1['F'], 1, -1));
        if ($info_bjdm_array == array_intersect($info_bjdm_array, $bjdm_array) &&
            key_exists($dep_no, $xy_array) &&
            $xy_array[$dep_no] == $fec_val1['D']) {
            //重构班级代码，删除已确认的班级代码
            $bjdm_array = array_udiff($bjdm_array, $info_bjdm_array, "array_compare");
        } else {
            //失败
            echo '<div style="color: red;">易班账号为: ' . $fec_val1['A'] . ' 的辅导员信息不符合规范</div>';
        }
    } elseif ($fec_val1['G'] == '2' &&
        $fec_val1['F'] === '-' &&
        key_exists($dep_no, $xy_array) &&
        $xy_array[$dep_no] == $fec_val1['D']) {

    } elseif ($fec_val1['G'] == '3' &&
        $fec_val1['D'] === '-' &&
        $fec_val1['E'] === '-' &&
        $fec_val1['F'] === '-') {
        //重构班级代码，删除已确认的班级代码
    }elseif ($fec_val1['A'] == null &&
             $fec_val1['B'] == null &&
             $fec_val1['C'] == null &&
             $fec_val1['D'] == null &&
             $fec_val1['E'] == null &&
             $fec_val1['F'] == null &&
             $fec_val1['G'] == null &&
             $fec_val1['H'] == null){
        $teacherInfoSheetData_array = array_slice($teacherInfoSheetData_array,0,$fec_idx1-3);
    }
    else {
        echo '<div style="color: red;">易班账号为: ' . $fec_val1['A'] . ' 的信息有误</div>';
        //身份代码有误
    }
}

include_once 'json_teacher.php';
//遍历插入数据到数据库
$item_num = count($teacherInfoSheetData_array);
$error_num = 0;
$success_num = 0;
foreach ($teacherInfoSheetData_array as $fec_idx1 => $fec_val1) {
    $sql = 'INSERT  INTO  tbl_infochecker (checker_ybid, worker_no, checker_name, in_dep, in_depno, classNo, identify, stu_num) 
            VALUES ("' . $fec_val1['A'] . '","' . $fec_val1['B'] . '","' . $fec_val1['C'] . '","' . $fec_val1['D'] . '","' . $fec_val1['E'] . '","' .
        $fec_val1['F'] . '","' . $fec_val1['G'] . '","' . $fec_val1['H'] . '") ON DUPLICATE KEY UPDATE checker_ybid = "' . $fec_val1['A'] . '", 
            worker_no = "' . $fec_val1['B'] . '", checker_name = "' . $fec_val1['C'] . '", in_dep = "' . $fec_val1['D'] . '", 
            in_depno = "' . $fec_val1['E'] . '", classNo = "' . $fec_val1['F'] . '",identify = "' . $fec_val1['G'] . '", stu_num = "' . $fec_val1['H'] . '"';
    if ($dbcon->query($sql)) {
        echo '('.(intval($fec_idx1)+1).'/'.$item_num.')<div>易班id为： ' . $fec_val1['A'] . ' 的教师的信息完成导入</div>';
        $success_num++;
    } else {
        echo '('.(intval($fec_idx1)+1).'/'.$item_num.')<div style="color: red;">插入/更新易班id为：' . $fec_val1['A'] . '的教师的信息时出错</div>';
        $error_num++;
    }
}
$dbcon->close();
echo '<div>处理完成，共'.$item_num.'，成功 '.$success_num.'，失败 '.$error_num.'</div>';