<?php

namespace App\Http\Controllers;

use App\Helper\ImageResizer;
use App\Models\Funding;
use App\Models\Ukm;
use Illuminate\Http\Request;

class FundingController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    // api funding

    public function apiIndex(Request $request)
    {
        $query = Funding::query();

        // Filter berdasarkan nama yang dicari
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%$search%");
        }

        // Filter berdasarkan jenis category ukm
        if ($request->has('category_id')) {
            $category_id = $request->category_id;
            $query->whereHas('ukm', function ($q) use ($category_id) {
                $q->where('category_id', $category_id);
            });
        }

        // Filter sort
        if ($request->has('sort')) {
            $sort = $request->sort;
            if ($sort == 'amount_asc') {
                $query->orderBy('current_amount', 'asc');
            } elseif ($sort == 'amount_desc') {
                $query->orderBy('current_amount', 'desc');
            } elseif ($sort == 'latest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($sort == 'oldest') {
                $query->orderBy('created_at', 'asc');
            }
        }

        $fundings = $query->with('ukm')->where('status',0)->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Funding',
            'data' => $fundings
        ], 200);
    }

    public function apiIndexDetail($id) {

        $fundings = Funding::with('ukm', 'payments.user')->where('id', $id)->first();

        return response()->json([
            'success' => true,
            'message' => 'List Data Funding',
            'data' => $fundings
        ], 200);
    }




    public function index()
    {

        $fundings = Funding::with('ukm')->get();



        return view('pages.funding.index', compact('fundings'));



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $ukms = Ukm::all();

        return view('pages.funding.create',compact('ukms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required',
            'fund_raise_use' => 'required',
            'ukm_id' => 'required',
            'target_amount' => 'required',
        ]);

        $image = $request->file('image');
        $getImageName = ImageResizer::ResizeImage($image, 'images', 'images',  300, 300 , 'webp');
        $bigImage = ImageResizer::ResizeImage($image, 'images', 'images',  1500, 1500 , 'webp',100);
        $funding = new Funding();
        $funding->title = $request->title;
        $funding->image = $getImageName;
        $funding->big_image = $bigImage;
        $funding->fund_raise_use = $request->fund_raise_use;
        $funding->ukm_id = $request->ukm_id;
        $funding->target_amount = $request->target_amount;
        $funding->current_amount = 0;
        $funding->status = 0;
        $funding->save();

        return redirect()->route('funding.index')
        ->with('success', 'Funding created successfully.');
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {


        // delete
        $funding = Funding::find($id);
        $funding->delete();

        return redirect()->route('fundings.index');
    }
}
