<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('cors');
    }

    /**
     * Display a listing of the resource filtered.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();
        return response()->json($users->load('country','city'));

    }

    /**
     * Display a listing of the resource filtered.
     *
     * @return \Illuminate\Http\Response
     */
    public function filterResource(Request $request)
    {
        $users = User::orderBy('name','ASC')
                    ->identification($request->identification)
                    ->name($request->name)
                    ->dateBirth($request->date_birth)
                    ->country($request->country)
                    ->city($request->city)
                    ->get();

        return response()->json($users->load('country','city'));

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
        $user->name =$request->input('name');
        $user->surnames =$request->input('surnames');
        $user->identification =$request->input('identification');
        $user->date_birth =$request->input('date_birth');
        $user->country_id =$request->input('country');
        $user->city_id =$request->input('city');
        $user->save();
        return response()->json($request);
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
        $user->name = $request->name;
        $user->surnames = $request->surnames;
        $user->identification = $request->identification;
        $user->date_birth = $request->date_birth;
        $user->country_id = $request->country;
        $user->city_id = $request->city;
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
