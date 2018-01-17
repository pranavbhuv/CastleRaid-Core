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

namespace CRCore\Events;

use CRCore\Loader;
use onebone\economyapi\EconomyAPI;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\utils\TextFormat;

class KillMoney implements Listener {
    private $main;
    
    public function __construct(Loader $main) {
        $this->main = $main;
        $main->getServer()->getPluginManager()->registerEvents($this, $main);
    }
    
    public function onDeath(PlayerDeathEvent $event) {
        $player = $event->getPlayer();
        if($player->getLastDamageCause() instanceof EntityDamageByEntityEvent) {
            $killer = $player->getLastDamageCause()->getDamager();
            if($killer instanceof Player) {
                $reward = 250;
                EconomyAPI::getInstance()->addMoney($killer, $reward);#
                $killer->sendMessage(TextFormat::BOLD . TextFormat::GREEN . "+ $" . $reward);
            }
        }
    }
}
