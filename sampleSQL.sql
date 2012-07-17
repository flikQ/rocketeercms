# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.1.44)
# Database: blueprint
# Generation Time: 2012-07-17 15:44:06 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table acl
# ------------------------------------------------------------

DROP TABLE IF EXISTS `acl`;

CREATE TABLE `acl` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `value` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `acl` WRITE;
/*!40000 ALTER TABLE `acl` DISABLE KEYS */;

INSERT INTO `acl` (`id`, `group_id`, `key`, `value`)
VALUES
	(1,1,'view_admin_panel',1),
	(2,2,'view_admin_panel',1),
	(3,3,'view_admin_panel',1),
	(4,4,'view_admin_panel',1),
	(5,5,'view_admin_panel',1),
	(6,1,'view_users',1),
	(7,2,'view_users',1),
	(8,3,'view_users',1),
	(9,4,'view_users',1),
	(10,5,'view_users',1),
	(11,1,'view_user_groups',1),
	(12,2,'view_user_groups',0),
	(13,3,'view_user_groups',0),
	(14,4,'view_user_groups',0),
	(15,5,'view_user_groups',0),
	(16,1,'view_user_rights',1),
	(17,2,'view_user_rights',0),
	(18,3,'view_user_rights',0),
	(19,4,'view_user_rights',0),
	(20,5,'view_user_rights',0),
	(21,1,'add_users',1),
	(22,2,'add_users',0),
	(23,3,'add_users',0),
	(24,4,'add_users',0),
	(25,5,'add_users',0),
	(26,1,'edit_users',1),
	(27,2,'edit_users',0),
	(28,3,'edit_users',0),
	(29,4,'edit_users',0),
	(30,5,'edit_users',0),
	(31,1,'remove_users',1),
	(32,2,'remove_users',0),
	(33,3,'remove_users',0),
	(34,4,'remove_users',0),
	(35,5,'remove_users',0),
	(36,1,'add_user_groups',1),
	(37,2,'add_user_groups',0),
	(38,3,'add_user_groups',0),
	(39,4,'add_user_groups',0),
	(40,5,'add_user_groups',0),
	(41,1,'edit_user_groups',1),
	(42,2,'edit_user_groups',0),
	(43,3,'edit_user_groups',0),
	(44,4,'edit_user_groups',0),
	(45,5,'edit_user_groups',0),
	(46,1,'remove_user_groups',1),
	(47,2,'remove_user_groups',0),
	(48,3,'remove_user_groups',0),
	(49,4,'remove_user_groups',0),
	(50,5,'remove_user_groups',0),
	(51,1,'add_user_rights',1),
	(52,2,'add_user_rights',0),
	(53,3,'add_user_rights',0),
	(54,4,'add_user_rights',0),
	(55,5,'add_user_rights',0),
	(56,1,'edit_user_rights',1),
	(57,2,'edit_user_rights',0),
	(58,3,'edit_user_rights',0),
	(59,4,'edit_user_rights',0),
	(60,5,'edit_user_rights',0),
	(61,1,'remove_user_rights',1),
	(62,2,'remove_user_rights',0),
	(63,3,'remove_user_rights',0),
	(64,4,'remove_user_rights',0),
	(65,5,'remove_user_rights',0),
	(66,1,'view_articles',1),
	(67,2,'view_articles',1),
	(68,3,'view_articles',1),
	(69,4,'view_articles',1),
	(70,5,'view_articles',1),
	(71,1,'add_articles',1),
	(72,2,'add_articles',1),
	(73,3,'add_articles',1),
	(74,4,'add_articles',1),
	(75,5,'add_articles',1),
	(76,1,'edit_articles',1),
	(77,2,'edit_articles',1),
	(78,3,'edit_articles',1),
	(79,4,'edit_articles',1),
	(80,5,'edit_articles',1),
	(81,1,'remove_articles',1),
	(82,2,'remove_articles',0),
	(83,3,'remove_articles',0),
	(84,4,'remove_articles',0),
	(85,5,'remove_articles',0),
	(86,1,'approve_articles',1),
	(87,2,'approve_articles',1),
	(88,3,'approve_articles',1),
	(89,4,'approve_articles',1),
	(90,5,'approve_articles',1),
	(91,1,'view_article_categories',1),
	(92,2,'view_article_categories',1),
	(93,3,'view_article_categories',1),
	(94,4,'view_article_categories',1),
	(95,5,'view_article_categories',1),
	(96,1,'add_article_categories',1),
	(97,2,'add_article_categories',1),
	(98,3,'add_article_categories',1),
	(99,4,'add_article_categories',1),
	(100,5,'add_article_categories',1),
	(101,1,'edit_article_categories',1),
	(102,2,'edit_article_categories',0),
	(103,3,'edit_article_categories',0),
	(104,4,'edit_article_categories',0),
	(105,5,'edit_article_categories',0),
	(106,1,'remove_article_categories',1),
	(107,2,'remove_article_categories',1),
	(108,3,'remove_article_categories',1),
	(109,4,'remove_article_categories',1),
	(110,5,'remove_article_categories',1),
	(111,1,'view_article_sections',1),
	(112,2,'view_article_sections',1),
	(113,3,'view_article_sections',1),
	(114,4,'view_article_sections',1),
	(115,5,'view_article_sections',1),
	(116,1,'add_article_sections',1),
	(117,2,'add_article_sections',0),
	(118,3,'add_article_sections',0),
	(119,4,'add_article_sections',0),
	(120,5,'add_article_sections',0),
	(121,1,'edit_article_sections',1),
	(122,2,'edit_article_sections',0),
	(123,3,'edit_article_sections',0),
	(124,4,'edit_article_sections',0),
	(125,5,'edit_article_sections',0),
	(126,1,'remove_article_sections',1),
	(127,2,'remove_article_sections',0),
	(128,3,'remove_article_sections',0),
	(129,4,'remove_article_sections',0),
	(130,5,'remove_article_sections',0),
	(131,1,'view_comments',1),
	(132,2,'view_comments',0),
	(133,3,'view_comments',0),
	(134,4,'view_comments',0),
	(135,5,'view_comments',0),
	(136,1,'view_videos',1),
	(137,2,'view_videos',0),
	(138,3,'view_videos',0),
	(139,4,'view_videos',0),
	(140,5,'view_videos',0),
	(141,1,'add_videos',1),
	(142,2,'add_videos',0),
	(143,3,'add_videos',0),
	(144,4,'add_videos',0),
	(145,5,'add_videos',0),
	(146,1,'edit_videos',1),
	(147,2,'edit_videos',0),
	(148,3,'edit_videos',0),
	(149,4,'edit_videos',0),
	(150,5,'edit_videos',0),
	(151,1,'remove_videos',1),
	(152,2,'remove_videos',0),
	(153,3,'remove_videos',0),
	(154,4,'remove_videos',0),
	(155,5,'remove_videos',0),
	(156,1,'view_video_categories',1),
	(157,2,'view_video_categories',0),
	(158,3,'view_video_categories',0),
	(159,4,'view_video_categories',0),
	(160,5,'view_video_categories',0),
	(161,1,'add_video_categories',1),
	(162,2,'add_video_categories',0),
	(163,3,'add_video_categories',0),
	(164,4,'add_video_categories',0),
	(165,5,'add_video_categories',0),
	(166,1,'edit_video_categories',1),
	(167,2,'edit_video_categories',0),
	(168,3,'edit_video_categories',0),
	(169,4,'edit_video_categories',0),
	(170,5,'edit_video_categories',0),
	(171,1,'remove_video_categories',1),
	(172,2,'remove_video_categories',0),
	(173,3,'remove_video_categories',0),
	(174,4,'remove_video_categories',0),
	(175,5,'remove_video_categories',0),
	(176,1,'view_forums',1),
	(177,2,'view_forums',0),
	(178,3,'view_forums',0),
	(179,4,'view_forums',0),
	(180,5,'view_forums',0),
	(181,1,'view_forum_sections',1),
	(182,2,'view_forum_sections',0),
	(183,3,'view_forum_sections',0),
	(184,4,'view_forum_sections',0),
	(185,5,'view_forum_sections',0),
	(186,1,'add_forums',1),
	(187,2,'add_forums',0),
	(188,3,'add_forums',0),
	(189,4,'add_forums',0),
	(190,5,'add_forums',0),
	(191,1,'edit_forums',1),
	(192,2,'edit_forums',0),
	(193,3,'edit_forums',0),
	(194,4,'edit_forums',0),
	(195,5,'edit_forums',0),
	(196,1,'remove_forums',1),
	(197,2,'remove_forums',0),
	(198,3,'remove_forums',0),
	(199,4,'remove_forums',0),
	(200,5,'remove_forums',0),
	(201,1,'add_forum_sections',1),
	(202,2,'add_forum_sections',0),
	(203,3,'add_forum_sections',0),
	(204,4,'add_forum_sections',0),
	(205,5,'add_forum_sections',0),
	(206,1,'edit_forum_sections',1),
	(207,2,'edit_forum_sections',0),
	(208,3,'edit_forum_sections',0),
	(209,4,'edit_forum_sections',0),
	(210,5,'edit_forum_sections',0),
	(211,1,'remove_forum_sections',1),
	(212,2,'remove_forum_sections',0),
	(213,3,'remove_forum_sections',0),
	(214,4,'remove_forum_sections',0),
	(215,5,'remove_forum_sections',0),
	(216,1,'view_pages',1),
	(217,2,'view_pages',0),
	(218,3,'view_pages',0),
	(219,4,'view_pages',0),
	(220,5,'view_pages',0),
	(221,1,'add_pages',1),
	(222,2,'add_pages',0),
	(223,3,'add_pages',0),
	(224,4,'add_pages',0),
	(225,5,'add_pages',0),
	(226,1,'edit_pages',1),
	(227,2,'edit_pages',0),
	(228,3,'edit_pages',0),
	(229,4,'edit_pages',0),
	(230,5,'edit_pages',0),
	(231,1,'remove_pages',1),
	(232,2,'remove_pages',0),
	(233,3,'remove_pages',0),
	(234,4,'remove_pages',0),
	(235,5,'remove_pages',0),
	(236,1,'view_settings',1),
	(237,2,'view_settings',0),
	(238,3,'view_settings',0),
	(239,4,'view_settings',0),
	(240,5,'view_settings',0),
	(241,1,'add_settings',1),
	(242,2,'add_settings',0),
	(243,3,'add_settings',0),
	(244,4,'add_settings',0),
	(245,5,'add_settings',0),
	(246,1,'edit_settings',1),
	(247,2,'edit_settings',0),
	(248,3,'edit_settings',0),
	(249,4,'edit_settings',0),
	(250,5,'edit_settings',0),
	(251,1,'remove_settings',1),
	(252,2,'remove_settings',0),
	(253,3,'remove_settings',0),
	(254,4,'remove_settings',0),
	(255,5,'remove_settings',0),
	(256,1,'view_files',1),
	(257,2,'view_files',0),
	(258,3,'view_files',0),
	(259,4,'view_files',0),
	(260,5,'view_files',0),
	(261,1,'add_files',1),
	(262,2,'add_files',0),
	(263,3,'add_files',0),
	(264,4,'add_files',0),
	(265,5,'add_files',0),
	(266,1,'edit_files',1),
	(267,2,'edit_files',0),
	(268,3,'edit_files',0),
	(269,4,'edit_files',0),
	(270,5,'edit_files',0),
	(271,1,'remove_files',1),
	(272,2,'remove_files',0),
	(273,3,'remove_files',0),
	(274,4,'remove_files',0),
	(275,5,'remove_files',0),
	(276,1,'view_file_categories',1),
	(277,2,'view_file_categories',0),
	(278,3,'view_file_categories',0),
	(279,4,'view_file_categories',0),
	(280,5,'view_file_categories',0),
	(281,1,'add_file_categories',1),
	(282,2,'add_file_categories',0),
	(283,3,'add_file_categories',0),
	(284,4,'add_file_categories',0),
	(285,5,'add_file_categories',0),
	(286,1,'edit_file_categories',1),
	(287,2,'edit_file_categories',0),
	(288,3,'edit_file_categories',0),
	(289,4,'edit_file_categories',0),
	(290,5,'edit_file_categories',0),
	(291,1,'remove_file_categories',1),
	(292,2,'remove_file_categories',0),
	(293,3,'remove_file_categories',0),
	(294,4,'remove_file_categories',0),
	(295,5,'remove_file_categories',0),
	(296,1,'view_galleries',1),
	(297,2,'view_galleries',0),
	(298,3,'view_galleries',0),
	(299,4,'view_galleries',0),
	(300,5,'view_galleries',0),
	(301,1,'add_galleries',1),
	(302,2,'add_galleries',0),
	(303,3,'add_galleries',0),
	(304,4,'add_galleries',0),
	(305,5,'add_galleries',0),
	(306,1,'edit_galleries',1),
	(307,2,'edit_galleries',0),
	(308,3,'edit_galleries',0),
	(309,4,'edit_galleries',0),
	(310,5,'edit_galleries',0),
	(311,1,'remove_galleries',1),
	(312,2,'remove_galleries',0),
	(313,3,'remove_galleries',0),
	(314,4,'remove_galleries',0),
	(315,5,'remove_galleries',0),
	(316,1,'view_photos',1),
	(317,2,'view_photos',0),
	(318,3,'view_photos',0),
	(319,4,'view_photos',0),
	(320,5,'view_photos',0),
	(321,1,'add_photos',1),
	(322,2,'add_photos',0),
	(323,3,'add_photos',0),
	(324,4,'add_photos',0),
	(325,5,'add_photos',0),
	(326,1,'edit_photos',1),
	(327,2,'edit_photos',0),
	(328,3,'edit_photos',0),
	(329,4,'edit_photos',0),
	(330,5,'edit_photos',0),
	(331,1,'remove_photos',1),
	(332,2,'remove_photos',0),
	(333,3,'remove_photos',0),
	(334,4,'remove_photos',0),
	(335,5,'remove_photos',0),
	(336,1,'view_shop_categories',1),
	(337,2,'view_shop_categories',0),
	(338,3,'view_shop_categories',0),
	(339,4,'view_shop_categories',0),
	(340,5,'view_shop_categories',0),
	(341,1,'add_shop_categories',1),
	(342,2,'add_shop_categories',0),
	(343,3,'add_shop_categories',0),
	(344,4,'add_shop_categories',0),
	(345,5,'add_shop_categories',0),
	(346,1,'edit_shop_categories',1),
	(347,2,'edit_shop_categories',0),
	(348,3,'edit_shop_categories',0),
	(349,4,'edit_shop_categories',0),
	(350,5,'edit_shop_categories',0),
	(351,1,'remove_shop_categories',1),
	(352,2,'remove_shop_categories',0),
	(353,3,'remove_shop_categories',0),
	(354,4,'remove_shop_categories',0),
	(355,5,'remove_shop_categories',0),
	(356,1,'view_shop_items',1),
	(357,2,'view_shop_items',0),
	(358,3,'view_shop_items',0),
	(359,4,'view_shop_items',0),
	(360,5,'view_shop_items',0),
	(361,1,'add_shop_items',1),
	(362,2,'add_shop_items',0),
	(363,3,'add_shop_items',0),
	(364,4,'add_shop_items',0),
	(365,5,'add_shop_items',0),
	(366,1,'edit_shop_items',1),
	(367,2,'edit_shop_items',0),
	(368,3,'edit_shop_items',0),
	(369,4,'edit_shop_items',0),
	(370,5,'edit_shop_items',0),
	(371,1,'remove_shop_items',1),
	(372,2,'remove_shop_items',0),
	(373,3,'remove_shop_items',0),
	(374,4,'remove_shop_items',0),
	(375,5,'remove_shop_items',0),
	(376,1,'view_orders',1),
	(377,2,'view_orders',0),
	(378,3,'view_orders',0),
	(379,4,'view_orders',0),
	(380,5,'view_orders',0),
	(381,1,'add_orders',1),
	(382,2,'add_orders',0),
	(383,3,'add_orders',0),
	(384,4,'add_orders',0),
	(385,5,'add_orders',0),
	(386,1,'edit_orders',1),
	(387,2,'edit_orders',0),
	(388,3,'edit_orders',0),
	(389,4,'edit_orders',0),
	(390,5,'edit_orders',0),
	(391,1,'remove_orders',1),
	(392,2,'remove_orders',0),
	(393,3,'remove_orders',0),
	(394,4,'remove_orders',0),
	(395,5,'remove_orders',0),
	(396,1,'view_squads',1),
	(397,2,'view_squads',0),
	(398,3,'view_squads',0),
	(399,4,'view_squads',0),
	(400,5,'view_squads',0),
	(401,1,'add_squads',1),
	(402,2,'add_squads',0),
	(403,3,'add_squads',0),
	(404,4,'add_squads',0),
	(405,5,'add_squads',0),
	(406,1,'edit_squads',1),
	(407,2,'edit_squads',0),
	(408,3,'edit_squads',0),
	(409,4,'edit_squads',0),
	(410,5,'edit_squads',0),
	(411,1,'remove_squads',1),
	(412,2,'remove_squads',0),
	(413,3,'remove_squads',0),
	(414,4,'remove_squads',0),
	(415,5,'remove_squads',0),
	(416,1,'view_squad_members',1),
	(417,2,'view_squad_members',0),
	(418,3,'view_squad_members',0),
	(419,4,'view_squad_members',0),
	(420,5,'view_squad_members',0),
	(421,1,'add_squad_members',1),
	(422,2,'add_squad_members',0),
	(423,3,'add_squad_members',0),
	(424,4,'add_squad_members',0),
	(425,5,'add_squad_members',0),
	(426,1,'edit_squad_members',1),
	(427,2,'edit_squad_members',0),
	(428,3,'edit_squad_members',0),
	(429,4,'edit_squad_members',0),
	(430,5,'edit_squad_members',0),
	(431,1,'remove_squad_members',1),
	(432,2,'remove_squad_members',0),
	(433,3,'remove_squad_members',0),
	(434,4,'remove_squad_members',0),
	(435,5,'remove_squad_members',0),
	(436,1,'view_matches',1),
	(437,2,'view_matches',1),
	(438,3,'view_matches',1),
	(439,4,'view_matches',1),
	(440,5,'view_matches',1),
	(441,1,'add_matches',1),
	(442,2,'add_matches',1),
	(443,3,'add_matches',1),
	(444,4,'add_matches',1),
	(445,5,'add_matches',1),
	(446,1,'edit_matches',1),
	(447,2,'edit_matches',1),
	(448,3,'edit_matches',1),
	(449,4,'edit_matches',1),
	(450,5,'edit_matches',1),
	(451,1,'remove_matches',1),
	(452,2,'remove_matches',0),
	(453,3,'remove_matches',0),
	(454,4,'remove_matches',0),
	(455,5,'remove_matches',0),
	(456,1,'view_sponsors',1),
	(457,2,'view_sponsors',0),
	(458,3,'view_sponsors',0),
	(459,4,'view_sponsors',0),
	(460,5,'view_sponsors',0),
	(461,1,'add_sponsors',1),
	(462,2,'add_sponsors',0),
	(463,3,'add_sponsors',0),
	(464,4,'add_sponsors',0),
	(465,5,'add_sponsors',0),
	(466,1,'edit_sponsors',1),
	(467,2,'edit_sponsors',0),
	(468,3,'edit_sponsors',0),
	(469,4,'edit_sponsors',0),
	(470,5,'edit_sponsors',0),
	(471,1,'remove_sponsors',1),
	(472,2,'remove_sponsors',0),
	(473,3,'remove_sponsors',0),
	(474,4,'remove_sponsors',0),
	(475,5,'remove_sponsors',0),
	(476,1,'view_sponsor_categories',1),
	(477,2,'view_sponsor_categories',0),
	(478,3,'view_sponsor_categories',0),
	(479,4,'view_sponsor_categories',0),
	(480,5,'view_sponsor_categories',0),
	(481,1,'add_sponsor_categories',1),
	(482,2,'add_sponsor_categories',0),
	(483,3,'add_sponsor_categories',0),
	(484,4,'add_sponsor_categories',0),
	(485,5,'add_sponsor_categories',0),
	(486,1,'edit_sponsor_categories',1),
	(487,2,'edit_sponsor_categories',0),
	(488,3,'edit_sponsor_categories',0),
	(489,4,'edit_sponsor_categories',0),
	(490,5,'edit_sponsor_categories',0),
	(491,1,'remove_sponsor_categories',1),
	(492,2,'remove_sponsor_categories',0),
	(493,3,'remove_sponsor_categories',0),
	(494,4,'remove_sponsor_categories',0),
	(495,5,'remove_sponsor_categories',0),
	(605,5,'add_spotlight_items',0),
	(604,4,'add_spotlight_items',0),
	(603,3,'add_spotlight_items',0),
	(602,2,'add_spotlight_items',0),
	(601,1,'add_spotlight_items',1),
	(600,5,'view_spotlight_items',0),
	(599,4,'view_spotlight_items',0),
	(598,3,'view_spotlight_items',0),
	(597,2,'view_spotlight_items',0),
	(596,1,'view_spotlight_items',1),
	(595,5,'remove_spotlights',0),
	(594,4,'remove_spotlights',0),
	(593,3,'remove_spotlights',0),
	(592,2,'remove_spotlights',0),
	(591,1,'remove_spotlights',1),
	(590,5,'edit_spotlights',0),
	(589,4,'edit_spotlights',0),
	(588,3,'edit_spotlights',0),
	(587,2,'edit_spotlights',0),
	(586,1,'edit_spotlights',1),
	(585,5,'add_spotlights',0),
	(584,4,'add_spotlights',0),
	(583,3,'add_spotlights',0),
	(582,2,'add_spotlights',0),
	(581,1,'add_spotlights',1),
	(580,5,'view_spotlights',0),
	(579,4,'view_spotlights',0),
	(578,3,'view_spotlights',0),
	(577,2,'view_spotlights',0),
	(576,1,'view_spotlights',1),
	(633,3,'remove_ads',0),
	(632,2,'remove_ads',0),
	(631,1,'remove_ads',1),
	(630,5,'edit_ads',0),
	(629,4,'edit_ads',0),
	(628,3,'edit_ads',0),
	(627,2,'edit_ads',0),
	(626,1,'edit_ads',1),
	(625,5,'add_ads',0),
	(624,4,'add_ads',0),
	(623,3,'add_ads',0),
	(622,2,'add_ads',0),
	(621,1,'add_ads',1),
	(620,5,'view_ads',0),
	(619,4,'view_ads',0),
	(618,3,'view_ads',0),
	(617,2,'view_ads',0),
	(616,1,'view_ads',1),
	(615,5,'remove_spotlight_items',0),
	(614,4,'remove_spotlight_items',0),
	(613,3,'remove_spotlight_items',0),
	(612,2,'remove_spotlight_items',0),
	(611,1,'remove_spotlight_items',1),
	(610,5,'edit_spotlight_items',0),
	(609,4,'edit_spotlight_items',0),
	(608,3,'edit_spotlight_items',0),
	(607,2,'edit_spotlight_items',0),
	(606,1,'edit_spotlight_items',1),
	(634,4,'remove_ads',0),
	(635,5,'remove_ads',0),
	(636,1,'view_ad_slots',1),
	(637,2,'view_ad_slots',0),
	(638,3,'view_ad_slots',0),
	(639,4,'view_ad_slots',0),
	(640,5,'view_ad_slots',0),
	(641,1,'add_ad_slots',1),
	(642,2,'add_ad_slots',0),
	(643,3,'add_ad_slots',0),
	(644,4,'add_ad_slots',0),
	(645,5,'add_ad_slots',0),
	(646,1,'edit_ad_slots',1),
	(647,2,'edit_ad_slots',0),
	(648,3,'edit_ad_slots',0),
	(649,4,'edit_ad_slots',0),
	(650,5,'edit_ad_slots',0),
	(651,1,'remove_ad_slots',1),
	(652,2,'remove_ad_slots',0),
	(653,3,'remove_ad_slots',0),
	(654,4,'remove_ad_slots',0),
	(655,5,'remove_ad_slots',0),
	(656,1,'remove_comments',1),
	(657,2,'remove_comments',0),
	(658,3,'remove_comments',0),
	(659,4,'remove_comments',0),
	(660,5,'remove_comments',0),
	(661,1,'edit_comments',1),
	(662,2,'edit_comments',0),
	(663,3,'edit_comments',0),
	(664,4,'edit_comments',0),
	(665,5,'edit_comments',0),
	(666,1,'view_forum_posts',1),
	(667,2,'view_forum_posts',0),
	(668,3,'view_forum_posts',0),
	(669,4,'view_forum_posts',0),
	(670,5,'view_forum_posts',0),
	(671,1,'edit_forum_posts',1),
	(672,2,'edit_forum_posts',0),
	(673,3,'edit_forum_posts',0),
	(674,4,'edit_forum_posts',0),
	(675,5,'edit_forum_posts',0),
	(676,1,'remove_forum_posts',1),
	(677,2,'remove_forum_posts',0),
	(678,3,'remove_forum_posts',0),
	(679,4,'remove_forum_posts',0),
	(680,5,'remove_forum_posts',0),
	(681,1,'add_shop_countries',1),
	(682,2,'add_shop_countries',0),
	(683,3,'add_shop_countries',0),
	(684,4,'add_shop_countries',0),
	(685,5,'add_shop_countries',0),
	(686,1,'view_shop_countries',1),
	(687,2,'view_shop_countries',0),
	(688,3,'view_shop_countries',0),
	(689,4,'view_shop_countries',0),
	(690,5,'view_shop_countries',0),
	(691,1,'edit_shop_countries',1),
	(692,2,'edit_shop_countries',0),
	(693,3,'edit_shop_countries',0),
	(694,4,'edit_shop_countries',0),
	(695,5,'edit_shop_countries',0),
	(696,1,'remove_shop_countries',1),
	(697,2,'remove_shop_countries',0),
	(698,3,'remove_shop_countries',0),
	(699,4,'remove_shop_countries',0),
	(700,5,'remove_shop_countries',0),
	(701,1,'upload_galleries',1),
	(702,2,'upload_galleries',0),
	(703,3,'upload_galleries',0),
	(704,4,'upload_galleries',0),
	(705,5,'upload_galleries',0),
	(706,1,'delete_takeover_settings',1),
	(707,2,'delete_takeover_settings',0),
	(708,3,'delete_takeover_settings',0),
	(709,4,'delete_takeover_settings',0),
	(710,5,'delete_takeover_settings',0),
	(711,1,'view_shop_brands',1),
	(712,2,'view_shop_brands',0),
	(713,3,'view_shop_brands',0),
	(714,4,'view_shop_brands',0),
	(715,5,'view_shop_brands',0),
	(716,1,'add_shop_brands',1),
	(717,2,'add_shop_brands',0),
	(718,3,'add_shop_brands',0),
	(719,4,'add_shop_brands',0),
	(720,5,'add_shop_brands',0),
	(721,1,'remove_shop_brands',1),
	(722,2,'remove_shop_brands',0),
	(723,3,'remove_shop_brands',0),
	(724,4,'remove_shop_brands',0),
	(725,5,'remove_shop_brands',0),
	(726,1,'edit_shop_brands',1),
	(727,2,'edit_shop_brands',0),
	(728,3,'edit_shop_brands',0),
	(729,4,'edit_shop_brands',0),
	(730,5,'edit_shop_brands',0),
	(731,1,'view_forum_threads',1),
	(732,2,'view_forum_threads',0),
	(733,3,'view_forum_threads',0),
	(734,4,'view_forum_threads',0),
	(735,5,'view_forum_threads',0),
	(736,1,'edit_forum_threads',1),
	(737,2,'edit_forum_threads',0),
	(738,3,'edit_forum_threads',0),
	(739,4,'edit_forum_threads',0),
	(740,5,'edit_forum_threads',0),
	(741,1,'remove_forum_threads',1),
	(742,2,'remove_forum_threads',0),
	(743,3,'remove_forum_threads',0),
	(744,4,'remove_forum_threads',0),
	(745,5,'remove_forum_threads',0),
	(746,1,'search_articles',1),
	(747,2,'search_articles',1),
	(748,3,'search_articles',1),
	(749,4,'search_articles',1),
	(750,5,'search_articles',1),
	(751,1,'search_users',1),
	(752,2,'search_users',1),
	(753,3,'search_users',1),
	(754,4,'search_users',1),
	(755,5,'search_users',1),
	(756,1,'view_streams',1),
	(757,2,'view_streams',1),
	(758,3,'view_streams',1),
	(759,4,'view_streams',1),
	(760,5,'view_streams',1),
	(761,1,'edit_streams',1),
	(762,2,'edit_streams',1),
	(763,3,'edit_streams',1),
	(764,4,'edit_streams',1),
	(765,5,'edit_streams',1),
	(766,1,'remove_streams',1),
	(767,2,'remove_streams',1),
	(768,3,'remove_streams',1),
	(769,4,'remove_streams',1),
	(770,5,'remove_streams',1),
	(771,1,'add_streams',1),
	(772,2,'add_streams',1),
	(773,3,'add_streams',1),
	(774,4,'add_streams',1),
	(775,5,'add_streams',1),
	(776,1,'add_stream_categories',1),
	(777,2,'add_stream_categories',1),
	(778,3,'add_stream_categories',1),
	(779,4,'add_stream_categories',1),
	(780,5,'add_stream_categories',1),
	(781,1,'edit_stream_categories',1),
	(782,2,'edit_stream_categories',1),
	(783,3,'edit_stream_categories',1),
	(784,4,'edit_stream_categories',1),
	(785,5,'edit_stream_categories',1),
	(786,1,'view_stream_categories',1),
	(787,2,'view_stream_categories',1),
	(788,3,'view_stream_categories',1),
	(789,4,'view_stream_categories',1),
	(790,5,'view_stream_categories',1),
	(791,1,'remove_stream_categories',1),
	(792,2,'remove_stream_categories',1),
	(793,3,'remove_stream_categories',1),
	(794,4,'remove_stream_categories',1),
	(795,5,'remove_stream_categories',1),
	(796,1,'add_stream_sections',1),
	(797,2,'add_stream_sections',1),
	(798,3,'add_stream_sections',1),
	(799,4,'add_stream_sections',1),
	(800,5,'add_stream_sections',1),
	(801,1,'edit_stream_sections',1),
	(802,2,'edit_stream_sections',1),
	(803,3,'edit_stream_sections',1),
	(804,4,'edit_stream_sections',1),
	(805,5,'edit_stream_sections',1),
	(806,1,'view_stream_sections',1),
	(807,2,'view_stream_sections',1),
	(808,3,'view_stream_sections',1),
	(809,4,'view_stream_sections',1),
	(810,5,'view_stream_sections',1),
	(811,1,'remove_stream_sections',1),
	(812,2,'remove_stream_sections',1),
	(813,3,'remove_stream_sections',1),
	(814,4,'remove_stream_sections',1),
	(815,5,'remove_stream_sections',1);

