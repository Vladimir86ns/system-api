<?php

namespace App\Services\Api\Company;

use App\Order;
use App\Company;
use Carbon\Carbon;
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

    /**
     * Get all orders with status done and time delivery null
     *
     * @param int $companyId Company ID
     * @return Order
     */
    public function getAllOrdersStatusDone(int $companyId)
    {
        return Order::where('company_id', $companyId)
            ->where('order_done', 1)
            ->whereNull('time_delivered')
            ->get();
    }

    /**
     * Get all company orders which are in progress
     *
     * @param int $companyId Company ID
     * @return Order
     */
    public function getAllCompanyOrdersInProgress(int $companyId)
    {
        return Order::where('company_id', $companyId)
            ->where('order_done', 0)
            ->get();
    }

    /**
     * Update order to done.
     *
     * @param Order $order
     * @return Order
     */
    public function updateOrderToDone(Order $order)
    {
        $order->update(['order_done' => 1]);

        return $order;
    }

    /**
     * Get order by orderID and companyId
     *
     * @param int $companyId Company ID
     * @param int $orderId Company ID
     * @return Company
     */
    public function getOrderByIdAndCompanyId(int $orderId, int $companyId)
    {
        return Order::where([
            ['id', $orderId],
            ['company_id', $companyId]
        ])->first();
    }

    /**
     * Close the order, and update company monthly profit & monthly income
     *
     * @param Order $order
     * @param Company $company
     * @return Order
     */
    public function closeOrder(Order $order, Company $company)
    {
        $orderAttributes = [
            'time_delivered' => Carbon::now()->format('Y-m-d H:i:s'),
        ];

        $companyAttributes = [
            'monthly_income' => $company->monthly_income + $order->order_price,
            'monthly_profit' => $company->monthly_profit + $order->order_profit
        ];

        $order->update($orderAttributes);
        $company->update($companyAttributes);

        return $order;
    }
}
