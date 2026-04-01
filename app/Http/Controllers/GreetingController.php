<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GreetingController extends Controller
{
    public function statelessIndex()
    {
        return view('stateless', [
            'message' => 'はじめまして',
            'name' => null,
            'error' => null,
        ]);
    }

    public function statelessStore(Request $request)
    {
        $name = trim((string) $request->input('name', ''));

        if ($name === '') {
            return view('stateless', [
                'message' => 'はじめまして',
                'name' => null,
                'error' => '名前を入力してください。',
            ]);
        }

        if (mb_strlen($name) > 50) {
            return view('stateless', [
                'message' => 'はじめまして',
                'name' => null,
                'error' => '名前は50文字以内で入力してください。',
            ]);
        }

        // セッションへは保存しない（ステートレス）
        return view('stateless', [
            'message' => "こんにちは {$name} さん",
            'name' => $name,
            'error' => null,
        ]);
    }

    public function statefulIndex(Request $request)
    {
        $name = $request->session()->get('name');

        return view('stateful', [
            'message' => $name ? "こんにちは {$name} さん" : 'はじめまして',
            'name' => $name,
        ]);
    }

    public function statefulStore(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
        ]);

        $request->session()->put('name', $validated['name']);

        return redirect()->route('stateful.index');
    }
}
