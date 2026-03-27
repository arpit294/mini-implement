<form id="deleteform">
    <input type="hidden" name="id" value="<?= $_POST['id']; ?>">

    <div class="text-center">
        <h5>Are you sure you want to delete?</h5>

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

        <button type="submit" class="btn btn-danger">Delete</button>
    </div>
</form>

<script>
$(document).on("submit", "#deleteform", function(e){

    e.preventDefault();

    var formData = new FormData(this);
    formData.append("action", "delete");

    $.ajax({
        url: "database.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(responseData){

            let data = JSON.parse(responseData);

            let modal = bootstrap.Modal.getInstance(document.getElementById('myModal'));
            modal.hide();

            $("#row_" + data.id).remove();
        }
    });
});
</script>