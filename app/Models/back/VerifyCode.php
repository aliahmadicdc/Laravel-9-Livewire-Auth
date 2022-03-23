<?php

namespace App\Models\back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
    ];

    public function getUpdatedAtAttribute($updated_at): string
    {
        return jdate($updated_at)->format('H:m:s Y-m-d');
    }

    public function getCreatedAtAttribute($created_at): string
    {
        return jdate($created_at)->format('H:m:s Y-m-d');
    }
}
