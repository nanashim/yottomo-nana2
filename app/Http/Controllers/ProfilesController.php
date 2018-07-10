<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Profile;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = User::all();
        
        return view('profiles.show',[
            'profiles' => $profiles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profile = new User;
        
        return view('profiles.create',[
            'profile' => $profile,
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
        $this->validate($request, [
            'content' => 'max:191',
            'birthday' => 'max:191',
            'birthplace' => 'max:191',
            'character1' => 'max:191',
            'character2' => 'max:191',
            'hobby' => 'max:191',
            'charmpoint' => 'max:191',
            'dream' => 'max:191',
            'app' => 'max:191',
        ]);
        
        $profile = new User;
        $profile->content = $request->content;
        $profile->birthday = $request->birthday;
        $profile->birthplace = $request->birthplace;
        $profile->character1 = $request->character1;
        $profile->character2 = $request->character2;
        $profile->hobby = $request->hobby;
        $profile->charmpoint = $request->charmpoint;
        $profile->dream = $request->dream;
        $profile->app = $request->app;
        $profile->save();
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = \App\User::find($id);
        
        return view('users.show',[
            'profile' => $profile,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = User::find($id);
        
        return view('profiles.edit',[
            'profile' => $profile,
        ]);
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
        $this->validate($request, [
            'content' => 'max:191',
            'birthday' => 'max:191',
            'birthplace' => 'max:191',
            'character1' => 'max:191',
            'character2' => 'max:191',
            'hobby' => 'max:191',
            'charmpoint' => 'max:191',
            'dream' => 'max:191',
            'app' => 'max:191',
        ]);
        
        $profile = User::find($id);
        $profile->content = $request->content;
        $profile->birthday = $request->birthday;
        $profile->birthplace = $request->birthplace;
        $profile->character1 = $request->character1;
        $profile->character2 = $request->character2;
        $profile->hobby = $request->hobby;
        $profile->charmpoint = $request->charmpoint;
        $profile->dream = $request->dream;
        $profile->app = $request->app;
        $profile->save();
        
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = User::find($id);
        $profile->delete();
        
        return redirect('/');
    }
}
