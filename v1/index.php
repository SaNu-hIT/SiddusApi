<?php
require_once '../include/DbOperation.php';
require '.././libs/Slim/Slim.php';
require '../include/PHPMailerAutoload.php';
date_default_timezone_set('Asia/Kolkata');

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

/* *
 * URL: jinodemos-001-site1.etempurl.com/Sidhus/v1/addProduct
 *  URL: http://jinodemos-001-site1.etempurl.com/Sidhus/v1/addProduct
     * @param $customer_id
     * @param $category_id
     * @param $subcat_id
     * @param $product_title
     * @param $keywords
     * @param $price
     * @param $contact_number
     * @param $city

     * @param $location

     * @param $latitude

     * @param $longitude

     * @param $description

     * @param $agree



 * Method: POST

 * */

$app->post('/demo_email',function() use ($app){
    if(send_Invoice_Email($app->request->post('InvoiceNo'))){
        $response['error'] = true;
        $response['message'] = "Mail Send";
    }
    else {
        $response['error'] = true;
        $response['message'] = "Error!. Mail Not Send";
        //  echo "0 results";
    }
    echoResponse(200,$response);
});

function send_Invoice_Email($InvoiceNo){

    $db = new DbOperation();
    $result = $db->list_Invoices($InvoiceNo,"","");
    $response = array();
    $response['error'] = false;
    $response['Invoice_info'] = array();

    $uploadedUserName="";

    $INVOICE_NO=$InvoiceNo;
    $cust_mobileno="";
    $cust_fullname="";
    $cust_alternate_mobileno="";
    $cust_emailId="";

    $event_name="";
    $subcat_name="";
    $theme_name="";
    $color_combo="";
    $event_address="";
    $event_pincode="";
    $event_location="";
    $event_landmark="";
    $venue_type="";
    $eventDate="";
    $eventTime="";
    $concept_type="";
    $notes_or_Remarks='';

    $transportation_Rate = "";
    $Tax_percentage = "";
    $Advance = "";
    $Total = "";
    $Balance = "";
    $Status = "";
    $Event_Details = "";
    $name_on_board = "";

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $temp = array();
            $INVOICE_NO = $row['INVOICE_NO'];

            $temp['user_id'] = $row['user_id'];
            $temp['uploadedUserName'] = $row['uploadedUser'];
            $event_name = $row['event_name'];
            $subcat_name = $row['subcat_id'];
            $theme_name = $row['theme_name'];
            $color_combo = $row['color_combo'];
            $cust_fullname = $row['cust_fullname'];
            $cust_mobileno = $row['cust_mobileno'];
            $cust_alternate_mobileno = $row['cust_alternate_mobileno'];
            $cust_emailId = $row['cust_emailId'];
            $event_address = $row['event_address'];
            $event_pincode = $row['event_pincode'];
            $event_location = $row['event_location'];
            $event_landmark = $row['event_landmark'];
            $venue_type = $row['venue_type'];
            $eventDate = date_format(date_create($row['eventDate']),"d-m-Y");
            $eventTime = $row['eventTime'];
            $concept_type = $row['concept_type'];
            $notes_or_Remarks = $row['notes_or_Remarks'];
            $transportation_Rate = $row['transportation_Rate'];
            $Tax_percentage = $row['Tax_percentage'];
            $Advance = $row['Advance'];
            $Total = $row['Total'];
            $Balance = $row['Total']-$row['Advance'];
            $Status = $row['Status'];
            $Event_Details = $row['event_Details'];
            $name_on_board = $row['name_on_board'];


        }

        $emailMessageHeader="<div style='background-color:#0ac1b4;padding:30px 20px;width:700px;font-size:14px;line-height:22px'>
<div style='color: white;text-transform:uppercase;font-size: 17px;font-weight:bold;background-color: white;text-align: center;font-style: italic;'>
<a href='https://sidduevents.com' target='_blank'>
<img alt='sidduevents.com' src='https://www.sidduevents.com/Sidhus_api/Mailformat_logo.png' style='width: 100%;max-width:300px;'>
</a>
<div style='font-size: 13px;font-style: normal;color: black;margin-top: -20px;padding-bottom: 6px;'>One click away to celebrate your happy moments.</div>
</div>
<div style='color: white;text-transform:uppercase;font-size: 17px;font-weight:bold;background-color: black;padding: 2px;text-align: center;font-style: italic;'></div>
<div style='color: red;text-transform:uppercase;font-size: 17px;font-weight:bold;background-color: white;padding: 7px;text-align: center;'>Booking  Confirmation
</div>";
        $emailMessageIntro="<div style='background-color:#ffffff;padding:20px;margin-top: 20px;'>
	<div style='font-size:14px;line-height:22px'>
		<div style='margin-top:30px'>
		    <p><b>Invoice No:</b> SID-BLR-$InvoiceNo</p>
			<p>Hi $cust_fullname,</p>
			<p>Greetings from Siddu Events, Thanks for choosing our platform for event service &amp; we are pleased to inform that your event has been confirm with us. We wish you a wonderful party!
.
			</p>
		</div>
		
		<div style='margin:15px 0'>
			<div>Best Regards,</div>
			<div><a href='https://sidduevents.com' style='color:#333' target='_blank'>Team Sidhus Events</a></div>
			<div>Phone: +91 8884337770</div>
		</div>
	</div>
</div>";

        $emailMessageCustomerDetails="
<div style='margin-top: 20px;color: white;text-transform:uppercase;font-size: 17px;font-weight:bold;background-color: grey;padding: 7px;text-align: center;font-style: italic;'>
Customer&nbsp;&nbsp;DETAILS</div>
<div style='background-color: white;padding:20px;'>
	
	<ul style='text-align: center;font-size: 17px;display:table;table-layout:fixed;padding:0;margin:10px 0 0 0;list-style:none;width:100%'>
		<li style='display:table-cell'>
			<div style='
    font-style: italic;
    font-size: 18px;
