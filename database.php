<?php
<<<<<<< HEAD
//this is the main class
class database
{
    public $conn;
    //this  is function for the database connection 
=======

class database
{
    public $conn;

>>>>>>> 4ec1e31e1ae34a845e057e4538453e08fbe2743f
    public function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "mini");

        if ($this->conn->connect_error) {
            die("Connection failed");
        }
    }
<<<<<<< HEAD
    //this is the function for validation   
    private function validateUserFields($name, $age, $city)
    {
        $errors = [];

        if (empty(($name))) {
            $errors['name'] = "Name is required!";
        }

        if (((string) $age) === '') {
=======

    public function insert($name, $age, $city)
    {
        $errors = [];


        if (empty(trim($name))) {
            $errors['name'] = "Name is required!";
        }

        if (empty(trim($age))) {
>>>>>>> 4ec1e31e1ae34a845e057e4538453e08fbe2743f
            $errors['age'] = "Age is required!";
        } elseif (!is_numeric($age)) {
            $errors['age'] = "Age must be number!";
        }

<<<<<<< HEAD
        if (empty(($city))) {
            $errors['city'] = "City is required!";
        }

        return $errors;
    }

    //this is the insert function for inserting entry to the database
    public function insert($name, $age, $city)
    {
        $errors = $this->validateUserFields($name, $age, $city);
=======
        if (empty(trim($city))) {
            $errors['city'] = "City is required!";
        }

>>>>>>> 4ec1e31e1ae34a845e057e4538453e08fbe2743f

        if (!empty($errors)) {
            echo json_encode([
                "status" => "error",
                "errors" => $errors
            ]);
            exit();
        }

        $sql = "INSERT INTO users (name, age, city) 
            VALUES ('$name', '$age', '$city')";

        if ($this->conn->query($sql)) {

            $id = $this->conn->insert_id;

            echo json_encode([
                "status" => "success",
                "data" => [
                    "id" => $id,
                    "name" => $name,
                    "age" => $age,
                    "city" => $city
                ]
            ]);
            exit();
        }
    }
<<<<<<< HEAD
    //this is select function return data from database
=======
>>>>>>> 4ec1e31e1ae34a845e057e4538453e08fbe2743f
    public function select()
    {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);

        return $result;
    }

<<<<<<< HEAD
    //get id from database for update and delete
=======
>>>>>>> 4ec1e31e1ae34a845e057e4538453e08fbe2743f
    public function getById($id)
    {
        $sql = "SELECT * FROM users WHERE id='$id'";
        return $this->conn->query($sql);
    }
<<<<<<< HEAD
    //this is the update function for update the values in database
    public function update($id, $name, $age, $city)
    {
        $errors = $this->validateUserFields($name, $age, $city);

        if (!empty($errors)) {
            echo json_encode([
                "status" => "error",
                "errors" => $errors
            ]);
            exit();
        }

=======

    public function update($id, $name, $age, $city)
    {
>>>>>>> 4ec1e31e1ae34a845e057e4538453e08fbe2743f
        $sql = "UPDATE users 
            SET name='$name', age='$age', city='$city' 
            WHERE id='$id'";

        if ($this->conn->query($sql)) {

            $responseData = [
                'status' => 'success',
                'message' => 'Data updated!',
                "data" => [
                    "id" => $id,
                    "name" => $name,
                    "age" => $age,
                    "city" => $city
                ]
            ];

            echo json_encode($responseData);
            exit();
        } else {

            echo json_encode([
                "status" => "error",
                "message" => "Update failed"
            ]);
            exit();
        }
    }

<<<<<<< HEAD
    //this is delete function for remove the data from database.
=======


>>>>>>> 4ec1e31e1ae34a845e057e4538453e08fbe2743f
    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id='$id'";

        if ($this->conn->query($sql)) {

            echo json_encode([
                "status" => "success",
                "id" => $id
            ]);
            exit();
        } else {

            echo json_encode([
                "status" => "error"
            ]);
            exit();
        }
    }
}



<<<<<<< HEAD
// this is the action for the perticular operation.
=======
//for action pass

>>>>>>> 4ec1e31e1ae34a845e057e4538453e08fbe2743f
if (isset($_POST['action'])) {

    $db = new database();


    if ($_POST['action'] == "insert") {
        $db->insert($_POST['name'], $_POST['age'], $_POST['city']);
    }


    if ($_POST['action'] == "update") {
        $db->update($_POST['id'], $_POST['name'], $_POST['age'], $_POST['city']);
    }

    if ($_POST['action'] == "delete") {
        $db->delete($_POST['id']);
    }

    exit();
}
<<<<<<< HEAD
    
=======
>>>>>>> 4ec1e31e1ae34a845e057e4538453e08fbe2743f
