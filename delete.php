<form id="deleteform">
    <input type="hidden" name="id" value="<?= $_POST['id']; ?>">

    <div class="text-center">
        <h5>Are you sure you want to delete?</h5>

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

        <button type="submit" class="btn btn-danger">Delete</button>
    </div>
</form>