'><b>Customer Name</b></div>
			<div>$cust_fullname</div>
		</li>
		<li style='display:table-cell'>
			<div style='
    font-style: italic;
    font-size: 18px;
'><b>Mobile Number</b></div>
			<div>$cust_mobileno</div>
		</li>
		<li style='display:table-cell'>
			<div style='
    font-style: italic;
    font-size: 18px;
'><b>Alt. Phone Number</b></div>
			<div>$cust_alternate_mobileno</div>
		</li>
	</ul>
</div>";

        $emailMessageEventDetails="
<div style='margin-top: 20px;color: white;text-transform:uppercase;font-size: 17px;font-weight:bold;background-color: grey;padding: 7px;text-align: center;font-style: italic;'>
Event  Details</div>
<div style='background-color: white;padding:20px;'>
	
	<ul style='text-align: center;font-size: 17px;display:table;table-layout:fixed;padding:0;margin:10px 0 0 0;list-style:none;width:100%'>
		<li style='display:table-cell'>
			<div style='
    font-style: italic;
    font-size: 18px;
'><b>Event Date</b></div>
			<div>$eventDate</div>
		</li>
		<li style='display:table-cell'>
			<div style='
    font-style: italic;
    font-size: 18px;
'><b>Timing</b></div>
			<div>$eventTime</div>
		</li>
		<li style='display:table-cell'>
			<div style='
    font-style: italic;
    font-size: 18px;
'><b>Occasion</b></div>
			<div>$venue_type</div>
		</li>
	</ul>
</div>";

        $emailMessageThemeDetails="
<div style='margin-top: 20px;color: white;text-transform:uppercase;font-size: 17px;font-weight:bold;background-color: grey;padding: 7px;text-align: center;font-style: italic;'>
Theme  Details</div>
<div style='background-color: white;padding:20px;'>
	<ul style='text-align: center;font-size: 17px;display:table;table-layout:fixed;padding:0;margin:10px 0 0 0;list-style:none;width:100%'>
		<li style='display:table-cell'>
			<div style='
    font-style: italic;
    font-size: 18px;
'><b>Concept Type</b></div>
			<div>$concept_type</div>
		</li>
		<li style='display:table-cell'>
			<div style='
    font-style: italic;
    font-size: 18px;
'><b>Theme Name</b></div>
			<div>$theme_name</div>
		</li>
		<li style='display:table-cell'>
			<div style='
    font-style: italic;
    font-size: 18px;
'><b>Color Combination</b></div>
			<div>$color_combo</div>
		</li>
	</ul>
</div>";

        $emailMessageDescriptionDetails="
<div style='margin-top: 20px;color: white;text-transform:uppercase;font-size: 17px;font-weight:bold;background-color: grey;padding: 7px;text-align: center;font-style: italic;'>
Description</div>
<div style='background-color: white;padding:20px;'>
	
	 
		<div style='font-weight:bold;font-style: italic;font-size: 18px;'>Inclusions</div>
		<ul style='text-align: center;font-size: 17px;padding:0 15px 0 20px;font-size:14px;'>
			<li>$Event_Details</li>
			 
		</ul>
		<div style='margin-top:15px'>
		  <div><p><b style='font-style: italic;font-size: 18px;'>Name on Board: </b> $name_on_board</p></div>
	     </div>
		 <div style='margin-top:15px'>
		  <div><b style='font-style: italic;font-size: 18px;'>Special Note: </b><p> $notes_or_Remarks</p></div>
	     </div>
	 
</div>";

        /*Reference Image Loop*/
        $emailMessageReferenceImagesDetails="<div style='margin-top: 20px;color: white;text-transform:uppercase;font-size: 17px;font-weight:bold;background-color: grey;padding: 7px;text-align: center;font-style: italic;'>
Reference Images</div><div style='background-color:#ffffff;padding:0 20px 20px 20px'>";
        $dbImage = new DbOperation();
        $resultImage = $dbImage->list_Invoices_Images($INVOICE_NO);

        if ($resultImage->num_rows > 0) {
            while($rowImage = $resultImage->fetch_assoc()) {
                $emailMessageReferenceImagesDetails=$emailMessageReferenceImagesDetails."<a href='".HOST_URL .$rowImage['imageUrl']."' style='text-decoration:none' target='_blank'>
 <img src='".HOST_URL .$rowImage['imageUrl']."' alt='Reference Image' style='border:1px solid #0ac1b4;margin-right:5px;margin-top:10px;max-width:140px;max-height:90px' class='CToWUd'>";
            }
        }
        $emailMessageReferenceImagesDetails=$emailMessageReferenceImagesDetails."</div>";
        /*Other Srvice Details Loop*/


$emailMessageOtherServicesDetails="<div style='margin-top: 20px;color: white;text-transform:uppercase;font-size: 17px;font-weight:bold;background-color: grey;padding: 7px;text-align: center;font-style: italic;'>Other Services Details</div>";

        $responseSubCatName= explode(",",$subcat_name);
        $ResultCategoryList=array();
        $ResultCategoryList['SubCategory_info']=array();
