<?php

namespace App\Http\Controllers;

use App\Models\Article; // Importer le modèle Article
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Article::all()); // Utiliser response()->json pour une réponse JSON
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'title' => 'required|string|max:200',
            'body' => 'required|string',
        ]);

        // Création d'un nouvel article
        $article = Article::create($validatedData);
        return response()->json($article, 201); // Retourner l'article créé avec un code 201 (Created)
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json(['message' => 'Article non trouvé'], 404);
        }

        return response()->json($article); // Retourner l'article trouvé
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json(['message' => 'Article non trouvé'], 404);
        }

        // Validation des données
        $validatedData = $request->validate([
            'title' => 'required|string|max:200',
            'body' => 'required|string',
        ]);

        // Mise à jour de l'article
        $article->update($validatedData);
        return response()->json($article); // Retourner l'article mis à jour
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json(['message' => 'Article non trouvé'], 404);
        }

        // Suppression de l'article
        $article->delete();
        return response()->json(['message' => 'Article supprimé avec succès'], 200); // Retourner un message de succès avec code 200
    }
}
