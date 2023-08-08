<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        $website = Website::create($data);

        return response()->json($website, 201);
    }

    public function showCreateWebsiteForm()
    {
        return view('pages.create-website');
    }
}

