<?php



class DbOperation

{

    private $con;



    function __construct()

    {

        require_once dirname(__FILE__) . '/DbConnect.php';

        $db = new DbConnect();

        $this->con = $db->connect();

    }





    /**

     * Method to add new Invoice



     */
    public function list_subCategory($category_id){
        $sqlQuery="select *,sidhus_category.cat_name from sidhus_subcategory inner join sidhus_category on sidhus_category.category_id=sidhus_subcategory.category_id where sidhus_subcategory.category_id = ". $category_id;
        //$sqlQuery= "select * from make_an_offer INNER JOIN sell_product ON sell_product.sell_id=make_an_offer.product_id where sell_product.customer_id = ". $customer_id;
        $result=$this->con->query($sqlQuery);
        $this->con->close();
        return $result;
    }
    public function list_subCategoryByName($Subcategory_Name){
        $sqlQuery="select *,sidhus_category.cat_name from sidhus_subcategory inner join sidhus_category on sidhus_category.category_id=sidhus_subcategory.category_id where sidhus_subcategory.subcat_name = '". $Subcategory_Name ."'";
        $result=$this->con->query($sqlQuery);
        $this->con->close();
        return $result;
    }

    public function list_Category(){
        $sqlQuery="select * from sidhus_category";
        //$sqlQuery= "select * from make_an_offer INNER JOIN sell_product ON sell_product.sell_id=make_an_offer.product_id where sell_product.customer_id = ". $customer_id;
        $result=$this->con->query($sqlQuery);
        $this->con->close();
        return $result;
    }
    public function list_EventType(){
        $sqlQuery="select * from sidhus_event_type";
        //$sqlQuery= "select * from make_an_offer INNER JOIN sell_product ON sell_product.sell_id=make_an_offer.product_id where sell_product.customer_id = ". $customer_id;
        $result=$this->con->query($sqlQuery);
        $this->con->close();
        return $result;
    }

    public function insert_Category($cat_name){

        $strInsertQry="INSERT INTO sidhus_category(cat_name ) "

            ." VALUES (?)";
        $stmt = $this->con->prepare($strInsertQry);
        $stmt->bind_param("s",$cat_name);
        $result = $stmt->execute();
        $stmt->close();
        if($result){
            return true;
        }
        return false;
    }

    public function delete_category($category_id){

        $strInsertQry="delete from sidhus_category where category_id = ?";



        $stmt = $this->con->prepare($strInsertQry);

        $stmt->bind_param("i",$category_id );

        $stmt->execute();

        $num_affected_rows = $stmt->affected_rows;

        $stmt->close();

        return $num_affected_rows > 0;

    }


    public function delete_Subcategory($Subcategory_id){

        $strInsertQry="delete from sidhus_subcategory where subcat_id = ?";

        $stmt = $this->con->prepare($strInsertQry);

        $stmt->bind_param("i",$Subcategory_id );

        $stmt->execute();

        $num_affected_rows = $stmt->affected_rows;

        $stmt->close();

        return $num_affected_rows > 0;

    }

    public function update_INVOICE($invoice_no,$user_id,$cust_fullname,$cust_address,$theme_name,$color_combo,$cust_mobileno,$cust_alternate_mobileno,$cust_emailId,$event_address,$event_pincode,$event_location,$event_landmark,$event_id,$subcat_id,$venue_type,$eventDate,$eventTime,$concept_type,$notes_or_Remarks,$transportation_Rate,$Tax_percentage,$Advance,$Total,$Status,$event_Details){
        $strInsertQry="update sidhus_invoice set cust_fullname='".$cust_fullname."',user_id=$user_id, cust_address='".$cust_address."', theme_name='".$theme_name."', color_combo='".$color_combo."', cust_mobileno='".$cust_mobileno."', cust_alternate_mobileno='".$cust_alternate_mobileno."', cust_emailId='".$cust_emailId."',"

            ." event_address='".$event_address."', event_pincode='".$event_pincode."', event_location='".$event_location."', event_landmark='".$event_landmark."', event_id=$event_id.,subcat_id='".$subcat_id."',venue_type='".$venue_type."',eventDate='".$eventDate."',eventTime='".$eventTime."',concept_type='".$concept_type."',notes_or_Remarks='".$notes_or_Remarks."',transportation_Rate=".$transportation_Rate.",Tax_percentage=".$Tax_percentage.",Advance=".$Advance.",Total=".$Total. ",Status='".$Status. "',event_Details='".$event_Details. "'"
        ."  where invoice_no=".$invoice_no."";
      //  $stmt = $this->con->prepare($strInsertQry);
      //  $stmt->bind_param("sssssssssssiisssssiiiii",$cust_fullname,$cust_address,$theme_name,$color_combo,$cust_mobileno,$cust_alternate_mobileno,$cust_emailId,$event_address,$event_pincode,$event_location,$event_landmark,$event_id,$subcat_id,$venue_type,$eventDate,$eventTime,$concept_type,$notes_or_Remarks,$transportation_Rate,$Tax_percentage,$Advance,$Total,$invoice_no);
//return $strInsertQry;
        $stmt = $this->con->prepare($strInsertQry);
        // $stmt->bind_param("ss", $newpassword, $username);
        $result = $stmt->execute();
        $stmt->close();
        return $result;// $num_affected_rows>=0;

    }

