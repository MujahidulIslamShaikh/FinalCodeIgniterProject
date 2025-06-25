<?php

namespace App\Controllers;

use App\Models\ProdBrandModel;
use App\Models\ProdCateModel;
use App\Models\ProductApiModel;
use App\Models\ProductModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class GeneralController extends BaseController
{
    public function product_list_pdf()
    {
        $model = new ProductApiModel();

        $products = $model
            ->select('productapitable.*, product_categories.CateName as category, product_brands.BrandName as brand')
            ->join('product_categories', 'product_categories.CateId = productapitable.CateId')
            ->join('product_brands', 'product_brands.BrandId = productapitable.BrandId')
            ->findAll();

        $dompdf = new Dompdf();
        $html = view('/pdf/product_list_pdf', ['products' => $products]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $dompdf->stream("product_list.pdf", ["Attachment" => false]);
        exit();
    }

    public function General_check()
    {
        $model = new ProductApiModel();
        $products = $model->findAll();
        //  $products = $model
        //     ->select('productapitable.*, product_categories.CateName as category, product_brands.BrandName as brand')
        //     ->join('product_categories', 'product_categories.CateId = productapitable.CateId')
        //     ->join('product_brands', 'product_brands.BrandId = productapitable.BrandId')
        //     ->findAll();

        echo "<h2>Product List</h2>";
        echo "<ul>";
        foreach ($products as $product) {
            // e    cho "<li>{$product['ProductName']}</li>";
            echo '<pre>';
            print_r($product);
            echo '</pre>';
        }
        echo "</ul>";
    }
    // ============================ Category and Brand =============================================
    public function CategoryListPdf()
    {
        $model = new ProdCateModel();
        $cates = $model->findAll();

        $dompdf = new Dompdf();
        $html = view('pdf/Brand_Cate_list_pdf', [
            'title'   => 'Category List',
            'headers' => ['Cate ID', 'Cate Name'],
            'columns' => ['CateId', 'CateName'],
            'rows'    => $cates
        ]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("category_list.pdf", ["Attachment" => false]);
        exit();
    }
    public function Brand_list_pdf()
    {
        $model = new ProdBrandModel();
        $brands = $model->findAll();

        $dompdf = new Dompdf();
        $html = view('pdf/Brand_Cate_list_pdf', [
            'title'   => 'Brand List',
            'headers' => ['Brand ID', 'Brand Name'],
            'columns' => ['BrandId', 'BrandName'],
            'rows'    => $brands
        ]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("brand_list.pdf", ["Attachment" => false]);
        exit();
    }




    public function pdf_template()
    {
        $dompdf = new Dompdf();

        // Optional: PDF settings
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);

        // ✅ Load HTML content (from view file or dynamic)
        $html = view('pdf_template', [
            'title' => 'User Report',
            'data'  => ['username' => 'Mujahid']
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // ✅ Output PDF to browser directly as download
        $dompdf->stream("user_report.pdf", ["Attachment" => false]); // true = download, false = inline

        exit(); // Stop CI response after output
    }

    public function CreateProductView()
    {
        return view('/CreateProductView');
    }

    public function BrandView()
    {

        return view('brand/BrandView');
    }

    public function index(): string
    {
        return view('welcome_message');
        // return "Mujahid";
        // return view('Form');
    }

    public function greet($name)
    {
        return "Hellow, " . esc($name) . "!";
    }
}
