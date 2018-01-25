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
use pocketmine\entity\Effect;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\item\Item;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;
use pocketmine\network\mcpe\protocol\ServerSettingsRequestPacket;
use pocketmine\network\mcpe\protocol\ServerSettingsResponsePacket;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class EventListener implements Listener{
    private $main;

    public function __construct(Loader $main){
        $this->main = $main;
        $main->getServer()->getPluginManager()->registerEvents($this, $main);
    }

    public function onDataPacket(DataPacketReceiveEvent $event) : void{
        $packet = $event->getPacket();
        if($packet instanceof ServerSettingsRequestPacket){
            $packet = new ServerSettingsResponsePacket();
            $packet->formData = file_get_contents($this->main->getDataFolder() . "tsconfig.json");
            $packet->formId = 5928;
            $event->getPlayer()->dataPacket($packet);
        }elseif($packet instanceof ModalFormResponsePacket){
            $formId = $packet->formId;
            if($formId !== 5928){
                return;
            }
        }
    }

    public function onJoin(PlayerJoinEvent $event) : void{
        $player = $event->getPlayer();
        $player->addTitle(TextFormat::GREEN . TextFormat::BOLD . "CastleRaidPE", TextFormat::GOLD . "Kingdoms MCPE Server");
        $player->sendPopup(TextFormat::GREEN . "CastleRaid\n" . TextFormat::GRAY . "The Only Kingdoms Server");
        $player->sendMessage(TextFormat::GREEN . "                     -=CastleRaid=-              ");
        $player->sendMessage(TextFormat::GRAY . "                                             ");
        $player->sendMessage(TextFormat::GRAY . "   A Kingdoms Minecraft Bedrock Edition Server");
        $player->sendMessage(TextFormat::BOLD . TextFormat::AQUA . "   VOTE:" . TextFormat::GRAY . " http://bit.do/castleraid");
        $player->sendMessage(TextFormat::BOLD . TextFormat::AQUA . "   DO:" . TextFormat::GRAY . " /menu");
        $player->sendMessage(TextFormat::BOLD . TextFormat::AQUA . "   DONATE:" . TextFormat::GRAY . " castleraid.buycraft.net");
        $player->sendMessage(TextFormat::GRAY . "                                             ");
        $player->sendMessage(TextFormat::GREEN . "                          -=-                       ");
        switch($player->getName()){
            case "iiFlamiinBlaze":
                $this->main->getServer()->broadcastMessage("Blazes are love, blazes are life!");
                break;
            case "QuiverlyRivalry":
                $this->main->getServer()->broadcastMessage("Fucking Code nibba");
                break;
            case "PotatoeTrainYT":
                $this->main->getServer()->broadcastMessage("THANK FUCK");
                break;
        }
        $h = round($player->getHealth()) / $player->getMaxHealth() * 100;
        $player->setNameTag($player->getDisplayName() . "\n{kingdom}\n " . TextFormat::GREEN . "♥" . $h . "%");
    }

    public function onPlayerLogin(PlayerLoginEvent $event) : void{
        $event->getPlayer()->teleport($this->main->getServer()->getDefaultLevel()->getSafeSpawn());
    }

    public function onConsume(PlayerItemConsumeEvent $event) : void{
        $player = $event->getPlayer();
        $inv = $player->getInventory();
        $hand = $inv->getItemInHand();
        if($hand->getId() === 373 && $hand->getDamage() === 1){
            $player->addEffect(Effect::getEffect(Effect::STRENGTH)->setAmplifier(3)->setDuration(2000));
            $inv->removeItem($hand);
        }
    }

    public function onInteract(PlayerInteractEvent $event) : void{
        $player = $event->getPlayer();
        if($event->getItem()->getId() === 130){
            $damage = $event->getItem()->getDamage();
            switch($damage){
                case 101:
                    $tier1 = Item::get(Item::ENDER_CHEST, 101, 1);
                    $tier1win = rand(10000, 25000);
                    EconomyAPI::getInstance()->addMoney($player, $tier1win);
                    $player->addTitle(TextFormat::BOLD . TextFormat::DARK_GRAY . "(" . TextFormat::GREEN . "!" . TextFormat::DARK_GRAY . ") " . TextFormat::RESET . TextFormat::GRAY . "You have won:", TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "$" . $tier1win);
                    $player->getInventory()->removeItem($tier1);
                    break;
                case 102:
                    $tier2 = Item::get(Item::ENDER_CHEST, 102, 1);
                    $tier2win = rand(25000, 50000);
                    EconomyAPI::getInstance()->addMoney($player, $tier2win);
                    $player->addTitle(TextFormat::BOLD . TextFormat::DARK_GRAY . "(" . TextFormat::GREEN . "!" . TextFormat::DARK_GRAY . ") " . TextFormat::RESET . TextFormat::GRAY . "You have won:", TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "$" . $tier2win);
                    $player->getInventory()->removeItem($tier2);
                    break;
                case 103:
                    $tier3 = Item::get(Item::ENDER_CHEST, 103, 1);
                    $tier3win = rand(50000, 100000);
                    EconomyAPI::getInstance()->addMoney($player, $tier3win);
                    $player->addTitle(TextFormat::BOLD . TextFormat::DARK_GRAY . "(" . TextFormat::GREEN . "!" . TextFormat::DARK_GRAY . ") " . TextFormat::RESET . TextFormat::GRAY . "You have won:", TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "$" . $tier3win);
                    $player->getInventory()->removeItem($tier3);
                    break;
            }
        }
    }

    public function onEntityDamage(EntityDamageEvent $event) : void{
        $player = $event->getEntity();
        if($player instanceof Player){
            $h = round($player->getHealth()) / $player->getMaxHealth() * 100;
            switch($h){ // "Borrowed" from @Thunder33345!
                case $h <= 100 && $h >= 80;
                    $thing = TextFormat::GREEN . "♥ " . $h . "%";
                    break;
                case $h <= 79 && $h >= 60;
                    $thing = TextFormat::DARK_GREEN . "♥ " . $h . "%";
                    break;
                case $h <= 59 && $h >= 40;
                    $thing = TextFormat::GOLD . "♥ " . $h . "%";
                    break;
                case $h <= 39 && $h >= 20;
                    $thing = TextFormat::RED . "♥ " . $h . "%";
                    break;
                case $h <= 19 && $h >= 0;
                    $thing = TextFormat::DARK_RED . "♥ " . $h . "%";
                    break;
                default;
                    $thing = "♥ " . $h . "%";
                    break;
            }
            $player->setNameTag($player->getDisplayName() . "\n{kingdom}\n " . $thing);
        }
    }
}
