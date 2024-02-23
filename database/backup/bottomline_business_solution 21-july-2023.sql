-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 22, 2023 at 03:58 AM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bottomline_business_solution`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

DROP TABLE IF EXISTS `attributes`;
CREATE TABLE IF NOT EXISTS `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `frontend_type` enum('select','radio','checkbox','text','text_area') COLLATE utf8_unicode_ci NOT NULL,
  `is_filterable` tinyint(1) NOT NULL DEFAULT '0',
  `is_required` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `metadata` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `attributes_code_unique` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

DROP TABLE IF EXISTS `attribute_values`;
CREATE TABLE IF NOT EXISTS `attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `attribute_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `price` decimal(2,2) DEFAULT '0.00',
  `quantity` int(11) NOT NULL DEFAULT '1',
  `discount_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `discount_type` enum('fixed','percent') COLLATE utf8_unicode_ci DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `metadata` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute_values_attribute_id_title_index` (`attribute_id`,`title`),
  KEY `attribute_values_price_index` (`price`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attribute_value_product`
--

DROP TABLE IF EXISTS `attribute_value_product`;
CREATE TABLE IF NOT EXISTS `attribute_value_product` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `attribute_value_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute_value_product_product_id_attribute_value_id_index` (`product_id`,`attribute_value_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `page_id` bigint(20) UNSIGNED DEFAULT NULL,
  `headings` longtext COLLATE utf8_unicode_ci,
  `description` longtext COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `buttons` longtext COLLATE utf8_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `added_by`, `updated_by`, `page_id`, `headings`, `description`, `image`, `buttons`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 5, 1, '{\"one\":\"We use high <span> quality and <\\/span> certified product\",\"two\":null}', 'Promoting mental, physical, emotional and spiritual well-being through alternative medicine that completely change your life.', 'taste-budz-banner.png', '{\"title1\":\"Shop Now\",\"link1\":\"front.products\",\"title2\":null,\"link2\":null}', 1, '2023-02-02 04:58:23', '2023-02-22 08:21:46', NULL),
