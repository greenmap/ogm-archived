<?php

  $marker_label = '';
  $marker_label .= '<div class="gmappopup">';
  // name, title, latitude, longitude, comment_count, value, nid, field_image_embed
  foreach ($view->field as $field) {
  	if($field['field']== 'nid')  {
 		$nid = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $entry, $view);
//		$node = node_load($nid); // far too heavy!
		$terms = taxonomy_node_get_terms($nid);
		foreach($terms as $key => $value) {
			$tid = $key;
			$icon = taxonomy_image_display($tid);
			$category_tid = taxonomy_get_parents($tid);
			foreach($category_tid as $key2 => $value2) {
				$genre_tids = taxonomy_get_parents($key2); // this gets the  genre, to be inserted as a class into things that need to be colored according to category
				foreach($genre_tids as $key3 => $value3) {
					$genre_tid = $key3;
					$genre_name = $value3->name;
					$genre_name_lc = strtolower($genre_name);
				}
			}
		}
		// $marker_label .= var_dump($terms);
 	}
	
	if($field['field']== 'name')  {
		$marker_label .= '<div class="gmapstyle-'. $field['field'] . ' ' . $genre_name_lc . '">'. $icon . views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $entry, $view)  . '</div>';
	}
	elseif($field['field']== 'title')  {
		$marker_label .= '<div class="gmapstyle-'. $field['field'] . ' ' . $genre_name_lc .'">'. views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $entry, $view)  . '</div>';
		// $marker_label .= '<hr class="gmapstyle-hr" ></hr>';
	}
	elseif($field['field']== 'field_image_embed')  {
		$image_html = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $entry, $view);
		if($image_html > '') {
			$marker_label .= '<div class="gmapstyle-'. $field['field'] .'">'. $image_html  . '</div>';
		}
	}
	elseif($field['field']== 'value')  {
		$marker_label .= '<div class="gmapstyle-'. $field['field'] .'">'. views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $entry, $view) . '</div>';
		// $marker_label .= '<div class="gmapstyle-more">' . l(t('more info') . ' >','node/' . $nid) . '</div>'; // eventually change link to be big info window
		// $marker_label .= '<a href="#" onClick="maxme()">link</a>';
		// need to add map.getInfoWindow().maximize() 
		$marker_label .= '<div class="gmapstyle-email">' . l(t('email this'),'forward/' . $nid) .'</div>';
		$marker_label .= '<div class="gmapstyle-link" id="linkthis" style="display: none"><a href="" onClick="mypopup()" >link this</a></div>'; // hide this until get js to work
		$marker_label .= '<div class="gmapstyle-linkbox" id="linkbox" style="display: none"><input name="textfield" type="text" value="http://www.greenmap.org' . base_path() . 'node/' . $nid . '"></div>';	
	}

	elseif($field['field']== 'comment_count')  {
		$comment_text = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $entry, $view)  . ' ' . t('comments');
		$marker_label .= '<div class="gmapstyle-'. $field['field'] .'">'. l($comment_text,'node/' . $nid, NULL, NULL, 'tabs-2') . '</div>';
	}
	elseif($field['field']== 'pending')  {
		$pending_text = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $entry, $view);
		if($pending_text[0] != '0') {
			$marker_label .= '<div class="gmapstyle-'. $field['field'] .'">'. t($pending_text) . '</div>';	
		}
		
	}
    // $marker_label .= '<div class="gmapstyle-'. $field['field'] .'">'. views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $entry, $view)  . '</div>';
  }
  // $view->field$field['field']== 'nid'
  //echo arg(1);
//  print_r($view->field);

  print $marker_label;
