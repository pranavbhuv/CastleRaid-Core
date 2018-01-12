<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Nice.
 */
declare(strict_types=1);

namespace CRCore\Commands;

use CRCore\Loader;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

/**
 * Class FlyCommand
 * @package CRCore\Commands
 */
class FlyCommand extends PluginCommand
{
    /**
     * FlyCommand constructor.
     * @param Loader $plugin
     */
    public function __construct(Loader $plugin){
        parent::__construct("fly", $plugin);
        $this->setDescription("Allows you to fly in survival");
        $this->setPermission("castleraid.fly");
    }

    /**
     * @param CommandSender $sender
     * @param Command $command
     * @param string $label
     * @param array $args
     * @return bool
     */
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
        $cmd = strtolower($command->getName());
        switch($cmd){
            case "fly":
                if($sender->hasPermission("castleraid.fly") and $sender instanceof Player){
                    if(!$sender->getAllowFlight()){
                        $sender->setAllowFlight(true);
                        $sender->sendMessage(TextFormat::GREEN . "Fly mode enabled.");
                    }else{
                        if($sender->getAllowFlight()){
                            $sender->setAllowFlight(false);
                            $sender->sendMessage(TextFormat::RED . "Fly mode disabled.");
                        }
                    }
                }
                break;
        }
        return true;
    }
}