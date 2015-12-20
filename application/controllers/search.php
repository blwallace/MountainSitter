<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
	}

	public function index()
	{

		
		$this->load->view('headers/index');
		$this->load->view('headers/navbar');
		$this->load->view('contents/search');
		$this->load->view('footers/footer');
	}
}

//end of main controller