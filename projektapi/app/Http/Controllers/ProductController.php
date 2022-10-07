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
            'quantity' => 'required',
            'category_id' => 'required'
        ]);

        //Lägger till och returnerar den nya podcasten som har skapats
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
}
