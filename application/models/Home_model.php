<?php

class Home_model extends CI_Model{

	function __construct(){
		$this->load->database();
	}
	
	
	function list_artwork() {
		$query = "select * from artworks order by artwork_id desc";
    $query = $this->db->query($query);
    // query();
    if ($query->num_rows() == 0)
        return array();
    $data = $query->result_array();
    foreach ($data as $index => $row) {}
    return $data;
	}
	
	function list_event() {
		$query = "select * from events order by event_id desc";
    $query = $this->db->query($query);
    // query();
    if ($query->num_rows() == 0)
        return array();
    $data = $query->result_array();
    foreach ($data as $index => $row) {}
    return $data;
	}

  function list_article() {
		$query = "select * from articles order by article_id desc";
    $query = $this->db->query($query);
    // query();
    if ($query->num_rows() == 0)
        return array();
    $data = $query->result_array();
    foreach ($data as $index => $row) {}
    return $data;
	}

  function list_forum() {
		$query = "select * from forums order by forum_id desc";
    $query = $this->db->query($query);
    // query();
    if ($query->num_rows() == 0)
        return array();
    $data = $query->result_array();
    foreach ($data as $index => $row) {}
    return $data;
	}
	
}