<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;
use App\Models\Schedule;

class Movie extends Model
{
    use HasFactory;
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
