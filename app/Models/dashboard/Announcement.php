<?php

namespace App\Models\dashboard;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    //	
    protected $fillable = [
        'author_id',
        'title',
        'description',
    ];



}
