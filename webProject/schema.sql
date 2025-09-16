-- Base pour portail universitaire (procédural)
DROP DATABASE IF EXISTS university_portal ;
CREATE DATABASE university_portal 
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE university_portal ;
 
DROP TABLE IF EXISTS message;
DROP TABLE IF EXISTS note;
DROP TABLE IF EXISTS module;
DROP TABLE IF EXISTS unite_enseignement;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS timetable;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(120) NOT NULL UNIQUE,
  password VARCHAR(120) NOT NULL, -- stocké en clair pour simplifier l'exemple (à critiquer)
  role ENUM('student','teacher','admin') NOT NULL DEFAULT 'student',
  fullname VARCHAR(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE unite_enseignement (
  id INT AUTO_INCREMENT PRIMARY KEY,
  code VARCHAR(20) NOT NULL UNIQUE,
  name VARCHAR(120) NOT NULL,
  type ENUM('TRANSVERSAL','PROFESSIONNEL','RECHERCHE') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE module (
  id INT AUTO_INCREMENT PRIMARY KEY,
  code VARCHAR(20) NOT NULL UNIQUE,
  name VARCHAR(120) NOT NULL,
  credits INT NOT NULL DEFAULT 3,
  ue_id INT,
  FOREIGN KEY (ue_id) REFERENCES unite_enseignement(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE note (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  module_id INT NOT NULL,
  grade DECIMAL(4,1) NOT NULL,
  FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (module_id) REFERENCES module(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE message (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sender_id INT NOT NULL,
  receiver_id INT NOT NULL,
  subject VARCHAR(200) NOT NULL,
  body TEXT NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (receiver_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE timetable (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(120) NOT NULL,
  day ENUM('Mon','Tue','Wed','Thu','Fri','Sat') NOT NULL,
  start_time TIME NOT NULL,
  end_time TIME NOT NULL,
  room VARCHAR(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Données d'exemple
INSERT INTO users (email, password, role, fullname) VALUES
('admin@example.com','admin','admin','Admin Istrateur'),
('teacher@example.com','teacher','teacher','Prof Esseur'),
('alice@student.com','alice','student','Alice Student'),
('bob@student.com','bob','student','Bob Student');

INSERT INTO unite_enseignement (code,name,type) VALUES
('UE-T001','Langues & Soft Skills','TRANSVERSAL'),
('UE-P101','Dév. Applications','PROFESSIONNEL'),
('UE-R301','Méthodologie Recherche','RECHERCHE');

INSERT INTO module (code,name,credits,ue_id) VALUES
('MOD-ALG','Algorithmes',4,2),
('MOD-WEB','Développement Web',3,2),
('MOD-ENG','Anglais Technique',2,1);

INSERT INTO note (student_id,module_id,grade) VALUES
(3,1,14.5),(3,2,12.0),(4,1,9.0);

INSERT INTO message (sender_id,receiver_id,subject,body) VALUES
(2,3,'Bienvenue','Bonjour Alice, bienvenue au module Web.'),
(3,2,'Question','Bonjour Prof, j\'ai une question sur le TP.');

INSERT INTO timetable (title,day,start_time,end_time,room) VALUES
('Algorithmes (TD)','Mon','08:30','10:00','B12'),
('Développement Web (Cours)','Wed','10:15','12:15','A03'),
('Anglais Technique','Fri','09:00','10:30','C21');
