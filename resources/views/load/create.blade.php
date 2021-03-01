@extends('../layouts.app')
@section('content')

<div class="container row">
    @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <div class="col-md-12 row" >
        <h1 class="col-md-10">New Load Test</h1>
    </div>
    <div class="col-md-12">
        <form action="{{ route('load.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="inputAddress">Load Test name</label>
                    <input type="text" class="form-control" name="load_test_name" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleFormControlSelect1">Example select</label>
                    <select class="form-control" name="env_id">
                        @foreach (\App\environment::all() as $data)
                            @if (Auth::user()->id == $data->user_id)
                                <option value="{{$data->env_id}}">{{$data->env_machine_name}}</option>
                            @endif
                        @endforeach
                    </select>
                  </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">URL Base</label>
                    <input type="text" class="form-control" name="load_test_base_url" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">URL Post</label>
                    <input type="text" class="form-control" name="load_test_post_url" required>
                </div>
            </div>
            
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputCity">Number of user to simulate</label>
                <input type="number" class="form-control" min="0" name="load_test_num_usr" required>
              </div>
              <div class="form-group col-md-4">
                <label for="inputZip">Load Ramp</label>
                <input type="number" class="form-control" min="0" name="load_test_ramp_usr">
              </div>
                <div class="form-group col-md-4">
                    <label class="form-check-label" for="gridCheck">Random Anwser</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="load_test_rand_anws" >
                        <label class="form-check-label" for="exampleRadios1">Yes</label>
                      </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleFormControlFile1">CSV Token's File</label>
                    <input type="file" class="form-control-file" name="load_test_csv_token" accept=".csv" id="csv_file" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleFormControlFile1">Gatling Test File</label>
                    <input type="file" class="form-control-file" name="load_test_file_charge" accept=".scala" id="gatling_file">
                </div>
            </div>           
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
    </div>
</div>



@endsection