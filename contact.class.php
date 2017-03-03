<?php

// import database configuration and connection
include "conn.php";

class Contact{

	private $_db;
	private $_name;
	private $_email;
	private $_tel_no;

	function __construct(){}

	// create new contact
	function create($name, $email, $tel_no){
		$this->_db = db_connect();
		$this->_name = $this->_db->real_escape_string($name);
		$this->_email = $this->_db->real_escape_string($email);
		$this->_tel_no = $this->_db->real_escape_string($tel_no);
		$query = "
			INSERT INTO contact_details (name, email, tel_no)
			VALUES ('" . $this->_name  . "','" . $this->_email . "','" . $this->_tel_no . "')
		";
		$saved = $this->_db->query($query);
		$output = '';
		if(!$saved){
			$output =  'Save unsuccessful: '.$this->_db->error;
		}else{
			$output = 'Save successful';
		}
		$this->_db->close();
		return $output;
	}

	// get all contacts from database
	function read(){
		$this->_db = db_connect();
		$query = "SELECT * FROM contact_details ORDER BY name ASC";
		$result = $this->_db->query($query);
		$this->_db->close();
		return $result;
	}

	// update contact based on id and with details to update as associative array
	function update($id, $contact_array){
		$this->_db = db_connect();
		$this->_name = $this->_db->real_escape_string($contact_array['name']);
		$this->_email = $this->_db->real_escape_string($contact_array['email']);
		$this->_tel_no = $this->_db->real_escape_string($contact_array['tel_no']);
		$query = "
			UPDATE contact_details 
			SET name='".$this->_name."', email='".$this->_email."', tel_no='".$this->_tel_no."'
			WHERE id = '".$id."'
		";
		$updated = $this->_db->query($query);
		$output = '';
		if(!$updated){
			$output = 'Update unsuccessful: '.$this->_db->error;
		}else{
			$output = 'Update successful';
		}
		$this->_db->close();
		return $output;
	}

	// delete a contact based on id
	function delete($id){
		$this->_db = db_connect();
		$query = "DELECT FROM contact_details WHERE id=".$id;
		$deleted = $this->_db->query($query);
		$output = '';
		if(!$deleted){
			$output = 'Delete unsuccessful: '.$this->_db->error;
		}else{
			$output = 'Delete successful';
		}
		$this->_db->close();
		return $output;
	}
}

?>