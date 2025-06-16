<?php
class User{
    private $conn;
    public $username;
    public $password;
    public $name;

    public function __construct($db){
        $this->conn = $db;
        
    }

    public function get_data(){
        $querry = 'SELECT username, 
                    password,
                    name
                    FROM login_details
                    WHERE username=?';

        $stmt = $this->conn->prepare($querry);

        $this->username   = htmlspecialchars($this->username);
        // $this->password    = htmlspecialchars($this->password);
        

        $stmt->bindParam(1,$this->username);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        $this->username = $row['username'];
        $this->password = $row['password'];
        $this->name = $row['name'];
    }
}

?>