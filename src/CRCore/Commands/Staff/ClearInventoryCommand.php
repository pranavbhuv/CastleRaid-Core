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

use CRCore\Commands\BaseCommand;
use CRCore\Loader;
use CRCore\API;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class ClearInventoryCommand extends BaseCommand{

    public function __construct(Loader $plugin){
        parent::__construct($plugin, "clearinv", "Clear your inventory", "/clearinv", ["clearinv"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender instanceof Player){
            $sender->sendMessage(API::NOT_PLAYER);
        }
        if(!$sender->hasPermission("castleraid.clearinv")){
            $sender->sendMessage(parent::NO_PERMISSION);
        }
        $sender->getInventory()->clearAll();
        $sender->sendMessage(TextFormat::AQUA . "Your inventory has been cleared!");
        $sender->addTitle(TextFormat::DARK_RED . "Inventory cleared!");
    }
}
