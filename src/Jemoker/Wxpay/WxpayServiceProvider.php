<?php namespace Jemoker\Wxpay;

use Illuminate\Support\ServiceProvider;

class WxpayServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @ bool
	 */
	protected $defer = false;

	/**
	* Bootstrap the application events.
	*
	* @return void
	*/
	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../../config/config.php' => config_path('jemoker-wxpay.php'),
		]);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('wxpay', function ($app)
		{
			$this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'jemoker-wxpay');
			return new Wxpay($app->config->get('jemoker-wxpay'));
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('wxpay');
	}

}
