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

namespace CRCore;

use CRCore\Commands\ClearInventoryCommand;
use CRCore\Commands\CustomPotionsCommand;
use CRCore\Commands\FeedCommand;
use CRCore\Commands\FlyCommand;
use CRCore\Commands\HealCommand;
use CRCore\Commands\InfoCommand;
use CRCore\Commands\MenuCommand;
use CRCore\Commands\MPShopCommand;
use CRCore\Commands\NickCommand;
use CRCore\Commands\QuestsCommand;
use CRCore\Events\EventListener;
use CRCore\Events\PotionListener;
use CRCore\Events\RelicListener;
use CRCore\Events\QuestListener;
use CRCore\Tasks\FakePlayerTask;

use CRCore\Tasks\BroadcastTask;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Loader extends PluginBase {

    public function onLoad(): void {
        API::$main = $this;

        $this->saveDefaultConfig();
        $this->saveResource("tsconfig.json");
        $this->saveResource("names.json");
        $this->saveResource("chat.json");

        if (file_exists($this->getDataFolder() . "names.json") == true)
            API::$names = new Config($this->getDataFolder() . "names.json", Config::JSON);

        if (file_exists($this->getDataFolder() . "chat.json") == true)
            API::$chat = new Config($this->getDataFolder() . "chat.json", Config::JSON);
    }

    public function onEnable(): void {
        new EventListener($this);
        new PotionListener($this);
        new RelicListener($this);
        new QuestListener($this);
        
        $this->getServer()->getScheduler()->scheduleRepeatingTask(new BroadcastTask($this), 2400);

        $task = new FakePlayerTask($this);
        $this->getServer()->getScheduler()->scheduleRepeatingTask($task, mt_rand(600, 2000));

        $this->getServer()->getCommandMap()->registerAll("CRCore", [
            new ClearInventoryCommand($this),
            new CustomPotionsCommand($this),
            new FlyCommand($this),
            new HealCommand($this),
            new InfoCommand($this),
            new MenuCommand($this),
            new MPShopCommand($this),
            new NickCommand($this),
            new FeedCommand($this),
            new QuestsCommand($this)
        ]);
    }
}
