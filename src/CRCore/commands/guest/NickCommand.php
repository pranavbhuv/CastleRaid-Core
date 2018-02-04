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

use CRCore\Loader;
use CRCore\API;
use CRCore\commands\BaseCommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class NickCommand extends BaseCommand{

    public function __construct(Loader $plugin){
        parent::__construct($plugin, "nickme", "Nick command", "/nickme", ["nickme"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender instanceof Player){
            $sender->sendMessage(API::NOT_PLAYER);
            return false;
        }
        if(!$sender->hasPermission("castleraid.nick")){
            $sender->sendMessage(parent::NO_PERMISSION);
            return false;
        }
        if(!isset($args[0])){
            $sender->sendMessage("Please provide a nickname.");
        }
        if($args[0] === "off"){
            $sender->setDisplayName($sender->getName());
        }else{
            $sender->setDisplayName($args[0]);
            $sender->sendMessage(TextFormat::BOLD . TextFormat::GRAY . "[" . TextFormat::GREEN . "!" . TextFormat::GRAY . "]" . TextFormat::RESET . TextFormat::GRAY . " You're now nicked as " . TextFormat::RED . "$args[0]" . TextFormat::GRAY . "!");
        }
        return true;
    }
}
