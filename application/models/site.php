<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Model {


	public function add_site($data)
	{
		$query = 'INSERT INTO sites (site_name,city,country,country_iso3166,elevation,full,latitude,longitude,state,station_id,created_at,updated_at) VALUES (?,?,?,?,?,?,?,?,?,?,Now(),Now())';
		$values = array($data['station_id'],$data['city'],$data['country'],$data['country_iso3166'],$data['elevation'],$data['full'],$data['latitude'],$data['longitude'],$data['state'],$data['station_id']);
		return $this->db->query($query,$values);
	}

	public function get_sites()
	{
		$query= 'SELECT * from sites';
		return $this->db->query($query)->result_array();
	}

	public function search_site($pws)
	{
		$query = "SELECT * from sites where sites.site_name like ?";
		$values = array($pws);
		return $this->db->query($query,$pws)->result_array();
	}

	public function add_document($document)
	{
		$query = "INSERT INTO documents (document,created_at) VALUES (?,NOW())";
		$values = array($document);
		return $this->db->query($query,$values);
	}

	public function get_documents()
	{
		$query = "SELECT * from documents";
		return $this->db->query($query)->result_array();
	}


}

/* End of file user.php */
/* Location: ./application/models/user.php */