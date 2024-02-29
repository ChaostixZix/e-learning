<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Video extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->ion_auth->logged_in()) {
            goto kiB6L;
        }
        redirect("auth");
        kiB6L:
        $this->load->library(["datatables", "form_validation"]);
        $this->load->model("Master_model", "master");
        $this->load->model("Dashboard_model", "dashboard");
        $this->load->model("Cbt_model", "cbt");
        $this->load->model("Log_model", "logging");
        $this->load->model("Kelas_model", "kelas");
        $this->load->model("Dropdown_model", "dropdown");
        $this->form_validation->set_error_delimiters('', '');
    }
    public function index($param = null)
    {
        $user = $this->ion_auth->user()->row();
        if ($this->ion_auth->is_admin() || $this->ion_auth_model->in_group('guru')) {
            $data = [
                "user" => $user,
                "judul" =>
                "Tahun Pelajaran dan Semester",
                "subjudul" => "Atur Tahun Pelajaran dan Semester",
                "profile" => $this->dashboard->getProfileAdmin($user->id),
                "setting" => $this->dashboard->getSetting(),
                "kelas" => $this->uri->segment(3),
                "role" => $this->ion_auth->is_admin() || $this->ion_auth->in_group('guru')
            ];
            $tp = $this->dashboard->getTahunActive();
            $smt = $this->dashboard->getSemesterActive();
            $data["tp"] = $this->dashboard->getTahun();
            $data["tp_active"] = $tp;
            $data["smt"] = $this->dashboard->getSemester();
            $data["smt_active"] = $smt;
            $jml = $this->master->getJmlHariEfektif($tp->id_tp . $smt->id_smt);
            $data["jml_hari"] = $jml == null ? "0" : $jml->jml_hari_efektif;
            $this->load->view("_templates/dashboard/_header", $data);
            $this->load->view("kelas/video/video", $data);
            $this->load->view("_templates/dashboard/_footer");
        }
        if ($this->ion_auth_model->in_group('siswa')) {
            // echo 'test';
            $data = [
                "user" => $user,
                "judul" =>
                "Tahun Pelajaran dan Semester",
                "subjudul" => "Atur Tahun Pelajaran dan Semester",
                "setting" => $this->dashboard->getSetting(),
                "kelas" => $this->uri->segment(3),
                "role" => $this->ion_auth->is_admin() || $this->ion_auth->in_group('guru')
            ];
            $this->load->view("members/siswa/templates/header", $data);
            $this->load->view("kelas/video/video", $data);
            $this->load->view("members/siswa/templates/footer");
        }
    }
}
