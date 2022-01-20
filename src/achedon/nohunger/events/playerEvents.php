<?php

namespace achedon\nohunger\events;

use achedon\nohunger\hunger;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Server;
use pocketmine\world\World;

class playerEvents implements Listener{

    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        $cfg = hunger::getConfigs("config");
        foreach($cfg->get("World") as $worlds){
            $allWorlds = Server::getInstance()->getWorldManager()->getWorldByName($worlds);
            if ($allWorlds instanceof World){
                $player->getHungerManager()->setEnabled(false);
            }
        }
    }
}