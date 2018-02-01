<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\Commands\Quests;

use CRCore\Commands\BaseCommand;
use CRCore\Loader;
use CRCore\API;

use pocketmine\command\CommandSender;
use pocketmine\Player;

use jojoe77777\FormAPI\FormAPI;

class QuestsCommand extends BaseCommand{

    public $inv;

    public function __construct(Loader $plugin){
        parent::__construct($plugin, "quest", "Quest Command", "/quest", ["quest"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender instanceof Player){
            $sender->sendMessage(API::NOT_PLAYER);
            return false;
        }
        if(!$sender->hasPermission("castleraid.quests")){
            $sender->sendMessage(parent::NO_PERMISSION);
            return false;
        }
        $handler = new Quests();
        $ui = $handler->getQuestUI();
        $ui->sendToPlayer($sender);
        return true;
    }
}
