<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static firstOrCreate(int[] $array)
 */
class Setting extends Model
{
    protected $table = 'settings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'show_date',
        'show_author',
        'allow_comments',
        'show_comments_count',
        'show_likes_count'
    ];
}
