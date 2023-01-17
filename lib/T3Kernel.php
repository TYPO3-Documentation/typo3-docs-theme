<?php

declare(strict_types=1);

namespace T3Docs\Theme;

use Doctrine\RST\Configuration;
use Doctrine\RST\Directives\Directive;
use Doctrine\RST\Event\PreDocumentRenderEvent;
use Doctrine\RST\Kernel;
use Doctrine\RST\References\Reference;
use Doctrine\RST\TextRoles\TextRole;
use T3Docs\Theme\Directives\DataDirective;
use T3Docs\Theme\Directives\IgnoredDirective;
use T3Docs\Theme\Directives\PhpDomain\PhpClass;
use T3Docs\Theme\Directives\PhpDomain\PhpConst;
use T3Docs\Theme\Directives\PhpDomain\PhpMethod;
use T3Docs\Theme\Directives\PhpDomain\PhpNamespace;
use T3Docs\Theme\Directives\TableDirective;
use T3Docs\Theme\Directives\Tabs\GroupTabDirective;
use T3Docs\Theme\Directives\Tabs\TabsDirective;
use T3Docs\Theme\Directives\WrapperDirective;
use T3Docs\Theme\Listener\DocumentRenderListener;

use function array_merge;

class T3Kernel extends Kernel
{
    /**
     * @param Directive[] $directives
     * @param Reference[] $references
     * @param TextRole[]  $textRoles
     */
    public function __construct(
        ?Configuration $configuration = null,
        array $directives = [],
        array $references = [],
        array $textRoles = []
    ) {
        $configuration = $configuration ?? new Configuration();
        $configuration->getEventManager()->addEventListener(
            [PreDocumentRenderEvent::PRE_DOCUMENT_RENDER],
            new DocumentRenderListener()
        );
        $configuration->setCustomTemplateDirs([__DIR__ . '/Templates']);
        $configuration->setTheme('bootstrap_theme');
        parent::__construct(
            $configuration,
            array_merge($directives, [
                new PhpNamespace(),
                new PhpClass(),
                new PhpMethod(),
                new PhpConst(),
                new WrapperDirective('pull-quote'),
                new WrapperDirective('container'),
                new WrapperDirective('versionadded'),
                new WrapperDirective('deprecated'),
                new TableDirective(),
                new WrapperDirective('versionchanged'),
                new TabsDirective(),
                new GroupTabDirective(),
                new DataDirective('rubric'),
                new DataDirective('youtube'),
                new IgnoredDirective('glossary'),
                new IgnoredDirective('t3-field-list-table'),
                new IgnoredDirective('graphviz'),
                new IgnoredDirective('confval'),
                new IgnoredDirective('uml'),
                new IgnoredDirective('rst-class'),
                new IgnoredDirective('todo'),
                new IgnoredDirective('index'),
                new IgnoredDirective('role'),
                new IgnoredDirective('highlight'),
                new IgnoredDirective('default-role'),
            ]),
            array_merge($references, []),
            array_merge($textRoles, [])
        );
    }
}
