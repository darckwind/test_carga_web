@extends('../layouts.app')
@section('content')

<div class="container">
    <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="{{Storage::url($path_file)}}"></iframe>
      </div>
</div>
@endsection