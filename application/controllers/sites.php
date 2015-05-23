<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sites extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
		$this->load->model('site');
	}

	public function index()
	{
		$sites = $this->site->get_sites();

		$data = array(
			'sites' => $sites);

		$this->load->view('index');
		$this->load->view('sites',$data);
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
				$elevation = $contents->current_observation->display_location->elevation;
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
				$error_log = array('Inactive Station');
	            $this->session->set_flashdata("site_error", $error_log);
	            redirect('/sites');
			}

        }

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
		//
		$json_string = file_get_contents("http://api.wunderground.com/api/de7ee2cef1184d4c/conditions/q/pws:MMSSKI.json");
		$this->site->add_document($json_string);

		$this->load->view('index');
		$this->load->view('sites');

		$documents = $this->site->get_documents();

		$temp = array();
        foreach ($documents as $document)
        {
        	$contents = json_decode($document['document']);
        	$content = $contents->current_observation->weather;
        	$tempf = $contents->current_observation->temp_f;
        	array_push($temp,"Conditions: " . $content . "--- Temp: ".$tempf);
        }
        var_dump($temp);
	}
}

//end of main controller