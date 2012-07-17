<?php

/**
 * Sage Pay Form example controller
 *
 * Functional code to pass order to Sage Pay Go Form service
 * http://www.sagepay.com/products_services/sage_pay_go/integration/form
 * and handle the success/failure redirects 
 *
 * @package   sagepay_form
 * @author    Ollie Rattue, Too many tabs <orattue[at]toomanytabs.com>
 * @copyright Copyright (c) 2010, Ollie Rattue
 * @license   http://www.opensource.org/licenses/mit-license.php
 * @link      https://github.com/ollierattue/codeigniter-sagepay-form
 */

class Sagepay_form_example extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
		
		$this->load->library('sagepay_form');
  	}

	// --------------------------------------------------------------------
	
    function index()
	{
		$vendor_tx_code = $this->sagepay_form->create_vendor_tx_code();
		
		/**************************************************************************************************
		* You need to save $vendor_tx_code against your order so that you can
		* match the success/failure response message from Sage Pay
		**************************************************************************************************/
		
		$this->sagepay_form->set_field('total', '15.00'); // with 2 decimal places where relevant
		$this->sagepay_form->set_field('description', 'My instructional DVD'); // The description of goods purchased is displayed on the Sage Pay Max 100
				
		// The domain name and protocol (http or https) is defined in sagepay_form_config. DO NOT INCLUDE HERE.
		$this->sagepay_form->set_field('success_url', 'sagepay_form_example/payment_status/success/');
		$this->sagepay_form->set_field('failure_url', 'sagepay_form_example/payment_status/failure/');
		
		// Billing address
		$this->sagepay_form->set_field('billing_first_names', "Jo"); // Max 20 characters
		$this->sagepay_form->set_field('billing_surname', "Blogs"); // Max 20 characters
		$this->sagepay_form->set_field('billing_address1', "Jo's place"); // Max 100 characters
		$this->sagepay_form->set_field('billing_address2', ""); // Optional Max 100 characters
		$this->sagepay_form->set_field('billing_city', "London"); // Max 40 characters
		$this->sagepay_form->set_field('billing_postcode', "EC8 8RH"); // Max 10 characters
		$this->sagepay_form->set_field('billing_country', "GB"); // 2 characters ISO 3166-1 country code
		$this->sagepay_form->set_field('billing_state', ""); // US customers only Max 2 characters State code
		$this->sagepay_form->set_field('billing_phone', "01205581818"); // Optional Max 20 characters
		                               
		// Can be the same as billing  
		$this->sagepay_form->set_field('delivery_first_names', "Jo"); // Max 20 characters
		$this->sagepay_form->set_field('delivery_surname', "Blogs"); // Max 20 characters
		$this->sagepay_form->set_field('delivery_address1', "Jo's office"); // Max 100 characters
		$this->sagepay_form->set_field('delivery_address2', ""); // Optional Max 100 characters
		$this->sagepay_form->set_field('delivery_city', "London"); // Max 40 characters
		$this->sagepay_form->set_field('delivery_postcode', "EC2 8RH"); // Max 10 characters
		$this->sagepay_form->set_field('delivery_country', "GB"); // 2 characters ISO 3166-1 country code
		$this->sagepay_form->set_field('delivery_state', ""); // US customers only Max 2 characters State code
		$this->sagepay_form->set_field('delivery_phone', "07879864846"); // Optional Max 20 characters
		
		// Or we can set the same delivery address as follows 
		$this->sagepay_form->set_same_delivery_address();
		
		// Optional values
		// $this->sagepay_form->set_field('send_email', ''); // Flag Consult the Form Protocol document
		// $this->sagepay_form->set_field('currency', ''); // 3 characters 
		// $this->sagepay_form->set_field('customer_email', ''); // Max 255 characters 
		// $this->sagepay_form->set_field('vendor_email', ''); // Set in config. You can do a per transaction override Max 255 characters 
		// $this->sagepay_form->set_field('email_message', ''); // A message to the customer which is inserted into the successful transaction e-mails only Max 7500 characters
		
		// Advanced fine control. Consult the Form Protocol document
		$this->sagepay_form->set_field('allow_gift_aid', 0); // For charities registered for Gift Aid, set to 1 to display the Gift Aid check box on the payment pages
		                     
		$this->sagepay_form->set_field('apply_avscv2', 0); // Allow fine control over AVS/CV2 checks and rules by changing this value
		$this->sagepay_form->set_field('apply_3d_secure', 0); // Allow fine control over 3D-Secure checks and rules by changing this value
		$this->sagepay_form->set_field('billing_agreement', 0); // For PAYPAL REFERENCE transactions 
		
		echo '<h2>Sage Pay Form example payment';
		echo $this->sagepay_form->form();
	}

	// --------------------------------------------------------------------

	// Redirected to from SagePay Form
	function payment_status($type = NULL)
	{
		$crypt = $_GET["crypt"];

		$decoded_response = $this->sagepay_form->decode_crypt($crypt);
		$response_array = $this->sagepay_form->getToken($decoded_response);
		
		$this->data['response_array'] = $response_array;		

		switch ($type)
		{
			case 'success':
				$this->load->view('sagepay_form_example/payment_status/success', $this->data);
			break;

			case('failure'):
				// Determine the reason this transaction was unsuccessful
				if ($response_array['Status'] == "NOTAUTHED")
				{
					$failure_reason = "You payment was declined by the bank.  This could be due to insufficient funds, or incorrect card details.";
				}
				else if ($response_array['Status'] == "ABORT")
				{
					$failure_reason =  "You chose to Cancel your order on the payment pages.  If you wish to change your order and resubmit it you can do so here. If you have questions or concerns about ordering online, please contact us at [your number].";
				}
				else if ($response_array['Status'] == "REJECTED")
				{
					$failure_reason = "Your order did not meet our minimum fraud screening requirements. If you have questions about our fraud screening rules, or wish to contact us to discuss this, please call [your number].";
				}
				else if ($response_array['Status'] == "INVALID" or $response_array['Status'] == "MALFORMED")
				{
					$failure_reason = "We could not process your order because we have been unable to register your transaction with our Payment Gateway. You can place the order over the telephone instead by calling [your number].";
				}
				else if ($response_array['Status'] == "ERROR")
				{
					$failure_reason = "We could not process your order because our Payment Gateway service was experiencing difficulties. You can place the order over the telephone instead by calling [your number].";
				}
				else
				{
					$failure_reason =  "The transaction process failed. Please contact us with the date and time of your order and we will investigate.";
				}

				$this->data['failure_reason'] = $failure_reason;

				$this->load->view('sagepay_form_example/payment_status/failure', $this->data);	
			break;

			default:
				redirect();
			break;
		}
	}

	// --------------------------------------------------------------------
}
?>