jQuery(document).ready(function($){

    $("#postcomment").keyup(function(e) {
        e.preventDefault();
        if (e.keyCode === 13) {
            // console.log("PostComment Click")
            $("#commentbutton").click();
        }

    });

    // var toggle  = document.getElementById("toggle");
    // $("#replybutton").click(function(e) {
    //     e.preventDefault();
    //
    //
    //
    //
    //     // if (e.keyCode === 13) {
    //     // let value=$('form').serializeArray()
    //     // var parent = jQuery(".showmore").parent("li");
    //     // var comment_HTML = '	<li><div class="comet-avatar"><img src="images/resources/comet-1.jpg" alt=""></div><div class="we-comment"><div class="coment-head"><h5><a href="time-line.html" title="">Jason borne</a></h5><span>1 year ago</span><a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a></div><p>This is nothing comment</p></div></li>';
    //     // $(comment_HTML).insertBefore(parent);
    //     // jQuery(this).val('');
    //
    //     console.log("ReplyButton Click",element)
    //
    //             $("#commentreply").append(``)
    //
    //
    // });
});

function replybutton(comment_id,e){
    e.preventDefault();
    console.log("Comment id",comment_id)
    let element=document.getElementById("commentreply_"+comment_id);
    console.log("Comment id",element)
    element.style.display = (element.dataset.toggle ^= 1) ? "block" : "none";
}
function postreply(comment_id,user_id,post_id,e) {
    e.preventDefault();
    if (e.keyCode === 13) {
        let reply = $('#reply_'+comment_id).val();
        console.log("reply of a comment",reply)


        $.ajax({
            url: '/home/postreply',
            method: 'post',
            data: {
                "_token": $('#csrf-token')[0].content,
                'post_id':post_id,
                'comment':reply,
                'comment_id':comment_id,
                'user_id':user_id,
            },
            dataType: 'json',
            success: function (data) {
                // console.log(data.response)

                if ($.isEmptyObject(data.error)){
                    // console.log("In the text area",comment_id)
                    var ele=document.getElementById("reply_"+comment_id).value = "";
                    // console.log("In the text area",ele)

                    // jQuery("#commentreply_"+comment_id).val('');

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
}
function postcomment(post_id,e){
    e.preventDefault();
    if (e.keyCode === 13) {
        console.log("PostComment Function id",post_id)
        // $("#commentbutton").click();
        // let comment = $('#postcomment_'+post_id).val();
        let comment  = $('#postcomment_'+post_id).val();

        $.ajax({
            url: '/home/postcomment',
            method: 'post',
            data: {
                "_token": $('#csrf-token')[0].content,
                'post_id':post_id,
                'comment':comment,
            },
            dataType: 'json',
            success: function (data) {
                console.log(data.response)
                if ($.isEmptyObject(data.error)){
                    var ele=document.getElementById("postcomment_"+post_id).value = "";


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
}
