<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

	public function add_user($form,$password)
	{
		$query= 'INSERT INTO users (alias,email,password,created_at) VALUES (?,?,?,Now())';
		$values= array($form['alias'],$form['email'],$password);
		return $this->db->query($query,$values);		
	}

	public function update_user($form,$id)
	{
		$query = 'UPDATE users SET email=?,user_name=?,alias=? WHERE id=?';
		$values = array($form['email'],$form['user_name'],$form['alias'],$id);
		return $this->db->query($query,$values);
	}

	public function get_user($email)
	{
		$query = 'SELECT * FROM users WHERE email like? and deleted_at IS NULL';
		$values = $email;
		return $this->db->query($query,$values)->result_array();
	}	

	public function get_user_id($id)
	{
		$query = 'SELECT * FROM users WHERE id =? and deleted_at IS NULL';
		$values = $id;
		return $this->db->query($query,$values)->result_array();
	}



}

/* End of file user.php */
/* Location: ./application/models/user.php */