<?php

namespace App\Exports;

use App\Order;
use App\Product;
use App\Orderproduct;
use DB;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\withHeadings;
class orderExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $history = DB::table('credit')
            ->join('credit_order', 'credit.credit_id', '=', 'credit_order.credit_id')
            ->join('orders', 'credit_order.order_id', '=', 'orders.order_id')
            ->join('order_product', 'orders.order_id', '=', 'order_product.order_id')
            ->join('products', 'order_product.product_id', '=', 'products.product_id')
            ->join('users', 'credit.user_id', '=', 'users.id')
            ->select('orders.order_id', 'orders.order_ref', 'users.id', 'orders.create_by' , 'credit.credit_id',  'products.product_id', 'products.product_name', 'products.price','orders.created_at')
            ->orderBy('order_id', 'ASC')
            ->get();

        return $history;
    }

    public function headings(): array
    {
        return [
            'ORDER ID',
            'ORDER REF',
            'USER ID',
            'RESELLER',
            'CREDIT ID',
            'PRODUCT ID',
            'PRODUCT NAME',
            'PRODUCT PRICE',
            'DATE'
        ];
    }
}
