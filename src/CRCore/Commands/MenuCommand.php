<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Nice.
 */

namespace CRCore\Commands;

use CRCore\Loader;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\PluginCommand;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;

/**
 * Class MenuCommand
 * @package CRCore\Commands
 */
class MenuCommand extends PluginCommand implements CommandExecutor
{
    /**
     * MenuCommand constructor.
     * @param Loader $plugin
     */
    public function __construct(Loader $plugin)
    {
        $this->setPermission("cp.command");
        $this->setDescription("Control Panel");
        $this->setAliases(["cp"]);
        parent::__construct("menu", $plugin);
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
            case "menu":
                if ($sender instanceof Player) {
                    if ($sender->hasPermission("cp.command")) {
                        $this->menuForm($sender);
                    }
                }
                break;
        }
        return true;
    }

    /**
     * @param Player $sender
     */
    public function menuForm(Player $sender)
    {
        $api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, array $data) {
            if (isset($data[0])) {
                switch ($data[0]) {
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
        $form->addButton(C::WHITE . "Shop");
        $form->addButton(C::WHITE . "Money Pouch Shop");
        $form->addButton(C::WHITE . "Custom Potion Shop");
        $form->addButton(C::WHITE . "Combiner");
        $form->addButton(C::WHITE . "Kingdom Menu");
        $form->addButton(C::WHITE . "Kingdom Teleporter");
        $form->addButton(C::WHITE . "CE List");
        $form->addButton(C::WHITE . "Auction House");
        $form->addButton(C::WHITE . "Tutorial");
        $form->addButton(C::WHITE . "Information");
        $form->sendToPlayer($sender);
    }
}
