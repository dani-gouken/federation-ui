<?php
namespace Federation\UI\Concerns;


trait ManagePageHead
{
    use ManagePageTitle;

    public function getHeadStart(): string
    {
        return $this->get('page.head.start', '');
    }

    public function getHeadEnd(): string
    {
        return $this->get('page.head.end', '');
    }

    public function getHeadTemplate(): string
    {
        return $this->get('page.head.template', '');
    }

    public function head(
        string $template = "",
        string $end = "",
        string $start = "",
        string $title = "",
    ): static {
        if (!empty($end)) {
            $this->set('page.head.end', $end);
        }
        if (!empty($start)) {
            $this->set('page.head.start', $start);
        }
        if (!empty($template)) {
            $this->set('page.head.template', $template);
        }
        if (!empty($title)) {
            $this->setPageTitle($title);
        }
        return $this;
    }

}