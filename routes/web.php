<?php

use App\Livewire\HomeComponent;
use App\Http\Middleware\AuthAdmin;
use App\Livewire\ContactComponent;
use App\Http\Middleware\AuthCustomer;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthSprovider;
//other Component
use App\Livewire\ChangeLocationComponent;
use App\Livewire\ServiceDetailsComponent;
//Controllers
use App\Http\Controllers\SearchController;
use App\Http\Controllers\MessageController;
//admin
use App\Livewire\ServiceCategoriesComponent;
use App\Livewire\ServicesByCategoryComponent;
use App\Livewire\Admin\AdminSliderComponent;
use App\Livewire\Admin\AdminContactComponent;
use App\Livewire\Admin\AdminAddSlideComponent;
use App\Livewire\Admin\AdminServicesComponent;
use App\Livewire\Admin\AdminDashboardComponent;
use App\Livewire\Admin\AdminEditSlideComponent;
use App\Livewire\Admin\AdminAddServiceComponent;
use App\Livewire\Admin\AdminEditServiceComponent;
use App\Livewire\Admin\AdminServiceStatusComponent;
use App\Livewire\Admin\AdminServiceCategoryComponent;
use App\Livewire\Admin\AdminServiceProvidersComponent;
use App\Livewire\Admin\AdminAddServiceCategoryComponent;
use App\Livewire\Admin\AdminServicesByCategoryComponent;
use App\Livewire\Admin\AdminEditServiceCategoryComponent;
//customers
use App\Livewire\Customer\CustomerDashboardComponent;
use App\Livewire\Customer\CustomerReviewFormComponent;
//sprovider
use App\Livewire\Sprovider\SproviderProfileComponent;
use App\Livewire\ProvidersProfileInformationComponent;
use App\Livewire\Sprovider\SproviderDashboardComponent;
use App\Livewire\Sprovider\AddSproviderServiceComponent;
use App\Livewire\Sprovider\EditSproviderProfileComponent;
use App\Livewire\Sprovider\EditSproviderServiceComponent;
use App\Livewire\Sprovider\SproviderServicesListComponent;



Route::get('/', HomeComponent::class)->name('home');
Route::get('/service-categories', ServiceCategoriesComponent::class)->name('home.service_categories');
Route::get('/{category_slug}/services', ServicesByCategoryComponent::class)->name('home.services_by_category');
Route::get('/service/{service_slug}', ServiceDetailsComponent::class)->name('home.service_details');

Route::get('/autocomplete', [SearchController::class,'autocomplete'])->name('autocomplete');
Route::post('/search', [SearchController::class, 'searchService'])->name('searchService');

Route::get('/change-location', ChangeLocationComponent::class)->name('home.change_location');
Route::get('/contact-us', ContactComponent::class)->name('home.contact');

//For messages
Route::get('/messages', [MessageController::class, 'index'])->name('message.index');
Route::post('/messages', [MessageController::class, 'store'])->name('message.store');
Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('message.destroy');
Route::get('/messages/{id}', [MessageController::class, 'show'])->name('message.show');

//To check profile of provider
Route::get('/providers-profile-information/{userId}', ProvidersProfileInformationComponent::class)->name('providersprofile');

//For Customers
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'authcustomer' => AuthCustomer::class, 
])->group(function () {
    Route::get('/customer/dashboard', CustomerDashboardComponent::class)->name('customer.dashboard');
    Route::get('/customer/reviewform', CustomerReviewFormComponent::class)->name('customer.review');
});

// For Service Provider
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'authsprovider' => AuthSprovider::class,
])->group(function () {
    Route::get('/sprovider/dashboard', SproviderDashboardComponent::class)->name('sprovider.dashboard');
    Route::get('/sprovider/profile', SproviderProfileComponent::class)->name('sprovider.profile');
    Route::get('/sprovider/profile/edit', EditSproviderProfileComponent::class)->name('sprovider.edit_profile');
    Route::get('/sprovider/service/add', AddSproviderServiceComponent::class)->name('sprovider.add_service');
    Route::get('/sprovider/service/edit/{service_id}', EditSproviderServiceComponent::class)->name('sprovider.edit_service');
    Route::get('/sprovider/service/list', SproviderServicesListComponent::class)->name('sprovider.list');
});

//For Admin
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'authadmin' => AuthAdmin::class
])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/admin/service-categories', AdminServiceCategoryComponent::class)->name('admin.service_categories');
    Route::get('/admin/service-category/add', AdminAddServiceCategoryComponent::class)->name('admin.add_service_category');
    Route::get('/admin/service-category/edit/{category_id}', AdminEditServiceCategoryComponent::class)->name('admin.edit_service_category');
    Route::get('/admin/all-services', AdminServicesComponent::class)->name('admin.all_services');
    Route::get('/admin/{category_slug}/services', AdminServicesByCategoryComponent::class)->name('admin.services_by_category');
    Route::get('/admin/service/add', AdminAddServiceComponent::class)->name('admin.add_service');
    Route::get('/admin/service/edit/{id}', AdminEditServiceComponent::class)->name('admin.edit_service');
    Route::get('/admin/service/service_status', AdminServiceStatusComponent::class)->name('admin.service_status');

    //slider Route
    Route::get('/admin/slider', AdminSliderComponent::class)->name('admin.slider');
    Route::get('/admin/slider/add', AdminAddSlideComponent::class)->name('admin.add_slide');
    Route::get('/admin/slider/edit/{slide_id}', AdminEditSlideComponent::class)->name('admin.edit_slide');
    Route::get('/admin/contacts', AdminContactComponent::class)->name('admin.contacts');
    Route::get('/admin/service-providers', AdminServiceProvidersComponent::class)->name('admin.service_providers');
});
