<?php
include "database.php";

$db = new database();

?>
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
