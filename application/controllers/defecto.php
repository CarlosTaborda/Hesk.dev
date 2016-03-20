<?php

class Defecto extends CI_Controller
{
   public function index(){
      $this->load->view('layouts/header');
      $this->load->view('defecto/index');
      $this->load->view('layouts/footer');
   }
}