    public function delete_INVOICE($invoice_no,$user_id){

        $strInsertQry="delete from sidhus_invoice where invoice_no = ? and user_id= ? ";
        $stmt = $this->con->prepare($strInsertQry);

        $stmt->bind_param("ii",$invoice_no,$user_id );

        $stmt->execute();
        $num_affected_rows = $stmt->affected_rows;
        $stmt->close();
        if($num_affected_rows > 0)
            return "true";
        else
            return "false";
    }
    public function create_new_invoice($cust_fullname,$user_id,$theme_name,$color_combo,$cust_mobileno,$cust_alternate_mobileno,$cust_emailId,$event_address,$event_pincode,$event_location,$event_landmark,$event_id,$subcat_id,$venue_type,$eventDate,$eventTime,$concept_type,$notes_or_Remarks,$transportation_Rate,$Tax_percentage,$Advance,$Total,$event_Details,$name_on_board,$special_notes){

//        $strInsertQry="INSERT INTO sidhus_invoice (cust_fullname,user_id, theme_name, color_combo, cust_mobileno, cust_alternate_mobileno, cust_emailId, "
//
//            ." event_address, event_pincode, event_location, event_landmark, event_id,subcat_id,venue_type,eventDate,eventTime,concept_type,notes_or_Remarks,transportation_Rate,Tax_percentage,Advance,Total,Status,event_Details) "
//
//            ." VALUES ('".$cust_fullname."',$user_id,'".$theme_name."','".$color_combo."','".$cust_mobileno."','".$cust_alternate_mobileno."','".$cust_emailId."','".$event_address."','".$event_pincode."','".$event_location."','".$event_landmark."',$event_id,$subcat_id,'".$venue_type."','".$eventDate."','".$eventTime."','".$concept_type."','".$notes_or_Remarks."',".$transportation_Rate.",".$transportation_Rate.",$Tax_percentage,$Advance,$Total,'Upcoming Event','".$event_Details."')";

 $strInsertQry="INSERT INTO sidhus_invoice (cust_fullname,event_Details,user_id, theme_name, color_combo, cust_mobileno, cust_alternate_mobileno, cust_emailId, "

            ." event_address, event_pincode, event_location, event_landmark, event_id,subcat_id,venue_type,eventDate,eventTime,concept_type,notes_or_Remarks,transportation_Rate,Tax_percentage,Advance,Total,Status,name_on_board,special_notes) "

            ." VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $this->con->prepare($strInsertQry);
$status='Upcoming Event';
       $stmt->bind_param("ssisssssssssissssssiiiisss",$cust_fullname,$event_Details,$user_id, $theme_name,$color_combo,$cust_mobileno,$cust_alternate_mobileno,$cust_emailId,$event_address,$event_pincode,$event_location,$event_landmark,$event_id,$subcat_id,$venue_type,$eventDate,$eventTime,$concept_type,$notes_or_Remarks,$transportation_Rate,$Tax_percentage,$Advance,$Total,$status,$name_on_board,$special_notes);

        $result = $stmt->execute();
        $stmt->close();

        if($result) {

            $sql = "SELECT invoice_no FROM sidhus_invoice WHERE invoice_no = LAST_INSERT_ID()";

            $result = $this->con->query($sql);

            $this->con->close();

            if ($result->num_rows > 0)

                return $result->fetch_assoc()["invoice_no"];

            else

                return false;

        }

        else

            return false;



    }
    public function insert_product_image($INVOICE_NO,$image){

        $strInsertQry= "INSERT INTO sidhus_invoice_reference_images (INVOICE_NO,imageUrl) "
            ." VALUES (?, ?)";
        $stmt = $this->con->prepare($strInsertQry);
        $stmt->bind_param("is",$INVOICE_NO, $image);
        $result = $stmt->execute();
        $stmt->close();
        if($result){
            return true;
        }
        return false;
    }
//sidhus_invoice.eventDate >='".$dateToday."' ORDER BY sidhus_invoice.eventDate DESC


