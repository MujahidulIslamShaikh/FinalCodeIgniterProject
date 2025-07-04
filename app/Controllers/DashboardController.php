<?php


namespace app\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductApiModel;

class DashboardController extends BaseController
{

    
    public function index()
    {
        return view('dashboard_view');
    }

    public function productCountData()
    {
        $model = new ProductApiModel();

        $data = $model->select("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as count")
            ->groupBy("month")
            ->orderBy("month", 'ASC')
            ->findAll();

        return $this->response->setJSON($data);
    }
}
