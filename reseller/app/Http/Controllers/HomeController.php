<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->isAdmin()) {

            $start = null;
            $end = null;

            $sumall = DB::table('history_credit')
                ->sum('topup');

            $sumbuy = DB::table('history_credit')
                ->sum('pay');

            $sumchangeall = DB::table('history_credit')
                ->sum('change');

            $sumcreditday = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereDate('history_credit.created_at', '=', date('Y-m-d'))
                ->sum('topup');

            $sumchangeday = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereDate('history_credit.created_at', '=', date('Y-m-d'))
                ->sum('change');

            $sumbuyday = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereDate('history_credit.created_at', '=', date('Y-m-d'))
                ->sum('pay');

            $sumtoupday = (int) $sumcreditday - (int) $sumchangeday; //ใช้
            $sumtoupall = (int) $sumall - (int) $sumchangeall;

            $sumbuyJan = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '01')
                ->sum('pay');

            $sumbuyFeb = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '02')
                ->sum('pay');

            $sumbuyMar = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '03')
                ->sum('pay');

            $sumbuyApr = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '04')
                ->sum('pay');

            $sumbuyMay = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '05')
                ->sum('pay');

            $sumbuyJun = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '06')
                ->sum('pay');

            $sumbuyJul = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '07')
                ->sum('pay');

            $sumbuyAug = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '08')
                ->sum('pay');

            $sumbuySept = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '09')
                ->sum('pay');

            $sumbuyOct = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '10')
                ->sum('pay');

            $sumbuyNov = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '11')
                ->sum('pay');

            $sumbuyDec = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '12')
                ->sum('pay');

            //Credit Months
            $sumcreditJan = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '1')
                ->sum('topup');

            $sumchangeJan = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '1')
                ->sum('change');

            $sumcreditFeb = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '2')
                ->sum('topup');

            $sumchangeFeb = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '2')
                ->sum('change');

            $sumcreditMar = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '3')
                ->sum('topup');

            $sumchangeMar = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '3')
                ->sum('change');

            $sumcreditApr = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '4')
                ->sum('topup');

            $sumchangeApr = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '4')
                ->sum('change');

            $sumcreditMay = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '5')
                ->sum('topup');

            $sumchangeMay = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '5')
                ->sum('change');

            $sumcreditJun = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '6')
                ->sum('topup');

            $sumchangeJun = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '6')
                ->sum('change');

            $sumcreditJul = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '7')
                ->sum('topup');

            $sumchangeJul = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '7')
                ->sum('change');

            $sumcreditAug = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '8')
                ->sum('topup');

            $sumchangeAug = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '8')
                ->sum('change');

            $sumcreditSept = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '9')
                ->sum('topup');

            $sumchangeSept = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '9')
                ->sum('change');

            $sumcreditOct = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '10')
                ->sum('topup');

            $sumchangeOct = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '10')
                ->sum('change');

            $sumcreditNov = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '11')
                ->sum('topup');

            $sumchangeNov = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '11')
                ->sum('change');

            $sumcreditDec = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '12')
                ->sum('topup');

            $sumchangeDec = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->whereMonth('history_credit.created_at', '=', '12')
                ->sum('change');

            $sumtoupJan = (int) $sumcreditJan - (int) $sumchangeJan;
            $sumtoupFeb = (int) $sumcreditFeb - (int) $sumchangeFeb;
            $sumtoupMar = (int) $sumcreditMar - (int) $sumchangeMar;
            $sumtoupApr = (int) $sumcreditApr - (int) $sumchangeApr;
            $sumtoupMay = (int) $sumcreditMay - (int) $sumchangeMay;
            $sumtoupJun = (int) $sumcreditJun - (int) $sumchangeJun;
            $sumtoupJul = (int) $sumcreditJul - (int) $sumchangeJul;
            $sumtoupAug = (int) $sumcreditAug - (int) $sumchangeAug;
            $sumtoupSept = (int) $sumcreditSept - (int) $sumchangeSept;
            $sumtoupOct = (int) $sumcreditOct - (int) $sumchangeOct;
            $sumtoupNov = (int) $sumcreditNov - (int) $sumchangeNov;
            $sumtoupDec = (int) $sumcreditDec - (int) $sumchangeDec;

            $product = DB::table('products')
                ->join('order_product', 'order_product.product_id', 'order_product.product_id')
                ->select(DB::raw('products.product_id , products.product_name as name , sum(products.price) / products.price as q'))
                ->groupBy('products.product_id')
                ->orderBy('products.product_id', 'asc')
                ->get()
                ->toArray();

            $q = DB::table('orders')
                ->join('order_product', 'orders.order_id', 'order_product.order_id')
                ->join('products', 'order_product.product_id', 'products.product_id')
                ->select(DB::raw('products.product_id , products.product_name , products.price , sum(products.price) as total , sum(products.price) / products.price as q'))
                ->groupBy('products.product_id')
                ->orderBy('products.product_id', 'asc')
                ->get()
                ->toArray();

            $productname = array_column($product, 'name');
            $quantity = array_column($q, 'q');

            $topten = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->select(DB::raw('history_credit.credit_id , users.name , users.surname , sum(pay) as total'))
                ->groupBy('history_credit.credit_id')
                ->orderBy('total', 'desc')
                ->Limit(10)
                ->get();

            return view('admin/dashboard', [
                'productname' => json_encode($productname),
                'quantity' => json_encode($quantity, JSON_NUMERIC_CHECK),
                'topten' => $topten,
                'sumtoupall' => $sumtoupall,
                'sumbuy' => $sumbuy,
                'sumbuyday' => $sumbuyday,
                'sumtoupday' => $sumtoupday,
                'start' => $start,
                'end' => $end,
                //buy
                'sumbuyJan' => json_encode($sumbuyJan),
                'sumbuyFeb' => json_encode($sumbuyFeb),
                'sumbuyMar' => json_encode($sumbuyMar),
                'sumbuyApr' => json_encode($sumbuyApr),
                'sumbuyMay' => json_encode($sumbuyMay),
                'sumbuyJun' => json_encode($sumbuyJun),
                'sumbuyJul' => json_encode($sumbuyJul),
                'sumbuyAug' => json_encode($sumbuyAug),
                'sumbuySept' => json_encode($sumbuySept),
                'sumbuyOct' => json_encode($sumbuyOct),
                'sumbuyNov' => json_encode($sumbuyNov),
                'sumbuyDec' => json_encode($sumbuyDec),
                //topup
                'sumtoupJan' => json_encode($sumtoupJan),
                'sumtoupFeb' => json_encode($sumtoupFeb),
                'sumtoupMar' => json_encode($sumtoupMar),
                'sumtoupApr' => json_encode($sumtoupApr),
                'sumtoupMay' => json_encode($sumtoupMay),
                'sumtoupJun' => json_encode($sumtoupJun),
                'sumtoupJul' => json_encode($sumtoupJul),
                'sumtoupAug' => json_encode($sumtoupAug),
                'sumtoupSept' => json_encode($sumtoupSept),
                'sumtoupOct' => json_encode($sumtoupOct),
                'sumtoupNov' => json_encode($sumtoupNov),
                'sumtoupDec' => json_encode($sumtoupDec),
            ]);

        } else {

            $start = null;
            $end = null;

            $hiscredit = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
                ->join('users', 'credit.user_id', '=', 'users.id')
                ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.change', 'history_credit.pay', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
                ->where('user_id', '=', Auth::user()->id)
                ->orderBy('history_credit.hiscredit_id', 'DESC')
                ->paginate(4);

            $sumall = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->where('credit.user_id', '=', Auth::user()->id)
                ->sum('topup');

            $sumbuy = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->where('credit.user_id', '=', Auth::user()->id)
                ->sum('pay');

            $sumchange = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->where('credit.user_id', '=', Auth::user()->id)
                ->sum('change');

            $sumcreditday = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->where('credit.user_id', '=', Auth::user()->id)
                ->whereDate('history_credit.created_at', '=', date('Y-m-d'))
                ->sum('topup');

            $sumbuyday = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->where('credit.user_id', '=', Auth::user()->id)
                ->whereDate('history_credit.created_at', '=', date('Y-m-d'))
                ->sum('pay');

            $sumchangeday = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
                ->join('users', 'credit.user_id', 'users.id')
                ->where('credit.user_id', '=', Auth::user()->id)
                ->whereDate('history_credit.created_at', '=', date('Y-m-d'))
                ->sum('change');

            $credit = DB::table('credit')
                ->where('user_id', '=', Auth::user()->id)
                ->get();

            $sumtopup = (int) $sumall - (int) $sumchange;
            $sumtopupday = (int) $sumcreditday - (int) $sumchangeday;

            return view('reseller/credituser', [
                'credit' => $credit,
                'sumtopup' => $sumtopup,
                'sumbuy' => $sumbuy,
                'sumtopupday' => $sumtopupday,
                'sumbuyday' => $sumbuyday,
                'hiscredit' => $hiscredit,
                'start' => $start,
                'end' => $end,
            ]);
        }
    }
}
