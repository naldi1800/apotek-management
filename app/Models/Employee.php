<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getStatusTextAttribute()
    {
        $statuses = [
            -1 => 'Suspended',
            0 => 'Active',
            1 => 'Inactive'
        ];

        return $statuses[$this->status] ?? 'Unknown';
    }

    // Scope untuk employee aktif
    public function scopeActive($query)
    {
        return $query->where('status', 0);
    }

    // Scope untuk employee suspended
    public function scopeSuspended($query)
    {
        return $query->where('status', -1);
    }
}
