<?php

namespace App\Models\dashboard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departmans extends Model
{
    protected $fillable = [
        'author_id',
        'name'

    ];

    public function supervisors(): HasMany
    {
        return $this->hasMany(Supervisor::class);
    }
}

