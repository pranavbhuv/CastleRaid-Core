<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors     : QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Jason.
 */
declare(strict_types=1);

namespace CRCore\Person;

use pocketmine\OfflinePlayer;

class Mail{

	/** @var Person $sender */
	private $sender;
	/** @var Person|OfflinePlayer $receiver */
	private $receiver;
	/** @var \DateTime $date */
	private $date;
	/** @var string $msg */
	private $msg;

	public function __construct(Person $sender, $receiver, string $date, string $message){
		$this->sender = $sender;
		$this->receiver = $receiver;
		$this->date = $date;
		$this->msg = $message;
	}

	/**
	 * @return Person
	 */
	public function getSender() : Person{
		return $this->sender;
	}

	/**
	 * @return Person|OfflinePlayer
	 */
	public function getReceiver(){
		return $this->receiver;
	}

	/**
	 * @return \DateTime
	 */
	public function getDate() : \DateTime{
		return $this->date;
	}

	/**
	 * @return string
	 */
	public function getMsg() : string{
		return $this->msg;
	}


}