<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\Feedback;
use App\Models\Contact;
use App\Models\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;


class ContactsController extends Controller
{
    public function index(): View
    {
        $contacts = Contact::ordered()->get();
        $page = Page::where('slug', 'about')->first();
        return view('client.contacts.index', compact('contacts', 'page'));
    }

    public function feedback(Request $request): RedirectResponse
    {
        $data = [
            'user' => (object)$request->only('name', 'phone', 'email'),
            'message' => $request->input('message'),
        ];
        Mail::send(new Feedback($data));

        return redirect()->route('client.index');
    }
}