if(count($responseSubCatName)==0){
    if($subcat_name!=""){
        $dbnew = new DbOperation();
        $result = $dbnew->list_subCategoryByName($subcat_name);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $subcat_id = $row['subcat_id'];
                $category_id = $row['category_id'];
                $subcat_name = $row['subcat_name'];
                $cat_name = $row['cat_name'];
                $emailMessageOtherServicesDetails =$emailMessageOtherServicesDetails."<div style='background-color: white;padding:20px;'>
	<ul style='text-align: center;font-size: 17px;display:table;table-layout:fixed;padding:0;margin:10px 0 0 0;list-style:none;width:100%'>
		<li style='display:table-cell'>
			<div style='
    font-style: italic;
    font-size: 18px;
'><b>Category</b></div>
			<div>$cat_name</div>
		</li>
		<li style='display:table-cell'>
			<div style='
    font-style: italic;
    font-size: 18px;
'><b>Sub Category</b></div>
			<div>$subcat_name</div>
		</li>
 
	</ul>
</div>";

            }
        }
    }
}
        for ($i = 0; $i < count($responseSubCatName); $i++) {
            $subCatName = $responseSubCatName[$i];
            $dbnew = new DbOperation();
            $result = $dbnew->list_subCategoryByName($subCatName);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $subcat_id = $row['subcat_id'];
                    $category_id = $row['category_id'];
                    $subcat_name = $row['subcat_name'];
                    $cat_name = $row['cat_name'];
                    $emailMessageOtherServicesDetails = $emailMessageOtherServicesDetails."<div style='background-color: white;padding:20px;'>
	<ul style='text-align: center;font-size: 17px;display:table;table-layout:fixed;padding:0;margin:10px 0 0 0;list-style:none;width:100%'>
		<li style='display:table-cell'>
			<div style='
    font-style: italic;
    font-size: 18px;
'><b>Category</b></div>
			<div>$cat_name</div>
		</li>
		<li style='display:table-cell'>
			<div style='
    font-style: italic;
    font-size: 18px;
'><b>Sub Category</b></div>
			<div>$subcat_name</div>
		</li>
 
	</ul>
</div>";

                }
            }


        }

        $emailMessageEventLocationDetails="		
<div style='margin-top: 20px;color: white;text-transform:uppercase;font-size: 17px;font-weight:bold;background-color: grey;padding: 7px;text-align: center;font-style: italic;'>
Event  Location  Details</div>
<div style='background-color: white;padding:20px;'>
 <div style='margin-bottom:15px'>
	<div style='font-size: 18px;float: left;width: 50%;'><b style='font-size: 21px;font-style: italic;'>Location:</b>  $event_location</div>
	<div style='font-size: 18px;float: right;width: 50%;'><b style='font-size: 21px;font-style: italic;'>Venue Type:</b> $venue_type </div>
</div>
 <div style='margin-top:45px'>
 
   <div style='font-size: 18px;width: 50%;'><b style='font-size: 21px;font-style: italic;'>Full Address: </b></div>
    <div style='font-size: 18px;width: 50%;'>$event_address</div>
 </div>
 <div style='margin-top: 20px;margin-bottom:15px'>
 
 <div style='font-size: 18px;width: 50%;'><b style='font-size: 21px;font-style: italic;'>Landmark:</b> $event_landmark</b></div>

 </div>
</div>";

        $emailMessagePaymentDetails="	
<div style='margin-top: 20px;color: white;text-transform:uppercase;font-size: 17px;font-weight:bold;background-color: grey;padding: 7px;text-align: center;font-style: italic;'>
Payment  Details</div>
<div style='background-color: white;padding:20px;'>
 <div style='margin-bottom:15px'>
	<div style='font-size: 18px;float: left;width: 50%;'><b style='font-style: italic;font-size: 21px;'>Transportation Price:</b> <b>Rs. $transportation_Rate</b></div>
	 
</div>
 <div style='background-color: white;padding:20px;'>
	
	<ul style='text-align: center;font-size: 17px;display:table;table-layout:fixed;padding:0;margin:10px 0 0 0;list-style:none;width:100%'>
		<li style='display:table-cell'>
			<div style='color: #d21818;font-style: italic;font-size: 21px;'><b>Booking Amount</b></div>
			<div style='padding: 11px;font-size: 21px;'>Rs.$Total</div>
		</li>
		<li style='display:table-cell'>
			<div style='color: #d21818;font-style: italic;font-size: 21px;'><b>Advance Paid</b></div>
			<div style='padding: 11px;font-size: 21px;'>Rs.$Advance</div>
		</li>
		<li style='display:table-cell'>
			<div style='color: #d21818;font-style: italic;font-size: 21px;'><b>Balance Amount</b></div>
			<div style='padding: 11px;font-size: 21px;'>Rs.$Balance</div>
		</li>
	</ul>
</div>
</div>";
        $emailMessageTermsDetails="	
 <div style='margin-top: 20px;color: white;text-transform:uppercase;font-size: 17px;font-weight:bold;background-color: grey;padding: 7px;text-align: center;font-style: italic;'>
