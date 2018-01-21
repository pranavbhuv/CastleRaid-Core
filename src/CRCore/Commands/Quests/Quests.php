<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 1/21/18
 * Time: 12:30 PM
 */

namespace CRCore\Commands\Quests;


use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use jojoe77777\FormAPI;

use CRCore\API;

class Quests{

    private static $quests = [];

    public static function registerQuests(){
        $quests = [
            1 => [
                'Needed-Items' => [Item::get(Item::DIAMOND, 0, 10)],
                'Rewarded-Items' => [Item::get(Item::CHEST, 0, 1)->setCustomName(TextFormat::GREEN . "Raiding Quest Rewards " . TextFormat::GRAY .  " (Tap anywhere)")],
                'Quest-Name' => 'Knights'
            ]
        ];
        self::$quests = $quests;
    }

    public static function addQuest(int $id, array $neededItems, array $rewardedItems, string $name){
        if (isset(self::$quests[$id]) == false){
            self::$quests[] = [
                $id => [
                'Needed-Items' => $neededItems,
                'Rewarded-Items' => $rewardedItems,
                'Quest-Name' => $name
            ]];
        }
    }

    public function getQuestById(int $id) {
        $r = null;
        if (self::$quests[$id] !== null) {
            $r = self::$quests[$id];
        }
        return $r !== null ? $r : false;
    }

    public static function getQuestByName(string $name) {
        $r = null;
        for ($i = 0; $i < count(self::$quests); $i++) {
            $id = self::$quests[$i];
            if ($id['Quest-Name'] == $name){
                $r = self::$quests[$i];
            }
        }
        return $r !== null ? $r : false;
    }

    public function getQuestUI() {
        $ui = null;
        $api = API::$main->getServer()->getPluginManager()->getPlugin("FormAPI");
        if ($api !== null) {
            $form = $api->createSimpleForm(function (Player $player, array $data){
                if (empty($data) == false) {

                    foreach ($data as $value) {

                        if ($value == 0) $player->sendMessage(API::QUEST_PREFIX . TextFormat::DARK_RED . " Exiting QuestUI...");

                        foreach (self::$quests as $id => $index) {

                            if ($value == $id) {
                                foreach ($index['Needed-Items'] as $items) {

                                    if ($player->getInventory()->contains($items) == true){
                                        $player->getInventory()->removeItem($items);
                                        foreach ($index['Rewarded-Items'] as $reward){
                                            $player->getInventory()->addItem($reward);
                                            $player->sendMessage(API::QUEST_PREFIX . 'Finished quest '.$index['Quest-Name'] . '!');
                                        }
                                    } else {
                                        $player->sendMessage(API::QUEST_PREFIX . 'You dont have all the items needed to complete this quest!');
                                    }
                                }
                            }
                        }
                    }
                }
            });

            $form->setTitle("Quest UI");
            $form->setContent(TextFormat::AQUA . "Tap any of the available quests below!");
            $form->addButton(TextFormat::DARK_RED . "Exit");
            foreach (self::$quests as $id => $index) {
                $form->addButton(TextFormat::GREEN . $index['Quest-Name']);
            }
            $ui = $form;
        }
        return $ui !== null ? $ui : false;
    }
}
