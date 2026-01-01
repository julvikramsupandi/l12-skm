<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class BerandaController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('beranda', [
            'title' => 'Beranda',
        ]);
    }
}
