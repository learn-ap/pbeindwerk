<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->withTrashed()->paginate(20); // Gebruik paginate en laad rollen
        return view('backend.users.index', compact('users')); // we nemen alle gebruikers uit de database via de model User en steken dit in een var ($users), dan via de compact geven we deze variabele(zie het als een zipbestand) aan een view blade page
    }

    public function create()
    {
        $roles = Role::all();
        return view('backend.users.create', compact('roles'));
    }

    //    Request => komst van illuminate
    //    $request is de var waarin de ingevulde formulier gegevens worden opgeslagen
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required'
        ]); // voordat de ingevulde gegevens worden opgeslagen moeten we eerst validaties uitvoeren

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]); // neem de ingevulde gegevens van de form en voeg ze toe aan de database

        $user->assignRole($request->role); // Wijs de gebruiker de opgegeven rol toe

        if ($request->hasFile('profile_image')) {
            $user->addMedia($request->file('profile_image'))->toMediaCollection('profile_images');
        } // Controleer of er een profielfoto is geüpload en voeg deze toe aan de 'profile_images' media-collection van de gebruiker

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('backend.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('backend.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required'
        ]); // voordat de ingevulde gegevens worden bijgewerkt, moeten we eerst validaties uitvoeren

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]); // Update de gebruikersgegevens

        $user->syncRoles($request->role); // Synchroniseer de rollen van de gebruiker met de opgegeven rol

        if ($request->hasFile('profile_image')) {
            $user->clearMediaCollection('profile_images');
            $user->addMedia($request->file('profile_image'))->toMediaCollection('profile_images');
        } // Controleer of er een nieuwe profielfoto is geüpload en update deze in de 'profile_images' media-collection van de gebruiker

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete(); // de trait SoftDeletes hebben we in onze User model toegevoegd dus de standaard delete is nu een softdelete geworden
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore(); // Herstel de verwijderde gebruiker

        return redirect()->route('users.index')->with('success', 'User restored successfully.');
    }
}

