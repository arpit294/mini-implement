<?php
include "database.php";

$db = new database();

?>
<<<<<<< HEAD
<div class="p-2">
    <h3 class="text-center mb-4 text-primary">Insert Data</h3>

    <form method="POST" id="addForm">
        <input type="hidden" name="id">

        <div class="mb-3">
            <label class="form-label fw-semibold">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter your name">
            <span class="text-danger" id="nameError"></span>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Age</label>
            <input type="number" name="age" class="form-control" placeholder="Enter your age">
            <span class="text-danger" id="ageError"></span>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">City</label>
            <input type="text" name="city" class="form-control" placeholder="Enter your city">
            <span class="text-danger" id="cityError"></span>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Insert Data
        </button>
    </form>
</div>
=======

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Page</title>

    <!-- Bootstrap CSS -->
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

<body class="d-flex justify-content-center align-items-center">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <div class="card shadow-lg p-4">
                    <h3 class="text-center mb-4 text-primary">Insert Data</h3>

                    <form method="POST" id="myform">
                        <input type="hidden" name="id">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your name">
                            <span class="text-danger" id="nameError"></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Age</label>
                            <input type="number" name="age" class="form-control" placeholder="Enter your age">
                            <span class="text-danger" id="ageError"></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">City</label>
                            <input type="text" name="city" class="form-control" placeholder="Enter your city">
                            <span class="text-danger" id="cityError"></span>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Insert Data
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <script>
        $(document).on("submit", "#myform", function(e) {

            e.preventDefault();

            var formData = new FormData(this);
            formData.append("action", "insert");

            $.ajax({
                url: "database.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,

                success: function(responseData) {

                    console.log("RESPONSE:", responseData);
                    let data = JSON.parse(responseData);

                    let modal = bootstrap.Modal.getInstance(document.getElementById('myModal'));
                    modal.hide();

                    $("#tableBody").prepend(
                        "<tr id='row_" + data.data.id + "'>" +
                        "<td>" + data.data.id + "</td>" +
                        "<td>" + data.data.name + "</td>" +
                        "<td>" + data.data.age + "</td>" +
                        "<td>" + data.data.city + "</td>" +
                        "<td>" +
                        "<button class='btn btn-warning btn-sm edit' data-id='" + data.data.id + "'>Edit</button> " +
                        "<button class='btn btn-danger btn-sm  delete'  data-id='" + data.data.id + "'>Delete</button>" +
                        "</td>" +
                        "</tr>"
                    );
                }
            });

        });
    </script>
</body>

</html>
>>>>>>> 4ec1e31e1ae34a845e057e4538453e08fbe2743f
