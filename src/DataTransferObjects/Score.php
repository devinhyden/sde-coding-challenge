<?php

class Score
{
	/**
	 * Increase value if address length is even
	 */
	const EVEN_INCREASE = 1.5;
	/**
	 * Increase value if address length is odd
	 */
	const ODD_INCREASE = 1;

	/**
	 * @var Driver
	 */
	protected Driver $driver;
	/**
	 * @var Address
	 */
	protected Address $address;
	/**
	 * @var float
	 */
	protected float $score;

	/**
	 * @param  Driver   $driver
	 * @param  Address  $address
	 */
	public function __construct(Driver $driver, Address $address)
	{
		$this->setDriver($driver);
		$this->setAddress($address);
		$this->calculateScore();
	}

	/**
	 * @return void
	 */
	protected function calculateScore() : void
	{
		$score = $this->address->isAddressLengthEven() ?
			$this->driver->getNumberOfVowels() * self::EVEN_INCREASE :
			$this->driver->getNumberOfConstants() * self::ODD_INCREASE;

		if ($this->doesDriverAndAddressShareCommonFactorOtherThanOne()) {
			$score += $score * .50;
		}

		$this->setScore($score);
	}

	/**
	 * If the length of the shipment's destination street name shares any common factors
	 * (besides 1) with the length of the driver’s name, the SS is increased by 50% above the
	 * base SS.
	 *
	 * Two identical lengths would share all common factors.
	 * Two even lengths, even if different, would share a common factor of 2.
	 * Two odd lengths that are different, may or may not contain common factors.
	 * Two different lengths, that are both prime, would share no common factors.
	 *
	 * @return bool
	 */
	protected function doesDriverAndAddressShareCommonFactorOtherThanOne() : bool
	{
		if ($this->isEven($this->driver->getLength()) && $this->isEven($this->address->getLength())) {
			return true;
		}

		$driverLengthFactors = $this->getFactors($this->driver->getLength());
		$addressLengthFactors = $this->getFactors($this->address->getLength());
		$lengthCommonFactors = array_intersect($driverLengthFactors, $addressLengthFactors);

		if (
			count($lengthCommonFactors) === 0 ||
			(count($lengthCommonFactors) === 1 && $lengthCommonFactors[0] === 1)
		) {
			return false;
		}
		return true;
	}

	/**
	 * @param  int  $number
	 * @return bool
	 */
	public function isEven(int $number) : bool
	{
		if ($number % 2 == 0) {
			return true;
		}
		return false;
	}

	/**
	 * @param  int  $number
	 * @return bool
	 */
	public function isOdd(int $number) : bool
	{
		return !$this->isEven($number);
	}

	/**
	 * @param  int  $number
	 * @return array
	 */
	function getFactors(int $number) : array
	{
		$factors = [];
		if ($number === 0) {
			// Cannot divide 0/0 does not exist
			return $factors;
		}

		for ($i = 1; $i <= $number; ++$i) {
			if ($number % $i == 0) {
				$factors[] = $i;
			}
		}
		return $factors;
	}

	/**
	 * @return Driver
	 */
	public function getDriver() : Driver
	{
		return $this->driver;
	}

	/**
	 * @param  Driver  $driver
	 * @return Score
	 */
	public function setDriver(Driver $driver) : Score
	{
		$this->driver = $driver;
		return $this;
	}

	/**
	 * @return Address
	 */
	public function getAddress() : Address
	{
		return $this->address;
	}

	/**
	 * @param  Address  $address
	 * @return Score
	 */
	public function setAddress(Address $address) : Score
	{
		$this->address = $address;
		return $this;
	}

	/**
	 * @return float
	 */
	public function getScore() : float
	{
		return $this->score;
	}

	/**
	 * @param  float  $score
	 */
	public function setScore(float $score) : void
	{
		$this->score = $score;
	}
}