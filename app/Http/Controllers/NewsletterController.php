<?php

namespace App\Http\Controllers;

use App\Models\NewsletterRecipients;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:newsletter_recipients,email',
        ]);

        NewsletterRecipients::create([
            'email' => $validated['email'],
            'subscribed_at' => now("America/Caracas"),
            'enabled' => true
        ]);

        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
} 