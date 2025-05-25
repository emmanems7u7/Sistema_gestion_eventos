<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\User;
class WelcomeController extends Controller
{
    public function welcome()
    {
        $users = User::paginate(4);
        $inventarios = Inventario::with('imagenes')->paginate(4);

        return view('welcome', compact('users', 'inventarios'));
    }
}
