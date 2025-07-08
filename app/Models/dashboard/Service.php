<?php

namespace App\Models\dashboard;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    protected $fillable = [
        'author_id',
        'name',
        'idCard',
        'departmans_id',
        'supervisors_id',
        'price',
        'descriptionUser',
        'accept',
        'status',
        'memberDate',
        'memberPrice',
        'lastSalary',
        'debt',
        'validationDate',
        'validationHr',
        'validationManager1',
        'finalPrice',
        'description',
        'validationManager2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function departmans(): BelongsTo
    {
        return $this->belongsTo(Departmans::class, 'departmans_id');
    }
    public function supervisors(): BelongsTo
    {
        return $this->belongsTo(Supervisor::class, 'supervisors_id');
    }
}
