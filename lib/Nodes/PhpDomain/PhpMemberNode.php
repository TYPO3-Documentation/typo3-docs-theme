<?php

declare(strict_types=1);

namespace T3Docs\Theme\Nodes\PhpDomain;

use Doctrine\RST\Environment;
use Doctrine\RST\Nodes\Node;
use Doctrine\RST\Nodes\ParagraphNode;
use Doctrine\RST\Parser;
use RuntimeException;

use function count;
use function explode;
use function htmlspecialchars;

class PhpMemberNode extends Node
{
    public const TYPE_METHOD = 'method';

    private string $type;

    private string $id;

    private string $name;

    /**
     * @var Node[]
     */
    private array $descriptionNodes = [];

    private array $modifiers = [];

    private array $attributes = [];

    /**
     * @param string $type
     * @param string $name
     */
    public function __construct(string $type, string $name, string $id)
    {
        parent::__construct();
        $this->type = $type;
        $this->name = $name;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getModifiers(): array
    {
        return $this->modifiers;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $modifiers
     */
    public function setModifiers(array $modifiers): void
    {
        $this->modifiers = $modifiers;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Node[]
     */
    public function getDescriptionNodes(): array
    {
        return $this->descriptionNodes;
    }

    public function addDescriptionNode(ParagraphNode $node): void
    {
        $this->descriptionNodes[] = $node;
    }


    protected function doRender(): string
    {
        $description = '';
        foreach ($this->getDescriptionNodes() as $node) {
            $description .= $node->render();
        }
        $content = $this->environment->getConfiguration()->getTemplateEngine()
            ->render('phpdomain/php-' . $this->getType() . '.html.twig',[
                'id' => $this->getId(),
                'name' => $this->getName(),
                'argumentText' => '',
                'description' => $description,
                'returnType' => null,
                'parameterArray' => [],
            ]);
        return $content;
    }
}