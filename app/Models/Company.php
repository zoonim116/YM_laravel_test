<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'phone', 'description', 'user_id'];

    protected $hidden = ['user_id'];

    protected static function booted(): void
    {
        static::creating(function (Company $company) {
            $company->user_id = auth()->id();
        });
    }
}
