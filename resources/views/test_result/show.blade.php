@extends('../layouts.app')
@section('content')
    <div class="container">
        <table class="table table-responsive-sm ">
            <tr>
                <th>Test Name</th>
                <th>Execution date</th>
                <th>Result</th>
            </tr>
            @foreach ($all_result as $data)
                <tr>
                    <td>{{ $data_load_test->load_test_name }} <i class="fa fa-eye" data-toggle="modal"
                            data-target="#{{ str_replace(' ', '', $data_load_test->load_test_name) }}"></i>
                    </td>
                    <td>{{ $data->created_at }}</td>
                    <td><a class="btn btn-info" data-toggle="modal"
                            data-target="#{{ str_replace(' ', '', $data_load_test->load_test_name) }}{{ $data->result_test_id }}">Result</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="modal fate" id="{{ str_replace(' ', '', $data_load_test->load_test_name) }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Test Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Load Test Name:</th>
                                <td>{{ $data_load_test->load_test_name }}</td>
                            </tr>
                            <tr>
                                <th>Number of users:</th>
                                <td>{{ $data_load_test->load_test_num_usr }}</td>
                            </tr>
                            <tr>
                                <th>User Ramp:</th>
                                @if ($data_load_test->load_test_ramp_usr != 0)
                                    <td>{{ $data_load_test->load_test_ramp_usr }}</td>
                                @else
                                    <td>No</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($all_result as $path)
        <div class="modal fade fbd-example-modal-lg"
            id="{{ str_replace(' ', '', $data_load_test->load_test_name) }}{{ $path->result_test_id }}" tabindex="-1"
            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Test Result {{$path->created_at}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item"
                                src="{{ Storage::url($path->result_test_path) }}"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
