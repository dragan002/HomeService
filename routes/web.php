<?php

use App\Livewire\HomeComponent;
use App\Http\Middleware\AuthAdmin;
use App\Http\Middleware\AuthCustomer;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthSprovider;
use App\Livewire\ServiceCategoriesComponent;
use App\Livewire\Admin\AdminDashboardComponent;
use App\Livewire\Admin\AdminServiceCategoryComponent;
use App\Livewire\Customer\CustomerDashboardComponent;
use App\Livewire\Sprovider\SproviderDashboardComponent;


Route::get('/', HomeComponent::class)->name('home');
Route::get('/service-categories', ServiceCategoriesComponent::class)->name('home.service_categories');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'authcustomer' => AuthCustomer::class, 
])->group(function () {
    Route::get('/customer/dashboard', CustomerDashboardComponent::class)->name('customer.dashboard');
});


// For Service Provider
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'authsprovider' => AuthSprovider::class,
])->group(function () {
    Route::get('/sprovider/dashboard', SproviderDashboardComponent::class)->name('sprovider.dashboard');
    });


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'authadmin' => AuthAdmin::class
])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/admin/service-categories', AdminServiceCategoryComponent::class)->name('admin.service_categories');
    Route::get('/admin/service-categories/add', AdminServiceCategoryComponent::class)->name('admin.add_service_category');
    }); 