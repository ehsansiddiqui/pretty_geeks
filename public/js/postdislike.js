function postdislike(post_id, e) {
    // console.log(e.action)
    e.preventDefault();
    // console.log('friendrequestclick')
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/home/dislikepost',
        // url: "{{}}",
        type:"POST",
        data:post_id,
        success: function(data) {

            // alert(data)
            if($.isEmptyObject(data.error)){

                // $('#dislikethumb').css('background-color', 'red');
            }else{
                Toastify({
                    text: data.error,
                    duration: 3000,
                    gravity: "bottom", // `top` or `bottom`
                    position: 'right', // `left`, `center` or `right`
                    backgroundColor: "#D93637",
                    stopOnFocus: true,
                    onClick: function(){}
                }).showToast();
            }



            // console.log(data)

        }
    });
}
