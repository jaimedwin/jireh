<div class="row mb-4"">
    <div class=" col-12">
        @if ($errors->any())
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5><i class="fas fa-exclamation-triangle"></i>
                            <strong>{{'Error!'}}</strong>
                        </h5>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>