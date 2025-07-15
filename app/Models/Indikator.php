<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;
    protected $fillable = ['aspect_id', 'nama', 'penjelasan', 'tahun_id'];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function aspect() {
        return $this->belongsTo(Aspect::class);
    }

    public function tahun()
    {
        return $this->belongsTo(Tahun::class);
    }

}
