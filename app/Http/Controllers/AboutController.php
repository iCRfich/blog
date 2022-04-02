<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role: user']);
    }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($request->all());
        if ($request->isMethod('post')) {
            $validate = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'name'  => 'required',
                'surname'  => 'required',
                'image'  => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'about'  => 'required'
            ]);
            if ($validate->fails()) {
                return back()->withErrors($validate)->withInput();
            }
        }
        else if ($request->isMethod('patch')) {
            $validate = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'name'  => 'required',
                'surname'  => 'required',
                'about'  => 'required'
            ]);
            if ($validate->fails()) {
                return back()->withErrors($validate)->withInput();
            }
        }
        $about = new About();
        $about->orUpdateOrCreate($request);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
