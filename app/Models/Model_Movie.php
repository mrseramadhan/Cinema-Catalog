<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Model_Movie extends Model
{

	protected $table = 'movie';
	protected $primaryKey = 'id_movie';

    protected $fillable = [
        'movie_name',
        'description',
        'picture',
        'duration'
    ];

}
