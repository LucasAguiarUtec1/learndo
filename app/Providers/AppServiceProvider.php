<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**Relation::enforceMorphMap([
            'Estudiante' => 'App\Models\Estudiante',
            'Organizador' => 'App\Models\Organizador',
            'Colaborador' => 'App\Models\Colaborador',
            'Seminario' => 'App\Models\Seminario',
            'Curso' => 'App\Models\Curso',
        ]);**/
    }
}
