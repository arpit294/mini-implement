<?php
include "database.php";

$db = new database();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $db->getById($id);
    $row = $result->fetch_assoc();
}

?>
<div class="p-2">
    <h3 class="text-center mb-4 text-primary">Edit Data</h3>

    <form method="POST" id="updateForm">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">

        <div class="mb-3">
            <label class="form-label fw-semibold">Name</label>
            <input type="text" name="name" class="form-control" value="<?= $row['name'] ?>">
            <span class="text-danger" id="nameError"></span>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Age</label>
            <input type="number" name="age" class="form-control" value="<?= $row['age'] ?>">
            <span class="text-danger" id="ageError"></span>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">City</label>
            <input type="text" name="city" class="form-control" value="<?= $row['city'] ?>">
            <span class="text-danger" id="cityError"></span>
        </div>

        <button type="submit" class="btn btn-primary w-100">Update</button>
    </form>
</div>
