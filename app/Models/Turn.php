<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'turn_name', 'is_active'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $dates = [
        'turn_name'
    ];

    /**
     * A Turn maybe have many movies
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }

    public function getActiveTextAttribute()
    {
        return $this->is_active ? 'Activo' : 'Inactivo';
    }
}
