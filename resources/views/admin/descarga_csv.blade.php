@can('use-app-download_csv')
    @if(empty($parameter))
    <div class="float-right">
        <a href="{{route($route_name)}}" class="btn btn-success" role="button" aria-label="Csv">
            <i class="fas fa-download"></i>
            {{$title_btn}}
        </a>
    </div>
    @else
    <div class="float-right">
        <a href="{{route($route_name, $parameter)}}" class="btn btn-success" role="button" aria-label="Csv">
            <i class="fas fa-download"></i>
            {{$title_btn}}
        </a>
    </div>
    @endif
@endcan