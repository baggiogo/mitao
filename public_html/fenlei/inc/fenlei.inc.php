<?php

//这是分类信息的函数
function get_info_url($id,$fid,$cityid='',$zoneid='',$streetid='',$array=array()){
	global $webdb,$Fid_db,$zone_DB,$street_DB,$city_DB,$BIZ_MODULEDB,$city_id;
	if(!$Fid_db['F']){
		$Fid_db['F'] = include(ROOT_PATH."data/all_fid.php");
	}
	if(!$city_DB){
		include(ROOT_PATH."data/all_city.php");
	}
	if(!$zone_DB&&$city_id){
		@include(ROOT_PATH."data/zone/$city_id.php");
	}
	$webdb[Info_htmlname] || $webdb[Info_htmlname]='html';
	if( count($city_DB[name])>2 ){
		if(!function_exists('MODULE_CK')||!in_array('fenlei',$BIZ_MODULEDB)){
			die("Free!");
		}		
	}
	if($city_DB[domain][$cityid]){
		$url=$city_DB[domain][$cityid].'/';
	}elseif($city_DB['dirname'][$cityid]&&$city_DB['url'][$cityid]){
		$url=$city_DB['url'][$cityid];
	}else{
		$url=$webdb[www_url].'/';
	}
	if($webdb[Info_htmlType]==2){
		if($id){
			$url.="{$Fid_db[F][dir_name][$fid]}/f$id.$webdb[Info_htmlname]";			
		}else{			
			if(!$zoneid&&!$streetid){
				$url.="{$Fid_db[F][dir_name][$fid]}";
			}elseif($zoneid&&$streetid){
				if(!$street_DB['dirname'][$streetid]){
					@include_once(ROOT_PATH."data/zone/$cityid.php");
				}				
				$url.="{$zone_DB['dirname'][$zoneid]}-{$street_DB['dirname'][$streetid]}/{$Fid_db[F][dir_name][$fid]}";
			}elseif($zoneid){
				if(!$zone_DB['dirname'][$zoneid]){
					@include_once(ROOT_PATH."data/zone/$cityid.php");
				}				
				$url.="{$zone_DB['dirname'][$zoneid]}/{$Fid_db[F][dir_name][$fid]}";
			}
			foreach($array AS $key=>$value){
				if($value!=''){
					if($key=='page'&&$value<2){
						continue;
					}					
					$value=str_replace(array('-','/'),array('#@#','#!#'),$value);
					$value=urlencode($value);
					$url.="-$key-$value";
				}				
			}
			$url.="/";
		}
	}elseif($webdb[Info_htmlType]==1){
		if($id){
			$url.="bencandy-city_id-$cityid-fid-$fid-id-$id.$webdb[Info_htmlname]";
		}else{
			$url.="list-city_id-$cityid-fid-$fid";
			$array[zone_id]=$zoneid;
			$array[street_id]=$streetid;
			foreach($array AS $key=>$value){
				if($value!=''){					
					$value=str_replace(array('-','/'),array('#@#','#!#'),$value);
					$value=urlencode($value);
					$url.="-$key-$value";
				}
			}
			$url.=".$webdb[Info_htmlname]";
		}
	}else{		
		if($id){
			$url.="bencandy.php?city_id=$cityid&fid=$fid&id=$id";
		}else{
			$url.="list.php?fid=$fid&city_id=$cityid";
			if($zoneid){
				$url.="&zone_id=$zoneid";
			}
			if($streetid){
				$url.="&street_id=$streetid";
			}
			foreach($array AS $key=>$value){
				$value=urlencode($value);
				$url.="&$key=$value";
			}
		}
	}
	return $url;
}

?>