<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Model;

class Indice extends Model
{
    protected $primaryKey = ['idIndice', 'idCategorie', 'idGrade', 'idEchlant'];
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = ['idIndice', 'Description', 'idCategorie', 'idGrade', 'idEchlant'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'idCategorie', 'idCategorie');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'idGrade', 'idGrade');
    }

    public function echlant()
    {
        return $this->belongsTo(Echlant::class, 'idEchlant', 'idEchlant');
    }
}
