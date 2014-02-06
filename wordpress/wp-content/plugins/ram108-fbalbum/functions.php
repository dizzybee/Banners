<?php

// DEFINITIONS

define( 'APC_AVAILABLE', extension_loaded('apc') && ini_get('apc.enabled') );
define( 'CURL_AVAILABLE', extension_loaded('curl') && function_exists('curl_version') );

// APC

if ( APC_AVAILABLE ){

	function apc_delete_reqex( $reqex ){
		if ( !class_exists('APCIterator') ) return FALSE;
		$toDelete = new APCIterator('user', $reqex, APC_ITER_VALUE);
		@apc_delete( $toDelete );
	}
}
