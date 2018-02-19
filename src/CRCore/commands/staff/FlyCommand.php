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

class FlyCommand extends PluginCommand{

	/**
	 * FlyCommand constructor.
	 * @param string $name
	 * @param Plugin $owner
	 */
    public function __construct (string $name, Plugin $owner){
	    parent::__construct($name, $owner);
	    $this->setDescription("Flight mode");
	    $this->setUsage("/fly");
	    $this->setPermission("castleraid.fly");
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

        if($sender->isCreative()){
	        $sender->sendMessage(TextFormat::RED . "You are already in creative mode!");
	        return false;
        }

        $sender->setAllowFlight($sender->getAllowFlight() == true ? false : true);
		$sender->setFlying($sender->getAllowFlight());
		$table = [
			true => TextFormat::GREEN . "Fly mode enabled.",
			false => TextFormat::RED . "Fly mode disabled."
		];

		$sender->sendMessage($table[$sender->getAllowFlight()]);
        return true;
    }
}
