<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Platillo;
class PublicController extends Controller
{
    //
    public function menu()
    {
        $platillos = Platillo::all();
        return view('menu.index', compact('platillos'));
    }
}
