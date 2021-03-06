<?php

namespace App\Http\Controllers;

use App\load_test;
use App\environment;
use App\result_test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoadTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        $load_test_data = load_test::has('environment')->get();
        return view('load.index',compact('load_test_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('load.create');
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
            'load_test_name'=>'required',
            'load_test_base_url'=>'required',
            'load_test_post_url'=>'required',
            'load_test_num_usr'=>'required',
            'load_test_csv_token'=>'required|mimes:csv,txt',
            'load_test_file_charge'=>'nullable|mimes:scala,txt',
            'env_id'=>'required'
        ]);
        $load_test = new load_test();
        $load_test->load_test_name = $request->input('load_test_name');
        $load_test->load_test_base_url = $request->input('load_test_base_url');
        $load_test->load_test_post_url = $request->input('load_test_post_url');
        $load_test->load_test_num_usr = $request->input('load_test_num_usr');
        $load_test->load_test_ramp_usr = $request->input('load_test_ramp_usr',0)?: 0;
        if($request->input('load_test_rand_anws')=="on"){
            $load_test->load_test_rand_anws = true;
        }else{
            $load_test->load_test_rand_anws = false;
        }
        $load_test->load_test_csv_token_name = $request->load_test_csv_token->getClientOriginalName();
        $load_test->load_test_csv_token = $request->load_test_csv_token->storeAs('gatling/src/test/resources',$request->load_test_csv_token->getClientOriginalName(),'public');
        if($request->hasFile('load_test_file_charge')){
            $load_test->load_test_file_charge_name = $request->load_test_file_charge->getClientOriginalName();
            $load_test->load_test_file_charge = $request->load_test_file_charge->storeAs('gatling/src/test/scala/computerdatabase',$request->load_test_file_charge->getClientOriginalName(),'public');
        }
        $load_test->env_id = $request->input('env_id');
        $load_test->save();
        return redirect()->route('load.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\load_test  $load_test
     * @return \Illuminate\Http\Response
     */
    public function show($load_test)
    {
        $data_test = load_test::find($load_test);
        
        $file_path = "../public/storage/gatling/src/test/resources/data.conf";
        $file = fopen($file_path,'w');
        fwrite($file,'url_base = "'.$data_test->load_test_base_url.'"');
        fwrite($file, "\n");
        fwrite($file,'url_post = "'.$data_test->load_test_post_url.'"');
        fwrite($file, "\n");
        fwrite($file,'n_user = "'.$data_test->load_test_num_usr.'"');
        fwrite($file, "\n");
        fwrite($file,'anw_rand = "'.$data_test->load_test_rand_anws.'"');
        fwrite($file, "\n");
        fwrite($file,'ramp_usr = "'.$data_test->load_test_ramp_usr.'"');
        fwrite($file, "\n");
        fwrite($file,'csv_file = "'.$data_test->load_test_csv_token_name.'"');
        fwrite($file, "\n");
        fclose($file);
        $com = "cd storage/gatling && mvn gatling:test -Dgatling.simulationClass=computerdatabase.".substr($data_test->load_test_file_charge_name,0,-6);
        exec($com,$out);
        foreach ($out as $line) {
            if (str_starts_with($line, 'Please open the following file:')) {
                //example path file = Please open the following file: /Users/sophie/development/test_carga_web/storage/app/public/gatling/target/gatling/basicsimulation-20210221224427800/index.html
                $path_file= substr(strstr($line, '/gatling/target/'),1);
            }
        }

        $result_test_path = new result_test();
        $result_test_path->result_test_path = $path_file;
        $result_test_path->load_test_id = $load_test;
        $result_test_path->save();

        return view('load.show',compact('path_file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\load_test  $load_test
     * @return \Illuminate\Http\Response
     */
    public function edit($load_test)
    {
        $edit_data = load_test::find($load_test);
        return view('load.edit',compact('edit_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\load_test  $load_test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $load_test_id)
    {
        $request->validate([
            'load_test_name'=>'required',
            'load_test_base_url'=>'required',
            'load_test_post_url'=>'required',
            'load_test_num_usr'=>'required',
            'load_test_csv_token'=>'nullable|mimes:csv,txt',
            'load_test_file_charge'=>'nullable|mimes:scala,txt',
            'env_id'=>'required'
        ]);
        $load_test = load_test::find($load_test_id);
        $load_test->load_test_name = $request->input('load_test_name');
        $load_test->load_test_base_url = $request->input('load_test_base_url');
        $load_test->load_test_post_url = $request->input('load_test_post_url');
        $load_test->load_test_num_usr = $request->input('load_test_num_usr');
        $load_test->load_test_ramp_usr = $request->input('load_test_ramp_usr',0)?: 0;
        if($request->input('load_test_rand_anws')=="on"){
            $load_test->load_test_rand_anws = true;
        }else{
            $load_test->load_test_rand_anws = false;
        }
        if($request->hasFile('load_test_csv_token')){
            $load_test->load_test_csv_token_name = $request->load_test_csv_token->getClientOriginalName();
            $load_test->load_test_csv_token = $request->load_test_csv_token->storeAs('gatling/src/test/resources',$request->load_test_csv_token->getClientOriginalName(),'public');
        }
        if($request->hasFile('load_test_file_charge')){
            $load_test->load_test_file_charge_name = $request->load_test_file_charge->getClientOriginalName();
            $load_test->load_test_file_charge = $request->load_test_file_charge->storeAs('gatling/src/test/scala/computerdatabase',$request->load_test_file_charge->getClientOriginalName(),'public');
        }
        $load_test->env_id = $request->input('env_id');
        $load_test->save();
        return redirect()->route('load.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\load_test  $load_test
     * @return \Illuminate\Http\Response
     */
    public function destroy($load_test_id)
    {
        $delete = load_test::find($load_test_id)->delete();
        return redirect()->route('load.index');
    }
}
