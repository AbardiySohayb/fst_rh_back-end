<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $table = 'employes';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nom', 'prenom', 'dateNaissance', 'adresse', 'telephone', 'email',
        'departement', 'poste', 'dateDeRecrutement', 'dateDeGrade', 'AncienneteEchelon',
        'typeContrat', 'statut', 'photo', 'diplomes', 'competences', 'soldeConges',
        'idCategorie', 'idGrade', 'idEchlant'
    ];

    // Relations
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
