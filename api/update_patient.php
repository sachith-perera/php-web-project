<?php
    //headers
    header('Access-Control-Allow-Origin:*');
    header('Content-Type:application/json');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
    header('Access-Control-Allow-Methods: PUT');

   //initializing API
    include_once('../core/initialize.php');

    //instantiate patient
    $patient = new Patient($db);
    $patient_address = new Patient_address($db);
    $patient_record = new Patient_record($db);

    //get posted data
    $data = json_decode(file_get_contents("php://input"));

    $patient->id = $data->id;
    $patient->first_name = $data->first_name;
    $patient->last_name = $data->last_name;
    $patient->gender = $data->gender;
    $patient->dob = $data->dob;
    $patient->email = $data->email;
    $patient->phone = $data->phone;

    $patient_address->id = $data->id;
    $patient_address->address1 = $data->address1;
    $patient_address->address2 = $data->address2;
    $patient_address->city = $data->city;
    $patient_address->state = $data->state;
    $patient_address->postal_code = $data->postal_code;

    $patient_record->patient_id = $data->id;
    
    if($patient->update_data()){
        if($patient_address->update_data()){
          if($patient_record->delete_record()){
        echo json_encode(array(
            'message' => 'Patient Updated',
            'patient_id'=>@$data->id
            
        ));}else{
            echo json_encode(array(
                'message' => 'Error Updating Records'
            ));
        }
        }else{
            echo json_encode(array(
                'message' => 'Error Updating Address'
            ));
        }
    }else{
        echo json_encode(array(
            'message' => 'Patient not Updated'
        ));
    }
    
  



?>