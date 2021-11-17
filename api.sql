-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 17 Kas 2021, 14:27:30
-- Sunucu sürümü: 10.5.12-MariaDB-cll-lve
-- PHP Sürümü: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `u145228262_dersler`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anahtarlar`
--

CREATE TABLE `anahtarlar` (
  `id` int(11) NOT NULL,
  `token` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `izin` int(11) NOT NULL,
  `resimlimit` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp(),
  `mevcutsorgu` int(11) NOT NULL,
  `gunluklimit` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `anahtarlar`
--

INSERT INTO `anahtarlar` (`id`, `token`, `izin`, `resimlimit`, `tarih`, `mevcutsorgu`, `gunluklimit`) VALUES
(1, '1RTHt2pfE2yo0g9km35', 1, 10, '2021-11-17 10:39:14', 6, 20);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bilgi`
--

CREATE TABLE `bilgi` (
  `id` int(11) NOT NULL,
  `ad` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `yas` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `memleket` varchar(20) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `bilgi`
--

INSERT INTO `bilgi` (`id`, `ad`, `yas`, `memleket`) VALUES
(1, 'Bahadır Önal', '22', 'Aksaray');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `havadurumu`
--

CREATE TABLE `havadurumu` (
  `id` int(11) NOT NULL,
  `sehirid` int(11) NOT NULL,
  `dun` int(11) NOT NULL,
  `bugun` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `havadurumu`
--

INSERT INTO `havadurumu` (`id`, `sehirid`, `dun`, `bugun`) VALUES
(1, 1, 15, 23),
(2, 2, 17, 19),
(3, 3, 14, 20),
(4, 4, 17, 16),
(5, 5, 23, 28);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `resimler`
--

CREATE TABLE `resimler` (
  `id` int(11) NOT NULL,
  `adveyol` varchar(30) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `resimler`
--

INSERT INTO `resimler` (`id`, `adveyol`) VALUES
(1, 'res/aile-bebek.jpg'),
(2, 'res/bina.jpg'),
(3, 'res/caliskan-insan.jpg'),
(4, 'res/cifttaksi-araba.jpg'),
(5, 'res/cin-bina.jpg'),
(6, 'res/deniz-doga.jpg'),
(7, 'res/dogal-doga.jpg'),
(8, 'res/farklı-insan.jpg'),
(9, 'res/gazete-insan.jpg'),
(10, 'res/gosterge-araba.jpg'),
(11, 'res/guzel-araba.jpg'),
(12, 'res/hayalperest-insan.jpg'),
(13, 'res/heyecanlı-insan.jpg'),
(14, 'res/hırcin-araba.jpg'),
(15, 'res/huzur-doga.jpg'),
(16, 'res/ilk-bebek.jpg'),
(17, 'res/ismerkezi-bina.jpg'),
(18, 'res/ıssız-doga.jpg'),
(19, 'res/iyi-doga.jpg'),
(20, 'res/kadın-insan.jpg'),
(21, 'res/kırmızı-araba.jpg'),
(22, 'res/normal-bebek.jpg'),
(23, 'res/normal-bina.jpg'),
(24, 'res/pahalı-araba.jpg'),
(25, 'res/pembe-bebek.jpg'),
(26, 'res/saglam-araba.jpg'),
(27, 'res/sinirli-doga.jpg'),
(28, 'res/taksi-araba.jpg'),
(29, 'res/turuncu-araba.jpg'),
(30, 'res/yalnız-doga.jpg'),
(31, 'res/yaris-araba.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sehirler`
--

CREATE TABLE `sehirler` (
  `id` int(11) NOT NULL,
  `ad` varchar(20) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sehirler`
--

INSERT INTO `sehirler` (`id`, `ad`) VALUES
(1, 'İstanbul'),
(2, 'İzmir'),
(3, 'Ankara'),
(4, 'Antalya'),
(5, 'Bursa');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `anahtarlar`
--
ALTER TABLE `anahtarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `bilgi`
--
ALTER TABLE `bilgi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `havadurumu`
--
ALTER TABLE `havadurumu`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `resimler`
--
ALTER TABLE `resimler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sehirler`
--
ALTER TABLE `sehirler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `anahtarlar`
--
ALTER TABLE `anahtarlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `bilgi`
--
ALTER TABLE `bilgi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `havadurumu`
--
ALTER TABLE `havadurumu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `resimler`
--
ALTER TABLE `resimler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Tablo için AUTO_INCREMENT değeri `sehirler`
--
ALTER TABLE `sehirler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
