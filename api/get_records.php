<?php

//headers
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

//initializing API
include_once('../core/initialize.php');

//instantiate records
$record = new Patient_record($db);

//patient query
$record->id = isset($_GET['id']) ? intval($_GET['id']) :die();
$results = $record->get_data();

//get the row count
$num = $results->rowCount();

if($num>0){
    $records_arr = array();
    $records_arr['data'] = array();

    while($row = $results->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $record_item = array(
            'id' => $row['patient_rec_id'],
            'patient_id'=> $row['patient_id'],
            'allergies'=> $row['allergies'],
            'records'=> $row['records'],
            'refererrals'=> $row['refererrals']
            

        );
        array_push($records_arr['data'], $record_item);
    }
    echo json_encode($records_arr);
}else{
    echo json_encode(array('error'=> 'No records found'));
}

?>