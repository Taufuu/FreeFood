<?php

declare(strict_types=1);

namespace Tofuu\FoodGen;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\TextFormat;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class main extends PluginBase implements Listener{
        public function onEnable(){
            $this->getServer()->getPluginManager()->registerEvents($this,$this);
            $this->getLogger()->info("Plugin Enabled");
            $this->saveDefaultConfig();
            $this->reloadConfig();
            $keyFromConfig = $this->getConfig()->get("key");
            $this->reloadConfig();
            $this->getConfig()->set("key", "example");
            $this->getConfig()->save();

        }
        public function onJoin(PlayerJoinEvent $event){
            $player = $event->getPlayer();
            $name = $player->getName();
            $this->getServer()->broadcastMessage(TextFormat::GREEN."$name Joined The HyperPE Server! Awesome!");
        }
        public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
            if($cmd->getName() == "/food"){
                if(!$sender instanceof Player){
                    $sender->sendMessage("This Command Only Works for players! Please perform this command IN GAME!");
                }else{
                    if(!isset($args[0]) or (is_int($args[0]) and $args[0] > 0)) {
                        $args[0] = 4; // Defining $args[0] with value 4
                    }
                    $sender->getInventory()->addItem(Item::get(364,0,$args[0]));
                    $sender->sendMessage("You have just recieved" .count($args[0]). " steak!");
                    $task = new tasks\MyTask($this, $sender->getName());
                    $this->getServer()->getScheduler()->scheduleRepeatingTask($task, 10*20); // Counted in ticks (1 second = 20 ticks)
                }
            }
            return true;
        }
    }
