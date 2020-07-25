-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2020-07-25 15:36:46
-- サーバのバージョン： 10.4.11-MariaDB
-- PHP のバージョン: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `kyoukasho_yoyaku`
--
CREATE DATABASE IF NOT EXISTS `kyoukasho_yoyaku` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `kyoukasho_yoyaku`;

-- --------------------------------------------------------

--
-- テーブルの構造 `dat_reserv`
--

CREATE TABLE `dat_reserv` (
  `code_reservation` int(10) NOT NULL,
  `code_user` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `code_order` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `dat_reserv`
--

INSERT INTO `dat_reserv` (`code_reservation`, `code_user`, `code_order`) VALUES
(18, '4', 1),
(19, '4', 4),
(22, '1', 1),
(23, '1', 4),
(24, '1', 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `mst_dat_order`
--

CREATE TABLE `mst_dat_order` (
  `code_order` int(10) NOT NULL,
  `code_subject` int(10) NOT NULL,
  `code_text` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `mst_dat_order`
--

INSERT INTO `mst_dat_order` (`code_order`, `code_subject`, `code_text`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 1),
(4, 3, 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `mst_dat_sub`
--

CREATE TABLE `mst_dat_sub` (
  `code_subject` int(10) NOT NULL,
  `name_subject` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name_teacher` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `mst_dat_sub`
--

INSERT INTO `mst_dat_sub` (`code_subject`, `name_subject`, `name_teacher`) VALUES
(1, 'Webプログラミング', '矢吹先生'),
(2, 'C++プログラミング', '田隈先生'),
(3, 'プログラミング概論', '小笠原先生');

-- --------------------------------------------------------

--
-- テーブルの構造 `mst_dat_text`
--

CREATE TABLE `mst_dat_text` (
  `code_text` int(10) NOT NULL,
  `name_text` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name_auther` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name_publisher` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name_year` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(5) NOT NULL,
  `gazou` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `mst_dat_text`
--

INSERT INTO `mst_dat_text` (`code_text`, `name_text`, `name_auther`, `name_publisher`, `name_year`, `price`, `quantity`, `gazou`, `date`) VALUES
(2, '基礎からしっかり学ぶC++の教科書', '竹内', '集英社', '2020年', 2000, 4, '978-4822298937.jpg', '2020-07-29'),
(5, 'ｐｐｐ', '', '', '', 200, 0, '', '0000-00-00'),
(6, '数学A', '', '', '', 500, 0, '', '0000-00-00'),
(7, '数学A', '', '', '', 600, 0, '', '0000-00-00'),
(10, '社会技術概論', '', '', '', 3800, 0, '', '0000-00-00'),
(11, 'eee', '', '', '', 100, 0, '', '0000-00-00'),
(13, 'DNA', 'ｒｒ', 'y', '2789', 1000, 0, '978-4627847316.jpg', '2020-07-25'),
(14, 'ii', 'lo', 'kk', '790', 100, 0, '978-4891006266.jpg', '2020-07-25');

-- --------------------------------------------------------

--
-- テーブルの構造 `mst_dat_user`
--

CREATE TABLE `mst_dat_user` (
  `code_user` int(10) NOT NULL,
  `name_user` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(10) NOT NULL,
  `mail_address` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `mst_dat_user`
--

INSERT INTO `mst_dat_user` (`code_user`, `name_user`, `student_id`, `mail_address`, `password`) VALUES
(1, '佐藤', 1842000, '', 'abc'),
(2, '田中', 1942000, '', 'abc'),
(3, '鈴木', 2042000, '', 'abc'),
(4, '下田', 1842999, '', '1234');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `dat_reserv`
--
ALTER TABLE `dat_reserv`
  ADD PRIMARY KEY (`code_reservation`);

--
-- テーブルのインデックス `mst_dat_order`
--
ALTER TABLE `mst_dat_order`
  ADD PRIMARY KEY (`code_order`);

--
-- テーブルのインデックス `mst_dat_sub`
--
ALTER TABLE `mst_dat_sub`
  ADD PRIMARY KEY (`code_subject`);

--
-- テーブルのインデックス `mst_dat_text`
--
ALTER TABLE `mst_dat_text`
  ADD PRIMARY KEY (`code_text`);

--
-- テーブルのインデックス `mst_dat_user`
--
ALTER TABLE `mst_dat_user`
  ADD PRIMARY KEY (`code_user`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `dat_reserv`
--
ALTER TABLE `dat_reserv`
  MODIFY `code_reservation` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- テーブルのAUTO_INCREMENT `mst_dat_order`
--
ALTER TABLE `mst_dat_order`
  MODIFY `code_order` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルのAUTO_INCREMENT `mst_dat_sub`
--
ALTER TABLE `mst_dat_sub`
  MODIFY `code_subject` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルのAUTO_INCREMENT `mst_dat_text`
--
ALTER TABLE `mst_dat_text`
  MODIFY `code_text` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- テーブルのAUTO_INCREMENT `mst_dat_user`
--
ALTER TABLE `mst_dat_user`
  MODIFY `code_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
