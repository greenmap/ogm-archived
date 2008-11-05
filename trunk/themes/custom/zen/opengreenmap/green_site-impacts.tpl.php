<?php

// this function is called by green-site-full.tpl.php
// it creates the impacts tab
function output_impacts($node)
{
	// create the form to add a new impact
	$add_impact = '<div id="addimpact"><form method="get" action="' . base_path() . 'node/add/impact"><label>';
	$add_impact .= t('Because of this site, I ') . '<select id="impacttype" name="impacttype">' ;
	$add_impact .= '<option id="">choose one</option>';
	$add_impact .= '<option id="Changed a Habit">Changed a Habit</option>';
	$add_impact .= '<option id="Greened my Work">Greened my Work</option>';
	$add_impact .= '<option id="Saved CO2">Saved CO2</option>';
	$add_impact .= '<option id="Protected Nature">Protected Nature</option>';
	$add_impact .= '<option id="Raised Awareness">Raised Awareness</option>';
	$add_impact .= '<option id="Connected Locally">Connected Locally</option>';
	$add_impact .= '<option id="Took Action">Took Action</option>';
	$add_impact .= '<option id="Other">Other</option>';
	$add_impact .= '</select> <input type="submit" value="Add Yours!" />';
	// this ensures that the next page works inside the iframe
	$add_impact .= '<input type="hidden" name="theme" value="simple" />';
	// this ensures that we return to the green site when we submit the impact
	$add_impact .= '<input type="hidden" name="destination" value="node/' . $node->nid . '/simple" />';
	// this passes the node id of the site to the impact form
	$add_impact .= '<input type="hidden" name="nid" value="' . $node->nid . '" />';
	$add_impact .= '<input type="hidden" name="node_title" value="' . $node->title . '" />';
	$add_impact .= '</form></div>';

	// query database for impacts
	$result = db_query('SELECT field_because_of_this_site_value AS action, COUNT(1) AS actioncount
						FROM {content_type_impact} 
						WHERE field_site_nid = %d
						GROUP BY action', $node->nid);

	// set basic details for chart
	$chart = array(
	  '#chart_id' => 'test_chart',
	  '#title' => t('Impacts'),
	  '#type' => CHART_TYPE_BAR_H_GROUPED,
	  '#adjust_resolution' => TRUE,
	  
	);

	$colors = array(
		'Changed a Habit' => 'f89938',
		'Greened my Work' => 'fdbb30',
		'Saved CO2' => 'fedb91',
		'Protected Nature' => '099848',
		'Raised Awareness' => '8cc63f',
		'Connected Locally' => '7fb3d8',
		'Other' => '666666',
	);

	$max = 0;
	// get data for chart
	while ($impact = db_fetch_object($result)) {
		$chart['#data'][] = array($impact->actioncount);
		$chart['#legends'][] = $impact->action;
		// set colours automatically, can over-ride with our own colors if we want
		$chart['#data_colors'][] = $colors[$impact->action];
		if($impact->actioncount > $max){
			$max = $impact->actioncount;
		}
	}
	
	// automatically set x axis labels for bottom. don't know how to prevent decimals 
	$chart['#mixed_axis_labels'][CHART_AXIS_X_BOTTOM][1][] = chart_mixed_axis_range_label(0, $max);

	// chart_size(300);


	// add the chart to the impacts section
	$add_impact .= '<div id="impacts_chart">';
	$add_impact .= chart_render($chart);
	$add_impact .= '</div>';

	// this embeds a list of all current impacts
	$add_impact .= '<div id="impacts_right">';

	$add_impact .= '<div id="impacts_list">';
	$list_of_impacts_view = views_get_view('list_of_impacts_for_site');
	$list_of_impacts_view->args[0]=$node->nid;
	$add_impact .= views_build_view('embed', $list_of_impacts_view, $list_of_impacts_view->args, false, false); 
	$add_impact .= '</div>';

	$res = db_query('SELECT COUNT(vid) AS cnt FROM {content_type_impact} WHERE field_site_nid = %d AND field_discover_site_value = 1', $node->nid);
	$line = db_fetch_object($res);
	if ($line->cnt > 0)
		$add_impact .= '<p id="impacts_stats">'.$line->cnt.' People discovered this site because of this map. <a href="'.base_path().'node/add/impact?theme=simple&destination=node/'.$node->nid.'/simple&nid='.$node->nid.'&node_title='.$node->title.'">Did you?</a></p>';

	$add_impact .= '</div>';

	// return the impacts section to the main info window building function
	return $add_impact;
}
