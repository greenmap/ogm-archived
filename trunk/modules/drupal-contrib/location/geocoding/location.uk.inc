<?php
// $Id: location.uk.inc,v 1.2 2006/03/08 06:53:39 dww Exp $

function location_geocode_uk_providers() {
  return array(
    'google' => array('name' => 'Google Maps API', 'url' => 'http://www.google.com/apis/maps/', 'tos' => 'http://www.google.com/apis/maps/terms.html')

  );
}


function location_geocode_uk_google($location = array()) {
  $service_url = 'http://maps.google.com/maps/geo?output=xml&key='. variable_get('location_geocode_uk_google_apikey', '') .'&q=';

  //Optimisation for getting results
  $full_line_address = location_address2singleline($location);

    if($location['postal_code']) {
     $address = $location['postal_code'];
    } elseif($location['street']) {
     $address = $location['street']. ', ' .$location['city'];
    } else { 
     $address = $full_line_address;
    }

  $http_reply = drupal_http_request($service_url . urlencode($address));

  $status_code_match = array();
  preg_match('/<code>(.*)<\/code>/', $http_reply->data, $status_code_match);
  $status_code = $status_code_match[1];
  if ($status_code != 200) {
    return NULL;
  }

  $accuracy_code_match = array();
  preg_match('/Accuracy="([0-9])"/', $http_reply->data, $accuracy_code_match);
  $accuracy_code = $accuracy_code_match[1];

  //Changed accuracy threshold... needs testing...
  if ($accuracy_code < 2) {
    return NULL;
  }

  $latlon_match = array();
  preg_match('/<coordinates>(.*)<\/coordinates>/', $http_reply->data, $latlon_match);

  $latlon_exploded = explode(',', $latlon_match[1]);

  return array('lat' => $latlon_exploded[1], 'lon' => $latlon_exploded[0]);
}


function location_geocode_uk_google_settings() {
  $form = array();

  $form['location_geocode_uk_google_apikey'] = array(
    '#type' => 'textfield',
    '#title' => t('Google Maps API Key'),
    '#size' => 64,
    '#maxlength' => 128,
    '#default_value' => variable_get('location_geocode_uk_google_apikey', ''),
    '#description' => t('In order to use the Google Maps API geocoding web-service, you will need a Google Maps API Key.  You can obtain one at the !sign_up_link for the !google_maps_api.', array('!sign_up_link' => '<a href="http://www.google.com/apis/maps/signup.html">sign-up page</a>', '!google_maps_api' => '<a href="http://www.google.com/apis/maps/">Google Maps API</a>'))

  );

  return $form;
}




