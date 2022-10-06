<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Returnerar alla lagrade kategorier
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validerar och kontrollerar att allt är ifyllt. Skrivs ut ett felmeddelande om något inte är ifyllt. Krav på att alla fält ska vara ifyllda
        $request->validate([
            'category_name'
        ]);

        //Lägger till och returnerar den nya categoryen som har skapats
        return Category::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Hämtar category utifrån dess id
        $category = Category::find($id);

        //Kontroll om variabeln $category inte är lika med null
        if ($category != null) {
            //Returnerar categoryen
            return $category;
        } else {
            //Skriver ut felmeddelande och felkoden 404 om variabeln $category är null
            return response()->json([
                'Kategorin kunde inte hittas!'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Hämtar category utifrån dess id och sparar i variabeln $category
        $category = category::find($id);

        //Validerar och kontrollerar att allt är ifyllt. Krav på att alla fält ska vara ifyllda
        $request->validate([
            'category_name'
        ]);

        //Kontroll om variabeln $category inte är lika med null
        if ($category != null) {
            //Uppdaterar 
            $category->update($request->all());
            //Returnerar det uppdaterade innehållet
            return $category;
        } else {
            //Returnerar ett felmeddelande och felkod om categoryen inte kunde hittas
            return response()->json(['Produkten kunde inte hittas'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Hämtar category utifrån dess ID
        $category = Category::find($id);

        //Kontroll om category inte är lika med null
        if ($category != null) {
            //Tar bort category
            $category->delete();
            //Returnerar 
            return response()->json(['Kategorin har tagits bort']);
        } else {
            return response()->json(['Kategorin kunde inte hittas'], 404);
        }
    }
}
