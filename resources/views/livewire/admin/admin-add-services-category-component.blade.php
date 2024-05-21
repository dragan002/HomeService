<div>
    <div class="section-title-01 honmob">
        <div class="bg_parallax image_02_parallax"></div>
        <div class="opacy_bg_02">
            <div class="container">
                <h1>Add Service Categories</h1>
                <div class="crumbs">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li>/</li>
                        <li>Add Service Categories</li>
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
                        <div class="col-md-8 col-md-offest-2 profile1">
                            <div class="panel-default">
                                <div class="panel-heading">
                                    <div class="col-md-6">
                                        Add New Service Category
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.service_categories') }}" class="btn btn-info pull-right">All Categories</a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <form action="" class="form-horizontal">
                                        <div class="form-group">
                                            <label for="name" class="control-label col-sm-3">Category Name:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="slug">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="control-label col-sm-3">Category Image:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control-file" name="image">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success pull-right">Add Category</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
