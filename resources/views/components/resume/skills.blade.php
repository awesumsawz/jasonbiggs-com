@php
    use App\Models\Lists;

    $languages = [
		"PHP",
		"JavaScript",
		"JQuery",
		"CSS",
		"Sass",
		"HTML",
		"Laravel",
		"React",
		"NextJS",
		"TypeScript",
		"Python",
		"Bash",
		"PowerShell",
		"SQL"
	];
    $software = [
		"Visual Studio Code",
        "Ollama",
		"PhpStorm",
		"WordPress",
		"Docker",
        "Git",
		"Github",
        "Gitlab",
		"Figma",
		"Adobe Creative Suite",
		"VirtualBox",
        "QEMU"
	];
    $systems = [
		"MacOS",
		"Arch Linux",
		"Ubuntu Server",
		"WordPress",
		"Atlassian Suite",
		"Circle CI",
		"Linode",
		"Digital Ocean",
		"Amazon Web Services",
		"Active Directory"
	];
@endphp

<div class="title">
    <h2>Skills</h2>
    {{-- <p class="subtitle">
        Sections are Ordered Most Experienced to Least
    </p> --}}
</div>
<div class="content">
    <div class="skill-list">
        <h3>Languages & Frameworks</h3>
        <ul>
            {!! Lists::listBuilder($languages) !!}
        </ul>
    </div>
    <div class="skill-list">
        <h3>Software</h3>
        <ul>
            {!! Lists::listBuilder($software) !!}
        </ul>
    </div>
    <div class="skill-list">
        <h3>Systems</h3>
        <ul>
            {!! Lists::listBuilder($systems) !!}
        </ul>
    </div>
</div>