@include('components.head')
@include('components.header')

@if (Request::is('/'))
    @include('components.main.home')
@elseif (Request::is('web'))
    @include('components.main.web')
@elseif (Request::is('resume'))
    @include('components.main.resume')
@elseif (Request::is('blog'))
    @php echo "blog"; @endphp
@elseif (Request::is('tech'))
    @include('components.main.tech')
@else
    @php 
    echo "404"; 
    print_r(Request::path());
    @endphp
    @include('components.main.404')
@endif

@include('components.footer')
@include('components.foot')