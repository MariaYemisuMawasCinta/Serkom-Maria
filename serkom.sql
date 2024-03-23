CREATE DATABASE serkom;
USE serkom;

--
-- Struktur tabel untuk tabel `beasiswa`
--

CREATE TABLE `beasiswa` (
  `MasukanNama` varchar(50) NOT NULL,
  `MasukanEmail` varchar(50) NOT NULL,
  `NomorHP` varchar(30) NOT NULL,
  `smt` varchar(10) NOT NULL,
  `ipk` varchar(10) NOT NULL,
  `beasiswa` varchar(20) NOT NULL,
  `status_ajuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
