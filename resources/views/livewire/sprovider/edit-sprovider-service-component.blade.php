<div>
    <div class="section-title-01 honmob">
        <div class="bg_parallax image_02_parallax"></div>
        <div class="opacy_bg_02">
            <div class="container">
                <h1>Edit Service </h1>
                <div class="crumbs">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li>/</li>
                        <li>Edit Service</li>
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
                        <div class="col-md-12 col-md-offest-2 profile1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="col-md-6">
                                        Edit Service Category
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <a href="{{ route('sprovider.service_status') }}" class="btn btn-info pull-right">Services Status</a>
                                    </div> --}}
                                    <div class="col-md-6">
                                        <a href="{{ route('sprovider.list') }}" class="btn btn-info pull-right">All Services</a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="panel-body">
                                        @if(session('message'))
                                            <div class="alert alert-success">
                                                {{ session('message') }}
                                            </div>
                                        @endif
                                        <!-- Display error message -->
                                        @if(session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                    <form class="form-horizontal" wire:submit.prevent="updateService">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name" class="control-label col-sm-3">Name:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="name" wire:model="name" wire:keyup="generateSlug">
                                                @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="slug" class="control-label col-sm-3">Slug:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="slug" wire:model="slug">
                                                @error('slug') <p class="text-danger">{{ $message }}</p> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{-- check it --}}
                                            <label for="name" class="control-label col-sm-3">Service Category:</label> 
                                            <div class="col-sm-9">
                                                <select class="form-control" wire:model="serviceCategoryId">>
                                                    <option value="">Select Service Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('slug') <p class="text-danger">{{ $message }}</p> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tagline" class="control-label col-sm-3">Tagline:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="tagline" wire:model="tagline">
                                                @error('tagline') <p class="text-danger">{{ $message }}</p> @enderror

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="price" class="control-label col-sm-3">Price:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="price" wire:model="price">
                                                @error('price') <p class="text-danger">{{ $message }}</p> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="discount_type" class="control-label col-sm-3">Discount Type:</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="discountType" wire:model="discountType">
                                                    <option value="">Select Discount Type</option>
                                                    <option value="fixed">Fixed</option>
                                                    <option value="percentage">Percent</option>
                                                </select>
                                                @error('discount_type') <p class="text-danger">{{ $message }}</p> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="discount" class="control-label col-sm-3">Discount:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="discount" wire:model="discount">
                                                @error('discount') <p class="text-danger">{{ $message }}</p> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="control-label col-sm-3">Description:</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" wire:model="description"></textarea>
                                                @error('description') <p class="text-danger">{{ $message }}</p> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inclusion" class="control-label col-sm-3">Inclusion:</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" wire:model="inclusion"></textarea>
                                                @error('inclusion') <p class="text-danger">{{ $message }}</p> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exclusion" class="control-label col-sm-3">Exclusion:</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" wire:model="exclusion"></textarea>
                                                @error('exclusion') <p class="text-danger">{{ $message }}</p> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="thumbnail" class="control-label col-sm-3">Thumbnail</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control-file" id="thumbnail" wire:model="newThumbnail">
                                                @if ($newThumbnail)
                                                    <img src="{{ $newThumbnail->temporaryUrl() }}" alt="Thumbnail preview" width="60">
                                                @else
                                                    <img src="{{ asset('images/sproviders/thumbnails') }}/{{ $thumbnail }}" alt="Current thumbnail" width="60">
                                                @endif
                                                @error('newThumbnail') <p class="text-danger">{{ $message }}</p> @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="newImage" class="control-label col-sm-3">Image</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control-file" id="newImage" wire:model="newImage">
                                                @if ($newImage)
                                                    <img src="{{ $newImage->temporaryUrl() }}" alt="Image preview" width="60">
                                                @else
                                                    <img src="{{ asset('images/sproviders')}}/{{ $image }}" alt="Current image" width="60">
                                                @endif
                                                @error('newImage') <p class="text-danger">{{ $message }}</p> @enderror
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success pull-right">Update Service</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
