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
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class FeedbackCommand extends BaseCommand{

    const FEEDBACK_PREFIX = TextFormat::BLUE . "Feedback" . "> " . TextFormat::WHITE;

    public function __construct(Loader $plugin){
        parent::__construct($plugin, "feedback", "Gives us feedback", "/feedback", ["fb"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender instanceof Person){
            $sender->sendMessage(API::NOT_PLAYER);
            return false;
        }
        if(!$sender->hasPermission("castleraid.feedback")){
            $sender->sendMessage(parent::NO_PERMISSION);
            return false;
        }
        $this->sendFeedbackForm($sender);
        return true;
    }

    public function sendFeedbackForm(Person $person) : void{
        /** @var FormAPI $api */
        $api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createCustomForm(function (Person $player, array $data){
            if(!isset($data)) return;
            $f = fopen(API::$main->getDataFolder() . "/feedback/" . $player->getName() . ".txt", "a");
            fwrite($f, $data[0] . "\n");
            fclose($f);
            $player->sendMessage(self::FEEDBACK_PREFIX . TextFormat::GREEN . "Thanks for your feedback! Our developers will take a look to it ASAP.");
            return null;
        });
        $form->setTitle(TextFormat::BLUE . "Feedback");
        $form->addInput("Write your feedback/suggestion/bug report here!\n", "Vaults don't work.");
        $form->sendToPlayer($person);
    }
}
