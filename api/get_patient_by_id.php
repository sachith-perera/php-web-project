<?php
    //headers
    header('Access-Control-Allow-Origin:*');
    header('Content-Type:application/json');

   //initializing API
    include_once('../core/initialize.php');

    //instantiate patient
    $patient = new Patient($db);

    $patient->id = isset($_GET['id']) ? $_GET['id'] :die();
    $patient->get_data_by_id();

    $patient_arr = array(
        'id' => $patient->id,
        'first_name' => $patient->first_name,
        'last_name'=> $patient->last_name,
        'gender' => $patient->gender,
        'dob' => $patient->dob,
        'email' => $patient->email,
        'phone'=> $patient->phone

    );

    //make json
    print_r(json_encode($patient_arr));

   

   



?>