<?php
namespace App\Http\Controllers\admin;

use App\Credit;
use App\Exports\orderExport;
use App\Exports\resellerExport;
use App\Exports\creditExport;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DB;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //dashbord
    public function index(Request $request)
    {
        $start = $request['startdate'];
        $end = $request['enddate'];

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

        $product = DB::table('orders')
            ->join('order_product', 'orders.order_id', 'order_product.order_id')
            ->join('products', 'order_product.product_id', 'products.product_id')
            ->whereMonth('order_product.created_at', '=', date('m'))
            ->select(DB::raw('products.product_id , products.product_name as name'))
            ->groupBy('products.product_id')
            ->orderBy('products.product_id', 'asc')
            ->get()
            ->toArray();

        $q = DB::table('orders')
            ->join('order_product', 'orders.order_id', 'order_product.order_id')
            ->join('products', 'order_product.product_id', 'products.product_id')
            ->whereMonth('order_product.created_at', '=', date('m'))
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
    }

    //manageuserbyadmin
    public function show()
    {
        $user = DB::table('credit')
            ->join('users', 'credit.user_id', '=', 'users.id')
            ->select('users.*', 'credit.*')
            ->orderBy('users.id', 'desc')
            ->paginate(5);

        return view('admin/manageuserbyadmin', [
            'user' => $user,
        ]);
    }

    //manageadminbyadmin
    public function showmanageadminbyadmin()
    {
        $user = DB::table('users')
            ->where('typeUser', 'ADMIN')
            ->paginate(6);

        return view('admin/manageadminbyadmin')
            ->with("user", $user);
    }

    //add user -- not use
    public function create()
    {
        return view('admin/adduserbyadmin');
    }

    //add admin -- not use
    public function addadminbyadmin()
    {
        return view('admin/addadminbyadmin');
    }

    //save add user
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'alpha', 'string', 'max:255'],
            'surname' => ['required', 'alpha', 'string', 'max:255'],
            //'surname' => ['required', 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/', 'string', 'max:255'],
            'tel' => ['required', 'digits:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'typeUser' => ['required', 'in:ADMIN,RESELLER'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_code3', 3);
        } else {
            $u = user::create([
                'name' => $request['name'],
                'surname' => $request['surname'],
                'tel' => $request['tel'],
                'email' => $request['email'],
                'typeUser' => $request['typeUser'],
                'password' => Hash::make($request['password']),
            ]);

            $name = Auth::user()->name;
            $surname = Auth::user()->surname;

            credit::create([
                'create_by' => $name . " " . $surname,
                'update_by' => $name . " " . $surname,
                'after' => 0,
                'user_id' => $u->id,
            ]);
            return redirect()->back()->with('status', 'Create Reseller Success');
        }
    }

    //save add admin
    public function storeadminbyadmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'alpha', 'string', 'max:255'],
            'surname' => ['required', 'alpha', 'string', 'max:255'],
            'tel' => ['required', 'digits:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'typeUser' => ['required', 'in:ADMIN,RESELLER'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_code', 1);
        } else {
            $u = user::create([
                'name' => $request['name'],
                'surname' => $request['surname'],
                'tel' => $request['tel'],
                'email' => $request['email'],
                'typeUser' => $request['typeUser'],
                'password' => Hash::make($request['password']),
            ]);
            return redirect('admin/manageadminbyadmin')->with('status', 'Create Admin Success');
        }
    }

    //edituserbyadmin --not use
    public function edit($id)
    {
        return view('admin/edituserbyadmin')->with('user', user::find($id));
    }

    //save edit user and admin
    public function update(Request $request, $id)
    {
        $user = user::find($id);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'alpha', 'max:255'],
            'surname' => ['required', 'alpha', 'max:255'],
            'tel' => ['required', 'digits:10'],
            'email' => ['unique:users,email,' . $user->id, 'max:255', 'string'],
            'typeUser' => ['required', 'in:ADMIN,RESELLER'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_code2', 2)->with('us', $user->id);
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
                if ($request['typeUser'] == 'RESELLER') {
                    // return redirect()->route('manageuserbyadmin')->with('status', 'Edit User Success');
                    return redirect()->back()->with('status', 'Edit Reseller Success');
                } else {
                    // return redirect()->route('manageadminbyadmin')->with('status', 'Edit Admin Success');
                    return redirect()->back()->with('status', 'Edit Admin Success');
                }
            } else {
                $user->update([
                    'name' => $request['name'],
                    'surname' => $request['surname'],
                    'tel' => $request['tel'],
                    'email' => $request['email'],
                    'typeUser' => $request['typeUser'],
                    'password' => Hash::make($request['password']),
                ]);
                if ($request['typeUser'] == 'RESELLER') {
                    // return redirect()->route('manageuserbyadmin')->with('status', 'Edit User Success');
                    return redirect()->back()->with('status', 'Edit Reseller Success');
                } else {
                    // return redirect()->route('manageadminbyadmin')->with('status', 'Edit Admin Success');
                    return redirect()->back()->with('status', 'Edit Admin Success');
                }
            }
        }
    }

    //delete credit and delete user (manageuserbyadmin)
    public function delete($id)
    {
        // dd($id);
        $credit = credit::find($id);
        $credit->delete();

        $user = user::find($credit->user_id);
        $user->delete();

        // return redirect()->route('manageuserbyadmin')->with('status', 'Delete User Success');
        return redirect()->back()->with('status', 'Delete Reseller Success');
    }

    //delete admin (manageadminbyadmin)
    public function deleteadminbyadmin($id)
    {
        $user = user::find($id);
        $user->delete();

        // return redirect()->route('manageadminbyadmin')->with('status', 'Delete Admin Success');
        return redirect()->back()->with('status', 'Delete Admin Success');
    }

    //show profile at dropdown
    public function showprofileadmin()
    {
        return view('admin/profileadmin');
    }

    //editprofileadmin --not use
    public function editprofileadmin($id)
    {
        return view('admin/editprofileadmin')->with('user', user::find($id));
    }

    //update edit profile admin
    public function updateeditprofileadmin(Request $request, $id)
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
            return redirect()->back()->withErrors($validator)->withInput()->with('error_code5', 5)->with('user', $user->id);
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
                return redirect()->route('profileadmin')->with('status', 'Edit Profile Success');

            } else {
                $user->update([
                    'name' => $request['name'],
                    'surname' => $request['surname'],
                    'tel' => $request['tel'],
                    'email' => $request['email'],
                    'typeUser' => $request['typeUser'],
                    'password' => Hash::make($request['password']),
                ]);
                return redirect()->route('profileadmin')->with('status', 'Edit Profile Success');
            }
        }
    }

    //showhistoryadmin ประวัติการสั่งซื้อของ reseller
    public function showhistoryadmin()
    {
        $start = null;
        $end = null;
        $name = null;

        $history = DB::table('credit')
            ->join('credit_order', 'credit.credit_id', '=', 'credit_order.credit_id')
            ->join('orders', 'credit_order.order_id', '=', 'orders.order_id')
            ->join('order_product', 'orders.order_id', '=', 'order_product.order_id')
            ->join('products', 'order_product.product_id', '=', 'products.product_id')
            ->join('users', 'credit.user_id', '=', 'users.id')
            ->select('users.id', 'credit.credit_id', 'orders.created_at', 'orders.create_by', 'orders.order_id', 'orders.order_ref', 'products.product_id', 'products.product_name', 'products.price')
            ->orderBy('order_id', 'DESC')
            ->paginate(6);

        return view('admin/showhistoryadmin', [
            'history' => $history,
            'start' => $start,
            'end' => $end,
            'name' => $name,
        ]);
    }

    //ค้นหา manageuserbyadmin
    public function searchuseradmin(Request $request)
    {
        $user = DB::table('credit')
            ->join('users', 'credit.user_id', '=', 'users.id')
            ->select('users.*', 'credit.*')
            ->where('typeUser', '=', 'RESELLER')
            ->where('name', 'LIKE', '%' . $request->name . '%')
            ->orWhere('email', 'LIKE', '%' . $request->name . '%')
            ->paginate(5);

        return view('admin/manageuserbyadmin', [
            'user' => $user,
        ]);
    }

    public function searchadminuseradmin(Request $request)
    {

        $user = DB::table('users')
            ->where('typeUser', 'ADMIN')
            ->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->name . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->name . '%');
            })
            ->get();

        return view('admin/manageadminbyadmin')
            ->with("user", $user);

        // $user = DB::table('users')
        //     ->where('typeUser', 'ADMIN')
        //     ->where('name', 'LIKE', '%' . $request->name . '%')
        //     ->orWhere('email', 'LIKE', '%' . $request->name . '%')
        //     ->get();

        // return view('admin/manageadminbyadmin', [
        //     'user' => $user,
        // ]);
    }

    //ค้นหา searchhistoryadmin ประวัติการสั่งซื้อของลูกค้า -- not use
    public function searchhistoryadmin(Request $request)
    {
        $start = $request['startdate'];
        $end = $request['enddate'];

        $history = DB::table('credit')
            ->join('credit_order', 'credit.credit_id', '=', 'credit_order.credit_id')
            ->join('orders', 'credit_order.order_id', '=', 'orders.order_id')
            ->join('order_product', 'orders.order_id', '=', 'order_product.order_id')
            ->join('products', 'order_product.product_id', '=', 'products.product_id')
            ->join('users', 'credit.user_id', '=', 'users.id')
            ->select('users.id', 'users.email', 'credit.credit_id', 'orders.created_at', 'orders.create_by', 'orders.order_id', 'orders.order_ref', 'products.product_id', 'products.product_name', 'products.price')
            ->where('name', 'LIKE', '%' . $request->name . '%')
            ->orWhere('email', 'LIKE', '%' . $request->name . '%')
            ->orWhere('orders.order_id', 'LIKE', '%' . $request->name . '%')
            ->orWhere('product_name', 'LIKE', '%' . $request->name . '%')
            ->orderBy('order_id', 'DESC')->get();

        return view('admin/showhistoryadmin', [
            'history' => $history,
            'start' => $start,
            'end' => $end,
        ]);
    }

    //คำนวณ products ที่ขายได้ ว่าชิ้นไหนเท่าไหร่
    public function showproductadmin(Request $request)
    {

        if ($request['startdate'] == null && $request['enddate'] == null) {

            $start = $request['startdate'];
            $end = $request['enddate'];

            $pro = DB::table('orders')
                ->join('order_product', 'orders.order_id', 'order_product.order_id')
                ->join('products', 'order_product.product_id', 'products.product_id')
                ->select(DB::raw('products.product_id , products.product_name , products.price , sum(products.price) as total , sum(products.price) / products.price as q'))
                ->groupBy('products.product_id')
                ->orderBy('products.product_id', 'asc')
                ->get();

        } else {

            $start = $request['startdate'];
            $end = $request['enddate'];

            $pro = DB::table('orders')
                ->join('order_product', 'orders.order_id', 'order_product.order_id')
                ->join('products', 'order_product.product_id', 'products.product_id')
                ->select(DB::raw('products.product_id , products.product_name , products.price , sum(products.price) as total , sum(products.price) / products.price as q'))
                ->whereBetween('order_product.created_at', [$request['startdate'] . ' 00:00:00', $request['enddate'] . ' 23:59:59'])
                ->groupBy('products.product_id')
                ->orderBy('products.product_id', 'asc')
                ->get();

        }
        return view('admin/showproductadmin', [
            'pro' => $pro,
            'start' => $start,
            'end' => $end,
        ]);
    }

    //showdetailsuser รายละเอียดทั้งหมด
    public function showdetailsuser($id)
    {
        $hiscredit = DB::table('history_credit')
            ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
            ->join('users', 'credit.user_id', '=', 'users.id')
            ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.change', 'history_credit.pay', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
            ->where('user_id', '=', $id)
            ->orderBy('history_credit.hiscredit_id', 'DESC')
        // ->paginate(5, ['*'], 'p1');
            ->get();

        $sumtopall = DB::table('history_credit')
            ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
            ->join('users', 'credit.user_id', 'users.id')
            ->where('credit.user_id', '=', $id)
            ->sum('topup');

        $sumchangeall = DB::table('history_credit')
            ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
            ->join('users', 'credit.user_id', 'users.id')
            ->where('credit.user_id', '=', $id)
            ->sum('change');

        $sumall = $sumtopall - $sumchangeall;

        $sumbuy = DB::table('history_credit')
            ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
            ->join('users', 'credit.user_id', 'users.id')
            ->where('credit.user_id', '=', $id)
            ->sum('pay');

        $sumtopday = DB::table('history_credit')
            ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
            ->join('users', 'credit.user_id', 'users.id')
            ->where('credit.user_id', '=', $id)
            ->whereDate('history_credit.created_at', '=', date('Y-m-d'))
            ->sum('topup');

        $sumchangeday = DB::table('history_credit')
            ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
            ->join('users', 'credit.user_id', 'users.id')
            ->where('credit.user_id', '=', $id)
            ->whereDate('history_credit.created_at', '=', date('Y-m-d'))
            ->sum('change');

        $sumcreditday = $sumtopday - $sumchangeday;

        $sumtopmount = DB::table('history_credit')
            ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
            ->join('users', 'credit.user_id', 'users.id')
            ->where('credit.user_id', '=', $id)
            ->whereMonth('history_credit.created_at', '=', date('m'))
            ->sum('topup');

        $sumchangemonth = DB::table('history_credit')
            ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
            ->join('users', 'credit.user_id', 'users.id')
            ->where('credit.user_id', '=', $id)
            ->whereMonth('history_credit.created_at', '=', date('m'))
            ->sum('change');

        $sumcreditmonth = $sumtopmount - $sumchangemonth;

        $sumbuyday = DB::table('history_credit')
            ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
            ->join('users', 'credit.user_id', 'users.id')
            ->where('credit.user_id', '=', $id)
            ->whereDate('history_credit.created_at', '=', date('Y-m-d'))
            ->sum('pay');

        $sumbuymonth = DB::table('history_credit')
            ->join('credit', 'history_credit.credit_id', 'credit.credit_id')
            ->join('users', 'credit.user_id', 'users.id')
            ->where('credit.user_id', '=', $id)
            ->whereMonth('history_credit.created_at', '=', date('m'))
            ->sum('pay');

        $credit = DB::table('credit')
            ->where('user_id', '=', $id)
            ->get();

        $history = DB::table('credit')
            ->join('credit_order', 'credit.credit_id', '=', 'credit_order.credit_id')
            ->join('orders', 'credit_order.order_id', '=', 'orders.order_id')
            ->join('order_product', 'orders.order_id', '=', 'order_product.order_id')
            ->join('products', 'order_product.product_id', '=', 'products.product_id')
            ->join('users', 'credit.user_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.surname', 'credit.credit_id', 'orders.created_at', 'orders.create_by', 'orders.order_id', 'orders.order_ref', 'products.product_id', 'products.product_name', 'products.price')
            ->where('user_id', '=', $id)
            ->orderBy('order_id', 'DESC')
        // ->paginate(5, ['*'], 'p2');
            ->get();

        return view('admin/showdetailsuser', [
            'credit' => $credit,
            'sumall' => $sumall,
            'sumbuy' => $sumbuy,
            'sumcreditday' => $sumcreditday,
            'sumbuyday' => $sumbuyday,
            'hiscredit' => $hiscredit,
            'history' => $history,
            'user' => user::find($id),
            'sumbuymonth' => $sumbuymonth,
            'sumcreditmonth' => $sumcreditmonth,
        ]);
    }

    //showdetailsadmin รายละเอียดทั้งหมด
    public function showdetailsadmin($id)
    {
        return view('admin/showdetailsadmin')->with('user', user::find($id));
    }

    //filter order ด้วยวันที่ และชื่อ
    public function searchhistoryadminbydate(Request $request)
    {
        if ($request['startdate'] == null && $request['enddate'] == null && $request['name'] == null) {

            $start = $request['startdate'];
            $end = $request['enddate'];
            $name = $request['name'];

            $history = DB::table('credit')
                ->join('credit_order', 'credit.credit_id', '=', 'credit_order.credit_id')
                ->join('orders', 'credit_order.order_id', '=', 'orders.order_id')
                ->join('order_product', 'orders.order_id', '=', 'order_product.order_id')
                ->join('products', 'order_product.product_id', '=', 'products.product_id')
                ->join('users', 'credit.user_id', '=', 'users.id')
                ->select('users.id', 'users.email', 'credit.credit_id', 'orders.created_at', 'orders.create_by', 'orders.order_id', 'orders.order_ref', 'products.product_id', 'products.product_name', 'products.price')
                ->paginate(6);

            return view('admin/showhistoryadmin', [
                'history' => $history,
                'start' => $start,
                'end' => $end,
                'name' => $name,
            ]);

        } elseif ($request['startdate'] != null && $request['enddate'] != null && $request['name'] == null) {

            $start = $request['startdate'];
            $end = $request['enddate'];
            $name = $request['name'];

            $history = DB::table('credit')
                ->join('credit_order', 'credit.credit_id', '=', 'credit_order.credit_id')
                ->join('orders', 'credit_order.order_id', '=', 'orders.order_id')
                ->join('order_product', 'orders.order_id', '=', 'order_product.order_id')
                ->join('products', 'order_product.product_id', '=', 'products.product_id')
                ->join('users', 'credit.user_id', '=', 'users.id')
                ->select('users.id', 'users.email', 'credit.credit_id', 'orders.created_at', 'orders.create_by', 'orders.order_id', 'orders.order_ref', 'products.product_id', 'products.product_name', 'products.price')
                ->whereBetween('orders.created_at', [$request['startdate'] . ' 00:00:00', $request['enddate'] . ' 23:59:59'])
                ->paginate(6);

            return view('admin/showhistoryadmin', [
                'history' => $history,
                'start' => $start,
                'end' => $end,
                'name' => $name,
            ]);

        } elseif ($request['startdate'] != null && $request['enddate'] != null && $request['name'] != null) {

            $start = $request['startdate'];
            $end = $request['enddate'];
            $name = $request['name'];

            $history = DB::table('credit')
                ->join('credit_order', 'credit.credit_id', '=', 'credit_order.credit_id')
                ->join('orders', 'credit_order.order_id', '=', 'orders.order_id')
                ->join('order_product', 'orders.order_id', '=', 'order_product.order_id')
                ->join('products', 'order_product.product_id', '=', 'products.product_id')
                ->join('users', 'credit.user_id', '=', 'users.id')
                ->select('users.id', 'users.email', 'credit.credit_id', 'orders.created_at', 'orders.create_by', 'orders.order_id', 'orders.order_ref', 'products.product_id', 'products.product_name', 'products.price')
                ->whereBetween('orders.created_at', [$request['startdate'] . ' 00:00:00', $request['enddate'] . ' 23:59:59'])
                ->where(function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->name . '%')
                        ->orWhere('email', 'LIKE', '%' . $request->name . '%')
                        ->orWhere('orders.order_id', 'LIKE', '%' . $request->name . '%')
                        ->orWhere('product_name', 'LIKE', '%' . $request->name . '%');
                })
                ->paginate(6);

            return view('admin/showhistoryadmin', [
                'history' => $history,
                'start' => $start,
                'end' => $end,
                'name' => $name,
            ]);

        } elseif ($request['startdate'] == null && $request['enddate'] == null && $request['name'] != null) {

            $start = $request['startdate'];
            $end = $request['enddate'];
            $name = $request['name'];

            $history = DB::table('credit')
                ->join('credit_order', 'credit.credit_id', '=', 'credit_order.credit_id')
                ->join('orders', 'credit_order.order_id', '=', 'orders.order_id')
                ->join('order_product', 'orders.order_id', '=', 'order_product.order_id')
                ->join('products', 'order_product.product_id', '=', 'products.product_id')
                ->join('users', 'credit.user_id', '=', 'users.id')
                ->select('users.id', 'users.email', 'credit.credit_id', 'orders.created_at', 'orders.create_by', 'orders.order_id', 'orders.order_ref', 'products.product_id', 'products.product_name', 'products.price')
                ->where(function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->name . '%')
                        ->orWhere('email', 'LIKE', '%' . $request->name . '%')
                        ->orWhere('orders.order_id', 'LIKE', '%' . $request->name . '%')
                        ->orWhere('product_name', 'LIKE', '%' . $request->name . '%');
                })
                ->orderBy('order_id', 'DESC')
                ->paginate(6);

            return view('admin/showhistoryadmin', [
                'history' => $history,
                'start' => $start,
                'end' => $end,
                'name' => $name,
            ]);

        } else {

            $start = $request['startdate'];
            $end = $request['enddate'];
            $name = $request['name'];

            $history = DB::table('credit')
                ->join('credit_order', 'credit.credit_id', '=', 'credit_order.credit_id')
                ->join('orders', 'credit_order.order_id', '=', 'orders.order_id')
                ->join('order_product', 'orders.order_id', '=', 'order_product.order_id')
                ->join('products', 'order_product.product_id', '=', 'products.product_id')
                ->join('users', 'credit.user_id', '=', 'users.id')
                ->select('users.id', 'users.email', 'credit.credit_id', 'orders.created_at', 'orders.create_by', 'orders.order_id', 'orders.order_ref', 'products.product_id', 'products.product_name', 'products.price')
                ->paginate(6);

            return view('admin/showhistoryadmin', [
                'history' => $history,
                'start' => $start,
                'end' => $end,
                'name' => $name,
            ]);

        }
    }
    public function exporttoexcel()
    {
        return Excel::download(new orderExport, 'orderExport.xlsx');
    }

    public function exportresellertoexcel()
    {
        return Excel::download(new resellerExport, 'resellerExport.xlsx');
    }

    public function exportrehiscredittoexcel()
    {
        return Excel::download(new creditExport, 'historycreditExport.xlsx');
    }
}
