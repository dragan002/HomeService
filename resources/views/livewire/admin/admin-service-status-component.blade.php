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
                <h1>Services Status</h1>
                <div class="crumbs">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li>/</li>
                        <li>Services Status</li>
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
                                        <div class="col-md-6">
                                            Pending Services Status
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ route('admin.allServices') }}" class="btn btn-info pull-right">All Services</a>
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
                                                <th>Provider Name</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Category</th>
                                                <th>Service Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($services as $service)
                                                <tr>
                                                    @if($service->service_status === 'pending')
                                                        <td>{{ $service->name }}</td>
                                                        <td><img src="{{ asset('images/services/thumbnails') }}/{{ $service->thumbnail }}" alt="" width="60"></td>
                                                        <td>{{ $service->name }}</td>
                                                        <td>{{ $service->price }}</td>
                                                        <td>{{ $service->category->name }}</td>
                                                        <td>{{ $service->service_status }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.editService', ['id' => $service->id])}}"><i class="fa fa-edit fa-2x text-info"></i></a>
                                                            <a href="#" style="margin-left: 10px;" onclick="confirm('Are you sure you want to delete this services?') || event.stopImmidiatePropagation()" wire:click.prevent="deleteService({{ $service->id }})"><i class="fa fa-times fa-2x text-danger"></i>
                                                            </a>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- {{ $services->links() }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
