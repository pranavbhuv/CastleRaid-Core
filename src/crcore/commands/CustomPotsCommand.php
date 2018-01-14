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
use jojoe77777\FormAPI;
use onebone\economyapi\EconomyAPI;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class CustomPotsCommand extends PluginCommand{

	public function __construct(Loader $plugin){
		parent::__construct("cpshop", $plugin);
		$this->setPermission("cp2.command");
		$this->setDescription("CastleRaid Core CustomPot Command");
	}

	/**
	 * @param CommandSender $sender
	 * @param string        $commandLabel
	 * @param array         $args
	 *
	 * @return bool|mixed
	 */
	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if($this->testPermission($sender) and $sender instanceof Player){
			$api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(function(Player $sender, array $data){
				$economy = EconomyAPI::getInstance();
				$money = $economy->myMoney($sender->getName());
				if(isset($data[0])){
					switch($data[0]){
						case 0:
							if($money >= 25000){
								$itemID = 373;
								$inv = $sender->getInventory();
								$inv->addItem(Item::get($itemID, 100, 1)->setCustomName("Raiding Potion \n \n*Todo\n *Todo"));
								$economy->reduceMoney($sender, 25000);
							}else{
								$sender->sendMessage("You don't have enough money!");
							}
							break;
						case 1:
							if($money >= 40000){
								$itemID = 373;
								$inv = $sender->getInventory();
								$inv->addItem(Item::get($itemID, 101, 1)->setCustomName("Kingdom Potion\n \n*Todo\n *Todo"));
								$economy->reduceMoney($sender, 40000);
							}else{
								$sender->sendMessage("You don't have enough money!");
							}
							break;
						case 2:
							if($money >= 15000){
								$itemID = 373;
								$inv = $sender->getInventory();
								$inv->addItem(Item::get($itemID, 102, 1)->setCustomName("Farming Potion"));
								$economy->reduceMoney($sender, 15000);
							}else{
								$sender->sendMessage("You don't have enough money!");
							}
							break;
						case 3;
							if($money >= 30000){
								$itemID = 373;
								$inv = $sender->getInventory();
								$inv->addItem(Item::get($itemID, 103, 1)->setCustomName("PvP Potion"));
								$economy->reduceMoney($sender, 30000);
							}else{
								$sender->sendMessage("You don't have enough money!");
							}
							break;
						case 4;
							if($money >= 30000){
								$itemID = 373;
								$inv = $sender->getInventory();
								$inv->addItem(Item::get($itemID, 104, 1)->setCustomName("Getaway Potion"));
								$economy->reduceMoney($sender, 30000);
							}else{
								$sender->sendMessage("You don't have enough money!");
							}
							break;
						case 5;
							if($money >= 50000){
								$itemID = 373;
								$inv = $sender->getInventory();
								$inv->addItem(Item::get($itemID, 105, 1)->setCustomName("Kings Potion"));
								$economy->reduceMoney($sender, 50000);
							}else{
								$sender->sendMessage("You don't have enough money!");
							}
							break;
					}
				}
			});
			$form->setTitle("Custom Potions Shop");
			$form->setContent("Custom Potions available below!");
			$form->addButton(TextFormat::GREEN . "Raiding Potion | $25k");
			$form->addButton(TextFormat::GREEN . "Kingdom Potion | $40k");
			$form->addButton(TextFormat::GREEN . "Farming Potion | $15k");
			$form->addButton(TextFormat::GREEN . "Pvp Potion | $30k");
			$form->addButton(TextFormat::GREEN . "Getaway Potion | $30k");
			$form->addButton(TextFormat::GREEN . "Kings Potion | $50k");
			$form->sendToPlayer($sender);
			return true;
		}else{
			return false;
		}
	}
}
