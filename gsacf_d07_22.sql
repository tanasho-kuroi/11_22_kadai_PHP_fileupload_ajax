-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2021 年 1 月 29 日 22:10
-- サーバのバージョン： 10.4.17-MariaDB
-- PHP のバージョン: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gsacf_d07_22`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `joblist_table`
--

CREATE TABLE `joblist_table` (
  `id` int(12) NOT NULL,
  `joblist` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skill` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resistDate` date NOT NULL,
  `delete_flag` int(2) NOT NULL DEFAULT 0,
  `is_admin` int(3) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `joblist_table`
--

INSERT INTO `joblist_table` (`id`, `joblist`, `skill`, `category`, `region`, `resistDate`, `delete_flag`, `is_admin`, `created_at`, `updated_at`) VALUES
(2, 'SE', 'PHP88', 'IT132', 'hokkaido', '2020-12-14', 0, 0, '2020-12-28 06:27:06', '2021-01-17 10:23:42'),
(3, 'エンジニア2', 'PHP10', '', 'Japan', '2020-12-08', 0, 0, '2020-12-28 06:27:08', '2021-01-17 11:10:41'),
(5, 'エンジニア', 'PHP0', 'IT132', 'hokkaido', '2020-12-27', 0, 0, '2020-12-28 06:27:12', '2021-01-14 06:09:02'),
(6, 'SE', 'PHP2', '', 'Japanff', '2020-12-29', 0, 0, '2020-12-28 06:27:13', '2021-01-13 21:29:33'),
(7, 'エンジニア', 'PHP3', 'IT1111', 'Japan', '2020-12-14', 0, 0, '2020-12-28 06:27:15', '2021-01-17 06:34:16'),
(8, 'エンジニア', 'PHP3', 'IT55445', 'Japan', '2021-01-06', 0, 0, '2020-12-28 06:27:57', '2021-01-17 10:22:27'),
(9, 'エンジニア', 'PHP5', 'IT1', 'kyushu', '2020-12-15', 0, 0, '2020-12-28 06:27:58', '2021-01-17 11:12:02'),
(10, 'SE', 'PHP0', '', 'Japan', '2021-01-02', 0, 0, '2020-12-28 06:28:00', '2021-01-03 11:12:25'),
(11, 'エンジニア', 'PHP10000', '', 'Japan', '2020-12-29', 0, 0, '2021-01-01 11:19:17', '2021-01-02 06:26:04'),
(12, 'エンジニア', 'PHP3333', 'IT553', 'kyushu', '2021-01-25', 0, 0, '2021-01-01 11:19:30', '2021-01-14 06:09:09'),
(13, 'エンジニア2', 'PHP6111', '', 'Japan', '2020-12-31', 0, 0, '2021-01-01 11:20:06', '2021-01-03 11:12:30'),
(14, 'エンジニア', 'PHP9', 'IT55', 'Japan', '2021-01-10', 0, 0, '2021-01-01 11:20:09', '2021-01-17 06:47:31'),
(15, 'エンジニア', 'deedefde', '', 'hokkaido', '2021-01-06', 1, 0, '2021-01-09 13:07:05', '2021-01-09 13:07:05'),
(16, 'エンジニア', 'PHP8', '', 'Japan', '2021-01-27', 0, 0, '2021-01-09 13:07:12', '2021-01-09 13:07:12'),
(17, 'エンジニア', 'PHP5', '', 'Japan', '2021-01-01', 1, 0, '2021-01-09 13:07:14', '2021-01-09 13:07:14'),
(18, 'エンジニア', 'PHP4', '', 'Japan', '2021-01-02', 0, 0, '2021-01-13 23:10:00', '2021-01-13 23:10:00'),
(19, 'エンジニア', 'PHP1', 'IT1', 'Japan', '2020-12-10', 0, 0, '2021-01-14 06:05:47', '2021-01-14 06:05:47'),
(20, 'エンジニア', 'PHP5', 'IT5', 'Japan', '2021-01-31', 0, 0, '2021-01-19 00:10:51', '2021-01-19 00:10:51'),
(21, 'エンジニア', 'PHP10', 'IT10', 'Japan', '2020-12-16', 0, 0, '2021-01-19 00:11:55', '2021-01-19 00:11:55'),
(22, 'エンジニア', 'PHP1', 'IT1', 'Japan', '2021-01-04', 0, 0, '2021-01-19 00:13:12', '2021-01-19 00:13:12'),
(23, 'エンジニア', 'PHP4eee', 'IT4', 'Japan', '2020-12-06', 0, 0, '2021-01-19 00:13:22', '2021-01-19 00:13:33'),
(24, 'エンジニア', 'PHP7', 'IT7', 'Japan', '2021-01-03', 0, 0, '2021-01-19 00:13:53', '2021-01-19 21:25:19');

-- --------------------------------------------------------

--
-- テーブルの構造 `like_joblist_table`
--

CREATE TABLE `like_joblist_table` (
  `id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `joblist_id` int(12) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='いいね機能';

