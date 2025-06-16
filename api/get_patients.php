<?php
    //headers
    header('Access-Control-Allow-Origin:*');
    header('Content-Type:application/json');

   //initializing API
    include_once('../core/initialize.php');

    //instantiate patient
    $patient = new Patient($db);
    
    //patient query
    $result = $patient->get_data();

    //get the row count
    $num = $result->rowCount();

    if($num > 0) {
        $patient_arr = array();
        $patient_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $patient_item = array(
                'id' => $id,
                'first_name' => $first_name,
                'last_name'=> $last_name,
                'gender' => $gender,
                'dob' => $dob,
                'email' => $email,
                'phone' => $phone
            );
            array_push($patient_arr['data'], $patient_item);
        }
        //convert to JSON
        echo json_encode($patient_arr);
    }else{

        echo json_encode(array('error'=> 'No Data Found'));

    }

   



?>