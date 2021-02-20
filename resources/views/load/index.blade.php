@extends('../layouts.app')
@section('content')
<style>
    .my-custom-scrollbar {
        position: relative;
        height: 200px;
        overflow: auto;
    }
    .table-wrapper-scroll-y {
        display: block;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12 row" >
            <h1 class="col-md-10">Load Test</h1>
            <a href="{{ route('load.create') }}">
                <button class="btn btn-info col-md-12" >Add New Load Test</button>
            </a>
            
        </div>
    </div>
    <div class="row">
        <table class="table table-responsive-sm ">
            <tr>
                <th>Machine</th>
                <th>Test Name</th>
                <th>Test URL</th>
                <th>Total Load</th>
                <th>Ramp Load</th>
                <th>Ramdon Anwser</th>
                <th>Created At</th>
                <th>Acction</th>
            </tr>
            @foreach($load_test_data as $data)
                @if(Auth::user()->id == $data->environment->user_id)
                    <tr>
                        <td>{{$data->environment->env_machine_name}} <i class="fa fa-eye"></i></td>
                        <td>{{$data->load_test_name}}</td>
                        <td>{{$data->load_test_base_url}}{{$data->load_test_post_url}}</td>
                        <td>{{$data->load_test_num_usr}}</td>
                        <td>{{$data->load_test_ramp_usr}}</td>
                        <td>{{$data->load_test_rand_anws}}</td>
                        <td>{{$data->created_at}}</td>
                        <td>
                            <form action="{{ route('load.destroy',$data->load_test_id) }}" method="POST">
                                <a class="btn btn-warning" href="{{ route('load.show',$data->load_test_id) }}">Run</a>
                                <a class="btn btn-success" href="{{ route('load.edit',$data->load_test_id) }}">edit</a>
                                <!--selector multiples edicion de datos-->
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
</div>    


@endsection