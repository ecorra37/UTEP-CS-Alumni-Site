-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2014 at 05:50 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cs5339teamxfa14`
--
CREATE DATABASE IF NOT EXISTS `cs5339teamxfa14` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cs5339teamxfa14`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `first` varchar(15) NOT NULL,
  `last` varchar(15) NOT NULL,
  `title` varchar(15) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

DROP TABLE IF EXISTS `friend_requests`;
CREATE TABLE IF NOT EXISTS `friend_requests` (
  `frequest_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_from` varchar(25) NOT NULL,
  `user_id_to` varchar(25) NOT NULL,
  `request_date` date NOT NULL,
  `request_confirm_date` date NOT NULL,
  `request_status` enum('0','1','-1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`frequest_id`),
  KEY `user_id_from` (`user_id_from`,`user_id_to`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`frequest_id`, `user_id_from`, `user_id_to`, `request_date`, `request_confirm_date`, `request_status`) VALUES
(2, 'hima', 'madhu', '2014-11-25', '2014-11-25', '1'),
(6, 'mike', 'hima', '0000-00-00', '2014-12-04', '-1'),
(7, 'hari', 'hima', '2014-12-02', '2014-12-04', '1'),
(8, 'hima', 'siri', '2014-12-03', '0000-00-00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(30) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(15) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `item_pic` varchar(30) NOT NULL,
  `pymt_method` text NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `category`, `product_name`, `description`, `quantity`, `price`, `item_pic`) VALUES
(1, 'apparel', 'UTEP T-Shirt', 'This is a T-shirt very comfortable', 15, '11.99', 'utep_shirt.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `master`
--

DROP TABLE IF EXISTS `master`;
CREATE TABLE IF NOT EXISTS `master` (
  `master_id` int(11) NOT NULL AUTO_INCREMENT,
  `academicyear` varchar(30) DEFAULT NULL,
  `term` int(11) DEFAULT NULL,
  `last` varchar(30) DEFAULT NULL,
  `first` varchar(30) DEFAULT NULL,
  `major` varchar(30) DEFAULT NULL,
  `level` varchar(30) DEFAULT NULL,
  `degree` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`master_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `msg_body` longtext,
  `msg_by` varchar(25) NOT NULL,
  `msg_to` varchar(25) NOT NULL,
  `date_added` date NOT NULL,
  `msg_status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `msg_body`, `msg_by`, `msg_to`, `date_added`, `msg_status`) VALUES
(1, '', '0', '0', '2014-12-02', '0'),
(2, '', '0', '0', '2014-12-02', '0'),
(3, '', '0', '0', '2014-12-02', '0'),
(4, '', '0', '0', '2014-12-02', '0'),
(5, '', '0', '0', '2014-12-02', '0'),
(6, '', '0', '0', '2014-12-02', '0'),
(7, '', '0', '0', '2014-12-02', '0'),
(8, 'cxc', '0', '0', '2014-12-02', '0'),
(9, 'helllo test', 'hima', 'priya', '2014-12-02', '0'),
(10, 'hello ', 'hima', 'priya', '2014-12-02', '0'),
(11, 'hi ', 'hima', 'priya', '2014-12-02', '0'),
(12, 'hiiii', 'hima', 'madhu', '2014-12-02', '0'),
(13, 'hi priya this is my first message from madhu', 'madhu', 'priya', '2014-12-02', '0'),
(14, 'hi..from priya', 'hima', 'madhu', '2014-12-02', '0'),
(15, 'hiii from priya.....correct', 'hima', 'madhu', '2014-12-02', '0'),
(16, 'hello this is hima how are you?', 'hima', 'priya', '2014-12-03', '0');

-- --------------------------------------------------------

--
-- Table structure for table `privacy`
--

DROP TABLE IF EXISTS `privacy`;
CREATE TABLE IF NOT EXISTS `privacy` (
  `privacy_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `property_name` varchar(30) NOT NULL,
  `property_value` varchar(30) NOT NULL,
  `hide_status` enum('on','off') NOT NULL DEFAULT 'off',
  `privacy_field_status` enum('0','1') NOT NULL DEFAULT '0',
  `date_updated` date DEFAULT NULL,
  PRIMARY KEY (`privacy_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `privacy`
--

INSERT INTO `privacy` (`privacy_id`, `user_id`, `user_name`, `property_name`, `property_value`, `hide_status`, `privacy_field_status`, `date_updated`) VALUES
(1, 0, 'hima', 'Email', 'htest@test.com', 'off', '1', '2014-12-04'),
(2, 0, 'hima', 'fname', 'Hima', 'off', '0', '2014-12-02'),
(3, 0, 'hima', 'lname', 'Kondepati', 'off', '0', '2014-12-02'),
(4, 0, 'hima', 'title', 'Miss', 'off', '0', '2014-12-02'),
(5, 0, 'hima', 'Gender', 'f', 'on', '1', '2014-12-04'),
(6, 0, 'hima', 'City', 'el paso', 'off', '1', '2014-12-04'),
(7, 0, 'hima', 'Address', '1700 utep', 'off', '0', '2014-12-04'),
(8, 0, 'hima', 'bio_data', 'hi welcome to my profile', 'off', '0', '2014-12-02'),
(9, 0, 'hima', 'employeement', 'n', 'off', '0', '2014-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first` varchar(50) NOT NULL,
  `last` varchar(50) NOT NULL,
  `title` enum('Mr','Ms','Mis') DEFAULT NULL,
  `gender` enum('f','m','u') NOT NULL DEFAULT 'u',
  `city` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `bio_data` text,
  `employed` enum('y','n','u') NOT NULL DEFAULT 'u',
  `profile_pic` varchar(50) NULL,
  `last_login` date DEFAULT NULL,
  `profile_added` date DEFAULT NULL,
  `active_status` enum('0','1') NOT NULL DEFAULT '0',
  `friend_count` int(11) DEFAULT NULL,
  `friend_array` text,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `first`, `last`, `title`, `gender`, `city`, `address`, `bio_data`, `employed`, `profile_pic`, `last_login`, `profile_added`, `active_status`, `friend_count`, `friend_array`) VALUES
(1, 'hima', 'test', 'htest@test.com', 'Hima', 'Kalagara', 'Mis', 'f', 'el paso', '1700 utep', 'hi welcome to my profile', 'n', 0x89504e470d0a1a0a0000000d4948445200000040000000400806000000aa6971de00000e8149444154785eed9b0b8c5cd57dc67fe7dc7be7bd3b3bde97bdeb357edbb8c60608350102244140a1212929a4296aa10f354d9548515ad1a6555b54a54d25b552d597d4a6297102a90805849aa6516903099426406d635e86e0e7da5eefc3bb3b8f3b73e73ecee9accea9ae3ab21051763d8e92bff4712e778ee6ccf7fd1fe7e5155a6b7e944d727eecc7027cf625d67fee201ffb8bd7f8c2de231c787492b9c74f7276099de7d9bd8739d8f9eca14e9f8f2ff5e53cd98aa7c01fbfc46559874f4ef4f1331bca0cac2e40ce034f600d948658412b81191f8ed5583c51e7f176c25ffdde6ef6ff500af0a9e7547675497ce6a27ef19bbb87290de7414a4316c036a041778564a261ae05afccd13856d37f7eb2ae3ff7d7d7c8f60f8d0017ff931af9e836befcde75e2a64d1581230ca9942c0801c2b65a1b61525f8014a6ef5b0b9aa74ee87f7f6a52dff3ad0f39672e7801b67f458dfefc36f5e8ed5b9c6b468a82448352105b92008e044718925600db2fed633e377d677ccdd3c793fd8fbd257efad93b9cd32ca339f7df7ffff279fe2b49ff8737aac7eed8eebe67b0200815b422a887102aeb7d81314b5c61482716b1823081b64aa3a298118c16c49a463bb9f213dfe6b14f5cb27ce9e0b28c76fd9af8b3376f74af1fc80b9a96783b01571a6045d002944ed340838d0252286846e03950f460e93b6fde20af6b04f19f82f31b17dc34f8bec7da375c3d2e3e3e5e76684630dd84c500626510a520b48812fb6cdbc8f435d006f510ce36a115c358d9e1aa31f1ebb73cd1bef1821260eb8389f7aee1f80f778c7a6ea860da37e4130d91ea42624548c9dbffb7822469bf589948a84530d734efb68e78e2924af2fb5b3a635e3029b0ca8b6fd839ec5c5fca0aa61b30db04cf314414062e90d802286df8a7eadb7cc716c32558f2361d988f00014305c12523f23dcf4ec53780f3e40521c0866274e74425271a219c6e18020843dc4b4999e910d34a8c086088a3d37ea90810a52d334d2878b0b6e28a0dc5e02ec8f65e800d7ba3f25d1bf4f57d3987a986c9d9ac035a806babb8234d1b4bd0891141433ae559319c25d8cfe2ae08883584b11161b8e0b0ae5f5fb734f6d17bbc6a4f05283bd1b63545b9564bc154c3e43596bc720cf1b68220316d82798700d9150142800be464070e48d2a268eb09d34d9306a39d31073a6383f77c4f0570055b07f2a2b010402d34de06d012420dcdb8033ba7bbd27a591af2825400b31a4c3d2e80a29d02854e6788560cb5369473a2e008b602bd1500ad8bae14d4dae047c673da3162d46248004f826bd320112055ba0ac4904f45b08894153480b2077969de05b179ef3a66ec9e4e83637bb5501a37b63fb61d4368c374d2874604b19ddec218da769a6bff1f620bfb9cbeb7d360028d104e34e04c0bc2c4a011419280d2b84bbfa197112095d6aeb29e692b98f7a19958afebd4ab8ef5bc942048530001690490ee0bd2e247ace0746452a2e49a34f0b4466bed5a27263d1140089c38d17e3d50dacb22ce06e0c7863c1ad2bcb6027485bf20352b824d816e01ccf36c08be031b2b506b253a4a842f1c1c2039ef29b0ee4b4a08709bca3979a616b7b4866a045218c2616291867dfa1c77a32b2d9214619cae12c18c0130d319b3d5195b80bbf45b7a120112edb49decd491f9c6e4fa71b52d2b258a74831329eb7deb759956ffee08e82e82dd004c5b7441278ac3f3f164d019db413b3d390fb051505488d1b168ee8feebebc78f7f1a8c0f11ab8926eb384df8100a910dd46ac605b0556e1f3f07effa1a9ccf01f48f4f4895f947eaf8a608c10d19cce3f7be854fdae1d9b0bdeb40fa1f538e7ce71525152f69ab7b744437f06c68a70e08d7a344fe9598488d03aeee56e30915ac5a1573878e074f27cd00cd8b6ca7af31d2d212c787b5376ffb0bd020bb58057a6d5f3edce984b6303494f0500022145ed8ce87fe4b9d766838aa7d93a60aab6e607b5342576ae0257685e383417cc74c65a1a13087a2a4027f734d0125ab7c26c69df2bd5ecc3fffdda2c9bcab0dd8aa0f40fa0ae8d904b0761b408cfbe3ac3eb35ef9176b6f4e2d29840cbfc86de1e88440a31ebe8c4df329a1b1171c0370eceb3a502ef1a310531fabea2219d41f20e5cb31ac64af0b503f3ac76432e9fc86fc8ea4824883340d4d3a5b08d822447145e51acde77f7e5999ffaad0f8c3382cfa32fcc319a879bd6c2ba1256a97495a7f9ff503addf149604b3fdcb2ceecff1f7e7e8e8bdc26bf7bdb389fbe3a77ed0d95da9f95747b6469ec9e0bb0656fe85c9e5ff8db3b2ecb7f64f7da1ca33987dfb96d9c5de5365ffad649261723ae1b835b266067055665c1932048e7780164240ce54cb8df7a11ec5903afcf443cd8f98e3d8321f775c84b57b27e30c3afeee9db73ed406deff6bdad72cfef05deffe0dc9fdc7169ee33576d2e31802123252c2a78e2c0024fbfbcc8405f89abb654d83cece20868db4d4e9000020a0e943cc8b81026f0c64ccc77bfb740c36ff0dedd03dcb6abc22a095a8102f21e1c3ad3e6f3ff35ffcf2fb4067feef03d99a42711f0ee07ce7ee8ba0dce6f5fb2be44d17ab3a5e0751f5e6bc0ce8b2bdc7beb046b07154f1e38c9df7df3148fef5be0e0a936f38d08a9142256ccd422f677de3df2e2fc521f9e3a7892f5c38a7b6f9b60e7b60a87eae6fbfc04943d29de349ae5833bfb7e768cea7d3d89802d0fb4565f3b507deef66b46365c5494e431e48f04504fc0116934780e349a0927a61a9c986e31570d89ed765703ae63fa0cf56758b73acfba35254a0587288144a5cbe0bc840d7928caf486e9e1efcc34be7a247bc3abbf52fe9ff32ac08d0f9cfecb0fee19f8e4aeb5050624040adef2c1b7e4bb4d4a7b25e64014411829a2d8b0f35c49c693781e2496b452e79e16730e6c2e9819c295305b8bf89bff9c7d7a5f3878f3d15fca86e745801dff50ddf5bef1f677de7fe5487e8d0712437e3e0257bccd60e9c52774ed05d2cb51d06fbf36a0e8c0d692192bebd1a9330b7cf1a5e823fb7f6de4abe7652f304afd539b2f1aca67ed75f7f1264cb78ce7438ca5e7fee9fd5f6c1129bacc90718469d3c31290746f9a603181230d585f8424821debfbd9fcd6d4a7d7ff63f0c4b15fceb55754802d7f5fdb7aedb073c7aa4a0e4fc35cdb1c7f694b54887421d388c18fa19918c4d6cbddfc352951290c3c8b8c04cfc0bc9346243f329f0de7209373d83e96dbf3f29bfefb21f7f51515a094f877ae5d532a7bc214b1e3350822f0ec29702d82b36da8c7e9c227ddfaa66d3792aed0d7d8367d999e2a61ecad2a5c3902390ffa86fb187a73e6a3137b2bff36798fd42b22c0c40371f6e24c74fb40a580b4ff8ae36c00609e67025304754a1ad9ed6dde899d5b30656105a219c2e12aac2f43ae9061a45fde78c20f86a130b3220278417ddbd088b7cbcb3a280553f6127436309e4f433925ab5939131a4ed560b800b98c607820b33abbe0ff2414beb62202b83a7e77b93f9b9340a30d4717e1940fb14e0b9736382fa6817a0bcefa3022a1bf9c2743fd4a606504c8c5cd9d85fe11120d47aa46007bc26b899f7f8b1338db84fe02640a590ac9cc4f4c7c31ce4cdeeb86cb2580cdffa83426e38bdd5c86c525ef2f40128390a0e9a169a8fad02a83960eb9acdca495ea07e6965500ad749f9771c71324d5b6093d4c95efa9690dcdc014c48c23705d678dd694965f00ad0b8eeb0c27085a6d8842500908d163016c1af86d90050152e6887576dd97b538f10b422f8b009d2f934046831b69a37612810204bdb704688590c941ac34407a65b64c112001274ab4682b084288a3b4f841efd3a01d41a8204eb4402001b19c29203aa61ab5a0d60a757f9c889e877f8af442b515286ab5d694a8880890cb2780d652786e6db1c573f5b9ea5d6edf003ab930bc8f062d219b87ea997916e3cc371dcfaba3b500b17c455048493430f22f936f9cbef58a6bfb4ad582436d1e5cb7a7dc4962181b87ac0e79f1d0cc2986377e03c35c2f670a2428a5bc72f9f0a97aeda1c2bea31fbbf4b2cd1c8d60a60a4870c47926aec013b0750de40722befdccf7827a7ee4f3997cee0c4ac5805a5e01a08956cdecf8c4d70f1d3f32d4fcee9b1fbefaf24d8c2f381c9d86f916e8743bbb22a49536c83930de07ebd6c02c014f3e73b8d9cc54be901b1e7e1ea57ca00924cb7622646f82b3c028426c10428cfa27276fcab517efbc6af744ff96ca00fe021c9b87b9263443d21be1ef5b90eecb54f3ec4a28e70cf1b15510e460ffa9695e7f73f6b8333cf660a6b26a1f4a4d01c780b39d3b83e55d0a0321b080d639adb5579898f88f70a1ffe4932f4c7ee0e5c1b9cbaed83c262edd58c069c35c03a6ea30eb4310431041acd26bf1b7276efa641cc8b986f448095677d05780050dfbe7aabc7ae474e887f299e2c4a67f750bf9499da8b3c014504dc92f6304d82870803e6014582b1c39a86235d09c3eb32baace5f57297a3bb64f0c3bdb87caacce3b6435b422a806506f4323802036ef92ae0ccddb7b8152a683ac417f075282afe1583de6b599458e9d990b9a4172303f32fa546e70e810e83a5acf00278139c0ef08a05644002b820b1480216035428c0a298a2a4afa5af367b704f3f3bb1d91eca8e43323eb0607e4ba4a8935852c8325494680a3d33f8448bd9e5ea426121a11ccd615a7fc36938b0d4e2d54e346104ce3645e2e0c0dedcb0e548e0947f83a5175ebf533c002d04ac9af900069249003fa81612bc62ae1c81c9a6cd40acaedeae2faa05edfa8826022e3396319e116fbb25eae94f344319b21eb081beea014b414f8ed9046106a3f8cda914afc308e4f7ac5e2d16ca974345b2e9f70b3d91ad0d6a6d0cd03b3d6eb75a09dde14afb0005604017840c10a51b12823444148e102ae8a939c8aa242e4fb0351d85ea512d5a7952a6a8d2035532c1de94b29ebae9759f04aa579e9794de93a2d20d14a4768ed038bc08245cd7a3deec9dda015425a21f24011e8b38294ac383984c8082124768d8e40702ed368fb5fddb104ad43a005f8403d050da00d44a9d77b23407744b840c6a6473e0539206b3f732dc439ce3c132002424b30009a40cb22b09fc75dc47b2cc0b9a3c249c9e259b8164e9700da22b1885210db567517b8951260a5041116e9b3b52e1114f6d9105e59fbf15f8ff3236eff0bd80c0dd9cf857bdc0000000049454e44ae426082, '2014-11-25', '2014-11-25', '1', NULL, NULL),
(2, 'priya', 'test', 'priya@test.com', 'priyafname', 'plastname', 'Ms', 'f', 'hyderabd', 'india', 'hi my name is priya', 'u', NULL, '2014-11-25', '2014-11-25', '0', NULL, NULL),
(3, 'madhu', 'test', 'm@test.com', 'mfirst', 'mlast', 'Mr', 'f', 'el paso', '1700 utep', 'hi this is madhu welcome to my page', 'u', NULL, '2014-12-01', '2014-12-01', '0', NULL, NULL),
(4, 'hari', 'test', 'ha@test.com', 'hfirst', 'hlast', 'Mr', 'f', 'el paso', '1700', 'hi this is hari', 'u', NULL, '2014-12-01', '2014-12-01', '0', NULL, NULL),
(5, 'siri', 'test', 's@test.com', 'stest', 'slast', 'Ms', 'f', 'el paso', '1700', 'siri''s profile', 'u', NULL, '2014-12-01', '2014-12-01', '0', NULL, NULL),
(6, 'mike', 'test', 'mike@test.com', 'mfirst', 'mlast', NULL, 'm', 'el paso', '1700 utep', 'test', 'u', NULL, NULL, NULL, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

DROP TABLE IF EXISTS `user_posts`;
CREATE TABLE IF NOT EXISTS `user_posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_body` longtext,
  `added_by` varchar(25) NOT NULL,
  `added_to` varchar(25) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_posts`
--

INSERT INTO `user_posts` (`post_id`, `post_body`, `added_by`, `added_to`, `date_added`) VALUES
(1, 'hi this is my first post', 'hima', 'hima', '2014-11-25'),
(2, 'hello', 'hima', 'hima', '2014-12-02'),
(3, 'hi...', 'hima', 'madhu', '2014-12-02'),
(4, 'hello', 'hima', 'hari', '2014-12-04');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
