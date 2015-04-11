<?php
class Db
{
	private $db;
	
	public function __construct()
	{
		$config = C('DB');			//获取数据库配置

		$this->db = new iMysql($config['HOST'],$config['USER'],$config['PWD'],$config['DATABASE']);

		if($this->db->connect_errno)
		{
			echo $this->db->connect_errno;
		}
		$this->db->set_charset("utf8");	
	}
	
	public function insert($sql)
	{
		$rs = $this->db->query($sql);
		if(!$rs)
		{
			return false;
		}
		return $this->db->rs_insert_id;
	}
	
	public function del($sql)
	{
		$rs = $this->db->query($sql);
		if($rs)
		{
			return true;
		}
		return false;
	}
	
	public function update($sql)
	{
		$rs = $this->db->query($sql);
		if($rs)
		{
			$result = true;
		}
		return false;
	}
	
	public function select($sql)
	{
		$rs = $this->db->query($sql);

		$number = $this->db->rs_num_rows;
		if($number<1)
		{
			return false;
		}
		if($number==1)
		{
			return $this->db->fetch_array($rs,MYSQL_ASSOC);
		}

		$array = null;
		while($row = $this->db->fetch_array($rs,MYSQL_ASSOC))
		{
			$array[] = $row;
		}
		$this->db->free_result($rs);
		return $array;
	}
	
	public function find($sql)
	{
		$rs = $this->db->query($sql);
		
		$number = $this->db->rs_num_rows;
		if($number<1)
		{
			return false;
		}
		$result  = $this->db->fetch_array($rs,MYSQL_ASSOC);
		$this->db->free_result($rs);
		return $result;
	}
}