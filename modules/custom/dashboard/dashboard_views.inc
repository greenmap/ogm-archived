<?php

function dashboard_views_tables() {
//  return array();
  return array(
	'og_ancestry_dashboard' => array(
      'name' => 'og_ancestry',
      'join' => array(
        'left' => array(
          'table' => 'node',
          'field' => 'nid',
        ),
		'right' => array(
		  'field' => 'nid'
		)
      ),
	  'filters' => array(
        'group_nid' => array(
          // this filter does not set any context because i am delegating filtering to built
          // in views like handler. i can't easily learn which groups matched later.
		  // array('IS NULL' => 'Is Null')
		  // 'handler' => 'dashboard_handler_filter',
          'name' => t('Dashboard: post not in og'),
          'operator' => array('IS' => 'Is'),
		  'field' => 'group_nid',
		  'value' => array('#type' => 'hidden', '#value' => null),
		  'handler' => 'dashboard_handler_filter',
          'help' => t('Filter lists all nodes not posted to group.'),   
        )
      )    
    )
  );
}

function dashboard_handler_filter($op, $filter, $filterinfo, &$query) {
  $query->add_table('og_ancestry');
  $query->add_where("og_ancestry.nid IS NULL");
}
