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

namespace CRCore\Events;

# Loader use:
use CRCore\Loader;

# PocketMine uses:
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\TextFormat;

class BlazeListener implements Listener{

    /**
     * BlazeListener constructor.
     * @param Loader $main
     */
  public function __construct(Loader $main){
    $this->main = $main;
  }

    /**
     * @param PlayerJoinEvent $event
     */
  public function onJoin(PlayerJoinEvent $event){
    $player = $event->getPlayer();
    $player->sendMessage(TextFormat::GOLD . "Blazes are love, Blazes are life");
    $player->addTitle(TextFormat::GOLD . "Blazes are love, Blazes are life");
    $player->sendPopup(TextFormat::GOLD . "Blazes are love, Blazes are life");
  }
}
