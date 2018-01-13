<?php

namespace Tasks\HealthBar;

use pocketmine\{Server, Player};
use pocketmine\scheduler\PluginTask;
use pocketmine\Plugin;
use pocketmine\utils\TextFormat;

class HealthBar extends PluginTask {
    public function __construct($plugin){
        $this->plugin = $plugin;
        parent::__construct($plugin);
    }

    public function onRun($currentTick){
        foreach($this->getOwner()->getServer()->getOnlinePlayers() as $p){
            $player = $p;
            $p->setNameTag(TextFormat::GREEN . $p->getName() . "§c[" . ($player->getHealth() / $player->getMaxHealth() * 20)."]");
        }
    }
}
