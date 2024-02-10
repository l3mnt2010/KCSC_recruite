SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";


CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `logcode` int(12) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, "RedVelvet","https://youtu.be/xlyrt5eAtKI"),
(2, "NewJeans","https://youtu.be/ArmDp-zijuc"),
(3, "IVE","https://youtu.be/F0B7HDiY-10"),
(4, "LE SSERAFIM", "https://youtu.be/hLvWy2b857I"),
(5, "aespa", "REDACTED"), 
(6, "NewJeans","https://youtu.be/sVTy_wmn5SU");



GRANT ALL PRIVILEGES ON KCSC_TTV.* TO KCSC;
FLUSH PRIVILEGES;
