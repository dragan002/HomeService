<?php

use App\Livewire\HomeComponent;
use App\Http\Middleware\AuthAdmin;
use App\Livewire\ContactComponent;
use Illuminate\Support\Facades\Mail;
use App\Http\Middleware\AuthCustomer;
use Illuminate\Support\Facades\Route;
//other Component
use App\Http\Middleware\AuthSprovider;
use App\Livewire\ChangeLocationComponent;
//Controllers
use App\Livewire\ServiceDetailsComponent;
//admin
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MessageController;
use App\Livewire\Admin\AdminSliderComponent;
use App\Livewire\ServiceCategoriesComponent;
use App\Livewire\Admin\AdminContactComponent;
use App\Livewire\ServicesByCategoryComponent;
use App\Livewire\Admin\AdminAddSlideComponent;
use App\Livewire\Admin\AdminServicesComponent;
use App\Livewire\Admin\AdminDashboardComponent;
use App\Livewire\Admin\AdminEditSlideComponent;
use App\Livewire\Admin\AdminAddServiceComponent;
use App\Livewire\Admin\AdminEditServiceComponent;
use App\Livewire\Admin\AdminServiceStatusComponent;
use App\Livewire\Admin\AdminServiceCategoryComponent;
//customers
use App\Livewire\Customer\CustomerDashboardComponent;
use App\Livewire\Sprovider\SproviderProfileComponent;
//sprovider
use App\Livewire\Admin\AdminServiceProvidersComponent;
use App\Livewire\Customer\CustomerReviewFormComponent;
use App\Livewire\ProvidersProfileInformationComponent;
use App\Livewire\Sprovider\SproviderDashboardComponent;
use App\Livewire\Admin\AdminAddServiceCategoryComponent;
use App\Livewire\Admin\AdminServicesByCategoryComponent;
use App\Livewire\Sprovider\AddSproviderServiceComponent;

use App\Livewire\Admin\AdminEditServiceCategoryComponent;
use App\Livewire\Sprovider\EditSproviderProfileComponent;
//broadcast
use App\Livewire\Sprovider\EditSproviderServiceComponent;
use App\Livewire\Sprovider\SproviderServicesListComponent;

Broadcast::channel('messages.{receiverId}', function ($user, $receiverId) {
    return $user->id === (int) $receiverId;
});


Route::get('/', HomeComponent::class)->name('home');

Route::get('/service-categories', ServiceCategoriesComponent::class)->name('service.service_categories');
Route::get('/{category_slug}/services', ServicesByCategoryComponent::class)->name('service.services_by_category');
Route::get('/service/{service_slug}', ServiceDetailsComponent::class)->name('service.service_details');

// ===== SEARCH AND AUTOCOMPLETE ======
Route::prefix('search')->group(function () {
    Route::get('/autocomplete', [SearchController::class, 'autocomplete'])->name('search.autocomplete');
    Route::post('/', [SearchController::class, 'searchService'])->name('search.service');
});
// =====END SEARCH AND AUTOCOMPLETE ======


Route::get('/change-location', ChangeLocationComponent::class)->name('change_location');
Route::get('/contact-us', ContactComponent::class)->name('contact');

// =============FOR MESSAGES ===========
Route::resource('messages', MessageController::class)->only([
    'index', 'store', 'show', 'destroy'
]);
Route::post('/messages/{message}/reply', [MessageController::class, 'sendAnswer'])->name('message.reply');
// =============  END FOR MESSAGES ===========


Route::middleware(['auth'])->group(function () {
    Route::get('/services/{service}/book', [BookingController::class, 'create'])->name('bookings.create');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/services/{service}/book', [BookingController::class, 'store'])->name('bookings.store');

    //Booking Notification
    Route::get('/notifications', function() {
        return view('notifications.index');
    })->name('notifications.index');
});




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
    // For confirmation status when is service booked
    Route::get('/bookings/manage', [BookingController::class, 'manage'])->name('bookings.manage');
    Route::put('/bookins/{id}', [BookingController::class, 'update'])->name('bookings.update');
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
