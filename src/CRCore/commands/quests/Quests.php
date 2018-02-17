<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\commands\Quests;

use CRCore\API;
use jojoe77777\FormAPI\FormAPI;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class Quests{

    const QUEST_PREFIX = TextFormat::GREEN . "Quests " . TextFormat::AQUA . "> " . TextFormat::WHITE;

    /** @var array[] $quests */
    private static $quests = [];

    public static function registerQuests() : void{
        $quests = [
            1 => [
                'Needed-Items' => [Item::get(Item::DIAMOND, 0, 10)],
                'Rewarded-Items' => [Item::get(Item::CHEST, 0, 1)->setCustomName(TextFormat::GREEN . "Knights Quest Rewards " . TextFormat::GRAY . " (Tap anywhere)")],
                'Quest-Name' => 'Knights'
            ]
        ];
        self::$quests = $quests;
    }

    public static function addQuest(int $id, array $neededItems, array $rewardedItems, string $name) : void{
        if(isset(self::$quests[$id]) == false){
            self::$quests[$id] = [
                $id => [
                    'Needed-Items' => $neededItems,
                    'Rewarded-Items' => $rewardedItems,
                    'Quest-Name' => $name
                ]];
        }
    }

    public function getQuestById(int $id) : array{
        if(self::$quests[$id] == null) return null;
        return self::$quests[$id];
    }

    public static function getQuestByName(string $name) : ?array{
        $r = null;
        for($i = 0; $i < count(self::$quests); $i++){
            $id = self::$quests[$i];
            if($id['Quest-Name'] == $name){
                $r = self::$quests[$i];
            }
        }
        return $r;
    }

    public function getQuestUI() : ?SimpleForm{
        $ui = null;

        /** @var FormAPI $api */
        $api = API::$main->getServer()->getPluginManager()->getPlugin("FormAPI");
        if($api !== null){
            $form = $api->createSimpleForm(function (Player $player, ?int $data){
                if(!isset($data)) return false;
                if($data == 0) $player->sendMessage(Quests::QUEST_PREFIX . TextFormat::DARK_RED . " Exiting QuestUI...");
                foreach(self::$quests as $id => $index){
                    if($data !== $id) return false;
                    $all = true;
                    foreach($index['Needed-Items'] as $items){
                        if(!$player->getInventory()->contains($items)){
                            $need = "";
                            foreach($index['Needed-Items'] as $item){
                                if(!$item instanceof Item) continue;
                                $need .= "{$item->getCount()} {$item->getName()}(s)\n";
                            }
                            $player->sendMessage(Quests::QUEST_PREFIX . TextFormat::RED . "You don't have all the items needed to complete this quest!\n".
                                                                                           "Needed items: " . TextFormat::ITALIC . $need);
                            $all = false;
                            break;
                        }
                    }
                    if($all){
                        foreach($index['Needed-Items'] as $items)
                            $player->getInventory()->removeItem($items);
                        foreach($index['Rewarded-Items'] as $reward){
                            $player->getInventory()->addItem($reward);
                            $player->sendMessage(Quests::QUEST_PREFIX . TextFormat::GREEN . 'Finished quest ' . TextFormat::GOLD . $index['Quest-Name'] . TextFormat::GREEN . '!');
                        }
                    }
                }
                return true;
            });
            $form->setTitle("Quest UI");
            $form->setContent(TextFormat::AQUA . "Tap any of the available quests below!");
            $form->addButton(TextFormat::DARK_RED . "Exit");
            foreach(self::$quests as $id => $index){
                $form->addButton(TextFormat::GREEN . $index['Quest-Name']);
            }
            $ui = $form;
        }
        return $ui;
    }
}
