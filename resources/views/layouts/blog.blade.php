@include('components.head')
@include('components.header')

<main class="blog-page">
    <section class="blog-header">
        <div class="container">
            <h1>BLOG</h1>
            @if(isset($selectedTag) && !empty($selectedTag))
            <div class="active-filter">
                <span>Showing posts tagged with: <strong>{{ $selectedTag }}</strong></span>
                <a href="{{ route('blog.index', request()->except('tag', 'page')) }}" class="clear-filter">Clear filter</a>
            </div>
            @endif
        </div>
    </section>
    
    <section class="blog-content">
        @if(isset($allowedPerPage) && isset($perPage))
        <div class="container">
            <div class="blog-controls">
                @if(isset($allTags) && count($allTags) > 0)
                <div class="tag-filter">
                    <form action="{{ route('blog.index') }}" method="GET" id="tagFilterForm">
                        <label for="tag">Filter by tag:</label>
                        <select name="tag" id="tag" onchange="document.getElementById('tagFilterForm').submit()">
                            <option value="">All posts</option>
                            @foreach($allTags as $tag)
                                <option value="{{ $tag }}" {{ isset($selectedTag) && $selectedTag == $tag ? 'selected' : '' }}>
                                    {{ $tag }}
                                </option>
                            @endforeach
                        </select>
                        @if(request()->has('per_page'))
                            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                        @endif
                    </form>
                </div>
                @endif
                
                <div class="per-page-selector">
                    <form action="{{ route('blog.index') }}" method="GET" id="perPageForm">
                        <label for="per_page">Show:</label>
                        <select name="per_page" id="per_page" onchange="document.getElementById('perPageForm').submit()">
                            @foreach($allowedPerPage as $value)
                                <option value="{{ $value }}" {{ $perPage == $value ? 'selected' : '' }}>
                                    {{ $value }} posts
                                </option>
                            @endforeach
                        </select>
                        @if(request()->has('tag'))
                            <input type="hidden" name="tag" value="{{ request('tag') }}">
                        @endif
                    </form>
                </div>
            </div>
        </div>
        @endif
        
        <div class="blog-grid">
            @yield('content')
        </div>
        
        @hasSection('pagination')
            <div class="container">
                @yield('pagination')
            </div>
        @endif
    </section>
</main>

@include('components.footer')
@include('components.foot')
@stack('scripts') 