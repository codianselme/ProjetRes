$(document).ready(function(){

    var origin = window.location.origin;
    //alert(origin);
    var path = window.location.pathname.split( '/' );
    //alert(path);
    // var uRL = origin;
    // alert(uRL); 
    var uRL = $('#url').val();

    var loader = '<div class="loader"></div>';

    

    function show_formAjax_error(data){
        if (data.status == 422) {
            $('.error').remove();
            $.each(data.responseJSON.errors, function (i, error) {
                var el = $(document).find('[name="' + i + '"]');
                el.after($('<span class="error">' + error[0] + '</span>'));
            });
        }
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    
    // ========================================
    // script for User Login module
    // ========================================

    $('#user-login').validate({
        rules: {
            user_name: { required: true },
            user_password: { required: true }
        },
        messages: {
            user_name: { required: "Email Address is required" },
            user_password: { required: "Password is required" }
        },
        submitHandler: function (form) {
            $('#user-login').append(loader);
            var formdata = new FormData(form);
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'This Operation is not Performed due to demo mode',
                showConfirmButton: false,
                timer: 1500
            })
            setTimeout(function () { window.location.reload(); }, 1500);
        }
    });

    $('.logout').click(function(){
        $.ajax({
            url: uRL + '/logout',
            type: 'GET',
            success: function (dataResult) {
                if (dataResult == '1') {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Logged Out Successfully.',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(function () { window.location.href = uRL + '/'; }, 1500);
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: dataResult,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            error: function (data) {
                show_formAjax_error(data)
            }
        });
    });

    $('#change-password').validate({
        rules: {
            old: { required: true },
            new: { required: true },
            confirm: { required: true,equalTo:"#password" }
        },
        submitHandler: function (form) {
            $('#change-password').append(loader);
            var formdata = new FormData(form);
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'This Operation is not Performed due to demo mode',
                showConfirmButton: false,
                timer: 1500
            })
            setTimeout(function () { window.location.reload(); }, 1500);
        }
    });


    $('.show-edit-profile').click(function(){
        $('#profileModal').modal('show');
    });

    // ========================================
    // script for User SignUp module
    // ========================================

    $('#user-signup').validate({
        rules: {
            name: { required: true },
            phone: { required: true },
            email: { required: true },
            password: { required: true },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('#user-signup').append(loader);
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'This Operation is not Performed due to demo mode',
                showConfirmButton: false,
                timer: 1500
            })
            setTimeout(function () { window.location.reload(); }, 1500);
        }
    });

    // ========================================
    // script for Update Profile module
    // ========================================


    $('#forgot-password').validate({
        rules: {
            email: { required: true },
        },
        submitHandler: function (form) {
            $('.message').empty();
            var formdata = new FormData(form);
            $('#forgot-password').append(loader);
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'This Operation is not Performed due to demo mode',
                showConfirmButton: false,
                timer: 1500
            })
            setTimeout(function () { window.location.reload(); }, 1500);
        }
    });

    $('#reset-password').validate({
        rules: {
            password: { required: true },
            confirm_password: { required: true,equalTo:"#password" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('#reset-password').append(loader);
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'This Operation is not Performed due to demo mode',
                showConfirmButton: false,
                timer: 1500
            })
            setTimeout(function () { window.location.reload(); }, 1500);
        }
    });

        

        $('#updateProfile').validate({
            rules: {
                name: { required: true },
                phone: { required: true },
                address: { required: true }
            },
            submitHandler: function (form) {
                $('#updateProfile').append(loader);
                var formdata = new FormData(form);
                Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'This Operation is not Performed due to demo mode',
                showConfirmButton: false,
                timer: 1500
            })
            setTimeout(function () { window.location.reload(); }, 1500);
            }
        });

    // ========================================
    // script for Reservation module
    // ========================================

    $('#check-tables').validate({
        rules: {
            persons: { required: true },
            date: { required: true },
            time: { required: true },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('#check-tables').append(loader);
            $.ajax({
                url: uRL+'/reservation',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    $('.available-tables').html(dataResult);
                    $('.loader').remove();
                }
            });
        }
    });

    $('#create-reservation').validate({
        rules: {
            table_no: { required: true },
            no_person: { required: true },
            date: { required: true },
            start_time: { required: true },
            end_time: { required: true },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('#confirm-reservation').append(loader);
           Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'This Operation is not Performed due to demo mode',
                showConfirmButton: false,
                timer: 1500
            })
            setTimeout(function () { window.location.reload(); }, 1500);
        }
    });
    

    
    // $('#exampleModal').modal('show');
    $(document).on('click', '.table_id', function () {
        var id = $(this).attr('data-id');
        $('#exampleModal input[name=table_no]').val(id);
        $('#exampleModal').modal('show');

    });

    $('#addReservation').validate({
        submitHandler: function (form) {
            // alert(1);
            var formdata = new FormData(form);
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'This Operation is not Performed due to demo mode',
                showConfirmButton: false,
                timer: 1500
            })
            setTimeout(function () { window.location.reload(); }, 1500);
        }
    });


    

    // ========================================
    // script for Proceed To Complate Order Code module
    // ========================================
    $('.addOrder').click(function (e) {
        e.preventDefault();
        var customer_name = $('.customer_name').val();
        var food_qty = [];
        $('input[name="food_qty[]"]').each(function() {
            food_qty.push(this.value);
        });
        var food_price = [];
        $('input[name="food_price[]"]').each(function () {
            food_price.push(this.value);
        });
        var food_id = [];
        $('input[name="food_id[]"]').each(function () {
            food_id.push(this.value);
        });
        var payment_method = $("input[type=radio][name=defaultExampleRadios]:checked").val();
        var shipping_method = JSON.parse(localStorage.getItem("shipping_method"));
        var grand_total = parseInt($('.grand-total').html());
       // alert(grand_total);
        Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'This Operation is not Performed due to demo mode',
                showConfirmButton: false,
                timer: 1500
            })
            setTimeout(function () { window.location.reload(); }, 1500);
    });

    // ========================================
    // script for User ContactUs module
    // ========================================
    
    $('#addContactUs').validate({
        rules: {
            name: { required: true },
            email: { required: true },
            phone: { required: true },
            message: { required: true }
        },
        submitHandler: function (form) {
            $('#addContactUs').append(loader);
            var formdata = new FormData(form);
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'This Operation is not Performed due to demo mode',
                showConfirmButton: false,
                timer: 1500
            })
            setTimeout(function () { window.location.reload(); }, 1500);
        }
    });
});