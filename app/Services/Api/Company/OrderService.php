<?php

namespace App\Services\Api\Company;

use App\Company;
use App\CompanyProduct;

class OrderService
{
    /**
     * Save company order
     *
     * @param array $orderIds
     * @param Company $companyId
     */
    public function saveOrder(array $orderIds, Company $company)
    {
        $companyProducts = $this->getProductsByCompanyIdAndIds($company->id, $orderIds);

        $productsById = $companyProducts->keyBy('id')->map(function ($item) {
            return [$item->name, $item->type];
        });

        $orderItemsNameAndType = collect($orderIds)->map(function ($id) use ($productsById) {
            $name = array_get($productsById, $id);
            return $name;
        })
        ->toArray();

        $attributes['order_items'] = json_encode($orderItemsNameAndType);
        $attributes['order_price'] = $companyProducts->sum('price');
        $attributes['order_profit'] = $attributes['order_price'] - $companyProducts->sum('cost');

        return $company->orders()->create($attributes);
    }

    /**
     * Get company by id
     *
     * @param int $id Company ID
     * @return Company
     */
    public function getCompanyById(int $id)
    {
        return Company::find($id);
    }

    /**
     * Get company products by ids
     *
     * @param int $companyId Company ID
     * @param int $ids Product Ids
     * @return CompanyProduct
     */
    public function getProductsByCompanyIdAndIds(int $companyId, array $ids)
    {
        return CompanyProduct::where('company_id', $companyId)
            ->whereIn('id', $ids)
            ->get();
    }
}
