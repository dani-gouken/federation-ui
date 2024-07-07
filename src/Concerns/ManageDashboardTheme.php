<?php
namespace Federation\UI\Concerns;

trait ManageDashboardTheme
{
    public function setTheme(string $theme): static
    {
        return $this->set('page.dashboard.theme', $theme);
    }

    public function getTheme(string $default = ""): string
    {
        return $this->get('page.dashboard.theme', $default);
    }
}