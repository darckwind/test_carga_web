<?php

namespace App\Http\Controllers;

use App\result_test;
use App\load_test;
use Illuminate\Http\Request;

class ResultTestController extends Controller
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
     * @param  \App\result_test  $result_test
     * @return \Illuminate\Http\Response
     */
    public function show($load_test_id)
    {
        $all_result = result_test::all()->where('load_test_id',$load_test_id);
        $data_load_test = load_test::find($load_test_id);
        //die($all_result);
        return view('test_result.show',compact('all_result','data_load_test'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\result_test  $result_test
     * @return \Illuminate\Http\Response
     */
    public function edit(result_test $result_test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\result_test  $result_test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, result_test $result_test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\result_test  $result_test
     * @return \Illuminate\Http\Response
     */
    public function destroy(result_test $result_test)
    {
        //
    }
}
