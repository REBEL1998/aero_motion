CREATE DATABASE aero_motion;

--
-- Table structure for table `category`
--

  CREATE TABLE `category` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `status` char(1) NOT NULL DEFAULT 'Y',
    `desc` TEXT DEFAULT NULL,
    `url_key` varchar(255) NOT NULL,
    `image` TEXT DEFAULT NULL,
    `rmdate` date DEFAULT NULL,
    `flagdelete` char(1) DEFAULT '',
    PRIMARY KEY (id),
    KEY (`status`),
    KEY (`url_key`),
    KEY (`rmdate`),
    KEY (`flagdelete`)
  );

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

create table `users` (
	`id` int(11) NOT NULL,
	`username` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL,
	`firstname` varchar(255) NOT NULL,
	`lastname` varchar(255) NOT NULL,
	`status` char(1) NOT NULL DEFAULT 'Y',
	`flagdelete` char(1) NOT NULL DEFAULT 'N',
	`rmdate` date DEFAULT NULL,
	 PRIMARY KEY (`id`),
   KEY (`status`),
   KEY (`flagdelete`),
   KEY (`rmdate`)
);


--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`) VALUES
(1, 'admin', '$2y$10$4OjgXyQY0UGKESMujlH2n.gkXlo.eIhjkgMnGth5T0JYrvhWB9JgC', 'admin@bootsback.com', 'Nilesh', 'Panchal');

CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contactno` varchar(255) DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `accounttype` char(2) NOT NULL DEFAULT 'SM',
  `status` char(1) NOT NULL DEFAULT 'Y',
  `rmdate` date DEFAULT NULL,
  `flagdelete` char(1) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `email` (`email`),
  KEY `password` (`password`),
  KEY `accounttype` (`accounttype`),
  KEY `status` (`status`),
  KEY `flagdelete` (`flagdelete`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8

CREATE TABLE `email_otp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `otp` varchar(10) NOT NULL,
  `dateadded` DATETIME DEFAULT NULL,
  `rmdate` date DEFAULT NULL,
  `flagdelete` char(1) DEFAULT '',
  KEY `id` (`id`),
  KEY `email` (`email`),
  KEY `otp` (`otp`),
  KEY `dateadded` (`dateadded`),
  KEY `rmdate` (`rmdate`),
  KEY `flagdelete` (`flagdelete`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


=> For store product details

CREATE TABLE `product` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `catid` int(11) NOT NULL,
	  `name` varchar(255) NOT NULL,
	  `title` varchar(255) NOT NULL,
	  `desc` text NOT NULL,
	  `specification` text DEFAULT NULL,
	  `productImage` varchar(500) DEFAULT NULL,
	  `flagstatus` char(1) DEFAULT NULL,
	  `dateadded` datetime DEFAULT NULL,
	  `dateupdate` datetime DEFAULT NULL,
	  `flagdeleted` datetime DEFAULT NULL,
    PRIMARY KEY (id),
	KEY `catid` (`catid`),
	KEY `dateadded` (`dateadded`),
	KEY `dateupdate` (`dateupdate`),
	KEY `flagstatus` (`flagstatus`),
	KEY `flagdeleted` (`flagdeleted`)
  )
  
  
=> dump data insert 


INSERT INTO `product` (`id`, `catid`, `name`, `title`, `desc`, `flagstatus`, `dateadded`, `dateupdate`, `flagdeleted`) VALUES
(1, 1, 'This is sample product', ' This is sample product', ' This is sample product', 'Y', '2023-02-19 07:07:25', NULL, NULL),
(2, 1, 'This is sample product', ' This is sample product', ' This is sample product', 'Y', '2023-02-19 07:07:42', NULL, NULL),
(3, 1, 'This is sample product', ' This is sample product', ' This is sample product', 'Y', '2023-02-19 07:07:56', NULL, NULL),
(4, 2, 'This is sample product one qdsgdsgadsg', ' This is sample product one  sdfsdfafd ', ' This is sample product onefsdafadfsf', 'Y', '2023-02-19 07:33:07', '2023-02-19 08:05:55', NULL);


=> For store contact details 

CREATE TABLE `contactus` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `contactname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` mediumtext,
  `dateadded` DATETIME DEFAULT NULL,
  `rmdate` date DEFAULT NULL,
  `flagdelete` char(1) NOT NULL DEFAULT 'N',
  KEY `id` (`id`),
  KEY `dateadded` (`dateadded`),
  KEY `rmdate` (`rmdate`),
  KEY `flagdelete` (`flagdelete`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




=> 21-02-23

ALTER TABLE category ADD COLUMN imagename TEXT DEFAULT NULL AFTER url_key;