CREATE TABLE nguoidung(
  ma_nguoidung bigint(19) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ten_nguoidung varchar(150), 
  matkhau varchar(150), 
  email varchar(150), 
  gioitinh varchar(15),
  ngaysinh date, 
  avatar varchar(600) DEFAULT 'nguoidung.jpeg',
  anhbia varchar(600) DEFAULT 'anhbia.jpg',
  tieusu varchar(250)
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO nguoidung(ten_nguoidung, matkhau, email, gioitinh, ngaysinh, avatar, anhbia,tieusu) VALUES
('Nguyễn Hải Đăng','abcde','HAIDANG@gmail.com','nam','1999-02-18', 'anh2.jpg','anh3.jpg','ahahha'),
('Tạ Hà Quỳnh Anh', 'abcde', 'QUYNHANH@gmail.com','nữ','2500-07-08', 'nguoidung.jpeg','anhbia.jpg','ihihiii'),
('Nguyễn Văn Quang','abcde','VANQUANG@gmail.com','nữ','2505-03-14','anh2.jpeg','anhbia.jpg','ohoooho'),
('Nguyễn Quốc khánh','abcde','QUOCKHANH@gmail.com','nam','2504-07-02','nguoidung.jpeg','anhbia.jpg','một cộng một bằng 2'),
('Bảo Ngọc ','abcde','BAONGOC@gmail.com','nam','2502-07-15','nguoidung.jpeg','anhbia.jpg','worldcup 2024');


CREATE TABLE tt_nguoidung(
  tt_ma_nguoidung bigint(19) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ma_nguoidung bigint(19),
  FOREIGN KEY (ma_nguoidung) REFERENCES nguoidung(ma_nguoidung),
  trangthai varchar(250),
  hoc_tai varchar(250),
  lam_tai varchar(250),
  moi_quan_he varchar(150)
);
INSERT INTO tt_nguoidung(ma_nguoidung, hoc_tai, lam_tai, moi_quan_he) VALUES
(1,'ĐẠI HỌC CỘNG NGHỆ ĐHQGHN',null,'Độc thân'),
(2,'HỌC VIÊN BƯU CHÍNH VIỄN THÔNG',null, 'Độc Thân'),
(3,'HỌC VIÊN PHÓNG KHÔNG - KHÔNG QUÂN',null,'Độc thân'),
(4,'HỌC VIỆN ANH NINH NHÂN DÂN',null, 'Độc Thân'),
(5,'ĐẠI HỌC LUẬT ĐÀ NẴNG',null,'Độc thân');

CREATE TABLE nhan_tin(
  ma_tin_nhan int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  tin_nhan_tu bigint(19),
  FOREIGN KEY (tin_nhan_tu) REFERENCES nguoidung(ma_nguoidung),
  tin_nhan_den bigint(19),
  FOREIGN KEY (tin_nhan_den) REFERENCES nguoidung(ma_nguoidung), 
  noidung varchar(4294967295),
  timestamp varchar(150)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
INSERT INTO nhan_tin(tin_nhan_tu,tin_nhan_den,noidung) VALUES 
(1,2,'a'),
(2,1,'b'),
(1,2,'c'),
(2,1,'d');


SET time_zone = "+07:00";
CREATE TABLE baidang (
  ma_baidang int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  dang_boi int,
  FOREIGN KEY (dang_boi) REFERENCES nguoidung(ma_nguoidung),
  noidung text,
  image varchar(600),
  luong_like int NOT NULL DEFAULT 0,
  luong_binhluan int NOT NULL DEFAULT 0,
  luong_chia_se int NOT NULL DEFAULT 0,
  thoigian_dang timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO baidang (dang_boi,noidung, image, luong_like) VALUES
(2, 'v', 'a.jpg', 0),
(1, 'd ', 'b.jpg', 0),
(5, 'g ', 'c.jpg', 1);



CREATE TABLE chia_se (
  ma_chiase int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ma_baidang bigint(19),
  FOREIGN KEY (ma_baidang) REFERENCES baidang(ma_baidang),
  chia_se_by bigint(19),
  FOREIGN KEY (chia_se_by) REFERENCES nguoidung(ma_nguoidung),
  thoidiem_chiase varchar(150)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE binhluan(
  ma_binhluan int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  binhluan_boi bigint(19),
  FOREIGN KEY (binhluan_boi) REFERENCES nguoidung(ma_nguoidung),
  ma_baidang bigint(19),
  FOREIGN KEY (ma_baidang) REFERENCES baidang(ma_baidang),
  noidung_binhluan varchar(4294967295),
  thoidiem_binhluan varchar(150)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
INSERT INTO binhluan(binhluan_boi, ma_baidang,noidung_binhluan ,thoidiem_binhluan) VALUES
(2,1,'?',null),
(2,3,'?',null),
(1,3,'.',null);



CREATE TABLE thongbao (
  ma_thongbao int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  thongbao_tu bigint(19),
  FOREIGN KEY (thongbao_tu) REFERENCES nguoidung(ma_nguoidung),
  noidung_thongbao varchar(250),
  ma_baidang bigint(19),
  FOREIGN KEY (ma_baidang) REFERENCES baidang(ma_baidang),
  thoidiem_thongbao varchar(250),
  tong_tb int DEFAULT 0 -- Thêm cột tổng thông báo và đặt giá trị mặc định là 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO thongbao(thongbao_tu,noidung_thongbao) VALUES 
  (1, 'đã thích bài viết của bạn'),
  (3, 'đã bình luận vào bài viết của bạn'),
  (2, 'đã thích bài viết của bạn'),
  (1, 'đã gửi một lời mời kết bạn'),
  (5, 'đã thích bài viết của bạn');



CREATE TABLE banbe (
  ma_banbe int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ma_nguoidung1 bigint(19),
  FOREIGN KEY (ma_nguoidung1) REFERENCES nguoidung(ma_nguoidung),
  ma_nguoidung2 bigint(19),
  FOREIGN KEY (ma_nguoidung2) REFERENCES nguoidung(ma_nguoidung)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO banbe (ma_nguoidung1, ma_nguoidung2) VALUES
  (1, 2),
  (1, 3),
  (2, 3),
  (2, 4),
  (3, 4),
  (3, 5),
  (4, 5);


CREATE TABLE yeucau_ketban(
  ma_yeucau int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ma_nguoigui bigint(19),
  FOREIGN KEY (ma_nguoigui) REFERENCES nguoidung(ma_nguoidung),
  ma_nguoinhan bigint(19),
  FOREIGN KEY (ma_nguoinhan) REFERENCES nguoidung(ma_nguoidung),
  status varchar(300)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
INSERT INTO yeucau_ketban(ma_nguoigui,ma_nguoinhan,status) VALUES 
(1,2,'Đã gửi'),
(2,4,'Đã gửi'),
(3,1,'Đã gửi'),
(5,3,'Đã gửi'),
(4,3,'Đã gửi');

CREATE TABLE thich(
  ma_thich int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  thich_boi bigint(19),
  FOREIGN KEY (thich_boi) REFERENCES nguoidung(ma_nguoidung),
  ma_baidang bigint(19),
  FOREIGN KEY (ma_baidang) REFERENCES baidang(ma_baidang)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO thich(thich_boi, ma_baidang) VALUES
(2,1),
(3,2),
(3,2);
