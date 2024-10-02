<?php

// module directory name
$HmvcConfig['facebooklogin']["_title"]       = "Facebooklogin customer";
$HmvcConfig['facebooklogin']["_description"] = "Facebooklogin customer";



// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['facebooklogin']['_database'] = true;
$HmvcConfig['facebooklogin']["_tables"] = array(
	'facebook_settings'
);
//Table sql Data insert into existing tables to run module
$HmvcConfig['facebooklogin']["_extra_query"] = true;