(2, 5, NULL, 2, '{\"one\":\"About Us\",\"two\":null}', NULL, NULL, '{\"title1\":null,\"link1\":null,\"title2\":null,\"link2\":null}', 1, '2023-02-02 05:01:47', '2023-02-02 05:01:47', NULL),
(3, 5, NULL, 3, '{\"one\":\"SHOP CANNABIS\",\"two\":null}', NULL, NULL, '{\"title1\":null,\"link1\":null,\"title2\":null,\"link2\":null}', 1, '2023-02-02 05:02:33', '2023-02-02 05:02:33', NULL),
(4, 5, NULL, 4, '{\"one\":\"SAFE PRACTICES\",\"two\":null}', NULL, NULL, '{\"title1\":null,\"link1\":null,\"title2\":null,\"link2\":null}', 1, '2023-02-02 05:02:47', '2023-02-02 05:02:47', NULL),
(5, 5, NULL, 5, '{\"one\":\"CONTACT US\",\"two\":null}', NULL, NULL, '{\"title1\":null,\"link1\":null,\"title2\":null,\"link2\":null}', 1, '2023-02-02 05:17:50', '2023-02-02 05:17:50', NULL),
(6, 5, NULL, 6, '{\"one\":\"Login\",\"two\":null}', NULL, NULL, '{\"title1\":null,\"link1\":null,\"title2\":null,\"link2\":null}', 1, '2023-02-02 05:48:03', '2023-02-02 05:48:03', NULL),
(7, 5, NULL, 7, '{\"one\":\"Register\",\"two\":null}', NULL, NULL, '{\"title1\":null,\"link1\":null,\"title2\":null,\"link2\":null}', 1, '2023-02-02 05:48:12', '2023-02-02 05:48:12', NULL),
(8, 5, NULL, 8, '{\"one\":\"Blogs\",\"two\":null}', NULL, NULL, '{\"title1\":null,\"link1\":null,\"title2\":null,\"link2\":null}', 1, '2023-02-22 03:43:59', '2023-02-22 03:43:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `content` longtext COLLATE utf8_unicode_ci,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_data` longtext COLLATE utf8_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `added_by`, `updated_by`, `category_id`, `title`, `slug`, `description`, `content`, `icon`, `meta_data`, `is_active`, `order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, NULL, NULL, '5 THINGS YOU SHOULD KNOW BEFORE YOU USE CANNABIS AS ALTERNATIVE MEDICINE', '5-things-you-should-know-before-you-use-cannabis-as-alternative-medicine', '\"Cannabis has been used for medicinal purposes for centuries, and in recent years it has gained popularity as an alternative medicine. However, before using cannabis as an alternative medicine, there are several things you should know. In this blog, we will discuss 5 things that you should know before using cannabis as an alternative medicine.\"', '\"<p>Cannabis has been used for medicinal purposes for centuries, and in recent years it has gained popularity as an alternative medicine. However, before using cannabis as an alternative medicine, there are several things you should know. In this blog, we will discuss 5 things that you should know before using cannabis as an alternative medicine.<\\/p>\\r\\n<h6>Know Your Local Laws and Regulations<\\/h6>\\r\\n<p>Before using cannabis as an alternative medicine, it is important to be aware of the laws and regulations in your local area. Cannabis is illegal in many parts of the world, while in other places it is legal for medicinal or recreational use. Make sure you understand the legal status of cannabis in your area before considering it as an alternative medicine.<\\/p>\\r\\n<h6>Consider Potential Risks and Side Effects<\\/h6>\\r\\n<p>While cannabis can provide many benefits as an alternative medicine, it can also come with potential risks and side effects. Common side effects may include dizziness, dry mouth, and increased heart rate. Cannabis can also interact with other medications, so it is essential to talk with your healthcare provider before taking cannabis as an alternative medicine.<\\/p>\\r\\n<h6>Understand the Different Strains and Products<\\/h6>\\r\\n<p>There are many different strains and products of cannabis available, each with its unique properties and effects. Some strains may be more effective for treating specific conditions than others, and certain products may be more appropriate for certain delivery methods. Research the different strains and products available, and consult with a knowledgeable professional to determine which may be the most appropriate for your needs.<\\/p>\\r\\n<h6>Start with a Low Dosage<\\/h6>\\r\\n<p>Using a lot of cannabis can make you high if your product contains THC. It is crucial to start with a low dosage when using cannabis as an alternative medicine. This allows you to evaluate how your body reacts to the substance and adjust the dosage as needed. Starting with a small amount and gradually increasing the dosage as necessary can help you avoid adverse reactions and ensure that you are using cannabis safely and effectively.<\\/p>\\r\\n<h6>Always Purchase from a Reputable Source<\\/h6>\\r\\n<p>The quality and purity of the cannabis you use as an alternative medicine can significantly impact its effectiveness and safety. Always purchase cannabis from a reputable source that provides detailed information about the product, including its source, ingredients, and quality control testing.<\\/p>\\r\\n<h6>The Way Forward<\\/h6>\\r\\n<p>As the legalization of cannabis continues to spread globally, more and more people are exploring its potential as an alternative medicine. While there is still much to learn about cannabis, research has shown that it can provide a range of benefits for both physical and mental health. Although, it is important to note that it is not without risks. Like any medication, cannabis can have side effects, and it can also be addictive. It is necessary to speak with a healthcare provider before using cannabis as an alternative medicine, particularly if you are taking other medications or have a history of substance abuse.<\\/p>\"', 'blog-img1.jpg', '{\"meta_title\":null,\"meta_description\":null,\"meta_keywords\":null}', 1, 1, '2023-02-22 03:12:12', '2023-02-22 03:12:12', NULL),
(2, 5, NULL, NULL, 'BENEFITS OF ALTERNATIVE MEDICINES OVER CONTEMPORARY MEDICINES', 'benefits-of-alternative-medicines-over-contemporary-medicines', '\"Alternative medicines, also known as complementary or traditional medicines, have gained increasing popularity over the years due to their perceived benefits over contemporary medicines and are showing no sign of slowing down. While conventional medicine has undoubtedly made significant strides in the treatment of diseases and health conditions, there are several reasons why individuals are turning to alternative medicine.\"', '\"<p>Alternative medicines, also known as complementary or traditional medicines, have gained increasing popularity over the years due to their perceived benefits over contemporary medicines and are showing no sign of slowing down. While conventional medicine has undoubtedly made significant strides in the treatment of diseases and health conditions, there are several reasons why individuals are turning to alternative medicine.<\\/p>\\r\\n<p>Here are a few major benefits of alternative medicines over contemporary medicines in the western world which seems to continue to grow.<\\/p>\\r\\n<h6>Fewer Side Effects<\\/h6>\\r\\n<p>One of the most significant benefits of alternative medicines is that they often have fewer side effects than contemporary medicines. Many alternative therapies are derived from natural sources, such as herbs or plant extracts, which are less likely to cause adverse reactions. Additionally, alternative medicine practitioners take a holistic approach to healthcare, addressing the root cause of an ailment rather than just treating symptoms. This means that patients are less likely to experience unwanted side effects from their treatments.<\\/p>\\r\\n<h6>Personalized Approach<\\/h6>\\r\\n<p>Alternative medicines often focus on a more personalized approach to health and wellness, taking into account the individual\'s unique physical, emotional, and spiritual needs. This can lead to a more comprehensive and holistic approach to healthcare that may not be possible with contemporary medicines.<\\/p>\\r\\n<h6>Individualized Treatments<\\/h6>\\r\\n<p>Unlike contemporary medicine, which often relies on a one-size-fits-all approach, alternative medicine practitioners tailor their treatments to each patient\'s unique needs. For example, an acupuncturist may use different points and techniques depending on the patient\'s specific symptoms and health history. This individualized approach can lead to more effective treatments and better patient outcomes.<\\/p>\\r\\n<h6>Emphasis on Prevention<\\/h6>\\r\\n<p>Many alternative medicine therapies focus on preventing illness rather than simply treating it. For example, a naturopathic doctor may work with a patient to improve their diet, exercise routine, and stress management techniques to boost their overall health and immune system. By emphasizing prevention, alternative medicine practitioners can help patients avoid illness altogether, which can be especially important for chronic conditions.<\\/p>\\r\\n<h6>Lower Costs<\\/h6>\\r\\n<p>Finally, alternative medicines can often be less expensive than contemporary medicines. Because many alternative therapies are based on natural remedies and do not require expensive equipment or pharmaceuticals, they can be more affordable for patients. This can be especially important for individuals without access to comprehensive health insurance or who are facing high out-of-pocket expenses.<\\/p>\\r\\n<p>While alternative medicines can be beneficial in many ways, it\'s important to remember that they are not a substitute for conventional medical care. Alternative therapies should be used in conjunction with, rather than in place of, traditional treatments. Additionally, it\'s important to consult with a healthcare professional before starting any new therapy or supplement, as some alternative medicines can interact with medications or worsen certain conditions.<\\/p>\\r\\n<h6>Bottom line<\\/h6>\\r\\n<p>Alternative medicines can provide a more natural, holistic, and personalized approach to healthcare, while also being perceived as safer and less expensive. However, it\'s important to approach alternative therapies with caution and to use them in conjunction with, rather than as a replacement for, conventional medical care.<\\/p>\"', 'blog-img2.jpg', '{\"meta_title\":null,\"meta_description\":null,\"meta_keywords\":null}', 1, 1, '2023-02-22 03:13:06', '2023-02-22 03:13:06', NULL),
(3, 5, NULL, NULL, 'THERAPEUTIC BENEFITS OF CBD, CBN, AND CBG', 'therapeutic-benefits-of-cbd-cbn-and-cbg', '\"Cannabis also known as marijuana, is a plant that has been used for medicinal and recreational purposes for centuries. It contains over 100 different compounds, known as cannabinoids, which interact with the human body\\u2019s endocannabinoid system to produce various effects.\"', '\"<p>Cannabis also known as marijuana, is a plant that has been used for medicinal and recreational purposes for centuries. It contains over 100 different compounds, known as cannabinoids, which interact with the human body&rsquo;s endocannabinoid system to produce various effects. The three most well-known cannabinoids are CBD (cannabidiol), CBN (cannabinol), and CBG (cannabigerol), each of which has its own unique therapeutic benefits while, THC is the psychoactive compound in cannabis that gives users a &ldquo;high&rdquo;, on the other hand, CBD is non-psychoactive and is believed to have therapeutic benefits.<\\/p>\\r\\n<h6>How Does Cannabis Work?<\\/h6>\\r\\n<p>The human body has an endocannabinoid system that regulates a variety of functions, including mood, appetite, pain sensation, and immune response. When THC and other cannabinoids from cannabis are consumed, they interact with the body&rsquo;s endocannabinoid system, which can result in a range of effects, including pain relief, relaxation, and changes in mood.<\\/p>\\r\\n<h6>Therapeutic Benefits of Cannabis:<\\/h6>\\r\\n<p>Cannabis has shown a number of potential therapeutic benefits.<\\/p>\\r\\n<h6>The Benefits and Uses of CBD<\\/h6>\\r\\n<p>CBD, or cannabidiol, is a non-intoxicating compound found in the cannabis plant. It is commonly used for its potential therapeutic benefits, including reducing anxiety, relieving pain, and improving sleep. However, it is important to note that CBD&rsquo;s effects are still being researched, and more studies are needed to fully understand its potential uses and benefits. Additionally, it&rsquo;s essential to speak with a healthcare provider before starting to use CBD to ensure it is safe and appropriate for individual use.<\\/p>\\r\\n<p>CBD can be sold in various forms including:<\\/p>\\r\\n<ul>\\r\\n<li>Oils<\\/li>\\r\\n<li>Capsules<\\/li>\\r\\n<li>Gummies<\\/li>\\r\\n<li>Vapes<\\/li>\\r\\n<li>Topicals<\\/li>\\r\\n<\\/ul>\\r\\n<p>&nbsp;<\\/p>\\r\\n<h6>The Benefits and Uses of CBN<\\/h6>\\r\\n<p>CBN, or cannabinol, is a minor cannabinoid found in the cannabis plant that is formed when THC (tetrahydrocannabinol) oxidizes over time. Some studies suggest that it may have the potential as a sleep aid, pain reliever, and anti-inflammatory agent. CBN has also been studied for its potential to stimulate appetite and reduce intraocular pressure in glaucoma patients and other eye conditions. It could provide pain relief for chronic muscle disorders and also decrease muscle sensitization.<\\/p>\\r\\n<p>CBN can be sold as a standalone product, such as:<\\/p>\\r\\n<ul>\\r\\n<li>Tincture<\\/li>\\r\\n<li>Capsule<\\/li>\\r\\n<li>Topicals<\\/li>\\r\\n<\\/ul>\\r\\n<p>&nbsp;<\\/p>\\r\\n<h6>The Benefits and Uses of CBG<\\/h6>\\r\\n<p>CBG, or cannabigerol, is a non-psychoactive cannabinoid that is produced in the early stages of the plant\'s growth cycle. Cannabigerol is often referred to as the &ldquo;stem cell&rdquo; because it is the precursor to other cannabinoids like THC and CBD. It is believed to have a variety of therapeutic benefits, including anti-inflammatory, antibacterial, and neuroprotective effects. It has also been shown to have potential as a treatment for glaucoma and other eye conditions. Some studies have also suggested that CBG may have anti-cancer properties, making it a potential treatment for certain types of cancer.<\\/p>\\r\\n<p>CBG can be sold as, oils and it can also treat skin conditions such as psoriasis and eczema.<\\/p>\\r\\n<h6>All in all<\\/h6>\\r\\n<p>The therapeutic benefits of CBD, CBN, and CBG are still being studied, but early research suggests that they have the potential for treating a variety of conditions. It\'s important to note that while these cannabinoids are derived from cannabis, they can also be extracted from hemp, which contains very low levels of THC and is legal in most countries. If you\'re interested in using these compounds for medicinal purposes, it\'s important to talk to your doctor and do your own research to determine what might be most effective for you.<\\/p>\"', 'blog-img3.jpg', '{\"meta_title\":null,\"meta_description\":null,\"meta_keywords\":null}', 1, 1, '2023-02-22 03:15:43', '2023-02-22 03:15:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `seodata` longtext COLLATE utf8_unicode_ci,
  `metadata` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `description`, `image`, `is_active`, `seodata`, `metadata`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Icehockey', 'taste-budz', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `category_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `metadata` longtext COLLATE utf8_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `visits` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `added_by`, `updated_by`, `category_type_id`, `parent_id`, `title`, `slug`, `icon`, `metadata`, `is_active`, `visits`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 5, 1, NULL, 'Non-Psychoactive', 'non-psychoactive', 'cat3.jpg', NULL, 1, 0, '2023-02-03 08:22:47', '2023-02-10 07:52:51', NULL),
(2, 5, 5, 1, NULL, 'Glass', 'glass', 'cat1.jpg', NULL, 1, 0, '2023-02-03 08:23:38', '2023-02-10 07:52:55', NULL),
(3, 5, NULL, 2, 1, 'Non-Psychoactve', 'non-psychoactve', NULL, NULL, 1, 0, '2023-02-21 09:20:47', '2023-06-02 18:23:09', '2023-06-02 18:23:09'),
(4, 5, 5, 1, 1, 'Aperia d', 'aperia-d', '2023_24_large.png', NULL, 1, 0, '2023-06-01 21:58:49', '2023-06-02 21:41:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

DROP TABLE IF EXISTS `category_product`;
CREATE TABLE IF NOT EXISTS `category_product` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_product_product_id_category_id_index` (`product_id`,`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`) VALUES
(6, 7, 1, NULL, NULL),
(5, 6, 1, NULL, NULL),
(7, 8, 1, NULL, NULL),
(8, 9, 2, NULL, NULL),
(9, 10, 2, NULL, NULL),
(10, 11, 2, NULL, NULL),
(11, 12, 2, NULL, NULL),
(12, 13, 2, NULL, NULL),
(13, 14, 2, NULL, NULL),
(14, 15, 2, NULL, NULL),
(15, 16, 2, NULL, NULL),
(16, 17, 2, NULL, NULL),
(17, 18, 2, NULL, NULL),
(18, 19, 2, NULL, NULL),
(19, 20, 2, NULL, NULL),
(20, 21, 2, NULL, NULL),
(21, 22, 2, NULL, NULL),
(22, 23, 2, NULL, NULL),
(23, 24, 2, NULL, NULL),
(24, 25, 2, NULL, NULL),
(25, 26, 2, NULL, NULL),
(26, 27, 2, NULL, NULL),
(27, 28, 2, NULL, NULL),
(28, 29, 2, NULL, NULL),
(29, 30, 2, NULL, NULL),
(30, 31, 2, NULL, NULL),
(31, 32, 2, NULL, NULL),
(32, 33, 2, NULL, NULL),
(33, 34, 2, NULL, NULL),
(34, 35, 2, NULL, NULL),
(35, 36, 2, NULL, NULL),
(36, 37, 2, NULL, NULL),
(37, 38, 2, NULL, NULL),
(38, 39, 2, NULL, NULL),
(39, 40, 2, NULL, NULL),
(40, 41, 2, NULL, NULL),
(41, 42, 2, NULL, NULL),
(42, 43, 2, NULL, NULL),
(43, 44, 2, NULL, NULL),
(44, 45, 2, NULL, NULL),
(45, 46, 2, NULL, NULL),
(46, 47, 2, NULL, NULL),
(47, 48, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_types`
--

DROP TABLE IF EXISTS `category_types`;
CREATE TABLE IF NOT EXISTS `category_types` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_types`
--

INSERT INTO `category_types` (`id`, `added_by`, `updated_by`, `name`, `slug`, `order`, `link`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, NULL, 'Products', 'products', '1', NULL, 1, '2023-02-03 08:20:35', '2023-02-03 08:20:35', NULL),
(2, 5, 5, 'Blogs', 'blogs', '1', NULL, 1, '2023-02-21 09:20:10', '2023-02-22 02:27:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_queries`
--

DROP TABLE IF EXISTS `contact_queries`;
CREATE TABLE IF NOT EXISTS `contact_queries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '1',
  `metadata` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `start_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `user_id`, `name`, `description`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 52, NULL, NULL, '08/03/2023', '08/04/2023', '2023-06-27 12:07:16', '2023-06-27 12:07:16'),
(2, 52, NULL, NULL, '01/03/2024', '01/04/2024', '2023-06-27 15:00:30', '2023-06-27 15:00:30'),
(3, 38, NULL, NULL, '01/10/2024', '01/11/2024', '2023-06-27 20:35:42', '2023-06-27 20:35:42'),
(4, 38, NULL, NULL, '01/17/2024', '01/18/2024', '2023-06-27 20:37:58', '2023-06-27 20:37:58');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_10_28_234129_create_pages_table', 1),
(6, '2022_10_28_234141_create_banners_table', 1),
(7, '2022_10_31_233525_create_categories_table', 1),
(8, '2022_10_31_233623_create_category_types_table', 1),
(9, '2022_11_04_190917_create_statuses_table', 1),
(10, '2022_11_04_230710_create_notifications_table', 1),
(11, '2022_11_08_222103_create_page_contents_table', 1),
(12, '2022_11_11_012257_create_web_settings_table', 1),
(13, '2022_12_12_115956_create_contact_queries_table', 1),
(14, '2023_01_10_185035_create_user_metas_table', 1),
(58, '2023_06_05_175355_create_teams_table', 9),
(16, '2023_01_31_214234_create_social_accounts_table', 1),
(56, '2023_05_31_162105_create_permission_tables', 8),
(30, '2023_02_02_204936_create_products_table', 2),
(31, '2023_02_02_232204_create_attributes_table', 2),
(32, '2023_02_02_235716_create_attribute_values_table', 2),
(33, '2023_02_03_000741_create_table_attribute_value_product', 2),
(34, '2023_02_03_000945_create_table_category_product', 2),
(35, '2023_02_03_011036_create_brands_table', 2),
(36, '2023_02_03_195904_create_variations_table', 2),
(45, '2023_02_15_002504_create_orders_table', 3),
(46, '2023_02_15_003819_create_order_items_table', 3),
(47, '2023_02_15_003908_create_order_histories_table', 3),
(48, '2023_02_16_214558_create_order_payments_table', 3),
(49, '2023_01_02_183252_create_blogs_table', 4),
(50, '2022_12_29_191729_create_testimonials_table', 5),
(51, '2023_01_03_174718_create_social_links_table', 5),
(52, '2022_10_15_030434_create_order_statuses_table', 6),
(53, '2023_02_22_214528_create_jobs_table', 6),
(55, '2022_02_10_203421_create_package_permissions_table', 7),
(60, '2023_06_05_175355_create_team_player_table', 10),
(63, '2023_06_21_184444_create_students_table', 11),
(64, '2023_06_21_185353_create_courses_table', 11),
(65, '2023_06_21_210229_create_payments_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 20),
(2, 'App\\Models\\User', 38),
(4, 'App\\Models\\User', 22),
(5, 'App\\Models\\User', 24),
(5, 'App\\Models\\User', 25),
(5, 'App\\Models\\User', 26),
(5, 'App\\Models\\User', 27),
(5, 'App\\Models\\User', 39),
(5, 'App\\Models\\User', 40),
(5, 'App\\Models\\User', 43),
(5, 'App\\Models\\User', 44),
(5, 'App\\Models\\User', 47),
(6, 'App\\Models\\User', 21),
(6, 'App\\Models\\User', 23),
(6, 'App\\Models\\User', 41),
(6, 'App\\Models\\User', 45),
(6, 'App\\Models\\User', 46),
(6, 'App\\Models\\User', 48),
(6, 'App\\Models\\User', 49),
(6, 'App\\Models\\User', 51),
(6, 'App\\Models\\User', 52),
(9, 'App\\Models\\User', 28),
(9, 'App\\Models\\User', 29),
(9, 'App\\Models\\User', 30),
(9, 'App\\Models\\User', 31),
(9, 'App\\Models\\User', 32),
(9, 'App\\Models\\User', 33),
(11, 'App\\Models\\User', 53),
(11, 'App\\Models\\User', 54),
(11, 'App\\Models\\User', 55);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('38a86b17-fea6-4fa5-9ad2-3bc273f9be66', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 1, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:08:43', '2023-07-20 16:08:43'),
('615b6fc8-930f-410d-a14b-b0783f132637', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 2, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:08:44', '2023-07-20 16:08:44'),
('1483b989-998c-4019-9cc5-dcd76de6ac30', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 3, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:08:45', '2023-07-20 16:08:45'),
('324e7cd8-b7b6-4552-9eca-7225a7e63f79', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 4, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:08:46', '2023-07-20 16:08:46'),
('c9b2d8c2-b3b5-4f04-8752-11f1cfd0d32e', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 5, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:08:48', '2023-07-20 16:08:48'),
('f7689b01-ecdc-4ca6-9d22-8823209fd90c', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 6, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:08:49', '2023-07-20 16:08:49'),
('60452de7-25e3-47ca-9f9d-c53883bf7632', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 7, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:08:50', '2023-07-20 16:08:50'),
('b7b4b0f8-656c-4561-80a4-0ad2e6375a94', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 8, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:08:51', '2023-07-20 16:08:51'),
('ecabcdaa-b830-4d77-bec5-4ef2dd954863', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 9, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:08:52', '2023-07-20 16:08:52'),
('8143a919-e0e9-4fd1-9961-a8198c3e7d33', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 10, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:08:53', '2023-07-20 16:08:53'),
('bdb33b6c-37d3-45c5-a422-000bb0ff1e5a', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 11, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:08:54', '2023-07-20 16:08:54'),
('c216ab11-5c03-4292-90c5-616443bbf88e', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 12, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:08:56', '2023-07-20 16:08:56'),
('68f3e7fd-ddbb-46ff-a017-93d885f66379', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 13, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:08:57', '2023-07-20 16:08:57'),
('ec6fcdab-0ed8-4fb9-b402-be03c32f891d', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 14, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:08:58', '2023-07-20 16:08:58'),
('c3dd0d01-fa6b-43af-ac49-cd24de4309a2', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 15, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:08:59', '2023-07-20 16:08:59'),
('5167091c-bd2b-482e-aceb-3a2520952969', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 16, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:00', '2023-07-20 16:09:00'),
('d0507c9e-68e1-42ee-b977-9dfd873f16a4', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 17, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:01', '2023-07-20 16:09:01'),
('9d39de4d-e070-4c31-a3ac-d7cb10ebbb4d', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 18, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:02', '2023-07-20 16:09:02'),
('0ae4b59f-ac02-4f68-9828-132f94ec5294', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 19, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:03', '2023-07-20 16:09:03'),
('cab9bb89-a0d2-4c17-9e24-967a79459237', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 20, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:04', '2023-07-20 16:09:04'),
('150a14f8-1c36-4ed7-93a7-6dfb73f2cb21', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 21, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:06', '2023-07-20 16:09:06'),
('99f29329-8320-47eb-8af8-584ceda4d2df', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 22, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:07', '2023-07-20 16:09:07'),
('aa865bff-6758-47d4-8c37-71d0c25efc2d', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 23, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:08', '2023-07-20 16:09:08'),
('12ee8a66-ddfb-4dd6-b34b-575082995c86', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 24, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:09', '2023-07-20 16:09:09'),
('868e56f2-731b-492a-9705-4a420f8a2807', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 25, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:10', '2023-07-20 16:09:10'),
('a0a8a9ce-310f-4209-abea-50e5754d1bf6', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 26, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:11', '2023-07-20 16:09:11'),
('0dd3c4e3-04d7-4f32-b3e5-30cbc44f3235', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 27, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:12', '2023-07-20 16:09:12'),
('6cadb2e4-95fe-4aa4-b53f-5d1c492f4e54', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 28, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:14', '2023-07-20 16:09:14'),
('5010f63b-3d62-4faa-b460-5db3d0dc4575', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 29, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:15', '2023-07-20 16:09:15'),
('9af566cf-3c34-4454-b972-b61bbc0e0057', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 30, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:16', '2023-07-20 16:09:16'),
('4b8d1a13-993c-4481-ab4d-6aee5de149b4', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 31, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:17', '2023-07-20 16:09:17'),
('cc90ba8a-2e2a-4d23-80a9-40a90b537aab', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 32, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:18', '2023-07-20 16:09:18'),
('1457dcfb-bc7d-48d0-9758-811be4c7a09d', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 33, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:19', '2023-07-20 16:09:19'),
('39be4b86-bdf1-4b94-8d16-d460436a311e', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 34, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:20', '2023-07-20 16:09:20'),
('d4d1f8f7-d28a-42a0-a78b-7134a9b7c7b8', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 35, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:21', '2023-07-20 16:09:21'),
('2a53bf0c-9c53-455f-bc4a-b6445518bd61', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 36, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:23', '2023-07-20 16:09:23'),
('609b424b-eec6-45bb-9761-82ba71b59ba6', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 37, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:24', '2023-07-20 16:09:24'),
('50fdd87f-722d-489a-8fc6-ba11d1110a3b', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 38, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:25', '2023-07-20 16:09:25'),
('5605c403-c1c2-476f-ae12-60bb83e7b625', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 39, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:26', '2023-07-20 16:09:26'),
('8f3ca34d-2c07-4c89-9200-bbac8566dae6', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 40, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:27', '2023-07-20 16:09:27'),
('108d1993-34f7-41c5-be2d-8b17ad1e06e3', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 41, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:29', '2023-07-20 16:09:29'),
('af61b380-7cb6-47e5-aa64-20e380f0a3f6', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 42, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:30', '2023-07-20 16:09:30'),
('b991fea3-5ab2-4995-923b-d16f396201dc', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 43, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:31', '2023-07-20 16:09:31'),
('2404497d-9ca1-468c-a2b3-f4e1d9dceeeb', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 44, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:32', '2023-07-20 16:09:32'),
('257edbfa-7657-4d07-a761-6f1b9548a92b', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 45, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:33', '2023-07-20 16:09:33'),
('ec95ec1c-ae75-4c5e-b15a-77bd202ef3e3', 'App\\Notifications\\CourseRegisterNotification', 'App\\Models\\Student', 83, '{\"data\":{\"subject\":\"Hello\"},\"reason\":\"contact\"}', NULL, '2023-07-20 16:09:34', '2023-07-20 16:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_guest` tinyint(1) NOT NULL DEFAULT '0',
  `order_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_total` decimal(8,2) DEFAULT NULL,
  `coupon_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_charges` decimal(8,2) DEFAULT NULL,
  `tax` decimal(8,2) DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `delivery_details` longtext COLLATE utf8_unicode_ci,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_details` longtext COLLATE utf8_unicode_ci,
  `customer_details` longtext COLLATE utf8_unicode_ci,
  `metadata` longtext COLLATE utf8_unicode_ci,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status_id`, `is_guest`, `order_number`, `sub_total`, `coupon_code`, `shipping_charges`, `tax`, `total`, `delivery_details`, `payment_method`, `payment_details`, `customer_details`, `metadata`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 1, 1, 'TBZ230220073217twMOF5', '134.00', NULL, '0.00', '0.00', '134.00', '{\"first_name\":\"Joseph\",\"last_name\":\"Stalin\",\"address\":\"Street 45, Test address\",\"city\":\"New York\",\"state\":\"11\",\"zipcode\":\"12333\"}', 'credit card', '{\"name\":\"John\",\"credit_card\":\"4111111111111111\",\"cvv\":\"123\",\"exp_month\":\"03\",\"exp_year\":\"2025\"}', '{\"salutation\":\"mr\",\"first_name\":\"Joseph\",\"last_name\":\"STalin\",\"email\":\"jostalin376@gmail.com\"}', NULL, 'new', '2023-02-21 02:32:17', '2023-02-21 02:32:17', NULL),
(2, NULL, 1, 1, 'TBZ230220112238HshH42', '270.00', NULL, '0.00', '0.00', '270.00', '{\"first_name\":\"Ethan\",\"last_name\":\"PAtrick\",\"address\":\"Street 45, Test address\",\"city\":\"New York\",\"state\":\"12\",\"zipcode\":\"12333\"}', 'paypal', 'null', '{\"salutation\":\"mr\",\"first_name\":\"Joseph\",\"last_name\":\"Stalin\",\"email\":\"jostalin376@gmail.com\"}', NULL, 'new', '2023-02-21 06:22:38', '2023-02-21 06:22:38', NULL),
(3, NULL, 4, 1, 'TBZ230221064649Wbjbn1', '22.00', NULL, '0.00', '0.00', '22.00', '{\"first_name\":\"Joseph\",\"last_name\":\"Stalin\",\"address\":\"Street 45, Test address\",\"city\":\"New York\",\"state\":\"Feni\",\"zipcode\":\"12333\"}', 'paypal', 'null', '{\"salutation\":\"mr\",\"first_name\":\"Joseph\",\"last_name\":\"Stalin\",\"email\":\"jostalin376@gmail.com\"}', NULL, 'processing', '2023-02-22 01:46:49', '2023-02-23 07:55:16', NULL),
(4, 5, 5, 0, 'TBZ230221064744tn0f13', '47.50', NULL, '0.00', '0.00', '47.50', '{\"first_name\":\"Joseph\",\"last_name\":\"Stalin\",\"address\":\"Street 45, Test address\",\"city\":\"New York\",\"state\":\"Feni\",\"zipcode\":\"12333\"}', 'paypal', 'null', '{\"salutation\":\"mr\",\"first_name\":\"Ethan\",\"last_name\":\"PAtrick\",\"email\":\"ethanpatrik175@gmail.com\"}', NULL, 'deliver', '2023-02-22 01:47:44', '2023-04-06 21:13:57', NULL),
(5, NULL, NULL, 1, 'TBZ230420124139x1dXW1', '50.00', NULL, '0.00', '0.00', '50.00', '{\"first_name\":\"Molly\",\"last_name\":\"Burns\",\"address\":\"Exercitationem sit d\",\"city\":\"Suscipit similique l\",\"state\":\"Omnis odio tempore\",\"zipcode\":\"84133\"}', 'paypal', 'null', '{\"salutation\":\"mr\",\"first_name\":\"Amber\",\"last_name\":\"Foreman\",\"email\":\"jocij@mailinator.com\"}', NULL, 'new', '2023-04-20 00:41:39', '2023-04-20 00:41:39', NULL),
(6, NULL, NULL, 1, 'TBZ230420011856xCdHs1', '12.00', NULL, '0.00', '0.00', '12.00', '{\"first_name\":\"Althea\",\"last_name\":\"Anderson\",\"address\":\"Qui sapiente quidem\",\"city\":\"Aute mollit in ipsum\",\"state\":\"Reiciendis aute in q\",\"zipcode\":\"12645\"}', 'paypal', 'null', '{\"salutation\":\"mrs\",\"first_name\":\"Chloe\",\"last_name\":\"Bauer\",\"email\":\"mizafihac@mailinator.com\"}', NULL, 'new', '2023-04-20 01:18:56', '2023-04-20 01:18:56', NULL),
(7, NULL, NULL, 1, 'TBZ230420014709CbnQD0', '0.00', NULL, '0.00', '0.00', '0.00', '{\"first_name\":\"Quail\",\"last_name\":\"Dennis\",\"address\":\"Qui et ut consectetu\",\"city\":\"Culpa molestiae qui\",\"state\":\"Eum consectetur cup\",\"zipcode\":\"37404\"}', 'credit card', '{\"name\":\"Test\",\"credit_card\":\"5555555555554444\",\"cvv\":\"123\",\"exp_month\":\"11\",\"exp_year\":\"2031\"}', '{\"salutation\":\"mrs\",\"first_name\":\"Ivan\",\"last_name\":\"Cervantes\",\"email\":\"wewi@mailinator.com\"}', NULL, 'new', '2023-04-20 01:47:09', '2023-04-20 01:47:09', NULL),
(8, NULL, NULL, 1, 'TBZ230420025123OJ2dA1', '25.00', NULL, '0.00', '0.00', '25.00', '{\"first_name\":\"Gabriel\",\"last_name\":\"Tanner\",\"address\":\"Consequatur eum cons\",\"city\":\"Doloremque cupiditat\",\"state\":\"Sint ut fuga Non al\",\"zipcode\":\"15139\"}', 'paypal', 'null', '{\"salutation\":\"mr\",\"first_name\":\"Jael\",\"last_name\":\"Hays\",\"email\":\"gomebuqy@mailinator.com\"}', NULL, 'new', '2023-04-20 02:51:23', '2023-04-20 02:51:23', NULL),
(9, NULL, NULL, 1, 'TBZ2304271130461PU4q1', '35.00', NULL, '0.00', '0.00', '35.00', '{\"first_name\":\"Sydney\",\"last_name\":\"Young\",\"address\":\"Nulla pariatur Ea e\",\"city\":\"Voluptatibus eos vol\",\"state\":\"Ab qui aspernatur an\",\"zipcode\":\"72779\"}', 'credit card', '{\"name\":\"trsdt\",\"credit_card\":\"4242424242424242\",\"cvv\":\"123\",\"exp_month\":\"10\",\"exp_year\":\"2026\"}', '{\"salutation\":\"mrs\",\"first_name\":\"Emmanuel\",\"last_name\":\"Mcdaniel\",\"email\":\"cizedamyf@mailinator.com\"}', NULL, 'new', '2023-04-27 23:30:46', '2023-04-27 23:30:46', NULL),
(10, NULL, NULL, 1, 'TBZ230428062844WnBEd1', '30.00', NULL, '0.00', '0.00', '30.00', '{\"first_name\":\"Ethan\",\"last_name\":\"PAtrick\",\"address\":\"Street 45, Test address\",\"city\":\"New York\",\"state\":\"New York\",\"zipcode\":\"12333\"}', 'paypal', 'null', '{\"salutation\":\"mr\",\"first_name\":\"Ethan\",\"last_name\":\"PAtrick\",\"email\":\"ethanpatrik175@gmail.com\"}', NULL, 'new', '2023-04-28 18:28:44', '2023-04-28 18:28:44', NULL),
(11, NULL, NULL, 1, 'TBZ2304281111297nlWG1', '35.00', NULL, '0.00', '0.00', '35.00', '{\"first_name\":\"Hermione\",\"last_name\":\"Vega\",\"address\":\"Voluptas consectetur\",\"city\":\"Placeat ut in qui a\",\"state\":\"Velit qui mollit do\",\"zipcode\":\"81038\"}', 'paypal', 'null', '{\"salutation\":\"mr\",\"first_name\":\"Yuli\",\"last_name\":\"Horn\",\"email\":\"duqoki@mailinator.com\"}', NULL, 'new', '2023-04-28 23:11:29', '2023-04-28 23:11:29', NULL),
(12, NULL, NULL, 1, 'TBZ230429015053caFKD1', '35.00', NULL, '0.00', '0.00', '35.00', '{\"first_name\":\"Richard\",\"last_name\":\"Branson\",\"address\":\"Golden Road, Silver street 5-B\",\"city\":\"New York\",\"state\":\"Velit qui mollit do\",\"zipcode\":\"10001\"}', 'paypal', 'null', '{\"salutation\":\"mr\",\"first_name\":\"Richard\",\"last_name\":\"Branson\",\"email\":\"richardbranson993@gmail.com\"}', NULL, 'new', '2023-04-29 01:50:53', '2023-04-29 01:50:53', NULL),
(13, NULL, NULL, 1, 'TBZ230429015159sPj7T1', '45.00', NULL, '0.00', '0.00', '45.00', '{\"first_name\":\"Richard\",\"last_name\":\"Branson\",\"address\":\"Golden Road, Silver street 5-B\",\"city\":\"New York\",\"state\":\"Velit qui mollit do\",\"zipcode\":\"10001\"}', 'paypal', 'null', '{\"salutation\":\"mr\",\"first_name\":\"Richard\",\"last_name\":\"Branson\",\"email\":\"richardbranson993@gmail.com\"}', NULL, 'new', '2023-04-29 01:51:59', '2023-04-29 01:51:59', NULL),
(14, NULL, 1, 1, 'TBZ230502065044uybzc1', '25.00', NULL, '0.00', '0.00', '25.00', '{\"first_name\":\"Joseph\",\"last_name\":\"Stalin\",\"address\":\"Street 45, Test address\",\"city\":\"New York\",\"state\":\"Feni\",\"zipcode\":\"12333\"}', 'cod', 'null', '{\"salutation\":\"mr\",\"first_name\":\"Joseph\",\"last_name\":\"Stalin\",\"email\":\"jostalin376@gmail.com\"}', NULL, 'new', '2023-05-02 18:50:44', '2023-05-02 18:50:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_histories`
--

DROP TABLE IF EXISTS `order_histories`;
CREATE TABLE IF NOT EXISTS `order_histories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_histories`
--

INSERT INTO `order_histories` (`id`, `order_id`, `status`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'processing', 'The order status has been changed to processing with order no#TBZ230221064649Wbjbn1', '2023-02-23 07:55:16', '2023-02-23 07:55:16', NULL),
(2, 4, 'processing', 'The order status has been changed to processing with order no#TBZ230221064744tn0f13', '2023-04-06 21:13:18', '2023-04-06 21:13:18', NULL),
(3, 4, 'deliver', 'The order status has been changed to deliver with order no#TBZ230221064744tn0f13', '2023-04-06 21:13:57', '2023-04-06 21:13:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `variation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_variation` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `quantity` int(11) DEFAULT NULL,
  `total_amount` decimal(12,4) NOT NULL,
  `metadata` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `variation_id`, `is_variation`, `image`, `sku`, `name`, `price`, `quantity`, `total_amount`, `metadata`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 10, NULL, 0, 'http://localhost:8000/assets/frontend/images/products/zigzag-100mm.png', NULL, 'Zig Zag 100mm Rolling Machine', '12.0000', 1, '12.0000', NULL, '2023-02-21 02:32:17', '2023-02-21 02:32:17', NULL),
(2, 1, 11, NULL, 0, 'http://localhost:8000/assets/frontend/images/products/aero-spaced.png', NULL, 'Aero spaced by Higher Standards 4 Piece Grinder 1.6\" (40 mm)', '25.0000', 1, '25.0000', NULL, '2023-02-21 02:32:17', '2023-02-21 02:32:17', NULL),
(3, 1, 13, NULL, 0, 'http://localhost:8000/assets/frontend/images/products/image018.png', NULL, 'Blazy Susan - Metallic Tray - Rose | 9.25\" x 7\"', '22.0000', 1, '22.0000', NULL, '2023-02-21 02:32:17', '2023-02-21 02:32:17', NULL),
(4, 1, NULL, 10, 1, 'http://localhost:8000/assets/frontend/images/variations/image008.jpg', NULL, 'CBN 300 ml', '30.0000', 1, '30.0000', NULL, '2023-02-21 02:32:17', '2023-02-21 02:32:17', NULL),
(5, 1, NULL, 13, 1, 'http://localhost:8000/assets/frontend/images/variations/warming-2k.png', NULL, 'Warming 2000 mg', '45.0000', 1, '45.0000', NULL, '2023-02-21 02:32:17', '2023-02-21 02:32:17', NULL),
(6, 2, NULL, 6, 1, 'http://localhost:8000/assets/frontend/images/variations/image004.jpg', NULL, 'CBD 300 ml', '30.0000', 4, '120.0000', NULL, '2023-02-21 06:22:38', '2023-02-21 06:22:38', NULL),
(7, 2, 11, NULL, 0, 'http://localhost:8000/assets/frontend/images/products/aero-spaced.png', NULL, 'Aero spaced by Higher Standards 4 Piece Grinder 1.6\" (40 mm)', '25.0000', 6, '150.0000', NULL, '2023-02-21 06:22:38', '2023-02-21 06:22:38', NULL),
(8, 3, 9, NULL, 0, 'http://localhost:8000/assets/frontend/images/products/image012.jpg', NULL, 'Pulsar Quartz Deco Dab Straw', '22.0000', 1, '22.0000', NULL, '2023-02-22 01:46:49', '2023-02-22 01:46:49', NULL),
(9, 4, 12, NULL, 0, 'http://localhost:8000/assets/frontend/images/products/image016.png', NULL, 'Multi-Function Silicone Ashtray', '25.0000', 1, '25.0000', NULL, '2023-02-22 01:47:44', '2023-02-22 01:47:44', NULL),
(10, 4, 13, NULL, 0, 'http://localhost:8000/assets/frontend/images/products/image018.png', NULL, 'Blazy Susan - Metallic Tray - Rose | 9.25\" x 7\"', '22.0000', 1, '22.0000', NULL, '2023-02-22 01:47:44', '2023-02-22 01:47:44', NULL),
(11, 4, 14, NULL, 0, 'http://localhost:8000/assets/frontend/images/products/image020.jpg', NULL, '6mm Quartz Terp Pearls | Clear', '0.5000', 1, '0.5000', NULL, '2023-02-22 01:47:44', '2023-02-22 01:47:44', NULL),
(12, 5, 11, NULL, 0, 'https://alpha.yourwebsitedemos.com/web/taste-budz/assets/frontend/images/products/aero-spaced.png', NULL, 'Aero spaced by Higher Standards 4 Piece Grinder 1.6\" (40 mm)', '25.0000', 2, '50.0000', NULL, '2023-04-20 00:41:39', '2023-04-20 00:41:39', NULL),
(13, 6, 10, NULL, 0, 'https://alpha.yourwebsitedemos.com/web/taste-budz/assets/frontend/images/products/zigzag-100mm.png', NULL, 'Zig Zag 100mm Rolling Machine', '12.0000', 1, '12.0000', NULL, '2023-04-20 01:18:56', '2023-04-20 01:18:56', NULL),
(14, 8, 11, NULL, 0, 'https://alpha.yourwebsitedemos.com/web/taste-budz/assets/frontend/images/products/aero-spaced.png', NULL, 'Aero spaced by Higher Standards 4 Piece Grinder 1.6\" (40 mm)', '25.0000', 1, '25.0000', NULL, '2023-04-20 02:51:23', '2023-04-20 02:51:23', NULL),
(15, 9, NULL, 3, 1, 'http://alpha.yourwebsitedemos.com/web/taste-budz/assets/frontend/images/variations/cbd.png', NULL, 'CBD Lemon 20 gummies', '35.0000', 1, '35.0000', NULL, '2023-04-27 23:30:46', '2023-04-27 23:30:46', NULL),
(16, 10, NULL, 6, 1, 'https://alpha.yourwebsitedemos.com/web/taste-budz/assets/frontend/images/variations/image004.jpg', NULL, 'CBD 300 ml', '30.0000', 1, '30.0000', NULL, '2023-04-28 18:28:44', '2023-04-28 18:28:44', NULL),
(17, 11, NULL, 3, 1, 'https://alpha.yourwebsitedemos.com/web/taste-budz/assets/frontend/images/variations/cbd.png', NULL, 'CBD Lemon 20 gummies', '35.0000', 1, '35.0000', NULL, '2023-04-28 23:11:29', '2023-04-28 23:11:29', NULL),
(18, 12, NULL, 3, 1, 'https://alpha.yourwebsitedemos.com/web/taste-budz/assets/frontend/images/variations/cbd.png', NULL, 'CBD Lemon 20 gummies', '35.0000', 1, '35.0000', NULL, '2023-04-29 01:50:53', '2023-04-29 01:50:53', NULL),
(19, 13, NULL, 12, 1, 'https://alpha.yourwebsitedemos.com/web/taste-budz/assets/frontend/images/variations/cooling-2k.png', NULL, 'Cooling 2000mg', '45.0000', 1, '45.0000', NULL, '2023-04-29 01:51:59', '2023-04-29 01:51:59', NULL),
(20, 14, 11, NULL, 0, 'https://alpha.yourwebsitedemos.com/web/taste-budz/assets/frontend/images/products/aero-spaced.png', NULL, 'Aero spaced by Higher Standards 4 Piece Grinder 1.6\" (40 mm)', '25.0000', 1, '25.0000', NULL, '2023-05-02 18:50:44', '2023-05-02 18:50:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_payments`
--

DROP TABLE IF EXISTS `order_payments`;
CREATE TABLE IF NOT EXISTS `order_payments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `data` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

DROP TABLE IF EXISTS `order_statuses`;
CREATE TABLE IF NOT EXISTS `order_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'new',
  `message` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `title`, `message`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'new', 'Your order is on the pending list, we will inform you when it processes further. Kindly continue to check your dashboard or email.', 'active', '2021-11-11 04:22:45', '2022-10-15 16:33:00', NULL),
(2, 'approve', 'Your order has been approved, We will get back to you soon.', 'active', '2021-11-11 04:30:55', '2021-11-11 04:30:55', NULL),
(3, 'completed', 'Order Reservation Completed.', 'active', '2021-11-11 04:32:50', '2022-10-20 07:10:11', NULL),
(4, 'processing', 'We are processing your selected products.', 'active', '2021-11-11 04:35:54', '2022-10-20 07:08:15', NULL),
(5, 'deliver', 'Congratulations!.. The Products you selected have been delivered! We are happy to deliver you better services!', 'active', '2021-11-11 04:36:35', '2021-11-11 05:23:55', NULL),
(6, 'cancell', 'We are sorry, your order has been cancelled.', 'active', '2021-11-11 04:37:12', '2021-11-11 04:37:12', NULL),
(7, 'Refund', 'Your Order has been refund successfuly!', 'active', '2021-11-11 04:37:42', '2021-11-11 04:37:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `package_permissions`
--

DROP TABLE IF EXISTS `package_permissions`;
CREATE TABLE IF NOT EXISTS `package_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reference_id` bigint(20) UNSIGNED DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `added_by`, `updated_by`, `parent_id`, `name`, `slug`, `order`, `link`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, NULL, NULL, 'Home', 'home', '1', NULL, 1, '2023-02-02 03:54:54', '2023-02-02 03:54:54', NULL),
(2, 5, NULL, NULL, 'About US', 'about-us', '1', NULL, 1, '2023-02-02 03:55:11', '2023-02-02 03:55:11', NULL),
(3, 5, 5, NULL, 'SHOP CANNABIS or Products', 'shop-cannabis-or-products', '1', NULL, 1, '2023-02-02 03:55:31', '2023-02-02 09:18:48', NULL),
(4, 5, NULL, NULL, 'Safe Practices', 'safe-practices', '1', NULL, 1, '2023-02-02 03:55:44', '2023-02-02 03:55:44', NULL),
(5, 5, NULL, NULL, 'Contact Us', 'contact-us', '1', NULL, 1, '2023-02-02 03:55:53', '2023-02-02 03:55:53', NULL),
(6, 5, NULL, NULL, 'Login', 'login', '1', NULL, 1, '2023-02-02 03:56:11', '2023-02-02 03:56:11', NULL),
(7, 5, NULL, NULL, 'Register', 'register', '1', NULL, 1, '2023-02-02 03:56:16', '2023-02-02 03:56:16', NULL),
(8, 5, NULL, NULL, 'Blogs', 'blogs', '1', NULL, 1, '2023-02-22 03:43:43', '2023-02-22 03:43:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page_contents`
--

DROP TABLE IF EXISTS `page_contents`;
CREATE TABLE IF NOT EXISTS `page_contents` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `key` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_contents_key_unique` (`key`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `page_contents`
--

INSERT INTO `page_contents` (`id`, `page_id`, `type`, `key`, `content`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'text', 'section_one_heading1', 'OUR CATEGORIES', 1, '2023-02-02 09:27:43', '2023-02-02 09:27:43', NULL),
(2, 1, 'text', 'section_two_heading1', 'ABOUT US', 1, '2023-02-02 09:48:31', '2023-02-02 09:48:31', NULL),
(3, 1, 'text', 'section_two_heading2', 'ALL OF OUR PRODUCTS ARE INDEPENDENTLY LAB TESTED FOR SAFETY', 1, '2023-02-02 09:48:53', '2023-02-02 09:48:53', NULL),
(4, 1, 'content', 'section_two_description', 'Taste Budz began its journey in Virginia Beach with its flagship, VBCBD. After 2 years of successful business we expanded to Washington DC. We deal in alternative medicine that aims to bring physical, mental, emotional and spiritual healing to our customers. With Taste Budz, our goal is to remove the stigma attached to natural medicine and prove that it is, in fact, safe to use and benefits people in multiple ways; from removing pain, reducing anxiety, improving mood, relieving muscle tension, increasing relaxation, among many others. We plan to do this by spreading education and advocating for alternative medication. Opening March 6, our DC location will be our biggest center ever and will hopefully break the stigma of alternative medicine in a big way! In the near future, we hope to be a national company.', 1, '2023-02-02 09:49:59', '2023-02-23 08:19:55', NULL),
(5, 1, 'links', 'section_two_button', '{\"label\":\"Shop Now\",\"link\":\"front.products\"}', 1, '2023-02-02 09:52:07', '2023-02-02 10:01:49', NULL),
(6, 1, 'image', 'section_two_image1', '1-about-img-1.png', 1, '2023-02-02 10:04:21', '2023-02-02 10:04:21', NULL),
(7, 1, 'image', 'section_two_image2', '1-about-img-2.png', 1, '2023-02-02 10:04:33', '2023-02-02 10:04:33', NULL),
(8, 1, 'image', 'section_two_image3', '1-object-1.png', 1, '2023-02-23 08:25:58', '2023-02-23 08:25:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('ethanpatrik175@gmail.com', '$2y$10$TeqA5mT6e18jODNlcuhkN.jSYDrJcu0T2GBjhsrKaLYRvOU4ab9DG', '2023-06-06 11:33:42'),
('richardbranson993@gmail.com', '$2y$10$/lJ2vub3w0Sh3U1oZkLXi.3dP9ZX31yU2fgfS4dH2ZghslVyfWj/C', '2023-06-23 21:03:57');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `payment_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payer_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payer_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(10,2) NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payment_id`, `payer_id`, `payer_email`, `amount`, `currency`, `payment_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PAYID-MSKMMTA33B013063V693452H', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 150.00, 'USD', 'approved', '2023-06-22 17:06:17', '2023-06-22 17:06:17', NULL),
(2, 'PAYID-MSKMNZQ2GY21381JN8938230', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 1500.00, 'USD', 'approved', '2023-06-22 17:08:50', '2023-06-22 17:08:50', NULL),
(3, 'PAYID-MSKMPGI9NR46321DK903894W', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 700.00, 'USD', 'approved', '2023-06-22 17:11:49', '2023-06-22 17:11:49', NULL),
(4, 'PAYID-MSKMPWQ4Y263004UT661494P', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 50.00, 'USD', 'approved', '2023-06-22 17:12:55', '2023-06-22 17:12:55', NULL),
(5, 'PAYID-MSKMVJQ4JF84893TG863614J', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 100.00, 'USD', 'approved', '2023-06-22 17:24:55', '2023-06-22 17:24:55', NULL),
(6, 'PAYID-MSKMYEQ2FL35714K4926553S', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 50.00, 'USD', 'approved', '2023-06-22 17:30:54', '2023-06-22 17:30:54', NULL),
(7, 'PAYID-MSKMZ4A0KN27660TJ227130Y', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 50.00, 'USD', 'approved', '2023-06-22 17:34:36', '2023-06-22 17:34:36', NULL),
(8, 'PAYID-MSK5XUQ69H14563N7507121U', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 50.00, 'USD', 'approved', '2023-06-23 12:50:25', '2023-06-23 12:50:25', NULL),
(9, 'PAYID-MSK5YEI4DM35962WU634223F', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 200.00, 'USD', 'approved', '2023-06-23 12:51:23', '2023-06-23 12:51:23', NULL),
(10, 'PAYID-MSK52MY64165359EX1317842', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 50.00, 'USD', 'approved', '2023-06-23 12:56:14', '2023-06-23 12:56:14', NULL),
(11, 'PAYID-MSK54DA1CJ10972R3424630L', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 150.00, 'USD', 'approved', '2023-06-23 12:59:50', '2023-06-23 12:59:50', NULL),
(12, 'PAYID-MSK56QI2W952952GM784262L', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 150.00, 'USD', 'approved', '2023-06-23 13:05:00', '2023-06-23 13:05:00', NULL),
(13, 'PAYID-MSK6IDA0AR738953X128484R', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 50.00, 'USD', 'approved', '2023-06-23 13:25:31', '2023-06-23 13:25:31', NULL),
(14, 'PAYID-MSK6JHY7JE19413X4545693H', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 100.00, 'USD', 'approved', '2023-06-23 13:27:53', '2023-06-23 13:27:53', NULL),
(15, 'PAYID-MSK6RPY8NY132940V539561N', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 250.00, 'USD', 'approved', '2023-06-23 13:45:32', '2023-06-23 13:45:32', NULL),
(16, 'PAYID-MSK6ZMQ4Y214891WM4081730', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 100.00, 'USD', 'approved', '2023-06-23 14:02:23', '2023-06-23 14:02:23', NULL),
(17, 'PAYID-MSK7DEY2SK99015PF515434R', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 150.00, 'USD', 'approved', '2023-06-23 14:23:13', '2023-06-23 14:23:13', NULL),
(18, 'PAYID-MSLAY6Q01M24626FK8048415', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 150.00, 'USD', 'approved', '2023-06-23 16:18:03', '2023-06-23 16:18:03', NULL),
(19, 'PAYID-MSLA4PA5MJ69056WV4871105', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 50.00, 'USD', 'approved', '2023-06-23 16:25:28', '2023-06-23 16:25:28', NULL),
(20, 'PAYID-MSLA5XQ7XH779211P501750U', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 50.00, 'USD', 'approved', '2023-06-23 16:29:11', '2023-06-23 16:29:11', NULL),
(21, 'PAYID-MSLBD4Q98T85267GF3424308', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 50.00, 'USD', 'approved', '2023-06-23 16:41:22', '2023-06-23 16:41:22', NULL),
(22, 'PAYID-MSLBEUY8TW6152453614074Y', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 50.00, 'USD', 'approved', '2023-06-23 16:42:55', '2023-06-23 16:42:55', NULL),
(23, 'PAYID-MSLBFPY5M043444E3788560J', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 50.00, 'USD', 'approved', '2023-06-23 16:44:41', '2023-06-23 16:44:41', NULL),
(24, 'PAYID-MSLBF6I89V729847V833225U', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 50.00, 'USD', 'approved', '2023-06-23 16:45:41', '2023-06-23 16:45:41', NULL),
(25, 'PAYID-MSLBHVA4EN11204CU649782A', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 50.00, 'USD', 'approved', '2023-06-23 16:49:18', '2023-06-23 16:49:18', NULL),
(26, 'PAYID-MSLBHVA4EN11204CU649782A', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 50.00, 'USD', 'approved', '2023-06-23 16:50:21', '2023-06-23 16:50:21', NULL),
(27, 'PAYID-MSLBHVA4EN11204CU649782A', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 50.00, 'USD', 'approved', '2023-06-23 16:51:02', '2023-06-23 16:51:02', NULL),
(28, 'PAYID-MSLBI3Q1B882700T7596461V', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 150.00, 'USD', 'approved', '2023-06-23 16:51:53', '2023-06-23 16:51:53', NULL),
(29, 'PAYID-MSLBPHQ4U40446452277950S', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 100.00, 'USD', 'approved', '2023-06-23 17:05:43', '2023-06-23 17:05:43', NULL),
(30, 'PAYID-MSLBSOI3B364428B13036105', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 100.00, 'USD', 'approved', '2023-06-23 17:12:20', '2023-06-23 17:12:20', NULL),
(31, 'PAYID-MSLEDQQ4NV2867207789191Y', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 449.00, 'USD', 'approved', '2023-06-23 20:05:21', '2023-06-23 20:05:21', NULL),
(32, 'PAYID-MSLEJMY45D429755E8894848', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 449.00, 'USD', 'approved', '2023-06-23 20:17:51', '2023-06-23 20:17:51', NULL),
(33, 'PAYID-MSLEQUA24646836S7037224C', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 449.00, 'USD', 'approved', '2023-06-23 20:33:18', '2023-06-23 20:33:18', NULL),
(34, 'PAYID-MSLE2IA7TK416248V305022W', '7HK3DHBAVAS22', 'sb-i1you21416954@business.example.com', 449.00, 'USD', 'approved', '2023-06-23 20:53:52', '2023-06-23 20:53:52', NULL),
(35, 'PAYID-MSLFSGY4P448348JA8684200', 'Y7457CR4XCYCJ', 'sb-sk43h126405752@personal.example.com', 449.00, 'USD', 'approved', '2023-06-23 21:50:49', '2023-06-23 21:50:49', NULL),
(36, 'PAYID-MSLG57Y1VM33499DJ714870M', 'Y7457CR4XCYCJ', 'sb-sk43h126405752@personal.example.com', 449.00, 'USD', 'approved', '2023-06-23 23:23:51', '2023-06-23 23:23:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user-create', 'web', '2023-05-31 12:43:47', '2023-05-31 12:43:47'),
(2, 'user-list', 'web', '2023-05-31 13:32:06', '2023-05-31 13:32:06'),
(3, 'user-edit', 'web', '2023-05-31 13:32:21', '2023-05-31 13:32:21'),
(4, 'user-delete', 'web', '2023-05-31 13:32:32', '2023-05-31 13:32:32'),
(5, 'product-add', 'web', '2023-05-31 13:33:12', '2023-05-31 13:33:12'),
(6, 'product-edit', 'web', '2023-05-31 13:33:25', '2023-05-31 13:33:25'),
(7, 'product-delete', 'web', '2023-05-31 13:33:36', '2023-05-31 13:33:36'),
(8, 'product-list', 'web', '2023-05-31 13:33:56', '2023-05-31 13:33:56'),
(9, 'add-role', 'web', '2023-05-31 17:51:23', '2023-05-31 17:51:23'),
(10, 'edit-role', 'web', '2023-05-31 17:51:33', '2023-05-31 17:51:33'),
(11, 'delete-role', 'web', '2023-05-31 17:51:44', '2023-05-31 17:51:44'),
(12, 'role-list', 'web', '2023-05-31 17:51:54', '2023-05-31 17:51:54'),
(13, 'change-user-status', 'web', '2023-05-31 19:43:38', '2023-05-31 19:43:38'),
(15, 'add-category', 'web', '2023-06-01 21:51:42', '2023-06-01 21:51:42'),
(16, 'edit-category', 'web', '2023-06-01 21:52:01', '2023-06-01 21:52:01'),
(17, 'delete-category', 'web', '2023-06-01 21:52:16', '2023-06-01 21:52:16'),
(18, 'can-change-category-status', 'web', '2023-06-01 22:03:33', '2023-06-01 22:03:33'),
(20, 'product-details', 'web', '2023-06-02 14:01:18', '2023-06-02 14:01:18'),
(22, 'view-product-trash', 'web', '2023-06-02 14:21:05', '2023-06-02 14:21:05'),
(23, 'view-role-trash', 'web', '2023-06-02 14:35:28', '2023-06-02 14:35:28'),
(24, 'update-user', 'web', '2023-06-02 16:52:01', '2023-06-02 16:52:01'),
(25, 'category-list', 'web', '2023-06-02 17:48:25', '2023-06-02 17:48:25'),
(26, 'view-category-trash', 'web', '2023-06-02 17:50:05', '2023-06-02 17:50:05'),
(27, 'can-manage-users', 'web', '2023-06-02 18:49:51', '2023-06-02 18:49:51'),
(28, 'can-add-permission', 'web', '2023-06-02 19:28:12', '2023-06-02 19:28:12'),
(29, 'can-edit-permission', 'web', '2023-06-02 19:28:42', '2023-06-02 19:28:42'),
(30, 'can-delete-permission', 'web', '2023-06-02 19:28:57', '2023-06-02 19:28:57'),
(34, 'can-change-websettings', 'web', '2023-06-02 20:11:12', '2023-06-02 20:11:12'),
(32, 'can-view-permissions', 'web', '2023-06-02 19:31:11', '2023-06-02 19:31:11'),
(35, 'manage-category', 'web', '2023-06-02 20:30:59', '2023-06-02 20:30:59'),
(36, 'can-add-team', 'web', '2023-06-05 13:12:30', '2023-06-05 13:12:30'),
(37, 'can-view-team', 'web', '2023-06-05 14:43:05', '2023-06-05 14:43:05');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 5, 'auth_token', '7fcd1e8b608c4cb4af110cc72a216f451ebc171d6feae78789941bd6c8442e2f', '[\"*\"]', NULL, NULL, '2023-03-08 16:27:29', '2023-03-08 16:27:29'),
(2, 'App\\Models\\User', 5, 'auth_token', 'ef13b00304d0e6a72bbb66270057359666fef02a827935b9ff84b930f45a4132', '[\"*\"]', NULL, NULL, '2023-03-08 17:16:22', '2023-03-08 17:16:22'),
(3, 'App\\Models\\User', 6, 'auth_token', 'f526c5e0873fd547749bc21fd7e45694f2ea23fb10ded77ad964b030c2fbe3ee', '[\"*\"]', NULL, NULL, '2023-03-08 17:18:34', '2023-03-08 17:18:34'),
(4, 'App\\Models\\User', 7, 'auth_token', '4921601ed057570a79166ba6de19e63d3eeed7c4cc4129ebcb948faa6ec153ed', '[\"*\"]', NULL, NULL, '2023-03-08 17:43:12', '2023-03-08 17:43:12'),
(5, 'App\\Models\\User', 5, 'auth_token', 'f3d63ca8f376f6c6cde3d0499cf1c25a9bc44688e938a7e52c222b01760a0914', '[\"*\"]', NULL, NULL, '2023-03-08 19:14:23', '2023-03-08 19:14:23'),
(6, 'App\\Models\\User', 5, 'auth_token', 'bc5b958211d44d8b61becf2b409c70101e312f63a08b48d89c3b68333209529e', '[\"*\"]', NULL, NULL, '2023-03-09 18:29:35', '2023-03-09 18:29:35'),
(7, 'App\\Models\\User', 8, 'auth_token', 'd6950504f640e27cedd134bdb4e9d0806598ee733446328d78d90a40b2c395a7', '[\"*\"]', NULL, NULL, '2023-04-05 19:28:00', '2023-04-05 19:28:00'),
(8, 'App\\Models\\User', 9, 'auth_token', 'e872a18685ca9c6d7d7f53f2ec485e79466d826ab7047883d3cfffa22dde32bf', '[\"*\"]', NULL, NULL, '2023-04-27 21:08:32', '2023-04-27 21:08:32'),
(9, 'App\\Models\\User', 10, 'auth_token', 'a4dc15219a4a3786a6e07a1df828c86d104d309d5eb0c329b9b10045ad074978', '[\"*\"]', NULL, NULL, '2023-04-28 10:48:53', '2023-04-28 10:48:53'),
(10, 'App\\Models\\User', 11, 'auth_token', 'a5fa2e9f27692b45572a59aee4ac57f1a6d5a516fd2e798b722520b1db1b412c', '[\"*\"]', NULL, NULL, '2023-04-28 10:52:36', '2023-04-28 10:52:36'),
(11, 'App\\Models\\User', 12, 'auth_token', '5398c79a64d6aee9a240bec1fbb5e96d09a1d38d7a649825e2e29cb97f2d2245', '[\"*\"]', NULL, NULL, '2023-04-28 10:59:43', '2023-04-28 10:59:43'),
(12, 'App\\Models\\User', 13, 'auth_token', '9d401eaff93866caed0b2d6dd1792aded61867102e7e2b8c938fc384fb047a04', '[\"*\"]', NULL, NULL, '2023-04-28 11:00:44', '2023-04-28 11:00:44'),
(13, 'App\\Models\\User', 12, 'auth_token', 'aff312a2018dc72e02b9f7052683e3db72135f20caee490f9837fe8faf43d261', '[\"*\"]', NULL, NULL, '2023-04-28 11:06:03', '2023-04-28 11:06:03'),
(14, 'App\\Models\\User', 5, 'auth_token', '80b84c79b93ec63514440a38008757fe1258e674333028a40b8edb40626030af', '[\"*\"]', NULL, NULL, '2023-04-28 11:17:24', '2023-04-28 11:17:24'),
(15, 'App\\Models\\User', 14, 'auth_token', '3bf23ac858aee02a10c783a2b8e24022ee085a34786c7f18817cc46472010b5d', '[\"*\"]', NULL, NULL, '2023-04-28 11:23:35', '2023-04-28 11:23:35'),
(16, 'App\\Models\\User', 12, 'auth_token', 'f9f1fd77005bf1cde2c047ede32c3428cc6447fe971c644661928ecd04e135dc', '[\"*\"]', NULL, NULL, '2023-04-28 11:28:13', '2023-04-28 11:28:13'),
(17, 'App\\Models\\User', 15, 'auth_token', '79f227591f4065a25ec653f81fbe14114dd771b6490303ca2d1d9bea3ff0bda9', '[\"*\"]', NULL, NULL, '2023-04-28 12:57:12', '2023-04-28 12:57:12'),
(18, 'App\\Models\\User', 16, 'auth_token', '815c69da14fd52c629aeae350746a03729ae06c3045bd2b77db55a4ca1a2c6de', '[\"*\"]', NULL, NULL, '2023-04-28 13:03:09', '2023-04-28 13:03:09'),
(19, 'App\\Models\\User', 17, 'auth_token', '7141d0e2464d446ee3c94a2a0d7a7eb6f510d2b03ab156422aee9f31e3d9e41a', '[\"*\"]', NULL, NULL, '2023-04-28 15:50:02', '2023-04-28 15:50:02'),
(20, 'App\\Models\\User', 18, 'auth_token', 'aebc07fc9b996c3f18803861514c11a189d1fd6fc74afd5f7132ad3dfb0c2edc', '[\"*\"]', NULL, NULL, '2023-05-18 21:01:55', '2023-05-18 21:01:55'),
(21, 'App\\Models\\User', 19, 'auth_token', '62a4cd5dd34e16b32b37cc54fa3d030ec7e9381335016b0afb3d6b79ae7386df', '[\"*\"]', NULL, NULL, '2023-05-18 21:15:39', '2023-05-18 21:15:39'),
(22, 'App\\Models\\User', 20, 'auth_token', 'd86e6105dd35dbd342606a669d978ce75f7618e56cfb12594a9984b8e687f15e', '[\"*\"]', NULL, NULL, '2023-05-21 02:28:02', '2023-05-21 02:28:02');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `discount_type` enum('fixed','percent') COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `stock_alert_quantity` int(11) NOT NULL DEFAULT '0',
  `sku` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sold` int(11) NOT NULL DEFAULT '0',
  `short_description` longtext COLLATE utf8_unicode_ci,
  `description` longtext COLLATE utf8_unicode_ci,
  `related_products` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seodata` longtext COLLATE utf8_unicode_ci,
  `metadata` longtext COLLATE utf8_unicode_ci,
  `type` enum('simple','variation') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'simple',
  `is_sample` tinyint(1) NOT NULL DEFAULT '0',
  `is_onsale` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `in_store` tinyint(1) NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_added_by_brand_id_index` (`added_by`,`brand_id`),
  KEY `products_name_index` (`name`),
  KEY `products_price_discount_amount_index` (`price`,`discount_amount`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `added_by`, `updated_by`, `deleted_by`, `brand_id`, `name`, `slug`, `thumbnail`, `price`, `discount_amount`, `discount_type`, `quantity`, `stock_alert_quantity`, `sku`, `sold`, `short_description`, `description`, `related_products`, `seodata`, `metadata`, `type`, `is_sample`, `is_onsale`, `is_active`, `in_store`, `is_featured`, `created_at`, `updated_at`, `deleted_at`) VALUES
(44, 5, NULL, NULL, 1, '4.5\" Opaque White Swirled Hand Pipe', '45-opaque-white-swirled-hand-pipe', 'image073.png', '15.00', '0.00', NULL, 0, 0, 'OWSH', 0, NULL, 'null', NULL, '{\"meta_title\":\"\",\"meta_description\":\"\",\"meta_keywords\":\"\"}', NULL, 'simple', 0, 0, 1, 1, 0, '2023-02-08 02:26:23', '2023-06-07 11:58:37', '2023-06-07 11:58:37'),
(45, 5, NULL, NULL, 1, 'Stündenglass Gravity Hookah V2', 'stndenglass-gravity-hookah-v2', 'image075.png', '650.00', '0.00', NULL, 0, 0, 'SGHV2', 0, NULL, 'null', NULL, '{\"meta_title\":\"\",\"meta_description\":\"\",\"meta_keywords\":\"\"}', NULL, 'simple', 0, 0, 1, 1, 0, '2023-02-08 02:27:10', '2023-06-07 11:58:34', '2023-06-07 11:58:34'),
(46, 5, NULL, NULL, 1, '4\" Slime Swirl Sherlock Hand Pipe | Assorted Colors * ELITE SERIES', '4-slime-swirl-sherlock-hand-pipe-assorted-colors-elite-series', 'image077.png', '25.00', '0.00', NULL, 0, 0, 'S3HP', 0, NULL, 'null', NULL, '{\"meta_title\":\"\",\"meta_description\":\"\",\"meta_keywords\":\"\"}', NULL, 'simple', 0, 0, 1, 1, 0, '2023-02-08 02:28:14', '2023-06-07 11:58:31', '2023-06-07 11:58:31'),
(47, 5, 5, NULL, 1, 'Elliott Wells', 'elliott-wells', NULL, '10.00', '0.00', NULL, 20, 1, 'RTL003', 0, NULL, 'null', NULL, '{\"meta_title\":\"\",\"meta_description\":\"\",\"meta_keywords\":\"\"}', NULL, 'variation', 0, 0, 1, 0, 0, '2023-05-30 21:29:46', '2023-06-07 12:00:59', NULL),
(48, 5, NULL, NULL, 1, 'Brian Wolfe', 'nobis-excepteur-est', 'banner2.jpg', '0.00', '0.00', NULL, 0, 0, NULL, 0, 'Id aute iste aute a', 'null', NULL, '{\"meta_title\":\"Qui explicabo Quod\",\"meta_description\":\"Dolores voluptas nul\",\"meta_keywords\":\"Dignissimos dolores\"}', NULL, 'variation', 0, 0, 1, 0, 0, '2023-06-01 13:46:16', '2023-06-07 11:58:26', '2023-06-07 11:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', 'web', '2023-05-31 13:02:29', '2023-05-31 13:02:29', NULL),
(2, 'Admin', 'web', '2023-05-31 13:36:24', '2023-05-31 13:36:24', NULL),
(3, 'Editor', 'web', '2023-05-31 13:37:05', '2023-05-31 13:37:05', NULL),
(11, 'User', 'web', '2023-06-19 15:17:37', '2023-06-19 15:17:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(2, 11),
(3, 1),
(4, 1),
(5, 1),
(5, 2),
(6, 1),
(7, 1),
(8, 1),
(8, 9),
(8, 10),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(13, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(20, 1),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(25, 1),
(26, 1),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(30, 1),
(32, 1),
(34, 1),
(35, 1),
(36, 1),
(36, 5),
(37, 1),
(37, 5);

-- --------------------------------------------------------

--
-- Table structure for table `social_accounts`
--

DROP TABLE IF EXISTS `social_accounts`;
CREATE TABLE IF NOT EXISTS `social_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `social_accounts_provider_id_unique` (`provider_id`),
  KEY `social_accounts_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

DROP TABLE IF EXISTS `social_links`;
CREATE TABLE IF NOT EXISTS `social_links` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `key`, `link`, `class`, `icon`, `order`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Facebook', 'https://www.facebook.com/', 'fab fa-facebook-f', 'icons8-facebook-48.png', 1, 1, '2023-02-23 01:37:25', '2023-02-23 01:37:25', NULL),
(2, 'Instagram', 'https://instagram.com/', 'fab fa-instagram', 'icons8-instagram-48.png', 2, 1, '2023-02-23 01:38:07', '2023-02-23 01:38:07', NULL),
(3, 'Twitter', 'https://twitter.com/', 'fab fa-twitter', 'icons8-twitter-48.png', 3, 1, '2023-02-23 01:38:34', '2023-02-23 01:38:34', NULL),
(4, 'linkedin', 'https://www.linkedin.com/', 'fab fa-linkedin-in', 'icons8-linkedin-48.png', 4, 1, '2023-02-23 01:39:09', '2023-02-23 01:39:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'type of status means status used for which prduct, company, order or etc.',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `middle_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_responsibilities` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_start_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_end_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `course_id`, `first_name`, `middle_name`, `last_name`, `email`, `phone`, `job_responsibilities`, `date_of_birth`, `location`, `event_address`, `event_city`, `event_state`, `class_start_date`, `class_end_date`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2, 'Joseph', NULL, 'Stalin', 'richardbranson993@gmail.com', '04234242423', NULL, NULL, 'New york', 'St. A-25', 'New York', 'New York', '01/17/2024', '01/18/2024', 1, '2023-07-20 20:10:12', '2023-07-21 20:05:29'),
(3, 2, 'Shana', NULL, 'Howard', 'webdevs635@gmail.com', '+1 (574) 728-3689', NULL, NULL, NULL, 'St. A-25', 'New York', 'New York', NULL, NULL, 1, '2023-07-20 21:07:13', '2023-07-20 22:08:10'),
(7, 2, 'Neil', NULL, 'Sheppard', 'wopugu@mailinator.com', '+1 (617) 734-9151', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-07-21 13:01:34', '2023-07-21 13:01:34'),
(8, 2, 'Brock', NULL, 'Holloway', 'wufijyqe@mailinator.com', '+1 (262) 244-9662', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-07-21 17:47:29', '2023-07-21 17:47:29'),
(9, 2, 'Beau', NULL, 'Bird', 'guta@mailinator.com', '+1 (701) 409-2912', NULL, NULL, NULL, NULL, NULL, NULL, '01/24/2024', '01/25/2024', 1, '2023-07-21 17:50:20', '2023-07-21 18:41:23');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
CREATE TABLE IF NOT EXISTS `teams` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `captain_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `captain_id`, `name`, `logo`, `slug`, `description`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, 43, 'Wyatt Knowles', NULL, 'wyatt-knowles', NULL, 1, '2023-06-12 18:17:57', '2023-06-12 18:18:07', '2023-06-12 18:18:07'),
(3, 43, 'Team-c', 'team-c.png', 'team-c', NULL, 1, '2023-06-08 19:41:30', '2023-06-08 19:42:05', '2023-06-08 19:42:05'),
(4, 43, 'Team-c', NULL, 'team-c', NULL, 1, '2023-06-08 19:50:53', '2023-06-08 20:22:42', '2023-06-08 20:22:42'),
(5, 43, 'Team A', NULL, 'team-a', NULL, 1, '2023-06-12 17:54:35', '2023-06-12 17:59:18', '2023-06-12 17:59:18'),
(6, 43, 'Team A', NULL, 'team-a', NULL, 1, '2023-06-12 17:54:42', '2023-06-12 17:59:14', '2023-06-12 17:59:14'),
(7, 43, 'Team A', NULL, 'team-a', NULL, 1, '2023-06-12 18:00:36', '2023-06-12 18:11:19', '2023-06-12 18:11:19'),
(8, 43, 'Team A', NULL, 'team-a', NULL, 1, '2023-06-12 18:00:51', '2023-06-12 18:11:16', '2023-06-12 18:11:16'),
(9, 43, 'Team A', NULL, 'team-a', NULL, 1, '2023-06-12 18:07:27', '2023-06-12 18:11:14', '2023-06-12 18:11:14'),
(10, 43, 'Team A', NULL, 'team-a', NULL, 1, '2023-06-12 18:07:34', '2023-06-12 18:11:12', '2023-06-12 18:11:12'),
(12, 43, 'Team A', NULL, 'team-a', NULL, 1, '2023-06-12 18:18:13', '2023-06-12 18:18:13', NULL),
(13, 43, 'Team B', NULL, 'team-b', NULL, 1, '2023-06-12 18:18:30', '2023-06-12 18:18:30', NULL),
(14, 43, 'Team c', NULL, 'team-c', NULL, 1, '2023-06-12 18:18:37', '2023-06-12 18:18:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `team_player`
--

DROP TABLE IF EXISTS `team_player`;
CREATE TABLE IF NOT EXISTS `team_player` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `player_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `team_player`
--

INSERT INTO `team_player` (`id`, `team_id`, `player_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 38, NULL, NULL, NULL),
(3, 1, 41, NULL, NULL, NULL),
(13, 2, 38, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  `review` longtext COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `added_by`, `updated_by`, `name`, `designation`, `company`, `rating`, `review`, `image`, `order`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 5, 'SUZANNE HIGGINS', 'Client', '', 0, '<p>I have recently switched to alternate medicines from Taste Budz and have found them to be extremely soothing and beneficial.</p>', 'profile-1.png', 1, 1, '2023-02-23 01:17:07', '2023-02-23 01:31:01', NULL),
(2, 5, 5, 'DAVE FISHER', 'Client', '', 0, '<p>I\'ve always been skeptical about natural medicine but ever since I tried Taste Budz, my entire perception has changed.</p>', 'profile-1.png', 1, 1, '2023-02-23 01:17:51', '2023-02-23 01:58:37', NULL),
(3, 5, 5, 'PAULA RICHARD', 'Client', '', 0, '<p>The team at Taste Budz is super accommodating. They made my entire journey towards natural medicine so easy.</p>', 'profile-1.png', 1, 1, '2023-02-23 01:18:16', '2023-02-23 01:30:15', NULL),
(4, 5, 5, 'SARA PETER', 'Client', '', 0, '<p>Taste Budz has helped me reduce my anxiety and improve my mood. I\'m grateful.</p>', 'profile-1.png', 1, 1, '2023-02-23 01:18:42', '2023-02-23 01:31:58', NULL),
(5, 5, 5, 'MARK RUDD', 'Client', '', 0, '<p>Their product is excellent and so is the initiative.</p>', 'profile-1.png', 1, 1, '2023-02-23 01:19:00', '2023-02-23 01:31:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` enum('male','female','other') COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_notification_active` tinyint(1) NOT NULL DEFAULT '0',
  `sms_notification_active` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'UTC',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_online` tinyint(1) DEFAULT '0',
  `is_available` tinyint(1) DEFAULT '1',
  `metadata` longtext COLLATE utf8_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `company_name`, `address`, `first_name`, `last_name`, `email`, `username`, `phone`, `mobile`, `image`, `date_of_birth`, `gender`, `email_notification_active`, `sms_notification_active`, `email_verified_at`, `display_name`, `timezone`, `password`, `latitude`, `longitude`, `is_active`, `is_online`, `is_available`, `metadata`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, NULL, NULL, 'Ethan', 'Patrik', 'ethanpatrik175@gmail.com', 'ethanpatrik175', NULL, NULL, NULL, NULL, NULL, 0, 0, '2023-02-02 03:10:56', NULL, 'UTC', '$2y$10$gWcnDerLwLe9jAOm3e4dp.MLrYACqm1i1jbNcCnjDBXK1faPK1z7W', NULL, NULL, 1, 0, 1, NULL, 'mwZRNiwVgqFWZEODU2HMEgvg4KpNW5pnbPBJTgQzLDxDewF3tCXVmu3atWWG', '2023-02-02 01:50:11', '2023-02-23 05:50:23', NULL),
(49, NULL, NULL, 'Gannon', 'Kirby', 'femujalel@mailinator.com', NULL, '012345678912', NULL, NULL, NULL, NULL, 0, 0, '2023-06-09 01:22:01', NULL, 'UTC', '$2y$10$A6aDfxzboWLNwV.24uexyeiwNeN/ap1i.5332eGmiu3a5gcJ32ESW', NULL, NULL, 1, 0, 1, NULL, NULL, '2023-06-08 20:21:52', '2023-06-08 20:21:52', NULL),
(48, NULL, NULL, 'Velma', 'Mullen', 'kivoputuha@mailinator.com', NULL, '012345678912', NULL, NULL, NULL, NULL, 0, 0, '2023-06-09 01:21:23', NULL, 'UTC', '$2y$10$21ELSxdQ2KIsdX9MFnhYV.Xv7UJsFrAeuGkJbAkqfsYvJ2oqTLaSq', NULL, NULL, 1, 0, 1, NULL, NULL, '2023-06-08 20:21:17', '2023-06-08 20:21:17', NULL),
(46, NULL, NULL, 'Hayfa', 'Hebert', 'cacenozeqo@mailinator.com', NULL, '012345678912', NULL, NULL, NULL, NULL, 0, 0, '2023-06-09 01:09:09', NULL, 'UTC', '$2y$10$jrU83gu7CVXIz6fWLwl1cuIOrFe55NrYjj2jx6JzoyDyFxKw15EbS', NULL, NULL, 1, 0, 1, NULL, NULL, '2023-06-08 20:09:01', '2023-06-08 20:09:01', NULL),
(38, NULL, NULL, 'Richard', 'Branson', 'richardbranson993@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2023-06-06 17:58:09', NULL, 'UTC', '$2y$10$5IJKVsL5fMIHiYssg6xwzOiOwf44Uer4GdmaKguQTzQOknqq2vuqu', NULL, NULL, 1, 0, 1, NULL, NULL, '2023-06-06 17:57:38', '2023-06-06 17:58:09', NULL),
(47, NULL, NULL, 'Brett', 'Cooper', 'luxym@mailinator.com', NULL, '012345678912', NULL, NULL, NULL, NULL, 0, 0, '2023-06-09 01:20:40', NULL, 'UTC', '$2y$10$pKxsZ4ahvvhy9/655.fGTeDS0ci3HfGTz1DYpsSKi/z5R1LcYpEi.', NULL, NULL, 1, 0, 1, NULL, NULL, '2023-06-08 20:20:33', '2023-06-08 20:20:33', NULL),
(45, NULL, NULL, 'Linus', 'Fletcher', 'mihexy@mailinator.com', NULL, '012345678912', NULL, NULL, NULL, NULL, 0, 0, '2023-06-09 01:08:05', NULL, 'UTC', '$2y$10$8eRpHnYQM7u214.XAnfEeOgq.reJrphHvDU./cvAsJAbEHmhE1WzS', NULL, NULL, 1, 0, 1, NULL, NULL, '2023-06-08 20:07:25', '2023-06-08 20:07:25', NULL),
(43, NULL, NULL, 'Perry', 'Branson', 'perry@mailinator.com', NULL, '01234567812', NULL, NULL, NULL, NULL, 0, 0, '2023-06-09 00:29:00', NULL, 'UTC', '$2y$10$0gb5y9R/TTiO29s0c1okeeGdKlZccFN3ekmTuUNmD9EmKThZ.Xaku', NULL, NULL, 1, 0, 1, NULL, NULL, '2023-06-08 19:28:48', '2023-06-08 19:32:38', NULL),
(51, NULL, NULL, 'Tara', 'Harris', 'lirasi@mailinator.com', NULL, '123456789', NULL, NULL, NULL, NULL, 0, 0, '2023-06-19 19:54:11', NULL, 'UTC', '$2y$10$0Q8PmciXEpnP8Zn0wag8lO/lvO1WiNo8HN7ZNdRv2aT285knZHHja', NULL, NULL, 1, 0, 1, NULL, NULL, '2023-06-19 14:53:34', '2023-06-19 14:53:34', NULL),
(52, 'doath', NULL, 'Howard', 'Oneil', 'satedavova@mailinator.com', NULL, '123456789', NULL, NULL, NULL, NULL, 0, 0, '2023-06-19 20:05:19', NULL, 'UTC', '$2y$10$pUc8cQZB7zjXLSTh5rtoKuASzO7xA9tGKTCMYIyfkBKMfWLPhme6i', NULL, NULL, 1, 0, 1, NULL, NULL, '2023-06-19 15:05:09', '2023-06-19 15:05:09', NULL),
(53, NULL, NULL, 'Petra', 'Riddle', 'loqi@mailinator.com', NULL, '012345678912', NULL, NULL, NULL, NULL, 0, 0, '2023-06-22 18:32:57', NULL, 'UTC', '$2y$10$OmkZSEEi8eh0FEPbvg0Wbe.sT3dTHHc63kUqaTkZiFuRO77VmYkyi', NULL, NULL, 1, 0, 1, NULL, NULL, '2023-06-22 13:32:39', '2023-06-22 13:32:39', NULL),
(54, NULL, NULL, 'Sage', 'Mullen', 'domyledil@mailinator.com', NULL, '012345678912', NULL, NULL, NULL, NULL, 0, 0, '2023-06-23 22:02:19', NULL, 'UTC', '$2y$10$zJie32OiyukHDUEConxM7OaxuxULMw/P0JWeAeGsBFAjcONuIu5cO', NULL, NULL, 1, 0, 1, NULL, NULL, '2023-06-23 17:01:54', '2023-06-23 17:01:54', NULL),
(55, 'Logan lothj', 'Aut velit fugiat qui', 'Christine', 'Hogan', 'jiso@mailinator.com', NULL, '0123456789', NULL, NULL, NULL, NULL, 0, 0, '2023-06-24 02:19:47', NULL, 'UTC', '$2y$10$yKe40orfdWvEH/yisk7kaOT310L85jrHymb.UWAA2jxh5aua2KEL.', NULL, NULL, 1, 0, 1, NULL, NULL, '2023-06-23 21:19:00', '2023-06-23 21:19:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_metas`
--

DROP TABLE IF EXISTS `user_metas`;
CREATE TABLE IF NOT EXISTS `user_metas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` longtext COLLATE utf8_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variations`
--

DROP TABLE IF EXISTS `variations`;
CREATE TABLE IF NOT EXISTS `variations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `discount_type` enum('fixed','percent') COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `stock_alert_quantity` int(11) NOT NULL DEFAULT '0',
  `sku` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sold` int(11) NOT NULL DEFAULT '0',
  `description` longtext COLLATE utf8_unicode_ci,
  `seodata` longtext COLLATE utf8_unicode_ci,
  `metadata` longtext COLLATE utf8_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `in_store` tinyint(1) NOT NULL DEFAULT '0',
  `is_onsale` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `variations_product_id_foreign` (`product_id`),
  KEY `variations_added_by_foreign` (`added_by`),
  KEY `variations_updated_by_foreign` (`updated_by`),
  KEY `variations_deleted_by_foreign` (`deleted_by`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `variations`
--

INSERT INTO `variations` (`id`, `added_by`, `updated_by`, `deleted_by`, `product_id`, `name`, `slug`, `thumbnail`, `price`, `discount_amount`, `discount_type`, `quantity`, `stock_alert_quantity`, `sku`, `sold`, `description`, `seodata`, `metadata`, `is_active`, `in_store`, `is_onsale`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 5, 5, NULL, 6, 'CBN Elderberry 20 gummies', 'cbn-elderberry-20-gummies', 'cbd-cbn.png', '45.00', '0.00', NULL, 0, 0, 'CBN', 0, 'null', '{\"meta_title\":\"\",\"meta_description\":\"\",\"meta_keywords\":\"\"}', NULL, 1, 1, 0, '2023-02-07 01:25:59', '2023-02-09 09:58:50', NULL),
(4, 5, NULL, NULL, 6, 'CBG Pear 20 gummies', 'cbg-pear-20-gummies', 'cdb-cbg.png', '45.00', '0.00', NULL, 0, 0, 'CBG', 0, 'null', '{\"meta_title\":\"\",\"meta_description\":\"\",\"meta_keywords\":\"\"}', NULL, 1, 1, 0, '2023-02-07 01:24:51', '2023-02-07 01:24:51', NULL),
(3, 5, NULL, NULL, 6, 'CBD Lemon 20 gummies', 'cbd-lemon-20-gummies', 'cbd.png', '35.00', '0.00', NULL, 0, 0, 'CBD', 0, 'null', '{\"meta_title\":\"\",\"meta_description\":\"\",\"meta_keywords\":\"\"}', NULL, 1, 1, 0, '2023-02-07 01:24:05', '2023-02-07 01:24:05', NULL),
(6, 5, NULL, NULL, 7, 'CBD 300 ml', 'cbd-300-ml', 'image004.jpg', '30.00', '0.00', NULL, 0, 0, 'CBD300', 0, 'null', '{\"meta_title\":\"\",\"meta_description\":\"\",\"meta_keywords\":\"\"}', NULL, 1, 1, 0, '2023-02-08 01:38:48', '2023-02-08 01:38:48', NULL),
(7, 5, NULL, NULL, 7, 'CBD 900 ml', 'cbd-900-ml', 'image004.jpg', '75.00', '0.00', NULL, 0, 0, 'CBD900', 0, 'null', '{\"meta_title\":\"\",\"meta_description\":\"\",\"meta_keywords\":\"\"}', NULL, 1, 1, 0, '2023-02-08 01:39:20', '2023-02-08 01:39:20', NULL),
(8, 5, NULL, NULL, 7, 'CBG 300 ml', 'cbg-300-ml', 'image006.jpg', '30.00', '0.00', NULL, 0, 0, 'CBG300', 0, 'null', '{\"meta_title\":\"\",\"meta_description\":\"\",\"meta_keywords\":\"\"}', NULL, 1, 1, 0, '2023-02-08 01:40:01', '2023-02-08 01:40:01', NULL),
(9, 5, NULL, NULL, 7, 'CBG 900 ml', 'cbg-900-ml', 'image006.jpg', '75.00', '0.00', NULL, 0, 0, 'CBG900', 0, 'null', '{\"meta_title\":\"\",\"meta_description\":\"\",\"meta_keywords\":\"\"}', NULL, 1, 1, 0, '2023-02-08 01:40:41', '2023-02-08 01:40:41', NULL),
(10, 5, NULL, NULL, 7, 'CBN 300 ml', 'cbn-300-ml', 'image008.jpg', '30.00', '0.00', NULL, 0, 0, 'CBN300', 0, 'null', '{\"meta_title\":\"\",\"meta_description\":\"\",\"meta_keywords\":\"\"}', NULL, 1, 1, 0, '2023-02-08 01:41:16', '2023-02-08 01:41:16', NULL),
(11, 5, NULL, NULL, 7, 'CBN 900 ml', 'cbn-900-ml', 'image008.jpg', '75.00', '0.00', NULL, 0, 0, 'CBN900', 0, 'null', '{\"meta_title\":\"\",\"meta_description\":\"\",\"meta_keywords\":\"\"}', NULL, 1, 1, 0, '2023-02-08 01:41:52', '2023-02-08 01:41:52', NULL),
(12, 5, NULL, NULL, 8, 'Cooling 2000mg', 'cooling-2000mg', 'cooling-2k.png', '45.00', '0.00', NULL, 0, 0, 'COOLING200', 0, 'null', '{\"meta_title\":\"\",\"meta_description\":\"\",\"meta_keywords\":\"\"}', NULL, 1, 1, 0, '2023-02-08 01:44:38', '2023-02-08 01:44:38', NULL),
(13, 5, NULL, NULL, 8, 'Warming 2000 mg', 'warming-2000-mg', 'warming-2k.png', '45.00', '0.00', NULL, 0, 0, 'WARM2000', 0, 'null', '{\"meta_title\":\"\",\"meta_description\":\"\",\"meta_keywords\":\"\"}', NULL, 1, 1, 0, '2023-02-08 01:45:21', '2023-02-08 01:45:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `web_settings`
--

DROP TABLE IF EXISTS `web_settings`;
CREATE TABLE IF NOT EXISTS `web_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `addedBy` bigint(20) UNSIGNED DEFAULT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` longtext COLLATE utf8_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `web_settings`
--

INSERT INTO `web_settings` (`id`, `addedBy`, `key`, `data`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 'logo', '{\"logo\":\"logo.jpg\"}', 'active', '2023-02-02 03:27:34', '2023-06-21 22:06:46', NULL),
(2, 5, 'footer', '{\"footer\":\"logo.jpg\"}', 'active', '2023-02-02 03:28:25', '2023-06-21 22:06:55', NULL),
(3, 5, 'favicon', '{\"favicon\":\"logo.jpg\"}', 'active', '2023-02-02 03:32:20', '2023-06-21 22:07:03', NULL),
(4, NULL, 'contactInfo', '{\"number1\":\"+1 (202) 506-598\",\"number2\":null,\"whatsapp\":null,\"email1\":\"Tastebuddydc@gmail.com\",\"email2\":null,\"contact_us_queries_email\":\"ethanpatrik175@gmail.com\",\"address\":\"317 Pennsylvania Ave SE <br \\/>\\r\\nWashington DC 20003\",\"desc\":\"Taste Budz deals in alternative medicine that aims to bring physical, mental, emotional and spiritual healing to our customers with the help of natural medicine. Our goal is to remove the stigma attached to natural medicine and prove that it is, in fact, safe to use and beneficial.\"}', 'active', '2023-02-23 02:06:53', '2023-05-24 19:26:47', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
