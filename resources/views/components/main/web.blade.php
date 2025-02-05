@php
class showcase
{
    public function galleryCard($card_info, &$count):string
    {
        $title          = $card_info['title'];
        $description    = $card_info['description'];
        $date           = $card_info['date'];
        $image_url      = $card_info['imageURL'];
        $image_alt      = $card_info['imageAlt'];
        
        $output =   '<article id="card-'. $count .'" class="card-wrapper">';
        $output .=    '<div class="grid-card" style="background-image: url(\''. $image_url .'\')">';
        $output .=      '<div class="overlay" onclick="galleryGridShowModal(this)"></div>';
        $output .=    '</div>';
        $output .=    '<div class="grid-card-modal-wrapper">';
        $output .=    	'<div class="grid-card-modal">';
        $output .=				'<div class="image">';
        $output .=					'<img src="'. $image_url .'" alt="'. $image_alt .'">';
        $output .=      		'<div class="close" onclick="galleryGridCollapseModal(this)">';
        $output .=        		'<iconify-icon icon="fa:close"></iconify-icon>';
        $output .=      		'</div>';
        $output .=				'</div>';
        $output .=      	'<div class="content">';
        $output .=      		'<div class="title">';
        $output .=        		$title;
        $output .=      		'</div>';
        $output .=      		'<div class="description">';
        $output .=        		$description;
        $output .=      		'</div>';
        $output .=      		'<div class="date">';
        $output .=        		$date;
        $output .=      		'</div>';
        $output .=      	'</div>';
        $output .=    	'</div>';
        $output .=      '<div class="overlay" onclick="galleryGridCollapseModal(this)"></div>';
        $output .=  	'</div>';
        $output .=  '</article>';
        
        $count++;

        return $output;
    }
}

$gallery_builder = new showcase;
@endphp

<main class="{{ $mainClass }}">
    <section class="intro">
        <h1>{{ $title }}</h1>
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
            {!! $gallery_builder->galleryCard($card, $index) !!}
        @endforeach
    </section>
</main>