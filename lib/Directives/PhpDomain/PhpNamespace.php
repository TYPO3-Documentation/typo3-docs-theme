<?php

declare(strict_types=1);

namespace T3Docs\Theme\Directives\PhpDomain;

use Doctrine\RST\Directives\Directive;

class PhpNamespace extends Directive
{
    public function getName(): string
    {
        return 'php:namespace';
    }
}