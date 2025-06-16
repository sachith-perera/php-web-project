<?php
 //headers
 header('Access-Control-Allow-Origin:*');
 header('Content-Type:application/json');

//initializing API
 include_once('../core/initialize.php');

 $patient_address = new Patient_address($db);

 $patient_address->id = isset( $_GET['id'] ) ? $_GET['id'] :die;

 $patient_address->get_data();

 $patient_address_arr= array( 
    'id' => $patient_address->id,
    'patient_id'=> $patient_address->patient_id,
    'address1'=> $patient_address->address1,
    'address2'=> $patient_address->address2,
    'city'=>$patient_address->city,
    'state'=>$patient_address->state,
    'postal_code'=>$patient_address->postal_code,
 );

  //make json   
  print_r(json_encode($patient_address_arr));


?>