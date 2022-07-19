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
                                        <li>
                                            <div class="activity-meta">
                                                <i>10 hours Ago</i>
                                                <span><a href="#" title="">Commented on Video posted </a></span>
                                                <h6>by <a href="#">black demon.</a></h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="activity-meta">
                                                <i>30 Days Ago</i>
                                                <span><a href="#" title="">Posted your status. “Hello guys, how
																are you?”</a></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="activity-meta">
                                                <i>2 Years Ago</i>
                                                <span><a href="#" title="">Share a video on her
																timeline.</a></span>
                                                <h6>"<a href="#">you are so funny mr.been.</a>"</h6>
                                            </div>
                                        </li>
                                    </ul>
                                </div><!-- recent activites -->
                                <div class="widget stick-widget">
                                    <h4 class="widget-title">Who's following</h4>
                                    <ul class="followers">
                                        @foreach($friend_requests as $friend_request)
                                            <li>
                                                <figure><img src={{asset("images/resources/friend-avatar2.jpg")}} alt="">
                                                </figure>
                                                <div class="friend-meta">
                                                    <h4><a href="#" title="">{{$friend_request->name}}</a></h4>
                                                    <a href="" id="friendrequesttext_{{$friend_request->id}}"  title="" onclick="friendrequest({{$friend_request}}, event)" class="underline">Add Friend</a>
                                                </div>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div><!-- who's following -->
                            </aside>
                        </div><!-- sidebar -->
                        <div class="col-lg-6">
                           <!-- add post new box -->
                            <div class="loadMore">
{{--                                @for ($i = 0; $i < count($posts); $i++)--}}
                                    <div class="central-meta item">

                                        <div class="user-post">

                                            <div class="friend-info">

                                                <figure>
                                                    <img src={{asset("images/resources/friend-avatar10.jpg")}} alt="">
                                                </figure>
                                                <div class="friend-name">
                                                    <ins><a href="#" title="">{{(new App\Models\User)->getusers($post->user_id)}}</a></ins>
                                                    <span>published: june,2 2018 19:PM</span>
                                                </div>
                                                <div class="post-meta">
{{--                                                                                                    <img src="images/resources/user-post.jpg" alt="">--}}
                                                    <div class="container">
                                                        <div class="row">
                                                            @foreach((new App\Models\Post)->returnImages($post->id) as $index => $image)


                                                                {{--                                                            {{dd($index)}}--}}
                                                                <div class="col"  style="margin: 1px; padding-right: 0px;
    padding-left: 3px;">
                                                                    <img src="{{Storage::url("public/{$image->file_url}")}}" alt="">
                                                                    {{--                                                            <img src="{{ storage_path('app/images/1606216903_1.JPG') }}" style="width: 100%; height: 100%;">--}}
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
{{--                                                                        @dd({{(new App\Models\PostComment)->countcomments($post->id)}})--}}
																		<ins>{{(new App\Models\PostComment)->countcomments($post->id)}}</ins>
																	</span>
                                                            </li>
                                                            <li onclick="postlike({{$post->id}},event)">
																	<span class="like" data-toggle="tooltip"
                                                                          title="like">
																		<i id="likethumb" class="ti-thumb-up"></i>
																		<ins id="likecounter_{{$post->id}}">{{(new App\Models\PostLike)->countlikes($post->id)}}</ins>
																	</span>
                                                            </li>
                                                            <li onclick="postdislike({{$post->id}},event)">
																	<span class="dislike" data-toggle="tooltip"
                                                                          title="dislike">
																		<i id="dislikethumb" class="ti-thumb-down"></i>
																		<ins id="dislikecounter_{{$post->id}}">{{(new App\Models\DisLike)->countdislikes($post->id)}}</ins>
																	</span>
                                                            </li>
                                                            <li class="social-media">
                                                                <div class="menu">
                                                                    <div class="btn trigger"><i
                                                                            class="fa fa-share-alt"></i></div>

                                                                    <div class="rotater">
                                                                        <div class="btn btn-icon"><a href="https://www.facebook.com/sharer/sharer.php?u=http://{{ urlencode($_SERVER['HTTP_HOST']) }}{{ urlencode($_SERVER['REQUEST_URI']) }}"
                                                                                                     target="_blank"
                                                                                                     title=""><i
                                                                                    class="fa fa-facebook"></i></a>
                                                                        </div>
                                                                    </div>

                                                                                                                                    <div class="rotater">
                                                                                                                                        <div class="btn btn-icon"><a href="https://twitter.com/intent/tweet?url=http://{{ urlencode($_SERVER['HTTP_HOST']) }}{{ urlencode($_SERVER['REQUEST_URI']) }}"
                                                                                target="_blank"
                                                                                                                                                                     title=""><i
                                                                                                                                                    class="fa fa-twitter"></i></a>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                    <div class="rotater">
                                                                        <div class="btn btn-icon"><a onclick="sharepage({{(new App\Models\Post)->returnImages($post->id)}},{{$post}},event)"
                                                                                                     title=""><i
                                                                                    class="fa fa-share-alt"></i></a>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="description">

                                                        <p>
                                                            {{$post->description}}
                                                        </p>
                                                    </div>

                                                    {{--                                                @endforeach--}}
                                                </div>
                                            </div>
                                            <div class="coment-area" >
                                                <ul class="we-comet" id="">

                                                    @foreach($comments as $comment)
{{--                                                                                                            @dd($comment->commentable_id)--}}
{{--                                                      @dd($post->id)--}}
                                                        @if($post->id == $comment->commentable_id)
                                                            <li>
                                                                <div class="comet-avatar">
                                                                    <img src={{asset("images/resources/comet-1.jpg")}} alt="">
                                                                </div>
                                                                <div class="we-comment">
                                                                    <div class="coment-head">
{{--                                                                                                                                    <h5><a href="#" title="">{{$comment->user()}}</a></h5>--}}
                                                                        <h5><a href="#" title="">{{(new App\Models\User)->getusers($comment->user_id)}}</a></h5>

                                                                        <span>1 week ago</span>
                                                                        <a class="we-reply" id="" onclick="replybutton({{$comment->id}},event)" title="Reply"><i
                                                                                class="fa fa-reply"></i></a>
                                                                    </div>
                                                                    <p>{{$comment->comment}}
                                                                        <i class="em em-smiley"></i>
                                                                    </p>
                                                                </div>
{{--                                                                                                                    @dd($replies)--}}
                                                                @foreach($replies as $reply)
                                                                    @if($reply->parent_id == $comment->id)
                                                                        <ul>
                                                                            <li>
                                                                                <div class="comet-avatar">
                                                                                    <img src={{asset("images/resources/comet-2.jpg")}} alt="">
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
                                                                            <textarea id="reply_{{ $comment->id }}" name="comment" placeholder="Post your comment" onkeyup="postreply({{$comment->id}},{{$comment->user_id}},{{ $post->id }},event)"></textarea>
                                                                            <div class="add-smiles">
                                                                                <span class="em em-expressionless" title="add icon"></span>
                                                                            </div>
                                                                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
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
                                                        <a href="#" title="" class="showmore underline" id="commentsdiv_{{$post->id}}">more
                                                            comments</a>
                                                    </li>
                                                    <li class="post-comment">
                                                        <div class="comet-avatar">
                                                            <img src={{asset("images/resources/comet-1.jpg")}} alt="">
                                                        </div>
                                                        <div class="post-comt-box">
                                                            <form method="post">
                                                                @csrf
                                                                <textarea id="postcomment_{{ $post->id }}" name="comment"
                                                                          placeholder="Post your comment" onkeyup="postcomment({{$post->id }},event)"></textarea>
                                                                <div class="add-smiles">
																		<span class="em em-expressionless"
                                                                              title="add icon"></span>
                                                                </div>
                                                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
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
                                                                <button id="commentbutton_{{$post->id }}" type="submit"></button>
                                                            </form>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>

                                    </div>
{{--                                @endfor--}}

                            </div>
                        </div><!-- centerl meta -->
                        <div class="col-lg-3">
                            <aside class="sidebar static">
                                <div class="widget friend-list stick-widget">
                                    <h4 class="widget-title">Social Circle</h4>
                                    <div id="searchDir"></div>
                                    <ul id="people-list" class="friendz-list">
                                        <li>
                                            <figure>
                                                <img src={{asset("images/resources/friend-avatar.jpg")}} alt="">
                                                <span class="status f-online"></span>
                                            </figure>
                                            <div class="friendz-meta">
                                                <a href="#">bucky barnes</a>
                                                <i><a href="#"
                                                      class="__cf_email__"></a></i>
                                            </div>
                                        </li>
                                        <li>
                                            <figure>
                                                <img src={{asset("images/resources/friend-avatar2.jpg")}} alt="">
                                                <span class="status f-away"></span>
                                            </figure>
                                            <div class="friendz-meta">
                                                <a href="#">Sarah Loren</a>
                                                <i><a href=""
                                                      class="__cf_email__"></a></i>
                                            </div>
                                        </li>
                                        <li>
                                            <figure>
                                                <img src={{asset("images/resources/friend-avatar3.jpg")}} alt="">
                                                <span class="status f-off"></span>
                                            </figure>
                                            <div class="friendz-meta">
                                                <a href="time-line.html">jason borne</a>
                                                <i><a href="#"
                                                      class="__cf_email__"></a></i>
                                            </div>
                                        </li>
                                        <li>
                                            <figure>
                                                <img src={{asset("images/resources/friend-avatar4.jpg")}} alt="">
                                                <span class="status f-off"></span>
                                            </figure>
                                            <div class="friendz-meta">
                                                <a href="#">Cameron diaz</a>
                                                <i><a href="#"
                                                      class="__cf_email__"></a></i>
                                            </div>
                                        </li>
                                        <li>

                                            <figure>
                                                <img src={{asset("images/resources/friend-avatar5.jpg")}} alt="">
                                                <span class="status f-online"></span>
                                            </figure>
                                            <div class="friendz-meta">
                                                <a href="time-line.html">daniel warber</a>
                                                <i><a href="#"
                                                      class="__cf_email__"></a></i>
                                            </div>
                                        </li>
                                        <li>

                                            <figure>
                                                <img src={{asset("images/resources/friend-avatar6.jpg")}} alt="">
                                                <span class="status f-away"></span>
                                            </figure>
                                            <div class="friendz-meta">
                                                <a href="time-line.html">andrew</a>
                                                <i><a href="#"
                                                      class="__cf_email__"></a></i>
                                            </div>
                                        </li>
                                        <li>

                                            <figure>
                                                <img src={{asset("images/resources/friend-avatar7.jpg")}} alt="">
                                                <span class="status f-off"></span>
                                            </figure>
                                            <div class="friendz-meta">
                                                <a href="time-line.html">amy watson</a>
                                                <i><a href="#"
                                                      class="__cf_email__"></a></i>
                                            </div>
                                        </li>
                                        <li>

                                            <figure>
                                                <img src={{asset("images/resources/friend-avatar5.jpg")}} alt="">
                                                <span class="status f-online"></span>
                                            </figure>
                                            <div class="friendz-meta">
                                                <a href="time-line.html">daniel warber</a>
                                                <i><a href="#"
                                                      class="__cf_email__"></a></i>
                                            </div>
                                        </li>
                                        <li>

                                            <figure>
                                                <img src={{asset("images/resources/friend-avatar2.jpg")}} alt="">
                                                <span class="status f-away"></span>
                                            </figure>
                                            <div class="friendz-meta">
                                                <a href="time-line.html">Sarah Loren</a>
                                                <i><a href="#"
                                                      class="__cf_email__"></a></i>
                                            </div>
                                        </li>
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
