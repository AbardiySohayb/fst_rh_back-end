<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriquePromotion extends Model
{
    use HasFactory;

    // Si le nom de la table n'était pas le pluriel par défaut, tu devrais le préciser :
    // protected $table = 'historique_promotions';

    // Champs assignables en masse (lors d'un create/update)
    protected $fillable = [
        'user_id',
        'action',
        'ancien_grade',
        'nouveau_grade',
        'date_action',
    ];

    // Relation avec User (si elle existe)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
