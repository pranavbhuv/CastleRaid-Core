<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Nice.
 */

namespace CRCore\Events;

# Loader use:
use CRCore\Loader;

# PocketMine uses:
use pocketmine\entity\Effect;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat;

# PocketMine event uses:
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;
use pocketmine\network\mcpe\protocol\ServerSettingsRequestPacket;
use pocketmine\network\mcpe\protocol\ServerSettingsResponsePacket;

/**
 * Class EventListener
 * @package CRCore\Events
 */
class EventListener implements Listener
{
    private $main;  // We store class properties in stuff like this. You say public/private/protected and the variable name.
                    //private means only accessable in this class, public means accessable everywhere. idk protected xD

    /**
     * EventListener constructor.
     * @param Loader $main
     */
    public function __construct(Loader $main)
    {
        $this->main = $main;
    }

    /**
     * @param DataPacketReceiveEvent $event
     */

    public function onDataPacket(DataPacketReceiveEvent $event)
    {
        $packet = $event->getPacket();
        if ($packet instanceof ServerSettingsRequestPacket) {
            $packet = new ServerSettingsResponsePacket();
            $packet->formData = file_get_contents($this->getDataFolder() . "tsconfig.json");
            $packet->formId = 5928;
            $event->getPlayer()->dataPacket($packet);
        } elseif ($packet instanceof ModalFormResponsePacket) {
            $formId = $packet->formId;
            if ($formId !== 5928) {
                return;

            }
        }
    }

    /**
     * @param PlayerJoinEvent $event
     */

    public function onJoin(PlayerJoinEvent $event)
    {
        $player = $event->getPlayer();
        $player->sendMessage(TextFormat::GREEN . "              -=CastleRaid=-                ");
        $player->sendMessage(TextFormat::GRAY . "                                             ");
        $player->sendMessage(TextFormat::GRAY . "         A Kingdoms Minecraft Pocket Ediition Server        ");
        $player->sendMessage(TextFormat::BOLD . TextFormat::AQUA . "   VOTE: Soon                    ");
        $player->sendMessage(TextFormat::BOLD . TextFormat::AQUA . "DONATE:" . TextFormat::GRAY."castleraid.buycraft.net");
        $player->sendMessage(TextFormat::GRAY . "                                             ");
        $player->sendMessage(TextFormat::GREEN . "                    -=-                     ");
        switch ($player->getName()) {
            case "iiFlamiinBlaze":
                $this->main->getServer()->broadcastMessage("Blazes are love, blazes are life!");
                break;
            case "QuiverlyRivalry":
                $this->main->getServer()->broadcastMessage("Wb oh sir lord of our kingdoms!");
                break;
        }
    }

    /**
     * @param PlayerItemConsumeEvent $event
     */
    public function onConsume(PlayerItemConsumeEvent $event)
    {
        $player = $event->getPlayer();
        $inv = $player->getInventory();
        $hand = $inv->getItemInHand();
        if ($hand->getId() === 373 && $hand->getDamage() === 1) {
            $player->addEffect(Effect::getEffect(Effect::STRENGTH)->setAmplifier(3)->setDuration(100 * 20));
            $inv->removeItem($hand);
        }
    }


    /**
     * @param PlayerInteractEvent $event
     */
    public function onInteract(PlayerInteractEvent $event)
    {
        $player = $event->getPlayer();
        if ($event->getItem()->getId() === 130) {
            $damage = $event->getItem()->getDamage();
            switch ($damage) {
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
                    $player->addTitle(C::BOLD . TextFormat::DARK_GRAY . "(" . TextFormat::GREEN . "!" . TextFormat::DARK_GRAY . ") " . TextFormat::RESET . TextFormat::GRAY . "You have won:", TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "$" . $tier3win);
                    $player->getInventory()->removeItem($tier3);
                    break;
            }
        }
    }
}