/*!40000 ALTER TABLE `acl` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table article_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `article_categories`;

CREATE TABLE `article_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `url_name` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `article_categories` WRITE;
/*!40000 ALTER TABLE `article_categories` DISABLE KEYS */;

INSERT INTO `article_categories` (`id`, `name`, `url_name`, `created_at`)
VALUES
	(1,'Category','category',1334711332),
	(2,'Category Two','Category-Two',1342464743),
	(3,'Category Three','Category-Three',1342464752);

/*!40000 ALTER TABLE `article_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table article_categories_map
# ------------------------------------------------------------

DROP TABLE IF EXISTS `article_categories_map`;

CREATE TABLE `article_categories_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table article_sections
# ------------------------------------------------------------

DROP TABLE IF EXISTS `article_sections`;

CREATE TABLE `article_sections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `url_name` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `article_sections` WRITE;
/*!40000 ALTER TABLE `article_sections` DISABLE KEYS */;

INSERT INTO `article_sections` (`id`, `name`, `url_name`, `created_at`)
VALUES
	(1,'News','news',0),
	(2,'Blogs','blogs',0);

/*!40000 ALTER TABLE `article_sections` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table articles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `articles`;

CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `section_id` int(10) unsigned NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `short_content` varchar(140) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `is_approved` tinyint(1) DEFAULT NULL,
  `url_title` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `image_thumb_url` varchar(255) NOT NULL,
  `image_thumb_path` text NOT NULL,
  `image_filename` varchar(255) NOT NULL,
  `image_mime` varchar(40) NOT NULL,
  `image_size` int(11) NOT NULL,
  `image_path` text,
  `comments_number` int(11) NOT NULL DEFAULT '0',
  `status` char(255) NOT NULL DEFAULT 'draft',
  `starts_at` int(11) DEFAULT NULL,
  `ends_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  FULLTEXT KEY `search_index` (`title`,`short_content`,`content`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;

INSERT INTO `articles` (`id`, `section_id`, `category_id`, `title`, `content`, `short_content`, `created_at`, `updated_at`, `user_id`, `is_approved`, `url_title`, `image_url`, `image_thumb_url`, `image_thumb_path`, `image_filename`, `image_mime`, `image_size`, `image_path`, `comments_number`, `status`, `starts_at`, `ends_at`)
VALUES
	(1,1,1,'An article is for life, not just for christmas','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342461649,1342462102,1,NULL,'An-article-is-for-life-not-just-for-christmas','/uploads/article_images/landscape_7.jpg','/uploads/article_images/landscape_7_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/landscape_7_thumb.jpg','landscape_7.jpg','image/jpeg',340,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/landscape_7.jpg',5,'published',NULL,NULL),
	(2,1,2,'Vulpes, lobortis fere nulla nostrud augue','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464792,1342464792,1,NULL,'Vulpes-lobortis-fere-nulla-nostrud-augue','/uploads/article_images/landscape-mirrors-into-lake.jpg','/uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','landscape-mirrors-into-lake.jpg','image/jpeg',454,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/landscape-mirrors-into-lake.jpg',0,'published',NULL,NULL),
	(3,2,2,'Lorem ipsum dolor sit amet, multo','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p><img src=\"/uploads/tinymce/images/landscape-mirrors-into-lake.jpg\" alt=\"\" width=\"1920\" height=\"1200\" /></p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464841,1342484375,1,NULL,'Lorem-ipsum-dolor-sit-amet-multo','/uploads/article_images/field-with-big-tree.jpg','/uploads/article_images/field-with-big-tree_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/field-with-big-tree_thumb.jpg','field-with-big-tree.jpg','image/jpeg',491,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/field-with-big-tree.jpg',3,'published',NULL,NULL),
	(4,1,2,'Vulpes, lobortis fere nulla nostrud augue','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464792,1342464792,1,NULL,'Vulpes-lobortis-fere-nulla-nostrud-augue','/uploads/article_images/landscape-mirrors-into-lake.jpg','/uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','landscape-mirrors-into-lake.jpg','image/jpeg',454,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/landscape-mirrors-into-lake.jpg',0,'published',NULL,NULL),
	(5,2,2,'Lorem ipsum dolor sit amet, multo','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p><img src=\"/uploads/tinymce/images/landscape-mirrors-into-lake.jpg\" alt=\"\" width=\"1920\" height=\"1200\" /></p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464841,1342464840,1,NULL,'Lorem-ipsum-dolor-sit-amet-multo','/uploads/article_images/field-with-big-tree.jpg','/uploads/article_images/field-with-big-tree_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/field-with-big-tree_thumb.jpg','field-with-big-tree.jpg','image/jpeg',491,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/field-with-big-tree.jpg',0,'published',NULL,NULL),
	(6,1,2,'Vulpes, lobortis fere nulla nostrud augue','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464792,1342464792,1,NULL,'Vulpes-lobortis-fere-nulla-nostrud-augue','/uploads/article_images/landscape-mirrors-into-lake.jpg','/uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','landscape-mirrors-into-lake.jpg','image/jpeg',454,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/landscape-mirrors-into-lake.jpg',0,'published',NULL,NULL),
	(7,1,2,'Lorem ipsum dolor sit amet, multo','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p><img src=\"/uploads/tinymce/images/landscape-mirrors-into-lake.jpg\" alt=\"\" width=\"1920\" height=\"1200\" /></p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464841,1342464840,1,NULL,'Lorem-ipsum-dolor-sit-amet-multo','/uploads/article_images/field-with-big-tree.jpg','/uploads/article_images/field-with-big-tree_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/field-with-big-tree_thumb.jpg','field-with-big-tree.jpg','image/jpeg',491,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/field-with-big-tree.jpg',0,'published',NULL,NULL),
	(8,1,2,'Vulpes, lobortis fere nulla nostrud augue','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464792,1342464792,1,NULL,'Vulpes-lobortis-fere-nulla-nostrud-augue','/uploads/article_images/landscape-mirrors-into-lake.jpg','/uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','landscape-mirrors-into-lake.jpg','image/jpeg',454,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/landscape-mirrors-into-lake.jpg',0,'published',NULL,NULL),
	(9,1,2,'Lorem ipsum dolor sit amet, multo','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p><img src=\"/uploads/tinymce/images/landscape-mirrors-into-lake.jpg\" alt=\"\" width=\"1920\" height=\"1200\" /></p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464841,1342464840,1,NULL,'Lorem-ipsum-dolor-sit-amet-multo','/uploads/article_images/field-with-big-tree.jpg','/uploads/article_images/field-with-big-tree_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/field-with-big-tree_thumb.jpg','field-with-big-tree.jpg','image/jpeg',491,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/field-with-big-tree.jpg',0,'published',NULL,NULL),
	(10,1,2,'Vulpes, lobortis fere nulla nostrud augue','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464792,1342464792,1,NULL,'Vulpes-lobortis-fere-nulla-nostrud-augue','/uploads/article_images/landscape-mirrors-into-lake.jpg','/uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','landscape-mirrors-into-lake.jpg','image/jpeg',454,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/landscape-mirrors-into-lake.jpg',0,'published',NULL,NULL),
	(11,1,2,'Lorem ipsum dolor sit amet, multo','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p><img src=\"/uploads/tinymce/images/landscape-mirrors-into-lake.jpg\" alt=\"\" width=\"1920\" height=\"1200\" /></p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464841,1342464840,1,NULL,'Lorem-ipsum-dolor-sit-amet-multo','/uploads/article_images/field-with-big-tree.jpg','/uploads/article_images/field-with-big-tree_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/field-with-big-tree_thumb.jpg','field-with-big-tree.jpg','image/jpeg',491,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/field-with-big-tree.jpg',0,'published',NULL,NULL),
	(12,1,2,'Vulpes, lobortis fere nulla nostrud augue','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464792,1342464792,1,NULL,'Vulpes-lobortis-fere-nulla-nostrud-augue','/uploads/article_images/landscape-mirrors-into-lake.jpg','/uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','landscape-mirrors-into-lake.jpg','image/jpeg',454,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/landscape-mirrors-into-lake.jpg',0,'published',NULL,NULL),
	(13,1,2,'Lorem ipsum dolor sit amet, multo','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p><img src=\"/uploads/tinymce/images/landscape-mirrors-into-lake.jpg\" alt=\"\" width=\"1920\" height=\"1200\" /></p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464841,1342464840,1,NULL,'Lorem-ipsum-dolor-sit-amet-multo','/uploads/article_images/field-with-big-tree.jpg','/uploads/article_images/field-with-big-tree_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/field-with-big-tree_thumb.jpg','field-with-big-tree.jpg','image/jpeg',491,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/field-with-big-tree.jpg',0,'published',NULL,NULL),
	(14,2,2,'Lorem ipsum dolor sit amet, multo','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p><img src=\"/uploads/tinymce/images/landscape-mirrors-into-lake.jpg\" alt=\"\" width=\"1920\" height=\"1200\" /></p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464841,1342464840,1,NULL,'Lorem-ipsum-dolor-sit-amet-multo','/uploads/article_images/field-with-big-tree.jpg','/uploads/article_images/field-with-big-tree_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/field-with-big-tree_thumb.jpg','field-with-big-tree.jpg','image/jpeg',491,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/field-with-big-tree.jpg',0,'published',NULL,NULL),
	(15,1,2,'Vulpes, lobortis fere nulla nostrud augue','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464792,1342464792,1,NULL,'Vulpes-lobortis-fere-nulla-nostrud-augue','/uploads/article_images/landscape-mirrors-into-lake.jpg','/uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','landscape-mirrors-into-lake.jpg','image/jpeg',454,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/landscape-mirrors-into-lake.jpg',0,'published',NULL,NULL),
	(16,2,2,'Lorem ipsum dolor sit amet, multo','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p><img src=\"/uploads/tinymce/images/landscape-mirrors-into-lake.jpg\" alt=\"\" width=\"1920\" height=\"1200\" /></p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464841,1342464840,1,NULL,'Lorem-ipsum-dolor-sit-amet-multo','/uploads/article_images/field-with-big-tree.jpg','/uploads/article_images/field-with-big-tree_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/field-with-big-tree_thumb.jpg','field-with-big-tree.jpg','image/jpeg',491,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/field-with-big-tree.jpg',0,'published',NULL,NULL),
	(17,1,2,'Lorem ipsum dolor sit amet, multo','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p><img src=\"/uploads/tinymce/images/landscape-mirrors-into-lake.jpg\" alt=\"\" width=\"1920\" height=\"1200\" /></p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464841,1342464840,1,NULL,'Lorem-ipsum-dolor-sit-amet-multo','/uploads/article_images/field-with-big-tree.jpg','/uploads/article_images/field-with-big-tree_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/field-with-big-tree_thumb.jpg','field-with-big-tree.jpg','image/jpeg',491,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/field-with-big-tree.jpg',0,'published',NULL,NULL),
	(18,1,2,'Vulpes, lobortis fere nulla nostrud augue','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464792,1342464792,1,NULL,'Vulpes-lobortis-fere-nulla-nostrud-augue','/uploads/article_images/landscape-mirrors-into-lake.jpg','/uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','landscape-mirrors-into-lake.jpg','image/jpeg',454,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/landscape-mirrors-into-lake.jpg',0,'published',NULL,NULL),
	(19,1,2,'Vulpes, lobortis fere nulla nostrud augue','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464792,1342464792,1,NULL,'Vulpes-lobortis-fere-nulla-nostrud-augue','/uploads/article_images/landscape-mirrors-into-lake.jpg','/uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','landscape-mirrors-into-lake.jpg','image/jpeg',454,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/landscape-mirrors-into-lake.jpg',0,'published',NULL,NULL),
	(20,2,2,'Lorem ipsum dolor sit amet, multo','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p><img src=\"/uploads/tinymce/images/landscape-mirrors-into-lake.jpg\" alt=\"\" width=\"1920\" height=\"1200\" /></p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464841,1342464840,1,NULL,'Lorem-ipsum-dolor-sit-amet-multo','/uploads/article_images/field-with-big-tree.jpg','/uploads/article_images/field-with-big-tree_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/field-with-big-tree_thumb.jpg','field-with-big-tree.jpg','image/jpeg',491,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/field-with-big-tree.jpg',0,'published',NULL,NULL),
	(21,1,2,'Vulpes, lobortis fere nulla nostrud augue','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464792,1342464792,1,NULL,'Vulpes-lobortis-fere-nulla-nostrud-augue','/uploads/article_images/landscape-mirrors-into-lake.jpg','/uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','landscape-mirrors-into-lake.jpg','image/jpeg',454,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/landscape-mirrors-into-lake.jpg',0,'published',NULL,NULL),
	(22,1,2,'Lorem ipsum dolor sit amet, multo','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p><img src=\"/uploads/tinymce/images/landscape-mirrors-into-lake.jpg\" alt=\"\" width=\"1920\" height=\"1200\" /></p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464841,1342464840,1,NULL,'Lorem-ipsum-dolor-sit-amet-multo','/uploads/article_images/field-with-big-tree.jpg','/uploads/article_images/field-with-big-tree_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/field-with-big-tree_thumb.jpg','field-with-big-tree.jpg','image/jpeg',491,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/field-with-big-tree.jpg',0,'published',NULL,NULL),
	(23,1,2,'Vulpes, lobortis fere nulla nostrud augue','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464792,1342464792,1,NULL,'Vulpes-lobortis-fere-nulla-nostrud-augue','/uploads/article_images/landscape-mirrors-into-lake.jpg','/uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/landscape-mirrors-into-lake_thumb.jpg','landscape-mirrors-into-lake.jpg','image/jpeg',454,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/landscape-mirrors-into-lake.jpg',0,'published',NULL,NULL),
	(24,1,2,'Lorem ipsum dolor sit amet, multo','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p><img src=\"/uploads/tinymce/images/landscape-mirrors-into-lake.jpg\" alt=\"\" width=\"1920\" height=\"1200\" /></p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464841,1342464840,1,NULL,'Lorem-ipsum-dolor-sit-amet-multo','/uploads/article_images/field-with-big-tree.jpg','/uploads/article_images/field-with-big-tree_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/field-with-big-tree_thumb.jpg','field-with-big-tree.jpg','image/jpeg',491,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/field-with-big-tree.jpg',0,'published',NULL,NULL),
	(25,1,2,'Lorem ipsum dolor sit amet, multo','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p><img src=\"/uploads/tinymce/images/landscape-mirrors-into-lake.jpg\" alt=\"\" width=\"1920\" height=\"1200\" /></p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut op',1342464841,1342464840,1,NULL,'Lorem-ipsum-dolor-sit-amet-multo','/uploads/article_images/field-with-big-tree.jpg','/uploads/article_images/field-with-big-tree_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/article_images/field-with-big-tree_thumb.jpg','field-with-big-tree.jpg','image/jpeg',491,'/Users/Gavin/Sites/Rocketeer Basic/uploads/article_images/field-with-big-tree.jpg',0,'published',NULL,NULL);

/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resource_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `resource` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;

INSERT INTO `comments` (`id`, `resource_id`, `user_id`, `resource`, `content`, `created_at`)
VALUES
	(1,1,1,'articles','This is a comment',1342462093),
	(2,1,1,'articles','Commenting some more on this article',1342462102),
	(3,3,1,'articles','This is a comment',1342483072),
	(4,3,1,'articles','This is a real comment!',1342483357),
	(5,3,1,'articles','More comments, but this one is much longer so you can see how it acts when it drops over more than one line. It should look totally fine.',1342484375);

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;

INSERT INTO `groups` (`id`, `name`, `description`)
VALUES
	(1,'admins','Administrators'),
	(2,'members','Members'),
	(3,'contributors','Contributors'),
	(4,'squad_members','Squad Members'),
	(5,'authors','Authors'),
	(6,'moderators','Moderators');

/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table meta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `meta`;

CREATE TABLE `meta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `fb_id` int(11) DEFAULT NULL,
  `twt_id` int(11) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `about` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `meta` WRITE;
/*!40000 ALTER TABLE `meta` DISABLE KEYS */;

