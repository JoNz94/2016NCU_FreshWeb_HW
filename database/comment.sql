-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2016-04-27 21:23:47
-- 伺服器版本: 10.1.9-MariaDB
-- PHP 版本： 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `homework`
--

-- --------------------------------------------------------

--
-- 資料表結構 `comment`
--

CREATE TABLE `comment` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `subject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `subject`, `content`, `time`) VALUES
(1, 1, 'first comment', 'r u OK?', '0000-00-00 00:00:00'),
(2, 2, '使用者test', '使用者測試留言~', '2016-04-09 17:48:05'),
(3, 3, '洗個版', '灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試灌水測試', '2016-04-09 17:52:02'),
(4, 4, '        ', '         ', '2016-04-09 18:30:07'),
(5, 5, 'Joe', '#include&lt;iostream&gt;\r\nusing&nbsp;namespace&nbsp;std;\r\nint&nbsp;main()\r\n{\r\n&nbsp;&nbsp;&nbsp;&nbsp;cout&lt;&lt;&quot;0.0&quot;;\r\n}', '2016-04-09 19:22:47'),
(6, 1, '攻擊測試', '&lt;script&gt;alert(&apos;打爆你&apos;);&lt;/script&gt;', '2016-04-12 20:20:03'),
(7, 1, '符號測試', '&lt;標籤&gt;&lt;/標籤&gt;\r\n&apos;單引號&apos;\r\n&quot;雙引號&quot;\r\n(括號)\r\n&lt;(_ _)&gt;\r\nʕ•ᴥ•ʔ', '2016-04-12 20:43:06'),
(9, 1, 'XD', 'XDDDDDDDD', '2016-04-16 01:04:16');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