--
-- テーブルのデータのダンプ `like_joblist_table`
--

INSERT INTO `like_joblist_table` (`id`, `user_id`, `joblist_id`, `created_at`) VALUES
(1, 0, 10, '2021-01-19 21:22:21'),
(2, 0, 12, '2021-01-19 21:22:23'),
(13, 0, 3, '2021-01-26 22:10:21'),
(15, 0, 9, '2021-01-26 22:10:30'),
(18, 0, 20, '2021-01-26 22:22:23');

-- --------------------------------------------------------

--
-- テーブルの構造 `like_table`
--

CREATE TABLE `like_table` (
  `id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `todo_id` int(12) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `like_table`
--

INSERT INTO `like_table` (`id`, `user_id`, `todo_id`, `created_at`) VALUES
(8, 4, 20, '2021-01-16 15:35:59'),
(9, 4, 23, '2021-01-16 15:36:00'),
(10, 4, 23, '2021-01-16 15:36:00'),
(11, 4, 23, '2021-01-16 15:36:00'),
(12, 4, 23, '2021-01-16 15:36:01'),
(13, 4, 23, '2021-01-16 15:36:01'),
(14, 4, 23, '2021-01-16 15:36:01'),
(15, 4, 23, '2021-01-16 15:36:01'),
(33, 10, 20, '2021-01-17 06:04:05'),
(34, 10, 22, '2021-01-17 06:04:08'),
(35, 10, 23, '2021-01-17 06:04:09'),
(42, 0, 22, '2021-01-19 21:21:33');

-- --------------------------------------------------------

--
-- テーブルの構造 `todo_table`
--

CREATE TABLE `todo_table` (
  `id` int(12) NOT NULL,
  `todo` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `todo_table`
--

INSERT INTO `todo_table` (`id`, `todo`, `deadline`, `created_at`, `updated_at`) VALUES
(20, 'PHP課題333e', '2021-01-07', '2020-12-26 16:44:59', '2021-01-16 15:16:03'),
(21, 'test', '2021-01-13', '2021-01-02 06:22:10', '2021-01-02 06:22:10'),
(22, 'PHP課題', '2021-01-28', '2021-01-16 15:16:11', '2021-01-16 15:16:11'),
(23, 'test222', '2021-01-13', '2021-01-16 15:16:40', '2021-01-16 15:16:40'),
(24, 'testaaaa', '2020-12-30', '2021-01-16 16:00:56', '2021-01-16 16:00:56');

-- --------------------------------------------------------

--
-- テーブルの構造 `users_table`
--

CREATE TABLE `users_table` (
  `id` int(12) NOT NULL,
  `username` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `users_table`
--

INSERT INTO `users_table` (`id`, `username`, `password`, `is_admin`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, '管理者', 'kanri', 1, 0, '2021-01-05 23:14:06', '2021-01-05 23:27:58'),
(2, 'ジーズ太郎3', '3', 0, 0, '2021-01-05 23:16:09', '2021-01-05 23:16:09'),
(3, 'ジーズ太郎4', '4', 0, 1, '2021-01-05 23:16:10', '2021-01-05 23:16:10'),
(4, 'ジーズ太郎0', '0', 0, 1, '2021-01-05 23:16:11', '2021-01-05 23:16:11'),
(6, 'ジーズ太郎8', '8', 0, 0, '2021-01-05 23:16:14', '2021-01-05 23:16:14'),
(10, 'ジーズ太郎1', '1000', 0, 0, '2021-01-09 15:47:50', '2021-01-09 15:47:50'),
(12, 'ジーズ太郎11111', '111111', 0, 0, '2021-01-10 08:01:48', '2021-01-10 08:01:48');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `joblist_table`
--
ALTER TABLE `joblist_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `like_joblist_table`
--
ALTER TABLE `like_joblist_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `like_table`
--
ALTER TABLE `like_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `todo_table`
--
ALTER TABLE `todo_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `joblist_table`
--
ALTER TABLE `joblist_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- テーブルの AUTO_INCREMENT `like_joblist_table`
--
ALTER TABLE `like_joblist_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- テーブルの AUTO_INCREMENT `like_table`
--
ALTER TABLE `like_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- テーブルの AUTO_INCREMENT `todo_table`
--
ALTER TABLE `todo_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- テーブルの AUTO_INCREMENT `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
