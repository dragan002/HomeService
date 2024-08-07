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
                <h1>All Slides</h1>
                <div class="crumbs">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li>/</li>
                        <li>Service Categories</li>
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
                                            All Slides
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ route('admin.addSlide') }}" class="btn btn-info pull-right">Add New Slide</a>
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
                                                <th>Title</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Created at</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($slides as $slide)
                                                <tr>
                                                    <td>{{ $slide->id }}</td>
                                                    <td>{{ $slide->title }}</td>
                                                    <td><img src="{{ asset('images/slider') }}/{{ $slide->image }}" alt="" width="60"></td>
                                                    <td>
                                                        @if($slide->status)
                                                                Active
                                                        @else
                                                                Inactive
                                                        @endif
                                                    </td>
                                                    <td>{{ $slide->created_at }}</td>

                                                    <td>
                                                        <a href="{{ route('admin.editSlide', ['id' => $slide->id])}}"><i class="fa fa-edit fa-2x text-info"></i></a>
                                                        <a href="#" style="margin-left: 10px;" onclick="if (!confirm('Are you sure you want to delete this slide?')) { event.preventDefault(); event.stopPropagation(); } else { @this.deleteSlide({{ $slide->id }}) }">
                                                            <i class="fa fa-times fa-2x text-danger"></i>
                                                        </a>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $slides->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
