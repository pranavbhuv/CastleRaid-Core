<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\person;

use pocketmine\utils\TextFormat;

class Mail{

    public const prefix = TextFormat::GOLD . "Mail >> " . TextFormat::WHITE;

    /** @var Person $sender */
    private $sender;
    /** @var string $date */
    private $date;
    /** @var string $msg */
    private $msg;
    /** @var int $id */
    private $id;

    public function __construct(Person $sender, string $date, string $message, int $id){
        $this->sender = $sender;
        $this->date = $date;
        $this->msg = $message;
        $this->id = $id;
    }

    public function getSender() : Person{
        return $this->sender;
    }

    public function getDate() : string{
        return $this->date;
    }

    public function getMsg() : string{
        return $this->msg;
    }

    public function getId() : int{
        return $this->id;
    }


}