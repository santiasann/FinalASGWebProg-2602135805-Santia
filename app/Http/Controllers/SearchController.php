<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;

class SearchController extends Controller
{
    //
    public function index(Request $request){
        $searchTerm = $request->input('search'); // Ambil input pencarian
        $articles = Donasi::where('judul', 'LIKE', "%{$searchTerm}%")
            ->orWhere('deskripsi', 'LIKE', "%{$searchTerm}%")
            ->get();

        return view('menu.search', compact('articles', 'searchTerm'));
    }
}
