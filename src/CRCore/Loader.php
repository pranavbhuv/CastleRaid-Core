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

use CRCore\Commands\{
    ClearInventoryCommand,
    CustomPotionsCommand,
    FeedCommand,
    FlyCommand,
    HealCommand,
    InfoCommand,
    MenuCommand,
    MPShopCommand,
    NickCommand,
    QuestsCommand
};
use CRCore\Events\{
    EventListener,
    PotionListener,
    RelicListener
};
use CRCore\Tasks\{
    BroadcastTask,
    FakePlayerTask
};
use pocketmine\{
    plugin\PluginBase,
    utils\Config
};

class Loader extends PluginBase {

    public function onLoad(): void {
        API::$main = $this;

        $this->saveDefaultConfig();
        $this->saveResource("tsconfig.json");
        $this->saveResource("names.json");
        $this->saveResource("chat.json");
        $this->saveResource("config.json");

        if (file_exists($this->getDataFolder() . "config.json") == true)
            API::$msg = new Config($this->getDataFolder() . "config.json", Config::JSON);

        if (file_exists($this->getDataFolder() . "names.json") == true)
            API::$names = new Config($this->getDataFolder() . "names.json", Config::JSON);

        if (file_exists($this->getDataFolder() . "chat.json") == true)
            API::$chat = new Config($this->getDataFolder() . "chat.json", Config::JSON);

        if (!is_dir($this->getDataFolder() . "/feedback")) @mkdir($this->getDataFolder() . "/feedback");
    }

    public function onEnable(): void {
        new EventListener($this);
        new PotionListener($this);
        new RelicListener($this);
        
        $this->getServer()->getScheduler()->scheduleRepeatingTask(new BroadcastTask($this), 2400);

        $this->getServer()->getScheduler()->scheduleRepeatingTask(new FakePlayerTask($this), mt_rand(600, 2000));

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
