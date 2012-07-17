<html>
<head>
	<title>Sagepay Form example - Payment Success</title>
	<link rel="STYLESHEET" type="text/css" href="<?php echo base_url();?>css/formKitStyle.css">
</head>

<body>
    <div id="pageContainer">
        <div id="content">
            <div id="contentHeader">Your order has been Successful</div>
            <p>
                The Form transaction has completed successfully and the customer has been returned to this order completion page<br>
                <br>
                The order number, for your customer's reference is: <strong><?php echo $response_array['VendorTxCode']; ?></strong><br>
                <br>
                They should quote this in all correspondence with you, and likewise you should use this reference when sending queries to Sage Pay about this transaction (along with your Vendor Name).<br>
                <br>
                The table below shows everything sent back from Form about this order.  You would not normally show this level of detail to your customers, but it is useful during development.  You may wish to store this information in a local database if you have one.<br>
                <br>
                You can customise this page to send confirmation e-mails, display delivery times, present download pages, whatever is appropriate for your application.
            </p>
            <div class="greyHzShadeBar">&nbsp;</div>
            	<table class="formTable">
					<tr>
						<td colspan="2"><div class="subheader">Details sent back by Form</div></td>
						</tr>
					<tr>
				   		<td class="fieldLabel">VendorTxCode:</td>
				   		<td class="fieldData"><?php echo $response_array['VendorTxCode']; ?></td>
				</tr>
				<tr>
				   <td class="fieldLabel">Status:</td>
				   <td class="fieldData"><?php echo $response_array['Status']; ?></td>
				</tr>
				<tr>
				   <td class="fieldLabel">StatusDetail:</td>
				   <td class="fieldData"><?php echo $response_array['StatusDetail']; ?></td>
				</tr>
				<tr>
				   <td class="fieldLabel">Amount:</td>
				   <td class="fieldData"><?php echo $response_array['Amount']; ?></td>
				</tr>
				<tr>
				   <td class="fieldLabel">VPSTxId:</td>
				   <td class="fieldData"><?php echo $response_array['VPSTxId']; ?></td>
				</tr>
				<tr>
				   <td class="fieldLabel">VPSAuthCode</td>
				   <td class="fieldData"><?php echo $response_array['TxAuthNo']; ?></td>
				</tr>
				<tr>
				   <td class="fieldLabel">AVSCV2 Results:</td>
				   <td class="fieldData"><?php echo $response_array['AVSCV2']; ?><span class="smalltext"> - Address:<?php echo $response_array['AddressResult']; ?>, Post Code:<?php echo $response_array['PostCodeResult']; ?>, CV2:<?php echo $response_array['CV2Result']; ?></span></td>
				</tr>
				<tr>
				   <td class="fieldLabel">Gift Aid Transaction?:</td>
				   <td class="fieldData"><?php if ($response_array['GiftAid'] == "1") echo "Yes"; else echo "No"; ?></td>
				</tr>
				<tr>
				   <td class="fieldLabel">3D-Secure Status:</td>
				   <td class="fieldData"><?php echo $response_array['3DSecureStatus']; ?></td>
				</tr>
				
				<?php if (array_key_exists('CAVV',$response_array)): ?>
				<tr>
				   <td class="fieldLabel">CAVV:</td>
				   <td class="fieldData"><?php echo $response_array['CAVV']; ?></td>
				</tr>
				<?php endif; ?>
				
				<tr>
				   <td class="fieldLabel">CardType:</td>
				   <td class="fieldData"><?php echo $response_array['CardType']; ?></td>
				</tr>
				<tr>
				   <td class="fieldLabel">Last4Digits:</td>
				   <td class="fieldData"><?php echo $response_array['Last4Digits']; ?></td>
				</tr>
				<tr>
				   <td class="fieldLabel">AddressStatus:</td>
				<td class="fieldData"><span style="float:right; font-size: smaller;">&nbsp;*PayPal transactions only</span><?php if (isset($response_array['AddressStatus'])) echo $response_array['AddressStatus']; ?></td>
				</tr>
				<tr>
				<td class="fieldLabel">PayerStatus:</td>
				<td class="fieldData"><span style="float:right; font-size: smaller;">&nbsp;*PayPal transactions only</span><?php if (isset($response_array['PayerStatus'])) echo $response_array['PayerStatus']; ?></td>
				</tr>
				</table>
                <div class="greyHzShadeBar">&nbsp;</div>
</div>
</div>
</body>
</html>