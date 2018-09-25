-- MySQL dump 10.13  Distrib 5.7.23, for Linux (x86_64)
--
-- Host: localhost    Database: db_base_symfony
-- ------------------------------------------------------
-- Server version	5.7.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tblAccount`
--

DROP TABLE IF EXISTS `tblAccount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblAccount` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `removedRecord` tinyint(1) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblAccount`
--

LOCK TABLES `tblAccount` WRITE;
/*!40000 ALTER TABLE `tblAccount` DISABLE KEYS */;
INSERT INTO `tblAccount` VALUES ('29349283428374','Louis Nguyen','nguyenvuluan89@gmail.com','luannguyen','25f9e794323b453885f5181f1b624d0b',1,0,'2018-12-31 23:59:59','2018-12-31 23:59:59');
/*!40000 ALTER TABLE `tblAccount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblBanner`
--

DROP TABLE IF EXISTS `tblBanner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblBanner` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `active` tinyint(1) NOT NULL,
  `removedRecord` tinyint(1) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblBanner`
--

LOCK TABLES `tblBanner` WRITE;
/*!40000 ALTER TABLE `tblBanner` DISABLE KEYS */;
INSERT INTO `tblBanner` VALUES ('c002b758a3073044a346ea509f6397e8','Sample Banner','45b13bbe02f3a840eb041413dd794f25.jpeg','<p><br></p>',1,0,'2018-09-16 20:47:11','2018-09-16 20:47:11');
/*!40000 ALTER TABLE `tblBanner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblCategory`
--

DROP TABLE IF EXISTS `tblCategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblCategory` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parentId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seoTitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seoDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seoKeyword` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `removedRecord` tinyint(1) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblCategory`
--

LOCK TABLES `tblCategory` WRITE;
/*!40000 ALTER TABLE `tblCategory` DISABLE KEYS */;
INSERT INTO `tblCategory` VALUES ('91a1ef3e63e969f6e4a5e96a8bd387b4','Máy uốn tóc','may-uon-toc','0','','','',1,0,'2018-09-16 21:08:14','2018-09-16 21:08:14'),('9e30a9b322998c071bb7fa227e0fa045','Kéo','keo','0','','','',1,0,'2018-09-16 20:59:39','2018-09-16 20:59:39'),('e774a965c2be672a8cb1cd163c198597','Máy duỗi tóc','may-duoi-toc','0','','','',1,0,'2018-09-16 21:07:28','2018-09-16 21:07:28'),('f8be50f54fa95900e69685809d8eacce','Tông Đơ','tong-do','0','','','',1,0,'2018-09-16 20:58:59','2018-09-16 20:58:59');
/*!40000 ALTER TABLE `tblCategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblProduct`
--

DROP TABLE IF EXISTS `tblProduct`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblProduct` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mainImage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subImages` longtext COLLATE utf8_unicode_ci,
  `description` longtext COLLATE utf8_unicode_ci,
  `price` double NOT NULL,
  `salePrice` double NOT NULL,
  `categoryId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seoTitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seoDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seoKeyword` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `removedRecord` tinyint(1) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblProduct`
--

LOCK TABLES `tblProduct` WRITE;
/*!40000 ALTER TABLE `tblProduct` DISABLE KEYS */;
INSERT INTO `tblProduct` VALUES ('3504602fbf001da3ff309afe409558dd','Máy uốn Tóc shinon mini bỏ túi BB9899','may-uon-toc-shinon-mini-bo-tui-bb9899','56b91571346b4dc9989f0f090ebafe07.png','','<div id=\"policy-shortdesc\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><p style=\"margin-bottom: 10px;\">Máy uốn tóc mini bỏ túi thiết kế nhỏ gọn, chất liệu cao cấp tráng lớp ceramic tránh làm hư tổn tóc, bảo vệ tóc tối đa, thân máy uốn tóc được thiết kế nút ON/OFF, dây xoay 360 độ&nbsp;thuận tiện khi sử dụng. Máy uốn tóc shinon mini giá rẻ thích hợp mang theo khi đi công tác, du lịch, di chuyển xa.&nbsp;</p></div><div id=\"policy-warranty\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><span class=\"glyphicon glyphicon-certificate\" style=\"line-height: 1; color: rgb(242, 120, 75); margin-right: 5px;\"></span>Bảo hành 1 đổi 1</div><div id=\"policy-warranty-time\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><span style=\"font-weight: 700;\">Thời hạn bảo hành:&nbsp;</span>3 tháng</div><div id=\"policy-note\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\">Bảo hành bằng hóa đơn mua hàng</div>',125000,125000,'91a1ef3e63e969f6e4a5e96a8bd387b4','','','',1,0,'2018-09-17 23:27:21','2018-09-17 23:27:21'),('51d75e50c5c214f40cf6d42426fe6556','Máy uốn tóc mini giá rẻ ZF 2002','may-uon-toc-mini-gia-re-zf-2002','9ce5d84ef034a1a8946792a6b73a44d7.png','','<div id=\"policy-shortdesc\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><p style=\"margin-bottom: 10px;\">Bạn muốn thay đổi kiểu tóc khi tham dự party, liên hoan, sinh nhật bằng kiểu tóc bồng bềnh lãng mạn hay xoăn búp lọn dễ thương.<span style=\"font-weight: 700;\">Máy uốn tóc mini ZF 2002,&nbsp;<a href=\"http://www.nhanhmua.vn/deal/may-uon-toc-mini-zf-2002-professional/1038\" target=\"_blank\" style=\"color: rgb(68, 108, 179);\">&nbsp;</a>c</span>ho mái tóc luôn bóng đẹp, tạo nhiều kiểu mới theo kịp xu hướng thời trang và vẻ đẹp rạng ngời, kiêu sa và nữ tính nhất với khoảng thời gian ngắn nhất.</p></div><div id=\"policy-warranty\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><span class=\"glyphicon glyphicon-certificate\" style=\"line-height: 1; color: rgb(242, 120, 75); margin-right: 5px;\"></span>Bảo hành 1 đổi 1</div><div id=\"policy-warranty-time\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><span style=\"font-weight: 700;\">Thời hạn bảo hành:&nbsp;</span>1 tháng</div><div id=\"policy-note\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\">Bảo hành bằng tem trên sản phẩm</div>',90000,69000,'91a1ef3e63e969f6e4a5e96a8bd387b4','','','',1,0,'2018-09-17 23:24:36','2018-09-17 23:24:36'),('58675c63b0fa6add2d76185bd4140e31','Máy duỗi tóc Shinon SH-8009 Lcd 5 mức điều chỉnh nhiệt độ','may-duoi-toc-shinon-sh-8009-lcd-5-muc-dieu-chinh-nhiet-do','12a57730a38bffb96ebaae334701e24e.png','','<div id=\"policy-shortdesc\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><p style=\"margin-bottom: 10px;\">Máy duỗi thẳng&nbsp;tóc Shinon SH-8009 LCD có 5 mức điều chỉnh nhiệt độ phù hợp với từng loại tóc với màn hình LED hiển thị nhiệt độ thông minh, mặt trên của máy ép tóc Shinon được trang bị chuỗi đèn LED màu đẹp mắt. Máy duỗi tóc Shinon SH-8009 thiết kế chỉ với 1 nút ON/OF, sử dụng nhanh chóng chỉ cần nhấn và giữ khoảng 2s để bật/tắt nguồn máy, chất liệu gốm ceremic ở bề mặt tiếp xúc và gờ giới hạn để truyền nhiệt, chống dính giúp bảo vệ tóc tránh hư tổn.&nbsp;</p></div><div id=\"policy-warranty\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><span class=\"glyphicon glyphicon-certificate\" style=\"line-height: 1; color: rgb(242, 120, 75); margin-right: 5px;\"></span>Bảo hành 1 đổi 1</div><div id=\"policy-warranty-time\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><span style=\"font-weight: 700;\">Thời hạn bảo hành:&nbsp;</span>3 tháng</div><div id=\"policy-note\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\">Bảo hành bằng hóa đơn mua hàng</div>',255000,255000,'e774a965c2be672a8cb1cd163c198597','','','',1,0,'2018-09-17 23:30:25','2018-09-17 23:30:25'),('7192374ae6d1844ce7bd1969c4fd698d','Tông đơ có dây cao cấp DSP 90037 chuyên cho Salon Ver 2018','tong-do-co-day-cao-cap-dsp-90037-chuyen-cho-salon-ver-2018','df94b1782f4f0e5aa7e6eb2dba64f95f.png','','<p><span style=\"font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif; font-size: 13px;\">Tông đơ điện có dây cao cấp DSP 90037 với thiết kế hiện đại và tinh tế được làm bằng khung kim loại, lưỡi của thiết bị được làm bằng cacbon mạ titan không thẻ gỉ. Máy cầm đầm tay cực kỳ&nbsp;êm với công suất thực 12W. Đi kèm theo thiết bị có nhiều cữ ủi từ 1 đến 4 mm ngoài ra shop còn hỗ trợ tặng kèm thêm 1 lược và 1 kéo để cắt.</span><br></p>',550000,495000,'f8be50f54fa95900e69685809d8eacce','','','',1,0,'2018-09-17 23:03:50','2018-09-17 23:03:50'),('7316b7db9e07e06832cc14ed235b4a17','Bộ kéo cắt tóc và cắt tỉa xanh chuyên nghiệp M755','bo-keo-cat-toc-va-cat-tia-xanh-chuyen-nghiep-m755','f818c21c4b9a49aa2a392d788897c1c8.png','','<div id=\"policy-warranty\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><span class=\"glyphicon glyphicon-certificate\" style=\"line-height: 1; color: rgb(242, 120, 75); margin-right: 5px;\"></span>Bảo hành 1 đổi 1</div><div id=\"policy-warranty-time\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><span style=\"font-weight: 700;\">Thời hạn bảo hành:&nbsp;</span>12 tháng</div><div id=\"policy-note\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\">Bảo hành bằng hóa đơn bán hàng</div>',325000,199000,'9e30a9b322998c071bb7fa227e0fa045','','','',1,0,'2018-09-17 23:19:01','2018-09-17 23:19:01'),('80467b1fdb77a2e0d61bb993ad2f5a3d','Bộ 2 kéo cắt tỉa thép không gỉ (Gọng vàng) M79','bo-2-keo-cat-tia-thep-khong-gi-gong-vang-m79','6ffecdb744894dcf06a09267ba8d6e82.png','','<p><em style=\"font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif; font-size: 13px;\">Sản phẩm không bảo hành</em><br></p>',199000,199000,'9e30a9b322998c071bb7fa227e0fa045','','','',1,0,'2018-09-17 23:22:49','2018-09-17 23:22:49'),('8dffeac1efd01cc07079363802ecd1b8','Máy kẹp duỗi thẳng tóc Kemei KM-328','may-kep-duoi-thang-toc-kemei-km-328','f1b016178e410e0974da44922a5d6c47.png','','<div id=\"policy-shortdesc\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><p style=\"margin-bottom: 10px;\">Máy duỗi tóc, máy kẹp thẳng tóc Kemei 328 thiết kế nhỏ gọn, màu sắc bắt mắt với chất liệu vỏ ngoài bằng nhưa, bản kẹp tóc bằng sứ phủ ceramic cao cấp an toàn cho tóc, lượng tỏa nhiệt nhanh, đều tạo kiểu tóc thẳng đẹp. Với máy kẹp tóc mini Kemei 328 bỏ túi giúp bạn gái nhanh chóng tạo ra nhiều&nbsp;kiểu tóc đẹp ở nhà hay đi du lịch xa.</p></div><div id=\"policy-warranty\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><span class=\"glyphicon glyphicon-certificate\" style=\"line-height: 1; color: rgb(242, 120, 75); margin-right: 5px;\"></span>Bảo hành 1 đổi 1</div><div id=\"policy-warranty-time\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><span style=\"font-weight: 700;\">Thời hạn bảo hành:&nbsp;</span>3 tháng</div><div id=\"policy-note\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\">Bảo hành bằng hóa đơn mua hàng</div>',119000,119000,'e774a965c2be672a8cb1cd163c198597','','','',1,0,'2018-09-17 23:29:24','2018-09-17 23:29:24'),('9f9213c28430d156ec9e175a9b9e4593','Bộ kéo cắt tỉa cao cấp Nhật Bản Kasho VQA1','bo-keo-cat-tia-cao-cap-nhat-ban-kasho-vqa1','68efffd6f741d2b356303f1ee31c34d8.png','','<div id=\"policy-warranty\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><span class=\"glyphicon glyphicon-certificate\" style=\"line-height: 1; color: rgb(242, 120, 75); margin-right: 5px;\"></span>Bảo hành 1 đổi 1</div><div id=\"policy-warranty-time\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><span style=\"font-weight: 700;\">Thời hạn bảo hành:&nbsp;</span>12 tháng</div><div id=\"policy-note\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\">Bảo hành bằng hóa đơn bán hàng</div>',750000,579000,'9e30a9b322998c071bb7fa227e0fa045','','','',1,0,'2018-09-17 23:21:31','2018-09-17 23:21:31'),('abe0afb0e0f22e6ad7cf4c43ceca0732','Tông đơ cắt tóc Codos T6 Hàn Quốc','tong-do-cat-toc-codos-t6-han-quoc','bc6f33d8e0a521b5e14f3bf38bd77229.jpeg','','<p><span style=\"font-weight: 700; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif; font-size: 13px;\">Tông đơ cắt tóc Codos T6</span><span style=\"font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif; font-size: 13px;\">&nbsp;có thiết kế nhỏ gọn , sử dụng pin sạc tiện lợi và có đèn LED hiện thị thông báo tình trạng đang sử dụng hoặc pin sạc. Đây là một trong những&nbsp;</span><span style=\"font-weight: 700; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif; font-size: 13px;\">tông đơ cao cấp giá rẻ</span><span style=\"font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif; font-size: 13px;\">&nbsp;được sử dụng khá nhiều tại các tiệm cắt tóc hay sử dụng cắt tóc trong gia đình an toàn, nhanh chóng với máy chạy êm ái, không làm tổn hại đến da đầu.</span><br></p>',590000,590000,'f8be50f54fa95900e69685809d8eacce','','','',1,0,'2018-09-17 23:01:57','2018-09-17 23:01:57'),('b2eb1083344354e0f48232d4c8b9df93','Máy Uốn Tóc Xoắn Ốc Shinon BB8972','may-uon-toc-xoan-oc-shinon-bb8972','af38bc6a853c1c5d6ca818fa076b10a7.png','','<div id=\"policy-shortdesc\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><p style=\"margin-bottom: 10px;\">Máy uốn tóc Shinon BB8972 với thiết kế dạng xoắn ốc giúp tạo nhiều kiểu tóc đẹp, bồng bềnh nhanh chóng ngay tại nhà, làm từ chất liệu cao cấp máy nóng nhanh tạo kiểu tóc nhanh và giữ nếp lâu, đầu xoắn cách nhiệt, tránh bỏng khi chạm vào máy làm tóc. Đặc biệt máy uốn tóc mini bỏ túi được tráng lớp ceramic giúp bảo vệ tối đa cho tóc tránh những hư tổn do nhiệt độ tỏa lên tóc, an toàn cho tóc khi sử dụng.</p></div><div id=\"policy-warranty\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><span class=\"glyphicon glyphicon-certificate\" style=\"line-height: 1; color: rgb(242, 120, 75); margin-right: 5px;\"></span>Bảo hành 1 đổi 1</div><div id=\"policy-warranty-time\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><span style=\"font-weight: 700;\">Thời hạn bảo hành:&nbsp;</span>3 tháng</div><div id=\"policy-note\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\">Bảo hành bằng hóa đơn mua hàng</div>',195000,195000,'91a1ef3e63e969f6e4a5e96a8bd387b4','','','',1,0,'2018-09-17 23:28:07','2018-09-17 23:28:07'),('bd1e1791713b87d1bd3a0c2ef9b7da64','Tông đơ Hàn Quốc cao cấp Codos 918','tong-do-han-quoc-cao-cap-codos-918','1cb16de366b5fb29fe7cba9376601a02.png','','<p><span style=\"font-family: Arial, Helvetica, \"Helvetica Neue\", sans-serif; font-size: 13px;\">Tông đơ cắt tóc không dây cao cấp của Hàn Quốc thương hiệu Codos 918, thiết kế cao cấp cầm siêu đầm tay dung lượng pin của thiết bị lên đến 2200 Mah cho thời gian sử dụng liên tục lên đến 5 tiếng đồng hồ. Trên thiết bị tích hợp màn hình LCD hiển thị nhiều thông số chức năng của thiết bị như tốc độ, dung lượng pin.</span><br></p>',1250000,895,'f8be50f54fa95900e69685809d8eacce','','','',1,0,'2018-09-17 23:05:49','2018-09-17 23:05:49'),('c047e05432a8a3f64f7946ee91ff40be','Tông đơ cắt tóc Philip QC-2018','tong-do-cat-toc-philip-qc-2018','d14eedfaf8a5470cc83b3689104eaad9.jpeg','','<p><span style=\"font-weight: 700; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif; font-size: 13px;\">Tông đơ cắt tóc Philips QC-2018</span><span style=\"font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif; font-size: 13px;\">&nbsp;với thiết kế đẹp mắt, sang trọng.Tông đơ cắt tóc &nbsp;sạc điện Philips với lưỡi răng bằng thép không gỉ có lược căn độ dài tóc, vận hành êm ái kết hợp cùng thiết kế chuyên nghiệp sẽ giúp bạn dễ dàng thực hiện việc cắt tóc cho người thân một cách nhanh chóng, dễ dàng ngay tại nhà, vừa an toàn, tiết kiệm lại không mất nhiều thời gian.&nbsp;</span><br></p>',245000,245000,'f8be50f54fa95900e69685809d8eacce','','','',1,0,'2018-09-17 22:58:42','2018-09-17 22:58:42'),('d83fd05b02079759dc07d28d18860b31','Lược điện uốn duỗi đa năng RM-066','luoc-dien-uon-duoi-da-nang-rm-066','9386e06e440102b6a2c5759a79d3570a.png','','<div id=\"policy-shortdesc\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><p style=\"margin-bottom: 10px;\">Lược điện uốn duỗi mini RM-066 thiết kế nhỏ gọn, vừa tay cầm, thao tác dễ dàng giúp bạn tạo được nhiều kiểu tóc đẹp như mong muốn. Lược điện làm tóc đa năng mini RM-066 thích hợp để sử dụng ở các tiệm làm tóc, salon tóc hay tạo kiểu tóc ngay tại nhà một cách nhanh chóng.&nbsp;</p></div><div id=\"policy-warranty\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><span class=\"glyphicon glyphicon-certificate\" style=\"line-height: 1; color: rgb(242, 120, 75); margin-right: 5px;\"></span>Bảo hành 1 đổi 1</div><div id=\"policy-warranty-time\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><span style=\"font-weight: 700;\">Thời hạn bảo hành:&nbsp;</span>3 tháng</div><div id=\"policy-note\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\">Bảo hành bằng hóa đơn mua hàng</div>',139000,139000,'e774a965c2be672a8cb1cd163c198597','','','',1,0,'2018-09-17 23:31:16','2018-09-17 23:31:16'),('ed6fb0f7631097129b6da40fe95212be','Tăng Đơ Đa Năng 3 in 1 Kemei KM1120','tang-do-da-nang-3-in-1-kemei-km1120','8a109305e030ce9e4a5cd03de3d9466c.png','','<div id=\"policy-shortdesc\" style=\"font-size: 13px; margin-bottom: 5px; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif;\"><p style=\"margin-bottom: 10px;\"><span style=\"font-weight: 700;\">Kemei KM1120&nbsp;</span>3 in 1<span style=\"font-weight: 700;\">&nbsp;</span>là<span style=\"font-weight: 700;\">&nbsp;máy cạo râu đa năng&nbsp;</span>kiêm&nbsp;<span style=\"font-weight: 700;\">tông đơ cắt tóc</span>và máy tỉa lông mũi. Kemei&nbsp;<span style=\"font-weight: 700;\">KM1120</span>&nbsp;3 in 1 với kiểu dáng sang trọng, lịch lãm cùng thiết kế chuyên dụng dễ dàng sử dụng. Bộ sản phẩm còn kèm chổi vệ sinh giúp bạn vệ sinh sản phẩm dễ dàng hơn.</p></div>',165000,165000,'f8be50f54fa95900e69685809d8eacce','','','',1,0,'2018-09-17 23:10:54','2018-09-17 23:10:54'),('feaa4cd433af6084b5ac5766a494d1c8','Bộ Tông Đơ Cắt Tóc Jichen 0817 Tặng kèm 2 kéo cắt kéo tỉa','bo-tong-do-cat-toc-jichen-0817-tang-kem-2-keo-cat-keo-tia','c2c61a39822bf863687c8927ad8a6a6f.png','','<p><span style=\"font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif; font-size: 13px;\">Bộ Tông Đơ Cắt Tóc Jichen 0817 Tặng kèm 2 kéo cắt kéo tỉa với thiết kế nhỏ gọn, máy chạy êm, thao tác tắt mở đơn giản, có thể vệ sinh máy sau mỗi lần sử dụng dễ dàng.&nbsp;</span><span style=\"font-weight: 700; font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif; font-size: 13px;\">Tông đơ cắt tóc&nbsp;Jichen 0817 giá rẻ</span><span style=\"font-family: Arial, Helvetica, &quot;Helvetica Neue&quot;, sans-serif; font-size: 13px;\">&nbsp;là sản phẩm chuyên dụng để cắt tóc cho trẻ em trong gia đình hoặc sử dụng nhiều&nbsp;ở các salon tóc hiện nay.</span><br></p>',310000,310000,'f8be50f54fa95900e69685809d8eacce','','','',1,0,'2018-09-17 23:09:53','2018-09-17 23:09:53');
/*!40000 ALTER TABLE `tblProduct` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-25 14:28:36
