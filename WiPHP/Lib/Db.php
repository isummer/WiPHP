<?php
class Db
{
	private $db;
	
	public function __construct()
	{
		$config = C('DB');			//获取数据库配置

		$this->db = @new mysqli($config['HOST'],$config['USER'],$config['PWD'],$config['DATABASE']);
		if($this->db->connect_errno)
		{
			echo $this->db->connect_errno;
		}
		$this->db->set_charset("utf8");	
	}
	
	public function insert($sql)
	{
		$result = $this->db->query($sql);
		
		if($result)
		{
			return $this->db->insert_id;
		}
		else
		{
			return false;
		}
	}
	
	public function del($sql)
	{
		$result = $this->db->query($sql);
		if($result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function update($sql)
	{
		$result = $this->db->query($sql);
		if($result)
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	public function select($sql)
	{
		$result = $this->db->query($sql);
		$number = $result->num_rows;
		if($number<1)
		{
			return false;
		}
		if($number==1)
		{
			return $result->fetch_array(MYSQLI_ASSOC);
		}

		$array = null;
		// MYSQLI_ASSOC, MYSQLI_NUM, or MYSQLI_BOTH.
		while($row = $result->fetch_array(MYSQLI_ASSOC))
		{
			$array[] = $row;
		}
		
		return $array;
	}
	
	public function find($sql)
	{
		$result = $this->db->query($sql);
		
		$number = $result->num_rows;
		if($number<1)
		{
			return false;
		}
		$result  = $result->fetch_array(MYSQLI_ASSOC);
		return $result;
	}
}