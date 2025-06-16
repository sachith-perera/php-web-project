<?php
//headers
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
header('Access-Control-Allow-Methods: POST');

//initializing API
include_once('../core/initialize.php');

//instantiate patient
$patient_record = new Patient_record($db);

//get posted data
$data = json_decode(file_get_contents("php://input"));
try {
    if (is_array($data)) {
        foreach ($data as $item) {
            // Set patient record properties for each item in the array
            $patient_record->allergies = $item->Allergy;
            $patient_record->records = $item->Record;
            $patient_record->refererrals = $item->Referral;
            $patient_record->patient_id = $item->patient_id;

            // Create record and store the ID if successful
            $patient_record->create_record();

        }
    }

    echo json_encode(array(
        'message' => 'Patient Created',
        'patient_id' => $created_id
    ));
} catch (Exception $e) {
    echo json_encode(array(
        'message' => 'Patient not Created'
    ));
}






?>