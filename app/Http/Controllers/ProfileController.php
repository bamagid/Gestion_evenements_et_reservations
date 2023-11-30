<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        if (Auth::guard('association')) {
            return view('profile.edit', [
                'user' => Auth::guard('association')->user(),
            ]);
        }
        if (Auth::guard('client')) {
            return view('profile.edit', [
                'user' => Auth::guard('client')->user(),
            ]);
        }
        abort(403, "Vous ne pouvez pas accedez a cette page");
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        if (Auth::guard('client')) {
            $request->user()->guard('client')->fill($request->validated());

            if ($request->user()->guard('client')->isDirty('email')) {
                $request->user()->guard('client')->email_verified_at = null;
            }

            $request->user()->guard('client')->save();
            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        }
        if (Auth::guard('association')) {
            $request->user()->guard('association')->fill($request->validated());

            if ($request->user()->guard('association')->isDirty('email')) {
                $request->user()->guard('association')->email_verified_at = null;
            }

            $request->user()->guard('association')->save();
            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        }

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
}
