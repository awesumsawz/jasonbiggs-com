@include('components.head')
@include('components.header')

@php
use App\Models\Gallery;
@endphp

<main class="showcase-template">
    <section class="intro">
        <h1>Web Wizard</h1>
        <div class="blurb">
            {{ $introBlurb }}
        </div>
    </section>
    <section class="examples">
        <div class="column">
            {{ $examplesColumnOne }}
        </div>
        <div class="column">
            {{ $examplesColumnTwo }}
        </div>
    </section>
    <section class="gallery-grid">
        @foreach ($galleryCards as $index => $card)
            {!! Gallery::galleryCardBuilder($card, $index) !!}
        @endforeach
    </section>
</main>

@include('components.footer')
@include('components.foot')