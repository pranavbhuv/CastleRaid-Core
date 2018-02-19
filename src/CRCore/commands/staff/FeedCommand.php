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


use pocketmine\command\PluginCommand;
use pocketmine\Player;
use pocketmine\command\CommandSender;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat;

class FeedCommand extends PluginCommand{

	/**
	 * FeedCommand constructor.
	 * @param string $name
	 * @param Plugin $owner
	 */
    public function __construct (string $name, Plugin $owner){
	    parent::__construct($name, $owner);
	    $this->setDescription("Feeds a player");
	    $this->setUsage("/feed");
	    $this->setPermission("castleraid.feed");
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

        $sender->setFood(20);
        $sender->setSaturation(20);
        $sender->sendMessage(TextFormat::GREEN . "You have been fed");
        return true;
    }
}
