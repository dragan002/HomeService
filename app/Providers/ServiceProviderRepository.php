<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use App\Repositories\ServiceRepository;

class ServiceProviderRepository extends ServiceProvider {
    
    public function register() {
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
    }
}