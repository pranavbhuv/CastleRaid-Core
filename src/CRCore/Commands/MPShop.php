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

namespace CRCore\Commands;

use CRCore\Loader;
use onebone\economyapi\EconomyAPI;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;

/**
 * Class MenuCommand
 * @package CRCore\Commands
 */
class MPShop extends PluginCommand
{
    /**
     * MenuCommand constructor.
     */
    /**
     * @param Loader $plugin
     */
    public function __construct(Loader $plugin)
    {
	    parent::__construct("mpshop", $plugin);
        $this->setPermission("mp.command");
        $this->setDescription("CastleRaid Core MoneyPouch Command");
        $this->setAliases(["mpshop"]);
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args) {
	    if($this->testPermission($sender) and $sender instanceof Player) {
		    $api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
		    $form = $api->createSimpleForm(function (Player $sender, array $data) {
			    if (isset($data[0])) {
				    switch ($data[0]) {
					    case 0:
						    $money = EconomyAPI::getInstance()->myMoney($sender->getName());
						    if ($money >= 20000) {
							    $itemID = 130;
							    $inv = $sender->getInventory();
							    $inv->addItem(Item::get($itemID, 101, 1)->setCustomName(TF::RESET . TF::BOLD . TF::LIGHT_PURPLE . "Money Pouch" . TF::RESET . TF::GRAY . " (Tap anywhere)" . PHP_EOL . PHP_EOL .

							                                                            TF::DARK_GRAY . " *" . TF::AQUA . " Tier Level: " . TF::GRAY . "1" . PHP_EOL .

							                                                            TF::DARK_GRAY . " *" . TF::AQUA . " Amount to win: " . TF::GRAY . "$10,000 - $25,000"));
							    EconomyAPI::getInstance()->reduceMoney($sender, 20000);
						    } else {
							    $sender->sendMessage("You Don't Have Enough Money.");
						    }
					    break;
					    case 1:
						    $money = EconomyAPI::getInstance()->myMoney($sender->getName());
						    if ($money >= 40000) {
							    $itemID = 130;
							    $inv = $sender->getInventory();
							    $inv->addItem(Item::get($itemID, 102, 1)->setCustomName(TF::RESET . TF::BOLD . TF::LIGHT_PURPLE . "Money Pouch" . TF::RESET . TF::GRAY . " (Tap anywhere)" . PHP_EOL . PHP_EOL .

							                                                            TF::DARK_GRAY . " *" . TF::AQUA . " Tier Level: " . TF::GRAY . "2" . PHP_EOL .

							                                                            TF::DARK_GRAY . " *" . TF::AQUA . " Amount to win: " . TF::GRAY . "$25,000 - $50,000"));
							    EconomyAPI::getInstance()->reduceMoney($sender, 40000);
						    } else {
							    $sender->sendMessage("You Don't Have Enough Money.");
						    }
					    break;
					    case 2:
						    $money = EconomyAPI::getInstance()->myMoney($sender->getName());
						    if ($money >= 80000) {
							    $itemID = 130;
							    $inv = $sender->getInventory();
							    $inv->addItem(Item::get($itemID, 103, 1)->setCustomName(TF::RESET . TF::BOLD . TF::LIGHT_PURPLE . "Money Pouch" . TF::RESET . TF::GRAY . " (Tap anywhere)" . PHP_EOL . PHP_EOL .

							                                                            TF::DARK_GRAY . " *" . TF::AQUA . " Tier Level: " . TF::GRAY . "3" . PHP_EOL .

							                                                            TF::DARK_GRAY . " *" . TF::AQUA . " Amount to win: " . TF::GRAY . "$50,000 - $100,000"));
							    EconomyAPI::getInstance()->reduceMoney($sender, 80000);
						    } else {
							    $sender->sendMessage("You Don't Have Enough Money.");
						    }
					    break;
				    }
			    }
		    });
		    $form->setTitle("Money Pouch Shop");
		    $form->setContent("Money Pouchs avaliable below!\nTier 1: Win between $10,000 to $25,000\nTier 2: Win between $25,000 to $50,000\nTier 3: Win between $50,000 t0 $100,000");
		    $form->addButton(TF::GREEN . "Tier 1 | $20k");
		    $form->addButton(TF::GREEN . "Tier 2 | $40k");
		    $form->addButton(TF::GREEN . "Tier 3 | $80k");
		    $form->sendToPlayer($sender);
		    return true;
	    }else{
	    	return false;
	    }
    }
}