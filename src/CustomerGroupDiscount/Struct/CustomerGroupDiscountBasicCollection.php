<?php declare(strict_types=1);
/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

namespace Shopware\CustomerGroupDiscount\Struct;

use Shopware\Framework\Struct\Collection;

class CustomerGroupDiscountBasicCollection extends Collection
{
    /**
     * @var CustomerGroupDiscountBasicStruct[]
     */
    protected $elements = [];

    public function add(CustomerGroupDiscountBasicStruct $customerGroupDiscount): void
    {
        $key = $this->getKey($customerGroupDiscount);
        $this->elements[$key] = $customerGroupDiscount;
    }

    public function remove(string $uuid): void
    {
        parent::doRemoveByKey($uuid);
    }

    public function removeElement(CustomerGroupDiscountBasicStruct $customerGroupDiscount): void
    {
        parent::doRemoveByKey($this->getKey($customerGroupDiscount));
    }

    public function exists(CustomerGroupDiscountBasicStruct $customerGroupDiscount): bool
    {
        return parent::has($this->getKey($customerGroupDiscount));
    }

    public function getList(array $uuids): CustomerGroupDiscountBasicCollection
    {
        return new self(array_intersect_key($this->elements, array_flip($uuids)));
    }

    public function get(string $uuid): ? CustomerGroupDiscountBasicStruct
    {
        if ($this->has($uuid)) {
            return $this->elements[$uuid];
        }

        return null;
    }

    public function getUuids(): array
    {
        return $this->fmap(
            function (CustomerGroupDiscountBasicStruct $customerGroupDiscount) {
                return $customerGroupDiscount->getUuid();
            }
        );
    }

    public function getCustomerGroupUuids(): array
    {
        return $this->fmap(
            function (CustomerGroupDiscountBasicStruct $customerGroupDiscount) {
                return $customerGroupDiscount->getCustomerGroupUuid();
            }
        );
    }

    public function filterByCustomerGroupUuid(string $uuid): CustomerGroupDiscountBasicCollection
    {
        return $this->filter(
            function (CustomerGroupDiscountBasicStruct $customerGroupDiscount) use ($uuid) {
                return $customerGroupDiscount->getCustomerGroupUuid() === $uuid;
            }
        );
    }

    protected function getKey(CustomerGroupDiscountBasicStruct $element): string
    {
        return $element->getUuid();
    }
}