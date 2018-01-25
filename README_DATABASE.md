# 数据库说明
~~~~
使用的是MySQL 5.7版本数据库，MariaDB 5.5兼容
view开头的是视图
fun开头的是函数
sp开头的是存储过程
~~~~
>视图
- [View_detail_data](#view-detail-data-详细统计数据)
- [View_detail_score](#view-detail-score)
- [View_detail_selector_with_title](#view-detail-selector-with-title)
- [View_published_que](#view-published-que)
- [View_result_score_name](#view-result-score-name)
- [View_selector_score](#view-selector-score)
>函数
- [fun_is_complish](#fun-is-complish)
- [fun_update_stuinfo](#fun-update-stuinfo)
>存储过程
- [sp_save_que](#sp-save-que)


---

##### View_detail_data-详细统计数据

>详细统计数据，该视图对应统计页面-详情内的数据
~~~~
Unique_mark
唯一标识字段，由teacher_ybid,que_publish_id,que_id拼接而成，用处是做唯一标识，不必了解。

Result_id
结果id，代表此条目对应属于的并参照在tbl_queresults表中评价结果的id。

Teacher_ybid
对应的是该评价结果属于哪一位辅导员，参照tbl_infochecker表的checker_ybid字段。

Que_publish_id
对应的是该评价结果属于哪一张问卷，参照tbl_quepublish表的publish_id字段。

Que_id
对应的是该选择结果属于哪一个题目，参照tbl_queitems表的que_id字段。

Needed_num
表示该题目需要多少人评价。

Content
对应题目的题干内容。

Selector_id
此项为冗余项，无用。

Selector_dis
表示此题目的选项分布，每个选项的数据用分号隔开“；”，选项内的数据分选择该选项的数量和选择该选项的人占所有选择的百分比，用逗号隔开“，”。

Done_num
表示完成了该题目的人数。

~~~~
---
##### View_detail_score
>所有结果选项的被选中数量,该视图为所有结果选项的被选中数量
~~~~
Detail_id
表示当前详细条目的id。

Result_id
表示当前详细条目所属的结果，参照tbl_queresults表的result_id。

Selector_id
表示当前详细条目的数据是对应哪一个选项，参照tbl_queselectors表中的selector_id字段。

Que_id
表示当前详细条目对应的是哪一道题目的选项，参照tbl_queitems表的que_id字段。

Selectoed_num
表示该条目在对应问卷对应老师对应选项被选中的数量

Sum_score
表示该条目统计所有被选中的总分。
~~~~

---

##### View_detail_selector_with_title

与view_detail_score基本一致，只是将其最后一项替换成了对应题目的题干内容content
~~~~
Content
对应题目的题干内容content。

View_publish_selectoritems
所有的问卷的选项条目详情。

publish_id
该选项条目对应的问卷id

que_id
表示该选项对应的题目id

selector_id
表示该选项条目的id

selector_mark
选项标志

content
选项的内容

score_percent
该选项占该题分数的百分比

selector_score
选择该选项的分数
~~~~

---

##### View_published_que
>所有的问卷的题目
~~~~
Publish_id
对应问卷的id

Que_id
该条目对应的题目id

Content
该条目对应的题目的题干内容

Scores
该条目对应的题目的分数
~~~~

---

##### View_result_score_name

>概略统计结果，对应统计界面-总览页面的数据
~~~~
Que_publish_id
该统计结果条目对应的问卷id。

Worker_no
对应的辅导员的工号

Checker_name
对应辅导员的姓名

In_dep
对应辅导员所属的学院名称

T_ave_score
平均分

Done_num
完成人数

Needed_num
在校学生人数（需要完成该问卷的人数）

Involve_percent
完成百分比（完成人数/在校学生人数）

Good_per
优良率

Bad_per
差率

Number_distribution1
评价为80-95分的人数

istribution1_per
评价为80-95分的人数的百分比

Number_distribution2
评价为70-79分的人数

Istribution2_per
评价为70-79分的人数的百分比

Number_distribution3
评价为60-69分的人数

Istribution3_per
评价为60-69分的人数的百分比

Number_distribution4
评价为50-59分的人数

Istribution4_per
评价为50-59分的人数的百分比
~~~~

---

##### View_selector_score

>每一个选项的详细情况，选项在数据库的id、所属题目的id、选项标记符号、选项内容、选项权值、选择该选项该题的分数。
~~~~
Selector_id
选项的id。

Que_id
该选项所属题目的id。

Selector_mark
选项的标记符号。

Content
选项的内容。

Score_percent
该选项的全职，百分比。

Selector_score
选择该选项的得分。
~~~~

---


##### fun_is_complish
>定义：fun_is_complish(ybid_par bigint) RETURNS tinyint(1)
>
>作用：返回学生是否完成了问卷。
>
>影响：无
>
>返回值：1表示已完成，0表示未完成

| 参数 - 类型        | 描述             |
|:------------------|:-----------------|
| ybid_par - bigint | 查询的学生的易班id |

---


##### fun_update_stuinfo
>定义：fun_update_stuinfo(ybid_par bigint,s_no_par varchar(45),name_par varchar(45),dep_par varchar(90),pro_par varchar(90),grade_par varchar(90),class_par varchar(90),depno_par varchar(20),prono_par varchar(20),classno_par varchar(20)) RETURNS tinyint(1)
>
>作用：保存学生的信息。
>
>影响：会在tbl_students表中插入一条新的数据。
>
>返回值：1，保存完成。

| 参数 - 类型              | 描述          |
|:------------------------|:--------------|
| ybid_par - bigint       | 学生的易班id   |
| s_no_par - varchar(45)  | 学生学号       |
| name_par - varchar(45)  | 学生姓名       |
| dep_par - varchar(90)     | 学生所属学院   |
| pro_par - varchar(90)     | 学生专业       |
| grade_par - varchar(90)   | 学生年级       |
| class_par - varchar(90)   | 学生班级       |
| depno_par - varchar(20)   | 学生学院代码   |
| prono_par - varchar(20)   | 学生专业代码   |
| classno_par - varchar(20) | 学生行政班代码 |

---

##### sp_save_que
>定义：sp_save_que(IN stu_ybid_par bigint,IN publish_id int, IN selector_rst varchar(2000), OUT sp_rst tinyint)
>
>保存对老师评价的问卷结果。
>
>影响：tbl_resultdetail对应行中的selectoed_num字段将会加一；tbl_queresults中相应行中的done_num字段和number_distribution字段会加一；tbl_students中的is_done会被置为1。
>
>返回值：(sp_rst)，1，保存完成；0，表示出错。

| 参数 - 类型                      | 描述                      |
|:--------------------------------|:--------------------------|
| IN stu_ybid_par - bigint        | 评价的学生的易班id          |
| IN publish_id - int             | 评价的问卷的id             |
| IN selector_rst - varchar(2000) | 选择选项的id，用分号“;”隔开 |
| OUT sp_rst - tinyint            | 操作的结果                 |

---