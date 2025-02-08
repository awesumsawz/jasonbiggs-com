@php
use App\Models\Lists;

$degrees = json_decode($education->value, true);
$languages = json_decode($skillsLanguages->value, true);
$software = json_decode($skillsSoftware->value, true);
$systems = json_decode($skillsSystems->value, true);
$hobbies = json_decode($personalHobbies->value, true);
$projects = json_decode($personalProjects->value, true);
$speaking = json_decode($personalSpeaking->value, true);

@endphp

@include('components.head')
@include('components.header')

<main class="resume-template">
    <section class="intro">
        <div class="title">
            <h1>Resume</h1>
            {{-- TODO: MAKE THIS DYNAMIC --}}
            <p class="subtitle">Last Updated December 2024</p>
        </div>
        <div class="content">
            <div class="body-content">
                <div class="post page type-page status-publish hentry">
                    <div class="post-content">
                        <div class="entry">
                            <div class="wp-block-file aligncenter">
                                <a href="{{ asset('files/12-05-24_JasonBiggs_Resume__WebDeveloper.pdf') }}" class="wp-block-file__button wp-element-button" download="">
                                    Download a copy
                                </a>
                            </div>
                            {!! $intro->value !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class="education">
        <div class="title">
            <h2>Education</h2>
        </div>
        <div class="content">
            @if (is_array($degrees))
                @foreach($degrees as $degree)
                    {!! Lists::educationBuilder($degree) !!}
                @endforeach
            @else
                <p>No education degrees found.</p>
            @endif
        </div>
    </section>
    <section class="skills">
        <div class="title">
            <h2>Skills</h2>
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
    </section>
    <section class="professional-exp">
        <div class="title">
            <h2>Professional Experience</h2>
        </div>
        <div class="content">
            @foreach ($professionalExperience as $experience)
                @php
                $array['position'] = $experience->position;
                $array['company'] = $experience->company;
                $array['start_date'] = $experience->start_date;
                $array['end_date'] = $experience->end_date;
                $array['location'] = $experience->location;
                $array['description'] = json_decode($experience->description, true);
                @endphp
                {!! Lists::experienceBuilder($array) !!}
            @endforeach
        </div>
    </section>
    <section class="personal-exp">
        <div class="title">
            <h2>Personal Experience</h2>
        </div>
        <div class="content">
            <div class="skill-list">
                <h3>Hobbies & Interests</h3>
                <ul>
                    {!! Lists::listBuilder($hobbies) !!}
                </ul>
            </div>
            <div class="projects">
                <h3>Personal Projects</h3>
                <div class="wrapper">
                    <div class="project">
                        <h4>Think Bigg Development</h4>
                        <p class="description">
                            {!! $projects['think_bigg_development'] !!}
                        </p>
                    </div>
                    <div class="project">
                        <h4>TechRegular</h4>
                        <p class="description">
                            {!! $projects['techregular'] !!}
                        </p>
                    </div>
                    <div class="project inactive">
                        <h4>Think Bigg Consulting</h4>
                        <p class="description">
                            {!! $projects['think_bigg_consulting'] !!}
                        </p>
                    </div> 
                </div>
            </div>
            <div class="speaking">
                <h3>Speaking Engagements</h3>
                <div class="wrapper">
                    <div class="year">
                        <h4>2014</h4>
                        <div class="event-list">
                            {!! Lists::h5ListBuilder($speaking['2014']) !!}
                        </div>
                    </div>
                    <div class="year">
                        <h4>2015</h4>
                        <div class="event-list">
                            {!! Lists::h5ListBuilder($speaking['2015']) !!}
                        </div>
                    </div>
                    <div class="year">
                        <h4>2016</h4>
                        <div class="event-list">
                            {!! Lists::h5ListBuilder($speaking['2016']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@include('components.footer')
@include('components.foot')