@php
$slides = [
  [
    'slide_title' => 'Web Wizard',
    'slide_contents' => 'Taking lines of code and assembling them into web pages and applications has always fascinated Jason and continues to do so today. In his professional experience, Jason has crafted a number of web pages and web sites. In his personal life, Jason maintains several websites for personal and professional use.',
    'cta_url' => '/web',
    'cta_button_text' => 'Learn More',
    'slide_image' => asset('images/photos/imacs_row.jpg'),
  ],
  [
    'slide_title' => 'Resume',
    'slide_contents' => 'This doesn\'t really need explanation, does it?',
    'cta_url' => '/resume',
    'cta_button_text' => 'View the Vita',
    'slide_image' => asset('images/photos/audio_jacks.jpg'),
  ]
];
@endphp

<x-layouts.home :slides="$slides">
  <x-slot:main-class>
    front-page
  </x-slot:main-class>
  <x-slot:content>
    <div class="body-content">
      <p>Some people head into their careers knowing exactly what they want to do. Jason... not so much.</p>
      <p>Starting as a fourth and fifth grade teacher, Jason found that the classroom simply wasn't what he'd expected. After his position was eliminated in 2016, Jason took the opportunity to join a university IT department as a Help Desk Support Specialist. There, he learned more than he could've possibly imagined he would in such a short time. Thanks to his coworkers and mentor, Jason was able to find his passions were server side.</p>
      <p>Upon leaving his help desk position, Jason joined a marketing company as a Systems Support Technician. There, he learned that the physical side of servers weren't all they were cracked up to be. However, the learning picked up in this position enabled him to start doing his own web development projects, taking his initial exploration of front end development into a new stage.</p>
      <p>His newly realized itch for development needed tending. Jason began pursuing a job that would allow him to grow as a developer and after initially applying for a Junior WordPress Developer position, he was grabbed by the Training team as a dual-role Trainer, Developer. However, upon learning of Jason's expertise on the backend and affinity for picking up new skills, the role was quickly adjusted, making Jason the Training team's Full-Stack Developer.</p>
    </div>
  </x-slot:content>
</x-layouts.home>
