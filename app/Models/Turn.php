<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
    //
    /**
     * A Turn maybe have many movies
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}
