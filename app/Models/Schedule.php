<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;

class Schedule extends Model
{
    use HasFactory;
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
    protected $fillable = ['movie_id', 'start_time', 'end_time'];
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
