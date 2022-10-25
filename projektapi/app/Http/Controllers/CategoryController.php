<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;

class CategoryController extends Controller
{
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
    public function getCategoryById($id)
    {

        //Hämtar Produkt utifrån dess id
        $category = Category::find($id);

        //Kontroll om variabeln $product inte är lika med null
        if ($category != null) {
            //Returnerar Produkten
            return $category;
        } else {
            //Skriver ut felmeddelande och felkoden 404 om variabeln $product är null
            return response()->json([
                'Produkten kunde inte hittas!'
            ], 404);
        }
    }

    public function updateCategory(Request $request, $id)
    {
        //Hämtar product utifrån dess id och sparar i variabeln $product
        $category = Category::find($id);

        //Validerar och kontrollerar att allt är ifyllt. Krav på att alla fält ska vara ifyllda
        $request->validate([
            'categoryname' => 'required',
            'categorydescription' => 'required'
        ]);

        //Kontroll om variabeln $product inte är lika med null
        if ($category != null) {
            //Uppdaterar 
            $category->update($request->all());
            //Returnerar det uppdaterade innehållet
            return $category;
        } else {
            //Returnerar ett felmeddelande och felkod om producten inte kunde hittas
            return response()->json(['Kategorin kunde inte hittas'], 404);
        }
    }

    //Ta bort kategori
    public function deleteCategory($id)
    {
        //Hämtar product utifrån dess ID
        $category = Category::find($id);

        //Kontroll om producten inte är lika med null
        if ($category != null) {
            //Tar bort producten
            $category->delete();
            //Returnerar 
            return response()->json(['Kategorin har tagits bort']);
        } else {
            return response()->json(['Kategorin kunde inte hittas'], 404);
        }
    }
}



?>