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

use CRCore\Loader;
use CRCore\API;
use CRCore\Commands\BaseCommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class HealCommand extends BaseCommand{

    public function __construct(Loader $plugin){
        parent::__construct($plugin, "heal", "Heals a player", "/heal", ["heal"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender instanceof Player){
            $sender->sendMessage(API::NOT_PLAYER);
        }
        if(!$sender->hasPermission("castleraid.heal")){
            $sender->sendMessage(API::NO_PERMISSION);
        }
        $sender->setHealth(20);
        $sender->sendMessage(TextFormat::AQUA . "You have been healed!");
        $sender->addTitle(TextFormat::DARK_RED . "You have been healed!");
    }
}