Terms &amp; Conditions</div>
<div style='background-color: white;padding:20px;'>
  <div style='margin-top:15px'>
		<div style='font-weight:bold;font-style: italic;font-size: 18px;'>Inclusions</div>
		<ul style='font-size: 17px;padding:0 15px 0 20px;font-size:14px;'>
			<li>Free transportation for the delivery and dispatch of the decoration within the radius of 10 Km from indiranagar. Rs.40 per km will be applicable if it exceeds 10km.</li>
			<li style='padding-top:5px'>&#8203;If addition decorations are required, additional charges will be applied based on the package.</li>
			<li style='padding-top:5px'>All the Items used for decoration should be returned at the end of the party except balloons.</li>
		    <li style='padding-top:5px'>Decorations booked are valid for party duration of 3 - 4 hours only.</li>
		    <li style='padding-top:5px'>Remaining balance payment should be done in the form of cash only, once the event is completed.</li>
		    <li style='padding-top:5px'>If there is any damage to any of the decoration items, the customer will be charged accordingly.</li>
		    <li style='padding-top:5px'>A Decoration package does not include any furniture’s.</li>
		    <li style='padding-top:5px'>Sufficient time is required to execute the decorations, in case it differs then it is not in our control. </li>
		    <li style='padding-top:5px'>Customer needs to take all the permissions related to the decor from party hall / Banquet halls.</li>
		    <li style='padding-top:5px'>Legal Disclaimer: Product may slightly vary due to Photographic Lighting or Place of the event.</li>
		
		</ul></div></div></div>";

        $replayemail="sidduevents03@gmail.com";
     //	 $replayemail='jinoshajiv@gmail.com';
        $message=$emailMessageHeader.$emailMessageIntro.$emailMessageCustomerDetails.$emailMessageEventDetails.$emailMessageThemeDetails.$emailMessageDescriptionDetails.$emailMessageReferenceImagesDetails.$emailMessageOtherServicesDetails.$emailMessageEventLocationDetails.$emailMessagePaymentDetails.$emailMessageTermsDetails;

        $message = $message ."<br/> <br/>If any queries replay to email-id : ".$replayemail ." or contact sidhus events management team<br/><br/>Regards,<br/>Team Sidhus Events<br/><br/>";

        $subject="Siddu Events INVOICE on $eventDate";


        $headers = "From: " . strip_tags($replayemail) . "\r\n";
        //  $headers = "From: " . strip_tags($replayemail) . "\r\n";
        $headers .= "Reply-To: ". strip_tags($replayemail) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        if($cust_emailId!="")
         $cust_emailId= $cust_emailId.',jinoshajiv@gmail.com';
        else
           $cust_emailId= 'sidduevents03@gmail.com';

	   
	   
	/*   $mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "keems.letsschool@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "cloudique7273";

//Set who the message is to be sent from
$mail->setFrom('keems.letsschool@gmail.com', 'Jino Shaji');

//Set an alternative reply-to address
$mail->addReplyTo('jinoshajiv@gmail.com', 'Jino Shaji');

//Set who the message is to be sent to
$mail->addAddress($cust_emailId, $cust_fullname);

//Set the subject line
$mail->Subject = $subject;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML($message);

//Replace the plain text body with one created manually
$mail->AltBody = $message;

//Attach an image file
//send the message, check for errors
if (!$mail->send()) {
   $ok=false;
} else {
   $ok=true;
}*/


    if($cust_emailId!="") {
            $ok = @mail('jinoshajiv@gmail.com', $subject, $message, $headers);
            $ok = @mail($cust_emailId, $subject, $message, $headers);
        }
        else
            $ok=false; 
/*if (!$mail->send()) {
   $ok=false;
} else {
   $ok=true;
}*/

        if ($ok) {
           return true;
        }else{
            return false;
        }
    }
    return false;

}

$app->post('/create_new_invoice',function() use ($app){
    verifyRequiredParams(array('cust_fullname','user_id',
        'theme_name','color_combo','cust_mobileno',
        'cust_emailId','event_address','event_pincode','event_location','event_landmark'
    ,'eventDate','eventTime','event_id','subcat_id','venue_type','concept_type','notes_or_Remarks'
    ,'transportation_Rate','Tax_percentage','Advance','Total'));

    $cust_fullname = $app->request->post('cust_fullname');
    $user_id = $app->request->post('user_id');

    $theme_name=$app->request->post('theme_name');

    $color_combo=$app->request->post('color_combo');
    $cust_mobileno=$app->request->post('cust_mobileno');
    $cust_alternate_mobileno=$app->request->post('cust_alternate_mobileno');
    $cust_emailId=$app->request->post('cust_emailId');
    $event_address=$app->request->post('event_address');
    $event_pincode=$app->request->post('event_pincode');
    $event_location=$app->request->post('event_location');
    $event_landmark=$app->request->post('event_landmark');
    $eventDate=$app->request->post('eventDate');

    $eventDate=date_format(date_create($eventDate),"Y-m-d");
//    $response['error'] = false;
//    $response['message'] = "Invoice added successfully";
//    $response['Invoice_id'] =$eventDate;
//    echoResponse(200,$response);
//    return;
    $eventTime=$app->request->post('eventTime');
    $event_id=$app->request->post('event_id');
    $subcat_id =$app->request->post('subcat_id');
    $venue_type=$app->request->post('venue_type');
    $concept_type=$app->request->post('concept_type');
    $notes_or_Remarks=$app->request->post('notes_or_Remarks');
    $transportation_Rate=$app->request->post('transportation_Rate');
    $Tax_percentage=$app->request->post('Tax_percentage');
    $Advance=$app->request->post('Advance');
    $Total=$app->request->post('Total');
    $event_Details=$app->request->post('event_Details');
    $name_on_board=$app->request->post('name_on_board');
    $special_notes=$app->request->post('special_notes');

    $db = new DbOperation();
    $response = array();
    $result=$db->create_new_invoice($cust_fullname,$user_id,$theme_name,$color_combo,$cust_mobileno,$cust_alternate_mobileno,$cust_emailId,$event_address,$event_pincode,$event_location,$event_landmark,$event_id,$subcat_id,$venue_type,$eventDate,$eventTime,$concept_type,$notes_or_Remarks,$transportation_Rate,$Tax_percentage,$Advance,$Total,$event_Details,$name_on_board,$special_notes);
//    $response['error'] = true;
//    $response['Invoice_id'] =$result;
//
//    echoResponse(200,$response);
//    return;
    if($result!=false){
        $response['error'] = false;
        $response['message'] = "Invoice added successfully";
        $response['Invoice_id'] =$result;
        if (send_Invoice_Email($response['Invoice_id'])) {
            $response['Email_error'] = false;
            $response['Email_response'] = "EMail Sent successfully";
        }else{
            $response['Email_error'] = true;
            $response['Email_response'] ="Mail Could not send";
        }
  }else{

        $response['error'] = true;
        $response['message'] = "Could not add new Invoice";
        $response['Invoice_id'] =$result;
    }

    echoResponse(200,$response);
});


