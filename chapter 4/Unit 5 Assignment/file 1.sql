-- create the tables
CREATE TABLE breadCategories (
  breadCategoryID       INT(11)        NOT NULL   AUTO_INCREMENT,
  breadCategoryName     VARCHAR(255)   NOT NULL,
  dateAdded          	  DATETIME       NOT NULL,
  PRIMARY KEY (breadCategoryID)
);

CREATE TABLE bread (
  breadID        	INT(11)        NOT NULL   AUTO_INCREMENT,
  breadCategoryID	INT(11)        NOT NULL,
  breadCode      	VARCHAR(10)    NOT NULL   UNIQUE,
  breadName      	VARCHAR(255)   NOT NULL,
  description        	TEXT           NOT NULL,
  price              	DECIMAL(10,2)  NOT NULL,
  dateAdded          	DATETIME       NOT NULL,
  PRIMARY KEY (breadID)
);

INSERT INTO breadcategories (breadCategoryName, dateAdded) VALUES 
('Birds', '2018-11-23 13:45:15'), 
('Cats', '2021-09-14 11:10:38'), 
('Dogs', '2021-11-27 22:05:22'), 
('Snakes', '2020-10-07 21:13:54'),
('Fish', '2022-12-30 07:57:01');

INSERT INTO bread (breadCategoryID, breadCode, breadName, description, price, dateAdded) values
-- Birds
(1, 'BRD-001', 'Buddy', '2 year old Cockatiel', 0.00, '2021-12-31 23:59:59'),
(1, 'BRD-002', 'Cupcake', '4 month old Parakeet', 0.00, '2021-12-31 23:59:59'),
(1, 'BRD-003', 'SUnshine', '1 year old Lovebird', 0.00, NOW()),
-- Cats
(2, 'CAT-001', 'Simba', '6 month old American Shorthair', 0.00, '2021-12-31 23:59:59'),
(2, 'CAT-002', 'Nala', '8 month old Siamese', 0.00, '2021-12-31 23:59:59'),
(2, 'CAT-003', 'Luna', '3 year old Domestic Longhair', 0.00, NOW()),
-- Dogs
(3, 'DOG-001', 'Bailey', '9 month old Beagle', 0.00, '2021-12-31 23:59:59'),
(3, 'DOG-002', 'Sadie', '3 year old Golden Retriever', 0.00, '2021-12-31 23:59:59'),
(3, 'DOG-003', 'Cooper', '8 week old Poodle', 0.00, NOW()),
-- Snakes
(4, 'SNA-001', 'Asmodeus', '2 month old Western Hognose', 0.00, '2021-12-31 23:59:59'),
(4, 'SNA-002', 'Basil', '4 month old Garter', 0.00, '2021-12-31 23:59:59'),
(4, 'SNA-003', 'Diablo', '1 year old King Snake', 0.00, NOW()),
-- Fish
(5, 'FIS-001', 'Flipper', 'Guppy', 0.00, '2021-12-31 23:59:59'),
(5, 'FIS-002', 'Finley', 'Neon Tetra', 0.00, '2021-12-31 23:59:59'),
(5, 'FIS-003', 'Goldie', 'Goldfish', 0.00, NOW());

UPDATE bread 
SET price = ROUND(RAND() * 100, 2);

