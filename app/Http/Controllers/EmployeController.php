<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RH\Employe;
use App\Models\RH\Echlant;
use App\Models\RH\Indice;
use App\Models\RH\Grade;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
class EmployeController extends Controller
{
    //trouver un employé
    public function searchEmploye(Request $request){

        $searchTerm = Str::lower($request->value);
        $employes = Employe::where(DB::raw("LOWER(nom)"),'LIKE',"%{$searchTerm}%")
                           ->orWhere(DB::raw("LOWER(prenom)"),'LIKE',"%{$searchTerm}%")
                           ->get();
        return response()->json([
                'data' => $employes
        ]);
    }





    /*
        Mise à jour automatique des échelons .( se trouve dans job pour une)
        si garder cette fonction dans le controller il faudrait un button au haut du page
        et il faudrait que le responsable RH click un button qui execute cette fonction chaque
        jour pour synchornizer au jour actuelle

    public function updateEchlons()
    {
        $employes = Employe::all();
        $now = Carbon::now();
        $updatedCount = 0;

        foreach ($employes as $employe){
            // Uniformiser les noms de variables
            $currentEchlon = $employe->idEchlant;
            $currentGrade = $employe->idGrade;
            $categorie = $employe->idCategorie;

            // Dates de l'ancien échelon et différence avec maintenant
            $ancienneteEchelon = $employe->AncienneteEchelon;
            $ancienneteEchelon = Carbon::parse($ancienneteEchelon);
            $diffYears = $ancienneteEchelon->diffInYears($now);

            // Vérifier s'il a passé 2 ans dans un échelon
            if ($diffYears >= 2){
                $nextEchlonValue = $currentEchlon + 1;

                // Vérifier si cet échelon existe pour ce grade et cette catégorie
                $indiceExists = Indice::where('idEchlant', $nextEchlonValue)
                                    ->where('idGrade', $currentGrade)
                                    ->where('idCategorie', $categorie)
                                    ->exists();

                if($indiceExists) {
                    $employe->idEchlant = $nextEchlonValue;
                    $employe->AncienneteEchelon = $now;
                    $employe->save();
                    $updatedCount++;
                } else {
                    if($currentGrade != "D") {
                        // Logique pour notification d'augmentation de grade
                    }
                }
            }
        }

        return response()->json(['message' => 'Mise à jour des échelons effectuée.', 'count' => $updatedCount]);
    }*/

    /*
     Button de Promotion manuelle de l'employé vers un grade supérieur.

    public function promoteEmploye(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:employes,id',
        ]);

        $employe = Employe::findOrFail($request->id);

        $employeGrade = $employe -> idGrade;
        $employeCategorie = $employe -> idCategorie;

        if ($employeGrade == "A") {
            $employe -> idGrade = "B";
            $employe -> idEchlant = 1;
            $employe -> save();
        } elseif ($employeGrade == "B") {
            $employe -> idGrade = "C";
            $employe -> idEchlant = 1;
            $employe -> save();
        } elseif ($employeGrade == "C" && Str::lower($employeCategorie) != "maitre de conference habilite")
        {
            $employe -> idGrade = "D";
            $employe -> idEchlant = 1;
            $employe -> save();
        } else {
            return response()->json(['message' => 'No higher grade available.'], 400);
        }

        return response()->json([
            'message' => 'Employé promu avec succès.',
            'new_grade' => $employe->idGrade,
            'new_echlon' => $employe->idEchlant
        ], 200);

    }*/

/*

    public function getPromotableEmployees()
    {
        $now = Carbon::now();
        $employes = Employe::whereNotNull('AncienneteEchelon') // Assure-toi que l'ancienneté est définie
            ->get()
            ->filter(function($employe) use ($now) {
                // Calculer la différence d'années entre la date actuelle et la date d'ancienneté de l'échelon
                $anciennete = Carbon::parse($employe->AncienneteEchelon);
                $diffYears = $anciennete->diffInYears($now);

                // Vérifier si l'employé a 2 ans ou plus dans son échelon
                return $diffYears >= 2;
            });

        return response()->json($employes);
    }



}*/
    //CRUD
    public function getAllEmployees()
    {
        $employees = Employe::all(); // Fetch all records from the 'employe' table
        return response()->json($employees);
    }