$app->post('/update_INVOICE',function() use ($app){
    verifyRequiredParams(array('InvoiceNo','user_id','cust_fullname',
        'theme_name','color_combo','cust_mobileno',
        'cust_emailId','event_address','event_pincode','event_location','event_landmark'
    ,'eventDate','eventTime','event_id','subcat_id','venue_type','concept_type','notes_or_Remarks'
    ,'transportation_Rate','Tax_percentage','Advance','Total','Status'));

    $InvoiceNo = $app->request->post('InvoiceNo');
    $user_id = $app->request->post('user_id');
    $cust_fullname = $app->request->post('cust_fullname');



    $theme_name=$app->request->post('theme_name');

    $color_combo=$app->request->post('color_combo');
    $cust_mobileno=$app->request->post('cust_mobileno');
    $cust_alternate_mobileno=$app->request->post('cust_alternate_mobileno');
    $cust_emailId=$app->request->post('cust_emailId');
    $event_address=$app->request->post('event_address');
    $event_pincode=$app->request->post('event_pincode');
    $event_location=$app->request->post('event_location');
    $event_landmark=$app->request->post('event_landmark');
    $eventDate=$app->request->post('eventDate');
    $eventDate=date_format(date_create($eventDate),"Y-m-d");
    $eventTime=$app->request->post('eventTime');
    $event_id=$app->request->post('event_id');
    $subcat_id =$app->request->post('subcat_id');
    $venue_type=$app->request->post('venue_type');
    $concept_type=$app->request->post('concept_type');
    $notes_or_Remarks=$app->request->post('notes_or_Remarks');
    $transportation_Rate=$app->request->post('transportation_Rate');
    $Tax_percentage=$app->request->post('Tax_percentage');
    $Advance=$app->request->post('Advance');
    $Total=$app->request->post('Total');
    $Status=$app->request->post('Status');
    $event_Details=$app->request->post('event_Details');

    $db = new DbOperation();
    $response = array();
    $result=$db->update_INVOICE($InvoiceNo,$user_id,$cust_fullname,$theme_name,$color_combo,$cust_mobileno,$cust_alternate_mobileno,$cust_emailId,$event_address,$event_pincode,$event_location,$event_landmark,$event_id,$subcat_id,$venue_type,$eventDate,$eventTime,$concept_type,$notes_or_Remarks,$transportation_Rate,$Tax_percentage,$Advance,$Total,$Status,$event_Details);
//echo $result;
//return;
    if($result){
        $response['error'] = false;
        $response['message'] = "Invoice updated successfully";

    }else{

        $response['error'] = true;
        $response['message'] = "Could not update new Invoice";
    }
    echoResponse(200,$response);

});

$app->post('/delete_Invoice',function() use ($app){
    verifyRequiredParams(array('InvoiceNo','user_id'));
    $InvoiceNo = $app->request->post('InvoiceNo');
    $user_id = $app->request->post('user_id');
    $db = new DbOperation();
    $response = array();
    if($db->delete_INVOICE($InvoiceNo,$user_id)=="true"){
        $response['error'] = false;
        $response['message'] = "Invoice deleted successfully";
    }else{
        $response['error'] = true;
        $response['message'] = "Could not delete new Invoice";
    }
    echoResponse(200,$response);
});

$app->post('/list_invoice',function() use ($app){
    $INVOICE_NO=$app->request->post('invoice_no');
    $eventDate=$app->request->post('eventDate');
    $user_id=$app->request->post('user_id');
    $db = new DbOperation();
    $result = $db->list_Invoices($INVOICE_NO,$eventDate,$user_id);
    $response = array();
    $response['error'] = false;
    $response['Invoice_info'] = array(); 
   // $response['query']=$result;

    // echoResponse(200,$response);
    //  return;

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $temp = array();
            $temp['INVOICE_NO'] = $row['INVOICE_NO'];
            $temp['cust_fullname'] = $row['cust_fullname'];
            $temp['user_id'] = $row['user_id'];
            $temp['uploadedUserName'] = $row['uploadedUser'];
            $temp['event_name'] = $row['event_name'];
            $temp['subcat_name'] = $row['subcat_id'];
            // $temp['cat_name'] = $row['cat_name'];

            $temp['cust_address'] = "";
            $temp['theme_name'] = $row['theme_name'];
            $temp['color_combo'] = $row['color_combo'];
            $temp['cust_mobileno'] = $row['cust_mobileno'];
            $temp['cust_alternate_mobileno'] = $row['cust_alternate_mobileno'];
            $temp['cust_emailId'] = $row['cust_emailId'];
            $temp['event_address'] = $row['event_address'];
            $temp['event_pincode'] = $row['event_pincode'];
            $temp['event_location'] = $row['event_location'];
            $temp['event_landmark'] = $row['event_landmark'];
            $temp['venue_type'] = $row['venue_type'];
            $temp['eventDate'] = date_format(date_create($row['eventDate']),"d-m-Y");

            $temp['eventTime'] = $row['eventTime'];
            $temp['concept_type'] = $row['concept_type'];
            $temp['notes_or_Remarks'] = $row['notes_or_Remarks'];
            $temp['transportation_Rate'] = $row['transportation_Rate'];
            $temp['Tax_percentage'] = $row['Tax_percentage'];
            $temp['Advance'] = $row['Advance'];
            $temp['Total'] = $row['Total'];
            $temp['Balance'] = $row['Total']-$row['Advance'];
            $temp['Status'] = $row['Status'];
            $temp['Event_Details'] = $row['event_Details'];
            $temp['name_on_board'] = $row['name_on_board'];
           $temp['special_notes'] = $row['special_notes'];

            $dbImage = new DbOperation();
            $resultImage = $dbImage->list_Invoices_Images($row['INVOICE_NO']);
            $temp['INVOICE_Images'] = array();
            if ($resultImage->num_rows > 0) {
                $tempImage = array();
                while($rowImage = $resultImage->fetch_assoc()) {
                    $tempImage['ImageUrl']=HOST_URL .$rowImage['imageUrl'];
                    array_push($temp['INVOICE_Images'],$tempImage);

                }

            }

            array_push($response['Invoice_info'],$temp);

            // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " User Name" . $row["username"]. "<br>" . " API Key" . $row["api_key"]. "<br>";

        }

    } else {
        $response['error'] = true;
        $response['message'] = "No data found";
        //  echo "0 results";
    }
    echoResponse(200,$response);
});

