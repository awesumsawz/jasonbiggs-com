<x-layout>
    <x-slot:main-class>resume-template</x-slot:main-class>
    <x-slot:title>Resume</x-slot:title>
    <x-slot:subtitle>Last Updated December 2024</x-slot:subtitle>
    <x-slot:downloadURL>
        {{ asset('files/12-05-24_JasonBiggs_Resume__WebDeveloper.pdf') }}
    </x-slot:downloadURL>
    <x-slot:intro-blurb>
        <p>Jason’s journey into technology and development started after leaving a career in education, where he honed his skills in communication and problem-solving. At Judson University, he dove into system administration and customer support, while also putting his knack for web and graphic design to good use.</p>
        <p>From there, he joined The Mx Group, blending customer-facing work with scripting and automation, creating tools with PowerShell, Bash, and Python that streamlined workflows and boosted productivity. This sparked his passion for development, leading him to Dealer Inspire, where he quickly transitioned from Trainer to Full-Stack Developer. Over the years, he built and maintained websites, extended plugins, and created tools that made a real impact. After exiting DI amid a restructuring in early 2024, Jason took the opportunity to learn React, Next.js, and TypeScript, expanding his front-end expertise.</p>
        <p>Now, as a Senior Software Engineer at Chime Financial, Jason helps drive revenue and user engagement by building dynamic pages, troubleshooting WordPress, and creating tools with PHP, JavaScript, and Advanced Custom Fields. His cross-departmental documentation efforts ensure workflows are smooth and knowledge is shared effectively across teams.</p>
        <p>Outside of work, Jason loves spending time with his daughter Eleanor, exploring new hobbies (hello, coffee brewing and photography), and tinkering with his home network and gaming computer. He’s a tech enthusiast, podcast aficionado (Accidental Tech Podcast, Connected, The Vergecast), and an actual-play podcast superfan (The Adventure Zone, Dungeons & Daddies, Dimension 20).</p>
    </x-slot:intro-blurb>
    <x-slot:education>
        <div class="title">
            <h2>Education</h2>
        </div>
        <div class="content">
            <div class="degree">
                <h3>Master of Science</h3>
                <p class="focus">Education in Literacy</p>
                <p>June 2016</p>
                <p>Judson University</p>
                <p>Elgin, Illinois</p>
            </div>
            <div class="degree">
                <h3>Bachelor of Science</h3>
                <p class="focus">Elementary Education</p>
                <p>May 2013</p>
                <p>Northern Illinois University</p>
                <p>DeKalb, Illinois</p>
            </div>
        </div>
    </x-slot:education>
    <x-slot:skills>
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
                    <li>PHP</li>
                    <li>JavaScript</li>
                    <li>JQuery</li>
                    <li>CSS</li>
                    <li>Sass</li>
                    <li>HTML</li>
                    <li>Laravel</li>
                    <li>React</li>
                    <li>NextJS</li>
                    <li>TypeScript</li>
                    <li>Python</li>
                    <li>Bash</li>
                    <li>PowerShell</li>
                </ul>
            </div>
            <div class="skill-list">
                <h3>Software</h3>
                <ul>
                    <li>VSCode</li>
                    <li>PhpStorm</li>
                    <li>WordPress</li>
                    <li>Docker</li>
                    <li>Git</li>
                    <li>Figma</li>
                    <li>Affinity Suite</li>
                    <li>PyCharm</li>
                    <li>Adobe Creative Suite</li>
                    <li>Parallels</li>
                    <li>VirtualBox</li>
                </ul>
            </div>
            <div class="skill-list">
                <h3>Systems</h3>
                <ul>
                    <li>Macos</li>
                    <li>WordPress</li>
                    <li>Arch Linux</li>
                    <li>Ubuntu Server</li>
                    <li>Wordpress</li>
                    <li>Atlassian Suite</li>
                    <li>Circle CI</li>
                    <li>Linode</li>
                    <li>Digital Ocean</li>
                    <li>Amazon Web Services</li>
                    <li>Active Directory</li>
                </ul>
            </div>
        </div>
    </x-slot:skills>
    <x-slot:professional-exp>
        <section class="professional-exp">
            <div class="title">
                <h2>Professional Experience</h2>
            </div>
            <div class="content">
                <div class="experience">
                    <h3 class="position">Senior Software Engineer</h3>
                    <div class="info">
                        <p class="range">August 2024 - Present</p>
                        <p class="company">Chime Financial</p>
                        <p class="location">Remote</p>
                    </div>
                    <ul class="list">
                        <li>Collaborate with the marketing team to enhance user engagement across the Chime website, driving revenue growth through optimized digital experiences</li>
                        <li>Troubleshoot and resolve WordPress bugs reported by users, ensuring a seamless and reliable platform experience</li>
                        <li>Design and implement new website pages using PHP and JavaScript, incorporating modern, responsive features to improve user satisfaction</li>
                        <li>Leverage Advanced Custom Fields to create dynamic, customizable user interfaces, streamlining content management for non-technical teams</li>
                        <li>Develop comprehensive cross-departmental documentation to standardize workflows and improve knowledge sharing</li>
                    </ul>
                </div>
                <div class="experience">
                    <h3 class="position">Software Engineer I</h3>
                    <div class="info">
                        <p class="range">December 2022 - March 2024</p>
                        <p class="company">Dealer Inspire</p>
                        <p class="location">Remote</p>
                    </div>
                    <ul class="list">
                        <li>Collaborated cross-functionally to deliver impactful documentation projects, resulting in a 20% increase in project efficiency and knowledge sharing</li>
                        <li>Conceptualized and executed innovative dealer web pages to elevate user experience and drive sales, increasing page views by 50% and lead conversion rate by 20%</li>
                        <li>Arranged a comprehensive code review process for pull requests, emphasizing quality standards and adherence to guidelines, identifying and correcting 200+ coding issues, resulting in a 40% improvement in code quality metrics</li>
                        <li>Designed and implemented software using PHP and JavaScript to integrate a third-party AI multilingual translation tool, which boosted dealership website engagement by 15% and reduced departmental development workload by 20%</li>
                    </ul>
                </div>
                <div class="experience">
                    <h3 class="position">Full-Stack Developer</h3>
                    <div class="info">
                        <p class="range">October 2019 - December 2022</p>
                        <p class="company">Dealer Inspire</p>
                        <p class="location">Naperville, Illinois</p>
                    </div>
                    <ul class="list">
                        <li>Engineered a scalable white-label training solution built specifically for internal teams, achieving a 50% average increase in departmental learning engagement</li>
                        <li>Constructed custom WordPress plugins integrating Google Analytics to guide training decisions, enhancing departmental efficiency by 20%</li>
                        <li>Architected a series of Python scripts to automate the processing of departmental information, reducing the average weekly workload by 3 hours</li>
                        <li>Implemented Agile development techniques to the training team, resulting in a 25% enhancement in workflow efficiency</li>
                        <li>Led a cross-functional collaboration to revamp Training Team brand identity on team websites, aligning design elements and messaging, boosting website traffic by 25% and decreasing bounce rate by 15%</li>
                        <li>Mentored a junior developer in Wordpress web development and server administration, resulting in a 30% boost in coding proficiency</li>
                        <li>Conceptualized, engineered, and optimized WordPress platforms with bespoke themes and plugins, channeling users towards a training-as-a-service membership model that led to a 100% boost in departmental revenue</li>
                    </ul>
                </div>
                <div class="experience">
                    <h3 class="position">Systems Support Technician</h3>
                    <div class="info">
                        <p class="range">February 2019 - October 2019</p>
                        <p class="company">The Mx Group</p>
                        <p class="location">Burr Ridge, Illinois</p>
                    </div>
                    <ul class="list">
                        <li>Analyzed market trends and conducted cost-benefit analysis for technology purchases, resulting in 15% cost savings and improved efficiency in inventory management</li>
                        <li>Orchestrated the development and implementation of departmental procedures using Bash, PowerShell, and Python scripts, yielding a 25% enhancement in operational efficiency and a time-saving of 12 hours weekly</li>
                        <li>Led the creation of a gamified security-training platform with interactive modules and quizzes, achieving a 50% completion rate increase and reducing security vulnerabilities by 20% within 6 months</li>
                        <li>Developed comprehensive procedural documentation for 20+ internal processes, streamlining onboarding and training time for new employees by 50% and reducing errors by 40%</li>
                    </ul>
                </div>
                <div class="experience">
                    <h3 class="position">Help Desk Support Specialist</h3>
                    <div class="info">
                        <p class="range">June 2017 - February 2019</p>
                        <p class="company">Judson University</p>
                        <p class="location">Elgin, Illinois</p>
                    </div>
                    <ul class="list">
                        <li>Resolved a wide range of technical issues as both level one and two help desk support, resulting in a 40% reduction in average ticket resolution time</li>
                        <li>Directed hands-on training sessions tailored to diverse user groups, focusing on optimizing university technology utilization; saw a 40% increase in user adoption rates and a 20% reduction in IT support ticket volume</li>
                        <li>Developed and maintained websites utilizing HTML, CSS, JavaScript, and WordPress; integrated user-friendly features that boosted customer engagement, leading to a 30% increase in online sales and a 15% growth in repeat visitors</li>
                        <li>Orchestrated the construction, restoration, and maintenance of Mac and Windows computer systems, implementing system upgrades and repairs that led to a 15% increase in system speed and reliability</li>
                    </ul>
                </div>
                <div class="experience">
                    <h3 class="position">Fifth Grade Teacher</h3>
                    <div class="info">
                        <p class="range">August 2022 - June 2017</p>
                        <p class="company">John Muir Literacy Academy</p>
                        <p class="location">Hoffman Estates, Illinois</p>
                    </div>
                    <ul class="list">
                        <li>Taught all subjects in a self-contained classroom, with special emphasis on integrating technology into literacy and the content subjects of social studies and science</li>
                        <li>Administered and analyzed data from MAP and PARCC tests</li>
                    </ul>
                </div>
                <div class="experience">
                    <h3 class="position">Fourth Grade Teacher</h3>
                    <div class="info">
                        <p class="range">August 2013 - June 2016</p>
                        <p class="company">Southbury Elementary School</p>
                        <p class="location">Oswego, Illinois</p>
                    </div>
                    <ul class="list">
                        <li>Member of the school's Technology Committee</li>
                        <li>Installed Apple TVs in every classroom in the building</li>
                        <li>Gave multiple presentations to staff members about how to integrate iOS and Apple TVs into their classrooms to enhance student learning</li>
                        <li>Taught all subjects in a self-contained classroom, with special emphasis on integrating technology into literacy and the content subjects of social studies and science</li>
                        <li>Administered and analyzed data from ISAT, MAP, PARCC, and STAR test</li>
                    </ul>
                </div>
            </div>
        </section>
    </x-slot:professional-exp>
    <x-slot:personal-exp>
        <section class="personal-exp">
            <div class="title">
                <h2>Personal Experience</h2>
            </div>
            <div class="content">
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
                <div class="projects">
                    <h3>Personal Projects</h3>
                    <div class="wrapper">
                        <div class="project">
                            <h4>TechRegular</h4>
                            <p class="description">Jason's regular-person technology blog where he tried to present more complex technology to people who weren't as absorbed into technology as he is. The blog is currently on extended hiatus but blogging is certainly in Jason's future.</p>
                        </div>
                        <div class="project">
                            <h4>Think Bigg Consulting</h4>
                            <p class="description">Think Bigg Consulting is Jason's consulting entity. Primarily, the company facilitates the design and development of individual or small business websites and branding. The company also consults on other IT related topics if needs arise. This project is no longer active.</p>
                        </div>
                        <div class="project">
                            <h4>Awesumsawz Gaming</h4>
                            <p class="description">Awesumsawz Gaming was Jason's first official attempt to make it into the technology industry in his previous career as an educator. Jason streamed and podcasted under the Awesumsawz brand for about eight months before ending the effort in favor of focusing on his family.</p>
                        </div>
                    </div>
                </div>
                <div class="skill-list">
                    <h3>Hobbies & Interests</h3>
                    <ul>
                        <li>Photography</li>
                        <li>Graphic Design</li>
                        <li>Productivity</li>
                        <li>Consumer Technology</li>
                        <li>Computer Building</li>
                        <li>Gaming</li>
                        <li>Mechanical Keyboards</li>
                        <li>Reading</li>
                        <li>Everyday Carry</li>
                        <li>Guitar & Bass</li>
                        <li>Cable Management</li>
                        <li>Coffee</li>
                    </ul>
                </div>
            </div>
        </section>
    </x-slot:personal-exp>
</x-layout>