    public function update_INVOICE_Change_Status_Completed(){
        $this->update_INVOICE_Change_Status_Ongoing();
        $dateToday=date_default_timezone_set("Y-m-d");
        $strInsertQry="update sidhus_invoice set Status='Completed Events' where sidhus_invoice.eventDate < '".$dateToday."'";
        //  $stmt = $this->con->prepare($strInsertQry);
        //  $stmt->bind_param("sssssssssssiisssssiiiii",$cust_fullname,$cust_address,$theme_name,$color_combo,$cust_mobileno,$cust_alternate_mobileno,$cust_emailId,$event_address,$event_pincode,$event_location,$event_landmark,$event_id,$subcat_id,$venue_type,$eventDate,$eventTime,$concept_type,$notes_or_Remarks,$transportation_Rate,$Tax_percentage,$Advance,$Total,$invoice_no);
//return $strInsertQry;
        $stmt = $this->con->prepare($strInsertQry);
        // $stmt->bind_param("ss", $newpassword, $username);
        $result = $stmt->execute();
        $stmt->close();
        return $result;// $num_affected_rows>=0;

    }

    public function update_INVOICE_Change_Status_Ongoing(){
        $dateToday=date_default_timezone_set("Y-m-d");
        $strInsertQry="update sidhus_invoice set Status='Ongoing Events' where sidhus_invoice.eventDate ='".$dateToday."'";
        //  $stmt = $this->con->prepare($strInsertQry);
        //  $stmt->bind_param("ssssssssssiisssssiiiii",$cust_fullname,$theme_name,$color_combo,$cust_mobileno,$cust_alternate_mobileno,$cust_emailId,$event_address,$event_pincode,$event_location,$event_landmark,$event_id,$subcat_id,$venue_type,$eventDate,$eventTime,$concept_type,$notes_or_Remarks,$transportation_Rate,$Tax_percentage,$Advance,$Total,$invoice_no);
//return $strInsertQry;
        $stmt = $this->con->prepare($strInsertQry);
        // $stmt->bind_param("ss", $newpassword, $username);
        $result = $stmt->execute();
        $stmt->close();
        return $result;// $num_affected_rows>=0;

    }

