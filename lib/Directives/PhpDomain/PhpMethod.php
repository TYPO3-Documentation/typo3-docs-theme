<?php

declare(strict_types=1);

namespace T3Docs\Theme\Directives\PhpDomain;

use Doctrine\RST\Environment;
use Doctrine\RST\Nodes\BlockNode;
use Doctrine\RST\Nodes\DocumentNode;
use Doctrine\RST\Nodes\Node;
use Doctrine\RST\Nodes\ParagraphNode;
use Doctrine\RST\Nodes\SpanNode;
use Doctrine\RST\Parser;
use Doctrine\RST\Parser\LineChecker;
use T3Docs\Theme\Nodes\PhpDomain\PhpMemberNode;

class PhpMethod extends PhpMember
{

    public function getName(): string
    {
        return 'php:method';
    }

    public function process(Parser $parser, ?Node $node, string $variable, string $data, array $options): void
    {
        $document = $parser->getDocument();

        $memberNode = new PhpMemberNode(PhpMemberNode::TYPE_METHOD, $data, Environment::slugify($data));
        $memberNode->setEnvironment($parser->getEnvironment());

        if ($node instanceof BlockNode) {
            $node = $parser->getSubParser()->parseLocal($node->getValue());
            if ($node instanceof DocumentNode) {
                $subnodes = $node->getNodes();
                foreach ($subnodes as $subnode) {
                    if ($subnode instanceof ParagraphNode) {
                        $memberNode->addDescriptionNode($subnode);
                    }
                }
            }
        }
        $document->addNode($memberNode);
    }


}