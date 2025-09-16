<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::with('roles')->paginate(15);
        
        return view('users.index', compact('users'));
    }

    public function show(User $user): View
    {
        $user->load('roles');
        
        return view('users.show', compact('user'));
    }

    public function edit(User $user): View
    {
        $user->load('roles');
        $roles = Role::all();
        
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'bio' => 'nullable|string|max:1000',
            'title' => 'nullable|string|max:255',
            'avatar' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'team' => 'nullable|string|max:255',
            'social_links' => 'nullable|array',
            'is_author' => 'boolean',
            'roles' => 'array',
            'roles.*' => 'exists:roles,id'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio,
            'title' => $request->title,
            'avatar' => $request->avatar,
            'country' => $request->country,
            'position' => $request->position,
            'team' => $request->team,
            'social_links' => $request->social_links,
            'is_author' => $request->boolean('is_author'),
        ]);

        if ($request->has('roles')) {
            $user->roles()->sync($request->roles);
        }

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
