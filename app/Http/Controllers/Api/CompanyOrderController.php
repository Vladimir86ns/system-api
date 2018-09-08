<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Order;
use Carbon\Carbon;
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
     * Get all orders ready for process, with status false
     *
     * @param int $id Company ID
     * @return Order;
     */
    public function getOrders($id)
    {
        return Order::where('company_id', $id)->where('order_done', 0)->get();
    }

    /**
     * Get all orders ready to close, with status done
     *
     * @param int $id Company ID
     * @return Order;
     */
    public function getOrdersStatusDone($id)
    {
        return Order::where('company_id', $id)
                ->where('order_done', 1)
                ->whereNull('time_delivered')
                ->get();
    }

    /**
     * Update order to done when all items are finished
     *
     * @param int $id Company ID
     * @param int $orderId Order ID
     * @return Order;
     */
    public function orderIsDone($id, $orderId)
    {
        $order = Order::where([
                ['id', $orderId],
                ['company_id', $id]
            ])->first();

        $order->update(['order_done' => 1]);

        return $order;
    }

    /**
     * Update order to done when all items are finished
     *
     * @param int $id Company ID
     * @param int $orderId Order ID
     * @return Order;
     */
    public function orderIsClose($id, $orderId)
    {
        $order = Order::where([
                ['id', $orderId],
                ['company_id', $id]
            ])->first();

        $order->update(['time_delivered' => Carbon::now()->format('Y-m-d H:i:s')]);

        return $order;
    }
}
