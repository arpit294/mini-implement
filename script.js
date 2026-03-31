//this is for opening add.php modal
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
// this is for validation error clear 
function clearValidationErrors() {
    $("#nameError").text("");
    $("#ageError").text("");
    $("#cityError").text("");
}
//this is for validation in add and update
function validateRequiredFields(form) {
    var name = $(form).find("[name='name']").val().trim();
    var age = $(form).find("[name='age']").val().trim();
    var city = $(form).find("[name='city']").val().trim();
    var isValid = true;

    clearValidationErrors();

    if (name === "") {
        $("#nameError").text("Name is required!");
        isValid = false;
    }

    if (age === "") {
        $("#ageError").text("Age is required!");
        isValid = false;
    }

    if (city === "") {
        $("#cityError").text("City is required!");
        isValid = false;
    }

    return isValid;
}
// this is the add form connect with backend and return the value on home page
$(document).on("submit", "#addForm", function(e) {
    e.preventDefault();

    var form = this;
    var submitButton = $(form).find("button[type='submit']");

    if (!validateRequiredFields(form)) {
        return;
    }

    var formData = new FormData(form);

    formData.append("action", "insert");

    submitButton.prop("disabled", true);

    $.ajax({
        url: "database.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(responseData) {
            let data = JSON.parse(responseData);

            if (data.status === "error") {
                $("#nameError").text(data.errors.name || "");
                $("#ageError").text(data.errors.age || "");
                $("#cityError").text(data.errors.city || "");
                return;
            }

            clearValidationErrors();

            let modal = bootstrap.Modal.getInstance(document.getElementById("myModal"));
            if (modal) {
                modal.hide();
            }

            form.reset();
            $("#noDataRow").remove();

            $("#tableBody").prepend(
                "<tr id='row_" + data.data.id + "'>" +
                "<td>" + data.data.id + "</td>" +
                "<td>" + data.data.name + "</td>" +
                "<td>" + data.data.age + "</td>" +
                "<td>" + data.data.city + "</td>" +
                "<td>" +
                "<button class='btn btn-warning btn-sm btn-custom edit' data-id='" + data.data.id + "'>Edit</button> " +
                "<button class='btn btn-danger btn-sm btn-custom delete' data-id='" + data.data.id + "'>Delete</button>" +
                "</td>" +
                "</tr>"
            );
        },
        complete: function() {
            submitButton.prop("disabled", false);
        }
    });
});


// this is the update form connect with backend and return the value on home page
$(document).on("submit", "#updateForm", function(e) {
    e.preventDefault();

    var form = this;
    var submitButton = $(form).find("button[type='submit']");

    if (!validateRequiredFields(form)) {
        return;
    }

    var formData = new FormData(form);

    formData.append("action", "update");

    submitButton.prop("disabled", true);

    $.ajax({
        url: "database.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(responseData) {
            let data = JSON.parse(responseData);

            if (data.status === "error") {
                $("#nameError").text(data.errors.name || "");
                $("#ageError").text(data.errors.age || "");
                $("#cityError").text(data.errors.city || "");
                return;
            }

            if (data.status === "success") {
                clearValidationErrors();

                let modal = bootstrap.Modal.getInstance(document.getElementById("myModal"));
                if (modal) {
                    modal.hide();
                }

                $("#row_" + data.data.id).html(
                    "<td>" + data.data.id + "</td>" +
                    "<td>" + data.data.name + "</td>" +
                    "<td>" + data.data.age + "</td>" +
                    "<td>" + data.data.city + "</td>" +
                    "<td>" +
                    "<button class='btn btn-warning btn-sm btn-custom edit' data-id='" + data.data.id + "'>Edit</button> " +
                    "<button class='btn btn-danger btn-sm btn-custom delete' data-id='" + data.data.id + "'>Delete</button>" +
                    "</td>"
                );
            }
        },
        complete: function() {
            submitButton.prop("disabled", false);
        }
    });
});
// this is the delete from connect with backend and return the value on home page
$(document).on("submit", "#deleteform", function(e) {
    e.preventDefault();

    var form = this;
    var submitButton = $(form).find("button[type='submit']");
    var formData = new FormData(form);

    formData.append("action", "delete");

    submitButton.prop("disabled", true);

    $.ajax({
        url: "database.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(responseData) {
            let data = JSON.parse(responseData);

            let modal = bootstrap.Modal.getInstance(document.getElementById("myModal"));
            if (modal) {
                modal.hide();
            }

            $("#row_" + data.id).remove();

            if ($("#tableBody tr").length === 0) {
                $("#tableBody").html("<tr id='noDataRow'><td colspan='5' class='text-center text-muted'>No data found</td></tr>");
            }
        },
        complete: function() {
            submitButton.prop("disabled", false);
        }
    });
});
//this is for opening update modal 
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
//this is for delete modal opening  
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
