<?php

class Patient_record
{
    private $conn;
    public $id;
    public $patient_id;
    public $allergies;
    public $records;
    public $refererrals;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function get_data()
    {
        $query = 'SELECT patient_rec_id,
                    patient_id,
                    allergies,
                    records,
                    refererrals
                    FROM patient_records
                    where patient_id =?';

        //prepare statement
        $stmt = $this->conn->prepare($query);
        //bind parameters
        $stmt->bindParam(1, $this->id);
        //execute statment
        $stmt->execute();
        return $stmt;

    }

    public function create_record()
    {

        $query = 'INSERT INTO PATIENT_RECORDS SET patient_id=:patient_id,allergies=:allergies,records=:records,refererrals=:refererrals';

        $stmt = $this->conn->prepare($query);

        //claen data
        $this->patient_id = htmlspecialchars($this->patient_id);
        $this->allergies = htmlspecialchars($this->allergies);
        $this->records = htmlspecialchars($this->records);
        $this->refererrals = htmlspecialchars($this->refererrals);

        //binding parameters

        $stmt->bindParam(':patient_id', $this->patient_id);
        $stmt->bindParam(':allergies', $this->allergies);
        $stmt->bindParam('records', $this->records);
        $stmt->bindParam('refererrals', $this->refererrals);


        if ($stmt->execute()) {
            return true;
        }

        printf("Error %s. \n", $stmt->error);
        return false;
    }

    

    public function delete_record(){
        $query = "DELETE FROM patient_records WHERE patient_id = :patient_id";

        $stmt = $this->conn->prepare($query);

        $this->patient_id = htmlspecialchars($this->patient_id);

        
        $stmt->bindParam(':patient_id', $this->patient_id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error %s. \n", $stmt->error);
        return false;

        
    }
}


?>