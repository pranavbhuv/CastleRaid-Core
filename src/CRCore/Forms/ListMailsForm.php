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

use pocketmine\form\Form;
use pocketmine\form\MenuForm;
use pocketmine\form\MenuOption;
use pocketmine\Player;

//TODO: Finish this.

class ListMailsForm extends MenuForm{

	public function __construct(string $title, string $text, $options){
		parent::__construct($title, $text, $options);
	}

	/**
	 * @return MenuOption
	 * @throws \InvalidStateException
	 */
	public function getSelectedOption() : MenuOption{
		return parent::getSelectedOption();
	}

	public function onSubmit(Player $player) : ?Form{
		return new SeeMail2Form()
	}
}