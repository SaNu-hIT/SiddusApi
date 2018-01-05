
CREATE TABLE IF NOT EXISTS `Sidhus_Login_credentials` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pincode` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `mobileno` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `emailId` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `FRID` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `mobileno` (`mobileno`),
  UNIQUE KEY `emailId` (`emailId`)
);

 CREATE TABLE IF NOT EXISTS sidhus_event_Type (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(50) NOT NULL,
  PRIMARY KEY (`cat_id`)
);
CREATE TABLE IF NOT EXISTS sidhus_category (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) NOT NULL,
  PRIMARY KEY (`cat_id`)
);
CREATE TABLE IF NOT EXISTS sidhus_subcategory (
  `subcat_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) NOT NULL,
  `subcat_name` varchar(50) NOT NULL,
  PRIMARY KEY (`subcat_id`)
);

create table if not exists sidhus_invoice_reference_images(
 `ImageId` int(11) NOT NULL AUTO_INCREMENT,
 `INVOICE_NO` int(11) NOT NULL,
 `imageUrl` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
 PRIMARY KEY (`ImageId`)
);

create table if not exists sidhus_invoice(
   `INVOICE_NO` int(11) NOT NULL AUTO_INCREMENT,
   `cust_fullname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
   `user_id` bigint(20) NOT NULL,
  `cust_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cust_pincode` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `cust_city` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cust_mobileno` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cust_alternate_mobileno` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cust_emailId` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `event_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `event_pincode` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `event_location` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `event_landmark` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `event_id` int(11) NOT NULL ,
  `subcat_id` varchar(100) NOT NULL,
   venue_type varchar(30) not null,
   eventDate date not null,
   eventTime varchar(30) not null,
   concept_type varchar(30) not null,
   notes_or_Remarks varchar(80) not null,
   transportation_Rate varchar(20) not null,
   Tax_percentage decimal(10,2) not null,
   Advance decimal(10,2) not null,
   Total decimal(10,2) not null,
   Status varchar(30) not null default 'Upcoming Event',
   event_Details varchar(720) not null default,
   PRIMARY KEY (`INVOICE_NO`)
);

