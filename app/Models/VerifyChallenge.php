<?php

namespace App\Models;

use App\Enum\Field;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;


class VerifyChallenge extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $fillable = [
        Field::USER_ID,
        Field::CODE,
    ];

    protected $casts = [];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model){
            $model->id = Str::ulid();
        });
    }
}
