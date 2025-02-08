@php
    use App\Models\Lists;

    $hobbies = [
        'Home Automation',
        'Photography',
        'Graphic Design',
        'Home Labbing',
        'Productivity',
        'Consumer Technology',
        'Computer Building',
        'Gaming',
        'Mechanical Keyboards',
        'Home Networking',
        'Reading',
        'Everyday Carry',
        'Guitar & Bass',
        'Cable Management',
        'Coffee',
    ]
@endphp

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
                    Through Think Bigg Development, I build and maintain websites for small businesses owned by current and former educators. This initiative is dedicated to empowering educational entrepreneurs with tailored digital solutions.
                </p>
            </div>
            <div class="project">
                <h4>TechRegular</h4>
                <p class="description">
                    Jason's technology blog breaks down complex tech topics into everyday language. Recently rebuilt using NextJS, TechRegular is gearing up for a comeback with fresh content and enhanced performance.
                </p>
            </div>
            <div class="project inactive">
                <h4>Think Bigg Consulting</h4>
                <p class="description">
                    Think Bigg Consulting is Jason's consulting venture that once specialized in crafting websites, branding, and offering IT advice for individuals and small businesses. While it laid the groundwork for his digital expertise, this project remains dormant.
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
                    <h5>Illinois Reading Conference</h5>
                </div>
            </div>
            <div class="year">
                <h4>2015</h4>
                <div class="event-list">
                    <h5>Illinois Reading Conference</h5>
                </div>
            </div>
            <div class="year">
                <h4>2016</h4>
                <div class="event-list">
                    <h5>Illinois Reading Conference</h5>
                    <h5>Literacy In Motion</h5>
                    <h5>Starved Rock Reading Council</h5>
                </div>
            </div>
        </div>
    </div>
</div>