<?php
namespace Federation\UI\Concerns;

trait ManagePageBody
{
    public function getBodyEnd(): string
    {
        return $this->get('page.body.end', '');
    }
    public function getBodyStart(): string
    {
        return $this->get('page.body.end', '');
    }

    public function body(string $end = "", string $start = ""): static
    {
        if (!empty($end)) {
            $this->set('page.body.end', $end);
        }
        if (!empty($start)) {
            $this->set('page.body.start', $start);
        }
        return $this;
    }
}