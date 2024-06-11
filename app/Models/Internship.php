<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Internship extends Model
{
	use HasFactory;

	protected $guarded = ["id"];

	protected $dates = ["created_at", "updated_at"];

	protected $casts = [
		"jumlah_orang" => "integer",
		"duration" => "integer",
		"intern_start" => "date",
		"intern_end" => "date"
	];

	public function getDurationAttribute()
	{
		return $this->intern_start->format("j M Y") . " - " . $this->intern_end->format("j M Y");
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
