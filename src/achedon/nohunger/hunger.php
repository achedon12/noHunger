<?php

namespace achedon\nohunger;

use achedon\nohunger\events\playerEvents;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use pocketmine\plugin\PluginOwned;
use pocketmine\utils\Config;

class hunger extends PluginBase implements PluginOwned {

    private static $instance;

    protected function onEnable(): void{
        self::$instance = $this;
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");

        $this->getServer()->getPluginManager()->registerEvents(new playerEvents(), $this);
    }

    protected function onDisable(): void{
        $this->saveResource("config.yml");
    }

    public static function getInstance(): self{
        return self::$instance;
    }

    public static function getConfigs($name): Config{
        return new Config(self::$instance->getDataFolder() . "$name.yml", Config::YAML);
    }

    public function getOwningPlugin(): Plugin{
        return $this;
    }
}