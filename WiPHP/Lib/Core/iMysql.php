<?php
class iMysql
{
	public $conn;
	public $connect_errno;
	public $rs_insert_id;
	public $rs_num_rows;

	function __construct($db_host,$db_username,$db_passwd,$db_database,$db_port='3306')
	{
		$conn = mysql_connect($db_host.':'.$db_port, $db_username, $db_passwd);
		if(!$conn) {
			$this->connect_errno = mysql_errno();
			die('Could not connect: ' . mysql_errno());	
		}
		$this->conn = $conn;
		mysql_select_db($db_database,$this->conn);
	}	

	public function set_charset($charset)
	{
		return mysql_set_charset($charset,$this->conn);
	}

	public function query($sql)
	{
		$result = mysql_query($sql,$this->conn);
		if($result)
		{
			$this->rs_insert_id = mysql_insert_id();
			if(is_resource($result))
			{
				$this->rs_num_rows = mysql_num_rows($result);
			}	
		}
		return $result;
	}

	public function fetch_array($result,$array_type=MYSQLI_BOTH)
	{
		return mysql_fetch_array($result,$array_type);
	}

	public function free_result($result)
	{
		mysql_free_result($result);
	}

}