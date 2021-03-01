@extends('../layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 row" >
            <h1 class="col-md-10">Machines</h1>
            <a href="{{ route('env.create') }}">
                <button class="btn btn-info col-md-12" >Add New Machine</button>
            </a>
            
        </div>
    </div>
    <div class="row">
        <table class="table table-responsive-sm">
            <tr>
                <th>Machine name</th>
                <th>Operative System</th>
                <th>Number of Threads</th>
                <th>Machine Ram</th>
                <th>Machine Server</th>
                <th>Created At</th>
                <th>Acction</th>
            </tr>
            @foreach($env_data as $data)
                @if(Auth::user()->id == $data->user_id)
                    <tr>
                        <td>{{$data->env_machine_name}}</td>
                        <td>{{$data->env_machine_os}}</td>
                        <td>{{$data->env_thread}}</td>
                        <td>{{$data->env_ram}} GB</td>
                        <td>{{$data->env_server}}</td>
                        <td>{{$data->created_at}}</td>
                        <td>
                            <form action="{{ route('env.destroy',$data->env_id) }}" method="POST">
                                <a class="btn btn-warning" href="{{ route('env.edit',$data->env_id) }}">edit</a>
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