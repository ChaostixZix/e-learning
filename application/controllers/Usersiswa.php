<?php
/*   ________________________________________
    |                 GarudaCBT              |
    |    https://github.com/garudacbt/cbt    |
    |________________________________________|
*/
 defined("\x42\101\123\x45\120\x41\124\110") or exit("\x4e\x6f\x20\144\x69\x72\145\x63\x74\40\163\x63\162\151\160\x74\x20\x61\143\143\x65\163\x73\40\x61\x6c\154\x6f\x77\x65\x64"); class Usersiswa extends CI_Controller { public function __construct() { goto jtGNY; sefKb: $this->load->model("\104\x61\163\x68\142\157\x61\x72\144\137\x6d\157\x64\x65\x6c", "\144\141\x73\150\x62\x6f\x61\x72\x64"); goto ylbGg; B5jSz: $this->load->model("\125\163\x65\x72\163\137\x6d\157\144\145\x6c", "\165\163\145\162\163"); goto BTRgH; o7P0_: oNTnf: goto lGNHz; jtGNY: parent::__construct(); goto gJCqt; ylbGg: $this->form_validation->set_error_delimiters('', ''); goto WYBZp; lGNHz: $this->load->library(["\x64\141\x74\x61\x74\x61\x62\x6c\x65\x73", "\x66\x6f\x72\155\x5f\166\141\154\x69\144\141\164\151\x6f\156"]); goto B5jSz; oBvbP: redirect("\141\x75\164\150"); goto o7P0_; gJCqt: if ($this->ion_auth->logged_in()) { goto oNTnf; } goto oBvbP; BTRgH: $this->load->model("\x4d\x61\x73\x74\145\x72\137\155\x6f\x64\x65\x6c", "\x6d\x61\163\x74\x65\162"); goto sefKb; WYBZp: } public function is_has_access() { goto I45Ka; J8mQn: $group = $this->ion_auth->get_users_groups($user_id)->row()->name; goto YgMbC; YgMbC: if (!(!$group === "\x61\144\155\x69\x6e" or !$group === "\x67\x75\162\165")) { goto b1jF9; } goto qSNcv; Ju93a: b1jF9: goto FA9oc; qSNcv: show_error("\x48\141\x6e\171\141\x20\x41\x64\155\151\x6e\x69\163\164\162\141\x74\157\162\40\x79\141\x6e\147\x20\144\151\142\145\x72\x69\x20\x68\141\153\x20\165\x6e\x74\165\x6b\40\155\145\x6e\x67\141\x6b\x73\145\163\x20\x68\141\154\x61\x6d\x61\156\x20\x69\156\x69\x2c\40\x3c\x61\x20\150\x72\145\x66\x3d\42" . base_url("\144\141\163\150\x62\x6f\141\162\x64") . "\x22\76\x4b\145\155\x62\x61\x6c\151\40\x6b\145\40\155\x65\156\165\x20\x61\x77\x61\154\74\57\x61\76", 403, "\101\153\x73\x65\163\40\x54\x65\x72\154\141\x72\x61\156\147"); goto Ju93a; I45Ka: $user_id = $this->ion_auth->user()->row()->id; goto J8mQn; FA9oc: } public function output_json($data, $encode = true) { goto pAifj; XToA9: nMeMj: goto Rh620; pAifj: if (!$encode) { goto nMeMj; } goto d9hBO; d9hBO: $data = json_encode($data); goto XToA9; Rh620: $this->output->set_content_type("\x61\x70\160\154\151\x63\141\x74\x69\x6f\x6e\x2f\152\163\x6f\x6e")->set_output($data); goto V2rBY; V2rBY: } public function data() { goto HrYEg; GJkaK: $smt = $this->dashboard->getSemesterActive(); goto C0WJ2; A8dPy: $tp = $this->dashboard->getTahunActive(); goto GJkaK; C0WJ2: $this->output_json($this->users->getUserSiswa($tp->id_tp, $smt->id_smt), false); goto sZwiW; HrYEg: $this->is_has_access(); goto A8dPy; sZwiW: } public function index() { goto aYoPp; uGvT1: $this->load->view("\x75\x73\145\162\163\57\163\151\163\167\x61\x2f\144\141\x74\141"); goto RzaR1; Dy_LB: $data["\x73\x6d\x74\x5f\x61\x63\164\151\166\x65"] = $this->dashboard->getSemesterActive(); goto VkALI; oVWy_: $user = $this->ion_auth->user()->row(); goto klj9r; aYoPp: $this->is_has_access(); goto oVWy_; VkALI: $this->load->view("\137\x74\x65\x6d\x70\x6c\141\164\x65\163\x2f\144\x61\x73\150\x62\157\x61\x72\x64\57\x5f\x68\145\x61\x64\145\162", $data); goto uGvT1; oOHtd: $data["\x74\x70\x5f\x61\x63\x74\x69\x76\145"] = $this->dashboard->getTahunActive(); goto YFUCX; YFUCX: $data["\x73\x6d\164"] = $this->dashboard->getSemester(); goto Dy_LB; RzaR1: $this->load->view("\137\164\x65\155\160\x6c\141\x74\x65\163\x2f\x64\x61\163\150\x62\157\x61\162\x64\x2f\137\146\157\x6f\164\x65\x72"); goto sz8mX; klj9r: $data = ["\165\x73\145\162" => $user, "\x6a\x75\144\165\x6c" => "\x55\x73\145\x72\40\x4d\141\156\x61\147\x65\155\145\x6e\x74", "\x73\165\142\x6a\165\144\165\154" => "\104\x61\x74\141\40\x55\163\145\x72\40\x53\x69\x73\167\141", "\160\162\157\x66\151\x6c\145" => $this->dashboard->getProfileAdmin($user->id), "\x73\x65\x74\x74\x69\156\x67" => $this->dashboard->getSetting()]; goto Ji5XD; Ji5XD: $data["\164\x70"] = $this->dashboard->getTahun(); goto oOHtd; sz8mX: } public function list() { goto wWgD6; dgcvA: $smt = $this->dashboard->getSemesterActive(); goto OkaRW; HSvsf: $data = ["\154\x69\163\164\163" => $lists, "\x74\157\x74\141\154" => $count_siswa, "\160\x61\147\x65\x73" => ceil($count_siswa / $limit), "\x73\x65\141\x72\143\150" => $search, "\x70\x65\162\x70\141\147\x65" => $limit]; goto HlQ1g; pYdtM: $limit = $this->input->post("\x6c\x69\155\151\x74", true); goto VdP47; OkaRW: $count_siswa = $this->users->getUserSiswaTotalPage($search); goto YZtlB; VdP47: $search = $this->input->post("\163\145\x61\x72\x63\x68", true); goto EgrPA; wWgD6: $page = $this->input->post("\x70\141\x67\x65", true); goto pYdtM; HlQ1g: $this->output_json($data); goto afGl7; EgrPA: $offset = ($page - 1) * $limit; goto k6rOr; YZtlB: $lists = $this->users->getUserSiswaPage($tp->id_tp, $smt->id_smt, $offset, $limit, $search); goto HSvsf; k6rOr: $tp = $this->dashboard->getTahunActive(); goto dgcvA; afGl7: } private function registerSiswa($username, $password, $email, $additional_data, $group) { goto rgDNu; YY2ss: $data["\x73\164\141\x74\165\163"] = true; goto KuUBN; t3r1g: return $data; goto tXOW3; gcJ8D: $data["\163\x74\141\164\x75\x73"] = false; goto P8ckB; rgDNu: $reg = $this->ion_auth->register($username, $password, $email, $additional_data, $group); goto YY2ss; P8ckB: bagmu: goto t3r1g; cUKVA: if (!($reg == false)) { goto bagmu; } goto gcJ8D; KuUBN: $data["\x69\144"] = $reg; goto cUKVA; tXOW3: } private function aktifkan($siswa) { goto i58D3; W2X0W: $reg = $this->registerSiswa($username, $password, $email, $additional_data, $group); goto hvxU2; d9LEA: $deleted = $this->ion_auth->delete_user($user_siswa->id); goto P250u; RBJKX: if ($deleted) { goto J_9oB; } goto sH3kV; tWDx1: $last_name = end($nama); goto GDRl1; i58D3: $nama = explode("\x20", $siswa->nama); goto mCFf0; KXUnR: $deleted = true; goto IzNHh; P250u: E4DN2: goto RBJKX; k0dRt: $email = $siswa->nis . "\100\163\151\x73\167\x61\56\x63\157\155"; goto nuH9a; sH3kV: $data = ["\x73\x74\x61\164\x75\x73" => false, "\x6d\x73\x67" => "\101\153\165\x6e\40\x73\151\163\167\141\40\164\x69\x64\141\x6b\x20\164\x65\162\x73\145\x64\x69\x61\x20\50\x73\x75\x64\x61\x68\40\x64\151\147\x75\156\x61\x6b\141\156\x29\x2e"]; goto KhHC1; nJUZD: $group = array("\63"); goto tapjJ; GDRl1: $username = trim($siswa->username); goto kL9Ed; SPveC: return $data; goto Aps96; kL9Ed: $password = trim($siswa->password); goto k0dRt; tapjJ: $user_siswa = $this->db->get_where("\x75\x73\145\162\163", "\x65\155\141\151\154\75\x22" . $email . "\42")->row(); goto KXUnR; MemeO: pU5cE: goto SPveC; nuH9a: $additional_data = ["\x66\x69\x72\x73\164\x5f\156\x61\x6d\145" => $first_name, "\x6c\x61\x73\164\x5f\156\x61\x6d\x65" => $last_name]; goto nJUZD; KhHC1: goto pU5cE; goto jPO16; mCFf0: $first_name = $nama[0]; goto tWDx1; jPO16: J_9oB: goto W2X0W; IzNHh: if (!($user_siswa != null)) { goto E4DN2; } goto d9LEA; hvxU2: $data = ["\163\164\141\164\x75\x73" => $reg, "\x6d\163\x67" => !$reg ? "\101\x6b\x75\156\x20" . $siswa->nama . "\40\x67\x61\x67\x61\x6c\x20\x64\151\141\x6b\164\151\146\x6b\141\x6e\56" : "\x41\153\165\x6e\x20" . $siswa->nama . "\40\144\x69\x61\153\x74\151\x66\x6b\x61\156\x2e"]; goto MemeO; Aps96: } public function activate($id) { goto F6GdC; Piszx: $data = $this->aktifkan($siswa); goto Cr0AL; F6GdC: $siswa = $this->users->getDataSiswa($id); goto Piszx; Cr0AL: $this->output_json($data); goto gfdm3; gfdm3: } public function aktifkanSemua() { goto G4L7V; G4L7V: $siswaAktif = $this->users->getSiswaAktif(); goto fQR6j; e_Pr7: $data = ["\163\x74\x61\x74\x75\x73" => true, "\152\165\155\154\x61\x68" => $jum, "\x6d\x73\x67" => $jum . "\40\x73\x69\163\167\x61\40\144\151\141\x6b\164\151\x66\x6b\141\156\x2e"]; goto kJSFo; LRjX7: foreach ($siswaAktif as $siswa) { goto YoFlN; utOQy: hmvI4: goto FYlaY; YoFlN: if (!($siswa->aktif == 0)) { goto hmvI4; } goto IFIwa; Sqzvx: $jum += 1; goto utOQy; IFIwa: $this->aktifkan($siswa); goto Sqzvx; FYlaY: ums0J: goto pnP7e; pnP7e: } goto IOrtl; kJSFo: $this->output_json($data); goto gZrQ1; fQR6j: $jum = 0; goto LRjX7; IOrtl: ugMrA: goto e_Pr7; gZrQ1: } private function nonaktifkan($user, $nama) { goto CbeFB; EnFXM: goto f4IwP; goto YFhpy; iRw62: $data = ["\163\x74\x61\x74\165\163" => false, "\x6d\163\147" => "\101\x6e\144\141\x20\x62\x75\x6b\x61\156\40\141\144\x6d\x69\156\x2e"]; goto EnFXM; lkmiu: $data = ["\163\164\141\164\165\163" => $deleted, "\155\163\147" => $deleted ? "\123\151\x73\167\x61\40" . urldecode($nama) . "\40\x64\151\x6e\157\x6e\x61\x6b\164\151\x66\x6b\141\x6e\x2e" : "\123\151\163\167\x61\40" . urldecode($nama) . "\x20\x67\x61\147\141\x6c\x20\x64\151\x6e\x6f\x6e\x61\153\164\151\146\153\141\x6e\x2e"]; goto KUqAd; Dkb6u: if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) { goto AjE8N; } goto iRw62; CbeFB: if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) { goto ZYZWG; } goto Dkb6u; mEuZr: $data = ["\163\x74\141\164\x75\x73" => false, "\155\x73\x67" => "\131\x6f\165\40\x6d\165\163\164\x20\142\145\x20\141\x6e\x20\141\x64\155\x69\156\x69\163\164\162\141\164\157\162\x20\164\157\40\166\x69\x65\167\x20\x74\x68\151\x73\40\x70\x61\x67\145\x2e"]; goto xxuss; xxuss: KSvX0: goto IUBNC; LG6P0: ZYZWG: goto mEuZr; c_8S2: goto KSvX0; goto LG6P0; ANPrg: $deleted = $this->ion_auth->delete_user($user->id); goto lkmiu; IUBNC: return $data; goto VlfRs; KUqAd: f4IwP: goto c_8S2; YFhpy: AjE8N: goto ANPrg; VlfRs: } public function deactivate($username, $nama) { goto nA2e8; VCINv: $user = $this->users->getUsers($username); goto UeGBk; WW1CM: goto V2EwT; goto wBoju; fDqKn: V2EwT: goto HISYX; UeGBk: $data = $this->nonaktifkan($user, $nama); goto WW1CM; lhe0Y: $data = ["\163\164\141\164\x75\163" => false, "\x6d\x73\x67" => "\131\x6f\165\x20\x6d\x75\163\x74\40\142\x65\x20\x61\x6e\x20\x61\144\155\151\156\x69\163\x74\x72\141\x74\x6f\x72\x20\x74\157\x20\x76\151\145\167\40\x74\150\151\x73\40\x70\x61\147\x65\56"]; goto fDqKn; wBoju: LIwS2: goto lhe0Y; nA2e8: if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) { goto LIwS2; } goto VCINv; HISYX: $this->output_json($data, true); goto WNXYT; WNXYT: } public function reset_login($username, $nama) { goto gosIS; brvcj: $this->db->where("\x6c\x6f\x67\x69\x6e", $username); goto hgqM0; zaySP: goto e939X; goto KgQSi; KgQSi: C1t49: goto fTbOQ; gosIS: if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) { goto C1t49; } goto brvcj; y74St: $data = ["\x73\164\141\x74\165\163" => false, "\155\163\x67" => "\125\x73\x65\x72\x20" . $nama . "\40\147\x61\147\x61\154\x20\x64\x69\162\x65\163\145\x74"]; goto e885R; Y2Bjj: Zqp5Y: goto MRRrC; bygtD: jJw1F: goto zaySP; MRRrC: $data = ["\x73\x74\x61\164\x75\x73" => true, "\155\x73\x67" => "\x55\163\145\162\x20" . $nama . "\40\x62\145\x72\150\x61\x73\x69\154\40\144\x69\162\x65\163\145\x74"]; goto bygtD; hgqM0: if ($this->db->delete("\x6c\x6f\147\151\156\x5f\x61\164\x74\145\x6d\x70\164\163")) { goto Zqp5Y; } goto y74St; fTbOQ: $data = ["\x73\x74\141\164\x75\x73" => false, "\155\163\147" => "\131\157\x75\40\x6d\x75\x73\164\x20\142\145\40\x61\x6e\x20\x61\x64\x6d\x69\156\151\163\164\x72\x61\x74\x6f\x72\40\164\x6f\x20\166\151\x65\x77\40\x74\x68\x69\x73\40\x70\x61\x67\x65\x2e"]; goto nOZ65; phrlA: $this->output_json($data, true); goto Eahra; nOZ65: e939X: goto phrlA; e885R: goto jJw1F; goto Y2Bjj; Eahra: } public function nonaktifkanSemua() { goto hP1uP; ZxFLi: $data = ["\163\x74\x61\x74\165\x73" => true, "\152\x75\x6d\154\x61\x68" => $jum, "\155\x73\147" => $jum . "\x20\x73\151\x73\x77\x61\x20\x64\151\x6e\x6f\156\x61\153\x74\x69\146\x6b\x61\x6e\x2e"]; goto yLELa; yLELa: $this->output_json($data); goto HDNxv; ZtQz8: foreach ($siswaAktif as $siswa) { goto eYp8t; g8nHQ: $jum += 1; goto OwyPG; nGggI: Lqlk9: goto BTpAL; KjxFx: goto G70UM; goto qho89; OwyPG: G70UM: goto nGggI; BTpAL: ETdfS: goto Yqj6z; eYp8t: if (!($siswa->aktif > 0)) { goto Lqlk9; } goto u5y12; qho89: d7qQq: goto g8nHQ; jgEBS: $this->output_json($del); goto KjxFx; u5y12: $del = $this->nonaktifkan($siswa, $siswa->nama); goto m4h5D; m4h5D: if ($del["\163\164\141\x74\165\x73"]) { goto d7qQq; } goto jgEBS; Yqj6z: } goto TJ8Oo; s33Qc: $jum = 0; goto ZtQz8; TJ8Oo: CrHdV: goto ZxFLi; hP1uP: $siswaAktif = $this->users->getSiswaAktif(); goto s33Qc; HDNxv: } public function edit($id) { goto gKXA5; c7KCD: $user = $this->ion_auth->user()->row(); goto CGc_U; vfios: $this->load->view("\155\x65\155\x62\145\x72\x73\x2f\x67\x75\x72\x75\x2f\164\x65\x6d\160\x6c\141\x74\x65\163\x2f\x66\157\x6f\x74\x65\162"); goto ETqUB; NIxTs: $data["\x74\x70\137\141\x63\164\151\x76\x65"] = $tp; goto UYSgV; wM78V: ge4lG: goto gETBL; MwlGk: $guru = $this->dashboard->getDataGuruByUserId($user->id, $tp->id_tp, $smt->id_smt); goto iDzfZ; UYSgV: $data["\x73\155\x74"] = $this->dashboard->getSemester(); goto NvdFB; M8hjP: if ($this->ion_auth->is_admin()) { goto lLa77; } goto MwlGk; p7XE4: $this->load->view("\x5f\164\145\155\x70\154\141\x74\x65\x73\x2f\x64\141\163\x68\x62\157\x61\162\x64\x2f\137\150\145\x61\144\145\162", $data); goto vxe7W; tDHm0: $data["\x74\160"] = $this->dashboard->getTahun(); goto NIxTs; Gn0XY: $this->load->view("\137\164\x65\x6d\160\x6c\141\164\x65\163\57\144\x61\163\x68\142\x6f\x61\162\144\57\137\x66\157\x6f\x74\x65\x72"); goto wM78V; ETqUB: goto ge4lG; goto gv7ES; JXG7Z: $siswa = $this->master->getDataSiswaById($tp->id_tp, $smt->id_smt, $id); goto c7KCD; deQIt: $smt = $this->dashboard->getSemesterActive(); goto JXG7Z; CGc_U: $data = ["\x75\x73\x65\x72" => $user, "\x6a\x75\144\x75\154" => "\x55\x73\145\x72\x20\x4d\x61\156\141\147\145\155\x65\x6e\164", "\x73\165\142\x6a\x75\144\165\154" => "\x45\144\151\x74\x20\104\141\164\x61\40\x55\x73\145\x72", "\x73\x65\164\164\x69\x6e\147" => $this->dashboard->getSetting()]; goto s2OTg; s2OTg: $data["\163\x69\163\x77\x61"] = $siswa; goto tDHm0; TRXgE: $this->load->view("\165\x73\x65\162\163\x2f\163\x69\x73\167\141\57\145\x64\151\x74"); goto vfios; gKXA5: $tp = $this->dashboard->getTahunActive(); goto deQIt; NvdFB: $data["\x73\155\164\137\x61\143\x74\151\166\x65"] = $smt; goto M8hjP; gv7ES: lLa77: goto S2a0E; iDzfZ: $data["\x67\x75\x72\x75"] = $guru; goto K4Dlp; vxe7W: $this->load->view("\165\163\145\162\163\57\163\x69\x73\x77\x61\57\x65\144\x69\164"); goto Gn0XY; S2a0E: $data["\x70\162\x6f\146\151\x6c\145"] = $this->dashboard->getProfileAdmin($user->id); goto p7XE4; K4Dlp: $this->load->view("\x6d\x65\155\x62\145\x72\163\x2f\147\x75\162\x75\x2f\x74\x65\155\x70\x6c\141\x74\145\x73\x2f\x68\145\x61\x64\x65\162", $data); goto TRXgE; gETBL: } public function update() { goto LkyDM; KfUbZ: $username = $this->input->post("\x75\163\x65\162\156\141\155\145", true); goto aseN4; zxAWj: $newPass = $this->input->post("\156\x65\x77", true); goto ErpCK; aseN4: $oldPass = $this->input->post("\x6f\154\x64", true); goto zxAWj; PsYSF: $this->form_validation->set_rules("\x6e\145\167", "\120\x61\163\x73\x77\x6f\162\144\x20\x42\141\x72\165", "\x72\x65\x71\165\151\x72\x65\144\x7c\x6e\x75\155\x65\x72\x69\x63\x7c\164\162\151\x6d\174\155\151\156\x5f\x6c\x65\156\x67\x74\150\133\x36\x5d"); goto AbrKC; ErpCK: $this->form_validation->set_rules("\165\163\x65\x72\156\141\155\145", "\x55\163\145\162\x6e\141\x6d\x65", "\x72\145\x71\165\x69\162\x65\x64\x7c\156\x75\x6d\x65\162\x69\143\174\164\162\151\x6d\174\x6d\151\156\137\x6c\x65\156\x67\164\150\x5b\66\135\174\x69\x73\x5f\165\x6e\151\x71\165\x65\133\x6d\141\x73\x74\x65\x72\x5f\x73\x69\163\x77\141\56\x75\163\145\162\x6e\141\155\145\135"); goto cj7np; cj7np: $this->form_validation->set_rules("\x6f\154\x64", "\x50\x61\163\163\167\157\x72\144\40\114\141\x6d\141", "\x72\x65\x71\165\x69\x72\145\144\174\x6e\165\x6d\x65\x72\151\143\x7c\x74\x72\x69\x6d\174\x6d\x69\156\x5f\x6c\x65\x6e\147\164\x68\133\x36\135"); goto PsYSF; LkyDM: $id_siswa = $this->input->post("\151\144\x5f\163\151\x73\167\x61", true); goto KfUbZ; AbrKC: } public function change_password() { goto MrCI1; ozz2W: AAfVA: goto rjjQ_; pzHfh: $this->form_validation->set_rules("\156\x65\167", $this->lang->line("\x63\150\141\x6e\x67\x65\x5f\x70\x61\163\x73\x77\157\162\144\x5f\166\141\x6c\151\144\141\x74\151\x6f\x6e\137\156\145\167\137\x70\141\x73\163\167\157\x72\x64\x5f\x6c\141\x62\x65\x6c"), "\162\x65\x71\165\x69\x72\x65\144\174\x6d\x69\156\x5f\x6c\145\x6e\147\x74\x68\133" . $this->config->item("\x6d\151\x6e\137\160\x61\163\163\167\157\162\x64\137\154\145\156\x67\164\150", "\x69\x6f\x6e\x5f\141\165\164\x68") . "\135\x7c\155\x61\x74\143\x68\145\163\x5b\x6e\x65\167\137\143\x6f\156\146\x69\162\x6d\135"); goto gqc0h; zWE_K: iTwer: goto XJg2R; XJg2R: $data = ["\163\x74\x61\x74\x75\163" => false, "\145\x72\x72\157\162\x73" => ["\157\x6c\x64" => form_error("\x6f\x6c\x64"), "\156\x65\x77" => form_error("\156\145\167"), "\156\145\x77\x5f\143\x6f\x6e\x66\151\162\x6d" => form_error("\156\145\167\x5f\x63\157\156\x66\x69\x72\155")]]; goto ozz2W; QgXm_: goto ou_Ye; goto U2cUa; mqYai: if ($this->form_validation->run() === FALSE) { goto iTwer; } goto WI6yn; WI6yn: $identity = $this->session->userdata("\151\x64\x65\x6e\x74\151\x74\x79"); goto Nn_K6; bPfrh: if ($change) { goto DOnC2; } goto rB6So; Nn_K6: $change = $this->ion_auth->change_password($identity, $this->input->post("\x6f\154\x64"), $this->input->post("\156\145\x77")); goto bPfrh; rB6So: $data = ["\163\x74\x61\164\x75\x73" => false, "\x6d\x73\147" => $this->ion_auth->errors()]; goto QgXm_; YhcOk: $data["\163\164\141\164\165\x73"] = true; goto jMwZT; U2cUa: DOnC2: goto YhcOk; Nbfsi: goto AAfVA; goto zWE_K; jMwZT: ou_Ye: goto Nbfsi; rjjQ_: $this->output_json($data); goto oHC23; gqc0h: $this->form_validation->set_rules("\156\x65\167\x5f\143\x6f\x6e\x66\151\162\x6d", $this->lang->line("\143\x68\x61\156\147\x65\137\x70\x61\163\163\x77\157\x72\144\x5f\x76\x61\x6c\151\144\x61\164\x69\157\156\x5f\x6e\145\167\137\160\x61\163\x73\167\x6f\162\x64\x5f\x63\x6f\x6e\x66\x69\x72\x6d\x5f\x6c\x61\142\x65\154"), "\162\x65\x71\165\151\162\145\x64"); goto mqYai; MrCI1: $this->form_validation->set_rules("\x6f\154\144", $this->lang->line("\143\x68\x61\156\x67\x65\x5f\160\141\x73\163\167\157\x72\144\137\x76\x61\154\151\144\141\164\x69\x6f\x6e\137\x6f\x6c\x64\137\160\141\163\x73\x77\157\x72\x64\x5f\x6c\x61\142\x65\154"), "\x72\145\161\x75\x69\x72\145\x64"); goto pzHfh; oHC23: } public function delete($id) { goto T8AJr; hghFG: $data["\x73\x74\x61\x74\165\x73"] = $this->ion_auth->delete_user($id) ? true : false; goto H0oTW; H0oTW: $this->output_json($data); goto nbPqT; T8AJr: $this->is_has_access(); goto hghFG; nbPqT: } private function hash_password($password) { goto Uuf7Y; JMFGD: ikAY7: goto HnJVk; HnJVk: return password_hash($password, PASSWORD_BCRYPT); goto eEwOP; Uuf7Y: if (!(empty($password) || strpos($password, "\0") !== FALSE || strlen($password) > 4096)) { goto ikAY7; } goto TPzjE; TPzjE: return FALSE; goto JMFGD; eEwOP: } }