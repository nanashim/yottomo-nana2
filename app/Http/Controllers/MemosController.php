<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class MemosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $memos = $user->memos()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'memos' => $memos,
            ];
            $data += $this->counts($user);
            return view('users.show', $data);
        }else {
            return view('welcome');
        }
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:191',
        ]);

        $request->user()->memos()->create([
            'content' => $request->content,
        ]);

        return redirect()->back();
    }
    
    public function destroy($id)
    {
        $memo = \App\Memo::find($id);

        if (\Auth::id() === $memo->user_id) {
            $memo->delete();
        }

        return redirect()->back();
    }
}
