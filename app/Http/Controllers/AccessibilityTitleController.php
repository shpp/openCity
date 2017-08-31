<?php

namespace App\Http\Controllers;

use App\AccessibilityTitle;
use Illuminate\Http\Request;

class AccessibilityTitleController extends Controller
{
    public function show(AccessibilityTitle $accessibilityTitle)
    {
        return view('accessibility_titles.show', compact('accessibilityTitle'));
    }
}
