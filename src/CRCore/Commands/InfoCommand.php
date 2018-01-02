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
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\PluginCommand;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;

/**
 * Class InfoCommand
 * @package CRCore\Commands
 */
class InfoCommand extends PluginCommand implements CommandExecutor
{
    /**
     * InfoCommand constructor.
     * @param Loader $plugin
     */
    public function __construct(Loader $plugin)
    {
        $this->setDescription("Receive A Book About How To Play");
        $this->setAliases(["information"]);
        $this->setPermission("castleraid.info");
        parent::__construct("info", $plugin);
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
            case "info":
                if ($sender instanceof Player) {
                    if ($sender->hasPermission("castleraid.info")) {
                        $this->giveBook($sender);
                        $sender->sendMessage(C::GREEN . "You recivied Infomation book!");
                    }
                }
                break;
        }
        return true;
    }

    /**
     * @param $player
     */

    public function giveBook(Player $player)
    {
        $book = Item::get(Item::WRITTEN_BOOK, 0, 1);
        $book->setTitle(C::GREEN . C::UNDERLINE . "Information Booklet");
        $book->setPageText(0, C::GREEN . C::UNDERLINE . "Whats a Kingdom?" . C::BLACK . "\n - A kingdom, is your home, its like a fations. Except bigger! \n - Kingdoms, have many members and a custom world! \n - Each kingdom has a king, this king is who you shall fight for!");
        $book->setPageText(1, C::GREEN . C::UNDERLINE . "How can my Kingdom win?" . C::BLACK . "\n - You can earn power in the weekly wars, and from PvPing enemy kingdoms! \n - You can earn power in our KOTH at warzone.");
        $book->setPageText(2, C::GREEN . c::UNDERLINE . "How do I store my loot, and get loot?" . C::BLACK . "\n - Try doing /pv 1, for a vault! \n - Go to your kingdoms world, and make a base, skybase, or lair! \n - Make sure you raid other kingdoms bases!");
        $book->setPageText(3, C::GREEN . c::UNDERLINE . "Helpful Commands" . C::BLACK . "\n- /k \n - /warpme \n - /pv \n - /shop \n - /cpshop \n - /mpshop \n - /menu");
        $book->setAuthor("CastleRaid Network");
        $player->getInventory()->addItem($book);
    }
}