<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Nice.
 */
declare(strict_types=1);

namespace CRshit\Commands;

use CRshit\Loader;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\PluginCommand;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;

/**
 * Class MenuCommand
 * @package CRshit\Commands
 */
class TradeCommand extends PluginCommand implements CommandExecutor
{
    /**
     * MenuCommand constructor.
     * @param Loader $plugin
     */
    public function __construct(Loader $plugin)
    {
        $this->setPermission("trade.command");
        $this->setDescription("Trade Commands");
        $this->setAliases(["trade"]);
        parent::__construct("trade", $plugin);
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
            case "trade":
                if ($sender instanceof Player) {
                    if ($sender->hasPermission("trade.command")) {
                        $this->tradeForm($sender);
                    }
                }
                break;
        }
        return true;
    }

    /**
     * @param $sender
     */
    public function tradeForm($sender)
    {
        $api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, array $data) {
            if (isset($data[0])) {
                switch ($data[0]) {
                    case 0:
                        $command = "menu";
                        $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                    case 1:
                        $command1 = "sell";
                        $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender, $command1);
                        break;
                    case 2:
                        $command2 = "ah";
                        $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender, $command2);
                        break;

                }
            }
        });
        $form->setTitle("Trade Menu");
        $form->setContent("List of Actions");
        $form->addButton(C::GREEN . "Back, to Loader Menu");
        $form->addButton(C::GREEN . "Auction your Items");
        $form->addButton(C::GREEN . "Buy auctioned Items");
        $form->sendToPlayer($sender);
    }
}