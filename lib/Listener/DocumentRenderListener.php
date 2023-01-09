<?php

declare(strict_types=1);

namespace T3Docs\Theme\Listener;

use Doctrine\RST\Event\PreDocumentRenderEvent;

class DocumentRenderListener
{
    public function preDocumentRender(PreDocumentRenderEvent $event): void
    {
        $parameters         = $event->getParameters();
        $entries            = $event->getDocumentNode()->getEnvironment()->getMetas()->getAll();
        $parameters['tree'] = [];
        foreach ($entries as $entry) {
            $parameters['tree'][] = [
                'title' => $entry->getTitle(),
                'url' => $entry->getUrl(),
            ];
        }

        $event->setParameters($parameters);
    }
}
