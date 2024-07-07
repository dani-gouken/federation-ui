<?php
namespace Federation\UI\Concerns;

use Federation\UI\FederationContext;
use Illuminate\Http\Request;

trait ManagePageTitle
{
    protected $pageTitleBuilder = null;

    public function setPageTitle(string $title): static
    {
        $this->set('page.head.title', $title);
        return $this;
    }

    public function getPageTitle(): int|string|bool
    {
        return $this->get('page.head.title', '');
    }

    public function defaultPageTitleBuilder(FederationContext $context, Request $request)
    {
        $pageTitle = $context->getPageTitle();
        return $context->get('app.name') . (!empty($pageTitle) ? "- {$pageTitle}" : '');
    }

    public function buildPageTitle(Request $request): string
    {
        $builder = $this->pageTitleBuilder ?? [$this, 'defaultPageTitleBuilder'];
        return ($builder)($this, $request);
    }

    public function buildPageTitleUsing(callable $callable): static
    {
        $this->pageTitleBuilder = $callable;
        return $this;
    }

}