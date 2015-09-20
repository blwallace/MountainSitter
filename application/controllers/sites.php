<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sites extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
		$this->load->model('site');

	}

	public function index()
	{
		$sites = $this->site->get_sites();

		$data = array(
			'sites' => $sites);

		$this->load->view('headers/index');
		$this->load->view('headers/navbar');
		$this->load->view('contents/sites',$data);
		$this->load->view('footers/footer');
	}

	//Admin inputs wunderground PWS.  App adds site to maintained list.
	public function add()
	{
		//form rules

		$this->load->library('form_validation');
		$this->form_validation->set_rules('site','Site','required|is_unique[sites.site_name]');
		$this->form_validation->set_message('is_unique', '%s is already loaded');  

        if($this->form_validation->run() === FALSE) //displays error message if form validation rules were violated
        {
            $this->view_data["errors"] = validation_errors();
            $error_log = validation_errors();
            $this->session->set_flashdata("site_error", $error_log);
            redirect('/sites');
        }

        else
        {

			$site = $this->input->post(null,true);
			$site = strtoupper($site['site']);

			// //gets json string
			$json_string = file_get_contents("http://api.wunderground.com/api/de7ee2cef1184d4c/conditions/q/pws:" . $site . ".json");

			//converts json string into php object
			$contents = json_decode($json_string);        	
			//run json validation.

			$match_search = $this->json_validation($contents);

			if ($match_search === true)
			{
				//stores json object in database
				$city = $contents->current_observation->display_location->city;
				$country = $contents->current_observation->display_location->country;
				$country_iso3166 = $contents->current_observation->display_location->country_iso3166;
				$elevation = $contents->current_observation->observation_location->elevation;
				$full = $contents->current_observation->display_location->full;
				$latitude = $contents->current_observation->display_location->latitude;
				$longitude = $contents->current_observation->display_location->longitude;			
				$state = $contents->current_observation->display_location->state;
				$station_id= $contents->current_observation->station_id;

				$data = array(
					'city'=>$city,
					'country'=>$country,
					'country_iso3166'=>$country_iso3166,
					'elevation'=>$elevation,
					'full'=>$full,
					'latitude'=>$latitude,
					'longitude'=>$longitude,
					'state'=>$state,
					'station_id'=>$station_id);

				$this->site->add_site($data);

				redirect('/sites');
			}
			else
			{
				$error_log = "Station not working";
	            $this->session->set_flashdata("site_error", $error_log);
	            redirect('/sites');
			}

        }

	}

	public function locate()
	{
		$results = $this->input->post(null,true);

		$name_search = $results['name'];
		$lat_search = $results['lat'];
		$lon_search = $results['lon'];

		// $name_search = 'test';
		// $lat_search = 15 ;
		// $lon_search = 15;

		$name_site = '';
		$lat_site = 0;
		$lon_site = 0;

		$temp_arr = array();

		$sites = $this->site->get_sites();

		for($i=0;$i<count($sites);$i++)
		{
			$id = $sites[$i]['id'];
			$name_site = $sites[$i]['full'];
			$lat_site = $sites[$i]['latitude'];
			$lon_site = $sites[$i]['longitude'];
			$station_id = $sites[$i]['station_id'];

			$distance = $this->distance($lat_search, $lon_search, $lat_site, $lon_site, "M");

			$dis_arr = array(
				'id'=>$id,
				'distance'=>$distance,
				'location'=>$name_site,
				'station_id' => $station_id);

			array_push($temp_arr,$dis_arr);
		}

		$data = $this->table_sort($temp_arr);

		$data = array(
			'json' => json_encode($data));

		$this->load->view('partials/json',$data);
	}

	public function json_validation($contents)
	{
		//valid json response
		$response = $contents->response;

		if (property_exists($response,'error'))
		{
			return false;
		}

			return true;

	}

	public function add_document()
	{
		// $sites = $this->site->get_sites();
		$sites = $this->site->get_active_sites_limited();

		foreach ($sites as $site)
		{
			$station_id = $site['site_name'];
			$json_string = file_get_contents("http://api.wunderground.com/api/de7ee2cef1184d4c/conditions/q/pws:" .$station_id.".json");

			$json = json_decode($json_string);

			if(array_key_exists('weather', $json->current_observation))
				{
				$this->site->add_document($json_string,$site['id']);
				$this->site->update_refresh($site['id']);
				}
		}

		$documents = $this->site->get_documents();

	}

	public function deactivate($id)	
	{
		$this->site->deactivate_site($id);
		redirect('/sites');
	}

	public function activate($id)
	{
		$this->site->activate_site($id);
		redirect('/sites');		
	}

	public function delete($id)
	{
		$this->site->delete_site($id);
		$this->deactivate($id);
		redirect('/sites');
	}

	public function deleted()
	{
		$sites = $this->site->get_deleted_sites();

		$data = array(
			'sites' => $sites);

		$this->load->view('index');
		$this->load->view('sites',$data);
	}

	public function revive($id)
	{
		$this->site->revive_site($id);
		$this->activate($id);

		redirect('/sites/deleted');
	}

	public function distance($lat1, $lon1, $lat2, $lon2, $unit) 
	{

	  $theta = $lon1 - $lon2;
	  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	  $dist = acos($dist);
	  $dist = rad2deg($dist);
	  $miles = $dist * 60 * 1.1515;
	  $unit = strtoupper($unit);

	  if ($unit == "K") {
	    return ($miles * 1.609344);
	  } else if ($unit == "N") {
	      return ($miles * 0.8684);
	    } else {
	        return round($miles);
	      }
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
				if($table_data[$i]['distance'] <= $temp[$j]['distance'])
				{
					array_splice($temp, $j, 0, array($table_data[$i]));

					$j = count($temp); 
				}
				//if it isn't bigger than anything, then just add it to the end of the arry
				elseif($j == (count($temp) - 1))
				{
					array_push($temp,$table_data[$i]);
					$j = count($temp);
				}
			}
		}	

		// $sorted_arr = array_slice($temp, 0, 9);
		// $final_array = array();

		// foreach($sorted_arr as $key=> $value)
		// {
		// 	$date = $this->date_localizer($value['time']);
		// 	$time = $date['time'];
		// 	$date = $date['date'];

		// 	$temp_arr = array(
		// 				'date' =>$date,
		// 				'time' =>$time,
		// 				'weather' =>$value['weather'],
		// 				'temp_f' =>$value['temp_f'],
		// 				'wind_dir' =>$value['wind_dir'],
		// 				'wind_mph' =>$value['wind_mph'],
		// 				'wind_gust_mph' =>$value['wind_gust_mph']
		// 					);

		// 	array_push($final_array,$temp_arr);
		// }


		return $temp;	

	}
}	
//end of main controller