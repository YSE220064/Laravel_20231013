<?php

// namespace（名前空間）：packageみたいなもの
namespace App\Http\Controllers;

// プログラムの読み込み：importみたいなもの
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class HomeController extends Controller
{
    function about() {
        return view('about');
    }

    function search(Request $request) {
        $data = [
                    'keyword' => $request->q
                ];
                // Viewファイルにデータを渡す
                return view('search', $data);    }
}
