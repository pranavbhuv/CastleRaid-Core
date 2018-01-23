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

namespace CRCore\Commands\Quests;

use CRCore\Loader;
use CRCore\API;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;

class QuestsCommand extends PluginCommand{

    public $inv;

    public function __construct(Loader $plugin){
        parent::__construct("quests", $plugin);
        $this->setDescription("Quests Command");
        $this->setPermission("castleraid.quests");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if($sender->hasPermission("castleraid.quests")){
            if($sender instanceof Player){
                $handler = new Quests();
                $ui = $handler->getQuestUI();
                $ui->sendToPlayer($sender);
            }else{
                $sender->sendMessage(API::NOT_PLAYER);
            }
        }else{
            $sender->sendMessage(API::NO_PERMISSION);
        }
    }
}
