-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2025 at 12:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system_repair`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand_grounds`
--

CREATE TABLE `brand_grounds` (
  `brand_id` int(10) NOT NULL,
  `brand_name` text NOT NULL,
  `brand_num` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `brand_grounds`
--

INSERT INTO `brand_grounds` (`brand_id`, `brand_name`, `brand_num`) VALUES
(0, 'กรุณากรอกสาขา...', '0'),
(256, 'สาขา ชัยนาท', '256');

-- --------------------------------------------------------

--
-- Table structure for table `broken_symptoms`
--

CREATE TABLE `broken_symptoms` (
  `id_broken` int(11) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `zip_code` varchar(250) NOT NULL,
  `district` varchar(250) NOT NULL,
  `amphoe` varchar(250) NOT NULL,
  `province` varchar(250) NOT NULL,
  `mainternace_detail` text NOT NULL COMMENT 'สรุปอาการเสีย',
  `status` text NOT NULL,
  `id_customer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `broken_symptoms1`
--

CREATE TABLE `broken_symptoms1` (
  `id_es` int(10) NOT NULL COMMENT 'id ของ check box',
  `member_code` varchar(250) NOT NULL,
  `es1` varchar(10) NOT NULL,
  `es2` varchar(10) NOT NULL,
  `es3` varchar(10) NOT NULL,
  `es4` varchar(10) NOT NULL,
  `es5` varchar(10) NOT NULL,
  `es6` varchar(10) NOT NULL,
  `es7` varchar(10) NOT NULL,
  `es8` varchar(10) NOT NULL,
  `es9` varchar(10) NOT NULL,
  `es10` varchar(10) NOT NULL,
  `es11` varchar(10) NOT NULL,
  `es12` varchar(10) NOT NULL,
  `es13` varchar(10) NOT NULL,
  `es14` varchar(10) NOT NULL,
  `es15` varchar(10) DEFAULT NULL,
  `other1` varchar(250) NOT NULL COMMENT 'อื่น ๆ โปรดระบุ',
  `product_condition` varchar(250) NOT NULL COMMENT 'สภาพสินค้า',
  `detail` varchar(250) NOT NULL COMMENT 'อื่น ๆ โปรดระบุ\r\n                                            โดยละเอียด',
  `Important` varchar(250) NOT NULL COMMENT 'ข้อมูลสำคัญ',
  `Computer_type` text NOT NULL,
  `maintenance_type` varchar(150) NOT NULL,
  `Service_rate` varchar(150) NOT NULL,
  `technician` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL,
  `mainternace_detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `broken_symptoms1`
--

INSERT INTO `broken_symptoms1` (`id_es`, `member_code`, `es1`, `es2`, `es3`, `es4`, `es5`, `es6`, `es7`, `es8`, `es9`, `es10`, `es11`, `es12`, `es13`, `es14`, `es15`, `other1`, `product_condition`, `detail`, `Important`, `Computer_type`, `maintenance_type`, `Service_rate`, `technician`, `date`, `status`, `mainternace_detail`) VALUES
(1, 'MT-20250713-001', '', '', '', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'computer_in-jib', 'warranty_expired', 'บริการ-ซ่อมบำรุงรักษาคอมพิวเตอร์โน๊ตบุ๊ค_JIB', 'เกียรติศักดิ์', '2025-07-14 04:52:04', 1, 'Epson L3250 หมึกไม่ออก'),
(2, 'MT-20250713-002', '', '', '', '1', '', '', '', '', '', '1', '', '', '', '', '', '', '', '', '', 'computer_in-jib', 'mainternac', 'บริการ-ซ่อมบำรุงรักษาคอมพิวเตอร์ PC_JIB', 'เกียรติศักดิ์', '2025-07-14 05:40:26', 1, 'จอฟ้า'),
(3, 'MT-20250714-004', '', '', '', '', '', '', '', '', '', '1', '', '', '', '', '', '', '', '', '', 'computer_out', 'mainternac', 'บริการ-ประกอบสินค้าเคลม_JIB', 'เกียรติศักดิ์', '2025-07-14 11:47:25', 1, 'จอฟ้า'),
(4, 'MT-20250713-002', '', '', '', '1', '', '', '', '', '', '1', '', '', '', '', '', '', '', '', '', 'computer_in-jib', 'mainternac', 'บริการ-ซ่อมบำรุงรักษาคอมพิวเตอร์โน๊ตบุ๊ค_JIB', 'เกียรติศักดิ์', '2025-07-14 11:53:22', 1, 'จอฟ้า'),
(5, 'MT-20250714-005', '', '', '', '1', '', '', '', '', '', '', '', '1', '', '', '', 'ใส่ CPU', '', '', '', 'computer_out', 'mainternac', 'บริการ-ประกอบสินค้าเคลม_OTHER', 'เกียรติศักดิ์', '2025-07-14 11:55:40', 1, 'ใส่ CPU'),
(6, 'MT-20250715-006', '', '', '', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'computer_in-jib', 'mainternac', 'บริการ-ประกอบสินค้าเคลม_JIB', 'เกียรติศักดิ์', '2025-07-15 05:02:16', 1, 'ติดตั้ง windows ซื้อจากคอมมาท'),
(7, 'MT-20250715-007', '', '', '', '1', '', '1', '', '', '', '1', '', '', '1', '', '1', '', 'ตามอายุการใช้งาน', '', 'ไม่มีข้อมูล', 'computer_out', 'mainternac', 'บริการ-ประกอบสินค้าเคลม_JIB', 'เกียรติศักดิ์', '2025-07-15 06:02:08', 1, 'จอฟ้า ไม่ขึ้นภาพ'),
(8, 'MT-20250716-008', '', '', '', '1', '', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', 'computer_in-jib', 'mainternac', 'บริการ-ซ่อมบำรุงรักษาคอมพิวเตอร์ PC_JIB', 'เกียรติศักดิ์', '2025-07-16 02:55:58', 1, 'ไม่ขึ้นภาพ');

-- --------------------------------------------------------

--
-- Table structure for table `computer_type`
--

CREATE TABLE `computer_type` (
  `id_type` int(11) NOT NULL,
  `computer_name_th` varchar(20) NOT NULL,
  `computer_name_eng` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `computer_type`
--

INSERT INTO `computer_type` (`id_type`, `computer_name_th`, `computer_name_eng`) VALUES
(1, 'เครื่องนอก JIB', 'computer_out'),
(2, 'เครื่องในJIB', 'computer_in-jib');

-- --------------------------------------------------------

--
-- Table structure for table `login_user`
--

CREATE TABLE `login_user` (
  `id_user` int(11) NOT NULL,
  `Username` varchar(500) NOT NULL,
  `Password_repair` varchar(500) NOT NULL,
  `User_number` varchar(10) NOT NULL,
  `Firstname_repair` varchar(500) NOT NULL,
  `Lastname_repair` varchar(500) NOT NULL,
  `email_repair` varchar(500) NOT NULL,
  `brand_id` text NOT NULL,
  `User_status` text NOT NULL,
  `technician` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `login_user`
--

INSERT INTO `login_user` (`id_user`, `Username`, `Password_repair`, `User_number`, `Firstname_repair`, `Lastname_repair`, `email_repair`, `brand_id`, `User_status`, `technician`) VALUES
(1, 'kiattisak1998', '$2y$10$vC0fpLulnrHlqouV/.bOE.s.QVAUISvw4BTRR3TvxxXr2AO3gDNkW', '14416', 'เกียรติศักดิ์', 'แจ่มประแดง', 'kiattisakjampradang@gmail.com', '256', 'Sale', ''),
(2, 'kiattisak12', '$2y$10$gC.eSUA5yguKYw8ouQ52Qel1v0SufwbTQ2.0LrSOqZeunT4j5bfoG', '14456', 'test', '-', 'ddd@gmail.com', '256', '', ''),
(3, 'Admin', '$2y$10$6BvCp3PoZmsJvb3WEFKqzu0r3P2PFqsb5bVF7hNv4WIJSSteqNwl6', '14415', 'kiattisak', 'jampradang', 'kiattisak1998@gmail.com', '256', 'Admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `service_rates`
--

CREATE TABLE `service_rates` (
  `Service_id` int(11) NOT NULL,
  `Service_name` varchar(150) NOT NULL,
  `service_price` int(150) NOT NULL,
  `computer_name_eng` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='อัตราค่าบริการ';

--
-- Dumping data for table `service_rates`
--

INSERT INTO `service_rates` (`Service_id`, `Service_name`, `service_price`, `computer_name_eng`) VALUES
(1, 'บริการ-ตรวจเช็คอาการเบื้องต้น PC_JIB', 100, 'computer_in-jib'),
(2, 'บริการ-ตรวจเช็คอาการเบื้องต้น PC_OTHER', 500, 'computer_out'),
(3, 'บริการ-ซ่อมบำรุงรักษาคอมพิวเตอร์ PC_JIB', 300, 'computer_in-jib'),
(4, 'บริการ-ซ่อมบำรุงคอมพิวเตอร์ PC_OTHER', 500, 'computer_out'),
(5, 'บริการ-ซ่อมบำรุงรักษาคอมพิวเตอร์โน๊ตบุ๊ค_JIB', 300, 'computer_in-jib'),
(6, 'บริการ-ซ่อมบำรุงรักษาคอมพิวเตอร์โน๊ตบุ๊ค_OTHER', 800, 'computer_out'),
(7, 'บริการ-ประกอบสินค้าเคลม_JIB', 0, 'computer_in-jib'),
(8, 'บริการ-ประกอบสินค้าเคลม_OTHER', 0, 'computer_out'),
(9, 'บริการ-ประกอบคอมพิวเตอร์_JIB', 0, 'computer_in-jib'),
(10, 'บริการ-ประกอบคอมพิวเตอร์_OTHER', 800, 'computer_out'),
(11, 'บริการ-ติด Windows_JIB(ซื้อจากหน้าร้าน)', 0, 'computer_in-jib'),
(12, 'บริการ-ติดตั้ง Windows_OTHER(ซื้อจากหน้าร้าน)', 0, 'computer_out'),
(13, 'บริการ-ติดตั้ง Windows แก้ไขโปรแกรม_JIB', 300, 'computer_in-jib'),
(14, 'บริการ-ติดตั้ง Windows แก้ไขโปรแกรม_OTHER', 600, 'computer_out'),
(15, 'บริการ-ติดตั้งโปรแกรมทั่วไป โปรแกรมละ_JIB', 200, 'computer_in-jib'),
(16, 'บริการ-ติดตั้งโปรแกรมทั่วไป โปรแกรมละ_OTHER', 400, 'computer_out'),
(17, 'บริการ-ทำความสะอาดคอมพิวเตอร์_JIB', 300, 'computer_in-jib'),
(18, 'บริการ-ทำความสะอาดคอมพิวเตอร์_OTHER', 600, 'computer_out'),
(19, 'บริการ-เพิ่มหรือเปลี่ยนอุปกรณ์คอมพิวเตอร์PC_JIB', 100, 'computer_in-jib'),
(20, 'บริการ-เพิ่มหรือเปลี่ยนอุปกรณ์คอมพิวเตอร์PC_JIB', 300, 'computer_out'),
(21, 'บริการ- เปลี่ยนเมนบอร์ด,พาวเวอร์ซัพพลาย,พัดลมซีพียูู_JIB', 300, 'computer_in-jib'),
(22, 'บริการ- เปลี่ยนเมนบอร์ด,พาวเวอร์ซัพพลาย,พัดลมซีพียูู_OTHER', 600, 'computer_out'),
(23, 'บริการ- เปลี่ยนชุดระบายความร้อน CPU ด้วยระบบน้ำ_PC_JIB', 400, 'computer_in-jib'),
(24, 'บริการ- เปลี่ยนชุดระบายความร้อน CPU ด้วยระบบน้ำ_PC_OTHER', 800, 'computer_in-jib'),
(25, 'บริการ- เปลี่ยนเคสคอมพิวเตอร์_PC_JIB', 500, 'computer_out'),
(26, 'บริการ- เปลี่ยนเคสคอมพิวเตอร์_PC_OTHER', 1000, ''),
(27, 'บริการ- เปลี่ยนเคสคอมพิวเตอร์_PC_OTHER', 1000, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login_log`
--

CREATE TABLE `tbl_login_log` (
  `log_id` int(10) NOT NULL,
  `id_user` int(11) NOT NULL,
  `log_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `log_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='เก็บประวัติ การlogin';

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id_customer` int(11) NOT NULL,
  `member_code` varchar(20) NOT NULL,
  `first_customer` varchar(250) NOT NULL,
  `last_customer` varchar(250) NOT NULL,
  `tel_customer` varchar(10) NOT NULL,
  `email_customer` varchar(250) NOT NULL,
  `district_customer` varchar(250) NOT NULL,
  `amphoe_customer` varchar(250) NOT NULL,
  `province_customer` varchar(250) NOT NULL,
  `zipcode_customer` varchar(250) NOT NULL,
  `date_customer` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`id_customer`, `member_code`, `first_customer`, `last_customer`, `tel_customer`, `email_customer`, `district_customer`, `amphoe_customer`, `province_customer`, `zipcode_customer`, `date_customer`) VALUES
(1, 'MT-20250713-001', 'รุ่งชัย', '-', '0852472039', 'test@gmail.com', 'ชัยนาท', 'เมืองชัยนาท', 'ชัยนาท', '17000', '2025-07-13 07:39:01'),
(2, 'MT-20250713-002', 'ปอง', '-', '0642967762', 'test@gmail.com', 'เขาแก้ว', 'สรรพยา', 'ชัยนาท', '17150', '2025-07-13 07:44:25'),
(3, 'MT-20250713-003', 'อิฟ', '-', '0971264352', 'test@gmail.com', 'ชัยนาท', 'เมืองชัยนาท', 'ชัยนาท', '17000', '2025-07-13 07:45:37'),
(4, 'MT-20250714-004', 'เบียร์', '-', '0849989499', 'test@gmail.com', 'ชัยนาท', 'เมืองชัยนาท', 'ชัยนาท', '17000', '2025-07-14 11:43:59'),
(5, 'MT-20250714-005', 'พระ พร้อม', '-', '0952178900', 'test@gmail.com', 'ช่องแค', 'ตาคลี', 'นครสวรรค์', '60210', '2025-07-14 11:54:38'),
(6, 'MT-20250715-006', 'อลงกรณ์', '-', '0897021956', 'test@gmail.com', 'ชัยนาท', 'เมืองชัยนาท', 'ชัยนาท', '17000', '2025-07-15 05:01:05'),
(7, 'MT-20250715-007', 'บอล', '-', '0959466394', 'test@gmail.com', 'บางหลวง', 'สรรพยา', 'ชัยนาท', '17150', '2025-07-15 05:59:57'),
(8, 'MT-20250716-008', 'สราวุธ', '-', '0869956745', 'test@gmail.com', 'สรรพยา', 'สรรพยา', 'ชัยนาท', '17150', '2025-07-16 02:55:14'),
(9, 'MT-20250717-009', 'แอม', '-', '0994249144', 'test@gmail.com', 'ดงคอน', 'สรรคบุรี', 'ชัยนาท', '17140', '2025-07-17 04:51:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand_grounds`
--
ALTER TABLE `brand_grounds`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `broken_symptoms`
--
ALTER TABLE `broken_symptoms`
  ADD PRIMARY KEY (`id_broken`);

--
-- Indexes for table `broken_symptoms1`
--
ALTER TABLE `broken_symptoms1`
  ADD PRIMARY KEY (`id_es`);

--
-- Indexes for table `computer_type`
--
ALTER TABLE `computer_type`
  ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `login_user`
--
ALTER TABLE `login_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `service_rates`
--
ALTER TABLE `service_rates`
  ADD PRIMARY KEY (`Service_id`);

--
-- Indexes for table `tbl_login_log`
--
ALTER TABLE `tbl_login_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand_grounds`
--
ALTER TABLE `brand_grounds`
  MODIFY `brand_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `broken_symptoms`
--
ALTER TABLE `broken_symptoms`
  MODIFY `id_broken` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `broken_symptoms1`
--
ALTER TABLE `broken_symptoms1`
  MODIFY `id_es` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id ของ check box', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `computer_type`
--
ALTER TABLE `computer_type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_user`
--
ALTER TABLE `login_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service_rates`
--
ALTER TABLE `service_rates`
  MODIFY `Service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_login_log`
--
ALTER TABLE `tbl_login_log`
  MODIFY `log_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_login_log`
--
ALTER TABLE `tbl_login_log`
  ADD CONSTRAINT `tbl_login_log_ibfk_1` FOREIGN KEY (`log_id`) REFERENCES `login_user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