    public function addEmploye(Request $request)
    {
        // Validation des données envoyées
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'dateNaissance' => 'required|date',
            'adresse' => 'required|string',
            'telephone' => 'required|string|max:15',
            'email' => 'required|email|unique:employes,email',
            'departement' => 'required|string',
            'poste' => 'required|string',
            'dateDeRecrutement' => 'required|date',
            'dateDeGrade' => 'required|date',
            'AncienneteEchelon' => 'required|date',
            'typeContrat' => 'required|string',
            'statut' => 'required|string',
            'idCategorie' => 'required|string',
            'idGrade' => 'required|string',
            'idEchlant' => 'required|string',
        ]);

        // Création de l'employé avec les données validées
        $employe = Employe::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'dateNaissance' => $validated['dateNaissance'],
            'adresse' => $validated['adresse'],
            'telephone' => $validated['telephone'],
            'email' => $validated['email'],
            'departement' => $validated['departement'],
            'poste' => $validated['poste'],
            'dateDeRecrutement' => $validated['dateDeRecrutement'],
            'dateDeGrade' => $validated['dateDeGrade'],
            'AncienneteEchelon' => $validated['AncienneteEchelon'],
            'typeContrat' => $validated['typeContrat'],
            'statut' => $validated['statut'],
            'idCategorie' => $validated['idCategorie'],
            'idGrade' => $validated['idGrade'],
            'idEchlant' => $validated['idEchlant'],
        ]);

        // Retourner une réponse JSON avec l'employé ajouté
        return response()->json($employe, 201); // 201 signifie "created"
    }

    public function deleteEmploye(Request $request)
    {
        // Validation de l'ID de l'employé
        $request->validate([
            'id' => 'required|integer|exists:employes,id',
        ]);

        // Recherche de l'employé par ID
        $employe = Employe::find($request->id);

        // Suppression de l'employé
        $employe->delete();

        // Retourner une réponse JSON indiquant la suppression réussie
        return response()->json(['message' => 'Employé supprimé avec succès'], 200);
    }

    public function modifyEmploye(Request $request)
    {
        // Validation des données envoyées
        $validated = $request->validate([
            'id' => 'required|integer|exists:employes,id', // Validation de l'ID de l'employé
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'dateNaissance' => 'required|date',
            'adresse' => 'required|string',
            'telephone' => 'required|string|max:15',
            'email' => 'required|email|unique:employes,email,' . $request->id, // Exclure l'employé actuel
            'departement' => 'required|string',
            'poste' => 'required|string',
            'dateDeRecrutement' => 'required|date',
            'dateDeGrade' => 'required|date',
            'AncienneteEchelon' => 'required|date',
            'typeContrat' => 'required|string',
            'statut' => 'required|string',
            'idCategorie' => 'required|string',
            'idGrade' => 'required|string',
            'idEchlant' => 'required|string',
        ]);

        // Recherche de l'employé par ID
        $employe = Employe::find($request->id);

        // Mise à jour des données de l'employé
        $employe->update([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'dateNaissance' => $validated['dateNaissance'],
            'adresse' => $validated['adresse'],
            'telephone' => $validated['telephone'],
            'email' => $validated['email'],
            'departement' => $validated['departement'],
            'poste' => $validated['poste'],
            'dateDeRecrutement' => $validated['dateDeRecrutement'],
            'dateDeGrade' => $validated['dateDeGrade'],
            'AncienneteEchelon' => $validated['AncienneteEchelon'],
            'typeContrat' => $validated['typeContrat'],
            'statut' => $validated['statut'],
            'idCategorie' => $validated['idCategorie'],
            'idGrade' => $validated['idGrade'],
            'idEchlant' => $validated['idEchlant'],
        ]);


        // Retourner la réponse JSON avec l'employé mis à jour
        return response()->json($employe);
    }





