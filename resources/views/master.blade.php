<!DOCTYPE html>
<html>
@include('pages.header-links')
<body>
<div class="theme-layout">
{{--@include('pages.header')--}}
{{--    @if (\Request::is('home'))--}}
@include('pages.topbarhome')
{{--    @else--}}
{{--        @include('pages.topbartimeline')--}}
{{--    @endif--}}

<section>
    @yield('content')
</section>

    @include('pages.footer')
</div>
@include('pages.generalsetting')
@include('pages.model')
@include('pages.scripts')

</body>

</html>
