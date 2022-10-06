<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Returnerar alla lagrade produkter
        return Product::all();
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
            'name' => 'required',
            'category_name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ]);

        //Lägger till och returnerar den nya producten som har skapats
        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Hämtar product utifrån dess id
        $product = Product::find($id);

        //Kontroll om variabeln $product inte är lika med null
        if ($product != null) {
            //Returnerar producten
            return $product;
        } else {
            //Skriver ut felmeddelande och felkoden 404 om variabeln $product är null
            return response()->json([
                'Produkten kunde inte hittas!'
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
        //Hämtar product utifrån dess id och sparar i variabeln $product
        $product = Product::find($id);

        //Validerar och kontrollerar att allt är ifyllt. Krav på att alla fält ska vara ifyllda
        $request->validate([
            'name' => 'required',
            'category_name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ]);

        //Kontroll om variabeln $product inte är lika med null
        if ($product != null) {
            //Uppdaterar 
            $product->update($request->all());
            //Returnerar det uppdaterade innehållet
            return $product;
        } else {
            //Returnerar ett felmeddelande och felkod om producten inte kunde hittas
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
       //Hämtar product utifrån dess ID
       $product = Product::find($id);

       //Kontroll om product inte är lika med null
       if ($product != null) {
           //Tar bort product
           $product->delete();
           //Returnerar 
           return response()->json(['Produkten har tagits bort']);
       } else {
           return response()->json(['Produkten kunde inte hittas'], 404);
       }
    }
}
