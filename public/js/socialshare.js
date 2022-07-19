function facebookshare(post,e){
    e.preventDefault();
    console.log("share")
    console.log("Post Data",post)
    // console.log("Images Data",images)
    // url = 'https://www.facebook.com/sharer.php?display=popup&u=' + window.location.href;
    // console.log("share url",url)
    // options = 'toolbar=0,status=0,resizable=1,width=626,height=436';
    // window.open(url,'sharer',options);
    //
    // $.ajax({
    //     url: '/home/facebookshare',
    //     method: 'post',
    //     data: {
    //         "_token": $('#csrf-token')[0].content,
    //         'post':post,
    //         'post_images':images,
    //     },
    //     dataType: 'json',
    //     success: function (data) {
    //         // console.log(data.response)
    //
    //         if ($.isEmptyObject(data.error)){
    //             Toastify({
    //                 text: data.response,
    //                 duration: 3000,
    //                 gravity: "bottom", // `top` or `bottom`
    //                 position: 'right', // `left`, `center` or `right`
    //                 backgroundColor: "#D93637",
    //                 stopOnFocus: true,
    //                 onClick: function(){}
    //             }).showToast();
    //
    //         }else{
    //             Toastify({
    //                 text: data.error,
    //                 duration: 3000,
    //                 gravity: "bottom", // `top` or `bottom`
    //                 position: 'right', // `left`, `center` or `right`
    //                 backgroundColor: "#D93637",
    //                 stopOnFocus: true,
    //                 onClick: function(){}
    //             }).showToast();
    //
    //         }
    //     },
    //     error: function (data) {
    //         console.log(data);
    //     }
    // });
}
function sharepage(images,post,event){
console.log("Post Data",post)
console.log("Images Data",images)

    $.ajax({
        url: '/home/sharepost',
        method: 'post',
        data: {
            "_token": $('#csrf-token')[0].content,
            'post':post,
            'post_images':images,
        },
        dataType: 'json',
        success: function (data) {
            // console.log(data.response)

            if ($.isEmptyObject(data.error)){
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
        },
        error: function (data) {
            console.log(data);
        }
    });
}
