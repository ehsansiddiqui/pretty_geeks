@extends('master')

@section('content')


    <section>
        <div class="feature-photo">
            @if(is_null($User->cover_avatar))
                <figure><img src="{{asset('images/resources/default-cover.png')}}" alt=""></figure>
            @else
                <figure><img id="cover-image" src="{{Storage::url("public/".$User->cover_avatar)}}" alt=""></figure>

            @endif
{{--            @dd($check)--}}
                @if($check =='not_friend' and \Illuminate\Support\Facades\Auth::user()->id !=$User->id)
                    <div class="add-btn">
                        {{--                            <span>1205 followers</span>--}}
                        <a href="#" title="" data-ripple="">Add Friend</a>
                    </div>
                @endif
{{--            <form class="edit-phto">--}}
{{--                <i class="fa fa-camera-retro"></i>--}}
{{--                <label class="fileContainer">--}}
{{--                    Edit Cover Photo--}}
{{--                    <input type="file" id="cover-picture"/>--}}
{{--                </label>--}}
{{--            </form>--}}
            <div class="container-fluid">
                <div class="row merged">
                    <div class="col-lg-2 col-sm-3">
                        <div class="user-avatar">
                            @if(is_null($User->avatar))
                                <figure>
                                    <img src="{{asset('images/resources/user.jpg')}}" alt="">
{{--                                    <form class="edit-phto">--}}
{{--                                        <i class="fa fa-camera-retro"></i>--}}
{{--                                        <label class="fileContainer">--}}
{{--                                            Edit Display Photo--}}
{{--                                            <input type="file"/>--}}
{{--                                        </label>--}}
{{--                                    </form>--}}
                                </figure>
                            @else
                                <figure>
                                    <img id="dp-image" src="{{Storage::url("public/".$User->avatar)}}" alt="">
{{--                                    <form class="edit-phto" method="post" enctype="multipart/form-data" >--}}
{{--                                        <i class="fa fa-camera-retro"></i>--}}
{{--                                        <label class="fileContainer">--}}
{{--                                            Edit Display Photo--}}
{{--                                            <input type="file" id="dp-picture"/>--}}
{{--                                        </label>--}}
{{--                                    </form>--}}
                                </figure>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-10 col-sm-9">
                        <div class="timeline-info">
                            <ul>
                                <li class="admin-name">
                                    <h5>{{$User->name}}</h5>
                                    <span>Group Admin</span>
                                </li>
                                <li>
                                    <a class="" href="{{route('profile',encrypt($User->id))}}" title="" data-ripple="">time line</a>
                                    <a class="active" href="{{route('timelinephotos')}}" title="" data-ripple="">Photos</a>
                                    <a class="" href="{{route('profilevideos',encrypt($User->id))}}" title="" data-ripple="">Videos</a>
                                    <a class="" href="{{route('profilefriends',encrypt($User->id))}}" title="" data-ripple="">Friends</a>
                                    <a class="" href="timeline-groups.html" title="" data-ripple="">Groups</a>
                                    <a class="" href="{{route('profileabout',encrypt($User->id))}}" title="" data-ripple="">about</a>
                                    <a class="" href="#" title="" data-ripple="">more</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- top area -->

    <section>
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


                                </aside>
                            </div><!-- sidebar -->
                            <div class="col-lg-6">
                                <div class="central-meta">
                                    <ul class="photos">
                                        @foreach($posts as $post)

                                            <li>
                                                @foreach((new App\Models\Post)->returnImages($post->id) as $index => $image)
                                                    <a class="strip" href="{{Storage::url("public/{$image->file_url}")}}" title="" data-strip-group="mygroup" data-strip-group-options="loop: false">
                                                        <img src="{{Storage::url("public/{$image->file_url}")}}" alt=""></a>
                                                @endforeach
                                            </li>

                                        @endforeach
                                        {{--                                    <li>--}}
                                        {{--                                        <a class="strip" href="images/resources/photo-66.jpg" title="" data-strip-group="mygroup" data-strip-group-options="loop: false">--}}
                                        {{--                                            <img src="images/resources/photo6.jpg" alt=""></a>--}}
                                        {{--                                    </li>--}}
                                        {{--                                    <li>--}}
                                        {{--                                        <a class="strip" href="images/resources/photo-77.jpg" title="" data-strip-group="mygroup" data-strip-group-options="loop: false">--}}
                                        {{--                                            <img src="images/resources/photo7.jpg" alt=""></a>--}}
                                        {{--                                    </li>--}}
                                        {{--                                    <li>--}}
                                        {{--                                        <a class="strip" href="images/resources/photo-88.jpg" title="" data-strip-group="mygroup" data-strip-group-options="loop: false">--}}
                                        {{--                                            <img src="images/resources/photo8.jpg" alt=""></a>--}}
                                        {{--                                    </li>--}}

                                        {{--                                    <li>--}}
                                        {{--                                        <a class="strip" href="images/resources/photo-99.jpg" title="" data-strip-group="mygroup" data-strip-group-options="loop: false">--}}
                                        {{--                                            <img src="images/resources/photo12.jpg" alt=""></a>--}}
                                        {{--                                    </li>--}}
                                        {{--                                    <li>--}}
                                        {{--                                        <a class="strip" href="images/resources/photo-101.jpg" title="" data-strip-group="mygroup" data-strip-group-options="loop: false">--}}
                                        {{--                                            <img src="images/resources/photo10.jpg" alt=""></a>--}}
                                        {{--                                    </li>--}}
                                        {{--                                    <li>--}}
                                        {{--                                        <a class="strip" href="images/resources/photo-101.jpg" title="" data-strip-group="mygroup" data-strip-group-options="loop: false">--}}
                                        {{--                                            <img src="images/resources/photo11.jpg" alt=""></a>--}}
                                        {{--                                    </li>--}}
                                        {{--                                    <li>--}}
                                        {{--                                        <a class="strip" href="images/resources/photo-22.jpg" title="" data-strip-group="mygroup" data-strip-group-options="loop: false">--}}
                                        {{--                                            <img src="images/resources/photo1.jpg" alt=""></a>--}}
                                        {{--                                    </li>--}}
                                        {{--                                    <li>--}}
                                        {{--                                        <a class="strip" href="images/resources/photo-33.jpg" title="" data-strip-group="mygroup" data-strip-group-options="loop: false">--}}
                                        {{--                                            <img src="images/resources/photo9.jpg" alt=""></a>--}}
                                        {{--                                    </li>--}}
                                        {{--                                    <li>--}}
                                        {{--                                        <a class="strip" href="images/resources/photo-99.jpg" title="" data-strip-group="mygroup" data-strip-group-options="loop: false">--}}
                                        {{--                                            <img src="images/resources/photo12.jpg" alt=""></a>--}}
                                        {{--                                    </li>--}}
                                        {{--                                    <li>--}}
                                        {{--                                        <a class="strip" href="images/resources/photo-66.jpg" title="" data-strip-group="mygroup" data-strip-group-options="loop: false">--}}
                                        {{--                                            <img src="images/resources/photo6.jpg" alt=""></a>--}}
                                        {{--                                    </li>--}}
                                        {{--                                    <li>--}}
                                        {{--                                        <a class="strip" href="images/resources/photo-66.jpg" title="" data-strip-group="mygroup" data-strip-group-options="loop: false">--}}
                                        {{--                                            <img src="images/resources/photo13.jpg" alt=""></a>--}}
                                        {{--                                    </li>--}}
                                    </ul>
                                    <div class="lodmore"><button class="btn-view btn-load-more"></button></div>
                                </div><!-- photos -->
                            </div><!-- centerl meta -->
                            <div class="col-lg-3">
                                <aside class="sidebar static">
                                    <div class="widget">
                                        <h4 class="widget-title">Twitter feed</h4>
                                        <ul class="twiter-feed">
                                            <li>
                                                <i class="fa fa-twitter"></i>
                                                <span>
													<i>jhon william</i>
													@jhonwilliam
												</span>
                                                <p>tomorrow with the company we were working and 5 child run away from the working place. <a href="#" title="">#daydream5k</a> </p>
                                                <em>2 hours ago</em>
                                            </li>
                                            <li>
                                                <i class="fa fa-twitter"></i>
                                                <span>
													<i>Kelly watson</i>
													@kelly
												</span>
                                                <p>tomorrow with the company we were working and 5 child run away from the working place. <a href="#" title="">#daydream5k</a> </p>
                                                <em>2 hours ago</em>
                                            </li>
                                            <li>
                                                <i class="fa fa-twitter"></i>
                                                <span>
													<i>Jony bravo</i>
													@jonibravo
												</span>
                                                <p>tomorrow with the company we were working and 5 child run away from the working place. <a href="#" title="">#daydream5k</a> </p>
                                                <em>2 hours ago</em>
                                            </li>
                                        </ul>
                                    </div><!-- twitter feed-->
                                    <div class="widget friend-list stick-widget">
                                        <h4 class="widget-title">Friends</h4>
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
                                            {{--                                                <a href="time-line.html">Sarah Loren</a>--}}
                                            {{--                                                <i><a href="#" class="__cf_email__"></a></i>--}}
                                            {{--                                            </div>--}}
                                            {{--                                        </li>--}}
                                            {{--                                        <li>--}}
                                            {{--                                            <figure>--}}
                                            {{--                                                <img src="images/resources/friend-avatar3.jpg" alt="">--}}
                                            {{--                                                <span class="status f-off"></span>--}}
                                            {{--                                            </figure>--}}
                                            {{--                                            <div class="friendz-meta">--}}
                                            {{--                                                <a href="time-line.html">jason borne</a>--}}
                                            {{--                                                <i><a href="#" class="__cf_email__"></a></i>--}}
                                            {{--                                            </div>--}}
                                            {{--                                        </li>--}}
                                            {{--                                        <li>--}}
                                            {{--                                            <figure>--}}
                                            {{--                                                <img src="images/resources/friend-avatar4.jpg" alt="">--}}
                                            {{--                                                <span class="status f-off"></span>--}}
                                            {{--                                            </figure>--}}
                                            {{--                                            <div class="friendz-meta">--}}
                                            {{--                                                <a href="time-line.html">Cameron diaz</a>--}}
                                            {{--                                                <i><a href="#" class="__cf_email__"></a></i>--}}
                                            {{--                                            </div>--}}
                                            {{--                                        </li>--}}
                                            {{--                                        <li>--}}

                                            {{--                                            <figure>--}}
                                            {{--                                                <img src="images/resources/friend-avatar5.jpg" alt="">--}}
                                            {{--                                                <span class="status f-online"></span>--}}
                                            {{--                                            </figure>--}}
                                            {{--                                            <div class="friendz-meta">--}}
                                            {{--                                                <a href="time-line.html">daniel warber</a>--}}
                                            {{--                                                <i><a href="#" class="__cf_email__"></a></i>--}}
                                            {{--                                            </div>--}}
                                            {{--                                        </li>--}}
                                            {{--                                        <li>--}}

                                            {{--                                            <figure>--}}
                                            {{--                                                <img src="images/resources/friend-avatar6.jpg" alt="">--}}
                                            {{--                                                <span class="status f-away"></span>--}}
                                            {{--                                            </figure>--}}
                                            {{--                                            <div class="friendz-meta">--}}
                                            {{--                                                <a href="time-line.html">andrew</a>--}}
                                            {{--                                                <i><a href="#" class="__cf_email__"></a></i>--}}
                                            {{--                                            </div>--}}
                                            {{--                                        </li>--}}
                                            {{--                                        <li>--}}

                                            {{--                                            <figure>--}}
                                            {{--                                                <img src="images/resources/friend-avatar7.jpg" alt="">--}}
                                            {{--                                                <span class="status f-off"></span>--}}
                                            {{--                                            </figure>--}}
                                            {{--                                            <div class="friendz-meta">--}}
                                            {{--                                                <a href="time-line.html">amy watson</a>--}}
                                            {{--                                                <i><a href="#" class="__cf_email__"></a></i>--}}
                                            {{--                                            </div>--}}
                                            {{--                                        </li>--}}
                                            {{--                                        <li>--}}

                                            {{--                                            <figure>--}}
                                            {{--                                                <img src="images/resources/friend-avatar5.jpg" alt="">--}}
                                            {{--                                                <span class="status f-online"></span>--}}
                                            {{--                                            </figure>--}}
                                            {{--                                            <div class="friendz-meta">--}}
                                            {{--                                                <a href="time-line.html">daniel warber</a>--}}
                                            {{--                                                <i><a href="#" class="__cf_email__"></a></i>--}}
                                            {{--                                            </div>--}}
                                            {{--                                        </li>--}}
                                            {{--                                        <li>--}}

                                            {{--                                            <figure>--}}
                                            {{--                                                <img src="images/resources/friend-avatar2.jpg" alt="">--}}
                                            {{--                                                <span class="status f-away"></span>--}}
                                            {{--                                            </figure>--}}
                                            {{--                                            <div class="friendz-meta">--}}
                                            {{--                                                <a href="time-line.html">Sarah Loren</a>--}}
                                            {{--                                                <i><a href="#" class="__cf_email__"></a></i>--}}
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
                                                        <div class="chat-thumb"><img src={{asset("images/resources/chatlist1.jpg")}} alt=""></div>
                                                        <div class="notification-event">
															<span class="chat-message-item">
																Hi James! Please remember to buy the food for tomorrow! I’m gonna be handling the gifts and Jake’s gonna get the drinks
															</span>
                                                            <span class="notification-date"><time datetime="2004-07-24T18:18" class="entry-date updated">Yesterday at 8:10pm</time></span>
                                                        </div>
                                                    </li>
                                                    <li class="you">
                                                        <div class="chat-thumb"><img src={{asset("images/resources/chatlist2.jpg")}} alt=""></div>
                                                        <div class="notification-event">
															<span class="chat-message-item">
																Hi James! Please remember to buy the food for tomorrow! I’m gonna be handling the gifts and Jake’s gonna get the drinks
															</span>
                                                            <span class="notification-date"><time datetime="2004-07-24T18:18" class="entry-date updated">Yesterday at 8:10pm</time></span>
                                                        </div>
                                                    </li>
                                                    <li class="me">
                                                        <div class="chat-thumb"><img src={{asset("images/resources/chatlist1.jpg")}} alt=""></div>
                                                        <div class="notification-event">
															<span class="chat-message-item">
																Hi James! Please remember to buy the food for tomorrow! I’m gonna be handling the gifts and Jake’s gonna get the drinks
															</span>
                                                            <span class="notification-date"><time datetime="2004-07-24T18:18" class="entry-date updated">Yesterday at 8:10pm</time></span>
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
    </section>
@endsection
