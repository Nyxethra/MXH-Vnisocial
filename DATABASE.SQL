CREATE TABLE Users(
  User_id int PRIMARY KEY,
  Username varchar(50),
  Password varchar(50),
  Role varchar(20)
);
CREATE TABLE User_info(
  Id int PRIMARY KEY NOT NULL,
  User_id int NOT NULL,
  Bio varchar(150),
  Firstname varchar(50),
  Lastname varchar(50),
  Avatar BINARY not null,
  Gender varchar(10) not null default 'Nam',
  Birthday date ,
  Email varchar(120),
  CONSTRAINT fk_user_info_user_id
  FOREIGN KEY (user_id)
  REFERENCES users (user_id)
    
);
INSERT INTO `Users` (`User_id`, `Username`, `Password`, `Role`) VALUES ('1', 'qkhanhs123', 'khanhkhanhkhanh3','Admin'), ('2', 'votinhcoduoctraitimem', 'chilatinhco','user');
INSERT INTO `user_info` (`Id`, `User_id`, `Bio`, `Firstname`, `Lastname`, `Avatar`, `Gender`, `Birthday`, `Email`) VALUES ('', '2', 'có không giữ mất tìm liền', thichem, khong, '', 'Nam',2024-02-01, vietcaitaikhoanmacunglau@gmail.com);

CREATE TABLE friendrequest(
  request_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  sender_id int,
  FOREIGN KEY (sender_id) REFERENCES user(user_id),
  receiver_id int,
  FOREIGN KEY (receiver_id) REFERENCES user(user_id),
  status varchar(300)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
INSERT INTO friendrequest(sender_id,receiver_id,status) VALUES 
(1,2,'Đã gửi'),
(2,4,'Đã gửi'),
(3,1,'Đã gửi'),
(5,3,'Đã gửi'),
(4,3,'Đã gửi');

CREATE TABLE likes(
  like_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  like_by int,
  FOREIGN KEY (like_by) REFERENCES user(user_id),
  post_id int,
  FOREIGN KEY (post_id) REFERENCES posts(post_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO likes(like_by, post_id) VALUES
(2,1),
(3,2),
(3,2);