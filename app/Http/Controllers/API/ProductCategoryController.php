<?php

namespace App\Http\Controllers\API;

use App\helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use PDO;

class ProductCategoryController extends Controller
{
    public function all(Request $request)
    {

        $id = $request->input('id');
        $limit = $request->input('limit');
        $name = $request->input('name');
        $show_product = $request->input('show_product');


        if ($id) {
            $category = ProductCategory::with(['products'])->find($id);

            if ($category) {

                return ResponseFormatter::success(
                    $category,
                    'Data Category Berhasil Diambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data Category Tidak ada',
                    404
                );
            }
        }
        $category = ProductCategory::query();

        if ($name) {
            $category = ProductCategory::where('name', 'like', '%' . $name . '%');
        }

        if ($show_product) {
            $category->with('products');
        }
        return ResponseFormatter::success(
            $category->paginate($limit),
            'Data category Berhasil Diambil'
        );
    }
}
