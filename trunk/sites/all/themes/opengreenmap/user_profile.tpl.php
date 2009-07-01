<!--user_profile.tpl.php-->
<?php
//print print_r($user);
drupal_add_js("misc/collapse.js");

global $user;
$this_user = FALSE;
if (arg(0) == 'user' && is_numeric(arg(1))) {
  $this_user = user_load(arg(1));
}
if (!$this_user) {
  return;
}

$allowed_adder = FALSE;
if($user->uid == $this_user->uid && user_access('create green_site content')){
  $allowed_adder = TRUE;
}

if(!$allowed_adder){
  print t('Currently only registered Green Map projects can add sites and maps to the Open Green Map. ');
  print t('To become a Mapmaker go to <a href="http://www.greenmap.org/join">GreenMap.org/join</a>');
}

$isGroups = false;
while(list($key,$group) = each($this_user->og_groups)){
  $isGroups = true;
  $site_list = views_embed_view('list_of_user_sites_nomap', 'page_1', $this_user->uid, $key);
  $allowed_editor = FALSE;
  if  ($this_user->og_groups[$key]['is_admin'] && $user->uid == $this_user->uid) {
    $allowed_editor = TRUE;
  }

  print "<fieldset class='collapsible collapsed'>".
        "<legend> ".t('My sites on')." ".$this_user->og_groups[$key]['title'];
  print "</legend>";
  print l(t("View map"),'node/' . $key);
  if($allowed_editor){
    print l(t(" Edit map"),'node/' . $key. "/edit");
  }
  if($allowed_adder){
    print l(t(" Add Green Site"),'node/add/green_site', array('query' => 'gids[]='.$key));
  }

  print "<h3>".t("Green Sites:")."</h3>";
  print $site_list;
  print "<h3>".t("Recent Comments:")."</h3>";
  $comment_site_list = views_embed_view('comments', 'page_1', $key);
  print $comment_site_list;
  print "</fieldset>";
}

if ($isGroups){
  $title = t("All of my sites not in a map");
  $collapsed = 'collapsed';
}
else {
  $title = t("All of my sites");
  $collapsed = '';
}

$site_list = views_embed_view('list_of_user_sites_nomap', 'page_2', $this_user->uid);

print "<fieldset class='collapsible ".$collapsed."'>".
        "<legend> ".$title."</legend>";
if($allowed_adder){
  print l(t("Add green site"),'node/add/green_site');
}
print "<h3>".t("Sites:")."</h3>";
print $site_list;
print "<h3>".t("Recent Comments:")."</h3>";
$comment_site_list = views_embed_view('comments_recent_dashboard_nomap', 'default', $this_user->uid);
print $comment_site_list;

$flag_site_list = views_embed_view('list_all_flags_nomap', 'default', $this_user->uid);
print $flag_site_list;
print "</fieldset>";

?>
<!--/user_profile.tpl.php-->
