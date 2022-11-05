-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2022 at 07:34 PM
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
-- Database: `silverknight_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `BrandID` int(11) NOT NULL,
  `BName` varchar(100) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`BrandID`, `BName`, `Description`) VALUES
(2, 'Nike', 'Something Something'),
(3, 'Unknown', 'None'),
(5, 'LV', 'blah'),
(6, 'New Brand', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CName` varchar(100) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CName`, `Description`) VALUES
(2, 'Shoes', 'Non'),
(3, 'Unknown', 'None'),
(5, 'T-Shirt', 'blah'),
(6, 'New Category', 'blah blah'),
(7, 'Shorts', 'None None None'),
(8, 'Hat', 'Non Non');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Address` text NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `ProfileImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `FirstName`, `LastName`, `Address`, `PhoneNumber`, `Email`, `Password`, `ProfileImage`) VALUES
(3, 'Rick', 'Sanchez', '......', '0987685678', 'rick666@gmail.com', '123456789', 'CustomerImage/_KayWvvaF_400x400.jpg'),
(4, 'Marc', 'Spector', 'none none none', '0922738476', 'marc666@gmail.com', '123456789', 'CustomerImage/_FB_IMG_1545578284505.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `DeliveryID` int(11) NOT NULL,
  `Township` varchar(100) NOT NULL,
  `Cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`DeliveryID`, `Township`, `Cost`) VALUES
