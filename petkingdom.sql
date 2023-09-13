-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2022 at 07:22 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petkingdom`
--

-- --------------------------------------------------------

--
-- Table structure for table `datauser`
--

CREATE TABLE `datauser` (
  `userid` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `namalengkap` varchar(200) NOT NULL,
  `notlp` int(15) NOT NULL,
  `alamat` text NOT NULL,
  `level` enum('Customer','Admin') NOT NULL DEFAULT 'Customer',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `datauser`
--

INSERT INTO `datauser` (`userid`, `email`, `password`, `namalengkap`, `notlp`, `alamat`, `level`, `created`) VALUES
(1, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 123, 'Admin', 'Admin', '2022-06-15 05:20:32'),
(2, 'john@gmail.com', 'db4a25f7f6ffec7762efcb8608f9d0b5', 'Johnny', 12344, 'jl imam bonjol', 'Customer', '2022-06-15 05:20:32');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL,
  `namakategori` varchar(50) NOT NULL,
  `icon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `namakategori`, `icon`) VALUES
(1, 'Anjing', 'Kategori/15-06-2022-doggo.gif'),
(2, 'Kucing', 'Kategori/15-06-2022-catto.gif'),
(3, 'Kelinci', 'Kategori/15-06-2022-bunny.gif'),
(7, 'Hamster', 'Kategori/15-06-2022-hamster.gif');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_service`
--

CREATE TABLE `kategori_service` (
  `idkategoriserv` int(11) NOT NULL,
  `namakategoriserv` varchar(50) NOT NULL,
  `icon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_service`
--

INSERT INTO `kategori_service` (`idkategoriserv`, `namakategoriserv`, `icon`) VALUES
(1, 'Grooming', 'Kategoriserv/15-06-2022-grooming.gif'),
(2, 'Pet Clinic', 'Kategoriserv/15-06-2022-vet.gif'),
(3, 'Pet Hotel', 'Kategoriserv/15-06-2022-hotel.gif'),
(4, 'Pet Sitter', 'Kategoriserv/15-06-2022-sitter.gif');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `idproduk` int(11) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `namaproduk` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `harga` int(15) NOT NULL,
  `availability` enum('In Stock','Sold Out') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idproduk`, `idkategori`, `namaproduk`, `gambar`, `deskripsi`, `harga`, `availability`) VALUES
(1, 1, 'Pedigree Adult Beef & Vegetables', 'Product/15-06-2022-pedigree adult 2.jpg', 'Pedigree Makanan Anjing diformulasikan secara khusus dengan kandungan vitamin, mineral, dan protein tambahan yang diperlukan oleh anjing dewasa kesayangan anda. Pedigree Beef & Vegetables dapat memenu', 120000, 'In Stock'),
(2, 2, 'Friskies Party Mix', 'Product/15-06-2022-friskies kucing.jpg', 'Snack Kucing Kering dengan rasa Beachside; Tuna, Salmon dan Snappers, digunakan sebagai makanan selingan dan diberikan sebagai hadiah\r\n- Digunakan sebagai makanan selingan dan diberikan sebagai hadiah', 18000, 'In Stock'),
(3, 2, 'Whiskas Adult', 'Product/15-06-2022-whiskas.jpg', 'WHISKAS Makanan Kucing Kering 480gr\r\n\r\n1. WHISKAS makanan kucing kering lengkap dan seimbang, dirancang khusus untuk memenuhi kebutuhan kucing Anda pada tahap kehidupan mereka.\r\n\r\n\r\n\r\n2. Renyah di lua', 40000, 'In Stock'),
(4, 3, 'Rabbit House', 'Product/15-06-2022-kandang kelinci.jpg', 'Kandang kelinci ini memiliki struktur yang kuat dengan ruangan luas dan nyaman untuk tempat istirahat kelinci. Memiliki pintu di bagian depan dan samping, dengan atap yang bisa dibuka untuk memudahkan', 1250000, 'Sold Out'),
(5, 7, 'Crispy Hamster', 'Product/15-06-2022-crispy hamster.jpg', 'Natural Ingrediens\r\nBlanced Nutrition And Appetizing Mixture Food\r\nIngredients : maize, wheat, barley, peas, sunflower seeds,buckwheat,sorghum, peanuts, maize flakes, wild oats, safflower seeds, dehyd', 30000, 'In Stock');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `idservice` int(11) NOT NULL,
  `idkategoriserv` int(11) NOT NULL,
  `namaservice` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `harga` int(20) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`idservice`, `idkategoriserv`, `namaservice`, `gambar`, `harga`, `deskripsi`) VALUES
(1, 1, 'Gunting Kuku (Nail Clipping)', 'Service/15-06-2022-gunting kuku.jpg', 40000, 'Proses grooming / perawatan memotong kuku anjing / kucing ini untuk mengurangi resiko melukai owner ataupun groomer saat grooming atau saat dimandikan. Kuku anabul Kamu akan dipotong sesuai dengan batasannya, agar tidak terlalu dalam dan menyebabkan kucing kesakitan, berdarah, apalagi trauma untuk dipotong.'),
(2, 2, 'Konsultasi Kesehatan', 'Service/15-06-2022-konsultasi.png', 90000, 'Perlu diketahui bahwa nafsu makan yang menurun dan kerontokan bulu merupakan gejala dari suatu penyakit pada hewan. Untuk memastikan penyebab nafsu makan yang menurun, kerontokan bulu dan memastikan kesehatan hewan, hubungi ahli nya yaitu Pet Kingdom Clinic.\r\nPet Kingdom Clinic menyediakan layanan konsultasi kesehatan hewan dan General Check-up.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datauser`
--
ALTER TABLE `datauser`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `kategori_service`
--
ALTER TABLE `kategori_service`
  ADD PRIMARY KEY (`idkategoriserv`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `idkategori` (`idkategori`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`idservice`),
  ADD KEY `idkategoriserv` (`idkategoriserv`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datauser`
--
ALTER TABLE `datauser`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kategori_service`
--
ALTER TABLE `kategori_service`
  MODIFY `idkategoriserv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `idservice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`idkategoriserv`) REFERENCES `kategori_service` (`idkategoriserv`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
