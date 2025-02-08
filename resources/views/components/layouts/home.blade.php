@include('components.head')
@include('components.header')

@php
use App\Models\Gallery;
@endphp

<main class="{{ $mainClass }}">
    <section class="sliding-gallery">
        @foreach ($slides as $index => $slide)
            {!! Gallery::galleryBuilder($slide, $index) !!}
        @endforeach
    
        <div class="navigation">
            <div id="advance" class="arrow-right" onclick="gallerySlideArrows(this)">
                <iconify-icon inline icon="fa-solid:chevron-right"></iconify-icon>
            </div>
            <div id="return" class="arrow-left" onclick="gallerySlideArrows(this)">
                <iconify-icon inline icon="fa-solid:chevron-left"></iconify-icon>
            </div>
            <div class="dot-grid">
                @foreach ($slides as $index => $slide)
                    <div id="dot-{{ $index }}" class="dot{{ $index == 0 ? ' active' : '' }}" onclick="dotChangeSlide(this)"></div>
                @endforeach
            </div>
        </div>
    </section>
    <div>
        {{ $content }}
    </div>
</main>

@include('components.footer')
@include('components.foot')