(1, 'La Thar', 2000),
(2, 'Lan Ma Daw', 1500),
(4, 'Sue Lay', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `OrderID` varchar(50) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`OrderID`, `ProductID`, `Price`, `Quantity`) VALUES
('ORD-000001', 5, 12000, 2),
('ORD-000001', 7, 15000, 1),
('ORD-000002', 4, 25000, 1),
('ORD-000003', 6, 22000, 5),
('ORD-000004', 5, 12000, 1),
('ORD-000004', 4, 25000, 1),
('ORD-000004', 7, 15000, 1),
('ORD-000005', 8, 10000, 2),
('ORD-000005', 5, 12000, 1),
('ORD-000006', 7, 15000, 1),
('ORD-000007', 7, 15000, 2),
('ORD-000007', 4, 25000, 4),
('ORD-000008', 6, 22000, 2),
('ORD-000008', 7, 15000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` varchar(50) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `Date` varchar(12) NOT NULL,
  `Location` varchar(200) NOT NULL,
  `Contact` varchar(15) NOT NULL,
  `TotalQuantity` int(11) NOT NULL,
  `TotalAmount` int(11) NOT NULL,
  `Tax` decimal(10,0) NOT NULL,
  `DeliveryCost` int(11) NOT NULL,
  `GrandTotal` decimal(10,0) NOT NULL,
  `PaymentType` varchar(50) NOT NULL,
  `OrderStatus` varchar(50) NOT NULL,
  `PaymentStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CustomerID`, `Date`, `Location`, `Contact`, `TotalQuantity`, `TotalAmount`, `Tax`, `DeliveryCost`, `GrandTotal`, `PaymentType`, `OrderStatus`, `PaymentStatus`) VALUES
('ORD-000001', 3, '02-May-2022', 'blah blah blah', '0987685678', 3, 39000, '1950', 2000, '42950', 'KBZPay', 'Confirmed', 'Recieved'),
('ORD-000002', 3, '02-May-2022', 'blah blah blah', '0987685678', 1, 25000, '1250', 2000, '28250', 'WAVEmoney', 'Pending', 'Pending'),
('ORD-000003', 4, '02-May-2022', 'none none none', '0922738476', 5, 110000, '5500', 1500, '117000', 'COD', 'Pending', 'Recieved'),
('ORD-000004', 4, '02-May-2022', 'none none none', '0922738476', 3, 52000, '2600', 1500, '56100', 'KBZPay', 'Denied', 'Denied Order'),
('ORD-000005', 3, '02-May-2022', 'blah blah blah', '0987685678', 3, 32000, '1600', 2000, '35600', 'KBZPay', 'Confirmed', 'Pending'),
('ORD-000006', 3, '06-May-2022', '......', '0987685678', 1, 15000, '750', 2000, '17750', 'COD', 'Pending', 'Pending'),
('ORD-000007', 3, '06-May-2022', '......', '0987685678', 6, 130000, '6500', 1500, '138000', 'KBZPay', 'Confirmed', 'Pending'),
('ORD-000008', 3, '06-May-2022', '......', '0987685678', 4, 74000, '3700', 2000, '79700', 'WAVEmoney', 'Confirmed', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `BrandID` int(11) NOT NULL,
  `Color` varchar(50) NOT NULL,
  `Size` varchar(50) NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `Image1` varchar(255) NOT NULL,
  `Image2` varchar(255) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `Name`, `CategoryID`, `BrandID`, `Color`, `Size`, `Price`, `Quantity`, `Status`, `Image1`, `Image2`, `Description`) VALUES
(4, 'Casual Tide Shoes Canvas Sneakers', 2, 3, 'Black & White', 'Medium', 25000, 10, 'In Stock', 'ProductImage/_478.PNG', 'ProductImage/_12253.PNG', 'B&W Sneakers'),
(5, 'Outdoor Sports Quick-drying Tactics T-shirt', 5, 6, 'Black', 'Large', 12000, 12, 'In Stock', 'ProductImage/_2375.PNG', 'ProductImage/_2356.PNG', 'Black T-shirt'),
(6, 'Cross Printed Casual Tactical Shorts', 7, 6, 'Army Green', 'Medium', 22000, 10, 'In Stock', 'ProductImage/_45677.PNG', 'ProductImage/_45878.PNG', 'Army green colored shorts'),
(7, 'Pure Color Plus Velvet Knit Hat', 8, 6, 'Gray', 'Free', 15000, 12, 'In Stock', 'ProductImage/_125543.PNG', 'ProductImage/_12543.PNG', 'Gray hat'),
(8, 'New Product 111', 6, 6, 'Black & White', 'Medium', 10000, 10, 'In Stock', 'ProductImage/_3076836.jpg', 'ProductImage/_3497712.jpg', '.....');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder`
--

CREATE TABLE `purchaseorder` (
  `PurchaseOrderID` varchar(15) NOT NULL,
  `SupplierID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `Date` varchar(15) NOT NULL,
  `TotalQuantity` int(11) NOT NULL,
  `TotalAmount` int(11) NOT NULL,
  `Tax` decimal(10,0) NOT NULL,
  `GrandTotal` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchaseorder`
--

INSERT INTO `purchaseorder` (`PurchaseOrderID`, `SupplierID`, `StaffID`, `Date`, `TotalQuantity`, `TotalAmount`, `Tax`, `GrandTotal`) VALUES
('PUR-000001', 6, 6, '02-May-2022', 22, 200000, '10000', '210000'),
('PUR-000002', 4, 6, '02-May-2022', 22, 288000, '14400', '302400'),
('PUR-000003', 6, 6, '06-May-2022', 5, 50000, '2500', '52500');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorderdetail`
--

CREATE TABLE `purchaseorderdetail` (
  `PurchaseOrderID` varchar(15) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `PurchasePrice` int(11) NOT NULL,
  `PurchaseQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchaseorderdetail`
--

INSERT INTO `purchaseorderdetail` (`PurchaseOrderID`, `ProductID`, `PurchasePrice`, `PurchaseQuantity`) VALUES
('PUR-000001', 4, 8000, 10),
('PUR-000001', 7, 10000, 12),
('PUR-000002', 5, 9000, 12),
('PUR-000002', 6, 18000, 10),
('PUR-000003', 5, 10000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PhoneNumber` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `Name`, `Role`, `Password`, `Email`, `PhoneNumber`) VALUES
(6, 'Ishigami', 'Web Administrator', '1234567', 'ishigami666@gmail.com', '09123456'),
(8, 'Lex', 'Customer Service Provider', '1234567', 'lex666@gmail.com', '0976856745'),
(9, 'John', 'Marketing Manager', '1234567', 'john666@gmail.com', '0967854673'),
(10, 'Marley', 'Warehouse Manager', '1234567', 'marley666@gmail.com', '0946783456');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SupplierID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `OrgAddress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierID`, `Name`, `Email`, `PhoneNumber`, `OrgAddress`) VALUES
(4, 'Marry', 'marry666@gmail.com', '09384798475', 'buliding no., street name, township name, city name'),
(5, 'Unknown', 'unknown666@gmail.com', '09000000000', 'Unknown, unknown, unknown'),
(6, 'Jake', 'jake666@gmail.com', '098768334856', 'Sue Lay Township');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`BrandID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`DeliveryID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `purchaseorder`
--
ALTER TABLE `purchaseorder`
  ADD PRIMARY KEY (`PurchaseOrderID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SupplierID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `BrandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `DeliveryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `SupplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
