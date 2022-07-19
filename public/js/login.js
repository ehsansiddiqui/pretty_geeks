jQuery(document).ready(function($){
    $("#btnsignup").click(function(e) {
        e.preventDefault();
        let value=$('form').serializeArray()
        // var formEl = document.forms.signupform;
        // var formData = new FormData(formEl);
        // var name = formData.get('name');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: '/sign-up',
            method: 'post',
            data: value,
            dataType: 'json',
            success: function (data) {
                if ($.isEmptyObject(data.error)){
                    // alert("not a error")
                    document.getElementById("signupform").reset();
                    $('#res_message').html(data.response);
                    $('#msg_div').removeClass('alert-danger');
                    $('#msg_div').addClass('alert-success');
                    $('#msg_div').show();
                    $('#res_message').show();
                    // $('').reset();

                }else{
                    // $("#msg_div").find("ul").html('');
                    // $("#msg_div").css('display','block');
                    // $('#msg_div').removeClass('alert-success');
                    // $('#msg_div').addClass('alert-danger');
                    console.log("data",data)
                    $('#emailError').text(data.error.email[0]);
                    $('#mobileNumberError').text(data.error.mobile_number[0]);
                    $('#passwordError').text(data.error.password[0]);
                    $('#dobError').text(data.error.dob[0]);
                    $('#sexError').text(data.error.sex);
                    $('#nameError').text(data.error.name[0]);
                    console.log("Error",data.error)
                    // $.each( data.error, function( key, value ) {
                    //     $("#msg_div").find("ul").append('<li>'+value+'</li>');
                    // });
                    // alert("error")

                }
             //  console.log('Response',data)
                // window.location=data.url;
            },
            error: function (data) {
                console.log(data);
            }
        });
        // console.log("Values are",value)
    })
    $("#btnsignin").click(function(e) {
        e.preventDefault();
        // let values=$('signinform').serializeArray()
        // var username = document.getElementsById("test");
        let value=$('form').serializeArray()
        // var valueuser = $('#username-in').val()
        // var valuepass = $('#password-in').val()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/sign-in',
            method: 'post',
            data: value,
            dataType: 'json',
            success: function (data) {
                // console.log("Values are",data.data)
               if($.isEmptyObject(data.error)){
                   console.log('successs',data)
                   window.location=data.url;

                   // window.onload = checklogincount;
               }else{
                   console.log('successs',data)
                   $('#res_message').html(data.error);
                   $('#msg_div').removeClass('alert-success');
                   $('#msg_div').addClass('alert-danger')
                   $('#msg_div').show();
                   $('#res_message').show();

                   $.each( data.error, function( key, value ) {
                       $("#msg_div").find("ul").append('<li>'+value+'</li>');
                   });
               }
            },
            error: function (data) {
                console.log(data);
            }
        });
        // console.log("signin values:",value)
    })


})
