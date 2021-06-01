<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

const maandnamen = array("Selecteer maand","Januari","Februari","Maart","April","Mei","Juni",
"Juli","Augustus","September","Oktober","November","December");

class Maanden extends Model
{
    static function namen (){
        return maandnamen;
    }
    static function naam ($maandnr){
        if (!is_int($maandnr))return "";
        if ($maandnr < 1) return "";
        if ($maandnr > 12) return "";
        return maandnamen[$maandnr];
    }
}
