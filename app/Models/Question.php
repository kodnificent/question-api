<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question',
        'is_general',
        'categories',
        'point',
        'icon_url',
        'duration',
    ];

    /**
     * The attributes that are cast to native types
     *
     * @var array
     */
    protected $casts = [
        'is_general' => 'boolean'
    ];

    /**
     * Get all choices for this question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function choices() {
        return $this->hasMany(Choice::class);
    }
}
