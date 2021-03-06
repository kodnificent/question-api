<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
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
        'description',
        'is_correct_choice',
        'icon_url',
    ];

    /**
     * The attributes that are cast to native types
     *
     * @var array
     */
    protected $casts = [
        'is_correct_choice' => 'boolean'
    ];

    public function question() {
        return $this->belongsTo(Question::class);
    }
}
