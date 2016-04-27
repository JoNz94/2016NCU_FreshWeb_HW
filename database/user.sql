-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2016-04-27 21:23:55
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
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `nickname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sex` enum('男','女') COLLATE utf8_unicode_ci NOT NULL,
  `permission` enum('admin','member') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'member',
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`id`, `nickname`, `username`, `password`, `sex`, `permission`, `email`) VALUES
(1, '管理員 ʕ•ᴥ•ʔ', 'admin', 'ad3cf2bf2ff18fe231fe5012cb8b28e8', '男', 'admin', 'jonz94@g.ncu.edu.tw'),
(2, '幽浮', 'jonz94', '76ed30c061076fc364509bfa31b2f6f7', '男', 'member', 'jody16888@gmail.com'),
(3, '123', 'username', '81dc9bdb52d04dc20036dbd8313ed055', '女', 'member', '123@1234.1234'),
(4, '//我來亂的XD', 'a_a', 'c44a471bd78cc6c2fea32b9fe028d30a', '男', 'member', 'yskuo.tw@gmail.com'),
(5, 'Joe', 'joe8877', 'a51b8262ef1432918e9c0fbfe8d7308a', '男', 'member', 'joe888777@gmail.com');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `m_username` (`username`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
