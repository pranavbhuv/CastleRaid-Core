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

namespace CRshit\Commands;

use CRshit\Loader;
use onebone\economyapi\EconomyAPI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\PluginCommand;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;
use jojoe77777\FormAPI;

/**
 * Class MenuCommand
 * @package CRshit\Commands
 */
class CustomPots extends PluginCommand implements CommandExecutor
{
    /**
     * MenuCommand constructor.
     */
    /**
     * @param Loader $plugin
     */
    public function __construct(Loader $plugin)
    {
        $this->setPermission("cp2.command");
        $this->setDescription("Custom Pot Shhop");
        parent::__construct("cpshop", $plugin);
    }

    /**
     * @param CommandSender $sender
     * @param Command $command
     * @param string $label
     * @param array $args
     * @return bool
     */
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        $cmd = strtolower($command->getName());
        switch ($cmd) {
            case "cpshop":
                if ($sender instanceof Player) {
                    if ($sender->hasPermission("cp2.command")) {
                        $this->cpForm($sender);
                    }
                }
                break;
        }
        return true;
    }

    /**
     * @param Player $sender
     */
    public function cpForm(Player $sender)
    {
        $api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, array $data) {
            if (isset($data[0])) {
                switch ($data[0]) {
                    case 0:
                        $money = EconomyAPI::getInstance()->myMoney($sender->getName());
                        if ($money >= 25000) {
                            $itemID = 373;
                            $inv = $sender->getInventory();
                            $inv->addItem(Item::get($itemID, 1, 1)->setCustomName("Raiding Potion \n \n*Todo\n *Todo"));
                            EconomyAPI::getInstance()->reduceMoney($sender, 25000);
                        } else {
                            $sender->sendMessage("You Don't Have Enough Money.");
                        }
                        break;
                    case 1:
                        $money = EconomyAPI::getInstance()->myMoney($sender->getName());
                        if ($money >= 40000) {
                            $itemID = 373;
                            $inv = $sender->getInventory();
                            $inv->addItem(Item::get($itemID, 2, 1)->setCustomName("Kingdom Potion\n \n*Todo\n *Todo"));
                            EconomyAPI::getInstance()->reduceMoney($sender, 40000);
                        } else {
                            $sender->sendMessage("You Don't Have Enough Money.");
                        }
                        break;
                    case 2:
                        $money = EconomyAPI::getInstance()->myMoney($sender->getName());
                        if ($money >= 15000) {
                            $itemID = 373;
                            $inv = $sender->getInventory();
                            $inv->addItem(Item::get($itemID, 3, 1)->setCustomName("Farming Potion"));
                            EconomyAPI::getInstance()->reduceMoney($sender, 15000);
                        } else {
                            $sender->sendMessage("You Don't Have Enough Money.");
                        }
                        break;
                    case 3;
                        $money = EconomyAPI::getInstance()->myMoney($sender->getName());
                        if ($money >= 30000) {
                            $itemID = 373;
                            $inv = $sender->getInventory();
                            $inv->addItem(Item::get($itemID, 4, 1)->setCustomName("PvP Potion"));
                            EconomyAPI::getInstance()->reduceMoney($sender, 30000);
                        } else {
                            $sender->sendMessage("You Don't Have Enough Money.");
                        }
                        break;
                    case 4;
                        $money = EconomyAPI::getInstance()->myMoney($sender->getName());
                        if ($money >= 30000) {
                            $itemID = 373;
                            $inv = $sender->getInventory();
                            $inv->addItem(Item::get($itemID, 5, 1)->setCustomName("Getaway Potion"));
                            EconomyAPI::getInstance()->reduceMoney($sender, 30000);
                        } else {
                            $sender->sendMessage("You Don't Have Enough Money.");
                        }
                        break;
                    case 5;
                        $money = EconomyAPI::getInstance()->myMoney($sender->getName());
                        if ($money >= 50000) {
                            $itemID = 373;
                            $inv = $sender->getInventory();
                            $inv->addItem(Item::get($itemID, 6, 1)->setCustomName("Kings Potion"));
                            EconomyAPI::getInstance()->reduceMoney($sender, 50000);
                        } else {
                            $sender->sendMessage("You Don't Have Enough Money.");
                        }
                        break;
                }
            }
        });
        $form->setTitle("CustomPotions Shop");
        $form->setContent("CustomPotions avaliable below!");
        $form->addButton(C::GREEN . "Raiding Potion | $25k");
        $form->addButton(C::GREEN . "Kingdom Potion | $40k");
        $form->addButton(C::GREEN . "Farming Potion | $15k");
        $form->addButton(C::GREEN . "Pvp Potion | $30k");
        $form->addButton(C::GREEN . "Getaway Potion | $30k");
        $form->addButton(C::GREEN . "Kings Potion | $50k");
        $form->sendToPlayer($sender);
    }
}