  /*   public function list_Invoices($Invoice_no,$eventDate,$user_id){
        $this->update_INVOICE_Change_Status_Completed();

        $dateToday=date_default_timezone_set("Y-m-d");
        if(($Invoice_no!="")&&($eventDate!="")&&($user_id!="")){

            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name,sidhus_subcategory.subcat_name,sidhus_category.cat_name FROM sidhus_invoice INNER join sidhus_subcategory on sidhus_subcategory.subcat_id=sidhus_invoice.subcat_id 
                     INNER JOIN sidhus_category ON sidhus_subcategory.category_id=sidhus_category.category_id
                   INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
                 INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id where sidhus_invoice.eventDate='".$eventDate."' and sidhus_invoice.INVOICE_NO=$Invoice_no and Sidhus_Login_credentials.user_id=$user_id and sidhus_invoice.eventDate >='".$dateToday."'
                 ORDER BY sidhus_invoice.eventDate ASC ";

        }
        else if(($Invoice_no!="")&&($eventDate!="")){
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name,sidhus_subcategory.subcat_name,sidhus_category.cat_name FROM sidhus_invoice INNER join sidhus_subcategory on sidhus_subcategory.subcat_id=sidhus_invoice.subcat_id 
INNER JOIN sidhus_category ON sidhus_subcategory.category_id=sidhus_category.category_id
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id where sidhus_invoice.eventDate='".$eventDate."' and sidhus_invoice.INVOICE_NO=$Invoice_no and sidhus_invoice.eventDate >='".$dateToday."'
       ORDER BY sidhus_invoice.eventDate ASC ";
         }
        else if(($Invoice_no!="")&&($user_id!="")){
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name,sidhus_subcategory.subcat_name,sidhus_category.cat_name FROM sidhus_invoice INNER join sidhus_subcategory on sidhus_subcategory.subcat_id=sidhus_invoice.subcat_id 
INNER JOIN sidhus_category ON sidhus_subcategory.category_id=sidhus_category.category_id
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id where   sidhus_invoice.INVOICE_NO=$Invoice_no and Sidhus_Login_credentials.user_id=$user_id and sidhus_invoice.eventDate >='".$dateToday."'
 ORDER BY sidhus_invoice.eventDate ASC";
        }
        else if(($eventDate!="")&&($user_id!="")){
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name,sidhus_subcategory.subcat_name,sidhus_category.cat_name FROM sidhus_invoice INNER join sidhus_subcategory on sidhus_subcategory.subcat_id=sidhus_invoice.subcat_id 
INNER JOIN sidhus_category ON sidhus_subcategory.category_id=sidhus_category.category_id
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id where sidhus_invoice.eventDate='".$eventDate."' and Sidhus_Login_credentials.user_id=$user_id ORDER BY sidhus_invoice.eventDate ASC";

        }
        else if(($user_id!="")){
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name,sidhus_subcategory.subcat_name,sidhus_category.cat_name FROM sidhus_invoice INNER join sidhus_subcategory on sidhus_subcategory.subcat_id=sidhus_invoice.subcat_id 
INNER JOIN sidhus_category ON sidhus_subcategory.category_id=sidhus_category.category_id
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id where   Sidhus_Login_credentials.user_id=$user_id and sidhus_invoice.eventDate >='".$dateToday."' ORDER BY sidhus_invoice.eventDate ASC";

        }
        else if(($Invoice_no!="")){
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name,sidhus_subcategory.subcat_name,sidhus_category.cat_name FROM sidhus_invoice INNER join sidhus_subcategory on sidhus_subcategory.subcat_id=sidhus_invoice.subcat_id 
INNER JOIN sidhus_category ON sidhus_subcategory.category_id=sidhus_category.category_id
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id where   sidhus_invoice.INVOICE_NO=$Invoice_no and sidhus_invoice.eventDate >='".$dateToday."' ORDER BY sidhus_invoice.eventDate ASC";

        }
        else if(($eventDate!="")){
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name,sidhus_subcategory.subcat_name,sidhus_category.cat_name FROM sidhus_invoice INNER join sidhus_subcategory on sidhus_subcategory.subcat_id=sidhus_invoice.subcat_id 
INNER JOIN sidhus_category ON sidhus_subcategory.category_id=sidhus_category.category_id
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id where sidhus_invoice.eventDate='".$eventDate."'  ORDER BY sidhus_invoice.eventDate ASC";

        }
        else{
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name,sidhus_subcategory.subcat_name,sidhus_category.cat_name FROM sidhus_invoice INNER join sidhus_subcategory on sidhus_subcategory.subcat_id=sidhus_invoice.subcat_id 
INNER JOIN sidhus_category ON sidhus_subcategory.category_id=sidhus_category.category_id
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id where  sidhus_invoice.eventDate >= '".$dateToday."' ORDER BY sidhus_invoice.eventDate ASC";

        }


        //$sqlQuery= "select * from make_an_offer INNER JOIN sell_product ON sell_product.sell_id=make_an_offer.product_id where sell_product.customer_id = ". $customer_id;

        $result=$this->con->query($sqlQuery);
        $this->con->close();
       //  return $sqlQuery;
        return $result;
    }

 */   

