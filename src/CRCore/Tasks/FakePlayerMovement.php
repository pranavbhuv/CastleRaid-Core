<?php

namespace CRCore\Tasks;


use CRCore\API;
use CRCore\Loader;


use pocketmine\block\Solid;
use pocketmine\entity\Entity;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\level\Location;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\MoveEntityPacket;
use pocketmine\Player;
use pocketmine\scheduler\PluginTask;

class FakePlayerMovement extends PluginTask {

    private $player;

    /** @var Vector3 */
    private $Lastvector3;

    private $chunk;

    public function __construct(Loader $owner, Player $player) {
        parent::__construct($owner);
        $this->player = $player;
    }

    public function onRun(int $currentTick) {
        $this->Lastvector3 = $this->player->asVector3();
        $this->walk();
    }

    public function walk(){
        $to = new Location($this->player->getLocation()->x + mt_rand(-1, 1), $this->player->getLocation()->y + mt_rand(-1, 1), $this->player->getLocation()->z + mt_rand(-1, 1));
        $from = new Location($this->Lastvector3->x, $this->Lastvector3->y, $this->Lastvector3->z, $to->yaw, $to->pitch);

        if($this->player->getLevel()->getBlock($this->Lastvector3) instanceof Solid == false) {
            $ev = new PlayerMoveEvent($this->player, $from, $to);
            $this->player->getServer()->getPluginManager()->callEvent($ev);
            $this->player->teleport($ev->getTo());
            $this->broadcastMovement();
        } else {
            $this->player->kill();
            $this->player->close();
            API::$main->getServer()->getLogger()->notice($this->player->getName() . ' has caused an error so its been closed and killed!');
        }
    }

    protected function broadcastMovement(){
        $level = $this->player->getLevel();
        $this->chunk = $level->getChunk(((int) $this->player->x) >> 4, ((int) $this->player->z) >> 4, true);
        if($this->chunk !== null){
            $pk = new MoveEntityPacket();
            $pk->entityRuntimeId = Entity::$entityCount++;
            $pk->position = $this->player->getOffsetPosition($this->Lastvector3);
            $pk->yaw = $this->player->getLocation()->yaw;
            $pk->pitch = $this->player->getLocation()->pitch;
            $pk->headYaw = $this->player->getLocation()->yaw; //TODO
            $level->addChunkPacket($this->chunk->getX(), $this->chunk->getZ(), $pk);
        }
    }
}
