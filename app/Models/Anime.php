<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Anime extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'numberOfEp',
        'image',
        'created_at',
        'update_at'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}