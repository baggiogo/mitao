<?php
!function_exists('readover') && exit('Forbidden');
$lang['o_hot'] = array(
	'default'=> array(array('id'			=>	'1',
							'parent_id'		=>	null,
							'sort'			=>	'1',
							'tag'			=>	'memberHot',
							'type_name'		=>	'�û�����',
					  		'display'		=>	'1',
					  		'active'		=>	'1'),
					  array('id'			=>	'2',
					  		'parent_id'		=>	'1',
					  		'sort'			=>	'1',
					  		'tag'			=>	'memberOnLine',
					  		'type_name'		=>	'��������',
					  		'filter_time'	=>	array('current'=>'history','filters'=>array('today','week','month','history'),'filterItems'=>array('18','18','18','18')),
					  		'display'		=>	'1',
					  		'active'		=>	'1'),
					  array('id'			=>	'3',
						  	'parent_id'		=>	'1',
						  	'sort'			=>	'2',
						  	'tag'			=>	'memberCredit',
						  	'type_name'		=>	'��������',
						  	'filter_type'	=>	array('current'=>'money',
						  						 	  'filters'=>array('money','rvrc','credit','currency',4),
						  						 	  'filterItems'=>array('18','18','18','18','18')),
						  	'display'		=>	'1',
						  	'active'		=>	'1'),
					  array('id'			=>	'4',
						  	'parent_id'		=>	'1',
						  	'sort'			=>	'3',
						  	'tag'			=>	'memberFriend',
						  	'type_name'		=>	'��������',
						  	'display'		=>	'0',
						  	'active'		=>	'1'),
					  array('id'			=>	'5',
						  	'parent_id'		=>	'1',
						  	'sort'			=>	'4',
						  	'tag'			=>	'memberThread',
						  	'type_name'		=>	'��������',
						  	'filter_time'	=>	array('current'=>'history','filters'=>array('today','week','month','history'),'filterItems'=>array('18','18','18','18')),
						  	'display'		=>	'0',
						  	'active'		=>	'1'),
					  /*array('id'			=> 	'6',
					  		'parent_id'		=> 	'1',
					  		'sort'			=> 	'6',
					  		'tag'			=> 	'memberShare',
					  		'type_name'		=>	'�����Ƽ�����',
					  		'filter_type'	=>	array('current'=>'memberShareAll',
					  								  'filters'=>array('memberShareThread',
					  												   'memberShareDiary',
					  												   'memberShareAlbum',
					  												   'memberShareUser',
					  												   'memberShareGroup',
					  												   'memberSharePic',
					  												   'memberShareLink',
					  												   'memberShareVideo',
					  												   'memberShareMusic',
					  												   'memberShareAll'),
					  								  'filterItems'=>array('18','18','18','18','18','18','18','18','18','18')),
					  		'filter_time'	=>	array('current'=>'history','filters'=>array('today','week','month','history'),'filterItems'=>array('18','18','18','18')),
					  		'display'		=>	'0',
					  		'active'		=>	'1'),*/
					  array('id'			=>	'8',
					  		'parent_id'		=>	null,
					  		'sort'			=>	'2',
					  		'tag'			=>	'threadHot',
					  		'type_name'		=>	'��������',
					  		'display'		=>	'1',
					  		'active'		=>	'1'),
					  array('id'			=>	'9',
					  		'parent_id'		=>	'8',
					  		'sort'			=>	'1',
					  		'tag'			=>	'threadPost',
					  		'type_name'		=>	'�ظ�����',
					  		'filter_time'	=>	array('current'=>'history','filters'=>array('today','week','month','history'),'filterItems'=>array('10','10','10','10')),
					  		'display'		=>	'1',
					  		'active'		=>	'1'),
					  array('id'			=>	'10',
					  		'parent_id'		=>	'8',
					  		'sort'			=>	'2',
					  		'tag'			=>	'threadRate',
					  		'type_name'		=>	'��������',
					  		'filter_type'	=>	array('current'=>'rateThread_1',
					  								  'filters'=>array('rateThread_1','rateThread_2','rateThread_3','rateThread_4','rateThread_5','rateThread_6','rateThread_7'),
					  								  'filterItems'=>array('10','10','10','10','10','10','10')),
					  		'filter_time'	=>	array('current'=>'history','filters'=>array('today','week','month','history'),'filterItems'=>array('10','10','10','10')),
					  		'display'		=>	'0',
					  		'active'		=>	'1'),
					  array('id'			=>	'11',
					  		'parent_id'		=>	'8',
					  		'sort'			=>	'3',
					  		'tag'			=>	'threadFav',
					  		'type_name'		=>	'�ղ�����',
					  		'filter_time'	=>	array('current'=>'history','filters'=>array('today','week','month','history'),'filterItems'=>array('10','10','10','10')),
					  		'display'		=>	'1',
					  		'active'		=>	'1'),
					  /*array('id'			=>	'12',
					  		'parent_id'		=>	'8',
					  		'sort'			=>	'4',
					  		'tag'			=>	'threadShare',
					  		'type_name'		=>	'��������',
					  		'filter_time'	=>	array('current'=>'history','filters'=>array('today','week','month','history'),'filterItems'=>array('10','10','10','10')),
					  		'display'		=>	'0',
					  		'active'		=>	'1'),*/
					  array('id'			=>	'13',
					  		'parent_id'		=>	null,
					  		'sort'			=>	'3',
					  		'tag'			=>	'diaryHot',
					  		'type_name'		=>	'��־����',
					  		'display'		=>	'1',
					  		'active'		=>	'1'),
					  array('id'			=>	'14',
					  		'parent_id'		=>	'13',
					  		'sort'			=>	'1',
					  		'tag'			=>	'diaryComment',
					  		'type_name'		=>	'��������',
					  		'filter_time'	=>	array('current'=>'history','filters'=>array('today','week','month','history'),'filterItems'=>array('10','10','10','10')),
					 	 	'display'		=>	'1',
					 	 	'active'		=>	'1'),
					  array('id'			=>	'15',
					  		'parent_id'		=>	'13',
					  		'sort'			=>	'2',
					  		'tag'			=>	'diaryRate',
					  		'type_name'		=>	'��������',
					  		'filter_type'	=>	array('current'=>'rateDiary_8',
					  								  'filters'=>array('rateDiary_8','rateDiary_9','rateDiary_10','rateDiary_11','rateDiary_12','rateDiary_13','rateDiary_14'),
					  								  'filterItems'=>array('10','10','10','10','10','10','10')),
					  		'filter_time'	=>	array('current'=>'history','filters'=>array('today','week','month','history'),'filterItems'=>array('10','10','10','10')),
					  		'display'		=>	'0',
					  		'active'		=>	'1'),
					  array('id'			=>	'16',
					  		'parent_id'		=>	'13',
					  		'sort'			=>	'3',
					  		'tag'			=>	'diaryFav',
					  		'type_name'		=>	'�ղ�����',
					  		'filter_time'	=>	array('current'=>'history','filters'=>array('today','week','month','history'),'filterItems'=>array('10','10','10','10')),
					  		'display'		=>	'0',
					  		'active'		=>	'1'),
					 /* array('id'			=>	'17',
					  		'parent_id'		=>	'13',
					  		'sort'			=>	'4',
					  		'tag'			=>	'diaryShare',
					  		'type_name'		=>	'��������',
					  		'filter_time'	=>	array('current'=>'history','filters'=>array('today','week','month','history'),'filterItems'=>array('10','10','10','10')),
					  		'display'		=>	'0',
					  		'active'		=>	'1'),*/
					  array('id'			=>	'18',
					  		'parent_id'		=>	null,
					  		'sort'			=>	'4',
					  		'tag'			=>	'picHot',
					  		'type_name'		=>	'��Ƭ����',
					  		'display'		=>	'1',
					  		'active'		=>	'1'),
					  array('id'			=>	'19',
					  		'parent_id'		=>	'18',
					  		'sort'			=>	'1',
					  		'tag'			=>	'picComment',
					  		'type_name'		=>	'��������',
					 	 	'filter_time'	=>	array('current'=>'history','filters'=>array('today','week','month','history'),'filterItems'=>array('20','20','20','20')),
					  		'display'		=>	'1',
					  		'active'		=>	'1'),
					  array('id'			=>	'20',
					  		'parent_id'		=>	'18',
					  		'sort'			=>	'2',
					  		'tag'			=>	'picRate',
					  		'type_name'		=>	'��������',
					  		'filter_type'	=>	array('current'=>'ratePicture_15',
					  							      'filters'=>array('ratePicture_15','ratePicture_16','ratePicture_17','ratePicture_18','ratePicture_19','ratePicture_20','ratePicture_21','ratePicture_22'),
					  							      'filterItems'=>array('20','20','20','20','20','20','20','20')),
					  		'filter_time'	=>	array('current'=>'history','filters'=>array('today','week','month','history'),'filterItems'=>array('20','20','20','20')),
					  		'display'		=>	'0',
					  		'active'		=>  '1'),
					  array('id'			=>	'21',
						  	'parent_id'		=>	'18',
						  	'sort'			=>	'3',
						  	'tag'			=>	'picFav',
						  	'type_name'		=>	'�ղ�����',
						  	'filter_time'	=>	array('current'=>'history','filters'=>array('today','week','month','history'),'filterItems'=>array('20','20','20','20')),
						  	'display'		=>	'0',
						  	'active'		=>	'1'),
					 /* array('id'			=>	'22',
					  		'parent_id'		=>	'18',
					  		'sort'			=>	'4',
					  		'tag'			=>	'picShare',
					  		'type_name'		=>	'��������',
					  		'filter_time'	=>	array('current'=>'history','filters'=>array('today','week','month','history'),'filterItems'=>array('20','20','20','20')),
					  		'display'		=>	'0',
					  		'active'		=>	'1'),*/
					  array('id'			=>	'23',
					  		'parent_id'		=>	null,
					  		'sort'			=>	'5',
					  		'tag'			=>	'forumHot',
					  		'type_name'		=>	'��̳�������',
					  		'display'		=>	'1',
					  		'active'		=>	'1'),
					  array('id'			=>	'24',
					  		'parent_id'		=>	'23',
					  		'sort'			=>	'1',
					  		'tag'			=>	'forumPost',
					  		'type_name'		=>	'���շ�������',
					  		'display'		=>	'1',
					  		'active'		=>	'1'),
					  array('id'			=>	'25',
					  		'parent_id'		=>	'23',
					  		'sort'			=>	'2',
					  		'tag'			=>	'forumTopic',
					  		'type_name'		=>	'��������',
					  		'display'		=>	'0',
					  		'active'		=>	'1'),
					  array('id'			=>	'26',
					  		'parent_id'		=>	'23',
					  		'sort'			=>	'3',
					  		'tag'			=>	'forumArticle',
					  		'type_name'		=>	'��������',
						  	'display'		=>	'0',
						  	'active'		=>	'1'),
					  ),
);
?>







