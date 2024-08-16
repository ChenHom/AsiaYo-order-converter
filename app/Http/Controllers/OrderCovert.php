<?php

namespace App\Http\Controllers;

use App\DTO\OrderConvertDTO;
use App\Http\Requests\OrderRequest as Request;
use App\Services\OrderService;

class OrderCovert extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(OrderService $orderService, Request $request)
    {
        return $orderService->convertOrder(
            OrderConvertDTO::fromRequest($request)
        );
    }
}
