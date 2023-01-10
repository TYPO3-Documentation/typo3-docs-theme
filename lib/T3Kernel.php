<?php

declare(strict_types=1);

namespace T3Docs\Theme;

use Doctrine\RST\Configuration;
use Doctrine\RST\Directives\Directive;
use Doctrine\RST\Event\PreDocumentRenderEvent;
use Doctrine\RST\Kernel;
use Doctrine\RST\References\Reference;
use Doctrine\RST\TextRoles\TextRole;
use T3Docs\Theme\Directives\ContainerDirective;
use T3Docs\Theme\Directives\IgnoredDirective;
use T3Docs\Theme\Directives\PullQuoteDirective;
use T3Docs\Theme\Directives\VersionAdded;
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
                new VersionAdded(),
                new PullQuoteDirective(),
                new ContainerDirective(),
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
