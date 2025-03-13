// View datatable
$(document).ready(function() {

    var table = $('#userTable').DataTable({
        processing: true,
        serverSide: true,
        "ajax": {
            "url": $('#userTable').data('route'),
            "type": "get"
        },
        columns: [
            { data: 'id', name: 'id' , orderable: false, searchable: false },
            { data: 'name', name: 'name' , orderable: false, searchable: false },
            { data: 'email', name: 'email' , orderable: false, searchable: false },
            { data: 'contact_no', name: 'contact_no' , orderable: false, searchable: false }, 
            { data: 'alt_contact_no', name: 'alt_contact_no' , orderable: false, searchable: false }, 
            { data: 'address', name: 'address' , orderable: false, searchable: false  }, 
            { data: 'designation', name: 'designation' }, // searchable by designation
            { data: 'status', name: 'status' }, // searchable by status
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // Add User
    $('#userAddForm').on('submit', function(e) {
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
                $('#userAddModal').modal('hide');
                $('#userAddForm')[0].reset();

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

    // edit User
    $(document).on('click', '#userTable .edit', function() {
        var routeUrl = $(this).data('url');
        $.ajax({
            url: routeUrl,
            type: 'get',
            success: function(response){
                $("#userEditForm input[name='id']").val(response.id);
                $("#userEditForm input[name='name']").val(response.name);
                $("#userEditForm input[name='email']").val(response.email);
                $("#userEditForm input[name='contact_no']").val(response.user_detail.contact_no);
                $("#userEditForm input[name='alt_contact_no']").val(response.user_detail.alt_contact_no);
                $("#userEditForm textarea[name='address']").val(response.user_detail.address);
                $("#userEditForm select[name='designation']").val(response.user_detail.designation_id);
                $("#userEditForm select[name='status']").val(response.user_detail.status);
            },
            error: function(xhr, status, error){
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong. Please try again."
                });
            }
        });
        $("#userEditModal").modal('toggle');
    });   

    
    // Update User
    $('#userEditForm').on('submit', function(e) {
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
                $('#userEditModal').modal('hide');
                $('#userEditForm')[0].reset();
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
