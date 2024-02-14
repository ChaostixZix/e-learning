<?php

/*   ________________________________________
    |                 GarudaCBT              |
    |    https://github.com/garudacbt/cbt    |
    |________________________________________|
*/
class Cbtanalisis extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect("auth");
            goto BbG8_;
        }
        if (!(!$this->ion_auth->is_admin() && !$this->ion_auth->in_group("guru"))) {
            goto UbbNh;
        }
        show_error("Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href=\"" . base_url("dashboard") . "\">Kembali ke menu awal</a>", 403, "Akses Terlarang");
        UbbNh:
        BbG8_:
        $this->load->library(["datatables", "form_validation"]);
        $this->form_validation->set_error_delimiters('', '');
    }
    public function output_json($data, $encode = true)
    {
        if (!$encode) {
            goto f5okH;
        }
        $data = json_encode($data);
        f5okH:
        $this->output->set_content_type("application/json")->set_output($data);
    }
    public function index()
    {
        $this->load->model("Dashboard_model", "dashboard");
        $this->load->model("Cbt_model", "cbt");
        $this->load->model("Dropdown_model", "dropdown");
        $user = $this->ion_auth->user()->row();
        $data = ["user" => $user, "judul" => "Analisa Soal", "subjudul" => "Analisa Soal Ujian", "setting" => $this->dashboard->getSetting()];
        $tp = $this->dashboard->getTahunActive();
        $smt = $this->dashboard->getSemesterActive();
        $data["tp"] = $this->dashboard->getTahun();
        $data["tp_active"] = $tp;
        $data["smt"] = $this->dashboard->getSemester();
        $data["smt_active"] = $smt;
        $jadwal = $this->input->get("jadwal");
        $thn_sel = $this->input->get("thn");
        $smt_sel = $this->input->get("smt");
        $thn_sel = $thn_sel == null ? $tp->id_tp : $thn_sel;
        $smt_sel = $smt_sel == null ? $smt->id_smt : $smt_sel;
        $data["tp_selected"] = $thn_sel;
        $data["smt_selected"] = $smt_sel;
        $data["jadwal_selected"] = $jadwal;
        if (!($jadwal != null)) {
            goto yBw95;
        }
        $info = $this->cbt->getJadwalById($jadwal);
        $all_jawaban = $this->cbt->getJawabanByBank($info->id_bank);
        $jawabans_siswa = [];
        $ids = [];
        foreach ($all_jawaban as $jawaban_siswa) {
            array_push($ids, $jawaban_siswa->id_siswa);
            $jawabans_siswa[$jawaban_siswa->jenis_soal][$jawaban_siswa->nomor_soal][$jawaban_siswa->id_siswa] = $jawaban_siswa->jawaban_siswa;
        }
        $nilai_pg = $this->cbt->getAllNilaiSiswa($jadwal);
        $all_soals = $this->cbt->getSoalByBank($info->id_bank);
        if (!isset($all_soals[1])) {
            goto S4Y1m;
        }
        foreach ($all_soals[1] as $no => $soal) {
            $soal->jawaban_siswa = [];
            $soal->skor_siswa = [];
            $soal->jumlah_benar = 0;
            $soal->jumlah_salah = 0;
            $total_siswa = 0;
            $x = [];
            $jwbn_siswa = isset($jawabans_siswa[1][$no]) && isset($jawabans_siswa[1][$no]) ? $jawabans_siswa[1][$no] : [];
            foreach ($jwbn_siswa as $id => $jawab_siswa) {
                $total_siswa++;
                if ($jawab_siswa == $soal->jawaban) {
                    $soal->jumlah_benar++;
                    array_push($x, 1);
                    goto MVWVj;
                }
                $soal->jumlah_salah++;
                array_push($x, 0);
                MVWVj:
                if ($jawab_siswa == "A") {
                    $soal->jawaban_siswa["jawab_a"][$id] = $jawab_siswa;
                    goto oj7zn;
                }
                if ($jawab_siswa == "B") {
                    $soal->jawaban_siswa["jawab_b"][$id] = $jawab_siswa;
                    goto oj7zn;
                }
                if ($jawab_siswa == "C") {
                    $soal->jawaban_siswa["jawab_c"][$id] = $jawab_siswa;
                    goto oj7zn;
                }
                if ($jawab_siswa == "D") {
                    $soal->jawaban_siswa["jawab_d"][$id] = $jawab_siswa;
                    goto oj7zn;
                }
                if ($jawab_siswa == "E") {
                    $soal->jawaban_siswa["jawab_e"][$id] = $jawab_siswa;
                    goto cEvR8;
                }
                cEvR8:
                oj7zn:
            }
            $benar = $soal->jumlah_benar;
            $salah = $soal->jumlah_salah;
            $jml_siswa = $total_siswa;
            $kesukaran = 0;
            $status_soal = '';
            if (!($jml_siswa > 0)) {
                goto EKxQC;
            }
            $kesukaran = round($benar / $jml_siswa, 2);
            if ($kesukaran >= 0.7) {
                $status_soal = "mudah";
                goto hJjci;
            }
            if ($kesukaran >= 0.3) {
                $status_soal = "sedang";
                goto x4CBJ;
            }
            $status_soal = "sukar";
            x4CBJ:
            hJjci:
            EKxQC:
            $soal->tingkat_kesukaran = $kesukaran;
            $soal->status_kesukaran = $status_soal;
            $cek = $jml_siswa % 2;
            if (!($cek == 1)) {
                goto I2Bn8;
            }
            $jml_siswa--;
            I2Bn8:
            $bagi = $jml_siswa / 2;
            $pos_a = 0;
            $pos_b = $bagi;
            $y = [];
            $yng_benar_golonganatas = 0;
            $yng_benar_golonganbawah = 0;
            $no = 1;
            foreach ($nilai_pg as $id => $nilai) {
                array_push($y, $nilai->pg_benar);
                if (!isset($jwbn_siswa[$id])) {
                    goto DS31d;
                }
                $siswa_menjawab = $jwbn_siswa[$id];
                if ($no <= $bagi) {
                    if (!($siswa_menjawab == $soal->jawaban)) {
                        goto fIdVp;
                    }
                    $yng_benar_golonganatas++;
                    fIdVp:
                    goto Fia4p;
                }
                if (!($siswa_menjawab == $soal->jawaban)) {
                    goto TL7m7;
                }
                $yng_benar_golonganbawah++;
                TL7m7:
                Fia4p:
                DS31d:
                $no++;
            }
            $soal->total_siswa = $total_siswa;
            $soal->benar_atas = $yng_benar_golonganatas;
            $soal->benar_bawah = $yng_benar_golonganbawah;
            $pearson = $this->pearson($x, $y);
            $soal->nilai_valid = $pearson;
            $soal->table_r = $this->nilaiSignifikansi($total_siswa);
            $validitas = $this->nilaiSignifikansi($total_siswa) <= $pearson ? "Valid" : "Tidak valid";
            $soal->status_valid = $validitas;
            $bagi_daya = $bagi > 0 ? $bagi : 1;
            if ($yng_benar_golonganatas == 0 && $yng_benar_golonganbawah != 0) {
                $daya_pembeda = 0 - $yng_benar_golonganbawah / $bagi_daya;
                goto cUOMh;
            }
            if ($yng_benar_golonganatas != 0 && $yng_benar_golonganbawah == 0) {
                $daya_pembeda = $yng_benar_golonganatas / $bagi_daya;
                goto ktkdL;
            }
            if ($yng_benar_golonganatas == 0 && $yng_benar_golonganbawah == 0) {
                $daya_pembeda = 0;
                goto Imj75;
            }
            $daya_pembeda = $yng_benar_golonganatas / $bagi_daya - $yng_benar_golonganbawah / $bagi_daya;
            Imj75:
            ktkdL:
            cUOMh:
            $soal->daya_pembeda = $daya_pembeda;
            if ($daya_pembeda >= 0.7) {
                $soal->status_daya = "Baik Sekali";
                goto mTDsM;
            }
            if ($daya_pembeda >= 0.4) {
                $soal->status_daya = "Baik";
                goto mVIeE;
            }
            if ($daya_pembeda >= 0.2) {
                $soal->status_daya = "Cukup";
                goto f6jRp;
            }
            $soal->status_daya = "Jelek";
            f6jRp:
            mVIeE:
            mTDsM:
        }
        S4Y1m:
        $data["info"] = $info;
        $data["soals"] = $all_soals;
        $data["nilai"] = $nilai_pg;
        yBw95:
        if ($this->ion_auth->is_admin()) {
            $data["profile"] = $this->dashboard->getProfileAdmin($user->id);
            $data["kodejadwal"] = $this->dropdown->getAllJadwal($thn_sel, $smt_sel);
            $this->load->view("_templates/dashboard/_header", $data);
            $this->load->view("cbt/analisis/data");
            $this->load->view("_templates/dashboard/_footer");
            goto Q12eo;
        }
        $guru = $this->dashboard->getDataGuruByUserId($user->id, $thn_sel, $smt_sel);
        $nguru[$guru->id_guru] = $guru->nama_guru;
        $data["guru"] = $guru;
        $data["kodejadwal"] = $this->dropdown->getAllJadwalGuru($thn_sel, $smt_sel, $guru->id_guru);
        $this->load->view("members/guru/templates/header", $data);
        $this->load->view("cbt/analisis/data");
        $this->load->view("members/guru/templates/footer");
        Q12eo:
    }
    private function pearson($x, $y)
    {
        $cx = count($x);
        $cy = count($y);
        if (!($cx === 0 || $cy === 0)) {
            if (!($cx < $cy)) {
                goto A7I2I;
            }
            $d = $cy - $cx;
            $i = 0;
            sypYq:
            if (!($i < $d)) {
                A7I2I:
                if (!($cx > $cy)) {
                    goto Z1yTF;
                }
                $d = $cx - $cy;
                $i = 0;
                OFbjq:
                if (!($i < $d)) {
                    Z1yTF:
                    if (!(count($x) !== count($y))) {
                        $x = array_values($x);
                        $y = array_values($y);
                        $xs = array_sum($x) / count($x);
                        $ys = array_sum($y) / count($y);
                        $a = 0;
                        $bx = 0;
                        $by = 0;
                        $i = 0;
                        DW0IP:
                        if (!($i < count($x))) {
                            $b = sqrt($bx * $by);
                            $ret = -1;
                            if (!($b > 0)) {
                                goto LDJF7;
                            }
                            $ret = $a / $b;
                            LDJF7:
                            return $ret;
                        }
                        $xr = $x[$i] - $xs;
                        $yr = $y[$i] - $ys;
                        $a += $xr * $yr;
                        $bx += pow($xr, 2);
                        $by += pow($yr, 2);
                        $i++;
                        goto DW0IP;
                    }
                    return -1;
                }
                array_pop($x);
                $i++;
                goto OFbjq;
            }
            array_pop($y);
            $i++;
            goto sypYq;
        }
        return -1;
    }
    public function getNilaiKelas()
    {
        $this->load->model("Dashboard_model", "dashboard");
        $this->load->model("Cbt_model", "cbt");
        $kelas = $this->input->get("kelas");
        $sesi = $this->input->get("sesi");
        $jadwal = $this->input->get("jadwal");
        $tp = $this->dashboard->getTahunActive();
        $smt = $this->dashboard->getSemesterActive();
        $info = $this->cbt->getJadwalById($jadwal, $sesi);
        $siswas = $this->cbt->getSiswaByKelas($tp->id_tp, $smt->id_smt, $kelas);
        $arrDur = [];
        foreach ($siswas as $siswa) {
            $arrJawab_pg = [];
            $arrJawab_essai = [];
            $i = 0;
            WuUBU:
            if (!($i < $info->tampil_pg)) {
                $j = 0;
                qquMf:
                if (!($j < $info->tampil_esai)) {
                    $jawab_essai = isset($arrJawab_essai[$siswa->id_siswa]) ? $arrJawab_essai[$siswa->id_siswa] : [];
                    $arrDur[$siswa->id_siswa] = ["dur" => $this->cbt->getDurasiSiswa($siswa->id_siswa . "0" . $jadwal), "jawab_pg" => $arrJawab_pg[$siswa->id_siswa], "jawab_essai" => $jawab_essai, "log" => $this->cbt->getLogUjian($siswa->id_siswa, $jadwal)];
                }
                $jawaban = $this->cbt->getJawabanSiswa($siswa->id_siswa . "0" . $jadwal . $info->id_bank . 2 . ($j + 1));
                if ($jawaban != null) {
                    $arrJawab_essai[$siswa->id_siswa][] = $jawaban;
                    goto ulP7K;
                }
                $arrJawab_essai[$siswa->id_siswa][] = array("id_jawaban" => 0, "jawaban" => '', "jawaban_benar" => '', "koreksi" => 0);
                ulP7K:
                $j++;
                goto qquMf;
            }
            $arrJawab_pg[$siswa->id_siswa][] = $this->cbt->getJawabanSiswa($siswa->id_siswa . "0" . $jadwal . $info->id_bank . 1 . ($i + 1));
            $i++;
            goto WuUBU;
        }
        $data["siswa"] = $siswas;
        $data["jawaban"] = $arrDur;
        $data["info"] = $info;
        $this->output_json($data);
    }
    public function getJadwalUjianByJadwal()
    {
        $this->load->model("Cbt_model", "cbt");
        $this->load->model("Dropdown_model", "dropdown");
        $jadwal = $this->input->get("jadwal");
        $tp = $this->input->get("thn");
        $smt = $this->input->get("smt");
        $info = $this->cbt->getJadwalById($jadwal);
        $kelas = unserialize($info->bank_kelas);
        $kelases = [];
        foreach ($kelas as $key => $value) {
            $kelases[$value["kelas_id"]] = $this->dropdown->getNamaKelasById($info->id_tp, $info->id_smt, $value["kelas_id"]);
        }
        $this->output_json($kelases);
    }
    public function kalkulasi()
    {
        $jadwal = $this->input->get("jadwal");
        $update = $this->generateNilaiUjian($jadwal);
        $this->output_json($update);
    }
    public function generateNilaiUjian($jadwal)
    {
        $this->load->model("Cbt_model", "cbt");
        $info = $this->cbt->getJadwalById($jadwal);
        $bagi_pg = $info->tampil_pg / 100;
        $bobot_pg = $info->bobot_pg / 100;
        $bagi_pg2 = $info->tampil_kompleks / 100;
        $bobot_pg2 = $info->bobot_kompleks / 100;
        $bagi_jodoh = $info->tampil_jodohkan / 100;
        $bobot_jodoh = $info->bobot_jodohkan / 100;
        $bagi_isian = $info->tampil_isian / 100;
        $bobot_isian = $info->bobot_isian / 100;
        $bagi_essai = $info->tampil_esai / 100;
        $bobot_essai = $info->bobot_esai / 100;
        $kelas_bank = unserialize($info->bank_kelas);
        $kelases = [];
        foreach ($kelas_bank as $key => $value) {
            array_push($kelases, $value["kelas_id"]);
        }
        $siswas = $this->cbt->getSiswaByKelas($info->id_tp, $info->id_smt, $kelases);
        $ids = [];
        foreach ($siswas as $key => $value) {
            array_push($ids, $value->id_siswa);
        }
        $jawabans = $this->cbt->getJawabanByBank($info->id_bank);
        $soal = [];
        $jawabans_siswa = [];
        foreach ($jawabans as $jawaban_siswa) {
            if (!($jawaban_siswa->jenis_soal == "2")) {
                goto ArPJE;
            }
            $jawaban_siswa->opsi_a = @unserialize($jawaban_siswa->opsi_a);
            $jawaban_siswa->jawaban_siswa = @unserialize($jawaban_siswa->jawaban_siswa);
            $jawaban_siswa->jawaban_benar = @unserialize($jawaban_siswa->jawaban_benar);
            $jawaban_siswa->jawaban_benar = array_map("strtoupper", $jawaban_siswa->jawaban_benar);
            $jawaban_siswa->jawaban_benar = array_filter($jawaban_siswa->jawaban_benar, "strlen");
            ArPJE:
            if (!($jawaban_siswa->jenis_soal == "3")) {
                goto CU36E;
            }
            $jawaban_siswa->jawaban_siswa = @unserialize($jawaban_siswa->jawaban_siswa);
            $jawaban_siswa->jawaban_benar = @unserialize($jawaban_siswa->jawaban_benar);
            $jawaban_siswa->jawaban_siswa = json_decode(json_encode($jawaban_siswa->jawaban_siswa));
            $jawaban_siswa->jawaban_benar = json_decode(json_encode($jawaban_siswa->jawaban_benar));
            CU36E:
            $jawabans_siswa[$jawaban_siswa->id_siswa][$jawaban_siswa->jenis_soal][] = $jawaban_siswa;
            $soal[$jawaban_siswa->jenis_soal][] = $jawaban_siswa;
        }
        $insets = [];
        foreach ($siswas as $siswa) {
            $ada_jawaban = isset($jawabans_siswa[$siswa->id_siswa]);
            $ada_jawaban_pg = $ada_jawaban && isset($jawabans_siswa[$siswa->id_siswa]["1"]);
            $ada_jawaban_pg2 = $ada_jawaban && isset($jawabans_siswa[$siswa->id_siswa]["2"]);
            $ada_jawaban_jodoh = $ada_jawaban && isset($jawabans_siswa[$siswa->id_siswa]["3"]);
            $ada_jawaban_isian = $ada_jawaban && isset($jawabans_siswa[$siswa->id_siswa]["4"]);
            $ada_jawaban_essai = $ada_jawaban && isset($jawabans_siswa[$siswa->id_siswa]["5"]);
            $nilai_input = $this->cbt->getNilaiSiswaByJadwal($jadwal, $siswa->id_siswa);
            $jawaban_pg = $ada_jawaban_pg ? $jawabans_siswa[$siswa->id_siswa]["1"] : [];
            $benar_pg = 0;
            $salah_pg = 0;
            if (!($info->tampil_pg > 0)) {
                goto yBlmy;
            }
            if (!(count($jawaban_pg) > 0)) {
                goto w2i3_;
            }
            foreach ($jawaban_pg as $jwb_pg) {
                if (!($jwb_pg != null && $jwb_pg->jawaban_siswa != null)) {
                    goto uZnp6;
                }
                if (strtoupper($jwb_pg->jawaban_siswa) == strtoupper($jwb_pg->jawaban_benar)) {
                    $benar_pg += 1;
                    goto hqRvt;
                }
                $salah_pg += 1;
                hqRvt:
                uZnp6:
            }
            w2i3_:
            yBlmy:
            $skor_pg = $bagi_pg == 0 ? 0 : $benar_pg / $bagi_pg * $bobot_pg;
            $jawaban_pg2 = $ada_jawaban_pg2 ? $jawabans_siswa[$siswa->id_siswa]["2"] : [];
            $benar_pg2 = 0;
            $skor_koreksi_pg2 = 0.0;
            $otomatis_pg2 = 0;
            if (!($info->tampil_kompleks > 0)) {
                goto pKAAG;
            }
            if (!(count($jawaban_pg2) > 0)) {
                goto AKaZ5;
            }
            foreach ($jawaban_pg2 as $num => $jawab_pg2) {
                $otomatis_pg2 = $jawab_pg2->nilai_otomatis;
                $skor_koreksi_pg2 += $jawab_pg2->nilai_koreksi;
                $arr_benar = [];
                foreach ($jawab_pg2->jawaban_siswa as $js) {
                    if (!in_array($js, $jawab_pg2->jawaban_benar)) {
                        goto EEVzN;
                    }
                    array_push($arr_benar, true);
                    EEVzN:
                }
                $benar_pg2 += 1 / count($jawab_pg2->jawaban_benar) * count($arr_benar);
            }
            AKaZ5:
            pKAAG:
            $s_pg2 = $bagi_pg2 == 0 ? 0 : $benar_pg2 / $bagi_pg2 * $bobot_pg2;
            $input_pg2 = 0;
            if (!($nilai_input != null && $nilai_input->kompleks_nilai != null)) {
                goto fWv2M;
            }
            $input_pg2 = $nilai_input->kompleks_nilai;
            fWv2M:
            $skor_pg2 = $input_pg2 != 0 ? $input_pg2 : ($otomatis_pg2 == 0 ? $s_pg2 : $skor_koreksi_pg2);
            $jawaban_jodoh = $ada_jawaban_jodoh ? $jawabans_siswa[$siswa->id_siswa]["3"] : [];
            $benar_jod = 0;
            $skor_koreksi_jod = 0.0;
            $otomatis_jod = 0;
            if (!($info->tampil_jodohkan > 0)) {
                goto rvRTe;
            }
            if (!(count($jawaban_jodoh) > 0)) {
                goto igGp2;
            }
            foreach ($jawaban_jodoh as $num => $jawab_jod) {
                $skor_koreksi_jod += $jawab_jod->nilai_koreksi;
                $arrSoal = $jawab_jod->jawaban_benar->jawaban;
                $headSoal = array_shift($arrSoal);
                $arrJwbSoal = [];
                $items = 0;
                foreach ($arrSoal as $kolSoal) {
                    $jwb = new stdClass();
                    foreach ($kolSoal as $pos => $kol) {
                        if (!($kol == "1")) {
                            goto rwbMY;
                        }
                        $jwb->subtitle[] = $headSoal[$pos];
                        $items++;
                        rwbMY:
                    }
                    $jwb->title = array_shift($kolSoal);
                    array_push($arrJwbSoal, $jwb);
                }
                $arrJawab = $jawab_jod->jawaban_siswa->jawaban;
                $headJawab = array_shift($arrJawab);
                $arrJwbJawab = [];
                foreach ($arrJawab as $kolJawab) {
                    $jwbs = new stdClass();
                    foreach ($kolJawab as $po => $kol) {
                        if (!($kol == "1")) {
                            goto exR7M;
                        }
                        $sub = $headJawab[$po];
                        $jwbs->subtitle[] = $sub;
                        exR7M:
                    }
                    array_push($arrJwbJawab, $jwbs);
                }
                $item_benar = 0;
                $item_salah = 0;
                foreach ($arrJwbJawab as $p => $ajjs) {
                    foreach ($ajjs->subtitle as $pp => $ajs) {
                        if (in_array($ajs, $arrJwbSoal[$p]->subtitle)) {
                            $item_benar++;
                            goto x85rH;
                        }
                        $item_salah++;
                        x85rH:
                    }
                }
                $benar_jod += 1 / $items * $item_benar;
                $otomatis_jod = $jawab_jod->nilai_otomatis;
            }
            igGp2:
            rvRTe:
            $s_jod = $bagi_jodoh == 0 ? 0 : $benar_jod / $bagi_jodoh * $bobot_jodoh;
            $input_jod = 0;
            if (!($nilai_input != null && $nilai_input->jodohkan_nilai != null)) {
                goto xURJ6;
            }
            $input_jod = $nilai_input->jodohkan_nilai;
            xURJ6:
            $skor_jod = $input_jod != 0 ? $input_jod : ($otomatis_jod == 0 ? $s_jod : $skor_koreksi_jod);
            $jawaban_is = $ada_jawaban_isian ? $jawabans_siswa[$siswa->id_siswa]["4"] : [];
            $benar_is = 0;
            $skor_koreksi_is = 0.0;
            $otomatis_is = 0;
            if (!($info->tampil_isian > 0)) {
                goto B36cT;
            }
            if (!(count($jawaban_is) > 0)) {
                goto l5VOB;
            }
            foreach ($jawaban_is as $num => $jawab_is) {
                $skor_koreksi_is += $jawab_is->nilai_koreksi;
                $benar = $jawab_is != null && strtolower($jawab_is->jawaban_siswa) == strtolower($jawab_is->jawaban_benar);
                if (!$benar) {
                    goto fMFkb;
                }
                $benar_is++;
                fMFkb:
                $otomatis_is = $jawab_is->nilai_otomatis;
            }
            l5VOB:
            B36cT:
            $s_is = $bagi_isian == 0 ? 0 : $benar_is / $bagi_isian * $bobot_isian;
            $input_is = 0;
            if (!($nilai_input != null && $nilai_input->isian_nilai != null)) {
                goto IO5vr;
            }
            $input_is = $nilai_input->isian_nilai;
            IO5vr:
            $skor_is = $input_is != 0 ? $input_is : ($otomatis_is == 0 ? $s_is : $skor_koreksi_is);
            $jawaban_es = $ada_jawaban_essai ? $jawabans_siswa[$siswa->id_siswa]["5"] : [];
            $benar_es = 0;
            $skor_koreksi_es = 0.0;
            $otomatis_es = 0;
            if (!($info->tampil_esai > 0)) {
                goto fTdwb;
            }
            if (!(count($jawaban_es) > 0)) {
                goto LEvjg;
            }
            foreach ($jawaban_es as $num => $jawab_es) {
                $skor_koreksi_es += $jawab_es->nilai_koreksi;
                $benar = $jawab_es != null && strtolower($jawab_es->jawaban_siswa) == strtolower($jawab_es->jawaban_benar);
                if (!$benar) {
                    goto lfuAL;
                }
                $benar_es++;
                lfuAL:
                $otomatis_es = $jawab_es->nilai_otomatis;
            }
            LEvjg:
            fTdwb:
            $s_es = $bagi_essai == 0 ? 0 : $benar_es / $bagi_essai * $bobot_essai;
            $input_es = 0;
            if (!($nilai_input != null && $nilai_input->isian_nilai != null)) {
                goto CtQYj;
            }
            $input_es = $nilai_input->essai_nilai;
            CtQYj:
            $skor_es = $input_es != 0 ? $input_es : ($otomatis_es == 0 ? $s_es : $skor_koreksi_es);
            $insert["id_nilai"] = $siswa->id_siswa . "0" . $jadwal;
            $insert["id_siswa"] = $siswa->id_siswa;
            $insert["id_jadwal"] = $jadwal;
            $insert["pg_benar"] = $benar_pg;
            $insert["pg_nilai"] = round($skor_pg, 2);
            $insert["kompleks_nilai"] = round($skor_pg2, 2);
            $insert["jodohkan_nilai"] = round($skor_jod, 2);
            $insert["isian_nilai"] = round($skor_is, 2);
            $insert["essai_nilai"] = round($skor_es, 2);
            array_push($insets, $insert);
        }
        $update = $this->db->update_batch("cbt_nilai", $insets, "id_nilai");
        return $update;
    }
    private function nilaiSignifikansi($jml)
    {
        $list = [3 => [5 => 0.997], [1 => 0.999], 4 => [5 => 0.95], [1 => 0.99], 5 => [5 => 0.878], [1 => 0.959], 6 => [5 => 0.8110000000000001], [1 => 0.917], 7 => [5 => 0.754], [1 => 0.874], 8 => [5 => 0.707], [1 => 0.834], 9 => [5 => 0.666], [1 => 0.798], 10 => [5 => 0.632], [1 => 0.765], 11 => [5 => 0.602], [1 => 0.735], 12 => [5 => 0.576], [1 => 0.708], 13 => [5 => 0.553], [1 => 0.6840000000000001], 14 => [5 => 0.532], [1 => 0.661], 15 => [5 => 0.514], [1 => 0.641], 16 => [5 => 0.497], [1 => 0.623], 17 => [5 => 0.482], [1 => 0.606], 18 => [5 => 0.468], [1 => 0.59], 19 => [5 => 0.456], [1 => 0.575], 20 => [5 => 0.444], [1 => 0.5610000000000001], 21 => [5 => 0.433], [1 => 0.549], 22 => [5 => 0.423], [1 => 0.537], 23 => [5 => 0.413], [1 => 0.526], 24 => [5 => 0.404], [1 => 0.515], 25 => [5 => 0.396], [1 => 0.505], 26 => [5 => 0.388], [1 => 0.496], 27 => [5 => 0.381], [1 => 0.487], 28 => [5 => 0.374], [1 => 0.478], 29 => [5 => 0.367], [1 => 0.47], 30 => [5 => 0.361], [1 => 0.463], 31 => [5 => 0.355], [1 => 0.456], 32 => [5 => 0.349], [1 => 0.449], 33 => [5 => 0.344], [1 => 0.442], 34 => [5 => 0.339], [1 => 0.436], 35 => [5 => 0.334], [1 => 0.43], 36 => [5 => 0.329], [1 => 0.424], 37 => [5 => 0.325], [1 => 0.418], 38 => [5 => 0.32], [1 => 0.413], 39 => [5 => 0.316], [1 => 0.408], 40 => [5 => 0.312], [1 => 0.403], 41 => [5 => 0.308], [1 => 0.398], 42 => [5 => 0.304], [1 => 0.393], 43 => [5 => 0.301], [1 => 0.389], 44 => [5 => 0.297], [1 => 0.384], 45 => [5 => 0.294], [1 => 0.38], 46 => [5 => 0.291], [1 => 0.376], 47 => [5 => 0.288], [1 => 0.372], 48 => [5 => 0.284], [1 => 0.368], 49 => [5 => 0.281], [1 => 0.364], 50 => [5 => 0.279], [1 => 0.361], 55 => [5 => 0.266], [1 => 0.345], 60 => [5 => 0.254], [1 => 0.33], 65 => [5 => 0.244], [1 => 0.317], 70 => [5 => 0.235], [1 => 0.306], 75 => [5 => 0.227], [1 => 0.296], 80 => [5 => 0.22], [1 => 0.286], 85 => [5 => 0.213], [1 => 0.278], 90 => [5 => 0.207], [1 => 0.27], 95 => [5 => 0.202], [1 => 0.263], 100 => [5 => 0.195], [1 => 0.256], 125 => [5 => 0.176], [1 => 0.23], 150 => [5 => 0.159], [1 => 0.21], 175 => [5 => 0.149], [1 => 0.194], 200 => [5 => 0.138], [1 => 0.191], 300 => [5 => 0.113], [1 => 0.181], 400 => [5 => 0.098], [1 => 0.148], 500 => [5 => 0.08799999999999999], [1 => 0.128], 600 => [5 => 0.08], [1 => 0.115], 700 => [5 => 0.074], [1 => 0.105], 800 => [5 => 0.07000000000000001], [1 => 0.091], 900 => [5 => 0.065], [1 => 0.08599999999999999], 1000 => [5 => 0.062], [1 => 0.081]];
        if (isset($list[$jml])) {
            if (isset($list[$jml]["5"])) {
                return $list[$jml]["5"];
            }
            return $list[$jml]["1"];
        }
        $keys = $this->getClosest($jml, array_keys($list));
        if (!($keys < 4)) {
            goto SzSg6;
        }
        $keys = 4;
        SzSg6:
        if (isset($list[$keys]["5"])) {
            return $list[$keys]["5"];
        }
        return $list[$keys]["1"];
    }
    function getClosest($search, $arr)
    {
        $closest = null;
        foreach ($arr as $item) {
            if (!($closest === null || abs($search - $closest) > abs($item - $search))) {
                goto k91t_;
            }
            $closest = $item;
            k91t_:
        }
        return $closest;
    }
}
