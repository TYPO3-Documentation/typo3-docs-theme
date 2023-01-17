<?php

declare(strict_types=1);

namespace T3Docs\Theme\Directives\PhpDomain;

use Doctrine\RST\Directives\Directive;
use Doctrine\RST\Nodes\BlockNode;
use Doctrine\RST\Nodes\Node;
use Doctrine\RST\Parser;
use T3Docs\Theme\Nodes\PhpDomain\PhpMemberNode;
use T3Docs\Theme\Nodes\TabsGroupNode;

abstract class PhpMember extends Directive
{
}