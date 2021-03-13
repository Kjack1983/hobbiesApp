<?php

namespace App\Http\Controllers;

use App\Hobby;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HobbyController extends Controller
{

    public function __construct() {

        // Restrict the display if the user is not logged in only to index and show views.
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$hobbies = Hobby::all();
        
        //$hobbies = Hobby::paginate(10);
        $hobbies = Hobby::orderBy('created_at', 'DESC')->paginate(10);

        return view('hobby.index')->with([
            'hobbies' => $hobbies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hobby.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $request->validate(array(
            'name' => 'required|min:3',
            'description' => 'required|min:5'
        ));
        
        $hobby = new Hobby(array(
            'name' => $request->name,
            'description' => $request->description,
            'user_id' =>  auth()->id()
        ));

        $hobby->save();

        return $this->index()->with(array(
            'message_success' => 'The hobby <b>' .$hobby->name .'</b> was created successfully',
            'message_warrning' => 'Warning for <b>' .$hobby->name .'</b>'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function show(Hobby $hobby)
    {
        return view('hobby.show')->with(array(
            'hobby' => $hobby
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function edit(Hobby $hobby) 
    {
        return view('hobby.edit')->with(array(
            'hobby' => $hobby
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hobby $hobby)
    {
        // validation
        $request->validate(array(
            'name' => 'required|min:3',
            'description' => 'required|min:5'
        ));
        
        $hobby->update(array(
            'name' => $request->name,
            'description' => $request->description
        ));

        return $this->index()->with(array(
            'message_success' => 'The hobby <b>' .$hobby->name .'</b> was updated',
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hobby $hobby)
    {
        $oldName = $hobby->name;
        $hobby->delete();
        return $this->index()->with(array(
            'message_success' => 'The hobby <b>' . $oldName . '</b> was deleted successfully' 
        ));
    }
}
