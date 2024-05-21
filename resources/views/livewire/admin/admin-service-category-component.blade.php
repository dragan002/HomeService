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
                            <table class="table table-stripped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($scategories as $scategory)
                                        <tr>
                                            <td>{{ $scategory->id }}</td>
                                            <td><img src="{{ asset('images/categories') }}/{{ $scategory->image }}" alt="" width="60"></td>
                                            <td>{{ $scategory->name }}</td>
                                            <td>{{ $scategory->slug }}</td>
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
