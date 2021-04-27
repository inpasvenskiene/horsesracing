<?php

namespace App\Http\Controllers;

use App\Models\better;
use Illuminate\Http\Request;

class BetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){
        if(isset($request->horse_id) && $request->horse_id !== 0)
        $betters = \App\Models\better::where('horse_id', $request->horse_id)->orderBy('bet', 'asc')->get();
    else
        $betters = \App\Models\better::orderBy('bet', 'asc')->get();
        $horses =\App\Models\horse::orderBy('name', 'asc')->get();
    return view('betters.index', ['betters' => $betters, 'horses' => $horses]);

    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $horses = \App\Models\Horse::orderBy('name')->get();
        return view('betters.create', ['horses' => $horses]);
        
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
            'name' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|max:100',
            'surname' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|max:150',
            'bet' => 'required|gt:0',
            'horse_id' => 'required'
        ];

    	$customMessages = [
    		'name.required' => 'Please, insert your name.',
    		'surname.required' => 'Please, insert your surname.',
        	'bet.required'  => 'You must choose bet amount!',
            'horse_id.required' => 'Please, select horse',
    	];

    	$this->validate($request, $rules, $customMessages);

        $better = new Better();
        // can be used for seeing the insides of the incoming request
        // var_dump($request->all()); die();
        $better->fill($request->all());
        $better->save();
        return redirect()->route('betters.index')->with('message', 'Added successful!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\better  $better
     * @return \Illuminate\Http\Response
     */
    public function show(better $better)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\better  $better
     * @return \Illuminate\Http\Response
     */
    public function edit(better $better)
    {

        $horses = \App\Models\Horse::orderBy('name')->get();
        return view('betters.edit', ['better' => $better, 'horses' => $horses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\better  $better
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, better $better)
    {
        $request->validate([
            'name' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|unique:horses|max:100',
            'surname' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|max:150',
            'bet' => 'required|gt:0',
            'horse_id' => 'required'
        ]);

            $better->fill($request->all());
            $better->save();
            return redirect()->route('betters.index')->with('message', 'Changed successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\better  $better
     * @return \Illuminate\Http\Response
     */
    public function destroy(better $better, request $request)
    {
        $better->delete();
        return redirect()->route('betters.index', ['horse_id'=> $request->input('horse_id')]);

    }
}
