<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogo extends CI_Controller {


    function index()
    {
        $this->load->view('catalogo');
    }

    function envia(){
        print_r($_POST);
    }
}