CREATE TABLE admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL
);

INSERT INTO admin (username, password)
VALUES ('admin', PASSWORD('motdepasse'));

CREATE TABLE tutos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titre VARCHAR(255),
  type ENUM('video', 'image'),
  fichier VARCHAR(255),
  likes INT DEFAULT 0
);

CREATE TABLE commentaires (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tuto_id INT,
  message TEXT,
  date_comment DATETIME DEFAULT CURRENT_TIMESTAMP
);
