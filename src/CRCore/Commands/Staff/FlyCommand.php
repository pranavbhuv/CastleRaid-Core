<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Jason.
 */
declare(strict_types=1);

namespace CRCore\Commands\Staff;

use CRCore\API;
use CRCore\Commands\BaseCommand;
use CRCore\Loader;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class FlyCommand extends BaseCommand{

    public function __construct(Loader $plugin){
        parent::__construct($plugin, "fly", "Flight mode", "/fly", ["fly"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender instanceof Player){
            $sender->sendMessage(API::NOT_PLAYER);
        }
        if(!$sender->hasPermission("castleraid.fly")){
            $sender->sendMessage(parent::NO_PERMISSION);
        }
        if(!$sender->isCreative()){
            if(!$sender->getAllowFlight()){
                $sender->setAllowFlight(true);
                $sender->setFlying(true);
                $sender->sendMessage(TextFormat::GREEN . "Fly mode enabled.");
            }else{
                $sender->setAllowFlight(false);
                $sender->setFlying(false);
                $sender->sendMessage(TextFormat::RED . "Fly mode disabled.");
            }
        }else{
            $sender->sendMessage(TextFormat::RED . "You are already in creative mode!");
        }
    }
}
