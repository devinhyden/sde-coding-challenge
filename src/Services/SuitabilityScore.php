<?php

class SuitabilityScore
{
	protected array $addresses;
	protected array $drivers;
	protected array $scores;
	protected array $output;

	public function __construct(array $addresses, array $drivers)
	{
		foreach ($drivers as $driver) {
			$this->drivers[] = new Driver($driver);
		}

		do {
			foreach ($addresses as $address) {
				$address = new Address($address);
				$this->addresses[] = $address;
				$this->calculateScoresForAddressByAvailableDrivers($address);
			}

			$this->sortScoresByHighestScore();
			$this->output[] = $this->getHighestScore();
			$this->getAvailableDrivers();
		} while (count($this->drivers) > 0);

		echo $this->getTotalSuitabilityScore()."\n";
		foreach ($this->output as $output) {
			echo $output->getScore()."\n";
		}
	}

	/**
	 * @param  Address  $address
	 * @return void
	 */
	public function calculateScoresForAddressByAvailableDrivers(Address $address) : void
	{
		$this->scores = [];
		foreach ($this->drivers as $driver) {
			$this->scores[] = new Score($driver, $address);
		}
	}

	/**
	 * @return void
	 */
	public function sortScoresByHighestScore() : void
	{
		usort($this->scores, function (Score $score1, Score $score2) {
			if ($score1->getScore() == $score2->getScore()) {
				return 0;
			}
			return ($score1->getScore() > $score2->getScore()) ? -1 : 1;
		});
	}

	/**
	 * @return Score
	 */
	protected function getHighestScore() : Score
	{
		return $this->scores[0];
	}

	/**
	 * @return void
	 */
	protected function getAvailableDrivers() : void
	{
		$this->drivers = array_filter($this->drivers, function (Driver $driver) {
			return $driver->getName() !== $this->getHighestScore()->getDriver()->getName();
		});
	}

	/**
	 * @return int
	 */
	protected function getTotalSuitabilityScore() : int
	{
		return array_reduce($this->output, function ($carry, $output) {
			$carry += $output->getScore();
			return $carry;
		});
	}
}