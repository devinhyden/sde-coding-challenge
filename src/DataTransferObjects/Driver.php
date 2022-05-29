<?php

class Driver
{
	protected string $name;
	protected int $length;
	protected int $numberOfVowels;
	protected int $numberOfConstants;

	/**
	 * @param  string  $name  First and last name // Devin Hyden
	 */
	public function __construct(string $name)
	{
		$this->setName(trim(strtolower($name)));
		$this->setLength(strlen($this->getName()));
		$this->setNumberOfVowels(preg_match_all('/[aeiouy]/i', $this->getName()));
		$this->setNumberOfConstants(preg_match_all('/[bcdfghjklmnpqrstvwxz]/i', $this->getName()));
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
	 * @return int
	 */
	public function getNumberOfVowels() : int
	{
		return $this->numberOfVowels;
	}

	/**
	 * @param  int  $numberOfVowels
	 */
	public function setNumberOfVowels(int $numberOfVowels) : void
	{
		$this->numberOfVowels = $numberOfVowels;
	}

	/**
	 * @return int
	 */
	public function getNumberOfConstants() : int
	{
		return $this->numberOfConstants;
	}

	/**
	 * @param  int  $numberOfConstants
	 */
	public function setNumberOfConstants(int $numberOfConstants) : void
	{
		$this->numberOfConstants = $numberOfConstants;
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
}