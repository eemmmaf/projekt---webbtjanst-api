<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;

class AuthController extends Controller
{
    //Funktion för att registrera användare
    public function register(Request $request)
    {
        //Validerar att alla fält är ifyllda och att emailadressen är unik
        $validatedUser = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]
        );

        //Om det inmatade är inte är korrekt
        if ($validatedUser->fails()) {
            return response()->json([
                //Visar felmeddelande och felkod 401 
                'message' => 'Ange korrekt mail/lösenord/namn',
                'error' => $validatedUser->errors()
            ], 401);
        }

        //Om det inmatade är korrekt lagras användaren och en token returneras. Löenordet hashas.
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);

        //Skapar token
        $token = $user->createToken('Apitoken')->plainTextToken;

        $response = [
            'message' => 'Användare har skapats',
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    //Funktion för att logga in användare
    public function logIn(Request $request)
    {
        //Både mailadress och lösenord krävs
        $validatedUser = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        //Om det inmatade saknas
        if ($validatedUser->fails()) {
            return response()->json([
                //Returnerar felmeddelande och felkod 401
                'message' => 'Ange korrekt mail/lösenord/namn',
                'error' => $validatedUser->errors()
            ], 401);
        }

        //Kontroll om felaktig inloggning
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Felaktig mailadress eller lösenord'
            ], 401);
        }

        //Om inloggningen lyckas returneras en access-token. Ett meddelande och 200 returneras.
        $user = User::where('email', $request->email)->first();
        return response()->json([
            'message' => 'Användare har loggats in',
            'token' => $user->createToken('Apitoken')->plainTextToken
        ], 200);
    }

    //Funktion för att logga ut 
    public function logOut(Request $request)
    {
        //Tar bort token
        $request->user()->currentAccessToken()->delete();

        $response = [
            'message' => 'Användare har loggats ut'
        ];

        //Returnerar meddelande och kod 200
        return response($response, 200);
    }
}
