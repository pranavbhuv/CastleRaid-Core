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
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;

class ClearInventoryCommand extends PluginCommand{

	/**
	 * ClearInventoryCommand constructor.
	 * @param string $name
	 * @param Plugin $owner
	 */
    public function __construct (string $name, Plugin $owner){
	    parent::__construct($name, $owner);
	    $this->setDescription("Clear your inventory");
	    $this->setUsage("/clearinv");
	    $this->setPermission("castleraid.clearinv");
    }

	/**
	 * @param CommandSender $sender
	 * @param string $commandLabel
	 * @param array $args
	 * @return bool|mixed
	 */
	public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender instanceof Player){
            $sender->sendMessage('onLY In-Game');
            return false;
        }

        if(!$this->testPermission($sender)) return true;

        $sender->getInventory()->clearAll();
        $sender->sendMessage(TextFormat::AQUA . "Your inventory has been cleared!");
        $sender->addTitle(TextFormat::DARK_RED . "Inventory cleared!");
        return true;
    }
}