$app->post('/list_invoice_completed',function() use ($app){
    $INVOICE_NO=$app->request->post('invoice_no');
    $eventDate=$app->request->post('eventDate');
    $user_id=$app->request->post('user_id');
    $db = new DbOperation();
    $result = $db->list_Invoices_completed($INVOICE_NO,$eventDate,$user_id);
    $response = array();
    $response['error'] = false;
    $response['Invoice_info'] = array();
//     echo $result;
//   return;
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $temp = array();
            $temp['INVOICE_NO'] = $row['INVOICE_NO'];
            $temp['cust_fullname'] = $row['cust_fullname'];
            $temp['user_id'] = $row['user_id'];
            $temp['uploadedUserName'] = $row['uploadedUser'];
            $temp['event_name'] = $row['event_name'];
            $temp['subcat_name'] = $row['subcat_id'];
            // $temp['cat_name'] = $row['cat_name'];

            $temp['cust_address'] = "";
            $temp['theme_name'] = $row['theme_name'];
            $temp['color_combo'] = $row['color_combo'];
            $temp['cust_mobileno'] = $row['cust_mobileno'];
            $temp['cust_alternate_mobileno'] = $row['cust_alternate_mobileno'];
            $temp['cust_emailId'] = $row['cust_emailId'];
            $temp['event_address'] = $row['event_address'];
            $temp['event_pincode'] = $row['event_pincode'];
            $temp['event_location'] = $row['event_location'];
            $temp['event_landmark'] = $row['event_landmark'];
            $temp['venue_type'] = $row['venue_type'];
            $temp['eventDate'] = date_format(date_create($row['eventDate']),"d-m-Y");
            $temp['eventTime'] = $row['eventTime'];
            $temp['concept_type'] = $row['concept_type'];
            $temp['notes_or_Remarks'] = $row['notes_or_Remarks'];
            $temp['transportation_Rate'] = $row['transportation_Rate'];
            $temp['Tax_percentage'] = $row['Tax_percentage'];
            $temp['Advance'] = $row['Advance'];
            $temp['Total'] = $row['Total'];
            $temp['Balance'] = $row['Total']-$row['Advance'];
            $temp['Status'] = $row['Status'];
            $temp['Event_Details'] = $row['event_Details'];
            $temp['name_on_board'] = $row['name_on_board'];
            $temp['special_notes'] = $row['special_notes'];

            $dbImage = new DbOperation();
            $resultImage = $dbImage->list_Invoices_Images($row['INVOICE_NO']);
            $temp['INVOICE_Images'] = array();
            if ($resultImage->num_rows > 0) {
                $tempImage = array();
                while($rowImage = $resultImage->fetch_assoc()) {
                    $tempImage['ImageUrl']=HOST_URL .$rowImage['imageUrl'];
                    array_push($temp['INVOICE_Images'],$tempImage);
                }

            }

            array_push($response['Invoice_info'],$temp);

            // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " User Name" . $row["username"]. "<br>" . " API Key" . $row["api_key"]. "<br>";
        }

    } else {
        $response['error'] = true;
        $response['message'] = "No data found";
        //  echo "0 results";
    }
    echoResponse(200,$response);
});

$app->post('/addProduct_Images',function() use ($app){
    verifyRequiredParams(array('image','invoice_id'));
    $INVOICE_NO=$app->request->post('invoice_id');
    $base = $app->request->post('image');
    // $filename = $app->request->post('filename');
    $db = new DbOperation();
    $filename=$db->randString(25) . "_".$INVOICE_NO .".jpg";

//$response['error'] = false;
//        $response['message'] = ROOT_URL.'imgupload/' . $filename;
//$response['mFileName'] = $filename;
//echoResponse(200,$response);
//return;

// Decode Image
    $binary = base64_decode($base);
    header('Content-Type: bitmap; charset=utf-8');
// Images will be saved under 'www/imgupload/uplodedimages' folder
    $file = fopen('../imgupload/' . $filename, 'wb');
// Create File
    $res= fwrite($file, $binary);
    fclose($file);
    $response = array();
    if($db->insert_product_image($INVOICE_NO, ROOT_URL.'imgupload/' . $filename)){
        $response['error'] = false;
        $response['message'] = "Invoice Image added successfully";
    }else{
        $response['error'] = true;
        $response['message'] = "Could not add new Invoice image";
    }
    echoResponse(200,$response);

});





/* *METHOD TO Insert  Subcategory

 * URL: http://YOUR DOMAIN/Sidhus/v1/insert_SubCategory

 *  URL: http://techdemos.esy.es//Sidhus/v1/insert_SubCategory

    * @param $category_id
    * @param $Subcat_name

     * Method: POST

 * */

$app->post('/insert_SubCategory',function() use ($app){
    verifyRequiredParams(array('category_id','cat_name'));
    $subcat_name = $app->request->post('cat_name');
    $category_id= $app->request->post('category_id');
    $db = new DbOperation();
    $response = array();

    if($db->insert_SubCategory($category_id,$subcat_name)){
        $response['error'] = false;
        $response['message'] = "SubCategory successfully added";
    }else{
        $response['error'] = true;
        $response['message'] = "Could not add new Subcategory";
    }
    echoResponse(200,$response);
});


