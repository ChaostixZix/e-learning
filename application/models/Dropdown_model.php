<?php
/*   ________________________________________
    |                 GarudaCBT              |
    |    https://github.com/garudacbt/cbt    |
    |________________________________________|
*/
 class Dropdown_model extends CI_Model { public function getBulan() { goto WUL9o; WUL9o: $result = $this->db->get("\142\x75\x6c\x61\156")->result(); goto Ww0nj; lKoyA: foreach ($result as $key => $row) { $ret[$row->id_bln] = $row->nama_bln; xEbNT: } goto N67tj; jxW4S: if (!$result) { goto CEHhN; } goto lKoyA; SAH9U: return $ret; goto hpjYD; Ww0nj: $ret = []; goto jxW4S; N67tj: XMZzA: goto nxdrq; nxdrq: CEHhN: goto SAH9U; hpjYD: } public function getAllSesi() { goto Y7a8f; eO6QF: Pf8Zs: goto uyh_e; iBOjo: foreach ($result as $key => $row) { $ret[$row->id_sesi] = $row->nama_sesi; OUpPA: } goto GFW7p; UKiT0: $result = $this->db->get("\143\142\x74\137\x73\x65\x73\151")->result(); goto s5cxV; GFW7p: YztTy: goto eO6QF; Y7a8f: $this->db->select("\151\x64\x5f\x73\145\x73\x69\54\40\156\141\155\141\x5f\x73\145\x73\151\54\40\x6b\x6f\x64\145\x5f\x73\145\x73\151"); goto UKiT0; s5cxV: if (!$result) { goto Pf8Zs; } goto iBOjo; uyh_e: return $ret; goto n6MwO; n6MwO: } public function getAllRuang() { goto Q5a92; faZk1: nZNGf: goto WDZHW; cDMqo: if (!$result) { goto nZNGf; } goto OYjaJ; WDZHW: return $ret; goto GWyAW; J1_mN: ISZNq: goto faZk1; OYjaJ: foreach ($result as $key => $row) { $ret[$row->id_ruang] = $row->nama_ruang; OqYC2: } goto J1_mN; Q5a92: $result = $this->db->get("\x63\142\164\137\x72\x75\141\156\147")->result(); goto LCf0j; LCf0j: $ret = []; goto cDMqo; GWyAW: } public function getAllWaktuSesi() { goto bBZnW; bBZnW: $result = $this->db->get("\x63\142\x74\137\163\145\x73\x69")->result(); goto iflGY; JnN_B: cH63o: goto P3L2o; EpLEz: zeqNm: goto JnN_B; egbON: foreach ($result as $key => $row) { $ret[$row->id_sesi] = ["\155\165\x6c\141\151" => $row->waktu_mulai, "\141\x6b\x68\x69\162" => $row->waktu_akhir]; HKDkJ: } goto EpLEz; P3L2o: return $ret; goto h9Ka9; iflGY: if (!$result) { goto cH63o; } goto egbON; h9Ka9: } public function getDataKelompokMapel() { goto E7dP_; YzGDK: return $ret; goto yMx8Z; ezKJb: qz0Mb: goto YzGDK; Rh3JP: $ret = []; goto Pq6w2; E7dP_: $this->db->select("\52"); goto GnJOU; GnJOU: $this->db->from("\x6d\x61\163\x74\145\162\x5f\x6b\x65\x6c\x6f\155\x70\157\153\x5f\155\141\x70\x65\154"); goto hGAxI; hGAxI: $this->db->order_by("\153\157\144\x65\137\x6b\145\154\x5f\x6d\x61\x70\x65\154"); goto mGGnN; Pq6w2: foreach ($result as $row) { $ret[$row->kode_kel_mapel] = $row->nama_kel_mapel; eWJEQ: } goto ezKJb; mGGnN: $result = $this->db->get()->result(); goto Rh3JP; yMx8Z: } public function getAllMapel() { goto xsj4V; bbRrD: return $ret; goto QrfuI; urTKb: if (!$result) { goto i884v; } goto TNdGe; aO9D1: $this->db->where("\x73\164\x61\164\165\x73", "\61"); goto hmZoD; HBBdS: i884v: goto bbRrD; hmZoD: $result = $this->db->get("\155\141\163\164\145\x72\137\x6d\141\160\x65\x6c")->result(); goto urTKb; xsj4V: $this->db->select("\x69\144\x5f\x6d\x61\160\145\x6c\x2c\156\x61\155\x61\x5f\x6d\x61\x70\x65\154\x2c\165\162\x75\164\141\156\137\x74\141\155\160\x69\154"); goto K_3Iw; TNdGe: foreach ($result as $key => $row) { $ret[$row->id_mapel] = $row->nama_mapel; mR0L3: } goto Y97Pb; Y97Pb: T3wgm: goto HBBdS; K_3Iw: $this->db->order_by("\165\162\x75\x74\141\156\137\164\141\x6d\x70\x69\154"); goto aO9D1; QrfuI: } public function getAllKodeMapel() { goto UtRVg; MUp7v: return $ret; goto Y0f1x; hR9EA: $this->db->where("\x73\x74\141\164\165\x73", "\x31"); goto mLHwP; mLHwP: $result = $this->db->get("\x6d\141\163\x74\145\162\137\155\x61\160\145\x6c")->result(); goto ih6rW; JYRXr: o5QTf: goto cR7Y0; UtRVg: $this->db->order_by("\x75\x72\165\x74\x61\x6e\137\x74\x61\155\160\x69\154"); goto hR9EA; cR7Y0: BIDk6: goto MUp7v; a9uq0: foreach ($result as $key => $row) { $ret[$row->id_mapel] = $row->kode; z2E7i: } goto JYRXr; ih6rW: $ret[''] = "\124\x69\x64\x61\x6b\x20\141\x64\141"; goto N80i2; N80i2: if (!$result) { goto BIDk6; } goto a9uq0; Y0f1x: } public function getAllMapelPeminatan() { goto RNomx; ZWH0A: t3KiP: goto tvCuB; Cn1Vw: $this->db->from("\155\x61\163\x74\x65\x72\137\153\x65\154\x6f\155\160\x6f\153\x5f\155\141\x70\145\x6c"); goto UjVLz; aaWVs: if (!$result) { goto wMevi; } goto VfuKc; tk8rg: RfM0q: goto v4l1j; As_uf: $result = $this->db->get("\155\141\x73\x74\x65\162\137\155\141\160\145\x6c")->result(); goto aaWVs; VfuKc: foreach ($result as $key => $row) { $ret[$row->id_mapel] = $row->nama_mapel; iKL2Q: } goto ZWH0A; UjVLz: $this->db->where("\153\x61\x74\x65\x67\x6f\162\x69\x20\74\76\40\x22\127\101\x4a\111\102\x22")->or_where("\153\x61\164\145\x67\x6f\x72\x69\40\74\x3e\x20\x22\x50\101\111\40\50\113\x65\155\145\x6e\141\147\51\42"); goto Xa_py; O2Sxl: if (!(count($ress) > 0)) { goto DxrBX; } goto MvSb6; MvSb6: $this->db->where_in("\x6b\x65\154\x6f\x6d\160\x6f\153", $ress); goto JiIEH; tvCuB: wMevi: goto tF1Zv; v4l1j: $ret = []; goto O2Sxl; s9FF0: $ress = []; goto Wo3n2; hTjhU: sAtcs: goto tk8rg; Wo3n2: if (!$res) { goto RfM0q; } goto iZgeT; Xa_py: $res = $this->db->get("\155\141\x73\x74\x65\162\137\x6d\141\160\145\154")->result(); goto s9FF0; RNomx: $this->db->select("\x2a"); goto Cn1Vw; iZgeT: foreach ($res as $key => $row) { $ress[$row->id_kel_mapel] = $row->kode_kel_mapel; RWpua: } goto hTjhU; JiIEH: $this->db->order_by("\165\162\x75\x74\141\156\x5f\164\141\x6d\x70\x69\x6c"); goto As_uf; tF1Zv: DxrBX: goto jkl4I; jkl4I: return $ret; goto yebo3; yebo3: } public function getAllLevel($jenjang) { goto TS9NO; MYPFH: $levels = ["\x37" => "\x37", "\x38" => "\x38", "\x39" => "\x39"]; goto QiP1c; ql39x: if ($jenjang == "\x31") { goto QE6ZZ; } goto aAz63; s2ukc: goto W8Urr; goto gg6in; wa0Je: QE6ZZ: goto mm7cs; PklgF: return $levels; goto pXAWd; gg6in: V2j5R: goto MYPFH; aAz63: if ($jenjang == "\62") { goto V2j5R; } goto cotk_; QiP1c: goto W8Urr; goto YsC81; vh7U6: W8Urr: goto PklgF; L0vkl: $levels = ["\x31\60" => "\x31\x30", "\61\x31" => "\61\61", "\x31\62" => "\61\x32"]; goto vh7U6; mm7cs: $levels = ["\61" => "\x31", "\62" => "\x32", "\x33" => "\x33", "\64" => "\x34", "\x35" => "\65", "\66" => "\66"]; goto s2ukc; cotk_: if ($jenjang == "\x33") { goto MxG1b; } goto veufX; TS9NO: $levels = []; goto ql39x; YsC81: MxG1b: goto L0vkl; veufX: goto W8Urr; goto wa0Je; pXAWd: } public function getAllKelas($tp, $smt, $level = null) { goto erDc1; qFWqa: t0IDo: goto M8YVy; O7pOJ: if (!($level != null)) { goto t0IDo; } goto c9uTh; tdEjZ: goto afvoO; goto cG1vg; M8YVy: $result = $this->db->get()->result(); goto ql7dI; ql7dI: $ret = []; goto AUVUJ; cG1vg: SLkuU: goto TXpOd; BWoNw: afvoO: goto l_XCy; TXpOd: foreach ($result as $key => $row) { $ret[$row->id_kelas] = $row->nama_kelas; GbZs2: } goto e0WWL; erDc1: $this->db->select("\x2a"); goto y8zOd; y8zOd: $this->db->from("\x6d\x61\x73\164\x65\162\137\x6b\x65\x6c\141\163"); goto XFQd7; XFQd7: $this->db->where("\x69\144\137\x74\160", $tp); goto DdaOr; Ks34g: $this->db->order_by("\x6e\141\x6d\x61\x5f\x6b\x65\x6c\x61\163", "\x41\123\x43"); goto O7pOJ; OgrJ4: $this->db->order_by("\x6c\x65\166\x65\x6c\x5f\151\144", "\101\x53\x43"); goto Ks34g; c9uTh: $this->db->where("\x6c\x65\166\x65\154\137\151\x64" . $level); goto qFWqa; l_XCy: return $ret; goto gEEnL; echXP: $ret = []; goto tdEjZ; e0WWL: sAQWi: goto BWoNw; AUVUJ: if ($result) { goto SLkuU; } goto echXP; DdaOr: $this->db->where("\x69\144\x5f\163\x6d\x74", $smt); goto OgrJ4; gEEnL: } public function getAllKeyKodeKelas($tp, $smt) { goto nBhY3; F0E2Z: if ($result) { goto PuhVy; } goto wZRC4; YGoe1: $this->db->where("\x69\x64\x5f\163\155\164", $smt); goto hm_bQ; jqwBq: return $ret; goto N3hem; SAyxZ: goto rAtyD; goto FEIsC; fEvP0: $this->db->where("\x69\144\137\x74\x70", $tp); goto YGoe1; wZRC4: $ret = []; goto SAyxZ; AvZza: $this->db->from("\155\141\163\164\145\x72\137\153\145\154\x61\163"); goto fEvP0; nBhY3: $this->db->select("\52"); goto AvZza; FEIsC: PuhVy: goto CgcJK; MA35B: oUoi8: goto OwS4T; hm_bQ: $result = $this->db->get()->result(); goto F0E2Z; OwS4T: rAtyD: goto jqwBq; CgcJK: foreach ($result as $key => $row) { $ret[$row->kode_kelas] = $row->nama_kelas; w6tca: } goto MA35B; N3hem: } public function getAllKodeKelas($tp = null, $smt = null) { goto s0uXC; s0uXC: $this->db->select("\x2a"); goto iDm1c; CV3J5: $ret = []; goto HI40e; vo0AK: $result = $this->db->get()->result(); goto UeuDj; eEMTK: ro2KL: goto c6Spc; c6Spc: return $ret; goto hoZHT; nO5V4: GGuVn: goto t6obZ; t6obZ: foreach ($result as $key => $row) { $ret[$row->id_kelas] = $row->kode_kelas; hf8ar: } goto SotpB; HI40e: goto ro2KL; goto nO5V4; NEycT: nuq07: goto vo0AK; SotpB: f1lbT: goto eEMTK; iDm1c: $this->db->from("\155\141\x73\x74\145\162\x5f\x6b\145\154\x61\163"); goto DHB5i; murMe: if (!($smt != null)) { goto nuq07; } goto FbDOx; zB5af: Rf6US: goto murMe; DHB5i: if (!($tp != null)) { goto Rf6US; } goto uw1l5; UeuDj: if ($result) { goto GGuVn; } goto CV3J5; FbDOx: $this->db->where("\x69\144\x5f\x73\155\x74", $smt); goto NEycT; uw1l5: $this->db->where("\151\144\137\164\x70", $tp); goto zB5af; hoZHT: } public function getNamaKelasById($tp, $smt, $id) { goto bJoDt; iyYKL: ZGl_F: goto ZGyqa; j2eMg: return null; goto Xlyqo; JT8CJ: fDT30: goto A_XpU; Cl7FN: $this->db->where("\151\x64\137\153\x65\x6c\141\x73", $id); goto tUxT0; Xlyqo: goto fDT30; goto iyYKL; hzuyW: $result = $this->db->get("\155\141\163\164\x65\x72\137\153\145\154\x61\163")->row(); goto FDWXB; ZGyqa: return $result->nama_kelas; goto JT8CJ; bJoDt: $this->db->select("\156\x61\x6d\x61\137\x6b\x65\154\x61\163"); goto Cl7FN; FDWXB: if ($result != null) { goto ZGl_F; } goto j2eMg; tUxT0: $this->db->where("\151\144\137\164\x70", $tp); goto KS2O8; KS2O8: $this->db->where("\x69\x64\137\x73\x6d\x74", $smt); goto hzuyW; A_XpU: } public function getAllKelasByArrayId($tp, $smt, $arrId) { goto EECa3; EECa3: $this->db->select("\52"); goto PVYPr; Ugzhu: $this->db->where("\x69\x64\137\x74\x70", $tp); goto MOI83; XHyQM: gUs9f: goto i4ELk; ruqt7: return $ret; goto hpLQj; W43T0: $ret = []; goto G_6Vs; yPXLc: $result = $this->db->get()->result(); goto W43T0; G_6Vs: if (!$result) { goto Xe6Ik; } goto V_i6T; V_i6T: foreach ($result as $key => $row) { $ret[$row->id_kelas] = $row->nama_kelas; OzIur: } goto XHyQM; MOI83: $this->db->where_in("\x69\x64\x5f\153\x65\154\x61\163", $arrId); goto yPXLc; i4ELk: Xe6Ik: goto ruqt7; PVYPr: $this->db->from("\x6d\x61\x73\164\x65\162\137\153\x65\154\141\x73"); goto Ugzhu; hpLQj: } public function getAllEkskul() { goto pI0P4; rsCXD: pq72I: goto HZnRt; T2j5L: foreach ($result as $key => $row) { $ret[$row->id_ekstra] = $row->nama_ekstra; IXrTd: } goto VVCJM; bHj7H: if (!$result) { goto pq72I; } goto T2j5L; VVCJM: yAwIU: goto rsCXD; pI0P4: $result = $this->db->get("\155\x61\163\x74\x65\x72\137\145\x6b\163\164\x72\x61")->result(); goto bHj7H; HZnRt: return $ret; goto eNtIA; eNtIA: } public function getAllKodeEkskul() { goto yBZIF; yHnNc: return $ret; goto zA0Wz; K7e7F: O7PE4: goto yHnNc; yBZIF: $result = $this->db->get("\155\x61\x73\x74\x65\162\x5f\145\x6b\x73\164\162\x61")->result(); goto iSkUi; m3Cbh: nom71: goto K7e7F; iSkUi: if (!$result) { goto O7PE4; } goto iro2g; iro2g: foreach ($result as $key => $row) { $ret[$row->id_ekstra] = $row->kode_ekstra; E2z29: } goto m3Cbh; zA0Wz: } public function getAllJurusan() { goto Dndy1; PGh2P: S3C8c: goto bnTxe; bnTxe: xA6cM: goto ZsT3c; j0Ukt: if (!$result) { goto xA6cM; } goto XSlnx; ZsT3c: return $ret; goto E8Arr; XSlnx: foreach ($result as $key => $row) { $ret[$row->id_jurusan] = $row->kode_jurusan; DLxdQ: } goto PGh2P; Dndy1: $result = $this->db->get("\155\x61\163\x74\x65\162\x5f\152\x75\x72\165\163\141\156")->result(); goto j0Ukt; E8Arr: } public function getAllGuru() { goto N_YWm; i64sk: pIs2i: goto LNDBg; RT6tZ: if (!$result) { goto pIs2i; } goto rl_yJ; mLIGo: $ret["\60"] = "\120\151\x6c\151\150\x20\x47\x75\162\165\x20\72"; goto RT6tZ; N_YWm: $this->db->select("\x61\56\x69\x64\x5f\147\165\x72\x75\x2c\40\x61\56\x6e\141\x6d\141\x5f\147\x75\x72\165"); goto Xh0zy; fgtf5: $this->db->join("\x75\163\145\162\x73\x20\145", "\x61\56\165\163\x65\x72\x6e\141\155\145\75\x65\x2e\x75\163\145\162\156\141\x6d\x65"); goto aCiC7; rl_yJ: foreach ($result as $key => $row) { $ret[$row->id_guru] = $row->nama_guru; WBxmP: } goto u0Y8F; u0Y8F: y7G8m: goto i64sk; aCiC7: $result = $this->db->get()->result(); goto mLIGo; Xh0zy: $this->db->from("\155\x61\163\x74\145\162\x5f\147\x75\162\165\40\x61"); goto fgtf5; LNDBg: return $ret; goto ct15m; ct15m: } public function getAllLevelGuru() { goto CVEvV; NjfNC: $ret[''] = "\120\151\154\x69\x68\40\x4a\x61\x62\141\164\x61\156\40\72"; goto A4O3L; lYY19: JJQHE: goto JF3GD; WUIql: foreach ($result as $key => $row) { $ret[$row->id_level] = $row->level; qsLdM: } goto lYY19; A4O3L: if (!$result) { goto IbUMQ; } goto WUIql; RSyiy: return $ret; goto ccNDh; JF3GD: IbUMQ: goto RSyiy; CVEvV: $result = $this->db->get("\154\x65\x76\x65\154\x5f\147\x75\x72\165")->result(); goto NjfNC; ccNDh: } public function getAllJenisUjian() { goto XvD3h; zeepV: if (!$result) { goto dM_hu; } goto WT5CZ; J1fSb: yamtp: goto wqMpe; wqMpe: dM_hu: goto idP0Q; XvD3h: $result = $this->db->get("\143\x62\x74\137\152\x65\x6e\151\163")->result(); goto zeepV; WT5CZ: foreach ($result as $key => $row) { $ret[$row->id_jenis] = $row->nama_jenis . "\x20\50" . $row->kode_jenis . "\51"; xzRvR: } goto J1fSb; idP0Q: return $ret; goto GZKMH; GZKMH: } public function getAllBankSoal() { goto UY_TC; J_c9B: if (!$result) { goto ACZZw; } goto A42hD; xQeEo: ACZZw: goto A8tue; A8tue: return $ret; goto T7BcX; UY_TC: $result = $this->db->get("\143\142\164\137\142\x61\x6e\x6b\x5f\163\x6f\x61\154")->result(); goto BQ0Mw; P6SHK: tumlX: goto xQeEo; BQ0Mw: $ret[''] = "\x50\x69\x6c\x69\150\x20\x42\141\156\153\x20\123\157\x61\154\40\x3a"; goto J_c9B; A42hD: foreach ($result as $key => $row) { $ret[$row->id_bank] = $row->bank_kode; oo8jC: } goto P6SHK; T7BcX: } public function getAllJadwal($tp, $smt) { goto a0RBv; nok78: $ret = []; goto CToOg; kLNnY: $this->db->join("\x63\142\x74\137\x62\x61\x6e\153\137\x73\x6f\141\x6c\40\x62", "\142\56\151\x64\x5f\x62\x61\x6e\153\x3d\x61\56\x69\x64\137\142\141\x6e\153"); goto Fq5tq; XywXM: VokFg: goto b7mN_; lsYqo: return $ret; goto Bzzy1; CToOg: if (!$result) { goto jkIsu; } goto buT_P; b7mN_: jkIsu: goto lsYqo; H4xy8: $this->db->where("\x61\56\x69\x64\137\x73\x6d\164", $smt); goto Nk7pW; a0RBv: $this->db->from("\x63\x62\164\137\x6a\x61\144\167\141\x6c\x20\x61"); goto kLNnY; Fq5tq: $this->db->where("\x61\x2e\x69\144\x5f\x74\x70", $tp); goto H4xy8; Nk7pW: $result = $this->db->get()->result(); goto nok78; buT_P: foreach ($result as $key => $row) { $ret[$row->id_jadwal] = $row->bank_kode; qNGrV: } goto XywXM; Bzzy1: } public function getAllJadwalGuru($tp, $smt, $guru) { goto tq5vQ; izKTw: $result = $this->db->get()->result(); goto oRFLT; H1nFj: Fgwzz: goto kITzi; oRFLT: $ret = []; goto zuWWZ; y1Sxj: i3M88: goto H1nFj; zuWWZ: if (!$result) { goto Fgwzz; } goto yGzxF; VfFYX: $this->db->where("\141\x2e\151\144\x5f\163\155\x74", $smt); goto izKTw; NghJd: $this->db->join("\143\142\164\x5f\x62\x61\156\x6b\137\163\157\x61\154\40\142", "\x62\56\x69\x64\137\142\141\x6e\x6b\x3d\x61\56\x69\144\137\x62\x61\x6e\153\40\x41\x4e\x44\40\142\56\x62\x61\x6e\153\137\x67\165\162\165\137\151\x64\x3d" . $guru); goto cUxxa; cUxxa: $this->db->where("\x61\x2e\x69\x64\x5f\x74\160", $tp); goto VfFYX; yGzxF: foreach ($result as $key => $row) { $ret[$row->id_jadwal] = $row->bank_kode; dQeh0: } goto y1Sxj; tq5vQ: $this->db->from("\143\x62\164\x5f\x6a\141\x64\167\x61\x6c\x20\x61"); goto NghJd; kITzi: return $ret; goto IlWLh; IlWLh: } public function getAllJenisJadwal($tp, $smt, $jenis, $mapel) { goto jEWAT; EBTiN: foreach ($result as $key => $row) { $ret[$row->id_jadwal] = $row->bank_kode; GUBZv: } goto hOLWi; YEuQ_: $this->db->where("\x61\x2e\151\144\x5f\x73\155\x74", $smt); goto KQnbb; gY_GV: $this->db->join("\x63\142\164\x5f\x62\x61\156\x6b\137\163\x6f\x61\154\40\142", "\142\56\x69\x64\x5f\x62\141\156\153\x3d\141\x2e\151\x64\137\142\x61\x6e\153"); goto uF3Aa; MBhEN: goto JJCzp; goto VGgJ2; Iur63: if ($mapel == "\x30") { goto EEzL_; } goto TnJvf; khBcA: return $ret; goto sPUcE; OqJ3_: $this->db->where("\x61\56\x69\x64\137\164\160", $tp); goto YEuQ_; hOLWi: OV7Vn: goto i_rHJ; i_rHJ: jU138: goto khBcA; pIkzS: $result = $this->db->get()->result(); goto lctHU; VGgJ2: EEzL_: goto gY_GV; lctHU: $ret = []; goto RskQr; TnJvf: $this->db->join("\143\142\x74\137\x62\x61\156\x6b\x5f\163\x6f\x61\154\40\x62", "\142\56\x69\144\x5f\142\141\156\153\75\x61\56\x69\x64\x5f\142\x61\156\x6b\x20\101\116\104\40\x62\56\x62\x61\x6e\153\137\155\x61\160\145\154\x5f\x69\144\75" . $mapel . "\x20"); goto MBhEN; RskQr: if (!$result) { goto jU138; } goto EBTiN; uF3Aa: JJCzp: goto OqJ3_; KQnbb: $this->db->where("\141\56\151\x64\x5f\152\145\x6e\x69\163", $jenis); goto pIkzS; jEWAT: $this->db->from("\143\x62\164\137\152\x61\144\x77\x61\154\x20\141"); goto Iur63; sPUcE: } }