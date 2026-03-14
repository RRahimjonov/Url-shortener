<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Arr;

class LinkController extends Controller
{
    public function store(Request $request){

        $validated = $request->validate([
            'original_url' => 'required|url',
            'custom_code' => 'nullable|unique:links,short_code'
        ]);

        $customCode = $request->custom_code;
       $shortCode = ($customCode) ? $customCode : str()->random(6);

       $validated = Arr::except($validated, ['custom_code']);

        $link = Link::create(array_merge($validated, ['short_code' => $shortCode]));

        return redirect('/')->with('new_link', $link);
    }

    public function redirect($shortCode){

        $link = Link::where('short_code', $shortCode)->firstOrFail();
        $link->increment('click');
       return redirect($link->original_url);

    }
}