// Great Britain
function location_province_list_uk() {
  return array('GSY' => "Guernsey",
    'JSY' => "Jersey",
    'BDG' => "Barking and Dagenham",
    'BNE' => "Barnet",
    'BNS' => "Barnsley",
    'BAS' => "Bath and North East Somerset",
    'BDF' => "Bedfordshire",
    'BEX' => "Bexley",
    'BIR' => "Birmingham",
    'BBD' => "Blackburn with Darwen",
    'BPL' => "Blackpool",
    'BOL' => "Bolton",
    'BMH' => "Bournemouth",
    'BRC' => "Bracknell Forest",
    'BRD' => "Bradford",
    'BEN' => "Brent",
    'BNH' => "Brighton and Hove",
    'BST' => "Bristol City of",
    'BRY' => "Bromley",
    'BKM' => "Buckinghamshire",
    'BUR' => "Bury",
    'CLD' => "Calderdale",
    'CAM' => "Cambridgeshire",
    'CMD' => "Camden",
    'CHS' => "Cheshire",
    'CON' => "Cornwall",
    'COV' => "Coventry (West Midlands district)",
    'CRY' => "Croydon",
    'CMA' => "Cumbria",
    'DAL' => "Darlington",
    'DER' => "Derby",
    'DBY' => "Derbyshire",
    'DEV' => "Devon",
    'DNC' => "Doncaster",
    'DOR' => "Dorset",
    'DUD' => "Dudley (West Midlands district)",
    'DUR' => "Durham",
    'EAL' => "Ealing",
    'ERY' => "East Riding of Yorkshire",
    'ESX' => "East Sussex",
    'ENF' => "Enfield",
    'ESS' => "Essex",
    'GAT' => "Gateshead (Tyne & Wear district)",
    'GLS' => "Gloucestershire",
    'GRE' => "Greenwich",
    'HCK' => "Hackney",
    'HAL' => "Halton",
    'HMF' => "Hammersmith and Fulham",
    'HAM' => "Hampshire",
    'HRY' => "Haringey",
    'HRW' => "Harrow",
    'HPL' => "Hartlepool",
    'HAV' => "Havering",
    'HEF' => "Herefordshire County of",
    'HRT' => "Hertfordshire",
    'HIL' => "Hillingdon",
    'HNS' => "Hounslow",
    'IOW' => "Isle of Wight",
    'IOS' => "Isles of Scilly",
    'ISL' => "Islington",
    'KEC' => "Kensington and Chelsea",
    'KEN' => "Kent",
    'KHL' => "Kingston upon Hull City of",
    'KTT' => "Kingston upon Thames",
    'KIR' => "Kirklees",
    'KWL' => "Knowsley",
    'LBH' => "Lambeth",
    'LAN' => "Lancashire",
    'LDS' => "Leeds",
    'LCE' => "Leicester",
    'LEC' => "Leicestershire",
    'LEW' => "Lewisham",
    'LIN' => "Lincolnshire",
    'LIV' => "Liverpool",
    'LND' => "London City of",
    'LUT' => "Luton",
    'MAN' => "Manchester",
    'MDW' => "Medway",
    'MRT' => "Merton",
    'MDB' => "Middlesbrough",
    'MIK' => "Milton Keynes",
    'NET' => "Newcastle upon Tyne",
    'NWM' => "Newham",
    'NFK' => "Norfolk",
    'NEL' => "North East Lincolnshire",
    'NLN' => "North Lincolnshire",
    'NSM' => "North Somerset",
    'NTY' => "North Tyneside",
    'NYK' => "North Yorkshire",
    'NTH' => "Northamptonshire",
    'NBL' => "Northumberland",
    'NGM' => "Nottingham",
    'NTT' => "Nottinghamshire",
    'OLD' => "Oldham",
    'OXF' => "Oxfordshire",
    'PTE' => "Peterborough",
    'PLY' => "Plymouth",
    'POL' => "Poole",
    'POR' => "Portsmouth",
    'RDG' => "Reading",
    'RDB' => "Redbridge",
    'RCC' => "Redcar and Cleveland",
    'RIC' => "Richmond upon Thames",
    'RCH' => "Rochdale",
    'ROT' => "Rotherham",
    'RUT' => "Rutland",
    'SHN' => "St Helens",
    'SLF' => "Salford",
    'SAW' => "Sandwell",
    'SFT' => "Sefton",
    'SHF' => "Sheffield",
    'SHR' => "Shropshire",
    'SLG' => "Slough",
    'SOL' => "Solihull",
    'SOM' => "Somerset",
    'SGC' => "South Gloucestershire",
    'STY' => "South Tyneside",
    'STH' => "Southampton",
    'SOS' => "Southend-on-Sea",
    'SWK' => "Southwark",
    'STS' => "Staffordshire",
    'SKP' => "Stockport",
    'STT' => "Stockton-on-Tees",
    'STE' => "Stoke-on-Trent",
    'SFK' => "Suffolk",
    'SND' => "Sunderland",
    'SRY' => "Surrey",
    'STN' => "Sutton",
    'SWD' => "Swindon",
    'TAM' => "Tameside",
    'TFW' => "Telford and Wrekin",
    'THR' => "Thurrock",
    'TOB' => "Torbay",
    'TWH' => "Tower Hamlets",
    'TRF' => "Trafford",
    'WKF' => "Wakefield",
    'WLL' => "Walsall",
    'WFT' => "Waltham Forest",
    'WND' => "Wandsworth",
    'WRT' => "Warrington",
    'WAR' => "Warwickshire",
    'WBK' => "West Berkshire",
    'WSX' => "West Sussex",
    'WSM' => "Westminster",
    'WGN' => "Wigan",
    'WIL' => "Wiltshire",
    'WNM' => "Windsor and Maidenhead",
    'WRL' => "Wirral",
    'WOK' => "Wokingham",
    'WLV' => "Wolverhampton",
    'WOR' => "Worcestershire",
    'YOR' => "York",
    'ANT' => "Antrim",
    'ARD' => "Ards",
    'ARM' => "Armagh",
    'BLA' => "Ballymena",
    'BLY' => "Ballymoney",
    'BNB' => "Banbridge",
    'BFS' => "Belfast",
    'CKF' => "Carrickfergus",
    'CSR' => "Castlereagh",
    'CLR' => "Coleraine",
    'CKT' => "Cookstown",
    'CGV' => "Craigavon",
    'DRY' => "Derry",
    'DOW' => "Down",
    'DGN' => "Dungannon and South Tyrone",
    'FER' => "Fermanagh",
    'LRN' => "Larne",
    'LMV' => "Limavady",
    'LSB' => "Lisburn",
    'MFT' => "Magherafelt",
    'MYL' => "Moyle",
    'NYM' => "Newry and Mourne",
    'NTA' => "Newtownabbey",
    'NDN' => "North Down",
    'OMH' => "Omagh",
    'STB' => "Strabane",
    'ABE' => "Aberdeen",
    'ABD' => "Aberdeenshire",
    'ANS' => "Angus",
    'AGB' => "Argyll and Bute",
    'CLK' => "Clackmannanshire",
    'DGY' => "Dumfries and Galloway",
    'DND' => "Dundee",
    'EAY' => "East Ayrshire",
    'EDU' => "East Dunbartonshire",
    'ELN' => "East Lothian",
    'ERW' => "East Renfrewshire",
    'EDH' => "Edinburgh",
    'ELS' => "Eilean Siar",
    'FAL' => "Falkirk",
    'FIF' => "Fife",
    'GLG' => "Glasgow",
    'HLD' => "Highland",
    'IVC' => "Inverclyde",
    'NAY' => "North Ayrshire",
    'NLK' => "North Lanarkshire",
    'ORK' => "Orkney Islands",
    'PKN' => "Perth and Kinross",
    'MLN' => "Midlothian",
    'MRY' => "Moray",
    'RFW' => "Renfrewshire",
    'SCB' => "Scottish Borders The",
    'ZET' => "Shetland Islands",
    'SAY' => "South Ayrshire",
    'SLK' => "South Lanarkshire",
    'STG' => "Stirling",
    'WDU' => "West Dunbartonshire",
    'WLN' => "West Lothian",
    'BGW' => "Blaenau Gwent",
    'BGE' => "Bridgend",
    'CAY' => "Caerphilly",
    'CRF' => "Cardiff",
    'CMN' => "Carmarthenshire",
    'CGN' => "Ceredigion",
    'CWY' => "Conwy",
    'DEN' => "Denbighshire",
    'FLN' => "Flintshire",
    'GWN' => "Gwynedd",
    'AGY' => "Isle of Anglesey",
    'MTY' => "Merthyr Tydfil",
    'MON' => "Monmouthshire",
    'NTL' => "Neath Port Talbot",
    'NWP' => "Newport",
    'PEM' => "Pembrokeshire",
    'POW' => "Powys",
    'RCT' => "Rhondda Cynon Taf",
    'SWA' => "Swansea",
    'TOF' => "Torfaen",
    'VGL' => "Vale of Glamorgan",
    'WRX' => "Wrexham");
}
?>
