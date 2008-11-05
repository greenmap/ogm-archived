<?php
// SELECT a.* FROM node AS a LEFT OUTER JOIN og_ancestry AS b ON a.nid = b.nid WHERE b.nid IS NULL AND a.uid = $user->uid;
function moderate_ogm_views_tables() {
//  return array();
  return array(
	'content_field_moderated_countries' => array(
      'name' => 'content_field_moderated_countries',
      'join' => array(
        'left' => array(
          'table' => 'node',
          'field' => 'nid',
        ),
		'right' => array(
		  'field' => 'nid'
		)
      ),
	  'fields' => array(
		'field_moderated_countries_value' => array(
			'name' => t('Moderated countries: Value'),
			'sortable' => FALSE,
			'handler' => moderate_ogm_views_handler_field_value(),
			'option' => 'string',
			'help' => t('Displays the reason why flag has added.')
		),
/*		'allow' => array(
			'notafield' => TRUE,
			'name' => t('Abuse: Allow link'),
			'sortable' => FALSE,
			'handler' => moderate_ogm_views_handler_field_allow(),
			'addlfields' => array(
				'type',
				'oid'
			),
			'option' => 'string',
			'help' => t('Displays the allow link.')
			
		)*/
	  ),
	  'filters' => array(
        'nid' => array(    
          'name' => t('Moderated countries: List of Countries'),
          'operator' => array('=' => 'Equal'),
		  'field' => 'nid',
		  'value' => array('#type' => 'hidden', '#value' => ''),
		  'handler' => 'moderate_ogm_handler_filter',
          'help' => t('Filter lists all countries of current node.')
        )
      ) 
    )
  );
}

function moderate_ogm_views_handler_field_dates() {
  return array(
    'views_handler_field_date_small'  => t('As Short Date'),
    'views_handler_field_date'        => t('As Medium Date'),
    'views_handler_field_date_large'  => t('As Long Date'),
    'views_handler_field_date_custom' => t('As Custom Date'),
    'views_handler_field_since'       => t('As Time Ago')
  );
}

function moderate_ogm_views_handler_field_value() {
	return array(
		'moderate_ogm_views_field_value_default' => t('Default view')
	);
}
/*
 * _abuse_allow($type, $oid)
 * 
 */
function moderate_ogm_views_field_value_default($fieldinfo, $fielddata, $value, $data){
//	$result =  db_query("SELECT * FROM abuse_reasons WHERE arid='".$value."';");
 //   $returnValue = db_fetch_object($result);
	print($value);
//	return $returnValue->reason;
}

function moderate_ogm_views_handler_field_allow(){
	return array(
		'moderate_ogm_views_field_allow_default' => t('Allow link')
	);
}

function moderate_ogm_views_field_allow_default($fieldinfo, $fielddata, $value, $data){
	//print_r($data);
	return l(t('Allow'),'moderate_ogm/allow/'.$data->abuse_type."/".$data->abuse_oid);
	
}



function moderate_ogm_handler_filter($op, $filter, $filterinfo, &$query) {
//	$query->add_table('abuse');
//	$query->add_where("abuse.oid IS NOT NULL");
//	$query->add_where("abuse.valid = 0");
  //$query->add_table('abuse');
  //$query->add_where("abuse.oid = node.nid");
  print_r($filter);
}