-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2017 at 08:10 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edustudio`
--

-- --------------------------------------------------------

--
-- Table structure for table `affiliations`
--

CREATE TABLE `affiliations` (
  `affiliationid` int(11) NOT NULL,
  `affiliationname` varchar(100) NOT NULL,
  `personid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `affiliations`
--

INSERT INTO `affiliations` (`affiliationid`, `affiliationname`, `personid`, `status`) VALUES
(1, 'The Sovenance', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `batchid` int(11) NOT NULL,
  `batchno` varchar(30) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `dateStart` date NOT NULL,
  `dateEnd` date NOT NULL,
  `datestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`batchid`, `batchno`, `status`, `dateStart`, `dateEnd`, `datestamp`) VALUES
(1, 'Batch 1', 1, '2017-09-22', '2017-09-23', '2017-09-22 10:58:52');

-- --------------------------------------------------------

--
-- Table structure for table `batchpayables`
--

CREATE TABLE `batchpayables` (
  `payableid` int(11) NOT NULL,
  `paymentid` int(11) NOT NULL,
  `updated_amount` decimal(10,2) NOT NULL,
  `payer` int(11) NOT NULL,
  `batchid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batchpayables`
--

INSERT INTO `batchpayables` (`payableid`, `paymentid`, `updated_amount`, `payer`, `batchid`, `status`) VALUES
(1, 1, '2500.00', 1, 1, 1),
(2, 2, '5500.00', 1, 1, 1),
(3, 2, '5500.00', 2, 1, 1),
(4, 1, '2500.00', 2, 1, 1),
(5, 3, '500.00', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `batchscholarships`
--

CREATE TABLE `batchscholarships` (
  `bscholarshipid` int(11) NOT NULL,
  `scholarshipid` int(11) NOT NULL,
  `updated_discount` decimal(10,2) NOT NULL,
  `batchid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientid` int(11) NOT NULL,
  `personid` int(11) NOT NULL,
  `payableid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contactpersons`
--

CREATE TABLE `contactpersons` (
  `contactpersonid` int(11) NOT NULL,
  `personid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `educationid` int(11) NOT NULL,
  `program` varchar(30) NOT NULL,
  `major` varchar(30) NOT NULL,
  `semGraduate` varchar(30) NOT NULL,
  `yearGraduate` varchar(30) NOT NULL,
  `school` varchar(100) NOT NULL,
  `honors` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`educationid`, `program`, `major`, `semGraduate`, `yearGraduate`, `school`, `honors`) VALUES
(1, 'BSED', 'Programming', '8th Semester', '1998', 'Asian College of Technology', 'Cum Laude');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `enrollmentid` int(11) NOT NULL,
  `sectionparticipantid` int(11) NOT NULL,
  `scholarshipid` int(11) NOT NULL,
  `payableid` int(11) NOT NULL,
  `datestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `jobid` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `company` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`jobid`, `position`, `company`) VALUES
(1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `participantpayments`
--

CREATE TABLE `participantpayments` (
  `p_paymentid` int(11) NOT NULL,
  `sectionparticipantid` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `due_date` date NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participantpayments`
--

INSERT INTO `participantpayments` (`p_paymentid`, `sectionparticipantid`, `amount`, `due_date`, `status`) VALUES
(1, 1, '2334.98', '2017-09-22', 1),
(2, 1, '2334.98', '2017-09-23', 1),
(3, 1, '2334.98', '2017-09-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `participantid` int(11) NOT NULL,
  `participantno` varchar(30) NOT NULL,
  `personid` int(11) NOT NULL,
  `educationid` int(11) NOT NULL,
  `seccourse_status` tinyint(4) NOT NULL,
  `seccourseid` int(11) NOT NULL,
  `job_status` tinyint(4) NOT NULL,
  `jobid` int(11) NOT NULL,
  `religion` varchar(20) NOT NULL,
  `civilstatus` varchar(20) NOT NULL,
  `datestamp` datetime NOT NULL,
  `createdby` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`participantid`, `participantno`, `personid`, `educationid`, `seccourse_status`, `seccourseid`, `job_status`, `jobid`, `religion`, `civilstatus`, `datestamp`, `createdby`, `status`) VALUES
