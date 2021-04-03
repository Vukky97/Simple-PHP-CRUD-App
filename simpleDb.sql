SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status`  varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ownerName` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ownerEmail` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `projects` (`id`, `title`, `description`,`status`,`ownerName`,`ownerEmail`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Phasellus porttitotelis felis, sed lobortis nunc. ','Fejlesztésre vár','Test Owner', 'test@test.io'),
(2, 'Pellentesque bibendum vehicula sapien, a molestie velit pharetra nec.', 'Douis tristique dui consectetu imperdiet te.','Folyamatban','Test Owner', 'test@test.io'),
(3, 'Vestibulum sapien metus, feugiat non nunc sed, laoreet luctus dolor.', 'Vestibulum ni','Kész','Test Owner', 'test@test.io');


ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

COMMIT;
