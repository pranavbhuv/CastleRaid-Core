
<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\commands\staff;

use CRCore\API;
use CRCore\commands\BaseCommand;
use CRCore\Loader;
use jojoe77777\FormAPI\FormAPI;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class ModPage extends BaseCommand{

    public function __construct(Loader $plugin){
        parent::__construct($plugin, "modscreen", "Control Panel for Morderators", "/modscreen", ["ms"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender instanceof Player){
            $sender->sendMessage(API::NOT_PLAYER);
            return false;
        }
        if(!$sender->hasPermission("castleraid.ms")){
            $sender->sendMessage(parent::NO_PERMISSION);
            return false;
        }
        $api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, array $data){
            if(isset($data[0])){
                switch($data[0]){
                    case 0:
                        $this->kickForm($sender);
                        break;
                    case 1:
                        $this->freezeForm($sender);
                        break;
                    case 2:
                        $this->broadcastForm($sender);
                        break;
                    case 3:
                        $this->callforhelp($sender);
                        break;
                }
            }
        });
        $form->setTitle("Moderators Menu");
        $playername = $sender->getName();
        $form->setContent(TextFormat::WHITE . "Welcome" . TextFormat::GREEN . "[Mod]" . TextFormat::GRAY . $playername);
        $form->addButton("Kick a Player\nKick an Abusive Player!");
        $form->addButton("Freeze a player\nFreeze an hacker, for a screenshot");
        $form->addButton("Broadcast a Message\n" . TextFormat::RED . "Only for emergencys!");
        $form->addButton("Call for backup\nCall all OPs!");
        $form->sendToPlayer($sender);
        return true;
    }

    public function kickForm($player){
        $api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createCustomForm(function (Player $event, array $data){
            $player = $event->getPlayer();
            $result = $data[0];
            if($result != null){
                $this->playerName = $result;
                $this->reason = $data[1];
                $this->getPlugin()->getServer()->
                $this->plugin->getServer()->dispatchCommand(new ConsoleCommandSender(), "ban " . $this->targetName . " " . $this->reason);
            }
        });
        $form->setTitle(TextFormat::GREEN . "Kick an Player");
        $form->addInput("Player Name");
        $form->addInput("Reason");
        $form->sendToPlayer($player);
    }
}