INSERT INTO `meta` (`id`, `user_id`, `first_name`, `last_name`, `fb_id`, `twt_id`, `age`, `twitter`, `about`)
VALUES
	(1,1,'Admin','User',NULL,NULL,'1st January 1970','@twitter','<p>I am the default admin user, I would suggest you remove me once you are confident enough to create your own admin account with your own details</p>');

/*!40000 ALTER TABLE `meta` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url_title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `template_name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;

INSERT INTO `pages` (`id`, `title`, `url_title`, `content`, `created_at`, `updated_at`, `parent_id`, `template_name`)
VALUES
	(1,'About','about','<p>Lorem ipsum dolor sit amet, multo, indoles ea cogo tation paulatim validus aliquip mos, bis vel iusto quae ut. Iusto vel iriure jus ut opes lucidus in hendrerit singularis vero lucidus. Ideo sudo et consequat lucidus odio praesent, modo eligo torqueo metuo imputo, ulciscor. Ullamcorper sit ideo comis ut jus indoles. Consequat gilvus, vulputate natu meus suscipere nostrud suscipit. Eros eum minim haero acsi consequat metuo lucidus gemino odio ibidem conventio facilisis capio. Patria plaga facilisi vel et verto validus, obruo nonummy defui ludus. Vulpes, lobortis fere nulla nostrud augue.</p>\n<p>Ut nullus vindico adsum vel turpis. Luptatum quidne ut paratus autem vulputate. Ea blandit dignissim, dolore veniam imputo. Qui nostrud quis qui validus rusticus feugait validus iustum. Humo abbas, utrum quae, utinam euismod ut feugiat, duis refoveo iustum.</p>\n<p><img title=\"Hot air balloon\" src=\"/uploads/tinymce/images/landscape_3.jpg\" alt=\"Hot air balloon\" width=\"1920\" height=\"1200\" /></p>\n<p>Praemitto suscipere incassum wisi feugiat velit reprobo.</p>\n<p>At ymo iriure delenit pneum singularis loquor usitas antehabeo blandit. Te eum hendrerit virtus causa utrum caecus voco paratus. Brevitas inhibeo refoveo nibh ut consectetuer iriure et ymo euismod vicis distineo. Hendrerit meus ille meus patria populus, minim diam praemitto luctus exerci utrum accumsan esca. Commodo caecus quis appellatio capio ut camur. Erat exerci comis lobortis eligo pertineo et zelus opto nulla olim utinam paratus oppeto haero.</p>\n<p>Ut ne, ne eu loquor ut, facilisi ingenium. Duis vulputate vel quae feugait nibh defui importunus tation iriure ratis esse. Decet in enim ex jugis lobortis in appellatio voco, et secundum brevitas. Quis in odio aliquam esca vero populus quibus interdico paulatim wisi mara consequat, luctus. Praesent lobortis eu quis ideo vero vel iustum roto vindico aptent laoreet.</p>\n<p>Exputo molior vindico, virtus ille nulla secundum similis illum. Delenit demoveo acsi turpis autem abdo torqueo eligo.</p>\n<p>Turpis iriure pagus blandit suscipit accumsan abigo utinam. Incassum praemitto neo vero utrum nulla consequat praesent eros quadrum ut.</p>\n<p>Caecus consequat, nostrud ea, esse, defui, demoveo. Gemino nostrud te, pagus tristique velit. Jus sino interdico ullamcorper verto meus hendrerit, quae feugait foras. Quae vel ne singularis velit, abico blandit commoveo at, pala esse letatio laoreet.</p>\n<p>Accumsan accumsan at illum sino persto delenit augue eros, genitus minim, ullamcorper uxor odio.</p>\n<p>Te in iustum te proprius, haero.</p>',0,1342463004,0,'default');

/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`)
VALUES
	('91d7e868915c41edd1c11d54d3b26c1b','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_4) App',1342485106,'a:7:{s:15:\"_facebook_scope\";s:0:\"\";s:18:\"_facebook_callback\";s:21:\"http://blueprint.dev/\";s:5:\"email\";s:15:\"admin@admin.com\";s:2:\"id\";s:1:\"1\";s:7:\"user_id\";s:1:\"1\";s:8:\"group_id\";s:1:\"1\";s:5:\"group\";s:6:\"admins\";}'),
	('93d56a57d471cfd26c8944f3bcdf9d74','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_4) App',1342525037,'a:2:{s:15:\"_facebook_scope\";s:0:\"\";s:18:\"_facebook_callback\";s:32:\"http://blueprint.dev/admin/login\";}');

/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL,
  `value` varchar(255) NOT NULL,
  `category_name` varchar(40) NOT NULL DEFAULT 'general',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;

INSERT INTO `settings` (`id`, `key`, `value`, `category_name`)
VALUES
	(1,'site_title','Rocketeer Basic','general'),
	(2,'default_theme','basic','themes'),
	(3,'site_id','','google_analytics'),
	(4,'username','','google_analytics'),
	(5,'password','','google_analytics'),
	(6,'image_width','150','articles'),
	(7,'image_height','150','articles'),
	(14,'avatar_width','80','users'),
	(15,'avatar_height','80','users'),
	(16,'per_page','20','articles'),
	(29,'application_id','','facebook'),
	(30,'api_secret','','facebook'),
	(31,'consumer_key','','twitter'),
	(32,'consumer_secret','','twitter');

/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table spotlight_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `spotlight_items`;

CREATE TABLE `spotlight_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `spotlight_id` int(10) unsigned NOT NULL,
  `headline` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `description` text,
  `image_url` varchar(255) NOT NULL,
  `image_thumb_url` varchar(255) NOT NULL,
  `image_thumb_path` text NOT NULL,
  `image_filename` varchar(255) NOT NULL,
  `image_mime` varchar(40) NOT NULL,
  `image_size` int(11) NOT NULL,
  `image_path` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `spotlight_items` WRITE;
/*!40000 ALTER TABLE `spotlight_items` DISABLE KEYS */;

