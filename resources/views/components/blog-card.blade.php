<div class="blog-card">
    <div class="card-content">
        <h2 class="card-title">
            <a href="{{ url('/blog/' . $post->slug) }}">{{ $post->title }}</a>
        </h2>
        <div class="card-meta">
            <span class="post-date">{{ $post->published_at->format('F j, Y') }}</span>
            @if(isset($post->tags) && count($post->tags) > 0)
                <span class="post-tags">
                    @foreach($post->tags as $tag)
                        <span class="tag">{{ $tag }}</span>
                    @endforeach
                </span>
            @endif
        </div>
        <div class="card-excerpt">
            <p>{{ $post->excerpt }}</p>
        </div>
        @if($post->image)
        <div class="card-image-small">
            <a href="{{ url('/blog/' . $post->slug) }}">
                <img src="{{ asset($post->image) }}" alt="{{ $post->title }}">
            </a>
        </div>
        @endif
        <div class="card-link">
            <a href="{{ url('/blog/' . $post->slug) }}" class="read-more">Read More</a>
        </div>
    </div>
</div> 