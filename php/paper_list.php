<?php
/**
 * Created by PhpStorm.
 * User: Linker
 * Date: 2018/2/8
 * Time: 22:21
 */

include 'auto_load_register.php';
include 'php_lib/db_con_test.php';

$sql = 'select * from tbl_quepublish ORDER BY publish_id DESC ';

$ret_obj = new classes\return_data();

if($result = $db_con->query($sql)){
    $row = $result->fetch_all();
    if($row != null){
        $ret_array = array();
        foreach ($row as $fec_index => $fec_val){
            $temp_row['title']          = $fec_val[2];
            $temp_row['c_time']         = $fec_val[5];
            $temp_row['paper_id']       = $fec_val[0];
            $temp_row['template_id']    = $fec_val[1];
            $temp_row['status']         = $fec_val[4];
            array_push($ret_array,$temp_row);
        }
        $ret_obj->Ret_Data = $ret_array;
    }
    $ret_obj->Status = 'success';
    $ret_obj->StatusCode = '1';

}else{
    $ret_obj->Status = 'failed';
    $ret_obj->StatusCode = 0;
}

$db_con->close();
echo json_encode($ret_obj);
