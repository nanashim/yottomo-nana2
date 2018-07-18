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
        
        // $me = User::select('id')->where('id', 16)->get();
        
        // foreach ($me as $ma) {
        //     echo $ma->id;
        // }
        
        // $user = User::find($id);
        
        // $me = User::select('id')->where('id', 16)->get();
        // foreach ($me as $ma) {
        //     return $ma->id;
        // }
        
        $user = User::find($id);
        // $hogeは、自分をフォローしてくれている人たちが入っている
        $hoge_a = User_friend::join('users','users.id','=','user_friend.user_id')
                    ->select('users.*')
                    ->where('friend_id',$id)
                    ->pluck('id')
                    ->toArray();
                    // ->paginate(10);
        
        // $futuresは、自分がフォローしている人たちが入っている
        $futures_a = User_friend::join('users','users.id','=','user_friend.friend_id')
                    ->select('users.*')
                    ->where('user_id',$id)
                    ->pluck('id')
                    ->toArray();
                    // ->paginate(10);
        
        $sougo_id = array_intersect($futures_a, $hoge_a);
        
        $data = [];
        
        if($sougo_id){
            
                $futures = User::select()->whereIn('id', $sougo_id)->paginate(10);
                
                $data = [
                    'user' => $user,
                    'users' => $futures,
                ];
                
                array_push($data, ['user' => $user], ['users' => $futures]);
                // array_push($data['users'], ['key' => 'val']);
                
        
                $data += $this->counts($user);
        
                
            
        }else{
            $futures = null;
             $data = [
                    'user' => $user,
                    'users' => $futures,
                ];
                
                array_push($data, ['user' => $user], ['users' => $futures]);
                // array_push($data['users'], ['key' => 'val']);
                
        
                $data += $this->counts($user);
        }    
        return view('users.futures', $data);
        // print_r($sougo_id);
        // exit;
        // var_dump($futures);
        // usersテーブルの中から、【Judy】を取得し、$userに格納
        // $user = User::find($id);
        // $userに格納された【Judy】をフレンドしている人たちを$futuresに格納→【Jet】と【Yuki】
        // $futures = $user->futures()->paginate(10);
        
        // $userに格納された【Judy】がフレンドしている人たちを$friendsに格納→【Jet】
        // $friends = $user->friends()->paginate(10);
        //user_friendテーブルの中から、【Judy】がフレンドしている人たちを$hogeに格納→【Jet】(※でもuser_friendテーブルのデータ形式じゃ使えない)
        // $hoge = User_friend::all()->where('user_id', '=', '$id');
        
        // $hogehoge = array_diff($futures, $friends);
        // $key = array_search('id', $friends);
        // $friendsのidと$futuresのuser_idが一致していれば取得したい
        // $hogeのfriend_idと$futuresのuser_idが一致していれば取得したい
        // $sougo = $futures->where('user_id', '=', '$friends['id']);
                
                
                
        
        // $futures = $user->futures()->where('friend_id', '=', $id)->get();

        
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
