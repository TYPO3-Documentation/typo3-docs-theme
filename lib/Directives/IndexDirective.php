<?php

declare(strict_types=1);

namespace T3Docs\Theme\Directives;

use Doctrine\RST\Directives\SubDirective;
use Doctrine\RST\Nodes\Node;
use Doctrine\RST\Parser;

use function count;
use function explode;

class IndexDirective extends SubDirective
{

    public function getName(): string
    {
        return 'index';
    }

    /** @param string[] $options */
    public function processSub(
        Parser $parser,
        ?Node $document,
        string $variable,
        string $data,
        array $options
    ): ?Node {
        // Indexes do not get rendered within their document
        return null;
    }
}
