<?php

namespace FondOfSpryker\Zed\DataFixerContentful\Persistence;

use Generated\Shared\Transfer\DataFixerContentfulCriteriaFilterTransfer;
use Orm\Zed\Contentful\Persistence\FosContentfulQuery;
use Orm\Zed\ContentfulPageSearch\Persistence\FosContentfulPageSearchQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\DataFixerContentful\Persistence\DataFixerContentfulPersistenceFactory getFactory()
 */
class DataFixerContentfulRepository extends AbstractRepository implements DataFixerContentfulRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\DataFixerContentfulCriteriaFilterTransfer $criteriaFilterTransfer
     *
     * @return \Orm\Zed\ContentfulPageSearch\Persistence\FosContentfulPageSearch[]
     */
    public function getWrongStoreContentfulPageSearchEntries(
        DataFixerContentfulCriteriaFilterTransfer $criteriaFilterTransfer
    ): array {

        $query = $this->getFactory()->createContentfulPageSearchQuery();
        $this->createFilterContentfulPageSearch($criteriaFilterTransfer, $query);
        return $query->find()->getData();
    }

    /**
     * @param \Generated\Shared\Transfer\DataFixerContentfulCriteriaFilterTransfer $criteriaFilterTransfer
     *
     * @return \Orm\Zed\Contentful\Persistence\FosContentful[]
     */
    public function getWrongStoreContentfulEntries(
        DataFixerContentfulCriteriaFilterTransfer $criteriaFilterTransfer
    ): array {

        $query = $this->getFactory()->createContentfulQuery();
        $this->createFilterContentful($criteriaFilterTransfer, $query);
        return $query->find()->getData();
    }

    /**
     * @param \Generated\Shared\Transfer\DataFixerContentfulCriteriaFilterTransfer $criteriaFilterTransfer
     * @param \Orm\Zed\ContentfulPageSearch\Persistence\FosContentfulPageSearchQuery $query
     *
     * @return void
     */
    protected function createFilterContentfulPageSearch(
        DataFixerContentfulCriteriaFilterTransfer $criteriaFilterTransfer,
        FosContentfulPageSearchQuery $query
    ): void {

        if ($criteriaFilterTransfer->getStoreName() !== null) {
            $query->filterByKey_Like(strtolower($criteriaFilterTransfer->getStoreName() . '%'));
            $query->filterByStore(
                strtoupper($criteriaFilterTransfer->getStoreName()),
                Criteria::NOT_EQUAL
            );
        }
    }

    /**
     * @param \Generated\Shared\Transfer\DataFixerContentfulCriteriaFilterTransfer $criteriaFilterTransfer
     * @param \Orm\Zed\Contentful\Persistence\FosContentfulQuery $query
     *
     * @return void
     */
    protected function createFilterContentful(
        DataFixerContentfulCriteriaFilterTransfer $criteriaFilterTransfer,
        FosContentfulQuery $query
    ): void {

        if ($criteriaFilterTransfer->getStoreName() !== null) {
            $query->filterByFkStore($criteriaFilterTransfer->getStoreId(), Criteria::EQUAL);
            $query->filterByStorageKey(strtolower($criteriaFilterTransfer->getStoreName() . '%'), Criteria::NOT_LIKE);
        }
    }
}
