<?php

namespace Annaba\Annaba;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AnnabaServiceProvider extends ServiceProvider
{
   
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/annaba.php', 'annaba'
        );
    }
   
    public function boot(): void
    {
       $this->publishes([
            __DIR__.'/../config/annaba.php' => config_path('annaba.php'),
        ], 'config');

        $this->loadViewsFrom(__DIR__.'/../resources/views','annaba');

         $this->commands([
            \Annaba\Annaba\Commands\AnnabaCreatorCommand::class,
            \Annaba\Annaba\Commands\AnnabaUpdatorCommand::class,
            \Annaba\Annaba\Commands\WizardCreatorCommand::class,
            \Annaba\Annaba\Commands\WizardUpdatorCommand::class,
        ]);

        Livewire::component('annaba.annabacreator', \Annaba\Annaba\Livewire\AnnabaCreator::class);
        Livewire::component('annaba.annabaupdate', \Annaba\Annaba\Livewire\AnnabaUpdate::class);
        Livewire::component('annaba.wizardcreator', \Annaba\Annaba\Livewire\WizardCreator::class);
        Livewire::component('annaba.wizardupdate', \Annaba\Annaba\Livewire\WizardUpdate::class);



    }
}