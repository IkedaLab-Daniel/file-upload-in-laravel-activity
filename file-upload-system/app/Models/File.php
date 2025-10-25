<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'filename',
        'original_name',
        'file_path',
        'mime_type',
        'file_size',
    ];
}
