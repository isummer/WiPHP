<?php
/*
 * 模型基类
 */
class Model 
{
	static private $db;
	
	protected $table;
	
	//主键
	protected $pk = null;
	
	protected $where = null;
	protected $orderby = null;
	protected $limit = null;
	
	protected $data = array();
	
	public function __construct($table)
	{	
		$this->table =$table;
		
		if(empty(self::$db))
		{
			self::$db = new Db();
		}
		return self::$db;
			
	}
	
	public function where($where)
	{
		$this->where = " WHERE $where";
		return $this;
	}
	
	public function orderby($by,$order=null)
	{
		if(isset($order))
		{
			$this->orderby = " ORDER BY `$by` $order";
		}
		else
		{
			$this->orderby = " ORDER BY `$by`";
		}
		return $this;
	}
	
	public function limit($count,$end=null)
	{
		if(isset($end))
		{
			$this->limit = " LIMIT $count,$end";
		}
		else 
		{
			$this->limit = " LIMIT $count";
		}
		return $this;
	}
	
	public function add($data=null)
	{
		if(!empty($data))
		{
			$sql ="INSERT INTO `$this->table`";
			$sql .= " (`".implode("`, `", array_keys($data))."`)";
			$sql .=" VALUES ('".implode("', '", $data)."')";	
		}
		else
		{
			$sql ="INSERT INTO `$this->table` (";
			foreach ($this->data as $key=>$value)
			{
				if(!empty($this->$value))
				{
					$sql .= "`$key`,";
				}
			}
			
			$sql = rtrim($sql,',');		//去掉产生的sql语句末尾逗号
			
			$sql .= ") VALUES (";
			foreach ($this->data as $key=>$value)
			{
				if(!empty($this->$value))
				{
					$sql .= "'".$this->$value."'".',';
				}	
			}
				
			$sql = rtrim($sql,',');		//去除末尾逗号
			
			$sql .= ")";
		}
		$result = self::$db->insert($sql);
		if($result)
		{
			return $result;
		}
		else
		{
			return false;
		}
	}
	
	public function deleteOne($id)
	{
		$sql = "DELETE FROM `$this->table` WHERE `$this->pk` = $id";
		
		$result = self::$db->del($sql);
		if($result)
		{
			return true;
		}
		else 
		{
			return false;
		}
	}

	public function delete()
	{
		$sql = "DELETE FROM `$this->table`";
		$sql .=$this->where;
		
		$result = self::$db->del($sql);
		if($result)
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	public function update($data=null)
	{
		if(!empty($data))
		{
			$sql = "UPDATE `$this->table` SET";
			foreach ($data as $key =>$value)
			{
				$sql.= " `$key` = '$value',";
			}
			
			$sql = rtrim($sql,',');
			//$sql .= " WHERE $this->pk =$this->id";
			$sql .=$this->where;
			
		}
		else 
		{
			$sql ="UPDATE `$this->table` SET";
			foreach ($this->data as $key=>$value)
			{
				if(!empty($this->$value))
				{
					$sql .= "`$key` = '{$this->$value}',";
				}
			}
				
			$sql = rtrim($sql,',');			
			//$sql .= " WHERE $this->pk =$this->id";
			$sql .=$this->where;
		}
		
		$result = self::$db->update($sql);
		if($result)
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	public function select()
	{
		$sql = "SELECT * FROM `$this->table`";
		$sql .=$this->where;
		$sql .=$this->orderby;
		$sql .=$this->limit;
		$result = self::$db->select($sql);
			
		if($result)
		{
			return $result;
		}
		else 
		{
			return null;
			//throw new DbException('nothing find');
		}
	}

	/*
	 * 获取单条记录
	 */
	public function findOne($id)
	{
		$sql ="SELECT * FROM `$this->table` WHERE `$this->pk` = $id";
		$result = self::$db->find($sql);
	
		if($result)
		{
			return $result;
		}
		else 
		{
			return null;
			//throw new DbException('nothing find');
		}
	}

	/*
	 * 获取记录数
	 */
	public function count()
	{
		$sql ="SELECT COUNT(*) FROM `$this->table`";
		$sql .=$this->where;
		$sql .=$this->orderby;
		$sql .=$this->limit;
		$result = self::$db->select($sql);
		
		return $result['COUNT(*)'];
		/*
		if($result)
		{
			return $result;
		}
		else 
		{
			throw new DbException('nothing find');
		}
		*/
	}
}