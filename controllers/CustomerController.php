<?php

session_start();
require_once ROOT  . '/View.php';
require_once ROOT . '/models/HelpRequestModel.php';
require_once ROOT . '/models/ComplaintModel.php';
require_once ROOT . '/models/CustomerModel.php';
require_once ROOT . '/models/BookingModel.php';
require_once ROOT . '/models/CustomerProfileModel.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class CustomerController {

  //customer functions
  public function customerBooking() {
    $view = new View("Customer/customer_booking");
  }

  public function customerComplaint() {
    $complaintModel = new ComplaintModel();
    $customerModel = new CustomerModel();

    if(!empty($_POST['customer_complaint'] && $_POST['customer_complaint'] == 'submitted')){
      $data['inputted_data'] = $_POST;
		  $subject = $_POST['subject'];
		  $complaintmessage = $_POST['complaintmessage'];
      $rating = $_POST['rating'];
      $ComplaintError = "";

      if(empty($subject) && empty($complaintmessage) && empty($rating))
      {
          $ComplaintError = "Please fill all the empty fields";
      }

      if($ComplaintError == ""){
        $complaintID = $complaintModel->generateCustomerComplaintID();
        $currentDateTime = date('Y-m-d H:i:s');
        $userID = $_SESSION['loggedin']['user_id'];
        $customerDetails = $customerModel->getCustomerByUserID($userID);


        $customerComplaint = [
          'ComplaintID' => $complaintID,
          'Date' => $currentDateTime,
          'Subject' => $subject,
          'Content' => $complaintmessage,
          'Rates' => $rating,
          'CustomerID' => $customerDetails->CustomerID
        ];

        $complaintModel-> addNewCustomerComplaint($customerComplaint);
        $ComplaintError = "none";

      }

      $data['ComplaintError'] = $ComplaintError;
    }
    $view = new View("Customer/customer_complaint", $data);
  }

  public function customerDashboard() {
    $view = new View("Customer/customer_dashboard");
  }

  public function customerHelp() {
    $view = new View("Customer/customer_help");
  }

  public function customerCalender() {
    $view = new View("Customer/customer_calender");
  }

  public function customerHistory() {
    $view = new View("Customer/customer_history");
  }

  public function customerViewad(){
    $view = new View("Customer/customer_viewad");
  }

  public function customerViewmyad(){
    $view = new View("Customer/customer_viewmyad");
  }

  public function customerPostad(){
    $view = new View("Customer/customer_postad");
  }

  public function customerPayment(){
    $view = new View("Customer/customer_payment");
  }

  public function customerProfile(){
    $customerModel = new CustomerModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $data['customer_details'] = $customerModel->getCustomerByUserID($userID);
    $view = new View("Customer/customer_profile",$data);
  }



  public function customerProfileEd(){
    $customerModel = new CustomerModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $data['customer_details'] = $customerModel->getCustomerByUserID($userID);

    $view = new View("Customer/customer_profileEd",$data);

    
    
  } 
  
  public function customerProfileEdUp(){
    $dataEdit = $_POST['customer_edit'];
    $fn = $_POST['f_name'];
    $ln = $_POST['l_name'];
    $nic = $_POST['nic'];
    $addr = $_POST['address'];
    $cont = $_POST['phone_num'];
    $bio = $_POST['bio'];
    $dob = $_POST['dob'];
    $cardno = $_POST['card_num'];
    $cvv = $_POST['cvv'];
    $exp = $_POST['expiry'];
    
    $edit = new CustomerProfileModel();

    if ($edit->customerProfileEdUp($fn,$ln,$nic,$addr,$cont,$bio,$dob,$cardno,$cvv,$exp,$dataEdit)) {
      $edit->customerProfileEdUp($fn,$ln,$nic,$addr,$cont,$bio,$dob,$cardno,$cvv,$exp,$dataEdit);
      header('location: ' . fullURLfront . '/Customer/customer_profile');
    } 
    else {
      die('Something went wrong dsghjgdsahjdga.');
    }


    $view = new View("Customer/customer_profile");
  }


  public function customerSearch(){
    $dataEdit = $_POST['search'];
    $search = new CustomerModel();

    if (true) {
      $data = $search->search($dataEdit);
      $view = new View("Customer/customer_search");
      // header('location: ' . fullURLfront . '/Customer/customer_search' . $search);
    } 
    else {
      die('Something went wrong dsghjgdsahjdga.');
    }
  }





  public function customerService(){
    $view = new View("Customer/customer_service");
  }

  public function customerServiceLocation(){
    $view = new View("Customer/customer_serviceLocation");
  }

  public function customerServiceList(){
    $view = new View("Customer/customer_serviceList");
  }
 
}