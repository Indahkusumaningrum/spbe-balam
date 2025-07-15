<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = ['nama'];

    public function aspects()
    {
        return $this->hasMany(Aspect::class);
    }
}
