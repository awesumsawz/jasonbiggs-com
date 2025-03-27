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

<main class="resume mx-auto">
    <section>
        <div class="text-center">
            <h1 class="text-[4rem] font-bold mb-0 text-gray-900 dark:text-primary">Resume</h1>
            <p class="subtitle-note">Last Updated {{ date('F Y') }}</p>
        </div>
        <div class="flex flex-col">
            <div class="body-content mt-0">
                <div class="post page type-page status-publish hentry">
                    <div class="post-content">
                        <div class="entry">
                            <div class="text-center my-6">
                                <a href="{{ asset('files/jasonbiggs_cv.pdf')}}" class="bg-dark-gray !text-white text-[1.4rem] px-6 py-2 rounded-full hover:bg-primary-hover transition-colors duration-300 dark:bg-true-black dark:hover:bg-primary-hover" download="">
                                    Download a copy
                                </a>
                            </div>
                            <div class="prose prose-lg dark:prose-invert max-w-none text-gray-800 dark:text-light-gray">
                                {!! $intro->value !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section>
        <div class="section-title">
            <h2 class="text-[3.6rem] font-bold mb-2">Education</h2>
        </div>
        <div class="flex flex-col md:flex-row justify-between gap-8">
            @if (is_array($degrees))
                @foreach($degrees as $degree)
                    {!! Lists::educationBuilder($degree) !!}
                @endforeach
            @else
                <p class="text-gray-800 dark:text-gray-200">No education degrees found.</p>
            @endif
        </div>
    </section>
    <hr>
    <section>
        <div class="section-title">
            <h2 class="text-[3.6rem] font-bold mb-0">Skills</h2>
            <p class="subtitle-note">Sections are Ordered Most Experienced to Least</p>
        </div>
        <div class="flex flex-col gap-8">
            <div class="text-center">
                <h3 class="font-display mb-[1rem]">Languages & Frameworks</h3>
                <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3  list-none pl-0">
                    {!! Lists::listBuilder($languages) !!}
                </ul>
            </div>
            <div class="text-center">
                <h3 class="font-display mb-[1rem]">Software</h3>
                <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3  list-none pl-0">
                    {!! Lists::listBuilder($software) !!}
                </ul>
            </div>
            <div class="text-center">
                <h3 class="font-display mb-[1rem]">Systems</h3>
                <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3  list-none pl-0">
                    {!! Lists::listBuilder($systems) !!}
                </ul>
            </div>
        </div>
    </section>
    <hr>
    <section>
        <div class="section-title">
            <h2 class="text-[3.6rem] font-bold mb-2">Professional Experience</h2>
        </div>
        <div class="flex flex-col gap-8">
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
    <hr>
    <section>
        <div class="section-title">
            <h2 class="text-[3.6rem] font-bold mb-2">Personal Experience</h2>
        </div>
        <div class="flex flex-col gap-8">
            <div class="text-center">
                <h3 class="font-display mb-2 pb-[1rem]">Hobbies & Interests</h3>
                <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3  list-none pl-0">
                    {!! Lists::listBuilder($hobbies) !!}
                </ul>
            </div>
            <div class="mb-4">
                <h3 class="font-display mb-2 text-center pb-[1rem]">Personal Projects</h3>
                <div class="flex flex-col gap-8">
                    <div class="grid md:grid-cols-[30rem_auto] gap-8">
                        <h4 class="text-[2rem] dark:text-white font-display text-right md:text-right">TechRegular</h4>
                        <p class="leading-relaxed text-gray-800 dark:text-gray-200">
                            {!! $projects['techregular'] !!}
                        </p>
                    </div>
                    <div class="grid md:grid-cols-[30rem_auto] gap-8">
                        <h4 class="text-[2rem] dark:text-white font-display text-right md:text-right">Think Bigg Consulting</h4>
                        <p class="leading-relaxed text-gray-800 dark:text-gray-200">
                            {!! $projects['think_bigg_consulting'] !!}
                        </p>
                    </div>
                </div>
            </div>
            <div>
                <h3 class="font-display mb-2 text-center">Speaking Engagements</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div>
                        <h4 class="font-display mb-4">2014</h4>
                        <div class="flex flex-col ">
                            {!! Lists::h5ListBuilder($speaking['2014']) !!}
                        </div>
                    </div>
                    <div>
                        <h4 class="font-display mb-4">2015</h4>
                        <div class="flex flex-col ">
                            {!! Lists::h5ListBuilder($speaking['2015']) !!}
                        </div>
                    </div>
                    <div>
                        <h4 class="font-display mb-4">2016</h4>
                        <div class="flex flex-col ">
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
