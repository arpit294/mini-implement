<?php
include "database.php";

$db = new database();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $db->getById($id);
    $row = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background: linear-gradient(to right, #667eea, #764ba2);
            height: 100vh;
        }

        .card {
            border-radius: 15px;
        }
    </style>
</head>

<body class="bg-light d-flex justify-content-center align-items-center">

    <div class="card p-4 shadow" style="width:400px;">
        <h3 class="text-center mb-3">Edit Data</h3>

        <form method="POST" id="myform">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <label>Name:</label>
            <input type="text" name="name" class="form-control mb-2" value="<?= $row['name'] ?>">
            <label>Age:</label>
            <input type="number" name="age" class="form-control mb-2" value="<?= $row['age'] ?>">
            <label>City:</label>
            <input type="text" name="city" class="form-control mb-3" value="<?= $row['city'] ?>">

            <button type="submit"  class="btn btn-primary w-100">Update</button>
        </form>
    </div>
<script>
$(document).on("submit", "#myform", function(e){

    e.preventDefault();

    var formData = new FormData(this);
    formData.append("action", "update");

    $.ajax({
        url: "database.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(responseData){

            let data = JSON.parse(responseData);

            if(data.status === "success"){
                let modal = bootstrap.Modal.getInstance(document.getElementById('myModal'));
                modal.hide();

                $("#row_" + data.data.id).html(
                    "<td>" + data.data.id + "</td>" +
                    "<td>" + data.data.name + "</td>" +
                    "<td>" + data.data.age + "</td>" +
                    "<td>" + data.data.city + "</td>" +
                    "<td>" +
                    "<button class='btn btn-warning btn-sm edit' data-id='"+data.data.id+"'>Edit</button> " +
                    "<button class='btn btn-danger btn-sm delete data-id='"+data.data.id+"'>Delete</button>" +
                    "</td>"
                );
            }
        }
    });

});
</script>
</body>

</html>