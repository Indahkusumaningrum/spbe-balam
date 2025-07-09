<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;
    protected $fillable = ['domain_id', 'aspect_id', 'name', 'description'];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function aspect() {
        return $this->belongsTo(Aspect::class);
    }
}
