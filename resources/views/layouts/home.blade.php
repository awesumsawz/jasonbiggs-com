@include('components.head')
@include('components.header')

@php
use App\Models\Gallery;

$slides = json_decode($slideContent->value, true);
@endphp

<main class="front-page">
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
    <section class="body-content">
        {!! $textContent->value !!}
    </section>
</main>

@include('components.footer')
@include('components.foot')