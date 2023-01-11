<?php

declare(strict_types=1);

namespace T3Docs\Theme\Nodes;

use Doctrine\RST\Environment;
use Doctrine\RST\Nodes\Node;
use Doctrine\RST\Parser;
use RuntimeException;

use function count;
use function explode;
use function htmlspecialchars;

class TabsGroupNode extends Node
{
    private Parser $parser;
    private ?Node $node;
    private string $title;
    private string $id;

    public function __construct(Parser $parser, ?Node $node, string $title, ?string $id = null)
    {
        parent::__construct();

        $this->parser = $parser;
        $this->node   = $node;
        $this->title  = $title;
        $this->id     = $id ?? $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getId(): string
    {
        return $this->id;
    }

    protected function doRender(): string
    {
        $contents     = $this->node !== null ? $this->node->render() : '';
        $templateName = 'tabs/tab-group.html.twig';
        $renderedCode = $this->parser->renderTemplate($templateName, [
            'title' => htmlspecialchars($this->title),
            'id' => Environment::slugify($this->id),
        ]);
        $wrapper      = explode('|||', $renderedCode, 2);

        if (count($wrapper) < 2) {
            throw new RuntimeException('Template ' . $templateName . '  did not contain a mark for the wrapping position split (|||)');
        }

        return $wrapper[0] . $contents . $wrapper[1];
    }
}
