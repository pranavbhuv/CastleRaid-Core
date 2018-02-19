<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\commands\guest;

use pocketmine\Player;
use pocketmine\plugin\Plugin;
use CRCore\forms\FeedbackForm;
use pocketmine\utils\TextFormat;
use pocketmine\form\element\Input;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;

class FeedbackCommand extends PluginCommand{


	/**
	 * FeedbackCommand constructor.
	 * @param string $name
	 * @param Plugin $owner
	 */
    public function __construct (string $name, Plugin $owner){
	    parent::__construct($name, $owner);
	    $this->setDescription("Gives us feedback");
	    $this->setAliases(["fb"]);
	    $this->setPermission("castleraid.feedback");
    }

	/**
	 * @param CommandSender $sender
	 * @param string $commandLabel
	 * @param array $args
	 * @return bool|mixed
	 */
	public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender instanceof Player){
            $sender->sendMessage('Only In-Game');
            return false;
        }

        if(!$this->testPermission($sender)) return true;

        $sender->sendForm($this->makeForm());
        return true;
    }

    public function makeForm() : FeedbackForm{
        $f = new FeedbackForm(TextFormat::BLUE . "Feedback", [new Input("Write your feedback/suggestion/bug report here!", "Vaults don't work.")]);
        return $f;
    }
}
