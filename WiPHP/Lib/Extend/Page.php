<?php
/*
 * 分页类
 */
class Page
{
	public $page;
	
	public function __construct($page)
	{
		if(isset($page))
		{
			if($page<2)
			{
				$this->page = 1;
			}
			else 
			{
				$this->page = $page;
			}				
		}
		else
		{
			$this->page = 1;
		}
	}
}
//TODO 分页方法待完善