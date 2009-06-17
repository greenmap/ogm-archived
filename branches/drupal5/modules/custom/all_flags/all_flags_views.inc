<?php
// SELECT a.* FROM node AS a LEFT OUTER JOIN og_ancestry AS b ON a.nid = b.nid WHERE b.nid IS NULL AND a.uid = $user->uid;
function all_flags_views_tables() {
//  return array();
  return array(
	'abuse' => array(
      'name' => 'abuse',
      'join' => array(
        'left' => array(
          'table' => 'node',
          'field' => 'nid',
        ),
		'right' => array(
		  'field' => 'oid'
		)
      ),
	  'fields' => array(
	    'type' => array(
			'name' => t('Abuse: Type'),
			'help' => t('Displays the type of the flag.')
		),
		'created' => array(
			'name' => t('Abuse: Created Time'),
			'sortable' => TRUE,
        	'handler' => all_flags_views_handler_field_dates(),
        	'option' => 'string',
			'help' => t('Displays the post time of the flag.')
		),
		'body' => array(
			'name' => t('Abuse: Body'),
			'help' => t('Displays the text body of a flag.')
		),
		'reason' => array(
			'name' => t('Abuse: Reason'),
			'sortable' => FALSE,
			'handler' => all_flags_views_handler_field_reason(),
			'option' => 'string',
			'help' => t('Displays the reason why flag has added.')
		),
	/*	'uid' => array(
			'name' => t('Abuse: Type'),
			'help' => t('Displays the type of a flag.')
		),*/
		'name' => array(
			'name' => t('Abuse: Name of flagger'),
			'help' => t('Displays the poster\'s name.')
		),
		'mail' => array(
			'name' => t('Abuse: Email of flagger'),
			'help' => t('Displays the poster\'s email.')
		),
		'allow' => array(
			'notafield' => TRUE,
			'name' => t('Abuse: Allow link'),
			'sortable' => FALSE,
			'handler' => all_flags_views_handler_field_allow(),
			'addlfields' => array(
				'type',
				'oid'
			),
			'option' => 'string',
			'help' => t('Displays the allow link.')
		),
		'count' => array(
			'notafield' => TRUE,
			'name' => t('Abuse: Count of all flags'),
			'sortable' => FALSE,
			'handler' => all_flags_views_handler_field_count(),
			'addlfields' => array(
				'type',
				'oid'
			),
			'option' => 'string',
			'help' => t('Displays the allow link.')
		),
		'pending' => array(
			'notafield' => TRUE,
			'name' => t('Abuse: Count of pending flags'),
			'sortable' => FALSE,
			'handler' => all_flags_views_handler_field_pending(),
			'addlfields' => array(
				'type',
				'oid'
			),
			'option' => 'string',
			'help' => t('Displays the allow link.')
		)
	  ),
	  'filters' => array(
        'oid' => array(
          // this filter does not set any context because i am delegating filtering to built
          // in views like handler. i can't easily learn which groups matched later.
		  // array('IS NULL' => 'Is Null')
		  // 'handler' => 'dashboard_handler_filter',
          'name' => t('All Flags: List of flags'),
          'operator' => array('=' => 'Equal'),
		  'field' => 'oid',
		  'value' => array('#type' => 'hidden', '#value' => ''),
		  'handler' => 'all_flags_handler_filter',
          'help' => t('Filter lists all flags of current node.')
        )
      ) 
    )
  );
}

function all_flags_views_handler_field_dates() {
  return array(
    'views_handler_field_date_small'  => t('As Short Date'),
    'views_handler_field_date'        => t('As Medium Date'),
    'views_handler_field_date_large'  => t('As Long Date'),
    'views_handler_field_date_custom' => t('As Custom Date'),
    'views_handler_field_since'       => t('As Time Ago')
  );
}

function all_flags_views_handler_field_reason() {
	return array(
		'all_flags_views_field_reason_default' => t('Default view')
	);
}
/*
 * _abuse_allow($type, $oid)
 * 
 */
function all_flags_views_field_reason_default($fieldinfo, $fielddata, $value, $data){
	$result =  db_query("SELECT * FROM abuse_reasons WHERE arid='".$value."';");
    $returnValue = db_fetch_object($result);
	
	return $returnValue->reason;
}

function all_flags_views_handler_field_allow(){
	return array(
		'all_flags_views_field_allow_default' => t('Allow link')
	);
}

function all_flags_views_field_allow_default($fieldinfo, $fielddata, $value, $data){
	//print_r($data);
	return l(t('Allow'),'all_flags/allow/'.$data->abuse_type."/".$data->abuse_oid);
	
}
function all_flags_views_handler_field_count(){
	return array(
		'all_flags_views_field_count_default' => t('total count of flags')
	);
}

function all_flags_views_field_count_default($fieldinfo, $fielddata, $value, $data){
	//print_r($data);
	 $result =  db_query("SELECT DISTINCT a.oid, count(b.aid) AS count FROM abuse AS a LEFT JOIN abuse AS b ON a.oid = b.oid WHERE a.type = '".$data->abuse_type."' AND a.oid='".$data->abuse_oid."' GROUP BY b.aid;");
	 $r = db_fetch_object($result);
	 if(isset($r->count)){
	 	$c = $r->count;
	 }else {
	 	$c = 0;
	 }
	return t($c . ' flag(s)');
	
}

function all_flags_views_handler_field_pending(){
	return array(
		'all_flags_views_field_pending_default' => t('pending')
	);
}
function all_flags_views_field_pending_default($fieldinfo, $fielddata, $value, $data){
	//print_r($data);
	 $result =  db_query("SELECT DISTINCT a.oid, count(b.aid) AS count FROM abuse AS a LEFT JOIN abuse AS b ON a.oid = b.oid WHERE a.type = '".$data->abuse_type."' AND a.oid='".$data->abuse_oid."' AND a.valid='0' GROUP BY b.aid;");
	 $r = db_fetch_object($result);
	 if(isset($r->count)){
	 	$c = $r->count;
	 }else {
	 	$c = 0;
	 }
	return t($c . ' flag(s)');
	
}
function all_flags_handler_filter($op, $filter, $filterinfo, &$query) {
	$query->add_table('abuse');
	$query->add_where("abuse.oid IS NOT NULL");
	$query->add_where("abuse.valid = 0");
  //$query->add_table('abuse');
  //$query->add_where("abuse.oid = node.nid");
  //print_r($filter);
}