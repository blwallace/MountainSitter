<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recording extends CI_Model {

	public function get_documents()
	{
		$query= 'SELECT * from documents';
		return $this->db->query($query)->result_array();
	}	

	public function get_document_id($id)
	{
		$query = "SELECT * FROM documents where site_id = ?";
		$values = array($id);
		return $this->db->query($query,$values)->result_array();
	}

	public function get_document_id_date($id,$startdate,$enddate)
	{
		$query = "SELECT * FROM documents where site_id = ? and created_at > ? AND created_at < ?";
		$values = array($id,$startdate,$enddate);
		return $this->db->query($query,$values)->result_array();
	}	

	public function get_document_id_top($id)
	{
		$query = "SELECT * FROM documents where site_id = ? ORDER BY id DESC LIMIT 1";
		$values = array($id);
		return $this->db->query($query,$values)->result_array();
	}	

	// public function add_site($data)
	// {
	// 	$query = 'INSERT INTO sites (site_name,city,country,country_iso3166,elevation,full,latitude,longitude,state,station_id,created_at,updated_at) VALUES (?,?,?,?,?,?,?,?,?,?,Now(),Now())';
	// 	$values = array($data['station_id'],$data['city'],$data['country'],$data['country_iso3166'],$data['elevation'],$data['full'],$data['latitude'],$data['longitude'],$data['state'],$data['station_id']);
	// 	return $this->db->query($query,$values);
	// }

	// public function get_sites()
	// {
	// 	$query= 'SELECT * from sites WHERE deleted_at IS NULL';
	// 	return $this->db->query($query)->result_array();
	// }

	// public function get_deleted_sites()
	// {
	// 	$query= 'SELECT * from sites WHERE deleted_at IS NOT NULL';
	// 	return $this->db->query($query)->result_array();
	// }	

	// public function get_active_sites()
	// {
	// 	$query = "SELECT * FROM sites WHERE deactivated_at IS NULL AND deleted_at IS NULL";
	// 	return $this->db->query($query)->result_array();
	// }

	// public function search_site($pws)
	// {
	// 	$query = "SELECT * from sites where sites.site_name like ?";
	// 	$values = array($pws);
	// 	return $this->db->query($query,$pws)->result_array();
	// }

	// public function add_document($document,$id)
	// {
	// 	$query = "INSERT INTO documents (site_id,document,created_at) VALUES (?,?,NOW())";
	// 	$values = array($id,$document);
	// 	return $this->db->query($query,$values);
	// }

	// public function get_documents()
	// {
	// 	$query = "SELECT * from documents";
	// 	return $this->db->query($query)->result_array();
	// }

	// public function deactivate_site($id)
	// {
	// 	$query = "UPDATE sites SET deactivated_at = Now() WHERE id = ?";
	// 	$values = array($id);
	// 	return $this->db->query($query,$values);
	// }

	// public function activate_site($id)
	// {
	// 	$query = "UPDATE sites SET deactivated_at = NULL WHERE id = ?";
	// 	$values = array($id);
	// 	return $this->db->query($query,$values);
	// }

	// public function delete_site($id)
	// {
	// 	$query = "UPDATE sites SET deleted_at = Now() WHERE id = ?";
	// 	$values = array($id);
	// 	return $this->db->query($query,$values);
	// }	

	// public function undelete_site($id)
	// {
	// 	$query = "UPDATE sites SET deleted+at = NULL WHERE id = ?";
	// 	$values = array($id);
	// 	return $this->db->query($query,$values);
	// }

	// public function revive_site($id)
	// {
	// 	$query = "UPDATE sites SET deleted_at = NULL where id = ?";
	// 	$values = array($id);
	// 	return $this->db->query($query,$values);
	// }


}

/* End of file user.php */
/* Location: ./application/models/user.php */