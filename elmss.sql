-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 14 Feb 2024 pada 11.23
-- Versi server: 8.0.35-0ubuntu0.22.04.1
-- Versi PHP: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elmss`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `api_setting`
--

CREATE TABLE `api_setting` (
  `id` int NOT NULL,
  `auto_sync` int NOT NULL DEFAULT '0',
  `edit_profile_siswa` int NOT NULL DEFAULT '0',
  `edit_profile_guru` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `api_token`
--

CREATE TABLE `api_token` (
  `id_api` int NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int NOT NULL,
  `address` text NOT NULL,
  `agent` text NOT NULL,
  `device` text NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku_induk`
--

CREATE TABLE `buku_induk` (
  `id_siswa` int NOT NULL,
  `uid` varchar(50) NOT NULL,
  `rombel_awal` varchar(50) DEFAULT NULL,
  `nama_panggilan` varchar(50) DEFAULT NULL,
  `bahasa` varchar(50) DEFAULT NULL,
  `jml_saudara_kandung` int NOT NULL DEFAULT '0',
  `jml_saudara_tiri` int NOT NULL DEFAULT '0',
  `jml_saudara_angkat` int NOT NULL DEFAULT '0',
  `yatim` int NOT NULL DEFAULT '0' COMMENT '0=ada orang-tua, 1=yatim, 2=yatim piatu',
  `tinggal_bersama` varchar(1) NOT NULL DEFAULT '1' COMMENT '1=orang-tua, 2=saudara, 3=wali, 4=asrama/pesantren, 5=kost, 6=lainnya',
  `jarak` varchar(10) DEFAULT NULL,
  `gol_darah` varchar(4) DEFAULT NULL,
  `penyakit` mediumtext,
  `kelainan_fisik` varchar(100) DEFAULT NULL,
  `kegemaran` longtext,
  `beasiswa` longtext,
  `no_ijazah_sebelumnya` varchar(50) DEFAULT NULL,
  `tahun_lulus_sebelumnya` varchar(10) DEFAULT NULL,
  `pindahan_dari` varchar(100) DEFAULT NULL,
  `alasan_kepindahan` varchar(200) DEFAULT NULL,
  `agama_ayah` varchar(20) DEFAULT NULL,
  `tempat_lahir_ayah` varchar(50) DEFAULT NULL,
  `wn_ayah` varchar(50) DEFAULT NULL,
  `penghasilan_ayah` varchar(50) DEFAULT NULL,
  `hidup_meninggal_ayah` varchar(50) DEFAULT NULL,
  `agama_ibu` varchar(50) DEFAULT NULL,
  `tempat_lahir_ibu` varchar(50) DEFAULT NULL,
  `wn_ibu` varchar(50) DEFAULT NULL,
  `penghasilan_ibu` varchar(50) DEFAULT NULL,
  `hidup_meninggal_ibu` varchar(50) DEFAULT NULL,
  `tempat_lahir_wali` varchar(50) DEFAULT NULL,
  `agama_wali` varchar(20) DEFAULT NULL,
  `wn_wali` varchar(50) DEFAULT NULL,
  `penghasilan_wali` varchar(10) DEFAULT NULL,
  `status` int DEFAULT '1' COMMENT '1= aktif, 2=lulus, 3=pindah, 4=keluar',
  `tahun_lulus` int DEFAULT NULL,
  `no_ijazah` varchar(50) DEFAULT NULL,
  `kelas_akhir` varchar(50) DEFAULT NULL,
  `lanjut_ke` varchar(50) DEFAULT NULL,
  `pindah_ke` varchar(100) DEFAULT NULL,
  `alasan_pindah` varchar(100) DEFAULT NULL,
  `tgl_pindah` varchar(20) DEFAULT NULL,
  `bekerja_di` varchar(100) DEFAULT NULL,
  `catatan_penting` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `buku_induk`
--

INSERT INTO `buku_induk` (`id_siswa`, `uid`, `rombel_awal`, `nama_panggilan`, `bahasa`, `jml_saudara_kandung`, `jml_saudara_tiri`, `jml_saudara_angkat`, `yatim`, `tinggal_bersama`, `jarak`, `gol_darah`, `penyakit`, `kelainan_fisik`, `kegemaran`, `beasiswa`, `no_ijazah_sebelumnya`, `tahun_lulus_sebelumnya`, `pindahan_dari`, `alasan_kepindahan`, `agama_ayah`, `tempat_lahir_ayah`, `wn_ayah`, `penghasilan_ayah`, `hidup_meninggal_ayah`, `agama_ibu`, `tempat_lahir_ibu`, `wn_ibu`, `penghasilan_ibu`, `hidup_meninggal_ibu`, `tempat_lahir_wali`, `agama_wali`, `wn_wali`, `penghasilan_wali`, `status`, `tahun_lulus`, `no_ijazah`, `kelas_akhir`, `lanjut_ke`, `pindah_ke`, `alasan_pindah`, `tgl_pindah`, `bekerja_di`, `catatan_penting`) VALUES
(1, '12dc0e3d-c2b5-11ee-baa6-ecf4bbdec16c', NULL, NULL, NULL, 0, 0, 0, 0, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'f9d8b119-c9cb-11ee-baa6-ecf4bbdec16c', NULL, NULL, NULL, 0, 0, 0, 0, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bulan`
--

CREATE TABLE `bulan` (
  `id_bln` int NOT NULL,
  `nama_bln` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `bulan`
--

INSERT INTO `bulan` (`id_bln`, `nama_bln`) VALUES
(1, 'Januari'),
(2, 'Februari'),
(3, 'Maret'),
(4, 'April'),
(5, 'Mei'),
(6, 'Juni'),
(7, 'Juli'),
(8, 'Agustus'),
(9, 'September'),
(10, 'Oktober'),
(11, 'November'),
(12, 'Desember');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_bank_soal`
--

CREATE TABLE `cbt_bank_soal` (
  `id_bank` int NOT NULL,
  `bank_jenis_id` int NOT NULL DEFAULT '0',
  `bank_kode` varchar(255) NOT NULL DEFAULT '0',
  `bank_level` varchar(225) NOT NULL,
  `bank_kelas` longtext NOT NULL,
  `bank_mapel_id` int DEFAULT NULL,
  `bank_jurusan_id` int NOT NULL DEFAULT '0',
  `bank_guru_id` int DEFAULT NULL,
  `bank_nama` varchar(250) NOT NULL,
  `kkm` int DEFAULT '0',
  `jml_soal` int NOT NULL DEFAULT '0',
  `jml_esai` int NOT NULL DEFAULT '0',
  `tampil_pg` int NOT NULL DEFAULT '0',
  `tampil_esai` int NOT NULL DEFAULT '0',
  `bobot_pg` int NOT NULL DEFAULT '0',
  `bobot_esai` int NOT NULL DEFAULT '0',
  `opsi` int NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '0',
  `soal_agama` varchar(20) DEFAULT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `deskripsi` longtext,
  `jml_kompleks` int NOT NULL DEFAULT '0',
  `tampil_kompleks` int NOT NULL DEFAULT '0',
  `bobot_kompleks` int NOT NULL DEFAULT '0',
  `jml_jodohkan` int NOT NULL DEFAULT '0',
  `tampil_jodohkan` int NOT NULL DEFAULT '0',
  `bobot_jodohkan` int NOT NULL DEFAULT '0',
  `jml_isian` int NOT NULL DEFAULT '0',
  `tampil_isian` int NOT NULL DEFAULT '0',
  `bobot_isian` int NOT NULL DEFAULT '0',
  `status_soal` int NOT NULL DEFAULT '0' COMMENT '0=belum selesai, 1=sudah selesai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_durasi_siswa`
--

CREATE TABLE `cbt_durasi_siswa` (
  `id_durasi` int NOT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_jadwal` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '0=belum ujian, 1=sedang ujian, 2=sudah ujian',
  `lama_ujian` time DEFAULT NULL,
  `mulai` varchar(22) DEFAULT NULL,
  `selesai` varchar(22) DEFAULT NULL,
  `reset` int NOT NULL DEFAULT '0' COMMENT '0=tidak, 1=reset dari 0, 2=reset dari sisa waktu, 3=ulangi semua',
  `time_create` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_jadwal`
--

CREATE TABLE `cbt_jadwal` (
  `id_jadwal` int NOT NULL,
  `id_tp` char(2) NOT NULL,
  `id_smt` char(2) NOT NULL,
  `id_bank` int DEFAULT NULL,
  `id_jenis` int DEFAULT NULL,
  `tgl_mulai` varchar(20) NOT NULL,
  `tgl_selesai` varchar(20) NOT NULL,
  `durasi_ujian` int NOT NULL,
  `pengawas` longtext,
  `acak_soal` int NOT NULL,
  `acak_opsi` int NOT NULL,
  `hasil_tampil` int NOT NULL,
  `token` int NOT NULL,
  `status` int NOT NULL,
  `ulang` int NOT NULL,
  `reset_login` int NOT NULL,
  `rekap` int NOT NULL DEFAULT '0',
  `jam_ke` int NOT NULL DEFAULT '0',
  `jarak` int NOT NULL DEFAULT '0',
  `time_create` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_jenis`
--

CREATE TABLE `cbt_jenis` (
  `id_jenis` int NOT NULL,
  `nama_jenis` varchar(50) NOT NULL,
  `kode_jenis` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `cbt_jenis`
--

INSERT INTO `cbt_jenis` (`id_jenis`, `nama_jenis`, `kode_jenis`) VALUES
(1, 'Penilaian Harian', 'PH'),
(2, 'Penilaian Tengah Semester', 'PTS'),
(3, 'Penilaian Akhir Semester', 'PAS'),
(4, 'Penilaian Akhir Tahun', 'PAT'),
(5, 'Ujian Madrasah Berbasis Komputer', 'UMBK'),
(6, 'Try Out', 'TO'),
(7, 'Simulasi', 'SIML');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_kelas_ruang`
--

CREATE TABLE `cbt_kelas_ruang` (
  `id_kelas_ruang` varchar(50) NOT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_ruang` int NOT NULL,
  `id_sesi` int NOT NULL DEFAULT '0',
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `set_siswa` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_kop_absensi`
--

CREATE TABLE `cbt_kop_absensi` (
  `id_kop` int NOT NULL,
  `header_1` varchar(100) DEFAULT NULL,
  `header_2` varchar(100) DEFAULT NULL,
  `header_3` varchar(100) DEFAULT NULL,
  `header_4` varchar(100) DEFAULT NULL,
  `proktor` varchar(100) DEFAULT NULL,
  `pengawas_1` varchar(100) DEFAULT NULL,
  `pengawas_2` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_kop_berita`
--

CREATE TABLE `cbt_kop_berita` (
  `id_kop` int NOT NULL,
  `header_1` varchar(100) DEFAULT NULL,
  `header_2` varchar(100) DEFAULT NULL,
  `header_3` varchar(100) DEFAULT NULL,
  `header_4` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_kop_kartu`
--

CREATE TABLE `cbt_kop_kartu` (
  `id_set_kartu` int NOT NULL,
  `header_1` varchar(100) DEFAULT NULL,
  `header_2` varchar(100) DEFAULT NULL,
  `header_3` varchar(100) DEFAULT NULL,
  `header_4` varchar(100) DEFAULT NULL,
  `tanggal` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_nilai`
--

CREATE TABLE `cbt_nilai` (
  `id_nilai` int NOT NULL,
  `pg_benar` int DEFAULT '0',
  `pg_nilai` varchar(10) DEFAULT '0',
  `essai_nilai` varchar(10) DEFAULT '0',
  `id_siswa` int DEFAULT NULL,
  `id_jadwal` int DEFAULT NULL,
  `kompleks_nilai` varchar(10) DEFAULT '0',
  `jodohkan_nilai` varchar(10) DEFAULT '0',
  `isian_nilai` varchar(10) DEFAULT '0',
  `dikoreksi` int NOT NULL DEFAULT '0',
  `time_create` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_nomor_peserta`
--

CREATE TABLE `cbt_nomor_peserta` (
  `id_nomor` int NOT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL DEFAULT '1',
  `nomor_peserta` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_pengawas`
--

CREATE TABLE `cbt_pengawas` (
  `id_pengawas` varchar(50) NOT NULL,
  `id_jadwal` varchar(50) NOT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_ruang` varchar(50) NOT NULL,
  `id_sesi` varchar(50) NOT NULL,
  `id_guru` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_rekap`
--

CREATE TABLE `cbt_rekap` (
  `id_rekap` int NOT NULL,
  `id_tp` int NOT NULL,
  `tp` varchar(20) NOT NULL,
  `id_smt` int NOT NULL,
  `smt` varchar(20) NOT NULL,
  `id_jadwal` varchar(250) NOT NULL,
  `id_jenis` varchar(250) NOT NULL,
  `kode_jenis` varchar(20) NOT NULL,
  `id_bank` varchar(250) NOT NULL,
  `bank_kelas` mediumtext NOT NULL,
  `bank_kode` varchar(20) NOT NULL,
  `bank_level` int NOT NULL,
  `id_mapel` varchar(250) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `tgl_mulai` varchar(22) NOT NULL,
  `tgl_selesai` varchar(22) NOT NULL,
  `tampil_pg` int NOT NULL,
  `jawaban_pg` longtext NOT NULL,
  `tampil_esai` int NOT NULL,
  `jawaban_esai` longtext NOT NULL,
  `bobot_pg` int NOT NULL,
  `bobot_esai` int NOT NULL,
  `id_guru` varchar(250) NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `nama_kelas` mediumtext,
  `soal_kompleks` longtext,
  `soal_jodohkan` longtext,
  `soal_isian` longtext,
  `soal_essai` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_rekap_nilai`
--

CREATE TABLE `cbt_rekap_nilai` (
  `id_rekap_nilai` int NOT NULL,
  `id_jadwal` int DEFAULT NULL,
  `id_tp` int NOT NULL,
  `tp` varchar(20) NOT NULL,
  `id_smt` int NOT NULL,
  `smt` varchar(20) NOT NULL,
  `id_jenis` int NOT NULL,
  `kode_jenis` varchar(20) NOT NULL,
  `id_bank` int DEFAULT NULL,
  `id_mapel` int DEFAULT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_kelas` int DEFAULT '0',
  `kelas` varchar(20) NOT NULL,
  `mulai` varchar(20) NOT NULL,
  `selesai` varchar(20) NOT NULL,
  `durasi` varchar(20) NOT NULL,
  `bobot_pg` int NOT NULL,
  `jawaban_pg` longtext NOT NULL,
  `nilai_pg` varchar(10) NOT NULL,
  `bobot_esai` int NOT NULL,
  `jawaban_esai` longtext NOT NULL,
  `nilai_esai` varchar(10) NOT NULL,
  `id_guru` int DEFAULT NULL,
  `nama_siswa` varchar(100) DEFAULT NULL,
  `no_peserta` varchar(100) DEFAULT NULL,
  `soal_kompleks` longtext,
  `soal_jodohkan` longtext,
  `soal_isian` longtext,
  `soal_essai` longtext,
  `time_create` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_ruang`
--

CREATE TABLE `cbt_ruang` (
  `id_ruang` int NOT NULL,
  `nama_ruang` varchar(50) NOT NULL,
  `kode_ruang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `cbt_ruang`
--

INSERT INTO `cbt_ruang` (`id_ruang`, `nama_ruang`, `kode_ruang`) VALUES
(1, 'Ruang 1', 'LAB-KOM'),
(2, 'Ruang 2', 'R2'),
(3, 'Ruang 3', 'R3'),
(4, 'Ruang 4', 'R4'),
(5, 'Ruang 5', 'R5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_sesi`
--

CREATE TABLE `cbt_sesi` (
  `id_sesi` int NOT NULL,
  `nama_sesi` varchar(50) NOT NULL,
  `kode_sesi` varchar(10) NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_akhir` time NOT NULL,
  `aktif` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `cbt_sesi`
--

INSERT INTO `cbt_sesi` (`id_sesi`, `nama_sesi`, `kode_sesi`, `waktu_mulai`, `waktu_akhir`, `aktif`) VALUES
(1, 'Sesi 1', 'S1', '07:30:00', '09:30:00', 1),
(2, 'Sesi 2', 'S2', '09:00:00', '12:30:00', 1),
(3, 'Sesi 3', 'S3', '10:30:00', '14:00:00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_sesi_siswa`
--

CREATE TABLE `cbt_sesi_siswa` (
  `siswa_id` int NOT NULL,
  `kelas_id` int DEFAULT NULL,
  `ruang_id` int NOT NULL,
  `sesi_id` int NOT NULL,
  `tp_id` int NOT NULL,
  `smt_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_soal`
--

CREATE TABLE `cbt_soal` (
  `id_soal` int NOT NULL,
  `bank_id` int DEFAULT NULL,
  `mapel_id` int DEFAULT '0',
  `jenis` int NOT NULL COMMENT '1=ganda, 2=ganda kompleks, 3=menjodohkan, 4=isian singkat, 5=uraian',
  `nomor_soal` int DEFAULT '0',
  `file` varchar(255) DEFAULT NULL,
  `file1` mediumtext,
  `tipe_file` varchar(50) DEFAULT NULL,
  `soal` longtext,
  `opsi_a` longtext,
  `opsi_b` longtext,
  `opsi_c` longtext,
  `opsi_d` longtext,
  `opsi_e` longtext,
  `file_a` varchar(255) DEFAULT NULL,
  `file_b` varchar(255) DEFAULT NULL,
  `file_c` varchar(255) DEFAULT NULL,
  `file_d` varchar(255) DEFAULT NULL,
  `file_e` varchar(255) DEFAULT NULL,
  `jawaban` longtext,
  `created_on` int DEFAULT NULL,
  `updated_on` int DEFAULT NULL,
  `tampilkan` int NOT NULL DEFAULT '0',
  `deskripsi` longtext NOT NULL,
  `kesulitan` int NOT NULL DEFAULT '1' COMMENT 'tingkat kesulitan 1-10',
  `timer` int NOT NULL DEFAULT '0' COMMENT '0=tidak, 1=ya',
  `timer_menit` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_soal_siswa`
--

CREATE TABLE `cbt_soal_siswa` (
  `id_soal_siswa` varchar(15) NOT NULL,
  `id_bank` int DEFAULT NULL,
  `id_jadwal` int DEFAULT NULL,
  `id_soal` int DEFAULT NULL,
  `id_siswa` int DEFAULT NULL,
  `jenis_soal` int NOT NULL,
  `no_soal_alias` int NOT NULL,
  `opsi_alias_a` varchar(1) DEFAULT NULL,
  `opsi_alias_b` varchar(1) DEFAULT NULL,
  `opsi_alias_c` varchar(1) DEFAULT NULL,
  `opsi_alias_d` varchar(1) DEFAULT NULL,
  `opsi_alias_e` varchar(1) DEFAULT NULL,
  `jawaban_alias` longtext,
  `jawaban_siswa` longtext,
  `jawaban_benar` longtext,
  `point_essai` int DEFAULT '0',
  `soal_end` int NOT NULL DEFAULT '0',
  `point_soal` varchar(5) NOT NULL DEFAULT '0',
  `nilai_koreksi` varchar(5) NOT NULL DEFAULT '0',
  `nilai_otomatis` int NOT NULL DEFAULT '0' COMMENT '0=otomatis, 1=dari guru',
  `time_create` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_token`
--

CREATE TABLE `cbt_token` (
  `token` varchar(6) NOT NULL,
  `auto` int NOT NULL,
  `id_token` int NOT NULL,
  `jarak` int NOT NULL DEFAULT '0',
  `updated` varchar(20) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `cbt_token`
--

INSERT INTO `cbt_token` (`token`, `auto`, `id_token`, `jarak`, `updated`) VALUES
('HILZCX', 0, 1, 0, '2022-03-25 08:05:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `id` mediumint UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'guru', 'Pembuat Soal dan ujian'),
(3, 'siswa', 'Peserta Ujian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hari`
--

CREATE TABLE `hari` (
  `id_hri` int NOT NULL,
  `nama_hri` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `hari`
--

INSERT INTO `hari` (`id_hri`, `nama_hri`) VALUES
(1, 'Senin'),
(2, 'Selasa'),
(3, 'Rabu'),
(4, 'Kamis'),
(5, 'Jum\'at'),
(6, 'Sabtu'),
(7, 'Minggu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan_guru`
--

CREATE TABLE `jabatan_guru` (
  `id_jabatan_guru` varchar(50) NOT NULL,
  `id_guru` int DEFAULT NULL,
  `id_jabatan` int NOT NULL,
  `id_kelas` int DEFAULT '0',
  `mapel_kelas` longtext,
  `ekstra_kelas` longtext,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `jabatan_guru`
--

INSERT INTO `jabatan_guru` (`id_jabatan_guru`, `id_guru`, `id_jabatan`, `id_kelas`, `mapel_kelas`, `ekstra_kelas`, `id_tp`, `id_smt`) VALUES
('141', 1, 5, 0, 'a:1:{i:0;a:3:{s:8:\"id_mapel\";s:2:\"32\";s:10:\"nama_mapel\";s:11:\"Informatika\";s:11:\"kelas_mapel\";a:3:{i:0;a:1:{s:5:\"kelas\";s:11:\"INF-ANKES-X\";}i:1;a:1:{s:5:\"kelas\";s:11:\"INF-ANKIM-X\";}i:2;a:1:{s:5:\"kelas\";N;}}}}', 'a:0:{}', 4, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_catatan_mapel`
--

CREATE TABLE `kelas_catatan_mapel` (
  `id_catatan` int NOT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `type` int NOT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_mapel` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_guru` int DEFAULT NULL,
  `level` varchar(1) NOT NULL DEFAULT '0',
  `tgl` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` text NOT NULL,
  `readed` varchar(22) NOT NULL DEFAULT '0',
  `reading` longtext COMMENT 'array id_siswa yang membaca',
  `jml` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_catatan_wali`
--

CREATE TABLE `kelas_catatan_wali` (
  `id_catatan` int NOT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `type` int NOT NULL COMMENT '1=semua siswa, 2=per siswa',
  `level` varchar(1) NOT NULL COMMENT '1=saran, 2=teguran, 3=peringatan, 4=sangsi',
  `tgl` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_siswa` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL,
  `text` text NOT NULL,
  `readed` varchar(22) NOT NULL DEFAULT '0',
  `reading` longtext,
  `jml` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_ekstra`
--

CREATE TABLE `kelas_ekstra` (
  `id_kelas_ekstra` varchar(50) NOT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_kelas` int DEFAULT NULL,
  `ekstra` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_jadwal_kbm`
--

CREATE TABLE `kelas_jadwal_kbm` (
  `id_kbm` int NOT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_kelas` int DEFAULT NULL,
  `kbm_jam_pel` int NOT NULL,
  `kbm_jam_mulai` varchar(5) NOT NULL,
  `kbm_jml_mapel_hari` int NOT NULL,
  `istirahat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `kelas_jadwal_kbm`
--

INSERT INTO `kelas_jadwal_kbm` (`id_kbm`, `id_tp`, `id_smt`, `id_kelas`, `kbm_jam_pel`, `kbm_jam_mulai`, `kbm_jml_mapel_hari`, `istirahat`) VALUES
(410, 4, 1, 0, 45, '06:30', 5, 'a:2:{i:0;a:2:{s:3:\"ist\";s:1:\"3\";s:3:\"dur\";s:2:\"20\";}i:1;a:2:{s:3:\"ist\";s:1:\"3\";s:3:\"dur\";s:2:\"20\";}}');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_jadwal_mapel`
--

CREATE TABLE `kelas_jadwal_mapel` (
  `id_jadwal` int NOT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_hari` int NOT NULL,
  `jam_ke` int NOT NULL,
  `id_mapel` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `kelas_jadwal_mapel`
--

INSERT INTO `kelas_jadwal_mapel` (`id_jadwal`, `id_tp`, `id_smt`, `id_kelas`, `id_hari`, `jam_ke`, `id_mapel`) VALUES
(41011, 4, 1, 0, 1, 1, 41),
(41012, 4, 1, 0, 1, 2, 42),
(41014, 4, 1, 0, 1, 4, 0),
(41015, 4, 1, 0, 1, 5, 0),
(41021, 4, 1, 0, 2, 1, 0),
(41022, 4, 1, 0, 2, 2, 0),
(41024, 4, 1, 0, 2, 4, 0),
(41025, 4, 1, 0, 2, 5, 0),
(41031, 4, 1, 0, 3, 1, 0),
(41032, 4, 1, 0, 3, 2, 0),
(41034, 4, 1, 0, 3, 4, 0),
(41035, 4, 1, 0, 3, 5, 0),
(41041, 4, 1, 0, 4, 1, 0),
(41042, 4, 1, 0, 4, 2, 0),
(41044, 4, 1, 0, 4, 4, 0),
(41045, 4, 1, 0, 4, 5, 0),
(41051, 4, 1, 0, 5, 1, 0),
(41052, 4, 1, 0, 5, 2, 0),
(41054, 4, 1, 0, 5, 4, 0),
(41055, 4, 1, 0, 5, 5, 0),
(41061, 4, 1, 0, 6, 1, 0),
(41062, 4, 1, 0, 6, 2, 0),
(41064, 4, 1, 0, 6, 4, 0),
(41065, 4, 1, 0, 6, 5, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_jadwal_materi`
--

CREATE TABLE `kelas_jadwal_materi` (
  `id_kjm` varchar(50) NOT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_materi` int DEFAULT NULL,
  `id_mapel` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL,
  `jadwal_materi` varchar(20) NOT NULL,
  `jenis` int DEFAULT NULL COMMENT '1=materi, 2=tugas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_materi`
--

CREATE TABLE `kelas_materi` (
  `id_materi` int NOT NULL,
  `id_tp` int NOT NULL DEFAULT '1',
  `id_smt` int NOT NULL DEFAULT '1',
  `kode_materi` text NOT NULL,
  `id_guru` int DEFAULT NULL,
  `materi_kelas` text NOT NULL,
  `id_mapel` int DEFAULT '0',
  `kode_mapel` varchar(300) DEFAULT NULL,
  `judul_materi` text NOT NULL,
  `isi_materi` longtext NOT NULL,
  `file` longtext,
  `link_file` varchar(255) DEFAULT NULL,
  `tgl_mulai` datetime DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` int DEFAULT NULL,
  `youtube` varchar(255) NOT NULL,
  `jenis` int NOT NULL DEFAULT '1' COMMENT '1=materi, 2=tugas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_siswa`
--

CREATE TABLE `kelas_siswa` (
  `id_kelas_siswa` int NOT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `kelas_siswa`
--

INSERT INTO `kelas_siswa` (`id_kelas_siswa`, `id_tp`, `id_smt`, `id_siswa`, `id_kelas`) VALUES
(411, 4, 1, 1, 1),
(412, 4, 1, 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_struktur`
--

CREATE TABLE `kelas_struktur` (
  `id_kelas` int NOT NULL,
  `ketua` int DEFAULT NULL,
  `wakil_ketua` int DEFAULT NULL,
  `sekretaris_1` int DEFAULT NULL,
  `sekretaris_2` int DEFAULT NULL,
  `bendahara_1` int DEFAULT NULL,
  `bendahara_2` int DEFAULT NULL,
  `sie_ekstrakurikuler` int DEFAULT NULL,
  `sie_upacara` int DEFAULT NULL,
  `sie_olahraga` int DEFAULT NULL,
  `sie_keagamaan` int DEFAULT NULL,
  `sie_keamanan` int DEFAULT NULL,
  `sie_ketertiban` int DEFAULT NULL,
  `sie_kebersihan` int DEFAULT NULL,
  `sie_keindahan` int DEFAULT NULL,
  `sie_kesehatan` int DEFAULT NULL,
  `sie_kekeluargaan` int DEFAULT NULL,
  `sie_humas` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `level_guru`
--

CREATE TABLE `level_guru` (
  `id_level` int NOT NULL,
  `level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `level_guru`
--

INSERT INTO `level_guru` (`id_level`, `level`) VALUES
(1, 'Kepala Sekolah'),
(2, 'Wakil Kepala Sekolah'),
(3, 'Bimbingan Konseling'),
(4, 'Walikelas'),
(5, 'Guru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level_kelas`
--

CREATE TABLE `level_kelas` (
  `id_level` int NOT NULL,
  `level` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `level_kelas`
--

INSERT INTO `level_kelas` (`id_level`, `level`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, '7'),
(8, '8'),
(9, '9'),
(10, '10'),
(11, '11'),
(12, '12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` int NOT NULL,
  `log_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int NOT NULL,
  `id_group` int NOT NULL,
  `name_group` text NOT NULL,
  `log_type` int NOT NULL,
  `log_desc` text NOT NULL,
  `address` text NOT NULL,
  `agent` text NOT NULL,
  `device` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `log_time`, `id_user`, `id_group`, `name_group`, `log_type`, `log_desc`, `address`, `agent`, `device`) VALUES
(29, '2024-02-13 16:45:20', 1, 1, 'admin', 0, 'Login', '180.253.65.199', 'Chrome 121.0.0.0', 'Windows 10'),
(30, '2024-02-14 04:35:33', 1, 1, 'admin', 0, 'Login', '182.2.145.113', 'Chrome 121.0.0.0', 'Android'),
(31, '2024-02-14 04:39:47', 5, 1, 'admin', 0, 'Login', '182.2.145.113', 'Chrome 121.0.0.0', 'Android'),
(32, '2024-02-14 09:53:44', 1, 1, 'admin', 0, 'Login', '103.186.90.99', 'Chrome 121.0.0.0', 'Windows 10'),
(33, '2024-02-14 09:54:13', 1, 1, 'admin', 0, 'Login', '114.10.6.149', 'Firefox 123.0', 'Mac OS X');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(10, '114.10.6.149', 'operator', 1707904368),
(11, '114.10.6.149', 'operator', 1707904376),
(12, '114.10.6.149', 'operator', 1707904414);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_materi`
--

CREATE TABLE `log_materi` (
  `id_log` varchar(50) NOT NULL,
  `log_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_siswa` int DEFAULT NULL,
  `jam_ke` int NOT NULL,
  `id_materi` varchar(50) NOT NULL,
  `id_mapel` int DEFAULT NULL,
  `log_type` int NOT NULL,
  `log_desc` text NOT NULL,
  `text` longtext,
  `file` mediumtext,
  `nilai` varchar(3) DEFAULT NULL,
  `catatan` mediumtext,
  `address` text NOT NULL,
  `agent` text NOT NULL,
  `device` text NOT NULL,
  `finish_time` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_ujian`
--

CREATE TABLE `log_ujian` (
  `id_log` int NOT NULL,
  `log_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_siswa` int DEFAULT NULL,
  `id_jadwal` int DEFAULT NULL,
  `log_type` int NOT NULL,
  `log_desc` text NOT NULL,
  `address` text NOT NULL,
  `agent` text NOT NULL,
  `device` text NOT NULL,
  `reset` int NOT NULL COMMENT '0=tidak reset, 1=reset',
  `finish_time` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_ekstra`
--

CREATE TABLE `master_ekstra` (
  `id_ekstra` int NOT NULL,
  `nama_ekstra` varchar(100) NOT NULL,
  `kode_ekstra` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `master_ekstra`
--

INSERT INTO `master_ekstra` (`id_ekstra`, `nama_ekstra`, `kode_ekstra`) VALUES
(1, 'Pramuka', 'PRAM'),
(2, 'Baca Tulis Al Quran', 'BTQ'),
(3, 'Tahfidz', 'TFZ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_guru`
--

CREATE TABLE `master_guru` (
  `id_guru` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `nip` char(30) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `email` varchar(254) DEFAULT NULL,
  `kode_guru` varchar(6) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` mediumtext,
  `no_ktp` varchar(16) DEFAULT NULL,
  `tempat_lahir` varchar(30) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `agama` varchar(10) DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `alamat_jalan` varchar(255) DEFAULT NULL,
  `rt_rw` varchar(8) DEFAULT NULL,
  `dusun` varchar(50) DEFAULT NULL,
  `kelurahan` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(30) DEFAULT NULL,
  `kabupaten` varchar(30) DEFAULT NULL,
  `provinsi` varchar(30) DEFAULT NULL,
  `kode_pos` int DEFAULT NULL,
  `kewarganegaraan` varchar(10) DEFAULT NULL,
  `nuptk` varchar(20) DEFAULT NULL,
  `jenis_ptk` varchar(50) DEFAULT NULL,
  `tgs_tambahan` varchar(50) DEFAULT NULL,
  `status_pegawai` varchar(50) DEFAULT NULL,
  `status_aktif` varchar(20) DEFAULT NULL,
  `status_nikah` varchar(20) DEFAULT NULL,
  `tmt` date DEFAULT NULL,
  `keahlian_isyarat` varchar(10) DEFAULT NULL,
  `npwp` varchar(16) DEFAULT NULL,
  `foto` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `master_guru`
--

INSERT INTO `master_guru` (`id_guru`, `id_user`, `nip`, `nama_guru`, `email`, `kode_guru`, `username`, `password`, `no_ktp`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `agama`, `no_hp`, `alamat_jalan`, `rt_rw`, `dusun`, `kelurahan`, `kecamatan`, `kabupaten`, `provinsi`, `kode_pos`, `kewarganegaraan`, `nuptk`, `jenis_ptk`, `tgs_tambahan`, `status_pegawai`, `status_aktif`, `status_nikah`, `tmt`, `keahlian_isyarat`, `npwp`, `foto`) VALUES
(1, 0, '12345678', 'Leonardo Julyawan', 'leoyai2014@outlook.com', NULL, 'leonardo', 'jatayu', '3276022607760006', 'Jakarta', '1976-07-26', 'L', 'Islam', '087873354877', 'Jalan Jambu 6 Blok S7 No.8', NULL, NULL, NULL, 'Tapos', 'Depok', 'Jawa Barat', 16454, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/profiles/12345678.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_hari_efektif`
--

CREATE TABLE `master_hari_efektif` (
  `id_hari_efektif` int NOT NULL,
  `jml_hari_efektif` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_jurusan`
--

CREATE TABLE `master_jurusan` (
  `id_jurusan` int NOT NULL,
  `nama_jurusan` varchar(30) NOT NULL,
  `kode_jurusan` varchar(10) DEFAULT NULL,
  `mapel_peminatan` longtext,
  `status` int NOT NULL DEFAULT '1',
  `deletable` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `master_jurusan`
--

INSERT INTO `master_jurusan` (`id_jurusan`, `nama_jurusan`, `kode_jurusan`, `mapel_peminatan`, `status`, `deletable`) VALUES
(0, 'Perawat', '01', '8,', 1, 0),
(1, 'Kesehatan', 'AKS', '9,', 1, 0),
(2, 'Kimia', 'AKM', '9,', 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_kelas`
--

CREATE TABLE `master_kelas` (
  `id_kelas` int NOT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `nama_kelas` varchar(30) NOT NULL,
  `kode_kelas` varchar(20) DEFAULT NULL,
  `jurusan_id` int NOT NULL,
  `level_id` int NOT NULL,
  `guru_id` int DEFAULT NULL,
  `siswa_id` int DEFAULT NULL,
  `jumlah_siswa` longtext,
  `set_siswa` varchar(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `master_kelas`
--

INSERT INTO `master_kelas` (`id_kelas`, `id_tp`, `id_smt`, `nama_kelas`, `kode_kelas`, `jurusan_id`, `level_id`, `guru_id`, `siswa_id`, `jumlah_siswa`, `set_siswa`) VALUES
(1, 4, 1, 'INFORMATIKA AKS 33', 'INF-AKS-33', 1, 10, 0, 1, 'a:1:{i:0;a:1:{s:2:\"id\";s:1:\"1\";}}', '0'),
(2, 4, 1, 'INFORMATIKA AKM 29', 'INF-AKM-29', 2, 10, 0, 2, 'a:1:{i:0;a:1:{s:2:\"id\";s:1:\"2\";}}', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_kelompok_mapel`
--

CREATE TABLE `master_kelompok_mapel` (
  `id_kel_mapel` int NOT NULL,
  `kode_kel_mapel` varchar(10) DEFAULT NULL,
  `nama_kel_mapel` varchar(100) DEFAULT NULL,
  `kategori` varchar(20) DEFAULT NULL,
  `id_parent` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `master_kelompok_mapel`
--

INSERT INTO `master_kelompok_mapel` (`id_kel_mapel`, `kode_kel_mapel`, `nama_kel_mapel`, `kategori`, `id_parent`) VALUES
(1, 'A', 'Kelompok A (Wajib)', 'WAJIB', 0),
(2, 'B', 'Kelompok B', 'WAJIB', 0),
(3, 'C', 'Kelompok C', 'PEMINATAN', 0),
(4, 'MULOK', 'Muatan Lokal', 'MULOK', 0),
(5, 'C1', 'Kelompok C1', 'PEMINATAN', 3),
(6, 'PAI', 'PAI', 'PAI (Kemenag)', 0),
(7, 'C1', 'Informatika', 'PEMINATAN', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_mapel`
--

CREATE TABLE `master_mapel` (
  `id_mapel` int NOT NULL,
  `nama_mapel` varchar(50) NOT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `kelompok` varchar(5) NOT NULL DEFAULT '-',
  `bobot_p` int NOT NULL DEFAULT '0',
  `bobot_k` int NOT NULL DEFAULT '0',
  `jenjang` int NOT NULL DEFAULT '0',
  `urutan` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `deletable` int NOT NULL DEFAULT '1',
  `urutan_tampil` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `master_mapel`
--

INSERT INTO `master_mapel` (`id_mapel`, `nama_mapel`, `kode`, `kelompok`, `bobot_p`, `bobot_k`, `jenjang`, `urutan`, `status`, `deletable`, `urutan_tampil`) VALUES
(1, 'Al Quran-Hadis', 'QH', 'PAI', 0, 0, 1, 1, 1, 0, 1),
(2, 'Fiqih', 'FQH', 'PAI', 0, 0, 1, 1, 1, 0, 3),
(3, 'Akidah Akhlak', 'AA', 'PAI', 0, 0, 1, 1, 1, 0, 2),
(4, 'Sejarah Kebudayaan Islam', 'SKI', 'PAI', 0, 0, 1, 1, 1, 0, 4),
(5, 'Bahasa Arab', 'BAR', 'A', 0, 0, 1, 2, 1, 0, 3),
(6, 'Bahasa Indonesia', 'BIND', 'A', 0, 0, 1, 2, 1, 0, 2),
(7, 'Bahasa Inggris', 'BING', 'A', 0, 0, 1, 2, 1, 0, 7),
(8, 'Matematika', 'MTK', 'A', 0, 0, 1, 2, 1, 0, 4),
(9, 'Ilmu Pengetahuan Alam', 'IPA', 'A', 0, 0, 1, 2, 1, 0, 5),
(10, 'Ilmu Pengetahuan Sosial', 'IPS', 'A', 0, 0, 1, 2, 1, 0, 6),
(11, 'Pendidikan Pancasila dan Kewarganegaraan', 'PPKn', 'A', 0, 0, 1, 2, 1, 0, 1),
(12, 'Pendidikan Jasmani Olah Raga dan Kesehatan', 'PJOK', 'B', 0, 0, 1, 3, 1, 0, 2),
(13, 'Seni Budaya', 'SB', 'B', 0, 0, 2, 3, 1, 0, 1),
(14, 'Prakarya', 'PRA', 'B', 0, 0, 2, 3, 1, 0, 3),
(15, 'SBdP', 'SBDP', 'B', 0, 0, 0, 3, 0, 0, 1),
(16, 'Akhlak', 'AK', 'C', 0, 0, 3, 0, 0, 0, 19),
(17, 'Antropologi', 'ANT', 'C1', 0, 0, 3, 0, 1, 0, 4),
(18, 'Bahasa Arab (Peminatan)', 'BAR-P', 'C', 0, 0, 3, 0, 1, 0, 3),
(19, 'Bahasa dan Sastra Asing Lainnya', 'BSAL', 'C', 0, 0, 3, 0, 1, 0, 16),
(20, 'Bahasa dan Sastra Indonesia', 'BSIN', 'C', 0, 0, 3, 0, 1, 0, 15),
(21, 'Bahasa dan Sastra Inggris', 'BSING', 'C', 0, 0, 3, 0, 1, 0, 14),
(22, 'Bahasa Jepang', 'JPN', 'C', 0, 0, 3, 0, 1, 0, 18),
(23, 'Bahasa Jerman', 'JRM', 'C', 0, 0, 3, 0, 1, 0, 12),
(24, 'Biologi', 'BIO', 'C', 0, 0, 3, 0, 1, 0, 2),
(25, 'Ekonomi', 'EKN', 'C', 0, 0, 3, 0, 1, 0, 11),
(26, 'Fikih (Peminatan)', 'FQH-P', 'C', 0, 0, 3, 0, 1, 0, 4),
(27, 'Fikih - Ushul Fikih', 'UFQH', 'C', 0, 0, 3, 0, 1, 0, 5),
(28, 'Fisika', 'FIS', 'C1', 0, 0, 3, 0, 1, 0, 3),
(29, 'Geografi', 'GEO', 'C', 0, 0, 3, 0, 1, 0, 10),
(30, 'Hadis - Ilmu Hadis', 'HA', 'C', 0, 0, 3, 0, 1, 0, 6),
(31, 'Ilmu Kalam', 'IK', 'C', 0, 0, 3, 0, 1, 0, 7),
(32, 'Informatika', 'INF', 'C', 0, 0, 3, 0, 1, 0, 13),
(33, 'Keterampilan', 'KTR', 'C', 0, 0, 3, 0, 0, 0, 17),
(34, 'Kimia', 'KIM', 'C1', 0, 0, 3, 0, 1, 0, 2),
(35, 'Prakarya dan Kewirausahaan', 'PK', 'B', 0, 0, 3, 0, 0, 0, 3),
(36, 'Sejarah', 'SEJ', 'C', 0, 0, 3, 0, 1, 0, 8),
(37, 'Sejarah Indonesia', 'SJI', 'A', 0, 0, 3, 0, 1, 0, 5),
(38, 'Sosiologi', 'SOS', 'C', 0, 0, 3, 0, 1, 0, 9),
(39, 'Tafsir - Ilmu Tafsir', 'TT', 'C1', 0, 0, 3, 0, 1, 0, 1),
(40, 'Bahasa Sunda', 'BSUND', 'MULOK', 0, 0, 1, 0, 1, 1, 1),
(41, 'Pendidikan Agama dan Budi Pekerti', 'PABP', 'A', 0, 0, 1, 1, 1, 0, 1),
(42, 'Matematika (Peminatan)', 'MTK-P', 'C', 0, 0, 3, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_siswa`
--

CREATE TABLE `master_siswa` (
  `id_siswa` int NOT NULL,
  `nisn` int(10) UNSIGNED ZEROFILL NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(1) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `kelas_awal` int NOT NULL,
  `tahun_masuk` varchar(30) DEFAULT NULL,
  `sekolah_asal` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` varchar(30) DEFAULT NULL,
  `agama` varchar(10) DEFAULT NULL,
  `hp` varchar(15) DEFAULT NULL,
  `email` varchar(254) DEFAULT NULL,
  `foto` varchar(255) DEFAULT 'siswa.png',
  `anak_ke` int DEFAULT NULL,
  `status_keluarga` varchar(1) DEFAULT NULL,
  `alamat` mediumtext,
  `rt` varchar(5) DEFAULT NULL,
  `rw` varchar(5) DEFAULT NULL,
  `kelurahan` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kabupaten` varchar(100) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `kode_pos` int DEFAULT NULL,
  `nama_ayah` varchar(150) DEFAULT NULL,
  `tgl_lahir_ayah` varchar(50) DEFAULT NULL,
  `pendidikan_ayah` varchar(50) DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `nohp_ayah` varchar(20) DEFAULT NULL,
  `alamat_ayah` longtext,
  `nama_ibu` varchar(50) DEFAULT NULL,
  `tgl_lahir_ibu` varchar(50) DEFAULT NULL,
  `pendidikan_ibu` varchar(50) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `nohp_ibu` varchar(20) DEFAULT NULL,
  `alamat_ibu` longtext,
  `nama_wali` varchar(150) DEFAULT NULL,
  `tgl_lahir_wali` varchar(50) DEFAULT NULL,
  `pendidikan_wali` varchar(50) DEFAULT NULL,
  `pekerjaan_wali` varchar(100) DEFAULT NULL,
  `nohp_wali` varchar(20) DEFAULT NULL,
  `alamat_wali` longtext,
  `nik` varchar(30) NOT NULL,
  `warga_negara` varchar(20) NOT NULL,
  `uid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `master_siswa`
--

INSERT INTO `master_siswa` (`id_siswa`, `nisn`, `nis`, `nama`, `jenis_kelamin`, `username`, `password`, `kelas_awal`, `tahun_masuk`, `sekolah_asal`, `tempat_lahir`, `tanggal_lahir`, `agama`, `hp`, `email`, `foto`, `anak_ke`, `status_keluarga`, `alamat`, `rt`, `rw`, `kelurahan`, `kecamatan`, `kabupaten`, `provinsi`, `kode_pos`, `nama_ayah`, `tgl_lahir_ayah`, `pendidikan_ayah`, `pekerjaan_ayah`, `nohp_ayah`, `alamat_ayah`, `nama_ibu`, `tgl_lahir_ibu`, `pendidikan_ibu`, `pekerjaan_ibu`, `nohp_ibu`, `alamat_ibu`, `nama_wali`, `tgl_lahir_wali`, `pendidikan_wali`, `pekerjaan_wali`, `nohp_wali`, `alamat_wali`, `nik`, `warga_negara`, `uid`) VALUES
(1, 0000123456, '1234578', 'Agus', 'L', '123456', '123456', 10, '2024-02-27', NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/foto_siswa/1234578jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '12dc0e3d-c2b5-11ee-baa6-ecf4bbdec16c'),
(2, 0000230001, '230001', 'siswa_ankim1', 'L', '230001', '230001', 10, '2023-07-01', '', '', '', 'Islam', '', NULL, 'uploads/foto_siswa/230001jpg', 0, '1', '', '', '', '', '', '', NULL, 0, '', NULL, NULL, '', '', '', '', NULL, NULL, '', '', '', '', NULL, NULL, '', '', '', '', '', 'f9d8b119-c9cb-11ee-baa6-ecf4bbdec16c');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_smt`
--

CREATE TABLE `master_smt` (
  `id_smt` int NOT NULL,
  `smt` varchar(10) NOT NULL,
  `nama_smt` varchar(10) NOT NULL,
  `active` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `master_smt`
--

INSERT INTO `master_smt` (`id_smt`, `smt`, `nama_smt`, `active`) VALUES
(1, 'Ganjil', 'I (satu)', 0),
(2, 'Genap', 'II (dua)', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_tp`
--

CREATE TABLE `master_tp` (
  `id_tp` int NOT NULL,
  `tahun` varchar(20) NOT NULL,
  `active` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `master_tp`
--

INSERT INTO `master_tp` (`id_tp`, `tahun`, `active`) VALUES
(1, '2020/2021', 0),
(2, '2021/2022', 0),
(3, '2022/2023', 0),
(4, '2023/2024', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `post`
--

CREATE TABLE `post` (
  `id_post` int NOT NULL,
  `dari` int DEFAULT NULL,
  `dari_group` int DEFAULT NULL,
  `kepada` varchar(50) NOT NULL COMMENT 'group',
  `text` longtext NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `post_comments`
--

CREATE TABLE `post_comments` (
  `id_comment` int NOT NULL,
  `id_post` int DEFAULT NULL,
  `dari` int DEFAULT NULL,
  `dari_group` int DEFAULT NULL,
  `text` longtext NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(1) NOT NULL DEFAULT '1' COMMENT '1:pengumuman, 2:materi, 3:tugas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `post_reply`
--

CREATE TABLE `post_reply` (
  `id_reply` int NOT NULL,
  `id_comment` int DEFAULT NULL,
  `dari` int DEFAULT NULL,
  `dari_group` int DEFAULT NULL,
  `text` longtext NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rapor_admin_setting`
--

CREATE TABLE `rapor_admin_setting` (
  `id_setting` int NOT NULL,
  `id_tp` int NOT NULL DEFAULT '0',
  `id_smt` int NOT NULL DEFAULT '0',
  `kkm_tunggal` int NOT NULL DEFAULT '0',
  `kkm` int DEFAULT NULL,
  `bobot_ph` int DEFAULT NULL,
  `bobot_pts` int DEFAULT NULL,
  `bobot_pas` int DEFAULT NULL,
  `bobot_absen` int DEFAULT NULL,
  `tgl_rapor_akhir` varchar(100) DEFAULT NULL,
  `tgl_rapor_kelas_akhir` varchar(100) DEFAULT NULL,
  `tgl_rapor_pts` varchar(100) DEFAULT NULL,
  `nip_kepsek` int DEFAULT '0',
  `nip_walikelas` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rapor_catatan_wali`
--

CREATE TABLE `rapor_catatan_wali` (
  `id_catatan_wali` int NOT NULL,
  `id_tp` int NOT NULL DEFAULT '0',
  `id_smt` int NOT NULL DEFAULT '0',
  `id_kelas` int DEFAULT NULL,
  `id_siswa` int DEFAULT NULL,
  `nilai` longtext,
  `deskripsi` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rapor_data_catatan`
--

CREATE TABLE `rapor_data_catatan` (
  `id_catatan` int NOT NULL,
  `id_tp` int NOT NULL DEFAULT '0',
  `id_smt` int NOT NULL DEFAULT '0',
  `id_kelas` int DEFAULT NULL,
  `jenis` int NOT NULL COMMENT '1=desk absensi, 2=desk catatan, 3=desk ranking',
  `kode` int NOT NULL,
  `deskripsi` varchar(150) NOT NULL,
  `rank` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rapor_data_fisik`
--

CREATE TABLE `rapor_data_fisik` (
  `id_fisik` int NOT NULL,
  `id_tp` int NOT NULL DEFAULT '0',
  `id_smt` int NOT NULL DEFAULT '0',
  `id_kelas` int DEFAULT NULL,
  `jenis` int NOT NULL COMMENT '1=pendengaran, 2=penglihatan, 3=gigi, 4=lain-lain',
  `kode` int NOT NULL,
  `deskripsi` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rapor_data_sikap`
--

CREATE TABLE `rapor_data_sikap` (
  `id_sikap` int NOT NULL,
  `id_tp` int NOT NULL DEFAULT '0',
  `id_smt` int NOT NULL DEFAULT '0',
  `id_kelas` int DEFAULT NULL,
  `jenis` int NOT NULL COMMENT '1=spiritual, 2=sosial',
  `kode` int NOT NULL,
  `sikap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rapor_fisik`
--

CREATE TABLE `rapor_fisik` (
  `id_fisik` int NOT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `kondisi` longtext NOT NULL,
  `tinggi` int NOT NULL,
  `berat` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rapor_kikd`
--

CREATE TABLE `rapor_kikd` (
  `id_kikd` int NOT NULL,
  `id_mapel_kelas` int DEFAULT NULL,
  `aspek` int NOT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `materi_kikd` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rapor_kkm`
--

CREATE TABLE `rapor_kkm` (
  `id_kkm` int NOT NULL,
  `kkm` int DEFAULT '0',
  `bobot_ph` int DEFAULT '0',
  `bobot_pts` int DEFAULT '0',
  `bobot_pas` int DEFAULT '0',
  `bobot_absen` int DEFAULT '0',
  `beban_jam` int DEFAULT '0',
  `id_tp` int NOT NULL DEFAULT '0',
  `id_smt` int NOT NULL DEFAULT '0',
  `jenis` int NOT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_mapel` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rapor_naik`
--

CREATE TABLE `rapor_naik` (
  `id_naik` int NOT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_siswa` int NOT NULL,
  `naik` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rapor_nilai_akhir`
--

CREATE TABLE `rapor_nilai_akhir` (
  `id_nilai_akhir` int NOT NULL,
  `id_mapel` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `nilai` int DEFAULT '0',
  `akhir` int DEFAULT NULL,
  `predikat` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rapor_nilai_ekstra`
--

CREATE TABLE `rapor_nilai_ekstra` (
  `id_nilai_ekstra` int NOT NULL,
  `id_ekstra` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `nilai` int NOT NULL,
  `predikat` varchar(1) DEFAULT NULL,
  `deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rapor_nilai_harian`
--

CREATE TABLE `rapor_nilai_harian` (
  `id_nilai_harian` int NOT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_mapel` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `p1` varchar(3) DEFAULT NULL,
  `p2` varchar(3) DEFAULT NULL,
  `p3` varchar(3) DEFAULT NULL,
  `p4` varchar(3) DEFAULT NULL,
  `p5` varchar(3) DEFAULT NULL,
  `p6` varchar(3) DEFAULT NULL,
  `p7` varchar(3) DEFAULT NULL,
  `p8` varchar(3) DEFAULT NULL,
  `p_rata_rata` varchar(4) DEFAULT NULL,
  `p_predikat` varchar(1) DEFAULT NULL,
  `p_deskripsi` longtext,
  `k1` varchar(3) DEFAULT NULL,
  `k2` varchar(3) DEFAULT NULL,
  `k3` varchar(3) DEFAULT NULL,
  `k4` varchar(3) DEFAULT NULL,
  `k5` varchar(3) DEFAULT NULL,
  `k6` varchar(3) DEFAULT NULL,
  `k7` varchar(3) DEFAULT NULL,
  `k8` varchar(3) DEFAULT NULL,
  `k_rata_rata` varchar(4) DEFAULT NULL,
  `k_predikat` varchar(1) DEFAULT NULL,
  `k_deskripsi` longtext,
  `jml` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rapor_nilai_pts`
--

CREATE TABLE `rapor_nilai_pts` (
  `id_nilai_pts` int NOT NULL,
  `id_mapel` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `nilai` int DEFAULT '0',
  `predikat` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rapor_nilai_sikap`
--

CREATE TABLE `rapor_nilai_sikap` (
  `id_nilai_sikap` int NOT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_tp` int NOT NULL DEFAULT '0',
  `id_smt` int NOT NULL DEFAULT '0',
  `jenis` int DEFAULT NULL,
  `nilai` longtext NOT NULL,
  `deskripsi` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rapor_prestasi`
--

CREATE TABLE `rapor_prestasi` (
  `id_ranking` int NOT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `ranking` int NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `p1` varchar(100) NOT NULL,
  `p1_desk` varchar(100) NOT NULL,
  `p2` varchar(100) NOT NULL,
  `p2_desk` varchar(100) NOT NULL,
  `p3` varchar(100) NOT NULL,
  `p3_desk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `running_text`
--

CREATE TABLE `running_text` (
  `id_text` int NOT NULL,
  `text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id_setting` int NOT NULL,
  `kode_sekolah` varchar(10) DEFAULT NULL,
  `sekolah` varchar(50) DEFAULT NULL,
  `npsn` varchar(10) DEFAULT NULL,
  `nss` varchar(20) DEFAULT NULL,
  `jenjang` int DEFAULT NULL,
  `kepsek` varchar(50) DEFAULT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `tanda_tangan` mediumtext,
  `alamat` mediumtext,
  `desa` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kota` varchar(30) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `kode_pos` int DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `web` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nama_aplikasi` varchar(100) DEFAULT NULL,
  `logo_kanan` mediumtext,
  `logo_kiri` mediumtext,
  `versi` varchar(10) DEFAULT NULL,
  `ip_server` varchar(100) DEFAULT NULL,
  `waktu` varchar(50) DEFAULT NULL,
  `server` varchar(50) DEFAULT NULL,
  `id_server` varchar(50) DEFAULT NULL,
  `sekolah_id` varchar(50) DEFAULT NULL,
  `db_versi` varchar(10) DEFAULT NULL,
  `satuan_pendidikan` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`id_setting`, `kode_sekolah`, `sekolah`, `npsn`, `nss`, `jenjang`, `kepsek`, `nip`, `tanda_tangan`, `alamat`, `desa`, `kecamatan`, `kota`, `provinsi`, `kode_pos`, `telp`, `fax`, `web`, `email`, `nama_aplikasi`, `logo_kanan`, `logo_kiri`, `versi`, `ip_server`, `waktu`, `server`, `id_server`, `sekolah_id`, `db_versi`, `satuan_pendidikan`) VALUES
(1, NULL, 'SMK JAKARTA', '', '', 3, 'ELMSS', '', '', 'Pasar Rebo Jaktim', 'Kalisari', '  ', '    ', 'DKI JAYA', 13790, '', '', '', '', 'ELMSS.ID', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) DEFAULT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int UNSIGNED NOT NULL,
  `last_login` int UNSIGNED DEFAULT NULL,
  `active` tinyint UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '180.244.160.65', 'admin', '$2y$12$ouYG1eXHzpY5CdGvG2IogOnlF/SKAGgVw7GQAoZ0tHnblBtg2hH0.', 'agung@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1706977929, 1707904453, 1, 'agung', 'agung', NULL, NULL),
(2, '180.244.160.65', '123456', '$2y$10$O0xr/6mI7cwlVvkbg3sLmez7GaRe8qJy0R/KocEkVTjqiNP4zCLUm', '1234578@siswa.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1706979556, 1707022100, 1, 'Agus', 'Agus', NULL, NULL),
(3, '180.244.160.65', '98765', '$2y$10$E5MfKViaIIQG2OcdwMYy/uizH0GSPBD/QvsHEuZZTh.W5C2eLzuU.', '98765@guru.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1706979723, 1707022141, 1, 'El', 'El', NULL, NULL),
(4, '103.119.51.146', 'leonardo', '$2y$12$duUSFTNvIt7rtxH4AMgtSe2A4qzXMqgcv3PkYQxXZNLN9Vnxz9s6i', 'leoyai2014@outlook.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1707020732, 1707022253, 1, 'Leonardo', 'Julyawan', NULL, NULL),
(5, '182.2.145.113', 'BoTed', '$2y$12$M5JJxCYCK81TLO9Py6AMiO0zECOuO4LGmkig/.QpHAdJFSSfxjSXK', 'b2playfun@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1707885539, 1707885587, 1, 'Bobby', 'Tedyana', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `group_id` mediumint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 3),
(3, 3, 2),
(4, 4, 1),
(5, 5, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_profile`
--

CREATE TABLE `users_profile` (
  `id_user` int NOT NULL,
  `nama_lengkap` text NOT NULL,
  `jabatan` text,
  `level_access` int NOT NULL DEFAULT '0',
  `foto` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `users_profile`
--

INSERT INTO `users_profile` (`id_user`, `nama_lengkap`, `jabatan`, `level_access`, `foto`) VALUES
(5, 'BoTed', 'Pengawas ', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `api_setting`
--
ALTER TABLE `api_setting`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `api_token`
--
ALTER TABLE `api_token`
  ADD PRIMARY KEY (`id_api`) USING BTREE;

--
-- Indeks untuk tabel `buku_induk`
--
ALTER TABLE `buku_induk`
  ADD PRIMARY KEY (`id_siswa`) USING BTREE;

--
-- Indeks untuk tabel `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id_bln`) USING BTREE;

--
-- Indeks untuk tabel `cbt_bank_soal`
--
ALTER TABLE `cbt_bank_soal`
  ADD PRIMARY KEY (`id_bank`) USING BTREE,
  ADD UNIQUE KEY `id_bank_soal` (`id_bank`) USING BTREE,
  ADD UNIQUE KEY `kode_bank_soal` (`bank_kode`) USING BTREE;

--
-- Indeks untuk tabel `cbt_durasi_siswa`
--
ALTER TABLE `cbt_durasi_siswa`
  ADD PRIMARY KEY (`id_durasi`) USING BTREE,
  ADD KEY `Cbt_index_id_durasi` (`id_durasi`) USING BTREE COMMENT 'id durasi',
  ADD KEY `id_siswa` (`id_siswa`) USING BTREE;

--
-- Indeks untuk tabel `cbt_jadwal`
--
ALTER TABLE `cbt_jadwal`
  ADD PRIMARY KEY (`id_jadwal`) USING BTREE,
  ADD UNIQUE KEY `idjawal_relation` (`id_jadwal`) USING BTREE,
  ADD UNIQUE KEY `id_bank_soal` (`id_bank`) USING BTREE,
  ADD KEY `idx_jns_fc` (`id_jenis`) USING BTREE;

--
-- Indeks untuk tabel `cbt_jenis`
--
ALTER TABLE `cbt_jenis`
  ADD PRIMARY KEY (`id_jenis`) USING BTREE,
  ADD UNIQUE KEY `idx_jns` (`id_jenis`) USING BTREE;

--
-- Indeks untuk tabel `cbt_kelas_ruang`
--
ALTER TABLE `cbt_kelas_ruang`
  ADD PRIMARY KEY (`id_kelas_ruang`) USING BTREE;

--
-- Indeks untuk tabel `cbt_kop_absensi`
--
ALTER TABLE `cbt_kop_absensi`
  ADD PRIMARY KEY (`id_kop`) USING BTREE;

--
-- Indeks untuk tabel `cbt_kop_berita`
--
ALTER TABLE `cbt_kop_berita`
  ADD PRIMARY KEY (`id_kop`) USING BTREE;

--
-- Indeks untuk tabel `cbt_kop_kartu`
--
ALTER TABLE `cbt_kop_kartu`
  ADD PRIMARY KEY (`id_set_kartu`) USING BTREE;

--
-- Indeks untuk tabel `cbt_nilai`
--
ALTER TABLE `cbt_nilai`
  ADD PRIMARY KEY (`id_nilai`) USING BTREE,
  ADD UNIQUE KEY `id_nilai_idx` (`id_nilai`) USING BTREE;

--
-- Indeks untuk tabel `cbt_nomor_peserta`
--
ALTER TABLE `cbt_nomor_peserta`
  ADD PRIMARY KEY (`id_nomor`) USING BTREE;

--
-- Indeks untuk tabel `cbt_pengawas`
--
ALTER TABLE `cbt_pengawas`
  ADD PRIMARY KEY (`id_pengawas`) USING BTREE;

--
-- Indeks untuk tabel `cbt_rekap`
--
ALTER TABLE `cbt_rekap`
  ADD PRIMARY KEY (`id_rekap`) USING BTREE;

--
-- Indeks untuk tabel `cbt_rekap_nilai`
--
ALTER TABLE `cbt_rekap_nilai`
  ADD PRIMARY KEY (`id_rekap_nilai`) USING BTREE;

--
-- Indeks untuk tabel `cbt_ruang`
--
ALTER TABLE `cbt_ruang`
  ADD PRIMARY KEY (`id_ruang`) USING BTREE;

--
-- Indeks untuk tabel `cbt_sesi`
--
ALTER TABLE `cbt_sesi`
  ADD PRIMARY KEY (`id_sesi`) USING BTREE;

--
-- Indeks untuk tabel `cbt_sesi_siswa`
--
ALTER TABLE `cbt_sesi_siswa`
  ADD PRIMARY KEY (`siswa_id`) USING BTREE;

--
-- Indeks untuk tabel `cbt_soal`
--
ALTER TABLE `cbt_soal`
  ADD PRIMARY KEY (`id_soal`) USING BTREE,
  ADD UNIQUE KEY `id_soal_idx` (`id_soal`) USING BTREE,
  ADD KEY `id_bank_idx` (`bank_id`) USING BTREE;

--
-- Indeks untuk tabel `cbt_soal_siswa`
--
ALTER TABLE `cbt_soal_siswa`
  ADD PRIMARY KEY (`id_soal_siswa`) USING BTREE,
  ADD UNIQUE KEY `is_soal_siswa` (`id_soal_siswa`) USING BTREE,
  ADD KEY `id_siswa` (`id_siswa`) USING BTREE,
  ADD KEY `id_jadwal` (`id_jadwal`) USING BTREE,
  ADD KEY `id_soal_fc` (`id_soal`) USING BTREE,
  ADD KEY `id_bank_fc` (`id_bank`) USING BTREE;

--
-- Indeks untuk tabel `cbt_token`
--
ALTER TABLE `cbt_token`
  ADD PRIMARY KEY (`id_token`) USING BTREE;

--
-- Indeks untuk tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id_hri`) USING BTREE;

--
-- Indeks untuk tabel `jabatan_guru`
--
ALTER TABLE `jabatan_guru`
  ADD PRIMARY KEY (`id_jabatan_guru`) USING BTREE;

--
-- Indeks untuk tabel `kelas_catatan_mapel`
--
ALTER TABLE `kelas_catatan_mapel`
  ADD PRIMARY KEY (`id_catatan`) USING BTREE;

--
-- Indeks untuk tabel `kelas_catatan_wali`
--
ALTER TABLE `kelas_catatan_wali`
  ADD PRIMARY KEY (`id_catatan`) USING BTREE;

--
-- Indeks untuk tabel `kelas_ekstra`
--
ALTER TABLE `kelas_ekstra`
  ADD PRIMARY KEY (`id_kelas_ekstra`) USING BTREE;

--
-- Indeks untuk tabel `kelas_jadwal_kbm`
--
ALTER TABLE `kelas_jadwal_kbm`
  ADD PRIMARY KEY (`id_kbm`) USING BTREE;

--
-- Indeks untuk tabel `kelas_jadwal_mapel`
--
ALTER TABLE `kelas_jadwal_mapel`
  ADD PRIMARY KEY (`id_jadwal`) USING BTREE;

--
-- Indeks untuk tabel `kelas_jadwal_materi`
--
ALTER TABLE `kelas_jadwal_materi`
  ADD PRIMARY KEY (`id_kjm`) USING BTREE;

--
-- Indeks untuk tabel `kelas_materi`
--
ALTER TABLE `kelas_materi`
  ADD PRIMARY KEY (`id_materi`) USING BTREE;

--
-- Indeks untuk tabel `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD PRIMARY KEY (`id_kelas_siswa`) USING BTREE,
  ADD UNIQUE KEY `id_kelas_siswa_idx` (`id_kelas_siswa`) USING BTREE,
  ADD KEY `id_siswa_idx` (`id_siswa`) USING BTREE,
  ADD KEY `Id_kelas` (`id_kelas`) USING BTREE;

--
-- Indeks untuk tabel `kelas_struktur`
--
ALTER TABLE `kelas_struktur`
  ADD PRIMARY KEY (`id_kelas`) USING BTREE;

--
-- Indeks untuk tabel `level_guru`
--
ALTER TABLE `level_guru`
  ADD PRIMARY KEY (`id_level`) USING BTREE;

--
-- Indeks untuk tabel `level_kelas`
--
ALTER TABLE `level_kelas`
  ADD PRIMARY KEY (`id_level`) USING BTREE,
  ADD KEY `index_id_level` (`id_level`) USING BTREE;

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`) USING BTREE;

--
-- Indeks untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `log_materi`
--
ALTER TABLE `log_materi`
  ADD PRIMARY KEY (`id_log`) USING BTREE;

--
-- Indeks untuk tabel `log_ujian`
--
ALTER TABLE `log_ujian`
  ADD PRIMARY KEY (`id_log`) USING BTREE;

--
-- Indeks untuk tabel `master_ekstra`
--
ALTER TABLE `master_ekstra`
  ADD PRIMARY KEY (`id_ekstra`) USING BTREE;

--
-- Indeks untuk tabel `master_guru`
--
ALTER TABLE `master_guru`
  ADD PRIMARY KEY (`id_guru`) USING BTREE;

--
-- Indeks untuk tabel `master_hari_efektif`
--
ALTER TABLE `master_hari_efektif`
  ADD PRIMARY KEY (`id_hari_efektif`) USING BTREE;

--
-- Indeks untuk tabel `master_jurusan`
--
ALTER TABLE `master_jurusan`
  ADD PRIMARY KEY (`id_jurusan`) USING BTREE;

--
-- Indeks untuk tabel `master_kelas`
--
ALTER TABLE `master_kelas`
  ADD PRIMARY KEY (`id_kelas`) USING BTREE,
  ADD UNIQUE KEY `id_kelas_idx` (`id_kelas`) USING BTREE,
  ADD KEY `index_level_Id` (`level_id`) USING BTREE;

--
-- Indeks untuk tabel `master_kelompok_mapel`
--
ALTER TABLE `master_kelompok_mapel`
  ADD PRIMARY KEY (`id_kel_mapel`) USING BTREE;

--
-- Indeks untuk tabel `master_mapel`
--
ALTER TABLE `master_mapel`
  ADD PRIMARY KEY (`id_mapel`) USING BTREE;

--
-- Indeks untuk tabel `master_siswa`
--
ALTER TABLE `master_siswa`
  ADD PRIMARY KEY (`id_siswa`,`uid`,`nisn`,`nis`) USING BTREE,
  ADD UNIQUE KEY `Id_siswa_idx` (`id_siswa`) USING BTREE,
  ADD UNIQUE KEY `uid_idx` (`uid`) USING BTREE,
  ADD UNIQUE KEY `nisn` (`nisn`) USING BTREE;

--
-- Indeks untuk tabel `master_smt`
--
ALTER TABLE `master_smt`
  ADD PRIMARY KEY (`id_smt`) USING BTREE;

--
-- Indeks untuk tabel `master_tp`
--
ALTER TABLE `master_tp`
  ADD PRIMARY KEY (`id_tp`) USING BTREE;

--
-- Indeks untuk tabel `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`) USING BTREE;

--
-- Indeks untuk tabel `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id_comment`) USING BTREE;

--
-- Indeks untuk tabel `post_reply`
--
ALTER TABLE `post_reply`
  ADD PRIMARY KEY (`id_reply`) USING BTREE;

--
-- Indeks untuk tabel `rapor_admin_setting`
--
ALTER TABLE `rapor_admin_setting`
  ADD PRIMARY KEY (`id_setting`) USING BTREE;

--
-- Indeks untuk tabel `rapor_catatan_wali`
--
ALTER TABLE `rapor_catatan_wali`
  ADD PRIMARY KEY (`id_catatan_wali`) USING BTREE;

--
-- Indeks untuk tabel `rapor_data_catatan`
--
ALTER TABLE `rapor_data_catatan`
  ADD PRIMARY KEY (`id_catatan`) USING BTREE;

--
-- Indeks untuk tabel `rapor_data_fisik`
--
ALTER TABLE `rapor_data_fisik`
  ADD PRIMARY KEY (`id_fisik`) USING BTREE;

--
-- Indeks untuk tabel `rapor_data_sikap`
--
ALTER TABLE `rapor_data_sikap`
  ADD PRIMARY KEY (`id_sikap`) USING BTREE;

--
-- Indeks untuk tabel `rapor_fisik`
--
ALTER TABLE `rapor_fisik`
  ADD PRIMARY KEY (`id_fisik`) USING BTREE;

--
-- Indeks untuk tabel `rapor_kikd`
--
ALTER TABLE `rapor_kikd`
  ADD PRIMARY KEY (`id_kikd`) USING BTREE;

--
-- Indeks untuk tabel `rapor_kkm`
--
ALTER TABLE `rapor_kkm`
  ADD PRIMARY KEY (`id_kkm`) USING BTREE;

--
-- Indeks untuk tabel `rapor_naik`
--
ALTER TABLE `rapor_naik`
  ADD PRIMARY KEY (`id_naik`) USING BTREE;

--
-- Indeks untuk tabel `rapor_nilai_akhir`
--
ALTER TABLE `rapor_nilai_akhir`
  ADD PRIMARY KEY (`id_nilai_akhir`) USING BTREE;

--
-- Indeks untuk tabel `rapor_nilai_ekstra`
--
ALTER TABLE `rapor_nilai_ekstra`
  ADD PRIMARY KEY (`id_nilai_ekstra`) USING BTREE;

--
-- Indeks untuk tabel `rapor_nilai_harian`
--
ALTER TABLE `rapor_nilai_harian`
  ADD PRIMARY KEY (`id_nilai_harian`) USING BTREE;

--
-- Indeks untuk tabel `rapor_nilai_pts`
--
ALTER TABLE `rapor_nilai_pts`
  ADD PRIMARY KEY (`id_nilai_pts`) USING BTREE;

--
-- Indeks untuk tabel `rapor_nilai_sikap`
--
ALTER TABLE `rapor_nilai_sikap`
  ADD PRIMARY KEY (`id_nilai_sikap`) USING BTREE;

--
-- Indeks untuk tabel `rapor_prestasi`
--
ALTER TABLE `rapor_prestasi`
  ADD PRIMARY KEY (`id_ranking`) USING BTREE;

--
-- Indeks untuk tabel `running_text`
--
ALTER TABLE `running_text`
  ADD PRIMARY KEY (`id_text`) USING BTREE;

--
-- Indeks untuk tabel `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`) USING BTREE;

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `id_user` (`id`) USING BTREE,
  ADD UNIQUE KEY `username_idx` (`username`) USING BTREE;

--
-- Indeks untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`) USING BTREE,
  ADD KEY `fk_users_groups_users1_idx` (`user_id`) USING BTREE,
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`) USING BTREE;

--
-- Indeks untuk tabel `users_profile`
--
ALTER TABLE `users_profile`
  ADD PRIMARY KEY (`id_user`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `api_setting`
--
ALTER TABLE `api_setting`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `api_token`
--
ALTER TABLE `api_token`
  MODIFY `id_api` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `buku_induk`
--
ALTER TABLE `buku_induk`
  MODIFY `id_siswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `bulan`
--
ALTER TABLE `bulan`
  MODIFY `id_bln` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `cbt_bank_soal`
--
ALTER TABLE `cbt_bank_soal`
  MODIFY `id_bank` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `cbt_jadwal`
--
ALTER TABLE `cbt_jadwal`
  MODIFY `id_jadwal` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `cbt_jenis`
--
ALTER TABLE `cbt_jenis`
  MODIFY `id_jenis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `cbt_rekap`
--
ALTER TABLE `cbt_rekap`
  MODIFY `id_rekap` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `cbt_rekap_nilai`
--
ALTER TABLE `cbt_rekap_nilai`
  MODIFY `id_rekap_nilai` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `cbt_ruang`
--
ALTER TABLE `cbt_ruang`
  MODIFY `id_ruang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `cbt_sesi`
--
ALTER TABLE `cbt_sesi`
  MODIFY `id_sesi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `cbt_soal`
--
ALTER TABLE `cbt_soal`
  MODIFY `id_soal` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `cbt_token`
--
ALTER TABLE `cbt_token`
  MODIFY `id_token` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `hari`
--
ALTER TABLE `hari`
  MODIFY `id_hri` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kelas_catatan_mapel`
--
ALTER TABLE `kelas_catatan_mapel`
  MODIFY `id_catatan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelas_catatan_wali`
--
ALTER TABLE `kelas_catatan_wali`
  MODIFY `id_catatan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelas_materi`
--
ALTER TABLE `kelas_materi`
  MODIFY `id_materi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelas_struktur`
--
ALTER TABLE `kelas_struktur`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `level_guru`
--
ALTER TABLE `level_guru`
  MODIFY `id_level` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `log_ujian`
--
ALTER TABLE `log_ujian`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `master_ekstra`
--
ALTER TABLE `master_ekstra`
  MODIFY `id_ekstra` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `master_guru`
--
ALTER TABLE `master_guru`
  MODIFY `id_guru` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `master_hari_efektif`
--
ALTER TABLE `master_hari_efektif`
  MODIFY `id_hari_efektif` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `master_jurusan`
--
ALTER TABLE `master_jurusan`
  MODIFY `id_jurusan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `master_kelas`
--
ALTER TABLE `master_kelas`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `master_kelompok_mapel`
--
ALTER TABLE `master_kelompok_mapel`
  MODIFY `id_kel_mapel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `master_mapel`
--
ALTER TABLE `master_mapel`
  MODIFY `id_mapel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `master_siswa`
--
ALTER TABLE `master_siswa`
  MODIFY `id_siswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `master_smt`
--
ALTER TABLE `master_smt`
  MODIFY `id_smt` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `master_tp`
--
ALTER TABLE `master_tp`
  MODIFY `id_tp` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id_comment` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `post_reply`
--
ALTER TABLE `post_reply`
  MODIFY `id_reply` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rapor_admin_setting`
--
ALTER TABLE `rapor_admin_setting`
  MODIFY `id_setting` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rapor_catatan_wali`
--
ALTER TABLE `rapor_catatan_wali`
  MODIFY `id_catatan_wali` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rapor_data_catatan`
--
ALTER TABLE `rapor_data_catatan`
  MODIFY `id_catatan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rapor_data_fisik`
--
ALTER TABLE `rapor_data_fisik`
  MODIFY `id_fisik` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rapor_data_sikap`
--
ALTER TABLE `rapor_data_sikap`
  MODIFY `id_sikap` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rapor_fisik`
--
ALTER TABLE `rapor_fisik`
  MODIFY `id_fisik` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rapor_kikd`
--
ALTER TABLE `rapor_kikd`
  MODIFY `id_kikd` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rapor_kkm`
--
ALTER TABLE `rapor_kkm`
  MODIFY `id_kkm` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rapor_nilai_akhir`
--
ALTER TABLE `rapor_nilai_akhir`
  MODIFY `id_nilai_akhir` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rapor_nilai_ekstra`
--
ALTER TABLE `rapor_nilai_ekstra`
  MODIFY `id_nilai_ekstra` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rapor_nilai_harian`
--
ALTER TABLE `rapor_nilai_harian`
  MODIFY `id_nilai_harian` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rapor_nilai_pts`
--
ALTER TABLE `rapor_nilai_pts`
  MODIFY `id_nilai_pts` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rapor_nilai_sikap`
--
ALTER TABLE `rapor_nilai_sikap`
  MODIFY `id_nilai_sikap` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rapor_prestasi`
--
ALTER TABLE `rapor_prestasi`
  MODIFY `id_ranking` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `running_text`
--
ALTER TABLE `running_text`
  MODIFY `id_text` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users_profile`
--
ALTER TABLE `users_profile`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cbt_jadwal`
--
ALTER TABLE `cbt_jadwal`
  ADD CONSTRAINT `id_bank_soal` FOREIGN KEY (`id_bank`) REFERENCES `cbt_bank_soal` (`id_bank`),
  ADD CONSTRAINT `id_jns_idx_ifc` FOREIGN KEY (`id_jenis`) REFERENCES `cbt_jenis` (`id_jenis`);

--
-- Ketidakleluasaan untuk tabel `cbt_soal_siswa`
--
ALTER TABLE `cbt_soal_siswa`
  ADD CONSTRAINT `id_bank_fc` FOREIGN KEY (`id_bank`) REFERENCES `cbt_bank_soal` (`id_bank`),
  ADD CONSTRAINT `id_jadwal_fc` FOREIGN KEY (`id_jadwal`) REFERENCES `cbt_jadwal` (`id_jadwal`),
  ADD CONSTRAINT `Id_siswa_fc` FOREIGN KEY (`id_siswa`) REFERENCES `master_siswa` (`id_siswa`),
  ADD CONSTRAINT `id_soal_fc` FOREIGN KEY (`id_soal`) REFERENCES `cbt_soal` (`id_soal`);

--
-- Ketidakleluasaan untuk tabel `master_kelas`
--
ALTER TABLE `master_kelas`
  ADD CONSTRAINT `key_id_cek` FOREIGN KEY (`level_id`) REFERENCES `level_kelas` (`id_level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;