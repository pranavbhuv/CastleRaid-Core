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

namespace CRCore\Commands;

use CRCore\Loader;
use CRCore\API;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\plugin\Plugin;

class BaseCommand extends Command implements PluginIdentifiableCommand{

    private $plugin;

    public function __construct(Loader $plugin, $name, $description, $usageMessage, $aliases){
        parent::__construct($name, $description, $usageMessage, $aliases);
        $this->plugin = $plugin;
    }

    public function getPlugin() : Plugin{
        return $this->plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender->hasPermission($this->getPermission())){
            $sender->sendMessage(API::NO_PERMISSION);
        }
        $result = $this->onExecute($sender, $args);
        if(is_string($result)){
            $sender->sendMessage($result);
        }
        return true;
    }
}