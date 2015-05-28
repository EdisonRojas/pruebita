<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Credenciales para Facebook 25/04/2015 miraditaloja
		 */
        'Facebook' => array(
            'client_id'     => '',
            'client_secret' => '',
            'scope'         => array('email','user_friends','user_status'),
        ),
		'Google' => array(
			'client_id'     => '',
			'client_secret' => '',
			'scope'         => array('userinfo_email', 'userinfo_profile'),
		),

		'Twitter' => array(
			'client_id'     => '',
			'client_secret' => '',
					// No scope - oauth1 doesn't need scope
		),	

	)

);