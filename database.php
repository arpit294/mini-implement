<?php
//this is the main class
class database
{
    public $conn;
    //this  is function for the database connection 
    public function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "mini");

        if ($this->conn->connect_error) {
            die("Connection failed");
        }
    }
    //this is the function for validation   
    private function validateUserFields($name, $age, $city)
    {
        $errors = [];

        if (empty(($name))) {
            $errors['name'] = "Name is required!";
        }

        if (((string) $age) === '') {
            $errors['age'] = "Age is required!";
        } elseif (!is_numeric($age)) {
            $errors['age'] = "Age must be number!";
        }

        if (empty(($city))) {
            $errors['city'] = "City is required!";
        }

        return $errors;
    }

    //this is the insert function for inserting entry to the database
    public function insert($name, $age, $city)
    {
        $errors = $this->validateUserFields($name, $age, $city);

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
    //this is select function return data from database
    public function select()
    {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);

        return $result;
    }

    //get id from database for update and delete
    public function getById($id)
    {
        $sql = "SELECT * FROM users WHERE id='$id'";
        return $this->conn->query($sql);
    }
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

    //this is delete function for remove the data from database.
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



// this is the action for the perticular operation.
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
    