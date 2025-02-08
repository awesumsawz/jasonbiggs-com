@php
    use App\Models\Lists;
    
    $degrees = [
		[
			'degree' => 'Master of Science',
			'field' => 'Education in Literacy',
			'date' => 'June 2016',
			'university' => 'Judson University',
			'location' => 'Elgin, Illinois'
		],
		[
			'degree' => 'Bachelor of Science',
			'field' => 'Elementary Education',
			'date' => 'May 2013',
			'university' => 'Northern Illinois University',
			'location' => 'DeKalb, Illinois'
		]
	];
@endphp


<div class="title">
    <h2>Education</h2>
</div>
<div class="content">
    @foreach($degrees as $degree)
        {!! Lists::educationBuilder($degree) !!}
    @endforeach
</div>