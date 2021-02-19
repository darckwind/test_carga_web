@extends('../layouts.app')
@section('content')

<div class="container ">
    <div class="row">
        <div class=" col-md-12">
            <h2>Add New Environment</h2>
        </div>
        <div class="col-md-12 ">
            <form action="{{ route('env.store') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-md-12 row">
                        <div class="col-md-8">
                            <label for="exampleInputEmail1">Environment Name</label>
                            <input type="text" class="form-control" name="env_machine_name" required>
                            <input type="text" name="user_id" value="{{ Auth::user()->id }}" readonly style="display:none;">
                            <small  class="form-text text-muted">in case of using an abbreviation, use an easy to identify</small>
                        </div>
                        <br>
                    </div>
                    <div class="col-md-12 row">
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Environment Operative System (Optional)</label>
                            <select class="form-control" name="env_machine_os">
                                <option>Centos</option>
                                <option>Fedora</option>
                                <option>Ubuntu</option>
                                <option>Red Hat</option>
                                <option>Debian</option>
                                <option>Windows Server</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Threads Environment</label>
                            <input class="form-control" type="number" name="env_thread" min="1" required>
                            <small  class="form-text text-muted">This value make reference to threads available</small>
                        </div>
                        
                    </div>
                    <div class="col-md-12 row">
                            <div class="col-md-4">
                                <label >Ram Environment (GB)</label>
                                <input class="form-control" type="number" name="env_ram" min="0" required>
                            </div>
                            <div class="col-md-4">
                                <label>Environment Server</label>
                                <select class="form-control" name="env_server" required>
                                    <option>Apache</option>
                                    <option>Nginx</option>
                                    <option>Tomcat</option>
                                    <option>Lighttpd</option>
                                </select>
                            </div>
                    </div>                               
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>    
</div>

@endsection