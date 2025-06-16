<?php
//headers
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


//initializing API
include_once('../core/initialize.php');

//instantiate patient
$patient = new Patient($db);
$patient_address = new Patient_address($db);
$patient_records = new Patient_record($db);

//get posted data
$data = json_decode(file_get_contents("php://input"));

$patient->id = $data->id;
$patient_address->id = $data->id;
$patient_records->patient_id = $data->id;

if ($patient_records->delete_record()) {
    if ($patient_address->delete_data()) {
        if ($patient->delete_data()) {
            echo json_encode(array(
                'message' => 'Patient deleted',
                'patient_id' => @$data->id
            ));
        }
    }
} else {
    echo json_encode(array(
        'message' => 'Patient not deleted'
    ));
}





?>