<?php
namespace Federation\UI;

readonly class Menu
{
    public function __construct(
        public string $id = "main",
        /** @var array<ListItem> **/
        public array $userDropdownItems = [],
        /** @var array<MenuItem> **/
        public array $items = [],
        public string $logoutUrl = "#",
        public string $theme = "dark",
    ) {
    }


    public function addItem(MenuItem $item): static
    {
        $this->items[] = $item;
        return $this;
    }

    public function addUserDropdownItem(ListItem $item): static
    {
        $this->userDropdownItems[] = $item;
        return $this;
    }
}