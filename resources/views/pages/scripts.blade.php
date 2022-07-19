
<script src={{asset("js/main.min.js")}}></script>
<script src={{asset("js/script.js")}}></script>
<script src={{asset("js/map-init.js")}}></script>
<script src={{asset("js/login.js")}}></script>
<script src={{asset("js/posts.js")}}></script>
<script src={{asset("js/friendrequest.js")}}></script>
<script src={{asset("js/postlike.js")}}></script>
<script src={{asset("js/postdislike.js")}}></script>
<script src={{asset("js/postcomment.js")}}></script>
<script src={{asset("js/socialshare.js")}}></script>
<script src={{asset("js/profile.js")}}></script>
<script src={{asset("js/jquery.filer.min.js")}}></script>

{{--<script src="{{asset('js/jquery.js')}}"></script>--}}
{{--<script src="{{asset('js/popper.js')}}"></script>--}}
{{--<script src="{{asset('js/modelbootstrap.min.js')}}"></script>--}}
<script src="{{asset('js/modelmain.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>

    let logincount="{{auth()->user()->login_count}}"
    if (logincount == 0){
        console.log('login count',logincount)

        $('.modal').modal({backdrop: 'static', keyboard: false});

    }
    let userID = "{{auth()->user()->id}}";
    // Enable pusher logging - don't include this in production
    var notificationsWrapper   = $('.dropdown-notifications');
    var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('i[data-count]');
    var notificationsCount     = parseInt(notificationsCountElem.data('count'));
    var notifications          = notificationsWrapper.find('ul.drops-menu');
    let count= $("#notificationcounts").text();
    console.log("notification count",count)
    var cnt = parseInt(count);
    Pusher.logToConsole = true;

    var pusher = new Pusher('3e7ca447e0332d450e79', {
        cluster: 'ap2'
    });

    var channel = pusher.subscribe('friend-request');
    channel.bind('App\\Events\\FriendRequestNotification', function(data) {
        if(userID == data.id){
            if (!isNaN(cnt))
            {
                cnt++;
                $('#notificationcounts').text(String(cnt));
               // count.text(String(cnt));

            }
//         var existingNotifications = notifications.html();
//         var newNotificationHtml =` <li>
//                                     <a href="notifications.html" title="">
//                                         <img src="images/resources/thumb-2.jpg" alt="">
//                                         <div class="mesg-meta">
//                                             <h6>data.username</h6>
//                                             <span>data.message</span>
//                                             <i>2 min ago</i>
//                                         </div>
//                                     </a>
// <!--                                    <span class="tag red">Reply</span>-->
//                                 </li>`
//         notifications.html(newNotificationHtml + existingNotifications);
//         notificationsCount += 1;
//         notificationsCountElem.attr('data-count', notificationsCount);
//         notificationsWrapper.find('.notif-count').text(notificationsCount);
//         notificationsWrapper.show();

            $("#notificationlist").append(`<li>
                                     <a href="notifications.html" title="">
                                         <img src="images/resources/thumb-2.jpg" alt="">
                                         <div class="mesg-meta">
                                             <h6>`+data.username+`</h6>
                                             <span>`+data.message+`</span>
                                             <i>2 min ago</i>
                                         </div>
                                     </a>
                                   <span class="tag red">New</span>
                                 </li>`);
            alert(JSON.stringify(data));
        }
        // alert(JSON.stringify(data));
    });
    var channellike =pusher.subscribe('like-events');
    channellike.bind('App\\Events\\Like', function(data) {
        console.log('In the like event',data)
        let likecount= $("#likecounter_"+data.postId).text();
        var likecnt = parseInt(likecount);
        console.log("like count",likecnt)

        alert(JSON.stringify(data.action));
        if(data.action == 'like'){
            alert("Into like")
            if (!isNaN(likecnt))
            {
                likecnt++;
                console.log("like counter plus",String(likecnt))
                // console.log($("#likecounter_"+data.postId).text(String(likecnt)))

                $("#likecounter_"+data.postId).text(String(likecnt));
                // count.text(String(cnt));

            }
        }

        if(data.action == 'dislike'){
            // alert("into it")
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            // $.ajax({
            //     url: '/home/deselectlike',
            //     type:"POST",
            //     data:{
            //         'post_id':data.postId,
            //     },
            //     success: function(dataresult) {
            //
            //         // alert(data)
            //         if($.isEmptyObject(dataresult.error)){
                        $('#likethumb').css({'background-color': '', 'opacity' : ''});
                        if (!isNaN(likecnt))
                            {
                                likecnt--;
                                console.log("like counter minus",String(likecnt))
                                console.log($("#likecounter_"+data.postId).text(String(likecnt)))

                                $("#likecounter_"+data.postId).text(String(likecnt));
                                // count.text(String(cnt));

                            }
            //         }else{
            //             Toastify({
            //                 text: dataresult.error,
            //                 duration: 3000,
            //                 gravity: "bottom", // `top` or `bottom`
            //                 position: 'right', // `left`, `center` or `right`
            //                 backgroundColor: "#D93637",
            //                 stopOnFocus: true,
            //                 onClick: function(){}
            //             }).showToast();
            //         }
            //
            //     }
            // });
        }
    })

    var channellike =pusher.subscribe('dislike-events');
    channellike.bind('App\\Events\\PostDisLike', function(data) {
        console.log('In the like event',data)
        let dislikecount= $("#dislikecounter_"+data.postId).text();
        var dislikecnt = parseInt(dislikecount);
        console.log("dislike count",dislikecnt)

        alert(JSON.stringify(data.action));
        if(data.action == 'dislike'){
            alert("Into like")
            if (!isNaN(dislikecnt))
            {
                dislikecnt++;
                console.log("like counter plus",String(dislikecnt))
                // console.log($("#likecounter_"+data.postId).text(String(likecnt)))

                $("#dislikecounter_"+data.postId).text(String(dislikecnt));
                // count.text(String(cnt));

            }
        }

        if(data.action == 'like'){
            // alert("into it")
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            // $.ajax({
            //     url: '/home/deselectlike',
            //     type:"POST",
            //     data:{
            //         'post_id':data.postId,
            //     },
            //     success: function(dataresult) {
            //
            //         // alert(data)
            //         if($.isEmptyObject(dataresult.error)){
            $('#dislikethumb').css({'background-color': '', 'opacity' : ''});
            if (!isNaN(dislikecnt))
            {
                dislikecnt--;
                console.log("like counter minus",String(dislikecnt))
                console.log($("#dislikecounter_"+data.postId).text(String(dislikecnt)))

                $("#dislikecounter_"+data.postId).text(String(dislikecnt));
                // count.text(String(cnt));

            }
            //         }else{
            //             Toastify({
            //                 text: dataresult.error,
            //                 duration: 3000,
            //                 gravity: "bottom", // `top` or `bottom`
            //                 position: 'right', // `left`, `center` or `right`
            //                 backgroundColor: "#D93637",
            //                 stopOnFocus: true,
            //                 onClick: function(){}
            //             }).showToast();
            //         }
            //
            //     }
            // });
        }
    })
    let commentchannel =pusher.subscribe('comment-events');
    commentchannel.bind('App\\Events\\Comment', function(data) {
        console.log('Comment event data event',data)

        if(data.action === "comment") {
            var parent = jQuery("#commentsdiv_" + data.postId).parent("li");
            var comment_HTML = `<li><div class="comet-avatar"><img src="images/resources/comet-1.jpg" alt=""></div><div class="we-comment"><div class="coment-head"><h5><a href="time-line.html" title="">${data.username }</a></h5><span>1 year ago</span><a class="we-reply" onclick="replybutton(${data.commentId},event)" title="Reply"><i class="fa fa-reply"></i></a></div><p>${data.comment}</p></div>
 <ul id="ulreply_${data.commentId}" style="display: none">
                                                        <li>
                                                            <a href="#" title="" class="showmore underline" id="replydiv_${data.commentId}">more
                                                              replies</a>

                                                        </li>
                                                    </ul>
<ul id="commentreply_${data.commentId}" style="display: none">
                                                        <div class="post-comt-box">
                                                            <form method="post">
                                                            <textarea id="reply_${data.commentId}" name="comment" placeholder="Post your comment" onkeyup="postreply(${data.commentId},${data.userId},${data.postId},event)"></textarea>
                                                                <div class="add-smiles">
                                                                <span class="em em-expressionless" title="add icon"></span>
                                                                </div>
                                                                    <input type="hidden" name="post_id" value="${data.postId}" />
                                                                <div class="smiles-bunch">
                                                                    <i class="em em---1"></i>
                                                                    <i class="em em-smiley"></i>
                                                                    <i class="em em-anguished"></i>
                                                                    <i class="em em-laughing"></i>
                                                                    <i class="em em-angry"></i>
                                                                    <i class="em em-astonished"></i>
                                                                    <i class="em em-blush"></i>
                                                                    <i class="em em-disappointed"></i>
                                                                    <i class="em em-worried"></i>
                                                                    <i class="em em-kissing_heart"></i>
                                                                    <i class="em em-rage"></i>
                                                                    <i class="em em-stuck_out_tongue"></i>
                                                                </div>
                                                                <button id="" type="submit"></button>
                                                            </form>
                                                        </div>
                                                    </ul>
</li>`;

            $(comment_HTML).insertBefore(parent);
        }else if(data.action === "reply"){
            searchbar = document.getElementById("ulreply_"+ data.commentId).style.display = "block";
            var parent = jQuery("#replydiv_" + data.commentId).parent("li");
            var comment_HTML = `<li><div class="comet-avatar"><img src="images/resources/comet-1.jpg" alt=""></div><div class="we-comment"><div class="coment-head"><h5><a href="time-line.html" title="">` + data.username + `</a></h5><span>1 year ago</span><a class="we-reply" href="#" title="Reply"></a></div><p>` + data.comment + `</p></div></li>`;
            $(comment_HTML).insertBefore(parent);
        }

        alert(JSON.stringify(data));

    })
</script>
