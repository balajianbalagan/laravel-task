<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request, Website $website)
    {
        $user = Auth::user() ?? null;

        // Create subscription without user selection default as id=  1
        $subscription = Subscription::firstOrCreate([
            'user_id' => $user ? $user->id : 1,
            'website_id' => $website->id,
        ]);

        return response()->json($subscription, 201);
    }
    public function showSubscribeForm(Website $website)
    {
        return view('pages.subscribe-website', compact('website'));
    }
}
