jQuery(document).ready(function($){
    $('#filer_input').filer({
        limit: 3,
        maxSize: 3,
        extensions: ["jpg", "png", "gif"],
        showThumbs: true,
        changeInput:' <li><i class="fa fa-image"></i> <label class="fileContainer">  </label> </li>'
    });
    $('#video').filer({
        limit: 3,
        maxSize: 15,
        extensions: ["mp4", "flv", "wmv"],
        showThumbs: true,
        changeInput:' <li><i class="fa fa-video-camera"></i> <label class="fileContainer">  </label> </li>'
    });


    // $("#createForm").submit(function(e) {
    // $('#createForm').on('submit',function(e){
    //
    //     e.preventDefault();
    //     console.log("Post button clicked")
    //     // let value=$('form').serializeArray()
    //     let formData = new FormData(this);

    //     console.log("form are",formData)
    //     console.log("vales fo form arr are",value)
    //

    //     console.log("Values are",imagename)

    //     // if( document.getElementById("filer_input").files.length == 0 ){
    //     //     console.log("no Image files selected")
    //     // }else{
    //     //     console.log("Image is selected")
    //     // }
    //     // // var formEl = document.forms.signupform;
    //     // // var formData = new FormData(formEl);
    //     // // var name = formData.get('name');
    //     // $.ajaxSetup({
    //     //     headers: {
    //     //         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    //     //     }
    //     // });
    //     $.ajax({
    //         url: '/home/insertposts',
    //         method: 'post',
    //         data:  {"_token":  $('#csrf-token')[0].content,
    //             description : descvalue,
    //             image_url : imagename },
    //         dataType: 'json',
    //         success: function (data) {
    //             // if ($.isEmptyObject(data.error)){
    //             //     // alert("not a error")
    //             //     document.getElementById("signupform").reset();
    //             //     $('#res_message').html(data.response);
    //             //     $('#msg_div').removeClass('alert-danger');
    //             //     $('#msg_div').addClass('alert-success');
    //             //     $('#msg_div').show();
    //             //     $('#res_message').show();
    //             //     // $('').reset();
    //             //
    //             // }else{
    //             //     $("#msg_div").find("ul").html('');
    //             //     $("#msg_div").css('display','block');
    //             //     $('#msg_div').removeClass('alert-success');
    //             //     $('#msg_div').addClass('alert-danger');
    //             //     $('#mobileNumberError').text(data.error.mobile_number[0]);
    //             //     $('#emailError').text(data.error.email[0]);
    //             //     console.log("Error",data.error)
    //             //     $.each( data.error, function( key, value ) {
    //             //         $("#msg_div").find("ul").append('<li>'+value+'</li>');
    //             //     });
    //             //     // alert("error")
    //             //
    //             // }
    //              console.log('Response',data)
    //             // window.location=data.url;
    //         },
    //         error: function (data) {
    //             console.log(data);
    //         }
    //     });
    //     // console.log("Values are",value)
    // })

    $('#createForm').on('submit',function(event){
        event.preventDefault();
        let descvalue = $('#desc').val();
        let imagevalue= document.getElementById("filer_input")
        let videovalue= document.getElementById("video")
        let imagename=[]
        let videoname=[]
        for (var i = 0; i < imagevalue.files.length; ++i) {
            imagename.push(imagevalue.files.item(i).name)
        }
        for (var i = 0; i < videovalue.files.length; ++i) {
            videoname.push(videovalue.files.item(i).name)
        }
        if(descvalue == '' && imagename.length == 0 && videoname.length == 0){
            Toastify({
                text: "Please Enter Something in Post",
                duration: 3000,
                gravity: "bottom", // `top` or `bottom`
                position: 'right', // `left`, `center` or `right`
                backgroundColor: "#D93637",
                // linear-gradient(to right, #D93637, #DDBE7A)
                stopOnFocus: true,
                onClick: function(){}
            }).showToast();
        }else {
            $.ajax({
                url: '/home/insertposts',
                type:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log('Response', data)
                    // document.getElementById("createForm").reset();
                    // document.getElementById("filer_input").reset();
                    // document.getElementById("video").reset();
                    // $('#filer_input').val('')
                    // $('#video').val('')
                    console.log("Yes in the post section")
                    // document.getElementById('filer_input').value = "";
                    var filerKit = $('#filer_input').prop("jFiler");
                    filerKit.reset();
                    $('#filer_input').wrap('<form>').closest('form').get(0).reset();
                    $('#filer_input').unwrap();
                    Toastify({
                        text: data.response,
                        duration: 3000,
                        gravity: "bottom", // `top` or `bottom`
                        position: 'right', // `left`, `center` or `right`
                        backgroundColor: "#D93637",
                        stopOnFocus: true,
                        onClick: function(){}
                    }).showToast();
                }
            });
        }

    });

    // $("video").change(function(){
    //     if(event.target.files.length > 0){
    //         var src = URL.createObjectURL(event.target.files[0]);
    //         var preview = document.getElementById("file-ip-1-preview");
    //         // var preview = document.createElement("img");
    //         preview.preview = src;
    //         preview.style.display = "block";
    //     }
    // });


})
