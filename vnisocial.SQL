CREATE TABLE nguoidung(
  ma_nguoidung bigint(19) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ten_nguoidung varchar(150), 
  matkhau varchar(150), 
  email varchar(150), 
  gioitinh varchar(15),
  ngaysinh date, 
  avatar varchar(600) DEFAULT 'nguoidung.jpeg',
  anhbia varchar(600) DEFAULT 'anhbia.jpg',
  tieusu varchar(250),
  hoc_tai varchar(250),
  lam_tai varchar(250),
  song_tai varchar(250)
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO nguoidung(song_tai,hoc_tai,ten_nguoidung, matkhau, email, gioitinh, ngaysinh, anhbia,tieusu) VALUES
('Thanh Xuân, Hà Nội','ĐĂNG UNI','Nguyễn Hải Đăng','abcde','HAIDANG@gmail.com','nam','1999-02-18', 'anh3.jpg','ahahha'),
('Thanh Xuân, Hà Nội','HỌC VIÊN PHÓNG KHÔNG - KHÔNG QUÂN','Tạ Hà Quỳnh Anh', 'abcde', 'QUYNHANH@gmail.com','nữ','2500-07-08', 'anhbia.jpg','ihihiii'),
('Thanh Xuân, Hà Nội','HỌC VIỆN ANH NINH NHÂN DÂN','Nguyễn Văn Quang','abcde','VANQUANG@gmail.com','nữ','2505-03-14','anhbia.jpg','ohoooho'),
('Thanh Xuân, Hà Nội','ĐẠI HỌC LUẬT ĐÀ NẴNG','Nguyễn Quốc khánh','abcde','QUOCKHANH@gmail.com','nam','2504-07-02','anhbia.jpg','một cộng một bằng 2'),
('Thanh Xuân, Hà Nội','HỌC VIÊN BƯU CHÍNH VIỄN THÔNG','Bảo Ngọc ','abcde','BAONGOC@gmail.com','nam','2502-07-15','anhbia.jpg','worldcup 2024');




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
  ma_baidang bigint(19) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  dang_boi bigint(19),
  FOREIGN KEY (dang_boi) REFERENCES nguoidung(ma_nguoidung),
  noidung text,
  image varchar(600),
  luong_like int NOT NULL DEFAULT 0,
  luong_binhluan int NOT NULL DEFAULT 0,
  luong_chia_se int NOT NULL DEFAULT 0,
  thoigian_dang timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO baidang (dang_boi,noidung, image, luong_like) VALUES
(1, 'Hang Múa là điểm đến phải tham quan khi ghé đến Ninh Bình. Nơi đây có núi non trùng điệp, cây cối xanh rì, thiên nhiên hoang dã và hình ảnh cầu thang được chạm trổ tinh xảo, độc đáo hình rồng phượng tạo ra vẻ đẹp làm say đắm lòng người. Hãy đến ngay Ninh Bình và thắm nhìn cảnh đẹp thiên nhiên này nhé. ', 'd.webp', 1),
(5, 'Gành Đá Dĩa được mệnh danh là kiệt tác thiên nhiên vì được hình thành từ những trận núi lửa cách đây 200 triệu năm trước. Nơi đây có hàng nghìn cột đá đa hình dạng xếp chồng lên nhau, khít nhau như bàn tay của một vị thần sắp đặt và còn khiến du khách ấn tượng bởi những gam màu thay đổi liên tục trong ngày.', 'f.webp', 1),
(2, 'Thác Bản Giốc là dòng thác ở Cao Bằng nằm trong top 4 thác nước xuyên quốc gia lớn nhất thế giới. Khí hậu tại nơi đây được chia thành 2 mùa mưa và khô. Đến với Thác Bản Giốc vào mùa mưa, bạn sẽ được ngắm nhìn, dòng thác chảy ồ ạt tung bọt trắng xóa hoặc dòng thác màu xanh ngọc óng ánh, dịu hiền vào mùa khô giúp bạn cảm nhận rõ rệt được sự thoải mái và bình yên nơi đây. Còn chần chừ mà không đến tham quan cảnh đẹp thiên nhiên Việt Nam được nhiều người yêu thích.', 'a.webp', 0),
(4, 'Mù Cang Chải toạ lạc ở thị trấn huyện lỵ của huyện Mù Cang Chải, tỉnh Yên Bái, Việt Nam. Nơi đây là một trong những địa điểm du lịch nhất định bạn phải ghé thăm. Khi đến đây bạn sẽ được ngắm nhìn khung cảnh tuyệt vời, cảm nhận sự hùng vĩ, mênh mông trên từng thửa ruộng bậc thang, hay của dòng nước trong veo của Thác Mơ và những con người hiền lành, gần gũi nơi đây. Còn chần chừ gì mà không đến cảnh đẹp thiên nhiên Việt nam này.', 'b.webp', 0),
(3, 'Tràng An - Ninh Bình là cảnh đẹp thiên nhiên được yêu thích nhất Việt Nam và là quần thể danh thắng được UNESCO công nhận. Tràng An có 3 khu vực chính, đó là: cố đô Hoa Lư, hang động Tràng An và chùa Bái Đính đã tạo ra nét đẹp hùng vĩ và quyến rũ của Tràng An. Bên cạnh đó, ẩm thực phong phú, thơm ngon cũng là điểm được khách du lịch yêu thích. Trong đó, Chùa Bái Đính là một trong những địa điểm được nhiều khách du lịch yêu thích nhất, khi có tượng Phật bằng đồng dát vàng lớn nhất châu Á và mang trong mình đậm chất cổ xưa của dân tộc cùng khung cảnh tâm linh,đồ sộ xung quanh và không gian thanh tịnh để du khách cầu an, chiêm bái.', 'c.webp', 1),
(5, 'Vịnh Hạ Long là một vịnh nhỏ thuộc tỉnh Quảng Ninh và là một trong những di sản thiên nhiên được thế giới công nhận. Nơi đây tựa như bức tranh hài hòa giữa 3 yếu tố bầu trời bao la, mặt nước và những đảo đá nhấp nhô hùng vĩ.Vịnh Hạ Long là điểm đến thú vị dành cho những ai yêu thích du lịch khám phá, nơi đây chính phong cảnh thiên nhiên Việt Nam rất đáng du lịch một lần trong đời. ', 'e.webp', 1);



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
(1,2,'đẹp tuyệt vời',null),
(2,2,'quá đẹp',null),
(3,2,'wao',null);



CREATE TABLE thongbao (
  da_xem BOOLEAN DEFAULT FALSE,
  ma_thongbao INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  thongbao_tu BIGINT(19),
  FOREIGN KEY (thongbao_tu) REFERENCES nguoidung(ma_nguoidung),
  thongbao_den BIGINT(19),
  FOREIGN KEY (thongbao_den) REFERENCES nguoidung(ma_nguoidung),
  noidung_thongbao VARCHAR(250),
  ma_baidang BIGINT(19),
  FOREIGN KEY (ma_baidang) REFERENCES baidang(ma_baidang),
  thoidiem_thongbao TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Sử dụng kiểu dữ liệu TIMESTAMP để lưu thời điểm thông báo
  tong_tb INT DEFAULT 0 -- Thêm cột tổng thông báo và đặt giá trị mặc định là 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO thongbao(thongbao_tu,thongbao_den,noidung_thongbao) VALUES 
   (2,3, 'đã thích bài viết của bạn'),
  (1,3, 'đã gửi một lời mời kết bạn'),
  (5,2, 'đã thích bài viết của bạn');



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
  (1, 5),
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
