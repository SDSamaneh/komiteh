<?php

namespace App\Models\dashboard;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supervisor extends Model
{
    protected $fillable = [
        'author_id',
        'name',
        'idCard',
        'departmans_id',

    ];
 
    public function departmans(): BelongsTo
    {
        return $this->belongsTo(Departmans::class);
    }
    // یک مدیر واحد می‌تواند چند کاربر داشته باشد
    public function users()
    {
        return $this->hasMany(User::class, 'supervisor_id');
    }
}
