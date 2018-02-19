<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore;

use CRCore\commands\{
    staff\ClearInventoryCommand,
    guest\CustomPotionsCommand,
    guest\FeedbackCommand,
    staff\FeedCommand,
    staff\FlyCommand,
    staff\HealCommand,
    guest\InfoCommand,
    guest\MenuCommand,
    guest\MPShopCommand,
    guest\NickCommand,
    quests\QuestsCommand,
    quests\Quests
};
use CRCore\events\{
    EventListener,
    PotionListener,
    HeadListener,
    RelicListener,
    KillMoneyListener
};
use CRCore\tasks\{
    BroadcastTask,
};
use pocketmine\{
	command\PluginCommand, plugin\PluginBase, utils\Config, utils\TextFormat
};

class Loader extends PluginBase{
   
    const CORE_VERSION = "v1.4.6";
   
    public static $instance;
    
    public function onLoad() : void{
        self::$instance = $this;

        $this->saveDefaultConfig();
        $this->saveResource("tsconfig.json");
        $this->saveResource("names.json");
        $this->saveResource("chat.json");
        $this->saveResource("config.json");


        if(!is_dir($this->getDataFolder() . "/feedback")) @mkdir($this->getDataFolder() . "/feedback");
    }

    public function onEnable() : void{
        new EventListener($this);
        new PotionListener($this);
        new RelicListener($this);
        new KillMoneyListener($this);

        $this->getServer()->getScheduler()->scheduleRepeatingTask(new BroadcastTask($this), 2400);

        $commands = [
	        new ClearInventoryCommand('clearinventory', $this),
	        new CustomPotionsCommand('custompotion', $this),
	        new FlyCommand('fly', $this),
	        new HealCommand('heal', $this),
	        new InfoCommand('info', $this),
	        new MenuCommand('menu', $this),
	        new MPShopCommand('mpshop', $this),
	        new NickCommand('nick', $this),
	        new FeedCommand('feed', $this),
	        new QuestsCommand('quest', $this),
	        new FeedbackCommand('feedback', $this)

        ];
        /** @var PluginCommand $cmds */
	    foreach($commands as $cmds)
        	$cmds->setPermissionMessage(TextFormat::BOLD . TextFormat::GRAY . "(" . TextFormat::RED . "!" . TextFormat::GRAY . ")" . TextFormat::RED . "You don't have permission to use this command"); // sets the no permision message also use <permission> in the message to get the commands permission

        $this->getServer()->getCommandMap()->registerAll("CRCore", $commands);

        $quests = new Quests();
        $quests->registerQuests();
    }
    
    public static function getInstance() : self{
        return self::$instance;
    }
}