$app->post('/list_Category',function() use ($app){

    $db = new DbOperation();
    $result = $db->list_Category();
    $response = array();
    $response['error'] = false;
    $response['Category_info'] = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $temp = array();
            $temp['category_id'] = $row['category_id'];
            $temp['cat_name'] = $row['cat_name'];
            array_push($response['Category_info'],$temp);

        }
    } else {
        $response['error'] = true;
        $response['message'] = "No data found";
        //  echo "0 results";
    }
    echoResponse(200,$response);
});

$app->post('/list_EventType',function() use ($app){

    $db = new DbOperation();
    $result = $db->list_EventType();
    $response = array();
    $response['error'] = false;
    $response['EventType_info'] = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $temp = array();
            $temp['event_id'] = $row['event_id'];
            $temp['event_name'] = $row['event_name'];
            array_push($response['EventType_info'],$temp);

        }
    } else {
        $response['error'] = true;
        $response['message'] = "No data found";
        //  echo "0 results";
    }
    echoResponse(200,$response);
});

$app->post('/list_SubCategory',function() use ($app){
    verifyRequiredParams(array('category_id'));
    $category_id=$app->request->post('category_id');
    $db = new DbOperation();
    $result = $db->list_subCategory($category_id);
    $response = array();
    $response['error'] = false;
    $response['SubCategory_info'] = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $temp = array();
            $temp['subcat_id'] = $row['subcat_id'];
            $temp['category_id'] = $row['category_id'];
            $temp['subcat_name'] = $row['subcat_name'];
            $temp['cat_name'] = $row['cat_name'];
            array_push($response['SubCategory_info'],$temp);

        }
    } else {
        $response['error'] = true;
        $response['message'] = "No data found";
        //  echo "0 results";
    }
    echoResponse(200,$response);
});


/* *METHOD TO remove  Subcategory

 * URL: http://YOUR DOMAIN/PISCO_API/v1/remove_SubCategory

 *  URL: http://techdemos.esy.es//PISCO_API/v1/remove_SubCategory

    * @param $Subcategory_id

     * Method: POST

 * */



$app->post('/remove_SubCategory',function() use ($app){

    verifyRequiredParams(array('Subcategory_id'));

    $Subcategory_id = $app->request->post('Subcategory_id');

    $db = new DbOperation();

    $response = array();

    if($db->delete_Subcategory($Subcategory_id)){

        $response['error'] = false;

        $response['message'] = "SubCategory successfully removed ";

    }else{

        $response['error'] = true;

        $response['message'] = "Could not remove a SubCategory";

    }

    echoResponse(200,$response);

});


/* *METHOD TO remove  category

 * URL: http://YOUR DOMAIN/PISCO_API/v1/remove_Category

 *  URL: http://techdemos.esy.es//PISCO_API/v1/remove_Category

    * @param $category_id

     * Method: POST

 * */



$app->post('/remove_Category',function() use ($app){

    verifyRequiredParams(array('category_id'));

    $category_id = $app->request->post('category_id');

    $db = new DbOperation();



    $response = array();

    if($db->delete_category($category_id)){

        $response['error'] = false;

        $response['message'] = "Category successfully removed ";

    }else{

        $response['error'] = true;

        $response['message'] = "Could not remove a Category";

    }

    echoResponse(200,$response);

});



$app->post('/insert_Category',function() use ($app){
    verifyRequiredParams(array('cat_name'));
    $cat_name = $app->request->post('cat_name');
    $product_id = $app->request->post('product_id');
    $db = new DbOperation();
    $response = array();

    if($db->insert_Category($cat_name)){

        $response['error'] = false;

        $response['message'] = "Category successfully added";

    }else{

        $response['error'] = true;

        $response['message'] = "Could not add new category";

    }

    echoResponse(200,$response);

});



$app->post('/uploadPic',function() use ($app){

    $base = $app->request->post('image');

    $db = new DbOperation();

    $filename=$db->randString(25) ."_1Jinosh". ".jpg";

    // $filename = $app->request->post('filename');

//

//    $base = $_REQUEST['image'];

//// Get file name posted from Android App

//    $filename = $_REQUEST['filename'];

// Decode Image

    $binary = base64_decode($base);
    /*  $img=$base;
      $img = str_replace('data:image/png;base64,', '', $img);
      $img = str_replace(' ', '+', $img);
      $data = base64_decode($img);
      $file ='../imgupload/' . uniqid() . '.png';
      $success = file_put_contents($file, $data);
  */
    header('Content-Type: bitmap; charset=utf-8');

// Images will be saved under 'www/imgupload/uplodedimages' folder

    $file = fopen('../imgupload/' . $filename, 'wb');

// Create File

    $success= fwrite($file, $base);

    fclose($file);

    echo $success ? $file : 'Unable to save the file.';; //'Image upload complete, Please check your php file directory';

});



/* *METHOD TO USER REGISTRATION

 * URL: http://YOUR DOMAIN/PISCO_API/v1/User_Registration

 *  URL: http://techdemos.esy.es//PISCO_API/v1/User_Registration

    * @param $fullname

     * @param $address

     * @param $pincode

     * @param $city

     * @param $mobileno

     * @param $emailId

     * @param $password

     * @param $FRID

     * @param $role

     * Method: POST

 * */



$app->post('/User_Registration',function() use ($app){

    verifyRequiredParams(array('full_name','address','pincode','city','password','FRID','role'));

    $fullname = $app->request->post('full_name');

    $address = $app->request->post('address');

    $pincode=$app->request->post('pincode');

    $city=$app->request->post('city');

    $mobileno = $app->request->post('mobileno');

    $emailId = $app->request->post('emailId');
    $password=$app->request->post('password');

    $FRID = $app->request->post('FRID');

    $role = $app->request->post('role');

    $db = new DbOperation();
    $imagepath="";
    if($app->request->post('image')!="") {
        $base = $app->request->post('image');
        // $filename = $app->request->post('filename');

        $filename = $db->randString(25) . "_" . $fullname . ".jpg";
// Decode Image
        $binary = base64_decode($base);
        header('Content-Type: bitmap; charset=utf-8');
// Images will be saved under 'www/imgupload/' folder
        $file = fopen('../imgupload/' . $filename, 'wb');

// Create File
        $res = fwrite($file, $binary);
        fclose($file);
        $imagepath='PISCO_API/imgupload/' . $filename;

    }







    $response = array();

    if($db->newUser($fullname, $address, $pincode, $city, $mobileno, $emailId, $password, $FRID, $role,$imagepath)){

        $response['error'] = false;

        $response['message'] = "User registered successfully";

    }else{

        $response['error'] = true;

        $response['message'] = "Could not register new User";

    }

    echoResponse(200,$response);

});



