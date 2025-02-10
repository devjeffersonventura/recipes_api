<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecipeController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::all();
        return response()->json($recipes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação
        $validator = Validator::make($request->all(), Recipe::rules());

        // Se houver erros
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Cria a receita
        $recipe = Recipe::create($request->all());

        // Retorna a receita criada com o status 201 (created)
        return response()->json($recipe, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $recipe = Recipe::find($id);

        // Verifica se a receita foi encontrada
        if (!$recipe) {
            return response()->json(['error' => 'Receita não encontrada'], 404);
        }

        return response()->json($recipe);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $recipe = Recipe::find($id);

        // Se a receita não foi encontrada retorna um erro 404
        if (!$recipe) {
            return response()->json(['error' => 'Receita não encontrada'], 404);
        }

        // Validação
        $validator = Validator::make($request->all(), Recipe::rules());

        // Se houver erros, retorna um erro 422
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Atualiza a receita
        $recipe->update($request->all());

        // Retorna a receita atualizada com o status 200 (ok)
        return response()->json($recipe);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recipe = Recipe::find($id);

        // Se a receita não foi encontrada retorna um erro 404
        if (!$recipe) {
            return response()->json(['error' => 'Receita não encontrada'], 404);    
        }

        // Deleta a receita
        $recipe->delete();

        // Retorna a receita deletada com o status 204 (no content)
        return response()->json(null, 204);
    }
}
