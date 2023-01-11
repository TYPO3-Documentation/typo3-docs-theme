<?php

declare(strict_types=1);

namespace T3Docs\Theme\Directives;

use Doctrine\RST\Directives\SubDirective;
use Doctrine\RST\Nodes\Node;
use Doctrine\RST\Parser;
use RuntimeException;

use function count;
use function explode;
use function htmlspecialchars;

class TableDirective extends SubDirective
{
    private string $name;
    private string $templateName;

    public function __construct()
    {
        $this->name         = 'table';
        $this->templateName = 'directive/table.html.twig';
    }

    /** @param string[] $options */
    public function processSub(
        Parser $parser,
        ?Node $document,
        string $variable,
        string $data,
        array $options
    ): ?Node {
        $class      = $options['class'] ?? '';
        $wrapperDiv = $parser->renderTemplate(
            $this->templateName,
            [
                'header' => htmlspecialchars($data),
                'class' => $class,

            ]
        );

        $wrapper = explode('|||', $wrapperDiv, 2);

        if (count($wrapper) < 2) {
            throw new RuntimeException('Template ' . $this->templateName . '  did not contain a mark for the wrapping position split (|||)');
        }

        return $parser->getNodeFactory()->createWrapperNode($document, $wrapper[0], $wrapper[1]);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
