<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where email = '".$email."' and password = '".md5($password)."'  ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 2;
		}
	}

	function save_document(){
		extract($_POST);
		$check = $this->db->query("SELECT * FROM documents where doc_name ='$doc_name' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO documents set doc_name = '$doc_name'");
		}else{
			$save = $this->db->query("UPDATE documents set doc_name = '$doc_name' where id = $id");
		}

		if($save){
			return 1;
		}
	}

	function delete_document(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM documents where id = ".$id);
		if($delete)
			return 1;
	}

	function confirm(){
		extract($_POST);
			$qry = $this->db->query("SELECT * FROM users where id = 1 and password = '".md5($password)."'  ");
		if($qry->num_rows > 0){
			return 1;
		}else{
			return 2;
		}
	}

	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function login2(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM students where student_code = '".$student_code."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['rs_'.$key] = $value;
			}
				return 1;
		}else{
			return 3;
		}
	}
	function save_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(!empty($password)){
					$data .= ", password=md5('$password') ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			return 1;
		}
	}
	function signup(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass')) && !is_numeric($k)){
				if($k =='password'){
					if(empty($v))
						continue;
					$v = md5($v);

				}
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}

		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'../assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");

		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			if(empty($id))
				$id = $this->db->insert_id;
			foreach ($_POST as $key => $value) {
				if(!in_array($key, array('id','cpass','password')) && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
					$_SESSION['login_id'] = $id;
			return 1;
		}
	}

	function update_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','table')) && !is_numeric($k)){
				if($k =='password')
					$v = md5($v);
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if($_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			foreach ($_POST as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			if($_FILES['img']['tmp_name'] != '')
			$_SESSION['login_avatar'] = $fname;
			return 1;
		}
	}
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}
	function save_system_settings(){
		extract($_POST);
		$data = '';
		foreach($_POST as $k => $v){
			if(!is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if($_FILES['cover']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['cover']['name'];
			$move = move_uploaded_file($_FILES['cover']['tmp_name'],'../assets/uploads/'. $fname);
			$data .= ", cover_img = '$fname' ";

		}
		$chk = $this->db->query("SELECT * FROM system_settings");
		if($chk->num_rows > 0){
			$save = $this->db->query("UPDATE system_settings set $data where id =".$chk->fetch_array()['id']);
		}else{
			$save = $this->db->query("INSERT INTO system_settings set $data");
		}
		if($save){
			foreach($_POST as $k => $v){
				if(!is_numeric($k)){
					$_SESSION['system'][$k] = $v;
				}
			}
			if($_FILES['cover']['tmp_name'] != ''){
				$_SESSION['system']['cover_img'] = $fname;
			}
			return 1;
		}
	}
	function save_image(){
		extract($_FILES['file']);
		if(!empty($tmp_name)){
			$fname = strtotime(date("Y-m-d H:i"))."_".(str_replace(" ","-",$name));
			$move = move_uploaded_file($tmp_name,'../assets/uploads/'. $fname);
			$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
			$hostName = $_SERVER['HTTP_HOST'];
			$path =explode('/',$_SERVER['PHP_SELF']);
			$currentPath = '/'.$path[1]; 
			if($move){
				return $protocol.'://'.$hostName.$currentPath.'/assets/uploads/'.$fname;
			}
		}
	}
	function save_branch(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			// if($k == 'department'){
			// 	$data .= " $k='$v'";
			// }
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(empty($id)){
			$chars = '0101010101010101010';
			$i = 0;
			while($i == 0){
				$bcode = substr(str_shuffle($chars), 0, 15);
				$chk = $this->db->query("SELECT * FROM branches where branch_code = '$bcode'")->num_rows;
				if($chk <= 0){
					$i = 1;
				}
			}
			$data .= ", branch_code='$bcode' ";
			$save = $this->db->query("INSERT INTO branches set $data");
		}else{
			$save = $this->db->query("UPDATE branches set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function delete_branch(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM branches where id = $id");
		if($delete){
			return 1;
		}
	}
	function save_parcel(){
		extract($_POST);
		// foreach($price as $k => $v){
			$data = "";
			foreach($_POST as $key => $val){
				if(!is_numeric($key)){
					if(empty($data)){
						$data .= " $key='$val' ";
					}else{
						$data .= ", $key='$val' ";
					}
				}
			}
			// if(!isset($type)){
			// 	$data .= ", type='2' ";
			// }
			// 	$data .= ", height='{$height[$k]}' ";
			// 	$data .= ", width='{$width[$k]}' ";
			// 	$data .= ", length='{$length[$k]}' ";
			// 	$data .= ", weight='{$weight[$k]}' ";
			// 	$price[$k] = str_replace(',', '', $price[$k]);
			// 	$data .= ", price='{$price[$k]}' ";
			if(empty($id)){
				$i = 0;
				while($i == 0){
					$charToUse = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
					// $ref = sprintf("%'012d",mt_rand(0, 999999999999));
					$ref = substr(str_shuffle($charToUse), 0, 7);
					$ref = (date('Ymd').$ref);
					$chk = $this->db->query("SELECT * FROM parcels where reference_number = '$ref'")->num_rows;
					if($chk <= 0){
						$i = 1;
					}
				}
				$data .= ", reference_number='$ref' ";
				if($save[] = $this->db->query("INSERT INTO parcels set $data"))
					$ids[]= $this->db->insert_id;
					$save_tracks = $this->db->query("INSERT INTO parcel_tracks set status= '0' , parcel_id = ".$this->db->insert_id);
			}else{
				if($save[] = $this->db->query("UPDATE parcels set $data where id = $id"))
					$ids[] = $id;
					$save_tracks = $this->db->query("INSERT INTO parcel_tracks set status= '0' , parcel_id = ".$id);
			}
			return json_decode(array('data'=>$data));
		// }

		if(isset($save) && isset($ids) && $save_tracks){
			// return json_encode(array('ids'=>$ids,'status'=>1));
			return 1;
		}
	}
	function delete_parcel(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM parcels where id = $id");
		if($delete){
			return 1;
		}
	}
	function update_parcel(){
		extract($_POST);
		$update = $this->db->query("UPDATE parcels set status= $status where id = $id");
		$save = $this->db->query("INSERT INTO parcel_tracks set status= $status , parcel_id = $id");
		if($update && $save)
			return 1;  
	}
	function get_user_data(){
		extract($_GET);
		$user = $this->db->query("SELECT * FROM users  where id = $id");
		while($row = $user->fetch_assoc()){
			foreach ($row as $key => $value) {
				if(!in_array($key, array('password', 'email'))){
					$data[$key] = $row[$key];
					if($key == 'branch_id'){
						$branch_id = $row[$key];
					}
				}
			}
		}
		$branch = $this->db->query("SELECT * FROM branches where id = $branch_id");
		while($row = $branch->fetch_assoc()){
			foreach ($row as $key => $value) {
				if(in_array($key, array('department'))){
					$data[$key] = $row[$key];
				}
			}
		}
		if($data)
			return json_encode($data);  
	}
	function get_parcel_heistory(){
		extract($_POST);
		$data = array();
		$parcel = $this->db->query("SELECT * FROM parcels where reference_number = '$ref_no'");
		if($parcel->num_rows <=0){
			return 2;
		}else{
			$parcel = $parcel->fetch_array();
			// $data[] = array('status'=>'Files To Confirm','date_created'=>date("M d, Y h:i A",strtotime($parcel['date_created'])));
			$history = $this->db->query("SELECT * FROM parcel_tracks where parcel_id = {$parcel['id']}");
			$status_arr = array("Sent","Received", "Denied");
			while($row = $history->fetch_assoc()){
				$row['date_created'] = date("M d, Y h:i A",strtotime($row['date_created']));
				$row['status'] = $status_arr[$row['status']];
				$row['sender'] = $this->db->query("SELECT concat(firstname , ' ' , lastname) as name FROM users where id = {$parcel['sender_name']}")->fetch_array()['name'];
				$row['recipient'] = $this->db->query("SELECT concat(firstname , ' ' , lastname) as name FROM users where id = {$parcel['recipient_name']}")->fetch_array()['name'];
				$row['doc_type'] = $this->db->query("SELECT doc_name FROM documents where id = {$parcel['doc_type']}")->fetch_array()['doc_name'];
				$row['remarks'] = $parcel['remarks'];
				$data[] = $row;
			}
			return json_encode($data);
		}
	}
	function get_report(){
		extract($_POST);
		$data = array();
		$check_id = ( $id == 1 ? "" : "(sender_name = $id OR recipient_name =$id) and");
		$get = $this->db->query("SELECT * FROM parcels where $check_id
			date(date_created) BETWEEN '$date_from' and '$date_to' ".($status != 'all' ? " and status = $status " : "")."
			order by unix_timestamp(date_created) asc");
		$status_arr = array("Sent","Received", "Denied");
		while($row=$get->fetch_assoc()){
			$row['sender_name'] = ucwords($this->db->query("SELECT concat(firstname, ' ' , lastname) as name FROM users where id = {$row['sender_name']}")->fetch_array()['name']);
			$row['recipient_name'] = ucwords($this->db->query("SELECT concat(firstname, ' ' , lastname) as name FROM users where id = {$row['recipient_name']}")->fetch_array()['name']);
			$row['date_created'] = date("M d, Y",strtotime($row['date_created']));
			$row['status'] = $status_arr[$row['status']];
			$row['doc_type'] = ucwords($this->db->query("SELECT doc_name FROM documents where id = {$row['doc_type']}")->fetch_array()['doc_name']);
			// $row['price'] = number_format($row['price'],2);
			$data[] = $row;
		}
		return json_encode($data);
	}
}