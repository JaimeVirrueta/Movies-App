<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //
    /**
     * A Movie maybe has a many turns
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function turns()
    {
        return $this->belongsToMany(Turn::class);
    }
}
