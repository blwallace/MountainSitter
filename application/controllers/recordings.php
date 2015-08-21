<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Recordings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
		$this->load->model('site');
		$this->load->model('recording');
		$this->load->view('footer');

	}

	public function index()
	{
		$documents = $this->site->get_documents();
		$temp = array();


		foreach($documents as $json)
		{
			$document = json_decode($json['document']);

			$log = array(
				'name'=>$document->current_observation->display_location->full,
				'time'=>$document->current_observation->local_time_rfc822,				
				'weather'=>$document->current_observation->weather,				
				'temperature'=>$document->current_observation->temp_f);
			array_push($temp,$log);
		}

		$data = array(
			'locations'=>$temp);

		$this->load->view('index');
		$this->load->view('recording',$data);
		$this->load->view('footer');
	}

	public function show($id)
	{
		$documents = $this->recording->get_document_id($id);
		$temp = array();
		$d3_data = array();
		$degree_map = array();
		$speed_map= array();

		for($i = 0; $i<370; $i += 10)
		{
			$degree_map[$i] = 0;
			$speed_map[$i] = 0;
		}


		//creating objects with tallied wind data
		foreach ($documents as $json) {
			$document = json_decode($json['document']);

			if(!array_key_exists('error', $document->response))
			{			
				// if($document->current_observation->wind_degrees == 0)
				// {
				// 	var_dump($document);
				// }

				$degree_map[round($document->current_observation->wind_degrees,-1)] += 1;
				// This add the mpg to the total.  can be biased if wind blows really hard in one day
				$speed_map[round($document->current_observation->wind_degrees,-1)] += $document->current_observation->wind_mph;
			}
		}

		//hack to get 0 degrees to work
		unset($degree_map[0]);
		unset($speed_map[0]);

		$map = array($degree_map,$speed_map);
		$json_map = json_encode($map);

		// var_dump($json_map);
		foreach($documents as $json)
		{
			$document = json_decode($json['document']);

			//does not load a bad measurement
			if(!array_key_exists('error', $document->response))
			{

				//load the array with info temp info
				$log = array(
					'id' => $json['id'],
					'name'=>$document->current_observation->display_location->full,
					'time'=>$document->current_observation->local_time_rfc822,
					'epoch'=>$document->current_observation->observation_epoch,
					'weather'=>$document->current_observation->weather,				
					'temperature'=>$document->current_observation->temp_f);


				//load array info with wind info
				array_push($temp,$log);
			}
		}



		// //d3 visualization
		// foreach($documents as $json)
		// {
		// 	$document = json_decode($json['document']);

		// 	$log = array(
		// 		$document->current_observation->observation_epoch,
		// 		$document->current_observation->temp_f);
		// 	array_push($d3_data,$log);
		// }		

		$data = array(
			'locations'=>$temp,
			'd3_datas'=>$d3_data,
			'windhistory'=>$json_map);

		$this->load->view('index');
		$this->load->view('recording',$data);		
		$this->load->view('footer');
	}

	public function dates()
	{
		$start = $this->input->post('startdate');
		$end = $this->input->post('enddate');		

		var_dump($start);
	}

}

//end of main controller