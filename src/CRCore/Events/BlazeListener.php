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

class BlazeListener implements Listener{

  public function __construct(Loader $main){
    $this->main = $main;
  }
}
