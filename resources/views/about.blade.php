@extends('master')

@section('content')

<section>
    <div class="feature-photo">
        @if(is_null( \Illuminate\Support\Facades\Auth::user()->cover_avatar))
            <figure><img src="images/resources/timeline-1.jpg" alt=""></figure>
        @else
            <figure><img id="cover-image" src="{{Storage::url("public/".\Illuminate\Support\Facades\Auth::user()->cover_avatar)}}" alt=""></figure>

        @endif
        <div class="add-btn">
{{--            <span>1205 followers</span>--}}
{{--            <a href="#" title="" data-ripple="">Add Friend</a>--}}
        </div>
        <form class="edit-phto">
            <i class="fa fa-camera-retro"></i>
            <label class="fileContainer">
                Edit Cover Photo
                <input type="file" id="cover-picture"/>
            </label>
        </form>
        <div class="container-fluid">
            <div class="row merged">
                <div class="col-lg-2 col-sm-3">
                    <div class="user-avatar">
                        @if(is_null( \Illuminate\Support\Facades\Auth::user()->avatar))
                            <figure>
                                <img src="images/resources/user-avatar.jpg" alt="">
                                <form class="edit-phto">
                                    <i class="fa fa-camera-retro"></i>
                                    <label class="fileContainer">
                                        Edit Display Photo
                                        <input type="file"/>
                                    </label>
                                </form>
                            </figure>
                        @else
                            <figure>
                                <img id="dp-image" src="{{Storage::url("public/".\Illuminate\Support\Facades\Auth::user()->avatar)}}" alt="">
                                <form class="edit-phto" method="post" enctype="multipart/form-data" >
                                    <i class="fa fa-camera-retro"></i>
                                    <label class="fileContainer">
                                        Edit Display Photo
                                        <input type="file" id="dp-picture"/>
                                    </label>
                                </form>
                            </figure>
                        @endif
                    </div>
                </div>
                <div class="col-lg-10 col-sm-9">
                    <div class="timeline-info">
                        <ul>
                            <li class="admin-name">
                                <h5>{{\Illuminate\Support\Facades\Auth::user()->name}}</h5>
                                <span>Group Admin</span>
                            </li>
                            <li>
                                <a class="" href="{{route('timeline')}}" title="" data-ripple="">time line</a>
                                <a class="" href="{{route('timelinephotos')}}" title="" data-ripple="">Photos</a>
                                <a class="" href="{{route('timelinevideos')}}" title="" data-ripple="">Videos</a>
                                <a class="" href="{{route('timelinefriends')}}" title="" data-ripple="">Friends</a>
                                <a class="" href="timeline-groups.html" title="" data-ripple="">Groups</a>
                                <a class="active" href="{{route('about')}}" title="" data-ripple="">about</a>
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
                                    <h4 class="widget-title">Edit info</h4>
                                    <ul class="naves">
                                        <li>
                                            <i class="ti-info-alt"></i>
                                            <a title="" href="#">Basic info</a>
                                        </li>
                                        <li>
                                            <i class="ti-mouse-alt"></i>
                                            <a title="" href="#">Education &amp; Work</a>
                                        </li>
                                        <li>
                                            <i class="ti-heart"></i>
                                            <a title="" href="#">My interests</a>
                                        </li>
                                        <li>
                                            <i class="ti-settings"></i>
                                            <a title="" href="#">account setting</a>
                                        </li>
                                        <li>
                                            <i class="ti-lock"></i>
                                            <a title="" href="#">change password</a>
                                        </li>
                                    </ul>
                                </div>
                            </aside>
                        </div><!-- sidebar -->
                        <div class="col-lg-6">
                            <div class="central-meta">
                                <div class="about">
                                    <div class="personal">
                                        <h5 class="f-title"><i class="ti-info-alt"></i> Personal Info</h5>
                                    </div>
                                    <div class="d-flex flex-row mt-2">
                                        <ul class="nav nav-tabs nav-tabs--vertical nav-tabs--left" >
                                            <li class="nav-item">
                                                <a href="#basic" class="nav-link active" data-toggle="tab" >Basic info</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#location" class="nav-link" data-toggle="tab" >location</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#work" class="nav-link" data-toggle="tab" >work and education</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#interest" class="nav-link" data-toggle="tab"  >interests</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#lang" class="nav-link" data-toggle="tab" >languages</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="basic" >
                                                <ul class="basics">
                                                    <li><i class="ti-user"></i>{{\Illuminate\Support\Facades\Auth::user()->name}}</li>
                                                    <li><i class="ti-map-alt"></i>live in Dubai</li>
                                                    <li><i class="ti-mobile"></i>{{\Illuminate\Support\Facades\Auth::user()->mobile_number}}</li>
                                                    <li><i class="ti-email"></i>{{\Illuminate\Support\Facades\Auth::user()->email}}</li>
{{--                                                    <li><i class="ti-email"></i><a href="https://wpkixx.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="84fdebf1f6e9e5ede8c4e1e9e5ede8aae7ebe9">[email&#160;protected]</a></li>--}}

                                                    <li><i class="ti-world"></i>www.yoursite.com</li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="location" role="tabpanel">
                                                <div class="location-map">
                                                    <div id="map-canvas"></div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="work" role="tabpanel">
                                                <div>

                                                    <a href="#" title="">{{\Illuminate\Support\Facades\Auth::user()->company_name}}</a>
                                                    <p>work as {{\Illuminate\Support\Facades\Auth::user()->profession}} in {{\Illuminate\Support\Facades\Auth::user()->company_name}} from {{date('Y', strtotime(\Illuminate\Support\Facades\Auth::user()->profession_start_date))}}</p>
                                                    <ul class="education">
                                                        <li><i class="ti-facebook"></i> {{\Illuminate\Support\Facades\Auth::user()->education}} from {{\Illuminate\Support\Facades\Auth::user()->university_name}}</li>
{{--                                                        <li><i class="ti-twitter"></i> MSCS from Harvard Unversity</li>--}}
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="interest" role="tabpanel">
                                                <ul class="basics">
                                                    <li>Footbal</li>
                                                    <li>internet</li>
                                                    <li>photography</li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="lang" role="tabpanel">
                                                <ul class="basics">
                                                    <li>english</li>
                                                    <li>french</li>
                                                    <li>spanish</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <p style="margin-top: 20px;">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                    </p>
                                </div>
                            </div>
                        </div><!-- centerl meta -->
                        <div class="col-lg-3">
                            <aside class="sidebar static">

                                <div class="widget stick-widget">
                                    <h4 class="widget-title">Who's follownig</h4>
                                    <ul class="followers">
                                        @foreach($friend_requests as $friend_request)
                                            {{--                                                @dd($friend_request)--}}

                                            <li>
                                                @if(is_null($friend_request->avatar))
                                                    <figure><img src={{asset("images/resources/user.jpg")}} alt="">
                                                    </figure>
                                                @else
                                                    <figure><img src="{{Storage::url("public/{$friend_request->avatar}")}}" alt="">
                                                    </figure>
                                                @endif
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
