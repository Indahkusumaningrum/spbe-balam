<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regulasi extends Model
{
    protected $table = 'regulations';
    
    protected $fillable = ['kategori', 'judul', 'file_path'];
}
