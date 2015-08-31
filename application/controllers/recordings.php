<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Recordings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
		$this->load->model('site');
		$this->load->model('recording');	
	}

	public function index()
	{
		//runs sql query to pull all weather information for station
		$documents = $this->site->get_documents();
		$temp = array();

		//converters the sql query results to 
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

	public function search($id)
	{
		$temp = array();
		$degree_map = array();
		$speed_map= array();

		//load additional site data
		$documents = $this->recording->get_document_id_top($id);
		$json_map = json_encode($this->json($documents));

		//assigns value from db to json
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
		
		$data = array(
			'locations'=>$temp,
			'id'=>$id);


		$this->load->view('index');
		$this->load->view('navbar');	
		$this->load->view('graph_script',$data);		
		$this->load->view('partials/site_info',$data);
		$this->load->view('windrose');
		$this->load->view('partials/footer');
	}


	//converts output from database to json objects for d3 map
	public function json($documents)
	{
		//setting up object for d3 windrose
		for($i = 0; $i<370; $i += 10)
		{
			$degree_map[$i] = 0;
			$speed_map[$i] = 0;
		}

		$table_data = array();

		//creating objects with tallied wind data
		foreach ($documents as $json) {
			$document = json_decode($json['document']);

			if(!array_key_exists('error', $document->response))
			{			
				$degree_map[round($document->current_observation->wind_degrees,-1)] += 1;
				// This add the mpg to the total.  can be biased if wind blows really hard in one day
				$speed_map[round($document->current_observation->wind_degrees,-1)] += $document->current_observation->wind_mph;

			//creates an php object from the json data
			$dump = array(
				"time" => $document->current_observation->local_time_rfc822,
				"weather" => $document->current_observation->weather,
				"temp_f" => $document->current_observation->temp_f,
				"wind_dir" => $document->current_observation->wind_dir,
				"wind_mph" => $document->current_observation->wind_mph,
				"wind_gust_mph" => $document->current_observation->wind_gust_mph,
				);
			}
			array_push($table_data,$dump);
		}


		//hack to get 0 degrees to work
		unset($degree_map[0]);
		unset($speed_map[0]);

		//insert function to sort array
		$table_sorted = $this->table_sort($table_data);


		$map = array($degree_map,$speed_map,'table_data'=>$table_sorted);	


		return $map;	
	}

	public function table_sort($table_data)
	{
		//NOTE: THIS FUNCTION IS VERY INEFFICIENT. CAN USE SOME REFACTORING
		$temp = array($table_data[0]);

		for($i=1; $i < count($table_data); $i++)
		{
			for($j=0; $j < count($temp); $j++)
			{
				//if new data is greater than wind speed, slice ahead 
				if($table_data[$i]['wind_mph'] >= $temp[$j]['wind_mph'])
				{
					array_splice($temp, $j, 0, array($table_data[$i]));
					$j = count($temp); 
				}
				//if it isn't bigger than anything, then just add it to the end of the arry
				elseif($j == (count($temp) - 1))
				{
					array_push($temp,$table_data[$i]);
					$j++;
				}
			}
		}	


		return array_slice($temp, 0, 9);	

	}

	public function find($id)
	{
		//recovering post data. might only exists if user refines search
		if (isset($_POST['startdate']))
		{
			if ($_POST['startdate'] == '')
			{
			    $startdate = gmdate("Y-m-d H:i:s",strtotime("last week"));
			}		
			else
			{
		    	$startdate = gmdate("Y-m-d H:i:s",strtotime($this->input->post('startdate')));
			}

			if ($_POST['enddate'] == '')
			{
			    $enddate = gmdate("Y-m-d H:i:s",strtotime("06/01/2115"));	
			}		    
			else
			{					
					$enddate = strtotime('+1 day', strtotime($this->input->post('enddate')));
					$enddate = gmdate("Y-m-d H:i:s",$enddate);
				
			}
		}

		//queries to load documents
		if(!isset($startdate))
		{
			$startdate = gmdate("Y-m-d H:i:s",strtotime("last week"));	
			$enddate = gmdate("Y-m-d H:i:s",strtotime("06/01/2115"));		
			$documents = $this->recording->get_document_id_date($id,$startdate,$enddate);		}
		else
		{
			$documents = $this->recording->get_document_id_date($id,$startdate,$enddate);
		}

		//creates wind data and ranks things
		$results = $this->json($documents);

		$results = json_encode($results);

		$data = array(
			'json'=> $results);

		$this->load->view('partials/json',$data);
	}

	public function array_sort($array, $on, $order=SORT_ASC)
	{
	    $new_array = array();
	    $sortable_array = array();
	}
	   
}
//end of main controller