<?php

namespace App\Http\Controllers;

use App\Attractie;
use App\Cart;
use App\Cart_item;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttractieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attracties = Attractie::paginate(5);
        $producten = Product::paginate(5);
        $users = User::paginate(5);
        $cart_items = Cart_item::paginate(5);

        $product = new Product();

        if (request()->is('beheerder')) {
            if (auth()->user()->id == 1) {
                return view('pages/beheerder', compact('attracties', 'producten', 'users', 'product'));
            } else {
                abort('403');
            }
        } else if (request()->is('winkel')) {
            $producten = Product::latest()->paginate(5);
            return view('pages/winkel', compact('producten', 'product', 'cart_items'));
        } else {
            $attracties = Attractie::latest()->paginate(12);
            if (auth()->check()) {
                $user = auth()->user();

                $cart = new Cart();
                $cart->user_id = auth()->user()->id;

                if ($user->getCartByUserId($user->id) == 0) {
                    $cart->save();
                }
            }

            return view('index', compact('attracties', 'product'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->id == 1) {
            $product = new Product();
            return view('attracties/create')->with(compact('product'));
        } else {
            abort('403');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->id == 1) {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'cover_image' => 'image|nullable|max:1999'
            ]);

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
                $fileNameToStore = 'noimage.jpg';
            }

            $attractie = new Attractie();
            $attractie->user_id = auth()->user()->id;
            $attractie->title = $request->input('title');
            $attractie->description = $request->input('description');
            $attractie->cover_image = $fileNameToStore;

            $attractie->save();
            return redirect('/beheerder')->with('success', 'Attractie Aangemaakt');
        } else {
            abort('403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attractie = Attractie::find($id);
        return view('pages/attractie', compact('attractie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->id == 1) {
            $attractie = Attractie::find($id);
            $product = new Product();
            if (auth()->user()->id == $attractie->user->id) {
                return view('attracties/edit')->with(compact('attractie', 'product'));
            } else {
                return redirect('/beheerder');
            }
        } else {
            abort('403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attractie $attractie)
    {
        if (auth()->user()->id == 1) {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'cover_image' => 'image|nullable|max:1999'
            ]);

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
                $fileNameToStore = 'noimage.jpg';
            }

//            $attractie->update([
//                'title' => request('title'),
//                'description' => request('description')
//            ]);

            $attractie->title = $request->input('title');
            $attractie->description = $request->input('description');
            if ($request->hasFile('cover_image')) {
                if ($attractie->cover_image != 'noimage.jpg') {
                    Storage::delete('public/cover_images/' . $attractie->cover_image);
                }
                $attractie->cover_image = $fileNameToStore;
            }
            $attractie->save();
            return redirect('/beheerder')->with('success', 'Attractie Aangepast');
        } else {
            abort('403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if (auth()->user()->id == 1) {
            $attractie = Attractie::find($id);

            if (auth()->user()->id == $attractie->user->id) {
                if ($attractie->cover_image != 'noimage.jpg') {
                    Storage::delete('public/cover_images/' . $attractie->cover_image);
                }
                $attractie->delete();
            }
            return redirect('/beheerder')->with('success', 'Attractie verwijderd');
        } else {
            abort('403');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Uitgelogd');
    }
}
