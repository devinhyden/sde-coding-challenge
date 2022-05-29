<?php

class Address
{
	protected string $name;
	protected int $length;

	/**
	 * @param  string  $name  Street number, name, and type // 123 Elm Street
	 */
	public function __construct(string $name)
	{
		$this->setName(trim(strtolower($name)));
		$this->setLength(strlen($this->getName()));
	}

	/**
	 * @return int
	 */
	public function getLength() : int
	{
		return $this->length;
	}

	/**
	 * @param  int  $length
	 */
	public function setLength(int $length) : void
	{
		$this->length = $length;
	}

	/**
	 * @return string
	 */
	public function getName() : string
	{
		return $this->name;
	}

	/**
	 * @param  string  $name
	 */
	public function setName(string $name) : void
	{
		$this->name = $name;
	}

	public function isAddressLengthEven() : bool
	{
		return $this->getLength() % 2 === 0;
	}
}