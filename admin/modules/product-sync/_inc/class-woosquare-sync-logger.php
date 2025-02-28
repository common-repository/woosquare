<?php
/**
 * Woosquare_Plus v1.0 by wpexperts.io
 *
 * @package Woosquare_Plus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Square sync logging class which saves important data to the log
 *
 * @since 1.0.0
 * @version 1.0.0
 */
class WooSquare_Sync_Logger {

		/**
		 * The logger instance for logging purposes.
		 *
		 * @var Logger
		 */
	public static $logger;
	const WC_LOG_FILENAME = 'woocommerce-square-sync';

	/**
	 * Utilize WC logger class
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 *
	 * @param  mixed $message     The message to be logged.
	 * @param  int   $start_time  (Optional) Start time for duration-based log entry.
	 * @param  int   $end_time    (Optional) End time for duration-based log entry.
	 */
	public static function log( $message, $start_time = null, $end_time = null ) {

		if ( empty( self::$logger ) ) {
			self::$logger = new WC_Logger();
		}

		$settings = get_option( 'woocommerce_squareconnect_settings', '' );

		if ( ! empty( $settings['logging'] ) && 'yes' !== $settings['logging'] ) {
			return;
		}

		if ( ! is_null( $start_time ) ) {
			$current_time         = 'current_time';
			$formatted_start_time = date_i18n( get_option( 'date_format' ) . ' g:ia', $start_time );
			$end_time             = is_null( $end_time ) ? $current_time( 'timestamp' ) : $end_time;
			$formatted_end_time   = date_i18n( get_option( 'date_format' ) . ' g:ia', $end_time );
			$elapsed_time         = round( abs( $end_time - $start_time ) / 60, 2 );

			$log_entry  = '====Start Log ' . $formatted_start_time . '====' . "\n" . $message . "\n";
			$log_entry .= '====End Log ' . $formatted_end_time . ' (' . $elapsed_time . ')====' . "\n\n";

		} else {

			$log_entry = '====Start Log====' . "\n" . $message . "\n" . '====End Log====' . "\n\n";

		}

		self::$logger->add( self::WC_LOG_FILENAME, $log_entry );
	}
}
