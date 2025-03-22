<ul id="menu-primary-menu" class="nav">
	<x-nav-link href="/" :active="isThePageActive('/')">Home</x-nav-link>
	<x-nav-link href="/web" :active="isThePageActive('/web')">Web</x-nav-link>
	<x-nav-link href="/resume" :active="isThePageActive('/resume')">Resume</x-nav-link>
	<x-nav-link href="/blog" :active="isThePageActive('/blog')">Blog</x-nav-link>
</ul>