<?php

class Patient_address{
    private $conn;

    public $id;
    public $patient_id;
    public $address1;
    public $address2;
    public $city;
    public $state;
    public $postal_code;

    public function __construct($db) {
        $this->conn = $db;

    }

    public function get_data(){
        $sql = 'SELECT patient_id,
                address1,
                address2,
                city,
                state,
                postal_code
                FROM patient_address
                where patient_id =?'; 
                
        //prepare statement
        $stmt = $this->conn->prepare($sql);
        //bind parameters
        $stmt->bindParam(1,$this->id);
        //execute statment
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // $this ->id = $row['patient_add_id'];
        $this ->patient_id = $row['patient_id'];
        $this -> address1 = $row['address1'];
        $this -> address2 = $row['address2'];
        $this ->city = $row['city'];
        $this ->state = $row['state'];
        $this ->postal_code = $row['postal_code'];
    }

    public function create_data(){
        $sql = 'INSERT INTO patient_address SET patient_id =:patient_id,address1=:address1,address2=:address2,city=:city,state=:state,postal_code=:postal_code';
        //prepare statement
        $stmt = $this->conn->prepare($sql);
        //clean data
        $this->patient_id = htmlspecialchars( $this->patient_id );
        $this->address1 = htmlspecialchars( $this->address1 );
        $this->address2 = htmlspecialchars( $this->address2 );
        $this ->city = htmlspecialchars( $this->city );
        $this ->state = htmlspecialchars( $this->state );
        $this ->postal_code = htmlspecialchars( $this->postal_code );

        //bind parameters
        $stmt-> bindParam(':patient_id', $this->patient_id);
        $stmt->bindParam(':address1',$this->address1);
        $stmt->bindParam(':address2',$this->address2);
        $stmt->bindParam(':city',$this->city);
        $stmt->bindParam(':state',$this->state);
        $stmt->bindParam(':postal_code',$this->postal_code);

        if($stmt->execute()) {
            return true;
        }

        printf("Error %s. \n",$stmt->error);
        return false;
    }

    public function update_data(){
        $sql = 'UPDATE patient_address SET address1=:address1,address2=:address2,city=:city,state=:state,postal_code=:postal_code
                WHERE  patient_id =:patient_id';
        //prepare statement
        $stmt = $this->conn->prepare($sql);
        //clean data
        $this->id = htmlspecialchars( $this->id );
        $this->address1 = htmlspecialchars( $this->address1 );
        $this->address2 = htmlspecialchars( $this->address2 );
        $this ->city = htmlspecialchars( $this->city );
        $this ->state = htmlspecialchars( $this->state );
        $this ->postal_code = htmlspecialchars( $this->postal_code );

        //bind parameters
        $stmt-> bindParam(':patient_id', $this->id);
        $stmt->bindParam(':address1',$this->address1);
        $stmt->bindParam(':address2',$this->address2);
        $stmt->bindParam(':city',$this->city);
        $stmt->bindParam(':state',$this->state);
        $stmt->bindParam(':postal_code',$this->postal_code);

        if($stmt->execute()) {
            return true;
        }

        printf("Error %s. \n",$stmt->error);
        return false;
    }

    public function delete_data(){
        $sql = "DELETE FROM patient_address WHERE patient_id = :patient_id";

        $stmt = $this->conn->prepare($sql);

        $this->patient_id = htmlspecialchars( $this->id );

        //bind parameters
        $stmt-> bindParam(':patient_id', $this->id);

        if($stmt->execute()) {
            return true;
        }

        printf("Error %s. \n",$stmt->error);
        return false;
    }

}


?>