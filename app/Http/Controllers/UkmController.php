<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ukm;
use Illuminate\Http\Request;

class ukmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $ukms = ukm::all();

        return view('pages.ukm.index', compact('ukms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all();

        return view('pages.ukm.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'email' => 'required|email',
            'wa' => 'required',
            'proposal_url' => 'required|url',
            'pitch_deck_url' => 'required|url',
            'category_id' => 'required',
            'status' => 'required|boolean',
        ]);

        $ukm = new UKM;
        $ukm->name = $validatedData['name'];
        $ukm->description = $validatedData['description'];
        $ukm->email = $validatedData['email'];
        $ukm->wa = $validatedData['wa'];
        $ukm->proposal_url = $validatedData['proposal_url'];
        $ukm->pitch_deck_url     = $validatedData['pitch_deck_url'];
        $ukm->category_id = $validatedData['category_id'];
        $ukm->status = $validatedData['status'];
        $ukm->save();

        return redirect()->route('ukms.index')->with('success', 'UKM berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $ukm = ukm::find($id);
        $categories = Category::all();
        return view('pages.ukm.edit', compact('ukm', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'email' => 'required|email',
            'wa' => 'required',
            'proposal_url' => 'required|url',
            'pitch_deck_url' => 'required|url',
            'category_id' => 'required',
            'status' => 'required|boolean',
        ]);

        $ukm = ukm::find($id);

        $ukm->name = $validatedData['name'];
        $ukm->description = $validatedData['description'];
        $ukm->email = $validatedData['email'];
        $ukm->wa = $validatedData['wa'];
        $ukm->proposal_url = $validatedData['proposal_url'];
        $ukm->pitch_deck_url     = $validatedData['pitch_deck_url'];
        $ukm->category_id = $validatedData['category_id'];
        $ukm->status = $validatedData['status'];
        $ukm->save();

        return redirect()->route('ukms.index')->with('success', 'UKM berhasil diubah.');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $ukm = ukm::find($id);

        $ukm->delete();

        return redirect()->route('ukms.index')->with('success', 'UKM berhasil dihapus.');
    }
}
