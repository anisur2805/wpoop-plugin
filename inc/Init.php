<?php
namespace WPOOP;
final class Init {

	public function __construct() {}

	/**
	 * Get all of the service classes for the plugin
	 *
	 * @return array
	 */
	public static function get_services() {
		return array(
			Pages\Dashboard::class,
			Base\Enqueue::class,
			Base\SettingsLinks::class,
			Base\CustomPostTypeController::class,
		);
	}

	/**
	 * Loop through the classes, initialize them, and call the register() method if it exists
	 *
	 * @return void
	 */
	public static function register_services() {
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Instantiate the class
	 * @param string $class class from the service array
	 * @return class instance new instance of the class
	 */
	private static function instantiate( $class ) {
		$service = new $class();
		return $service;
	}
}
