<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/employes', [EmployeController::class, 'getAllEmployees']);
Route::post('/employes/add', [EmployeController::class, 'addEmploye']);
Route::delete('/employes/delete', [EmployeController::class, 'deleteEmploye']);
Route::put('/employes/update', [EmployeController::class, 'modifyEmploye']);

// Récupération de l'indice d'un employé
Route::get('/employes/{employeId}/indice', [EmployeController::class, 'getEmployeIndice']);

// Route pour filtrer les employés (à la place de searchEmploye)
Route::post('/employes/filter', [EmployeController::class, 'filterEmployes']);
/*
// Route pour obtenir les employés qui ont besoin de mise à jour
Route::get('/employes/need-update/{id}', [EmployeController::class, 'needUpdate']);

// Nouvelle route pour avoir tous les employés qui ont besoin de mise à jour
Route::get('/employes/need-updates', function (EmployeController $controller) {
    $employes = \App\Models\Employe::all();
    return $controller->getConcernedEmployes($employes->toArray());
});*/

Route::post('/employes/concerned', [EmployeController::class, 'getConcernedEmployes']);
Route::post('/employes/updateEchlon', [EmployeController::class, 'updateEchlons']);



// Route pour générer un document d'augmentation d'échelons
Route::post('/employes/generate-update-doc', function(Request $request, EmployeController $controller) {
    return $controller->generateUpdateEchelonDoc($request->selectedIds);
});
