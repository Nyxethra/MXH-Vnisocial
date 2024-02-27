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
