-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2020 at 04:20 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medicare`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aId` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pwd` text NOT NULL,
  `profileImg` varchar(30) NOT NULL,
  `datetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aId`, `username`, `email`, `pwd`, `profileImg`, `datetime`, `status`, `updatedAt`) VALUES
(1, 'Mehul', 'm@g.com', 'MUZROVJQSHVldExQWU5Mdy9XdHNTZz09', '8482_user-400-9.jpg', '2020-01-17 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'Mann', 'mn@g.com', 'MUZROVJQSHVldExQWU5Mdy9XdHNTZz09', '', '2020-03-31 21:22:32', 0, '0000-00-00 00:00:00'),
(5, 'Harsh', 'h@g.com', 'MUZROVJQSHVldExQWU5Mdy9XdHNTZz09', '2142_patient.jpg', '2020-03-31 21:57:50', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bank_transaction`
--

CREATE TABLE `bank_transaction` (
  `btId` int(11) NOT NULL,
  `amount` float NOT NULL,
  `datetime` datetime NOT NULL,
  `tranType` int(1) NOT NULL COMMENT '0=deposite,1=withdraw',
  `walletId` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_transaction`
--

INSERT INTO `bank_transaction` (`btId`, `amount`, `datetime`, `tranType`, `walletId`, `status`) VALUES
(1, 500, '2020-04-12 18:45:34', 0, 10, 0),
(2, 5200, '2020-04-12 18:54:37', 0, 10, 0),
(3, 300, '2020-04-12 19:03:03', 0, 11, 0),
(4, 1000, '2020-04-13 10:12:01', 0, 10, 0),
(5, 1000, '2020-04-13 10:12:14', 0, 10, 0),
(6, 1000, '2020-04-13 10:15:18', 0, 10, 0),
(7, 1000, '2020-04-13 10:15:35', 0, 10, 0),
(8, 1000, '2020-04-13 10:15:48', 1, 10, 0),
(9, 300, '2020-04-13 10:56:00', 0, 11, 0),
(10, 500, '2020-04-14 18:31:28', 0, 11, 0),
(11, 300, '2020-04-14 18:39:54', 0, 11, 0),
(12, 86, '2020-04-20 19:01:35', 0, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `pwmId` int(11) NOT NULL,
  `pId` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `qty`, `pwmId`, `pId`, `datetime`) VALUES
(4, 1, 11, 2, '0000-00-00 00:00:00'),
(5, 1, 14, 2, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chatId` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `docId` int(11) NOT NULL,
  `pId` int(11) NOT NULL,
  `icappId` int(11) NOT NULL,
  `sender` int(1) NOT NULL,
  `deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chatId`, `timestamp`, `status`, `docId`, `pId`, `icappId`, `sender`, `deleted`) VALUES
