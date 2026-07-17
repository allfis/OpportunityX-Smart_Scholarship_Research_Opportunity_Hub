SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+06:00";
SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS `opportunityx_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `opportunityx_db`;

DROP VIEW IF EXISTS `v_opportunities`;
DROP VIEW IF EXISTS `v_applications`;
DROP VIEW IF EXISTS `v_stats`;
DROP TABLE IF EXISTS `activity_log`;
DROP TABLE IF EXISTS `deadline_alerts`;
DROP TABLE IF EXISTS `notifications`;
DROP TABLE IF EXISTS `applications`;
DROP TABLE IF EXISTS `bookmarks`;
DROP TABLE IF EXISTS `opportunities`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `opportunity_types`;
DROP TABLE IF EXISTS `application_statuses`;
DROP TABLE IF EXISTS `fields_of_study`;
DROP TABLE IF EXISTS `countries`;
DROP TABLE IF EXISTS `universities`;


CREATE TABLE `universities` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `short_name` VARCHAR(20) NOT NULL,
  `country` VARCHAR(100) NOT NULL DEFAULT 'Bangladesh',
  `type` ENUM('Public','Private','International') NOT NULL DEFAULT 'Public',
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_short_name` (`short_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `universities` (`name`,`short_name`,`country`,`type`) VALUES
('Khulna University of Engineering & Technology','KUET','Bangladesh','Public'),
('University of Dhaka','DU','Bangladesh','Public'),
('Bangladesh University of Engineering & Technology','BUET','Bangladesh','Public'),
('North South University','NSU','Bangladesh','Private'),
('BRAC University','BRAC','Bangladesh','Private'),
('University of Liberal Arts Bangladesh','ULAB','Bangladesh','Private'),
('Jahangirnagar University','JU','Bangladesh','Public'),
('University of Chittagong','CU','Bangladesh','Public'),
('Rajshahi University','RU','Bangladesh','Public'),
('Bangladesh University of Professionals','BUP','Bangladesh','Public'),
('Islamic University of Technology','IUT','Bangladesh','International'),
('Shahjalal University of Science & Technology','SUST','Bangladesh','Public'),
('Chittagong University of Engineering & Technology','CUET','Bangladesh','Public'),
('Bangladesh Agricultural University','BAU','Bangladesh','Public'),
('Dhaka University of Engineering & Technology','DUET','Bangladesh','Public'),
('Massachusetts Institute of Technology','MIT','USA','International'),
('Stanford University','Stanford','USA','International'),
('University of Oxford','Oxford','UK','International'),
('Technical University of Munich','TUM','Germany','International'),
('University of Tokyo','UTokyo','Japan','International'),
('University of Toronto','UofT','Canada','International'),
('Australian National University','ANU','Australia','International'),
('National University of Singapore','NUS','Singapore','International'),
('ETH Zurich','ETHZ','Switzerland','International'),
('Tsinghua University','Tsinghua','China','International');

CREATE TABLE `fields_of_study` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(120) NOT NULL,
  `slug` VARCHAR(120) NOT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `fields_of_study` (`name`,`slug`) VALUES
('Computer Science','computer-science'),
('Engineering','engineering'),
('Medical Science','medical-science'),
('Business','business'),
('Arts & Humanities','arts'),
('Physics','physics'),
('Chemistry','chemistry'),
('Biology','biology'),
('Mathematics','mathematics'),
('Environmental Science','environmental-science'),
('Data Science','data-science'),
('Artificial Intelligence','artificial-intelligence'),
('Electrical Engineering','electrical-engineering'),
('Mechanical Engineering','mechanical-engineering'),
('Civil Engineering','civil-engineering');

CREATE TABLE `countries` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `code` VARCHAR(3) NOT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `countries` (`name`,`code`) VALUES
('Bangladesh','BD'),
('United States','US'),
('United Kingdom','GB'),
('Germany','DE'),
('Japan','JP'),
('Canada','CA'),
('Australia','AU'),
('Singapore','SG'),
('Switzerland','CH'),
('China','CN'),
('India','IN'),
('South Korea','KR'),
('Netherlands','NL'),
('France','FR'),
('Sweden','SE'),
('New Zealand','NZ');

CREATE TABLE `opportunity_types` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(60) NOT NULL,
  `slug` VARCHAR(60) NOT NULL,
  `badge_class` VARCHAR(20) NOT NULL DEFAULT 'b-sch',
  `color` VARCHAR(7) NOT NULL DEFAULT '#1d4ed8',
  `icon` VARCHAR(30) DEFAULT NULL,
  `sort_order` INT NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `opportunity_types` (`name`,`slug`,`badge_class`,`color`,`icon`,`sort_order`) VALUES
('Scholarship','scholarship','b-sch','#1d4ed8','fa-award',1),
('Research Grant','grant','b-grant','#047857','fa-microscope',2),
('Fellowship','fellowship','b-fel','#6d28d9','fa-handshake',3),
('Internship','internship','b-int','#b45309','fa-briefcase',4),
('Competition','competition','b-comp','#be185d','fa-trophy',5);

CREATE TABLE `application_statuses` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(40) NOT NULL,
  `slug` VARCHAR(40) NOT NULL,
  `color_class` VARCHAR(20) NOT NULL,
  `sort_order` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `application_statuses` (`name`,`slug`,`color_class`,`sort_order`) VALUES
('Applied','applied','c-app',1),
('Under Review','review','c-rev',2),
('Shortlisted','shortlist','c-sho',3),
('Accepted','accepted','c-acc',4),
('Rejected','rejected','c-rej',5);

CREATE TABLE `activity_log` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED DEFAULT NULL,
  `action` VARCHAR(100) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user` (`user_id`),
  KEY `idx_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `role` ENUM('student','faculty','admin') NOT NULL DEFAULT 'student',
  `university_id` INT UNSIGNED DEFAULT NULL,
  `department` VARCHAR(100) DEFAULT NULL,
  `education_level` ENUM('HSC','Bachelor''s','Master''s','PhD') DEFAULT NULL,
  `cgpa` DECIMAL(4,2) DEFAULT NULL,
  `fields_of_interest` TEXT DEFAULT NULL,
  `profile_photo` VARCHAR(255) DEFAULT NULL,
  `bio` TEXT DEFAULT NULL,
  `research_experience_years` INT UNSIGNED DEFAULT 0,
  `country_id` INT UNSIGNED DEFAULT NULL,
  `is_verified` TINYINT(1) NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `last_login` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_email` (`email`),
  KEY `idx_role` (`role`),
  KEY `idx_university` (`university_id`),
  KEY `idx_user_country` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`name`,`email`,`password_hash`,`role`,`is_verified`) VALUES
