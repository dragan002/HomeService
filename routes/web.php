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
use App\Livewire\Admin\AdminServiceProvidersComponent;
use App\Livewire\Admin\AdminAddServiceCategoryComponent;
use App\Livewire\Admin\AdminServicesByCategoryComponent;
use App\Livewire\Admin\AdminEditServiceCategoryComponent;
//customers
use App\Livewire\Customer\CustomerDashboardComponent;
//sprovider
use App\Livewire\Customer\CustomerReviewFormComponent;
use App\Livewire\Sprovider\SproviderProfileComponent;
use App\Livewire\ProvidersProfileInformationComponent;
use App\Livewire\Sprovider\SproviderDashboardComponent;
use App\Livewire\Sprovider\AddSproviderServiceComponent;
use App\Livewire\Sprovider\EditSproviderProfileComponent;
use App\Livewire\Sprovider\EditSproviderServiceComponent;
use App\Livewire\Sprovider\SproviderServicesListComponent;

Broadcast::channel('messages.{receiverId}', function ($user, $receiverId) {
    return $user->id === (int) $receiverId;
});

Route::get('/', HomeComponent::class)->name('home');
Route::as('service.')->group(function() {
    Route::get('/serviceCategories', ServiceCategoriesComponent::class)->name('serviceCategories');
    Route::get('{categorySlug}/service', ServicesByCategoryComponent::class)->name('serviceByCategory');
    Route::get('/service/{serviceSlug}', ServiceDetailsComponent::class)->name('serviceDetails');
});

// ===== SEARCH AND AUTOCOMPLETE ======

Route::prefix('search')->as('search.')->controller(SearchController::class)->group(function () {
    Route::get('/autocomplete','autocomplete')->name('autocomplete');
    Route::post('/', 'searchService')->name('service');
});

// =====END SEARCH AND AUTOCOMPLETE ======

Route::get('/change-location', ChangeLocationComponent::class)->name('change_location');
Route::get('/contact-us', ContactComponent::class)->name('contact');

// =============FOR MESSAGES ===========

Route::prefix('messages')->as('messages.')->controller(MessageController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('/{message}', 'show')->name('show');
    Route::delete('/{message}', 'destroy')->name('destroy');

    Route::post('/{message}/reply', 'sendAnswer')->name('reply');
});

// =============  END FOR MESSAGES ===========

//  ============== BOOKING AND EMAIL NOTIFICATION =========

Route::middleware(['auth'])->group(function () {
    Route::prefix('bookings')->as('bookings.')->controller(BookingController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{service}/book', 'create')->name('create');
        Route::post('/{service}/book','store')->name('store');
    });

    // Notifications routes
    Route::get('/notifications', function() {
        return view('notifications.index');
    })->name('notifications.index');
});

//  ============== END OF BOOKING AND EMAIL NOTIFICATION =========

//To check profile of provider
Route::get('/providersProfileInformation/{userId}', ProvidersProfileInformationComponent::class)->name('providersProfile');

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

// =============== FOR SERVICE PROVIDER ===================

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'authsprovider' => AuthSprovider::class,
])->prefix('sprovider')->as('sprovider.')->group(function () {

    // Dashboard
    Route::get('/dashboard', SproviderDashboardComponent::class)->name('dashboard');

    // Profile
    Route::get('/profile', SproviderProfileComponent::class)->name('profile');
    Route::get('/profile/edit', EditSproviderProfileComponent::class)->name('edit_profile');

    // Services
    Route::get('/service/add', AddSproviderServiceComponent::class)->name('add_service');
    Route::get('/service/edit/{service_id}', EditSproviderServiceComponent::class)->name('edit_service');
    Route::get('/service/list', SproviderServicesListComponent::class)->name('list');

    // Bookings
    Route::get('/bookings/manage', [BookingController::class, 'manage'])->name('bookings_manage');
    Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('bookings_update');
});

//===================== FOR ADMIN ==================

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'authadmin' => AuthAdmin::class,
])->prefix('admin')->as('admin.')->group(function() {
    // Dashboard
    Route::get('/dashboard', AdminDashboardComponent::class)->name('dashboard');
    //Admin Categories
    Route::get('/service-categories', AdminServiceCategoryComponent::class)->name('service_categories');
    Route::get('/service-category/add', AdminAddServiceCategoryComponent::class)->name('add_service_category');
    Route::get('/service-category/edit/{category_id}', AdminEditServiceCategoryComponent::class)->name('edit_service_category');
    //Admin Services
    Route::get('/all-services', AdminServicesComponent::class)->name('all_services');
    Route::get('/service/add', AdminAddServiceComponent::class)->name('add_service');
    Route::get('/service/edit/{id}', AdminEditServiceComponent::class)->name('edit_service');
    //Service Status
    Route::get('service/service_status', AdminServiceStatusComponent::class)->name('service_status');
    //Service By Category
    Route::get('/service/{category_slug}/services', AdminServicesByCategoryComponent::class)->name('services_by_category');
    //Sliders
    Route::get('/slider', AdminSliderComponent::class)->name('slider');
    Route::get('/slider/add', AdminAddSlideComponent::class)->name('add_slide');
    Route::get('/slider/edit/{slide_id}', AdminEditSlideComponent::class)->name('edit_slide');
    //Contact
    Route::get('/contacts', AdminContactComponent::class)->name('contacts');
    //Service Providers
    Route::get('/service-providers', AdminServiceProvidersComponent::class)->name('service_providers');
});

