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
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class MenuCommand extends BaseCommand{

    public function __construct(Loader $plugin){
        parent::__construct($plugin, "menu", "Control Panel", "/menu", ["m"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender instanceof Player){
            $sender->sendMessage(API::NOT_PLAYER);
            return false;
        }
        if(!$sender->hasPermission("castleraid.menu")){
            $sender->sendMessage(parent::NO_PERMISSION);
            return false;
        }
        /** @var FormAPI $api */
        $api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, ?int $data){
            if(!isset($data)) return;
            switch($data){
                case 0:
                    $command = "shopui";
                    $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender, $command);
                    break;
                case 1:
                    $command1 = "mp";
                    $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender, $command1);
                    break;
                case 2:
                    $command2 = "cpshop";
                    $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender, $command2);
                    break;
                case 3:
                    $command3 = "combine";
                    $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender, $command3);
                    break;
                case 4:
                    $command4 = "k";
                    $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender, $command4);
                    break;
                case 5:
                    $command5 = "warpme";
                    $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender, $command5);
                    break;
                case 6:
                    $command6 = "celist";
                    $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender, $command6);
                    break;
                case 7:
                    $command7 = "ah";
                    $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender, $command7);
                    break;
                case 8:
                    $command8 = "tutorial";
                    $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender, $command8);
                    break;
                case 9:
                    $command9 = "info";
                    $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender, $command9);
                    break;
            }
        });
        $form->setTitle("Server Menu");
        $form->setContent("List of buttons.");
        $form->addButton(TextFormat::DARK_AQUA . "Shop");
        $form->addButton(TextFormat::DARK_AQUA . "Money Pouch Shop");
        $form->addButton(TextFormat::DARK_AQUA . "Custom Potion Shop");
        $form->addButton(TextFormat::DARK_AQUA . "Combiner");
        $form->addButton(TextFormat::DARK_AQUA . "Kingdom Menu");
        $form->addButton(TextFormat::DARK_AQUA . "Kingdom Teleporter");
        $form->addButton(TextFormat::DARK_AQUA . "CE List");
        $form->addButton(TextFormat::DARK_AQUA . "Auction House");
        $form->addButton(TextFormat::DARK_AQUA . "Tutorial");
        $form->addButton(TextFormat::DARK_AQUA . "Information");
        $form->sendToPlayer($sender);
        return true;
    }
}
