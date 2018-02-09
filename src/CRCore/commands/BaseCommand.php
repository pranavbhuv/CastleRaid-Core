<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\commands;

use CRCore\Loader;
use pocketmine\command\Command;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat;

abstract class BaseCommand extends Command implements PluginIdentifiableCommand{
    
    const NO_PERMISSION = TextFormat::BOLD . TextFormat::GRAY . "(" . TextFormat::RED . "!" . TextFormat::GRAY . ")" . TextFormat::RED . " You don't have permission to use this command";
    
    private $plugin;
  
    public function __construct(Loader $plugin, $name, $description, $usageMessage, $aliases){
        parent::__construct($name, $description, $usageMessage, $aliases);
        $this->plugin = $plugin;
    }

    public function getPlugin() : Plugin{
        return $this->plugin;
    }
}