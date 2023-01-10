<?php

declare(strict_types=1);

namespace T3Docs\Theme\Directives;

use Doctrine\RST\Directives\Directive;
use Doctrine\RST\Nodes\Node;
use Doctrine\RST\Parser;

use function htmlspecialchars;

class DataDirective extends Directive
{
    private string $name;
    private string $templateName;

    public function __construct(string $name, ?string $templateName = null)
    {
        $this->name         = $name;
        $this->templateName = $templateName ?? 'directive/' . $this->name . '.html.twig';
    }

    public function processNode(Parser $parser, string $variable, string $data, array $options): ?Node
    {
        $renderedCode = $parser->renderTemplate(
            $this->templateName,
            ['data' => htmlspecialchars($data)]
        );

        return $parser->getNodeFactory()->createRawNode($renderedCode);
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
