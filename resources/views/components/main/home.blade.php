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

    $gallery_slides = [
        [
            'slide_title' => 'Web Wizard',
            'slide_contents' => 'Taking lines of code and assembling them into web pages and applications has always fascinated Jason and continues to do so today. In his professional experience, Jason has crafted a number of web pages and web sites. In his personal life, Jason maintains several websites for personal and professional use.',
            'cta_url' => '\/web',
            'cta_button_text' => 'Learn More',
            'slide_image' => assets('images/photos/imacs_row.jpg'),
        ],
        [
            'slide_title' => 'Resume',
            'slide_contents' => 'This doesn\'t really need explanation, does it?',
            'cta_url' => '\/resume',
            'cta_button_text' => 'View the Vita',
            'slide_image' => assets('images/photos/audio_jacks.jpg'),
        ]
    ];

    $frontpage_builder = new frontPage;
@endphp

<main class="{{ $mainClass }}">
    <section class="sliding-gallery">
        @php 
        $slide_counter = 0;
        @endphp
        @foreach ($gallery_slides as $slide)
            @php
            $new_slide = $frontpage_builder->gallerySlide($slide, $slide_counter);
            echo $new_slide;
            $slide_counter++;
            @endphp
        @endforeach
        <div class="navigation">
            <div id="advance" class="arrow-right" onclick="gallerySlideArrows(this)">
                <iconify-icon inline icon="fa-solid:chevron-right"></iconify-icon>
            </div>
            <div id="return" class="arrow-left" onclick="gallerySlideArrows(this)">
                <iconify-icon inline icon="fa-solid:chevron-left"></iconify-icon>
            </div>
            <div class="dot-grid">
                @for ($i = 0; $i < $slide_counter; $i++)
                    <div id="dot-{{ $i }}" class="dot{{ $i == 0 ? ' active' : '' }}" onclick="dotChangeSlide(this)"></div>
                @endfor
            </div>
        </div>
    </section>
    <div>
        {{ $content }}
    </div>
</main>