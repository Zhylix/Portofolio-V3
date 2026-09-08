<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\Profile;
use App\Models\SocialLink;
use App\Services\ContactMessageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function index(): View
    {
        $profile = Profile::first();
        $socialLinks = SocialLink::ordered()->get();

        return view('pages.contact', compact('profile', 'socialLinks'));
    }

    public function store(StoreContactMessageRequest $request, ContactMessageService $service): RedirectResponse
    {
        $service->store($request->validated());

        return back()->with('success', 'Thank you! Your message has been received.');
    }
}
