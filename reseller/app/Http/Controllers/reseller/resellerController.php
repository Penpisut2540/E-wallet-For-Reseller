<?php

namespace App\Http\Controllers\reseller;

use App\Creditorder;
use App\Historycredit;
use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Order;
use App\Orderproduct;
use App\Product;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class resellerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //show profile
    public function showprofilereseller()
    {
        $credit = DB::table('credit')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        return view('reseller/profileuser', [
            'credit' => $credit,
        ]);
    }

    //-- not use
    public function editprofilereseller($id)
    {
        $credit = DB::table('credit')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        return view('reseller/editprofileuser')->with('user', user::find($id))
            ->with("credit", $credit);
    }

    //save edit profile
    public function updateeditprofilereseller(Request $request, $id)
    {
        $user = user::find($id);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'alpha', 'string', 'max:255'],
            'surname' => ['required', 'alpha', 'string', 'max:255'],
            'tel' => ['required', 'digits:10'],
            'email' => ['unique:users,email,' . $user->id, 'max:255', 'string'],
            'typeUser' => ['required', 'in:ADMIN,RESELLER'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_code6', 6)->with('user', $user->id);
        } else {
            if ($request['password'] == $user->password) {
                $user->update([
                    'name' => $request['name'],
                    'surname' => $request['surname'],
                    'tel' => $request['tel'],
                    'email' => $request['email'],
                    'typeUser' => $request['typeUser'],
                    'password' => ($request['password']),
                ]);
                return redirect()->route('profileuser')->with('status', 'Edit Profile Success');

            } else {
                $user->update([
                    'name' => $request['name'],
                    'surname' => $request['surname'],
                    'tel' => $request['tel'],
                    'email' => $request['email'],
                    'typeUser' => $request['typeUser'],
                    'password' => Hash::make($request['password']),
                ]);
                return redirect()->route('profileuser')->with('status', 'Edit Profile Success');
            }
        }
    }

    //show credit user only user
    public function showcredituser()
    {
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
        ]);
    }

    //show product
    public function showproduct()
    {
        $credit = DB::table('credit')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        $product = DB::table('products')->get();

        $order = DB::table('orders')
            ->orderBy('order_id', 'DESC')
            ->Limit(1)
            ->get();

        return view('reseller/showproduct', [
            'product' => $product,
            'credit' => $credit,
            'order' => $order,
        ]);
    }

    //--not use
    public function buyorder($id)
    {
        $product = product::find($id);

        $order = DB::table('orders')
            ->orderBy('order_id', 'DESC')
            ->Limit(1)
            ->get();

        $credit = DB::table('credit')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        return view('reseller/buyorder')
            ->with("product", $product)
            ->with("order", $order)
            ->with("credit", $credit);

    }

    //save order when user buy
    public function storebuyorder(Request $request, $id = null)
    {
        $price = $request['price'];
        $cd_id = $request['credit_id'];

        $credit = DB::table('credit')->where('credit_id', $cd_id)->first();
        $after = $credit->after;

        $ref = $request['order_ref'];

        if ($after >= $price) {

            if ($ref == null) {
                $o = order::create([
                    'order_ref' => (int) 1,
                    'create_by' => $request['create_by'],
                ]);
            } else {
                $o = order::create([
                    'order_ref' => $request['order_ref'],
                    'create_by' => $request['create_by'],
                ]);
            }

            creditorder::create([
                'credit_id' => $request['credit_id'],
                'order_id' => $o->order_id,
            ]);

            orderproduct::create([
                'order_id' => $o->order_id,
                'product_id' => $request['product_id'],
            ]);

            DB::table('credit')
                ->where('user_id', '=', Auth::user()->id)
                ->update(['after' => (int) $after - (int) $price], ['after' => (int) $after - (int) $price]);

            historycredit::create([
                'pay' => (int) $price,
                'create_by' => $request['create_by'],
                'typeCreate' => "USED",
                'credit_id' => $request['credit_id'],
            ]);
            return redirect()->back()->with('status4', 4);

        } else {
            //สร้าง modal แจ้งเตือน ส่ง error code
            return redirect()->back()->with('status3', 3);
        }
    }

    //ประวัติการสั่งซื้อ
    public function showhistoryuser()
    {
        $history = DB::table('credit')
            ->join('credit_order', 'credit.credit_id', '=', 'credit_order.credit_id')
            ->join('orders', 'credit_order.order_id', '=', 'orders.order_id')
            ->join('order_product', 'orders.order_id', '=', 'order_product.order_id')
            ->join('products', 'order_product.product_id', '=', 'products.product_id')
            ->join('users', 'credit.user_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.surname', 'credit.credit_id', 'orders.created_at', 'orders.create_by', 'orders.order_id', 'orders.order_ref', 'products.product_id', 'products.product_name', 'products.price')
            ->where('user_id', '=', Auth::user()->id)
            ->orderBy('order_id', 'DESC')
            ->paginate(6);

        $credit = DB::table('credit')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        return view('reseller/showhistoryuser', [
            'history' => $history,
            'credit' => $credit,
        ]);
    }

    //--not use
    public function orderdetails($id)
    {
        //dd($id);
        $product = product::find($id)
            ->get();

        return view('reseller/orderdetails', [
            'product' => $product,
        ]);
    }

    //ประวัติการใช้เงินของตัวเอง
    public function showtopuppaycredituser()
    {
        $hiscredit = DB::table('history_credit')
            ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
            ->join('users', 'credit.user_id', '=', 'users.id')
            ->select('history_credit.create_by', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.change', 'history_credit.pay', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
            ->where('user_id', '=', Auth::user()->id)
            ->orderBy('history_credit.hiscredit_id', 'DESC')
            ->get();

        return view('reseller/showtopuppaycredituser', [
            'hiscredit' => $hiscredit,
        ]);
    }

    //แสดงรายละเอียดเงินในบัญชีของ user ด้านบน navbar เลยต้องส่งค่าไป layouts แล้ว extents ไปไฟล์อื่น
    public function showbalance()
    {
        $credit = DB::table('credit')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        return view('layouts/app', [
            'credit' => $credit,
        ]);
    }

    //ค้นหา searchhistoryuser ประวัติการสั่งซื้อของลูกค้า
    public function searchhistoryuser(Request $request)
    {
        $credit = DB::table('credit')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        $history = DB::table('credit')
            ->join('credit_order', 'credit.credit_id', '=', 'credit_order.credit_id')
            ->join('orders', 'credit_order.order_id', '=', 'orders.order_id')
            ->join('order_product', 'orders.order_id', '=', 'order_product.order_id')
            ->join('products', 'order_product.product_id', '=', 'products.product_id')
            ->join('users', 'credit.user_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.surname', 'users.email', 'credit.credit_id', 'orders.created_at', 'orders.create_by', 'orders.order_id', 'orders.order_ref', 'products.product_id', 'products.product_name', 'products.price')
            ->where('user_id', '=', Auth::user()->id)
            ->where('orders.order_id', 'LIKE', '%' . $request->name . '%')
            ->orderBy('order_id', 'DESC')
            ->paginate(6);

        return view('reseller/showhistoryuser', [
            'history' => $history,
            'credit' => $credit,
        ]);
    }

    //show contact
    public function showcontact()
    {
        $credit = DB::table('credit')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        return view('reseller/showcontact', [
            'credit' => $credit,
        ]);
    }

    //sendmail
    public function sendemail(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $data = array(
            'name' => $request->name,
            'message' => $request->message,
        );

        Mail::to('adminreseller@ketshopweb.com')->send(new SendMail($data));
        return back()->with('success', 'Thanks for contacting us!');
    }

}
