<?php
ini_set('session.gc_maxlifetime', 60 * 2);
date_default_timezone_set('Asia/Colombo'); //Asia/Colombo
session_start();
$dir_name = dirname($_SERVER['SCRIPT_NAME']);

define('ROOT', __DIR__);

// url => http://localhost:81/mvcp/user/add-post
// url => user/add-post
$url = trim(substr_replace(trim($_SERVER['REQUEST_URI'], '/'), '', 0, strlen($dir_name)), "?");
define("fullURLfront", "/taskhub");

// associative arrays
$routes = [

  //main controllers
    'main/index' => 'MainController@index',

  //authentication controller
    'auth/login' => 'AuthController@login',
    'auth/employee_register' => 'AuthController@employeeRegister',
    'auth/contractor_register' => 'AuthController@contractorRegister',
    'auth/customer_register' => 'AuthController@customerRegister',
    'auth/manpower_register' => 'AuthController@manpowerRegister',
    'auth/forgot_password' => 'AuthController@forgotPassword',

  //employee section
    'Employee/employee_dashboard' => 'EmployeeController@employeeDashboard',
    'Employee/employee_help' => 'EmployeeController@employeeHelp',
    'Employee/employee_history' => 'EmployeeController@employeeHistory',
    'Employee/employee_complaint' => 'EmployeeController@employeeComplaint',
    'Employee/employee_booking' => 'EmployeeController@employeeBooking',
    'Employee/employee_profile' => 'EmployeeController@employeeProfile',
    'Employee/employee_search' => 'EmployeeController@employeeSearch',
    'Employee/employee_viewad' => 'EmployeeController@employeeViewad',

  //manpower section
    'Manpower/manpower_dashboard' => 'ManpowerController@manpowerDashboard',
    'Manpower/manpower_profile' => 'ManpowerController@manpowerProfile',
    'Manpower/manpower_viewad' => 'ManpowerController@manpowerViewad',
    'Manpower/manpower_search' => 'ManpowerController@manpowerSearch',

  //contractor section
    'Contractor/contractor_profile' => 'ContractorController@contractorProfile',
    'Contractor/contractor_complaint' =>'ContractorController@contractorComplaint',
    'Contractor/contractor_postad' =>'ContractorController@contractorPostad',
    'Contractor/contractor_help' =>'ContractorController@contractorHelp',
    'Contractor/contractor_paymentform' =>'ContractorController@contractorPaymentform',
    'Contractor/contractor_payment' =>'ContractorController@contractorPayment',
    'Contractor/contractor_confirmpayment' =>'ContractorController@contractorConfirmpayment',
    'Contractor/contractor_paymentdone' =>'ContractorController@contractorPaymentdone',

  //customer section

    'Customer/customer_profile' => 'CustomerController@customerProfile',
    'Customer/customer_viewad' => 'CustomerController@customerViewad',
    'Customer/customer_complaint' => 'CustomerController@customerComplaint',
    'Customer/customer_services' => 'CustomerController@customerService',
    'Customer/customer_servicelist' => 'CustomerController@customerServicelist',
    'Customer/customer_bookingform' => 'CustomerController@customerBookingform',
    'Customer/customer_help' => 'CustomerController@customerHelp',

];

$found = false;
$request_path_only = explode("?", $url)[0];

foreach($routes as $route => $name) {
  if ($route === $request_path_only) {
    $found = true;
    // UserController@addPost
    $split = explode("@", $name);
    // [UserController, addPost]
    $controller_file = $split[0];
    $method = $split[1];

    require_once __DIR__ . "/controllers/" . $controller_file . ".php";
    $controller = new $controller_file();
    call_user_func([$controller, $method]);
  }
}



if ($found == false) {
  echo "404 Page Not Found";
}