<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'text',
        'is_completed'
    ];

    protected $casts = [
        'is_completed' => 'boolean'
    ];
}
