<?php

namespace CRCore\person;


use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCreationEvent;

class onPlayerCreation implements Listener{
    
    public function __construct(Loader $core){
        $core->getServer()->getPluginManager()->registerEvents($this, $core);
    }
    
    public function onCreation(PlayerCreationEvent $creationEvent){
        if ($creationEvent->getPlayerClass() == Person::class) return;

        $creationEvent->setPlayerClass(Person::class);
    }
}