/* *METHOD TO LOGIN

     * URL: http://YOUR DOMAIN/PISCO_API/v1/User_Login

     *  URL: http://techdemos.esy.es//PISCO_API/v1/User_Login

     * @param $user_name

     * @param $password

 * Method: POST

 * */

$app->post('/User_Login',function() use ($app){

    verifyRequiredParams(array('username','password'));

    $username = $app->request->post('username');

    $password=$app->request->post('password');

    $db = new DbOperation();

    $response = array();

    $result = $db->user_login($username, $password);

//    echo $result;

//    return;

    $response = array();

    $response['error'] = false;

    $response['user_info'] = array();

    if ($result->num_rows > 0) {

        // output data of each row

        while($row = $result->fetch_assoc()) {

            $temp = array();

            $temp['user_id'] = $row['user_id'];

            $temp['fullname'] = $row['fullname'];

            $temp['address'] = $row['address'];

            $temp['pincode'] = $row['pincode'];

            $temp['city'] = $row['city'];

            $temp['mobileno'] = $row['mobileno'];

            $temp['emailId'] = $row['emailId'];

            $temp['role'] = $row['role'];
            if( $row['profile_imageurl']!="")
                $temp['profile_imageurl'] = HOST_URL .$row['profile_imageurl'];
            else
                $temp['profile_imageurl'] ="";
            array_push($response['user_info'],$temp);

            // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " User Name" . $row["username"]. "<br>" . " API Key" . $row["api_key"]. "<br>";

        }

    } else {

        $response['error'] = true;

        $response['message'] = "No data found";

        //  echo "0 results";

    }

    echoResponse(200,$response);

});



/* *METHOD TO get user profile

     * URL: http://YOUR DOMAIN/PISCO_API/v1/Get_user_info

     *  URL: http://techdemos.esy.es//PISCO_API/v1/Get_user_info

     * @param userid



 * Method: POST*/



$app->post('/Get_user_info',function() use ($app){

    verifyRequiredParams(array('userid'));

    $userid = $app->request->post('userid');

    $db = new DbOperation();
    $result = $db->user_info($userid);
    $response = array();
    $response['error'] = false;
    // $response['sqlQuery'] = $result;
    //echoResponse(200,$response);
    // return;
    $response['user_info'] = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $temp = array();
            $temp['user_id'] = $row['user_id'];
            $temp['fullname'] = $row['fullname'];
            $temp['address'] = $row['address'];
            $temp['pincode'] = $row['pincode'];
            $temp['city'] = $row['city'];
            $temp['mobileno'] = $row['mobileno'];
            $temp['emailId'] = $row['emailId'];
            $temp['role'] = $row['role'];
            if( $row['profile_imageurl']!="")
                $temp['profile_imageurl'] = HOST_URL .$row['profile_imageurl'];
            else
                $temp['profile_imageurl'] ="";
            array_push($response['user_info'],$temp);

            // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " User Name" . $row["username"]. "<br>" . " API Key" . $row["api_key"]. "<br>";

        }

    } else {
        $response['error'] = true;
        $response['message'] = "No data found";
        //  echo "0 results";
    }
    echoResponse(200,$response);

});

function echoResponse($status_code, $response)

{

    $app = \Slim\Slim::getInstance();

    $app->status($status_code);

    $app->contentType('application/json');

    echo json_encode($response);

}





function verifyRequiredParams($required_fields)

{

    $error = false;

    $error_fields = "";

    $request_params = $_REQUEST;



    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

        $app = \Slim\Slim::getInstance();

        parse_str($app->request()->getBody(), $request_params);

    }



    foreach ($required_fields as $field) {

        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {

            $error = true;

            $error_fields .= $field . ', ';

        }

    }



    if ($error) {

        $response = array();

        $app = \Slim\Slim::getInstance();

        $response["error"] = true;

        $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';

        echoResponse(400, $response);

        $app->stop();

    }

}



function authenticateStudent(\Slim\Route $route)

{

    $headers = apache_request_headers();

    $response = array();

    $app = \Slim\Slim::getInstance();



    if (isset($headers['Authorization'])) {

        $db = new DbOperation();

        $api_key = $headers['Authorization'];

        if (!$db->isValidStudent($api_key)) {

            $response["error"] = true;

            $response["message"] = "Access Denied. Invalid Api key";

            echoResponse(401, $response);

            $app->stop();

        }

    } else {

        $response["error"] = true;

        $response["message"] = "Api key is misssing";

        echoResponse(400, $response);

        $app->stop();

    }

}





function authenticateFaculty(\Slim\Route $route)

{

    $headers = apache_request_headers();

    $response = array();

    $app = \Slim\Slim::getInstance();

    if (isset($headers['Authorization'])) {

        $db = new DbOperation();

        $api_key = $headers['Authorization'];

        if (!$db->isValidFaculty($api_key)) {

            $response["error"] = true;

            $response["message"] = "Access Denied. Invalid Api key";

            echoResponse(401, $response);

            $app->stop();

        }

    } else {

        $response["error"] = true;

        $response["message"] = "Api key is misssing";

        echoResponse(400, $response);

        $app->stop();

    }

}



$app->run();