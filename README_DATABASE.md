	View_detail_data-详细统计数据
详细统计数据，该视图对应统计页面-详情内的数据

	Unique_mark
唯一标识字段，由teacher_ybid,que_publish_id,que_id拼接而成，用处是做唯一标识，不必了解。
	Result_id
结果id，代表此条目对应属于的并参照在tbl_queresults表中评价结果的id。
	Teacher_ybid
对应的是该评价结果属于哪一位辅导员，参照tbl_infochecker表的checker_ybid字段。
	Que_publish_id
对应的是该评价结果属于哪一张问卷，参照tbl_quepublish表的publish_id字段。
	Que_id
对应的是该选择结果属于哪一个题目，参照tbl_queitems表的que_id字段。
	Needed_num
表示该题目需要多少人评价。
	Content
对应题目的题干内容。
	Selector_id
此项为冗余项，无用。
	Selector_dis
表示此题目的选项分布，每个选项的数据用分号隔开“；”，选项内的数据分选择该选项的数量和选择该选项的人占所有选择的百分比，用逗号隔开“，”。
	Done_num
表示完成了该题目的人数。

	View_detail_score-所有结果选项的被选中数量
该视图为所有结果选项的被选中数量

	Detail_id
表示当前详细条目的id。
	Result_id
表示当前详细条目所属的结果，参照tbl_queresults表的result_id。
	Selector_id
表示当前详细条目的数据是对应哪一个选项，参照tbl_queselectors表中的selector_id字段。
	Que_id
表示当前详细条目对应的是哪一道题目的选项，参照tbl_queitems表的que_id字段。
	Selectoed_num
表示该条目在对应问卷对应老师对应选项被选中的数量
	Sum_score
表示该条目统计所有被选中的总分。

	View_detail_selector_with_title
与view_detail_score基本一致，只是将其最后一项替换成了对应题目的题干内容content

	Content
对应题目的题干内容content。

	View_publish_selectoritems-所有的问卷的选项详情
所有的问卷的选项条目详情。

	publish_id
该选项条目对应的问卷id
	que_id
表示该选项对应的题目id
	selector_id
表示该选项条目的id
	selector_mark
选项标志
	content
选项的内容
	score_percent
该选项占该题分数的百分比
	selector_score
选择该选项的分数


	View_published_que-所有的问卷的题目
所有的问卷的题目

	Publish_id
对应问卷的id
	Que_id
该条目对应的题目id
	Content
该条目对应的题目的题干内容
	Scores
该条目对应的题目的分数

	View_result_score_name-概略统计结果
概略统计结果，对应统计界面-总览页面的数据

	Que_publish_id
该统计结果条目对应的问卷id。
	Worker_no
对应的辅导员的工号
	Checker_name
对应辅导员的姓名
	In_dep
对应辅导员所属的学院名称
	T_ave_score
平均分
	Done_num
完成人数
	Needed_num
在校学生人数（需要完成该问卷的人数）
	Involve_percent
完成百分比（完成人数/在校学生人数）
	Good_per
优良率
	Bad_per
差率
	Number_distribution1
评价为80-95分的人数
	istribution1_per
评价为80-95分的人数的百分比
	Number_distribution2
评价为70-79分的人数
	Istribution2_per
评价为70-79分的人数的百分比
	Number_distribution3
评价为60-69分的人数
	Istribution3_per
评价为60-69分的人数的百分比
	Number_distribution4
评价为50-59分的人数
	Istribution4_per
评价为50-59分的人数的百分比

	View_selector_score-每个选项的详细情况
每一个选项的详细情况，选项在数据库的id、所属题目的id、选项标记符号、选项内容、选项权值、选择该选项该题的分数。

	Selector_id
选项的id。
	Que_id
该选项所属题目的id。
	Selector_mark
选项的标记符号。
	Content
选项的内容。
	Score_percent
该选项的全职，百分比。
	Selector_score
选择该选项的得分。
