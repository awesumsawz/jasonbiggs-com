@extends('layouts.blog-post')

@section('title', $post['metadata']['title'])

@section('content')
<article class="blog-post">
    <div class="back-link">
        <a href="{{ route('blog.index') }}" class="back-to-posts">
            <span class="back-arrow">&larr;</span>
            <span class="back-text">Back to all posts</span>
        </a>
    </div>

    <header class="post-header">
        <h1 class="post-title">{{ $post['metadata']['title'] }}</h1>

        @if(isset($post['metadata']['tags']) && is_array($post['metadata']['tags']) && count($post['metadata']['tags']) > 0)
            <div class="post-tags">
                <div class="tags-wrapper">
                    @foreach($post['metadata']['tags'] as $tag)
                        <a href="{{ route('blog.index', ['tag' => $tag]) }}" class="tag-badge">
                            {{ $tag }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="post-meta">
            <span class="post-date">{{ $post['metadata']['formatted_date'] ?? date('F j, Y', strtotime($post['metadata']['date'])) }}</span>
            <span class="reading-time">• {{ $post['metadata']['reading_time'] }} min read</span>
        </div>
    </header>

    @if(isset($post['metadata']['featured_image']))
        <div class="post-featured-image">
            <img src="{{ $post['metadata']['featured_image'] }}" alt="{{ $post['metadata']['title'] }}">
        </div>
    @else
        <hr>
    @endif

    <div class="post-content">
        {!! $post['content'] !!}
    </div>

    <div class="post-footer">
        <hr class="my-8 border-light-gray dark:border-gray">
        <div class="post-navigation">
            @if(isset($previousPost))
                <a href="{{ route('blog.show', $previousPost['slug']) }}" class="previous-post">
                    <div class="nav-header">
                        <span class="nav-arrow">&larr;</span>
                        <span class="nav-label">Previous Post</span>
                    </div>
                    <span class="nav-title">{{ $previousPost['metadata']['title'] }}</span>
                </a>
            @else
                <div class="nav-placeholder"></div>
            @endif

            @if(isset($nextPost))
                <a href="{{ route('blog.show', $nextPost['slug']) }}" class="next-post">
                    <div class="nav-header">
                        <span class="nav-label">Next Post</span>
                        <span class="nav-arrow">&rarr;</span>
                    </div>
                    <span class="nav-title">{{ $nextPost['metadata']['title'] }}</span>
                </a>
            @else
                <div class="nav-placeholder"></div>
            @endif
        </div>
    </div>
</article>
@endsection
