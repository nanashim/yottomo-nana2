<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\Controller;

use App\User;
use App\User_friend;
use App\Memo;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(20);
        
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        $memos = $user->memos()->orderBy('created_at', 'desc')->paginate(10);
        
        $data = [
            'user' => $user,
            'memos' => $memos,
        ];
        
        $data += $this->counts($user);
        
        return view('users.show', $data);
    }
    
    public function edit($id)
    {
        $user = User::find($id);
        // $memos = $user->memos()->orderBy('created_at', 'desc')->paginate(10);
        
        $data = [
            'user' => $user,
        //     'memos' => $memos,
        ];
        
        $data += $this->counts($user);
        
        return view('users.edit', $data);
        
        
    }
    
    public function friends($id)
    {
        $user = User::find($id);
        $friends = $user->friends()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $friends,
        ];

        $data += $this->counts($user);

        return view('users.friends', $data);
    }
    
    
    // zuttomo
    public function zuttomoings($id)
    {
        $user = User::find($id);
        $zuttomoings = $user->zuttomoings()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $zuttomoings,
        ];

        $data += $this->counts($user);

        return view('users.zuttomoings', $data);
    }
    
    // future
    public function futures($id)
    {
        $user = User::find($id);
        $futures = $user->futures()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $futures,
        ];

        $data += $this->counts($user);

        return view('users.futures', $data);
    }
    
    // public function futures($id)
    // {
    //     $user = User::find($id);
    //     $futures = $user->futures()->where('user_id', '=', $id);

    //     $data = [
    //         'user' => $user,
    //         'users' => $futures,
    //     ];

    //     $data += $this->counts($user);

    //     return view('users.futures', $data);
    // }
    
    
//     public function futures($id)
    // {
//         $user = User::select();
// // dd($user);
//         return view('users.futures', $user);
        
    // }    
        
        
        
        // $users = DB::table('users')->get();

        // return view('users.futures', ['users' => $users]);
    
    
}
