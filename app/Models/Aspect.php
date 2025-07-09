<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspect extends Model
{
    use HasFactory;
    protected $fillable = ['domain_id', 'nama'];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function indikators()
    {
        return $this->hasMany(Indikator::class);
    }
}
