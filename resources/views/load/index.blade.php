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
            <div class="col-md-12 row">
                <h1 class="col-md-10">Load Test</h1>
                <a href="{{ route('load.create') }}">
                    <button class="btn btn-info col-md-12">Add New Load Test</button>
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
                    <th>Acction</th>
                </tr>
                @foreach ($load_test_data as $data)
                    @if (Auth::user()->id == $data->environment->user_id)
                        <tr>
                            <td>{{ $data->environment->env_machine_name }} <i class="fa fa-eye" data-toggle="modal"
                                    data-target="#{{ str_replace(' ', '', $data->environment->env_machine_name) }}"></i></td>
                            <td>{{ $data->load_test_name }}</td>
                            <td>{{ $data->load_test_base_url }}{{ $data->load_test_post_url }}</td>
                            <td>{{ $data->load_test_num_usr }}</td>
                            <td>{{ $data->load_test_ramp_usr }}</td>
                            @if ($data->load_test_rand_anws)
                                <td>yes</td>
                            @else
                                <td>No</td>
                            @endif
                            <td>
                                <form action="{{ route('load.destroy', $data->load_test_id) }}" method="POST">
                                    <a class="btn btn-warning" href="{{ route('load.show', $data->load_test_id) }}"><i
                                            class="fa fa-bolt"></i></a>
                                    <a class="btn btn-success" href="{{ route('load.edit', $data->load_test_id) }}"><i
                                            class="fa fa-edit"></i></a>
                                    <a class="btn btn-info" href="{{ route('result.show', $data->load_test_id) }}"><i
                                            class="fa fa-list"></i></a>
                                    <!--selector multiples edicion de datos-->
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>
    </div>

    @foreach (App\environment::all() as $data)
        <div class="modal fade" id="{{ str_replace(' ', '', $data->env_machine_name) }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Machine Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Machine Name:</th>
                                    <td>{{ $data->env_machine_name }}</td>
                                </tr>
                                <tr>
                                    <th>Machine OS:</th>
                                    <td>{{ $data->env_machine_os }}</td>
                                </tr>
                                <tr>
                                    <th>Machine Threads:</th>
                                    <td>{{ $data->env_thread }}</td>
                                </tr>
                                <tr>
                                    <th>Machine Ram:</th>
                                    <td>{{ $data->env_ram }} GB</td>
                                </tr>
                                <tr>
                                    <th>Machine Server:</th>
                                    <td>{{ $data->env_server }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
