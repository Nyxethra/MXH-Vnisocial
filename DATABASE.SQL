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