public function updateEchlons(Request $request)
{
    $employeIds = $request->input('employeIds', []);

    // Si aucun ID n'est fourni, on retourne 0
    if (empty($employeIds)) {
        return response()->json([
            'message' => 'Aucun ID fourni.',
            'updated' => 0
        ], 400);
    }

    $employes = Employe::whereIn('id', $employeIds)->get();
    $now = Carbon::now();
    $updatedCount = 0;

    foreach ($employes as $employe) {
        $currentEchlon = $employe->idEchlant;
        $currentGrade = $employe->idGrade;
        $categorie = $employe->idCategorie;
        $nextEchlonValue = $currentEchlon + 1;

        // Vérifier si l'échelon suivant existe pour ce grade et cette catégorie
        $indiceExists = Indice::where('idEchlant', $nextEchlonValue)
                            ->where('idGrade', $currentGrade)
                            ->where('idCategorie', $categorie)
                            ->exists();

        if ($indiceExists) {
            // Mettre à jour l'échelon et l'ancienneté
            $employe->idEchlant = $nextEchlonValue;
            $employe->AncienneteEchelon = $now;
            $employe->save();
            $updatedCount++;
        } else {
            // Échelon max atteint, possibilité de changement de grade
            if ($currentGrade != "D") {
                // À implémenter : logique d'augmentation de grade
            }
        }
    }

    return response()->json([
        'message' => 'Mise à jour terminée.',
        'updated' => $updatedCount
    ]);
}



// Modifier l'ancienne fonction pour renvoyer l'indice d'un employé par ceci :
public function getEmployeIndice($employeId){

        $employe = Employe::findOrFail($employeId);

        $employeGrade = $employe -> idGrade;
        $employeEchlon = $employe -> idEchlant;
        $employeCategorie = $employe -> idCategorie;

        $employeIndice = Indice::where('idEchlant',$employeEchlon)
                               ->where('idGrade',$employeGrade)
                               ->where('idCategorie',$employeCategorie)
                               ->first();

        return response()->json([
            'indice' => $employeIndice
        ]);
}


// fonction pour verifier si un employe a besoin d'une augmentation d'echlant
public function needUpdate($id){

        $now = Carbon::now();
        $employe = Employe::find($id);

            //Current Information about the employe
            $currentEchlon = $employe -> idEchlant;
            $currentGrade = $employe -> idGrade;
            $categorie = $employe -> idCategorie;

            //dates of the last Echelon and the difference with now
            $ancienneteEchelon = $employe -> AncienneteEchelon;
            $ancienneteEchelon = Carbon::parse($ancienneteEchelon);
            $diffYears = $ancienneteEchelon->diffInYears($now);

            //check if he spent 2 years in an echlon
            if ($diffYears >= 2){
                return true ;
            }
            return false;
}



// fonction du filtrage  qui renvoie tous les employes d'une categorie ou grade ou echelon ou une combinaison de deux ou de trois
public function filterEmployes(Request $request)
{
    $categorie = $request->category;
    $grade = $request->grade;
    $echelon = $request->echelon;

    $query = Employe::query();

    if (!is_null($categorie)) {
        $query->where('idCategorie', $categorie);
    }

    if (!is_null($grade)) {
        $query->where('idGrade', $grade);
    }

    if (!is_null($echelon)) {
        $query->where('idEchlant', $echelon);
    }

    $employes = $query->get();

	return response()->json([
                'data' => $employes
        ]);
}



//fonction pour renvoyer les ids des  employes concerner par la mise à jour des echelons , à partir des employé d'un filtre envoyé en parametre
public function getConcernedEmployes(Request $request)
{
    $employes = $request->input('employes');

    $filtered = collect($employes)->filter(function ($employe) {
        return $this->needUpdate($employe['id']);
    })->values();

    return response()->json(['data' => $filtered]);
}



//fonction reàoit les ids des concerné et genere un document

public function generateUpdateEchelonDoc(array $selectedIds)

