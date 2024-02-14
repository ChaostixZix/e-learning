<?php

/*   ________________________________________
    |                 GarudaCBT              |
    |    https://github.com/garudacbt/cbt    |
    |________________________________________|
*/
class Cbtnilai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect("auth");
            goto q05Od;
        }
        if (!(!$this->ion_auth->is_admin() && !$this->ion_auth->in_group("guru"))) {
            goto Fecv1;
        }
        show_error("Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href=\"" . base_url("dashboard") . "\">Kembali ke menu awal</a>", 403, "Akses Terlarang");
        Fecv1:
        q05Od:
        $this->load->library(["datatables", "form_validation"]);
        $this->load->library("upload");
        $this->form_validation->set_error_delimiters('', '');
    }
    public function output_json($data, $encode = true)
    {
        if (!$encode) {
            goto cFftK;
        }
        $data = json_encode($data);
        cFftK:
        $this->output->set_content_type("application/json")->set_output($data);
    }
    public function index()
    {
        $this->load->model("Dashboard_model", "dashboard");
        $this->load->model("Cbt_model", "cbt");
        $this->load->model("Dropdown_model", "dropdown");
        $this->load->model("Kelas_model", "kelas");
        $user = $this->ion_auth->user()->row();
        $this->db->trans_start();
        $data = ["user" => $user, "judul" => "Hasil Ujian Siswa", "subjudul" => "Nilai Siswa", "setting" => $this->dashboard->getSetting()];
        $tp = $this->dashboard->getTahunActive();
        $smt = $this->dashboard->getSemesterActive();
        $data["tp"] = $this->dashboard->getTahun();
        $data["tp_active"] = $tp;
        $data["smt"] = $this->dashboard->getSemester();
        $data["smt_active"] = $smt;
        $data["ruang"] = $this->dropdown->getAllRuang();
        $data["sesi"] = $this->dropdown->getAllSesi();
        $kelas_selected = $this->input->get("kelas");
        $jadwal_selected = $this->input->get("jadwal");
        $data["kelas_selected"] = $kelas_selected;
        $ya = $this->input->get("ya");
        $yb = $this->input->get("yb");
        $xa = $this->input->get("xa");
        $xb = $this->input->get("xb");
        if ($this->ion_auth->in_group("guru")) {
            $guru = $this->dashboard->getDataGuruByUserId($user->id, $tp->id_tp, $smt->id_smt);
            $data["guru"] = $guru;
            $id_guru = $guru->id_guru;
            goto dxnIl;
        }
        $id_guru = null;
        dxnIl:
        if ($jadwal_selected != null) {
            $info = $this->cbt->getJadwalById($jadwal_selected);
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
            $siswas = $this->cbt->getSiswaByKelas($tp->id_tp, $smt->id_smt, $kelas_selected);
            $ids = [];
            foreach ($siswas as $key => $value) {
                array_push($ids, $value->id_siswa);
            }
            $jawabans = $this->cbt->getJawabanSiswaByJadwal($jadwal_selected, $ids);
            $soal = [];
            $jawabans_siswa = [];
            foreach ($jawabans as $jawaban_siswa) {
                if (!($jawaban_siswa->jenis_soal == "2")) {
                    goto kYAod;
                }
                $jawaban_siswa->opsi_a = @unserialize($jawaban_siswa->opsi_a);
                $jawaban_siswa->jawaban_siswa = @unserialize($jawaban_siswa->jawaban_siswa);
                $jawaban_siswa->jawaban_benar = @unserialize($jawaban_siswa->jawaban_benar);
                $jawaban_siswa->jawaban = @unserialize($jawaban_siswa->jawaban);
                $jawaban_siswa->jawaban_benar = array_map("strtoupper", $jawaban_siswa->jawaban_benar);
                $jawaban_siswa->jawaban = array_map("strtoupper", $jawaban_siswa->jawaban);
                $jawaban_siswa->jawaban_benar = array_filter($jawaban_siswa->jawaban_benar, "strlen");
                $jawaban_siswa->jawaban = array_filter($jawaban_siswa->jawaban, "strlen");
                kYAod:
                if (!($jawaban_siswa->jenis_soal == "3")) {
                    goto yFr6n;
                }
                $jawaban_siswa->jawaban_siswa = @unserialize($jawaban_siswa->jawaban_siswa);
                $jawaban_siswa->jawaban_benar = @unserialize($jawaban_siswa->jawaban_benar);
                $jawaban_siswa->jawaban = @unserialize($jawaban_siswa->jawaban);
                $jawaban_siswa->jawaban_siswa = json_decode(json_encode($jawaban_siswa->jawaban_siswa));
                $jawaban_siswa->jawaban_benar = json_decode(json_encode($jawaban_siswa->jawaban_benar));
                $jawaban_siswa->jawaban = json_decode(json_encode($jawaban_siswa->jawaban));
                yFr6n:
                $jawabans_siswa[$jawaban_siswa->id_siswa][$jawaban_siswa->jenis_soal][] = $jawaban_siswa;
                $soal[$jawaban_siswa->jenis_soal][] = $jawaban_siswa;
            }
            $durasies = $this->cbt->getDurasiSiswaByJadwal($jadwal_selected);
            $logs = $this->cbt->getLogUjianByJadwal($jadwal_selected);
            foreach ($siswas as $siswa) {
                $dur_siswa = '';
                $lamanya = '';
                foreach ($durasies as $durasi) {
                    if (!($durasi->id_siswa == $siswa->id_siswa)) {
                        goto Sjih_;
                    }
                    if ($durasi->lama_ujian == null) {
                        $mins = (strtotime($durasi->selesai) - strtotime($durasi->mulai)) / 60;
                        $dur_siswa = round($mins, 2) . " m";
                        goto c8dlT;
                    }
                    $lamanya = $durasi->lama_ujian;
                    if (strpos($lamanya, ":") !== false) {
                        $elap = explode(":", $lamanya);
                        $ed = $elap[2] == "00" ? 0 : 1;
                        $ej = $elap[0] == "00" ? '' : intval($elap[0]) . "j ";
                        $em = $elap[1] == "00" ? '' : intval($elap[1]) + $ed . "m";
                        $dd = $ej . $em;
                        $dur_siswa = $dd == '' ? "0 m" : $dd;
                        goto Lrkks;
                    }
                    $dur_siswa = $durasi->mulai . " m";
                    Lrkks:
                    c8dlT:
                    Sjih_:
                }
                $loading = '';
                $mulai = "- -  :  - -";
                $selesai = "- -  :  - -";
                foreach ($logs as $log) {
                    if (!($log->id_siswa == $siswa->id_siswa)) {
                        goto yaQSA;
                    }
                    $sudahMulai = false;
                    $sudahSelesai = false;
                    if ($log->log_type == "1") {
                        if (!($log != null)) {
                            goto m5KwL;
                        }
                        $mulai = date("H:i", strtotime($log->log_time));
                        $sudahMulai = true;
                        m5KwL:
                        goto vxLm6;
                    }
                    if (!($log != null)) {
                        goto CXg2H;
                    }
                    $selesai = date("H:i", strtotime($log->log_time));
                    $sudahSelesai = true;
                    CXg2H:
                    vxLm6:
                    $loading = $sudahSelesai ? "<i class=\"fa fa-check\"></i> " : ($sudahMulai ? "<i class=\"fa fa-spinner fa-spin\"></i> " : '');
                    yaQSA:
                }
                $siswa->mulai_ujian = $mulai;
                $siswa->selesai_ujian = $selesai;
                $siswa->lama_ujian = $loading . $dur_siswa;
                $siswa->durasi_ujian = $lamanya;
                $ada_jawaban = isset($jawabans_siswa[$siswa->id_siswa]);
                $ada_jawaban_pg = $ada_jawaban && isset($jawabans_siswa[$siswa->id_siswa]["1"]);
                $ada_jawaban_pg2 = $ada_jawaban && isset($jawabans_siswa[$siswa->id_siswa]["2"]);
                $ada_jawaban_jodoh = $ada_jawaban && isset($jawabans_siswa[$siswa->id_siswa]["3"]);
                $ada_jawaban_isian = $ada_jawaban && isset($jawabans_siswa[$siswa->id_siswa]["4"]);
                $ada_jawaban_essai = $ada_jawaban && isset($jawabans_siswa[$siswa->id_siswa]["5"]);
                $arrJawabanPg = [];
                $jawaban_pg = $ada_jawaban_pg ? $jawabans_siswa[$siswa->id_siswa]["1"] : [];
                $benar_pg = 0;
                $skor_pg = 0;
                if (!($info->tampil_pg > 0)) {
                    goto yTawM;
                }
                if (count($jawaban_pg) > 0) {
                    foreach ($jawaban_pg as $num => $jwb_pg) {
                        $benar = false;
                        if (!($jwb_pg != null && $jwb_pg->jawaban_siswa != null)) {
                            goto Bdu1N;
                        }
                        if (strtoupper($jwb_pg->jawaban_siswa) == strtoupper($jwb_pg->jawaban)) {
                            $benar_pg += 1;
                            $benar = true;
                            goto YRDVu;
                        }
                        $benar = false;
                        YRDVu:
                        Bdu1N:
                        $arrJawabanPg[$num] = ["jawaban" => strtoupper($jwb_pg->jawaban_siswa), "benar" => $benar];
                    }
                    goto gAMrr;
                }
                $n = 0;
                dbqXf:
                if (!($n < $info->tampil_pg)) {
                    gAMrr:
                    $skor_pg = $benar_pg / $bagi_pg * $bobot_pg;
                    yTawM:
                    $siswa->jawaban_pg = $arrJawabanPg;
                    $siswa->skor_pg = round($skor_pg, 2);
                    $nilai_input = $this->cbt->getNilaiSiswaByJadwal($jadwal_selected, $siswa->id_siswa);
                    if (!($nilai_input != null)) {
                        goto Ifnes;
                    }
                    $siswa->dikoreksi = $nilai_input->dikoreksi;
                    Ifnes:
                    $jawaban_pg2 = $ada_jawaban_pg2 ? $jawabans_siswa[$siswa->id_siswa]["2"] : [];
                    $benar_pg2 = 0;
                    $skor_koreksi_pg2 = 0.0;
                    $otomatis_pg2 = 0;
                    if (!($info->tampil_kompleks > 0)) {
                        goto hKPCw;
                    }
                    foreach ($jawaban_pg2 as $num => $jawab_pg2) {
                        $skor_koreksi_pg2 += $jawab_pg2->nilai_koreksi;
                        $arr_benar = [];
                        if (!$jawab_pg2->jawaban_siswa) {
                            goto j81j2;
                        }
                        foreach ($jawab_pg2->jawaban_siswa as $js) {
                            if (!in_array($js, $jawab_pg2->jawaban)) {
                                goto AEZoZ;
                            }
                            array_push($arr_benar, true);
                            AEZoZ:
                        }
                        j81j2:
                        if (!(count($jawab_pg2->jawaban) > 0)) {
                            goto KAdug;
                        }
                        $benar_pg2 += 1 / count($jawab_pg2->jawaban) * count($arr_benar);
                        KAdug:
                        $point_benar = $info->bobot_kompleks > 0 ? round($info->bobot_kompleks / $info->tampil_kompleks, 2) : 0;
                        $point_item = count($jawab_pg2->jawaban) > 0 ? $point_benar / count($jawab_pg2->jawaban) : 0;
                        $pk = $point_item * count($arr_benar);
                        $ks = array_search($jawab_pg2->nomor_soal, array_column($soal[2], "nomor_soal"));
                        $point = round($pk, 2);
                        if ($jawab_pg2->nilai_otomatis == "0") {
                            $soal[2][$ks]->point = $point;
                            goto VHnUU;
                        }
                        $soal[2][$ks]->point = $jawab_pg2->nilai_koreksi;
                        VHnUU:
                        $soal[2][$ks]->point_koreksi = $jawab_pg2->nilai_koreksi;
                        $soal[2][$ks]->point_otomatis = $point;
                        $otomatis_pg2 = $jawab_pg2->nilai_otomatis;
                    }
                    hKPCw:
                    $s_pg2 = $bagi_pg2 == 0 ? 0 : $benar_pg2 / $bagi_pg2 * $bobot_pg2;
                    $input_pg2 = 0;
                    if (!($nilai_input != null && $nilai_input->kompleks_nilai != null)) {
                        goto AZOjo;
                    }
                    $input_pg2 = $nilai_input->kompleks_nilai;
                    AZOjo:
                    $skor_pg2 = $input_pg2 != 0 ? $input_pg2 : ($otomatis_pg2 == 0 ? $s_pg2 : $skor_koreksi_pg2);
                    $siswa->skor_kompleks = round($skor_pg2, 2);
                    $jawaban_jodoh = $ada_jawaban_jodoh ? $jawabans_siswa[$siswa->id_siswa]["3"] : [];
                    $skor_koreksi_jod = 0.0;
                    $otomatis_jod = 0;
                    $benar_jod = 0;
                    if (!($info->tampil_jodohkan > 0)) {
                        goto v7ZL7;
                    }
                    foreach ($jawaban_jodoh as $num => $jawab_jod) {
                        $skor_koreksi_jod += $jawab_jod->nilai_koreksi;
                        $typeSoal = $jawab_jod->jawaban->type;
                        $arrSoal = $jawab_jod->jawaban->jawaban;
                        $headSoal = array_shift($arrSoal);
                        $arrJwbSoal = [];
                        $items = 0;
                        foreach ($arrSoal as $kolSoal) {
                            $jwb = new stdClass();
                            foreach ($kolSoal as $pos => $kol) {
                                if (!($kol == "1")) {
                                    goto J_5HE;
                                }
                                $jwb->subtitle[] = $headSoal[$pos];
                                $items++;
                                J_5HE:
                            }
                            $jwb->title = array_shift($kolSoal);
                            array_push($arrJwbSoal, $jwb);
                        }
                        $ks = array_search($jawab_jod->nomor_soal, array_column($soal[3], "nomor_soal"));
                        $soal[3][$ks]->type_soal = $typeSoal;
                        $soal[3][$ks]->tabel_soal = $arrJwbSoal;
                        $arrJawab = [];
                        if (!isset($jawab_jod->jawaban_siswa->jawaban)) {
                            goto kjwaO;
                        }
                        $arrJawab = $jawab_jod->jawaban_siswa->jawaban;
                        $headJawab = array_shift($arrJawab);
                        kjwaO:
                        $arrJwbJawab = [];
                        foreach ($arrJawab as $kolJawab) {
                            $jwbs = new stdClass();
                            foreach ($kolJawab as $po => $kol) {
                                if (!($kol == "1")) {
                                    goto U0s2R;
                                }
                                $sub = $headJawab[$po];
                                $jwbs->subtitle[] = $sub;
                                U0s2R:
                            }
                            $jwbs->title = array_shift($kolJawab);
                            array_push($arrJwbJawab, $jwbs);
                        }
                        $soal[3][$ks]->tabel_jawab = $arrJwbJawab;
                        $arrBenar = [];
                        $item_benar = 0;
                        $item_salah = 0;
                        $item_lebih = 0;
                        foreach ($arrJwbJawab as $p => $ajjs) {
                            $ll = 0;
                            $bb = 0;
                            $ss = 0;
                            $arrBenar[$p] = new stdClass();
                            if (!isset($ajjs->subtitle)) {
                                goto eqTac;
                            }
                            foreach ($ajjs->subtitle as $pp => $ajs) {
                                if (!(isset($arrJwbSoal[$p]) && !isset($arrJwbSoal[$p]->subtitle[$pp]))) {
                                    goto yGnY_;
                                }
                                $ll++;
                                $arrBenar[$p]->lebih = $ll;
                                $item_lebih++;
                                yGnY_:
                                if (!(isset($arrJwbSoal[$p]) && isset($arrJwbSoal[$p]->subtitle))) {
                                    goto vZaW7;
                                }
                                if (in_array($ajs, $arrJwbSoal[$p]->subtitle)) {
                                    $bb++;
                                    $arrBenar[$p]->benar = $bb;
                                    $item_benar++;
                                    goto uS30q;
                                }
                                $ss++;
                                $arrBenar[$p]->salah = $ss;
                                $item_salah++;
                                uS30q:
                                vZaW7:
                            }
                            eqTac:
                        }
                        $benar_jod += 1 / $items * $item_benar;
                        $point_benar = $info->bobot_jodohkan > 0 ? round($info->bobot_jodohkan / $info->tampil_jodohkan, 2) : 0;
                        $point_item = $point_benar / count($arrSoal);
                        $item_kurang = 0;
                        $point_soal = 0;
                        foreach ($arrJwbSoal as $ps => $ajj) {
                            if (!isset($ajj->subtitle)) {
                                goto Z3cDZ;
                            }
                            $point_subitem = $point_item / count((array) $ajj->subtitle);
                            if (!isset($arrBenar[$ps]->benar)) {
                                goto bMG4K;
                            }
                            $point_soal += $point_subitem * $arrBenar[$ps]->benar;
                            bMG4K:
                            $kk = 0;
                            foreach ($ajj->subtitle as $pps => $aj) {
                                if (!(isset($arrJwbJawab[$ps]) && !isset($arrJwbJawab[$ps]->subtitle[$pps]))) {
                                    goto pq0fJ;
                                }
                                $kk++;
                                $arrBenar[$ps]->kurang = $kk;
                                $item_kurang++;
                                pq0fJ:
                            }
                            Z3cDZ:
                        }
                        $soal[3][$ks]->tabel_benar = $arrBenar;
                        $soal[3][$ks]->point_soal = $point_soal;
                        $point = round($point_soal, 2);
                        if ($jawab_jod->nilai_otomatis == "0") {
                            $soal[3][$ks]->point = $point;
                            goto s8yQ5;
                        }
                        $soal[3][$ks]->point = $jawab_jod->nilai_koreksi;
                        s8yQ5:
                        $soal[3][$ks]->point_koreksi = $jawab_jod->nilai_koreksi;
                        $soal[3][$ks]->point_otomatis = $point;
                        $otomatis_jod = $jawab_jod->nilai_otomatis;
                    }
                    v7ZL7:
                    $s_jod = $bagi_jodoh == 0 ? 0 : $benar_jod / $bagi_jodoh * $bobot_jodoh;
                    $input_jod = 0;
                    if (!($nilai_input != null && $nilai_input->jodohkan_nilai != null)) {
                        goto EBqh1;
                    }
                    $input_jod = $nilai_input->jodohkan_nilai;
                    EBqh1:
                    $skor_jod = $input_jod != 0 ? $input_jod : ($otomatis_jod == 0 ? $s_jod : $skor_koreksi_jod);
                    $siswa->skor_jodohkan = round($skor_jod, 2);
                    $jawaban_is = $ada_jawaban_isian ? $jawabans_siswa[$siswa->id_siswa]["4"] : [];
                    $skor_koreksi_is = 0.0;
                    $otomatis_is = 0;
                    $benar_is = 0;
                    if (!($info->tampil_isian > 0)) {
                        goto GiKxl;
                    }
                    foreach ($jawaban_is as $num => $jawab_is) {
                        $skor_koreksi_is += $jawab_is->nilai_koreksi;
                        $benar = $jawab_is != null && strtolower($jawab_is->jawaban_siswa) == strtolower($jawab_is->jawaban);
                        if (!$benar) {
                            goto Kijl9;
                        }
                        $benar_is++;
                        Kijl9:
                        $ks = array_search($jawab_is->nomor_soal, array_column($soal[4], "nomor_soal"));
                        $point = !$benar ? 0 : ($info->bobot_isian > 0 ? round($info->bobot_isian / $info->tampil_isian, 2) : 0);
                        if ($jawab_is->nilai_otomatis == "0") {
                            $soal[4][$ks]->point = $point;
                            goto iDPhr;
                        }
                        $soal[4][$ks]->point = $jawab_is->nilai_koreksi;
                        iDPhr:
                        $soal[4][$ks]->point_koreksi = $jawab_is->nilai_koreksi;
                        $soal[4][$ks]->point_otomatis = $point;
                        $otomatis_is = $jawab_is->nilai_otomatis;
                    }
                    GiKxl:
                    $s_is = $bagi_isian == 0 ? 0 : $benar_is / $bagi_isian * $bobot_isian;
                    $input_is = 0;
                    if (!($nilai_input != null && $nilai_input->isian_nilai != null)) {
                        goto akWPL;
                    }
                    $input_is = $nilai_input->isian_nilai;
                    akWPL:
                    $skor_is = $input_is != 0 ? $input_is : ($otomatis_is == 0 ? $s_is : $skor_koreksi_is);
                    $siswa->skor_isian = round($skor_is, 2);
                    $jawaban_es = $ada_jawaban_essai ? $jawabans_siswa[$siswa->id_siswa]["5"] : [];
                    $skor_koreksi_es = 0.0;
                    $otomatis_es = 0;
                    $benar_es = 0;
                    if (!($info->tampil_esai > 0)) {
                        goto ezab5;
                    }
                    foreach ($jawaban_es as $num => $jawab_es) {
                        $skor_koreksi_es += (int) $jawab_es->nilai_koreksi;
                        $benar = $jawab_es != null && strtolower($jawab_es->jawaban_siswa) == strtolower($jawab_es->jawaban);
                        if (!$benar) {
                            goto FgBqB;
                        }
                        $benar_es++;
                        FgBqB:
                        $ks = array_search($jawab_es->nomor_soal, array_column($soal[5], "nomor_soal"));
                        $point = !$benar ? 0 : ($info->bobot_esai > 0 ? round($info->bobot_esai / $info->tampil_esai, 2) : 0);
                        if ($jawab_es->nilai_otomatis == "0") {
                            $soal[5][$ks]->point = $point;
                            goto CPwbC;
                        }
                        $soal[5][$ks]->point = $jawab_es->nilai_koreksi;
                        CPwbC:
                        $soal[5][$ks]->point_koreksi = $jawab_es->nilai_koreksi;
                        $soal[5][$ks]->point_otomatis = $point;
                        $otomatis_es = $jawab_es->nilai_otomatis;
                    }
                    ezab5:
                    $s_es = $bagi_essai == 0 ? 0 : $benar_es / $bagi_essai * $bobot_essai;
                    $input_es = 0;
                    if (!($nilai_input != null && $nilai_input->isian_nilai != null)) {
                        goto icCkt;
                    }
                    $input_es = $nilai_input->essai_nilai;
                    icCkt:
                    $skor_es = $input_es != 0 ? $input_es : ($otomatis_es == 0 ? $s_es : $skor_koreksi_es);
                    $siswa->skor_essai = round($skor_es, 2);
                    $total = $skor_pg + $skor_pg2 + $skor_jod + $skor_is + $skor_es;
                    $siswa->skor_total = round($total, 2);
                    if ($ya != null) {
                        if (!($total > $xa)) {
                            goto h1FrH;
                        }
                        $xa = $total;
                        h1FrH:
                        if (!($total < $xb)) {
                            goto Awpcc;
                        }
                        $xb = $total;
                        Awpcc:
                        $siswa->skor_katrol = round(($ya - $yb) / 100 * $total + $yb, 2);
                        goto Kod2t;
                    }
                    $siswa->skor_katrol = '';
                    Kod2t:
                }
                $arrJawabanPg[$n + 1] = ["jawaban" => '', "benar" => false];
                $n++;
                goto dbqXf;
            }
            $data["info"] = $info;
            $data["siswas"] = $siswas;
            if (!($ya != null)) {
                goto o7ivC;
            }
            $convert = ["ya" => $ya, "yb" => $yb, "xa" => $xa, "xb" => $xb];
            $data["convert"] = $convert;
            o7ivC:
            $kelas_bank = unserialize($info->bank_kelas);
            $kelases = [];
            foreach ($kelas_bank as $key => $value) {
                if (!($value["kelas_id"] != '')) {
                    goto GQanG;
                }
                $kelases[$value["kelas_id"]] = $this->dropdown->getNamaKelasById($tp->id_tp, $smt->id_smt, $value["kelas_id"]);
                GQanG:
            }
            $jadwals = $this->cbt->getAllJadwal($tp->id_tp, $smt->id_smt, $id_guru);
            $jdwl = [];
            foreach ($jadwals as $jadwal) {
                $kls = unserialize($jadwal->bank_kelas);
                foreach ($kls as $kl) {
                    if (!($kl["kelas_id"] == $kelas_selected)) {
                        goto SFWyZ;
                    }
                    $jdwl[$jadwal->id_jadwal] = $jadwal->bank_kode;
                    SFWyZ:
                }
            }
            $data["jadwal"] = $jdwl;
            goto R1Rpg;
        }
        $data["jadwal"] = [];
        $data["siswas"] = [];
        R1Rpg:
        $this->db->trans_complete();
        if ($this->ion_auth->is_admin()) {
            $data["profile"] = $this->dashboard->getProfileAdmin($user->id);
            $data["jadwal_selected"] = $jadwal_selected;
            $data["kelas"] = $this->dropdown->getAllKelas($tp->id_tp, $smt->id_smt);
            $this->load->view("_templates/dashboard/_header", $data);
            $this->load->view("cbt/nilai/data");
            $this->load->view("_templates/dashboard/_footer");
            goto EDYef;
        }
        $mapel_guru = $this->kelas->getGuruMapelKelas($id_guru, $tp->id_tp, $smt->id_smt);
        $mapel = json_decode(json_encode(unserialize($mapel_guru->mapel_kelas)));
        $data["jadwal_selected"] = $jadwal_selected;
        $arrKelas = [];
        if (!($mapel != null)) {
            goto GUblq;
        }
        foreach ($mapel as $m) {
            $arrMapel[$m->id_mapel] = $m->nama_mapel;
            foreach ($m->kelas_mapel as $kls) {
                if (!$kls->kelas) {
                    goto men0a;
                }
                $arrKelas[$kls->kelas] = $this->dropdown->getNamaKelasById($tp->id_tp, $smt->id_smt, $kls->kelas);
                men0a:
            }
        }
        GUblq:
        $data["kelas"] = $arrKelas;
        $this->load->view("members/guru/templates/header", $data);
        $this->load->view("cbt/nilai/data");
        $this->load->view("members/guru/templates/footer");
        EDYef:
    }
    public function detail()
    {
        $this->load->model("Cbt_model", "cbt");
        $this->load->model("Dashboard_model", "dashboard");
        $tp = $this->dashboard->getTahunActive();
        $smt = $this->dashboard->getSemesterActive();
        $siswa = $this->cbt->getSiswaById($tp->id_tp, $smt->id_smt, $this->input->get("siswa"));
        $jadwal = $this->input->get("jadwal");
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
        $jawabans = $this->cbt->getJawabanSiswaByJadwal($jadwal, $siswa->id_siswa);
        $soal = [];
        $jawabans_siswa = [];
        foreach ($jawabans as $jawaban_siswa) {
            if (!($jawaban_siswa->jenis_soal == "2")) {
                goto n2x2h;
            }
            $jawaban_siswa->opsi_a = @unserialize($jawaban_siswa->opsi_a);
            $jawaban_siswa->jawaban_siswa = @unserialize($jawaban_siswa->jawaban_siswa);
            $jawaban_siswa->jawaban_benar = @unserialize($jawaban_siswa->jawaban_benar);
            $jawaban_siswa->jawaban = @unserialize($jawaban_siswa->jawaban);
            $jawaban_siswa->jawaban_benar = array_map("strtoupper", $jawaban_siswa->jawaban_benar);
            $jawaban_siswa->jawaban_benar = array_filter($jawaban_siswa->jawaban_benar, "strlen");
            $jawaban_siswa->jawaban = array_map("strtoupper", $jawaban_siswa->jawaban);
            $jawaban_siswa->jawaban = array_filter($jawaban_siswa->jawaban, "strlen");
            n2x2h:
            if (!($jawaban_siswa->jenis_soal == "3")) {
                goto Q_ole;
            }
            $jawaban_siswa->jawaban_siswa = @unserialize($jawaban_siswa->jawaban_siswa);
            $jawaban_siswa->jawaban_benar = @unserialize($jawaban_siswa->jawaban_benar);
            $jawaban_siswa->jawaban = @unserialize($jawaban_siswa->jawaban);
            $jawaban_siswa->jawaban_siswa = json_decode(json_encode($jawaban_siswa->jawaban_siswa));
            $jawaban_siswa->jawaban_benar = json_decode(json_encode($jawaban_siswa->jawaban_benar));
            $jawaban_siswa->jawaban = json_decode(json_encode($jawaban_siswa->jawaban));
            Q_ole:
            $jawabans_siswa[$jawaban_siswa->id_siswa][$jawaban_siswa->jenis_soal][] = $jawaban_siswa;
            $soal[$jawaban_siswa->jenis_soal][] = $jawaban_siswa;
        }
        $ada_jawaban = isset($jawabans_siswa[$siswa->id_siswa]);
        $ada_jawaban_pg = $ada_jawaban && isset($jawabans_siswa[$siswa->id_siswa]["1"]);
        $ada_jawaban_pg2 = $ada_jawaban && isset($jawabans_siswa[$siswa->id_siswa]["2"]);
        $ada_jawaban_jodoh = $ada_jawaban && isset($jawabans_siswa[$siswa->id_siswa]["3"]);
        $ada_jawaban_isian = $ada_jawaban && isset($jawabans_siswa[$siswa->id_siswa]["4"]);
        $ada_jawaban_essai = $ada_jawaban && isset($jawabans_siswa[$siswa->id_siswa]["5"]);
        $skor = new stdClass();
        $nilai_input = $this->cbt->getNilaiSiswaByJadwal($jadwal, $siswa->id_siswa);
        if (!($nilai_input != null)) {
            goto SQLbZ;
        }
        $skor->dikoreksi = $nilai_input->dikoreksi;
        SQLbZ:
        $jawaban_pg = $ada_jawaban_pg ? $jawabans_siswa[$siswa->id_siswa]["1"] : [];
        $benar_pg = 0;
        $salah_pg = 0;
        if (!($info->tampil_pg > 0)) {
            goto BFddT;
        }
        if (!(count($jawaban_pg) > 0)) {
            goto ofmJN;
        }
        foreach ($jawaban_pg as $num => $jwb_pg) {
            $benar = false;
            if (!($jwb_pg != null && $jwb_pg->jawaban_siswa != null)) {
                goto kLYpw;
            }
            if (strtoupper($jwb_pg->jawaban_siswa) == strtoupper($jwb_pg->jawaban)) {
                $benar_pg += 1;
                $benar = true;
                goto oD8PB;
            }
            $salah_pg += 1;
            $benar = false;
            oD8PB:
            kLYpw:
            $ks = array_search($jwb_pg->nomor_soal, array_column($soal[1], "nomor_soal"));
            $soal[1][$ks]->point = !$benar ? 0 : ($info->bobot_pg > 0 ? round($info->bobot_pg / $info->tampil_pg, 2) : 0);
            $analisa = $benar ? "<i class=\"fa fa-check-circle text-green text-lg\"></i>" : "<i class=\"fa fa-times-circle text-red text-lg\"></i>";
            $soal[1][$ks]->analisa = $analisa;
        }
        ofmJN:
        BFddT:
        $skor->skor_pg = $skor_pg = $bagi_pg == 0 ? 0 : $benar_pg / $bagi_pg * $bobot_pg;
        $jawaban_pg2 = $ada_jawaban_pg2 ? $jawabans_siswa[$siswa->id_siswa]["2"] : [];
        $benar_pg2 = 0;
        $skor_koreksi_pg2 = 0.0;
        $otomatis_pg2 = 0;
        if (!($info->tampil_kompleks > 0)) {
            goto Qbt_e;
        }
        if (!(count($jawaban_pg2) > 0)) {
            goto yNxEp;
        }
        foreach ($jawaban_pg2 as $num => $jawab_pg2) {
            $skor_koreksi_pg2 += $jawab_pg2->nilai_koreksi;
            $arr_benar = [];
            if (!$jawab_pg2->jawaban_siswa) {
                goto jof98;
            }
            foreach ($jawab_pg2->jawaban_siswa as $js) {
                if (!in_array($js, $jawab_pg2->jawaban)) {
                    goto sQbg2;
                }
                array_push($arr_benar, true);
                sQbg2:
            }
            jof98:
            if (!(count($jawab_pg2->jawaban) > 0)) {
                goto AzeiO;
            }
            $benar_pg2 += 1 / count($jawab_pg2->jawaban) * count($arr_benar);
            AzeiO:
            $point_benar = $info->bobot_kompleks > 0 ? round($info->bobot_kompleks / $info->tampil_kompleks, 2) : 0;
            $point_item = count($jawab_pg2->jawaban) > 0 ? $point_benar / count($jawab_pg2->jawaban) : 0;
            $pk = $point_item * count($arr_benar);
            $jml_benar = count($arr_benar);
            if ($jml_benar == count($jawab_pg2->jawaban)) {
                $analisa = "<i class=\"fa fa-check-circle text-green text-lg\"></i>";
                goto pjRVT;
            }
            if ($jml_benar > 0 && $jml_benar < count($jawab_pg2->jawaban)) {
                $analisa = "<i class=\"fa fa-times-circle text-yellow text-lg\"></i>";
                goto nqc9M;
            }
            $analisa = "<i class=\"fa fa-times-circle text-red text-lg\"></i>";
            nqc9M:
            pjRVT:
            $ks = array_search($jawab_pg2->nomor_soal, array_column($soal[2], "nomor_soal"));
            $point = round($pk, 2);
            $soal[2][$ks]->analisa = $analisa;
            if ($jawab_pg2->nilai_otomatis == "0") {
                $soal[2][$ks]->point = $point;
                goto t3euY;
            }
            $soal[2][$ks]->point = $jawab_pg2->nilai_koreksi;
            t3euY:
            $soal[2][$ks]->point_koreksi = $jawab_pg2->nilai_koreksi;
            $soal[2][$ks]->point_otomatis = $point;
            $otomatis_pg2 = $jawab_pg2->nilai_otomatis;
        }
        yNxEp:
        Qbt_e:
        $s_pg2 = $bagi_pg2 == 0 ? 0 : $benar_pg2 / $bagi_pg2 * $bobot_pg2;
        $input_pg2 = 0;
        if (!($nilai_input != null && $nilai_input->kompleks_nilai != null)) {
            goto ZL8i0;
        }
        $input_pg2 = $nilai_input->kompleks_nilai;
        ZL8i0:
        $skor_pg2 = $input_pg2 != 0 ? $input_pg2 : ($otomatis_pg2 == 0 ? $s_pg2 : $skor_koreksi_pg2);
        $skor->skor_kompleks = $skor_pg2;
        $jawaban_jodoh = $ada_jawaban_jodoh ? $jawabans_siswa[$siswa->id_siswa]["3"] : [];
        $benar_jod = 0;
        $skor_koreksi_jod = 0.0;
        $otomatis_jod = 0;
        if (!($info->tampil_jodohkan > 0)) {
            goto AMmeu;
        }
        if (!(count($jawaban_jodoh) > 0)) {
            goto v03Mq;
        }
        foreach ($jawaban_jodoh as $num => $jawab_jod) {
            $skor_koreksi_jod += $jawab_jod->nilai_koreksi;
            $typeSoal = $jawab_jod->jawaban->type;
            $arrSoal = $jawab_jod->jawaban->jawaban;
            $headSoal = array_shift($arrSoal);
            $arrJwbSoal = [];
            $items = 0;
            foreach ($arrSoal as $kolSoal) {
                $jwb = new stdClass();
                foreach ($kolSoal as $pos => $kol) {
                    if (!($kol == "1")) {
                        goto xT45j;
                    }
                    $jwb->subtitle[] = $headSoal[$pos];
                    $items++;
                    xT45j:
                }
                $jwb->title = array_shift($kolSoal);
                array_push($arrJwbSoal, $jwb);
            }
            $ks = array_search($jawab_jod->nomor_soal, array_column($soal[3], "nomor_soal"));
            $soal[3][$ks]->type_soal = $typeSoal;
            $soal[3][$ks]->tabel_soal = $arrJwbSoal;
            $arrJawab = [];
            if (!isset($jawab_jod->jawaban_siswa->jawaban)) {
                goto iXKYq;
            }
            $arrJawab = $jawab_jod->jawaban_siswa->jawaban;
            $headJawab = array_shift($arrJawab);
            iXKYq:
            $arrJwbJawab = [];
            foreach ($arrJawab as $kolJawab) {
                $jwbs = new stdClass();
                foreach ($kolJawab as $po => $kol) {
                    if (!($kol == "1")) {
                        goto MbHQb;
                    }
                    $sub = $headJawab[$po];
                    $jwbs->subtitle[] = $sub;
                    MbHQb:
                }
                $jwbs->title = array_shift($kolJawab);
                array_push($arrJwbJawab, $jwbs);
            }
            $soal[3][$ks]->tabel_jawab = $arrJwbJawab;
            $arrBenar = [];
            $item_benar = 0;
            $item_salah = 0;
            $item_lebih = 0;
            foreach ($arrJwbJawab as $p => $ajjs) {
                $ll = 0;
                $bb = 0;
                $ss = 0;
                $arrBenar[$p] = new stdClass();
                if (!isset($ajjs->subtitle)) {
                    goto guZxS;
                }
                foreach ($ajjs->subtitle as $pp => $ajs) {
                    if (!(isset($arrJwbSoal[$p]) && !isset($arrJwbSoal[$p]->subtitle[$pp]))) {
                        goto Tfh7W;
                    }
                    $ll++;
                    $arrBenar[$p]->lebih = $ll;
                    $item_lebih++;
                    Tfh7W:
                    if (!(isset($arrJwbSoal[$p]) && isset($arrJwbSoal[$p]->subtitle))) {
                        goto gCxGR;
                    }
                    if (in_array($ajs, $arrJwbSoal[$p]->subtitle)) {
                        $bb++;
                        $arrBenar[$p]->benar = $bb;
                        $item_benar++;
                        goto xpYyx;
                    }
                    $ss++;
                    $arrBenar[$p]->salah = $ss;
                    $item_salah++;
                    xpYyx:
                    gCxGR:
                }
                guZxS:
            }
            $benar_jod += 1 / $items * $item_benar;
            $point_benar = $info->bobot_jodohkan > 0 ? round($info->bobot_jodohkan / $info->tampil_jodohkan, 2) : 0;
            $point_item = $point_benar / count($arrSoal);
            $item_kurang = 0;
            $point_soal = 0;
            foreach ($arrJwbSoal as $ps => $ajj) {
                if (!isset($ajj->subtitle)) {
                    goto SbN1M;
                }
                $point_subitem = $point_item / count((array) $ajj->subtitle);
                if (!isset($arrBenar[$ps]->benar)) {
                    goto zDBzy;
                }
                $point_soal += $point_subitem * $arrBenar[$ps]->benar;
                zDBzy:
                $kk = 0;
                foreach ($ajj->subtitle as $pps => $aj) {
                    if (!(isset($arrJwbJawab[$ps]) && !isset($arrJwbJawab[$ps]->subtitle[$pps]))) {
                        goto Sp0WQ;
                    }
                    $kk++;
                    $arrBenar[$ps]->kurang = $kk;
                    $item_kurang++;
                    Sp0WQ:
                }
                SbN1M:
            }
            $soal[3][$ks]->tabel_benar = $arrBenar;
            $soal[3][$ks]->point_soal = $point_soal;
            $point = round($point_soal, 2);
            if ($jawab_jod->nilai_otomatis == "0") {
                $soal[3][$ks]->point = $point;
                goto jyOCO;
            }
            $soal[3][$ks]->point = $jawab_jod->nilai_koreksi;
            jyOCO:
            $soal[3][$ks]->point_koreksi = $jawab_jod->nilai_koreksi;
            $soal[3][$ks]->point_otomatis = $point;
            if ($item_benar == $items && $item_salah == 0 && $item_lebih == 0 && $item_kurang == 0) {
                $analisa = "<i class=\"fa fa-check-circle text-green text-lg\"></i>";
                goto XtaKu;
            }
            if ($item_benar == 0) {
                $analisa = "<i class=\"fa fa-times-circle text-red text-lg\"></i>";
                goto PIgNQ;
            }
            $analisa = "<i class=\"fa fa-times-circle text-yellow text-lg\"></i>";
            PIgNQ:
            XtaKu:
            $soal[3][$ks]->analisa = $analisa;
            $otomatis_jod = $jawab_jod->nilai_otomatis;
        }
        v03Mq:
        AMmeu:
        $s_jod = $bagi_jodoh == 0 ? 0 : $benar_jod / $bagi_jodoh * $bobot_jodoh;
        $input_jod = 0;
        if (!($nilai_input != null && $nilai_input->jodohkan_nilai != null)) {
            goto bgJ1l;
        }
        $input_jod = $nilai_input->jodohkan_nilai;
        bgJ1l:
        $skor_jod = $input_jod != 0 ? $input_jod : ($otomatis_jod == 0 ? $s_jod : $skor_koreksi_jod);
        $skor->skor_jodohkan = $skor_jod;
        $jawaban_is = $ada_jawaban_isian ? $jawabans_siswa[$siswa->id_siswa]["4"] : [];
        $benar_is = 0;
        $skor_koreksi_is = 0.0;
        $otomatis_is = 0;
        if (!($info->tampil_isian > 0)) {
            goto mYdLV;
        }
        if (!(count($jawaban_is) > 0)) {
            goto nnXY2;
        }
        foreach ($jawaban_is as $num => $jawab_is) {
            $skor_koreksi_is += $jawab_is->nilai_koreksi;
            $benar = $jawab_is != null && strtolower($jawab_is->jawaban_siswa) == strtolower($jawab_is->jawaban);
            if (!$benar) {
                goto fgJQx;
            }
            $benar_is++;
            fgJQx:
            $ks = array_search($jawab_is->nomor_soal, array_column($soal[4], "nomor_soal"));
            $point = !$benar ? 0 : ($info->bobot_isian > 0 ? round($info->bobot_isian / $info->tampil_isian, 2) : 0);
            if ($jawab_is->nilai_otomatis == "0") {
                $soal[4][$ks]->point = $point;
                goto tw9S6;
            }
            $soal[4][$ks]->point = $jawab_is->nilai_koreksi;
            tw9S6:
            $soal[4][$ks]->point_koreksi = $jawab_is->nilai_koreksi;
            $soal[4][$ks]->point_otomatis = $point;
            if ($benar) {
                $analisa = "<i class=\"fa fa-check-circle text-green text-lg\"></i>";
                goto MLipY;
            }
            $analisa = "<i class=\"fa fa-times-circle text-yellow text-lg\"></i>";
            MLipY:
            $soal[4][$ks]->analisa = $analisa;
            $otomatis_is = $jawab_is->nilai_otomatis;
        }
        nnXY2:
        mYdLV:
        $s_is = $bagi_isian == 0 ? 0 : $benar_is / $bagi_isian * $bobot_isian;
        $input_is = 0;
        if (!($nilai_input != null && $nilai_input->isian_nilai != null)) {
            goto Kny4M;
        }
        $input_is = $nilai_input->isian_nilai;
        Kny4M:
        $skor_is = $input_is != 0 ? $input_is : ($otomatis_is == 0 ? $s_is : $skor_koreksi_is);
        $skor->skor_isian = $skor_is;
        $jawaban_es = $ada_jawaban_essai ? $jawabans_siswa[$siswa->id_siswa]["5"] : [];
        $benar_es = 0;
        $skor_koreksi_es = 0.0;
        $otomatis_es = 0;
        if (!($info->tampil_esai > 0)) {
            goto dkm_Q;
        }
        if (!(count($jawaban_es) > 0)) {
            goto ldtoR;
        }
        foreach ($jawaban_es as $num => $jawab_es) {
            $skor_koreksi_es += $jawab_es->nilai_koreksi;
            $benar = $jawab_es != null && strtolower($jawab_es->jawaban_siswa) == strtolower($jawab_es->jawaban);
            if (!$benar) {
                goto ATCY6;
            }
            $benar_es++;
            ATCY6:
            $ks = array_search($jawab_es->nomor_soal, array_column($soal[5], "nomor_soal"));
            $point = !$benar ? 0 : ($info->bobot_esai > 0 ? round($info->bobot_esai / $info->tampil_esai, 2) : 0);
            if ($jawab_es->nilai_otomatis == "0") {
                $soal[5][$ks]->point = $point;
                goto tME8O;
            }
            $soal[5][$ks]->point = $jawab_es->nilai_koreksi;
            tME8O:
            $soal[5][$ks]->point_koreksi = $jawab_es->nilai_koreksi;
            $soal[5][$ks]->point_otomatis = $point;
            if ($benar) {
                $analisa = "<i class=\"fa fa-check-circle text-green text-lg\"></i>";
                goto PXPlg;
            }
            $analisa = "<i class=\"fa fa-times-circle text-yellow text-lg\"></i>";
            PXPlg:
            $soal[5][$ks]->analisa = $analisa;
            $otomatis_es = $jawab_es->nilai_otomatis;
        }
        ldtoR:
        dkm_Q:
        $s_es = $bagi_essai == 0 ? 0 : $benar_es / $bagi_essai * $bobot_essai;
        $input_es = 0;
        if (!($nilai_input != null && $nilai_input->isian_nilai != null)) {
            goto GTBMm;
        }
        $input_es = $nilai_input->essai_nilai;
        GTBMm:
        $skor_es = $input_es != 0 ? $input_es : ($otomatis_es == 0 ? $s_es : $skor_koreksi_es);
        $skor->skor_essai = $skor_es;
        $total = $skor_pg + $skor_pg2 + $skor_jod + $skor_is + $skor_es;
        $skor->skor_total = $total;
        $durasies = $this->cbt->getDurasiSiswaByJadwal($jadwal);
        $logs = $this->cbt->getLogUjianByJadwal($jadwal);
        $dur_siswa = null;
        foreach ($durasies as $durasi) {
            if (!($durasi->id_siswa == $siswa->id_siswa)) {
                goto M5pMO;
            }
            $dur_siswa = $durasi;
            M5pMO:
        }
        $log_siswa = [];
        foreach ($logs as $log) {
            if (!($log->id_siswa == $siswa->id_siswa)) {
                goto AbvUR;
            }
            array_push($log_siswa, $log);
            AbvUR:
        }
        $user = $this->ion_auth->user()->row();
        $data = ["user" => $user, "judul" => "Koreksi Hasil Siswa", "subjudul" => "Hasil Siswa", "setting" => $this->dashboard->getSetting(), "durasi" => $dur_siswa, "log" => $log_siswa];
        $data["tp"] = $this->dashboard->getTahun();
        $data["tp_active"] = $tp;
        $data["smt"] = $this->dashboard->getSemester();
        $data["smt_active"] = $smt;
        $data["info"] = $info;
        $data["siswa"] = $siswa;
        $data["soal"] = $soal;
        $data["skor"] = $skor;
        $nilai_siswa = $this->cbt->getNilaiSiswaByJadwal($jadwal, $siswa->id_siswa);
        $data["ada_nilai"] = $nilai_siswa != null;
        if ($this->ion_auth->is_admin()) {
            $data["profile"] = $this->dashboard->getProfileAdmin($user->id);
            $this->load->view("_templates/dashboard/_header", $data);
            $this->load->view("cbt/nilai/detail");
            $this->load->view("_templates/dashboard/_footer");
            goto ZNApE;
        }
        $guru = $this->dashboard->getDataGuruByUserId($user->id, $tp->id_tp, $smt->id_smt);
        $data["guru"] = $guru;
        $this->load->view("members/guru/templates/header", $data);
        $this->load->view("cbt/nilai/detail");
        $this->load->view("members/guru/templates/footer");
        ZNApE:
    }
    public function simpanKoreksi()
    {
        $siswa = $this->input->post("siswa", true);
        $jadwal = $this->input->post("jadwal", true);
        $jenis = $this->input->post("jenis", true);
        $nilais = json_decode($this->input->post("nilai", true));
        $updated = [];
        $ids = [];
        $jml = 0;
        foreach ($nilais as $nilai) {
            array_push($ids, $nilai->id_soal);
            $jml += $nilai->koreksi;
            $updated[] = ["id_soal_siswa" => $nilai->id_soal, "nilai_koreksi" => $nilai->koreksi, "nilai_otomatis" => 1];
        }
        $updated = $this->db->update_batch("cbt_soal_siswa", $updated, "id_soal_siswa");
        if (!$updated) {
            goto CIq7v;
        }
        $this->db->set($jenis, $jml);
        $this->db->where("id_nilai", $siswa . "0" . $jadwal);
        $this->db->update("cbt_nilai");
        CIq7v:
        $data["success"] = $updated;
        $this->output_json($data);
    }
    public function tandaiKoreksi()
    {
        $siswa = $this->input->post("siswa", true);
        $jadwal = $this->input->post("jadwal", true);
        $this->db->set("dikoreksi", 1);
        $this->db->where("id_nilai", $siswa . "0" . $jadwal);
        $updated = $this->db->update("cbt_nilai");
        $data["success"] = $updated;
        $this->output_json($data);
    }
    public function tandaisemua()
    {
        $this->load->model("Cbt_model", "cbt");
        $id_jadwal = $this->input->post("id_jadwal", true);
        $siswas = $this->input->post("ids", true);
        $updated = 0;
        $test_data = [];
        foreach ($siswas as $id_siswa => $memulai) {
            $info = $this->cbt->getJadwalById($id_jadwal);
            $jawabans = $this->cbt->getJawabanByBank($info->id_bank, $id_siswa);
            $jawabans_siswa = [];
            foreach ($jawabans as $jawaban_siswa) {
                if (!($jawaban_siswa->jenis_soal == "2")) {
                    goto QvvLj;
                }
                $jawaban_siswa->opsi_a = @unserialize($jawaban_siswa->opsi_a);
                $jawaban_siswa->jawaban_siswa = @unserialize($jawaban_siswa->jawaban_siswa);
                $jawaban_siswa->jawaban_benar = @unserialize($jawaban_siswa->jawaban_benar);
                $jawaban_siswa->jawaban_benar = array_map("strtoupper", $jawaban_siswa->jawaban_benar);
                $jawaban_siswa->jawaban_benar = array_filter($jawaban_siswa->jawaban_benar, "strlen");
                QvvLj:
                if (!($jawaban_siswa->jenis_soal == "3")) {
                    goto E81O1;
                }
                $jawaban_siswa->jawaban_siswa = @unserialize($jawaban_siswa->jawaban_siswa);
                $jawaban_siswa->jawaban_benar = @unserialize($jawaban_siswa->jawaban_benar);
                $jawaban_siswa->jawaban_siswa = json_decode(json_encode($jawaban_siswa->jawaban_siswa));
                $jawaban_siswa->jawaban_benar = json_decode(json_encode($jawaban_siswa->jawaban_benar));
                E81O1:
                $jawabans_siswa[$jawaban_siswa->jenis_soal][] = $jawaban_siswa;
            }
            $ada_jawaban_isian = isset($jawabans_siswa["4"]);
            $ada_jawaban_essai = isset($jawabans_siswa["5"]);
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
            $jawaban_pg = isset($jawabans_siswa["1"]) ? $jawabans_siswa["1"] : [];
            $benar_pg = 0;
            $salah_pg = 0;
            if (!($info->tampil_pg > 0)) {
                goto vVrTx;
            }
            if (!(count($jawaban_pg) > 0)) {
                goto asHW5;
            }
            foreach ($jawaban_pg as $jwb_pg) {
                if (!($jwb_pg != null && $jwb_pg->jawaban_siswa != null)) {
                    goto bE1xv;
                }
                if (strtoupper($jwb_pg->jawaban_siswa) == strtoupper($jwb_pg->jawaban_benar)) {
                    $benar_pg += 1;
                    goto rOunY;
                }
                $salah_pg += 1;
                rOunY:
                bE1xv:
            }
            asHW5:
            vVrTx:
            $skor_pg = $bagi_pg == 0 ? 0 : $benar_pg / $bagi_pg * $bobot_pg;
            $jawaban_pg2 = isset($jawabans_siswa["2"]) ? $jawabans_siswa["2"] : [];
            $benar_pg2 = 0;
            $skor_koreksi_pg2 = 0.0;
            $otomatis_pg2 = 0;
            if (!($info->tampil_kompleks > 0)) {
                goto nO7HR;
            }
            if (!(count($jawaban_pg2) > 0)) {
                goto GQVeI;
            }
            foreach ($jawaban_pg2 as $num => $jawab_pg2) {
                $otomatis_pg2 = $jawab_pg2->nilai_otomatis;
                $skor_koreksi_pg2 += $jawab_pg2->nilai_koreksi;
                $arr_benar = [];
                foreach ($jawab_pg2->jawaban_siswa as $js) {
                    if (!in_array($js, $jawab_pg2->jawaban_benar)) {
                        goto ZqKY1;
                    }
                    array_push($arr_benar, true);
                    ZqKY1:
                }
                if (!(count($jawab_pg2->jawaban_benar) > 0)) {
                    goto W6oqJ;
                }
                $benar_pg2 += 1 / count($jawab_pg2->jawaban_benar) * count($arr_benar);
                W6oqJ:
            }
            GQVeI:
            nO7HR:
            $s_pg2 = $bagi_pg2 == 0 ? 0 : $benar_pg2 / $bagi_pg2 * $bobot_pg2;
            $skor_pg2 = $otomatis_pg2 == 0 ? $s_pg2 : $skor_koreksi_pg2;
            $jawaban_jodoh = isset($jawabans_siswa["3"]) ? $jawabans_siswa["3"] : [];
            $benar_jod = 0;
            $skor_koreksi_jod = 0.0;
            $otomatis_jod = 0;
            if (!($info->tampil_jodohkan > 0)) {
                goto Bq6q2;
            }
            if (!(count($jawaban_jodoh) > 0)) {
                goto d1k_N;
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
                            goto lpkKB;
                        }
                        $jwb->subtitle[] = $headSoal[$pos];
                        $items++;
                        lpkKB:
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
                            goto cdEVy;
                        }
                        $sub = $headJawab[$po];
                        $jwbs->subtitle[] = $sub;
                        cdEVy:
                    }
                    array_push($arrJwbJawab, $jwbs);
                }
                $item_benar = 0;
                $item_salah = 0;
                foreach ($arrJwbJawab as $p => $ajjs) {
                    if (!isset($ajjs->subtitle)) {
                        goto mqRsE;
                    }
                    foreach ($ajjs->subtitle as $pp => $ajs) {
                        if (in_array($ajs, $arrJwbSoal[$p]->subtitle)) {
                            $item_benar++;
                            goto VcrhK;
                        }
                        $item_salah++;
                        VcrhK:
                    }
                    mqRsE:
                }
                $benar_jod += 1 / $items * $item_benar;
                $otomatis_jod = $jawab_jod->nilai_otomatis;
            }
            d1k_N:
            Bq6q2:
            $s_jod = $bagi_jodoh == 0 ? 0 : $benar_jod / $bagi_jodoh * $bobot_jodoh;
            $skor_jod = $otomatis_jod == 0 ? $s_jod : $skor_koreksi_jod;
            $jawaban_is = $ada_jawaban_isian ? $jawabans_siswa["4"] : [];
            $benar_is = 0;
            $skor_koreksi_is = 0.0;
            $otomatis_is = 0;
            if (!($info->tampil_isian > 0)) {
                goto xAYFb;
            }
            if (!(count($jawaban_is) > 0)) {
                goto KvC6z;
            }
            foreach ($jawaban_is as $num => $jawab_is) {
                $skor_koreksi_is += $jawab_is->nilai_koreksi;
                $benar = $jawab_is != null && strtolower($jawab_is->jawaban_siswa) == strtolower($jawab_is->jawaban_benar);
                if (!$benar) {
                    goto WicvU;
                }
                $benar_is++;
                WicvU:
                $otomatis_is = $jawab_is->nilai_otomatis;
            }
            KvC6z:
            xAYFb:
            $s_is = $bagi_isian == 0 ? 0 : $benar_is / $bagi_isian * $bobot_isian;
            $skor_is = $otomatis_is == 0 ? $s_is : $skor_koreksi_is;
            $jawaban_es = $ada_jawaban_essai ? $jawabans_siswa["5"] : [];
            $benar_es = 0;
            $skor_koreksi_es = 0.0;
            $otomatis_es = 0;
            if (!($info->tampil_esai > 0)) {
                goto MsN4w;
            }
            if (!(count($jawaban_es) > 0)) {
                goto QFx1T;
            }
            foreach ($jawaban_es as $num => $jawab_es) {
                $skor_koreksi_es += $jawab_es->nilai_koreksi;
                $benar = $jawab_es != null && strtolower($jawab_es->jawaban_siswa) == strtolower($jawab_es->jawaban_benar);
                if (!$benar) {
                    goto yHtfy;
                }
                $benar_es++;
                yHtfy:
                $otomatis_es = $jawab_es->nilai_otomatis;
            }
            QFx1T:
            MsN4w:
            $s_es = $bagi_essai == 0 ? 0 : $benar_es / $bagi_essai * $bobot_essai;
            $skor_es = $otomatis_es == 0 ? $s_es : $skor_koreksi_es;
            $total = $skor_pg + $skor_pg2 + $skor_jod + $skor_is + $skor_es;
            $insert = ["id_nilai" => $id_siswa . "0" . $id_jadwal, "id_siswa" => $id_siswa, "id_jadwal" => $id_jadwal, "pg_benar" => $benar_pg, "pg_nilai" => round($skor_pg, 2), "kompleks_nilai" => round($skor_pg2, 2), "jodohkan_nilai" => round($skor_jod, 2), "isian_nilai" => round($skor_is, 2), "essai_nilai" => round($skor_es, 2), "dikoreksi" => $memulai === "2" ? "0" : "1"];
            $test_data[] = $insert;
            $upd = $this->db->replace("cbt_nilai", $insert);
            if (!$upd) {
                goto gdZFs;
            }
            $updated++;
            gdZFs:
        }
        $data["success"] = $updated;
        $data["siswa"] = $siswas;
        $this->output_json($data);
    }
    public function inputEssai()
    {
        $this->load->model("Dashboard_model", "dashboard");
        $this->load->model("Cbt_model", "cbt");
        $this->load->model("Dropdown_model", "dropdown");
        $kelas_selected = $this->input->get("kelas");
        $jadwal_selected = $this->input->get("jadwal");
        $info = $this->cbt->getJadwalById($jadwal_selected);
        $tp = $this->dashboard->getTahunActive();
        $smt = $this->dashboard->getSemesterActive();
        $siswas = $this->cbt->getSiswaByKelas($tp->id_tp, $smt->id_smt, $kelas_selected);
        $ids = [];
        foreach ($siswas as $key => $val) {
            array_push($ids, $val->id_siswa);
        }
        $nilai = $this->cbt->getNilaiAllSiswa([$jadwal_selected], $ids);
        foreach ($siswas as $siswa) {
            $siswa->skor_pg = isset($nilai[$siswa->id_siswa]) ? $nilai[$siswa->id_siswa]->pg_nilai : "0";
            $siswa->skor_pg2 = isset($nilai[$siswa->id_siswa]) ? $nilai[$siswa->id_siswa]->kompleks_nilai : "0";
            $siswa->skor_jod = isset($nilai[$siswa->id_siswa]) ? $nilai[$siswa->id_siswa]->jodohkan_nilai : "0";
            $siswa->skor_isian = isset($nilai[$siswa->id_siswa]) ? $nilai[$siswa->id_siswa]->isian_nilai : "0";
            $siswa->skor_essai = isset($nilai[$siswa->id_siswa]) ? $nilai[$siswa->id_siswa]->essai_nilai : "0";
        }
        $user = $this->ion_auth->user()->row();
        $data = ["user" => $user, "judul" => "Input Nilai Manual", "subjudul" => '', "profile" => $this->dashboard->getProfileAdmin($user->id), "setting" => $this->dashboard->getSetting()];
        $data["tp"] = $this->dashboard->getTahun();
        $data["smt"] = $this->dashboard->getSemester();
        $data["tp_active"] = $tp;
        $data["smt_active"] = $smt;
        $data["nama_kelas"] = $this->dropdown->getNamaKelasById($tp->id_tp, $smt->id_smt, $kelas_selected);
        $data["kelas_selected"] = $kelas_selected;
        $data["jadwal_selected"] = $jadwal_selected;
        $data["jadwal"] = $info;
        $data["siswas"] = $siswas;
        if ($this->ion_auth->is_admin()) {
            $this->load->view("_templates/dashboard/_header", $data);
            $this->load->view("cbt/nilai/nilai_essai");
            $this->load->view("_templates/dashboard/_footer");
            goto uPF0a;
        }
        $guru = $this->dashboard->getDataGuruByUserId($user->id, $tp->id_tp, $smt->id_smt);
        $data["guru"] = $guru;
        $this->load->view("members/guru/templates/header", $data);
        $this->load->view("cbt/nilai/nilai_essai");
        $this->load->view("members/guru/templates/footer");
        uPF0a:
    }
    public function simpanKoreksiEssai()
    {
        $this->load->model("Cbt_model", "cbt");
        $jadwal = $this->input->post("jadwal", true);
        $nilais = json_decode($this->input->post("nilai", true));
        $update = 0;
        $blm_selesai = [];
        foreach ($nilais as $nilai) {
            $nilai_siswa = $this->cbt->getNilaiSiswaByJadwal($jadwal, $nilai->id_siswa);
            if ($nilai_siswa != null) {
                $replace = ["id_nilai" => $nilai_siswa->id_nilai, "id_siswa" => $nilai_siswa->id_siswa, "id_jadwal" => $nilai_siswa->id_jadwal, "pg_benar" => $nilai_siswa->pg_benar, "pg_nilai" => $nilai_siswa->pg_nilai, "kompleks_nilai" => isset($nilai->kompleks_nilai) && $nilai->kompleks_nilai != null ? $nilai->kompleks_nilai : "0", "jodohkan_nilai" => isset($nilai->jodohkan_nilai) && $nilai->jodohkan_nilai != null ? $nilai->jodohkan_nilai : "0", "isian_nilai" => isset($nilai->isian_nilai) && $nilai->isian_nilai != null ? $nilai->isian_nilai : "0", "essai_nilai" => isset($nilai->essai_nilai) && $nilai->essai_nilai != null ? $nilai->essai_nilai : "0", "dikoreksi" => "1"];
                $up = $this->db->replace("cbt_nilai", $replace);
                if (!$up) {
                    goto XoQup;
                }
                $update++;
                XoQup:
                goto FR41f;
            }
            array_push($blm_selesai, $nilai->id_siswa);
            FR41f:
        }
        $data["success"] = $update;
        $data["data"] = $nilais;
        $data["blm_selesai"] = count($blm_selesai);
        $this->output_json($data);
    }
}
