<?php

namespace App\Http\Controllers\Client;

use App\Models\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function show(Page $page, Page $subpage = null): View
    {
        if ($subpage) {
            $page = $subpage;
        }

        return view('client.pages.default', compact('page'));
    }
}
