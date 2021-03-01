<?php

namespace App\Http\Controllers;

use App\environment;
use Illuminate\Http\Request;

class EnvironmentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $env_data = environment::all();
        return view('environment.index',compact('env_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('environment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'env_machine_name'=>'required',
            'env_machine_os',
            'env_thread'=>'required',
            'env_ram'=>'required',
            'env_server'=>'required'
            ]);
        $env =  new environment();
        $env->env_machine_name = $request->input('env_machine_name');
        $env->env_machine_os = $request->input('env_machine_os');
        $env->env_thread = $request->input('env_thread');
        $env->env_ram = $request->input('env_ram');
        $env->env_server = $request->input('env_server');
        $env->user_id = $request->input('user_id');
        $env->save();

        return redirect()->route('env.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\environment  $environment
     * @return \Illuminate\Http\Response
     */
    public function show(environment $environment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\environment  $environment
     * @return \Illuminate\Http\Response
     */
    public function edit($environment)
    {
        $env_data_edit = environment::find($environment);
        return view('environment.edit',compact('env_data_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\environment  $environment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$environment)
    {
        $env_data_update = environment::find($environment);
        $env_data_update->env_machine_name = $request->input('env_machine_name');
        $env_data_update->env_machine_os = $request->input('env_machine_os');
        $env_data_update->env_thread = $request->input('env_thread');
        $env_data_update->env_ram = $request->input('env_ram');
        $env_data_update->env_server = $request->input('env_server');
        $env_data_update->user_id = $request->input('user_id');
        $env_data_update->save();
        return redirect()->route('env.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\environment  $environment
     * @return \Illuminate\Http\Response
     */
    public function destroy($environment)
    {
        $env_destroy = environment::find($environment);
        $env_destroy->delete();
        return redirect()->route('env.index');
    }
}
