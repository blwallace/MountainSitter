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

		$this->load->view('headers/index');
		$this->load->view('contents/recording',$data);
		$this->load->view('footers/footer');
	}

	public function search($id)
	{
		$temp = array();
		$degree_map = array();
		$speed_map= array();

		//load additional site data. only loads one line
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
					'temperature'=>$document->current_observation->temp_f,
					'elevation'=>$document->current_observation->observation_location->elevation,
					'station_id'=>$document->current_observation->station_id,
					'latitude' => $document->current_observation->display_location->latitude,
					'longitude' => $document->current_observation->display_location->longitude						
					);


				//load array info with wind info
				array_push($temp,$log);
			}
		}
		
		$data = array(
			'locations'=>$temp,
			'id'=>$id);


		$this->load->view('headers/index');
		$this->load->view('headers/navbar');	
		$this->load->view('headers/graph_script',$data);		
		$this->load->view('partials/site_info',$data);
		$this->load->view('contents/weather_overview');
		$this->load->view('contents/windrose');
		$this->load->view('footers/footer');
	}


//this returns a json with all the information to load the page
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
			// if((!array_key_exists('error', $document->response)) )
			if((!array_key_exists('error', $document->response)) && ($document->current_observation->wind_degrees >= 0))
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
				// "conditions" => $document->current_observation->
				);

			array_push($table_data,$dump);
			}
			
		}
		//hack to get 0 degrees to work
		unset($degree_map[0]);
		unset($speed_map[0]);

		//insert function to sort array
		$table_sorted = $this->table_sort($table_data);
		$daily_table_sorted = $this->table_sort_all_weather($table_data);

		// var_dump($daily_table_sorted);

		$map = array($degree_map,$speed_map,'table_data'=>$table_sorted, 'table_data_days' => $daily_table_sorted);	

		return $map;	
	}

	//ranks highest wind speeds
	public function table_sort($table_data)
	{
		//NOTE: THIS FUNCTION IS VERY INEFFICIENT. CAN USE SOME REFACTORING
		$temp = array($table_data[0]);

		for($i=1; $i < count($table_data); $i++)
		{
			for($j=0; $j < count($temp); $j++)
			{
				if(($table_data[$i]['wind_mph'] < $temp[$j]['wind_mph']) && ( (strtotime($table_data[$i]['time']) - strtotime($temp[$j]['time'])) < (60*60*6)))
				{
					$j++;
				}

				//if new data is greater than wind speed, slice ahead 
				elseif($table_data[$i]['wind_mph'] >= $temp[$j]['wind_mph'])
				{
					if( (strtotime($table_data[$i]['time']) - strtotime($temp[$j]['time'])) < (60*60*12))
					{
						$temp[$j] = $table_data[$i];
					}
					else
					{
						array_splice($temp, $j, 0, array($table_data[$i]));
					}
					
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

	public function table_sort_all_weather($table_data)
	{
		$temp1 = array(
			"tempf_high" => $table_data[0]['temp_f'],
			"tempf_low" => $table_data[0]['temp_f'],
			"windspeed_high" => $table_data[0]['wind_mph'],
			// "conditions" => $table_data[0]['conditions'],
			// "precipitation" => $table_data[0]['precip'],
				);

		$date = $this->date_localizer($table_data[0]['time']);

		$temp = array(
			$date => $temp1);

		//double for loop
		for($i=1; $i < count($table_data); $i++)
				{

					//date of new array
					$date = $this->date_localizer($table_data[$i]['time']);

					// echo $date . ":" . $table_data[$i]['wind_mph'] . "</br>";

						if (!$this->date_exist($temp,$date))
						{
							//if high temp is higher than recorded, replace and then move on
							if($table_data[$i]['temp_f'] >= $temp[$date]['tempf_high'])
							{
								//replace
								$temp[$date]['tempf_high'] = $table_data[$i]['temp_f'];
							}		
							//if low temp is lower than recorded, replace and then move on
							if($table_data[$i]['temp_f'] <= $temp[$date]['tempf_low'])
							{
								//replace
								$temp[$date]['tempf_low'] = $table_data[$i]['temp_f'];
							}		
							//record highest wind speed
							if($table_data[$i]['wind_mph'] >= $temp[$date]['windspeed_high'])
							{
								//replace
								$temp[$date]['windspeed_high'] = $table_data[$i]['wind_mph'];
							}																			
						}

						else
						{
							$temp[$date] = array(
										"tempf_high" => $table_data[$i]['temp_f'],
										"tempf_low" => $table_data[$i]['temp_f'],
										"windspeed_high" => $table_data[$i]['wind_mph'],
										// "conditions" => $table_data[$i]['conditions'],
										// "precipitation" => $table_data[$i]['precip'],
											);	
						}						
				}	

		return $temp;

	}

	public function date_exist($array, $date)
	{
		$bool = true;

		foreach($array as $key => $value)
		{
			if($key == $date)
			{	
				$bool = false;
			}
		}

		return $bool;
	}
	//converts full date format to a local Month, DD, YYYY
	public function date_localizer($base_date)
	{

		$date = substr($base_date, 0, -2);

		$zone1 = substr($date, -1, 1);

		$zone2 = 10 * substr($date, -2, 1);

		$mult = substr($date, -3, 1);

		$zone = $zone1 + $zone2;

		if($mult == "-")
		{
			$zone = $zone * -1;
		}

		$local_time = strtotime($base_date) + ($zone * 60 * 60);

		return date("D m/d/y",$local_time);
	}
	   
}
//end of main controller