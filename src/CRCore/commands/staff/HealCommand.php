<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\commands\staff;

use pocketmine\Player;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat;

class HealCommand extends PluginCommand{

	/**
	 * HealCommand constructor.
	 * @param string $name
	 * @param Plugin $owner
	 */
    public function __construct (string $name, Plugin $owner){
	    parent::__construct($name, $owner);
	    $this->setDescription("Heals a player");
	    $this->setUsage("/heal");
	    $this->setPermission("castleraid.heal");
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

        $sender->setHealth(20);
        $sender->sendMessage(TextFormat::AQUA . "You have been healed!");
        $sender->addTitle(TextFormat::DARK_RED . "You have been healed!");
        return true;
    }
}
