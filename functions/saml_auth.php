<?php

/*
 * Default (test) WP Saml Auth config (see https://wordpress.org/plugins/wp-saml-auth)
 *
 * See cwd_base_live_saml_auth below for live site config
 *
*/
if ( ! function_exists ( 'cwd_base_default_saml_auth' ) ) {
	function cwd_base_default_saml_auth( $value, $option_name ) {
	    $config = array(
	        'connection_type' => 'internal',
	        'internal_config' => array(
	            'strict' => true,
	            'debug' => defined( 'WP_DEBUG' ) && WP_DEBUG ? true : false,
	            'baseurl' => home_url(),
	            'security' => array(
	                'requestedAuthnContext' => false,
	            ),
	            'sp' => array(
	                'entityId' => 'urn:' . parse_url( home_url(), PHP_URL_HOST ),
	                'assertionConsumerService' => array(
	                    'url' => wp_login_url(),
	                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
	                ),
	            ),
	            'idp' => array(
	                'entityId' => 'https://shibidp-test.cit.cornell.edu/idp/shibboleth',
	                'singleSignOnService' => array(
	                    'url' => 'https://shibidp-test.cit.cornell.edu/idp/profile/SAML2/Redirect/SSO',
	                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
	                ),
	                'x509cert' => 'MIIDXDCCAkSgAwIBAgIVAMKCR8IGXIOzO/yLt6e4sd7OMLgEMA0GCSqGSIb3DQEB
	BQUAMCcxJTAjBgNVBAMTHHNoaWJpZHAtdGVzdC5jaXQuY29ybmVsbC5lZHUwHhcN
	MTIwNjA3MTg0NjIyWhcNMzIwNjA3MTg0NjIyWjAnMSUwIwYDVQQDExxzaGliaWRw
	LXRlc3QuY2l0LmNvcm5lbGwuZWR1MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIB
	CgKCAQEAkhlf9EP399mqnBtGmPG9Vqu79Af2NZhhsT+LTMA1uhPZYv4RX/E4VD+I
	qce/EUP1ndPkGEwBnhrRT2ZegDpCmgo+EcED8cAh9AbwFTTitmBjxvErtJnS0ZBf
	MCLDcgOV1zM6bT5fF9SAIm0ZVSaeyQbNDwVDdwsBQHjAdg5vLd5VeYH9MI6enzdg
	BtPNSrEt3qZtCWl7ev8YQlWF3vZ+EoyDrWPZSOWzgR31QBs7mz13ABSveIri68Fg
	Nth9ylgFS7VNUlAp6xx6BRnMgL1QzVMZ5F4PbSRDp3UBoS6PMHd+WFenJWPPh6Sh
	MyrInrJ4QAPfKC77tJW+GUXl4T4DqQIDAQABo38wfTBcBgNVHREEVTBTghxzaGli
	aWRwLXRlc3QuY2l0LmNvcm5lbGwuZWR1hjNodHRwczovL3NoaWJpZHAtdGVzdC5j
	aXQuY29ybmVsbC5lZHUvaWRwL3NoaWJib2xldGgwHQYDVR0OBBYEFF9RADnmBsO5
	0hD8T+MUFqIgWAOxMA0GCSqGSIb3DQEBBQUAA4IBAQBqYpfdK4XAYE56sYmq/vUK
	OSBcbO2Uy3R7oTGrDKxrZI7xC1jchaaTW6BXtg6wzTSn8Jo2M0gvQrWyxZgQDrXG
	aL2TaPf5WjOWt/SsuJ+IShofS6ZWLkPCnrR0Ag9PwU58szw2jjUE4eJyv/dLDzhD
	HJ0EGastgSzRh1r3v2w8BYz1RHvjwESPB2HTgV1iuHwaIjaJxN39XyS6ZQzBj6sZ
	6Lem1R39zXmEvtVfCk9qgSKnbYulrrkIBzxllB34TUTKFs+Nz1j/sg2gj6Q5u9uW
	6mSm66mqn2E53r2CNHPTzWGwom5Mi9Z/DtOb2L/5jjxhFvCKxnEbIWm7XIe8qtqo',
	            ),
	        ),

	        // Only allow local WP login on non-prod environments
	        'permit_wp_login' => true,

	        // Override in child theme if accounts should be created automatically on netid login
	        // (see https://docs.pantheon.io/guides/wordpress-google-sso/advanced-configuration)
	        'auto_provision' => false,

	        // Role assigned to created users (if auto_provision is set to true)
	        'default_role' => get_option( 'subscriber' ),

	        // Match authenticated user to existing WP user by email address
	        // Can also set to 'login' to use netid/wp username
	        'get_user_by' => 'email',

	        // Map SAML response to WP user attributes
	        'user_login_attribute'   => 'urn:oid:0.9.2342.19200300.100.1.1',
	        'user_email_attribute'   => 'urn:oid:0.9.2342.19200300.100.1.3',
	        'display_name_attribute' => 'urn:oid:2.16.840.1.113730.3.1.241',
	        'first_name_attribute'   => 'urn:oid:2.5.4.42',
	        'last_name_attribute'    => 'urn:oid:2.5.4.4',
	    );

	    $value = isset( $config[ $option_name ] ) ? $config[ $option_name ] : $value;

	    return $value;
	}

	add_filter( 'wp_saml_auth_option', 'cwd_base_default_saml_auth', 10, 2 );
}

