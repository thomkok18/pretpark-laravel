<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            return view('producten/create')->with(compact('product'));
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
                'price' => 'required',
                'stock' => 'required',
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

            $product = new Product();
            $product->title = $request->input('title');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->stock = $request->input('stock');
            $product->cover_image = $fileNameToStore;

            $product->save();
            return redirect('/beheerder')->with('success', 'Product Aangemaakt');
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
        if (auth()->user()->id == 1) {
            $product = Product::find($id);
            if (auth()->user()->id == 1) {
                return view('producten/edit')->with('product', $product);
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
    public function update(Request $request, $id)
    {
        if (auth()->user()->id == 1) {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'price' => 'required',
                'stock' => 'required',
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

            $product = Product::find($id);
            $product->title = $request->input('title');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->stock = $request->input('stock');
            if ($request->hasFile('cover_image')) {
                if ($product->cover_image != 'noimage.jpg') {
                    Storage::delete('public/cover_images/' . $product->cover_image);
                }
                $product->cover_image = $fileNameToStore;
            }
            $product->save();
            return redirect('/beheerder')->with('success', 'Product Aangepast');
        } else {
            abort('403');
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
            $product = Product::find($id);

            if (auth()->user()->id == 1) {
                if ($product->cover_image != 'noimage.jpg') {
                    Storage::delete('public/cover_images/' . $product->cover_image);
                }
                $product->delete();
            }
            return redirect('/beheerder')->with('success', 'Product verwijderd');
        } else {
            abort('403');
        }
    }
}
