<?php

namespace App\Http\Controllers\Settings;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;


class LocaleController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'locale' => 'required|in:en,es'
        ]);

        $locale = $request->input('locale');

        // Update the user's locale preference (if authenticated)
        if (Auth::check()) {
            Auth::user()->update(['locale' => $locale]);
        }

        App::setLocale($locale);

        // Store the locale in the session (for guest users)
        session()->put('locale', $locale);

        return redirect()->back(); // Redirect back to the previous page
    }
}
