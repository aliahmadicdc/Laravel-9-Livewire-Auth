<?php

namespace App\Models\back;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class Image extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'alt'
    ];

    public function getNameAttribute($name): string
    {
        return asset(imageUrl . '/' . $name);
    }

    public function getUpdatedAtAttribute($updated_at): string
    {
        return jdate($updated_at)->format('H:i:s Y-m-d');
    }

    public function getCreatedAtAttribute($created_at): string
    {
        return jdate($created_at)->format('H:i:s Y-m-d');
    }
}
