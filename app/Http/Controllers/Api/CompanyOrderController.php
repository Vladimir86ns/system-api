<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Api\Company\OrderService;
use App\Services\Api\Company\OrderValidationService;

class CompanyOrderController extends BaseController
{
    /**
     * @var OrderService
     */
    protected $orderService;

    /**
     * @var Validator
     */
    protected $validator;

    public function __construct(
        OrderService $orderService,
        OrderValidationService $orderValidationService
    ) {
        $this->service = $orderService;
        $this->validator = $orderValidationService;
    }

    /**
     * Save company order
     *
     * @param int $id Company ID
     * @return CompanyProduct;
     */
    public function order(Request $request, $id)
    {
        $orderIds = $request->get('order_ids');

        $company = $this->validator->validateCompany($id);
        $this->validator->validateProducts($company->id, $orderIds);

        return $this->service->saveOrder($orderIds, $company);
    }

    /**
     * Save company un delivered orders
     *
     * @param int $id Company ID
     * @return Order;
     */
    public function getOrders($id)
    {
        return Order::where('company_id', $id)->where('order_done', 0)->get();
    }
}
