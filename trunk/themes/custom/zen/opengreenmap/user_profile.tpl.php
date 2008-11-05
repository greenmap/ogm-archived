<?php
//echo print_r($user);
drupal_add_js("misc/collapse.js");


$allowed_adder = FALSE;
if($GLOBALS['user']->uid == $user->uid && user_access('create green_site content')){
	$allowed_adder = TRUE;
}

if(!$allowed_adder){
	print t('Currently only registered Green Map projects can add sites and maps to the Open Green Map. ');
	print t('To become a Mapmaker go to ') . l(t('GreenMap.org/join'), 'http://www.greenmap.org/join');
}

$isGroups = false;
while(list($key,$group) = each($user->og_groups)){
	$isGroups = true;
	$view = views_get_view('list_of_user_sites');
	$view->args[0]=$user->uid;
	$view->args[1]=$key;
	$site_list = views_build_view('block', $view,$view->args, false, false);
		
	$allowed_editor = FALSE;
	
	if  ($user->og_groups[$key]['is_admin'] && $GLOBALS['user']->uid == $user->uid) {
       	$allowed_editor = TRUE;
	}
	
	
	echo "<fieldset class='collapsible collapsed'>".
			"<legend> ".t('My sites on')." ".$user->og_groups[$key]['title'];
	echo 	"</legend>";
	echo 	l(t("View map"),'node/' . $key);
			if($allowed_editor){
				echo l(t(" Edit map"),'node/' . $key. "/edit");
			}
			if($allowed_adder){
				echo l(t(" Add green site"),'node/add/green_site',null,'gids[]='.$key);
			}
	
	echo	"<h3>".t("Sites:")."</h3>";
	echo	$site_list;
	echo	"<h3>".t("Recent Comments:")."</h3>";
			$comment_view = views_get_view('comments_recent_dashboard');
			$comment_view->args[0]=$user->uid;
			$comment_view->args[1]=$key;
			$comment_site_list = views_build_view('block', $comment_view,$comment_view->args, false, false);
	echo 	$comment_site_list;
	if($allowed_editor){
		echo	"<h3>".t("Flags:")."</h3>";
				$flag_view = views_get_view('list_all_flags');
				$flag_view->args[0]=$user->uid;
				$flag_view->args[1]=$key;
			//	print_r($flag_view);
				$flag_site_list = views_build_view('block', $flag_view,$flag_view->args, false, false);
		echo 	$flag_site_list;
	}
	echo "</fieldset>";
}

if($isGroups){
        $title = t("All of my sites not in a map");
        $collapsed = 'collapsed';
}else {
        $title = t("All of my sites");
        $collapsed = '';
}

$view = null;
$view = views_get_view('list_of_user_sites_nomap');
$view->args[0]=$user->uid;

$site_list = views_build_view('block', $view,$view->args, false, false);

	echo "<fieldset class='collapsible ".$collapsed."'>".
    		"<legend> ".$title."</legend>";
			if($allowed_adder){
				echo l(t("Add green site"),'node/add/green_site');
			}
    echo    "<h3>".t("Sites:")."</h3>";
    echo    $site_list;
    echo    "<h3>".t("Recent Comments:")."</h3>";
			$comment_view = null;
    		$comment_view = views_get_view('comments_recent_dashboard_nomap');
    		$comment_view->args[0]=$user->uid;
            $comment_site_list = views_build_view('block', $comment_view,$comment_view->args, false, false);
   	echo 	$comment_site_list;
   	echo	"<h3>".t("Flags:")."</h3>";

			$flag_view = null;
			$flag_view = views_get_view('list_all_flags_nomap');
			$flag_view->args[0]=$user->uid;
			$flag_site_list = views_build_view('block', $flag_view,$flag_view->args, false, false);
	echo 	$flag_site_list;
	echo "</fieldset>";


