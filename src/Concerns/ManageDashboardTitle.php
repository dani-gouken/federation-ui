<?php
namespace Federation\UI\Concerns;

trait ManageDashboardTitle
{
    public function dashboadTitle(string $title): static
    {
        $this->set('page.dashboard.title', $title);
        return $this;
    }

    public function getDashboardTitle(): string
    {
        return $this->get('page.dashboard.title', '');
    }

    public function hasDashboardTitle(): string
    {
        return !empty($this->getDashboardTitle());
    }

}