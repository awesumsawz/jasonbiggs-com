@props([ 'href', 'active'=>FALSE ])

<li class="{{ $active ? 'active' : '' }} menu-item menu-item-type-post_type menu-item-object-page" aria-current="{{ $active ? 'page' : 'false' }}">
	<a href="{{ $href }}">
		{{ $slot }}
	</a>
</li>