<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\commands\guest;

use CRCore\API;
use CRCore\commands\BaseCommand;
use CRCore\Loader;
use jojoe77777\FormAPI\FormAPI;
use onebone\economyapi\EconomyAPI;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class CustomPotionsCommand extends BaseCommand{

    public $nomoney = TextFormat::RED . "You don't have enough money.";

    public function __construct(Loader $plugin){
        parent::__construct($plugin, "cpshop", "CPShop Command", "/cpshop", ["cpshop"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender instanceof Player){
            $sender->sendMessage(API::NOT_PLAYER);
            return false;
        }
        if(!$sender->hasPermission("castleraid.cp2")){
            $sender->sendMessage(parent::NO_PERMISSION);
            return false;
        }
        /** @var FormAPI $api */
        $api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, ?int $data){
            if(!isset($data)) return;
            switch($data){
                case 0:
                    $money = EconomyAPI::getInstance()->myMoney($sender->getName());
                    if($money >= 25000){
                        $itemID = 373;
                        $inv = $sender->getInventory();
                        $inv->addItem(Item::get($itemID, 100, 1)->setCustomName("Raiding Potion \n \n*Todo\n *Todo"));
                        EconomyAPI::getInstance()->reduceMoney($sender, 25000);
                    }else{
                        $sender->sendMessage($this->nomoney);
                    }
                    break;
                case 1:
                    $money = EconomyAPI::getInstance()->myMoney($sender->getName());
                    if($money >= 40000){
                        $itemID = 373;
                        $inv = $sender->getInventory();
                        $inv->addItem(Item::get($itemID, 101, 1)->setCustomName("Kingdom Potion\n \n*Todo\n *Todo"));
                        EconomyAPI::getInstance()->reduceMoney($sender, 40000);
                    }else{
                        $sender->sendMessage($this->nomoney);
                    }
                    break;
                case 2:
                    $money = EconomyAPI::getInstance()->myMoney($sender->getName());
                    if($money >= 15000){
                        $itemID = 373;
                        $inv = $sender->getInventory();
                        $inv->addItem(Item::get($itemID, 102, 1)->setCustomName("Farming Potion"));
                        EconomyAPI::getInstance()->reduceMoney($sender, 15000);
                    }else{
                        $sender->sendMessage($this->nomoney);
                    }
                    break;
                case 3;
                    $money = EconomyAPI::getInstance()->myMoney($sender->getName());
                    if($money >= 30000){
                        $itemID = 373;
                        $inv = $sender->getInventory();
                        $inv->addItem(Item::get($itemID, 103, 1)->setCustomName("PvP Potion"));
                        EconomyAPI::getInstance()->reduceMoney($sender, 30000);
                    }else{
                        $sender->sendMessage($this->nomoney);
                    }
                    break;
                case 4;
                    $money = EconomyAPI::getInstance()->myMoney($sender->getName());
                    if($money >= 30000){
                        $itemID = 373;
                        $inv = $sender->getInventory();
                        $inv->addItem(Item::get($itemID, 104, 1)->setCustomName("Getaway Potion"));
                        EconomyAPI::getInstance()->reduceMoney($sender, 30000);
                    }else{
                        $sender->sendMessage($this->nomoney);
                    }
                    break;
                case 5;
                    $money = EconomyAPI::getInstance()->myMoney($sender->getName());
                    if($money >= 50000){
                        $itemID = 373;
                        $inv = $sender->getInventory();
                        $inv->addItem(Item::get($itemID, 105, 1)->setCustomName("Kings Potion"));
                        EconomyAPI::getInstance()->reduceMoney($sender, 50000);
                    }else{
                        $sender->sendMessage($this->nomoney);
                    }
                    break;
            }
        });
        $form->setTitle("Custom Potions Shop");
        $form->setContent("Custom Potions available below!");
        $form->addButton(TextFormat::DARK_AQUA . "Raiding Potion | $25k");
        $form->addButton(TextFormat::DARK_RED . "Kingdom Potion | $40k");
        $form->addButton(TextFormat::DARK_GREEN . "Farming Potion | $15k");
        $form->addButton(TextFormat::DARK_AQUA . "Pvp Potion | $30k");
        $form->addButton(TextFormat::DARK_AQUA . "Getaway Potion | $30k");
        $form->addButton(TextFormat::DARK_RED . "Kings Potion | $50k");
        $form->sendToPlayer($sender);
        return true;
    }
}
