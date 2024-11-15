<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocComments extends Model
{
    Use SoftDeletes;
    protected $table = 'doc_comments';
    public $timestamps = false;

    protected $casts = [
        'created_on' => 'datetime',
        'updated_on' => 'datetime'
      ];
}

