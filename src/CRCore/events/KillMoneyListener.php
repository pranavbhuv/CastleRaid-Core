<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\events;

use CRCore\Loader;
use onebone\economyapi\EconomyAPI;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class KillMoneyListener implements Listener{
    
    private $main;

    public function __construct(Loader $main){
        $this->main = $main;
        $main->getServer()->getPluginManager()->registerEvents($this, $main);
    }

    public function onDeath(PlayerDeathEvent $event) : void{
        $player = $event->getPlayer();
        $ldc = $player->getLastDamageCause();
        if($ldc instanceof EntityDamageByEntityEvent){
            $killer = $ldc->getDamager();
            if($killer instanceof Player){
                $reward = 250;
                EconomyAPI::getInstance()->addMoney($killer, $reward);
                $killer->sendMessage(TextFormat::BOLD . TextFormat::GREEN . "+ $" . $reward);
            }
        }
    }
}
