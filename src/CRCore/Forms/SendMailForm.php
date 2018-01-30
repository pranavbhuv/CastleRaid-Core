<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors     : QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Jason.
 */

namespace CRCore\Forms;

use CRCore\API;
use CRCore\Person\Mail;
use CRCore\Person\Person;
use pocketmine\form\CustomForm;
use pocketmine\form\Form;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

//TODO: Finish this.

class SendMailForm extends CustomForm{
	/** @var array $data */
	private $data;

	public function __construct(string $title, $elements){
		parent::__construct($title, $elements);
	}

	public function onSubmit(Player $player) : ?Form{
		if(!$player instanceof Person) return null;
		if(is_null($this->data)) return null;

		if(!file_exists(API::$main->getDataFolder() . "/players/" . $this->data[0])){
			$player->sendMessage(TextFormat::RED . "Player " . TextFormat::DARK_RED . $this->data[0] . TextFormat::RED . " has never been here." );
			return null;
		}

		$player->addMail(new Mail($player, $this->data[0], date(), $this->data[1]));

	}

	public function handleResponse(Player $player, $data) : ?Form{
		$this->data = $data;
		return parent::handleResponse($player, $data);
	}
}