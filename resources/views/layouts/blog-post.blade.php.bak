@include('components.head')
@include('components.header')

<main class="blog-post-page">
    <div class="breadcrumbs">
        <div class="container">
            @include('components.breadcrumbs', ['title' => $__env->yieldContent('title')])
        </div>
    </div>
    
    <article class="blog-post">
        <div class="container">
            <header class="post-header">
                <h1 class="post-title">@yield('title')</h1>
                <div class="post-meta">
                    @if(View::hasSection('date'))
                        <span class="post-date">@yield('date')</span>
                    @endif
                    
                    @if(View::hasSection('tags'))
                        <div class="post-tags">
                            @yield('tags')
                        </div>
                    @endif
                </div>
            </header>
            
            @php
                $image = $__env->yieldContent('image');
            @endphp
            
            @if(!empty($image))
            <div class="post-featured-image">
                <img src="{{ $image }}" alt="@yield('title')">
            </div>
            @endif
            
            <div class="post-content">
                @yield('content')
            </div>
            
            <footer class="post-footer">
                <div class="post-navigation">
                    @yield('navigation')
                </div>
                
                @if(View::hasSection('share'))
                    <div class="post-share">
                        @yield('share')
                    </div>
                @endif
            </footer>
        </div>
    </article>
</main>

@include('components.footer')
@include('components.foot') 