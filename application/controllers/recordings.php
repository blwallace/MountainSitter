<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Recordings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
		$this->load->model('site');
		$this->load->model('recording');

	}

	public function index()
	{
		$documents = $this->site->get_documents();
		// var_dump($documents);
		$temp = array();

		foreach($documents as $json)
		{
			$document = json_decode($json['document']);

			$log = array(
				'name'=>$document->current_observation->display_location->full,
				'weather'=>$document->current_observation->weather,				
				'temp'=>$document->current_observation->temp_f);
			array_push($temp,$log);
		}

		$data = array(
			'locations'=>$temp);

		$this->load->view('index');
		$this->load->view('recording',$data);
		// $this->load->view('document',$data);
	}

	public function show($id)
	{
		$documents = $this->recording->get_document_id($id);
		// var_dump($documents);
		$temp = array();

		foreach($documents as $json)
		{
			$document = json_decode($json['document']);

			$log = array(
				'name'=>$document->current_observation->display_location->full,
				'time'=>$document->current_observation->local_time_rfc822,
				'weather'=>$document->current_observation->weather,				
				'temp'=>$document->current_observation->temp_f);
			array_push($temp,$log);
		}

		$data = array(
			'locations'=>$temp);

		$this->load->view('index');
		$this->load->view('recording',$data);		
	}

}

//end of main controller