DROP TABLE IF EXISTS `sagepay_form_payments`;
CREATE TABLE IF NOT EXISTS `sagepay_form_payments` (
  `VendorTxCode` varchar(50) NOT NULL,
  `VPSTxId` varchar(38) default NULL,
  `Status` varchar(20) default NULL,
  `StatusDetail` varchar(255) default NULL,
  `TxAuthNo` bigint(20) default NULL,
  `Amount` decimal(10,2) default NULL,
  `AVSCV2` varchar(50) default NULL,
  `AddressResult` varchar(20) default NULL,
  `PostCodeResult` varchar(20) default NULL,
  `CV2Result` varchar(20) default NULL,
  `GiftAid` tinyint(1) default NULL,
  `3DSecureStatus` varchar(50) default NULL,
  `CAVV` varchar(32) default NULL,
  `AddressStatus` varchar(20) default NULL,
  `CardType` varchar(15) default NULL,
  `Last4Digits` varchar(4) default NULL,
  `PayerStatus` varchar(20) default NULL,
  `LastUpdated` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`VendorTxCode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
