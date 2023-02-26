<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|    example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|    https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|    $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|    $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|    $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:    my-controller/index    -> my_controller/index
|        my-controller/my-method    -> my_controller/my_method
 */
$route['default_controller'] = 'home';
$route['/'] = '/home';
// $route['(:any)'] = '/business/index/$1';
$route['sign-up'] = '/sign_up';
$route['sign-up/(:any)'] = '/sign_up/$1';
$route['sign-in/(:any)'] = '/sign_in/$1';
$route['sign-in'] = '/sign_in';
$route['logout'] = '/sign_in/logout';
$route['business/(:any)'] = '/business/index/$1';
$route['company-setup'] = '/landing_setup';
$route['company-setup/(:any)'] = '/landing_setup/$1';
$route['post-ad'] = '/post_ad';
$route['post-ad/add'] = '/post_ad/add_new';
$route['post-ad/edit/(:any)'] = '/post_ad/add_new/$1';
$route['sign-in/(:any)'] = '/sign_in/$1';
$route['admin'] = 'admin/auth/login';
$route['admin/login'] = 'admin/auth/login';
$route['404_override'] = 'Eerror_404';
$route['translate_uri_dashes'] = false;
$route['technician-setup'] = '/Technician_detail';
$route['category/(:any)'] = '/Front_category/index/$1';
$route['products'] = '/Front_product/index/$1';
$route['products1'] = '/Front_product/product_demo/$1';
$route['productDetails/(:any)'] = '/Front_product/product_details/$1';
$route['admin/create_admin_user'] = 'admin/auth/create_admin_user';


// contact us
$route['contact-us'] = '/contact_us/index';
$route['contact-us/(:any)'] = '/contact-us/index/$1';
