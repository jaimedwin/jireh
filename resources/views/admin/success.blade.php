@if ($messages = Session::get('success'))
<div class="row mb-4">
    <div class="col-12">
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <span aria-hidden="true">&times;</span>
            </button>
            <h5><i class="icon fa fa-check"></i> {{'Alerta!'}}</h5>
            <ul>
                @foreach ($messages as $message)
                <li>{{$message}}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif