<main class="{{ $mainClass }}">
    <section class="intro">
        <div class="title">
            <h1>{{$title}}</h1>
            <p class="subtitle">{{$subtitle}}</p>
        </div>
        <div class="content">
            <div class="body-content">
                <div class="post page type-page status-publish hentry">
                    <div class="post-content">
                        <div class="entry">
                            <div class="wp-block-file aligncenter">
                                <a href="{{$downloadURL}}" class="wp-block-file__button wp-element-button" download="">
                                    Download a copy
                                </a>
                            </div>
                            {{$introBlurb}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class="education">
        
    </section>
    <section class="skills"></section>
    <section class="professional-exp"></section>
    <section class="personal-exp"></section>
</main>