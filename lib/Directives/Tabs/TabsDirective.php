<?php

declare(strict_types=1);

namespace T3Docs\Theme\Directives\Tabs;

use Doctrine\RST\Directives\Directive;
use Doctrine\RST\Nodes\BlockNode;
use Doctrine\RST\Nodes\DocumentNode;
use Doctrine\RST\Nodes\Node;
use Doctrine\RST\Parser;
use RuntimeException;

use function count;
use function explode;

class TabsDirective extends Directive
{
    public function getName(): string
    {
        return 'tabs';
    }

    public function process(Parser $parser, ?Node $node, string $variable, string $data, array $options): void
    {
        $templateName = 'tabs/tabs.html.twig';
        $document     = $parser->getDocument();
        $tabGroups    = $node;
        if ($node instanceof BlockNode) {
            $tabGroups = $parser->getSubParser()->parseLocal($node->getValue());
        }

        $renderedCode = $parser->renderTemplate(
            $templateName,
            [
                'groups' => $tabGroups instanceof DocumentNode ? $tabGroups->getNodes() : [],
            ]
        );
        $wrapper      = explode('|||', $renderedCode, 2);

        if (count($wrapper) < 2) {
            throw new RuntimeException('Template ' . $templateName . '  did not contain a mark for the wrapping position split (|||)');
        }

        $document->addNode($parser->getNodeFactory()->createWrapperNode($tabGroups, $wrapper[0], $wrapper[1]));
    }
}
