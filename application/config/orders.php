<?php defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| PayPal form class config
| -------------------------------------------------------------------------
*/

// If (and where) to log ipn to file
$config['paypal_lib_ipn_log_file'] = BASEPATH . 'logs/paypal_ipn.log';
$config['paypal_lib_ipn_log'] = TRUE;

// What is the default currency?
$config['paypal_lib_currency_code'] = 'EUR';

/*
| -------------------------------------------------------------------------
| Sage Pay form class config
| -------------------------------------------------------------------------
*/

/**************************************************************************************************
* Values for you to update
**************************************************************************************************/

// Set to SIMULATOR for the Simulator expert system, TEST for the Test Server and LIVE in the live environment
$config['connect_to'] = "LIVE"; 	

/** IMPORTANT.  Set the strYourSiteFQDN value to the Fully Qualified Domain Name of your server. **
** This should start http:// or https:// and should be the name by which our servers can call back to yours **
** i.e. it MUST be resolvable externally, and have access granted to the Sage Pay servers **
** examples would be https://www.mysite.com or http://212.111.32.22/ **/
$config['your_site_fqdn'] = "http://chelseamagazines.com/"; // IMPORTANT include final /

// Set this value to the Vendor Name assigned to you by Sage Pay or chosen when you applied
$config['vendor_name'] = "thechelseamagaz";

/** Set this value to the XOR Encryption password assigned to you by Sage Pay **/
$config['encryption_password'] = "AEew26JvMEo3FCMW";

// Set this to indicate the currency in which you wish to trade. 3 characters Examples: GBP, EUR and USD
// The currency must be supported by one of your Sage Pay merchant accounts or the transaction will be rejected. 
$config['currency'] = "GBP";

/** This can be DEFERRED or AUTHENTICATE if your Sage Pay account supports those payment types **/
$config['transaction_type'] = "PAYMENT";

/** Optional setting. If you are a Sage Pay Partner and wish to flag the transactions with your unique partner id set it here. **/
// Currently not supported by Library
$config['partner_id'] = "";

/* Optional setting. 
** 0 = Do not send either customer or vendor e-mails, 
** 1 = Send customer and vendor e-mails if address(es) are provided(DEFAULT). 
** 2 = Send Vendor Email but not Customer Email. If you do not supply this field, 1 is assumed and e-mails are sent if addresses are provided. **/
$config['send_email'] = 0; 

/** Optional setting. Set this to the mail address which will receive order confirmations and failures **/
$config['vendor_email'] = "luke.bilton@chelseamagazines.com";

/**************************************************************************************************
* Global Definitions for this site
***************************************************************************************************/

$config['protocol'] = "2.23";

if ($config['connect_to'] == "LIVE")
{
  	$config['purchase_url'] = "https://live.sagepay.com/gateway/service/vspform-register.vsp";
}
elseif ($config['connect_to'] == "TEST")
{
  	$config['purchase_url'] = "https://test.sagepay.com/gateway/service/vspform-register.vsp";
}
else // simulator
{
	$config['purchase_url'] = "https://test.sagepay.com/simulator/VSPFormGateway.asp";
}

/* End of file order.php */
