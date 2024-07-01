<div>
    <div class="col-md-6">
        <ul class="visible-md visible-lg text-right">
            @if(Session::has('city'))
                <li><a href="{{ route('updateLocation') }}"><i class="fa fa-map-marker"></i> {{ Session::get('city') }}, {{ Session::get('state') }}</a></li>
            @else
            <li><a href="{{ route('updateLocation') }}"><i class="fa fa-map-marker"></i> Prnjavor, RS</a></li>
            @endif
        </ul>
    </div>
</div>