('OpportunityX Admin','admin@opportunityx.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','admin',1);

INSERT INTO `users` (`name`,`email`,`password_hash`,`role`,`university_id`,`department`,`education_level`,`cgpa`,`fields_of_interest`,`research_experience_years`,`country_id`,`is_verified`) VALUES
('Rahim Ahmed','rahim@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','student',1,'CSE','Bachelor''s',3.85,'AI, Machine Learning, Data Science',1,1,1),
('Fatima Khan','fatima@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','student',2,'Physics','Master''s',3.72,'Quantum Physics, Optics',2,1,1),
('Tanvir Islam','tanvir@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','student',3,'EEE','Bachelor''s',3.65,'IoT, Embedded Systems, Robotics',0,1,1),
('Nusrat Jahan','nusrat@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','student',4,'BBA','Master''s',3.90,'Marketing, Finance, Entrepreneurship',0,1,1),
('Sakib Hasan','sakib@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','student',6,'CSE','PhD',3.92,'NLP, Computer Vision, Deep Learning',4,1,1);

INSERT INTO `users` (`name`,`email`,`password_hash`,`role`,`university_id`,`department`,`education_level`,`fields_of_interest`,`research_experience_years`,`is_verified`) VALUES
('Dr. Kamal Hossain','kamal@kuet.ac.bd','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','faculty',1,'CSE','PhD','AI, Software Engineering',15,1),
('Dr. Sarah Smith','sarah@mit.edu','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','faculty',16,'EECS','PhD','Machine Learning, Robotics',12,1),
('Prof. Anwarul Haque','anwar@du.ac.bd','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','faculty',2,'Physics','PhD','Theoretical Physics, Astrophysics',20,1);

CREATE TABLE `opportunities` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(300) NOT NULL,
  `description` TEXT NOT NULL,
  `organization` VARCHAR(200) NOT NULL,
  `field_id` INT UNSIGNED NOT NULL,
  `country_id` INT UNSIGNED NOT NULL,
  `amount` VARCHAR(100) DEFAULT NULL,
  `deadline` DATE NOT NULL,
  `eligibility_criteria` TEXT DEFAULT NULL,
  `application_url` VARCHAR(500) DEFAULT NULL,
  `posted_by` INT UNSIGNED DEFAULT NULL,
  `is_featured` TINYINT(1) NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `views_count` INT UNSIGNED NOT NULL DEFAULT 0,
  `applications_count` INT UNSIGNED NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_type` (`type_id`),
  KEY `idx_field` (`field_id`),
  KEY `idx_country` (`country_id`),
  KEY `idx_deadline` (`deadline`),
  KEY `idx_active` (`is_active`),
  KEY `idx_posted_by` (`posted_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `opportunities` (`type_id`,`title`,`description`,`organization`,`field_id`,`country_id`,`amount`,`deadline`,`eligibility_criteria`,`is_featured`,`applications_count`) VALUES
