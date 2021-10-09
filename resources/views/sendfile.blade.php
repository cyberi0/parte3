@extends('layout.mainlayout')
@section('content')
<body>
    <div class="container mt-2">
        <form id="fileUploadForm" method="POST" action="{{ url('/uploadToServer') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <input name="file" id="file" type="file" class="form-control">
            </div>

            <div class="form-group mb-3">
                <input id="buttonSend" type="submit" value="Enviar" class="btn btn-primary">
            </div>

            <div class="form-group">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                </div>
            </div>
        </form>
        <div id="show_table"></div>
    </div>
</body>
@endsection
