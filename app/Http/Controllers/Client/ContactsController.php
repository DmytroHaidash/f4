<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Contracts\View\View;

class ContactsController extends Controller
{
    public function index(): View
    {
        $contacts = Contact::ordered()->get();

        return view('client.contacts.index', compact('contacts'));
    }
}
