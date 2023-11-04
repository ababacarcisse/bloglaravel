<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| C'est ici que vous pouvez enregistrer les routes de l'API pour votre application.
| Ces routes sont chargées par le RouteServiceProvider et toutes sont assignées
| au groupe de middleware "api". Faites quelque chose de génial !
|
*/

// Route protégée par le middleware "auth:sanctum" pour obtenir les informations de l'utilisateur actuellement authentifié
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes pour les opérations CRUD (Create, Read, Update, Delete) sur les tâches
Route::get('tasks', [TaskController::class, 'index']); // Récupérer la liste des tâches
Route::post('tasks', [TaskController::class, 'store']); // Créer une nouvelle tâche
Route::get('tasks/{task}', [TaskController::class, 'show']); // Afficher une tâche spécifique
Route::put('tasks/{task}', [TaskController::class, 'update']); // Mettre à jour une tâche existante
Route::delete('tasks/{task}', [TaskController::class, 'destroy']); // Supprimer une tâche

// Route pour obtenir les tâches associées à une catégorie spécifique
Route::get('category/{category}/tasks', [TaskController::class, 'getTaskByCategory']);

// Route pour effectuer une recherche de tâches en fonction d'un terme de recherche
Route::get('search/{term}/tasks', [TaskController::class, 'getTaskByTerm']);

// Route pour trier les tâches en fonction de la colonne et de la direction spécifiées
Route::get('order/{column}/{direction}/tasks', [TaskController::class, 'getTaskByOrderBy']);