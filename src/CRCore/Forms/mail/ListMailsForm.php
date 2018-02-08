<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */

namespace CRCore\Forms\mail;

use CRCore\Person\Person;
use pocketmine\form\element\Label;
use pocketmine\form\Form;
use pocketmine\form\MenuForm;
use pocketmine\form\MenuOption;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class ListMailsForm extends MenuForm{

	/**
	 * @return MenuOption
	 * @throws \InvalidStateException
	 */
	public function getSelectedOption() : MenuOption{
		return parent::getSelectedOption();
	}

	/**
	 * @param Player $player
	 * @return null|Form
	 * @throws \InvalidStateException
	 */
	public function onSubmit(Player $player) : ?Form{
		if(!$player instanceof Person) return null;

		$id = $this->getSelectedOption()->getText(){1};
		$m = $player->getMailById($id);

		return new SeeMailForm("Showing mail with id " . TextFormat::BOLD . $m["id"], [new Label("From: " . TextFormat::GREEN . $m["sender"] . TextFormat::WHITE . "\n"
		                                                                                         . "Date & Time: " . TextFormat::AQUA . $m["date"] . TextFormat::WHITE . "\n\n"
		                                                                                         . "Message: " . TextFormat::YELLOW . $m["message"])]);
	}
}