/*
 * Saml Auth config for live site
 *
 * Copy this function into child theme during launch and change as needed
 *
*/
if ( ! function_exists ( 'cwd_base_live_saml_auth' ) ) {
	function cwd_base_live_saml_auth( $value, $option_name ) {
		// Replace $is_live with env check below once SP certs are uploaded
		// (NetID login will break after this until site is registered with IDM)
		$is_live = false;
		// $is_live = isset($_ENV['PANTHEON_ENVIRONMENT']) && $_ENV['PANTHEON_ENVIRONMENT'] === 'live';

		if ( $is_live ) {
			if ( $option_name === 'internal_config' ) {
				// SP Cert & Private Key for signing metadata
				$value['sp']['x509cert'] = file_get_contents(ABSPATH . '/wp-content/uploads/private/saml/certs/sp.crt');
				$value['sp']['privateKey'] = file_get_contents(ABSPATH . '/wp-content/uploads/private/saml/certs/sp.key');

				// Live Shibboleth connection
				$value['idp']['entityId'] = 'https://shibidp.cit.cornell.edu/idp/shibboleth';
				$value['idp']['singleSignOnService']['url'] = 'https://shibidp.cit.cornell.edu/idp/profile/SAML2/Redirect/SSO';

				// Live IDP cert
				$value['idp']['x509cert'] = 'MIIDSDCCAjCgAwIBAgIVAOZ8NfBem6sHcI7F39sYmD/JG4YDMA0GCSqGSIb3DQEB
BQUAMCIxIDAeBgNVBAMTF3NoaWJpZHAuY2l0LmNvcm5lbGwuZWR1MB4XDTA5MTEy
MzE4NTI0NFoXDTI5MTEyMzE4NTI0NFowIjEgMB4GA1UEAxMXc2hpYmlkcC5jaXQu
Y29ybmVsbC5lZHUwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQCTURo9
90uuODo/5ju3GZThcT67K3RXW69jwlBwfn3png75Dhyw9Xa50RFv0EbdfrojH1P1
9LyfCjubfsm9Z7FYkVWSVdPSvQ0BXx7zQxdTpE9137qj740tMJr7Wi+iWdkyBQS/
bCNhuLHeNQor6NXZoBgX8HvLy4sCUb/4v7vbp90HkmP3FzJRDevzgr6PVNqWwNqp
tZ0vQHSF5D3iBNbxq3csfRGQQyVi729XuWMSqEjPhhkf1UjVcJ3/cG8tWbRKw+W+
OIm71k+99kOgg7IvygndzzaGDVhDFMyiGZ4njMzEJT67sEq0pMuuwLMlLE/86mSv
uGwO2Qacb1ckzjodAgMBAAGjdTBzMFIGA1UdEQRLMEmCF3NoaWJpZHAuY2l0LmNv
cm5lbGwuZWR1hi5odHRwczovL3NoaWJpZHAuY2l0LmNvcm5lbGwuZWR1L2lkcC9z
aGliYm9sZXRoMB0GA1UdDgQWBBSQgitoP2/rJMDepS1sFgM35xw19zANBgkqhkiG
9w0BAQUFAAOCAQEAaFrLOGqMsbX1YlseO+SM3JKfgfjBBL5TP86qqiCuq9a1J6B7
Yv+XYLmZBy04EfV0L7HjYX5aGIWLDtz9YAis4g3xTPWe1/bjdltUq5seRuksJjyb
prGI2oAv/ShPBOyrkadectHzvu5K6CL7AxNTWCSXswtfdsuxcKo65tO5TRO1hWlr
7Pq2F+Oj2hOvcwC0vOOjlYNe9yRE9DjJAzv4rrZUg71R3IEKNjfOF80LYPAFD2Sp
p36uB6TmSYl1nBmS5LgWF4EpEuODPSmy4sIV6jl1otuyI/An2dOcNqcgu7tYEXLX
C8N6DXggDWPtPRdpk96UW45huvXudpZenrcd7A==';

				return $value;
			}

			/*
			 * Un-comment to restrict login to NetID only
			 * (Should only be done after site is registered with IDM)
			 */
			// if ( $option_name === 'permit_wp_login' ) {
			// 	return false;
			// }
		}

		return $value;
	}

	add_filter( 'wp_saml_auth_option', 'cwd_base_live_saml_auth', 99, 2 );
}


// Customize text on login page
if ( ! function_exists ( 'cwd_base_saml_login_text' ) ) {
	function cwd_base_saml_login_text( $strings ) {
		$strings['title'] = 'Log in with NetID:';
		$strings['button'] = 'Cornell NetID Login';
		$strings['alt_title'] = 'Log in with WordPress:';

		return $strings;
	}

	add_filter( 'wp_saml_auth_login_strings', 'cwd_base_saml_login_text' );
}
