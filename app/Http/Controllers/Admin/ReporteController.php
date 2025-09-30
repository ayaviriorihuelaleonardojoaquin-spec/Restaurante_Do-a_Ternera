<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index()
    {
        // Aquí puedes generar reportes de ventas, pedidos, etc.
        return view('admin.reportes');
    }
}
