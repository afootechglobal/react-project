-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2023 at 05:58 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alwaysonline_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `alert_tab`
--

CREATE TABLE `alert_tab` (
  `sn` int(11) NOT NULL,
  `alert_id` varchar(255) NOT NULL,
  `alert_detail` varchar(255) NOT NULL,
  `staff_id` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `computer` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `seen_status` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_tab`
--

CREATE TABLE `blog_tab` (
  `sn` int(11) NOT NULL,
  `cat_id` varchar(20) NOT NULL,
  `blog_id` varchar(50) NOT NULL,
  `blog_title` mediumtext NOT NULL,
  `blog_url` varchar(255) NOT NULL,
  `seo_keywords` text NOT NULL,
  `blog_summary` text NOT NULL,
  `blog_detail` longtext NOT NULL,
  `status_id` varchar(50) NOT NULL,
  `blog_pix` varchar(255) NOT NULL,
  `staff_id` varchar(30) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_tab`
--

INSERT INTO `blog_tab` (`sn`, `cat_id`, `blog_id`, `blog_title`, `blog_url`, `seo_keywords`, `blog_summary`, `blog_detail`, `status_id`, `blog_pix`, `staff_id`, `created_time`, `updated_time`) VALUES
(1, '007', 'BLOG00120231104052218', '7 Excellent Tips to Pass WAEC in One Sitting', '7-Excellent-Tips-to-Pass-WAEC-in-One-Sitting', 'WAEC, WAEC BLOG', 'The West African Examination Council (WAEC) is an examination body within the West African community that oversees the West African Senior Secondary School Certificate', '<h2><strong>Important Things to Know About WAEC/WASSCE 2023</strong></h2>\r\n<p>The West African Examination Council (WAEC) is an examination body within the West African community that oversees the West African Senior Secondary School Certificate Examination (WASSCE).<br /><br />WASSCE is an important examination that students in their final year in senior secondary schools or high schools, sit for. Every student taking WASSCE is expected to put their best foot forward; preparing effectively to pass in one sitting. Most times, a lot of students have difficulties passing all the subjects they sat for hence, the need to rewrite WASSCE.<br /><br />In this article, we will be sharing excellent tips to help you ace WASSCE in one sitting. Before that, let&rsquo;s walk you through the answers to some common questions you might randomly ask.</p>\r\n<h3>When will WAEC 2023 start?</h3>\r\n<p>The date for WASSCE 2023 has been scheduled by WAEC to start 8th May 2023 to 23rd June 2023.<br /><br />What are WAEC compulsory subjects?<br />English and Mathematics are compulsory subjects every student writing WASSCE must sit for.<br /><br /><strong>Tips To Prepare For WAEC/WASSCE</strong></p>\r\n<h3>1. Get acquainted With the WAEC Syllabus:</h3>\r\n<p>One of the major steps to preparing for any examination is knowing the format of the exam. WAEC requires students to register for at least six(6) subjects and a maximum of nine including English Language, which is compulsory for Science, Art, and Commercial students.<br /><br />WAEC questions are categorized into multiple-choice and theory, which students must answer depending on the subject. There are practical exams in Physics, Chemistry, Biology, and, Food and Nutrition. It is also important to study with the WAEC syllabus and know the timetable to help you plan accordingly.<br /><br />Also read: Government Library is now available on uLesson.</p>\r\n<h3>2. Set Attainable Study Goals</h3>\r\n<p><br />Another tip to help you prepare for WAEC is to set specific and attainable goals. Goal setting is a vital phase in preparing for a significant exam like WASSCE. Goals that are well-stated help you focus and channel your efforts to reach your WASSCE goals that&rsquo;s why we provide assistance to our learners to help them set SMART (Specific, Measurable, Attainable, Realistic &amp; Time bounded) goals. <br /><br />Keep in mind that your objectives do not have to be difficult, the simpler the goal the easier it is to achieve it. Avoid vague goals like, &ldquo;study chemistry during a certain regular time&rdquo;. Rather, Study this way: read and take notes on chapter 6 in Chemistry, or two comprehensive passages, etc.<br /><br />3. Create a Study Plan<br />A study plan is a sequence of stages that brings you to achieve the goal you set for yourself. When preparing for a really significant exam like WASSCE, a strategy like creating a study plan is necessary. A study plan allows you to allocate adequate time slots for studying each subject. For the WAEC exams, this would include the number of hours you intend to spend reading each subject and the tools you&rsquo;ll need to help you achieve your goals.<br /><br />4. Start Studying Early &amp; Take Notes<br />Adequate preparation is the best antidote to exam anxiety. Studying ahead allows you to spend more time comprehending each subject. Research shows that videos, illustrations, animations, motion pictures, and images aid better learning and understanding that&rsquo;s why the uLesson learning app uses this technique to help its learners excel academically.<br /><br />Digesting too much information can be overwhelming. A tip for tackling this is, &ldquo;take short notes when studying.&rdquo; Focus on writing down only relevant information that will enable you to recollect a larger concept. Short notes are relevant and useful for revisions.<br /><br />Also read: Library Lifetime Access: everything about it.<br /><br />5. Take Mock Exams &amp; Practice Tests on uLesson<br />Mock exams and practice tests give you an idea of how the WASSCE questions are set and also help you prepare effectively&nbsp; You&rsquo;ll learn how to manage your time effectively and identify your areas of strength and weakness. Take a uLesson mock exam to see how prepared you are for the forthcoming WAEC examinations.<br /><br />Set a time to practice past WAEC exam questions. This would help you become familiar with how the exam questions are set also and prepare you ahead of time. With over 8 years of past WAEC questions and detailed solutions available on the app, you can easily prepare for your WAEC exam. <br /><br />6. Ask for help<br />Smart learners continually ask questions when they feel stuck when learning. Speak to other learners or expert tutors about the topics you are struggling with to get clarity and understanding. The uLesson Learning App allows students to ask and receive fast responses to questions they have in different subjects.<br /><br />7. Take Some Rest<br />Rest is an essential element of the learning process. Adequate rest would help you avoid burnout and fatigue after long hours of studying.<br /><br />These tips are needed to help you effectively prepare for WAEC/WASSCE. Now, begin to apply these tips and you will be well on your way to being adequately prepared for your WAEC exams/WASSCE.</p>', '1', 'BLOG00120231104052218_6545c748b8eee.png', 'STF0000', '2023-11-04 05:22:18', '2023-11-04 04:23:36'),
(2, '007', 'BLOG00220231104054302', '4 Easy Ways to Help Your Child Prepare for the New School Se', '4-Easy-Ways-to-Help-Your-Child-Prepare-for-the-New-School-Session', '4 Easy Ways to Help Your Child Prepare for the New School Se', 'The new school year is here, and it’s about time to start helping your child prepare effectively. In this article, we share four easy ways to get them off to a great s', '<div data-id=\"f56e666\" data-element_type=\"container\" data-settings=\"{&quot;content_width&quot;:&quot;boxed&quot;}\">\r\n<div>\r\n<div data-id=\"d2a2098\" data-element_type=\"widget\" data-widget_type=\"text-editor.default\">\r\n<div>\r\n<h3>Help them set realistic expectations for the new school year</h3>\r\n<p>Helping your child plan and set expectations for the new session is an effective way to get them started. Ask your child about their grade expectations in the various subjects they will be taking. This should be done after they&rsquo;ve been introduced to the subjects at school, especially if the subjects are new to them.</p>\r\n<p>Initiate conversations with them and discuss what they are hoping to learn and achieve in the first term of the session, then work with them to set SMART goals.</p>\r\n<p>Also read:&nbsp;<a href=\"https://ulesson.com/blog/create-study-timetable-in-4-steps/\">4 easy steps for creating a study timetable</a></p>\r\n<h2>Help them establish a regular after-school routine</h2>\r\n<p>A consistent after-school routine helps children develop overall life skills that are significant to their success in academics and life. Skills such as time management, a sense of responsibility, prioritiation, and the like keep them in check with school and house duties</p>\r\n<p>After-school routines such as nap time, study and homework time, house chore time, and playing, plus relaxation time, should be included to create a well-structured after-school routine for children.&nbsp;</p>\r\n<p>It is also necessary to study and understand your child&rsquo;s learning patterns so they can guide you when helping them create an after-school routine. This is a key tool for nurturing children&rsquo;s development.</p>\r\n<p>Also read:&nbsp;<a href=\"https://ulesson.com/blog/ways-to-help-your-child-study-effectively-at-home/\">5 ways to help your child study effectively at home</a></p>\r\n<span id=\"elementor-toc__heading-anchor-1\"></span>\r\n<h3>Help them learn faster and easier with a learning companion</h3>\r\n<p>At uLesson, we believe children can learn and understand even the most difficult subjects easily. The uLesson Educational Tablet or&nbsp;<a href=\"https://app.adjust.com/3740fv5_qt1ww81\">App</a>&nbsp;helps children understand topics and subjects easily through the use of adaptive learning techniques, including video lessons, live classes from expert tutors, homework assistance, quizzes, educational games, and live chats with expert tutors.<br /><br />uLesson offers a variety of subjects across different grades, including primary, junior, and senior secondary schools. The lessons are interactive, engaging, and taught by experienced tutors.&nbsp;</p>\r\n<p>Also read:&nbsp;<a href=\"https://ulesson.com/blog/the-ulesson-education-tab-2features-and-benefits/\">The features and benefits of uLesson Education Tab 2</a></p>\r\n<span id=\"elementor-toc__heading-anchor-2\"></span>\r\n<h3>Back to School Discount Offer</h3>\r\n<p>To support parents in getting their children off to a great start in the new school session, we are giving up to 20% discount on the uLesson Education Tab 2 and subscription to Learning Plans.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div data-id=\"dec327f\" data-element_type=\"container\" data-settings=\"{&quot;content_width&quot;:&quot;boxed&quot;}\">\r\n<div>\r\n<div data-id=\"173d104\" data-element_type=\"widget\" data-widget_type=\"image.default\">\r\n<div><a href=\"https://ulesson.com/education-tab\"><img src=\"https://ulesson.com/blog/wp-content/uploads/2023/09/Group_10584-1024x536.png\" alt=\"uLesson Back to School\" width=\"100%\" height=\"\" /></a></div>\r\n</div>\r\n</div>\r\n</div>\r\n<div data-id=\"1b7d3dd\" data-element_type=\"container\" data-settings=\"{&quot;content_width&quot;:&quot;boxed&quot;}\">\r\n<div>\r\n<div data-id=\"ab0a588\" data-element_type=\"widget\" data-widget_type=\"text-editor.default\">\r\n<div><span id=\"elementor-toc__heading-anchor-3\"></span>\r\n<h3>Let them know you will reward their efforts</h3>\r\n<p>Children love it when you praise or reward their effort whenever they complete some tasks, get a good score, or improve their grades. Praising their effort, getting them gifts, or rewarding them with a treat boosts their confidence and empowers them for better performance, even when they don&rsquo;t get perfect grades. Let them know you will reward their efforts, even if it&rsquo;s not every time.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<p>&nbsp;</p>', '1', 'BLOG00220231104054302_6545cc1aac340.jpg', 'STF0000', '2023-11-04 05:43:02', '2023-11-04 04:45:31'),
(3, '007', 'BLOG00320231104071940', 'Finding and Using WAEC English Past Questions: The Best Way', 'Finding-and-Using-WAEC-English-Past-Questions-The-Best-Way', 'Finding and Using WAEC English Past Questions: The Best Way', 'WAEC stands for West African Examination council; it is the examining body that delivers the basic O-Level examination for secondary school students in West Africa. ', '<p>WAEC stands for West African Examination council; it is the examining body that delivers the basic O-Level examination for secondary school students in West Africa. Most, if not all, Nigerians who plan to further their education to the tertiary stage have to sit for the WAEC exams, also known widely as SSCE, or a combination of both that becomes WASSCE.</p>\r\n<p>As with any examination, quite a lot of time is dedicated to&nbsp;the preparation stage, which is why it is normal to see one prepare for an examination of a few hours for months, or even years. This is also the case with WAEC examinations.</p>\r\n<p>However, of all the subjects offered by WAEC, the English paper is often dreaded by secondary school students, mostly because of the way the&nbsp;WAEC English paper requires you to be creative&nbsp;with your answers.</p>\r\n<p>But there is very little to fear if you know how to properly utilise WAEC English past questions to your advantage. The fear in question sort of evaporates when you infuse the element of using these WASSCE past questions to your utmost benefit.</p>\r\n<p>Really, the beauty of having past questions to revise with is that&nbsp;it gives you a picture of what the actual exam will look like. In any case, the information and helpful ideas in this article should take you several steps ahead in preparing yourself for the SSCE English examination.</p>\r\n<p>&nbsp;</p>', '1', 'BLOG00320231104071940_6545e27c01907.jpg', 'STF0000', '2023-11-04 07:19:40', '2023-11-04 06:19:40');

-- --------------------------------------------------------

--
-- Table structure for table `blog_view_tab`
--

CREATE TABLE `blog_view_tab` (
  `sn` int(11) NOT NULL,
  `blog_id` varchar(50) NOT NULL,
  `session` varchar(100) NOT NULL,
  `system` varchar(100) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exam_subject_tab`
--

CREATE TABLE `exam_subject_tab` (
  `sn` int(11) NOT NULL,
  `exam_id` varchar(100) NOT NULL,
  `subject_id` varchar(100) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_subject_tab`
--

INSERT INTO `exam_subject_tab` (`sn`, `exam_id`, `subject_id`, `created_time`, `updated_time`) VALUES
(6, 'EXAM00120231104091818', 'SUBJ00520231104091338', '2023-11-04 09:19:18', '2023-11-04 08:19:18'),
(7, 'EXAM00120231104091818', 'SUBJ00420231104091109', '2023-11-04 09:19:18', '2023-11-04 08:19:18'),
(8, 'EXAM00120231104091818', 'SUBJ00120231104072333', '2023-11-04 09:19:18', '2023-11-04 08:19:18'),
(9, 'EXAM00120231104091818', 'SUBJ00320231104072838', '2023-11-04 09:19:18', '2023-11-04 08:19:18'),
(10, 'EXAM00120231104091818', 'SUBJ00220231104072532', '2023-11-04 09:19:18', '2023-11-04 08:19:18'),
(11, 'EXAM00220231104092419', 'SUBJ00520231104091338', '2023-11-04 09:24:19', '2023-11-04 08:24:19'),
(12, 'EXAM00220231104092419', 'SUBJ00420231104091109', '2023-11-04 09:24:19', '2023-11-04 08:24:19'),
(13, 'EXAM00220231104092419', 'SUBJ00120231104072333', '2023-11-04 09:24:19', '2023-11-04 08:24:19'),
(14, 'EXAM00220231104092419', 'SUBJ00320231104072838', '2023-11-04 09:24:19', '2023-11-04 08:24:19'),
(15, 'EXAM00220231104092419', 'SUBJ00220231104072532', '2023-11-04 09:24:19', '2023-11-04 08:24:19'),
(21, 'EXAM00320231104092607', 'SUBJ00520231104091338', '2023-11-04 09:26:51', '2023-11-04 08:26:51'),
(22, 'EXAM00320231104092607', 'SUBJ00420231104091109', '2023-11-04 09:26:51', '2023-11-04 08:26:51'),
(23, 'EXAM00320231104092607', 'SUBJ00120231104072333', '2023-11-04 09:26:51', '2023-11-04 08:26:51'),
(24, 'EXAM00320231104092607', 'SUBJ00320231104072838', '2023-11-04 09:26:51', '2023-11-04 08:26:51'),
(25, 'EXAM00320231104092607', 'SUBJ00220231104072532', '2023-11-04 09:26:51', '2023-11-04 08:26:51'),
(29, 'EXAM00420231104093435', 'SUBJ00120231104072333', '2023-11-04 09:35:29', '2023-11-04 08:35:29'),
(30, 'EXAM00420231104093435', 'SUBJ00320231104072838', '2023-11-04 09:35:29', '2023-11-04 08:35:29'),
(31, 'EXAM00420231104093435', 'SUBJ00220231104072532', '2023-11-04 09:35:29', '2023-11-04 08:35:29'),
(32, 'EXAM00420231104093435', 'SUBJ00420231104091109', '2023-11-04 09:35:29', '2023-11-04 08:35:29'),
(33, 'EXAM00420231104093435', 'SUBJ00520231104091338', '2023-11-04 09:35:29', '2023-11-04 08:35:29');

-- --------------------------------------------------------

--
-- Table structure for table `exam_tab`
--

CREATE TABLE `exam_tab` (
  `sn` int(11) NOT NULL,
  `exam_id` varchar(100) NOT NULL,
  `abbreviation` varchar(50) NOT NULL,
  `exam_name` varchar(100) NOT NULL,
  `exam_url` varchar(255) NOT NULL,
  `seo_keywords` text NOT NULL,
  `seo_description` text NOT NULL,
  `status_id` int(11) NOT NULL,
  `exam_passport` varchar(100) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_tab`
--

INSERT INTO `exam_tab` (`sn`, `exam_id`, `abbreviation`, `exam_name`, `exam_url`, `seo_keywords`, `seo_description`, `status_id`, `exam_passport`, `created_time`, `updated_time`) VALUES
(1, 'EXAM00120231104091818', 'waec', 'WEST AFRICAN EXAMINATIONS COUNCIL', 'waec', 'WAEC, West African Examinations Council', 'The West African Examinations Council is an examination board established by law to determine the examinations required in the public interest', 1, 'EXAM00120231104091818_6545fe86a0212.jpeg', '2023-11-04 09:18:18', '2023-11-04 08:19:18'),
(2, 'EXAM00220231104092419', 'neco', 'NATIONAL EXAMINATIONS COUNCIL', 'neco', 'NECO', 'The National Examinations Council is an examination body in Nigeria that conducts the Senior Secondary Certificate Examination and the General Certificate in Ed', 1, 'EXAM00220231104092419_6545ffb38f8e7.jpeg', '2023-11-04 09:24:19', '2023-11-04 08:24:19'),
(3, 'EXAM00320231104092607', 'utme', 'UNIFIED TERTIARY MATRICULATION EXAMINATION', 'utme', 'UTME', 'The Unified Tertiary Matriculation Examination is a computer-based standardized examination for prospective undergraduates in Nigeria.', 1, 'EXAM00320231104092607_6546004bdaec8.png', '2023-11-04 09:26:07', '2023-11-04 08:26:51'),
(4, 'EXAM00420231104093435', 'nabteb', 'NATIONAL BUSINESS AND TECHNICAL EXAMINATIONS BOARD', 'nabteb', 'NABTEB', 'The National Business and Technical Examinations Board popularly known as NABTEB, is a Nigerian examination board that is conducting examinations for technical ', 1, 'EXAM00420231104093435_6546021bbec78.jpeg', '2023-11-04 09:34:35', '2023-11-04 08:34:35');

-- --------------------------------------------------------

--
-- Table structure for table `faq_tab`
--

CREATE TABLE `faq_tab` (
  `sn` int(11) NOT NULL,
  `cat_id` varchar(100) NOT NULL,
  `faq_id` varchar(100) NOT NULL,
  `faq_question` varchar(255) NOT NULL,
  `faq_answer` longtext NOT NULL,
  `status_id` varchar(50) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq_tab`
--

INSERT INTO `faq_tab` (`sn`, `cat_id`, `faq_id`, `faq_question`, `faq_answer`, `status_id`, `created_time`, `updated_time`) VALUES
(1, '007', 'FAQ00120231104051118', 'How do i signup on this platform?', '<p>Kindly follow http://localhost/projects/alwaysonlineclasses.com/user/login/ to signup or login</p>', '1', '2023-11-04 05:11:18', '2023-11-04 04:13:10'),
(2, '007', 'FAQ00220231104051300', 'How do i subscribe to the lesson videos?', '<p>Signup and login tou your portal, and follow other instructions.</p>', '1', '2023-11-04 05:13:00', '2023-11-04 04:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment_tab`
--

CREATE TABLE `payment_tab` (
  `sn` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `payment_id` varchar(50) NOT NULL,
  `payment_gateway_id` varchar(50) NOT NULL,
  `sub_topic_id` varchar(50) NOT NULL,
  `transaction_type_id` varchar(100) NOT NULL,
  `fund_method_id` varchar(20) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `status_id` varchar(20) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_tab`
--

INSERT INTO `payment_tab` (`sn`, `user_id`, `payment_id`, `payment_gateway_id`, `sub_topic_id`, `transaction_type_id`, `fund_method_id`, `amount`, `status_id`, `date`) VALUES
(1, 'USER00120231104124303', 'TRANS00120231104125927', '', 'SUBTOPIC00320231104105016', 'DB', 'FM002', 300.00, '3', '2023-11-04 12:59:27'),
(2, 'USER00120231104124303', 'TRANS00220231104125939', '', 'SUBTOPIC00320231104105016', 'DB', 'FM002', 300.00, '3', '2023-11-04 12:59:39'),
(3, 'USER00120231104124303', 'TRANS00420231104010540', 'TRANS00420231104010540', 'SUBTOPIC00120231104104304', 'DB', 'FM002', 200.00, '5', '2023-11-04 13:05:40'),
(4, 'USER00120231104124303', 'TRANS00520231104011351', 'TRANS00520231104011351', 'SUBTOPIC00620231104105901', 'DB', 'FM001', 150.00, '5', '2023-11-04 13:14:01'),
(5, 'USER00120231104124303', 'TRANS01020231105015638', 'TRANS01020231105015638', 'SUBTOPIC00320231104105016', 'DB', 'FM002', 300.00, '5', '2023-11-05 01:56:38'),
(6, 'USER00120231104124303', 'TRANS01120231105015657', '', 'SUBTOPIC00420231104105229', 'DB', 'FM002', 250.00, '7', '2023-11-05 01:56:57');

-- --------------------------------------------------------

--
-- Table structure for table `setup_backend_settings_tab`
--

CREATE TABLE `setup_backend_settings_tab` (
  `sn` int(11) NOT NULL,
  `backend_setting_id` varchar(10) NOT NULL,
  `smtp_host` varchar(100) NOT NULL,
  `smtp_username` varchar(100) NOT NULL,
  `smtp_password` varchar(100) NOT NULL,
  `smtp_port` int(11) NOT NULL,
  `sender_name` varchar(100) NOT NULL,
  `support_email` varchar(100) NOT NULL,
  `payment_key` text NOT NULL,
  `currency_id` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setup_backend_settings_tab`
--

INSERT INTO `setup_backend_settings_tab` (`sn`, `backend_setting_id`, `smtp_host`, `smtp_username`, `smtp_password`, `smtp_port`, `sender_name`, `support_email`, `payment_key`, `currency_id`, `date`) VALUES
(1, 'BK_ID001', 'mail.agrohandlers.com', 'info@agrohandlers.com', '1971@@@ademorinola12', 465, 'AgroHandlers', 'afootech2016@gmail.com', 'pk_test_5a27902934264b8a8f8120c15c4c0f198b9715e3', 'NGN', '2023-09-29 17:48:26');

-- --------------------------------------------------------

--
-- Table structure for table `setup_categories_tab`
--

CREATE TABLE `setup_categories_tab` (
  `sn` int(11) NOT NULL,
  `cat_id` varchar(50) NOT NULL,
  `cat_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setup_categories_tab`
--

INSERT INTO `setup_categories_tab` (`sn`, `cat_id`, `cat_desc`) VALUES
(1, '001', 'WAEC'),
(2, '002', 'NECO'),
(3, '003', 'JAMB'),
(4, '004', 'UTME'),
(5, '005', 'IJMB'),
(6, '006', 'JUPEB'),
(7, '007', 'GENERAL');

-- --------------------------------------------------------

--
-- Table structure for table `setup_counter_tab`
--

CREATE TABLE `setup_counter_tab` (
  `sn` int(11) NOT NULL,
  `counter_id` varchar(100) NOT NULL,
  `counter_discription` varchar(225) NOT NULL,
  `counter_value` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setup_counter_tab`
--

INSERT INTO `setup_counter_tab` (`sn`, `counter_id`, `counter_discription`, `counter_value`) VALUES
(1, 'STF', 'STAFF ID COUNT', 2),
(2, 'USER', 'USER ID COUNT', 1),
(3, 'SUBJ', 'SUBJECT ID COUNT', 5),
(4, 'EXAM', 'EXAM ID COUNT', 4),
(5, 'TOPIC', 'TOPIC ID COUNT', 16),
(6, 'SUBTOPIC', 'SUBTOPIC ID COUNT', 11),
(7, 'VIDEO', 'VIDEO ID COUNT', 12),
(8, 'TRANS', 'TRANSACTION COUNT', 11),
(9, 'FAQ', 'FAQ ID COUNT', 2),
(10, 'BLOG', 'BLOG ID COUNT', 3),
(11, 'ALT', 'OPERATION ALERT', 0),
(12, 'US_ID', 'USER SUBSCRIPTION COUNT', 3);

-- --------------------------------------------------------

--
-- Table structure for table `setup_duration_tab`
--

CREATE TABLE `setup_duration_tab` (
  `sn` int(11) NOT NULL,
  `subscription_duration_id` int(50) NOT NULL,
  `subscription_duration_count` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setup_duration_tab`
--

INSERT INTO `setup_duration_tab` (`sn`, `subscription_duration_id`, `subscription_duration_count`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6),
(7, 7, 7),
(8, 8, 8),
(9, 9, 9),
(10, 10, 10),
(11, 11, 11),
(12, 12, 12),
(13, 13, 13),
(14, 14, 14),
(15, 15, 15),
(16, 16, 16),
(17, 17, 17),
(18, 18, 18),
(19, 19, 19),
(20, 20, 20),
(21, 21, 21),
(22, 22, 22),
(23, 23, 23),
(24, 24, 24),
(25, 25, 25),
(26, 26, 26),
(27, 27, 27),
(28, 28, 28),
(29, 29, 29),
(30, 30, 30);

-- --------------------------------------------------------

--
-- Table structure for table `setup_fund_method_tab`
--

CREATE TABLE `setup_fund_method_tab` (
  `sn` int(11) NOT NULL,
  `fund_method_id` varchar(50) NOT NULL,
  `fund_method_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setup_fund_method_tab`
--

INSERT INTO `setup_fund_method_tab` (`sn`, `fund_method_id`, `fund_method_name`) VALUES
(1, 'FM001', 'PAY WITH CARD'),
(2, 'FM002', 'PAY WITH WALLET'),
(3, 'FM003', 'BANK TRANSFER');

-- --------------------------------------------------------

--
-- Table structure for table `setup_role_tab`
--

CREATE TABLE `setup_role_tab` (
  `sn` int(11) NOT NULL,
  `role_id` varchar(50) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setup_role_tab`
--

INSERT INTO `setup_role_tab` (`sn`, `role_id`, `role_name`) VALUES
(1, '1', 'STAFF'),
(2, '2', 'ADMIN'),
(3, '3', 'SUPER ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `setup_status_tab`
--

CREATE TABLE `setup_status_tab` (
  `sn` int(10) UNSIGNED NOT NULL,
  `status_id` varchar(100) NOT NULL,
  `status_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setup_status_tab`
--

INSERT INTO `setup_status_tab` (`sn`, `status_id`, `status_name`) VALUES
(1, '1', 'ACTIVE'),
(2, '2', 'SUSPEND'),
(3, '3', 'PENDING'),
(4, '4', 'INACTIVE'),
(5, '5', 'SUCCESS'),
(6, '6', 'CANCELLED'),
(7, '7', 'FAILED');

-- --------------------------------------------------------

--
-- Table structure for table `setup_subscription_pricing_tab`
--

CREATE TABLE `setup_subscription_pricing_tab` (
  `sn` int(11) NOT NULL,
  `subscription_pricing_id` varchar(50) NOT NULL,
  `subscription_pricing_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setup_subscription_pricing_tab`
--

INSERT INTO `setup_subscription_pricing_tab` (`sn`, `subscription_pricing_id`, `subscription_pricing_name`) VALUES
(1, '1', 'FREE'),
(2, '2', 'PREMIUM');

-- --------------------------------------------------------

--
-- Table structure for table `setup_transaction_type_tab`
--

CREATE TABLE `setup_transaction_type_tab` (
  `sn` int(11) NOT NULL,
  `transaction_type_id` varchar(50) NOT NULL,
  `transaction_type_name` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setup_transaction_type_tab`
--

INSERT INTO `setup_transaction_type_tab` (`sn`, `transaction_type_id`, `transaction_type_name`, `date`) VALUES
(1, 'CR', 'CREDIT', '2022-06-02 22:34:27'),
(2, 'DB', 'DEBIT', '2022-06-02 22:34:51');

-- --------------------------------------------------------

--
-- Table structure for table `setup_video_volume_tab`
--

CREATE TABLE `setup_video_volume_tab` (
  `sn` int(11) NOT NULL,
  `video_volume_id` varchar(100) NOT NULL,
  `video_volume_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setup_video_volume_tab`
--

INSERT INTO `setup_video_volume_tab` (`sn`, `video_volume_id`, `video_volume_name`) VALUES
(1, '1', 'VOLUME 1'),
(2, '2', 'VOLUME 2'),
(3, '3', 'VOLUME 3'),
(4, '4', 'VOLUME 4'),
(5, '5', 'VOLUME 5'),
(6, '6', 'VOLUME 6'),
(7, '7', 'VOLUME 7'),
(8, '8', 'VOLUME 8'),
(9, '9', 'VOLUME 9'),
(10, '10', 'VOLUME 10');

-- --------------------------------------------------------

--
-- Table structure for table `staff_tab`
--

CREATE TABLE `staff_tab` (
  `sn` int(11) NOT NULL,
  `access_key` varchar(255) NOT NULL,
  `staff_id` varchar(100) NOT NULL,
  `fullname` varchar(225) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(225) NOT NULL,
  `status_id` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp` int(11) NOT NULL,
  `passport` varchar(255) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_time` datetime NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_tab`
--

INSERT INTO `staff_tab` (`sn`, `access_key`, `staff_id`, `fullname`, `mobile`, `email`, `address`, `status_id`, `role_id`, `password`, `otp`, `passport`, `last_login`, `created_time`, `updated_time`) VALUES
(1, '0a8b7c3d24cc6514c45a6db32ad47ee1', 'STF0000', 'PROF PHYLUM', '08060881900', 'afootechglobal@gmail.com', '12, KOTCO ROAD, ODE REMO, OGUN STATE', '1', 3, '3ca02c56bf3c1569f23773296459d4b6', 859776, '202310101240_STF0000_6524817bc29dd.jpg', '2023-11-04 04:32:36', '0000-00-00 00:00:00', '2023-11-04 04:32:36'),
(3, '233e1c709b7cd6357b5d61585a30c915', 'STF00220231013045426', 'PAUL EMMANUEL', '07050903886', 'seunemmanuel107@gmail.com', '12, KOTCO ROAD', '1', 2, '3ca02c56bf3c1569f23773296459d4b6', 858985, '202310260729_STF00220231013045426_653aa1ea45362.jpg', '2023-11-02 13:11:43', '2023-10-13 15:54:26', '2023-11-02 13:11:43');

-- --------------------------------------------------------

--
-- Table structure for table `subject_tab`
--

CREATE TABLE `subject_tab` (
  `sn` int(11) NOT NULL,
  `subject_id` varchar(100) NOT NULL,
  `subject_name` varchar(225) NOT NULL,
  `subject_url` varchar(255) NOT NULL,
  `seo_keywords` text NOT NULL,
  `seo_description` text NOT NULL,
  `status_id` varchar(10) NOT NULL,
  `subject_passport` varchar(50) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_tab`
--

INSERT INTO `subject_tab` (`sn`, `subject_id`, `subject_name`, `subject_url`, `seo_keywords`, `seo_description`, `status_id`, `subject_passport`, `created_time`, `updated_time`) VALUES
(1, 'SUBJ00120231104072333', 'mathematics', 'mathematics', 'Mathematics', 'the abstract science of number, quantity, and space, either as abstract concepts ( pure mathematics ), or as applied to other disciplines such as physics', '1', 'SUBJ00120231104072333_6545e36574bdb.png', '2023-11-04 07:23:33', '2023-11-04 11:50:22'),
(2, 'SUBJ00220231104072532', 'use of english', 'use-of-english', 'Use Of English', 'English studies (or simply, English) is an academic discipline taught in primary, secondary, and post-secondary education in English-speaking countries.', '1', 'SUBJ00220231104072532_6545e4073a4c6.jpg', '2023-11-04 07:25:32', '2023-11-04 06:26:15'),
(3, 'SUBJ00320231104072838', 'physics', 'physics', 'physics', 'physics can, at base, be defined as the science of matter, motion, and energy. Its laws are typically expressed with economy and precision', '1', 'SUBJ00320231104072838_6545e496b9761.jpg', '2023-11-04 07:28:38', '2023-11-04 06:28:38'),
(4, 'SUBJ00420231104091109', 'chemistry', 'chemistry', 'Chemistry', 'Chemistry is the study of matter, analysing its structure, properties and behaviour to see what happens when they change in chemical reactions.', '1', 'SUBJ00420231104091109_6545fc9dd869d.webp', '2023-11-04 09:11:09', '2023-11-04 08:11:09'),
(5, 'SUBJ00520231104091338', 'biology', 'biology', 'Biology', 'Biology, study of living things and their vital processes that deals with all the physicochemical aspects of life.', '1', 'SUBJ00520231104091338_6545fd32d447e.webp', '2023-11-04 09:13:38', '2023-11-04 08:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `sub_topic_tab`
--

CREATE TABLE `sub_topic_tab` (
  `sn` int(11) NOT NULL,
  `subject_id` varchar(100) NOT NULL,
  `topic_id` varchar(100) NOT NULL,
  `sub_topic_id` varchar(100) NOT NULL,
  `sub_topic_name` varchar(100) NOT NULL,
  `sub_topic_url` varchar(255) NOT NULL,
  `subscription_price` double(10,2) NOT NULL,
  `seo_keywords` text NOT NULL,
  `seo_description` text NOT NULL,
  `subscription_duration_id` varchar(100) NOT NULL,
  `sub_topic_passport` varchar(100) NOT NULL,
  `status_id` varchar(50) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_topic_tab`
--

INSERT INTO `sub_topic_tab` (`sn`, `subject_id`, `topic_id`, `sub_topic_id`, `sub_topic_name`, `sub_topic_url`, `subscription_price`, `seo_keywords`, `seo_description`, `subscription_duration_id`, `sub_topic_passport`, `status_id`, `created_time`, `updated_time`) VALUES
(1, 'SUBJ00120231104072333', 'TOPIC00120231104093643', 'SUBTOPIC00120231104104304', 'NUMBER BASIS', 'number-basis', 200.00, 'number basis', 'A number base (or base for short) of a numeral system tells us about the unique or different symbols and notations it uses to represent a value.', '14', 'SUBTOPIC00120231104104304_654612281ecd7.webp', '1', '2023-11-04 10:43:04', '2023-11-04 09:43:04'),
(2, 'SUBJ00120231104072333', 'TOPIC00120231104093643', 'SUBTOPIC00220231104104539', 'SETS', 'sets', 300.00, 'sets', 'Sets in mathematics, are simply a collection of distinct objects forming a group.', '10', 'SUBTOPIC00220231104104539_654612c353247.png', '1', '2023-11-04 10:45:39', '2023-11-04 09:45:39'),
(3, 'SUBJ00120231104072333', 'TOPIC00220231104093716', 'SUBTOPIC00320231104105016', 'VARIATION', 'variation', 300.00, 'Variation', 'A variation is a relation between a set of values of one variable and a set of values of other variables. In the equation y = mx + b, if m is a nonzero constant', '13', 'SUBTOPIC00320231104105016_654613d88176a.png', '1', '2023-11-04 10:50:16', '2023-11-04 09:50:16'),
(4, 'SUBJ00120231104072333', 'TOPIC00220231104093716', 'SUBTOPIC00420231104105229', 'PROGRESSION', 'progression', 250.00, 'Progression', 'An arithmetic sequence or progression is defined as a sequence of numbers in which for every pair of consecutive terms, the second number is obtained by adding ', '19', 'SUBTOPIC00420231104105229_6546145d1bbfe.png', '1', '2023-11-04 10:52:29', '2023-11-04 09:52:29'),
(5, 'SUBJ00120231104072333', 'TOPIC00620231104094558', 'SUBTOPIC00520231104105432', 'INEQUALITIES', 'inequalities', 150.00, 'Inequalities', 'In Mathematics, the relationship between two values that are not equal is defined by inequalities. Inequality means not equal. Generally, if two values are not ', '29', 'SUBTOPIC00520231104105432_654614d8b05a8.png', '1', '2023-11-04 10:54:32', '2023-11-04 09:54:32'),
(6, 'SUBJ00320231104072838', 'TOPIC01320231104095652', 'SUBTOPIC00620231104105901', 'MOTION', 'motion', 150.00, 'Motion', 'motion is when an object changes its position with respect to time. Motion is mathematically described in terms of displacement, distance, velocity.', '10', 'SUBTOPIC00620231104105901_654615e575fdf.jpg', '1', '2023-11-04 10:59:01', '2023-11-04 09:59:01'),
(7, 'SUBJ00220231104072532', 'TOPIC00920231104094825', 'SUBTOPIC00720231104110622', 'PUNCTUATION AND SPELLING', 'punctuation-spelling', 200.00, 'Punctuation and Spelling', 'Correctly spelling new vocabulary that is introduced to your students. Punctuation - Identifying and writing sentences that are punctuated correctly. ', '12', 'SUBTOPIC00720231104110622_6546179eaafd5.png', '1', '2023-11-04 11:06:22', '2023-11-04 10:06:22'),
(8, 'SUBJ00220231104072532', 'TOPIC01220231104095551', 'SUBTOPIC00920231104111309', 'WRITERS ARGUMENTS', 'writers-arguments', 100.00, 'writers arguments', 'Writing subtopics in an essay allows for a more detailed analysis to better understand the main topic by breaking it down into smaller.', '8', 'SUBTOPIC00920231104111309_654619474d600.jpeg', '1', '2023-11-04 11:13:09', '2023-11-04 10:13:27'),
(9, 'SUBJ00220231104072532', 'TOPIC01020231104094841', 'SUBTOPIC01020231104111526', 'VOWELS', 'vowels', 150.00, 'Vowels', 'In English, the vowels are a, e, i, o, and u, although y can sometimes count as a vowel, too. Vowels are contrasted with consonants.', '16', 'SUBTOPIC01020231104111526_654619beefeab.webp', '1', '2023-11-04 11:15:26', '2023-11-04 10:15:26'),
(10, 'SUBJ00220231104072532', 'TOPIC01120231104095516', 'SUBTOPIC01120231104111949', 'WRITING TECHNIQUES', 'writing-techniques', 400.00, 'writing techniques', 'You can use several writing techniques to make your writing more engaging and keep your audience reading until the end of your piece.', '30', 'SUBTOPIC01120231104111949_65461ac510258.jpg', '1', '2023-11-04 11:19:49', '2023-11-04 10:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `sub_topic_video_tab`
--

CREATE TABLE `sub_topic_video_tab` (
  `sn` int(11) NOT NULL,
  `topic_id` varchar(100) NOT NULL,
  `sub_topic_id` varchar(100) NOT NULL,
  `video_id` varchar(100) NOT NULL,
  `video_title` varchar(255) NOT NULL,
  `video_objective` longtext NOT NULL,
  `video_duration` varchar(100) NOT NULL,
  `video` varchar(100) NOT NULL,
  `video_passport` varchar(100) NOT NULL,
  `video_volume_id` varchar(100) NOT NULL,
  `subscription_pricing_id` varchar(100) NOT NULL,
  `status_id` varchar(50) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_topic_video_tab`
--

INSERT INTO `sub_topic_video_tab` (`sn`, `topic_id`, `sub_topic_id`, `video_id`, `video_title`, `video_objective`, `video_duration`, `video`, `video_passport`, `video_volume_id`, `subscription_pricing_id`, `status_id`, `created_time`, `updated_time`) VALUES
(1, 'TOPIC00120231104093643', 'SUBTOPIC00120231104104304', 'VIDEO00120231104113056', 'INTRO TO NUMBER BASES', '<p>at the end of the lesson, student will be introduced to number bases:<br /><br />1) Definition of number bases<br />2) types of number bases<br />3) concept of number bases</p>', '00:07:34', 'VIDEO00120231104113056_65461d60415d3.mp4', 'VIDEO00120231104113056_65461d60415c4.png', '2', '1', '1', '2023-11-04 11:30:56', '2023-11-04 10:41:16'),
(2, 'TOPIC00120231104093643', 'SUBTOPIC00120231104104304', 'VIDEO00220231104114016', 'NUMBER BASES PROPER', '<p>at the end of the lesson, student will be introduced to number bases:<br /><br />1) Definition of number bases<br />2) types of number bases<br />3) concept of number bases</p>', '00:05:27', 'VIDEO00220231104114016_65461f900b6fe.mp4', 'VIDEO00220231104114016_65461f900b6f2.png', '1', '2', '1', '2023-11-04 11:40:16', '2023-11-04 10:40:16'),
(3, 'TOPIC00220231104093716', 'SUBTOPIC00420231104105229', 'VIDEO00320231104115723', 'INTRO TO PROGRESSION', '<p>at the end of the lesson, student will be introduced to Progression:<br /><br />1) Definition of Progression<br />2) types of Progression<br />3) concept of Progression</p>', '00:03:34', 'VIDEO00320231104115723_6546239303417.mp4', 'VIDEO00320231104115723_654623930337f.png', '1', '1', '1', '2023-11-04 11:57:23', '2023-11-04 10:57:23'),
(4, 'TOPIC00220231104093716', 'SUBTOPIC00420231104105229', 'VIDEO00420231104120320', 'PROGRESSION PROPER', '<p>at the end of the lesson, student will be introduced to Progression proper:<br /><br />1) Definition of Progression proper<br />2) types of Progression proper<br />3) concept of Progression proper</p>', '00:04:20', 'VIDEO00420231104120320_654624f8855b6.mp4', 'VIDEO00420231104120320_654624f88559d.png', '2', '2', '1', '2023-11-04 12:03:20', '2023-11-04 11:03:20'),
(5, 'TOPIC00220231104093716', 'SUBTOPIC00320231104105016', 'VIDEO00520231104120726', 'INTRO TO VARIATION', '<p>at the end of the lesson, student will be introduced to Variation:<br /><br />1) Definition of Variation<br />2) types of Variation<br />3) concept of Variation</p>', '00:03:34', 'VIDEO00520231104120726_654625ee28cdf.mp4', 'VIDEO00520231104120726_654625ee28cd2.png', '1', '1', '1', '2023-11-04 12:07:26', '2023-11-04 11:07:26'),
(6, 'TOPIC00220231104093716', 'SUBTOPIC00320231104105016', 'VIDEO00620231104120906', 'VARIATION PROPER', '<p>at the end of the lesson, student will be introduced to Variation Proper:<br /><br />1) Definition of Variation Proper<br />2) types of Variation Proper<br />3) concept of Variation Proper</p>', '00:04:20', 'VIDEO00620231104120906_6546265292c1a.mp4', 'VIDEO00620231104120906_6546265292c0e.png', '2', '2', '1', '2023-11-04 12:09:06', '2023-11-04 11:09:06'),
(7, 'TOPIC00920231104094825', 'SUBTOPIC00720231104110622', 'VIDEO00720231104121233', 'INTRO TO PUNCTUATION AND SPELLING', '<p>at the end of the lesson, student will be introduced to Punctuation and spelling:<br /><br />1) Definition of Punctuation and spelling<br />2) types of Punctuation and spelling<br />3) concept of Punctuation and spelling</p>', '00:04:14', 'VIDEO00720231104121233_6546272159ee3.mp4', 'VIDEO00720231104121233_6546272159ec2.png', '1', '1', '1', '2023-11-04 12:12:33', '2023-11-04 11:12:33'),
(8, 'TOPIC00620231104094558', 'SUBTOPIC00520231104105432', 'VIDEO00820231104121531', 'INTRO TO INEQUALITIES', '<p>at the end of the lesson, student will be introduced to inequalities:<br /><br />1) Definition of inequalities<br />2) types of inequalities<br />3) concept of inequalities</p>', '00:04:20', 'VIDEO00820231104121531_654627d317131.mp4', 'VIDEO00820231104121531_654627d317125.png', '1', '1', '1', '2023-11-04 12:15:31', '2023-11-04 11:15:31'),
(9, 'TOPIC01320231104095652', 'SUBTOPIC00620231104105901', 'VIDEO00920231104121813', 'INTRO TO MOTION', '<p>at the end of the lesson, student will be introduced to motion:<br /><br />1) Definition of motion<br />2) types of motion<br />3) concept of motion</p>', '00:04:14', 'VIDEO00920231104121813_654628759df33.mp4', 'VIDEO00920231104121813_654628759df1a.png', '1', '1', '1', '2023-11-04 12:18:13', '2023-11-04 11:23:09'),
(10, 'TOPIC00620231104094558', 'SUBTOPIC00520231104105432', 'VIDEO01020231104122649', 'INEQUALITIES PROPER', '<p>at the end of the lesson, student will be introduced to Inequalities Proper:<br /><br />1) Definition of Inequalities Proper<br />2) types of Inequalities Proper<br />3) concept of Inequalities Proper</p>', '00:04:20', 'VIDEO01020231104122649_65462a7990a15.mp4', 'VIDEO01020231104122649_65462a7990a09.png', '2', '2', '1', '2023-11-04 12:26:49', '2023-11-04 11:26:49'),
(11, 'TOPIC01320231104095652', 'SUBTOPIC00620231104105901', 'VIDEO01120231104122853', 'MOTION PROPER', '<p>at the end of the lesson, student will be introduced to motion proper:<br /><br />1) Definition of motion proper<br />2) types of motion proper<br />3) concept of motion proper</p>', '00:04:14', 'VIDEO01120231104122853_65462af5528a2.mp4', 'VIDEO01120231104122853_65462af55289a.png', '2', '2', '1', '2023-11-04 12:28:53', '2023-11-04 11:28:53'),
(12, 'TOPIC00920231104094825', 'SUBTOPIC00720231104110622', 'VIDEO01220231104123107', 'PUNCTUATION AND SPELLING PROPER', '<p>at the end of the lesson, student will be introduced to Punctuation and spelling proper:<br /><br />1) Definition of Punctuation and spelling proper<br />2) types of Punctuation and spelling proper<br />3) concept of Punctuation and spelling proper</p>', '00:04:14', 'VIDEO01220231104123107_65462b7b2654d.mp4', 'VIDEO01220231104123107_65462b7b2653e.png', '2', '2', '1', '2023-11-04 12:31:07', '2023-11-04 11:31:07');

-- --------------------------------------------------------

--
-- Table structure for table `topic_tab`
--

CREATE TABLE `topic_tab` (
  `sn` int(11) NOT NULL,
  `exam_id` varchar(100) NOT NULL,
  `subject_id` varchar(100) NOT NULL,
  `topic_id` varchar(100) NOT NULL,
  `topic_name` varchar(225) NOT NULL,
  `status_id` varchar(50) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topic_tab`
--

INSERT INTO `topic_tab` (`sn`, `exam_id`, `subject_id`, `topic_id`, `topic_name`, `status_id`, `created_time`, `updated_time`) VALUES
(1, 'EXAM00120231104091818', 'SUBJ00120231104072333', 'TOPIC00120231104093643', 'NUMBER AND NUMERATION', '1', '2023-11-04 09:36:43', '2023-11-04 08:36:43'),
(2, 'EXAM00120231104091818', 'SUBJ00120231104072333', 'TOPIC00220231104093716', 'BINARY OPERATIONS', '1', '2023-11-04 09:37:16', '2023-11-04 08:37:16'),
(3, 'EXAM00120231104091818', 'SUBJ00120231104072333', 'TOPIC00320231104093727', 'STATISTICS', '1', '2023-11-04 09:37:27', '2023-11-04 08:37:27'),
(4, 'EXAM00120231104091818', 'SUBJ00120231104072333', 'TOPIC00420231104093751', 'GEOMETRY AND TRIGONOMETRY', '1', '2023-11-04 09:37:51', '2023-11-04 08:37:51'),
(5, 'EXAM00320231104092607', 'SUBJ00120231104072333', 'TOPIC00520231104094433', 'NUMBER & NUMERATION', '1', '2023-11-04 09:44:33', '2023-11-04 08:44:33'),
(6, 'EXAM00320231104092607', 'SUBJ00120231104072333', 'TOPIC00620231104094558', 'ALGEBRA', '1', '2023-11-04 09:45:58', '2023-11-04 08:45:58'),
(7, 'EXAM00320231104092607', 'SUBJ00120231104072333', 'TOPIC00720231104094628', 'STATISTICS', '1', '2023-11-04 09:46:28', '2023-11-04 08:46:28'),
(8, 'EXAM00320231104092607', 'SUBJ00120231104072333', 'TOPIC00820231104094659', 'GEOMETRIC AND TRIGONOMETRIC', '1', '2023-11-04 09:46:59', '2023-11-04 08:46:59'),
(9, 'EXAM00120231104091818', 'SUBJ00220231104072532', 'TOPIC00920231104094825', 'COMPREHENSION & SUMMARY', '1', '2023-11-04 09:48:25', '2023-11-04 08:48:25'),
(10, 'EXAM00120231104091818', 'SUBJ00220231104072532', 'TOPIC01020231104094841', 'ORAL FORM', '1', '2023-11-04 09:48:41', '2023-11-04 08:48:41'),
(11, 'EXAM00120231104091818', 'SUBJ00220231104072532', 'TOPIC01120231104095516', 'SUMMARY WRITING', '1', '2023-11-04 09:55:16', '2023-11-04 08:55:16'),
(12, 'EXAM00120231104091818', 'SUBJ00220231104072532', 'TOPIC01220231104095551', 'ESSAY WRITING', '1', '2023-11-04 09:55:51', '2023-11-04 08:55:51'),
(13, 'EXAM00320231104092607', 'SUBJ00320231104072838', 'TOPIC01320231104095652', 'MECHANICS', '1', '2023-11-04 09:56:52', '2023-11-04 08:56:52'),
(14, 'EXAM00320231104092607', 'SUBJ00320231104072838', 'TOPIC01420231104095720', 'WAVES, LIGHT AND OPTICS', '1', '2023-11-04 09:57:20', '2023-11-04 08:57:20'),
(15, 'EXAM00320231104092607', 'SUBJ00320231104072838', 'TOPIC01520231104095752', 'ELECTROSTATICS, ELECTRICITY, MAGNETISM AND ELECTRONICS', '1', '2023-11-04 09:57:52', '2023-11-04 08:57:52'),
(16, 'EXAM00320231104092607', 'SUBJ00320231104072838', 'TOPIC01620231104095830', 'THERMODYNAMICS', '1', '2023-11-04 09:58:30', '2023-11-04 08:58:30');

-- --------------------------------------------------------

--
-- Table structure for table `user_exam_tab`
--

CREATE TABLE `user_exam_tab` (
  `sn` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `exam_id` varchar(100) NOT NULL,
  `created_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_exam_tab`
--

INSERT INTO `user_exam_tab` (`sn`, `user_id`, `exam_id`, `created_time`) VALUES
(3, 'USER00120231104124303', 'EXAM00320231104092607', '2023-11-04 12:46:14'),
(4, 'USER00120231104124303', 'EXAM00120231104091818', '2023-11-04 12:46:14'),
(5, 'USER00120231104124303', 'EXAM00220231104092419', '2023-11-04 12:46:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_subscription_tab`
--

CREATE TABLE `user_subscription_tab` (
  `sn` int(11) NOT NULL,
  `us_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `topic_id` varchar(100) NOT NULL,
  `sub_topic_id` varchar(100) NOT NULL,
  `subscription_duration_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `due_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_subscription_tab`
--

INSERT INTO `user_subscription_tab` (`sn`, `us_id`, `user_id`, `topic_id`, `sub_topic_id`, `subscription_duration_id`, `start_date`, `due_date`, `status_id`, `date`) VALUES
(1, 'US_ID00120231104010540', 'USER00120231104124303', 'TOPIC00120231104093643', 'SUBTOPIC00120231104104304', 14, '2023-11-04 13:05:40', '2023-11-18 01:05:40', 1, '2023-11-04 13:05:40'),
(2, 'US_ID00220231104011401', 'USER00120231104124303', 'TOPIC01320231104095652', 'SUBTOPIC00620231104105901', 10, '2023-11-04 13:14:01', '2023-11-14 01:14:01', 1, '2023-11-04 13:14:01'),
(3, 'US_ID00320231105015638', 'USER00120231104124303', 'TOPIC00220231104093716', 'SUBTOPIC00320231104105016', 13, '2023-11-05 01:56:38', '2023-11-18 01:56:38', 1, '2023-11-05 01:56:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_tab`
--

CREATE TABLE `user_tab` (
  `sn` int(11) NOT NULL,
  `wallet_balance` double(10,2) NOT NULL,
  `access_key` varchar(50) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `fullname` varchar(225) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(225) NOT NULL,
  `status_id` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `reg_otp` bigint(11) NOT NULL,
  `otp` int(10) NOT NULL,
  `passport` varchar(100) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_time` datetime NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tab`
--

INSERT INTO `user_tab` (`sn`, `wallet_balance`, `access_key`, `user_id`, `fullname`, `mobile`, `email`, `address`, `status_id`, `password`, `reg_otp`, `otp`, `passport`, `last_login`, `created_time`, `updated_time`) VALUES
(1, 0.00, '9548198ad06b58ef0253ff897481837e', 'USER00120231104124303', 'MIKE AFOLABI', '08131252996', 'sunaf4real@gmail.com', '', '1', 'a59b83948c81e3a081538ec677ed354f', 934536, 0, '', '2023-11-05 00:56:38', '2023-11-04 12:43:03', '2023-11-05 00:56:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_verification_tab`
--

CREATE TABLE `user_verification_tab` (
  `sn` int(11) NOT NULL,
  `email` varchar(225) NOT NULL,
  `otp` varchar(50) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_verification_tab`
--

INSERT INTO `user_verification_tab` (`sn`, `email`, `otp`, `created_time`, `updated_time`) VALUES
(1, 'sunaf4real@gmail.com', '934536', '2023-11-04 12:41:20', '2023-11-04 12:42:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_wallet_tab`
--

CREATE TABLE `user_wallet_tab` (
  `sn` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `payment_id` varchar(50) NOT NULL,
  `payment_gateway_id` varchar(50) NOT NULL,
  `balance_before` double(10,2) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `balance_after` double(10,2) NOT NULL,
  `transaction_type_id` varchar(50) NOT NULL,
  `status_id` varchar(20) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_wallet_tab`
--

INSERT INTO `user_wallet_tab` (`sn`, `user_id`, `payment_id`, `payment_gateway_id`, `balance_before`, `amount`, `balance_after`, `transaction_type_id`, `status_id`, `date`) VALUES
(1, 'USER00120231104124303', 'TRANS00120231104125927', '', 0.00, 300.00, 0.00, 'DB', '3', '2023-11-04 12:59:27'),
(2, 'USER00120231104124303', 'TRANS00220231104125939', '', 0.00, 300.00, 0.00, 'DB', '3', '2023-11-04 12:59:39'),
(3, 'USER00120231104124303', 'TRANS00320231104125959', 'TRANS00320231104125959', 0.00, 500.00, 500.00, 'CR', '5', '2023-11-04 12:59:59'),
(4, 'USER00120231104124303', 'TRANS00420231104010540', 'TRANS00420231104010540', 500.00, 200.00, 300.00, 'DB', '5', '2023-11-04 13:05:40'),
(5, 'USER00120231104124303', 'TRANS00620231105014844', '', 0.00, 5000.00, 0.00, 'CR', '3', '2023-11-05 01:48:44'),
(6, 'USER00120231104124303', 'TRANS00720231105014956', '', 0.00, 3000.00, 0.00, 'CR', '3', '2023-11-05 01:49:56'),
(7, 'USER00120231104124303', 'TRANS00820231105015317', '', 0.00, 2000.00, 0.00, 'CR', '3', '2023-11-05 01:53:17'),
(8, 'USER00120231104124303', 'TRANS00920231105015529', '', 300.00, 3000.00, 300.00, 'CR', '6', '2023-11-05 01:55:29'),
(9, 'USER00120231104124303', 'TRANS01020231105015638', 'TRANS01020231105015638', 300.00, 300.00, 0.00, 'DB', '5', '2023-11-05 01:56:38'),
(10, 'USER00120231104124303', 'TRANS01120231105015657', '', 0.00, 250.00, 0.00, 'DB', '3', '2023-11-05 01:56:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alert_tab`
--
ALTER TABLE `alert_tab`
  ADD PRIMARY KEY (`sn`),
  ADD KEY `seen_status` (`seen_status`),
  ADD KEY `user_id` (`staff_id`);

--
-- Indexes for table `blog_tab`
--
ALTER TABLE `blog_tab`
  ADD PRIMARY KEY (`sn`),
  ADD KEY `user_id` (`staff_id`);

--
-- Indexes for table `blog_view_tab`
--
ALTER TABLE `blog_view_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `exam_subject_tab`
--
ALTER TABLE `exam_subject_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `exam_tab`
--
ALTER TABLE `exam_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `faq_tab`
--
ALTER TABLE `faq_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `payment_tab`
--
ALTER TABLE `payment_tab`
  ADD PRIMARY KEY (`sn`),
  ADD UNIQUE KEY `payment_id` (`payment_id`);

--
-- Indexes for table `setup_backend_settings_tab`
--
ALTER TABLE `setup_backend_settings_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `setup_categories_tab`
--
ALTER TABLE `setup_categories_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `setup_counter_tab`
--
ALTER TABLE `setup_counter_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `setup_duration_tab`
--
ALTER TABLE `setup_duration_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `setup_fund_method_tab`
--
ALTER TABLE `setup_fund_method_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `setup_role_tab`
--
ALTER TABLE `setup_role_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `setup_status_tab`
--
ALTER TABLE `setup_status_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `setup_subscription_pricing_tab`
--
ALTER TABLE `setup_subscription_pricing_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `setup_transaction_type_tab`
--
ALTER TABLE `setup_transaction_type_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `setup_video_volume_tab`
--
ALTER TABLE `setup_video_volume_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `staff_tab`
--
ALTER TABLE `staff_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `subject_tab`
--
ALTER TABLE `subject_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `sub_topic_tab`
--
ALTER TABLE `sub_topic_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `sub_topic_video_tab`
--
ALTER TABLE `sub_topic_video_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `topic_tab`
--
ALTER TABLE `topic_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `user_exam_tab`
--
ALTER TABLE `user_exam_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `user_subscription_tab`
--
ALTER TABLE `user_subscription_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `user_tab`
--
ALTER TABLE `user_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `user_verification_tab`
--
ALTER TABLE `user_verification_tab`
  ADD PRIMARY KEY (`sn`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_wallet_tab`
--
ALTER TABLE `user_wallet_tab`
  ADD PRIMARY KEY (`sn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alert_tab`
--
ALTER TABLE `alert_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_tab`
--
ALTER TABLE `blog_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog_view_tab`
--
ALTER TABLE `blog_view_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_subject_tab`
--
ALTER TABLE `exam_subject_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `exam_tab`
--
ALTER TABLE `exam_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faq_tab`
--
ALTER TABLE `faq_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_tab`
--
ALTER TABLE `payment_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `setup_backend_settings_tab`
--
ALTER TABLE `setup_backend_settings_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setup_categories_tab`
--
ALTER TABLE `setup_categories_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `setup_counter_tab`
--
ALTER TABLE `setup_counter_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `setup_duration_tab`
--
ALTER TABLE `setup_duration_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `setup_fund_method_tab`
--
ALTER TABLE `setup_fund_method_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `setup_role_tab`
--
ALTER TABLE `setup_role_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `setup_status_tab`
--
ALTER TABLE `setup_status_tab`
  MODIFY `sn` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `setup_subscription_pricing_tab`
--
ALTER TABLE `setup_subscription_pricing_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `setup_transaction_type_tab`
--
ALTER TABLE `setup_transaction_type_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `setup_video_volume_tab`
--
ALTER TABLE `setup_video_volume_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `staff_tab`
--
ALTER TABLE `staff_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject_tab`
--
ALTER TABLE `subject_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_topic_tab`
--
ALTER TABLE `sub_topic_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sub_topic_video_tab`
--
ALTER TABLE `sub_topic_video_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `topic_tab`
--
ALTER TABLE `topic_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_exam_tab`
--
ALTER TABLE `user_exam_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_subscription_tab`
--
ALTER TABLE `user_subscription_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_tab`
--
ALTER TABLE `user_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_verification_tab`
--
ALTER TABLE `user_verification_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_wallet_tab`
--
ALTER TABLE `user_wallet_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
