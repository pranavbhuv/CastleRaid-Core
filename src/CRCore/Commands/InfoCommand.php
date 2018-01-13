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
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\item\Item;
use pocketmine\item\WrittenBook;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;

/**
 * Class InfoCommand
 * @package CRCore\Commands
 */
class InfoCommand extends PluginCommand {
    /**
     * InfoCommand constructor.
     * @param Loader $plugin
     */
    public function __construct(Loader $plugin) {
        parent::__construct("info", $plugin);
        $this->setDescription("CastleRaid Core Info Command");
        $this->setAliases(["information"]);
        $this->setPermission("castleraid.info");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @return bool|mixed
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if ($this->testPermission($sender) and $sender instanceof Player) {
            /** @var WrittenBook $book */
            $book = Item::get(Item::WRITTEN_BOOK, 0, 1);
            $book->setTitle(C::GREEN . C::UNDERLINE . "Information Booklet");
            $book->setPageText(0, C::GREEN . C::UNDERLINE . "Whats a Kingdom?" . C::BLACK . "\n - A kingdom, is your home, its like a fations. Except bigger! \n - Kingdoms, have many members and a custom world! \n - Each kingdom has a king, this king is who you shall fight for!");
            $book->setPageText(1, C::GREEN . C::UNDERLINE . "How can my Kingdom win?" . C::BLACK . "\n - You can earn power in the weekly wars, and from PvPing enemy kingdoms! \n - You can earn power in our KOTH at warzone.");
            $book->setPageText(2, C::GREEN . c::UNDERLINE . "How do I store my loot, and get loot?" . C::BLACK . "\n - Try doing /pv 1, for a vault! \n - Go to your kingdoms world, and make a base, skybase, or lair! \n - Make sure you raid other kingdoms bases!");
            $book->setPageText(3, C::GREEN . c::UNDERLINE . "Helpful Commands" . C::BLACK . "\n- /k \n - /warpme \n - /pv \n - /shop \n - /cpshop \n - /mpshop \n - /menu");
            $book->setAuthor("CastleRaid Network");
            $sender->getInventory()->addItem($book);
            $sender->sendMessage(C::GREEN . "You received an Information Book!");
            return true;
        } else {
            return false;
        }
    }
}