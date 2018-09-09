<?php

namespace App\Services\Api\Company;

class OrderValidationService
{
    /**
     * @var service
     */
    protected $service;

    /**
     * InvestmentService
     *
     * @param OrderService $orderService
     */
    public function __construct(
        OrderService $orderService
    ) {
        $this->service = $orderService;
    }

    /**
     * Validate Company exist
     *
     * @param int $id Company ID
     * @return \Company
     */
    public function validateCompany(int $id)
    {
        $this->validateId($id);

        $company = $this->service->getCompanyById($id);

        if ($company) {
            return $company;
        }

        abort(404, "Company ID: {$id} is invalid!");
    }

    /**
     * Validate Order exist
     *
     * @param int $orderId Order ID
     * @param int $companyId Company ID
     * @return \Order
     */
    public function validateOrderByIdAndCompanyId(int $orderId, int $companyId)
    {
        $this->validateId($orderId);

        $order = $this->service->getOrderByIdAndCompanyId($orderId, $companyId);

        if ($order) {
            return $order;
        }

        abort(404, "Order ID: {$orderId} is invalid!");
    }

    /**
     * Validate Products exists by ids
     *
     * @param int $id Company Id
     * @param array $ids Products Ids
     */
    public function validateProducts(int $companyId, array $ids)
    {
        $allProductsIds = $this->service
            ->getProductsByCompanyIdAndIds($companyId, $ids)
            ->pluck('id')
            ->toArray();

        $notExists = collect($ids)->filter(function ($id) use ($allProductsIds) {
            return !in_array($id, $allProductsIds);
        })
        ->toArray();

        if ($notExists) {
            $ids = implode(',', $notExists);
            abort(404, "Product id(s) {$ids} is invalid!");
        }
    }

    /**
     * Validate id is integer
     *
     * @param int $id
     */
    public function validateId($id)
    {
        if (!is_int($id)) {
            abort(404, "Id must be a number!");
        }
    }
}
