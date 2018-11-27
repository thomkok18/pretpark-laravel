<?php

namespace App\Http\Controllers;

use App\Attractie;
use App\Product;
use App\Reactie;
use Illuminate\Http\Request;

class ReactieController extends Controller
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
        $request->validate([
            'comment' => 'required'
        ]);

        $reactie = new Reactie();
        $reactie->attractie_id = request()->id;
        $reactie->user_id = auth()->user()->id;
        $reactie->comment = $request->input('comment');

        $reactie->save();
        return redirect('/attractie/'.request()->id)->with('success', 'Reactie Geplaatst');
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
        $reacties = Reactie::latest()->paginate(5);
        $product = new Product();
        return view('pages/attractie', compact('attractie', 'reacties', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reactie = Reactie::find($id);
        $product = new Product();
        if (auth()->user()->id == $reactie->user->id) {
            return view('reactie/edit')->with(compact('reactie', 'product'));
        } else {
            return redirect('/');
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
        $request->validate([
            'comment' => 'required',
        ]);

        $reactie = Reactie::find($id);
        $reactie->comment = $request->input('comment');

        $reactie->save();
        return redirect('/attractie/'.$reactie->attractie->id)->with('success', 'Reactie Aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reactie = Reactie::find($id);

        if (auth()->user()->id == $reactie->user->id) {
            $reactie->delete();
        }
        return back()->with('success', 'Reactie verwijderd');
    }
}
