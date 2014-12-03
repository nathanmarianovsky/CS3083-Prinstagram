<?php

include "comment.php";

class Mapper {
	private $mappings;
	private $mappers;
	private $db;

	public function Mapper($db) {
		$this->mappings = [ "Photo" => "photo" ];
		$this->mappers = [ "Photo" => "photo_mapper" ];
		$this->db = $db;
	}

	private function get_comments_internal($cid_string) {
		$query = "SELECT comment.cid,ctime,ctext,username FROM comment,commentOn WHERE comment.cid = commentOn.cid AND comment.cid IN " . $cid_string;
		$statement = $this->db->prepare($query);
		$statement->execute();
		$statement->bind_result($cid, $ctime, $ctext, $username);
		$entities = array();
		while ($statement->fetch()) {
	        $new_obj = new Comment();
	        $new_obj->populate($cid, $ctime, $ctext, $username);
	        $entities[] = $new_obj;
	    }
		$statement->close();
		return $entities;
	}

	public function get_photo_comments($pids) {
		if(is_numeric($pids)) $pids = array($pids);
		$string = sprintf("(SELECT cid FROM commentOn WHERE pid IN (%s))", implode(',', $pids));
		return $this->get_comments_internal($string);
	}

	public function get_comments($cids) {
		return $this->get_comments_internal(sprintf("(%s)", implode(',', $cids)));
	}

	private function photo_mapper($statement, $obj) {
		$classname = get_class($obj);
		$statement->bind_result($pid, $poster, $caption, $pdate, $lnge, $lat, $lname, $is_pub, $image);
		$entities = array();
		$pids = array();
		while ($statement->fetch()) {
	        $new_obj = new $classname();
	        call_user_func_array([$new_obj, "populate"], [$pid, $poster, $caption, $pdate]);
	        $entities[] = $new_obj;
	        $pids[] = $pid;
	    }
	    $comments = $this->get_photo_comments($pids);
	    return $entities;
	}

	public function query($obj, $sql, $params) {
		$classname = get_class($obj);
		$sql = str_replace("<table>", '`'.$this->mappings[$classname].'`', $sql);
		$statement = $this->db->prepare($sql);
		if(count($params) > 0)
			call_user_func_array("$statement->bind_param", $params);
		$statement->execute();
		$entities = call_user_func_array([$this, $this->mappers[$classname]], [$statement, new $classname()]);
		$statement->close();
		return $entities; 
	}
}
?>