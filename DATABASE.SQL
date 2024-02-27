CREATE TABLE Users(
  id int PRIMARY KEY,
  username varchar(50),
  password varchar(50)
);

CREATE TABLE User_info(
  user_id int PRIMARY KEY,
  bio varchar(150),
  Firstname varchar(50),
  Lastname varchar(50),
  avatar BINARY not null,
  gender varchar(10) not null default 'Male',
  birthday datetime ,
  Email varchar(120)
);
