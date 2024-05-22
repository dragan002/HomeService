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
                <h1>Service Categories</h1>
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
                                            All Services Categories
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ route('admin.add_service_category') }}" class="btn btn-info pull-right">Add New</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($scategories as $scategory)
                                                <tr>
                                                    <td>{{ $scategory->id }}</td>
                                                    <td><img src="{{ asset('images/categories') }}/{{ $scategory->image }}" alt="" width="60"></td>
                                                    <td>{{ $scategory->name }}</td>
                                                    <td>{{ $scategory->slug }}</td>
                                                    <td><a href="{{ route('admin.edit_service_category', ['category_id' => $scategory->id]) }}"><i class="fa fa-edit fa-2x text-info"></i></a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $scategories->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
