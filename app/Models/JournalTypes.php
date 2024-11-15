<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalTypes extends Model
{
	use HasFactory;

	protected $table = 'journal_description_types';
        public $timestamps = false;
}
