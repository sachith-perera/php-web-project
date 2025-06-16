<?php

class Patient
{
    private $conn;

    public $id;
    public $first_name;
    public $last_name;
    public $gender;
    public $dob;
    public $email;
    public $phone;

    public function __construct($db)
    {
        $this->conn = $db;

    }

    //get all patients from DB
    public function get_data()
    {
        $sql = 'SELECT patient_id as id,
                first_name,
                last_name,
                gender,
                dob,
                email,
                phone
                FROM patients;';

        //prepare statement
        $stmt = $this->conn->prepare($sql);

        //execute statment
        $stmt->execute();

        return $stmt;

    }
    public function get_data_by_id()
    {
        $sql = 'SELECT patient_id as id,
        first_name,
        last_name,
        gender,
        dob,
        email,
        phone
        FROM patients
        WHERE patient_id = ?;';

        //prepare statement
        $stmt = $this->conn->prepare($sql);
        //bind Parameters
        $stmt->bindParam(1, $this->id);
        //execute statment
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->first_name = $row['first_name'];
        $this->last_name = $row['last_name'];
        $this->gender = $row['gender'];
        $this->dob = $row['dob'];
        $this->email = $row['email'];
        $this->phone = $row['phone'];


    }

    public function create_data()
    {
        $sql = 'INSERT INTO patients SET first_name =:first_name, last_name = :last_name, gender=:gender,dob =:dob, email =:email, phone=:phone';
        //prepare statement
        $stmt = $this->conn->prepare($sql);
        //claen data
        $this->first_name = htmlspecialchars($this->first_name);
        $this->last_name = htmlspecialchars($this->last_name);
        $this->gender = htmlspecialchars($this->gender);
        $this->dob = htmlspecialchars($this->dob);
        $this->email = htmlspecialchars($this->email);
        $this->phone = htmlspecialchars($this->phone);

        //binding parameters

        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':dob', $this->dob);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }

        printf("Error %s. \n", $stmt->error);
        return false;

    }

    public function update_data()
    {
        $sql = 'UPDATE patients SET first_name =:first_name, last_name = :last_name, gender=:gender,dob =:dob, email =:email, phone=:phone
                WHERE patient_id =:id';
        //prepare statement
        $stmt = $this->conn->prepare($sql);
        //claen data
        $this->first_name = htmlspecialchars($this->first_name);
        $this->last_name = htmlspecialchars($this->last_name);
        $this->gender = htmlspecialchars($this->gender);
        $this->dob = htmlspecialchars($this->dob);
        $this->email = htmlspecialchars($this->email);
        $this->phone = htmlspecialchars($this->phone);
        $this->id = htmlspecialchars($this->id);

        //binding parameters

        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':dob', $this->dob);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error %s. \n", $stmt->error);
        return false;

    }

    public function delete_data()
    {
        $sql1 = "DELETE 
                FROM patients
                WHERE patient_id =:id";

        $stmt1 = $this->conn->prepare($sql1);


        $this->id = htmlspecialchars($this->id);


        $stmt1->bindParam(':id', $this->id);

        if ($stmt1->execute()) {
            return true;
        }

        printf("Error %s. \n", $stmt1->error);
        return false;



    }

}
?>