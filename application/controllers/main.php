<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
	}

	public function index()
	{
		// var_dump($this);
		$this->load->view('headers/index');
		$this->load->view('headers/top_content');
		$this->load->view('footers/footer');
	}
}

//end of main controller