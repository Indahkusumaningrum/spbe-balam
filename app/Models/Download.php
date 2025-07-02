<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $table = 'downloads';
    
    protected $fillable = ['category', 'title', 'content', 'file_path'];
}
