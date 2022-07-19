// $(document).ready(function() {
//     setInterval(getposts, 10000);
// });
//
// function getposts() {
//     // $.ajax({
//     //     type: "GET",
//     //     url: "newstitles.php",
//     //     data: "user=success",
//     //     success: function(msg){
//     //         $(msg).appendTo("#edix");
//     //     }
//     // });
//     console.log("running")
// }

function postlike(post_id, e) {
    // console.log(e.action)
    e.preventDefault();
    // console.log('friendrequestclick')
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/home/likepost',
        // url: "{{}}",
        type:"POST",
        data:post_id,
        success: function(data) {

            // alert(data)
            if($.isEmptyObject(data.error)){

                $('#likethumb').css('background-color', 'red');
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
