<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantStatus extends Model
{
	use HasFactory;

	protected $table = "applicant_statuses";
	protected $guarded = ["id"];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function internship()
	{
		return $this->belongsTo(Internship::class);
	}

	public function applicantData()
	{
		return $this->belongsTo(ApplicantData::class, "user_id", "user_id");
	}
}
