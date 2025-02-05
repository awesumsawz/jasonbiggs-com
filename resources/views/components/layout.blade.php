@include('components.head')
@include('components.header')

@if (Request::is('/'))
    @include('components.main.home')
@elseif (Request::is('/web'))
    @include('components.main.web')
@elseif (Request::is('/resume'))
    @include('components.main.resume')
@elseif (Request::is('/blog'))
    @include('components.main.blog')
@else
    @include('components.main.404')
@endif

@include('components.footer')
@include('components.foot')