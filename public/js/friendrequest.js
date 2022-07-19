jQuery(document).ready(function($){
    // $('friendrequest').on('click',function(e) {
    //     e.preventDefault();
    //     console.log('friendrequestclick')
    // })




})
function friendrequest(self, e) {
    console.log(self.id)
    e.preventDefault();
    // console.log('friendrequestclick')
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/home/friendrequest',
        // url: "{{}}",
        type:"POST",
        data:self,
        success: function(data) {

            if($.isEmptyObject(data.error)){
                $('#friendrequesttext_'+self.id ).text('Request Send');

                Toastify({
                    text: data.response,
                    duration: 3000,
                    gravity: "bottom", // `top` or `bottom`
                    position: 'right', // `left`, `center` or `right`
                    backgroundColor: "#D93637",
                    stopOnFocus: true,
                    onClick: function(){}
                }).showToast();
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
function acceptrequest(data, e) {
    e.preventDefault();
    console.log("Request Data",data)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/home/acceptfriendrequest',
        // url: "{{}}",
        type:"POST",
        data:data,
        success: function(data) {

            if($.isEmptyObject(data.error)){
                $('#deleterequestbutton').hide();
                $('#acceptrequestbutton').hide();
                $('#requestdiv').append('<p id="deleterequestbutton" title="" data-ripple="">Request Accepted</p>');

                //
                Toastify({
                    text: data.response,
                    duration: 3000,
                    gravity: "bottom", // `top` or `bottom`
                    position: 'right', // `left`, `center` or `right`
                    backgroundColor: "#D93637",
                    stopOnFocus: true,
                    onClick: function(){}
                }).showToast();
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
function rejectrequest(data, e) {
    e.preventDefault();
    // console.log("Reject Request Data",data)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/home/rejectfriendrequest',
        // url: "{{}}",
        type:"POST",
        data:data,
        success: function(data) {
            if($.isEmptyObject(data.error)){
                $('#deleterequestbutton').hide();
                $('#acceptrequestbutton').hide();
                $('#requestdiv').append('<p id="deleterequestbutton" title="" data-ripple="">Request Rejected</p>');

                //
                Toastify({
                    text: data.response,
                    duration: 3000,
                    gravity: "bottom", // `top` or `bottom`
                    position: 'right', // `left`, `center` or `right`
                    backgroundColor: "#D93637",
                    stopOnFocus: true,
                    onClick: function(){}
                }).showToast();
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
function unfriend(data, e) {
    e.preventDefault();
    console.log(data)
    // console.log("Reject Request Data",data)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/home/unfriend',
        // url: "{{}}",
        type:"POST",
        data:data,
        success: function(data) {
            if($.isEmptyObject(data.error)){
                $('#unfriendbutton').hide();
                $('#unfrienddiv').append('<p title="" data-ripple="">Friend Removed</p>');

                //
                Toastify({
                    text: data.response,
                    duration: 3000,
                    gravity: "bottom", // `top` or `bottom`
                    position: 'right', // `left`, `center` or `right`
                    backgroundColor: "#D93637",
                    stopOnFocus: true,
                    onClick: function(){}
                }).showToast();
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
