<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'rfm_controller';;
$route['logout'] = 'auth_controller/logout';
$route['dashboard'] = 'dashboard_controller';
$route['rfm'] = 'rfm_controller';
$route['track_rfm'] = 'track_rfm_controller';
$route['rfp'] = 'rfp_controller';
$route['track_rfp'] = 'track_rfp_controller';
$route['project'] = 'project_controller';
$route['report'] = 'reportrfm_controller';
$route['daily_report'] = 'dailyreport_controller';
$route['activity'] = 'activity_controller';
$route['Darwhin_Sinarta'] = 'darwhin_controller';
$route['Hamsudi'] = 'hamsudi_controller';
$route['Indra_Maulana'] = 'indra_controller';
$route['Alan_Gentina'] = 'alan_controller';
$route['Bonar_Purba'] = 'bonar_controller';
$route['Elvia_Nur_Anggraini'] = 'elvia_controller';
$route['Irvan_Muhammad_Sindy'] = 'irvan_controller';
$route['Nanang_Andriani'] = 'nanang_controller';
$route['Reynaldi'] = 'reynaldi_controller';
$route['Rudy_Novrianto'] = 'rudy_controller';
$route['Suluh_Damar_Grahita'] = 'suluh_controller';
$route['Yosep_Heryana'] = 'yosep_controller';
$route['user_management'] = 'um_controller';
$route['kpi'] = 'um_controller/kpi_pic';
$route['export_to_excel'] = 'rfm_controller/export_to_excel';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