{
    $employes = Employe::whereIn('id', $selectedIds)->get();
    $employesWithIndice = $employes->map(function ($employe) {
        $indice = DB::table('indices')
            ->where('idCategorie', $employe->idCategorie)
            ->where('idGrade', $employe->idGrade)
            ->where('idEchlant', $employe->idEchlant)
            ->first();
        $employe->indiceId = $indice->idIndice ?? '';
        $nextEchelon = $employe->idEchlant + 1;
        $nextIndice = DB::table('indices')
            ->where('idCategorie', $employe->idCategorie)
            ->where('idGrade', $employe->idGrade)
            ->where('idEchlant', $nextEchelon)
            ->first();
        $employe->nextIndiceId = $nextIndice->idIndice ?? '';
        $employe->nextEchelon = $nextEchelon;
        return $employe;
    });

    if ($employesWithIndice->isEmpty()) {
        return response()->json(['message' => 'Aucun employé trouvé'], 404);
    }

    $echelons = [
        1 => 'الأولى', 2 => 'الثانية', 3 => 'الثالثة', 4 => 'الرابعة', 5 => 'الخامسة',
        6 => 'السادسة', 7 => 'السابعة', 8 => 'الثامنة', 9 => 'التاسعة', 10 => 'العاشرة'
    ];

    $grades = ['A' => 'أ', 'B' => 'ب', 'C' => 'ج', 'D' => 'د'];

    $categories = [
        'MAITRE DE CONFERENCES HABILITE' => 'أستاذ محاضر مؤهل',
        'PROFESSEUR ENSEIGNEMENT SUPERIEUR' => 'أستاذ التعليم العالي',
        'MAITRE DE CONFERENCES' => 'أستاذ محاضر'
    ];

    $exampleEmploye = $employesWithIndice->first();
    $categorieLabel = $categories[$exampleEmploye->idCategorie] ?? $exampleEmploye->idCategorie;
    $gradeLabel = $grades[$exampleEmploye->idGrade] ?? $exampleEmploye->idGrade;
    $proposedDate = \Carbon\Carbon::now()->addYears(2)->format('Y/m/d');

    // Déterminer les échelons actuels et suivants pour le procès-verbal
    $currentEchelon = $echelons[$exampleEmploye->idEchlant] ?? $exampleEmploye->idEchlant;
    $nextEchelon = $echelons[$exampleEmploye->nextEchelon] ?? $exampleEmploye->nextEchelon;

    // Créer un nouveau document TCPDF
    $pdf = new \TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Définir les informations du document
    $pdf->SetCreator('FST Digital');
    $pdf->SetAuthor('FST Marrakech');
    $pdf->SetTitle('وثائق الترقية');
    $pdf->SetSubject('Promotion Echelon');

    // Supprimer les en-têtes et pieds de page par défaut
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Définir les marges
    $pdf->SetMargins(10, 10, 10);

    // Définir l'auto-saut de page
    $pdf->SetAutoPageBreak(true, 10);

    // Définir le mode d'affichage
    $pdf->SetDisplayMode('real', 'default');

    // Définir la direction RTL (droite à gauche) pour l'arabe
    $pdf->setRTL(true);

    // Préparer le contenu HTML pour TCPDF
    $html = View::make('pdf.echelon_update', [
        'employes' => $employesWithIndice,
        'echelons' => $echelons,
        'categorieLabel' => $categorieLabel,
        'gradeLabel' => $gradeLabel,
        'proposedDate' => $proposedDate,
        'currentEchelon' => $currentEchelon,
        'nextEchelon' => $nextEchelon
    ])->render();

    // Ajouter une page
    $pdf->AddPage('P', 'A4');

    // Définir la police
    $pdf->SetFont('aealarabiya', '', 12);

    // Écrire le HTML au PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Générer un nom de fichier unique avec date
    $date = \Carbon\Carbon::now()->format('Y-m-d');
    $fileName = 'Documents_Promotion_' . $date . '_' . \Illuminate\Support\Str::random(4) . '.pdf';
    $path = storage_path("app/public/{$fileName}");

    // Enregistrer le PDF sur le disque
    $pdf->Output($path, 'F');

    return response()->json([
        'success' => true,
        'message' => 'PDF généré avec succès',
        'pdf_url' => asset("storage/{$fileName}")
    ]);
}




}

