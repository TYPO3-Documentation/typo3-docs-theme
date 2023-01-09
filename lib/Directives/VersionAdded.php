<?php

declare(strict_types=1);

namespace T3Docs\Theme\Directives;

use Doctrine\RST\Directives\SubDirective;
use Doctrine\RST\Nodes\Node;
use Doctrine\RST\Parser;
use RuntimeException;

use function count;
use function explode;

class VersionAdded extends SubDirective
{
    private string $template = 'directives/versionadded.html.twig';

    public function getName(): string
    {
        return 'versionadded';
    }

    /** @param string[] $options */
    public function processSub(
        Parser $parser,
        ?Node $document,
        string $variable,
        string $data,
        array $options
    ): ?Node {
        $wrapperDiv = $parser->renderTemplate(
            $this->template,
            ['text' => $data]
        );

        $wrapper = explode('|||', $wrapperDiv, 2);

        if (count($wrapper) < 2) {
            throw new RuntimeException('Template did not contain a mark for the wrapping position split (|||)');
        }

        return $parser->getNodeFactory()->createWrapperNode($document, $wrapper[0], $wrapper[1]);
    }
}
