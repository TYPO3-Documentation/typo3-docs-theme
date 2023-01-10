<?php

declare(strict_types=1);

namespace T3Docs\Theme\Directives;

use Doctrine\RST\Directives\Directive;
use Doctrine\RST\Nodes\Node;
use Doctrine\RST\Parser;

class RubricDirective extends Directive
{

    public function getName(): string
    {
        return 'rubric';
    }

    public function processNode(Parser $parser, string $variable, string $data, array $options): ?Node
    {
        return $parser->getNodeFactory()->createRawNode('<h6>' . $data . '</h6>');
    }
}