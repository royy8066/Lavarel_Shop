<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function setLocale(Request $request)
    {
        $request->validate([
            'locale' => 'required|in:vi,en',
        ]);

        session(['locale' => $request->locale]);

        return response()->json([
            'success' => true,
            'locale' => $request->locale,
        ]);
    }
}
