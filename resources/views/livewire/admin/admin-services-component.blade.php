<div>
    <style>
        nav svg {
            height: 20px;
        }
        nav .hidden {
            display: block !important;
        }
    </style>
    <div class="section-title-01 honmob">
        <div class="bg_parallax image_02_parallax"></div>
        <div class="opacy_bg_02">
            <div class="container">
                <h1>Sve Usluge</h1>
                <div class="crumbs">
                    <ul>
                        <li><a href="/">Početna</a></li>
                        <li>/</li>
                        <li>Kategorije Usluga</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="content-central">
        <div class="content_info">
            <div class="paddings-mini">
                <div class="container">
                    <div class="row portfolioContainer">
                        <div class="col-md-12 profile1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Sve Usluge
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ route('admin.service_status') }}" class="btn btn-info pull-right">Status Servisa</a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ route('admin.add_service') }}" class="btn btn-info pull-right">Dodaj Novu</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    @if(Session::has('message'))
                                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                                    @endif
                                    <table class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Slika</th>
                                                <th>Ime</th>
                                                <th>Cena</th>
                                                <th>Status</th>
                                                <th>Istaknuto</th>
                                                <th>Kategorija</th>
                                                <th>Kreirano</th>
                                                <th>Status Usluge</th>
                                                <th>Akcija</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($services as $service)
                                                @if($service->service_status === 'approved')
                                                    <tr>
                                                        <td>{{ $service->id }}</td>
                                                        <td><img src="{{ asset('images/services/thumbnails') }}/{{ $service->thumbnail }}" alt="" width="60"></td>
                                                        <td>{{ $service->name }}</td>
                                                        <td>{{ $service->price }}</td>
                                                        <td>
                                                            @if($service->status)
                                                                    Aktivno
                                                            @else
                                                                    Neaktivno
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($service->featured)
                                                                Da
                                                            @else
                                                                Ne
                                                            @endif
                                                        </td>
                                                        <td>{{ $service->category->name }}</td>
                                                        <td>{{ $service->created_at }}</td>
                                                        <td>{{ $service->service_status }}</td>

                                                        <td class="action_icons">
                                                            <a href="{{ route('admin.edit_service', ['id' => $service->id])}}"><i class="fa fa-edit fa-2x text-info"></i></a>
                                                            <a href="#" style="margin-left: 10px;" onclick="confirm('Da li ste sigurni da želite da obrišete ovu uslugu?') || event.stopImmidiatePropagation()" wire:click.prevent="deleteService({{ $service->id }})"><i class="fa fa-times fa-2x text-danger"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $services->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