(1, '2020-04-12 19:04:26', 1, 3, 2, 1, 0, 0),
(2, '2020-04-12 19:05:43', 1, 3, 2, 1, 0, 0),
(3, '2020-04-12 19:06:07', 1, 3, 2, 1, 1, 0),
(4, '2020-04-12 19:06:46', 1, 3, 2, 1, 0, 0),
(5, '2020-04-12 19:06:53', 1, 3, 2, 1, 1, 0),
(6, '2020-04-12 19:07:37', 1, 3, 2, 1, 0, 0),
(7, '2020-04-12 19:07:47', 1, 3, 2, 1, 1, 0),
(8, '2020-04-12 19:08:34', 1, 3, 2, 1, 0, 0),
(9, '2020-04-12 19:08:44', 1, 3, 2, 1, 1, 0),
(10, '2020-04-12 19:09:02', 1, 3, 2, 1, 0, 0),
(11, '2020-04-12 19:09:12', 1, 3, 2, 1, 1, 0),
(12, '2020-04-12 19:09:22', 1, 3, 2, 1, 1, 0),
(13, '2020-04-12 19:09:59', 1, 3, 2, 1, 0, 0),
(14, '2020-04-13 11:07:45', 1, 4, 2, 2, 0, 0),
(15, '2020-04-13 11:07:55', 1, 4, 2, 2, 1, 0),
(16, '2020-04-13 11:08:06', 1, 4, 2, 2, 0, 0),
(17, '2020-04-14 18:44:27', 1, 3, 2, 3, 1, 0),
(18, '2020-04-14 18:44:29', 1, 3, 2, 3, 0, 0),
(19, '2020-04-14 18:44:44', 1, 3, 2, 3, 0, 0),
(20, '2020-04-14 18:45:22', 1, 3, 2, 3, 1, 0),
(21, '2020-04-14 18:46:23', 1, 3, 2, 3, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `chat_attachment`
--

CREATE TABLE `chat_attachment` (
  `attId` int(11) NOT NULL,
  `src` text NOT NULL,
  `chatId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chat_msg`
--

CREATE TABLE `chat_msg` (
  `cmId` int(11) NOT NULL,
  `msg` text NOT NULL,
  `chatId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_msg`
--

INSERT INTO `chat_msg` (`cmId`, `msg`, `chatId`) VALUES
(1, 'Hiii', 1),
(2, 'I will glad to help you out! please tell me what happned to you?', 2),
(3, 'I feel Very Cold.', 3),
(4, 'Ohkay .. dont worry .. its common just do as isuggest', 4),
(5, 'Ohkay...', 5),
(6, 'first you need to do rest.. i suggesting you to do not approach work for two days', 6),
(7, 'Ok', 7),
(8, 'now i am gonna give you some medicine name you need to buy it.', 8),
(9, 'sure', 9),
(10, 'Crocin and Dolo 650 Mg', 10),
(11, 'ohkay ', 11),
(12, 'Thanks Doctor.... ', 12),
(13, 'It\'s been pleasure to help you.. hope you\'ll feel better .. bye', 13),
(14, 'Hello', 14),
(15, 'Hello', 15),
(16, 'How May I help you??', 16),
(17, 'Hello Doctor', 17),
(18, 'Hello.. Shivam', 18),
(19, 'Tell me your problem', 19),
(20, 'I have been affected from cold.. ', 20),
(21, 'That is common problem.. Take Crocine twice a day and have a rest.', 21);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `cityId` int(11) NOT NULL,
  `cityName` varchar(30) NOT NULL,
  `stateId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cityId`, `cityName`, `stateId`) VALUES
(1, 'Surat', 1),
(2, 'Ahemdabad', 1),
(3, 'Mumbai', 2),
(4, 'Nasik', 2),
(5, 'Jaipur', 3);

-- --------------------------------------------------------

--
-- Table structure for table `commission_rate`
--

CREATE TABLE `commission_rate` (
  `crId` int(11) NOT NULL,
  `rate` float NOT NULL,
  `userType` int(1) NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commission_rate`
--

INSERT INTO `commission_rate` (`crId`, `rate`, `userType`, `updatedAt`) VALUES
(1, 10, 1, '2020-03-27 17:08:31'),
(2, 10, 2, '2020-03-27 17:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `commission_transaction`
--

CREATE TABLE `commission_transaction` (
  `ctId` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `crId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commission_transaction`
--

INSERT INTO `commission_transaction` (`ctId`, `amount`, `crId`, `userId`, `datetime`) VALUES
(1, 50, 1, 1, '2020-04-12 18:45:34'),
(2, 70, 2, 1, '2020-04-12 18:54:37'),
(3, 450, 2, 1, '2020-04-12 18:54:37'),
(4, 30, 1, 3, '2020-04-12 19:10:04'),
(5, 30, 1, 4, '2020-04-13 11:08:11'),
(6, 30, 1, 4, '2020-04-13 11:08:11'),
(7, 50, 1, 1, '2020-04-14 18:31:28'),
(8, 30, 1, 3, '2020-04-14 18:47:01'),
(9, 50, 1, 1, '2020-06-11 14:12:38');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_address`
--

CREATE TABLE `delivery_address` (
  `daId` int(11) NOT NULL,
  `daName` varchar(30) NOT NULL,
  `daPhone` varchar(10) NOT NULL,
  `daPincode` int(11) NOT NULL,
  `daAddress` text NOT NULL,
  `cityId` int(11) NOT NULL,
  `pId` int(11) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_address`
--

INSERT INTO `delivery_address` (`daId`, `daName`, `daPhone`, `daPincode`, `daAddress`, `cityId`, `pId`, `createdAt`) VALUES
(1, 'Harsh', '0989869770', 395002, 'Surat new', 1, 1, '2020-04-12 18:53:45'),
(2, 'Harsh', '0989869770', 395002, 'Surat new', 1, 2, '2020-04-12 18:58:09');

-- --------------------------------------------------------

--
-- Table structure for table `disease`
--

CREATE TABLE `disease` (
  `disId` int(11) NOT NULL,
  `disName` text NOT NULL,
  `description` text NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `deleted` int(1) NOT NULL,
  `deletedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disease`
--

INSERT INTO `disease` (`disId`, `disName`, `description`, `createdAt`, `updatedAt`, `deleted`, `deletedAt`) VALUES
(1, 'Fungal Infection', 'A fungus that invades the tissue can cause a disease that\'s confined to the skin, spreads into tissue, bones and organs or affects the whole body.\nSymptoms depend on the area affected, but can include skin rash or vaginal infection resulting in abnormal discharge.\nTreatments include antifungal medication.', '2020-04-12 11:43:50', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'Migraine', 'The cause of migraines is not yet known. It is suspected that they result from abnormal activity in the brain.', '2020-04-12 11:47:04', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 'Angina', 'Angina is chest pain or discomfort caused when your heart muscle doesn\'t get enough oxygen-rich blood. It may feel like pressure or squeezing in your chest.', '2020-04-12 11:48:10', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 'Diabetes', 'Diabetes is a disease that occurs when your blood glucose, also called blood sugar, is too high. Blood glucose is your main source of energy and comes from the food you eat. Insulin, a hormone made by the pancreas, helps glucose from food get into your cells to be used for energy.', '2020-04-12 11:50:05', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, 'Flu', 'The flu attacks the lungs, nose and throat. Young children, older adults, pregnant women and people with chronic disease or weak immune systems are at high risk.\nSymptoms include fever, chills, muscle aches, cough, congestion, runny nose, headaches and fatigue.\nFlu is primarily treated with rest and fluid intake to allow the body to fight the infection on its own. Paracetamol may help cure the symptoms but NSAIDs should be avoided. An annual vaccine can help prevent the flu and limit its complications.', '2020-04-12 11:50:35', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, 'Malaria', 'Malaria is a life-threatening disease. It\'s typically transmitted through the bite of an infected Anopheles mosquito', '2020-04-12 11:51:46', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, 'Thyroid', 'The thyroid is a butterfly-shaped gland that sits low on the front of the neck. ... The thyroid secretes several hormones, collectively called thyroid hormones. The main hormone is thyroxine, also called T4.', '2020-04-12 11:53:14', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(8, 'Jaundice', 'A yellow tint to the skin or eyes caused by an excess of bilirubin, a substance created when red blood cells break down. Body fluids may also be yellow.', '2020-04-12 11:55:26', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, 'Asthma', 'Asthma is a condition in which your airways narrow and swell and produce extra mucus. This can make breathing difficult and trigger coughing, wheezing and shortness of breath', '2020-04-12 11:57:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(10, 'Acne', 'A skin condition that occurs when hair follicles plug with oil and dead skin cells.\nAcne is most common in teenagers and young adults.\nSymptoms range from uninflamed blackheads to pus-filled pimples or large, red and tender bumps.\nTreatments include over-the-counter creams and cleanser, as well as prescription antibiotics.', '2020-04-12 11:58:34', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(11, 'Cavities', 'Permanently damaged areas in teeth that develop into tiny holes.\nCauses include bacteria, snacking, sipping sugary drinks and poor teeth cleaning.\nThere may be no symptoms. Untreated cavities can cause toothache, infection and tooth loss.\nTreatments include fluoride, fillings and crowns. Severe cases may need a root canal or removal.', '2020-04-12 11:59:50', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(12, 'Tuberculosis (TB)', 'TB is caused by bacteria (Mycobacterium tuberculosis) that most often affect the lungs. Tuberculosis is curable and preventable.', '2020-04-12 11:59:57', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(13, 'Cold', 'The common cold is a viral infection of your nose and throat (upper respiratory tract). It\'s usually harmless, although it might not feel that way. Many types of viruses can cause a common cold', '2020-04-12 12:02:27', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(14, 'Conjunctivitis', 'Inflammation or infection of the outer membrane of the eyeball and the inner eyelid.\nConjunctivitis, or pink eye, is an irritation or inflammation of the conjunctiva, which covers the white part of the eyeball. It can be caused by allergies or a bacterial or viral infection. Conjunctivitis can be extremely contagious and is spread by contact with eye secretions from someone who is infected.\nSymptoms include redness, itching and tearing of the eyes. It can also lead to discharge or crusting around the eyes.\nIt\'s important to stop wearing contact lenses whilst affected by conjunctivitis. It often resolves on its own, but treatment can speed the recovery process. Allergic conjunctivitis can be treated with antihistamines. Bacterial conjunctivitis can be treated with antibiotic eye drops.', '2020-04-12 12:04:38', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(15, 'pneumonia', 'Pneumonia is a lung infection that can range from mild to so severe that you have to go to the hospital.', '2020-04-12 12:05:19', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(16, 'Diarrhoea', 'Loose, watery bowel movements that may occur frequently and with a sense of urgency. Some people frequently pass stools, but they are of normal consistency. This is not diarrhea. Similarly, breastfed babies often pass loose, pasty stools. This is normal. It is not diarrhea.', '2020-04-12 12:08:11', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(17, 'Typhoid', 'Typhoid fever is an infection that spreads through contaminated food and water.', '2020-04-12 12:08:12', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(18, 'High Blood Pressure', 'High blood pressure (HBP or hypertension) is when your blood pressure, the force of your blood pushing against the walls of your blood vessels, is consistently too high.', '2020-04-12 12:11:01', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(19, 'Gangrene', 'Dead tissue caused by an infection or lack of blood flow.\nThe death of tissue often occurs in the extremities or skin from loss of blood supply. The condition often affects toes, fingers and limbs, but can affect muscles and organs.\nSymptoms include discoloured skin, severe pain followed by numbness and foul discharge.\nGangrene requires urgent care. Treatment includes antibiotics and removing dead tissue.', '2020-04-12 12:11:46', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(20, 'Hepatitis', 'Hepatitis is an inflammation of the liver. The condition can be self-limiting or can progress to fibrosis (scarring), cirrhosis or liver cancer. Hepatitis viruses are the most common cause of hepatitis in the world but other infections, toxic substances (e.g. alcohol, certain drugs), and autoimmune diseases can also cause hepatitis.', '2020-04-12 12:13:37', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `docId` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `pwd` text NOT NULL,
  `gender` int(1) NOT NULL,
  `profileImg` text NOT NULL,
  `description` text NOT NULL,
  `experience` text NOT NULL,
  `address` text NOT NULL,
  `pincode` int(11) NOT NULL,
  `cityId` int(11) NOT NULL,
  `dptId` int(11) NOT NULL,
  `estimatedTime` int(11) NOT NULL,
  `specialization` text NOT NULL,
  `price` int(11) NOT NULL,
  `joindate` datetime NOT NULL,
  `datetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`docId`, `username`, `email`, `phone`, `pwd`, `gender`, `profileImg`, `description`, `experience`, `address`, `pincode`, `cityId`, `dptId`, `estimatedTime`, `specialization`, `price`, `joindate`, `datetime`, `status`, `updatedAt`) VALUES
(1, 'Krishna', 'krishna@gmail.com', '9427282785', 'MUZROVJQSHVldExQWU5Mdy9XdHNTZz09', 2, '1241_doctor-400-4.jpg', 'Doctor', '5 Years of experience as Surgen In Civil Hospital.', 'Udhana, surat', 394201, 1, 1, 10, 'Fungal Infection	,Migraine	,Diabetes,Jaundice,Tuberculosis (TB)	', 500, '2020-04-12 18:04:40', '2020-04-12 18:04:40', 2, '2020-04-12 18:32:55'),
(2, 'Pratik Patel', 'pratik@gmail.com', '8956363589', 'MUZROVJQSHVldExQWU5Mdy9XdHNTZz09', 1, '3733_friendly-indian-doctor-reviewing-medical-history-tablet_1262-12661.jpg', 'A doctor with miracle skills', 'I have been working as Senior doctor in renowned Hospital since 2010', 'A/401 Elite soc., Gandhi Road,  Ahemdabad', 395001, 2, 1, 10, 'Expertise in the cure of Asthma', 500, '2020-04-12 18:05:04', '2020-04-12 18:05:04', 2, '2020-04-12 18:33:00'),
(3, 'Dhaval Jarirwala', 'dhaval@gmail.com', '9898697775', 'MUZROVJQSHVldExQWU5Mdy9XdHNTZz09', 1, '6047_doctor-400-3.jpg', 'Instant Cure Doctor', '2 Years of experience in Mahavir Hospital.', 'Ashirwad Park, Udhana, Surat.', 395002, 1, 2, 0, 'Cold,pneumonia	', 0, '2020-04-12 18:22:08', '2020-04-12 18:22:08', 2, '2020-04-12 18:33:05'),
(4, 'Sneha Trivedi', 'sneha@gmail.com', '8849365231', 'MUZROVJQSHVldExQWU5Mdy9XdHNTZz09', 2, '6388_19312312-indian-doctor-woman.jpg', 'Responsible and efficient doctor.', 'I am having experience of 10 years.', '301 Hello Bunglows,  Adajan', 395004, 1, 2, 10, 'Expertise in Cold & Fever', 300, '2020-04-12 18:22:22', '2020-04-12 18:22:22', 2, '2020-04-13 11:06:37');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_active_time`
--

CREATE TABLE `doctor_active_time` (
  `acId` int(11) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `wdId` int(11) NOT NULL,
  `docId` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `deleted` int(1) NOT NULL,
  `deletedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_active_time`
--

INSERT INTO `doctor_active_time` (`acId`, `startTime`, `endTime`, `wdId`, `docId`, `createdAt`, `updatedAt`, `deleted`, `deletedAt`) VALUES
(1, '17:00:00', '20:00:00', 7, 1, '2020-04-12 18:15:05', '2020-04-13 18:01:01', 0, '0000-00-00 00:00:00'),
(2, '17:00:00', '20:00:00', 8, 1, '2020-04-12 18:15:08', '2020-04-13 18:01:01', 0, '0000-00-00 00:00:00'),
(3, '10:00:00', '13:00:00', 7, 1, '2020-04-12 18:15:09', '2020-04-13 18:01:01', 0, '0000-00-00 00:00:00'),
(4, '16:00:00', '20:00:00', 8, 2, '2020-04-12 18:20:03', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, '16:00:00', '18:00:00', 1, 2, '2020-04-12 18:20:03', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, '16:00:00', '19:00:00', 5, 2, '2020-04-12 18:20:03', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, '10:00:00', '13:00:00', 8, 1, '2020-04-12 18:42:25', '2020-04-13 18:01:01', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_appointment`
--

CREATE TABLE `doctor_appointment` (
  `appId` int(11) NOT NULL,
  `description` text NOT NULL,
  `datetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `acId` int(11) NOT NULL,
  `dptId` int(11) NOT NULL,
  `pId` int(11) NOT NULL,
  `docId` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `deleted` int(1) NOT NULL,
  `deletedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_appointment`
--

INSERT INTO `doctor_appointment` (`appId`, `description`, `datetime`, `status`, `acId`, `dptId`, `pId`, `docId`, `createdAt`, `updatedAt`, `deleted`, `deletedAt`) VALUES
(1, 'Description ', '2020-04-12 00:00:00', 1, 1, 1, 1, 1, '2020-04-12 18:45:34', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'Description ', '2020-04-14 00:00:00', 1, 2, 1, 2, 1, '2020-04-14 18:31:28', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 'Description ', '2020-06-11 00:00:00', 0, 2, 1, 1, 1, '2020-06-11 14:12:38', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_clinic`
--

CREATE TABLE `doctor_clinic` (
  `dcId` int(11) NOT NULL,
  `clinicName` varchar(30) NOT NULL,
  `clinicDescription` text NOT NULL,
  `clinicAddress` text NOT NULL,
  `clinicPincode` int(11) NOT NULL,
  `cityId` int(11) NOT NULL,
  `docId` int(11) NOT NULL,
  `joindate` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_clinic`
--

INSERT INTO `doctor_clinic` (`dcId`, `clinicName`, `clinicDescription`, `clinicAddress`, `clinicPincode`, `cityId`, `docId`, `joindate`, `status`, `updatedAt`) VALUES
(1, 'Rana Clinic', 'Krishna Rana\'s Clinic.', 'Udhana, Surat', 395401, 1, 1, '2020-04-12 18:09:30', 1, '2020-04-12 18:33:14');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_pharmacist`
--

CREATE TABLE `doctor_pharmacist` (
  `dophId` int(11) NOT NULL,
  `docId` int(11) NOT NULL,
  `pharId` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `deleted` int(1) NOT NULL,
  `deletedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_pharmacist`
--

INSERT INTO `doctor_pharmacist` (`dophId`, `docId`, `pharId`, `createdAt`, `deleted`, `deletedAt`) VALUES
(1, 1, 3, '2020-04-12 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 1, 4, '2020-04-13 17:25:41', 0, '2020-04-13 17:25:50');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_pharmacist_type`
--

CREATE TABLE `doctor_pharmacist_type` (
  `dptId` int(11) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_pharmacist_type`
--

INSERT INTO `doctor_pharmacist_type` (`dptId`, `type`) VALUES
(1, 'Regular Doctor'),
(2, 'Instant Cure Doctor'),
(3, 'Offline Pharmacy'),
(4, 'Online Pharmacy');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_qualification`
--

CREATE TABLE `doctor_qualification` (
  `dqId` int(11) NOT NULL,
  `university` varchar(50) NOT NULL,
  `degree` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `docId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_qualification`
--

INSERT INTO `doctor_qualification` (`dqId`, `university`, `degree`, `year`, `docId`) VALUES
(9, 'AIIMS', 'MBBS', 2007, 2),
(10, 'AIIMS', 'MS', 2010, 2),
(11, 'SMIMER', 'MBBS', 2016, 3),
(18, 'SMIMER', 'MBBS', 2013, 1),
(19, 'SMIMER', 'MD', 2015, 1),
(25, 'VNSGU', 'MD', 2010, 4);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_working_day`
--

CREATE TABLE `doctor_working_day` (
  `wdId` int(11) NOT NULL,
  `day` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_working_day`
--

INSERT INTO `doctor_working_day` (`wdId`, `day`) VALUES
(5, 'Friday'),
(1, 'Monday'),
(8, 'Monday - Friday'),
(9, 'Monday - Saturday'),
(10, 'Monday - Sunday'),
(6, 'Saturday'),
(7, 'Sunday'),
(4, 'Thursday'),
(2, 'Tuesday'),
(3, 'Wednesday');

-- --------------------------------------------------------

--
-- Table structure for table `instant_cure_appointment`
--

CREATE TABLE `instant_cure_appointment` (
  `icappId` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `dptId` int(11) NOT NULL,
  `pId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instant_cure_appointment`
--

INSERT INTO `instant_cure_appointment` (`icappId`, `datetime`, `status`, `dptId`, `pId`) VALUES
(1, '2020-04-12 19:03:03', 2, 2, 2),
(2, '2020-04-13 10:56:00', 2, 2, 2),
(3, '2020-04-14 18:39:54', 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `instant_cure_doctor`
--

CREATE TABLE `instant_cure_doctor` (
  `icdId` int(11) NOT NULL,
  `active_time` datetime NOT NULL,
  `active_status` int(1) NOT NULL,
  `allocated` int(1) NOT NULL,
  `icappId` int(11) DEFAULT NULL,
  `docId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instant_cure_doctor`
--

INSERT INTO `instant_cure_doctor` (`icdId`, `active_time`, `active_status`, `allocated`, `icappId`, `docId`) VALUES
(1, '2020-04-14 18:44:18', 0, 0, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medId` int(11) NOT NULL,
  `medName` text NOT NULL,
  `medDescription` text NOT NULL,
  `image` text NOT NULL,
  `disId` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedBy` int(11) NOT NULL,
  `updatedAt` datetime NOT NULL,
  `deleted` int(1) NOT NULL,
  `deletedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medId`, `medName`, `medDescription`, `image`, `disId`, `createdBy`, `createdAt`, `updatedBy`, `updatedAt`, `deleted`, `deletedAt`) VALUES
(1, 'Excedrin Migraine Pain Relief Caplets', 'Excedrin® Migraine Pain Relief Caplets, 24 ct Box', '9627_00300672039248_cf__jpeg_3.jpg', 2, 2, '2020-04-12 12:30:42', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'Excedrin® Migraine Pain Relief Caplets, 24 ct Box', 'Excedrin® Migraine Pain Relief Caplets, 24 ct Box', '', 3, 2, '2020-04-12 12:34:23', 2, '2020-04-12 13:40:20', 1, '2020-04-12 12:35:41'),
(3, 'DOXYCYCLINE', 'Doxycycline is a tetracycline antibiotic which fights off bacteria in the body. It is used to treat several bacterial infections, such as urinary tract infections, respiratory tract infection, eye and intestinal infections, acne, and infections in and around the mouth. Doxycycline capsule is also useful to prevent malaria. Although the antibiotic is approved by FDA but it?s unnecessary use or misuse may decrease its effectiveness or cause adverse effects. Thus, you should consult your doctor about its usage and dose to get desirable effects out of it. Doxycycline capsule is a versatile antibiotic that means it works against a wide range of bacteria and is very effective. The drug is sold under various brand names, but its generic form is cheaper to buy than its branded versions.', '', 10, 1, '2020-04-12 12:34:31', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 'Aspirin 81 mg', 'Compare to Bayer Chewable Low Dose Aspirin active ingredient.', '0017.jpg', 3, 2, '2020-04-12 12:39:21', 2, '2020-04-12 13:49:31', 0, '0000-00-00 00:00:00'),
(5, 'Amphotericin-B', 'The name Mega bacteria is a dreaded name to parakeets, canaries, parrots and other birds. Often also both other names „black dot“ or „going light syndrome“ are mentioned for the sickening of the birds. Specialists worldwide speak of „Macrorhabdus ornithogaster“.\n\nSources of infection are of course as almost ever droppings and contaminated drinking water. Acquisitions and bird shows are also big sources of infection. The name Mega bacteria indicates that antibiotics should be used as therapy!', '3414_Amphotericin-B.png', 1, 1, '2020-04-12 12:39:33', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, 'CEFTRIAXONE ', 'CEFTRIAXONE SODIUM 250 MG Pk/10, ndc# 60505-6151-01, MFR-APOTEX ', '5690_Cefoperazone.jpg', 17, 1, '2020-04-12 12:48:28', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, 'Codeine Linctus Syrup', 'Codeine Linctus is a cough syrup that helps to ease dry, tickly coughs. It reduces the urge to cough, leaving you feeling free from irritation caused by a persistent cough. Ideal for those suffering from a dry cough and looking for an effective solution. Codeine Linctus is also available in a sugar-free syrup.\n', '1116_Codeine_Linctus_Syrup_(15mg_5ml)_-_200ml_30.jpg', 13, 1, '2020-04-12 12:54:17', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(8, 'BGR-34 Tablet', 'Winning the fight against the silent killer, Type-2 Diabetes', '6809_Capture.PNG', 4, 2, '2020-04-12 12:57:36', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, 'Hyocimax S', 'We could do your products according to your samples, forma, and ingredients.\nAnd do the printing, label, logo and your own packaging for your company.\nThe paper box could be customized according to your design.\n', '', 0, 1, '2020-04-12 12:58:03', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(10, 'Maloff Protect Tablets', 'Maloff Protect Tablets', '9062_maloff-protect-tablets-p12855-14418_medium.jpg', 6, 2, '2020-04-12 13:00:30', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(11, 'Aminophylline ', 'PRESENTATION: Aminophylline Tablets BP 100mg: white round tablet plain on both sides. Each table contains: Aminophylline BP 100mg.  CLINICAL PHARMACOLOGY: Aminophylline is a bronchodilator, Aminophylline relaxes bronchial smooth muscle, relieves bronchospasm, and has a stimulant effect on respiration. It stimulates the myocardium and central nervous system, decreases peripheral resistance and venous pressure, and causes diuresis.  USES: Aminophylline is used in the management of asthma and chronic obstructive pulmonary disease.  DOSAGE AND ADMINISTRATION: Acute bronchospasm: 100 to 300mg three or four times daily after food.  CONTRA-INDICATIONS AND WARNINGS: Aminophylline should be given with caution to patients with peptic ulceration, hyperthyroidism, hypertension, cardiac arrhythmias or other cardiovascular disease, or epilepsy. Aminophylline should also be given with caution to patients with heart failure, hepatic dysfunction or chronic alcoholism, acute febrile illness, and to  neonates and the elderly.  Adverse Effects: The adverse effects commonly encountered are gastro-intestinal irritation and stimulation of the CNS. Aminophylline may cause nausea, vomiting, abdominal pain, diarrhoea, other gastro-intestinal disturbances, insomnia, headache , anxiety, restlessness, dizziness, tremor and palpitations.  Storage: Store in a cool and dry place. Protect from light. Keep out of reach of children.\n', '4313_Aminophylline-Tablet-100mg-10-10-Box.jpg', 9, 1, '2020-04-12 13:02:23', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(12, 'ThyroQ Ayurvedic Medicine for Thyroid ', 'A unique, safe, effective &, selective formula for hypothyroidism.', '4718_41k-Q2Mwo+L.jpg', 7, 2, '2020-04-12 13:04:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(13, 'Seroflo Inhaler, for Bronchitis', 'The offered inhaler is medicated for the treatment of asthma.', '1979_seroflo-inhaler-250x250.jpg', 9, 2, '2020-04-12 13:06:06', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(14, 'CROCIN PAIN RELIEF TABLET', 'CROCIN PAIN RELIEF TABLET used to treat mild to moderate pain and fever in conditions such as headache, toothache and period pains.', '2396_CROC0011_L.jpg', 0, 1, '2020-04-12 13:07:27', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(15, 'Nucoxia', 'Nucoxia 90 Tablet is a pain relieving medicine. It is used for relieving moderate pain and swelling of joints associated with different forms of gout and arthritis. It is also used for short-term treatment of moderate pain after dental surgery in people 16 years of age and older.\n\nNucoxia 90 Tablet can be taken with or without food. The dose depends on what you are taking it for and how well it helps your symptoms. You should take it as advised by your doctor. Do not take more or use it for longer than recommended.', '9372_nsoycxowig7f1cnlyg9o.jpg', 0, 1, '2020-04-12 13:11:41', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(16, 'VXL Isoniazid Medicine', 'Delicuf-Z (Isoniazide 300 mg tab).', '3988_seroflo-inhaler-250x250.jpg', 12, 2, '2020-04-12 13:13:51', 0, '0000-00-00 00:00:00', 1, '2020-04-12 13:15:42'),
(17, 'Calcium Chewable', 'Calcium is intended to support healthy bones and teeth. The minerals in this product are chelate to citric acid to help increase absorption within the body. Our great tasting chewables have been formulated with a mixture of natural sweeteners and flavors.', '5859_calcium-supplement-with-vitamin-d3-chewable-tablet-250x250.jpg', 0, 1, '2020-04-12 13:17:05', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(18, 'Haldikuf Ayurvedic Cough & Cold Syrup- 400 Ml', 'Haldikuf Syrup is a Combination of Haldi with Adulsa + Tulsi ', '1354_61kdgJurv+L__SL1500_.jpg', 13, 2, '2020-04-12 13:20:54', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(19, 'Artesunate', 'WE AT NIKSAN HEALTHCARE IS STATE OF ART, FDCA, ISO 9001: 2015, WHO, GMP, GLP CERTIFIED FACILITY TO DEVELOP AND MANUFACTURE HIGHLY QUALITY PHARMACEUTICAL FINISHED FORMULATIONS. NIKSAN HEALTHCARE IS LEADING MANUFACTURER, EXPORTER, SUPPLIERS, DISTRIBUTOR, TRADER AND DEALER OF HIGH STANDARD QUALITY ARTESUNATE 100 MG AMODIAQUINE 270 MG TABLETS.', '2970_artesunate-sulfadoxine-pyrimethamine-tablet-500x500.jpg', 6, 1, '2020-04-12 13:21:24', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(20, 'Dolo 650 MG Tablet', 'Dolo 650 MG Tablet is used to temporarily relieve fever and mild to moderate pain such as muscle ache, headache, toothache, arthritis, and backache.', '7518_61kdgJurv+L__SL1500_.jpg', 13, 2, '2020-04-12 13:23:58', 0, '0000-00-00 00:00:00', 1, '2020-04-12 13:35:27'),
(21, 'REFRESH TEARS', 'It is used for itchy and red eyes', '1532_refresh-tears-hero-packaging.png', 0, 2, '2020-04-12 13:29:02', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(22, 'Hep Plus', 'Act as a Tonic for boosting Liver Function', '8918_refresh-tears-hero-packaging.png', 8, 2, '2020-04-12 13:33:45', 0, '0000-00-00 00:00:00', 1, '2020-04-12 13:34:11'),
(23, 'Salius Chloramphenicol Eye Drops', 'Salius Pharma is a leading exporter of healthcare products from India with leading palyer in  innovative generic medicines.', '7340_chloramphenical-eye-drops-500x500.jpg', 14, 2, '2020-04-12 13:37:39', 2, '2020-04-12 13:38:34', 0, '0000-00-00 00:00:00'),
(24, 'Zindagi Stevia Dry Tablets 100 gm', 'Zindagi Stevia Dry Leaves 100 gm', '7676_zindagi_stevia_dry_leaves_100_gm_0.jpg', 4, 2, '2020-04-12 13:45:13', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_dose`
--

CREATE TABLE `medicine_dose` (
  `doseId` int(11) NOT NULL,
  `doseUnit` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine_dose`
--

INSERT INTO `medicine_dose` (`doseId`, `doseUnit`) VALUES
(1, 'MG'),
(2, 'GM'),
(3, 'ML');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_rating`
--

CREATE TABLE `medicine_rating` (
  `medRateId` int(11) NOT NULL,
  `description` text NOT NULL,
  `rates` int(1) NOT NULL,
  `pwmId` int(11) NOT NULL,
  `pId` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine_rating`
--

INSERT INTO `medicine_rating` (`medRateId`, `description`, `rates`, `pwmId`, `pId`, `datetime`) VALUES
(1, 'Worked 100% , very effective and fluent. 5 out of 5', 5, 19, 2, '2020-04-12 19:01:05');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_storage_type`
--

CREATE TABLE `medicine_storage_type` (
  `mstId` int(11) NOT NULL,
  `mstType` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine_storage_type`
--

INSERT INTO `medicine_storage_type` (`mstId`, `mstType`) VALUES
(1, 'Strip'),
(2, 'Bottle');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_storage_unit`
--

CREATE TABLE `medicine_storage_unit` (
  `msuId` int(11) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `mstId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine_storage_unit`
--

INSERT INTO `medicine_storage_unit` (`msuId`, `unit`, `mstId`) VALUES
(1, 'Tablet(s)', 1),
(2, 'Capsule(s)', 1),
(3, 'ml Suspension', 2),
(4, 'ml Oral Drop(s)', 2);

-- --------------------------------------------------------

--
-- Table structure for table `medicine_update_details`
--

CREATE TABLE `medicine_update_details` (
  `mudId` int(11) NOT NULL,
  `updatedMedName` text NOT NULL,
  `updatedMedDescription` text NOT NULL,
  `updatedDisId` int(11) NOT NULL,
  `medId` int(11) NOT NULL,
  `type` int(1) NOT NULL COMMENT '0=old,1=new',
  `status` int(1) NOT NULL COMMENT '0=pending,1=updated,2=rejected',
  `updatedBy` int(11) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine_update_details`
--

INSERT INTO `medicine_update_details` (`mudId`, `updatedMedName`, `updatedMedDescription`, `updatedDisId`, `medId`, `type`, `status`, `updatedBy`, `createdAt`) VALUES
(1, '', '', 14, 23, 1, 1, 2, '2020-04-12 13:38:34'),
(2, 'Salius Chloramphenicol Eye Drops', 'Salius Pharma is a leading exporter of healthcare products from India with leading palyer in  innovative generic medicines.', 0, 23, 0, 1, 2, '2020-04-12 13:38:34'),
(3, 'Excedrin® Migraine Pain Relief Caplets, 24 ct Box', '', 0, 2, 1, 1, 2, '2020-04-12 13:40:20'),
(4, 'Compare to Bayer Chewable Low Dose Aspirin active ingredient. Amazon Basic Care Chewable Aspirin 81 mg Tablets, Orange Flavor, are a chewable adult low dose aspirin. Aspirin is a nonsteroidal anti-inflammatory drug (NSAID) pain reliever used for the temporary relief of minor aches and pains. Low Dose Aspirin Regimen: Talk to your doctor or other healthcare provider before using this product for your heart. Amazon Basic Care Chewable Aspirin 81 mg Tablets are gluten free.', 'Excedrin® Migraine Pain Relief Caplets, 24 ct Box', 3, 2, 0, 1, 2, '2020-04-12 13:40:20'),
(5, 'Amazon Basic Care Aspirin 81 mg ', '', 0, 0, 1, 0, 2, '2020-04-12 13:48:37'),
(6, 'Aspirin 81 mg', '', 0, 4, 1, 1, 2, '2020-04-12 13:49:31'),
(7, 'Amazon Basic Care Aspirin 81 mg Pain Reliever', 'Compare to Bayer Chewable Low Dose Aspirin active ingredient.', 3, 4, 0, 1, 2, '2020-04-12 13:49:31');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_update_permission`
--

CREATE TABLE `medicine_update_permission` (
  `mupId` int(11) NOT NULL,
  `pharId` int(11) NOT NULL,
  `permission` int(1) NOT NULL COMMENT '0=pending,1=confirm,2=rejected',
  `permissionDateTime` datetime NOT NULL,
  `mudId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notiId` int(11) NOT NULL,
  `userTypeId` int(11) NOT NULL,
  `visitorId` int(11) NOT NULL,
  `msg` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `datetime` datetime NOT NULL,
  `deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `oiId` int(11) NOT NULL,
  `pwmId` int(11) NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `type` int(1) NOT NULL COMMENT '0=direct,1=prescription',
  `orderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`oiId`, `pwmId`, `price`, `qty`, `type`, `orderId`) VALUES
(1, 14, 70, 10, 1, 1),
(2, 17, 300, 15, 1, 1),
(3, 19, 1000, 1, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_medicine`
--

CREATE TABLE `order_medicine` (
  `orderId` int(11) NOT NULL,
  `daId` int(11) NOT NULL,
  `totalAmount` float NOT NULL,
  `datetime` datetime NOT NULL,
  `payMethod` varchar(20) NOT NULL,
  `pId` int(11) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_medicine`
--

INSERT INTO `order_medicine` (`orderId`, `daId`, `totalAmount`, `datetime`, `payMethod`, `pId`, `status`) VALUES
(1, 1, 5200, '2020-04-12 18:54:37', 'card', 1, 'Pending'),
(2, 2, 1000, '2020-04-12 18:58:33', 'COD', 2, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_pharmacy`
--

CREATE TABLE `order_pharmacy` (
  `opId` int(11) NOT NULL,
  `buyDatetime` datetime NOT NULL,
  `presDatetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `presId` int(11) NOT NULL,
  `pId` int(11) NOT NULL,
  `pharId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_pharmacy`
--

INSERT INTO `order_pharmacy` (`opId`, `buyDatetime`, `presDatetime`, `status`, `presId`, `pId`, `pharId`) VALUES
(1, '2020-04-12 18:51:37', '2020-04-12 18:48:13', 1, 1, 1, 3),
(2, '2020-04-12 18:51:37', '2020-04-12 18:48:13', 1, 2, 1, 3),
(3, '2020-04-14 18:52:00', '2020-04-12 18:48:13', 1, 1, 1, 3),
(4, '2020-04-14 18:52:00', '2020-04-12 18:48:13', 1, 2, 1, 3),
(5, '2020-06-11 14:16:49', '2020-04-12 18:48:13', 0, 1, 1, 3),
(6, '2020-06-11 14:16:49', '2020-04-12 18:48:13', 0, 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `pId` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `pwd` text NOT NULL,
  `gender` int(1) NOT NULL,
  `dob` datetime NOT NULL,
  `profileImg` text NOT NULL,
  `description` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `pincode` int(11) NOT NULL,
  `cityId` int(11) NOT NULL,
  `joindate` datetime NOT NULL,
  `datetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pId`, `username`, `email`, `phone`, `pwd`, `gender`, `dob`, `profileImg`, `description`, `address`, `pincode`, `cityId`, `joindate`, `datetime`, `status`, `updatedAt`) VALUES
(1, 'Mehul', 'msherdiwala16@gmail.com', '9427289586', 'MUZROVJQSHVldExQWU5Mdy9XdHNTZz09', 1, '1999-10-06 00:00:00', '4142_user-400-9.jpg', 'Patient ', 'Khatodra,Surat', 395002, 1, '2020-04-12 18:26:31', '2020-04-12 18:26:31', 0, '2020-04-12 18:28:06'),
(2, 'Mann Soni', 'mannsoni30@gmail.com', '9429680526', 'MUZROVJQSHVldExQWU5Mdy9XdHNTZz09', 1, '1996-05-11 00:00:00', '9557_istockphoto-613557584-612x612.jpg', 'New Description', 'A/401 Happy Homes, Udhna, Surat', 395004, 1, '2020-04-12 18:32:08', '2020-04-12 18:32:08', 0, '2020-06-03 09:51:37'),
(3, 'Viraj Ramani', 'viraj@gmail.com', '', 'MUZROVJQSHVldExQWU5Mdy9XdHNTZz09', 0, '0000-00-00 00:00:00', '', '', '', 0, 0, '2020-04-14 18:18:00', '2020-04-14 18:18:00', 0, '0000-00-00 00:00:00'),
(4, 'Smit Pandey', 'smit@gmail.com', '', 'MUZROVJQSHVldExQWU5Mdy9XdHNTZz09', 0, '0000-00-00 00:00:00', '', '', '', 0, 0, '2020-04-14 18:18:10', '2020-04-14 18:18:10', 0, '0000-00-00 00:00:00'),
(5, 'Raj Sherdiwala', 'raj@gmail.com', '', 'MUZROVJQSHVldExQWU5Mdy9XdHNTZz09', 0, '0000-00-00 00:00:00', '', '', '', 0, 0, '2020-04-14 18:19:09', '2020-04-14 18:19:09', 0, '0000-00-00 00:00:00'),
(6, 'Jay Chawda', 'jay@gmail.com', '', 'MUZROVJQSHVldExQWU5Mdy9XdHNTZz09', 0, '0000-00-00 00:00:00', '', '', '', 0, 0, '2020-04-14 18:19:12', '2020-04-14 18:19:12', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `patient_medical_record`
--

CREATE TABLE `patient_medical_record` (
  `pmrId` int(11) NOT NULL,
  `pmrDescription` text NOT NULL,
  `datetime` datetime NOT NULL,
  `docId` int(11) NOT NULL,
  `pId` int(11) NOT NULL,
  `updatedAt` datetime NOT NULL,
  `deleted` int(1) NOT NULL,
  `deletedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_medical_record`
--

INSERT INTO `patient_medical_record` (`pmrId`, `pmrDescription`, `datetime`, `docId`, `pId`, `updatedAt`, `deleted`, `deletedAt`) VALUES
(1, 'Description', '2020-04-12 18:46:38', 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `patient_medical_record_details`
--

CREATE TABLE `patient_medical_record_details` (
  `pmdId` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `description` text NOT NULL,
  `pmrId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_medical_record_details`
--

INSERT INTO `patient_medical_record_details` (`pmdId`, `datetime`, `description`, `pmrId`) VALUES
(1, '2020-04-12 18:48:13', 'Cold And Fever', 1),
(2, '2020-04-14 18:35:51', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient_report`
--

CREATE TABLE `patient_report` (
  `reportId` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `src` text NOT NULL,
  `pmdId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_doctor`
--

CREATE TABLE `payment_doctor` (
  `pdId` int(11) NOT NULL,
  `amount` float NOT NULL,
  `datetime` datetime NOT NULL,
  `appType` int(1) NOT NULL COMMENT '0=ragular,1=instant cure',
  `appId` int(11) NOT NULL,
  `pId` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_doctor`
--

INSERT INTO `payment_doctor` (`pdId`, `amount`, `datetime`, `appType`, `appId`, `pId`, `status`) VALUES
(1, 500, '2020-04-12 18:45:34', 0, 1, 1, 0),
(2, 300, '2020-04-12 19:10:04', 1, 1, 2, 0),
(3, 300, '2020-04-13 11:08:11', 1, 2, 2, 0),
(4, 300, '2020-04-13 11:08:11', 1, 2, 2, 0),
(5, 500, '2020-04-14 18:31:28', 0, 1, 2, 0),
(6, 300, '2020-04-14 18:47:01', 1, 3, 2, 0),
(7, 500, '2020-06-11 14:12:38', 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_pharmacist`
--

CREATE TABLE `payment_pharmacist` (
  `ppId` int(11) NOT NULL,
  `amount` float NOT NULL,
  `datetime` datetime NOT NULL,
  `orderId` int(11) NOT NULL,
  `pId` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_pharmacist`
--

INSERT INTO `payment_pharmacist` (`ppId`, `amount`, `datetime`, `orderId`, `pId`, `status`) VALUES
(1, 5200, '2020-04-12 18:54:39', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist`
--

CREATE TABLE `pharmacist` (
  `pharId` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `pwd` text NOT NULL,
  `profileImg` text NOT NULL,
  `description` text NOT NULL,
  `address` text NOT NULL,
  `pincode` int(11) NOT NULL,
  `cityId` int(11) NOT NULL,
  `dptId` int(11) NOT NULL,
  `joindate` datetime NOT NULL,
  `datetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacist`
--

INSERT INTO `pharmacist` (`pharId`, `username`, `email`, `phone`, `pwd`, `profileImg`, `description`, `address`, `pincode`, `cityId`, `dptId`, `joindate`, `datetime`, `status`, `updatedAt`) VALUES
(1, 'Harsh', 'harsh@gmail.com', '9898697775', 'MUZROVJQSHVldExQWU5Mdy9XdHNTZz09', '4724_patient8.jpg', 'Pharmacist', 'Ashirwad Park, Udhana, Surat.', 395002, 1, 4, '2020-04-12 12:17:54', '2020-04-12 12:17:54', 2, '2020-04-13 19:51:07'),
(2, 'Rutvik Dholakiya', 'rutvik@gmail.com', '7589052631', 'MUZROVJQSHVldExQWU5Mdy9XdHNTZz09', '6574_7910485066_10a1e5e586_b.jpg', 'I am medicine seller', 'Lalita chowk, Katargam', 395004, 1, 4, '2020-04-12 12:18:39', '2020-04-12 12:18:39', 2, '2020-04-12 18:03:27'),
(3, 'Het Soni', 'het@gmail.com', '9426451830', 'MUZROVJQSHVldExQWU5Mdy9XdHNTZz09', '2788_Body-of-missing-Indian-man-found-in-Australia-e1563299828233-1200x900.jpg', 'I am offline pharmacist', 'Akshar darshan Appartment, Katargam', 395004, 1, 3, '2020-04-12 17:58:16', '2020-04-12 17:58:16', 2, '2020-04-12 18:50:54'),
(4, 'Mayank', 'mayank@gmail.com', '9427289585', 'MUZROVJQSHVldExQWU5Mdy9XdHNTZz09', '1010_doctor-400-2.jpg', 'Pharmacist', 'surat', 395001, 1, 3, '2020-04-12 17:59:24', '2020-04-12 17:59:24', 2, '2020-04-12 18:50:59');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist_wise_medicine`
--

CREATE TABLE `pharmacist_wise_medicine` (
  `pwmId` int(11) NOT NULL,
  `price` float NOT NULL,
  `dose` int(11) NOT NULL,
  `doseId` int(11) NOT NULL,
  `capacity` float NOT NULL,
  `msuId` int(11) NOT NULL,
  `medId` int(11) NOT NULL,
  `pharId` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `deleted` int(1) NOT NULL,
  `deletedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacist_wise_medicine`
--

INSERT INTO `pharmacist_wise_medicine` (`pwmId`, `price`, `dose`, `doseId`, `capacity`, `msuId`, `medId`, `pharId`, `createdAt`, `updatedAt`, `deleted`, `deletedAt`) VALUES
(1, 200, 65, 1, 6, 1, 1, 2, '2020-04-12 12:30:42', '2020-04-12 13:06:17', 0, '0000-00-00 00:00:00'),
(2, 500, 5, 1, 15, 1, 2, 2, '2020-04-12 12:34:23', '2020-04-12 12:35:03', 1, '2020-04-12 12:35:41'),
(3, 500, 100, 1, 8, 2, 3, 1, '2020-04-12 12:34:31', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 500, 170, 1, 15, 1, 4, 2, '2020-04-12 12:39:21', '2020-04-12 13:06:35', 0, '0000-00-00 00:00:00'),
(5, 700, 20, 3, 200, 3, 5, 1, '2020-04-12 12:39:33', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, 300, 250, 1, 10, 1, 6, 1, '2020-04-12 12:48:28', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, 150, 5, 3, 200, 3, 7, 1, '2020-04-12 12:54:17', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(8, 400, 110, 1, 100, 1, 8, 2, '2020-04-12 12:57:36', '2020-04-12 13:06:49', 0, '0000-00-00 00:00:00'),
(9, 50, 1, 1, 10, 1, 9, 1, '2020-04-12 12:58:03', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(10, 700, 145, 1, 20, 1, 10, 2, '2020-04-12 13:00:30', '2020-04-12 13:07:14', 0, '0000-00-00 00:00:00'),
(11, 130, 100, 1, 10, 1, 11, 1, '2020-04-12 13:02:23', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(12, 1000, 100, 1, 25, 2, 12, 2, '2020-04-12 13:04:00', '2020-04-12 13:07:26', 0, '0000-00-00 00:00:00'),
(13, 1250, 125, 1, 25, 2, 13, 2, '2020-04-12 13:06:06', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(14, 70, 90, 1, 15, 1, 14, 1, '2020-04-12 13:07:27', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(15, 150, 90, 1, 10, 1, 15, 1, '2020-04-12 13:11:41', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(16, 1170, 100, 1, 10, 1, 16, 2, '2020-04-12 13:13:51', '2020-04-12 13:13:57', 1, '2020-04-12 13:15:42'),
(17, 300, 100, 1, 15, 1, 17, 1, '2020-04-12 13:17:05', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(18, 210, 400, 3, 70, 3, 18, 2, '2020-04-12 13:20:54', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(19, 1000, 100, 1, 10, 1, 19, 1, '2020-04-12 13:21:24', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(20, 50, 650, 1, 15, 1, 20, 2, '2020-04-12 13:23:58', '2020-04-12 13:24:07', 1, '2020-04-12 13:35:27'),
(21, 125, 15, 3, 15, 3, 21, 2, '2020-04-12 13:29:02', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(22, 150, 225, 3, 15, 3, 22, 2, '2020-04-12 13:33:45', '0000-00-00 00:00:00', 1, '2020-04-12 13:34:11'),
(23, 100, 5, 3, 5, 3, 23, 2, '2020-04-12 13:37:39', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(24, 225, 100, 1, 25, 1, 24, 2, '2020-04-12 13:45:13', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `presId` int(11) NOT NULL,
  `timesPerDay` int(11) NOT NULL COMMENT '1=morning,2=noon,4=night',
  `dineSuggestion` int(11) NOT NULL COMMENT '1=before dine,2=after dine',
  `qty` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `datetime` datetime NOT NULL,
  `pwmId` int(11) NOT NULL,
  `pmdId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`presId`, `timesPerDay`, `dineSuggestion`, `qty`, `status`, `datetime`, `pwmId`, `pmdId`) VALUES
(1, 5, 2, 10, 1, '2020-04-12 18:48:13', 14, 1),
(2, 4, 2, 15, 1, '2020-04-12 18:48:13', 17, 1),
(3, 7, 2, 10, 0, '2020-04-14 18:35:51', 1, 2),
(4, 5, 2, 15, 0, '2020-04-14 18:35:51', 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rateId` int(11) NOT NULL,
  `description` text NOT NULL,
  `rates` int(1) NOT NULL,
  `userType` int(1) NOT NULL,
  `userId` int(11) NOT NULL,
  `pId` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `stateId` int(11) NOT NULL,
  `stateName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`stateId`, `stateName`) VALUES
(1, 'Gujarat'),
(2, 'Maharastra'),
(3, 'Rajasthan');

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE `symptoms` (
  `syId` int(11) NOT NULL,
  `description` text NOT NULL,
  `disId` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `deleted` int(1) NOT NULL,
  `deletedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `symptoms`
--

INSERT INTO `symptoms` (`syId`, `description`, `disId`, `createdAt`, `updatedAt`, `deleted`, `deletedAt`) VALUES
(1, 'Darkening of the skin', 1, '2020-04-12 11:43:50', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'Loss of colour', 1, '2020-04-12 11:43:50', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 'Peeling', 1, '2020-04-12 11:43:50', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 'Rashes', 1, '2020-04-12 11:43:50', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, 'Small Bump', 1, '2020-04-12 11:43:50', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, 'Deformed toenail', 1, '2020-04-12 11:43:50', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, 'Itching', 1, '2020-04-12 11:43:50', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(8, 'Vaginal discharge', 1, '2020-04-12 11:43:50', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, 'Sensitivity to light, noise, and smells.', 2, '2020-04-12 11:47:04', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(10, 'Loss of appetite.', 2, '2020-04-12 11:47:04', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(11, 'Feeling very warm or cold.', 2, '2020-04-12 11:47:04', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(12, 'Fatigue.', 2, '2020-04-12 11:47:04', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(13, 'Pale skin.', 2, '2020-04-12 11:47:04', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(14, 'Dizziness.', 3, '2020-04-12 11:48:10', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(15, 'Fatigue.', 3, '2020-04-12 11:48:10', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(16, 'Nausea.', 3, '2020-04-12 11:48:10', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(17, 'Shortness of breath.', 3, '2020-04-12 11:48:10', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(18, 'Sweating.', 3, '2020-04-12 11:48:10', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(19, 'increased thirst and urination.', 4, '2020-04-12 11:50:05', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(20, 'fatigue.', 4, '2020-04-12 11:50:05', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(21, 'increased hunger.', 4, '2020-04-12 11:50:05', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(22, 'blurred vision.', 4, '2020-04-12 11:50:05', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(23, 'numbness or tingling in the feet or hands.', 4, '2020-04-12 11:50:05', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(24, 'sores that do not heal.', 4, '2020-04-12 11:50:05', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(25, 'unexplained weight loss.', 4, '2020-04-12 11:50:05', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(26, 'Pain in the muscles', 5, '2020-04-12 11:50:35', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(27, 'Dry or with Phlegm Cough', 5, '2020-04-12 11:50:35', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(28, 'Chills', 5, '2020-04-12 11:50:35', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(29, 'Dehydration', 5, '2020-04-12 11:50:35', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(30, 'Fatigue', 5, '2020-04-12 11:50:35', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(31, 'Fever', 5, '2020-04-12 11:50:35', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(32, 'Flushing', 5, '2020-04-12 11:50:35', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(33, 'Loss of Appetite', 5, '2020-04-12 11:50:35', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(34, 'Switching', 5, '2020-04-12 11:50:35', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(35, 'chest pressure', 5, '2020-04-12 11:50:35', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(36, 'Head Congestion', 5, '2020-04-12 11:50:35', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(37, 'Swollen lymph nodes', 5, '2020-04-12 11:50:35', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(38, 'shaking chills that can range from moderate to severe.', 6, '2020-04-12 11:51:46', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(39, 'high fever.', 6, '2020-04-12 11:51:46', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(40, 'profuse sweating.', 6, '2020-04-12 11:51:46', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(41, 'nausea.', 6, '2020-04-12 11:51:46', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(42, 'headache.', 6, '2020-04-12 11:51:46', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(43, 'vomiting.', 6, '2020-04-12 11:51:46', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(44, 'abdominal pain.', 6, '2020-04-12 11:51:46', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(45, 'Feeling cold.', 7, '2020-04-12 11:53:14', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(46, 'Tiring easily.', 7, '2020-04-12 11:53:14', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(47, 'Dry skin and brittle nails.', 7, '2020-04-12 11:53:14', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(48, 'Constipation.', 7, '2020-04-12 11:53:14', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(49, 'Depression.', 7, '2020-04-12 11:53:14', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(50, 'Trouble concentrating.', 7, '2020-04-12 11:53:14', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(51, 'Sore muscles.', 7, '2020-04-12 11:53:14', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(52, 'A yellow tinge to the skin and the whites of the eyes, normally starting at the head and spreading down the body', 8, '2020-04-12 11:55:26', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(53, 'Pale Stools', 8, '2020-04-12 11:55:26', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(54, 'Dark Urine', 8, '2020-04-12 11:55:26', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(55, 'Itchiness', 8, '2020-04-12 11:55:26', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(56, 'Fatigue', 8, '2020-04-12 11:55:26', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(57, 'Abdominal Pain', 8, '2020-04-12 11:55:26', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(58, 'Weight loss', 8, '2020-04-12 11:55:26', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(59, 'Vomiting', 8, '2020-04-12 11:55:26', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(60, 'Fever', 8, '2020-04-12 11:55:26', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(61, 'Feeling short of breath.', 9, '2020-04-12 11:57:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(62, 'Frequent coughing, especially at night', 9, '2020-04-12 11:57:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(63, 'Wheezing (a whistling noise during breathing)', 9, '2020-04-12 11:57:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(64, 'Difficulty breathing.', 9, '2020-04-12 11:57:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(65, 'Chest tightness.', 9, '2020-04-12 11:57:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(66, 'Pimples', 10, '2020-04-12 11:58:34', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(67, 'Redness', 10, '2020-04-12 11:58:34', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(68, 'Tenderness', 10, '2020-04-12 11:58:34', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(69, 'Blackhead', 10, '2020-04-12 11:58:34', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(70, 'Tooth loss', 11, '2020-04-12 11:59:50', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(71, 'Toothache', 11, '2020-04-12 11:59:50', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(72, 'A cough that lasts more than 3 weeks.', 12, '2020-04-12 11:59:57', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(73, 'Chest pain.', 12, '2020-04-12 11:59:57', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(74, 'Coughing up blood.', 12, '2020-04-12 11:59:57', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(75, 'Feeling tired all the time.', 12, '2020-04-12 11:59:57', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(76, 'Night sweats.', 12, '2020-04-12 11:59:57', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(77, 'Chills.', 12, '2020-04-12 11:59:57', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(78, 'Loss of appetite.', 12, '2020-04-12 11:59:57', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(79, 'Runny or stuffy nose.', 13, '2020-04-12 12:02:27', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(80, 'Sore throat.', 13, '2020-04-12 12:02:27', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(81, 'Cough.', 13, '2020-04-12 12:02:27', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(82, 'Congestion.', 13, '2020-04-12 12:02:27', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(83, 'Slight body aches or a mild headache.', 13, '2020-04-12 12:02:27', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(84, 'Sneezing.', 13, '2020-04-12 12:02:27', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(85, 'Low-grade fever.', 13, '2020-04-12 12:02:27', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(86, 'Pain in eyes', 14, '2020-04-12 12:04:38', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(87, 'Redness', 14, '2020-04-12 12:04:38', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(88, 'Irritation', 14, '2020-04-12 12:04:38', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(89, 'Redness of eyelid', 14, '2020-04-12 12:04:38', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(90, 'Discharge', 14, '2020-04-12 12:04:38', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(91, 'Dryness', 14, '2020-04-12 12:04:38', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(92, 'Itchiness', 14, '2020-04-12 12:04:38', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(93, 'Puffy eyes', 14, '2020-04-12 12:04:38', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(94, 'Swollen lining of the eye', 14, '2020-04-12 12:04:38', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(95, 'Watery eyes', 14, '2020-04-12 12:04:38', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(96, 'Sensitivity to light', 14, '2020-04-12 12:04:38', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(97, 'Cough, which may produce greenish, yellow or even bloody mucus.', 15, '2020-04-12 12:05:19', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(98, 'Fever, sweating and shaking chills.', 15, '2020-04-12 12:05:19', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(99, 'Shortness of breath.', 15, '2020-04-12 12:05:19', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(100, 'Rapid, shallow breathing.', 15, '2020-04-12 12:05:19', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(101, 'Sharp or stabbing chest pain that gets worse when you breathe deeply or cough.', 15, '2020-04-12 12:05:19', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(102, 'Loss of appetite, low energy, and fatigue.', 15, '2020-04-12 12:05:19', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(103, 'Stomach pain', 16, '2020-04-12 12:08:11', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(104, 'Abdominal cramps', 16, '2020-04-12 12:08:11', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(105, 'Bloating', 16, '2020-04-12 12:08:11', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(106, 'Thirst', 16, '2020-04-12 12:08:11', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(107, 'Weight loss', 16, '2020-04-12 12:08:11', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(108, 'Fever', 16, '2020-04-12 12:08:11', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(109, 'Blood or pus in the stools', 16, '2020-04-12 12:08:11', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(110, 'Persistent vomiting', 16, '2020-04-12 12:08:11', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(111, 'Dehydration', 16, '2020-04-12 12:08:11', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(112, 'Poor appetite.', 17, '2020-04-12 12:08:12', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(113, 'Abdominal pain and peritonitis.', 17, '2020-04-12 12:08:12', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(114, 'Headaches.', 17, '2020-04-12 12:08:12', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(115, 'Generalized aches and pains and weakness.', 17, '2020-04-12 12:08:12', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(116, 'Lethargy (usually only if untreated).', 17, '2020-04-12 12:08:12', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(117, 'Intestinal bleeding or perforation (after 2-3 weeks of the disease).', 17, '2020-04-12 12:08:12', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(118, 'Severe headache.', 18, '2020-04-12 12:11:01', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(119, 'Fatigue or confusion.', 18, '2020-04-12 12:11:01', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(120, 'Vision problems.', 18, '2020-04-12 12:11:01', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(121, 'Chest pain.', 18, '2020-04-12 12:11:01', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(122, 'Difficulty breathing.', 18, '2020-04-12 12:11:01', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(123, 'Irregular heartbeat.', 18, '2020-04-12 12:11:01', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(124, 'Pounding in your chest, neck, or ears.', 18, '2020-04-12 12:11:01', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(125, 'Blister', 19, '2020-04-12 12:11:46', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(126, 'Blue skin from poor circulation', 19, '2020-04-12 12:11:46', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(127, 'Bark scab', 19, '2020-04-12 12:11:46', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(128, 'Discolouration', 19, '2020-04-12 12:11:46', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(129, 'Ulcers', 19, '2020-04-12 12:11:46', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(130, 'Fever or Low blood pressure', 19, '2020-04-12 12:11:46', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(131, 'Creaky joints', 19, '2020-04-12 12:11:46', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(132, 'foul-Smelling discharge', 19, '2020-04-12 12:11:46', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(133, 'Pus', 19, '2020-04-12 12:11:46', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(134, 'Reduced sensation of touch', 19, '2020-04-12 12:11:46', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(135, 'Fatigue.', 20, '2020-04-12 12:13:37', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(136, 'Flu-like symptoms.', 20, '2020-04-12 12:13:37', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(137, 'Dark urine.', 20, '2020-04-12 12:13:37', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(138, 'Pale stool.', 20, '2020-04-12 12:13:37', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(139, 'Abdominal pain.', 20, '2020-04-12 12:13:37', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(140, 'Yellow skin and eyes, which may be signs of jaundice.', 20, '2020-04-12 12:13:37', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `userTypeId` int(11) NOT NULL,
  `user` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`userTypeId`, `user`) VALUES
(1, 'Doctor'),
(2, 'Pharmacist'),
(3, 'Patient'),
(4, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `walletId` int(11) NOT NULL,
  `amount` float NOT NULL,
  `userTypeId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`walletId`, `amount`, `userTypeId`, `userId`, `updatedAt`) VALUES
(1, 490, 4, 1, '0000-00-00 00:00:00'),
(2, 4680, 2, 1, '0000-00-00 00:00:00'),
(3, 0, 2, 2, '0000-00-00 00:00:00'),
(4, 0, 2, 3, '0000-00-00 00:00:00'),
(5, 0, 2, 4, '0000-00-00 00:00:00'),
(6, 1350, 1, 1, '0000-00-00 00:00:00'),
(7, 86, 1, 2, '0000-00-00 00:00:00'),
(8, 540, 1, 3, '0000-00-00 00:00:00'),
(9, 540, 1, 4, '0000-00-00 00:00:00'),
(10, 2500, 3, 1, '0000-00-00 00:00:00'),
(11, 0, 3, 2, '0000-00-00 00:00:00'),
(12, 0, 3, 3, '0000-00-00 00:00:00'),
(13, 0, 3, 4, '0000-00-00 00:00:00'),
(14, 0, 3, 5, '0000-00-00 00:00:00'),
(15, 0, 3, 6, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aId`);

--
-- Indexes for table `bank_transaction`
--
ALTER TABLE `bank_transaction`
  ADD PRIMARY KEY (`btId`),
  ADD KEY `walletId` (`walletId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `medId` (`pwmId`),
  ADD KEY `pId` (`pId`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chatId`),
  ADD KEY `docId` (`docId`),
  ADD KEY `pId` (`pId`),
  ADD KEY `icappId` (`icappId`);

--
-- Indexes for table `chat_attachment`
--
ALTER TABLE `chat_attachment`
  ADD PRIMARY KEY (`attId`),
  ADD KEY `chatId` (`chatId`);

--
-- Indexes for table `chat_msg`
--
ALTER TABLE `chat_msg`
  ADD PRIMARY KEY (`cmId`),
  ADD KEY `chatId` (`chatId`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`cityId`),
  ADD KEY `stateId` (`stateId`);

--
-- Indexes for table `commission_rate`
--
ALTER TABLE `commission_rate`
  ADD PRIMARY KEY (`crId`),
  ADD KEY `userType` (`userType`);

--
-- Indexes for table `commission_transaction`
--
ALTER TABLE `commission_transaction`
  ADD PRIMARY KEY (`ctId`),
  ADD KEY `crId` (`crId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD PRIMARY KEY (`daId`),
  ADD KEY `cityId` (`cityId`),
  ADD KEY `pId` (`pId`);

--
-- Indexes for table `disease`
--
ALTER TABLE `disease`
  ADD PRIMARY KEY (`disId`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`docId`),
  ADD KEY `cityId` (`cityId`),
  ADD KEY `dptId` (`dptId`);

--
-- Indexes for table `doctor_active_time`
--
ALTER TABLE `doctor_active_time`
  ADD PRIMARY KEY (`acId`),
  ADD KEY `wdId` (`wdId`),
  ADD KEY `docId` (`docId`);

--
-- Indexes for table `doctor_appointment`
--
ALTER TABLE `doctor_appointment`
  ADD PRIMARY KEY (`appId`),
  ADD KEY `wdId` (`acId`),
  ADD KEY `dptId` (`dptId`),
  ADD KEY `pId` (`pId`),
  ADD KEY `docId` (`docId`);

--
-- Indexes for table `doctor_clinic`
--
ALTER TABLE `doctor_clinic`
  ADD PRIMARY KEY (`dcId`),
  ADD KEY `cityId` (`cityId`),
  ADD KEY `docId` (`docId`);

--
-- Indexes for table `doctor_pharmacist`
--
ALTER TABLE `doctor_pharmacist`
  ADD PRIMARY KEY (`dophId`),
  ADD KEY `docId` (`docId`),
  ADD KEY `pharId` (`pharId`);

--
-- Indexes for table `doctor_pharmacist_type`
--
ALTER TABLE `doctor_pharmacist_type`
  ADD PRIMARY KEY (`dptId`);

--
-- Indexes for table `doctor_qualification`
--
ALTER TABLE `doctor_qualification`
  ADD PRIMARY KEY (`dqId`),
  ADD KEY `docId` (`docId`);

--
-- Indexes for table `doctor_working_day`
--
ALTER TABLE `doctor_working_day`
  ADD PRIMARY KEY (`wdId`),
  ADD KEY `day` (`day`);

--
-- Indexes for table `instant_cure_appointment`
--
ALTER TABLE `instant_cure_appointment`
  ADD PRIMARY KEY (`icappId`),
  ADD KEY `dptId` (`dptId`),
  ADD KEY `pId` (`pId`);

--
-- Indexes for table `instant_cure_doctor`
--
ALTER TABLE `instant_cure_doctor`
  ADD PRIMARY KEY (`icdId`),
  ADD KEY `docId` (`docId`),
  ADD KEY `appId` (`icappId`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medId`),
  ADD KEY `disId` (`disId`),
  ADD KEY `pharId` (`createdBy`),
  ADD KEY `updatedBy` (`updatedBy`);

--
-- Indexes for table `medicine_dose`
--
ALTER TABLE `medicine_dose`
  ADD PRIMARY KEY (`doseId`);

--
-- Indexes for table `medicine_rating`
--
ALTER TABLE `medicine_rating`
  ADD PRIMARY KEY (`medRateId`),
  ADD KEY `pwmId` (`pwmId`),
  ADD KEY `pId` (`pId`);

--
-- Indexes for table `medicine_storage_type`
--
ALTER TABLE `medicine_storage_type`
  ADD PRIMARY KEY (`mstId`);

--
-- Indexes for table `medicine_storage_unit`
--
ALTER TABLE `medicine_storage_unit`
  ADD PRIMARY KEY (`msuId`),
  ADD KEY `mstId` (`mstId`);

--
-- Indexes for table `medicine_update_details`
--
ALTER TABLE `medicine_update_details`
  ADD PRIMARY KEY (`mudId`),
  ADD KEY `updatedDisId` (`updatedDisId`),
  ADD KEY `medId` (`medId`);

--
-- Indexes for table `medicine_update_permission`
--
ALTER TABLE `medicine_update_permission`
  ADD PRIMARY KEY (`mupId`),
  ADD KEY `pharId` (`pharId`),
  ADD KEY `mudId` (`mudId`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notiId`),
  ADD KEY `visitorId` (`visitorId`),
  ADD KEY `id` (`id`),
  ADD KEY `userTypeId` (`userTypeId`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`oiId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `order_medicine`
--
ALTER TABLE `order_medicine`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `daId` (`daId`),
  ADD KEY `pId` (`pId`);

--
-- Indexes for table `order_pharmacy`
--
ALTER TABLE `order_pharmacy`
  ADD PRIMARY KEY (`opId`),
  ADD KEY `presId` (`presId`),
  ADD KEY `pId` (`pId`),
  ADD KEY `pharId` (`pharId`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`pId`),
  ADD KEY `cityId` (`cityId`);

--
-- Indexes for table `patient_medical_record`
--
ALTER TABLE `patient_medical_record`
  ADD PRIMARY KEY (`pmrId`),
  ADD KEY `docId` (`docId`),
  ADD KEY `pId` (`pId`);

--
-- Indexes for table `patient_medical_record_details`
--
ALTER TABLE `patient_medical_record_details`
  ADD PRIMARY KEY (`pmdId`),
  ADD KEY `pmrId` (`pmrId`);

--
-- Indexes for table `patient_report`
--
ALTER TABLE `patient_report`
  ADD PRIMARY KEY (`reportId`),
  ADD KEY `pmdId` (`pmdId`);

--
-- Indexes for table `payment_doctor`
--
ALTER TABLE `payment_doctor`
  ADD PRIMARY KEY (`pdId`),
  ADD KEY `docId` (`appId`),
  ADD KEY `pId` (`pId`);

--
-- Indexes for table `payment_pharmacist`
--
ALTER TABLE `payment_pharmacist`
  ADD PRIMARY KEY (`ppId`),
  ADD KEY `pharId` (`orderId`),
  ADD KEY `pId` (`pId`);

--
-- Indexes for table `pharmacist`
--
ALTER TABLE `pharmacist`
  ADD PRIMARY KEY (`pharId`),
  ADD KEY `cityId` (`cityId`),
  ADD KEY `dptId` (`dptId`);

--
-- Indexes for table `pharmacist_wise_medicine`
--
ALTER TABLE `pharmacist_wise_medicine`
  ADD PRIMARY KEY (`pwmId`),
  ADD KEY `medId` (`medId`),
  ADD KEY `pharId` (`pharId`),
  ADD KEY `msuId` (`msuId`),
  ADD KEY `doseId` (`doseId`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`presId`),
  ADD KEY `medId` (`pwmId`),
  ADD KEY `pmdId` (`pmdId`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rateId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `pId` (`pId`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`stateId`);

--
-- Indexes for table `symptoms`
--
ALTER TABLE `symptoms`
  ADD PRIMARY KEY (`syId`),
  ADD KEY `disId` (`disId`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`userTypeId`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`walletId`),
  ADD KEY `userTypeId` (`userTypeId`),
  ADD KEY `userId` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bank_transaction`
--
ALTER TABLE `bank_transaction`
  MODIFY `btId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chatId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `chat_attachment`
--
ALTER TABLE `chat_attachment`
  MODIFY `attId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_msg`
--
ALTER TABLE `chat_msg`
  MODIFY `cmId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `cityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `commission_rate`
--
ALTER TABLE `commission_rate`
  MODIFY `crId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `commission_transaction`
--
ALTER TABLE `commission_transaction`
  MODIFY `ctId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `delivery_address`
--
ALTER TABLE `delivery_address`
  MODIFY `daId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `disease`
--
ALTER TABLE `disease`
  MODIFY `disId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `docId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctor_active_time`
--
ALTER TABLE `doctor_active_time`
  MODIFY `acId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doctor_appointment`
--
ALTER TABLE `doctor_appointment`
  MODIFY `appId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctor_clinic`
--
ALTER TABLE `doctor_clinic`
  MODIFY `dcId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctor_pharmacist`
--
ALTER TABLE `doctor_pharmacist`
  MODIFY `dophId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctor_pharmacist_type`
--
ALTER TABLE `doctor_pharmacist_type`
  MODIFY `dptId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctor_qualification`
--
ALTER TABLE `doctor_qualification`
  MODIFY `dqId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `doctor_working_day`
--
ALTER TABLE `doctor_working_day`
  MODIFY `wdId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `instant_cure_appointment`
--
ALTER TABLE `instant_cure_appointment`
  MODIFY `icappId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `instant_cure_doctor`
--
ALTER TABLE `instant_cure_doctor`
  MODIFY `icdId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `medicine_dose`
--
ALTER TABLE `medicine_dose`
  MODIFY `doseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medicine_rating`
--
ALTER TABLE `medicine_rating`
  MODIFY `medRateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medicine_storage_type`
--
ALTER TABLE `medicine_storage_type`
  MODIFY `mstId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medicine_storage_unit`
--
ALTER TABLE `medicine_storage_unit`
  MODIFY `msuId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `medicine_update_details`
--
ALTER TABLE `medicine_update_details`
  MODIFY `mudId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `medicine_update_permission`
--
ALTER TABLE `medicine_update_permission`
  MODIFY `mupId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notiId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `oiId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_medicine`
--
ALTER TABLE `order_medicine`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_pharmacy`
--
ALTER TABLE `order_pharmacy`
  MODIFY `opId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `pId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patient_medical_record`
--
ALTER TABLE `patient_medical_record`
  MODIFY `pmrId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient_medical_record_details`
--
ALTER TABLE `patient_medical_record_details`
  MODIFY `pmdId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patient_report`
--
ALTER TABLE `patient_report`
  MODIFY `reportId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_doctor`
--
ALTER TABLE `payment_doctor`
  MODIFY `pdId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment_pharmacist`
--
ALTER TABLE `payment_pharmacist`
  MODIFY `ppId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pharmacist`
--
ALTER TABLE `pharmacist`
  MODIFY `pharId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pharmacist_wise_medicine`
--
ALTER TABLE `pharmacist_wise_medicine`
  MODIFY `pwmId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `presId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rateId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `stateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `syId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `userTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `walletId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
