@extends('../layouts.app')
@section('content')

<div class="container" onload="load_select();" >
    <div class="row">
        <div class=" col-md-12">
            <h2>Edit Environment</h2>
        </div>
        <div class="col-md-12 ">
            <form action="{{ route('env.update', $env_data_edit->env_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <div class="col-md-12 row">
                        <div class="col-md-8">
                            <label for="exampleInputEmail1">Environment Name</label>
                            <input type="text" class="form-control" name="env_machine_name" value="{{$env_data_edit->env_machine_name}}" required>
                            <input type="text" name="user_id" value="{{$env_data_edit->user_id}}" readonly style="display:none;">
                            <small  class="form-text text-muted">in case of using an abbreviation, use an easy to identify</small>
                        </div>
                        <br>
                    </div>
                    <div class="col-md-12 row">
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Environment Operative System (Optional)</label>
                            <select class="form-control" name="env_machine_os" id="inf_os">
                                <option>{{$env_data_edit->env_machine_os}}</option>
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
                            <input class="form-control" type="number" value="{{$env_data_edit->env_thread}}" name="env_thread" min="1" required>
                            <small  class="form-text text-muted">This value make reference to threads available</small>
                        </div>
                        
                    </div>
                    <div class="col-md-12 row">
                            <div class="col-md-4">
                                <label >Ram Environment (GB)</label>
                                <input class="form-control" type="number" value="{{$env_data_edit->env_ram}}" name="env_ram" min="0" required>
                            </div>
                            <div class="col-md-4">
                                <label>Environment Server</label>
                                <select class="form-control" name="env_server" id="inf_ser" required>
                                    <option>{{$env_data_edit->env_server}}</option>
                                    <option>Apache</option>
                                    <option>Nginx</option>
                                    <option>Tomcat</option>
                                    <option>Lighttpd</option>
                                </select>
                            </div>
                    </div>                               
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>    
</div>

<script type="text/javascript" language="javascript">
    function load_select(){
        var server = document.getElementById('inf_ser');
        var os = document.getElementById('inf_os');
        for(var i=1; i< server.length; i++){
            if (server.options[i].value == server.options[0].value)
            server.remove(i);
        }
        for(var i=1; i< os.length; i++){
            if (os.options[i].value == os.options[0].value)
            os.remove(i);
        }
    }
    window.onpaint = load_select();
    
</script>    

@endsection
