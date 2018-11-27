<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return User
     */
    public function index()
    {
        $product = new Product();
        return view('home')->with(compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function updatePersoonsgegevens(Request $request, $id)
    {
        if (auth()->user()->id == $id) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
            ]);

            $user = User::find($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');

            $user->save();
            return redirect('/home')->with('success', 'Persoonsgegevens Aangepast');
        }
    }

    public function updateWachtwoord(Request $request, $id)
    {
        if (auth()->user()->id == $id) {
            $request->validate([
                'password' => 'required|string|min:6|confirmed',
            ]);

            $user = User::find($id);
            if ($request->input('password') == $request->input('password_confirmation')) {
                $user->password = bcrypt($request->input('password'));

                $user->save();
                return redirect('/home')->with('success', 'Wachtwoord Aangepast');
            } else {
                return redirect('/home')->with('error', 'Nieuw wachtwoord komt niet overeen');
            }
        }
    }

    public function updateProfielfoto(Request $request, $id)
    {
        if (auth()->user()->id == $id) {
            $request->validate([
                'cover_image' => 'image|nullable|max:1999'
            ]);

            $user = User::find($id);
            if ($request->hasFile('cover_image')) {
                // Get filename with the extension
                $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('cover_image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                // Upload Image
                $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            } else {
                $fileNameToStore = $user->cover_image;
            }

            $user->cover_image = $fileNameToStore;

            $user->save();
            return redirect('/home')->with('success', 'Profielfoto Aangepast');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->id == 1) {
            $user = User::find($id);

            if (auth()->user()->id == 1) {
                $user->delete();
            }
            return redirect('/beheerder')->with('success', 'Account verwijderd');
        } else {
            abort('403');
        }
    }
}
