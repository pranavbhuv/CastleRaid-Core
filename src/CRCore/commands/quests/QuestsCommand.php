<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\commands\quests;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;
use pocketmine\plugin\Plugin;

class QuestsCommand extends PluginCommand{

	/**
	 * QuestsCommand constructor.
	 * @param string $name
	 * @param Plugin $owner
	 */
    public function __construct (string $name, Plugin $owner){
	    parent::__construct($name, $owner);
	    $this->setDescription("Quest Command");
	    $this->setPermission("castleraid.quests");
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

        $handler = new Quests();
        $ui = $handler->getQuestUI();
        $ui->sendToPlayer($sender);
        return true;
    }
}
