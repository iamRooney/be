<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\DashboardResource;
use App\Services\Admin\DashboardService;

class DashboardController extends Controller
{
    public function __invoke(DashboardService $dashboardService)
    {
        return new DashboardResource(

            $dashboardService->getDashboardData()

        );
    }
}
