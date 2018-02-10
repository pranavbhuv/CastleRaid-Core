<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\forms\mail;

use CRCore\person\Person;
use pocketmine\form\element\Label;
use pocketmine\form\Form;
use pocketmine\form\MenuForm;
use pocketmine\form\MenuOption;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class ListMailsForm extends MenuForm{

	public function getSelectedOption() : MenuOption{
		return parent::getSelectedOption();
	}

	public function onSubmit(Player $player) : ?Form{
		if(!$player instanceof Person) return null;
		$id = preg_replace("/[^0-9]/", '', explode(" from", explode("#", $this->getSelectedOption()->getText())[1])[0]);
		$m = $player->getMailById(intval($id));

		return new SeeMailForm("Showing mail with id " . TextFormat::BOLD . $m["id"], [new Label("From: " . TextFormat::GREEN . $m["sender"] . TextFormat::WHITE . "\n"
		                                                                                         . "Date & Time: " . TextFormat::AQUA . $m["date"] . TextFormat::WHITE . "\n\n"
		                                                                                         . "Message: " . TextFormat::YELLOW . $m["message"])]);
	}
}
