<?php

namespace Agorate\DeeplTranslateBundle;

use PackageVersions\Versions;
use Pimcore\Extension\Bundle\AbstractPimcoreBundle;
use Pimcore\Extension\Bundle\PimcoreBundleInterface;
use Pimcore\Extension\Bundle\Traits\PackageVersionTrait;

class DeeplTranslateBundle extends AbstractPimcoreBundle implements PimcoreBundleInterface
{
    use PackageVersionTrait;
    const PACKAGE_NAME = 'agorate/pimcore-deepl-translate-documents';

    /**
     * Returns all used JavaScript files
     *
     * @return string[]
     */
    public function getJsPaths(): array
    {
        return [
            '/bundles/deepltranslate/js/deepl-translation/startup.js'
        ];

    }

    /**
     * Bundle name as shown in extension manager
     *
     * @return string
     */
    public function getNiceName(): string
    {
        return 'Agorate - Deepl Translate Document Pimcore Bundle';
    }

    /**
     * Bundle description as shown in extension manager
     *
     * @return string
     */
    public function getDescription(): string
    {
        return "";
    }

    /** normalizes version to pretty version
     * e. g. v2.3.0@9e016f4898c464f5c895c17993416c551f1697d3 to 2.3.0
     *
     * @return array|string|null
     */
    public static function getSolutionVersion(): array|string|null
    {
        $version = Versions::getVersion(self::PACKAGE_NAME);

        $version = preg_replace('/^v/', '', $version);
        return preg_replace('/@(.+)$/', '', $version);
    }

    /**
     * Returns the composer package name used to resolve the version
     *
     * @return string
     */
    protected function getComposerPackageName(): string
    {
        return self::PACKAGE_NAME;
    }
}