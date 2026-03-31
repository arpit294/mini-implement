<?php

class database
{
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "mini");

        if ($this->conn->connect_error) {
            die("Connection failed");
        }
    }

    public function insert($name, $age, $city)
    {
        $errors = [];


        if (empty(trim($name))) {
            $errors['name'] = "Name is required!";
        }

        if (empty(trim($age))) {
            $errors['age'] = "Age is required!";
        } elseif (!is_numeric($age)) {
            $errors['age'] = "Age must be number!";
        }

        if (empty(trim($city))) {
            $errors['city'] = "City is required!";
        }


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
    public function select()
    {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);

        return $result;
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM users WHERE id='$id'";
        return $this->conn->query($sql);
    }

    public function update($id, $name, $age, $city)
    {
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



//for action pass

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
