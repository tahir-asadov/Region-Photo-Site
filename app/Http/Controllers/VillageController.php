<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.village.index', [
            'villages' => Village::latest()->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.village.create');
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
            'title' => 'required|min:3|max:64|unique:villages',
            'slug' => 'required|min:3|max:64|unique:villages',
        ]);
        
        Village::create($validatedData);

        return redirect()->route('village.index')->with('success', 'Village added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function show(Village $village)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function edit(Village $village)
    {
        return view('admin.village.edit', [
            'village' => $village
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Village $village)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:64|unique:villages,title,' . $village->id,
            'slug' => 'required|min:3|max:64|unique:villages,slug,' . $village->id,
        ]);

        $village->title = $request->input('title');
        $village->slug = $request->input('slug');
        $village->save();
        return redirect()->route('village.index')->with('success', 'Village updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function destroy(Village $village)
    {
        $village->delete();
        return redirect()->route('village.index')->with('success', 'Village deleted!');
    }
}
