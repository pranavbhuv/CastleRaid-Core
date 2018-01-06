<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Nice.
 */
declare(strict_types=1);

namespace CRCore;

# CRCore Command uses:
use CRCore\Commands\ClearInventoryCommand;
use CRCore\Commands\CustomPots;
use CRCore\Commands\FlyCommand;
use CRCore\Commands\HealCommand;
use CRCore\Commands\InfoCommand;
use CRCore\Commands\MenuCommand;
use CRCore\Commands\MPShop;
use CRCore\Commands\NickCommand;

# CRCore Task uses:
use CRCore\Tasks\AlertTask;

# CRCore Event uses:
use CRCore\Events\EventListener;
use CRCore\Events\PotionListener;
use CRCore\Events\BlazeListener;

# Base PocketMine uses:
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as C;

/**
 * Class Loader
 * @package CRCore
 */
class Loader extends PluginBase implements Listener{

    # Public variables:
    public $tutorial;

    # Public constants:
    const NO_PERMISSION = C::BOLD . C::GRAY . "(" . C::RED . "!" . C::GRAY . ")" . C::RED . "You don't have permission to use this command";
    const CORE_VERSION = "v1.4";

    public function onEnable()
    {
        $this->registerEvents(); //Registers Events
        $this->registerCommands(); //Registers Commands
        $this->registerTasks(); //Registers Tasks
        $this->getLogger()->info(C::GREEN . "CastleRaidCore Enabled!");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        if (!is_dir($this->getDataFolder())) {
            mkdir($this->getDataFolder());
        }
        $this->saveResource("tsconfig.json");

        API::$main = $this;
    }

    public function onDisable()
    {
        $this->getLogger()->info(C::RED . "CastleRaidCore Disabled!");
    }

    private function registerEvents()
    {
        # Register EventListener:
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PotionListener($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new BlazeListener($this), $this);
    }

    private function registerCommands()
    {
        # Register Command Files:
        $this->getCommand("cpshop")->setExecutor(new CustomPots($this));
        $this->getCommand("info")->setExecutor(new InfoCommand($this));
        $this->getCommand("menu")->setExecutor(new MenuCommand($this));
        $this->getCommand("mpshop")->setExecutor(new MPShop($this));
        $this->getCommand("nickme")->setExecutor(new NickCommand($this));
        $this->getCommand("clearinv")->setExecutor(new ClearInventoryCommand($this));
        $this->getCommand("heal")->setExecutor(new HealCommand($this));
        $this->getCommand("fly")->setExecutor(new FlyCommand($this));
    }


    private function registerTasks()
    {
        # Register Task Files:

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    }
}
