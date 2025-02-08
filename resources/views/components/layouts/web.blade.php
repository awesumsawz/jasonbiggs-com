@include('components.head')
@include('components.header')

@php
use App\Models\Gallery;
use App\Models\Lists;
$introBlurb = $intro->value;
$developmentExamples = json_decode($developmentExamples->value, true);
$productionSites = json_decode($productionSites->value, true);
$galleryCards = json_decode($galleryCards->value, true);
@endphp

<main class="showcase-template">
    <section class="intro">
        <h1>Web Wizard</h1>
        <div class="blurb">
            {!! $introBlurb !!}
        </div>
    </section>
    <section class="examples">
        <div class="column">
            <div class="title">
                <h2>Development Examples</h2>
            </div>
            <div class="links">
                {!! Lists::linkListBuilder($developmentExamples) !!}
            </div>
        </div>
        <div class="column">
            <div class="title">
                <h2>Websites in Production</h2>
            </div>
            <div class="links">
                {!! Lists::linkListBuilder($productionSites) !!}
            </div>
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