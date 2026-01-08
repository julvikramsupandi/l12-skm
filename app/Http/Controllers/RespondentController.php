<?php

namespace App\Http\Controllers;

use App\Models\Unor;
use Illuminate\Http\Request;
use Inertia\Inertia;


class RespondentController extends Controller
{
    public function index()
    {

        $unors = Unor::all();
        return Inertia::render('Respondent/RespondentPage', [
        // 'title' => $title,
            'unors' => $unors,
        ]);
    }
}
