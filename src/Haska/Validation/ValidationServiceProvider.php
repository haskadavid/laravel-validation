<?php namespace Haska\Validation;

use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Haska\Validation\FactoryInterface',
			'Haska\Validation\LaravelValidator'
		);
	}

	public function boot()
	{
		$this->package('haska/laravel-validation');
	}

}