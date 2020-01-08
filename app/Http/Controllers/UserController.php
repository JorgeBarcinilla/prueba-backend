<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('name','ASC')
                    ->identification($request->identification)
                    ->name($request->name)
                    ->dateBirth($request->date_birth)
                    ->country($request->country_id)
                    ->city($request->city_id)
                    ->get();
        return response()->json($users->load('country','city'),200)
        ->withHeaders([
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
        'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE',
        'content-type'=>'application/json; charset=utf-8'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = new User();
        $user->name =$request->name;
        $user->surnames =$request->surnames;
        $user->identification =$request->identification;
        $user->date_birth =$request->date_birth;
        $user->country_id =$request->country;
        $user->city_id =$request->city;
        $user->save();
        return response()->json(['message'=>'Usuario creado exitosamente'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->name =$request->name;
        $user->surnames =$request->surnames;
        $user->identification =$request->identification;
        $user->date_birth =$request->date_birth;
        $user->country_id =$request->country;
        $user->city_id =$request->city;
        $user->save();

        return response()->json(['message'=>'Usuario modificado']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message'=>'Usuario eliminado']);
    }
}
