<?php
    //headers
    header('Access-Control-Allow-Origin:*');
    header('Content-Type:application/json');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
    header('Access-Control-Allow-Methods: POST');

   //initializing API
    include_once('../core/initialize.php');

    //instantiate patient
    $patient = new Patient($db);

    //get posted data
    $data = json_decode(file_get_contents("php://input"));

    $patient->first_name = $data->first_name;
    $patient->last_name = $data->last_name;
    $patient->gender = $data->gender;
    $patient->dob = $data->dob;
    $patient->email = $data->email;
    $patient->phone = $data->phone;

    $created_id = $patient->create_data();
    
    if($created_id){
        echo json_encode(array(
            'message' => 'Patient Created',
            'patient_id' => $created_id
        ));
    }else{
        echo json_encode(array(
            'message' => 'Patient not Created'
        ));
    }
    
  



?>