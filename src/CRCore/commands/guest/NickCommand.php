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
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat;

class NickCommand extends PluginCommand{

	/**
	 * NickCommand constructor.
	 * @param string $name
	 * @param Plugin $owner
	 */
    public function __construct (string $name, Plugin $owner){
	    parent::__construct($name, $owner);
	    $this->setDescription("Nick command");
	    $this->setAliases(["nickme"]);
	    $this->setPermission("castleraid.nick");
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

        if(!isset($args[0])){
            $sender->sendMessage("Please provide a nickname.");
            return false;
        }

        if(strtolower($args[0]) == "off"){
	        $sender->setDisplayName($sender->getName());
	        return false;
        }

        $sender->setDisplayName($args[0]);
        $sender->sendMessage(TextFormat::BOLD . TextFormat::GRAY . "[" . TextFormat::GREEN . "!" . TextFormat::GRAY . "]" . TextFormat::RESET . TextFormat::GRAY . " You're now nicked as " . TextFormat::RED . "$args[0]" . TextFormat::GRAY . "!");
        return true;
    }
}
