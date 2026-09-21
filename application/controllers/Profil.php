<?php
class Profil extends CI_Controller {
    public function index() {
        if (!$this->session->userdata('id_user')) { redirect('auth/login'); }
        $this->load->view('templates/header');
        $this->load->view('profil');
        $this->load->view('templates/footer');
    }
}