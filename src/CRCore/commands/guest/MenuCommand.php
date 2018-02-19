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

use pocketmine\Player;
use jojoe77777\FormAPI\FormAPI;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;

class MenuCommand extends PluginCommand{


	/**
	 * MenuCommand constructor.
	 * @param string $name
	 * @param Plugin $owner
	 */
    public function __construct (string $name, Plugin $owner){
	    parent::__construct($name, $owner);
	    $this->setDescription("Control Panel");
	    $this->setAliases(["cp"]);
	    $this->setPermission("castleraid.cp");
    }

	/**
	 * @param CommandSender $sender
	 * @param string $commandLabel
	 * @param array $args
	 * @return bool|mixed
	 */
	public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender instanceof Player){
            $sender->sendMessage('Only In-Game');
            return false;
        }

        if(!$this->testPermission($sender)) return true;

        $api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, array $data){
            if(isset($data[0])){
                switch($data[0]){
                    case 0:
                        $command = "shopui";
                        $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                    case 1:
                        $command1 = "mpshop";
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
                        $command9 = "information";
                        $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender, $command9);
                        break;
                }
            }
        });
        $form->setTitle("Server Menu");
        $form->setContent("List of buttons.");
        $form->addButton(TextFormat::WHITE . "Shop");
        $form->addButton(TextFormat::WHITE . "Money Pouch Shop");
        $form->addButton(TextFormat::WHITE . "Custom Potion Shop");
        $form->addButton(TextFormat::WHITE . "Combiner");
        $form->addButton(TextFormat::WHITE . "Kingdom Menu");
        $form->addButton(TextFormat::WHITE . "Kingdom Teleporter");
        $form->addButton(TextFormat::WHITE . "CE List");
        $form->addButton(TextFormat::WHITE . "Auction House");
        $form->addButton(TextFormat::WHITE . "Tutorial");
        $form->addButton(TextFormat::WHITE . "Information");
        $form->sendToPlayer($sender);
        return true;
    }
}
