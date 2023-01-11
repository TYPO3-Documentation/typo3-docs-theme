<?php

declare(strict_types=1);

namespace T3Docs\Theme\Directives\Tabs;

use Doctrine\RST\Directives\Directive;
use Doctrine\RST\Nodes\BlockNode;
use Doctrine\RST\Nodes\Node;
use Doctrine\RST\Parser;
use T3Docs\Theme\Nodes\TabsGroupNode;

class GroupTabDirective extends Directive
{
    public function getName(): string
    {
        return 'group-tab';
    }

    public function process(Parser $parser, ?Node $node, string $variable, string $data, array $options): void
    {
        $document = $parser->getDocument();
        if ($node instanceof BlockNode) {
            $node = $parser->getSubParser()->parseLocal($node->getValue());
        }

        $tabsGroupNode = new TabsGroupNode($parser, $node, $data);
        $document->addNode($tabsGroupNode);
    }
}
