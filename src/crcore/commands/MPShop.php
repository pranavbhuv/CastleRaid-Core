<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors     : QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Nice.
 */
declare(strict_types=1);

namespace crcore\commands;

use crcore\Loader;
use onebone\economyapi\EconomyAPI;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class MPShop extends PluginCommand{

	public function __construct(Loader $plugin){
		parent::__construct("mpshop", $plugin);
		$this->setPermission("mp.command");
		$this->setDescription("CastleRaid Core MoneyPouch Command");
		$this->setAliases(["mpshop"]);
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if($this->testPermission($sender) and $sender instanceof Player){
			$api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(function(Player $sender, array $data){
				$economy = EconomyAPI::getInstance();
				$money = $economy->myMoney($sender->getName());
				if(isset($data[0])){
					switch($data[0]){
						case 0:
							if($money >= 20000){
								$itemID = 130;
								$inv = $sender->getInventory();
								$inv->addItem(Item::get($itemID, 101, 1)->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Money Pouch" . TextFormat::RESET . TextFormat::GRAY . " (Tap anywhere)" . PHP_EOL . PHP_EOL .

								                                                        TextFormat::DARK_GRAY . " *" . TextFormat::AQUA . " Tier Level: " . TextFormat::GRAY . "1" . PHP_EOL .

								                                                        TextFormat::DARK_GRAY . " *" . TextFormat::AQUA . " Amount to win: " . TextFormat::GRAY . "$10,000 - $25,000"));
								$economy->reduceMoney($sender, 20000);
							}else{
								$sender->sendMessage("You Don't Have Enough Money.");
							}
							break;
						case 1:
							if($money >= 40000){
								$itemID = 130;
								$inv = $sender->getInventory();
								$inv->addItem(Item::get($itemID, 102, 1)->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Money Pouch" . TextFormat::RESET . TextFormat::GRAY . " (Tap anywhere)" . PHP_EOL . PHP_EOL .

								                                                        TextFormat::DARK_GRAY . " *" . TextFormat::AQUA . " Tier Level: " . TextFormat::GRAY . "2" . PHP_EOL .

								                                                        TextFormat::DARK_GRAY . " *" . TextFormat::AQUA . " Amount to win: " . TextFormat::GRAY . "$25,000 - $50,000"));
								$economy->reduceMoney($sender, 40000);
							}else{
								$sender->sendMessage("You Don't Have Enough Money.");
							}
							break;
						case 2:
							if($money >= 80000){
								$itemID = 130;
								$inv = $sender->getInventory();
								$inv->addItem(Item::get($itemID, 103, 1)->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Money Pouch" . TextFormat::RESET . TextFormat::GRAY . " (Tap anywhere)" . PHP_EOL . PHP_EOL .

								                                                        TextFormat::DARK_GRAY . " *" . TextFormat::AQUA . " Tier Level: " . TextFormat::GRAY . "3" . PHP_EOL .

								                                                        TextFormat::DARK_GRAY . " *" . TextFormat::AQUA . " Amount to win: " . TextFormat::GRAY . "$50,000 - $100,000"));
								$economy->reduceMoney($sender, 80000);
							}else{
								$sender->sendMessage("You Don't Have Enough Money.");
							}
							break;
					}
				}
			});
			$form->setTitle("Money Pouch Shop");
			$form->setContent("Money Pouchs avaliable below!\nTier 1: Win between $10,000 to $25,000\nTier 2: Win between $25,000 to $50,000\nTier 3: Win between $50,000 t0 $100,000");
			$form->addButton(TextFormat::GREEN . "Tier 1 | $20k");
			$form->addButton(TextFormat::GREEN . "Tier 2 | $40k");
			$form->addButton(TextFormat::GREEN . "Tier 3 | $80k");
			$form->sendToPlayer($sender);
			return true;
		}else{
			return false;
		}
	}
}