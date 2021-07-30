<?php 

class Users {

    private $table = "user";
    private $connexion;
    
    public $id;
    public $email;
    public $name;

    public function __construct($db)
    {
        $this->connexion = $db;
    }

    public function getAllUsers() 
    {
        $stmt = "SELECT * FROM " . $this->table . "";

        $query = $this->connexion->prepare($stmt);

        $query->execute();

        return $query;
    }

    public function getUserById(){
        $stmt = "SELECT * FROM " . $this->table . " WHERE id = ?";

        $query = $this->connexion->prepare($stmt);
        $query->bindParam(1, $this->id); 
        
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->email = $row['email'];
    
    }

    public function AddUser()
    {
        $stmt = "INSERT INTO " . $this->table . " (id, name, email)
        VALUES (:id, :name, :email)";

        $query = $this->connexion->prepare($stmt);

        $query->bindParam(":id", $this->id);
        $query->bindParam(":name", $this->name);
        $query->bindParam(":email", $this->email);

        if($query->execute())
        {
            return true;
        }
        return false;

    }

    public function DeleteUser(){

        $stmt = "DELETE FROM " . $this->table . " WHERE id = ?";

        $query = $this->connexion->prepare($stmt);

        $query->bindParam(1, $this->id);

        if($query->execute())
        {
            return true;
        }        
        return false;
    }

    public function updateUser()
    {
        $stmt = "UPDATE " . $this->table . " SET name =:name, email = :email ";

        $query = $this->connexion->prepare($stmt);

        $query->bindParam(":name", $this->name);
        $query->bindParam(":email", $this->email);

        if($query->execute())
        {
            return true;
        }
        return false;

    }
}