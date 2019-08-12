<?php

namespace Tofuu\FoodGen\tasks;

use pocketmine\scheduler\PluginTask;
use Inactive-to-Reactive\Inactive-to-ReactiveExample;

             class task extends PluginTask {

                 public function __construct(Inactive-to-ReactiveExample $main, string $playername) {
                    parent::__construct($main);
                    $this->playername = $playername;
                }


                public function onRun(int $tick) {
    $player = $this->getOwner()->getServer()->getPlayer($this->playername());
    if($player instanceof Player) {
        $player->sendMessage("10 seconds has past!");
    }
}
             }.
