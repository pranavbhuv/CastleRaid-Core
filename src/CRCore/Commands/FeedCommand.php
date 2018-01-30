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

class FeedCommand extends PluginCommand{

    public function __construct(Loader $plugin){
        parent::__construct("feed", $plugin);
        $this->setDescription("Feeds a player");
        $this->setPermission("castleraid.feed");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if($sender->hasPermission("castleraid.feed")){
            if($sender instanceof Player){
                $sender->setFood(20);
                $sender->setSaturation(20);
                $sender->sendMessage(TextFormat::GREEN . "You have been fed");
            }else{
                $sender->sendMessage(API::NOT_PLAYER);
            }
        }else{
            $sender->sendMessage(API::NO_PERMISSION);
        }
    }
}