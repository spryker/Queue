<?php

namespace SprykerFeature\Yves\FrontendExporter;

use SprykerEngine\Shared\Kernel\LocatorLocatorInterface;
use SprykerFeature\Yves\FrontendExporter\Creator\ResourceCreatorInterface;
use Generated\Yves\Ide\AutoCompletion;

class FrontendExporterSettings
{
    /**
     * @var AutoCompletion
     */
    protected $locator;

    /**
     * @param LocatorLocatorInterface $locator
     */
    public function __construct(LocatorLocatorInterface $locator)
    {
        $this->locator = $locator;
    }

    /**
     * @return ResourceCreatorInterface[]
     */
    public function getResourceCreators()
    {
        return [
            $this->locator->productExporter()->pluginProductResourceCreator()
                ->createProductResourceCreator(),
            $this->locator->categoryExporter()->pluginCategoryResourceCreator()
                ->createCategoryResourceCreator(),
            $this->locator->redirectExporter()->pluginRedirectResourceCreator()
                ->createRedirectResourceCreator(),
            $this->locator->cmsExporter()->pluginPageResourceCreator()
                ->createPageResourceCreator(),
        ];
    }
}