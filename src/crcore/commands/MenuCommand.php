<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors     : QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Nice.
 */

namespace crcore\commands;

use crcore\Loader;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class MenuCommand extends PluginCommand{

	public function __construct(Loader $plugin){
		parent::__construct("menu", $plugin);
		$this->setPermission("cp.command");
		$this->setDescription("CastleRaid Core Menu Command");
		$this->setAliases(["cp"]);
	}

	/**
	 * @param CommandSender $sender
	 * @param string        $commandLabel
	 * @param array         $args
	 *
	 * @return bool|mixed|void
	 */
	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if($this->testPermission($sender) and $sender instanceof Player){
			$api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(function(Player $sender, array $data){
				$commandMap = $this->getPlugin()->getServer()->getCommandMap();
				if(isset($data[0])){
					switch($data[0]){
						case 0:
							$command = "shopui";
							$commandMap->dispatch($sender, $command);
							break;
						case 1:
							$command1 = "mpshop";
							$commandMap->dispatch($sender, $command1);
							break;
						case 2:
							$command2 = "cpshop";
							$commandMap->dispatch($sender, $command2);
							break;
						case 3:
							$command3 = "combine";
							$commandMap->dispatch($sender, $command3);
							break;
						case 4:
							$command4 = "k";
							$commandMap->dispatch($sender, $command4);
							break;
						case 5:
							$command5 = "warpme";
							$commandMap->dispatch($sender, $command5);
							break;
						case 6:
							$command6 = "celist";
							$commandMap->dispatch($sender, $command6);
							break;
						case 7:
							$command7 = "ah";
							$commandMap->dispatch($sender, $command7);
							break;
						case 8:
							$command8 = "tutorial";
							$commandMap->dispatch($sender, $command8);
							break;
						case 9:
							$command9 = "information";
							$commandMap->dispatch($sender, $command9);
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
		}
	}
}
