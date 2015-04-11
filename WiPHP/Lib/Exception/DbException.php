<?php
class DbException extends Exception
{
	public function __toString()
	{
		return __CLASS__.':'.$this->message;
	}
}