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

namespace CRshit;

# CRCore Command uses:
use CRshit\Commands\CustomPots;
use CRshit\Commands\InfoCommand;
use CRshit\Commands\MenuCommand;
use CRshit\Commands\MPShop;
use CRshit\Commands\NickCommand;
use CRshit\Commands\TradeCommand;
use CRshit\Commands\TutorialCommand;
# CRCore Task uses:
//TODO: AlertTasks

# CRCore Event uses:
use CRshit\Events\EventListener;

# Base PocketMine uses:
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as C;

/**
 * Class Loader
 * @package CRshit
 */
class Loader extends PluginBase implements Listener{

    # Public variables:
    public $tutorial;

    # Public constants:
    const NO_PERMISSION = C::BOLD . C::GRAY . "(" . C::RED . "!" . C::GRAY . ")" . C::RED . "You don't have permission to use this command";
    const CORE_VERSION = "v1.3";

    public function onEnable()
    {
        $this->registerEvents(); //Registers Events
        $this->registerCommands(); //Registers Commands
        $this->registerTasks(); //Registers Tasks
        $this->getLogger()->info(C::GREEN . "Enabled.");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        if (!is_dir($this->getDataFolder())) {
            mkdir($this->getDataFolder());
        }
        $this->saveResource("tsconfig.json");
    }

    public function onDisable()
    {
        $this->getLogger()->info(C::RED . "Disabled.");
    }

    private function registerEvents()
    {
        # Register EventListener:
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
    }

    private function registerCommands()
    {
        # Register Command Files:
        $this->getCommand("cpshop")->setExecutor(new CustomPots($this));
        $this->getCommand("info")->setExecutor(new InfoCommand($this));
        $this->getCommand("menu")->setExecutor(new MenuCommand($this));
        $this->getCommand("mpshop")->setExecutor(new MPShop($this));
        $this->getCommand("nickme")->setExecutor(new NickCommand($this));
        $this->getCommand("trade")->setExecutor(new TradeCommand($this));
        $this->getCommand("tutorial")->setExecutor(new TutorialCommand($this));
    }

    private function registerTasks()
    {
        # Register Task Files:
        //TODO: AlertTask
    }
}