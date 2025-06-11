<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'idCategorie';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['idCategorie', 'Description'];

    public function grades()
    {
        return $this->hasMany(Grade::class, 'idCategorie', 'idCategorie');
    }

    public function echlants()
    {
        return $this->hasMany(Echlant::class, 'idCategorie', 'idCategorie');
    }

    public function indices()
    {
        return $this->hasMany(Indice::class, 'idCategorie', 'idCategorie');
    }
}
