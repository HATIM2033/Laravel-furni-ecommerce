<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile page.
     */
    public function index(Request $request): View
    {
        return view('profile.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    
    /**
     * Display the user's contact messages.
     */
    public function messages(Request $request): View
    {
        $messages = ContactMessage::where('email', $request->user()->email)
            ->latest()
            ->get();
            
        return view('profile.messages', [
            'user' => $request->user(),
            'messages' => $messages,
        ]);
    }
    
    /**
     * Display a specific contact message.
     */
    public function showMessage(Request $request, ContactMessage $contactMessage): View
    {
        // Ensure user can only view their own messages
        if ($contactMessage->email !== $request->user()->email) {
            abort(403, 'Unauthorized');
        }
        
        return view('profile.message-show', [
            'user' => $request->user(),
            'message' => $contactMessage,
        ]);
    }
}
