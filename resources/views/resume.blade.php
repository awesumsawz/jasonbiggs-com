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
</x-layout> 