(1, 'P-0001', 3, 1, 0, 1, 0, 1, 'Roman Catholic', 'Single', '2017-09-22 11:03:39', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `participantscholarships`
--

CREATE TABLE `participantscholarships` (
  `p_scholarshipid` int(11) NOT NULL,
  `sectionparticipantid` int(11) NOT NULL,
  `scholarship` varchar(50) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participantscholarships`
--

INSERT INTO `participantscholarships` (`p_scholarshipid`, `sectionparticipantid`, `scholarship`, `discount`, `status`) VALUES
(1, 1, 'Discount A', '124.12', 1),
(2, 1, 'Discount B', '135.48', 1),
(3, 1, 'Discount C', '235.47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `paymentid` int(11) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payer` tinyint(4) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`paymentid`, `payment`, `amount`, `payer`, `status`) VALUES
(1, 'Enrollment Fee', '2500.00', 1, 1),
(2, 'Misc Fee', '5500.00', 1, 1),
(3, 'Others ', '500.00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `paymentschedules`
--

CREATE TABLE `paymentschedules` (
  `payscheduleid` int(11) NOT NULL,
  `date1` date NOT NULL,
  `date2` date NOT NULL,
  `date3` date NOT NULL,
  `batchid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymentschedules`
--

INSERT INTO `paymentschedules` (`payscheduleid`, `date1`, `date2`, `date3`, `batchid`) VALUES
(1, '2017-09-22', '2017-09-23', '2017-09-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `personid` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `age` tinyint(4) NOT NULL,
  `email` varchar(50) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `photo` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`personid`, `firstname`, `middlename`, `lastname`, `gender`, `birthdate`, `age`, `email`, `facebook`, `phone`, `barangay`, `city`, `province`, `photo`) VALUES
(1, 'Jovan Rey', 'Dacayanan', 'Reyes', '', '0000-00-00', 0, '', '', '', '', '', '', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMYAAADGCAYAAACJm/9dAAAgAElEQVR4XtS9WY8kWXYm9tluvrvHmhGRe1V19U5STQwwGgkDSQA55IyoGQgD/RG96lHPGm4YEXoWtAxJCfoJggRRwGjIZrO7qyr3zNgjfHc3t92E79x73S08I4vNeZpxMrsyI9zNze4963e+c671T/74f6/KskRRFLAsa/3HrgCrAkpU8jPbtuVPVVXgi//l5/jie2xYKFChKPmvSq7H3/OzjuPIZ83n6v8tKxtFBXn/+tqWvBVZqX7Gz3qeJ9fJihxJkiLL8/W18yJHVhTqOyxLPmP+8Dopr2MBlW0h5+cqyLUsWCj5OJUtz1A5FoqqQpJnsGwHjmWjzAu5F5vXtSDPJ9dwHVRlCZvXsSwUeQ65VKXWi3/SNFWfte31WtWfne9R66fWzDy/XijoZQAvzL/f+T3Kze/Vcq3Xt/7sd77vvutwAbheUN+x/k59Z/wPb9PstdyDetD1d370mZLPkpsbkv9yrc39c/23n6eyKEOAW9ooLQu5YwMOf1aglWcIL69g3VygjQwFIhR2hiLKkccJsiwT+VH3evdutv9t9rO+Xtufkz383T/8c3lC8+DmQvJL/fCWpZSC38kfma++u1FAyQWsSpSVUoy6kNynGGoDgby0RODqm0hR4QPDtkT4KMh8FRUFs1DCadtwXVf+TkWxXUeeg99v7o2f47WotLy3vChlY12HqmyhKEpUlVLqkgIsyl2ggAWbzy1yowRHBLyqRDkr/Zy8B64ZlcQohll0uUdtGMwa8/7WAqI3kULBe7sjxHUh1YJ4V3H4/o1w1nTjjlH4lRTDKPQnFMN8z1rh7lGMzb1RbviMSlD1Q8lam3v5pGLQYFExbAuFY/EfohjNJIZ/cQl3eIO2lQFuigwJ8mWOIknFABnDfud5a0pi5LrItMLWF0z/XfbRyPzv/MGfyerWFcIsADedllKEs6bxFAI+3EebYVuwbFrhjTcx1zZfWrfmyutUoFHWNyGCvfZGtrpRETkjRFQ6Cj8tHb+v9nOKL8VFLLi+DhWDi0aFosU3BsCxtaKV9GwWCv6OisLro0RObwALjuXI81DIHe01c1onR3lPCvRaYPTC1oW//vxyXzVPWvcYlJv657ju4qXEQisrbQyNUrL8jtXe3udtryH38S0ew3z+riU3SrzZ7LrHkPuvRRDqGiWtIyxLKfr6usbAiMG965lEz+QBLbil9swuULklXKtEaxXBOTuHO7xFy8pgezlWxQp2BhRJJophohMxjNrI1uXa/P3bFGOjxxWs3/6DP62ozSK4cnPGQqoQRh6em2Tsk7ylgiXuUv3daBn/a2vlEIXiMulN5c+VIFViXdeWHbTC6n2ymbwu11tbw0K+hwutBD43iiEbohRRQgF9L/JGWhztsUQxGCoynOIzSOwE/Tl6IPVN3EbauJxepSqRFSo8ZDhF72CsP6/P0C0IAuSlMgCVuTYVkz8TPb6rtGZjjPDXXTxDKVCQZM3Us4i3Fs9bioKo1eQ19f6oGPAeu6d+9O+TYogKyYPZcAvuf4XSKVF5FVwUCKMlnA9n8IY3aDkFnKDEKl/ByioUSS6KYWTwPqNUX6TtUOq+BRR5+63f/1fV9iaa0IECaiy1vEcLlRLESm2WDk5NDOnQBWqrXc9ZREm0FTdWU2k2LYSyyus4Vn+v8Rz8nbkWhZbCIrdSCyfNPesvR67zE1EM+YzKoWQB5fNK6MT7UGlpsS1be45K8h7PcsRL8D0mX5BQKkvhB8E6xFovLq8jnlU969p6aavquO4da6aWT2UYNKM0Hkao+YDGgIjh0l9iBF6UZSueXn/23zvFoNWj6bXg0NtwVZwSpVvBR4ZgMYf1/gPc0S26HuCElShGEWXItxRjvT46p62vkew/Q+l7XnfCVN4JPcb2+2RDdVxemQ2oJV0SSjEG13E3v9DkELb2IMbtUzAlztdKwZ9vKwYsV4U6JqHTVn8tXDXF4M/oNUT46t6qJjj8q0nczXeXJRWDzsQRVy95hFj3SpSBz1lYlniOnMKqXb6DLcXitfNMwABRZm3Z14soAIUCE0p6rS0jYZTfrJfyZAzz7lcMY4DWPkPvB/fgUxtcD1fr7/l3NZQSGIGhbUXF4L+0Yngl/CpDMJvB+vAB/mSEnm/BDiosswjFMkWW5JKLGnkzz76tEOt1MMZ9a/H+VsUwF+Z2ZQYOESuo8grZEB0qiGJILKxyEVo1Gr16jFdHpOr5w2bzKKcKseIFjICJBddexHgMYxEl7CJixARYJ73mOUVQTSyPSpRSCWkuFtl1XGWVJRRWYZugYhZzCxVapfq6JcMYHfMyBLOYsFuWJPqu58pmqDBto9RKWe5HR+rhjUH4NoqxlXzrOFzWUoeYvG+DDqoQ7n7lMOv00Wb/O5pj1BXDlUiECGGJ3C3glwm8yRj26TmC2QSD0Ab8EvN4gSouxGPcpxj1fMxEMPLfT0Sf9b2R6IShVP2Da8VgwqlNjIi8FlLJI2oxjMJ2NoJAj0HBlJxAZyaC6IirrOcl3FgN+zKetwl7KsttEB9+jiHRWmsYexpZoGIwcSf6ofK2Taikk2+BkTVUmueZVgyVdOdFBQo+b56JNhE1fjf/K7AzN6hUyTdfCg6kR6kkrCIaJsm+5Cj6melNmOgzcXcJUTviPbhx9B4MpczLKIbyKnwoKpfyVPJirga1JkWWCvqCLKbVgQA2ngfL5j3YykhIjiiLrrFQdT19sY19NEn8+m0b9FHbphoszPvR1zBxs1gUBdea5FvuWOJuvpQiK9+7eYlRNSH4VvIt7xSPYcMVqwKUbinhVJCvJOm2z8/gL+boNR3Ybon5coYqKZGlmUIva7B43SAYz7H+76+qGL/9L/6Xqq5dm4vacD1fxeG0uBqnXcNeBo5lLEckSlswV8d2d7RU1mydvstDqE1j3kKrzHoHIWGur/YE9Fh5AZFL25WPMxzKc+WxHApFTVkledbmgMokuQPv2VZ1FN6fwboNqMB/U8htz5XvdxwXRJySJJGaR+gGa+Vdo1sUTA0dr1KFofN6Dq8htZwSGXMaqeVsciHeHz+n8g+V5/DlssZTVLDyHKWt60Kst1DQqVi879US1XIGTIdANEOIAkGzDavZRRU0kTkhci9A4ajwjr4eFQFn9VorjFp4/UNdj9i2ojR8WohVUlzCazWRLWaweP9xLO6Wf2eUoAIfo1Lm+tTmQpTYvAi5i9qYiOOO2vC2CrgMpeAhozFzqf0ZekUG//wc8dlbNMoYllsi4D6nfEYLWar2y3gNDTbqqEXV0cx+i5zr6KSuPHU5Wr+fiqHWa6NK4krE3uuwQyBMlRybsEYuZmBUjThR0EzsXFeM7b+b7+J/3bIUKyHgEv9HYFMdRtEWaxSGeYB5VbT2mbZYfK9JWi1IcU6KfDoUM1CgCXvEmjHv0cVKSco1hsBQq8gLxGkC13Lg+6EUZ5j/0PrzvVQ6PmOSJgqts2ypp1D8JKxiSGZRCenNmDsQOXMYA2klYmHRVmGQJJoQQbTlvfRcKudhvlMQlGCin+fwsxXc2RD55XtEN5dSZ/H6B2gePoLd30MStJDoIissCQqlniBeu1LrYZC+jXJsFGUdYmjFECEWC2RJMbOcjmH7vtyvS4XIc3l+7esYtNYKXOJi71cMXYi7C6ip2gdNi115SFk8pR45JXpxBP/sFPnwDE2vgsW8g0Z5GSOJMzGepo4hgm8ruVAytlEMI+OOtZHptTyZkF0XpEX+f+cPVCh1B0MnTEtLUGyQDwkxTJhAodLLrBZcveq5RV0ZttGTumIw2fKMNxJUR11P/AkFVYcXqjasYmyjGMoa6iRcf0ZBn0YQtIJRQCjAvFedcKvIQAUxtGxS4eczl4RqC3i0iI6nC4DqCevIWb22YuokEraZIqSERtoD6uQrz1gpt8H/k4iDxUWJQmgA1nCHUi75ShtVmqJRWWgXKcLFGPn1KRZXZ1jM5iibXbSOn8LdP0LSaCOhh/MYkrDGQcWgwFHYFOJDhdVPfLd6rYEGY/cN+qieWoWjebyEy3C3yOG7DpI4FmSOAAaNZm4Uw9Q2GALXjK0JHSsqxkfhDBeqgAMbTuUhc21hIcAp0F0t4Z1+gDW9QadpobQLOCzozZeIlokUbA1II3JlKWVQYZtCIo3H4PuMYtSdwbbHEMX4vX+pKCHE6evKoQSJVRaN1Wvhrz+TsUIb76y9iH7vdny37b54bUf/kYRLewVaWZOIS+yvQ9i1QhV8flMXKde1CG4Q0SKBZ8W7KcGjRgg6pivUDJdMpVoWQarvhmKhLD8LgFSVLFM5zjqE1goiYRGVoCyQMoeg5zN5B59FezEKOBEyyTsk8dd1FyX5UidJrBKJxWo62QK6YMhvLyz4AJq89nyK8voc1uQGmI0RrVYo/AaCgxPg4Ahxq4+s0YDVbIqXMYphl6zeqwiAYZ6CGExBTSej9fBKGwxZthIo8gw+77vMRSlC38MXz56JgXnx8oUohkDocJXnFi8iWn+XNmIKsfcqBt9fimK4lYuMoS9DKTtDL17BP/sATK7R9PldKawkRr5YIU1UiL8BcoSMtIksaophDLdNBTayvFWcNCmFyMQ//ZP/o5IQIc/XMKr6HIXJUwUrjbrIB3QIIlppik01mJVCaV6f8hRrbRW3Xcof6sQ6rzZFOl5LFxjNd8m9CIzEX0mqL3mEUVjmCxR8FuHEgwlEriv42h0p4VPJOi04hZM0D4P+rP9OYZJbUDmUFBN1Mk/3zWSaysBXqr9PvcUWGgvvOWMNJM/lfrieEtJROHj/DB1cBysUWFUZLChLLzG8hFcWnLxCh4o7vEby4Q2s6TW8eIksSVB6AYLjR/AfPseis4OVH6BoNFAxzOG6UsErG05BH0XFyLXX0L7AeIoahWZd+ZbvZy1HFTlRpBIePT45xj/+nd+RNfkf/uRP5PmMYsheObY8Kz1g/bW57ia32fxeBWR8XipGLorBfc3Rj5fwT09RDi8RuAWSIhaPgVWmAJRaGCSWv1I0HOU1Nvw/I3PMMT4y0FuGXKT/d//wT8Vj1LVuLbiCqtyfxptcwrgxcZW6cnwfhnzvzcjiMxtVvCpDZaMA1hVPqtN1tIZrm2+sstZjrSSaqlHzGPJZfhcttOY7SS1GCzA3jcpkaBjiUSTMUiEI/z/VHBs+J5WApEHjiahc8uzka+nv4Gd430IzES4U0axsQ2GhYdPKmdolRVZCHxskOSqr5/D3aYkgSxFfXyC9eI/Gag43XSKZz5CUgHv4CI3PvkQ82MfMbyALfB1fVrDLSrhHnighi5eZhCKC4qn/Ua8t0uVGiAArL1Fl6p6qIsdOv4ef/Ae/jsV8gZ/99c+QVYUCGeCgYgjuOMgLAv2fUAzlrj4iK/L9osSVIx6j4sPbBfrRHM67N7DG1wg8wgoZ3LyAQ29BU8LwXht2Bd1rj1gLpTahFddXeYz75PGO3H4Klarj8eYDRnmMRpovMC7I5Ad3oNM7duMuVYGfk83X8bgOfNSi6eq3FODuoBsqmTT7avKaOmxa/0pdHVAWeE2puEuaNOxRQcbI6tTULOFNCXxoNlvdPzeeVysk9FEeiV9AB0cVYcim7rsSGNVAwXmmLZhsjFB11wmx4zCMKFDkMcoiVUk5LIS2i3I5x/L6AtHZW3irCYJshTJaICYi091B+Px7KI8eYx62kYUN8WoSmhQEN0izYLjI+DxDQeRrq/bD9arnh2uhYe4tGs7QkvB2Lkas1Qwxm80QeL6EoBK6Vq6sg/KuBoLeKJ6hCCkjteU1uHbaS3r0GEz27QKWnWOwXKB8+Q2c+RhN1jDoSZIETkpkzJWaEr03jZIyrtqoibGvh1XKCtRDqW0FuePh/tHv/693XMI6jpf4+X5vIXJbI+/dkX3NUDU/2/Y4RrnWVkmQeGVGtr/NfLZue9TPDFi/0Xzjb+oPKwqrN0uUTT/P9j3VLUr92YQ8yIo5USWDjgnpUNFSFGVGPanc41rRN+THXKI+lXu5jq9ACyGHGT4UhB/kM1zJVhgPr7GYT0B00/d89DttgSedJMLkwyukwwu4yQLFYoYkyTD122h89n34T77EvNFGGjZEGYWqz5i9tGDlumbjKE5WfQ8MCri9X2s5oGcVJESFeBLmiSEzgITmy4nEarBGRwF1uaCxWO+NDs/Xay0IIsPLEp7loaBiMJ13cuyslsi//hpeNEGDVW/fQbpYwk4LOJ4v+R3h2nXbgg7h1DNKweXO824rxvZzr/NiKsYG3qoLmjHM5sK6XEzLK/DkhlkprlhbeSad9YRoE+/dFft1hKYZqnWB/JRSfZuG153zJoFVVzIFyE1UqAqNJpaQXKVOSdE3YCj0/L3KY2qQta7dyIboKzFMUzCZWjNx7Fox+H2sk6iv1RVJepiqgldYaJQWkmiC07evML46E2TJCXz0ez0c7g6w3w6wujnH7PIdsskQyWQo4d3UbaPx7HvyJ2r1kYchEt1vwpoSIVDmZETACGUycRCLbvZMm6R1KG1uT5spcZhaMSQ8EkBDP7FKwPRqeevQTH5C71J73VEM+XgtPBavSni3gsck3rFR2DkrGhislsCrF/CXU3hOJblHtojgpNI7cEcx1GYrVEoJ+Mcpgqlj3Lm5Wmi1Vozf+u/+Z71XdwVXwhpTHzCGUbtA+eK6YhhB0mgM4746J6iueB8l5FpQ1Fop4tzaWpnq6j18ozr/vh7arZWnBgjUv/8+5ap7jHquZSrba+U2QlR73nV+pn8mJoPyY3IMOgdTUxEXo9dZw22ERv3KRpM9IckS1+dvcXt5inQxQ5UnsF0Pe4MeDvptWNEU6fgK6eQayWwqUOXC68J/9AVaz3+AvLOHvNlCJpV/Cloh4RiBAEHMdJ8Ef2eoJibUVIpsmNXKaGj51RaSCbVBfXQ4RBBBjAYNAhFMZRTEEK0ZC2phBBFco1+b+okxT4V4JCAoPeQeUDgFgipDdzaG/fY1wtUCLrswrBzZImHtD3BtUQxDO1fX2kC0ylvcladf2WNsF/jWLlIKbTodFmRCUz907CBhikmi9AMzomOBSigWOi8Q5KfW+XcfUmVyCyO05tpr7HsrOaznOkbz66GdiXCMQEvl21DetyA646nqymiuX0fj7sC1sv/KMq1hZf3MUgBjsKHXT+Etai0LxlX6RcslIaTulGSUU6VLxNMhkvkIMUOlxQLxfAGkMZpOBT+PEOYrIJ6hSGLyQjB3WvCOnqP3/Ieo+gcoGE6xtmBqI4LKmT1QRUVVqK3RT3TtxXgRgwDKrWqQQAJCCcNUeCJUEaF+KIhWFENTfAS13fLAxmPINWucLfOdVAx6Zq9wUEgvRgGvTNAa3cJ581rqOHaVYlWlohh2WopHpWLUO/jqHkPB33fbIup1jLrXMPu/9himwFcXDH5ACnqmDqA1vk5/NuZkTc2R6riiZZhQalto77sRE3IYAV1/RvOr5Pc1CrepP9Qr7PXrGsduwqe6tTe5ygaR0bClio7XHYqbxdSLqhGzes4ogqGhZFEOUyRkFV9XoKX6rhVDPIi0yaoVW68lPYXuhbGzFbCawWavQZqgXEWY3gwxvbxEPhvBWk7QtUmsY/9BBvgh5lYT7t4T9J//EO7gCEWzjZjVfM8GPBuVXSGrclWnKRQELGU+k4CvcyTD+6plewpmVL03ohiqFUyxgRWcKyCIeHoWFtXfVaJdY0uLcb8Lk5rGt3XISUtvu/ByegsAPkPMFYLrS9hv3mCHFe0qRVykSJcJrKSE1wzWyfcaPLiTY9TapbWC/MqKYZLvekIqD6qrteuYWIc8BmI0G2s+R+unKqBK2AxubUIkgUmNq65ZbRFcU0nfLtZoPlHdy/B75DomKqnHqprtWw+X+P1imXU/uEmit5X03nBMsYzuUObFaOgQb63UOmUQZaVFZii5LkwqyJb3YXo6FHiqqJj8OQW5ci00SL/IqBQx7JykwQTVKsH49D0WF+dIr8/QKhM0kQm8W4YhllUId+chBs9+CH/nBGWzjcxxUdgVcpsCnAnFRJJsLeSkm20SAk3DMXtSKwFSiSoWOM2+rJVCmRghSRKEYD1BgA0Fo6i0Y41RqqXWuYjA8zoUJzytjChLJIoJTSStYEurD3h5BPfiHNa7tzjwXeUxygyr5QpVWiJshOIthKSp6RwGXFDefkOkXHsEw+SuC8C9Oca/+J/uhZ7UY91lztbdTT0WV4qgFtjkYndjdbVQ931RnVJSF2jz920Xp7zH/QjWWkkN/UPj9aQySBOQto4feccaR8Z8r1nobah6/R2GLGnQFtOSq3vCmWfxsywCrnMYjTGrrkemAJqcSYPCAiFhUeYDUlUvUFI50hXK2QiLD2+xePMS7mSEME9QeEDqOYgrH173EPuf/RiNw8eYsrel1UJsUbjYTZKjJNFR+j1cAeYohAKPmjCXHDOSKYXISVqMBEu6yOuKOhAONV5d7bViRxMu5XOsjRc9plCKdMilUSEJZaXtle9VAySoeKJgpY2gDFBmpYRQHHTg+0CrSFCencIfDjHg2uUJojJClGeIswQ+axKZgmvNfqlcSjGg60yOdUSic5+6sa07BWMgrd/+fZV8b78kj5LeXROcqHeIq6xN/Ni+qOo03cR1dYRKPn/3cipfq6lM/Xp1RTH3sa0Y24mzeY56wi2VaN02et+z1n+2rTR1xTDv43vu8zD8uUwRMRQQ3SPO95qNq1/fhIikBVFQWUNU1XUXOcMfUuXLBH4WYXXxAZMXv0R+fYFGFku/QmoDSeHB6+zj4PkP0Dl+hoXfRNZsYs57sCs4dgm7yEGGBS26eC/tHerPYFp3ZT9qE1sIiUrwlNearvSelVmuWdfWmpRJxEtCLKlNqDZVNexBAepsA6ZiqDYERUmxCxt+5lJngBConBwh+72XUyTv3iGcTjGQQniCVRFjWcaI8gQuE/BMAQlGLhWDedMMty2fLFKulURv6LbMybr8oz9Q7NqPFMMUt+6pWWxP/FgL48ZjbvFXajDwR4qheh/qSrB9o/UHqSvGp6x5XYBFHLYUY51g1bD1ujKb77vvZ59SLPNe4WjpCuH2/W1bKbOhjvReqOS8VNVRyQnyMgPKFA0rQz6+wez9SyzOPiAfD2EXMSyrQlZ6cJo7GDz8HP3Hn8Pa2cfC9bHg9VxbxfZFikL3LIil1uGrycNUVT4V4ZZyqw5DpLJPVjEFWhAoBYNK2GzGCGlazdpHEBaWcEl7RTKNdRXchE1SSNXuWwAcolEIVRXbKVA5KRpuBXs6xvLlSzQmMwwIQTO/KFJEVYIoi6Xne91urTemruzb+ycy9qsqxic9hlaM+75oWzHq7zEegzexTvBq0rTtMUwR7e+kGOsi3+bC9dBtWyDvU4xtId3+vLHy26HctmJseywVMmwKix+FnDVl3Fg6IaKLxRQuj553VVS0yCmsksnmHNVijMXlGW5ev0BBigQT8MpH5bbh9Q4xePI5eo+fY9VoYsneEtdRPRRlgSxNBSmS2U3SQ6NEk39omPh72VchVeqWXa1Ewn/T0YMUTCkbuuefzyfopS6eUunEA+r2YLYhC/1eT4TR5lrxxGrwLu+GLcWsXwApOoENZzLG7OVLtGYR+oS1ZdpLhlWZYJnG0r23qVHdLeTdFyqJp9dcvvv23xhEkeff+lSOoVs069b6PktuBEVRezdJtxF0WRATftUo6nWrTvbptpVXLmSTmdRDKdkE82WmICXKoqgGIqzrpFn1UpgKqDzPlnTX4WR5RkOdruP693DG7ltcCTjWJLbNZtVDu/qzMryg5ac62KWrWi9Lwr3szKuQWTnybCnK0bBKpPMRrl+/QPzuJezJUNoe8tJH6TbRODhB9+lzdE6eYOX7WFIopYkqUPlDSXK4rkGY4Xo6TTa9NLJf69xHsX/NXhpvswZUag1ghczaYhGTXkpFCNIeTehYh9aqV1/B/HJVKpskW/SWCVyX/dw0ErkohjWZYELFiGJ0qRgM58hELjMs0xVWS3pNtZtK8XSrcy1UrMuhhFsGHKqlCPdFBp/OMb4llKrHyetkZd3Oqra9binrsdq2x6h7ivv+vm2xhY6hpyNuK5NZHCOE9dhTFrBeZNIflo2qTWA031evw2xbfRPP1o3GutCnTJhcc3sa43oEjw5P1XVZkdYcK/KNVDFIvEZhW0iJKlWctBfDRga7SFEuxijevUT89iWW0yWKwkbGknDYhrd3gOMf/Ajo7yDzQ8TUA/ZpsMJOBaT1rnGlpGFLGxGZY8W9Mw1pmq+lcDU+E5uylHWTOo48x2a8kORRkpjLQ4gJYolRhkwQ4ZI8KhdPIaCn0E3ojXJ4RQrHKpBlMeLVHJ3AhZ+lmL57B28RoUWmrw7RSFxcxitF5NSvuueu15/M79c/+xaPcUcWGErVLZ/ZbL5JpvbVXttCU78pI1z1UGotUPWbr5lrI3zmhuqKUVe+7XuQJG7LKtcXoK4Yd+5xa1RmfTHr4SA/sz3ysX4/dcXYNgLibUwvxhYDYA0p1hTDjM2RAKqwYXGvJc9wUDqWFLQKm52DCco8hlXlaNsVgttzpG9e4vb0EnlCyJIjZSpYrTZ2v/gSvSfP4PZ3sbJcJCUJjxU82RyyZFUiLS25GkZnci2JqxTnDN5OJSFcK3MZlVLIAytuE8EZDpeg4hQZcyKycJUHlBxDlEJ6CeXvfD9zHfEWHE5BUIDjiaIl/GiBcjXHMppjFU3hWZx5UKCYz+CsYrB3kGwsdvYxdKOCUTHEi/E5dOuseKrautc9tfEY9cjnXm/xbcm33HuNRFi/mBGausU0ymXWbi0wNamW9+g31N1eXTHqgradK9SV1nT41R9MOui2JmesLXnN3Zrr3Bfe1On09ecz97VOmGsbccej6GadusfY9np1Q7SuEUpIYcFmdZxYu03FAGJWLMhvQo6UVe88RcsCdrMI3u0VLt++x+L2FukyQrRKUXge/P09DJ48R/PBCaz2AJXbQCbe2nsAACAASURBVMoFE9LtZsaWCSH5TEIb0QwBseZcS4ZHkqzqol1tMqJBG1XCTkPC66rRpQQTFNpIEMFMX9EDgAjtFjmsMpO2ZrssMD0/h3V9iWI2RpoqdnFZpuDEEOkHEWqLLgXQw+k1zgVitoTuIrOItZc20PIdq67/YcY7fWTQtmhH1u/8oWLX1gVM/i4X2pj3v6ti3LGwNY+x5l+ZAWsqYFWG6J44fvveJBzSGHnd4vN99VzBLIpYEAm/dH+EDp2MEhmlNM9vLFA9lPrIY+mcaduL1J/BXP9T17nzvJaKtTmqRwYSSgiiQimOMLZ8TXFn8a8qEZYlesjRTCIszi8wfP8O0e0N4miJhFY28OHt7qF9+BA7jz9H2N9HUqoBCxmTYgqkhpJp5Fgg42TFumHhOsi9E17VvdP1NTWW2QikMXQiNTIoWrFJ1LrL7qjQix4rjtByWTxMsBgOcfv6FfzRGPZyLqEUvQ1XQOY6i+LpFmAZjKemojBiED6vng5jPIahn29HQebe71OM+v6uw+r7UKn1hn9CMbat8ubCejqh/sHmOrWvrrsUozB6cl9dMT7Fk5INEzrGpundfG6bJmKEne/XTX/rEMJsvHkWs7FGMXhrdaHeXuhtd2ye0Hymfv9Gaeuh411DoKj37M2WsQqsZbGoJnSOEi7pHST+pQwpgKbjCXRppyu40RILVsbP3iOZjjCfTQSNysMmnP4O2g+eYvDgEcL+HsogRCTQq2rSclw1fE4GPMi4U05dVCxXYSPQW4jgfYzo8/lNaFg3MgIFy2xjpdzSA2/qX4ywihQu+9etEovhNcaXF1henqOTpLCjOQp258lcL9X0xRqewMUyKZJ0dIOlscNUGW6zZ3UP+CnFMKjUp/ZvrRgGlTIXql/wU6HUtmLUv2TTZHqXwr62NtoJ1WN6w5vZtq71EKUejnybYmx7HbOBDAjMnNq6VzCbu60Y2+HPWslqw6Lvc9Xfphj1ELSuGBK6UDA1GUs6Hkjp0BNHBLHiqJ/5HHYUo9/pwmmGWMWRjJexRtdYvn+FfHyN0fUFVkWG1PWQeQ2UzQH6R49x+PQLOIM9xK6n5gOv2cfqKWSgnGbl8u+KeEn+kgHp7iqH8dZmH+vPbckEeRVxqO4Npe0Mn6yM6Fol+cTVmxeIJyO4eQLMptKQxbZcdh5WzFd4BYZ0MjtCIXXCtdGdlUJq1PLEcEohozUW770bVJvCXvt9fb/lmeoeo64cKgTZLMa2ht2vcRuPsR1KyQ3XaCFGOOV9tQp7/XPbrttYh29TjPvQJPEY2qWbgWb1/OWOkG41YNXfZ5SH/+XQhb+rYnwq9hVMXzNTGaMXzAU4IUX6ZBliFfCrCqubEZaXNzjc3Ufr+AgX06GEU93VHOXle7jLMebDS0xmE0QVEMFFYjfg9faxc/IM4ckToDeQe+c6m/sx1WITo4uhlhxKkQc570oMg6FA6jVSa6MYX8If08RPlSeJVAsFRVGLiEDlcPIUQZlicXOB6zcv4BYJQqfCYnSDLFrAygtBnxiOiaPijC16JyoFJ56UrKPw3mg8SjEevDczCvY+A39nn7bo8HUZM/IlivG7f/SvZODaXdeu6CB3YNZa/L/9/vq/P0Kl6lq5pRhqQ0rVMknhEJ6OqbyqhzX3JXTndZ1E0/J0T/pa2B025WwsgjBbGetKPqsnWOgzB4RGrwc6qB5vZRnV9ECOx+BZGmquRj28WodMa6xcWcb1AmvyHIMi4634O1qztWJIDK1CABEmLrQeA8OinpD+XFsaduQIhqpC1/OxuLzGzeu3eHR4iPaTR/jl25ewpxPsWwWC2RB95MiiCYa3N5jEMaKCpbIAme3CbnTQefodtI4foz3oS3Kfsi5guzIsjrUkoxhsZyXaJNX4ilmJmqqi8/d1cbA+KNt4VNY9PGmIpYVXlXwz8I2BkE+4eDnD+MNrLC4/oOdacIoEk8ktkmQJK+PgNWnC19QSpRhKuTjxxNHjgAhD21I8rId0pmNTFSvvMV33KIbxMnyGdSj1T/5QDXVWIqA6MEQwOHJFzyPaVpptS24Uw1jyeiN83UVtuytlgVUkKiNz5EmUNVCbRKKbFliBABUGz6TLtTiNgnNm1bQSVbfiVEB1TVqrymEPGOFKZfuESEeIUSyPCh+k45BTzom4sxBYVsjilW7w4c8V6E6o0hS2ZL3M1BCdixjGrUJkVKVYhSyb3TFHCrCTjkUwxtIpGbRpDivjlBYlhDIYwffhNdqwHF9YsVWWYq/RwMXLb9DyHBw+PsQvX/wC09NzDGwH3Qo46nXRDHxcX57henSDmCcNlSXiVSIzsqrmDrydBxgcHaN5sI+y2UJiOVhxxA/XlAPVuB/SYkqFVERAWd7aAIU6NKM4UOolu6frWfw34duszFGRNWuKjFmJcjpDixXsd6/hR1MEZYyLsw/IpN+dcLLq9TAWfCPeBi5WBkXd3d2XclQ0snpMjk7ONyHfvY7+zg/lvXXFMA0oSrD1YDC9sffF7vUcQJRHfJ/hyXwchplr1CFRaVgXk8knUvNLTQzJk5M2imHafdTkQs4g4voRFecoSwo920FdGXOpiHyrrEJqubD8lnxHka5gF6WwMjniv8jVaBu74ct/+WWS7xSckqSeR+gQ5ibWXW0qKFThoVISHVKriFogY8VF59BJM7JfrKgZhiaTCzmtmycDrZAvI6TpEkIDsQC30UTY6cENWvDdEIFjY+D7ePuLn8EtUzx8cogP71/j+t0HBFkpBbAHuzsY9PqI4wg3t1eYTcei5HkSiydOrQbKoAuv30Pj4FD+eL0BirCJlczbZXuqGh/qcD05b1cL1h3J0TGVMLzqo3e0FyYB0nQjMRSToRIyftOBV1nwswJ9XvjmHMPXXyG+vUKyWsjxZMbL1r3tp0TZ5DH138utrVnD+vyUGhT7LXOw15dZK4ZYZz1UWEIbgeeU2zIR1H05xZ08QlclNSZ3B3qtL56xAvxO8RgiCKpKqqyrGge/+bdxb8Z6sXqrmoH4kLlprdQxLPIYPieRWxXinP0hHkpWfultikRoylZWKndPFIZbSPp2wWYexRxmIOBICMBBafoMPt1oU2cCGy+yrpVIHKkgToX98y7d9TR401pqZkclpDVES2SzOVKOw1ktlNdwLDhBE2G7g6DVRRg00Wk0MAhCfPj6FyjjBQ4O+hjdXuD6/RmqKEJIj7G3h8MHB4IiTacjDG+usJiMhYHKYnRSeUicAKXrw2l30Tp8gM6DEwSDAVLOAnb99cgfex2WbnAg1UdhCgrKjdRzD1M05H4ycSf9hPIvFJOMOYaFwHLQch3MTt/DXYyQsI+dPe4EEWrMbK6pGXBQB4TuKIGxRrUf3qcY9c/XPfinFE4U4z//I3XUmFKIWoeWNEro5v6/pcawDrXMWXIa3rs/QTfDFDS/xWKcq8lzooXk06vqL48AUy/+QJ0hIZVV9YWKiSoFH8adHNiVwSHpjnOGaH0YP/stxJWFlGzMKhPrPL0do4hThM0WgnYLzUEPiZypoXsQOOCZiqfHxYgsaMUwAIIstmltXUOX6lgE4+TFVlAxdLDLNVZtIZz8mGK2mGI2GiKbKkSmSGNUlvIYDAOdoIV2fw9B0MR+v4/9VhsfXnyF+e0lBp1AvMHo4grxbAq3KjHo93F4fIBmK0CWJpjc3uD2/FwGMdMQpIWN1GZ4aSGrbBkK3T54gM7BMXpHxwLnJuzNYAgoUxWp56wu60RYaYWESxJi6oMt+Xdx+sISVqAB19urCjTJnWITEhm0touGFwBxhHdf/RytKkW1GGJ08UE1RJnd3qKNb8Pwm/ep+9n2GPy3fEYf2/BvpRi/98fqcEo1gl55CzUJgoOH1RevBbyGTHyc2GgLe88sn7Xi6CdYw2qS3CnFUMrA8INeSmbySxhiLJJJvnkJoSOwsYfhHq0fpwnyX0UKz8oxG91gMhrB9gPsHB7D9dsSv5LCHU2neP/yDebjCYJmE81uF8effwar0UBJirUonprdywnk9E4mbl3nUjqMMsm78RiqsE9at+mJ5jPpWNck97KPLKqlGE+GGF9fI52MgOUctlXA5dxWHk0gZ3Z46A0O0Gp1cLS/j0EQ4O1XP8fth7foNXw0PAej21ssxmM58y5sNrB7uIvBTk86L1bzOcbnl1gOh3Bl+CGRHHpTekh1fbfVQzDYw+FnX8Db2UUWBFiUFWI5WoA5A8NWNWG+/jIeXw2MUL+REhUjAYdDCmI0ywI9KkaSwFqlkt/NhmNEkzH2B20MmjbOXv8SN2fvJTqR4dO1Lk6T3P/bKoacZ1KDcNX+6bNYPuUuTNj1X/zxn2uZ3DS6q5vbaOOnLP/2QjEco6DXNd/8vV77MNVSXpdJr4QnZuElRVDHdalR/wZZqq2+jOFQRTtusiSIdMV5jOn1BcY35xjf3CBotPDki+9isH+oRlZWGRbjCd69fIXpcAyb4zUDHw+//ALhYACn0YQ6ZUDlV8xHqBgGQVL+VNdnpKdBWSujGFxzAaVleJheQ60YEvfKcDYFAlC5F4sZZpMx8ukY1WIKu8rhubaEEDHPfeD5HF4DjUYb+4Md+HmKy7cvEU+G6PguOmGA0XCIxXwKL/DhNwIM9ncRtDiNkOhOhWw6x/jsEuUqkdqI7I64aBelxbkbLjLLQ/v4EXaefw5vbx8Lx8GCHCfbkWvYek+388w6miPSor2o5TnI0hhdlOiUOeKrK8zPL5HOI0SzOZqBh9/4te8hjsZ49c3PkEZzICOKp8Pr2mTMtfW/R5A/lWOYz1AxzPEDm3D+V1SM3/tjhlKK+ShrJuGECikE2dmasrB9fwbikmRpHUqpd31Koe7UEGyFDHF4MIMOJtxlXsJjIijzc9XhKCSNyUxZm/NiVQFIQhXbkwAw5WS+2RBnb14imtwiXa1kINdn3/shnnz2pQhdPB/h9uIKo+srzCdzxQ9qNXHw9Cn8nQHsZhN5xcYcVn05hZ7EuzpkrGelyiA3VSmWU2pNB5kckazhQ51861l+JvVSa8vZR5yvliVI4wjlcolyPkW6mktcTsWJkwwr/lll8Bwf7TCQSvf85hIOrbFtwbctLOZzrFYrUYqg3YDXbiBhZTkIsNvtws1yLK+HWIwmiPOVhJismMmBOByHyXlWlouq1UXr0RN0Hz9DOehjyZOoHFfWoKTFJwVDD7K+j/lgIFMKI305DVWvKtFOVhi9eIGbV29gpRkano8vvvgMJw8P8ebNV7i4eAsQEk4YuuqJ+jXI3cjR/XmGQTI3UrlGyGi42I+ynjFl5PFXVow/rRR1WPH0pQJqOq6UCbzj3swtGGtR9w4K8FX1hnpiLsFDrS94jRVLHUEJiRwVzGQ8zxEvY8xnczTCBnr9vqBVcZoi0VSGMLCFTJekpGQTklf/LuIFTl98hdH1uTTetLo9/PA3fhMnj54jjWa4PXuHdy9eSjiVpxmanQ5agwHsThfBzgBerw94IXKeNS28JQZzd6MIhUTxrO9CvpdrZ04dYh1GORHNStZgwvrsOxl0tlEMvo+TyTkRJF/MsRgPkURz4RPRW3IC4my6lLZSj+S8lOjVFFYSoUGlBhAtI8SEl30PbjMUbB+Bi3a7jV6nA5fswThBNJliwrE8WUQcVWbEqtzHQe56iGwPZXeA9qPH6Dx5iqzRxkoyPq6tqnFQMepHQdQNnBhInYvFWYyW56KdxXDHI0zfvsLs7SkCC3h0dIJnnz0TWPrnX/0lhuNroZ07VaDYt3oWrfFA26jXVkD3yRxD7k1mE+uTh/UHvy35NjIt8vnP/vv/rWIBxRC/VOle9+fKeQofvz7lCRifs+Bi8o/6+9YWpdb7IHGqWDCeueByKrJAhfPZFO/evEEzDPH8i++IZV7GMeIsR5Jl6DQ8BFaBJCXjtBLOT8N3ZMoGp/i9efk1ppMxjk4e4dd+8vdgB23cnL7FxZuv8P7rlzTVCD0fnV4Pfq+LBSHEnR0Mjk6EU5QxwLc82A6ZSXfDJZPzyDzdGu9L5SEmH1fImbIQMv1VXmSfUq2kbseJIHJ0WiG1g3y1wnx8i9HVGZL5HJ7jimHgcuYcQbniWMoIQc6xOhw+ppC5OI6RxokSgsBH6TkIuj0EYag8Ygnstnuw8xK3wwtM50NkUawOgTTznRwfS9iIeXLVzh52v/NddI5OsJSYXxXraLhUbUmNpJGzFeWBdVOStvLMB7I8Rcd10MpWqG4uMX75DarRBF88fYLvfP4lrm+v8Obta7y/eAvb5bUIkTsoZdrIptlo2/h+LInf7jEEDDBHcutQ79sU4w6Jkooh0440wkATbFAfxv+mPnU3s69xbWoh07cpxrYrVEqjGmdIFaC3aLdCRNMZXr/8Bh/evYXv+/jJb/4EYbuF2WKJMZPJyVRO8mwyKfQ8Sb5pFTzbhm+X6DR8fHj3CldXVxjsHuDpl99DFJe4evcKw/cvsbwdouV7UsdgjlFy/ikpEq0O9h4/w/7DpyidUNlKl4fpmiOKN9Ck5Ea6B9qsjzyPJtypgWMfK4awWmVahzmhVZEhWWMghTqeTxBNRojGI6wWM2SrFfrdvqxRsZwDqzkaLMUlSykMsg7DA93N6VI2BxfwNFmP7a5Msm10mh18/vS5nIJEUIL512w8hMWTpziVnHmU50qhL7IcZG6A8OFjHD77Al53gMz2EAsCTS+mTuCVI8ZMlViPE5LCHOsv9CwWpPGoTy7v9SU+/PQvsRf4+M/+wX+MJEnxf/0/f4HL20vYTgU3cOQUXD0W96NRRfeF7puffbtiKNR/c3CMUrT7yuHqilQME9lY//Rf/lnFyq9RDOa1tHYmLPq7dNxJIUf3+tZDrHoCte1tOJyF1jCaTdBqBJiPR3jz8gUW05FY2B//xq9h/8EhJrM5Loe3GE9nqOZTBGkMl1Rp19dHh3FTKjRDnvazxGQ6RdjuYf/4iVS+F5fnmLx/iSpaiWIwlJJ0yvOQhw0kXoj+0SMcPf0Cje4ObLeJ0vWQEt+pt0FqQ6DOJVQ0iU1IoagqUmyU4NhU8o3fUSxaIkgqjVchSml7SNNCuEIeay3MJUZDTG9vJGEPWU1fLVEsxnDSOawskvH7mZxKU8DOFUvBcjzAD1AFDencg+uKcfjisy/gOw5m11e4Pn2Dyc0V7JLdgInkao7HITs2UtdHxKPVgg52Hz/FzsljWP19rEgfIevVsuDp80BIlzFeRMB0My6Igphl2G14wOwWoxe/RHR+imf7u/jBd77E61dv8YuvvyEZi/k/MhIINQurjkhth+Im17gLAHy7YhBVM2H7Btn6dI5xRzH+2Z/8uUq7pRFfeQ4pIusRj6aH774b3RZ+GX0vnVsf5xiG97T9gBwsli3muD0/xdX5GRqejWboIUuWmEyGODh6gKNHD3EzGuH8+kosFadkeNFSoRgWz1KgJbPhcuhvHqPdDCX08lod9PaPkbPKPR5i8vYbVIslAg4KiCKxqE6jhYyDkB0fdruP9t4RujuHaLZ24LQ7QNhS5z7oU11N7MsfyFHEBr834+/liK9NjqGyFPXi2kouL8VGORZKjkjObV9qDFa+QsAjAJIVoulIEDQW6JxMUcytaIJyOYZVRCg5t5Vfk5J/5Ei/uGP7gqxZzTaW1PqggU5/F4+fPEU7aGBxdYmLV19jeHUO3yLEkKIsVK81K9OF4yMhhabiSJ6BhFPho6dCPKRXFoqOqSrp8xYVEqXZuRwiTXe5WmGv4eP65S9w883PcRA4eNBt80g93NyOMJktBGqPklimureaAVJ6jS2gZ1vm6oqjV/RbcwxdbVhXwpUB+7RimNBNygn/5Z/8mRrEKVUlXcgRYJpUDX0WttywGu24RnH1wADy7tWgAXNmheneMmNkJMXU538zhlQtiVWujvhlF1fXd7GazfDTf/OvsT/o4fHDI7x+/Y1QBHji0MHRIS4uLnBxdYlOu41kdAPM5xJKCOtSNU0LRNlrt9DptjBbLmE32mj0dxDnJazlEtH5e+SLBQLXlQKfjIcJAykA8tTTlIfdw0d7sINubw/eYA9WfwDHDxE0GwibbQRBCNvzBDUSdKYeUpB4KDAyvcbdtmDpMeDzmqERolElPMfDCi5y20PI3oNohvnNBeaja+TRDNlyiWw+E2p2WKYoozFsrh1nSrGinZcIHR8eAnheCLfVkSp2xDpQsw2/3cHB8SPs7gyQDm9x/s1XuLk4hU/srVzJ0QOEiPnK+BmviYztsDxJot1H+OQ5Og+fotXpyEgfgg6UZhIdBYDQRT3KADMycthCFm3nE7z7678Cxtd4ttODX+ZScFysVrDcQPpNeOKqxzCO4AFzrnrOtj2Vcuvfv4pimNkAApXrXIM9L6p+bMYiGPoOaTCqoCZo1j//o/+x8pstRFEsiSAfdLmcq7OkdeeWRa47jzbmvCOFkeoxK3oEipwLwdo/j6TSX2xXSJEjp1Uk8irsTZVPjK4uMby6lHDGK3Kc7O9KZfSrn/8Cg24XT54+xtnFKUaToVSI280Aq9kc0WgMn5aZFeIyRS5HCTuoSEwj8c335d9Bo4Gg1ZRklF1rqzRFtUyQzWaSyDbCQNtwokuZxM5M6s0IGC5QuzMAdvcQd/vw2z00+7uiaG7QlKOEBTa2PREEGUujzwFn6JXIGeQMtVI5Wthi4U7rrlCQklyO/2oGTdiWg8QOkLIoxp7n6S3KmJXsRIYaF9EU06tLJNMJnCwByHtKM6kUy7kX5I1Zlpww6wVNWGGARV4isV34vQE6hyfoPzjC7t4+ApS4fPMCL3/211gNr9CwgJBHnOWpHMYpXpDHrlmurFvOqYYheVXHOHn8RIzMygIiDu4OfWT6yAeCAC3LQlAAbk5go0S1mCC5vIQ3m6GVJ4gnN7i5uUDMUT78nExI59qpYipDU3p9Y7XXsb7urzCQ+Keb5HT0qlnN4qEdVwAIE+rKN+njfwv2eegxP9wfmkTuEUsF3FvrH/+3f1ixAuz6hClzzOdTxFGEgpSF0Uidp+a4aPZ66O3sodXrS2ihwCd1sCONIw+ZVB0lPHKKGsmjfaXkx3EQ4q6j+RjL6QQX79/i+vRUlCV0XHQbTYFXR9c36Pe6ePjwBJZj4f35B5RlhnboYzWZYnk7RkMOmmSWB6E9FBlPWHXl+GF6ojhJ4QWBVLW9Rij3SoJguUqRzSPxXmEYrjv5yE1iAqvOHWWuVcp1eF5e3u4g7/ThtLpy3l3mBAj7u9g7OkGj3YfjevC4iPSIGrwg1YKhm1SwywR5HglHS45CISybpIhmSxRJgX53gJ2dA1RhSxiucbpExYHOxQrJYoTl8BJuHmNxfYViPhehs3j2HvOjjFRwNYhaIm0KtuNL915BmjmVeW8fHfKh9g6xs7ePbuhjdnWOVz//G1y9eoFiNpUzw5tMZMyhOjxWjaM8hUfG8/CYyAdo9XcVare7h7LdQur7SDwbIT1JmqNYRmiWtvSNBE4CK56jGSewJxMMX73A5OpM+rgzTgKRfiOF2NGCM+oQ9nOtSl2H9+tKsV1k/Cg5r4dKVAxzcJDMy+LUQ038ZE+9nkhvW6SiZmq0kOD/Hqx/+F//N1Wr38NgZxfD21t8OH2HJFpiPp8hWqzEksL1MDg4xMmTZzg8eSTeQ9JIqX2oGaRybhyFwjgUdWSQ9O4W5CmVGV5/80tcnr7HajYViLLbbkvTDLU0mi+wms/gex52yRLdGeD86kxmMQeujWg8xWI4Rst2ELabsEMPSZaiSMiP0mRWVox5QDv1xnPh89gttm/yeeMMyXwpBcMGTzd16VlCWbjRaKSq57xbfXSVHMrJ00qbLYSMsRsdZF4Iv7+D7uERWr1doZy4gopJZVT1bbNYRtixSOE7rMgnWM5GmI9ukSyXUniMFgsJI7qdPnb3D9E6PEK4sytJ8Go5EeBhNR0hXUyRz8ZIbm9hRUs0aFWzRApuCXMtmdyxsZS08jwb3G210do9QP/oBN3DBwg6PQTNljQJYbnA4vYat+/eYnJ+inw5g1dk6tB7PX1FDqDX1BGepic4pUvuVhtBfxf9x0/QPXkIb2cH7d09jKYzTG9GaDAc5ElOdox4fAV3Noc9m+L21StpTGIOyKPO1HAHlTjzjEAZHq0RpO1quhSO7zkj8mPodrMO6zyQxy/XFUPyZz0uSCgvKj2gYhB+cOU4NbbRurC++Of/VUW8f39/H6dn73F+dire4uZmKKgN4+vOYA/7xw+xd/IQ3Z39tWKIKGmhJJJF2DcVpIUeRHH6nTJHspjJSUEfXr9CzJNxbAvNRoB2sykWnfTxeLnEcjJFkaQIQ9YY2kLB9gMKWoHVdIZoPEHb9tA73IfTaQu1nL0Mi/kMeZyi3QhEMVZLzlrKRemY3MrRxFmBeL6C6/miEEGjiR6LekGIN+/fCeGMfQ8xawZZJiPpyROisriNFsKdfbjdPtDqAM0OOgeHcIIGHCJj/KyGnrnJHls7swR2FiOdjzG5vsD05krOtGABU2oXAn36qu+i18fOo0d4cHwsBcDRaIjZ6FZaWZc318hGQ3jxCl0W+VgbSFNEFhBr2FRl9o6gUBW9WKuDzu4+Bscn6B0cCXy7imMUy6XMaiKJL56MMb+6QjIbA0mkmbL075YMaSOowXiaPS5KWG3ESYncCdA7foTB0+doHz0UxVskKaYzghqB0EdcOxHFmLx/j9XFJTCfIChVS0CWr/QIU9pNNe6TXXmKL3oXSt1WiL/NWwiwoz2GoFBaMdbghz6JVkb5aC4YMwxHFIP3zeq7ylut4//0H1YnTx6j1+vh8uIcw9trwdSjhKf5tNAVpTjB7vFDNHs7sIOW8JMEDRI4Qj0OQ4lMJufps055JjQ3P8+wHN3ir//yX8thKExKqUKNZoD93R2hei/mEfI4RraMkCwXEmL5oYt2twWXifliiXixQD5fInB9HDx+LJRphkzL2RTXl5eSzHdbLUSzGWbjEbJkpQpQXXFlHwAAIABJREFUlW70pzdLWK124TdCNDod9Hf3xBJ+8/oVQgo88xFyisoSgR+oWamLCdLSQdAbKMu+ewC/twu/P4AdNuCGoSiVQtsKqWIHVMqixPTqHDfv3yDhhHLCqyzSscDnsUbiIKbR4NgZzxeu1oOTR9g7eADmdNfnVzh9+0bo5OloCDtaoFMm8DheJokRMRekAJNCI+ElmcQKvm7v7qLB+93ZRaM/EO8yGo1RMfFloXQ2lYTeThNhwJJUI9QUOWiSveaqz5ruiPE3DSUl17FDOYSSyoF2B4Mnz9A/eQhb51yeH+ricAK3inH77j0uv/ol8vGY5H84upFMoXY851UjoUIYVd14xtqbYqLJKeqI1doj3OM2pOypk+26YkhlXp8SLNwOUQxBbGBZJIvS/6oDRhmKWg//4d+rdvb24Pse4lUkikH+DfMJvzVARcSDbZF7h+jsPkCzuyNNNFQM0XfFzRVXzP5bHoIusVpGxbAFQZlcX+H1i6+RslHIqeD4Nvp7fSG+TcdjJNMlMsKoTOymUwklgtBHf9CF5VoYj8ZICQ4kKQLHw+7jJxg8fopuryeFQIaAJKapDV6JtS256UwgY+UBGOKUTLxIjGsECNttNDo9rPICN+MJ9o+OBHVijkK+VuAFcHIeGzzCihV224fd7KFzeIz+8SN4nR4cUQx6DHVikxAVictHBApGGJ2+w+KSh0nGaHFi/ZIQcyYKyAkgCWsIPH6YtRQe5es3sHt0IigSq+6z6RzReIzl7bVMHwzTCHayRBFHSFj1JrIipEceJ+ZJzmPxQMt97l1bFBeej6QsMZ3OpKJOCrqAF1opuOYsjlJYiZrRC+c6tJG99GxVw8hK+JYvOSRFqHB9uP0BvH4fNkNTP0Cz00W704HfDOB7NsooQjweIx6rw2+mt1dimR2exU3FkDxVjc20mOhr5MnkBYYecl+p4H7ulPIY/J20TdNj1Hv4ZTSoNCurEagKylSjevhHmAg07i6sk7//46rVbsnQqjxLsFzMBU/u7uwh6OxivFhhThQl7GL3wSM8ePgMvb19OebKZbsk01YKnsTkatpcg4cbFIUgSJw2xyT+3bvXyKoMvZ0eegcD5FaBq9tbrMZDhGmJnIgRj65drXBzcUZgAL1+B3mVYRlxgC/PisgReg1JAHeePsfh0RG++eYrRMs5dns9rJZzOZ6rSCKUcSy0cdI/eD4EQaOSTFfG4GEAt9mUzYx5SHwQ4vDkIQ4eHEuoNV+s1JndRYQsnghRkVDu+XAOBG0cPf8c7cGeABYMxUhJEWubq+Ow4vkQV2/eYn55IZbeiSLki5kMDiMyFzR81bOAHO1+D1VeIE1yLNMSpRfi4OETHB4/Qdhs4uL0FLcXH4QfxdNas8VEJm1IL7twuihctngZ5jtEYqj0Fqv5rNdUQJLniBhK5exV4bAzNejMYdhDDyZ1ToaOHJBWiHEgvs4wMej2EdEwTOhh2ODlCkiRuzYyImkMs3xPQmIyEQjSBL2eeOR2GKLXaKAd+IgnE1x/eIez16/AZjIWY5FngkTJOe9KPe6Q/kwoZWgo9VDqPsVQNRWehaLRrTUku3EtcjagHIapFENVNmSQqGq34LpyHZ//R79WkRLAn6SMr/NcEldaQxZ6/FYPvd1DXI7nmC4yfP/XfxNHj54IPCjcEkmO1KgTIQJW5LwUYqlpFYjZ8JyHq5srtAddhL0WKp+lpQLj2QTx8Bb7joMW8aLlSo7p/foXf4Ob63MJpRh7MuwgrMkEOktyqTk0dg9B0ICoUrvdROA5uL48l94ENu0Q1iyIjxN+yzLpD+fdsLdckuZmA3YYwnI97Bwc4dFnn2Gwu48oTjEcDqUIlWYzeF6Jk0dPRRF+9otXuLid4NkX30OPOYfL2oGipMhJqBwbWa6wmF7h+sMpVsNbWIsFytlMZj41fU/Oy273OrADW47K+s53v0TD8XD+/gzD6RJBq4er2QKLNMPBgxO0WiEW0zHSJXOsa+SrBcp4xU4gNlToE1V54IunchY5CpjJLDdfJZeE2FmMtImUMYjRB9rznQT4KB6sZdA48sVDZCSE8Xy0Dk6wSEvEtxNglYBAN3lWcgyAUyF3yEksBYlkiGi5PkrC0I2WMH73d/fw9PEj7La7KKIF3nz1C5y9eoVoNpZZtS6r7lRYqpu28Ebot9Gob8sx1sRUWlTNRjAnWa1zDOaM3Cfpy+c4UqMYLDeQrU0UlbMCAljP/8MfV3KAOY94kpmfKnkuHVpJF36njy+//2PJLd5fjOCFHTx69hl6O7tCDyg4K0jORytRcobqMpXQZjGdyYQ7WtOgGUr4snt4gM5OH6VnSSvplHHuaonPBh3YqxUuXr8SpOTyw3thmcrYFhsIGw2EYRNFWmIx44k6FTjimGHIo6ePsbe3i8VyKsBBSvSGiVfG/GCOasWwIRfFYIVcYC42N7HW0WyCNZyg3cOjx0+kcHVxdY3pdI445kGIK/idEE+ff4bPv/NDvD29wi+/fo3HTz/H/uEReJ6b6i1R+QXnvOZljPH4EqPLC+nMi4YjpOOJHDC53+9hd6eHJ8+ewA1pzTP84Ic/xKDdxtc//Rnen15i98EJPlxe4+dffyO9IQ+OjxAGDuLlDDf0QEWCjHnYKpV5rmZghTqMxRXLrVqGVb4gJVk9dZBAPaNJFW+rI8REMbgktiNghQwtI8jOOValBW9whCh3kbAZKloJHEvFkP5sF7ADBwnPC2RNxA9k3vGKnozSKLlTH0fHx3jEPLXVRj6f4xd/+f/h6uw9fLYPQA1mVnOtatZe89Huo4kYQZfn+IiUao4yVrOo7tDQxQionEwN3dAT+vlMem4ilYX9KdbJT75HAFmdtkPar2E38oisMETp+Ng/eozv/4hkvh28en8Ov9HEg6MjNJsN6SngCPflfCq5xOjyCuPhWHonaLXoXpnkOmKdHewfHuLo0YmgPsvVCiEy9N0K47NT/M3/+xcYfngnSW+v08QqiaTdlJVmhjjqvGrWJYBFnEoS/eDhEVrdNharBcaTkeQ3DUK0SYx4MkW6YFiVqoEFUqh0JQykp/DCBrxmUzhHVJIkLUQp6PHY9lo1PZTNEH6jheeffReNVh/nl0P0dw4wGOysx8JszmVlOBVjxqPBJkOpvYwvLiV/6jWbONjtY6fPOs2xdLjdjm7w5Xe/RL/dxtm7d3j/7hT9nV3s7O7h/OISf/XTn2IVReh2OBDBxWw6kfbXgmFiHAtrwHQbSqJsPKIMXVB912I9NWmxojeRSjU9vWbJykQNdUAMC5s0ZK6rOiczooVuF3HuIF8wv4kFVOAaV6xHcPhE4AryJyCMnKAs1FMwhpCaCj20SyBlgAe7+zjsdnHz4R2G1+dssEWSRQJTsyecUYHhNBmi5q+iGCZ04rOaOeTCQdOKsVEe1VIho5RktoAh3sv4aQlzmTsnZBTv/+g7FeNSRVDgIrnwGTeHvjTlk4/jN3v4wY9/E4+ffw/TZSyEvt5ggGYYYLmYYji8xNnpWwzPT5FwMkWWI2g3ZWQKBbDd64vwMXblpIijo2N8/vxz7Ax2kKYLXJ6/wYdvvsbZ11+JB2mwMMHThIhfSR3IkeFvGQlz8OHartBBLM9Fo9PE/skDBK0GFtEcy/kCHvHoSClGvoph0WNQ4SkEdPd8XukJVq5fYGae8yUxLmNoS6rnTr8Pn/mUG6DZHmB3/4Gkab5UwFlH5poJbVKmkHDRizRBtlogi1m/mGE2HAnb9GB3R8AAnqsXeC5mk6HMf3r+2XM02g1ETNhnC7SaIR6fPESVZXj36jV+8bO/kd3utNpSzJwvZioU4uRzdi3qeoDyGJ466kA4TarPRc8ZV57DJxuZRS+VE0kfCbvcdD876zAMhxkJUFmEz1SFyCofVpyiSlIZ48M2ATalca4ujUur3UaeFljNVpJXOiVrSSVix0ZEg0TyYbuHfquL3WYLxXIhFPssJxmSfe5q6osU+3Sl29QvFNp391CYOhhlhN78TOYA6JfUSu54FF2NlrdQmVVLgDSHEb2UwqONJQunvS8/kxYT1wsElWl1u2gRfvMdqVIyeSttH8ePP8fj599FELYxW67EqhB6HY2u8e7NS7x78w1W0xs0WeX2VQLIHmrybxiLO26IbJVhNp7Cqxx8/uQzPH/8DKmd4tWHFzh9/RLpcIhGkaHpkhGdwPPp4HiWHHuxeeopp2+z3dKWBhquAc+EPn72GHvHD4S+PJ1OUGYJktkc8WSGKk5lup2ciyeZFlmojCPJ61WFTrp/hiHsGgyDBnzXU7Blo4PWyRP0+vsA14eFslZHlInep2B1n3OsiGboYiZROLJLWbTkGBtW1RtBiG6niTyKETEJJ3q2WmI2ngivK3dKOWGVOUi3EaJJ4eIk7zTH3/ybn+L64lIGCbgk+SUEEmjtY5Qc4SAxC4WbdREOZnbg8flkBi1rJrkwaGUWrONJDYoHZsqga+kpUc08MidLU+zUSX3kLjlISh/gNEPKQZoJ6pcWiVBH3EYoJMUgaGM1XyGarRT8m0xhY4k5h1AEzAd30Wh2UKY5gqLCo/0DLMa3OL14IwfFBI0A6TJGleuJh3o0jckp6vWMulIYha7/zNQxRKF08r2pftPUKlRQkesUHYU1N+YenAmWOzaWZCt3v/tFRSy/2+3i4PAYg90d+eBiRW0Gjh4/xSLJkKQ2Hj79Art7h5JwqwpxhJvhOd68+wZnZ+9Rpgt0/RDNVguNdktCFrpSJla0KBxAkPEo2jhFGScYtDto9zuYLCdS/HKLTGBOt8oQEO5DgRXjVyJHrEKryb7Sf0Cr6HoeViTX9YiY7cswgHanhdUywnQ4wnzMaSCEaykYangbBUDyAj3lkJ4oz0u02x045D65HjrdnrTSLqgw7Q66Owfo7B6gNThAo7cn+U3CKjMtjKa/EO9Xk0pUTSfnUVirCKFjoUEwoyqFvDifTKTIR5iMCuw6FqbpEpljYafbQb/dhM/Pc45rvMLbr1/i3du3yDjVhDwtvyF5YJwskLNpiUm1RaXgvfvSw7LbHwhdJkkigeDTlArE/FFRRwjrCoomhUYOlOBprnoCuqDOarAdXyn7c9wGArfFDlRkRLeKSEiAbreL3vETGVG0HC1QLSK4qzlaFo81SzHiYTDdLvYePxGS6e35BRqljf/kH/x9ZNEc//df/J8IOwGOTh7gw9sP8owGgVL1BWX9yepdew09t1aK8frkpjp/ip5TCb6mnRikS85hpCGkYmielnT2qxZmTpCRH7PfnUznnV/7ceWFPhrNJjq9jtQzZswXpkv09x/iOz/4MTqDAwynEQY7hxj0dyXWJ7oSJXNc3H7A5fgcs3jMEd3ohwM0eLJPEOrzEbjIFfJ4hcvTt1JlbToWyiTCajZCPI9gF1D0EKImVYlG6GEyHmK5VHOWmCYxSSzSTHGzbFp0leAxjGFYE7ZaCNm/fUjFLTGZzjBfzDGfLwRt8xk3Cy+qEOKfWCcqF8/EZrhIYiGVj8iI4yHJecg8i5x0Fi3scGr4yWcI947hdHcQ2x4SPZ6e0KNbcvhAiULwc0uebfTuJar5GCFx+zRBt9WR74s1LYSbwV73mBbS93FwsI9ep43D/T2Z+r2cTfCBI/6XfIaV3LucIkTrLS3AkSJP0gs4DprNJnZ2doQLtiSbmGyC5ULyFMk1zDwJ3ce+Dlt0k47hXQljVv+DfeLsF3HcfdhFICGqnc1Q8lTV/V2UO0cyyM2KM9i3V2hEY/EMJQWsyrDz+CEef+dzLKcLnL95g3K+wOcnx9jptfHLr3+GweGuhPunH87UQTD6GDI1VEL5gtpEMVWR1xVyK0/0tETzPj1DVw6SYUlRv1WNL5E/qsHKEBhVU4ArRWBOgswF9k49H9bBT35SNSmUAft5c5mgLUTCNMf+0RN89r0f4el3vo+YIYzXRK+7IwxFxqMkvU2WQ0TFApnNeNdBx+vCtoXULLUAmQtbVphPbhHPJuBUo5CakK+kB+P81RsgSrC3uwvHd7F3sIdur4MXL77B7e2VxNeCu+vz09jTwN4BWSBJsNQz0wrS8pHm0ee1XE9oEKPJGFEUodduC9Hx9upGwgFB46XiqsiQBAmYZZBKzU1V2STj6VTqH06jj8bOMbrHT9F79Aw22bcN1jBcqQnY7MtmPkTQgiHgfITzr3+GybtXKKMZnDwX1IahEHMwGTAGVtg9ZJYlYdr+/p6M1Tk6PJS21/PzM6ns02DQzZOeTQ5bzhyjIMtYIToMFfin0+kItYcCNp5MRDFkiATZxYJAbarCdwpfa8VQlnZdI5ChdQsJpb3gCE7VRLFcAcmExx2h+fAExe4JEisEljFwdYrmciw8sFmcoLm/g+c/+D5yG7i+vICXF5hfXkmYSM/oeCU6u11c3FxhPJ4KK4HDJ2TCih5aZ/o/FI1DsoE17YMzb3muoBkTqloiVDur5FF3FEMrjygGow9+j8Km6M1ZthQGl+dixVzn4Nd/o2q1m7BcG6vVUqxLzhNteA5Dv4cHT55j5+gRunsPsXfAimwIK9cxflkirRL6IpSuOtSQCZSAYpWFjLwTTa5bzCaCxQcOO9LY40z+1Ft8+PqXMggg9H1RjB/96IfY2dvBT3/6V7i8OFMEQOLqeQ6fyTLrLawXkGdDy6cPvBR6CinnYYCThw/R7nRFKYfjEebzOfYGO2iGDVycXWA6GonHoKAIP4bhlUwvtwVNY5IuFHanQF4krEPJ9JDK7yDYPUT36BGaBw/Q2NuVaYGG88MGKI4P4m01qgS3b7/B5YuvEI1u+RAM+UUppOFHDqCv4LEiXlk4fvoUz589w6uXL1FkqSjM/0/dezVJcibXgp5aZ2WW1tW6AcwQnCE5s8NrfFrbh/2512wfd23N1i6XS16S1zASqrUqrVPLtXPcPeLLqKxGNwbAzC0YrLursjIjvnDtx49PxkMqR71S5vw78i50sIfwnFxdZxy5lqCWSyWpLdRlPAI1z7UMuNZLrSSJ4EzKwiqOx+dJ7iaN71GZ6hFMWSxuSiZVIRBz2DuXVDEtS/cfiCytyyhdksHllQxeP5d860J68B5lJbLL1irsV+EZri4sSOvoWAaXF0hhpdGoSbaSlePzM87uszaP8I77/fT5sHXAsE4hHN4IxHXnpgOuLHMoC0WAJBJqAOYpht4XAyh9bjCqzC/0fhFKMfle+/nPp3Af8Bb9fpehDGragIyn0ISq1aWysi6PfvFr2b37qUwxECNFyaVyMh1proHAGgvZlbWcE+S6KktZlnjhiLkxjVYt5qScS8npwVt58s2Xcvj8G2mdHEilVCJ7xG/+8R+l1+/JP//Lv8jx4SG1Gp11xMlErxqDOe4vLO3BPSIPQdKMcKJQKPHn8BawnBXcR6Uq3XZXri8vmIfgvTE4hOtDDR8NLi9z5oA7yqWkP+rLoIuEF0RiOUkVK5JeWJDG9p7UN7eIRcrmSpLPl7Saw4GLnkxaZ3L66pm8e/KlXB0fcQlLuVInvqt13ZZ+t8fmHapvnV5f8sUymQQvzs/UQ3AXxIhwFlS1UMmCdev3evTEnBMHTorMKcoASAOpdPP8PskAcH4I82zewj3MPI8RQi9cMSSDsjuQymuSzVS4DLPfu5JMuSBrjx9JurEqo3RBeqdncgVa//YloS0FGKZMSnoIFQc9KYH8rlqR0zdvJIXK1rgv+UJOJAe0CfhtUWABy+GUpWnkD8gNEWr6Ikxd4RnBibX3AHZ4I2hghSpA04YTfOpNoHxK+B1XpVIMgfl5wLMBKQDYefMBqlI2s5tOceUUhlZQeRikRtzpBiHY++RzyZTqki/UZWVpQ2qFmmBuDKEOpq+AF0JMPhp1WR0ajkCsDCrKsT3IsXTbV7JQKUsxl5KTg3fy+sVTOXn3Qi6P36pi3Lsrn3z6qRwcHMgXv/sthRjVLwD6AJaD5QcsOJ/XmjsFwPouBEYA3IgZj3yRyZ7X4weDoaTBtg1SsnxR8V2YthsOpY/KkZEXZ1HNQWEBlDYY6segE1j5Oh2GXYhb04WCTDHNt7IqxdU1om4rjWWpN1aUFHk8JGzjfP+VnL19KadvnxMjVSqWZXVjkwpwdn4h11dX0lyoSj6bln63w8/AhQGSXoD3ouWcUimGfdCLwrug3j9ShC77Tqy9KEGBKTjOG70IhK8subK4gIEuTbKpRAHXEt/BGmU3MUnwpICJIM9aklyuJq12jw29QqMuW48fy7hYkd5wItdHh3L18rkUgURYWJQrlOZzWWkuN2mcANWpl0tydXTErUocqcmB+wkbZ8fSHymSuwSiikyKzwDngvI3v5zRJMbZm2Lo7L1y9lnC7iseLJRiLhVlKwoJibwGQ2rsDVSGSzQJBoiK6nu7U7c4sJpQDABx2oAi57JSWVmWdLUuxaUVDutUaouyt3NfVhsr0izXKWB4qLTMnUtpX51Kq92SNgBk/YHGuEyq4F0GrNAAfox6+KDfkauzQ+l3zqVeqxEUuLq6KodHR/L27VsiXZFIriwvswG1v38gfXyvkLOk3KwjR0wVM4Rrh+UegUTYurzE2OfzMsplWZJuNppEE8NqI1yDFcYDgLUnCTFmUODvUL2BAxwp7gsRLqcY0ZCqVCW3tCKllTVZ2ror6zv3JJ1VtC+4ZTsXx9I5O5LWKbzeRBabS0QpF4oVaXe6hMrDM5ThCSbgxFIvgu49Ph+GgKQUoyGnDmHjEH9zxQFCVCunhoLtf4cSAPjnYDqWOwkjwnzCfMWYD7eA0mHdAgocC0Q9dHpjrl6orK7IzuNPpDueSKvVlsv9fensv1XBLlUEII9qpSKLzYacnx3L6cGhVACYHPbpFYr5nAyg8GBNIl6tKgX0h9JCzFvn+oqhI7eJRc8XhUnrU0TL7G0OXQe0tV/j6Frj94pxVXjt0Mq4zC74P6uJChFniwEZaKq5u02wL0IK7kcAHJfDGhmpLa5IfX2N2P/iYkMW1lZJe7m5tiVFwCpgKS4v5ODdvhwfH0m3dSmdyws+dMxFwILCWum+jQmZKuAacTClAkCIGGkEIG5AYV1bW5NlUES22vL69SvZf3tARcUQVbVWlZPjEzk7PSMuirV5CCzwR9iVwYk2RfnyLDn2qdxJOLBBPifjYlEay8uys7Mra6vrrA798U9/lIvTU/ZkiMYd9AhuI7xjBMedIfQCC0/ArIGzQq27hUrU4ooUV9aluXVXPvn872SSKsiLp08x9yaLtTK94cnBW86p7+7syfL6Jpn/mBxOJ1QiFCSmnUuieMFDC4byIUB8pOJHaRpVKB2CIp7Z0MwIO9CDYHyNWXJ4A1w/pw+1gRdCJhhZAxEAnFCwoDPsFbhiefmTW4rIE4W5mIqk8lXpp/NyPUjJzqefyeLGpgzGQzk7PuKCzNHllSytrEh7OJTl9XXpt9qyuFBjdHC2fyTLzbpUinmWkGE80VRDfot+Q3VxhdXB1hXQ1ecEtLK/gBNHudbKx1E5lkTTDlM3l0LvF34vnLvX5h6qT9z0pFtWbN0F61X8OQwfqIRSS3tbU63xZwi90HUQaSlUG3L3wd9IdXlJzrrXMirg4ptSrpY5aDSE1bs4l7PjYzk5PiK8o5DJSCmVkdbVNRPfAsYfAeYDfxExWIqoRAMqx8WII3ai89Wy1DGfXK7oRB8Gk9odefH8JR3gxsaG7O3tydHJibx99Zate3Cj4j2ZG2DxC7YDkZwMlSSdLOQKMyv3DQt5mdaqhGSvrKyxnJxDRWg4lK+//IqhS7NWIVz9/OiAeyvY0JaMFDh8hCk3vQc0HAeFnEwXGtLY2pVSc1Wa67uSL9UIFa/VyrK9tiyXJwdycXosxUKeMI/KwiKbgygagGBt//VLef3ka+kcv5Nx+4wGBd4LgoB7gsJrC0oh7fgDoEyWMBke6Kw0np9XpkLL73/X0iuIDmK6Ua8+ecmW70k5SEVr1Igwho0dDiWPSCJXkVGxLhiIvfuzX0p5oc5JxbODt7L//AmbrkAHILeAR74+PZX1xoJcHR7JxfGx1GolyWSm9GZARLPEXCoS0QAGSDRbe+2W9LttJaZDPgADYWmFD0xF80yEvMT9Dj4wKxqoOQwVw6iNQCDKs8vJlGQEWrIlvBKry0TIo5Vavrs5JT4KI3+2FgoVmUp9VTZ2H0lpoSFHCI9GHSmUC1KtFqVWKUkWA0fDIasfl6g4TSdSzhUlNYAl1IEcHDQZIDA83+9Lt9tiyTSX042gsEbZckUqzSXZ2NpmZers+JSWE7F2p9WmwG9vbcnDx4/k7PxMnj19RoWAYiAs4FJCkxuIEGr7lCOO21ohHGt8wUaRy0ixVpc1JM3oKaDXMp3I1cWldFC5atRZ037x9FsZtPFwkNuBnkYky4XtetCE15eLkmk0aTkri2vSGU/JLAIoerlaIS6qfXHCXgQMBKpk6AeglHl5diGXp8dydXIk+y+fSuvojUgP+dOI1SOilEmyYGsFjDqViXMEzcZgj55x2AHmzg8k51ZuipbWILwg92y8bTVMwMkgiEQ/m2U/BP/u9/oyRE9iCLYWkUm+LNOFVZk0N2Xt3s8YEWTGHTl9/VyOnn0jteV1Vf6ChkmYU18uV6R9ciLXp0eMEMBSiOc2noyYM4GgDYBNMpQA3QvPwHMwXBPQ3qBGAhTc9oYjb9I4GWJsLB92v1qLsrFSR0vZGgM3MDrrTbA9vQfWSGfSCKewzWpCkr3Uyv2tKWJIhUZwJJ2Aump9RUr1VQ7RXHYu2dDJZHVFVjmflXIxL9VySaYZsHD0OA5ZLlQlM87IAFNwgGdcnHMwpFmvSrt1JecnylOKn+HgqthN0ViWyuKqLCw0GU+eHp3I8f4+4RLkTBWRWq0qq2ur5Gg9PDomQQJ+AAgHuUl5TipM+GwqOmnLtZkDGP04m5YWZsQzWblz/6Hcf/wZd1D86cuv7YxHsrW2Qgbx/dcv5PDta47I4jCxEy4LbBaagqZwTSSjAAAgAElEQVQYo0JBqmurcu9nP5e13TukD8UQ/QCvLaD7XCNNDRSgUqnI8sqaPHn2UoY9wGLOJDUcSr2Yle7psZwdvCaamBgnrhLg+Byvn0JPw6WirmsGFAHFLj6wTfm8ohFA6gAjZP0NRlvMRTSvgNA7BimZgOO96SHSaeZ1rNAhf2z32aWfpoacec+sbEvpzudSWduj0coN23L04ivy064+fCzpUl1ShYycnxxLaTSR0nAk1wcHbHgqFoluWBuzGBrDfQDLBoOAEjkraiOG26xAGkVPDns1UthzgmU+WpFUUL3yAdMI8ux0/t6BnbYgzvpVykSvKodSv1KwYgkX+hhAL+D8QNaQWnu0PR2OtEyli1iQoFZYaSnXlqU96JElu1JFUj4kqzg4ZrmPAtUPjGkWC1JbWZHF5poUslVeE/oW+69fydJiXe5sb8nb1y9k/80rkiJwok6msra2KtM81lwhls1yAq991ZLrs3PpXbWk19EKzWg8NKuRZW2et4Zeg8GktSqj258gHOgV4H8IFKwkYBJ4faevxNDN1Q35/O9/JfXlFfnymyfy5tUbxvMrjbo0q2XObxzvv5azixO6Vx4cKoOAoqB1gOoVdlFsbcn6nV3ZuQuS4pQcAFncakut2ZC1lSYV7ODtK5IvrK1vyP67Y2mDlv/oSIqpqWw06jLtteT89IQ5mS9vZ1iEONeqKwrfsLAAXpJz8toZhgAXLSxE468LLBN3ZasJ1RKmlnOdRdBDrCQrRzg+ivfNg74UbOvIXcZdrkJOr+7J0s//i4zLy4oi6J3L4ZPfS//4QLY++1xGWOuWE5bjl8HVdXwq1/v7ksL0JvpqwMHhP1QzJU2qVLLj5gBVyfL5ocvP0ryVXgnhAXMJRmtonIzeHwhhNOZMMRDmohKnYaeFWTphYf5EFUO/gzDKQykN2zAlBEUDvU9q45OdaR/1Ylwc4t9cgYjJfLkq6RKg311aaMSHmP4SYJcgYJ0O+ZqG2RwxM6s7O7K8ti21yjJr5idHh/L6+VN5eG9XHt67I3/44j8JNgTyFZgh0OQsLS3J0fm1tPpT2VjdJJnBwZu38u7FC/JIoXKFscv+sKc8VzZog+oKSc2sTKkWDvnCSLvt/N9CBgqSdlNR5kQ4O0pnZXXnjuzef0Qw4e//+CdWQdKjEQdxFiro00ylPbiSIahV0AgaqmKM0T8AoK9alqXtTakuLsja+jqLDE+ePJFWvy+rm+uysrwgJ/tvCa/GdFyzsShrq1ty+OadvHr6VHqnx9LEOO4UyF80+bS5SPKFbJZCAoGG0XLF4OPl/aAqp/Se+B+Kv9hs8vFjyIpMKeHSSPMy4UoDCN3MnhIjZfZxUuYaCF/GaankCzIcX0kLDbbVPdn8+/9NzsYgPkhLtn0kB1/9D4CoZOvBpzLIV9kDOz94LSuForRevpbx5aXU0LNIoSEMCh1D9tLgoGCSJiQHtEgI55Ccw1vh+iBLGDnAOXDYDCEXxwY0HOc6CO5AVG+rSz91H6NWa7nUwRRDS9PqLaAUOtSEAFNhIQPFSyP02vjszpSChASzUJQs3GUux4HwDqwzrFcuTTg03DZgDRjF1MYe4A8FknyV6zUpAWlZWqAQnp8cysnb1/L43p7c392UL/7jX+XVs6esJGBHHkp5wPhctHqyfeeR3Nm7y+T9j198Ic+++YrJKaAWcKu4eVSfkMSzTp9XyAl7GWQcKdN7cF4bZGTKgRDVt1mz4IQdKDFRM0KPoszyKeYfnj1/wQoVt5SCIWQ80tHLNOYNOLWluxuA5OA22KykCgVZ2VxjMWJhoSqdTktePX8ug8lIaphULGY5TQivB8sLr1Gt1BnqgVsLjIg5QEnG2GxKpk32HOgtoPC29IRwezTAzGO4N0HYxaoVtthmsyxz48+TkxNpt9pKhcNYXCEvnIY24CQHlDB3gednMG/SjdILBb0h9lFyhNMgN2gDFLq0JZt/909y1p+yypi6OJT9L3/Lz16+80DGxSr7C5f7b6SWycjlu7eSn0xkaQFMhgNpIbG2TUcYPIMsYY4DwQ1yT4TZeBaQL5wBzg6NW8B7YPgQGXA+J5slfEbRwxri0qhwrQvu3SpaMPkMswLloGJoRYqlDBtUUhAJ4ypJbX7+iL+BEi0OHReCw+5gjDSVkwJ2SCw0uJKrUK2SFQN4Ihwoeg+InxFrQsM5R10uy/HRgUz7XRm2zqVRyMp6syr/8f/+s1ycnehBoGiGmfBCkUNQa5t3eYGAYh/tv5Xz40MZgasVkmgkA97Io6tEZzKdYyyOri6gHlCMDhpCqP/bHgeQxQG0xzkxA9+xls/wQi0R8g9YKU3YlRCAzBtQRpSpQdcoWRmgUYbwJo/BpTL3UVRQiKiWyEfUuj6Xs5MjUv6g7A04B7vPzH+UIhILYCDMqJYhD0BhAsBI9hsth4CngHDiHjATwkk63hO8SIbXym43BUqTTAgLhsYgQAijEE5RWAi4tNW/XHajaGDkKPk8xnJBTaS5BWXAvFNczcL3QEtUldG0LJnmuqRWNqT+8KFc9ltSzWek++6tvPvyK87sLGDkGQNcV1cyvbrgzAkqTABFrq2tyP7+W2mjgYkVBamsdNrgrs0xrwDNEIQa1r3f72slDCsNcihY9LXXhOeZzWhuiV4NOujRl+ZlXnDRdgdPNso3ghcrkNADLN/toaeg3fP1v3k0JaMCmkbsAKdoWXvwCpmiFOt1crk219ZkdWtbltc3ZDAey8ER6u19ckMhGwLGCrkG4u5ety1vn4F97p1sL9WlUcrJ13/4vVycnHKXAz44A5qXSl3qSyuSypXk6hIMiC3OaU+AmkyBRUJ3dtPa+zYyFuS1MePKjFAKX9gsRKHy8U6HmDNGVpr6CFEa1PJdcNV42PISVENA40MlgpfBQvocmTeg0NVGnWVjFBNGgw5JqEfDHl264pK060wvwK68PjjMeuALu7dhBZXcOe4taDytxAIY6cV1Ix4vlSvM6a7Q/YdSoDyNipGVWJlHWR9jBiLh0G3OXmgV20uynozTmJBRERPBCsHg/DerYQPmf6NpVSrr96S6e0+ym6vy7mxflqpF6bx5I/tfP5V8pUGuKXIFHx1IptOSa/S12tfyi1/+LYsn//7v/0rDhbASinF0dMz+E9kfO9fkIOMXcWTgysOU3ZQYPoRN+DsqVP4MZ7a32E56dwxsDfDLVivrkrXoK276xQTk/r40nKs/ezCFteXi976C9QiXgPbly6Rhaa6syDLIu0CzUy6zAoPuNOruaNihdQ8szPLGpqzt7LDi9PUfviCf0sM7W0w0/8e//3dyPjEcKyGM0pANUO9Wt0clAzQ8T64klAl7hEvEVizG5utUFh5kWjv1wBCZlfG4O5lgIlRAhzXEV+H3/DAY15s3gQXFfYFlBOOjKKcgtOSsOKYbEUatLEsfA1Hdtgx6LeL5YeHodcgBnNXQxDhtWTWz2ggEHV1uWjxuhNKOtMf98Br5YpG9AxDAIXxcXFwirP74+Fh6mGPvKwsj93QYOpb2zhTFld0FgIm9AS7Z5M3qrgv+DhLhdJZnGSlVNmPkGD3O22fzS5Kqrkpxc1fSq0ty3j6VRjEr1y9fydGzl1IsN2T5wSMpNJrSOzyQ64N3MsHsg0zlV7/+O+ZB/+2//T+cRLwP8KGk5Ok3z+Ty6ool2in28KGxKhg0xNKcAp8NKpFdNANt8SdQxtF0H6HR3gl3j6Gy/2crxtInd+kx2MgBLyqsEao7KFQiac3lZXF1Xbbu7Eq2WJIL0FzmFdJ9eXnJzjfcHMjTdvbuSK3ZZB/i8O0byU5HslyvysXJoVWkplIsljjNxekwJMtjMGugsqB1bS5WgcXCQ+P3YXW1vA3cEkOqcYqcsQjjINCcPQCtf+AtXEFcQLg+AChKYro0lvbXQGjwPuyJOOYIeCmQObDyAYJjrBvI8jxQby+WiixKEDg5RdNSqNjqoJHYAkGgeCz8m0kkYuVuj4KtYZbNDyDeR3XPFJNKyjn3HOlDESptb+/K4tKivHnzRo6Pjshdy7ql3YebwrCn4Rgq94Jh1UkJEmxFAUq54NFCWdsVzYClGD1GqbRQXpNBpi617T2R5aa0+1dSzYicP3suV2/2pVCsy+qDx5Jp1OX05QvpHh9KoQCIUU5+85tfy+XVpfzrv/yzbG9vy88++xm9/e9+9zs5OTmjN5h024SLIAREqIVSPjxHq9VieKjkOo7r0nBwZnfLD+AxPGKgXDQe7k6BQ8IDRRmVbA0s3WJpZIZNJLD0LSwvETsEGvdao0GKFVBJwluggYXkHE2YUrkqpWKRrINYAkm8PG7YkinElEjaKejE/AxBJsEOKHhrwe0KOAAQlkTMAh+EEckRVosBXqLgQTAS1kG6PBrJFehp+v1IMfA93JxDI2iJ0Wk346IwCht/sTDGK0E4cI59WhIOhjq8FFABnAd2h6NzqnnKhMqAwSoQjJGaxbbNohKG0jJmIRDcI4RCtA9gJBpnbuWZWmRR+ADMXaEc+t4gLEAtYMBzqtcXOFsNMjzs3UNugkIDbsnvM7xn94aRVzB4jCujIk913S8+F6EtCSxobRU6AmqbiWDXYV8K+VUZFxuy+ennMioX5fTqWOq5lJx/+1TahyeSy1Vk5cEjkUpFDp99K0UZ0ernC3n5p//yG04h/u4Pv5XlxSW5s7dHtssnT54SNwacGimBMEg2ArVqnlARGGnwnGkBQZNkhasARq9rzuIu+J/vMUKkQGrx4d6UD8LGVX15DBMyWHDExJkMGzCwlLBk+UKJUPMOlrdMJrKwUGcHExinEscv83R/2I6EcAhVJcSWKKkiiUTOiGoLS2/pkRRLaalWNIHGii3kIfQeIGZAFSyFqkSffQjkFvhZBUjMYpFK4d4C1s47uC4k/j0kmgrIdZogFUC3sMQFmcVWxRmxXwOaGXoqg9ID1wMfgpAQNW9Uy2rVshSLOZ0b4aYhtK0yVFZaO1Dk54ERws/BJBKHPwyh8lnJsVxpybXhnIAKxrXAgpZRPk+n5RoWFJ4d3haKERgA3BtClhAnFUJFdORAmWCY7FMx9JkCZg8aJYwlw5t3UKUD8nXa4xhAubQh/UxVtj79G+nmMnJxdSINjA98+60MTi4klSnK8r2HMikWWZHKDDvMkYATe/TovnzxxRfSxp6PbIZTivCkUHI880EXIM4eITfIcXDNFWzQNWSFPxtmDOT+1Z6O7jH84UKpmfAbiqGBpoK1lKRZF7gzuWFJFJYSJAKmGKhMoYs8HkmlUiI2iPMcHSygz9NKwpPgNdraR1d2wofPrjS3wWrnNpufSr6gJM+I6wcIicy6ASLO7QKA5SHB7494DWA6zBMfNWLCHVLGh6x1nj/4IZL1ztyxhx54TRine9OQD2A40MTf+YkIPtMZE21Mo7KW57KaQjHLmWXkA7xmg9vjc1BFwfrgTkeLA9qp10ErWutChmeD76Eag+vB+0Cx8LWw0JD1jU2iAVD00EJJCKzTuNu9RBhGOmSEoSJg6AYXgfCjughviBmR7Z1dGixEAgiJiXDefyud/hUjhOWlezLO1CS/tC6noExK9aU46MnZkyeS62H18lhW7j/ijHzrZF/aJwdUaPSqFupVefb8GXPMXC7DgTNAvIloRogJ78QwBcz4EHy9F++pOBGcf+9DFEM5b+BRbFOuD8iaIiWT72TRJrX4YHfK/WkGLzEwgl4YSLXox9SyAM0FN4vYF80aaH8J+6VLOQopSJOnfYUmILEEw5yCvLTqCm8Bdw0vkCbAcMCWci6n8GY2ZRi3aIXMMfNA+sLD9Aklz+ggC67PmnmhsLu1dMH3n5E7iRjmm1/8HXPPgFfAG3gC7g+B72MZBOwVGkc4MoAh0aPI5tLWdVcrz+nAbFYtIhjZL694bpga05xR8xBidXIZyZWUyACKgf/hLRBy6Sx3hejji4sL5nV4B4Zcc+9GQysvMnhohrAI4E0PpZiIT3UZI5C6i0tLHB1Fr2B3d0/OLi7k7cG+9EYdqVMx7kq6sCi55qoc9rAqbCCFfkcunj6V/HAibYwnP3gk2cYCKf+xhwNeaGV5URZqdXnz+rVcnp3Q23NLK3tUajix3wSDWIgdaRTIHGndcYO8eMI9kydp8U+/EjlGDCCcrUqFCnFTRhStTOO19GCXDT4dQteHxj0iXGaPfoWt8uK8rX6x3FdA0ypPmn78MpPiwVj6LVhZZZoAy0d0IzYsggQYsTIodq4xRZeZ0tqiaoSGEQIUhAgUkN6A4RceIBGYoIhBDwMHYnBrvx7/nJmD8zMj3h4WWsV73pdbDK9OqdWG9br5atoQcqDCVmgug2YUrXZqSqNQLdeYaKILfYA5EhgBjpjqkJWWb7V8OgUaoFqSaqnMz9QVxQOGYXhv9JbwexjUcs/g9z3vXjz0cGFiuJVFj0qHt3hvExRCyjyNVrvLfgLPl4wx4AEbydU1qEKvyQ/WqG9Lpbkl5ZUt2W+BUK8nxWFXLp4/leJoKu3OUFYePpZssyGX+6/l6vAtCw7LS8uyurwi794CBXBozIc6STcdq+GEceFMnUm5e00Y4+h5WF7I+8eDtDmNH0MxCEVZvL8zZRzu25FYu7ZtewiDiNmJmaGVZQHuNyeFYo5NIqbQw76MemOZ9DQxQlJHJKeHZcQt6b4txJ6Iz9vdjmQKSmKA1zMfMe4iEKoRfg22B06hoVub48NE6Q5hGgQoWZ69TTEUnDdfMcLYMozJQVuqBF4KXo9/HZZNAXdugZTtT/MYwBXW19cpFPvv3sm7t4CF5JX8GkrB3RsIf3SwhjSk1SI7+AxDgZtCSEG+Kyyez0mPSNcBK1vu4XBm87687IufRbMVWSTZYymWYGiQZyBEazKcOz29IEkDCJExLQlDRNjNZEJUNTrzjdqmLK8/kOr6jry+VLK0bLclrZcvuKqg3R3J8sNHkms25OzNc2kd7RPqAajK1uamHB0eyfHhvhJboNVt+93RC4KHRrEDDUoibxEmomyLVQysjmmxRMNw9bZsXJIPyAzdB3qMW5xsZPDxF5StU427W0y+OeDjnEJE2wI+oVNx2iU0ixgxSkw5Ew0XjbVi4DAadgHRVlp8KgYXm+h7AUuEGV+4UVAyotIBhURHfZrLM+RAzIn9GIiD+YncOa6CBAWFJSyVKjws7AlEKS/0GBCImJcoPgKCzFAGviX28HADv+EhCM5EofhW0uTQjMXx7KRr4hu/HsU2rOiays7Otuzd2ZNXr17J2zdvmFAO+uhzaLeeD9YCIRrArJAAmfMhA4W16AiGkhhAMdptjNfqPfEewxp+4mnjmsLSM+8ri/LmUEoVQCz0edawlVbScn52Ka1Wl+4LlUWQGWgTNifj7JQctosL27K69VhKy2vy8uxIhpOujM5OpPvujVQxg9MbyuKDh1SM4+ff6gLRScqGtHbl4uyM3Ls2EokCuJEeAEmreZ6Xj3WcRjFg+B5wUgqahDn1CUTdpR71K34AxfDnD7aVVGNvc0oL44gaeAzbPsqQgb7KFAeCEGF7QdZlkBN4jPEARBiSnRZJdszEl5OmUAwAwIaSxbQdF/9k2OaHoC9tbHL7D276cP8d91ujwkVbOFQAXaVUZVUGh4eEHGHY6Rl4p7A6TCEeEazBYsRQVjjVRRjz/DAqGZbEXggdX2vLUTFog/VPs2reSYYFg53LFbLy+GeP6TH+4z/+U46PMKhUoBKjYhfpJnINKoiuOAZDCkrKrFjhHoxkG8qExB1lXlatjAqHG6B83iShGAx1DXnsP0IolSlMpVSDl8/rTDz2DA5GcnXZZsUMiqGLIpVMAWBS0LoMpmlZae7J8sYDkXJdnh8fyDQ9ks7JOxkdHcpCNi9X/aEs3bsvmcaCHDz5SibXFzyjQr7I6UWskjs53GfDE2RsYAQkuoHnqSwg6kH1hBieoo6P/hqgKvbodNmLPgcOov2AHsM/FwWDVGN3gx6DhL6M3WwqjEmZzgrTcpnnYAjAOrtdFJGSDJpoIbA2inVwTpkp/gjvQ5nE76RTtJwIReCyNu/ck8baplxfXsnLZ0+52xoTgpzuo05OpV5bIGfSAAP2TGpzcnxyyiZjWEUKG1k6yRV3tn2iK8rVAmHSvoH+xHMNNvpA6oZ7suIBgUX2vgzZ7GkRv8VixYT1982dTSmVyvLixQs26BTmkVJmFZIt2+5CJuBImBAmKmxEwXAoLCA8BftgkQk7moLo6aATrkBDrerN0w1cW9jJZxiZSUmxnpdKraihAhu6QypcGwQHXXBP6bAaUAV4X4BKwZOFVcvLa3tSW97kCoZXB29J4T84O5bR2anUiyW56g1l4e5dydVrcvztlyLXl0pol83J1ta2jPpDjj8De8Uwyvah430i0gd4BoRIXAdXFWxoYhGCz10besybuMdC+cZibKAa8JjfHNU/ZZqmbNrwUpijhfaEhhwtpUyG3Fypxd3NqXeB/TCR/DBUoJ5oKZAxP2vH1ts1CAOj5EgItY5ERfGurnkcFRxddIiaPm4OD2hxfYuUl6dHpzLqtCWLmiEhFaBVGUi+DHcKZQKx2VRyTFyzcnnZIsQjsi7mOYDMjCoLxCgphQyZJJgz6f1oooyikJKVMQzjgatQMZQytCuUD99HMkzIjMfuNl8eHjA2CjWXGkpJeXLMHgvLsjgvCH5AUOzddrJsG05I8xbMtON7CAH1vLVao/PdmtdYjhIsjXdDEJZrPQ/C2+QrWcmWsmR9ZBO205Prc8zn92XQRwSgJBLoG5VAE5QrcGkMVkE0d3YkjRAjn5PXWIE2GXNv+LgFIuqKnPeG0ti9I7lqWS6efSXT81OGPwjHwAyP3BBGAqPOnCMkWBOUCVPi0QoZEPj1ZQQ8WrksCyvrpOE5Pjgmdg8levRoB4DhDIEcGHGFNkYC9MvD3HiiT0Ot2Qk/lNj9K+KdMtohyC2jGDSzoRieoLliaHLmqERN4DxU8WTTEzyPs+n6IEyEhuugkA4U6YOmsHKSLMN5YFS10IPoT1PSBlnzYEwO0Qro+dFQnAw4GYga/0hGnOHIo3FGVsI042ASEVuc77E+hNfzDB8D1TNTdGmoGLTOUDoOMsECx/PT3t8g4hgbooD+xfwJuu8erpliuCASQZvPS7lSpgIgfPKpOPzbO9RuSDhvQMp9ACUNUk0lQq6kikEPBkUBpIXl6dsVIyoEWKkmUgqW8aaSKQLiI0QjV8E6Dn7eC22QYoIIQQ2LHBmMMC9wJgcbtcpgQ1lekkKzwY2rz776SprZnHQOD7gBC+VkKEZzd08y5aJcPvtGUtdnJDlAolqr1RkKoxmLZ054PxQa6AJO8olM+z3Jl/LSQYhXrcvy5ra0e0M52T+WfCZH6h2QooHRvttrE49WSOUcOB7Nd8ejrQpl9wm+eR7DA2vP1+CF8Exq9bqkmjsbVAwPIeLYdMq8wC1ciNik57CKjCtIFNIgeeQDHJIpXSkTAbMAP6xuYapUa4RJX7fa0kZJkksNhXssOF/Nabuu9JCE51NgU5TmQkNKubxcnp1ypgGWwpPmsDrkpT5aT5YAw6JBTD9JY2Ajn34PrMWZx8Dv+3u5YrDmT7KzIFdhnKtJOK/D4SemSG7FncnDzzN6PUNVlLWhGDGQkbtKjOiAA0NYaEJPbghU76nMqyebSQyLAzwMtJ8AP0GTtFik5UYFrN/Dc9YeL0c40gVCewrlmlz3J9LY3BIplaW+ho1Tffn297+T5WpF2gfvJDUYEPl72elzzTH6UxfPv5JM75pGED2SYqks1WqdVUQYCygGDAEbyhwbwhBZn/zDV4Oh5AB/aSwxKsA+dJBkZCfY+NUmKSAmABHycErWjF4cKvuz8YXJXm/XP+eFUroxVr8wK0JD2dhen1EMaAzRttwZ0ZsB3Pkve+gVeg9WQawbzRCauYUmpPg/k8uzUcTGzWTKBNrJlIEDGnf7cn12QeWA5xkgB6mWpTceChB6WxubUsjCjb8kO4nOmJrHIKO6flGY0By084EAxuXYhGL42Cfr/NqnCRXD4QeueLzvsEhBQKPTtWi1hKGmQ70NkOfXxTlqu+YQ4Acv67QvXkxQD6F9IKwm8FkLxNyMpe0zwoamf8+fTxha8d5waTlM5tmSGBtiggdEOKWJL7r7OkpKg1VekObOnoxSWVnZ2pbjs1N58cc/ynKtLB0s3pxMSJ5w3unL4vYeo4LzV99Iutdi9ZBkbdmCVOsLBgNp2RSZ8maxmMFZEaxSyJDgulBfIC1ovz+SWrkmuXGKm7KG8BReLcW92HrimPzAMQrarVYeFVcML+sStzDzFYZUMJZ83gtba8wx/DDVvSvKdDjSkqp7CNc4hxn4g4g9CHgO1UtEFS3bp7y6sS7lSo1EbJji0om0NIFm0H7s7MP2ozEUA1Y3n5Pt+/fkrHVFPtH1tXVSbT776hvpd7AcRpUPj9IravQCvjDdLLknVV7vQKwfxfkWSvk9e3KnwEWN52OeIlW9mAzTmphGUR95UEu0GY6axQ8NSeiZ8bmqyOiWI4zTHpEj4zzHQKiCChIgIrC6TI8CxUg855l/RhU2juxgY26WyAF2pshIosUWhZ8otSpKokO4+2xB6uvg6d2QcSojG9u77GBjJVyzmJf20SGHuYBrumj3ZXFrlwjmy/3nIl10+vM2gpxjaIbPAXM7DReQzmTvoBVF1ssZoEy5JPl6nfCUlOQkjw1HV23uNk+BNZ4MHzCuKPMqjb9+cUunDSpp70E5cFVJoq9g5Dcy9P4KwvK1/BEphr/IS32odePDfUDfH4Qrils8j9n5AIh8tYWVuDBYHVvvde/+faJSwT4O6DXmxfGQETZxZgGME6DvGaiVhLdY3d6W635PaotN2drakf13+/ItOKBI/65EZMgjqBjG16oN0ZtkY0y6nHUjkXzj2gnXMNSsJ9sckkqw2SGUchBgiFfybrN7DFcMTgdyK6rOaXuugcIDDI+gbaAAACAASURBVBChJ5z20/whtPZ8bRpCVWN1B+eFfMANE8UhEUqFxso9Bg2aFT/A4wXPm2UnHJupBnxP5lSQJ048gpAbZamiNHfvS6ra5PfxDJ5/+0TO9/elkp5K++RQChkA/ipy2e7K8sYuN8S2jl/KGIqBBTsogGQxIlDn/WOgDeOreB4gWSB4lWvgMtIbT6Sy2JRspcwJTcgTqpTT7kCy5END/wa5qm7HIxKcp2vC74pGLJsqXewxTMITZbwoz4jrVmoA3WP4IXoSiw9D7duFLGn18H0Hd/nPhlh3mysozb1XemCZcqhMNKVar3FBO9CaGFABxAEDSUi+MJGGwfgM6NkR/mDAAWW7WlUefPKp/MOvfi3ffPWN/N//1//J+QcOBgF3g5InnI/PN0DJyLIeZcZmL9S1ziiNlT1Zmp1gSq4sjUaDQkJwIitFenS4R8b4gHtTmDVc8xDODYXPa+N3PCcIE298n8weiPHhKS0fQ54x42Gs6wK1r2JNA5DH3S5DHq1UaXIeGrQwlArdBj0kvaNNBxo8Rp2TKqMiFHQOBz64NxiSsHr90c/l5dG5rG9sy9rymjz76mtpnRxJJY2d7CeSJyRGEdMLy+tEQV+fvpHUqBMFM9gEBb4tnPMAs9t9TDqOuSWKlDoo7gBAmc5Ic22V27gwZtDtdGVw1ZYsGCEJyQYMByVdJ7K1HYN0FaYgUTdcS7lRMm51XSgbG9lBXjGrHFYwChXDE0IXBDSePOxwxXEPgQflyamXN6cTdLuV2oUVZY43a4kWVajllRUpV6pkLUSFAhCJ8XjAg8JNZwGHmiqOCBYkhbVbIA/evSP3HzyUly9fyu+/+J2UijhQdcd9IFYHIy3j4jNJs69CxtDIqORVurX+rYqsvQAoYaVSpvsEGrQIBLDhpNBrQQECD87f0ycKVTF83jbeUREqRnQdVpFyb4vzgsfAeTtYkTkZK1GeH2lJFuGmD2Qh3NGQ56ZihM8n6UU8x4JiELRIobDKEMvYmHPW3RPIC3FmKIVXl5alsfdQXhyey/07D2Sp1pCnf/pKOhenkpsMpNe6kHwWjcIM2nWy0FhlNNA+fyvpCYTf+jIwXiQ1yLHcjXkb5DVQKgZGI124g53h6zu70lxZomKiYta9uJIJejiGJuZGWWWiS4S5nkMobQ5DZw+lHCHL7UmWS4aWwyYbo9AKehYqRjI8woHNUwxYO3gA1KVRZUAWjwcMb4HOJC0I42uN2QBvxowCHrAO9IPoWbWdijEEI4hyN2EvJZd+wGuA2K3R5JL4RnNRh3SuWlwnlsmjepCT04MjJu30GiRCji01Zw6A2ScdvnIKzVhY82pYG8CyMnawjbAOAUNP2vdAf8HL1RQ4q0hpPqMQ/fAL96fM77MLFbUvEvddYFjwPSb4GBBipSZ+DfogLuyYelR6IAVXquHS0nIk9AGDuX8v+adOCGq33Q2E/6lLKrPqMcCgkc1Kc21d0our8ur4Uj5//HMpZwry5A9/5LTdqH8tg+6VFAsaLuNxVmtgNu9K7+oQ0ygs1TrWzFcV45oRShE8yIQB+cJYJlgSmkrLzr27srS6wrmTi9Mz6V+3ZNyBYijwkMEtdx6Gq4ojkY74pFQxLBl3xYA4OMQneGhelQqf5A3FCKsiEy4Fj1/u5T+4dnQHj46OCIWmi0TZrlLlUBOUAKsAQKxM4QdyFlAOm8Hg4hSj8UcTD/B29DAg3Bl6jBQVo49BIChTIS8FkBDksFujwA2thXpFlhoN2X/9Vt4+f0muK7BmgDuJQDzuVVDLQroWWvdYMRgymjChr0ImETByoFcBJg5Wj7z3YR1Xq0LB2uGc3GPMGA9TsHkCG5aXPWSlZzMIueahHrpRLRTJbBQy7rn0daqwyeeTDKHc+/PdWJ4OCwgA5tnncZVxnsR74G3CuoLF9Q25zuTltDWQv3n0M8kOp/LsT1+SPK3fvZTRoCXFSoH5GVZBVyoLpFUdtk8lCyIu9q/8mBQfphGP0tSQfoETkoAUiRSqFXnw6SdSqdfk3f47OT86ljE6/TB4BFBphXME8mXzpnpGftdKHh6VblmkCBp8rhiaX0dfYbnWpT1V31yNJD9s2imVYewxwlo9XgeIBrwF8EpMXrHLeWFBuhjS99BjoF6BYYNkuBUIv4vYEW1+rA3jxlIsCUYJF8UJQkqw+BEwM7hYYLtRQs6z91HKFbFFReori0RuHr3Zl9dPnhGVW8oX+T4cKeUOiVgxOBsdIXGs0WdHwx4MxkqjShQ8BcIxMGPrrIiHkEoVZOzifLB6fFH4Ym55Xo8lrPy5B/FKGvMVe8KqaLFiaOdcMWGq38gH1Mu8L/lOegxaUZth8LNg6ESlQXiaEzwyzPaDsKK+sirHg7GMs0W5v7Unk+u+7D99LiPMY4zaMhx3VDHIATCQcqlOxZh0LySXUrp9yLM6Vz1D0gc5YQT7N4B2YB5fZGVzUx7/DNSpIi9fvpDTw0MZAfbDlWDMEPlMQZmgkmXcUB4aUukSoVTAJ4Ubpcf4DsVgESZUDF64hQGaWYZwj7iJ5VbIhcUJvyoLdXn19g2VhZ5iQCwkBRiJG1hIMGjTbmFKjzgN6U/AX6U1bUxFMyTylDePSoUyoiM8Q0c8h8QwLVJabEijviD9dkfO3h1yO2sR4DjLMRAjU7YQixrDRISu9TDHkmqEP1V4OyyVBNcTq0O61RQhiwqTmRhDefLwzAK6kFMQ6eJj4mR6lqCxFIarDCu8F2IVM31tXFJ23BmNFmdRNLZWAonZcIqqFCB+w89VpdA5dbsgnj+rZ8buh0UDWPkF1nZ4/+JCQ44HQ5I1r1aaMrpsy/k75aHNZrFR91pK1SKrTp1OT4rlOqn/p/0rKgbbd1Rihd5EW58YgmpjD+VizMejnIsVDc3VJbm4OpeDg3ckXptiWIu5gjYusFUdijHkdi1dD6fPxipT1lXX8rx6/egrVAz/ZrSqzgoUdn43FCO0WgCeKYLTklW6YpT5tKausGClsNnZ3SVs+vnLFwoHx15uVKdSKVldWZW//dtfSvvqWr7+8muyiwPyDMr+q841iX7RViIVZuTLUONUyHG2AII1nT7DfZKmvVjk+5YKeTk7OCJcXUdosQtcQwTF7es+cHMe6nYNL0WhhELm81yOCcU4A3sgigEkIEOt3OrjdpCuELT+Phtggu+zKrgFegwoulPU4N+o4HAft4ZxavkRc+s4bDS+bBtL436FJuHoZTB/4XyC8qzGuUxkTnT1c7T1NBYMbCpy+hnOgbDQAw8IV50nGyUUI1euSblak1y5KmeDsWzcuS+VVE5651fSPsGm3UsRkDwPOlKqYmYiI93ugJSeGGmWUVsy2Ehrng/nj2tHLqJsKdh9qBAiMKCDU7dWrRNNO5gM5ej4SFpYE0DrCrnQs2QxB96FnQyya8/0faAE+lwSZVzvY0C+6OX9YapX5lu54YDxQC62EIRSsWrp7/IhmKEM6+NQCNTUkYTj7xjtxJ5wMDrgYBirYx4bU2vptNQXGvL48WeyvbUtX//pS3n67RNad0ypYXEM4kz2GWDBLBZWKIkmxJ4PUIhQ2hMsci/L7u6uLNQr8tVXf+TCF3R0MVhPYWEVQwsBBNwZEbQOUSkBG0I+PBzMPO/u7jC3ePX6NX/GZejAapHpL+40+zl4qBSeiysDcUCJ5Szhv736xzIpvUa8ulcbVXF3Vn8PVwGhRjyP3gOgKX5useCHeU2Ye9Bx4vcRlVr0p7VChDBKKwTeYkDskQAXKlUp1eoimYJcDSZy98GnMhkM5Or0TEaYC8Hat0swB06lzFl1nVpElREDazLFuSklUaFQ5GAaloZi9h2KQWohRAvkAgPNJp6DslOy8mazOjcR0raD3LMIZPzWEPW+qBquWUxcXHI3zx8oBj2wGTZGTOi7oSL6PsWAJfB01QVAk0H1GEjCvZSIw0dnGgQC0L7+EAPy+HuKSyFXV9fl4YMHcnZyKk++fUJ8PorfGI8dD7q2FJJ2TE0nx0Z1ZJTJs1l5NMHGkpdyfVEePnrImeEvvvhP6nwJ3djrK2JoqGRjLXmiosNZBzDeWiUKD1K5UNO8jwcP7svZ2TljW1TRgCfSMXTtSof5lzfqQkPifwd0P5rJnskZ9GmEuZr/2yfU9D00WQQdfeTtbY1vNlukcLFM/h7F8N+bKQAYQkDDqLhsTUOEZi5oU5ELZHIcHgNlUg97FFN5lsuvLy612QbqTNAAta4ln0kRuYDKEsnjCImBo59IuZBlHgr58IYpKnAIs2FU0ZOZLXTERGrJgkJY3AhzKuUF0K/QQIV/D9/LjVP43JKKgbCd7YfvUoxo51nw4fgAhE/wFggVgJXBvxETXl+cUwNBpNbtIwFLkdIS/4OaEfv6WpfXOteNUU3UwVF+sxhRWwOmICQuw2ErRAU/IceUZKW5uiWff/65XF6eybdffUkmCtDH7++/I/sykrxsCvgtWCgQOQCMOJVquSrFYl73xl1eUugxL7C+viYvX76S85NTWjQoDRSDCbg15RzrBKPg9JZeGXKFgzIzcgu8hucSrtyuHJ5vUNmN58orKu6p8T46MgtiBZRtgSEayHgIRvPZqmFSCJKVMXY/WIUaK8+V5UNcvQWeL6h0Jk+OYlSlwDiJfXprG9s8FzzbUb8nRcLT+5LPpGUBnMYYT84oShkl9GqlSKXBF5QYjVxH1kIxcH6OOo4byrGAx+FhbEz8XuYpxm2KME9pksYsqRgplNuJlfrAUCrUSlhMhE+4WFhbDP3jgvffvZXW5SUfJN0iZzp0Gw4h7SylAlKh25SUKkXDFn1/hBQa9uA/NH5SiIvpfqEcWsYdp3LSWN2SR48fycG7txyr/fSTR3JxeiL//d/+P5kMhuym5zN5zS3gcbJpKdVLsrd7h4KPzUwX5+fSWFiQX/7tL+X6+lL+8Ic/smKG8ADJpI+SeB7FCTp4wi62ySog8DbF8Afoifm86pFj0mKPYQkkzISFsLRyRN2C1a/CswDvLXo/wA4llSH0FknF8OuHSy2hUmhDaVr+TclCc0nqjSXmF6BLamMJTyota2vrDJNRcQKYD4z3iCXQrcf5FbDGjbMtiNMUgYzIwdG0yDkBO3EiPO/wz+Rf5l3deIReIgSChufoe/mSHjLpcZIeZZ7HwPfwOcr9ggbfLYphkhqFNeGbIx4ks99U5N69e7Kzs8Ou9PNnTyP4OlCgoK+nQBuZGVG70xR5W8m4jaUwA3S/NUn3+NBjPgINrSLk7wGNHqI2Va7JMhpBV5eytNiUf/z1P3BZzf/xX/8rB2C4yJFw5gnpHuuLdakt1kkTg/Vo3371Dcuujx4+lMcPHsnXX33JwgAEHzvzoMCe56BO7919nTWJ4fihAjBG5Qak2Wpe0gL6WbqXcfJnfWCeY3g/QxWDLI+lKs8T89/DfkcpfII+UzKvCBWDoSmo8625hq2pOpkpmiPWsOdjS1bWNgj2vGq1Sbp8cn7GZi5GkRGCwcvjfJRZEUNdIE0AXRKgMgN6A7IkYokN5m2MU9jzKQ9nwiKPXmfQWEiY9dsUQ0PCmznW91EMyh4MhY0efLdizInh/MHiQD/55BO60N///vd0l/gePoAbglDvB18Qw1pAz8GOkSYxAKAX6Oi20NnEwIrPM3hcbkNOOjOuN08ULKbp8iUZ5zTxx+FgIu3R/XtydXkm//lv/xaNSmJXNHD/W1tbcv/xfUkXcvL6zWsSI3dbbWnU6/Lg/gNWx558+y3Ha31/OFM4VrSUwjJ017gWB1fy3gIeXBgLH2TykGleaOBnqBYyFApnvtAEnAm9KUa5XOcZYP8FVkHfphih0EUGjfAYIeUq+KWwlQkWH2z1mxub8ujBIw4TYSsv7NG7g0N5+uwZx1HBEol8AOEywX9YIZBB+TjF5fZgLdTJQqV5xZ5BMi4aaDKM7XE/7ilCgKrOoccA0FCpb1eM2DD460NPE+bFyecXhllRLo7Gsheb3GPgF0OrSLdn9Cy4sDCBwg2jIoXkyknCEDs6DxI+NMQJMWaL4XjR3AI65Hj6pIIPIA28aFs8CXy/g/E4CoqlMejM1haY1J+dnVCYa5WydFpXcn1+QcQoQinkGcgnfv6zz2T33p682X8nv/vtb2nJsHcBcGnMVGM9AZGyKJvahBxDIM4Zxx3yUMDDBzHjqm0WPPkgkq8PFUNBgZp8AvWKvAqVIpyn5jLIs3LSaCwRgQuPgcGe6ST2XOGDTsbcvG5WGbPc344wCtSj6C/9/S9+KRtr6zY7r8R23e5Q/vDll7K/v0/Sbs7f2ziCUsZqs009p1ptDyvVCoa0fbH5T3q0WccQUxGF3w8FPeFIrJmn3016jts+a16STn9l8uezGanG1hoVhmFASINvexsoo8gTuPFTBd6ViH0M2z1BF0oPoUNOXMBiVQMPMXTwXyl1UPNXhdH/YK1gcVqtDiscrPWjqZfXoIjWh534lEyyWSktLLCMeX2tVh5x76DXJWM7EkOsKFtaasjm5qYsLzVkMBrKs5cv5PDgwMIdxTqxo+pcqLxB5dUiFBoXxHJvYiR2jvuODlzjwKiKdlt4EwoyOX2NeRwUlgxPwKwyGumcudHaNBrL/LcqBrxhLJi3KYZ/n5cFBCt3YUylXinLLz7/XD59/JjhDp7ExeUlFe/k9JwkbMcnJ3J5fspxYuCT6N1mIp4AD+bkEFrmipsygTS/V8gZ1M0Lp8JS9ozKxIwtP5ZiuLa4y3JMjj/sEHUbJj83LBOrGta8NwyQsu+pcqEBCIGHkDLWxb5vLMPMF2ShgR1yUzk/v+BmJF2LhdIwmLfVmrAShhXEKeHymg4o9XvYz4dmke7SoDWbjKRaKcudOzuysbEuretLWr+j42MKAfeP9/pUXC3oam7AUqs1vRAjQ5Bgqf15zXuwM3G8vdcMk0gS/5/4txoevVfoITcGgavLsFtqlVNkzGg2lwk7RygFekv8n7ymMHyY8WQ2jwFyAgxGobT9v/zqV/LZJ48YAh/tH7Ahi+WPT58/J4QDlTsYG1wNiCKMhi9SEG+iG0gi2mZEAOgN837Tss96htsU45Y3IjpYF8z8KB6jub2ubOfuSgyY5gd+I8QxrxFeLi2/LWQn4wD3v2nVAuA97opDbFoAsVqWioFkDZUidD1B6Q/aTigdy3p97PDGz3RdMQ4ZIcVCY4HNQniOk9MTWjhWrsiqgb6YrQ2YjGVpqSnbO1ssIx4e7rMOj4YilQ2d2o6yicAT+uScM3JwQAmegw7uJhF00tWHAkiaSQMD3ubObwqzcippTqJUN1DGCDIyTZFortlcYR9AFQOkDLcrxjwPQmg5LftIdrY25Ze/+AXXUqPErfv60nJ6di6v34LMecBGIrvPvoYNv8vGKzwC+kTYZaKGxf/Ey7Gccg6z6Q0B/nMVQxt5cZEi8o5zjM889YpysXmh1OKO8kq5t/CZAYZDwXaesPpym4ZyWgs0i4QT4+BsfwOSsokuVydEmaOJgNKqYqCZhp9xwgv7MRCCGScs4dmERKeZ2GO7JxCTWEt2dXmlE2IpUN/jqpStECTKtVpFqvUKoQXY8AS4yaAzINM2FBSbejQPwnCV0uPEgjxbJZnnKeYmuM6/mlCMpHHxEm/8sFT51PopR5f3vpnrTISVosXFFbkGn+x1m8NaCKWS75XMbcJ/E87PStREHj64J/fu3iVSAVU6VJ7evtuXJ8+fM0GH98BrQVHDTj5DMeWMVdyThYwwRtznqDRF+AL2jfu8P+IrYnz84N8xsoMfUzE8t0jOKLNVbwm416D938lKS/RkORgEXlHlDoK91z6FsnIoEMx2wWU04Uf5z+efW50OBRb/hnhwVTHGLTmOrIA8TO+BEBh7NBB/p0FkRq+R5oQgqyD0NBMZDLDzbyq5aUbGoJ4k7b0ujMd1AsYwM80V9g8ia+kLS+IOa3gOoccw2Y5Qrx6G+utdkENvopAQV0YWDNVM+wKZiRBkt7S0KhfoQLew2gyjvfGuiHnydCPhn4LTq0CPsbK8JJsbG2xiwoufnp3Jqzevpd3tkd2FBswWYKJJSmwX1yBEdllAxUx8m7F1mG+VURo5yccpBvOSIMfwbOP2hP12xXifboXv916PsbS3SY/h+B5/SAyNGMMZ4RpnKGLanNBS4cM8nKJnsWEYeA1GjsZrFB2plQ75fpkMS7ccYMLGUYw9RuuzplKuVuhRyKULpCx2BYJAGhAEAAVR2SK9o/JXwc2DDBiCTxwOKyYg58Kg2pSK4FuE0EfBs/D5CwVqGajM1vtG+DMblfUHpqBGt/AaTsRWX4kaeB/0ogYc9E1VxsxIBWBN1lnzlFWFc+ZWDbMTJAy82QTy9IphYGrCxeMxM6K/lx1ymPt4X2iahrdF83UkW9tbsruzQzQxGp1gdkQ0BRRDG4tpJlOyH6LknbcGLT0sckMLjzkIZP9H4E8OEmE7rAP5DHdHBv1Y9EOfrH83+Ltdf6QYdl/xWFKsmCGH1Ic6Gq/Qxc/Knhu328bFhdTyXdDncDuLaWyMWVFAa1x5cA3zrq8fvodfcb3ZBmIcms1QShGSOiwTD5eQ8AxrttIphToYizgUDGzqKAlDWLtYVQxyBu7eUDQqzgxMFMqkg7kJBa1paIQyrzKGK5GaDuCT4Y8FAR3J9Ll1dmuNCgcnoahTm+sOoNzJZDv5QLhnx5hIvI7vXkPDopiogWqFc7HwBt5PQxboilKhwhtixRsqV9V6XeBRQVU6HYK/cRD1V5LPyUNf91S4teEkJ0PJchHMnbt3pbm0JFcX17J/eMhnj7Pj3PcEJN19uTo/55k1mw0pZLJyeXEuPfAFIwrg09Tx3iQTx2zl6sNEdp5n0CEj/dIx1fDLB8/me6ZkSOm/6dxh4Tv5GYXwlNTKvQ2uASDDh9VocJEaRs02XMLqVexJdCYgDCf872FsHeYr7l14IcarqrmBkrXh+6heoTEHN9/ptjkpqCyDYCAkFTI/l3ijFOAZancAUYkQtXidUWuOgOIlgYBeL3/XytBUDmvMOdGBJqk6NeY5GAXZErvbDp7O0ThdXDHwWp9zuZGrkVnR8L8WoytLvDabQCGDFW9oqoGXC7gjVtSgGEYno4UPjfnDKUCFnhv8HuForiS5akOWmotSqdX4O9i1DZg9hpRgSNCsI4QnnyM+CsWP3b1tKWYy8vbVKyoLC/djLMdR60TLPbNgPva8H6YW6mFvGJkgcLupGDYaeEua/7GKERagKL9bn+xxcQxWgblwOZYfcpvsXrr1g1XGQw6XQnqP47sUw8Fz7ICaIOF9lTFDFQP4GygG3vPy6pyKoXmOMeZhTAWoWXIz6T5tryCp5iv5cx5z6ER/QjF0AMlhHbBAUA6CIZX5Idqbp/5TQ8yPUQwKiilG6B2SyXqYc0AxnPOX8m0VeigIklJQ14DNr7awoAYCM+mjPulkdLIvFikoAgoKOnWoGCiUgLE3sb68KoXSAj0mFIDlWEBybKEmfg/fr2AZaaPBpByUmKurS0QXtC8u5fL8jEgBfDb3U8BreGJll2GNsQ/VCb7up1SMpIELDbg/p9Tez+9TMQY9pYVxIQg9QhgqqTVXRC2+DwuGL3w/7HwnNTC0tP4e7LQj7ODBGLOH5SvIO9C3QJ7Q7rSMaEwJl5GoYf0uhlvwvkhGFULu03IeWiF/0XFahGhwzbgu5BRUaPMauB9Ux6AIvlCS129Qlo9RDK6xNHxXmIf5e/g5hG7bqX+89q9ph4ZSzJ3SGbKrQFhPT0/JeO6LM937msNQBLKRUbuBg2LAC4CkWQjBh0HRhSzoBYHZA5AMhKVAIcCglKtV5iLnl+cymQxksbEo9XJZWldYYX2pxMykC1U8Wzz9Y38LtfUDVOSnUgwn1ZsXSs0k5tuf3qFiYE+CJ9F+2AqH1v9d+ClEuRyJmSFgeFD4IuoTBGoQ3KAunLSU4fto+VYrHmDBjj9fIczkv8W1sWavYqM5SlYKxYquBsAADah4UHO3zj0+00uxhJHgMxAXA6mbVS4nMvpxIEkJp3ktZO3QjrMmzjpb/7GKgc/CGYYwCQ+nPKScUQxnHNFoyCnejIpI+zQgRl7AjPuRNilTnGyzcVUbxJqpQjmxgtNwIs/jGKvy+cKwMD9jPoXrhVcp0k+SFwz5DedxxnLdumQBZBFN2OFQOlgxTLaPWcWYaer9T6IYobeYUQzkGMwnUD0xb6BJonKnQsCcSNh/7vQ5EEowhbhiAFrsvLdJj5F0XwQEMnbWcc2QVAHJK4QZ3yPPkikaBY1xdU6KJcxVlHTiC4JiCXI4KwHFdYHEc8rnddE83gf9Ekz5+SJKDkXZw4wGkSy/+yjF8CU1cxTDvbAbB1ceKCBJbaxfoEm4wmcYnqYz3PMNWPjh4SFDKSTs6B+EhscT8HCQygF7/B4hLtrh5zpp5pGKfsYV0GvAIA1GREbjOedKBbm6viK1JjBWFSjPWFG2rFBFHkM7MHGGfDtadp4D+Sk9RvLzvWgUV0NFUo2dZZZrMYPrXEeuDKPRLEuICwgabWDsw8ESqWrzCf6BSS10T+APzgWDioE1Y/kCE2yEO/AUSl+ZkcvLC6uKxdeh5X6lekE44B5KY+sxfxcKS4xRUBRgR5kV1oCN0J5jVE2zfkJ0nV4imvMkk54wDhW90qqCEVaLwkbizFmQ5l/zOT8b3KOXWdE0xUpj3Jsm3yCo89VwtovEql1+zzcvWRNlYp5m+VKoMGALZChqnXuyhmBoB+vPwP2FfhA8qxHbOf0Ht+KRTzZskM5O1H1AJDUTikVG1HZZUJ5uVKWc1CGe4pux+Ld4LJ/t9mtyYz9jQOCJF7aXuGqMHWiGQZiHRllUu8L+AF3Y8VoIL0YW8TMkg7DM/sahcoReInk4rmQ6r5FlLoEHB+FheCVCynd/0DFBmCoGMEwY3olYEG0eHL+vybVWuKLDwqox248RfTY8JHMOUPvb7mzSBqnhAwHabaCf4dhzLgAAIABJREFUD1GMMLTB30MlDhVDP836It5gVD9pPSBAQso8m067o7kca7qzisfz5tz8TFBjR68pfVg98iok4gUNn5WpUD00ngvWk+VkNEWojeYoSXCMUEB7GNp3UfiMezyFanycx0geNM/uR1AM9sOCa8OZIl925EW0MRaKwbAG8AxDxqpgoa4fl/9CxcDroRweknioA4vnsfO83MJfN3NovEiNx/G7mlwrr5MqRcwgqIKGf8P8KyLVp+D0YNVrKN9SQC3DOFvpgPwz6K1Y6tWigVJlalXMr1N5weY/4O9SDDcEoQK48UjmAuzwcDtusO3JUc0GlfH8CaEi8xQya4YkrKrON0MSqrhdDtxMNMVvXBo2D+Jrqx1WCeMDUgDbyguAJhk7bEMVPZt9vDvW/xkUgwgKC3MhK5B55Ko4Xx+55fkilKKwYHjFLDU5W0ewoJYMBpuL4phdm1UuSB7KxBbckmV72LeFWVqvRSgR01cqHMJhGK4Mcc1mMgU5GoRaO8oA3ekePC23qhK7QukmI2fh89xG+x9q/Rg6cum8shBGXoYe4/spxozw283PJNzeE2HzWy21h05QYlyf/4/rotAZ8TNZvq3jrLMPtjZNZxYTxjepGKE30X6QAhh1+5Feg+36gDxAiEh3SfCclq8n8bSl94WjUVzvhv2VeoyQWMPbC8ilIDMefjPXWLqzpiBCapJ2pCHwurkzQhxEVtQrVvjlOMxxS63hQhjrJb3EzTiQYqBdaa+ykDLHY25VjPCLSyNR3zeyLW49tbq99kFiUjL8Lq4JQ/qutJGAEgGs7w1v4dywEZASAkLBu/n1XR5jNlTS358XXtDOYxkkpqi96chhJV85No43KZEAzpp2EQX+3Mub800LpWZ+4gxMFsoRLg7YjRoDsjOSQFlDTgWGOou4QWc04lMcnN6k/vGhlxW9bvYZ/1ihVMgf5R/tcuFYQV7/6n1dTqm4KLs/koFhn95sJzWpFB5eJcuSoVCEIZgrkysAk16y1cWwd18eyMoYgHLBwcVGCHxXmFm2kXTMNBnFDnILh2QAIwVD6IwmuiBS+yaAf4BM2UcweQ+26EX7D6qPoBb9WMUgJDuY+9Z59lhcQqFRRHIOdHNUHEwUgoMJ8TUsGJdt8joVXMhFm9xWqnMuSSP0fnlMGhkHc6jngNfQZ6cVMd/VDk4ccAIzD8Ogk2ObPJKjYpgBsbGDWeTTh2iJLZCxlyqOLEZU/FDJN8JDzz3dI/vVzcjn+qMdlmuRcHOoyMFUvC7lSqX1sIPC3/mQjDoPZ0Kkqr37vKqIJ7ve8Io8A6VFP8PHaJUGX+vzycaR1j4MvcuHqMJGSn+Dl4DEgBh9Tpzpjg900YnQhWABV4X/QD1vPZqoEUcvCMHA/WnibRvHb1j7ZD7gh6vXrRLD9zH7qYJiYY9ZVp0lALN7TqbZPAeoSGKXy8gIgMr2NeH1ivFSTlaQG6syhLudPkTw8JpkUh5w9qnr0sKDYRtRJmb+Y1tn+X1jg4yEyYaWOaNhuq/PJd44q89oNvrga6MwlQhPHTyysjWfdQC/ISn3zJdjtAK8b/Ca25J/oIaRKmgT1MYtgvelR8F/m59pg89ja76hHUB6qmGRCzbvJQAV3gyLFBQ3IyTBh87zJCoj6jE0hItLlsmbU6JpG05h6OyexjldnTdJlQK6AsVgqdYVye7NvVyc0Ou9qZLE8BidPLjJRBieRfJ+YyF431imeZEU9kJkJQ0S5Ro2J6VJ8jbsdakYw16H89ka12LiUCtDjrr9uKBlXoBjZeVbdUtXMiQrTdGzMXmN/q0Rl2KozPD5+d2U7XiZPYhr4p0d+qahYty8PPMmt45Ezb8hN2jhT5F3RF9wDLjf7Z/fmzrZgCcjbpGyongoF17aAft3MoamcL/nZt4Xc3uI9j7FiJVQvYHCmBQfBepK9zz6PZ/s0qWHtD4stxvdZ6DgSWV376H3CX/h5UuLnYOkct4Z3CpfZgBunAOZ3XNSqDVIc4pZiQE2J3Xb0u91ZDLsR4oBsJ6WSyl2UVXpfZ85+zNV8g/9UvHMkGPqNmMXykaUd839gGSuNlsKh2IQdB8MjP3FFQMK4fVbvxhyR0m8N87vNfQYM1oXcIaGrw1fM1eZnF36Fo/h1zNPMfShqGJofKyzFVA0DPyr8zPGck76zdLgJB9CGGN+X8WY50VdYMLwK3wd2P6K1ToLBKCfAcSeytFrs84UbQai0sNXKL3+x3/9+YoxE94ERiL07gyLrRgWP7+kYTEF9VD9r00xEEq5pQ55fjJw76DmxZxC4DW+SzGiLnLCKs9TljAxnxdKzfsdHjQXumiSyM5loBgxbB1Qb/KfK2E0J/1iq+WhlPdP/L7+XI8xTzFCqxp6Xb8/7D/P5sEBi/K39WGw2WkAYjoHUPm4q4VSHzjX/EN5jPC+3Msme1aRAbAJBq9u6etvUQz9IcdtP95jeJ7x4Sbig0Optcd7vGTvSSCRVsaMLIfdXTFciEMLnhQCLftazDpn1ZYfaOiW/X1vU4x5D0S7W/ouaPJBMfCnE3ZpUqXlZ93xgeoWSq/xtbkxwPuHWJk/VzG+6xEl78fPjNdqkHE9E5SrdSbGB7HUQN2EQnzXZ8Y//ziPYSesGKvI0PFvGmZG1KpBeMYizWzeokG2k0rMD+U0lNIBND2jWTbH+feYHF767pP4YMVYfbjLPkYoKNoJzxJM5rVdF2D/6KiSY9/wPIHlUFOKMB/xQR0/4PD9bku+k4rkB6Z1VH84s4rhr+GaMMqBCRNRpVo5CatjmpPMXrOHVN83xwgPP6kI4aPjmfESsb9QSSGwlNELEFQaYzFRGk/foOSlzRgn9N0iQb/1UTmGKwarVeahwj9DGNBMfqGZ+kwlzxfghF4kvGbsz/o4j8En+REZk37aBytGbXtl6rAKn8cA3ANaPgRb+Qx7hr75bQ8b5xFOqoXx6Lz3mZ0lmAWh3f6gzZrYkhACCTPoXGLmQqtannx7joF+BkIpMpEnPFry36HHQJqL3wmvPVTipOfzg0++Z2xtvVITPySYSGwvXVluSiGXl/2DAw4PgQ0F69KAfmVXPKqmKccTKldcPvyeYsDNM/x4xbD1OB+md/6qiCLqZnNUFcSI9lzhSOZlSN2P+STDUs37lfBcZhQwWBKK7zMUdxpZRA/g9YL813dWp/GAj5L0QtjQoOJ2oo9UjDAsmRsGBVf5YygGm19M6E2BQNWDeQ4ucI0Vw71Z2LR0T+HKwSoW4Sqzbt09rCtC8k9/KKHHDD1lqFC4sFxaZKmhrOFHJydUDDA6Ml8iHVFM4YlQl5uKIEjWCX+fsZoVmu+jGO5pPlxiaZAYMYVhk342DYs1TWm99eJJBYQd3nOF/Da/MGccduZsb7nkUC5ZqKHMWx+G0KgsFGPdrk1jbXSJccFcmxuga8PPeJ/H+GtQDK9KEWYNZOhooNGXhVKhoDv0IiwqhIpBzvQ5ijEvVwg9Rvh+fnYetiUVA220eg3zJQWygKDjzQ1DZIs3lkJrbPqKBAxZkUrUuvWhd75dhD9eMT5cHfSVXiy7abH1HNVKO/OiLdvk96EYH0ds8L7S3G0eIzQiakB1MVEkB86bVdtW7loIAzmeDFAFzL93Or/L8oeHF+YYyYeVfJ8f22MovEcVA2fvPQkXWj8YD/9CYdZr1YR9nmLcJjDzQpvwvsOf8+/8nLGUS0Wefaen1PmG5otoiTSE8865Dr57Xpicy/9LKgY/OyJGCEOp2MBwEY7lIOqltbkXLc5M3MCtQv6emvVtv5M0Tq4YakzTAhJxvqayuRJVxF0xcF2Y0PKtnn+uYtz2oH4MxYjn1j2UQtMIOUYMQQiTW4dzh5YkVoTbFSN58Enhn+cx3KMk3T0EI5tPS7FQYPjkBBO8Nnq6YJe19QcUrhIXTW5rvM6e/Y/vMdRrxNB2/Xz93AhexAWdWkVUxfAR2fkeI4lKju7peypG6NmpoCDnQzUW521rrVPl9eWpL4BEogmOJxw4GfoCHtv3hVJqW/XLPYY/qPe54h9EMdJAzWqDD8k3Q0CFCSqujcBIA0M6kjYxw+5CnfzTsVLzPIY/rBu/k+hwhz8PK3GxkujmVjwcEMDh9Qp/HrPhR/5fT1cZk2tPBqjfMMkP+zK3n/1PqBguEEw2vNyrSuJhC55ZjHYIZ0VmpeaHVAzPQT1aMKHlubMIZaPPqdrGCnsvGFnkutmcJt5UjKhEN5tHUVCCeJJgTBsTBTw5FKSkt5kJuwKoQfi69/1OZIC00s3d12C1wBdmkEdD0PfrgBNBE7oeesZi0VXiOw4iM9ZARXRGUbICQiLmkRhmj3ebF37FniBZuVPFDBG2M49eR1KitQjaaNXBLWvFREyH2sdQqEoYjqjltb3hwZjrbOgwv4egSnqbCft4Zbo5QWhvrmhRnaExJK/uAdfmnj5R+/LnEPTGkhcZAw5vXvt3hVKhkaL8emEAjCrgS17AfgxrcmGaCXVzKAVDkrAaEEBbIsVITH7CQOtqxpsjl/OOPbQEH6UYHG7SeBsVNCao4IvCNlN6g1Btw9rILOZHy7o+kqmo2ki4zU4jHsb7h32eUCD9XmMrbf2T97nK5M/sdpJlXnhsVkhCjgFrrmnFTKs8oVdKeo4QtfC+S7o9Wf14xbjtc1xJPXyN+jIMOWafWSgPyQ57bIAcYa3fuS2XC68neZ9eGfNnmsbsDqImbFTybybJEIzTWj/0fYphBgEV0p9KMRzorvQ4YP7AFJ4RIES0kclH9BGKYSvAwHIYCmxs0GYRoPFDuV0xbvOEurpYq4JqvWOMtns3Vv6Dppnnt/PCUU/GkxWrv7Ri+L35NYdsJorGnRVuP68fUjHmKomdKxvbRjBOxfCM3DXZaSpv8xj+5hFXgCkGHhbIk39sj+FNJwgK+aBo0X8cxcDoqAtk0qKHVurPUgwb5Z0RfANlMiYOcozIW9kEnwtZeG0ucKGX+66c76fwGKFi4O8hekJDuVljE3sGFbCb1v7jPcYNZ+0zKFa6zfikJ1aN4QPDen4IAwnfKFmjTvIE6HxQfHNhrjHPWn3fUMqq4TyoyGOMsZarr+70B/QYOlMdk67dVm2K7282JJg5v9uAf7OxkjXB9DPnKQbf0woJoWJ4WJWEvPjzfJ9y/FSKEXq4sDr4Po/h1/ZDKIYbsJn3sgSLDiKHMWiEUltrRoZgOxBs/xws8G0JmU/bJRuS7Hs4xi0BIny/YiTX0sbWY97v6ZCOWnLS7cBj/IiKgcOM6tzGX3W7IN0eSt0mmNbYvhEje4WPUb5tXIrOI+DEmnctLgAhxGWGTihxsD+1YnixwI2Ob0YKvfA86z4bCn28x5iXhzDFMSObM2rYVGN7nYrhLfE4LkXDZX5UGmr9rEXEkNn38Rjz9zXP/3SFMHMqwTiu8OePoRjcu2GM6aFiOLR99iFF9cmgXjd7B7cpBlhOUCGLSBi88u8r4GaSb3tP+14Y5s196EG1aoYB5a9OMWaN4bx87If0GGGY5oqBBmuljinKrKQWdzejHMNdd8SWYC16D7U8LvQQKLRGGmLE3eX3af7N0CReZ+yWxK20v8+MC2SpT5WZlTR0LDGOStofnV3XGem4Ouaz4eGBeFVKBdYWtrjcMSQjLPI2/Zz7fbynw7GTYVTSjUfVpIDmckbZDOTmXE4extEwRfDs+Dfm1fvD83TFDEMtD7/Cc5kRGit1f8whzAtXwnBoXojNjb7h2X/QB36/ilnSgIQ75tH55vk2TTHoMYA0AHuGzT2jg4mas6Nv8X1uJPJZXmP/81q0lq7iG5xXzQkPPX6QAS2MxW/+wGZjeu8AgwE8O0O49teuGKGShoJDpXY+v0QOwqSbvQzdbxf+nueqt5Uow7MPFSEpfMmfhVZZnwHN2AeJafK9k+/lBnGeYjh1U2hQ5+YDM1fywymGXyvyZipGY2+TTIReq/faMucZ0iBCzjEZwYuHg6EMwBLuoDqbEYiF11jtLGYLDybpGvGz+DAMvpFgebjtoYGHCYrBsVbjX4JioMHHcOQv7DHUE90UpuQZeHiGnd5OXj3zGsttMDiGcm0Yit22HdZDq1B+kucYenx/3rdZ+Z9SMUIWk9sUflZDf1jF4Fm4YizsbswohjMLwrWBuzSXB/FyjlYL+KmerQGmZmN/VYA81UJJHHokH9KMxTPFgHKwE2oryPAaLxfPlvPMxXH5JRjzFO/h+Y57jL8WxXDrmAynXJE1/FM4O1ehGeFcaDG98eqKEVpaV4x5eUtSKf33/LXzFOMvHUp5WDtz/3ZRP3RhYF4o5WkEcQWQRSiGlzy5i8KWx2RzGVLPuPWDbrIj7hNmNPIxhIKHT5c7PyZPxr/qMWDxsQsDlSW1/q4YIaWPC5n/DpkrImpJ7/5qjvGXVgwvO4ZGIQxr2ERCchdMTZIx3EY5Q2Pg/FrYFZiJIBTG2pJYmRyeEUu8iZAUP/f+xrww669BMW7zGPNyJ73eH9Zj0EgZ7U+qeReKkeOiRgqjUVySjr8EtKeGJwQUYj7DgHrUOgdDzmCqfKvR7EReOAbpY49Yc4znBy4l3LyzgbvV8HnzGzGphVK6Gs1wPsQJxVuZyMOUIGTwVWTRwEy0+UhhJI4K5btGyXc0jvaBcbbT98xyUXlkRYUxUrtojTFAjsG10rLb3DOuGbzCFA4Mjzlvl+0HDC/KlTGEgUTJNTfG3qSniQoA9gx/jBwD9+ZcAGHuOHvtPPToW6FV/6kUA+eDITBGIRuf700B6CKR83gUVXqYdwBqAUIEIzyeYgE0phAHWLxuimH9LMwtaCdcka0qzJ63xdtaY1eJUVMnHTMWcm5E8k6zAvW4wAaewCj9uXMukwOxqhUJ7NCNZhShnrIpqjfz9QEkcNZZV2NLjxkNIWzKGmjz4TBErhi4rwmUFwssdeEK3ge/o+yMeLH+viopcFuKqvQ8jXWNaKTSH75N5RFEp9ZPhdLAgBwSG9taMBQbUjIF0bZDJ5BLcXW0ksmxeR5UjPnXMM2xVcq63nl2vUMYvtwMWz7eKodocK3T4OxdGJz+1IiibbMvecJuUYzbQ6kYYfyBViuaGHSLquek3LSs4EExIIef/a+fT6EpvV5HhqMhE20OK4E6kkoxkn5vwE2h+Dv7FAafZzPPFCM9ScsYm9BTyuQXabwdjLt67wvj54y3KQvq+v1/j8N90YoTwuF3qM0gjk5lKKT4HafzhzBjsQoegj5OQ9mis2/M5s7HOwGqi0qYlhEqcWD5Q3mafFR4RBC8lEzHqky5XJECPwQdvjM1crgFSmAzH5QwhIOmGGncVwxqBFBXvYHS/tPpkh/YG5bOpKFVOrwW21O9lMnk0LiloBRY5MIzC+Getqo5Nr2xyPhY7CxG6bt2WXy8YuB+SHSJc7SuvvJ84TzNG+I6jUnShVR5JvXrw5Lv76kYgRbRYAVGhCw5WH/wy//9H6gYupSxz7lj7AvAMkMsj7m+bukWn+6AijEejiUzxRO2LjclXU2Tjl2qIERxrNkB/ttwKX7TqhgQvNmVyJ7zhDmHN7940VisiJyH+zhSUsB2JQPgddptWn7sp3P0Kas/dHUiIwgcrTG3yOg1cW/wWASCDOXm2mNlL6RiwEwA2j5NyXjkK7qMcp/gP3gOJXImQbVkuJoAiua8Vgjz8DoNn5QoDu+nLRSFYYdCQe9lFRIPJVxZFHCYkkxiHj/YKDwbfZu8/VSKIWBv52diBEA7kXyWos9ZVwpMiatTxVar7Uy/P7limGfl+XqO8fCfPqVPA9EXHl6lUuYaMey3gxCcnJzK+dmZgCyZPY7RRD0Gbw5CZQzADF7wtvHWUn/QIfU65SCa/dXkPhzq9yqTlzJDF4nvEQGczcoIq5QHWKIylhy2K1HoQFg2pBfivg8SCSifLlKOiQk1VhxExQLCSnRoA1GQzsSPOW8NoVXKWMT25CXnfbNyYZEBWeIBf88ZGzj0izmQMsfr9i41FLg+ZTJx0meNhmwawM4ltpquGGGyrCEqdgca3XSoHEGHfMbO21sifqZyOCm3He7toYqb0o/rYyirCSyxKjfCQK6LhmqAgd7yo78mxXCZdK+VuvubR1P2AIx2Bgvka2yLK83+2em5XF1e6c8hAqOpbnjFwzW4BN5U90iQR3zGYzAGtwoU/gxjXA2dVDHCKk6YELqCeDUHZA2gO4HgYnklwj+lxZkyD8H7QGgwDUcwWEp0Y9IASo3VBt7AdEwFiJ/hEVCazkihgE2yKRmxLwIWeL3f3mBgU3NaZh2PxpIr4Iw0dMzkuBaVgp+a4Ho0zNFVwooAxr+HQ9ChYpWbz2zHBQQf9dQKlUptWJDwEq/j2Kh4YQc8CO7nBUBcSPkTKAZHxFQ81OtZvor7YoM4UgzL0/4KPEaoGJTnvV89mCLxhuCjZFqtVLlJFQ8eB4n8AtWhDEqknOzTmWTG2bR8HkrFSahDLDQEwTYj7O3LqbukEjpxmOWHAUN6GFs6JslDK10Ag2WWOb7PNfd79yl8umgGY63qhUBgVsjryCtXSPUnMh1CMZ2Y2q2ZWnUoRbGcl2KpQA/CCgWqQAifhhPpYt0yfzklfQxEDUdSrVdU2LG4EaETLPJQcxOX7LgKhapbToZDjN+q96XTNVJFj6ToESIgp+Zh7GfQuOiye0cmsDiOnIt0hbrUhb+POD7xBbP1UykGV8fhOlhcAWI1x+eBY2FxBPkc9/kh0zMZYCgVf/2kOUZEEE7KNw331j7bno7A6TOeSA7rasslxq+dHtZuoUqVpfVFuAJBHfR0IyovPMor3dVqJSWsl6OyBeXAplcNUuIGnjtqPMiwA+tegjQyxt7gHkMVI8/Y9erqktW0QlETVPzdq2G4B/UYaeZKo/5UFYOhnOYRDHEyIvmCrjnOl1B4wDZYHAfiY+F6X4RTvR6GoGAY1FPhHpuLTRqTXq+ruQkkHUI5UT4S/BWv424/xnIZW/gJgdZzYW7BdEdjMygXPRV2AiKco/GxIkNW1x3oWSn6OZd1rBgUAuHflFXDmS8b5YVe475meiVz5hxmf/n25Hue8LJAkspSwJi/wWPmCzRm+Fmr1ZI0xnaRH0IxSPaAdOuHU4z3KVUQqPI2eZ4mvpqIa6iZat5TlhDle/X/bdMR5tMD5C0/0DaF0itgX6HxGmnCBKGIK0zMF2zfACpdlBsL21SA1TpiS08Y54aDNp5z4P2hHFysUigIYBSt1jWFo1ItUTGGI+zfg8Z73K6wZAjadJyW1DjH6pMKVZxTjKcjSXO9F7r9yDmyUiwXdSe4VW5TotisbqcrZ2dnFEDkY9Vald6q1+/woLH5NoscwxbJgzxNPWhaBv0RLSlCP3gzKB0uEHE3KH6w9xD5Cq6Za8+4KRUJv26WymJLrRGDwaMxTAm6/560QjEY4gWQHf8ZH6GVa10wbriXmW/Mr/yE4a7KT5J/K43IUqZ4ZpWaFCtlysrV5QU6xZKF0UF+ZuvVcEIfn3zPV9r3eps5OyGx+9zPwhlDUot3VhkPsUBDIfbtN4p7QnwYwy608sIvq7tqCdF22bGMExMNeE8Cbw5hU8Xwxp9aSJZ2Rzr471/uPcIOLuO+cDAJ6457Xcnm0lKvVyRXyMoYno8ECAgt0iytDnqYX0clJCeZSVaG4yFfxzAkp/lFf9jTpD4t2vlPp6RcKXMonoQL7FbDk+Sk1+3LxcU5Q6JKpWj5GMK1LgUVpGnwsGCE6fX70u9rNQ9n2e3q52B9LkJWvD+69ViP1hv0WBKnkMF6DieaG/VRCcTvq2J4aOVlp6h1Ydug8EJ0ybk2jWVo3VIUs7eEHLhWFUoIy6yivF8xwmeG5+ONSHgAtL1S2byUajXJl8r0mteXlzJF+IvV1fAcqNbRan+fqtQPpxh+7bFi7KliqMp4kwjioF7DQ5nQortGehczahiBnTtgnIiEPWr7xs3yqG+Bz0X7gHum9TH7+/VA+pYgB9b31LIncopCMUvFKJTyLLfC0uZyeZIl9HpD6XYGDF8ykpf0OCMDMImM8b6WdOdTzEEAgdGZCFVyCDC/B6gKvaaykaA6d3V9zT+LJew7x/5tFANGTPqhoCzLjpH0D5lsI19zLwBjkctlqBzFUpHGCgLT6w+k3+1RiCHY2j/qyxCKPQTyYCpZIorVMpPhxPiQQu+LRxkJp3sGGivr7ATshZGV/J6KwT6LwVt8CIrywlQM+WRKUvmilOp1yZdK5jEuZdLvoksmeSoGCiYIpXSnkn99WI7x5ylGJFu2v5EFEjvTVHN3haOtYTs+vjxtgPHnAQQqhBwQqm7wc9amzTrNuGmLi4OWR6RwsBbOKRu6YxwMk/zEFzvuGFRiuDSSfCEnpUqBeQabzjJWUt5UVtqdvrTaXZlO0pKTPEM/WOHxBCEXPEaKRGf+hXyISiUp6fXhVSaSy6d1Xx873tqJh8IiPEMlC3lMHqTA6SkLDKksBB2UoD7kpOvPXHiV92rMJL9URqJv7zkc6+JHJNjTlAx6fel2OlpiHqinRubiZ6SD4DNT+ebF9bMYYpmh8XDXO+QhSUJYCr5x2Oq/bkUK41oQ2kKgvAnLYAL5EUj9QaRdqki5viCFUkX6w4G0rq9k0O1IZjqSwnSsisF8JCNsGdnXj60Yft80IqFioAMOCVjchcfw0kCYmmh3NrpQ7x5FVRHrZAZdJTaOk9Nn3kTz1QBBouMamzPKxrCRFZXPzMLh39oHgPXEQ8/S1WSyIrkCGKs1PygU87Ts40lKOt2+dDoQUrTcsgJCQsTrk+lAa+vZNEMxIIgV9pGTYqlM4Wx1ujIe9SWbntI7DLj0UoUERQndGDtlHuJVMSSYkgXeBuGBhqA4EXgMYNC0szfVClgRHkkHrBDyQd/ZGERKCjxafyiDfl+GDKWQzEnkMegtkSs5vsmSyGg3CQyUG7RgJYP3yMNChyvsfKV4v2LgpzAMPrIQ7VKBoSREKCPZclUqjYbkC1XpjwbSuroslpLZAAAgAElEQVSUfueaClGQsWTIRA/ByVCZfmzFcAl32QsVg2rg+cbSrpI6+8ytdqjxLZRK4oQqElSb6uOB2n8en+m6O7VWTmam72cIWNjzZLeWfQdFj3IpoIPprBSJPoV3velxWOWBdkJIkUCPRTITllw9cdZ+iUh/MJbhALXyrHDRJrBGTITxOwpe5PJKQ/WSowqshun/v7cz/bHrurL7fvNQEyepNVCSRUm2W4pjybHs2HHcDRiNAAY6nQFBgG50A0kQNJJv+R/9zbM8wJZblp0OJZEUh5rePAS/tc6+99ZjMQYDuQkWWKx6w333nD2tvfY6QLDwsxY6zISNqi47aulB7eJimI9GlJDXxxhIxVpr9NVlZP2+D7SheQqrwOkiindtIWF0y22oFjrmOq0ybzSKZTg9PleNoWjcKooo4j3ZMKq0thTAXJdqjOJEWJNMh93xNzzK84SYlWbfriLMxazh8QZfGlR63kyr+blbea1YtbrR3z+IvavXojsYx3yxiMnpSczOjqNDGkyvh7qQNSlshoZlVN820/iLBvz0qdSuYWAIuf7a9UqlNo4Y3tgutBUK1Wmyt6iaTmqXGx/nRi9V6PJ5TOYjnWLbgE93wDlLDpzFO2mKXjtP2yldWHerTRNAjr1bQpnSM1KLbgqLkfpwytMmFrNNkK3oCOb2Wp63DWOjdN2TdmGFD64JZirpl70x6VYKEDjqFDWsxnmARm+8ceQLOqV7y7yImqF2C4V/pnsjiJYvag1g7sEgur2+PtsKw1GMdn3QZZSzpEKuy7jOAqfKgB3Gz07PRMdh41L3GLDgH/OmeGA2A3P7sj4ZFZJuoWhC3i+Gwya6MnLYADQbgeV5TqHxldkYrVdR6bMj1E+q9yubxY4vs45tK3qtThDktv1R9A+vRXd84HQl1jE/O4756aNorxfRF40AWBqJ0q4eo15M4cDlXqxGhSsGsDlqwNn1ddlkcFy1GZezABvWpOwy+yuFtSzismBasza0rtc/Z7Xz7MxmysI1I3+ZN93boDaMxdo9BoovLlDMXJZv6Q0CKiGEq7w5hqH8uHHTs5mCdzZ/yLCxGFdqOBrNSu4VKQ83bTFZx3Lu8+pAlfrjnmqNBLb4OdN8pQlvxfJNK5TNqN2Q8wruWtuF1seXmSnrMd38/Fw70cWe1uO9fpzvSwUckDoVfVYV8OkQinevQIcSRcn7gTl4luHrlDj1Mk+n84JW2TB8PZJzdrxuQK+OYhfTkUTz9DsV7j6nnX4JxkGzhQG06nll3SrqjpzyH5ZdrZ4P4bLVjTnNgcF+DK7ciPZwbPbDdhnzs0exPH0Y7c1C54KwRqVs1PVVBq3HG4ipkLiywfMebgr3qhlFSEfre/C4mse2kBkziiqKq4daWMexFZuiMowmXOowmecYGMbNP1oMegWFEYu3zbAsN7d0o6tJIXZaBRGpFHLN16to0PZGObfBhiV3T6+Bhxakit9ZbtXJxgD4UCBSfHX65PUt5eaoEgovlEADjTXgcx9sn9wl34x63lxTgIUZjPfkBpvjU1AzU4FNUdcGrZ+b0vdSYVWahyG5gSfTwRs1Prd8rP9qk6ceVx4Sk5xxinwX7NBLrNFbYeU78xUymNp119T/JMbJkZnGsqJ5qtoLZXv3WuQci3fJgR2j8nXt2SyKmxuy+jmp1LYTK+7B6CAGV56JznhPjnK7nsX85GGszh9Fd7uKnjp7Je0i42hIoSa6ZaqS91/uwgowEKv54txPGoYf83iqRZqbqX/1bzEMOZEODnSFGIJRqeZX49b7otScpU/piKHNg5crI6lu+K5jS7SQE3UtIZpCWUZzpsrHa2wQ3xnR8uTx6Rf4VCdbfoWoaFH5eU/5CjDmYrmI1XblAniAILWnAOmAk4apw0R6oEZksmqJZA65Puje3r6CPHXNhPMdScySbup6G7QMU+yTf684LeixmslQ6rMVJAvI4MjrMg4HY+zCVHfv+cTMyzYQAzfvjw1OC1hN/WW0K+Tzco8r6r/bRYZr6ZRTLJMKzxexWa7slUuTNutBXUYKXu8YRtMYKmfZKPDliIh6pGqjg+gfXo/u3oEMbr2YxOz0YWxmp9Fl1oR0VCAGeyvz+0LJUGpplkT+eZJh7EYM7TLnTI9d7qZw2JrG0cCY9BTd32vqY9QhuLJ8NoJ4TvXEmbZMMQosy7MIfq4oDHPgt3rgQ3u+QqHs55LFUxsim6Mhpiycn4IWAYaOilY2horTtg/NJItkxBYmLYZBHdMVrQO6NzCpJw0VpqGDLGpau9iynhaw0RYotb6DOTDkC282NzPSNPPbDP3+ZKmOzjVc9LJEJor75maq3zPTueYcQoo1m2+UKZ2p+NlIzXzf0S0nFGV6pYazFaZh2JlxDgf3cD6ZxmoGdG3jy3xdUbtE9+aMRHOf5PeZglTPB3wRjb8b28E4evtXYnB4aLHw2USp1GbO+eWMBpjaL/QT1LRkH1X615gWbU4AynALwidHkzdHH9UO9UkRo2kY1R4sg2RKl0uP6UIqlVZUNdu6GAVXXOszERn4ANkpzpSKcL+YzGOzEMm8QJNNRMrbIN9DE4KKCiAwPg+CIlwpVKcvw2Ch1TMoZEXSGzZlV1i/N96m7X4CTNfesO8F1nSbcX+Js9GHEAJDl9kEPm+WAi5oE2fYbXiZUvNg/6Jg5GGGJeRXeWmlSlLOEmdYqXj5qvYoDOLKMC74Ml+PP1Judl9HNtFy4+WMSp5Y6g1yMboZPCnRWilhufels394cBCH+wdx8vBRnB2fiMaSkZnXBzQgYrCmOTJQee1Ma8p75nVlgw+HpFqz3Y1VZxSd8X6MDq8oqi9mZzE9fhCt5Sy65TZrfkWgj5uF+Zn1DWhgiRg5W9N0LCk79OSI8XgqhWHkPsy96GMjQny+5194Xl8yDOXSRbxMDStIeroxCwbSyqKZsgxMCPVbCEm7PjOCmzg9m4qCUZ2n3ViwrGFkldx8yIBM4sUqlotpmaXAQKA+wKLlJNaODIPNjHGIWhF0gAmzQHxO87p9q1TTR5DanqbbWtHnRFfm2Vtd0y5mU3OQlLOX5mWFvOl2uTgvGxTkp6lewoZLwCFTr8pTJmJCY08KPjbcKh/eyYWbG+3iAnsx83lsDO6134c8nCEgJ6hCUBrvs9sHuuBJlQqGmqZHh4fx7I1n4tH9B/Hg7j2tRW5svt/b3xftHsIfhtFkJdSFraNpRsyqaQjiJZfUiWW7F63hfozpY/T7MZuexOT4QcR6Hr3qCAOKX/pIPugn09qmYbjWu9ho1P3YqTEUAf5A8U2N0VwXlwqOuDdu3Ig3/9mb8eKLL0brmVvPbzN0cfFYDf9ylfB34BaRHydbVZ65Z0IdqTQVPDebr81yW4aBLp5yyg1kcXPTwiXifSzkRniHFzSX1+I8iqRX8yH52Xy+LAbC7xlAwoWvnLx06V53PQJaZh8W84U2Z7/bj34X3tI2FvOZiHpJsXd0SmOoQ68HiXI01/Bdpi8pvuD/Pz5+qUVVm+RxZEixoBHyLwSMnXNGmr+rn5PVmqOKU0tTWHz6Eo02PL9nUgxZl75FqY9cT4VSqReeey7u3/00Htz71Nyu0vcYjkbx0ksvxXy1jE8++UTd6jSMppFzFQmUGHJfuRYigC3dDMUwoj+O8dFRDIbDWC0mcX58P1qrRXTLSCmNWAzDd+wiXT5nTSrjv3DTjC5eAHk0W16nq08qvptOKQ2D/fnyyy/HG194Qwai4jsfmPMO+sCt0M3JJl7+jk3IBtRXKXSnMwhwM6UoQLwgKelJtZGltgcqRFFcBBc0y0xNEOI78foYnGehvah8L0kf+EbV8WD8nvSL2oKmoNgXQhMI10QzHdW1dCpF/4LuMRGDs96MQnnWGlQLY3XuX58g6oUwHEvPA4q4Rx6S8p2GYy+WHlybgmMDCpaeC9o0iCaKciEXbsCsXg97MTZ6/ad0Egq0LACEa0toHOhXk4N2KHICGEiZdxH9BrbrYBA3n38h7t/7NO7fuduQLVqLFPmFL3xBTNff//73cXJ64jJlh7PG57jMMBTvlh5qW0Kh6Q5jsL+n9GyzmsX8/Dha65XSYY8nk9OC3jUrUH/iC0NYDVSqSqc+Q8OAu4ZDuP7M9Tg6OorWlZduOHFoKHp7WYCuCiWkoFIaxinSL+1+GTOl8JZmLEeTMcXmQjw1ZE3A87CNhp/UQabB1fWcdnsTvWFH4Zsowp7MsKweSenMupPcF/zpA+050LEX5IxENeAdHZXW7Qv3Z8Bqs9zEerGO+cwUbujdIuPpcfaSGIY3oAt0RwUMkyWGd294r98jVRsYLl5jUH68e2x1hPTR7uoY1aeXquFpdCzhYBlR2cRlG+wYgJEqI1JlVyScVRjEMgwxBgrEGG1xxrAbmmYyjJW6QtXJP8DPe+NxvPLSy4oW9z7+5ELadnB4GG+99Va0up347W9/G58+uF8hd800KtORLNwzYrBjOoW2s6Q70+lFSxT7XrS3i1jPOQ0YZ8MMeCsWaxAsHAyQ9eMRoxkk6jicruOzixjsvWeffVaSUXt7e0aldr1YejigUX1wcHYBhE2YtuD0SgwNtclLzE3hyKJJh8l48qeKIrymRMTIUVvr2HZaMgoWVXPWpbeQhDm6spDVnH6Zqr3ZLt1cbG0F20oAodvRBqYpNj2fxXK6FOUCCjejpBgBtQqwL/TwzJEVxMvwj9IGwclEAh7v4SeiymAwrNikmgpUxGHzZWFu5EypqUCxQsEv7XGoHaZxlKEm+Fqm+xklK6lWDf8WUQntCL53RywhegMCNdQMYDGSFpiNwppgeSoqB45uRCuhxrj1uVfj4af345PbH1XzHrz//sFBfOlLXwrk8H/3u9/F7Y8/qkT4mobRrG34vmLXMjciw9gqYqxavdgUYb0eU0k0RwEiYCBvu7Gg30HdtGF0+HLDyPf9YxoG74EICIahs+6ffe2FbbPbmCGzABsF/66P060gWwoWj9U47EE3hnck6fziQbMwVFNueWHckw3BhqfIX7WMdPF/bwEXmiyui92e1Ev61BJd0KqC+4vDvxahTsgM2HurEwsR8FZKoRi/5Ysgk7VDImJOj6zRm4dBclMGAxxCmduGz1Qm44RiiBzYifPzSRUZNb9d5kUqene5gSIelp5AetUqFy8/h12M/FD2VbLR6FrC/CqDAKRKJcXSTGzJzDebGI9HMR7v6fEAFpq2XDCFSV3lyT4UT0D8rhwdxeu3Xov7d+/F7d//73oiMyKOrlyJt995J4bjUbz//vvxj//nH0WByQhRpTGNeol7WKW6aRggSiBT7V4saR52WzHotZRGbeksi2beieW2G201HZ9sGFVN8EesMbh+nC+lghDX5964WRkG72umqFMoeUInmP5XZB+GediI7p8IslRvo/yopFoysCxQ08roOhc4kqcrleq05fWNfrg3YqNw6qO0R8W+N776GJKMJ9+H3kxHuUwKqp9SdJ/YaJK/oU439wi/jJFVBlg6x0z+8QGoccZ7I3kMLpnZ7+HI/CQJGKwsNMenoK4yXGuOTaaPjr7e5EZSndf76F5PDwp+LreVz9Nr9zRTv9mCvqFowry9u+q+J0VpQzKm3AfT9AZDjwuzca9ePZJhTGeTODk+LbUZypLLMgvOvWhHr9NXDv3a516Ne3fuxu8++CBm05n6DBjs1atX492vf02NwB/96Edx597dyih2EbYEbZqGwcp0i2LlBjCgTVQgdaLo70aLKFbSbgxj3WJ9GR/GcTYnMqrtVpnDHzNi8BkwDPaysp9n3vD5GKl2wYmVWAybUlg4TRY2FvVBQUNEb5D3MparUCohrVVVRLn/UvD1aGuhjDihesjm2KgAI/1RmkAOXsGkpSmlqOQOsROThD8zSrUUcbxBHZDw6LJDctcEckRvseiaR3Xrojmn3BT1iAglxcMZ9KGHj5jiqzvkGCm08clsojFd1wyunWDdakZ74/uiSFwm6EQ/L4hR3juZN++jUde+PgfeHsPINM9M34UiKgabKRVz+odXQHv6il79oSVVp9NpTCaTmE7msT/ej+n5VHWWyJOrVlw7vBZXjq7EzRdvxvGjR/Gz994rRuTU9PDoKP7lN76h6/jBD34Qp+dnF1CpXUAhjaKZjtdFszvaUhAHSC2qjaqvpDEGS8A1hs8zudis43UqY0wAoXkEdrIIGlSYi3VQmlLdbK20aRtghxgc2s92aGQ+rZf/+WtbQrUL6IXnntsUvRTTtdSmU6xiCOpu1zyXPMDRQ+Bu1mVBqU0gCdA8lRSGqz2tvSnu0KkTHlOACwhT8qSUKlmvSjdfaZuLzqwNxH9SXwI0psQuMWttdBhIp03j8KKUfuGouG9QQmATfUHgAHqStXXNhhXmjdDCADaoqe58ce1qiEH4bZGKOaUk388CWtwu0flrlIfUk2bXEBHtTq/c9+JsiixpTjKqv5R0/9ZGxtDq4nSW6thiJFzb6el59LukhMN4eOdRIEIHZN3b9OLK/lUZ2KuvvioP+d5778XHH39cFdgUoF//+tfj/v378ZOf/ESRkY2TqdSuYWQaXoEEAnK8N55Uk+wiXIp6O/WFomUKsgkGrxusVTpXvqlqkB3kTGn5DkReyfzv9NiaPSBd35f//G01+FwwL5LZpDQlPSVeGCU+No8Wl5RliaznUuObYuKS4tDw03xyQVMUMdxIS4+e3Bh7TYpv0iFgYfON+Lm9clcFcqLVlsl3LSBjp/DlvA4m8iSg5k52LYRgI86bBhzI9WX94xtW/z4NOVMcG40YiA6tpQAGReO6SbmgwcPqZSaD60czidfttvuKhtQdZvpa5t9RpEaaQGaU2tGkLGmijcYRFoPgGujx6HULQ1ngQHsbi9U8FrCaAR0GvRiMhtr0n35KbwKZ1VbMTxdxenIi4uW1vWtxtHckZUnSOx579+5d/T/v0xtvvBFf/vKX48MPP4xf//rXmltP8qO8fAUQFOZBUR1pGgZ+MTd/PicjSm7ApnEo6jSIirnx/3DE8COfxjCi20xvvf67BFr1e771b7+pYwCUXiRBMHMQOP/McReeEukPMCjpBsXt2dl5TChCeQxsUh7XgFuVVhSqRdUD0E1zGqYZ6+0iVm1SBYp3p1rk+nhA5ql1AysCYoGRiTjzhYtsBAOKV+b9gFETQsVQ1GmnsFd0cs6u1A+kSkNC9F7KrEhp+CWe5DilZFFRSzQT5jIkEOFoJ+MgrFBvlUNrNPLa6SlNyMaZ1EFaXUVmpaISY+jHgMM1S12VvQs5ntUylitL9shJyTDMGLB6CcNTy5itWI927O2PZRi83/GjE8HFg/4wBp1hHD88ERPgT19/MzaLdfzqV7+qjMOOxSgiMOXbb78dr7zySvzsZz8TKsWMfHPjPY1hNHlmzb5W8/XSqwsd3+nl5Jnxeu5nFDG2naKZ3OikZ9rKZ0vKTesv/vOfqcZgCo38O5ETM1kdEg1h+ncYhj3aVooZeBQhEkpn4NBb7a9CQsrPGd9MCnX2AMwcW0VraAIZ9caWdKq4DKUGEiPwkLpYsdxBGn70KYqRudHkaEbXW8o+RXSMSKbmYbcdgz4cL9JEot1cX2xA10mOEBlRGM3Ei20Ri+PgnI4/P3TtiqZRNJ+SNiLvpeJtK70n59FFxrT8a2V1F/Ciq0hMADTbMLeNLj2h0zZTP+ASGbbGMAw6OAXBfJHx4R7h/Sdn0xiP9uPG1RvR3nTi4f0HSq32B/vx4N6DuHPnTnU4Tx5YyZrevPlivPPOO6oxSaNIsTREVNjQn0XESNZ009MrmjTeIw0Hw5ATI6X8jAxD3Lod5ZvMmDBAIVI44+/+7Z9vE2qjNiBs84vRCP0mi3nphqBvVDwLqUvWHFl8uW4wkuC0KZEXIzIgHzyPhWBD0gfAo0vRf+jFxyuLpQukV+jdGCQ9D40flqnbLWnUFE6U+wue07CYWU1TzsKrFFaoDaozjtgBnCGgTM8huFfRhEtLMd/eioMF2sPNJG2cnk/EShV/iQYiY6cO6AWOrmkkTUqC4EkQswbGojpEjOW1Jvz4w+bPMVlgYxl136gcjgqvLlWS9TIWFDQtk+9obi6Wy5hMJzE9n8doMIorB1cZJ1T0Qobnzkd3JLFKCoUBwYVKlQ8+H/2LW7duKb365S9/GQ8fPqy4Uk9TY5hSvYshlWS17KdMpXKfZFGc76P6swAYn7VhUMNm1z5TvPw3U6vWd//uW0Wi017ekpf92N8fyTuZxm1OFDm08mYaRdJaKip4NHOWLj67HnZwR7YIApA2yVhKMSqtJabv9BogE6YvADtmyAXrRf1PoQ+xBHmUAoNSU6z8nkkdSb6OUj1JWUooSxHPIMLaUpzllNdsA2igCE6PCjV780oxFE3bgaMMP0cQAfUObXBp0K7F3JVRSTjaz8+eg1/L6aQGltTrKOdilEafitcCMGR0ECIYqI7wvpsYDAdK24jqaAvzf4xngpZVe6vGp2qSObUIlPxVzCeL6EY3rh5ej1dffjU+vv1xfHrnnqIv6RNi3by2yX0zMUq/+tWvStCb/gVdbxQXPR5ysRZrbqLLim+PFF/OJWvWHhkZeOyyAmxqBnaiW2I/lEVpPqcUGI/VGLsFd5X+qWhBgBtk0mtqkCmjcoPG/5f/9Vtb0zds0RnOR+NhOZTSKYrp3y68WWx5cWqKckQYmxSiXkeIEVDnoIyTwmmCz2OPJlXAwjQFhemTSqCUgfiAc6OS1XtCL2cnDOb7VFkJLQseLn2U0i03xcOwX/YXeJJOJCrIkVJFTdOl8EJd87gIqwd+OoN2dIdeZB2eUyjrbfhQOIt5GZ8FjhYDeO2+SYGOHWGzHwEaV6fRiUzzfutYCZJ2jyLTKBbPAnA4EAwB58FGPjzcD0Y0NXcvnd6U6XSPaT6ZS8QaVvHLz70SN1+4Gb/9hw/j7id3FCF4TR3tQNTWWvWDovsrX/lKnJycxM9//nOlW5IvKqPIuSGbHjZTq8qZlWiYxfdlUWbXMLLwhaiap0VVj2meQHMJO9nOrzba3Si0a5yaxejQ/4EICwLIfsmxXhtHAh+tf/ffiRh104kXA2Uh3GbRl2S75C3lDYGCAHLEwvEYCZmJX2RuUTbGPEfRiaUGhnS53pytjgbnWxTvKAeSZwN3yjuC9JRBJ2oGiSyXMytIS3TSkrEMNQrLVB3RzIZhlizfW/3DkKqOO8gDaCS0Xobgy/itAIQ8N7zNxThVMvcIOrt7JXSQVYyrb9IycbHo1oIA8XiM3b0Np1cYllC6MvHI4wRD0/kXCpdzKKWvGtbWksA0EXW51LXRa2qjrt52b0esgxSiUx8lYjFdxbg3jqO9K3G4d6hxgNPTE72eRgSmUxkBG50oQbQAwoU4+NOf/jSOj4/TQit4OTfabsRwZKzpHIk87hpGPkaASEN4Qz8XRcR9jF3DkAFcRtu/xCiaddBlhtEdtKTnJclYRCrUbDTPjrpQzDKQ1//0P/9s666uu64snIf4256eQ5m6gfEn8Y7Hk68T2tnI9vgcPjNzuMpjhlWbuIcBSzbrD8GYNPm2nWjz+yL5wusTYYg4qn3oGiuFsvqvEaBOzBZLqY7z+IQx3WjjdhTd1jJySmpIGrWG+4QcKELOwJkFNSLKJDpDZAP/J41ZrCYxmXFCk9nBVvNwzaURW6VIHfUIMAARJtsMSyG9Hro+pZ8lb5M+VDEKaVVxlgd1xaCrRiIpktNONwx53uTcHfbcZJgMTgKhOLS00lunc8MJDdoDTVN2W71YTzeqN65fuS4k6/TsVJueiEGtB/L3wgsvxNe+9jXdR6IFMC2vK/Y0zqh5EFBqDjdg26cxDKeaacgZ8ZmtKWtc4FcZR6EWyeifYBj1fXk85bs0YnQ3sX84jsPDQ33evH9JEzKiuY7W3/yv72yN5phbY6uuyWoi55UPktaYBa7PAEdqPxmxKQ6Q3tobyWob1AR1Dm/yHYtnScdaDKAjZicbjuaSOUjcSMvRQJkG05ktQJXMCaoKJmk2mUvlnkeZ+KNX0AUadsQgX/d1m5V6enJeoTRqBhJhtFDQ1DmIxtpDZgN76s+OxNFHQuaxjREkw45TSCxJNVNF/7AROV1l/oR6bSPEq9sHlfPYKbyudBpscozWdRDXVBjBNPT6Ed2euWoGNGaqyXA+g84g+q1+LKbLOH1wFs9e/5N48fkX4uHxwzg+OVbtwOPZGNevX5dhUHh/9NFHihb0QdKjC6Zu9AqaqVRuvKwzSiZVjlK7vCm469GrmqHIJu1GjPz/ZYZRMyHqXkazJ3GZYSw3szi8si9aTD0AVgfH/Aytf//335Q70uIWYQCjR0XPtaQo6cEy1SIU8bPsygLvsoCcxKRZbYaXUN1OrQPRtctwEFBo+R4NUx/DVY4gqo4tsweR/itzHmK3DqLHLlK4Y+bbZ3Vk7eNDWmplkfw8kvinU61DZMir3Sth4wEEgM6QFiKanMibHIRrtWq6kf4EHpQNL7hXMx61B5SOFIzkQj333LdTAww7vTAvnUcpqGfTxfl4GEz9HjUsPY3m5mVOFtrBqBbrQLu3pA6vy2Y/O5vomIZRbxzd6MX8bB7Ts1m8/OLn4rlnnov5Yhq3P7mtrjafE8NgBuHNN9+UB/3FL36hwjshXEUqJd4NakYjYqSR7NYYPmPwyYZRbb5G99lHijyeSlWF9CURI2H9NK4mSNCsifL9qDEW62kcXNkTk9YlgB3cBdUW6s9v/NWtba83kCw9CzsajfUgNlDK4vPE3IAsHhsU2JANdeeuB10OD/bEfRn0RzEa7amomZzPK69Z0bN3JGnoRpN3iN7QsmasTkTV8WGwWGcSPAYBIyVwqgFV1mxdnx3oKTNNsaEvX0CEivFJxIOsKDjaxRbRLvsZNCrHo3Gpq6hl1j53gtltadT6wBqljOuVjjhzKjdX9Mril2af+FhlTiIX1SCFOVxECDb6ZDKN+dyd7W6XvodPT/RQq8kAAAt9SURBVKpYAqRjnBIr3SfOSPR5JWnUgALDva7WgUg0OZ+q4UrhvV1GLKerWM3WsV5sZRQ3rt2Q1NAHH/6D1o26gg1NtIACQpSAHnL79m1dB8ahWqtxqMpujfG0hpGOKmuMZvQQG67Q8XPmJ6OE7uNnZBhEDAyDEiAH7bLnlQiUUM23vvMn2063Hwd7+7G/fxD9wVCLK4U+FPUYYl9aqYMmHN1YnY60DZ0yxEaDiQkFYgECI7p24f0s1rFYWqgYT8YmBnZj84ISQZ4jHfCxv22dq8fGI10hJaGQPj2dxGy6Ep0dL4jhsZFabQs6E7EoJMXqpItcirpSr5UoyHkTazW+8BB59Je8P9j/+dSUFq6pR99i7OYb024IRGfjs5DcGPeksaZjlsuwUio58vZQ5zxTYc4XhsPrc01EJtI0Dv189OiRHkcUlIBAcRrtInRH5ODoAI/2opVlpREU1YcH3bj6DKIGh1J0P310LiE6CIN8z7/9Tl/CdKh2YACb1jY+unNbvQr6VEC2r7/+erx261b8+v33VV9QkGfqJMJngY6flEKlN74IkRomb/5penDXaLVEEs+t+08lrSlPzvfdTYuU5TQK9bzm2hldLp0D/Wh/f6zain1o1NMAhjMQcwRb3/iPf7qF+ry3V0/QsdGWi1mMB30V2AwC4aVZZGYfMnVR91UfsquidkrXmaYM52q03QBjQ2o0vtMxwrJZqgsNJg9s1qfjrqO1tmpyYRw+Eqsdszn5/yQWEyIEsszdGPSGMd4bxOFVBpcGMgw8IDckJ/6a2LoQB7z1ph3zKUIInvGw3KXzec67SKq9xAD23NAD5h2PXKRr4UqtBbSoQaXCrk2lPjOImTX36K+0ccUhM9eK5xAxeG3qJ8h9AimkKuLrdH3j89UdqU17wTD4P9eJs+rtRQz3+qKRExWWs40MY8ZnnC6lkM6Yrc7XWK3j2rXrMV/NYjDuy0joapMOf/vb39bn/f73vx+/+c1v7GQaSiAe761Zr82N2kSiLlhBI5XarU+aadRjyNQO4e9yo6vfSV35yxRSGjq+zeuSQkhrqyPlcAwYhmf6LQhoYIk17ETru//tm9u03uSMCNJbzGPEYJAoFO4NpGHIk6zXcT7zkVtS/OhhQJs4OTsXq1WLwiQZ+rMF6aJuIWIgaAylm5RsyOy3ztpeC6WBFKepM52EFDGdLmI5o6FH38Aq4IxBHhyN4ujKQZU28Vp4ehAXaNeib/NeOhLA+brOrEAoYUvzzCrdXD9eMjv8vI5HbAtsV2oenbGhDc8Z4xaYozAlmvDZ2TxQZJgY7AE3l260RnrLfIUO1iyTjtzjGX2fMjfP4/g9kUopRiEbmvXsfghe2LPxvegOI1o9kteuSIubZSuO75/Gp/ceKpVCr5cmKM6JvhKv3e61dZwazweV+uIXvxjvvvuuOt0//OEPVXwLFSycFBlBUdXY9dzN/1+MDWwVI3d5T5spWH6fv5fnz8bPYy/0/xCQKBD6/49hIOiB2jw1I0bhGaQUMLcCZ+uv/se3tzlLTe6sQ07EGWKMJAcavCDk2KRV6QUQOzOHx15xioc/xeOUeYRCIiSogb2DxdMABAqVBH+BX0FcdNb4YhFTzvcTNQKKtY/nWsxWOkNvNkFG/iyms/PoDTpxcLCva+G9ddrswYG8KylKbna8ofN0pvlKv2Gz8SitBpIo8Ouz/lJvVnMN59NYKbSaR6WZcoamNDNuh0HtwMAQN1jeXRwuNqzHvhnDdcq1jqODQ3Vd+eOGocM29A5mAMbDsX5fTUDqfPK6KJXgXK9jvL2NYWKEjhqL6TrufXI/7t19EC0m9Vp9GQZdE9U1hSkMekak4L58/vOfj5s3b8ogfvzjH8upNLlM6luVUdrLUqmL6VO9q1PFsYLsKxnWxmx8A7L9pzUMyJt2zAyiaR8WvpoHyYyCtv7y7//VFuiKX6an1Ww0svWl8MrUg83LhJhOIOLFisUJWYFLpOOxgB2NwJBt66xtzqbrFVEtQaWYHOkRuTiapoY7JdqmcVZo1EPl6Odnszg7maqTi3dcU4guZupgZpHIkrDYueAscC5yGsvJyZme6yZlCIXBmJr5bS40j+H556dTeVylaUKP7K0FG+uEIAuluTDviDdFukY6owMp9V7lEMwi3qZBsBJ5UtEQB9OhbhhwTqERN36n2o0I1ZhV8Jiraz0BCahskHZOl3FO2jm18mKXYZEN4nTuGTgiAxaEHMLzzz8vejkOAjTqgw8+0LpaOLo+6MZ0+fr/u97/EidfyW42USJes5l6PdbkK+Ozl73ek3721KmUnMNWTog9yz5MWVdSRhNovT9a3/0v727xvAldcRGZtw80Y+0iiX2uFGvtfgcvxCbmX/K1/QMo4gh3mVKeByoqlwfzFG8f2RSPzxKizYEBujT5T5oBktAxPEn6gLDB2elMi8y5dRwSacE0Y6nOu231/MlhnuxxsAmga4CQST2jMH8xGAzDjTHL6CSEyiIScebnZvCS1mW45dqUAg5HVbogiFj9mo2AgvmE2mDmsVKJpPlYMH4PcIGXgjHglG0TS5qoOtoMoIPejKfpuK+WwC/jw4XzZWdCWslcu9kCHBWwnEHt6So6UnADHnC9WgsdWkTd5oiPEghoFCnV9773PUVZ7kPqf+VmVIO3AaWm83hStNDzComw6lGUPkgz/dpNpfjd5bTDJ5vK0xsGl2Z9AfXgit6xP5/Hjm34Ea1/83f/QnrT2UGmWuciiQzMCoj/30URcKHCTLCa5hIQMjA5j4WXRP6GDc9wEV1uI1kWZ/PYqA4/j9KzwPNR+LSpTVYazyT/ZgBI7z+dKWeHrs4GoJgfj/YUYYAud1EOpScFceKaee9MkbT50ZkqA1PUOigdAixYTYMi3HBoUshJi+hoI8XoQSOre+TkIZsu0y4/p2xCRU3UFZeKbGxyo1HusWjuRId1sjDuySwI3+C1wNUzRBY4RxCPZnKjx35Nb8kNSQ2BdhbyOMgDTc5mon3oQFGUN7Y2DNeDoHqWwqToJ1rCi6KHATxLxEh6CPc1JYW0SSrx6ItRo7ldq2vKor2oOzYf02y8ZeRIuJbnpzbt00SM6kSpBjVk91ouXKf6rlaTQbVyNOr7AB81qKH+WGBCbL3v/PXbW7wbm4iNktwnozK10raJhAttkIODQy00qBQpkZW6CUU0oJBvwQMTVewhh4N+jEC3iDgrF7/cqNGQzTlUn4LUhY2D5hF5OYXpZAIdosj3kyv3RxUxsUnpbqJQiZg1aQdqQEkMIdXC63FTFsf4umfBcwFNrWdj9X1QJHVIWXjuFYABcLaVABu6q4War9cVqgRFJgQM4H1JowTfEjqLKvySJh4p0waHMClkttAmtmJJaXyxYJwEBdsYlK6FYUccPzyOs9OJSYrIKohC7wGralYE1I+G5mKhuoKiGwfC0BJM2oRLH4dHTQl5rLtdartLo4CE6S6mTlm7JMKnCNFU2d+xiGZEakaeCxv9aawodQ6LiAe12ng8jAMyHRg8Ytl60lLX9a//w1tbqW0oJTGSYEU/Dry3/KYOWtwWpYz1Rs0hLG61pVAmYtijEbFbrZEWiIjBmzFLsDcay3tp2q6wUGlKUQBSF3AIjQQAUCUE4dmsdTAj6ZDSshRb0FmfpBFFaKxsVKdH/gzZiRePqUjOKEXT7Hl96mn2GZTL0/UuKWN1NrbcpY5o9/FfNP2olxjHJV9HA1dNt7q5KPV15CfbCJ/RBe9W6VTKYJo8bFIcm03kxA0nQvVluESZzMcns3MZoLlKaPrSKDS1pBMDfaEA+fD+ozijHpKCSVuqI6ZplwNtipIL79XtDlR0g0iRRhEtgG4vIFGNZlqiUtksbXrkZoMu96gRQJ/O1Kwp0jCatUYzijymANKAbj9bw/BYMPcRwzg62i8HApFGeeiLT/B/AdDBjyPGdoy4AAAAAElFTkSuQmCC');
INSERT INTO `person` (`personid`, `firstname`, `middlename`, `lastname`, `gender`, `birthdate`, `age`, `email`, `facebook`, `phone`, `barangay`, `city`, `province`, `photo`) VALUES
(2, 'Jovan Rey', 'Dacayanan', 'Reyes', '', '0000-00-00', 0, '', '', '', '', '', '', ''),
(3, 'Jovan Rey', 'Dacayanan', 'Reyes', 'Male', '0000-00-00', 19, 'ci102pc.reyes07@gmail.com', 'erebus.alh84001', '412-7266', 'Canduman', 'Mandaue City', 'Cebu', ''),
(4, 'Reyes', 'Jovan Rey', 'Dacayanan', '', '0000-00-00', 0, 'ci102pc.reyes07@gmail.com', 'erebus.alh84001', '412-7266', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservationid` int(11) NOT NULL,
  `activity` varchar(100) NOT NULL,
  `affiliationname` varchar(100) NOT NULL,
  `reservationdate` date NOT NULL,
  `timestart` time NOT NULL,
  `timeend` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservationid`, `activity`, `affiliationname`, `reservationdate`, `timestart`, `timeend`) VALUES
(6, 'Conference', 'The Sovenance', '2017-09-22', '15:30:00', '17:30:00'),
(7, 'Dinner', 'ROLWCC', '2017-09-22', '17:30:00', '18:30:00'),
(8, 'Party', 'The Sovenance', '2017-09-30', '01:00:00', '03:00:00'),
(9, 'Wedding', 'The Sovenance', '2017-09-30', '05:00:00', '06:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `scholarships`
--

CREATE TABLE `scholarships` (
  `scholarshipid` int(11) NOT NULL,
  `scholarshipName` varchar(50) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scholarships`
--

INSERT INTO `scholarships` (`scholarshipid`, `scholarshipName`, `discount`, `status`) VALUES
(1, 'Discount A', '124.12', 1),
(2, 'Discount B', '135.48', 1),
(3, 'Discount C', '235.47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `secondcourses`
--

CREATE TABLE `secondcourses` (
  `seccourseid` int(11) NOT NULL,
  `secondprogram` varchar(50) NOT NULL,
  `secondschool` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secondcourses`
--

INSERT INTO `secondcourses` (`seccourseid`, `secondprogram`, `secondschool`) VALUES
(1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sectionparticipants`
--

CREATE TABLE `sectionparticipants` (
  `sectionparticipantid` int(11) NOT NULL,
  `sectionid` int(11) NOT NULL,
  `participantid` int(11) NOT NULL,
  `result` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sectionparticipants`
--

INSERT INTO `sectionparticipants` (`sectionparticipantid`, `sectionid`, `participantid`, `result`) VALUES
(1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `sectionid` int(11) NOT NULL,
  `section` varchar(10) NOT NULL,
  `capacity` int(11) NOT NULL,
  `batchid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`sectionid`, `section`, `capacity`, `batchid`, `status`) VALUES
(1, 'Saturday', 3, 1, 1),
(2, 'Sunday', 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `accountid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `accesslevel` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`accountid`, `username`, `password`, `accesslevel`, `status`) VALUES
(1, 'jovan', 'warlord123', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `accountid` int(11) NOT NULL,
  `personid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `accountid`, `personid`) VALUES
(1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affiliations`
--
ALTER TABLE `affiliations`
  ADD PRIMARY KEY (`affiliationid`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`batchid`);

--
-- Indexes for table `batchpayables`
--
ALTER TABLE `batchpayables`
  ADD PRIMARY KEY (`payableid`);

--
-- Indexes for table `batchscholarships`
--
ALTER TABLE `batchscholarships`
  ADD PRIMARY KEY (`bscholarshipid`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientid`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`educationid`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`enrollmentid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`jobid`);

--
-- Indexes for table `participantpayments`
--
ALTER TABLE `participantpayments`
  ADD PRIMARY KEY (`p_paymentid`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`participantid`),
  ADD KEY `secourseid` (`seccourseid`),
  ADD KEY `educationid` (`educationid`),
  ADD KEY `personid` (`personid`),
  ADD KEY `jobid` (`jobid`);

--
-- Indexes for table `participantscholarships`
--
ALTER TABLE `participantscholarships`
  ADD PRIMARY KEY (`p_scholarshipid`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paymentid`);

--
-- Indexes for table `paymentschedules`
--
ALTER TABLE `paymentschedules`
  ADD PRIMARY KEY (`payscheduleid`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`personid`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservationid`);

--
-- Indexes for table `scholarships`
--
ALTER TABLE `scholarships`
  ADD PRIMARY KEY (`scholarshipid`);

--
-- Indexes for table `secondcourses`
--
ALTER TABLE `secondcourses`
  ADD PRIMARY KEY (`seccourseid`);

--
-- Indexes for table `sectionparticipants`
--
ALTER TABLE `sectionparticipants`
  ADD PRIMARY KEY (`sectionparticipantid`),
  ADD KEY `sectionid` (`sectionid`),
  ADD KEY `participantid` (`participantid`),
  ADD KEY `participantid_2` (`participantid`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`sectionid`),
  ADD KEY `batchid` (`batchid`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`accountid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `affiliations`
--
ALTER TABLE `affiliations`
  MODIFY `affiliationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `batchid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `batchpayables`
--
ALTER TABLE `batchpayables`
  MODIFY `payableid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `batchscholarships`
--
ALTER TABLE `batchscholarships`
  MODIFY `bscholarshipid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `educationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `enrollmentid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jobid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `participantpayments`
--
ALTER TABLE `participantpayments`
  MODIFY `p_paymentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `participantid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `participantscholarships`
--
ALTER TABLE `participantscholarships`
  MODIFY `p_scholarshipid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `paymentschedules`
--
ALTER TABLE `paymentschedules`
  MODIFY `payscheduleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `personid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `scholarships`
--
ALTER TABLE `scholarships`
  MODIFY `scholarshipid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `secondcourses`
--
ALTER TABLE `secondcourses`
  MODIFY `seccourseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sectionparticipants`
--
ALTER TABLE `sectionparticipants`
  MODIFY `sectionparticipantid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `sectionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `accountid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `sectionparticipants`
--
ALTER TABLE `sectionparticipants`
  ADD CONSTRAINT `sectionparticipants_ibfk_2` FOREIGN KEY (`participantid`) REFERENCES `participants` (`participantid`),
  ADD CONSTRAINT `sectionparticipants_ibfk_3` FOREIGN KEY (`sectionid`) REFERENCES `sections` (`sectionid`);

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`batchid`) REFERENCES `batches` (`batchid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
