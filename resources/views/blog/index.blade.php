@extends('layouts.blog')

@section('title', 'Blog')

@section('content')
    @foreach($posts as $post)
        <article class="blog-card">
            <a href="{{ route('blog.show', $post['slug']) }}" class="card-link-wrapper">
                <div class="card-content">
                    <div class="card-meta">
                        <span class="post-date">{{ $post['metadata']['formatted_date'] ?? date('F j, Y', strtotime($post['metadata']['date'])) }}</span>
                        @if(app()->environment('local'))
                        <!-- Debug info -->
                        <span class="debug-info" style="display: none;">
                            Raw date: {{ $post['metadata']['date'] ?? 'none' }} |
                            Filename: {{ basename($post['slug']) }} |
                            Timestamp: {{ strtotime($post['metadata']['date']) }}
                        </span>
                        @endif
                    </div>
                    
                    <h2 class="card-title">
                        {{ $post['metadata']['title'] }}
                    </h2>
                    
                    <div class="card-excerpt">
                        {{ $post['excerpt'] }}
                    </div>
                    
                    <div class="card-link">
                        <span class="read-more">Read more</span>
                    </div>
                </div>
            </a>
            
            @if(isset($post['metadata']['tags']) && is_array($post['metadata']['tags']) && count($post['metadata']['tags']) > 0)
            <div class="post-tags">
                <div class="tags-wrapper">
                    @foreach($post['metadata']['tags'] as $index => $tag)
                        @if($index < 2)
                        <a href="{{ route('blog.index', array_merge(request()->except(['tag', 'page']), ['tag' => $tag])) }}" class="tag-badge">
                            {{ $tag }}
                        </a>
                        @else
                        <a href="{{ route('blog.index', array_merge(request()->except(['tag', 'page']), ['tag' => $tag])) }}" class="tag-badge hidden-tag" data-post="{{ $post['slug'] }}" style="display: none;">
                            {{ $tag }}
                        </a>
                        @endif
                    @endforeach
                    
                    @if(count($post['metadata']['tags']) > 3)
                    <button class="tags-toggle" data-post="{{ $post['slug'] }}" data-expanded="false" onclick="togglePostTags('{{ $post['slug'] }}', this)">
                        <span class="more-text">+{{ count($post['metadata']['tags']) - 2 }} more</span>
                        <span class="less-text">Show less</span>
                    </button>
                    @endif
                </div>
            </div>
            @endif
        </article>
    @endforeach
@endsection

@section('pagination')
    <div class="blog-pagination">
        <div class="pagination-info">
            Showing {{ ($posts->currentPage() - 1) * $posts->perPage() + 1 }} to {{ min($posts->currentPage() * $posts->perPage(), $posts->total()) }} of {{ $posts->total() }} results
        </div>
        {{ $posts->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Make sure all hidden tags are properly hidden on page load
        document.querySelectorAll('.hidden-tag').forEach(tag => {
            tag.style.display = 'none';
        });
    });

    function togglePostTags(postId, button) {
        const hiddenTags = document.querySelectorAll(`.hidden-tag[data-post="${postId}"]`);
        const cardElement = button.closest('.blog-card');
        const isExpanded = button.getAttribute('data-expanded') === 'true';
        
        console.log(`Toggling tags for post ${postId}. Current state: ${isExpanded ? 'expanded' : 'collapsed'}`);
        console.log(`Found ${hiddenTags.length} hidden tags to toggle`);
        
        if (isExpanded) {
            // Hide tags - we're collapsing
            hiddenTags.forEach(tag => {
                tag.style.display = 'none';
            });
            button.setAttribute('data-expanded', 'false');
            cardElement.classList.remove('expanded');
        } else {
            // Show tags - we're expanding
            hiddenTags.forEach(tag => {
                tag.style.display = 'inline-flex';
            });
            button.setAttribute('data-expanded', 'true');
            cardElement.classList.add('expanded');
        }
    }
</script>
@endpush 