<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'published_at', 'image_path', 'is_activve'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'date',
        'is_active' => 'boolean'
    ];

    /**
     * A Movie maybe has a many turns
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function turns()
    {
        return $this->belongsToMany(Turn::class);
    }

    public function getActiveTextAttribute()
    {
        return $this->is_active ? 'Activo' : 'Inactivo';
    }
}
