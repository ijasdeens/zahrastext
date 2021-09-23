-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2021 at 06:11 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nowfarsp_new_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(800) NOT NULL,
  `admin_mob` varchar(300) NOT NULL,
  `admin_gmail` varchar(800) NOT NULL,
  `admin_password` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_mob`, `admin_gmail`, `admin_password`) VALUES
(1, 'Ijas', '0758953142', 'ijasdeen@gmail.com', '0758953142');

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `bank_details_id` int(11) NOT NULL,
  `bank_account_no` varchar(200) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `initial_amount` double NOT NULL,
  `initial_note` varchar(200) NOT NULL,
  `branch_name` varchar(200) NOT NULL,
  `primary_bank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`bank_details_id`, `bank_account_no`, `bank_name`, `initial_amount`, `initial_note`, `branch_name`, `primary_bank`) VALUES
(1, '8006536654', 'Commercial bank', 50000, 'Bussiness account ', 'Valaichenai', 0),
(2, '5456654565', 'HND ', 510000, 'Allocated for personal ', 'Oddamavadi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brands_id` int(11) NOT NULL,
  `brands_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brands_id`, `brands_name`) VALUES
(8, 'LGF');

-- --------------------------------------------------------

--
-- Table structure for table `chequesbyadmin`
--

CREATE TABLE `chequesbyadmin` (
  `chequesbyadmin_id` int(11) NOT NULL,
  `bank_name` varchar(500) NOT NULL,
  `branch_name` varchar(500) NOT NULL,
  `cheque_no` varchar(250) NOT NULL,
  `cheque_date` varchar(100) NOT NULL,
  `cheque_status` varchar(100) NOT NULL,
  `customer_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chequesbyadmin`
--

INSERT INTO `chequesbyadmin` (`chequesbyadmin_id`, `bank_name`, `branch_name`, `cheque_no`, `cheque_date`, `cheque_status`, `customer_name`) VALUES
(1, 'Commercial bank', 'Valaichenai', '199726500136', '2021-06-15', 'Postponed', 'Ijas deen');

-- --------------------------------------------------------

--
-- Table structure for table `cheques_details`
--

CREATE TABLE `cheques_details` (
  `cheque_details_id` int(11) NOT NULL,
  `cheque_no` varchar(800) NOT NULL,
  `cheque_date` varchar(20) NOT NULL,
  `amount` double NOT NULL,
  `status` varchar(500) NOT NULL,
  `bank_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cheques_details`
--

INSERT INTO `cheques_details` (`cheque_details_id`, `cheque_no`, `cheque_date`, `amount`, `status`, `bank_name`) VALUES
(1, '345345345', '2021-01-01', 300, 'Pending', 'HND '),
(2, '32555', '2021-02-01', 2500, 'Pending', 'HND '),
(3, '250000', '2021-01-01', 2500, 'Pending', 'HND ');

-- --------------------------------------------------------

--
-- Table structure for table `cheque_status`
--

CREATE TABLE `cheque_status` (
  `cheque_status_Id` int(11) NOT NULL,
  `cheque_id` int(11) NOT NULL,
  `given_to_sup` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `given_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(300) NOT NULL,
  `customer_mobile` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_mobile`) VALUES
(1, 'Fregmant', '0758953142'),
(2, 'David', '0758953145');

-- --------------------------------------------------------

--
-- Table structure for table `customer_check_details`
--

CREATE TABLE `customer_check_details` (
  `customer_cheque_details` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `customer_id_fk` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_dis_ads`
--

CREATE TABLE `customer_dis_ads` (
  `customer_ads_dis_id` int(11) NOT NULL,
  `customer_ads_1` text NOT NULL,
  `customer_ads_2` text NOT NULL,
  `customer_ads_3` text NOT NULL,
  `customer_ads_4` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_dis_ads`
--

INSERT INTO `customer_dis_ads` (`customer_ads_dis_id`, `customer_ads_1`, `customer_ads_2`, `customer_ads_3`, `customer_ads_4`) VALUES
(1, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `expenses_list`
--

CREATE TABLE `expenses_list` (
  `expenses_list_id` int(11) NOT NULL,
  `expense_type` int(11) NOT NULL,
  `expense_note` varchar(500) NOT NULL,
  `expense_date` varchar(200) NOT NULL,
  `expense_amount` double NOT NULL,
  `outlet_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses_list`
--

INSERT INTO `expenses_list` (`expenses_list_id`, `expense_type`, `expense_note`, `expense_date`, `expense_amount`, `outlet_id_fk`) VALUES
(1, 1, 'For tea ', '2021-07-14', 1500, 1);

-- --------------------------------------------------------

--
-- Table structure for table `expense_type`
--

CREATE TABLE `expense_type` (
  `expense_typeid` int(11) NOT NULL,
  `expense_name` varchar(800) NOT NULL,
  `outlet_on_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_type`
--

INSERT INTO `expense_type` (`expense_typeid`, `expense_name`, `outlet_on_status`) VALUES
(1, 'Owner purpsoe ', 1),
(2, 'Refreshment purpose ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `general_setting`
--

CREATE TABLE `general_setting` (
  `general_setting_id` int(11) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `logo` varchar(150) NOT NULL,
  `company_address` varchar(200) NOT NULL,
  `main_hotline_number` varchar(20) NOT NULL,
  `outlet_alert_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `general_setting`
--

INSERT INTO `general_setting` (`general_setting_id`, `company_name`, `logo`, `company_address`, `main_hotline_number`, `outlet_alert_quantity`) VALUES
(1, 'Zahras', '143252676_3638652746250707_1939029222996289137_n.jpg', 'Colombo road oddamavadi - 04', '0758953142', 15);

-- --------------------------------------------------------

--
-- Table structure for table `groups_for_sms`
--

CREATE TABLE `groups_for_sms` (
  `groups_id` int(11) NOT NULL,
  `groups_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups_for_sms`
--

INSERT INTO `groups_for_sms` (`groups_id`, `groups_name`) VALUES
(1, 'Create');

-- --------------------------------------------------------

--
-- Table structure for table `group_sms_contact`
--

CREATE TABLE `group_sms_contact` (
  `group_sms_contact_id` int(11) NOT NULL,
  `group_id_fk` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_sms_contact`
--

INSERT INTO `group_sms_contact` (`group_sms_contact_id`, `group_id_fk`, `customer_id`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_id_generator`
--

CREATE TABLE `invoice_id_generator` (
  `invoice_id` int(11) NOT NULL,
  `Id_k` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_id_generator`
--

INSERT INTO `invoice_id_generator` (`invoice_id`, `Id_k`) VALUES
(1, '001'),
(2, '002'),
(3, '003'),
(4, '004');

-- --------------------------------------------------------

--
-- Table structure for table `main_categories`
--

CREATE TABLE `main_categories` (
  `main_categoriesid` int(11) NOT NULL,
  `categoris_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_categories`
--

INSERT INTO `main_categories` (`main_categoriesid`, `categoris_name`) VALUES
(3, 'Cat 1');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `summery_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `choosen_quantity` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `summery_id`, `product_id`, `choosen_quantity`, `status`) VALUES
(1, 445, 2, 1, 1),
(2, 445, 1, 1, 1),
(3, 446, 1, 2, 1),
(4, 446, 2, 4, 1),
(5, 447, 2, 1, 1),
(6, 447, 1, 1, 1),
(7, 448, 2, 2, 1),
(8, 449, 2, 1, 1),
(9, 449, 1, 1, 1),
(10, 450, 2, 1, 1),
(11, 451, 2, 0, 0),
(12, 452, 2, 1, 1),
(13, 453, 2, 1, 1),
(14, 454, 2, 0, 0),
(15, 455, 2, 1, 1),
(16, 455, 1, 1, 1),
(17, 456, 2, 2, 1),
(18, 457, 2, 1, 1),
(19, 458, 2, 1, 1),
(20, 459, 2, 1, 1),
(21, 460, 2, 2, 1),
(22, 461, 1, 1, 1),
(23, 462, 2, 1, 1),
(24, 463, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_summery`
--

CREATE TABLE `order_summery` (
  `order_summery_id` int(11) NOT NULL,
  `ordered_date` varchar(100) NOT NULL,
  `ordered_status` tinyint(1) NOT NULL,
  `discount` int(11) NOT NULL,
  `discounted_amount` varchar(100) NOT NULL,
  `total_amount` double NOT NULL,
  `customer_id` varchar(11) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `invoice_no` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_summery`
--

INSERT INTO `order_summery` (`order_summery_id`, `ordered_date`, `ordered_status`, `discount`, `discounted_amount`, `total_amount`, `customer_id`, `payment_method`, `outlet_id`, `status`, `invoice_no`) VALUES
(445, '2021-03-31 8:02:22 PM', 1, 0, 'Rs.0', 6000, '1', 'Credit', 1, 'Sold', 'null'),
(446, '2021-04-01 1:24:17 PM', 1, 0, 'Rs.0', 16000, '1', 'Cash', 1, 'Sold', '446'),
(447, '2021-04-01 1:25:31 PM', 1, 0, 'Rs.0', 6000, '1', 'Cash', 1, 'Sold', '447'),
(448, '2021-04-01 2:52:19 PM', 1, 0, 'Rs.0', 4000, '1', 'Cheque', 1, 'Sold', '448'),
(449, '2021-04-20 12:43:49 PM', 1, 0, 'Rs.0', 4500, '1', 'Cash', 1, 'Sold', '449'),
(450, '2021-04-20 4:23:01 PM', 1, 0, 'Rs.0', 1500, '1', 'Credit', 1, 'Sold', '450'),
(451, '2021-05-08 4:46:56 PM', 1, 0, 'Rs.0', 2000, '1', 'Cash', 1, 'Sold', '451'),
(452, '2021-05-08 4:49:23 PM', 1, 10, 'Rs.120.00', 1080, '1', 'Cheque', 1, 'Sold', '452'),
(453, '2021-07-13 5:21:17 PM', 1, 0, 'Rs.0', 2000, '0', 'Cash', 1, 'Sold', '453'),
(454, '2021-07-13 5:24:12 PM', 1, 0, 'Rs.0', 4000, '1', 'Cash', 1, 'Sold', '454'),
(455, '2021-07-13 5:32:50 PM', 1, 0, 'Rs.0', 6000, '1', 'Cash', 1, 'Sold', '455'),
(456, '2021-07-13 8:23:25 PM', 1, 0, 'Rs.0', 4000, '1', 'Cash', 1, 'Sold', '456'),
(457, '2021-07-13 8:24:39 PM', 1, 0, 'Rs.0', 2000, '0', 'Cash', 1, 'Sold', '457'),
(458, '2021-07-13 8:27:45 PM', 1, 0, 'Rs.0', 2000, '1', 'Cash', 1, 'Sold', '458'),
(459, '2021-07-13 8:28:18 PM', 1, 0, 'Rs.0', 2000, '1', 'Cash', 1, 'Sold', '459'),
(460, '2021-07-13 8:29:22 PM', 1, 0, 'Rs.0', 4000, '1', 'Cash', 1, 'Sold', '460'),
(461, '2021-07-13 8:29:45 PM', 1, 0, 'Rs.0', 4000, '0', 'Cash', 1, 'Sold', '461'),
(462, '2021-07-13 8:30:47 PM', 1, 0, 'Rs.0', 2000, '0', 'Cash', 1, 'Sold', '462'),
(463, '2021-07-13 8:31:59 PM', 1, 0, 'Rs.0', 2000, '1', 'Cash', 1, 'Sold', '463');

-- --------------------------------------------------------

--
-- Table structure for table `outlets`
--

CREATE TABLE `outlets` (
  `outlets_id` int(11) NOT NULL,
  `outlets_name` varchar(200) NOT NULL,
  `outlet_mob` varchar(15) NOT NULL,
  `addresses` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outlets`
--

INSERT INTO `outlets` (`outlets_id`, `outlets_name`, `outlet_mob`, `addresses`) VALUES
(1, 'Oddamavadi', '0778953145', 'Oddamavadi Colombo road'),
(2, 'Valaichenai AAS', '0776598633', 'Dear address'),
(3, 'Meeravodai ', '0758953155', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `outlet_expenses`
--

CREATE TABLE `outlet_expenses` (
  `outlet_expese_id` int(11) NOT NULL,
  `outlet_id_fk` int(11) NOT NULL,
  `amount` double NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paying_method_cheque`
--

CREATE TABLE `paying_method_cheque` (
  `paying_method_cheque_id` int(11) NOT NULL,
  `bank_name` varchar(500) NOT NULL,
  `branch_name` varchar(500) NOT NULL,
  `account_no` int(11) NOT NULL,
  `cheque_date` varchar(100) NOT NULL,
  `cheque_status` varchar(100) NOT NULL,
  `summery_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paying_method_cheque`
--

INSERT INTO `paying_method_cheque` (`paying_method_cheque_id`, `bank_name`, `branch_name`, `account_no`, `cheque_date`, `cheque_status`, `summery_id`) VALUES
(1, 'Commercial', 'Vlch', 234234324, '2021-01-01', 'Pending', 448),
(2, 'Commercial ', 'Valacihenai', 250054545, '2021-05-08', 'Pending', 452);

-- --------------------------------------------------------

--
-- Table structure for table `products_for_outlet`
--

CREATE TABLE `products_for_outlet` (
  `products_for_outlet` int(11) NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_for_outlet`
--

INSERT INTO `products_for_outlet` (`products_for_outlet`, `outlet_id`, `product_id`, `product_quantity`) VALUES
(1, 1, 1, 200),
(2, 1, 2, 206);

-- --------------------------------------------------------

--
-- Table structure for table `products_section`
--

CREATE TABLE `products_section` (
  `products_id` int(11) NOT NULL,
  `products_code` varchar(500) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_categoryid` int(11) NOT NULL,
  `mfd` varchar(200) NOT NULL,
  `exp` varchar(200) NOT NULL,
  `product_cost` double NOT NULL,
  `product_price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `alert_quantity` int(11) NOT NULL,
  `product_pic` varchar(800) NOT NULL,
  `product_desc` text NOT NULL,
  `product_name` varchar(300) NOT NULL,
  `product_unit` varchar(500) NOT NULL,
  `supplier_det` int(11) NOT NULL,
  `batch_no` varchar(500) NOT NULL,
  `invoice_no` varchar(800) NOT NULL,
  `Invoice_manual` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_section`
--

INSERT INTO `products_section` (`products_id`, `products_code`, `brand_id`, `category_id`, `sub_categoryid`, `mfd`, `exp`, `product_cost`, `product_price`, `quantity`, `alert_quantity`, `product_pic`, `product_desc`, `product_name`, `product_unit`, `supplier_det`, `batch_no`, `invoice_no`, `Invoice_manual`) VALUES
(1, '161683901433627', 1, 1, 2, '2021-03-27', '2021-03-27', 2500, 4000, 1000, 100, '158583785_285208866301964_658414951536503965_o.jpg', 'The shirt is for males', 'Shirt ', 'LG', 1, 'AA1', '004', '20040'),
(2, '4706558827', 1, 1, 2, '2021-03-01', '2021-03-27', 1500, 2000, 150, 100, '89205196_1555409697961374_1147258371183738880_o.jpg', 'Trousars for male with fashion for new festival ', 'Trousars', 'XL', 1, 'AA1', '004', ' 255'),
(3, '8489743030', 8, 3, 6, '2021-04-01', '2021-04-30', 250, 300, 500, 400, 'anotherphoto.jpg', 'Desc', 'Anchor ', 'XL', 1, 'AACH', '005', '22');

-- --------------------------------------------------------

--
-- Table structure for table `remidner_section`
--

CREATE TABLE `remidner_section` (
  `reminder_id` int(11) NOT NULL,
  `cheques_reminder` int(11) NOT NULL,
  `credit_reminder` int(11) NOT NULL,
  `expire_reminder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `returned_print_data`
--

CREATE TABLE `returned_print_data` (
  `returned_print_id` int(11) NOT NULL,
  `name` varchar(800) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` varchar(200) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `outlet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `return_product_details_all`
--

CREATE TABLE `return_product_details_all` (
  `return_product_details_all_id` int(11) NOT NULL,
  `product_name` varchar(800) NOT NULL,
  `returned_quantity` int(11) NOT NULL,
  `product_code` varchar(800) NOT NULL,
  `price` varchar(800) NOT NULL,
  `type` varchar(100) NOT NULL,
  `order_summery_id` varchar(400) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `return_product_details_all`
--

INSERT INTO `return_product_details_all` (`return_product_details_all_id`, `product_name`, `returned_quantity`, `product_code`, `price`, `type`, `order_summery_id`, `product_id`) VALUES
(1, 'Trousars', 1, '4706558827', '2000', 'returned', '451', 2),
(2, 'Trousars', 2, '4706558827', '2000', 'returned', '454', 2);

-- --------------------------------------------------------

--
-- Table structure for table `return_temp_details`
--

CREATE TABLE `return_temp_details` (
  `return_temp_details_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `order_summery_id_fk` varchar(100) NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales_credit_details`
--

CREATE TABLE `sales_credit_details` (
  `sales_credti_id` int(11) NOT NULL,
  `sales_credit_amount` double NOT NULL,
  `summery_id_fk` int(11) NOT NULL,
  `outlet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_credit_details`
--

INSERT INTO `sales_credit_details` (`sales_credti_id`, `sales_credit_amount`, `summery_id_fk`, `outlet_id`) VALUES
(57, 1000, 446, 0),
(58, 4500, 447, 0),
(59, 2000, 449, 0),
(60, 500, 451, 0),
(61, 580, 452, 0),
(62, 500, 453, 0),
(63, 1500, 454, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_hold`
--

CREATE TABLE `shopping_hold` (
  `shopping_hold` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `grand_total` varchar(100) NOT NULL,
  `outlet_id_fk` int(11) NOT NULL,
  `hold_returned_time` varchar(200) NOT NULL,
  `hold_returned_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_hold`
--

INSERT INTO `shopping_hold` (`shopping_hold`, `status`, `customer_id`, `date`, `grand_total`, `outlet_id_fk`, `hold_returned_time`, `hold_returned_status`) VALUES
(23, 1, 1, '2021-04-01 12:38:10 ', '2,000.00', 1, '2021-04-01 12:38:20 PM', 1),
(25, 1, 1, '2021-04-01 12:46:25 ', '10,000.00', 1, '2021-04-01 12:46:33 PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_hold_products`
--

CREATE TABLE `shopping_hold_products` (
  `shopping_hold_pr_id` int(11) NOT NULL,
  `sh_products_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `shopping_hold_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_hold_products`
--

INSERT INTO `shopping_hold_products` (`shopping_hold_pr_id`, `sh_products_id`, `quantity`, `shopping_hold_id`) VALUES
(9, 2, 1, 23),
(12, 2, 1, 25),
(13, 1, 2, 25);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(300) NOT NULL,
  `staff_mobile` varchar(200) NOT NULL,
  `joint_date` varchar(300) NOT NULL,
  `responsibility` text NOT NULL,
  `password` varchar(500) NOT NULL,
  `working_outlet` int(11) NOT NULL,
  `cashier_ok` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `staff_mobile`, `joint_date`, `responsibility`, `password`, `working_outlet`, `cashier_ok`) VALUES
(1, 'Mohammed', '0750550660', '2020-11-11', 'Mmm', '0750550660', 0, 0),
(12, 'Staff number', '0758953142', '2021-01-01', 'asdasd', '0758953142', 1, 1),
(13, 'Yellow ', '0758953141', '2022-01-01', 'asdasdasd', '0758953141', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_categoryid` int(11) NOT NULL,
  `main_cat_id` int(11) NOT NULL,
  `sub_cat_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_categoryid`, `main_cat_id`, `sub_cat_id`) VALUES
(1, 2, 'Trousars'),
(2, 1, 'Shirt'),
(4, 1, 'T- shirt '),
(5, 2, 'Abaya'),
(6, 3, 'Shirts');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(200) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `org_name` varchar(500) NOT NULL,
  `supplier_addresses` text NOT NULL,
  `supplier_accountno` varchar(500) NOT NULL,
  `bank_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `mobile_number`, `org_name`, `supplier_addresses`, `supplier_accountno`, `bank_name`) VALUES
(1, 'David', '0758953145', 'Org', 'School cross road meeravodai - 04', '324324324', 'Commercial bank ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_warehouse`
--

CREATE TABLE `tbl_warehouse` (
  `warehouse_id` int(11) NOT NULL,
  `warehouse_name` varchar(500) NOT NULL,
  `warehouse_address` varchar(200) NOT NULL,
  `main_mobile` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temporary_data_of_sale`
--

CREATE TABLE `temporary_data_of_sale` (
  `temporary_data_of_sale_id` int(11) NOT NULL,
  `discount` varchar(100) NOT NULL,
  `subtract` varchar(100) NOT NULL,
  `discount_amount` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `paying_amount` varchar(100) NOT NULL,
  `outlet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temporary_data_of_sale`
--

INSERT INTO `temporary_data_of_sale` (`temporary_data_of_sale_id`, `discount`, `subtract`, `discount_amount`, `total`, `paying_amount`, `outlet_id`) VALUES
(1, '0%', '0.00', 'Rs.0', 'Rs.2,000.00', '<br>Rs.2,000.00', 1),
(2, '0%', '0.00', 'Rs.0', 'Rs.0.00', '<br>Rs.0.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_request_product`
--

CREATE TABLE `warehouse_request_product` (
  `warehouse_req_pr_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `request_quantity` int(11) NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `dateandtime` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warehouse_request_product`
--

INSERT INTO `warehouse_request_product` (`warehouse_req_pr_id`, `product_id`, `request_quantity`, `outlet_id`, `status`, `dateandtime`) VALUES
(9, 1, 1, 1, 'Completed', '2021-07-13 5:33:27 PM');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_stock`
--

CREATE TABLE `warehouse_stock` (
  `warehouse_stockid` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `warehouse_stock` int(11) NOT NULL,
  `saved_date` varchar(300) NOT NULL,
  `updated_date_time` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`bank_details_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brands_id`);

--
-- Indexes for table `chequesbyadmin`
--
ALTER TABLE `chequesbyadmin`
  ADD PRIMARY KEY (`chequesbyadmin_id`);

--
-- Indexes for table `cheques_details`
--
ALTER TABLE `cheques_details`
  ADD PRIMARY KEY (`cheque_details_id`);

--
-- Indexes for table `cheque_status`
--
ALTER TABLE `cheque_status`
  ADD PRIMARY KEY (`cheque_status_Id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_dis_ads`
--
ALTER TABLE `customer_dis_ads`
  ADD PRIMARY KEY (`customer_ads_dis_id`);

--
-- Indexes for table `expenses_list`
--
ALTER TABLE `expenses_list`
  ADD PRIMARY KEY (`expenses_list_id`);

--
-- Indexes for table `expense_type`
--
ALTER TABLE `expense_type`
  ADD PRIMARY KEY (`expense_typeid`);

--
-- Indexes for table `general_setting`
--
ALTER TABLE `general_setting`
  ADD PRIMARY KEY (`general_setting_id`);

--
-- Indexes for table `groups_for_sms`
--
ALTER TABLE `groups_for_sms`
  ADD PRIMARY KEY (`groups_id`);

--
-- Indexes for table `group_sms_contact`
--
ALTER TABLE `group_sms_contact`
  ADD PRIMARY KEY (`group_sms_contact_id`);

--
-- Indexes for table `invoice_id_generator`
--
ALTER TABLE `invoice_id_generator`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `main_categories`
--
ALTER TABLE `main_categories`
  ADD PRIMARY KEY (`main_categoriesid`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_summery_fk` (`summery_id`);

--
-- Indexes for table `order_summery`
--
ALTER TABLE `order_summery`
  ADD PRIMARY KEY (`order_summery_id`);

--
-- Indexes for table `outlets`
--
ALTER TABLE `outlets`
  ADD PRIMARY KEY (`outlets_id`);

--
-- Indexes for table `outlet_expenses`
--
ALTER TABLE `outlet_expenses`
  ADD PRIMARY KEY (`outlet_expese_id`);

--
-- Indexes for table `paying_method_cheque`
--
ALTER TABLE `paying_method_cheque`
  ADD PRIMARY KEY (`paying_method_cheque_id`);

--
-- Indexes for table `products_for_outlet`
--
ALTER TABLE `products_for_outlet`
  ADD PRIMARY KEY (`products_for_outlet`);

--
-- Indexes for table `products_section`
--
ALTER TABLE `products_section`
  ADD PRIMARY KEY (`products_id`);

--
-- Indexes for table `remidner_section`
--
ALTER TABLE `remidner_section`
  ADD PRIMARY KEY (`reminder_id`);

--
-- Indexes for table `returned_print_data`
--
ALTER TABLE `returned_print_data`
  ADD PRIMARY KEY (`returned_print_id`);

--
-- Indexes for table `return_product_details_all`
--
ALTER TABLE `return_product_details_all`
  ADD PRIMARY KEY (`return_product_details_all_id`);

--
-- Indexes for table `return_temp_details`
--
ALTER TABLE `return_temp_details`
  ADD PRIMARY KEY (`return_temp_details_id`);

--
-- Indexes for table `sales_credit_details`
--
ALTER TABLE `sales_credit_details`
  ADD PRIMARY KEY (`sales_credti_id`),
  ADD KEY `summery_id_fk` (`summery_id_fk`);

--
-- Indexes for table `shopping_hold`
--
ALTER TABLE `shopping_hold`
  ADD PRIMARY KEY (`shopping_hold`);

--
-- Indexes for table `shopping_hold_products`
--
ALTER TABLE `shopping_hold_products`
  ADD PRIMARY KEY (`shopping_hold_pr_id`),
  ADD KEY `hold_products_id` (`shopping_hold_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_categoryid`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  ADD PRIMARY KEY (`warehouse_id`);

--
-- Indexes for table `temporary_data_of_sale`
--
ALTER TABLE `temporary_data_of_sale`
  ADD PRIMARY KEY (`temporary_data_of_sale_id`);

--
-- Indexes for table `warehouse_request_product`
--
ALTER TABLE `warehouse_request_product`
  ADD PRIMARY KEY (`warehouse_req_pr_id`);

--
-- Indexes for table `warehouse_stock`
--
ALTER TABLE `warehouse_stock`
  ADD PRIMARY KEY (`warehouse_stockid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `bank_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brands_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `chequesbyadmin`
--
ALTER TABLE `chequesbyadmin`
  MODIFY `chequesbyadmin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cheques_details`
--
ALTER TABLE `cheques_details`
  MODIFY `cheque_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cheque_status`
--
ALTER TABLE `cheque_status`
  MODIFY `cheque_status_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_dis_ads`
--
ALTER TABLE `customer_dis_ads`
  MODIFY `customer_ads_dis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expenses_list`
--
ALTER TABLE `expenses_list`
  MODIFY `expenses_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense_type`
--
ALTER TABLE `expense_type`
  MODIFY `expense_typeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `general_setting`
--
ALTER TABLE `general_setting`
  MODIFY `general_setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups_for_sms`
--
ALTER TABLE `groups_for_sms`
  MODIFY `groups_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `group_sms_contact`
--
ALTER TABLE `group_sms_contact`
  MODIFY `group_sms_contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice_id_generator`
--
ALTER TABLE `invoice_id_generator`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `main_categories`
--
ALTER TABLE `main_categories`
  MODIFY `main_categoriesid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_summery`
--
ALTER TABLE `order_summery`
  MODIFY `order_summery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=465;

--
-- AUTO_INCREMENT for table `outlets`
--
ALTER TABLE `outlets`
  MODIFY `outlets_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `outlet_expenses`
--
ALTER TABLE `outlet_expenses`
  MODIFY `outlet_expese_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paying_method_cheque`
--
ALTER TABLE `paying_method_cheque`
  MODIFY `paying_method_cheque_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products_for_outlet`
--
ALTER TABLE `products_for_outlet`
  MODIFY `products_for_outlet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products_section`
--
ALTER TABLE `products_section`
  MODIFY `products_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `remidner_section`
--
ALTER TABLE `remidner_section`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `returned_print_data`
--
ALTER TABLE `returned_print_data`
  MODIFY `returned_print_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `return_product_details_all`
--
ALTER TABLE `return_product_details_all`
  MODIFY `return_product_details_all_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `return_temp_details`
--
ALTER TABLE `return_temp_details`
  MODIFY `return_temp_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sales_credit_details`
--
ALTER TABLE `sales_credit_details`
  MODIFY `sales_credti_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `shopping_hold`
--
ALTER TABLE `shopping_hold`
  MODIFY `shopping_hold` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `shopping_hold_products`
--
ALTER TABLE `shopping_hold_products`
  MODIFY `shopping_hold_pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  MODIFY `warehouse_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temporary_data_of_sale`
--
ALTER TABLE `temporary_data_of_sale`
  MODIFY `temporary_data_of_sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `warehouse_request_product`
--
ALTER TABLE `warehouse_request_product`
  MODIFY `warehouse_req_pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `warehouse_stock`
--
ALTER TABLE `warehouse_stock`
  MODIFY `warehouse_stockid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_summery_fk` FOREIGN KEY (`summery_id`) REFERENCES `order_summery` (`order_summery_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales_credit_details`
--
ALTER TABLE `sales_credit_details`
  ADD CONSTRAINT `summery_id_fk` FOREIGN KEY (`summery_id_fk`) REFERENCES `order_summery` (`order_summery_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shopping_hold_products`
--
ALTER TABLE `shopping_hold_products`
  ADD CONSTRAINT `hold_products_id` FOREIGN KEY (`shopping_hold_id`) REFERENCES `shopping_hold` (`shopping_hold`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
