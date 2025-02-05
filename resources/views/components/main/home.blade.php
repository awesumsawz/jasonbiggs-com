@php
    class frontPage
    {
    /**
     * Gallery Slide Builder
     *
     * Build a slide for use in the gallery slider that is active on the front page
     *
     * @param $slide_settings
     * @param $count
     * @return string
     */
        public function gallerySlide($slide_settings, &$count): string {
            $title      = $slide_settings['slide_title'];
            $content    = $slide_settings['slide_contents'];
            $cta_url    = $slide_settings['cta_url'];
            $cta_text   = $slide_settings['cta_button_text'];
            $image_url  = $slide_settings['slide_image'];

            $output =   '<div id="slide-'. $count .'" class="slide'. ($count == 0 ? ' active' : null) .'" style="background-image: url(\''. $image_url .'\')">';
            $output .=      '<div class="title">';
            $output .=          '<h2>'. $title .'</h2>';
            $output .=      '</div>';
            $output .=      '<div class="content">';
            $output .=          '<p>'. $content .'</p>';
            $output .=      '</div>';
            $output .=      '<div class="cta">';
            $output .=          '<a href="'. $cta_url .'">'. $cta_text .'</a>';
            $output .=      '</div>';
            $output .=      '<div class="overlay"></div>';
            $output .=  '</div>';

            $count++;
            return $output;
        }
    }

    $frontpage_builder = new frontPage;
@endphp

<main class="{{ $mainClass }}">
    <section class="sliding-gallery">
        @foreach ($slides as $index => $slide)
            {!! $frontpage_builder->gallerySlide($slide, $index) !!}
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