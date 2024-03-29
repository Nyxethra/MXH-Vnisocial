-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 29, 2024 lúc 01:27 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vnisocial`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baidang`
--

CREATE TABLE `baidang` (
  `ma_baidang` bigint(19) NOT NULL,
  `dang_boi` bigint(19) DEFAULT NULL,
  `noidung` text DEFAULT NULL,
  `image` varchar(600) DEFAULT NULL,
  `luong_like` int(11) NOT NULL DEFAULT 0,
  `luong_binhluan` int(11) NOT NULL DEFAULT 0,
  `luong_chia_se` int(11) NOT NULL DEFAULT 0,
  `thoigian_dang` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `baidang`
--

INSERT INTO `baidang` (`ma_baidang`, `dang_boi`, `noidung`, `image`, `luong_like`, `luong_binhluan`, `luong_chia_se`, `thoigian_dang`) VALUES
(1, 1, 'Ukraine đã tuyên bố bắn hạ một loạt máy bay kể từ khi Nga tiến hành chiến dịch quân sự đặc biệt vào cuối tháng 2/2022 với tỷ lệ thành công dường như đang tăng lên trong tháng này. Ngày 28/2, Bộ Quốc phòng Ukraine cho biết quân đội nước này đã bắn hạ tiêm kích thứ 10 của Nga chỉ trong 10 ngày. Các chuyên gia nhận định với Business Insider rằng thành công gần đây của Ukraine có lẽ là do sự dịch chuyển chiến thuật của Nga, được triển khai để ngăn chặn các cuộc tấn công của Kiev.', '65e5bc877662d.jpg', 0, 0, 0, '2024-03-29 00:25:38'),
(2, 1, 'd ', 'b.jpg', 0, 0, 0, '2024-03-29 00:25:38'),
(3, 5, 'g ', 'c.jpg', 1, 0, 0, '2024-03-29 00:25:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banbe`
--

CREATE TABLE `banbe` (
  `ma_banbe` int(11) NOT NULL,
  `ma_nguoidung1` bigint(19) DEFAULT NULL,
  `ma_nguoidung2` bigint(19) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `banbe`
--

INSERT INTO `banbe` (`ma_banbe`, `ma_nguoidung1`, `ma_nguoidung2`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 3),
(4, 2, 4),
(5, 3, 4),
(6, 3, 5),
(7, 4, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `ma_binhluan` int(11) NOT NULL,
  `binhluan_boi` bigint(19) DEFAULT NULL,
  `ma_baidang` bigint(19) DEFAULT NULL,
  `noidung_binhluan` longtext DEFAULT NULL,
  `thoidiem_binhluan` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `binhluan`
--

INSERT INTO `binhluan` (`ma_binhluan`, `binhluan_boi`, `ma_baidang`, `noidung_binhluan`, `thoidiem_binhluan`) VALUES
(1, 2, 1, '?', NULL),
(2, 2, 3, '?', NULL),
(3, 1, 3, '.', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chia_se`
--

CREATE TABLE `chia_se` (
  `ma_chiase` int(11) NOT NULL,
  `ma_baidang` bigint(19) DEFAULT NULL,
  `chia_se_by` bigint(19) DEFAULT NULL,
  `thoidiem_chiase` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `ma_nguoidung` bigint(19) NOT NULL,
  `ten_nguoidung` varchar(150) DEFAULT NULL,
  `matkhau` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `gioitinh` varchar(15) DEFAULT NULL,
  `ngaysinh` date DEFAULT NULL,
  `avatar` varchar(600) DEFAULT 'nguoidung.jpeg',
  `anhbia` varchar(600) DEFAULT 'anhbia.jpg',
  `tieusu` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`ma_nguoidung`, `ten_nguoidung`, `matkhau`, `email`, `gioitinh`, `ngaysinh`, `avatar`, `anhbia`, `tieusu`) VALUES
(1, 'Nguyễn Hải Đăng', 'abcde', 'HAIDANG@gmail.com', 'nam', '1999-02-18', 'anh2.jpg', 'anh3.jpg', 'ahahha'),
(2, 'Tạ Hà Quỳnh Anh', 'abcde', 'QUYNHANH@gmail.com', 'nữ', '2500-07-08', 'nguoidung.jpeg', 'anhbia.jpg', 'ihihiii'),
(3, 'Nguyễn Văn Quang', 'abcde', 'VANQUANG@gmail.com', 'nữ', '2505-03-14', 'anh2.jpeg', 'anhbia.jpg', 'ohoooho'),
(4, 'Nguyễn Quốc khánh', 'abcde', 'QUOCKHANH@gmail.com', 'nam', '2504-07-02', 'nguoidung.jpeg', 'anhbia.jpg', 'một cộng một bằng 2'),
(5, 'Bảo Ngọc ', 'abcde', 'BAONGOC@gmail.com', 'nam', '2502-07-15', 'nguoidung.jpeg', 'anhbia.jpg', 'worldcup 2024');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhan_tin`
--

CREATE TABLE `nhan_tin` (
  `ma_tin_nhan` int(11) NOT NULL,
  `tin_nhan_tu` bigint(19) DEFAULT NULL,
  `tin_nhan_den` bigint(19) DEFAULT NULL,
  `noidung` longtext DEFAULT NULL,
  `timestamp` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nhan_tin`
--

INSERT INTO `nhan_tin` (`ma_tin_nhan`, `tin_nhan_tu`, `tin_nhan_den`, `noidung`, `timestamp`) VALUES
(1, 1, 2, 'a', NULL),
(2, 2, 1, 'b', NULL),
(3, 1, 2, 'c', NULL),
(4, 2, 1, 'd', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thich`
--

CREATE TABLE `thich` (
  `ma_thich` int(11) NOT NULL,
  `thich_boi` bigint(19) DEFAULT NULL,
  `ma_baidang` bigint(19) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thich`
--

INSERT INTO `thich` (`ma_thich`, `thich_boi`, `ma_baidang`) VALUES
(1, 2, 1),
(2, 3, 2),
(3, 3, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongbao`
--

CREATE TABLE `thongbao` (
  `ma_thongbao` int(11) NOT NULL,
  `thongbao_tu` bigint(19) DEFAULT NULL,
  `thongbao_den` bigint(19) DEFAULT NULL,
  `noidung_thongbao` varchar(250) DEFAULT NULL,
  `ma_baidang` bigint(19) DEFAULT NULL,
  `thoidiem_thongbao` varchar(250) DEFAULT NULL,
  `tong_tb` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thongbao`
--

INSERT INTO `thongbao` (`ma_thongbao`, `thongbao_tu`, `thongbao_den`, `noidung_thongbao`, `ma_baidang`, `thoidiem_thongbao`, `tong_tb`) VALUES
(1, 2, 3, 'đã thích bài viết của bạn', NULL, NULL, 0),
(2, 1, 3, 'đã gửi một lời mời kết bạn', NULL, NULL, 0),
(3, 5, 2, 'đã thích bài viết của bạn', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tt_nguoidung`
--

CREATE TABLE `tt_nguoidung` (
  `tt_ma_nguoidung` bigint(19) NOT NULL,
  `ma_nguoidung` bigint(19) DEFAULT NULL,
  `trangthai` varchar(250) DEFAULT NULL,
  `hoc_tai` varchar(250) DEFAULT NULL,
  `lam_tai` varchar(250) DEFAULT NULL,
  `moi_quan_he` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tt_nguoidung`
--

INSERT INTO `tt_nguoidung` (`tt_ma_nguoidung`, `ma_nguoidung`, `trangthai`, `hoc_tai`, `lam_tai`, `moi_quan_he`) VALUES
(1, 1, NULL, 'ĐẠI HỌC CỘNG NGHỆ ĐHQGHN', NULL, 'Độc thân'),
(2, 2, NULL, 'HỌC VIÊN BƯU CHÍNH VIỄN THÔNG', NULL, 'Độc Thân'),
(3, 3, NULL, 'HỌC VIÊN PHÓNG KHÔNG - KHÔNG QUÂN', NULL, 'Độc thân'),
(4, 4, NULL, 'HỌC VIỆN ANH NINH NHÂN DÂN', NULL, 'Độc Thân'),
(5, 5, NULL, 'ĐẠI HỌC LUẬT ĐÀ NẴNG', NULL, 'Độc thân');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `yeucau_ketban`
--

CREATE TABLE `yeucau_ketban` (
  `ma_yeucau` int(11) NOT NULL,
  `ma_nguoigui` bigint(19) DEFAULT NULL,
  `ma_nguoinhan` bigint(19) DEFAULT NULL,
  `status` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `yeucau_ketban`
--

INSERT INTO `yeucau_ketban` (`ma_yeucau`, `ma_nguoigui`, `ma_nguoinhan`, `status`) VALUES
(1, 1, 2, 'Đã gửi'),
(2, 2, 4, 'Đã gửi'),
(3, 3, 1, 'Đã gửi'),
(4, 5, 3, 'Đã gửi'),
(5, 4, 3, 'Đã gửi');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `baidang`
--
ALTER TABLE `baidang`
  ADD PRIMARY KEY (`ma_baidang`),
  ADD KEY `dang_boi` (`dang_boi`);

--
-- Chỉ mục cho bảng `banbe`
--
ALTER TABLE `banbe`
  ADD PRIMARY KEY (`ma_banbe`),
  ADD KEY `ma_nguoidung1` (`ma_nguoidung1`),
  ADD KEY `ma_nguoidung2` (`ma_nguoidung2`);

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`ma_binhluan`),
  ADD KEY `binhluan_boi` (`binhluan_boi`),
  ADD KEY `ma_baidang` (`ma_baidang`);

--
-- Chỉ mục cho bảng `chia_se`
--
ALTER TABLE `chia_se`
  ADD PRIMARY KEY (`ma_chiase`),
  ADD KEY `ma_baidang` (`ma_baidang`),
  ADD KEY `chia_se_by` (`chia_se_by`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`ma_nguoidung`);

--
-- Chỉ mục cho bảng `nhan_tin`
--
ALTER TABLE `nhan_tin`
  ADD PRIMARY KEY (`ma_tin_nhan`),
  ADD KEY `tin_nhan_tu` (`tin_nhan_tu`),
  ADD KEY `tin_nhan_den` (`tin_nhan_den`);

--
-- Chỉ mục cho bảng `thich`
--
ALTER TABLE `thich`
  ADD PRIMARY KEY (`ma_thich`),
  ADD KEY `thich_boi` (`thich_boi`),
  ADD KEY `ma_baidang` (`ma_baidang`);

--
-- Chỉ mục cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  ADD PRIMARY KEY (`ma_thongbao`),
  ADD KEY `thongbao_tu` (`thongbao_tu`),
  ADD KEY `ma_baidang` (`ma_baidang`);

--
-- Chỉ mục cho bảng `tt_nguoidung`
--
ALTER TABLE `tt_nguoidung`
  ADD PRIMARY KEY (`tt_ma_nguoidung`),
  ADD KEY `ma_nguoidung` (`ma_nguoidung`);

--
-- Chỉ mục cho bảng `yeucau_ketban`
--
ALTER TABLE `yeucau_ketban`
  ADD PRIMARY KEY (`ma_yeucau`),
  ADD KEY `ma_nguoigui` (`ma_nguoigui`),
  ADD KEY `ma_nguoinhan` (`ma_nguoinhan`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `baidang`
--
ALTER TABLE `baidang`
  MODIFY `ma_baidang` bigint(19) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `banbe`
--
ALTER TABLE `banbe`
  MODIFY `ma_banbe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `ma_binhluan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `chia_se`
--
ALTER TABLE `chia_se`
  MODIFY `ma_chiase` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `ma_nguoidung` bigint(19) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `nhan_tin`
--
ALTER TABLE `nhan_tin`
  MODIFY `ma_tin_nhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `thich`
--
ALTER TABLE `thich`
  MODIFY `ma_thich` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  MODIFY `ma_thongbao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tt_nguoidung`
--
ALTER TABLE `tt_nguoidung`
  MODIFY `tt_ma_nguoidung` bigint(19) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `yeucau_ketban`
--
ALTER TABLE `yeucau_ketban`
  MODIFY `ma_yeucau` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `baidang`
--
ALTER TABLE `baidang`
  ADD CONSTRAINT `baidang_ibfk_1` FOREIGN KEY (`dang_boi`) REFERENCES `nguoidung` (`ma_nguoidung`);

--
-- Các ràng buộc cho bảng `banbe`
--
ALTER TABLE `banbe`
  ADD CONSTRAINT `banbe_ibfk_1` FOREIGN KEY (`ma_nguoidung1`) REFERENCES `nguoidung` (`ma_nguoidung`),
  ADD CONSTRAINT `banbe_ibfk_2` FOREIGN KEY (`ma_nguoidung2`) REFERENCES `nguoidung` (`ma_nguoidung`);

--
-- Các ràng buộc cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `binhluan_ibfk_1` FOREIGN KEY (`binhluan_boi`) REFERENCES `nguoidung` (`ma_nguoidung`),
  ADD CONSTRAINT `binhluan_ibfk_2` FOREIGN KEY (`ma_baidang`) REFERENCES `baidang` (`ma_baidang`);

--
-- Các ràng buộc cho bảng `chia_se`
--
ALTER TABLE `chia_se`
  ADD CONSTRAINT `chia_se_ibfk_1` FOREIGN KEY (`ma_baidang`) REFERENCES `baidang` (`ma_baidang`),
  ADD CONSTRAINT `chia_se_ibfk_2` FOREIGN KEY (`chia_se_by`) REFERENCES `nguoidung` (`ma_nguoidung`);

--
-- Các ràng buộc cho bảng `nhan_tin`
--
ALTER TABLE `nhan_tin`
  ADD CONSTRAINT `nhan_tin_ibfk_1` FOREIGN KEY (`tin_nhan_tu`) REFERENCES `nguoidung` (`ma_nguoidung`),
  ADD CONSTRAINT `nhan_tin_ibfk_2` FOREIGN KEY (`tin_nhan_den`) REFERENCES `nguoidung` (`ma_nguoidung`);

--
-- Các ràng buộc cho bảng `thich`
--
ALTER TABLE `thich`
  ADD CONSTRAINT `thich_ibfk_1` FOREIGN KEY (`thich_boi`) REFERENCES `nguoidung` (`ma_nguoidung`),
  ADD CONSTRAINT `thich_ibfk_2` FOREIGN KEY (`ma_baidang`) REFERENCES `baidang` (`ma_baidang`);

--
-- Các ràng buộc cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  ADD CONSTRAINT `thongbao_ibfk_1` FOREIGN KEY (`thongbao_tu`) REFERENCES `nguoidung` (`ma_nguoidung`),
  ADD CONSTRAINT `thongbao_ibfk_2` FOREIGN KEY (`thongbao_tu`) REFERENCES `nguoidung` (`ma_nguoidung`),
  ADD CONSTRAINT `thongbao_ibfk_3` FOREIGN KEY (`ma_baidang`) REFERENCES `baidang` (`ma_baidang`);

--
-- Các ràng buộc cho bảng `tt_nguoidung`
--
ALTER TABLE `tt_nguoidung`
  ADD CONSTRAINT `tt_nguoidung_ibfk_1` FOREIGN KEY (`ma_nguoidung`) REFERENCES `nguoidung` (`ma_nguoidung`);

--
-- Các ràng buộc cho bảng `yeucau_ketban`
--
ALTER TABLE `yeucau_ketban`
  ADD CONSTRAINT `yeucau_ketban_ibfk_1` FOREIGN KEY (`ma_nguoigui`) REFERENCES `nguoidung` (`ma_nguoidung`),
  ADD CONSTRAINT `yeucau_ketban_ibfk_2` FOREIGN KEY (`ma_nguoinhan`) REFERENCES `nguoidung` (`ma_nguoidung`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
