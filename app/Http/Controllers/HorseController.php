<?php

namespace App\Http\Controllers;

use App\Models\horse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;

class HorseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('horses.index', ['horses' => Horse::orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('horses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules = [
            'name' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|unique:horses|max:100',
            'runs' => 'required|',
            'wins' => 'required|lte:runs|gt:-1',
            'about' => 'required'
        ];

    	$customMessages = [
    		'name.required' => 'Please, insert your name.',
    		'runs.required' => 'Please, insert runs.',
        	'wins.required'  => 'Please, insert wins.',
            'about.required' => 'Please, something write',
    	];

    	$this->validate($request, $rules, $customMessages);

        $horse = new Horse();
        // can be used for seeing the insides of the incoming request
            // dd($request->all()); die();
           $horse->fill($request->all());
           $horse->save();
           return redirect()->route('horses.index')->with('message', 'Added successful!');    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function show(horse $horse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function edit(horse $horse)
    {
        return view('horses.edit', ['horse' => $horse]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, horse $horse)
    {

        $request->validate([
            'name' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|unique:horses|max:100',
            'runs' => 'required|',
            'wins' => 'required|lte:runs|gt:-1',
            'about' => 'required'
        ]);

        $horse->fill($request->all());
        $horse->save();
        return redirect()->route('horses.index')->with('message', 'Changed successful!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function destroy(horse $horse)
    {
        if (count($horse->betters)){ 
            return back()->withErrors(['error' => ['Can\'t delete horse with better assigned, please unassign first!']]);
        }
        $horse->delete();
        return redirect()->route('horses.index');
    }
}
