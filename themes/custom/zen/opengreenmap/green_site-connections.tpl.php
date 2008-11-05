<?php


function escape_js($str)
{
	$str = str_replace('\'', '&#039;', $str);
	$str = str_replace('"', '\"', $str);
	$str = str_replace("\n", '', $str);
	return $str;
}


function output_connections($node)
{
	$js = '';
	$js .= 'var c_content = [];';

	$list_related_sites = views_get_view('list_related_sites');
	$list_related_sites->args[0]=$node->primary_term->tid;
	$rel = views_build_view('embed', $list_related_sites, $list_related_sites->args, FALSE, 10);
	$rel = str_replace('<a href=', '<a target="_parent" href=', $rel);
	$rel = escape_js($rel);

	$js .= 'c_content["Links"] = "not available yet";';
	$js .= 'c_content["Related Sites"] = "' . $rel . '";';
	$js .= 'c_content["Related Green Maps"] = "not available yet";';
	$js .= 'c_content["Events"] = "not available yet";';
	$js .= 'c_content["Contacts at this Site"] = "not available yet";';
	$js .= 'c_content["Getting Here"] = "' . escape_js(content_format('field_phone', $node->field_public_transport_directio[0])) . '";';
	$js .= 'function replace_connections_content(item) {';
	$js .= 'document.getElementById("connections_content").innerHTML = c_content[item];';
	$js .= '}';
	drupal_add_js($js, 'inline');

	$ret = '';
	$ret .= '<div id="connections_container">';
		$ret .= '<div id="connections_menu">';
			$menu_items = array('Links', 'Related Sites', 'Related Green Maps');
			if (!empty($node->field_public_transport_directio[0]['value']))
				$menu_items[] = 'Getting Here';
			$menu_items = array_merge($menu_items, array('Events', 'Contacts at this Site'));
			foreach ($menu_items as $mi) {
				$ret .= '<p class="connections_menu_item" onclick="javascript:replace_connections_content(\''.$mi.'\');">' . $mi . '</p>';
			}
		$ret .= '</div>';
		$ret .= '<div id="connections_content">';
			$ret .= '';
		$ret .= '</div>';
		$ret .= '<div style="clear: left;"></div>';
	$ret .= '</div>';

	return $ret;
}


?>