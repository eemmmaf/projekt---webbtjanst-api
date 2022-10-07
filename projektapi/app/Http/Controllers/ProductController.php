<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;

class ProductController extends Controller
{
    public function addProduct(Request $request, $id)
    {
        //Läser in kategorin och ser vilket id den har
        $category = Category::find($id);

        //Om kategorin inte finns och returnerar null
        if ($category == null) {
            return response()->json([
                'Kategorin hittades inte'
            ], 404);
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ]);

        //Lägger till och returnerar den nya Produkten som har skapats
        return Products::create($request->all());

        return response()->json([
            'Produkt har lagts till'
        ], 200);
    }

    //Lägg till kategori
    public function addCategory(Request $request)
    {
        //Validerar och kontrollerar att allt är ifyllt. Skrivs ut ett felmeddelande om något inte är ifyllt. Krav på att alla fält ska vara ifyllda
        $request->validate([
            'categoryname' => 'required',
            'categorydescription' => 'required'
        ]);

        return Category::create($request->all());
    }

    //Hämta alla kategorier
    public function getCategories(Request $request)
    {
        //Returnerar alla lagrade kategorier
        return Category::all();
    }

    //Funktion för att hämta en produkt utifrån produktens id
    public function getProductById($id)
    {

        //Hämtar Produkt utifrån dess id
        $product = Products::find($id);

        //Kontroll om variabeln $product inte är lika med null
        if ($product != null) {
            //Returnerar Produkten
            return $product;
        } else {
            //Skriver ut felmeddelande och felkoden 404 om variabeln $product är null
            return response()->json([
                'Produkten kunde inte hittas!'
            ], 404);
        }
    }

    public function updateProduct(Request $request, $id)
    {
        //Hämtar product utifrån dess id och sparar i variabeln $product
        $product = Products::find($id);

        //Validerar och kontrollerar att allt är ifyllt. Krav på att alla fält ska vara ifyllda
        $request->validate([
            'name' => 'required',
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
            return response()->json(['producten kunde inte hittas'], 404);
        }
    }

    //Funktion för att ta bort en produkt
    public function destroy($id)
    {
        //Hämtar product utifrån dess ID
        $product = Products::find($id);

        //Kontroll om producten inte är lika med null
        if ($product != null) {
            //Tar bort producten
            $product->delete();
            //Returnerar 
            return response()->json(['Produkten har tagits bort']);
        } else {
            return response()->json(['Producten kunde inte hittas'], 404);
        }
    }

    //Funktion för att söka efter produkt
    public function searchProduct($name)
    {
        return Products::where('name', 'like', '%' . $name . '%')->get();
    }
}
