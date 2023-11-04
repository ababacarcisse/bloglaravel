<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Méthode pour récupérer la liste des tâches paginée avec leurs catégories
    public function index(){
        return Task::with("category")->paginate(5);
    }

    // Méthode pour créer une nouvelle tâche
    public function store(Request $request){
        $task = Task::create([
            "title" => $request->title,
            "body"=> $request->body,
            "category_id"=> $request->category_id,
        ]);
        return $task;
    }

    // Méthode pour afficher une tâche spécifique
    public function show(Task $task){
        return $task;
    }

    // Méthode pour mettre à jour une tâche existante
    public function update(Request $request, Task $task){
        $task->update([
            "title" => $request->title,
            "body"=> $request->body,
            "category_id"=> $request->category_id,
            "done"=> $request->done,
        ]);
        return $task;
    }

    // Méthode pour supprimer une tâche
    public function destroy(Task $task){
        $task->delete();
        return response()->json(["message"=>"task deleted"]);
    }

    // Méthode pour récupérer les tâches associées à une catégorie spécifique
    public function getTaskByCategory(Category $category){
        return $category->tasks()->with("category")->paginate(10);
    }

    // Méthode pour trier les tâches par colonne et direction spécifiées
    public function getTaskBy($column , $direction){
        return Task::with("category")->orderBy($column , $direction)->paginate(10);
    }

    // Méthode pour rechercher des tâches en fonction d'un terme de recherche
    public function getTaskByTerm($term){
        $task = Task::with("category")
            ->where("title","like","%".$term."%")
            ->orWhere("body","like","%".$term."%")
            ->orWhere("id","like","%".$term."%")
            ->paginate(10);
        return $task;
    }
}