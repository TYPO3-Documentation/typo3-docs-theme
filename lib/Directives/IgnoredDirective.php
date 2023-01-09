<?php

declare(strict_types=1);

namespace T3Docs\Theme\Directives;

use Doctrine\RST\Directives\Directive;

class IgnoredDirective extends Directive
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
