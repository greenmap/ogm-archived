<?php
	$allowed_adder = FALSE;
	if($GLOBALS['user']->uid == $user->uid){
		$allowed_adder = TRUE;
	}
	print_r(location_get_iso3166_list());
	$countries = location_get_iso3166_list();
	$result =  db_query("SELECT b.* FROM node AS a LEFT JOIN content_field_moderated_countries AS b ON a.nid = b.nid WHERE b.nid IS NOT NULL AND a.uid = '".$GLOBALS['user']->uid."';");
	$returnValue = db_fetch_object($result);
	$view = views_get_view('moderate_list_of_user_sites');
	$view->args[0]=$returnValue->field_moderated_countries_value;
	$site_list = views_build_view('block', $view,$view->args, false, false);

	$allowed_editor = FALSE;
	// ERROR
	if ($user->og_groups[$key]['is_admin'] && $GLOBALS['user']->uid == $user->uid) {
       	$allowed_editor = TRUE;
	}

    $content .= l(t("View map"),'node/' . $key);
				if($allowed_editor){
					$content .= l(t(" Edit map"),'node/' . $key. "/edit");
				}
				if($allowed_adder){
					$content .= l(t(" Add green site"),'node/add/green_site',null,'gids[]='.$key);
				}
	
	$content .=	"<h3>".t("Sites:")."</h3>";
	$content .= "<div style='overflow:auto;height:150px;'>";
	$content .=	$site_list;
	$content .= "</div>";
	$content .=	"<h3>".t("Recent Comments:")."</h3>";
				$comment_view = views_get_view('moderate_comments_recent');
				$comment_view->args[0]=$returnValue->field_moderated_countries_value;
				$comment_site_list = views_build_view('block', $comment_view,$comment_view->args, false, false);
	$content .= "<div style='overflow:auto;height:150px;'>";
	$content .= $comment_site_list;
	$content .= "</div>";
//	if($allowed_editor){
		$content .=	"<h3>".t("Flags:")."</h3>";
					$flag_view = views_get_view('moderate_list_all_flags');
					$flag_view->args[0]=$returnValue->field_moderated_countries_value;
					$flag_site_list = views_build_view('block', $flag_view,$flag_view->args, false, false);
		$content .= "<div style='overflow:auto;height:150px;'>";
		$content .= 	$flag_site_list;
		$content .= "</div>";
?>
