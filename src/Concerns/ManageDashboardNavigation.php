<?php
namespace Federation\UI\Concerns;

use Federation\UI\ListItem;
use Federation\UI\Menu;


trait ManageDashboardNavigation
{
    protected ?Menu $dashboardNavigation = null;

    /** @var ListItem[] **/
    protected array $dashboardSideNavigationItems = [];
    protected mixed $breadcrumbData = null;

    /** @param ListItem[] $side **/
    public function navigation(?Menu $main = null, ?array $side = null): static
    {
        if (!is_null($main)) {
            $this->dashboardNavigation = $main;
        }
        if (!is_null($side)) {
            $this->dashboardSideNavigationItems = $side;
        }
        return $this;
    }

    public function breadcrumb(string $name = "", mixed $data = null): static
    {
        if (!empty($name)) {
            $this->set("page.breadcrumb.name", $name);
        }

        if (!is_null($data)) {
            $this->breadcrumbData = $data;
        }

        return $this;
    }

    public function getNavigation(): Menu
    {
        return $this->dashboardNavigation ?? new Menu("main");
    }

    public function hasSideNavigation(): bool
    {
        return !empty($this->getSideNavigationItems());
    }

    public function hasBreadcrumb(): bool
    {
        return !empty($this->getBreadcrumb());
    }

    public function getBreadcrumb(): string
    {
        return $this->get("page.breadcrumb.name", "");
    }
    public function getBreadcrumbData(): mixed
    {
        return $this->breadcrumbData;
    }

    /** @return ListItem[] **/
    public function getSideNavigationItems(): array
    {
        return $this->dashboardSideNavigationItems;
    }

}