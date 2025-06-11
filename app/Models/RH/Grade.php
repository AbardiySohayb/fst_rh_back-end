<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $primaryKey = 'idGrade';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['idGrade', 'Description'];

    /**
     * public function category (){
     *  return this->belongsTo(Categorie::class,'idCategorie', 'idCategorie');
     * }
     *
     */

    public function categories()
    {
        return $this->hasMany(Category::class, 'idGrade', 'idGrade');
    }

    public function echlants()
    {
        return $this->hasMany(Echlant::class, 'idGrade', 'idGrade');
    }

    public function indices()
    {
        return $this->hasMany(Indice::class, 'idGrade', 'idGrade');
    }
}
