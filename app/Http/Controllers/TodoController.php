<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $todosdb = Todo::all();
        $param = ['tag' => $todosdb, 'tag' => $tagdb, 'user' => $userdb];
        return view('index', ['todos' => $param]);
    }

    public function create(TodoRequest $request)
    {
        $contents = $request->all();
        Todo::create($contents);
        return redirect('/');
    }

    public function update(TodoRequest $request)
    {
        $contents = $request->all();
        unset($contents['_token']);
        Todo::find($request->id)->update($contents);
        return redirect('/');
    }

    public function delete($id)
    {
        $contents = Todo::find($id);
        unset($contents['_token']);
        $contents->delete();
        return redirect('/');
    }

    public function check(Request $request)
    {
        $text = ['text' => 'ログインして下さい。'];
        return view('auth', $text);
    }

    public function checkUser(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Todo::attempt([
            'email' => $email,
            'password' => $password
        ])) {
            $text =   Auth::user()->name . 'さんがログインしました';
        } else {
            $text = 'ログインに失敗しました';
        }
        return view('auth', ['text' => $text]);
    }
}
