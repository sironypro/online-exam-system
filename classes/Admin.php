<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
include_once ($filepath.'/../lib/Session.php');


//Class: Admin
class Admin{
	
	private $db;
	private $fm;

	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function getAdminData($data){

		$adminUser = $this->fm->validation($data['adminUser']);
		$adminPass = $this->fm->validation($data['adminPass']);

		$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
		$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

		if(empty($adminUser) || empty($adminPass)){
			$msg = '<center><span class="error">Username & Password must not be empty !</span><center>';
			return $msg;
		}else{

			$admPass = md5($adminPass);
			$query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$admPass'";
				
			$result = $this->db->select($query);
			
			if($result != false){
				$value = $result->fetch_assoc();
				Session::init();
				Session::set("login", true);
				Session::set("adminId",$value['id']);
				Session::set("adminUser",$value['adminUser']);
				Session::set("adminName",$value['adminName']);
				header("Location: index.php");
			}else{
				$loginmsg = '<center><span class="error">Username/Password not match!</span><center>';
				return $loginmsg;
			}
		}
	}
}

?>