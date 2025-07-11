<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    protected $fillable = ['tahun', 'keterangan'];

    public function indikators()
    {
        return $this->hasMany(Indikator::class);
    }

    public static function getOrCreateCurrentYear()
    {
        $year = date('Y');
        return self::firstOrCreate(['tahun' => $year]);
    }

}
