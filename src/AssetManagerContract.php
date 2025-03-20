<?php
namespace Federation\UI;

interface AssetManagerContract
{
    public function getUrl(string $file): string;
}