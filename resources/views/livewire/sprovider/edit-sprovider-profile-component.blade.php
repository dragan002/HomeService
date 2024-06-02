<div>
    <div class="section-title-01 honmob">
        <div class="bg_parallax image_02_parallax"></div>
        <div class="opacy_bg_02">
            <div class="container">
                <h1>Edit Profile</h1>
                <div class="crumbs">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li>/</li>
                        <li>Edit Profile</li>
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
                                        Profile
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if(Session::has('message'))
                                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                                            @endif
                                            <form class="form-horizontal" wire:submit.prevent="updateProfile">
                                                <div class="form-group">
                                                    <label for="newImage" class="control-label col-md-3">Profile Image:</label>
                                                    <input type="file" class="form-control-file" name="newImage" wire:model="newImage" >
                                                    @if($newImage)
                                                        <img src="{{ $newImage->temporaryUrl() }}" alt="" width="220">
                                                    @elseif($image)
                                                        <img src="{{ asset('images/sproviders') }}/{{ $image }}" alt="" width="220">
                                                    @else
                                                        <img src="{{ asset('images/sproviders/default.jpg') }}" alt="" width="220">
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="about" class="control-label col-md-3">About:</label>
                                                    <textarea name="about" cols="30" rows="10" wire:model="about"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="city" class="control-label col-md-3">City:</label>
                                                    <input type="text" class="form-control-file" name="city" wire:model="city">
                                                </div>
                                                <div class="form-group">
                                                    <label for="service_category_id" class="control-label col-md-3">Service Category:</label>
                                                    <select type="text" class="form-control-file" name="service_category_id" wire:model="service_category_id">
                                                        @foreach($scategories as $scategory)
                                                            <option value="{{ $scategory->id }}">{{ $scategory->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="service_locations" class="control-label col-md-3">Service Location Zipcode</label>
                                                    <input type="text" class="form-control-file" name="service_locations" wire:model="service_locations" >
                                                </div>
                                                <button type="submit" class="btn btn-success">Update Profile</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
