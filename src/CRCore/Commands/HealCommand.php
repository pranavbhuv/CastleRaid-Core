<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\Commands;

use CRCore\Loader;
use CRCore\API;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class HealCommand extends PluginCommand{

    public function __construct(Loader $plugin){
        parent::__construct("heal", $plugin);
        $this->setDescription("Heals a player");
        $this->setPermission("castleraid.heal");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if($sender->hasPermission("castleraid.heal")){
            if($sender instanceof Player){
                $sender->setHealth(20);
                $sender->sendMessage(TextFormat::AQUA . "You have been healed!");
                $sender->addTitle(TextFormat::DARK_RED . "You have been healed!");
            }else{
                $sender->sendMessage(API::NOT_PLAYER);
            }
        }else{
            $sender->sendMessage(API::NO_PERMISSION);
        }
    }
}