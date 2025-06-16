<?php
    //headers
    header('Access-Control-Allow-Origin:*');
    header('Content-Type:application/json');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
    header('Access-Control-Allow-Methods: POST');

   //initializing API
    include_once('../core/initialize.php');

    //instantiate patient
    $patient_address = new Patient_address($db);

    //get posted data
    $data = json_decode(file_get_contents("php://input"));

    $patient_address->address1 = $data->address1;
    $patient_address->address1 = $data->address1;
    $patient_address->city = $data->city;
    $patient_address->state = $data->state;
    $patient_address->postal_code = $data->postal_code;
    $patient_address->patient_id = $data->patient_id;    

   
    
    if($patient_address->create_data()){
        echo json_encode(array(
            'message' => 'Patient Address Created'
        ));
    }else{
        echo json_encode(array(
            'message' => 'Patient Address not Created'
        ));
    }
    
  



?>