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
		$this->load->view('index');
		$this->load->view('top_content');
		$this->load->view('partials/footer');
	}
}

//end of main controller