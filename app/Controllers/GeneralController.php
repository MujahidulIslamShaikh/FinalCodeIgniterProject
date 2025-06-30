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

    public function insertDummyProducts()
    {
        $prodmodel = new \App\Models\ProductApiModel();
        $faker = \Faker\Factory::create();

        $imageUrls = [
            'https://images.unsplash.com/photo-1592503253921-79ec36ffb49b',
            'https://images.unsplash.com/photo-1606813902483-cd4ec6989a36',
            'https://images.unsplash.com/photo-1585386959984-a41552262da1',
            'https://images.unsplash.com/photo-1585386958340-c998b17feec2',
            'https://images.unsplash.com/photo-1583267745083-bb1a01fca7e2',
        ];

        $savePath = FCPATH . 'uploads/products/';
        if (!is_dir($savePath)) {
            mkdir($savePath, 0777, true);
        }

        $imageFiles = [];

        // Download images via cURL
        foreach ($imageUrls as $index => $url) {
            $fileName = 'product_' . ($index + 1) . '.jpg';
            $filePath = $savePath . $fileName;

            $ch = curl_init($url);
            $fp = fopen($filePath, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);

            // Check if image downloaded
            if (file_exists($filePath)) {
                $imageFiles[] = 'uploads/products/' . $fileName;
            }
        }

        if (empty($imageFiles)) {
            $imageFiles[] = 'uploads/products/default.png';
        }

        $data = [];
        for ($i = 0; $i < 50; $i++) {
            $data[] = [
                'ProdName'   => $faker->words(2, true),
                'details'    => $faker->sentence(),
                'CateId'     => rand(1, 5),
                'BrandId'    => rand(1, 5),
                'ProdImage'  => $imageFiles[array_rand($imageFiles)],
                'price'      => rand(100, 5000),
                'stock'      => rand(1, 100),
            ];
        }

        $prodmodel->insertBatch($data);
        return "✅ Inserted 50 dummy products with real static images!";
    }

    public function insertDummyCategories()
    {
        $model = new \App\Models\ProdCateModel();
        $faker = \Faker\Factory::create();

        $data = [];
        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'CateName' => ucfirst($faker->unique()->word)
            ];
        }

        $model->insertBatch($data);
        return "5 dummy categories inserted.";
    }

    public function insertDummyBrands()
    {
        $model = new \App\Models\ProdBrandModel();
        $faker = \Faker\Factory::create();

        $data = [];
        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'BrandName' => ucfirst($faker->unique()->company)
            ];
        }

        $model->insertBatch($data);
        return "5 dummy brands inserted.";
    }
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