(1,'Fulbright Foreign Student Program','Fully funded masters and PhD scholarships for international students. Covers tuition, living expenses, airfare, and health insurance.','US Department of State',1,2,'$30,000','2027-08-15','Bachelors degree with CGPA 3.5+',1,245),
(2,'NSF Research Grant 2025','Funding for innovative research projects in physics. Supports experimental and theoretical work.','National Science Foundation',6,2,'$50,000','2027-07-01','PhD student or Post-doc with research proposal',1,89),
(3,'Google PhD Fellowship','Prestigious fellowship for outstanding research in computer science. Includes tuition, stipend, and mentorship from Google researchers.','Google Research',1,2,'$40,000','2027-09-20','PhD student, 2+ years research experience',1,178),
(4,'Microsoft Research Intern','Paid internship at Microsoft Research Lab focusing on AI and systems research.','Microsoft Research',1,2,'$8,000/month','2027-06-30','Masters/PhD student in CS or related field',0,312),
(5,'ICPC World Finals 2025','The worlds most prestigious programming competition. Teams of 3 solve algorithmic problems under time pressure.','ICPC Foundation',1,5,'Trophy + Prize','2027-05-15','University students, regional qualifier required',0,567),
(6,'DAAD Scholarship Germany','Full funding for masters and PhD studies in Germany. Covers tuition, monthly stipend, travel, and health insurance.','DAAD',2,4,'$25,000','2027-10-01','Bachelors degree with CGPA 3.0+',1,198),
(7,'WHO Research Grant','WHO funding for health research in Bangladesh. Focus on public health, epidemiology, and health systems.','World Health Organization',3,1,'$20,000','2027-07-20','Medical background with research experience',0,67),
(8,'Chevening Scholarship','Fully funded one-year masters fellowship in the UK. Covers tuition, living allowance, and travel costs.','UK Government',4,3,'$35,000','2027-11-05','Bachelors degree, 2 years work experience',1,156),
(9,'JICA Internship Program','Engineering research internship in Japan. Work on infrastructure, disaster management, and technology projects.','JICA',2,5,'$5,000/month','2027-08-10','3rd/4th year Bachelors or Masters student',0,134),
(10,'NASA Space Apps Challenge','NASA space challenge hackathon with global participation. Teams solve real-world space and science problems.','NASA',2,2,'Certificate + Prize','2027-06-01','Open to all students and professionals',0,892),
(11,'MEXT Scholarship Japan','Japanese government scholarship for arts and humanities studies at Japanese universities.','Japanese Government',5,5,'$18,000','2027-05-30','HSC pass, age under 25',0,210),
(12,'IDRC Research Grant','International grant for development research in Canada. Focus on sustainable development and social innovation.','IDRC Canada',4,6,'$45,000','2027-09-15','Masters/PhD with research proposal',0,78);

INSERT INTO `opportunities` (`type_id`,`title`,`description`,`organization`,`field_id`,`country_id`,`amount`,`deadline`,`eligibility_criteria`,`posted_by`,`is_featured`) VALUES
(2,'KUET AI Research Assistantship','Research assistant position for AI/ML projects at KUET CSE department. Monthly stipend included.','KUET',1,1,'$200/month','2027-09-01','CSE students with Python and ML knowledge',7,0),
(1,'DU Physics Excellence Scholarship','Merit-based scholarship for outstanding physics students at University of Dhaka.','University of Dhaka',6,1,'BDT 15,000','2027-08-20','Physics major, CGPA 3.7+',9,0);

CREATE TABLE `bookmarks` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `opportunity_id` INT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_user_opp` (`user_id`, `opportunity_id`),
  KEY `idx_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `bookmarks` (`user_id`,`opportunity_id`) VALUES
(2,1),(2,3),(2,8),(3,6),(3,9),(4,8),(5,2),(5,3);

