<?php

namespace FondOfSpryker\Zed\DataFixerContentful\Business\Fixer;

use FondOfSpryker\Zed\ContentfulPageSearch\Business\ContentfulPageSearchFacadeInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\ContentfulStorageFacadeInterface;
use FondOfSpryker\Zed\DataFixer\Business\Dependency\DataFixerInterface;
use FondOfSpryker\Zed\DataFixerContentful\DataFixerContentfulConfig;
use FondOfSpryker\Zed\DataFixerContentful\Persistence\DataFixerContentfulRepositoryInterface;
use Generated\Shared\Transfer\DataFixerContentfulCriteriaFilterTransfer;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Store\Business\StoreFacadeInterface;

class ContentfulDataFixer implements DataFixerInterface
{
    use LoggerTrait;

    public const NAME = 'Contentful';

    /**
     * @var int
     */
    protected $unpublishCollectionCount = 1;

    /**
     * @var \FondOfSpryker\Zed\DataFixerContentful\Persistence\DataFixerContentfulRepositoryInterface
     */
    protected $repository;

    /**
     * @var \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @var \FondOfSpryker\Zed\ContentfulPageSearch\Business\ContentfulPageSearchFacadeInterface
     */
    protected $contentfulPageSearchFacade;

    /**
     * @var \FondOfSpryker\Zed\ContentfulStorage\Business\ContentfulStorageFacadeInterface
     */
    protected $contentfulStorageFacade;

    /**
     * @var \FondOfSpryker\Zed\DataFixerContentful\DataFixerContentfulConfig
     */
    protected $config;

    /**
     * @param \FondOfSpryker\Zed\DataFixerContentful\Persistence\DataFixerContentfulRepositoryInterface $repository
     * @param \FondOfSpryker\Zed\DataFixerContentful\DataFixerContentfulConfig $config
     * @param \Spryker\Zed\Store\Business\StoreFacadeInterface $storeFacade
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\ContentfulStorageFacadeInterface $contentfulStorageFacade
     * @param \FondOfSpryker\Zed\ContentfulPageSearch\Business\ContentfulPageSearchFacadeInterface $contentfulPageSearchFacade
     */
    public function __construct(
        DataFixerContentfulRepositoryInterface $repository,
        DataFixerContentfulConfig $config,
        StoreFacadeInterface $storeFacade,
        ContentfulStorageFacadeInterface $contentfulStorageFacade,
        ContentfulPageSearchFacadeInterface $contentfulPageSearchFacade
    ) {
        $this->repository = $repository;
        $this->config = $config;
        $this->storeFacade = $storeFacade;
        $this->contentfulPageSearchFacade = $contentfulPageSearchFacade;
        $this->contentfulStorageFacade = $contentfulStorageFacade;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }

    /**
     * @param array $stores
     *
     * @return bool
     */
    public function fix(array $stores): bool
    {
        foreach ($stores as $storeName => $storeId) {
            $criteriaFilter = $this->prepareCriteriaFilter($storeName, $storeId);

            $this->fixContentfulData($criteriaFilter);
        }

        return true;
    }

    /**
     * @param string $storeName
     * @param $storeId
     *
     * @return \Generated\Shared\Transfer\DataFixerContentfulCriteriaFilterTransfer
     */
    public function prepareCriteriaFilter(string $storeName, $storeId): DataFixerContentfulCriteriaFilterTransfer
    {
        $stores = $this->storeFacade->getAllStores();

        $criteriaFilter = new DataFixerContentfulCriteriaFilterTransfer();
        $criteriaFilter->setStoreName($storeName);
        $criteriaFilter->setStoreId($storeId);

        foreach ($stores as $store) {
            if ($store->getName() !== $storeName) {
                $criteriaFilter->addWrongStoreNames($store->getName());
            }
        }

        return $criteriaFilter;
    }

    /**
     * @param \Generated\Shared\Transfer\DataFixerContentfulCriteriaFilterTransfer $criteriaFilter
     *
     * @return void
     */
    protected function fixContentfulData(DataFixerContentfulCriteriaFilterTransfer $criteriaFilter): void
    {
        $unpublishIds = [];
        foreach ($this->repository->getWrongStoreContentfulEntries($criteriaFilter) as $contentful) {
            $unpublishIds[] = $contentful->getIdContentful();
            $contentful->delete();
            $this->getLogger()->info(sprintf(
                '%s deleting Contentful %s in store %s',
                $this->getName(),
                $contentful->getIdContentful(),
                $criteriaFilter->getStoreName()
            ), $contentful->toArray());

            if (count($unpublishIds) === $this->unpublishCollectionCount) {
                $unpublishIds = $this->startUnpublishing($criteriaFilter, $unpublishIds);
            }
        }
        if (count($unpublishIds) > 0) {
            $this->startUnpublishing($criteriaFilter, $unpublishIds);
        }
    }

    /**
     * @param \Generated\Shared\Transfer\DataFixerContentfulCriteriaFilterTransfer $criteriaFilter
     * @param array $unpublishIds
     *
     * @return array
     */
    protected function startUnpublishing(
        DataFixerContentfulCriteriaFilterTransfer $criteriaFilter,
        array $unpublishIds
    ): array {
        $this->contentfulPageSearchFacade->unpublish($unpublishIds);
        $this->getLogger()->info(sprintf(
            '%s unpublished ContentfulPageSearch id(s) %s in store %s',
            $this->getName(),
            implode(',', $unpublishIds),
            $criteriaFilter->getStoreName()
        ), $unpublishIds);
        $this->contentfulStorageFacade->unpublish($unpublishIds);
        $this->getLogger()->info(sprintf(
            '%s unpublished ContentfulStorage id(s) %s in store %s',
            $this->getName(),
            implode(',', $unpublishIds),
            $criteriaFilter->getStoreName()
        ), $unpublishIds);

        return [];
    }
}
