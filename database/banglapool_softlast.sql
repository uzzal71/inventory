-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 25, 2020 at 06:50 AM
-- Server version: 10.2.25-MariaDB-log
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banglapool_softlast`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_lavels`
--

CREATE TABLE `access_lavels` (
  `accessLavelId` int(11) NOT NULL,
  `lavelName` varchar(50) DEFAULT NULL,
  `lavelDiscription` text DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `createdDate` datetime DEFAULT current_timestamp(),
  `createdBy` int(11) DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updatedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `access_lavels`
--

INSERT INTO `access_lavels` (`accessLavelId`, `lavelName`, `lavelDiscription`, `status`, `createdDate`, `createdBy`, `updatedDate`, `updatedBy`) VALUES
(1, 'Admin', 'This is admin role', 'Active', '2017-03-08 11:26:05', NULL, '2017-03-08 12:10:10', NULL),
(3, 'Manager', 'this is mnager role', 'Active', '2017-03-08 13:05:18', NULL, '2017-03-08 13:08:44', NULL),
(5, 'HR', 'test this', 'Active', '2019-10-06 13:48:47', 1, '2019-10-06 14:44:34', 1),
(6, 'HR Manager', 'test', 'Active', '2019-10-09 09:57:50', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bankaccount`
--

CREATE TABLE `bankaccount` (
  `bankAccountId` int(11) NOT NULL,
  `accountNo` varchar(50) DEFAULT NULL,
  `accountName` varchar(50) DEFAULT NULL,
  `bankName` varchar(50) DEFAULT NULL,
  `branchName` varchar(50) DEFAULT NULL,
  `balance` float DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `createdDate` datetime DEFAULT current_timestamp(),
  `createdBy` varchar(50) DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updatedBy` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bankaccount`
--

INSERT INTO `bankaccount` (`bankAccountId`, `accountNo`, `accountName`, `bankName`, `branchName`, `balance`, `status`, `createdDate`, `createdBy`, `updatedDate`, `updatedBy`) VALUES
(1, '35465423423', 'Bangla Pool', 'DBBL', 'Panthapath', 0, 'Active', '2020-01-22 19:29:11', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cash`
--

CREATE TABLE `cash` (
  `cashId` int(11) NOT NULL,
  `cashName` varchar(50) DEFAULT NULL,
  `balance` float DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `createdDate` datetime DEFAULT current_timestamp(),
  `updatedDate` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdBy` int(11) DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cash`
--

INSERT INTO `cash` (`cashId`, `cashName`, `balance`, `status`, `createdDate`, `updatedDate`, `createdBy`, `updatedBy`) VALUES
(1, 'Cash in Hand', 0, 'Active', '2020-01-22 19:29:03', '2020-01-22 19:29:03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Oral', 'Active', 14, '2020-01-22 01:27:08', NULL, NULL),
(2, 'Solution', 'Active', 14, '2020-01-22 01:28:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companys`
--

CREATE TABLE `companys` (
  `companyID` int(11) NOT NULL,
  `companyName` varchar(50) DEFAULT NULL,
  `companycode` varchar(20) DEFAULT NULL,
  `companyAddress` varchar(100) DEFAULT NULL,
  `companyPhone` varchar(15) DEFAULT NULL,
  `companyEmail` varchar(100) DEFAULT NULL,
  `balance` float DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `regby` int(11) DEFAULT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companys`
--

INSERT INTO `companys` (`companyID`, `companyName`, `companycode`, `companyAddress`, `companyPhone`, `companyEmail`, `balance`, `status`, `regby`, `regdate`, `upby`, `update`) VALUES
(2, 'Sunshine It', 'SUN-2020', 'Dhaka', '1012101', 'sunshine@hmail.com', NULL, NULL, 14, '2020-01-14 05:03:27', NULL, '2020-01-14 05:04:25'),
(5, 'Banglapool', '001', 'House-5, Level-5, Road-20, Sector-13, Uttara, Dhaka-1230', '+88-01780335577', 'banglapool@yahoo.com', NULL, NULL, 14, '2020-01-20 11:21:13', NULL, '2020-01-20 11:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `com_profile`
--

CREATE TABLE `com_profile` (
  `com_pid` int(11) NOT NULL,
  `com_name` varchar(50) NOT NULL,
  `com_address` text NOT NULL,
  `com_mobile` varchar(30) NOT NULL,
  `com_email` varchar(50) DEFAULT NULL,
  `com_web` varchar(100) DEFAULT NULL,
  `com_logo` varchar(250) NOT NULL,
  `regby` varchar(20) NOT NULL,
  `regdt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_profile`
--

INSERT INTO `com_profile` (`com_pid`, `com_name`, `com_address`, `com_mobile`, `com_email`, `com_web`, `com_logo`, `regby`, `regdt`) VALUES
(1, 'Bangla Pool', 'House-5, Level-5, Road-20, Sector-13, Uttara, Dhaka-1230', '+88-01780335577', 'banglapool@yahoo.com', 'www.banglapool.com', '/upload/company/5e281bbc5834fLogo.jpg', '18', '2020-01-22 09:54:04');

-- --------------------------------------------------------

--
-- Table structure for table `cost_type`
--

CREATE TABLE `cost_type` (
  `costTypeId` int(11) NOT NULL,
  `costName` varchar(50) DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Active',
  `regby` int(11) DEFAULT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cost_type`
--

INSERT INTO `cost_type` (`costTypeId`, `costName`, `status`, `regby`, `regdate`, `upby`, `update`) VALUES
(1, 'Transport Bill', 'Active', 14, '2020-01-22 09:25:52', NULL, '2020-01-22 09:25:52'),
(2, 'Food Bill', 'Active', 14, '2020-01-22 09:25:57', NULL, '2020-01-22 09:25:57');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` int(11) NOT NULL,
  `customerName` varchar(50) DEFAULT NULL,
  `compname` varchar(50) DEFAULT NULL,
  `company` int(11) NOT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `balance` float DEFAULT NULL,
  `closing_balance` float(10,2) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `regby` int(11) DEFAULT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `customerName`, `compname`, `company`, `mobile`, `email`, `address`, `balance`, `closing_balance`, `status`, `regby`, `regdate`, `upby`, `update`) VALUES
(1, 'Faysal', 'Sunshine IT', 0, '01714044181', 'abcd@gmail.com', 'Dhaka', 0, NULL, 'Active', 14, '2020-01-23 03:40:20', NULL, '2020-01-23 03:40:20'),
(2, 'Hredoy', 'Sunshine IT', 0, '0135574798', 'anbsd@gmail.com', 'Dhaka', 5800, 5000.00, 'Active', 14, '2020-01-23 03:40:51', NULL, '2020-01-23 05:04:28'),
(3, 'Uzzal', 'Sunshine IT', 5, '354654', '', 'Dhaka', 5000, 5000.00, 'Active', 14, '2020-01-23 04:24:59', NULL, '2020-01-23 04:24:59'),
(4, 'Meraj', 'Sunshine IT', 0, '322423', '', 'Dhaka', 5900, NULL, 'Active', 14, '2020-01-23 05:11:23', NULL, '2020-01-23 05:14:09'),
(5, 'Mahbub', 'Sunshine IT', 0, '6465465', '', 'Dhaka', 3300, NULL, 'Active', 14, '2019-01-23 05:33:56', NULL, '2020-01-23 08:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `damages`
--

CREATE TABLE `damages` (
  `pdid` int(11) NOT NULL,
  `damagedate` date NOT NULL,
  `company` int(11) NOT NULL,
  `empid` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `invoice` varchar(20) NOT NULL,
  `totalPrice` float NOT NULL,
  `scharge` varchar(10) DEFAULT NULL,
  `sctype` varchar(5) DEFAULT NULL,
  `scAmount` float DEFAULT NULL,
  `accountType` varchar(15) NOT NULL,
  `accountNo` int(11) NOT NULL,
  `note` varchar(100) DEFAULT NULL,
  `regby` int(11) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `damage_product`
--

CREATE TABLE `damage_product` (
  `dpid` int(11) NOT NULL,
  `pdid` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `salePrice` float NOT NULL,
  `totalPrice` float NOT NULL,
  `regby` int(11) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dpt_id` int(11) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `regby` int(11) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dpt_id`, `dept_name`, `regby`, `regdate`, `upby`, `update`) VALUES
(1, 'Admin', 14, '2020-01-22 09:20:30', NULL, '2020-01-22 09:20:30'),
(2, 'Sales', 14, '2020-01-22 09:20:41', NULL, '2020-01-22 09:20:41');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `desg_id` int(11) NOT NULL,
  `dpt_id` int(11) NOT NULL,
  `desg_name` varchar(50) NOT NULL,
  `regby` int(11) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`desg_id`, `dpt_id`, `desg_name`, `regby`, `regdate`, `upby`, `update`) VALUES
(1, 1, 'Admin', 14, '2020-01-22 09:20:59', NULL, '2020-01-22 09:20:59'),
(2, 2, 'Sales Manager', 14, '2020-01-22 09:21:09', NULL, '2020-01-22 09:21:09');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employeeID` int(11) NOT NULL,
  `dpt_id` int(11) DEFAULT NULL,
  `desg_id` int(11) DEFAULT NULL,
  `employeeName` varchar(50) DEFAULT NULL,
  `company` int(11) NOT NULL,
  `empArea` varchar(50) DEFAULT NULL,
  `empaddress` mediumtext DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `joiningDate` date DEFAULT NULL,
  `salary` float DEFAULT NULL,
  `nid` varchar(20) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `regby` int(11) DEFAULT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employeeID`, `dpt_id`, `desg_id`, `employeeName`, `company`, `empArea`, `empaddress`, `phone`, `email`, `joiningDate`, `salary`, `nid`, `status`, `regby`, `regdate`, `upby`, `update`) VALUES
(1, 0, 0, 'Mr. Rabiul Alam', 5, NULL, 'House-5, Level-5, Road-20, Sector-13, Uttara, Dhaka-1230', '01780335577', 'banglapool@yahoo.com', '2018-01-07', 50000, '250102131321', 'Active', 14, '2020-01-22 09:22:28', 14, '2020-01-22 09:22:42'),
(2, 1, 1, 'Md. Sajedul Islam', 5, NULL, 'Dhaka', '016834709656', 'abc123@gmail.com', '2019-12-17', 10000, '6465432', 'Active', 14, '2020-01-23 03:10:43', NULL, '2020-01-23 03:10:43'),
(3, 2, 2, 'abc', 5, NULL, 'House-5, Level-5, Road-20, Sector-13, Uttara, Dhaka-1230', '01683470965432', '', '2018-01-07', 10000, '', 'Active', 14, '2020-01-23 09:02:47', NULL, '2020-01-23 09:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `employee_payment`
--

CREATE TABLE `employee_payment` (
  `empPid` int(11) NOT NULL,
  `empid` int(11) DEFAULT NULL,
  `company` int(11) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `month` varchar(5) DEFAULT NULL,
  `salary` float DEFAULT NULL,
  `accountType` varchar(50) DEFAULT NULL,
  `accountNo` int(11) DEFAULT NULL,
  `note` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `regby` int(11) DEFAULT NULL,
  `regdate` datetime NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `emp_target`
--

CREATE TABLE `emp_target` (
  `etid` int(11) NOT NULL,
  `empid` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `tamount` float NOT NULL,
  `regby` int(11) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mobileaccount`
--

CREATE TABLE `mobileaccount` (
  `mobileAccountId` int(11) NOT NULL,
  `accountName` varchar(50) DEFAULT NULL,
  `accountNo` int(11) DEFAULT NULL,
  `accountType` varchar(20) DEFAULT NULL,
  `accountOwner` varchar(50) DEFAULT NULL,
  `operatorName` char(50) DEFAULT NULL,
  `balance` float DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `createdDate` datetime DEFAULT current_timestamp(),
  `createdBy` int(11) DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updatedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobileaccount`
--

INSERT INTO `mobileaccount` (`mobileAccountId`, `accountName`, `accountNo`, `accountType`, `accountOwner`, `operatorName`, `balance`, `status`, `createdDate`, `createdBy`, `updatedDate`, `updatedBy`) VALUES
(1, 'Bangla Pool', 2147483647, NULL, 'Banglapool', NULL, 0, 'Active', '2020-01-22 19:29:31', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `packid` int(11) NOT NULL,
  `packdate` date NOT NULL,
  `package_name` varchar(50) NOT NULL,
  `company` int(11) NOT NULL,
  `tquantity` int(11) NOT NULL,
  `tprice` float DEFAULT NULL,
  `sprice` float DEFAULT NULL,
  `note` varchar(100) DEFAULT NULL,
  `regby` int(11) DEFAULT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `package_products`
--

CREATE TABLE `package_products` (
  `packpid` int(11) NOT NULL,
  `packid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `totalPrice` float DEFAULT NULL,
  `regby` int(11) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `pageId` int(11) NOT NULL,
  `pageName` varchar(50) DEFAULT NULL,
  `controllerName` varchar(50) DEFAULT NULL,
  `listViewName` varchar(50) DEFAULT NULL,
  `addViewName` varchar(50) DEFAULT NULL,
  `editViewName` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `createdDate` datetime DEFAULT current_timestamp(),
  `createdBy` int(11) DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updatedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pageId`, `pageName`, `controllerName`, `listViewName`, `addViewName`, `editViewName`, `status`, `createdDate`, `createdBy`, `updatedDate`, `updatedBy`) VALUES
(1, 'Dashboard', 'Home', 'Home', 'Home', 'Home', 'Active', '2019-10-06 16:55:49', 1, NULL, NULL),
(2, 'Products List', 'Product', 'Products List', 'Products List', 'Products List', 'Active', '2019-10-06 16:56:41', 1, NULL, NULL),
(3, 'Add Product', 'Product', 'Add Product', 'Add Product', 'Add Product', 'Active', '2019-10-06 17:02:02', 1, NULL, NULL),
(4, 'Purchase List', 'Purchase', 'Purchase List', 'Purchase List', 'Purchase List', 'Active', '2019-10-06 17:02:34', 1, NULL, NULL),
(5, 'Add Purchase', 'Purchase', 'Add Purchase', 'Add Purchase', 'Add Purchase', 'Active', '2019-10-06 17:02:57', 1, NULL, NULL),
(6, 'Sales List', 'Sale', 'Sales List', 'Sales List', 'Sales List', 'Active', '2019-10-06 17:03:24', 1, '2019-10-29 00:47:04', NULL),
(7, 'Add Sales', 'Sale', 'Add Sales', 'Add Sales', 'Add Sales', 'Active', '2019-10-06 17:03:41', 1, '2019-10-29 00:47:16', NULL),
(8, 'Returns List', 'Returns', 'Returns List', 'Returns List', 'Returns List', 'Active', '2019-10-06 17:10:01', 1, NULL, NULL),
(9, 'Add Return', 'Returns', 'Add Return', 'Add Return', 'Add Return', 'Active', '2019-10-06 17:10:24', 1, NULL, NULL),
(10, 'Quotation List', 'Quotation', 'Quotation List', 'Quotation List', 'Quotation List', 'Active', '2019-10-06 17:11:11', 1, '2019-12-23 21:16:10', NULL),
(11, 'Add Quotation', 'Quotation', 'Add Quotation', 'Add Quotation', 'Add Quotation', 'Active', '2019-10-06 17:11:35', 1, '2019-12-23 21:16:41', NULL),
(12, 'Voucher', 'Voucher', 'Voucher', 'Voucher', 'Voucher', 'Active', '2019-10-06 17:12:02', 1, NULL, NULL),
(13, 'Bank Account', 'Bankaccount', 'Bank Account', 'Bank Account', 'Bank Account', 'Active', '2019-10-06 17:15:41', 1, '2019-12-23 21:17:56', NULL),
(14, 'Cash Account', 'Cashaccount', 'Cash Account', 'Cash Account', 'Cash Account', 'Active', '2019-10-06 17:16:03', 1, '2019-12-23 21:18:00', NULL),
(15, 'Mobile Account', 'MobileAccount', 'Mobile Account', 'Mobile Account', 'Mobile Account', 'Active', '2019-10-06 17:16:24', 1, '2019-12-23 21:18:08', NULL),
(16, 'Employee Payment List', 'Employee_payment', 'Employee Payment List', 'Employee Payment List', 'Employee Payment List', 'Active', '2019-10-06 17:18:21', 1, '2019-12-23 21:24:07', NULL),
(17, 'Add Employee Payment', 'Employee_payment', 'Add Employee Payment', 'Add Employee Payment', 'Add Employee Payment', 'Active', '2019-10-06 17:18:45', 1, '2019-12-23 21:24:12', NULL),
(18, 'Sales Reports', 'Sale', 'Sales Reports', 'Sales Reports', 'Sales Reports', 'Active', '2019-10-06 17:19:16', 1, '2019-12-23 21:24:16', NULL),
(19, 'Voucher Report', 'Voucher', 'Voucher Report', 'Voucher Report', 'Voucher Report', 'Active', '2019-12-23 23:15:28', NULL, '2019-12-23 23:15:53', NULL),
(20, 'Purchase Reports', 'purchase', 'Purchase Reports', 'Purchase Reports', 'Purchase Reports', 'Active', '2019-10-06 17:20:06', 1, '2019-12-23 21:24:23', NULL),
(21, 'Customer Reports', 'Customer', 'Customer Reports', 'Customer Reports', 'Customer Reports', 'Active', '2019-10-06 17:20:28', 1, '2019-12-23 21:24:28', NULL),
(22, 'SalesMan / Employee Report', 'Employee', 'SalesMan / Employee Report', 'SalesMan / Employee Report', 'SalesMan / Employee Report', 'Active', '2019-10-06 17:20:56', 1, '2019-12-23 21:24:32', NULL),
(23, 'Supplier Report', 'Supplier', 'Supplier Report', 'Supplier Report', 'Supplier Report', 'Active', '2019-10-06 17:21:17', 1, '2019-12-23 21:24:39', NULL),
(24, 'Product Stock Report', 'Product', 'Product Stock Report', 'Product Stock Report', 'Product Stock Report', 'Active', '2019-10-06 17:25:28', 1, '2019-12-23 21:24:43', NULL),
(25, 'Company / Warehouse', 'Company', 'Company / Warehouse', 'Company / Warehouse', 'Company / Warehouse', 'Active', '2019-10-06 17:25:52', 1, '2019-12-23 21:24:49', NULL),
(26, 'Supplier', 'Supplier', 'Supplier', 'Supplier', 'Supplier', 'Active', '2019-10-06 17:26:13', 1, '2019-12-23 21:39:00', NULL),
(27, 'Employee', 'Employee', 'Employee', 'Employee', 'Employee', 'Active', '2019-10-06 17:26:38', 1, '2019-12-23 21:39:07', 1),
(28, 'Users', 'User', 'Users', 'Users', 'Users', 'Active', '2019-10-06 17:26:57', 1, '2019-12-23 21:39:14', NULL),
(29, 'Category', 'Category', 'Category', 'Category', 'Category', 'Active', '2019-10-06 17:27:17', 1, '2019-12-23 21:39:19', NULL),
(30, 'Units', 'Category', 'Units', 'Units', 'Units', 'Active', '2019-10-06 17:27:32', 1, '2019-12-23 21:39:23', NULL),
(31, 'Brands', 'Category', 'Brands', 'Brands', 'Brands', 'Active', '2019-10-06 17:27:53', 1, '2019-12-23 21:39:29', NULL),
(32, 'Department', 'Employee', 'Department', 'Department', 'Department', 'Active', '2019-10-06 17:28:21', 1, '2019-12-23 21:39:35', 1),
(33, 'Designation', 'Employee', 'Designation', 'Designation', 'Designation', 'Active', '2019-10-06 17:28:39', 1, '2019-12-23 21:39:41', NULL),
(34, 'Users Role', 'AccessLavels', 'Users Role', 'Users Role', 'Users Role', 'Active', '2019-10-06 17:29:25', 1, '2019-12-23 21:39:47', NULL),
(35, 'Expense Type', 'Cost', 'Expense Type', 'Expense Type', 'Expense Type', 'Active', '2019-10-06 17:30:17', 1, '2019-12-23 21:39:53', NULL),
(36, 'Access Permission', 'AccessPermission', 'Access Permission', 'Access Permission', 'Access Permission', 'Active', '2019-10-06 17:30:49', 1, '2019-12-23 21:40:02', NULL),
(37, 'Company Profile', 'Cost', 'Company Profile', 'Company Profile', 'Company Profile', 'Active', '2019-10-06 17:31:25', 1, '2019-12-23 21:40:09', NULL),
(43, 'Customer', 'Customer', 'Customer', 'Customer', 'Customer', 'Active', '2019-12-23 23:23:52', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page_access_relationship`
--

CREATE TABLE `page_access_relationship` (
  `pageAccessRelationId` int(11) NOT NULL,
  `accessLavel` int(11) DEFAULT NULL,
  `pageId` int(11) DEFAULT NULL,
  `isList` tinyint(4) DEFAULT NULL,
  `isAdd` tinyint(4) DEFAULT NULL,
  `isEdit` tinyint(4) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `createdDate` datetime DEFAULT current_timestamp(),
  `createdBy` int(11) DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updatedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page_access_relationship`
--

INSERT INTO `page_access_relationship` (`pageAccessRelationId`, `accessLavel`, `pageId`, `isList`, `isAdd`, `isEdit`, `status`, `createdDate`, `createdBy`, `updatedDate`, `updatedBy`) VALUES
(1, 1, 1, NULL, NULL, NULL, 'Active', '2019-12-23 22:28:08', NULL, NULL, NULL),
(2, 1, 2, NULL, NULL, NULL, 'Active', '2019-12-23 22:28:11', NULL, NULL, NULL),
(3, 1, 3, NULL, NULL, NULL, 'Active', '2019-12-23 22:28:15', NULL, NULL, NULL),
(4, 1, 4, NULL, NULL, NULL, 'Active', '2019-12-23 22:28:18', NULL, NULL, NULL),
(5, 1, 5, NULL, NULL, NULL, 'Active', '2019-12-23 22:30:17', NULL, NULL, NULL),
(6, 1, 6, NULL, NULL, NULL, 'Active', '2019-12-23 22:30:20', NULL, NULL, NULL),
(7, 1, 7, NULL, NULL, NULL, 'Active', '2019-12-23 22:30:23', NULL, NULL, NULL),
(8, 1, 8, NULL, NULL, NULL, 'Active', '2019-12-23 22:30:25', NULL, NULL, NULL),
(9, 1, 9, NULL, NULL, NULL, 'Active', '2019-12-23 22:30:29', NULL, NULL, NULL),
(10, 1, 10, NULL, NULL, NULL, 'Active', '2019-12-23 22:30:31', NULL, NULL, NULL),
(11, 1, 11, NULL, NULL, NULL, 'Active', '2019-12-23 22:30:34', NULL, NULL, NULL),
(12, 1, 12, NULL, NULL, NULL, 'Active', '2019-12-23 22:30:36', NULL, NULL, NULL),
(13, 1, 13, NULL, NULL, NULL, 'Active', '2019-12-23 22:30:39', NULL, NULL, NULL),
(14, 1, 14, NULL, NULL, NULL, 'Active', '2019-12-23 22:30:42', NULL, NULL, NULL),
(15, 1, 15, NULL, NULL, NULL, 'Active', '2019-12-23 22:30:44', NULL, NULL, NULL),
(16, 1, 16, NULL, NULL, NULL, 'Active', '2019-12-23 22:30:47', NULL, NULL, NULL),
(17, 1, 17, NULL, NULL, NULL, 'Active', '2019-12-23 22:30:49', NULL, NULL, NULL),
(18, 1, 18, NULL, NULL, NULL, 'Active', '2019-12-23 22:30:52', NULL, NULL, NULL),
(19, 1, 19, NULL, NULL, 0, 'Active', '2019-12-23 23:17:29', NULL, '2019-12-23 23:17:46', NULL),
(20, 1, 20, NULL, NULL, NULL, 'Active', '2019-12-23 22:30:57', NULL, NULL, NULL),
(21, 1, 21, NULL, NULL, NULL, 'Active', '2019-12-23 22:30:59', NULL, NULL, NULL),
(22, 1, 22, NULL, NULL, NULL, 'Active', '2019-12-23 22:31:03', NULL, NULL, NULL),
(23, 1, 23, NULL, NULL, NULL, 'Active', '2019-12-23 22:31:06', NULL, NULL, NULL),
(24, 1, 24, NULL, NULL, NULL, 'Active', '2019-12-23 22:31:08', NULL, NULL, NULL),
(25, 1, 25, NULL, NULL, NULL, 'Active', '2019-12-23 22:31:11', NULL, NULL, NULL),
(26, 1, 26, NULL, NULL, NULL, 'Active', '2019-12-23 22:31:13', NULL, NULL, NULL),
(27, 1, 27, NULL, NULL, NULL, 'Active', '2019-12-23 22:31:15', NULL, NULL, NULL),
(28, 1, 28, NULL, NULL, NULL, 'Active', '2019-12-23 22:31:21', NULL, NULL, NULL),
(29, 1, 29, NULL, NULL, NULL, 'Active', '2019-12-23 22:31:24', NULL, NULL, NULL),
(30, 1, 30, NULL, NULL, NULL, 'Active', '2019-12-23 22:31:27', NULL, NULL, NULL),
(31, 1, 31, NULL, NULL, NULL, 'Active', '2019-12-23 22:31:29', NULL, NULL, NULL),
(32, 1, 32, NULL, NULL, NULL, 'Active', '2019-12-23 22:31:31', NULL, NULL, NULL),
(33, 1, 33, NULL, NULL, NULL, 'Active', '2019-12-23 22:31:34', NULL, NULL, NULL),
(34, 1, 34, NULL, NULL, NULL, 'Active', '2019-12-23 22:31:36', NULL, NULL, NULL),
(35, 1, 35, NULL, NULL, NULL, 'Active', '2019-12-23 22:31:38', NULL, NULL, NULL),
(36, 1, 36, NULL, NULL, NULL, 'Active', '2019-12-23 22:31:41', NULL, NULL, NULL),
(37, 1, 37, NULL, NULL, NULL, 'Active', '2019-12-23 22:31:44', NULL, NULL, NULL),
(39, 1, 43, NULL, NULL, NULL, 'Active', '2019-12-23 23:24:21', NULL, NULL, NULL),
(40, 5, 1, NULL, NULL, NULL, 'Active', '2020-01-08 21:48:04', NULL, NULL, NULL),
(41, 5, 4, NULL, NULL, NULL, 'Active', '2020-01-08 21:48:25', NULL, NULL, NULL),
(42, 6, 1, NULL, NULL, NULL, 'Active', '2020-01-23 01:04:22', NULL, NULL, NULL),
(43, 6, 7, NULL, NULL, NULL, 'Active', '2020-01-23 01:04:39', NULL, NULL, NULL),
(44, 6, 6, NULL, NULL, NULL, 'Active', '2020-01-23 01:05:59', NULL, NULL, NULL),
(45, 6, 18, NULL, NULL, NULL, 'Active', '2020-01-23 01:06:57', NULL, NULL, NULL),
(46, 6, 15, NULL, NULL, NULL, 'Active', '2020-01-23 01:09:14', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` bigint(20) NOT NULL,
  `productName` varchar(100) DEFAULT NULL,
  `productcode` varchar(20) DEFAULT NULL,
  `categoryID` int(11) DEFAULT NULL,
  `brand` int(11) DEFAULT NULL,
  `units` int(11) DEFAULT NULL,
  `warranty` varchar(50) DEFAULT NULL,
  `pprice` float DEFAULT NULL,
  `sprice` float DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `regby` int(11) DEFAULT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `productcode`, `categoryID`, `brand`, `units`, `warranty`, `pprice`, `sprice`, `image`, `regby`, `regdate`, `upby`, `update`) VALUES
(1, 'Test 1', '01', 1, 1, 1, '365 days', 50, 100, 'Test5.jpg', 14, '2020-01-22 09:27:47', 14, '2020-01-22 09:27:56'),
(2, 'Test 2', '02', 2, 2, 2, '365 Days', 50, 100, 'Test6.jpg', 14, '2020-01-22 09:28:54', NULL, '2020-01-22 09:28:54');

-- --------------------------------------------------------

--
-- Table structure for table `product_brands`
--

CREATE TABLE `product_brands` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `regby` int(11) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_brands`
--

INSERT INTO `product_brands` (`id`, `name`, `status`, `regby`, `regdate`, `upby`, `update`) VALUES
(1, 'Square', 'Active', 14, '2020-01-22 09:27:23', NULL, '2020-01-22 09:27:23'),
(2, 'Beximco', 'Active', 14, '2020-01-22 09:28:33', NULL, '2020-01-22 09:28:33');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `productId` int(11) DEFAULT NULL,
  `categoryId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchaseID` int(11) NOT NULL,
  `purchaseDate` date DEFAULT NULL,
  `challanNo` varchar(20) DEFAULT NULL,
  `supplier` int(10) DEFAULT NULL,
  `company` int(11) DEFAULT NULL,
  `totalPrice` float DEFAULT NULL,
  `paidAmount` float DEFAULT NULL,
  `discount` varchar(20) DEFAULT NULL,
  `discountType` varchar(5) DEFAULT NULL,
  `discountAmount` float DEFAULT NULL,
  `accountType` varchar(15) DEFAULT NULL,
  `accountNo` int(11) DEFAULT NULL,
  `note` varchar(100) DEFAULT NULL,
  `regby` int(11) DEFAULT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchaseID`, `purchaseDate`, `challanNo`, `supplier`, `company`, `totalPrice`, `paidAmount`, `discount`, `discountType`, `discountAmount`, `accountType`, `accountNo`, `note`, `regby`, `regdate`, `upby`, `update`) VALUES
(1, '2020-01-23', 'Challan 001', 2, 5, 20000, 20000, NULL, NULL, NULL, 'Cash', 1, 'Test by Sunshine IT', 14, '2020-01-23 03:30:41', NULL, '2020-01-23 03:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_product`
--

CREATE TABLE `purchase_product` (
  `purchaseProuctID` int(11) NOT NULL,
  `purchaseID` int(11) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `pprice` float DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `totalPrice` float DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `createdDate` datetime DEFAULT current_timestamp(),
  `createdBy` int(11) DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updatedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_product`
--

INSERT INTO `purchase_product` (`purchaseProuctID`, `purchaseID`, `productID`, `pprice`, `quantity`, `totalPrice`, `status`, `createdDate`, `createdBy`, `updatedDate`, `updatedBy`) VALUES
(1, 1, 1, 50, 200, 10000, NULL, '2020-01-22 19:30:41', 14, NULL, NULL),
(2, 1, 2, 50, 200, 10000, NULL, '2020-01-22 19:30:41', 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `qutid` int(11) NOT NULL,
  `quotationDate` date NOT NULL,
  `customerID` int(11) NOT NULL,
  `totalPrice` float NOT NULL,
  `totalQuantity` varchar(20) NOT NULL,
  `note` text DEFAULT NULL,
  `regby` int(11) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`qutid`, `quotationDate`, `customerID`, `totalPrice`, `totalQuantity`, `note`, `regby`, `regdate`, `upby`, `update`) VALUES
(1, '2020-01-23', 5, 10000, '100', 'Test by Sunshine IT', 14, '2020-01-23 09:34:40', NULL, '2020-01-23 09:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_product`
--

CREATE TABLE `quotation_product` (
  `qutpid` int(11) NOT NULL,
  `qutid` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `salePrice` float NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `totalPrice` float NOT NULL,
  `regby` int(11) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_product`
--

INSERT INTO `quotation_product` (`qutpid`, `qutid`, `productID`, `salePrice`, `quantity`, `totalPrice`, `regby`, `regdate`, `upby`, `update`) VALUES
(1, 1, 1, 100, '100', 10000, 14, '2020-01-23 09:34:40', NULL, '2020-01-23 09:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `returnId` int(11) NOT NULL,
  `returnDate` date DEFAULT NULL,
  `company` int(11) DEFAULT NULL,
  `customerID` int(11) NOT NULL,
  `invoice` varchar(20) NOT NULL,
  `empid` int(11) NOT NULL,
  `totalPrice` float NOT NULL,
  `scharge` varchar(15) NOT NULL,
  `sctype` varchar(5) NOT NULL,
  `scAmount` float DEFAULT NULL,
  `accountType` varchar(20) DEFAULT NULL,
  `accountNo` int(11) DEFAULT NULL,
  `note` varchar(100) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  `regby` int(11) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`returnId`, `returnDate`, `company`, `customerID`, `invoice`, `empid`, `totalPrice`, `scharge`, `sctype`, `scAmount`, `accountType`, `accountNo`, `note`, `status`, `regby`, `regdate`, `upby`, `update`) VALUES
(1, '2020-01-23', 5, 5, '3', 1, 100, '0', '', 0, 'Mobile', 1, 'Test by Sunshine IT', 'Active', 14, '2020-01-23 06:28:31', NULL, '2020-01-23 06:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `returns_product`
--

CREATE TABLE `returns_product` (
  `rp_id` int(11) NOT NULL,
  `rt_id` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `rtype` varchar(20) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `salePrice` float NOT NULL,
  `totalPrice` float NOT NULL,
  `regby` int(11) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `returns_product`
--

INSERT INTO `returns_product` (`rp_id`, `rt_id`, `productID`, `rtype`, `quantity`, `salePrice`, `totalPrice`, `regby`, `regdate`, `upby`, `update`) VALUES
(1, 1, 1, NULL, 1, 100, 100, 14, '2020-01-23 06:28:31', NULL, '2020-01-23 06:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `saleID` int(11) NOT NULL,
  `saleDate` date DEFAULT NULL,
  `company` int(11) DEFAULT NULL,
  `empid` int(11) DEFAULT NULL,
  `customerID` int(11) DEFAULT NULL,
  `totalAmount` float DEFAULT NULL,
  `paidAmount` float DEFAULT NULL,
  `discount` varchar(20) DEFAULT NULL,
  `discountType` varchar(5) DEFAULT NULL,
  `discountAmount` float DEFAULT NULL,
  `accountType` varchar(50) DEFAULT NULL,
  `accountNo` varchar(50) DEFAULT NULL,
  `note` mediumtext DEFAULT NULL,
  `regby` int(11) DEFAULT NULL,
  `regdate` datetime DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`saleID`, `saleDate`, `company`, `empid`, `customerID`, `totalAmount`, `paidAmount`, `discount`, `discountType`, `discountAmount`, `accountType`, `accountNo`, `note`, `regby`, `regdate`, `upby`, `update`) VALUES
(1, '2020-01-23', 5, 1, 4, 1800, 800, '200', '', 200, 'Mobile', '1', '', 14, '2020-01-22 21:12:18', NULL, '2020-01-22 21:12:18'),
(2, '2019-01-23', 5, 1, 5, 2000, 800, '10', '%', 200, 'Mobile', '1', '', 14, '2020-01-22 21:34:21', NULL, '2020-01-22 22:04:22'),
(3, '2020-01-23', 5, 1, 5, 2000, 800, '200', '', 200, 'Mobile', '1', '', 14, '2020-01-22 22:12:36', NULL, '2020-01-22 22:12:36'),
(4, '2020-01-23', 5, 1, 5, 100, 0, '0', '', 0, 'Mobile', '1', '', 14, '2020-01-22 23:39:56', NULL, '2020-01-22 23:39:56'),
(5, '2020-01-23', 5, 1, 5, 100, 0, '0', '', 0, 'Mobile', '1', '', 14, '2020-01-22 23:42:11', NULL, '2020-01-22 23:42:11'),
(6, '2020-01-23', 5, 1, 5, 400, 100, '0', '', 0, 'Bank', '1', '', 14, '2020-01-23 00:57:33', NULL, '2020-01-23 00:57:33'),
(7, '2020-01-23', 5, 3, 5, 2500, 2500, '0', '', 0, 'Mobile', '1', '', 19, '2020-01-23 02:42:39', NULL, '2020-01-23 02:42:39'),
(8, '2020-01-23', 5, 3, 5, 1000, 1000, '0', '', 0, 'Bank', '1', '', 19, '2020-01-23 02:44:55', NULL, '2020-01-23 02:44:55');

-- --------------------------------------------------------

--
-- Table structure for table `sale_product`
--

CREATE TABLE `sale_product` (
  `saleProductID` int(11) NOT NULL,
  `saleID` int(11) DEFAULT NULL,
  `ptype` varchar(15) NOT NULL,
  `productID` int(11) DEFAULT NULL,
  `packsize` varchar(50) DEFAULT NULL,
  `sprice` float DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `squantity` float DEFAULT NULL,
  `bquantity` float DEFAULT NULL,
  `totalPrice` float DEFAULT NULL,
  `bonusAmount` float DEFAULT NULL,
  `createdDate` datetime DEFAULT current_timestamp(),
  `createdBy` int(11) DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_product`
--

INSERT INTO `sale_product` (`saleProductID`, `saleID`, `ptype`, `productID`, `packsize`, `sprice`, `quantity`, `squantity`, `bquantity`, `totalPrice`, `bonusAmount`, `createdDate`, `createdBy`, `updatedBy`, `updatedDate`) VALUES
(1, 1, '', 1, '100 ml', 100, 15, 10, 5, 1000, 500, '2020-01-22 21:12:18', 14, NULL, NULL),
(2, 1, '', 2, '500 ml', 100, 15, 10, 5, 1000, 500, '2020-01-22 21:12:18', 14, NULL, NULL),
(3, 2, '', 1, '', 100, 15, 10, 5, 1000, 500, '2020-01-22 21:34:21', 14, NULL, NULL),
(4, 2, '', 2, '', 100, 15, 10, 5, 1000, 500, '2020-01-22 21:34:21', 14, NULL, NULL),
(5, 3, '', 1, '', 100, 10, 10, 0, 1000, 0, '2020-01-22 22:12:36', 14, NULL, NULL),
(6, 3, '', 2, '', 100, 10, 10, 0, 1000, 0, '2020-01-22 22:12:36', 14, NULL, NULL),
(7, 4, '', 1, '', 100, 1, 1, 0, 100, 0, '2020-01-22 23:39:56', 14, NULL, NULL),
(8, 5, '', 2, '', 100, 1, 1, 0, 100, 0, '2020-01-22 23:42:11', 14, NULL, NULL),
(9, 6, '', 1, '', 100, 4, 4, 0, 400, 0, '2020-01-23 00:57:33', 14, NULL, NULL),
(10, 7, '', 1, '', 100, 15, 15, 0, 1500, 0, '2020-01-23 02:42:39', 19, NULL, NULL),
(11, 7, '', 2, '', 100, 10, 10, 0, 1000, 0, '2020-01-23 02:42:39', 19, NULL, NULL),
(12, 8, '', 2, '', 100, 10, 10, 0, 1000, 0, '2020-01-23 02:44:55', 19, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sma_units`
--

CREATE TABLE `sma_units` (
  `id` int(11) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(55) NOT NULL,
  `status` varchar(20) DEFAULT 'Active',
  `regby` int(11) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_units`
--

INSERT INTO `sma_units` (`id`, `code`, `name`, `status`, `regby`, `regdate`, `upby`, `update`) VALUES
(1, 'Pcs', 'Pcs', 'Active', 14, '2020-01-22 09:27:33', NULL, '2020-01-22 09:27:33'),
(2, 'Kg', 'Kg', 'Active', 14, '2020-01-22 09:28:43', NULL, '2020-01-22 09:28:43');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stockID` int(11) NOT NULL,
  `company` int(11) DEFAULT NULL,
  `product` int(11) DEFAULT NULL,
  `chalanNo` varchar(20) DEFAULT NULL,
  `totalPices` float DEFAULT NULL,
  `status` varchar(15) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stockID`, `company`, `product`, `chalanNo`, `totalPices`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(11, 5, 1, 'S001', -29, 'Active', 19, '2020-01-23 10:42:39', NULL, '2020-01-23 02:42:39'),
(13, 5, 2, 'S001', -31, 'Active', 19, '2020-01-23 10:44:55', NULL, '2020-01-23 02:44:55');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplierID` int(11) NOT NULL,
  `supplierName` varchar(50) DEFAULT NULL,
  `compname` varchar(100) DEFAULT NULL,
  `company` int(11) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `balance` float DEFAULT NULL,
  `regby` int(11) DEFAULT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplierID`, `supplierName`, `compname`, `company`, `mobile`, `email`, `address`, `balance`, `regby`, `regdate`, `upby`, `update`) VALUES
(1, 'Square', 'Square', NULL, '34234', '', 'Pabna', 50000, 14, '2020-01-22 09:30:37', NULL, '2020-01-22 09:30:37'),
(2, 'Beximco', 'Beximco', NULL, '01546855', '', 'Dhaka', 0, 14, '2020-01-23 03:30:37', NULL, '2020-01-23 03:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `empid` int(11) DEFAULT NULL,
  `user_name` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(50) NOT NULL DEFAULT '0',
  `role` varchar(50) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `regby` int(11) DEFAULT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `empid`, `user_name`, `password`, `role`, `status`, `regby`, `regdate`, `upby`, `update`) VALUES
(14, 1, 'admin', '1234', '1', 'Active', 0, '0000-00-00 00:00:00', 1, '2020-01-07 08:40:45'),
(16, 2, 'b', 'b', '5', 'Active', 14, '2020-01-09 05:47:40', NULL, '2020-01-09 05:47:40'),
(18, 5, 'banglapool', '1234', '1', 'Active', 14, '2020-01-20 11:26:32', NULL, '2020-01-20 11:26:32'),
(19, 3, 'a', 'a', '6', 'Active', 14, '2020-01-23 09:03:24', NULL, '2020-01-23 09:03:24');

-- --------------------------------------------------------

--
-- Table structure for table `vaucher`
--

CREATE TABLE `vaucher` (
  `vuid` int(11) NOT NULL,
  `voucherdate` date NOT NULL,
  `company` int(11) DEFAULT NULL,
  `customerID` int(11) DEFAULT NULL,
  `invoice` varchar(20) DEFAULT NULL,
  `employee` int(11) DEFAULT NULL,
  `costType` int(11) DEFAULT NULL,
  `supplier` int(11) DEFAULT NULL,
  `vauchertype` varchar(20) NOT NULL,
  `totalamount` float DEFAULT NULL,
  `accountType` varchar(11) DEFAULT NULL,
  `accountNo` int(11) DEFAULT NULL,
  `regby` int(11) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vaucher`
--

INSERT INTO `vaucher` (`vuid`, `voucherdate`, `company`, `customerID`, `invoice`, `employee`, `costType`, `supplier`, `vauchertype`, `totalamount`, `accountType`, `accountNo`, `regby`, `regdate`, `upby`, `update`) VALUES
(1, '2020-01-23', 5, 4, '1', 0, 0, 0, 'Credit Voucher', 100, 'Mobile', 1, 14, '2020-01-23 05:14:09', NULL, '2020-01-23 05:14:09'),
(2, '2020-01-23', 5, 5, '2', 0, 0, 0, 'Credit Voucher', 100, 'Mobile', 1, 14, '2020-01-23 05:34:53', NULL, '2020-01-23 05:34:53'),
(3, '2020-01-23', 5, 5, '', 0, 0, 0, 'Customer Pay', 4000, 'Bank', 1, 14, '2020-01-23 08:52:27', NULL, '2020-01-23 08:52:27'),
(4, '2020-01-23', 5, 0, '', 1, 1, 0, 'Debit Voucher', 100, 'Bank', 1, 14, '2020-01-23 09:01:04', NULL, '2020-01-23 09:01:04');

-- --------------------------------------------------------

--
-- Table structure for table `vaucher_particular`
--

CREATE TABLE `vaucher_particular` (
  `vpid` int(11) NOT NULL,
  `vuid` int(11) NOT NULL,
  `particulars` varchar(100) NOT NULL,
  `amount` float NOT NULL,
  `regby` int(11) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `upby` int(11) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vaucher_particular`
--

INSERT INTO `vaucher_particular` (`vpid`, `vuid`, `particulars`, `amount`, `regby`, `regdate`, `upby`, `update`) VALUES
(1, 1, 'Due', 100, 14, '2020-01-23 05:14:09', NULL, '2020-01-23 05:14:09'),
(2, 2, 'Due', 100, 14, '2020-01-23 05:34:53', NULL, '2020-01-23 05:34:53'),
(3, 3, 'Due', 4000, 14, '2020-01-23 08:52:27', NULL, '2020-01-23 08:52:27'),
(4, 4, 'Due', 100, 14, '2020-01-23 09:01:04', NULL, '2020-01-23 09:01:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_lavels`
--
ALTER TABLE `access_lavels`
  ADD PRIMARY KEY (`accessLavelId`);

--
-- Indexes for table `bankaccount`
--
ALTER TABLE `bankaccount`
  ADD PRIMARY KEY (`bankAccountId`);

--
-- Indexes for table `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`cashId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`),
  ADD UNIQUE KEY `category_id` (`categoryID`);

--
-- Indexes for table `companys`
--
ALTER TABLE `companys`
  ADD PRIMARY KEY (`companyID`);

--
-- Indexes for table `com_profile`
--
ALTER TABLE `com_profile`
  ADD PRIMARY KEY (`com_pid`);

--
-- Indexes for table `cost_type`
--
ALTER TABLE `cost_type`
  ADD PRIMARY KEY (`costTypeId`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `damages`
--
ALTER TABLE `damages`
  ADD PRIMARY KEY (`pdid`);

--
-- Indexes for table `damage_product`
--
ALTER TABLE `damage_product`
  ADD PRIMARY KEY (`dpid`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dpt_id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`desg_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employeeID`);

--
-- Indexes for table `employee_payment`
--
ALTER TABLE `employee_payment`
  ADD PRIMARY KEY (`empPid`);

--
-- Indexes for table `emp_target`
--
ALTER TABLE `emp_target`
  ADD PRIMARY KEY (`etid`);

--
-- Indexes for table `mobileaccount`
--
ALTER TABLE `mobileaccount`
  ADD PRIMARY KEY (`mobileAccountId`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`packid`);

--
-- Indexes for table `package_products`
--
ALTER TABLE `package_products`
  ADD PRIMARY KEY (`packpid`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`pageId`);

--
-- Indexes for table `page_access_relationship`
--
ALTER TABLE `page_access_relationship`
  ADD PRIMARY KEY (`pageAccessRelationId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `product_brands`
--
ALTER TABLE `product_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD KEY `Index 1` (`productId`,`categoryId`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchaseID`);

--
-- Indexes for table `purchase_product`
--
ALTER TABLE `purchase_product`
  ADD PRIMARY KEY (`purchaseProuctID`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`qutid`);

--
-- Indexes for table `quotation_product`
--
ALTER TABLE `quotation_product`
  ADD PRIMARY KEY (`qutpid`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`returnId`),
  ADD KEY `FK_damage_product` (`customerID`);

--
-- Indexes for table `returns_product`
--
ALTER TABLE `returns_product`
  ADD PRIMARY KEY (`rp_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`saleID`);

--
-- Indexes for table `sale_product`
--
ALTER TABLE `sale_product`
  ADD PRIMARY KEY (`saleProductID`);

--
-- Indexes for table `sma_units`
--
ALTER TABLE `sma_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stockID`),
  ADD KEY `Index 2` (`product`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplierID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vaucher`
--
ALTER TABLE `vaucher`
  ADD PRIMARY KEY (`vuid`);

--
-- Indexes for table `vaucher_particular`
--
ALTER TABLE `vaucher_particular`
  ADD PRIMARY KEY (`vpid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_lavels`
--
ALTER TABLE `access_lavels`
  MODIFY `accessLavelId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bankaccount`
--
ALTER TABLE `bankaccount`
  MODIFY `bankAccountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cash`
--
ALTER TABLE `cash`
  MODIFY `cashId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `companys`
--
ALTER TABLE `companys`
  MODIFY `companyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `com_profile`
--
ALTER TABLE `com_profile`
  MODIFY `com_pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cost_type`
--
ALTER TABLE `cost_type`
  MODIFY `costTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `damages`
--
ALTER TABLE `damages`
  MODIFY `pdid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `damage_product`
--
ALTER TABLE `damage_product`
  MODIFY `dpid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dpt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `desg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee_payment`
--
ALTER TABLE `employee_payment`
  MODIFY `empPid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_target`
--
ALTER TABLE `emp_target`
  MODIFY `etid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mobileaccount`
--
ALTER TABLE `mobileaccount`
  MODIFY `mobileAccountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `packid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package_products`
--
ALTER TABLE `package_products`
  MODIFY `packpid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `page_access_relationship`
--
ALTER TABLE `page_access_relationship`
  MODIFY `pageAccessRelationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_brands`
--
ALTER TABLE `product_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_product`
--
ALTER TABLE `purchase_product`
  MODIFY `purchaseProuctID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `qutid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quotation_product`
--
ALTER TABLE `quotation_product`
  MODIFY `qutpid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `returnId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `returns_product`
--
ALTER TABLE `returns_product`
  MODIFY `rp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `saleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sale_product`
--
ALTER TABLE `sale_product`
  MODIFY `saleProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sma_units`
--
ALTER TABLE `sma_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `vaucher`
--
ALTER TABLE `vaucher`
  MODIFY `vuid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vaucher_particular`
--
ALTER TABLE `vaucher_particular`
  MODIFY `vpid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
