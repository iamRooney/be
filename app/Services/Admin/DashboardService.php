<?php

namespace App\Services\Admin;

class DashboardService
{
    public function getDashboardData()
    {
        return [
            'stats' => [],
            'analytics' => [],
            'pending' => [],
            'recentCompanies' => [],
            'recentEnquiries' => [],
            'recentListings' => [],
            'activities' => [],
            'admin' => []
        ];
    }
}
