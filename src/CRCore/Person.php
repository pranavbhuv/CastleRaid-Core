<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Jason.
 */

namespace CRCore;

use pocketmine\Player;
use pocketmine\utils\Config;

class Person extends Player{

    //TODO: Learn SQL.

    /** @var Config $cfg */
    private $cfg;

    public function genCfg() : void{
        if(file_exists(API::$main->getDataFolder() . "/players/" . $this->getName() . ".json")){
            $this->cfg = new Config(API::$main->getDataFolder() . "/players/" . $this->getName() . ".json", Config::JSON);
        }else{
            $this->cfg = new Config(API::$main->getDataFolder() . "/players/" . $this->getName() . ".json", Config::JSON, ["mails" => []]);
        }
    }

    public function getMoney() : float{
        return EconomyAPI::getInstance()->myMoney($this->getName());
    }

    public function getMails() : array{
        return $this->cfg->get("mails");
    }
}