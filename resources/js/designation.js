// View datatable
$(document).ready(function() {

    var table = $('#designationTable').DataTable({
        processing: true,
        serverSide: true,
        "ajax": {
            "url": $('#designationTable').data('route'),
            "type": "get"
        },
        columns: [
            { data: 'id', name: 'id' , orderable: false, searchable: false },
            { data: 'name', name: 'name' }, // searchable by name
            { data: 'status', name: 'status' }, // searchable by status
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // Add Designation
    $('#designationAddForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data:  new FormData(this),
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: response.message
                });

                table.ajax.reload();
                $('#designationAddModal').modal('hide');
                $('#designationAddForm')[0].reset();

            },
            error: function(xhr) {
                if (xhr.status === 422) { // Validation error
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = "";
        
                    $.each(errors, function(field, messages) {
                        errorMessage = messages;
                    });
                    Swal.fire({
                        icon: "error",
                        title: "Validation Error",
                        html: errorMessage 
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong. Please try again."
                    });
                }
            }
        });
    });

    // edit Designation
    $(document).on('click', '#designationTable .edit', function() {
        var routeUrl = $(this).data('url');
        $.ajax({
            url: routeUrl,
            type: 'get',
            success: function(response){
                console.log(response)
                $("#designationEditForm input[name='designation_name']").val(response.name);
                $("#designationEditForm input[name='status']").val(response.status);
                $("#designationEditForm input[name='id']").val(response.id);
            },
            error: function(xhr, status, error){
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong. Please try again."
                });
            }
        });
        $("#designationEditModal").modal('toggle');
    });   

    
    // Update Designation
    $('#designationEditForm').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: $(this).attr("action"),
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:  formData,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: response.message
                });
        
                table.ajax.reload();
                $('#designationEditModal').modal('hide');
                $('#designationEditForm')[0].reset();
            },
            error: function(xhr) {
                if (xhr.status === 422) { // Validation error
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = "";
        
                    $.each(errors, function(field, messages) {
                        console.log(messages)
                        errorMessage += messages;
                    });
                    console.log(errorMessage)
                    Swal.fire({
                        icon: "error",
                        title: "Validation Error",
                        html: errorMessage 
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong. Please try again."
                    });
                }
            }
        });
    });
});
