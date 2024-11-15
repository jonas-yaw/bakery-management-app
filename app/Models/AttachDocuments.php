<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttachDocuments extends Model
{
    use SoftDeletes;
    public $timestamps = false;
	 protected $table = 'images';
   	 protected $fillable = [
        'owner_id',
        'filename',
        'image'
    ];

    protected $casts = [
        'created_on' => 'datetime',
      ];

    public function fileowner() {
    return $this->belongsToMany('\App\Models\Customer');
}
}
