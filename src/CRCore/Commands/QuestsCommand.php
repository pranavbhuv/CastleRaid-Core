
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

namespace CRCore\Commands;

use CRCore\Loader;
use CRCore\Events\QuestListener;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use pocketmine\item\Item;
use pocketmine\inventory\Inventory;
use jojoe77777\FormAPI;

class QuestsCommand extends PluginCommand {

    public $inv;

    public function __construct(Loader $plugin) {
        parent::__construct("quests", $plugin);
        $this->setDescription("Quests Command");
        $this->setPermission("castleraid.quests");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if ($sender->hasPermission("castleraid.quests")) {
            if ($sender instanceof Player) {
                $this->mainForm($sender);
            } else {
                $sender->sendMessage(API::NOT_PLAYER);
            }
        } else {
            $sender->sendMessage(API::NO_PERMISSION);
        }
    }

    public function mainForm(Player $player) {
        $api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, array $data) {
            if (isset($data[0])) {
                switch ($data[0]) {
                    case 0:
                        $sender->sendMessage(Loader::QUEST_PREFIX . TextFormat::DARK_RED . " Exiting QuestUI...");
                        break;
                    case 1:
                        $inv = $sender->getInventory();
                        if ($inv->contains(Item::get(Item::DIAMOND, 0, 10))) { //Quiver edit this for items for quests
                            $sender->sendMessage(API::QUEST_PREFIX . TextFormat::RED . " You have now received the quest rewards chest!");
                            $inv->removeItem(Item::get(Item::DIAMOND, 0, 10)); //Quiver edit this for items for quests
                            $inv->addItem(Item::get(Item::CHEST, 10, 1)->setCustomName(TextFormat::GREEN . "Knights Quest Rewards " . TextFormat::GRAY .  " (Tap anywhere)"));
                        } else {
                            $sender->sendMessage(TextFormat::RED . "You do not have the correct items to complete this quest!");
                        }
                        break;
                    case 2:
                        $inv = $sender->getInventory();
                        if ($inv->contains(Item::get(Item::DIAMOND, 0, 10))) { //Quiver edit this for items for quests
                            $sender->sendMessage(API::QUEST_PREFIX . TextFormat::RED . " You have now received the quest rewards chest!");
                            $inv->removeItem(Item::get(Item::DIAMOND, 0, 10)); //Quiver edit this for items for quests
                            $inv->addItem(Item::get(Item::CHEST, 11, 1)->setCustomName(TextFormat::GREEN . "Raiding Quest Rewards " . TextFormat::GRAY .  " (Tap anywhere)"));
                        } else {
                            $sender->sendMessage(TextFormat::RED . "You do not have the correct items to complete this quest!");
                        }
                        break;
                }
            }
        });
        $form->setTitle("Quest UI");
        $form->setContent(TextFormat::AQUA . "Tap any of the available quests below!");
        $form->addButton(TextFormat::DARK_RED . "Exit");
        $form->addButton(TextFormat::RED . "Quest | Knights");
        $form->addButton(TextFormat::RED . "Quest | Raiding");
        $form->sendToPlayer($player);
    }
}