  public function list_Invoices($Invoice_no,$eventDate,$user_id){
        $this->update_INVOICE_Change_Status_Completed();
 $sqlQuery="";
        $dateToday=date("Y-m-d");
        if(($Invoice_no!="")&&($eventDate!="")&&($user_id!="")){

            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name FROM sidhus_invoice 
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id   where sidhus_invoice.eventDate='".$eventDate."' and sidhus_invoice.INVOICE_NO=$Invoice_no and Sidhus_Login_credentials.user_id=$user_id and sidhus_invoice.eventDate >='".$dateToday."'
                 ORDER BY sidhus_invoice.eventDate ASC ";

        }
        else if(($Invoice_no!="")&&($eventDate!="")){
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name FROM sidhus_invoice 
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id   where sidhus_invoice.eventDate='".$eventDate."' and sidhus_invoice.INVOICE_NO=$Invoice_no and sidhus_invoice.eventDate >='".$dateToday."'
       ORDER BY sidhus_invoice.eventDate ASC ";
         }
        else if(($Invoice_no!="")&&($user_id!="")){
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name FROM sidhus_invoice 
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id   where   sidhus_invoice.INVOICE_NO=$Invoice_no and Sidhus_Login_credentials.user_id=$user_id and sidhus_invoice.eventDate >='".$dateToday."'
 ORDER BY sidhus_invoice.eventDate ASC";
        }
        else if(($eventDate!="")&&($user_id!="")){
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name FROM sidhus_invoice 
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id  where sidhus_invoice.eventDate='".$eventDate."' and Sidhus_Login_credentials.user_id=$user_id ORDER BY sidhus_invoice.eventDate ASC";

        }
        else if(($user_id!="")){
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name FROM sidhus_invoice 
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id  where   Sidhus_Login_credentials.user_id=$user_id and sidhus_invoice.eventDate >='".$dateToday."' ORDER BY sidhus_invoice.eventDate ASC";

        }
        else if(($Invoice_no!="")){
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name FROM sidhus_invoice 
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id  where   sidhus_invoice.INVOICE_NO=$Invoice_no and sidhus_invoice.eventDate >='".$dateToday."' ORDER BY sidhus_invoice.eventDate ASC";

        }
        else if(($eventDate!="")){
			if(is_numeric($eventDate)){
				  $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name FROM sidhus_invoice 
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id where (sidhus_invoice.INVOICE_NO=$eventDate)  and sidhus_invoice.eventDate >='".$dateToday."'  ORDER BY sidhus_invoice.eventDate ASC";

			}
			else{
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name FROM sidhus_invoice 
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id  where  ((sidhus_invoice.cust_fullname like '".$eventDate."%') or (sidhus_invoice.eventDate='".$eventDate."'))  and (sidhus_invoice.eventDate >='".$dateToday."')  ORDER BY sidhus_invoice.eventDate ASC";
			}
   }
        else{
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name FROM sidhus_invoice 
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id  where  sidhus_invoice.eventDate >= '".$dateToday."' ORDER BY sidhus_invoice.eventDate ASC";

        }


        //$sqlQuery= "select * from make_an_offer INNER JOIN sell_product ON sell_product.sell_id=make_an_offer.product_id where sell_product.customer_id = ". $customer_id;

        $result=$this->con->query($sqlQuery);
        $this->con->close();
        // return $sqlQuery;
       return $result;
    }


