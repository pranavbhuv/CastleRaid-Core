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

namespace crcore;

use crcore\commands\ClearInventoryCommand;
use crcore\commands\CustomPotsCommand;
use crcore\commands\FlyCommand;
use crcore\commands\HealCommand;
use crcore\commands\InfoCommand;
use crcore\commands\MenuCommand;
use crcore\commands\MPShopCommand;
use crcore\commands\NickCommand;

use crcore\events\EventListener;
use crcore\events\PotionListener;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Loader extends PluginBase{
	//TODO: Remove this or at least move it...
	const NO_PERMISSION = TextFormat::BOLD . TextFormat::GRAY . "(" . TextFormat::RED . "!" . TextFormat::GRAY . ")" . TextFormat::RED . "You don't have permission to use this command";

	public function onLoad() : void{
		$this->saveResource("tsconfig.json");
	}

	public function onEnable() : void{
		new EventListener($this);
		new PotionListener($this);

		$this->getServer()->getCommandMap()->registerAll("crcore", [
			new CustomPotsCommand($this),
			new InfoCommand($this),
			new MenuCommand($this),
			new MPShopCommand($this),
			new NickCommand($this),
			new ClearInventoryCommand($this),
			new HealCommand($this),
			new FlyCommand($this)
		]);
	}
}
