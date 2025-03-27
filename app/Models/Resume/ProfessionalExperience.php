<?php

namespace App\Models\Resume;

use Illuminate\Database\Eloquent\Model;

class ProfessionalExperience extends Model
{
	protected $table = 'professional_experiences';
	protected $fillable = ['position', 'company', 'start_date', 'end_date', 'location', 'description', 'display_order'];
}