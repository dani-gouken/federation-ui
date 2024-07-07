<?php
namespace Federation\UI;

readonly class MenuItem
{
    public function __construct(
        public string $name,
        public string $url = "#",
        public string $icon = "",
        public string $active = "",
        /** @var array<MenuItem> **/
        public array $children = [],
    ) {
    }

    public function hasChildren(): bool
    {
        return empty($this->children);
    }

    public function addChild(MenuItem $item): static
    {
        $this->children[] = $item;
        return $this;
    }

    public function hasSideMenu(): bool
    {
        return !empty($this->children ?? []);
    }

}