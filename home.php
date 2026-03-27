<?php
include "database.php";

$db = new database();
$result = $db->select();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background: linear-gradient(to right, #667eea, #764ba2);
            min-height: 100vh;
        }

        .main-card {
            border-radius: 20px;
            background: #ffffff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .table thead {
            border-radius: 10px;
        }

        .table th {
            background: white;
            color: black;
            font-weight: 600;
        }

        .table td {
            vertical-align: middle; 
        }

        .btn-custom {
            border-radius: 8px;
            padding: 5px 12px;
            font-size: 14px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .title {
            color: white;
            font-weight: 700;
            font-size: 28px;
        }

        .modal-content {
            border-radius: 20px;
        }
    </style>

<body>

    <div class="container mt-5">

    
        <div class="top-bar">
            <h2 class="title">User Management</h2>
            <button id="addBtn" class="btn btn-light btn-lg">
                Add User
            </button>
        </div>

       
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title text-dark">User Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body" id="modalContent"></div>

                </div>
            </div>
        </div>

   
        <div class="card main-card p-3">
            <div class="card-body">

                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="tableBody">

                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr id="row_<?php echo $row['id']; ?>">
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['name']; ?></td>
                                    <td><?= $row['age']; ?></td>
                                    <td><?= $row['city']; ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm btn-custom edit" data-id="<?= $row['id'] ?>">
                                            Edit
                                        </button>

                                        <button class="btn btn-danger btn-sm btn-custom delete" data-id="<?= $row['id'] ?>">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>

    </div>

</body>
<script>
    $(document).ready(function() {
        $("#addBtn").on("click", function() {
            $.ajax({
                url: "add.php",
                type: "GET",
                success: function(res) {
                    $("#modalContent").html(res);
                    let modal = new bootstrap.Modal(document.getElementById('myModal'));
                    modal.show();
                }
            });
        });
    });


    $(document).on("click", ".edit", function(e) {
        e.preventDefault();
        var id = $(this).data("id");

        $.ajax({
            url: "update.php",
            type: "GET",
            data: {
                id: id
            },
            success: function(response) {
                $("#modalContent").html(response);

                let modal = new bootstrap.Modal(document.getElementById('myModal'));
                modal.show();
            }
        });

    });


    $(document).on("click", ".delete", function(e) {

        e.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            url: "delete.php",
            type: "POST",
            data: {
                id: id
            },

            success: function(response) {

                $("#modalContent").html(response);

                let modal = new bootstrap.Modal(document.getElementById('myModal'));
                modal.show();
            }
        });
    });
</script>

</body>

</html>