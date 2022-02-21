<?php


namespace Agorate\PimcoreDeeplTranslateDocuments\DeeplTranslateBundle\EventListener;


use Pimcore\Event\BundleManager\PathsEvent;

class AdminListener
{
    public function addJSFiles(PathsEvent $event): void
    {
        $event->setPaths(
            array_merge(
                $event->getPaths(),
                [
                    '/bundles/agoratedeepltranslation/deepl-translation/js/startup.js'
                ]
            )
        );
    }
}