 public function list_Invoices_completed($Invoice_no,$eventDate,$user_id){

        $this->update_INVOICE_Change_Status_Completed();

        $dateToday=date("Y-m-d");
        if(($Invoice_no!="")&&($eventDate!="")&&($user_id!="")){

            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name FROM sidhus_invoice 
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id where sidhus_invoice.eventDate  =  '".$eventDate."' and sidhus_invoice.INVOICE_NO=$Invoice_no and Sidhus_Login_credentials.user_id=$user_id and sidhus_invoice.eventDate < '".$dateToday."'
                 ORDER BY sidhus_invoice.eventDate DESC ";
        }
        else if(($Invoice_no!="")&&($eventDate!="")){
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name FROM sidhus_invoice 
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id where sidhus_invoice.eventDate  =  '".$eventDate."' and sidhus_invoice.INVOICE_NO=$Invoice_no and sidhus_invoice.eventDate < '".$dateToday."'
       ORDER BY sidhus_invoice.eventDate DESC ";
        }
        else if(($Invoice_no!="")&&($user_id!="")){
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name FROM sidhus_invoice 
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id where   sidhus_invoice.INVOICE_NO = $Invoice_no and Sidhus_Login_credentials.user_id=$user_id and sidhus_invoice.eventDate < '".$dateToday."'
 ORDER BY sidhus_invoice.eventDate DESC";
        }
        else if(($eventDate!="")&&($user_id!="")){
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name FROM sidhus_invoice 
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id where sidhus_invoice.eventDate = '".$eventDate."' and Sidhus_Login_credentials.user_id=$user_id ORDER BY sidhus_invoice.eventDate DESC";

        }
        else if(($user_id!="")){
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name FROM sidhus_invoice 
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id where   Sidhus_Login_credentials.user_id = $user_id and sidhus_invoice.eventDate < '".$dateToday."' ORDER BY sidhus_invoice.eventDate DESC";

        }
        else if($Invoice_no!=""){
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name FROM sidhus_invoice 
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id where   sidhus_invoice.INVOICE_NO = $Invoice_no and sidhus_invoice.eventDate < '".$dateToday."' ORDER BY sidhus_invoice.eventDate DESC";

        }
        else if(($eventDate!="")){
			if(is_numeric($eventDate)){
				  $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name FROM sidhus_invoice 
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id where (sidhus_invoice.INVOICE_NO=$eventDate)  and sidhus_invoice.eventDate < '".$dateToday."'  ORDER BY sidhus_invoice.eventDate ASC";

			}
			else{
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name FROM sidhus_invoice 
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id where  ((sidhus_invoice.cust_fullname like '".$eventDate."%') or (sidhus_invoice.eventDate='".$eventDate."'))  and (sidhus_invoice.eventDate < '".$dateToday."')  ORDER BY sidhus_invoice.eventDate ASC";
			}
			 
        }
        else{
            $sqlQuery="SELECT sidhus_invoice.*,Sidhus_Login_credentials.fullname as uploadedUser,sidhus_event_type.event_name FROM sidhus_invoice 
INNER JOIN Sidhus_Login_credentials ON Sidhus_Login_credentials.user_id=sidhus_invoice.user_id
INNER JOIN sidhus_event_type on sidhus_event_type.event_id=sidhus_invoice.event_id where  sidhus_invoice.eventDate < '".$dateToday."' ORDER BY sidhus_invoice.eventDate DESC";

        }


        //$sqlQuery= "select * from make_an_offer INNER JOIN sell_product ON sell_product.sell_id=make_an_offer.product_id where sell_product.customer_id = ". $customer_id;

        $result=$this->con->query($sqlQuery);
        $this->con->close();
//          return $sqlQuery;
        return $result;
    }

     public function list_Invoices_Images($Invoice_no){
            $sqlQuery="select * from sidhus_invoice_reference_images where sidhus_invoice_reference_images.INVOICE_NO = ". $Invoice_no;
        //$sqlQuery= "select * from make_an_offer INNER JOIN sell_product ON sell_product.sell_id=make_an_offer.product_id where sell_product.customer_id = ". $customer_id;
        $result=$this->con->query($sqlQuery);
        $this->con->close();
        return $result;
    }





    /**

     * @param $fullname

     * @param $address

     * @param $pincode

     * @param $city

     * @param $mobileno

     * @param $emailId

     * @param $password

     * @param $FRID

     * @param $role

     * @return bool

     */

    public function newUser($fullname, $address, $pincode, $city, $mobileno, $emailId, $password, $FRID, $role,$imagepath){

        $strInsertQry="INSERT INTO Sidhus_Login_credentials(fullname, address, pincode, city, mobileno, emailId, password, "
            ." FRID, role,profile_imageurl) "
            ." VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)";

        $stmt = $this->con->prepare($strInsertQry);

        $stmt->bind_param("ssssssssss",$fullname, $address, $pincode, $city, $mobileno, $emailId, $password, $FRID, $role,$imagepath);

        $result = $stmt->execute();

        $stmt->close();

        if($result){

            return true;

        }

        return false;

    }

    public function randString($length, $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')

    {

        $str = '';

        $count = strlen($charset);

        while ($length--) {

            $str .= $charset[mt_rand(0, $count-1)];

        }

        return $str;

    }






    //Method to USER Login

    public function user_login($username,$password){
    $sqlQuery= "select * from Sidhus_Login_credentials where (mobileno='".$username."' or emailId ='".$username."') and (password='".$password."')";
    $result=$this->con->query($sqlQuery);
    $this->con->close();
    return $result;
    }

    //Method to Get USER info

    public function user_info($userid){

        $sqlQuery= "select * from Sidhus_Login_credentials where (user_id=$userid)";

        $result=$this->con->query($sqlQuery);

        $this->con->close();

        
        return $result;

    }






    //Checking the student is valid or not by api key




    //Method to generate a unique api key every time

    private function generateApiKey(){

        return md5(uniqid(rand(), true));

    }

}