INSERT INTO `spotlight_items` (`id`, `spotlight_id`, `headline`, `url`, `description`, `image_url`, `image_thumb_url`, `image_thumb_path`, `image_filename`, `image_mime`, `image_size`, `image_path`)
VALUES
	(1,1,'Spotlights are great for showing off content','http://www.rocketeercms.com','<p>Spotlights are wonderfully customisable, allowing you to point them wherever you like, including external websites.</p>','/uploads/spotlight_images/carousel_01.jpg','/uploads/spotlight_images/carousel_01_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/spotlight_images/carousel_01_thumb.jpg','carousel_01.jpg','image/jpeg',48,'/Users/Gavin/Sites/Rocketeer Basic/uploads/spotlight_images/carousel_01.jpg'),
	(2,1,'These can also go to pages within your own website','/articles/news/','<p>Simply put you can just enter the url below, sans domain name and the spotlight item will point to that page.</p>','/uploads/spotlight_images/carousel_02.jpg','/uploads/spotlight_images/carousel_02_thumb.jpg','/Users/Gavin/Sites/Rocketeer Basic//uploads/spotlight_images/carousel_02_thumb.jpg','carousel_02.jpg','image/jpeg',105,'/Users/Gavin/Sites/Rocketeer Basic/uploads/spotlight_images/carousel_02.jpg');

