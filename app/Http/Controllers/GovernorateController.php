<?php

namespace App\Http\Controllers;

use App\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
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
        $mapKeys = [
            ['EGY1536', 'Suez'],
            ['EGY1546', 'Bani Suwayf'],
            ['EGY1550', 'Al Wadi at Jadid'],
            ['EGY1551', 'Qina'],
            ['EGY1552', 'Suhaj'],
            ['EGY1557', 'Janub Sina'],
            ['EGY1558', 'Shamal Sina'],
            ['EGY5494', 'Luxor'],
        ];
        return view('add.governorate')->with('mapKeys', $mapKeys);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name_en' => 'required|unique:governorates,name_en|max:64',
            'name_ar' => 'required|unique:governorates,name_ar|max:64',
            'map_key' => 'required|unique:governorates,map_key'
        ]);

        Governorate::create($validatedData);
        
        return redirect()->back()->withSuccess(__('Governorate added successfully!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gorvernorate  $gorvernorate
     * @return \Illuminate\Http\Response
     */
    public function show(Gorvernorate $gorvernorate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gorvernorate  $gorvernorate
     * @return \Illuminate\Http\Response
     */
    public function edit(Gorvernorate $gorvernorate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gorvernorate  $gorvernorate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gorvernorate $gorvernorate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gorvernorate  $gorvernorate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gorvernorate $gorvernorate)
    {
        //
    }
}
