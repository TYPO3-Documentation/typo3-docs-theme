<?php

declare(strict_types=1);

namespace T3Docs\Theme\Directives\PhpDomain;

use Doctrine\RST\Directives\Directive;

class PhpConst extends PhpMember
{

    public function getName(): string
    {
        return 'php:const';
    }

}