CREATE TABLE `applications` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `opportunity_id` INT UNSIGNED NOT NULL,
  `status_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `applied_date` DATE NOT NULL,
  `notes` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_user_opp` (`user_id`, `opportunity_id`),
  KEY `idx_user` (`user_id`),
  KEY `idx_status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `applications` (`user_id`,`opportunity_id`,`status_id`,`applied_date`) VALUES
(2,1,1,'2027-03-15'),
(2,6,1,'2027-03-20'),
(3,11,2,'2027-03-10'),
(4,8,3,'2027-03-01'),
(5,10,4,'2027-02-15');

CREATE TABLE `notifications` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `message` TEXT NOT NULL,
  `type` ENUM('deadline','status_update','new_opportunity','system') NOT NULL DEFAULT 'system',
  `opportunity_id` INT UNSIGNED DEFAULT NULL,
  `is_read` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_read` (`user_id`, `is_read`),
  KEY `idx_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `notifications` (`user_id`,`title`,`message`,`type`,`opportunity_id`) VALUES
(2,'Deadline Approaching','Fulbright Program deadline is in 15 days','deadline',1),
(2,'Application Status Updated','Your DAAD Scholarship application is now under review','status_update',6),
(3,'New Opportunity Matched','A new research grant matches your profile','new_opportunity',2),
(5,'Congratulations!','Your NASA Space Apps application has been accepted!','status_update',10),
(2,'New Scholarship Posted','KUET AI Research Assistantship has been posted','new_opportunity',13);

CREATE TABLE `deadline_alerts` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `opportunity_id` INT UNSIGNED NOT NULL,
  `alert_days_before` INT UNSIGNED NOT NULL DEFAULT 7,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_user_opp` (`user_id`, `opportunity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `deadline_alerts` (`user_id`,`opportunity_id`,`alert_days_before`) VALUES
(2,1,15),(2,3,7),(2,8,30),(3,6,14),(4,8,7),(5,2,7);

-- একজন User কোন University-এর তা নির্দেশ করে।
-- University delete হলে user থাকবে, শুধু university_id NULL হবে।

ALTER TABLE `users` ADD CONSTRAINT `fk_user_uni` FOREIGN KEY (`university_id`) REFERENCES `universities` (`id`) ON DELETE SET NULL;

-- একজন User কোন Country-এর তা নির্দেশ করে।
-- Country delete হলে user থাকবে, country_id NULL হবে।

ALTER TABLE `users` ADD CONSTRAINT `fk_user_cnt` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE SET NULL;

-- প্রতিটি Opportunity কোন Type (Scholarship, Internship ইত্যাদি) এর তা নির্দেশ করে।
ALTER TABLE `opportunities` ADD CONSTRAINT `fk_opp_type` FOREIGN KEY (`type_id`) REFERENCES `opportunity_types` (`id`);

-- প্রতিটি Opportunity কোন Field of Study এর তা নির্দেশ করে।
ALTER TABLE `opportunities` ADD CONSTRAINT `fk_opp_field` FOREIGN KEY (`field_id`) REFERENCES `fields_of_study` (`id`);

-- Opportunity কোন Country-এর তা নির্দেশ করে।
ALTER TABLE `opportunities` ADD CONSTRAINT `fk_opp_cnt` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

-- কোন User Opportunity পোস্ট করেছে তা নির্দেশ করে।
-- User delete হলে Opportunity থাকবে, posted_by NULL হবে।
ALTER TABLE `opportunities` ADD CONSTRAINT `fk_opp_post` FOREIGN KEY (`posted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

-- User delete হলে তার Bookmark-ও delete হবে।
ALTER TABLE `bookmarks` ADD CONSTRAINT `fk_bm_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

-- Opportunity delete হলে Bookmark-ও delete হবে।
ALTER TABLE `bookmarks` ADD CONSTRAINT `fk_bm_opp` FOREIGN KEY (`opportunity_id`) REFERENCES `opportunities` (`id`) ON DELETE CASCADE;

-- User delete হলে তার Application-ও delete হবে, Opportunity delete হলে Application-ও delete হবে।

ALTER TABLE `applications` ADD CONSTRAINT `fk_app_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
ALTER TABLE `applications` ADD CONSTRAINT `fk_app_opp` FOREIGN KEY (`opportunity_id`) REFERENCES `opportunities` (`id`) ON DELETE CASCADE;
ALTER TABLE `applications` ADD CONSTRAINT `fk_app_stat` FOREIGN KEY (`status_id`) REFERENCES `application_statuses` (`id`);

-- User delete হলে Notification-ও delete হবে, Opportunity delete হলে Notification থাকবে কিন্তু opportunity_id NULL হবে।

ALTER TABLE `notifications` ADD CONSTRAINT `fk_ntf_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
ALTER TABLE `notifications` ADD CONSTRAINT `fk_ntf_opp` FOREIGN KEY (`opportunity_id`) REFERENCES `opportunities` (`id`) ON DELETE SET NULL;

-- User delete হলে Alert-ও delete হবে, Opportunity delete হলে Alert-ও delete হবে।
ALTER TABLE `deadline_alerts` ADD CONSTRAINT `fk_da_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
ALTER TABLE `deadline_alerts` ADD CONSTRAINT `fk_da_opp` FOREIGN KEY (`opportunity_id`) REFERENCES `opportunities` (`id`) ON DELETE CASCADE;

-- User delete হলে Log থাকবে কিন্তু user_id NULL হবে।
ALTER TABLE `activity_log` ADD CONSTRAINT `fk_log_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

-- Opportunity title এবং description দ্রুত Search করার জন্য।
-- Type, Field, Country, Active Status এবং Deadline অনুযায়ী দ্রুত Filter করার জন্য।
-- User-এর Unread Notification দ্রুত বের করার জন্য।
-- User-এর Applications এবং Status দ্রুত দেখানোর জন্য।

CREATE INDEX idx_opp_search ON opportunities (title(100), description(100));
CREATE INDEX idx_opp_filter ON opportunities (type_id, field_id, country_id, is_active, deadline);
CREATE INDEX idx_notif_unread ON notifications (user_id, is_read, created_at DESC);
CREATE INDEX idx_app_us ON applications (user_id, status_id);

CREATE VIEW `v_opportunities` AS
SELECT
  o.id, o.title, o.description, o.organization, o.amount, o.deadline,
  o.eligibility_criteria, o.application_url, o.is_featured, o.is_active,
  o.views_count, o.applications_count, o.created_at,
  ot.id AS type_id, ot.name AS type_name, ot.slug AS type_slug,
  ot.badge_class AS type_badge, ot.color AS type_color,
  f.id AS field_id, f.name AS field_name, f.slug AS field_slug,
  c.id AS country_id, c.name AS country_name, c.code AS country_code,
  u.id AS posted_by_id, u.name AS posted_by_name,
  un.name AS posted_by_university,
  DATEDIFF(o.deadline, CURDATE()) AS days_remaining,
  CASE
    WHEN DATEDIFF(o.deadline, CURDATE()) <= 7 THEN 'urgent'
    WHEN DATEDIFF(o.deadline, CURDATE()) <= 30 THEN 'soon'
    ELSE 'normal'
  END AS deadline_status
FROM opportunities o
INNER JOIN opportunity_types ot ON o.type_id = ot.id
INNER JOIN fields_of_study f ON o.field_id = f.id
INNER JOIN countries c ON o.country_id = c.id
LEFT JOIN users u ON o.posted_by = u.id
LEFT JOIN universities un ON u.university_id = un.id
WHERE o.is_active = 1;

CREATE VIEW `v_applications` AS
SELECT
  a.id, a.applied_date, a.notes, a.created_at, a.updated_at,
  a.user_id, u.name AS user_name, u.email AS user_email,
  a.opportunity_id, o.title AS opportunity_title,
  o.organization AS opportunity_org, o.amount AS opportunity_amount,
  ot.name AS opportunity_type, ot.badge_class AS opportunity_badge,
  a.status_id, s.name AS status_name, s.slug AS status_slug,
  s.color_class AS status_color
FROM applications a
INNER JOIN users u ON a.user_id = u.id
INNER JOIN opportunities o ON a.opportunity_id = o.id
INNER JOIN opportunity_types ot ON o.type_id = ot.id
INNER JOIN application_statuses s ON a.status_id = s.id;

CREATE VIEW `v_stats` AS
SELECT
  (SELECT COUNT(*) FROM opportunities WHERE is_active = 1 AND type_id = 1) AS total_scholarships,
  (SELECT COUNT(*) FROM opportunities WHERE is_active = 1 AND type_id = 2) AS total_grants,
  (SELECT COUNT(*) FROM opportunities WHERE is_active = 1 AND type_id IN (3,4)) AS total_fellowships_internships,
  (SELECT COUNT(*) FROM users WHERE role = 'student' AND is_active = 1) AS total_students,
  (SELECT COUNT(*) FROM applications) AS total_applications,
  (SELECT COUNT(*) FROM applications WHERE status_id = 4) AS total_accepted,
  (SELECT COUNT(*) FROM bookmarks) AS total_bookmarks,
  (SELECT COUNT(*) FROM universities WHERE is_active = 1) AS total_universities;

SET FOREIGN_KEY_CHECKS = 1;
COMMIT;