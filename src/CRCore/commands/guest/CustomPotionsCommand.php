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
use CRCore\person\Person;
use jojoe77777\FormAPI\FormAPI;
use onebone\economyapi\EconomyAPI;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class CustomPotionsCommand extends BaseCommand{

    public $nomoney = TextFormat::RED . "You don't have enough money.";

    public function __construct(Loader $plugin){
        parent::__construct($plugin, "cpshop", "CPShop Command", "/cpshop", ["cp"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender instanceof Person){
            $sender->sendMessage(API::NOT_PLAYER);
            return false;
        }
        if(!$sender->hasPermission("castleraid.cp")){
            $sender->sendMessage(parent::NO_PERMISSION);
            return false;
        }
        /** @var FormAPI $api */
        $api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, ?int $data){
            if(!isset($data)) return;
            if(!$player instanceof Person) return;
            switch($data){
                case 0: //meta 100
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if($money >= 25000){
                        $nbt = new CompoundTag("", [new StringTag("type", "raiding")]);
                        $player->getInventory()->addItem(Item::get(Item::POTION)->setCustomBlockData($nbt));
                        $player->reduceMoney(25000);
                    }else{
                        $player->sendMessage($this->nomoney);
                    }
                    break;
                case 1: //101
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if($money >= 40000){
                        $nbt = new CompoundTag("", [new StringTag("type", "kingdom")]);
                        $player->getInventory()->addItem(Item::get(Item::POTION)->setCustomBlockData($nbt));
                        $player->reduceMoney(40000);
                    }else{
                        $player->sendMessage($this->nomoney);
                    }
                    break;
                case 2: //102
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if($money >= 15000){
                        $nbt = new CompoundTag("", [new StringTag("type", "farming")]);
                        $player->getInventory()->addItem(Item::get(Item::POTION)->setCustomBlockData($nbt));
                        $player->reduceMoney(15000);
                    }else{
                        $player->sendMessage($this->nomoney);
                    }
                    break;
                case 3; #103
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if($money >= 30000){
                        $nbt = new CompoundTag("", [new StringTag("type", "pvp")]);
                        $player->getInventory()->addItem(Item::get(Item::POTION)->setCustomBlockData($nbt));
                        $player->reduceMoney(30000);
                    }else{
                        $player->sendMessage($this->nomoney);
                    }
                    break;
                case 4; #104
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if($money >= 30000){
                        $nbt = new CompoundTag("", [new StringTag("type", "getaway")]);
                        $player->getInventory()->addItem(Item::get(Item::POTION)->setCustomBlockData($nbt));
                        $player->reduceMoney(30000);
                    }else{
                        $player->sendMessage($this->nomoney);
                    }
                    break;
                case 5; #105
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if($money >= 50000){
                        $nbt = new CompoundTag("", [new StringTag("type", "kings")]);
                        $player->getInventory()->addItem(Item::get(Item::POTION)->setCustomBlockData($nbt));
                        $player->reduceMoney(50000);
                    }else{
                        $player->sendMessage($this->nomoney);
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
