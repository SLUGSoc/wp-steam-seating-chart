<?php
require_once("wp-load.php");

//echo steamProfileUrl($user_ID);

function steamProfileUrl($uid) {
	$userToken = oa_social_login_get_token_by_userid($uid);
	$settings = get_option ('oa_social_login_settings');

	$api_connection_handler = ((!empty ($settings ['api_connection_handler']) AND $settings ['api_connection_handler'] == 'fsockopen') ? 'fsockopen' : 'curl');
	$api_connection_use_https = ((!isset ($settings ['api_connection_use_https']) OR $settings ['api_connection_use_https'] == '1') ? true : false);
	$api_subdomain = (!empty ($settings ['api_subdomain']) ? trim ($settings ['api_subdomain']) : '');
	$api_resource_url = ($api_connection_use_https ? 'https' : 'http') . '://' . $api_subdomain . '.api.oneall.com/users/' . $userToken . '.json';
	$api_credentials = array ();
	$api_credentials['api_key'] = (!empty ($settings ['api_key']) ? $settings ['api_key'] : '');
	$api_credentials['api_secret'] = (!empty ($settings ['api_secret']) ? $settings ['api_secret'] : '');

	$result = oa_social_login_do_api_request ($api_connection_handler, $api_resource_url, $api_credentials);

	//Check result
	if (is_object ($result) AND property_exists ($result, 'http_code') AND $result->http_code == 200 AND property_exists ($result, 'http_data')) {
		$decoded_result = @json_decode ($result->http_data);
		if (is_object ($decoded_result) AND isset ($decoded_result->response->result->data->user)) {

			$accounts = $decoded_result->response->result->data->user->identities;
			foreach ($accounts as $account) {
				if (strcmp($account->provider, 'steam') == 0)
					return $account->id;
			}
		}
	}
	return NULL;
}

?>
