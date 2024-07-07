<?php
namespace Federation\UI;

readonly class ListItem
{
    public function __construct(
        public string $name,
        public string $subtitle = "",
        public string $url = "#",
        public string $id = "",
        public string $icon = "",
    ) {
    }

    public static function divider(): static
    {
        return new ListItem("divider");
    }

    public function isDivider(): bool
    {
        return $this->name === "divider";
    }

    public function hasIcon(): bool
    {
        return !empty($this->icon);
    }
    
    public function hasSubtitle(): bool
    {
        return !empty($this->subtitle);
    }
}