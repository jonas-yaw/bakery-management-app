<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
	use SoftDeletes;
	public $timestamps = false;
	protected $dates = ['created_on','deleted_at'];
	 protected $table = 'images';
   	 protected $fillable = [
        'accountnumber',
        'filename',
        'image',
        'created_by',
        'policy_number',
        'item_id',
        'mime',
        'reference_number',
        'filepath'
    ];


}
