@extends('master')

@section('content')

    <div class="gap gray-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row" id="page-contents">
                        <div class="col-lg-3">
                            <aside class="sidebar static">
                                <div class="widget">
                                    <h4 class="widget-title">Shortcuts</h4>
                                    <ul class="naves">
                                        <li>
                                            <i class="ti-clipboard"></i>
                                            <a href="#" title="">News feed</a>
                                        </li>
                                        <li>
                                            <i class="ti-mouse-alt"></i>
                                            <a href="#" title="">Inbox</a>
                                        </li>
                                        <li>
                                            <i class="ti-files"></i>
                                            <a href="#" title="">My pages</a>
                                        </li>
                                        <li>
                                            <i class="ti-user"></i>
                                            <a href={{route('timelinefriends')}} title="">friends</a>
                                        </li>
                                        <li>
                                            <i class="ti-image"></i>
                                            <a href={{route('timelinephotos')}} title="">images</a>
                                        </li>
                                        <li>
                                            <i class="ti-video-camera"></i>
                                            <a href={{route('timelinevideos')}} title="">videos</a>
                                        </li>
                                        <li>
                                            <i class="ti-comments-smiley"></i>
                                            <a href="#" title="">Messages</a>
                                        </li>
                                        <li>
                                            <i class="ti-bell"></i>
                                            <a href="#" title="">Notifications</a>
                                        </li>
                                        <li>
                                            <i class="ti-share"></i>
                                            <a href="#" title="">People Nearby</a>
                                        </li>
                                        <li>
                                            <i class="fa fa-bar-chart-o"></i>
                                            <a href="#" title="">insights</a>
                                        </li>
                                        <li>
                                            <i class="ti-power-off"></i>

                                            <a href={{ route('logout') }} title="" onclick="event.preventDefault();document.getElementById('frm-logout').submit();">Logout</a>
                                            <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </div><!-- Shortcuts -->
                                <div class="widget">
                                    <h4 class="widget-title">Recent Activity</h4>
                                    <ul class="activitiez">
                                        @foreach($notifications as $notification)
                                        <li>

                                            <div class="activity-meta">
                                                <i>10 hours Ago</i>
                                                @if($notification->receiver_id != \Illuminate\Support\Facades\Auth::user()->id)
                                                    <h6><a href="#">{{(new App\Models\User)->getusers($notification->receiver_id)}}</a></h6>
                                                @else
                                                    <h6><a href="#">{{(new App\Models\User)->getusers($notification->sender_id)}}</a></h6>

                                                @endif
                                                <span><a href="#" title="">{{$notification->notification_about}}</a></span>

                                            </div>

                                        </li>
                                        @endforeach
{{--                                        <li>--}}
{{--                                            <div class="activity-meta">--}}
{{--                                                <i>30 Days Ago</i>--}}
{{--                                                <span><a href="#" title="">Posted your status. “Hello guys, how--}}
{{--																are you?”</a></span>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <div class="activity-meta">--}}
{{--                                                <i>2 Years Ago</i>--}}
{{--                                                <span><a href="#" title="">Share a video on her--}}
{{--																timeline.</a></span>--}}
{{--                                                <h6>"<a href="#">you are so funny mr.been.</a>"</h6>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
                                    </ul>
                                </div><!-- recent activites -->
                                <div class="widget stick-widget">
{{--                                    <h4 class="widget-title">Who's following</h4>--}}
                                    <h4 class="widget-title">People to follow</h4>
                                    <ul class="followers">
                                        @foreach($friend_requests as $friend_request)
                                        <li>
                                            @if(is_null($friend_request->avatar))
                                                <figure><img src={{asset("images/resources/user.jpg")}} alt="">
                                                </figure>
                                            @else
                                                <figure><img src="{{Storage::url("public/{$friend_request->avatar}")}}" alt="">
                                                </figure>
                                            @endif
{{--                                            @dd($friend_request)--}}
                                            <div class="friend-meta">
                                                <h4><a href="{{route('profile',encrypt($friend_request->id))}}" title="">{{$friend_request->name}}</a></h4>
                                                <a href="" id="friendrequesttext_{{$friend_request->id}}"  title="" onclick="friendrequest({{$friend_request}}, event)" class="underline">Add Friend</a>
                                            </div>
                                        </li>
                                        @endforeach
{{--                                        <li>--}}
{{--                                            <figure><img src="images/resources/friend-avatar4.jpg" alt="">--}}
{{--                                            </figure>--}}
{{--                                            <div class="friend-meta">--}}
{{--                                                <h4><a href="#" title="">Issabel</a></h4>--}}
{{--                                                <a href="#" title="" class="underline">Add Friend</a>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <figure><img src="images/resources/friend-avatar6.jpg" alt="">--}}
{{--                                            </figure>--}}
{{--                                            <div class="friend-meta">--}}
{{--                                                <h4><a href="#" title="">Andrew</a></h4>--}}
{{--                                                <a href="#" title="" class="underline">Add Friend</a>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <figure><img src="images/resources/friend-avatar8.jpg" alt="">--}}
{{--                                            </figure>--}}
{{--                                            <div class="friend-meta">--}}
{{--                                                <h4><a href="#" title="">Sophia</a></h4>--}}
{{--                                                <a href="#" title="" class="underline">Add Friend</a>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <figure><img src="images/resources/friend-avatar3.jpg" alt="">--}}
{{--                                            </figure>--}}
{{--                                            <div class="friend-meta">--}}
{{--                                                <h4><a href="#" title="">Allen</a></h4>--}}
{{--                                                <a href="#" title="" class="underline">Add Friend</a>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
                                    </ul>
                                </div><!-- who's following -->
                            </aside>
                        </div><!-- sidebar -->
                        <div class="col-lg-6">
                            <div class="central-meta">
                                <div class="new-postbox">
                                    <figure>
{{--                                        @dd(\Illuminate\Support\Facades\Auth::user()->avatar)--}}
                                        <img src="{{Storage::url("public/".\Illuminate\Support\Facades\Auth::user()->avatar)}}" alt="">
                                    </figure>
                                    <div class="newpst-input">
                                        <form id="createForm" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <textarea rows="2" name="description" id="desc" placeholder="write something"></textarea>
                                            <div class="attachments">
                                                <ul>
{{--                                                    <li>--}}
{{--                                                        <i class="fa fa-music"></i>--}}
{{--                                                        <label class="fileContainer">--}}
{{--                                                            <input type="file" name="image_url">--}}
{{--                                                        </label>--}}
{{--                                                    </li>--}}
                                                    <li>
{{--                                                        <i class="fa fa-image"></i>--}}
{{--                                                        <label class="fileContainer">--}}
                                                            <input type="file" name="file_url[]" id="filer_input" accept="image/*" multiple="multiple" >
{{--                                                        </label>--}}
                                                    </li>
                                                    <li>
{{--                                                        <i class="fa fa-video-camera"></i>--}}
{{--                                                        <label class="fileContainer">--}}
                                                            <input type="file" id="video" name="file_url" accept="video/*" multiple="multiple" >
{{--                                                        </label>--}}
{{--                                                        <div class="preview">--}}
{{--                                                            <img id="file-ip-1-preview">--}}
{{--                                                        </div>--}}
                                                    </li>

{{--                                                    <li>--}}
{{--                                                        <i class="fa fa-camera"></i>--}}
{{--                                                        <label class="fileContainer">--}}
{{--                                                            <input type="file" name="image_url">--}}
{{--                                                        </label>--}}
{{--                                                    </li>--}}
                                                    <li>
                                                        <button id="postbutton" type="submit">Post</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- add post new box -->
                            <div class="loadMore">
                                @for ($i = 0; $i < count($posts); $i++)
                                <div class="central-meta item">

                                    <div class="user-post">

                                        <div class="friend-info">
{{--                                            <a href="{{route('single_post',$posts[$i]->id)}}" title="">--}}
                                            <figure>
                                                <img src="{{Storage::url("public/".(new App\Models\User)->getuserdp($posts[$i]->user_id))}}" alt="">
                                            </figure>
                                            <div class="friend-name">
                                                <ins><a href="{{route('profile',encrypt($posts[$i]->user_id))}}" title="">{{(new App\Models\User)->getusers($posts[$i]->user_id)}}</a></ins>
                                                <span>published: june,2 2018 19:PM</span>
                                            </div>
                                            <div class="post-meta">
{{--                                                <img src="images/resources/user-post.jpg" alt="">--}}
                                                <div class="container">
                                                    <div class="row">
                                                        @foreach((new App\Models\Post)->returnImages($posts[$i]->id) as $index => $image)


{{--                                                            {{dd($index)}}--}}
                                                        <div class="col"  style="margin: 1px; padding-right: 0px;
    padding-left: 3px;">
{{--                                                            <img src="{{Storage::url("public/{$image->file_url}")}}" alt="">--}}
                                                            <img src="{{ asset('/storage/'.$image->file_url) }}" style="width: 100%; height: 100%;">
                                                        </div>
                                                            @if(($index+1)%2 == 0 )
{{--                                                                {{var_dump($index)}}--}}
                                                        <div class="w-100"></div>
                                                            @endif


                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="we-video-info">
                                                    <ul>
                                                        <li>
																	<span class="views" data-toggle="tooltip"
                                                                          title="views">
																		<i class="fa fa-eye"></i>
																		<ins>1.2k</ins>
																	</span>
                                                        </li>
                                                        <li>
																	<span class="comment" data-toggle="tooltip"
                                                                          title="Comments">
																		<i class="fa fa-comments-o"></i>
																		<ins>{{(new App\Models\PostComment)->countcomments($posts[$i]->id)}}</ins>
																	</span>
                                                        </li>
                                                        <li onclick="postlike({{$posts[$i]}},event)">
																	<span class="like" data-toggle="tooltip"
                                                                          title="like">
																		<i id="likethumb" class="ti-thumb-up"></i>
																		<ins id="likecounter_{{$posts[$i]->id}}">{{(new App\Models\PostLike)->countlikes($posts[$i]->id)}}</ins>
																	</span>
                                                        </li>
                                                        <li onclick="postdislike({{$posts[$i]}},event)">
																	<span class="dislike" data-toggle="tooltip"
                                                                          title="dislike">
																		<i id="dislikethumb" class="ti-thumb-down"></i>
																		<ins id="dislikecounter_{{$posts[$i]->id}}">{{(new App\Models\DisLike)->countdislikes($posts[$i]->id)}}</ins>
																	</span>
                                                        </li>
                                                        <li class="social-media">
                                                            <div class="menu">
                                                                <div class="btn trigger"><i
                                                                        class="fa fa-share-alt"></i></div>
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="#"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-html5"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
                                                                <div class="rotater">
                                                                    <div class="btn btn-icon"><a href="https://www.facebook.com/sharer/sharer.php?u={{ route('single_post',$posts[$i]->id) }}"
                                                                                                 target="_blank"
                                                                                                 title=""><i
                                                                                class="fa fa-facebook"></i></a>
                                                                    </div>
                                                                </div>
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a onclick="facebookshare('{{ route('single_post',$posts[$i]->id) }}',event)"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-facebook"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="#"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-google-plus"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
                                                                <div class="rotater">
                                                                    <div class="btn btn-icon"><a href="https://twitter.com/intent/tweet?url={{ route('single_post',$posts[$i]->id) }}"
            target="_blank"
                                                                                                 title=""><i
                                                                                class="fa fa-twitter"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="rotater">
                                                                    <div class="btn btn-icon"><a onclick="sharepage({{(new App\Models\Post)->returnImages($posts[$i]->id)}},{{$posts[$i]}},event)"
                                                                                                 title=""><i
                                                                                class="fa fa-share-alt"></i></a>
                                                                    </div>
                                                                </div>
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="https://www.instagram.com/?url=http://{{ urlencode($_SERVER['HTTP_HOST']) }}{{ urlencode($_SERVER['REQUEST_URI']) }}"--}}
{{--                                                                                                 target="_blank"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-instagram"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="#"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-dribbble"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="#"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-pinterest"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}

                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="description">

                                                    <p>
                                                        {{$posts[$i]->description}}
                                                    </p>
                                                </div>

{{--                                                @endforeach--}}
                                            </div>
                                        </div>
                                        <div class="coment-area" >
                                            <ul class="we-comet" id="">
{{--                                                <li>--}}
{{--                                                    <div class="comet-avatar">--}}
{{--                                                        <img src="images/resources/comet-1.jpg" alt="">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="we-comment">--}}
{{--                                                        <div class="coment-head">--}}
{{--                                                            <h5><a href="#" title="">Jason borne</a></h5>--}}
{{--                                                            <span>1 year ago</span>--}}
{{--                                                            <a class="we-reply" href="#" title="Reply"><i--}}
{{--                                                                    class="fa fa-reply"></i></a>--}}
{{--                                                        </div>--}}
{{--                                                        <p>we are working for the dance and sing songs. this car--}}
{{--                                                            is very awesome for the--}}
{{--                                                            youngster. please vote this car and like our post--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <ul>--}}
{{--                                                        <li>--}}
{{--                                                            <div class="comet-avatar">--}}
{{--                                                                <img src="images/resources/comet-2.jpg" alt="">--}}
{{--                                                            </div>--}}
{{--                                                            <div class="we-comment">--}}
{{--                                                                <div class="coment-head">--}}
{{--                                                                    <h5><a href="time-line.html"--}}
{{--                                                                           title="">alexendra dadrio</a></h5>--}}
{{--                                                                    <span>1 month ago</span>--}}
{{--                                                                    <a class="we-reply" href="#"--}}
{{--                                                                       title="Reply"><i--}}
{{--                                                                            class="fa fa-reply"></i></a>--}}
{{--                                                                </div>--}}
{{--                                                                <p>yes, really very awesome car i see the--}}
{{--                                                                    features of this car in the official--}}
{{--                                                                    website of <a href="#"--}}
{{--                                                                                  title="">#Mercedes-Benz</a> and really--}}
{{--                                                                    impressed :-)</p>--}}
{{--                                                            </div>--}}
{{--                                                        </li>--}}
{{--                                                        <li>--}}
{{--                                                            <div class="comet-avatar">--}}
{{--                                                                <img src="images/resources/comet-3.jpg" alt="">--}}
{{--                                                            </div>--}}
{{--                                                            <div class="we-comment">--}}
{{--                                                                <div class="coment-head">--}}
{{--                                                                    <h5><a href="#" title="">Olivia</a></h5>--}}
{{--                                                                    <span>16 days ago</span>--}}
{{--                                                                    <a class="we-reply" href="#"--}}
{{--                                                                       title="Reply"><i--}}
{{--                                                                            class="fa fa-reply"></i></a>--}}
{{--                                                                </div>--}}
{{--                                                                <p>i like lexus cars, lexus cars are most--}}
{{--                                                                    beautiful with the awesome features, but--}}
{{--                                                                    this car is really outstanding than lexus--}}
{{--                                                                </p>--}}
{{--                                                            </div>--}}
{{--                                                        </li>--}}
{{--                                                    </ul>--}}
{{--                                                </li>--}}
                                                @foreach($comments as $comment)
{{--                                                    @dd($comment->commentable_id)--}}
                                                    @if($posts[$i]->id == $comment->commentable_id)
                                                <li>
                                                    <div class="comet-avatar">
                                                        <img src="{{Storage::url("public/".(new App\Models\User)->getuserdp($comment->user_id))}}" alt="" style="width: 50px">
                                                    </div>
                                                    <div class="we-comment">
                                                        <div class="coment-head">
{{--                                                            <h5><a href="#" title="">{{$comment->user()}}</a></h5>--}}
                                                            <h5><a href="#" title="">{{(new App\Models\User)->getusers($comment->user_id)}}</a></h5>

                                                            <span>1 week ago</span>
                                                            <a class="we-reply" id="" onclick="replybutton({{$comment->id}},event)" title="Reply"><i
                                                                    class="fa fa-reply"></i></a>
                                                        </div>
                                                        <p>{{$comment->comment}}
                                                            <i class="em em-smiley"></i>
                                                        </p>
                                                    </div>
{{--                                                    @dd($replies)--}}
                                                    @foreach($replies as $reply)
                                                    @if($reply->parent_id == $comment->id)
                                                    <ul>
                                                        <li>
                                                            <div class="comet-avatar">

                                                                <img src="{{Storage::url("public/".(new App\Models\User)->getuserdp($reply->user_id))}}" alt="" style="width: 50px">
                                                            </div>
                                                            <div class="we-comment">
                                                                <div class="coment-head">
                                                                    <h5><a href="time-line.html" title="">{{(new App\Models\User)->getusers($reply->user_id)}}</a></h5>
                                                                    <span>1 month ago</span>
                                                                    <a class="we-reply" href="#" title="Reply"></a>
                                                                </div>
                                                                <p>{{$reply->comment}}</p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    @endif
                                                    @endforeach
                                                    <ul id="ulreply_{{$comment->id}}" style="display: none">
                                                        <li>
                                                            <a href="#" title="" class="showmore underline" id="replydiv_{{$comment->id}}">more
                                                                replies</a>
                                                        </li>
                                                    </ul>
                                                    <ul id="commentreply_{{$comment->id}}" style="display: none">
                                                        <div class="post-comt-box">
                                                            <form method="post">
                                                            <textarea id="reply_{{ $comment->id }}" name="comment" placeholder="Post your comment" onkeyup="postreply({{$comment->id}},{{$comment->user_id}},{{ $posts[$i]->id }},event)"></textarea>
                                                                <div class="add-smiles">
                                                                <span class="em em-expressionless" title="add icon"></span>
                                                                </div>
                                                                <input type="hidden" name="post_id" value="{{ $posts[$i]->id }}" />
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
                                                </li>
                                                    @endif
                                                @endforeach
                                                <li>
                                                    <a href="#" title="" class="showmore underline" id="commentsdiv_{{$posts[$i]->id}}">more
                                                        comments</a>
                                                </li>
                                                <li class="post-comment">
                                                    <div class="comet-avatar">
                                                        <img src="{{Storage::url("public/".\Illuminate\Support\Facades\Auth::user()->avatar)}}" alt="">
                                                    </div>
                                                    <div class="post-comt-box">
                                                        <form method="post">
                                                            @csrf
																	<textarea id="postcomment_{{ $posts[$i]->id }}" name="comment"
                                                                        placeholder="Post your comment" onkeyup="postcomment({{$posts[$i]->id }},event)"></textarea>
                                                            <div class="add-smiles">
																		<span class="em em-expressionless"
                                                                              title="add icon"></span>
                                                            </div>
                                                            <input type="hidden" name="post_id" value="{{ $posts[$i]->id }}" />
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
                                                            <button id="commentbutton_{{ $posts[$i]->id }}" type="submit"></button>
                                                        </form>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>

                                </div>
                                @endfor
{{--                                <div class="central-meta item">--}}
{{--                                    <div class="user-post">--}}
{{--                                        <div class="friend-info">--}}
{{--                                            <figure>--}}
{{--                                                <img src="images/resources/nearly1.jpg" alt="">--}}
{{--                                            </figure>--}}
{{--                                            <div class="friend-name">--}}
{{--                                                <ins><a href="time-line.html" title="">Sara Grey</a></ins>--}}
{{--                                                <span>published: june,2 2018 19:PM</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="post-meta">--}}
{{--                                                <iframe src="https://player.vimeo.com/video/15232052"--}}
{{--                                                        height="315" webkitallowfullscreen mozallowfullscreen--}}
{{--                                                        allowfullscreen></iframe>--}}
{{--                                                <div class="we-video-info">--}}
{{--                                                    <ul>--}}
{{--                                                        <li>--}}
{{--																	<span class="views" data-toggle="tooltip"--}}
{{--                                                                          title="views">--}}
{{--																		<i class="fa fa-eye"></i>--}}
{{--																		<ins>1.2k</ins>--}}
{{--																	</span>--}}
{{--                                                        </li>--}}
{{--                                                        <li>--}}
{{--																	<span class="comment" data-toggle="tooltip"--}}
{{--                                                                          title="Comments">--}}
{{--																		<i class="fa fa-comments-o"></i>--}}
{{--																		<ins>52</ins>--}}
{{--																	</span>--}}
{{--                                                        </li>--}}
{{--                                                        <li>--}}
{{--																	<span class="like" data-toggle="tooltip"--}}
{{--                                                                          title="like">--}}
{{--																		<i class="ti-thumb-up"></i>--}}
{{--																		<ins>2.2k</ins>--}}
{{--																	</span>--}}
{{--                                                        </li>--}}
{{--                                                        <li>--}}
{{--																	<span class="dislike" data-toggle="tooltip"--}}
{{--                                                                          title="dislike">--}}
{{--																		<i class="ti-thumb-down"></i>--}}
{{--																		<ins>200</ins>--}}
{{--																	</span>--}}
{{--                                                        </li>--}}
{{--                                                        <li class="social-media">--}}
{{--                                                            <div class="menu">--}}
{{--                                                                <div class="btn trigger"><i--}}
{{--                                                                        class="fa fa-share-alt"></i></div>--}}
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="#"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-html5"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="#"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-facebook"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="#"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-google-plus"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="#"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-twitter"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="#"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-css3"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="#"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-instagram"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="#"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-dribbble"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="#"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-pinterest"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}

{{--                                                            </div>--}}
{{--                                                        </li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                                <div class="description">--}}

{{--                                                    <p>--}}
{{--                                                        Lonely Cat Enjoying in Summer Curabitur <a href="#"--}}
{{--                                                                                                   title="">#mypage</a> ullamcorper--}}
{{--                                                        ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas--}}
{{--                                                        tempus, tellus eget condimentum--}}
{{--                                                        rhoncus, sem quam semper libero, sit amet adipiscing sem--}}
{{--                                                        neque sed ipsum. Nam quam nunc,--}}
{{--                                                    </p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="coment-area">--}}
{{--                                            <ul class="we-comet">--}}
{{--                                                <li>--}}
{{--                                                    <div class="comet-avatar">--}}
{{--                                                        <img src="images/resources/comet-1.jpg" alt="">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="we-comment">--}}
{{--                                                        <div class="coment-head">--}}
{{--                                                            <h5><a href="time-line.html" title="">Jason--}}
{{--                                                                    borne</a></h5>--}}
{{--                                                            <span>1 year ago</span>--}}
{{--                                                            <a class="we-reply" href="#" title="Reply"><i--}}
{{--                                                                    class="fa fa-reply"></i></a>--}}
{{--                                                        </div>--}}
{{--                                                        <p>we are working for the dance and sing songs. this--}}
{{--                                                            video is very awesome for the--}}
{{--                                                            youngster. please vote this video and like our--}}
{{--                                                            channel</p>--}}
{{--                                                    </div>--}}

{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <div class="comet-avatar">--}}
{{--                                                        <img src="images/resources/comet-2.jpg" alt="">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="we-comment">--}}
{{--                                                        <div class="coment-head">--}}
{{--                                                            <h5><a href="time-line.html" title="">Sophia</a>--}}
{{--                                                            </h5>--}}
{{--                                                            <span>1 week ago</span>--}}
{{--                                                            <a class="we-reply" href="#" title="Reply"><i--}}
{{--                                                                    class="fa fa-reply"></i></a>--}}
{{--                                                        </div>--}}
{{--                                                        <p>we are working for the dance and sing songs. this--}}
{{--                                                            video is very awesome for the--}}
{{--                                                            youngster.--}}
{{--                                                            <i class="em em-smiley"></i>--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a href="#" title="" class="showmore underline">more--}}
{{--                                                        comments</a>--}}
{{--                                                </li>--}}
{{--                                                <li class="post-comment">--}}
{{--                                                    <div class="comet-avatar">--}}
{{--                                                        <img src="images/resources/comet-2.jpg" alt="">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="post-comt-box">--}}
{{--                                                        <form method="post">--}}
{{--																	<textarea--}}
{{--                                                                        placeholder="Post your comment"></textarea>--}}
{{--                                                            <div class="add-smiles">--}}
{{--																		<span class="em em-expressionless"--}}
{{--                                                                              title="add icon"></span>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="smiles-bunch">--}}
{{--                                                                <i class="em em---1"></i>--}}
{{--                                                                <i class="em em-smiley"></i>--}}
{{--                                                                <i class="em em-anguished"></i>--}}
{{--                                                                <i class="em em-laughing"></i>--}}
{{--                                                                <i class="em em-angry"></i>--}}
{{--                                                                <i class="em em-astonished"></i>--}}
{{--                                                                <i class="em em-blush"></i>--}}
{{--                                                                <i class="em em-disappointed"></i>--}}
{{--                                                                <i class="em em-worried"></i>--}}
{{--                                                                <i class="em em-kissing_heart"></i>--}}
{{--                                                                <i class="em em-rage"></i>--}}
{{--                                                                <i class="em em-stuck_out_tongue"></i>--}}
{{--                                                            </div>--}}
{{--                                                            <button type="submit"></button>--}}
{{--                                                        </form>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="central-meta item">--}}
{{--                                    <div class="user-post">--}}
{{--                                        <div class="friend-info">--}}
{{--                                            <figure>--}}
{{--                                                <img alt="" src="images/resources/friend-avatar10.jpg">--}}
{{--                                            </figure>--}}
{{--                                            <div class="friend-name">--}}
{{--                                                <ins><a title="" href="time-line.html">Janice Griffith</a></ins>--}}
{{--                                                <span>published: june,2 2018 19:PM</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="description">--}}

{{--                                                <p>--}}
{{--                                                    Curabitur World's most beautiful car in <a title=""--}}
{{--                                                                                               href="#">#test drive booking !</a> the--}}
{{--                                                    most beatuiful car available in america and the saudia--}}
{{--                                                    arabia, you can book your test--}}
{{--                                                    drive by our official website--}}
{{--                                                </p>--}}
{{--                                            </div>--}}
{{--                                            <div class="post-meta">--}}
{{--                                                <div class="linked-image align-left">--}}
{{--                                                    <a title="" href="#"><img alt=""--}}
{{--                                                                              src="images/resources/page1.jpg"></a>--}}
{{--                                                </div>--}}
{{--                                                <div class="detail">--}}
{{--                                                    <span>Love Maid - ChillGroves</span>--}}
{{--                                                    <p>Lorem ipsum dolor sit amet, consectetur ipisicing elit,--}}
{{--                                                        sed do eiusmod tempor--}}
{{--                                                        incididunt ut labore et dolore magna aliqua... </p>--}}
{{--                                                    <a title="" href="#">www.sample.com</a>--}}
{{--                                                </div>--}}
{{--                                                <div class="we-video-info">--}}
{{--                                                    <ul>--}}
{{--                                                        <li>--}}
{{--																	<span class="views" data-toggle="tooltip"--}}
{{--                                                                          title="views">--}}
{{--																		<i class="fa fa-eye"></i>--}}
{{--																		<ins>1.2k</ins>--}}
{{--																	</span>--}}
{{--                                                        </li>--}}
{{--                                                        <li>--}}
{{--																	<span class="comment" data-toggle="tooltip"--}}
{{--                                                                          title="Comments">--}}
{{--																		<i class="fa fa-comments-o"></i>--}}
{{--																		<ins>52</ins>--}}
{{--																	</span>--}}
{{--                                                        </li>--}}
{{--                                                        <li>--}}
{{--																	<span class="like" data-toggle="tooltip"--}}
{{--                                                                          title="like">--}}
{{--																		<i class="ti-thumb-up"></i>--}}
{{--																		<ins>2.2k</ins>--}}
{{--																	</span>--}}
{{--                                                        </li>--}}
{{--                                                        <li>--}}
{{--																	<span class="dislike" data-toggle="tooltip"--}}
{{--                                                                          title="dislike">--}}
{{--																		<i class="ti-thumb-down"></i>--}}
{{--																		<ins>200</ins>--}}
{{--																	</span>--}}
{{--                                                        </li>--}}
{{--                                                        <li class="social-media">--}}
{{--                                                            <div class="menu">--}}
{{--                                                                <div class="btn trigger"><i--}}
{{--                                                                        class="fa fa-share-alt"></i></div>--}}
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="#"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-html5"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="#"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-facebook"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="#"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-google-plus"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="#"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-twitter"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="#"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-css3"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="#"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-instagram"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="#"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-dribbble"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="rotater">--}}
{{--                                                                    <div class="btn btn-icon"><a href="#"--}}
{{--                                                                                                 title=""><i--}}
{{--                                                                                class="fa fa-pinterest"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}

{{--                                                            </div>--}}
{{--                                                        </li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div><!-- centerl meta -->
                        <div class="col-lg-3">
                            <aside class="sidebar static">
                                <div class="widget friend-list stick-widget">
                                    <h4 class="widget-title">Social Circle</h4>
                                    <div id="searchDir"></div>
                                    <ul id="people-list" class="friendz-list">
                                        @foreach($friendswith as $friends)
                                            {{--                                            @dd($friends)--}}
                                            @if(\Illuminate\Support\Facades\Auth::user()->id == $friends->user_id)
                                                <li>
                                                    {{--                                                        @dd($friends)--}}
                                                    <figure>
                                                        <img src="{{Storage::url("public/".(new App\Models\User)->getuserdp($friends->friend_id))}}" alt="">
                                                        <span class="status f-online"></span>
                                                    </figure>
                                                    <div class="friendz-meta">
                                                        <a href="#">{{(new App\Models\User)->getusers($friends->friend_id)}}</a>
                                                        <i><a href="#"
                                                              class="__cf_email__"></a></i>
                                                    </div>
                                                </li>
                                            @else
                                                <li>
                                                    <figure>
                                                        <img src="{{Storage::url("public/".(new App\Models\User)->getuserdp($friends->user_id))}}" alt="">
                                                        <span class="status f-online"></span>
                                                    </figure>
                                                    <div class="friendz-meta">
                                                        <a href="#">{{(new App\Models\User)->getusers($friends->user_id)}}</a>
                                                        <i><a href="#"
                                                              class="__cf_email__"></a></i>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
{{--                                        <li>--}}
{{--                                            <figure>--}}
{{--                                                <img src="images/resources/friend-avatar2.jpg" alt="">--}}
{{--                                                <span class="status f-away"></span>--}}
{{--                                            </figure>--}}
{{--                                            <div class="friendz-meta">--}}
{{--                                                <a href="#">Sarah Loren</a>--}}
{{--                                                <i><a href=""--}}
{{--                                                      class="__cf_email__"></a></i>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <figure>--}}
{{--                                                <img src="images/resources/friend-avatar3.jpg" alt="">--}}
{{--                                                <span class="status f-off"></span>--}}
{{--                                            </figure>--}}
{{--                                            <div class="friendz-meta">--}}
{{--                                                <a href="time-line.html">jason borne</a>--}}
{{--                                                <i><a href="#"--}}
{{--                                                      class="__cf_email__"></a></i>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <figure>--}}
{{--                                                <img src="images/resources/friend-avatar4.jpg" alt="">--}}
{{--                                                <span class="status f-off"></span>--}}
{{--                                            </figure>--}}
{{--                                            <div class="friendz-meta">--}}
{{--                                                <a href="#">Cameron diaz</a>--}}
{{--                                                <i><a href="#"--}}
{{--                                                      class="__cf_email__"></a></i>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}

{{--                                            <figure>--}}
{{--                                                <img src="images/resources/friend-avatar5.jpg" alt="">--}}
{{--                                                <span class="status f-online"></span>--}}
{{--                                            </figure>--}}
{{--                                            <div class="friendz-meta">--}}
{{--                                                <a href="time-line.html">daniel warber</a>--}}
{{--                                                <i><a href="#"--}}
{{--                                                      class="__cf_email__"></a></i>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}

{{--                                            <figure>--}}
{{--                                                <img src="images/resources/friend-avatar6.jpg" alt="">--}}
{{--                                                <span class="status f-away"></span>--}}
{{--                                            </figure>--}}
{{--                                            <div class="friendz-meta">--}}
{{--                                                <a href="time-line.html">andrew</a>--}}
{{--                                                <i><a href="#"--}}
{{--                                                      class="__cf_email__"></a></i>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}

{{--                                            <figure>--}}
{{--                                                <img src="images/resources/friend-avatar7.jpg" alt="">--}}
{{--                                                <span class="status f-off"></span>--}}
{{--                                            </figure>--}}
{{--                                            <div class="friendz-meta">--}}
{{--                                                <a href="time-line.html">amy watson</a>--}}
{{--                                                <i><a href="#"--}}
{{--                                                      class="__cf_email__"></a></i>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}

{{--                                            <figure>--}}
{{--                                                <img src="images/resources/friend-avatar5.jpg" alt="">--}}
{{--                                                <span class="status f-online"></span>--}}
{{--                                            </figure>--}}
{{--                                            <div class="friendz-meta">--}}
{{--                                                <a href="time-line.html">daniel warber</a>--}}
{{--                                                <i><a href="#"--}}
{{--                                                      class="__cf_email__"></a></i>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}

{{--                                            <figure>--}}
{{--                                                <img src="images/resources/friend-avatar2.jpg" alt="">--}}
{{--                                                <span class="status f-away"></span>--}}
{{--                                            </figure>--}}
{{--                                            <div class="friendz-meta">--}}
{{--                                                <a href="time-line.html">Sarah Loren</a>--}}
{{--                                                <i><a href="#"--}}
{{--                                                      class="__cf_email__"></a></i>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
                                    </ul>
                                    <div class="chat-box">
                                        <div class="chat-head">
                                            <span class="status f-online"></span>
                                            <h6>Bucky Barnes</h6>
                                            <div class="more">
                                                <span><i class="ti-more-alt"></i></span>
                                                <span class="close-mesage"><i class="ti-close"></i></span>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <ul>
                                                <li class="me">
                                                    <div class="chat-thumb"><img
                                                            src={{asset("images/resources/chatlist1.jpg")}} alt=""></div>
                                                    <div class="notification-event">
																<span class="chat-message-item">
																	Hi James! Please remember to buy the food for
																	tomorrow! I’m gonna be handling the
																	gifts and Jake’s gonna get the drinks
																</span>
                                                        <span class="notification-date"><time
                                                                datetime="2004-07-24T18:18"
                                                                class="entry-date updated">Yesterday at
																		8:10pm</time></span>
                                                    </div>
                                                </li>
                                                <li class="you">
                                                    <div class="chat-thumb"><img
                                                            src={{asset("images/resources/chatlist2.jpg")}} alt=""></div>
                                                    <div class="notification-event">
																<span class="chat-message-item">
																	Hi James! Please remember to buy the food for
																	tomorrow! I’m gonna be handling the
																	gifts and Jake’s gonna get the drinks
																</span>
                                                        <span class="notification-date"><time
                                                                datetime="2004-07-24T18:18"
                                                                class="entry-date updated">Yesterday at
																		8:10pm</time></span>
                                                    </div>
                                                </li>
                                                <li class="me">
                                                    <div class="chat-thumb"><img
                                                            src={{asset("images/resources/chatlist1.jpg")}} alt=""></div>
                                                    <div class="notification-event">
																<span class="chat-message-item">
																	Hi James! Please remember to buy the food for
																	tomorrow! I’m gonna be handling the
																	gifts and Jake’s gonna get the drinks
																</span>
                                                        <span class="notification-date"><time
                                                                datetime="2004-07-24T18:18"
                                                                class="entry-date updated">Yesterday at
																		8:10pm</time></span>
                                                    </div>
                                                </li>
                                            </ul>
                                            <form class="text-box">
                                                <textarea placeholder="Post enter to post..."></textarea>
                                                <div class="add-smiles">
                                                    <span title="add icon" class="em em-expressionless"></span>
                                                </div>
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
                                                <button type="submit"></button>
                                            </form>
                                        </div>
                                    </div>
                                </div><!-- friends list sidebar -->
                            </aside>
                        </div><!-- sidebar -->
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
