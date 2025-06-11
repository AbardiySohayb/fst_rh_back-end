<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Model;

class Echlant extends Model
{
    protected $table = 'echlants';
    protected $primaryKey = 'idEchlant';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'idEchlant',
        'Description',
    ];

    /**
     * public function category (){
     *  return $this->belongsTo(Categorie::class,'idCategorie', 'idCategorie');
     * }
     *
     * public function grade (){
     * return $this->belongsTo(Grade::class,'idGarde','idGrade');
     * }
     */

}
