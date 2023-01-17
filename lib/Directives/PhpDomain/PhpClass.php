<?php

declare(strict_types=1);

namespace T3Docs\Theme\Directives\PhpDomain;

use Doctrine\RST\Directives\Directive;
use Doctrine\RST\Environment;
use Doctrine\RST\Nodes\BlockNode;
use Doctrine\RST\Nodes\DocumentNode;
use Doctrine\RST\Nodes\Node;
use Doctrine\RST\Parser;
use Rector\Core\ValueObject\Configuration;

class PhpClass extends Directive
{
    public function getName(): string
    {
        return 'php:class';
    }

    public function process(Parser $parser, ?Node $node, string $variable, string $data, array $options): void
    {
        $templateName = 'phpdomain/php-class.html.twig';
        $document     = $parser->getDocument();
        $members    = $node;
        if ($node instanceof BlockNode) {
            $members = $parser->getSubParser()->parseLocal($node->getValue());
        }

        $pathParts = explode('\\', trim($data));
        $className = array_pop($pathParts);

        $renderedCode = $parser->renderTemplate(
            $templateName,
            [
                'id' => Environment::slugify($data),
                'className' => $className,
                'namespace' => implode('\\', $pathParts),
                'members' => $members instanceof DocumentNode ? $members->getNodes() : [],
            ]
        );
        $wrapper      = explode('|||', $renderedCode, 2);

        if (count($wrapper) < 2) {
            throw new \RuntimeException('Template ' . $templateName . '  did not contain a mark for the wrapping position split (|||)');
        }

        $document->addNode($parser->getNodeFactory()->createWrapperNode($members, $wrapper[0], $wrapper[1]));
    }

}