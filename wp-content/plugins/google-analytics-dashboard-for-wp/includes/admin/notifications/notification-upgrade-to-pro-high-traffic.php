<?php

/**
 * Add notification after 1 week of lite version installation
 * Recurrence: 30 Days
 *
 * @since 7.12.3
 */
final class ExactMetrics_Notification_Upgrade_To_Pro_High_Traffic extends ExactMetrics_Notification_Event {

	public $notification_id = 'exactmetrics_notification_upgrade_to_pro_high_traffic';
	public $notification_interval = 30; // in days
	public $notification_type = array( 'lite' );
	public $notification_icon = 'star';
    public $notification_category = 'insight';
    public $notification_priority = 3;

	/**
	 * Build Notification
	 *
	 * @return array $notification notification is ready to add
	 *
	 * @since 7.12.3
	 */
	public function prepare_notification_data( $notification ) {

        $report  = $this->get_report();

        $sessions = isset( $report['data']['infobox']['sessions']['value'] ) ? $report['data']['infobox']['sessions']['value'] : 0;

        if ( $sessions < 2000 ) {
            return false;
        }

		$notification['title'] = __( 'Upgrade to Unlock Advanced Tracking & Reports', 'google-analytics-dashboard-for-wp' );
		// Translators: upgrade to pro notification content
		$notification['content'] = __( 'Upgrade to ExactMetrics Pro to take advantage of advanced Google Analytics settings, unlock advanced insights, utilize Custom Dimensions, and more.', 'google-analytics-dashboard-for-wp' );
		$notification['btns']    = array(
			"upgrade_to_pro" => array(
				'url'           => $this->get_upgrade_url(),
				'text'          => __( 'Upgrade to Pro', 'google-analytics-dashboard-for-wp' ),
				'is_external'   => true,
			),
		);

		return $notification;
	}

}

// initialize the class
new ExactMetrics_Notification_Upgrade_To_Pro_High_Traffic();