/*!40000 ALTER TABLE `spotlight_items` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table spotlights
# ------------------------------------------------------------

DROP TABLE IF EXISTS `spotlights`;

CREATE TABLE `spotlights` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `template_name` varchar(40) DEFAULT 'default',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `spotlights` WRITE;
/*!40000 ALTER TABLE `spotlights` DISABLE KEYS */;

INSERT INTO `spotlights` (`id`, `name`, `template_name`, `created_at`, `updated_at`)
VALUES
	(1,'Main','main',0,0);

/*!40000 ALTER TABLE `spotlights` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned NOT NULL,
  `ip_address` char(16) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `country` varchar(2) NOT NULL DEFAULT '',
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(10) unsigned NOT NULL,
  `last_login` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `avatar_url` varchar(255) NOT NULL,
  `avatar_thumb_url` varchar(255) NOT NULL,
  `avatar_thumb_path` text NOT NULL,
  `avatar_filename` varchar(255) NOT NULL,
  `avatar_mime` varchar(40) NOT NULL,
  `avatar_size` int(11) NOT NULL,
  `avatar_path` text,
  `timezone` varchar(40) NOT NULL DEFAULT 'Europe/London',
  `comments_number` int(11) NOT NULL DEFAULT '0',
  `forum_threads_number` int(11) NOT NULL DEFAULT '0',
  `forum_posts_number` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`username`,`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `group_id`, `ip_address`, `username`, `password`, `country`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `remember_code`, `created_on`, `last_login`, `active`, `avatar_url`, `avatar_thumb_url`, `avatar_thumb_path`, `avatar_filename`, `avatar_mime`, `avatar_size`, `avatar_path`, `timezone`, `comments_number`, `forum_threads_number`, `forum_posts_number`)
VALUES
	(1,1,'127.0.0.1','Admin','97132b3bb7c5efd2a3daf34d281ea03cbcdedb18','GB','2ee07423e2','admin@admin.com','',NULL,NULL,1342481356,1342481486,1,'/uploads/user_avatars/avatar2.png','/uploads/user_avatars/avatar2_thumb.png','/Users/Gavin/Sites/Rocketeer Basic//uploads/user_avatars/avatar2_thumb.png','avatar2.png','image/png',8,'/Users/Gavin/Sites/Rocketeer Basic/uploads/user_avatars/avatar2.png','Europe/London',3,0,0);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
