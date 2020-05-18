<?php

namespace App\Http\Controllers\admin;

use App\Credit;
use App\Historycredit;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //--not use
    public function index()
    {
        return view('admin/managecreditbyadmin');
    }

    //--not use
    public function show()
    {
        $credit = DB::table('credit')
            ->join('users', 'credit.user_id', '=', 'users.id')
            ->orderBy('credit_id', 'ASC')
            ->paginate(4);

        return view('admin/managecreditbyadmin', [
            'credit' => $credit,
        ]);
    }

    //--not use
    public function insertCredit()
    {
        $user = DB::table('users')
            ->get();

        return view('admin/insertcreditbyadmin', [
            'user' => $user,
        ]);
    }

    //--not use
    public function delectCredit($id)
    {
        //dd($id);
        $credit = credit::find($id);
        $credit->delete();
        return redirect()->route('managecreditbyadmin')->with('status', 'Delete Credit Success');
    }

    //--not use
    public function storeCredit(Request $request)
    {
        if (credit::where('user_id', '=', $request['user_id'])->exists()) {
            return redirect()->back()->with('status', 'User have Credit ID !!');
        } else {
            credit::create([
                'create_by' => $request['create_by'],
                'update_by' => $request['create_by'],
                'after' => 0,
                'user_id' => $request['user_id'],
            ]);
            return redirect()->back()->with('status2', 'Create Credit Success');
        }
    }

    //--not use
    public function addmoneybyadmin($id)
    {
        return view('admin/addmoneybyadmin')->with('credit', credit::find($id));
    }

    // save add money by admin
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $credit = credit::find($id);

        $validator = Validator::make($request->all(), [
            'current' => ['required', 'integer', 'min:0'],
        ]);

        $current = $request['current'];
        $after = $credit->after;
        $name = Auth::user()->name;
        $surname = Auth::user()->surname;

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_code4', 4)->with('credit', $credit->credit_id);
        } else {
            $credit->update([
                'current' => (int) $current,
                'after' => ((int) $after + (int) $current),
                'before' => ((int) $after - (int) 'after'),
                'update_by' => $name . " " . $surname,
                'typeCreate' => "ADD",
            ]);

            historycredit::create([
                'topup' => (int) $current,
                'create_by' => $name . " " . $surname,
                'typeCreate' => "ADD",
                'credit_id' => $id,
            ]);

            return redirect()->back()->with('status', 'Add Money Success');
        }
    }

    //--not use
    public function searchcreditadmin(Request $request)
    {
        $credit = DB::table('credit')
            ->join('users', 'credit.user_id', '=', 'users.id')
            ->where('name', 'LIKE', '%' . $request->name . '%')
            ->orWhere('surname', 'LIKE', '%' . $request->name . '%')
            ->orderBy('history_credit.hiscredit_id', 'DESC')
            ->paginate(10);

        if (count($credit) > 0) {
            return view('admin/managecreditbyadmin', [
                'credit' => $credit,
            ]);
        } else {
            return redirect()->route('managecreditbyadmin')->with('status2', 'No Details found. Try to search again !');
        }
    }

    //ประวัติการใช้เงินทุก account
    public function showtopuppaycredit(Request $request)
    {
        if ($request['startdate'] == null && $request['enddate'] == null && $request['myselect'] != null && $request['name'] == null) {

            if ($request['myselect'] == 'all') {

                $start = $request['startdate'];
                $end = $request['enddate'];
                $select = $request['myselect'];
                $name = $request['name'];

                $hiscredit = DB::table('history_credit')
                    ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
                    ->join('users', 'credit.user_id', '=', 'users.id')
                    ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
                    ->orderBy('history_credit.created_at', 'DESC')
                    ->paginate(6);

                return view('admin/showtopuppaycredit', [
                    'hiscredit' => $hiscredit,
                    'start' => $start,
                    'end' => $end,
                    'name' => $name,
                    'select' => $request['myselect'],
                ]);

            } elseif ($request['myselect'] == 'green') {

                $start = $request['startdate'];
                $end = $request['enddate'];
                $select = $request['myselect'];
                $name = $request['name'];

                $hiscredit = DB::table('history_credit')
                    ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
                    ->join('users', 'credit.user_id', '=', 'users.id')
                    ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
                    ->where('history_credit.typeCreate', '=', 'ADD')
                    ->orderBy('history_credit.created_at', 'DESC')
                    ->paginate(6);

                return view('admin/showtopuppaycredit', [
                    'hiscredit' => $hiscredit,
                    'start' => $start,
                    'end' => $end,
                    'name' => $name,
                    'select' => $request['myselect'],
                ]);

            } elseif ($request['myselect'] == 'red') {

                $start = $request['startdate'];
                $end = $request['enddate'];
                $select = $request['myselect'];
                $name = $request['name'];

                $hiscredit = DB::table('history_credit')
                    ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
                    ->join('users', 'credit.user_id', '=', 'users.id')
                    ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
                    ->where('history_credit.typeCreate', '=', 'USED')
                    ->orderBy('history_credit.created_at', 'DESC')
                    ->paginate(6);

                return view('admin/showtopuppaycredit', [
                    'hiscredit' => $hiscredit,
                    'start' => $start,
                    'end' => $end,
                    'name' => $name,
                    'select' => $request['myselect'],
                ]);

            } elseif ($request['myselect'] == 'blue') {

                $start = $request['startdate'];
                $end = $request['enddate'];
                $select = $request['myselect'];
                $name = $request['name'];

                $hiscredit = DB::table('history_credit')
                    ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
                    ->join('users', 'credit.user_id', '=', 'users.id')
                    ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
                    ->where('history_credit.typeCreate', '=', 'CHENGE')
                    ->orderBy('history_credit.created_at', 'DESC')
                    ->paginate(6);

                return view('admin/showtopuppaycredit', [
                    'hiscredit' => $hiscredit,
                    'start' => $start,
                    'end' => $end,
                    'name' => $name,
                    'select' => $request['myselect'],
                ]);
            }

        } elseif ($request['startdate'] == null && $request['enddate'] == null && $request['myselect'] != null && $request['name'] != null) {

            $select = $request['myselect'];
            $start = $request['startdate'];
            $end = $request['enddate'];
            $name = $request['name'];

            //new
            if ($request['myselect'] == 'all') {

                $start = $request['startdate'];
                $end = $request['enddate'];
                $select = $request['myselect'];
                $name = $request['name'];

                $hiscredit = DB::table('history_credit')
                    ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
                    ->join('users', 'credit.user_id', '=', 'users.id')
                    ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
                    ->where(function ($q) use ($request) {
                        $q->where('name', 'LIKE', '%' . $request->name . '%')
                            ->orWhere('credit.credit_id', 'LIKE', '%' . $request->name . '%');
                    })
                    ->orderBy('history_credit.created_at', 'DESC')
                    ->paginate(6);

                return view('admin/showtopuppaycredit', [
                    'hiscredit' => $hiscredit,
                    'start' => $start,
                    'end' => $end,
                    'select' => $select,
                    'name' => $name,
                    'select' => $request['myselect'],
                ]);

            } elseif ($request['myselect'] == 'green') {

                $start = $request['startdate'];
                $end = $request['enddate'];
                $select = $request['myselect'];
                $name = $request['name'];

                $hiscredit = DB::table('history_credit')
                    ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
                    ->join('users', 'credit.user_id', '=', 'users.id')
                    ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
                    ->where('history_credit.typeCreate', '=', 'ADD')
                    ->where(function ($q) use ($request) {
                        $q->where('name', 'LIKE', '%' . $request->name . '%')
                            ->orWhere('credit.credit_id', 'LIKE', '%' . $request->name . '%');
                    })
                    ->orderBy('history_credit.created_at', 'DESC')
                    ->paginate(6);

                return view('admin/showtopuppaycredit', [
                    'hiscredit' => $hiscredit,
                    'start' => $start,
                    'end' => $end,
                    'select' => $select,
                    'name' => $name,
                    'select' => $request['myselect'],
                ]);

            } elseif ($request['myselect'] == 'red') {

                $start = $request['startdate'];
                $end = $request['enddate'];
                $select = $request['myselect'];
                $name = $request['name'];

                $hiscredit = DB::table('history_credit')
                    ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
                    ->join('users', 'credit.user_id', '=', 'users.id')
                    ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
                    ->where('history_credit.typeCreate', '=', 'USED')
                    ->where(function ($q) use ($request) {
                        $q->where('name', 'LIKE', '%' . $request->name . '%')
                            ->orWhere('credit.credit_id', 'LIKE', '%' . $request->name . '%');
                    })
                    ->orderBy('history_credit.created_at', 'DESC')
                    ->paginate(6);

                return view('admin/showtopuppaycredit', [
                    'hiscredit' => $hiscredit,
                    'start' => $start,
                    'end' => $end,
                    'select' => $select,
                    'name' => $name,
                    'select' => $request['myselect'],
                ]);

            } elseif ($request['myselect'] == 'blue') {

                $start = $request['startdate'];
                $end = $request['enddate'];
                $select = $request['myselect'];
                $name = $request['name'];

                $hiscredit = DB::table('history_credit')
                    ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
                    ->join('users', 'credit.user_id', '=', 'users.id')
                    ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
                    ->where('history_credit.typeCreate', '=', 'CHENGE')
                    ->where(function ($q) use ($request) {
                        $q->where('name', 'LIKE', '%' . $request->name . '%')
                            ->orWhere('credit.credit_id', 'LIKE', '%' . $request->name . '%');
                    })
                    ->orderBy('history_credit.created_at', 'DESC')
                    ->paginate(6);

                return view('admin/showtopuppaycredit', [
                    'hiscredit' => $hiscredit,
                    'start' => $start,
                    'end' => $end,
                    'select' => $select,
                    'name' => $name,
                    'select' => $request['myselect'],
                ]);
            }

        } elseif ($request['startdate'] != null && $request['enddate'] != null && $request['myselect'] != null && $request['name'] != null) {

            if ($request['myselect'] == 'all') {

                $start = $request['startdate'];
                $end = $request['enddate'];
                $select = $request['myselect'];
                $name = $request['name'];

                $hiscredit = DB::table('history_credit')
                    ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
                    ->join('users', 'credit.user_id', '=', 'users.id')
                    ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
                    ->whereBetween('history_credit.created_at', [$request['startdate'] . ' 00:00:00', $request['enddate'] . ' 23:59:59'])
                    ->where(function ($q) use ($request) {
                        $q->where('name', 'LIKE', '%' . $request->name . '%')
                            ->orWhere('credit.credit_id', 'LIKE', '%' . $request->name . '%');
                    })
                    ->orderBy('history_credit.created_at', 'DESC')
                    ->paginate(6);

                return view('admin/showtopuppaycredit', [
                    'hiscredit' => $hiscredit,
                    'start' => $start,
                    'end' => $end,
                    'select' => $select,
                    'name' => $name,
                    'select' => $request['myselect'],
                ]);

            } elseif ($request['myselect'] == 'green') {

                $start = $request['startdate'];
                $end = $request['enddate'];
                $select = $request['myselect'];
                $name = $request['name'];

                $hiscredit = DB::table('history_credit')
                    ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
                    ->join('users', 'credit.user_id', '=', 'users.id')
                    ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
                    ->where('history_credit.typeCreate', '=', 'ADD')
                    ->whereBetween('history_credit.created_at', [$request['startdate'] . ' 00:00:00', $request['enddate'] . ' 23:59:59'])
                    ->where(function ($q) use ($request) {
                        $q->where('name', 'LIKE', '%' . $request->name . '%')
                            ->orWhere('credit.credit_id', 'LIKE', '%' . $request->name . '%');
                    })
                    ->orderBy('history_credit.created_at', 'DESC')
                    ->paginate(6);

                return view('admin/showtopuppaycredit', [
                    'hiscredit' => $hiscredit,
                    'start' => $start,
                    'end' => $end,
                    'select' => $select,
                    'name' => $name,
                    'select' => $request['myselect'],
                ]);

            } elseif ($request['myselect'] == 'red') {

                $start = $request['startdate'];
                $end = $request['enddate'];
                $select = $request['myselect'];
                $name = $request['name'];

                $hiscredit = DB::table('history_credit')
                    ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
                    ->join('users', 'credit.user_id', '=', 'users.id')
                    ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
                    ->where('history_credit.typeCreate', '=', 'USED')
                    ->whereBetween('history_credit.created_at', [$request['startdate'] . ' 00:00:00', $request['enddate'] . ' 23:59:59'])
                    ->where(function ($q) use ($request) {
                        $q->where('name', 'LIKE', '%' . $request->name . '%')
                            ->orWhere('credit.credit_id', 'LIKE', '%' . $request->name . '%');
                    })
                    ->orderBy('history_credit.created_at', 'DESC')
                    ->paginate(6);

                return view('admin/showtopuppaycredit', [
                    'hiscredit' => $hiscredit,
                    'start' => $start,
                    'end' => $end,
                    'select' => $select,
                    'name' => $name,
                    'select' => $request['myselect'],
                ]);

            } elseif ($request['myselect'] == 'blue') {

                $start = $request['startdate'];
                $end = $request['enddate'];
                $select = $request['myselect'];
                $name = $request['name'];

                $hiscredit = DB::table('history_credit')
                    ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
                    ->join('users', 'credit.user_id', '=', 'users.id')
                    ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
                    ->where('history_credit.typeCreate', '=', 'CHENGE')
                    ->whereBetween('history_credit.created_at', [$request['startdate'] . ' 00:00:00', $request['enddate'] . ' 23:59:59'])
                    ->where(function ($q) use ($request) {
                        $q->where('name', 'LIKE', '%' . $request->name . '%')
                            ->orWhere('credit.credit_id', 'LIKE', '%' . $request->name . '%');
                    })
                    ->orderBy('history_credit.created_at', 'DESC')
                    ->paginate(6);

                return view('admin/showtopuppaycredit', [
                    'hiscredit' => $hiscredit,
                    'start' => $start,
                    'end' => $end,
                    'select' => $select,
                    'name' => $name,
                    'select' => $request['myselect'],
                ]);
            }

        } elseif ($request['startdate'] != null && $request['enddate'] != null && $request['myselect'] != null && $request['name'] == null) {

            if ($request['myselect'] == 'all') {

                $start = $request['startdate'];
                $end = $request['enddate'];
                $select = $request['myselect'];
                $name = $request['name'];

                $hiscredit = DB::table('history_credit')
                    ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
                    ->join('users', 'credit.user_id', '=', 'users.id')
                    ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
                    ->whereBetween('history_credit.created_at', [$request['startdate'] . ' 00:00:00', $request['enddate'] . ' 23:59:59'])
                    ->orderBy('history_credit.created_at', 'DESC')
                    ->paginate(6);

                return view('admin/showtopuppaycredit', [
                    'hiscredit' => $hiscredit,
                    'start' => $start,
                    'end' => $end,
                    'select' => $select,
                    'name' => $name,
                    'select' => $request['myselect'],
                ]);

            } elseif ($request['myselect'] == 'green') {

                $start = $request['startdate'];
                $end = $request['enddate'];
                $select = $request['myselect'];
                $name = $request['name'];

                $hiscredit = DB::table('history_credit')
                    ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
                    ->join('users', 'credit.user_id', '=', 'users.id')
                    ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
                    ->where('history_credit.typeCreate', '=', 'ADD')
                    ->whereBetween('history_credit.created_at', [$request['startdate'] . ' 00:00:00', $request['enddate'] . ' 23:59:59'])
                    ->orderBy('history_credit.created_at', 'DESC')
                    ->paginate(6);

                return view('admin/showtopuppaycredit', [
                    'hiscredit' => $hiscredit,
                    'start' => $start,
                    'end' => $end,
                    'select' => $select,
                    'name' => $name,
                    'select' => $request['myselect'],
                ]);

            } elseif ($request['myselect'] == 'red') {

                $start = $request['startdate'];
                $end = $request['enddate'];
                $select = $request['myselect'];
                $name = $request['name'];

                $hiscredit = DB::table('history_credit')
                    ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
                    ->join('users', 'credit.user_id', '=', 'users.id')
                    ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
                    ->where('history_credit.typeCreate', '=', 'USED')
                    ->whereBetween('history_credit.created_at', [$request['startdate'] . ' 00:00:00', $request['enddate'] . ' 23:59:59'])
                    ->orderBy('history_credit.created_at', 'DESC')
                    ->paginate(6);

                return view('admin/showtopuppaycredit', [
                    'hiscredit' => $hiscredit,
                    'start' => $start,
                    'end' => $end,
                    'select' => $select,
                    'name' => $name,
                    'select' => $request['myselect'],
                ]);

            } elseif ($request['myselect'] == 'blue') {

                $start = $request['startdate'];
                $end = $request['enddate'];
                $select = $request['myselect'];
                $name = $request['name'];

                $hiscredit = DB::table('history_credit')
                    ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
                    ->join('users', 'credit.user_id', '=', 'users.id')
                    ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
                    ->where('history_credit.typeCreate', '=', 'CHENGE')
                    ->whereBetween('history_credit.created_at', [$request['startdate'] . ' 00:00:00', $request['enddate'] . ' 23:59:59'])
                    ->orderBy('history_credit.created_at', 'DESC')
                    ->paginate(6);

                return view('admin/showtopuppaycredit', [
                    'hiscredit' => $hiscredit,
                    'start' => $start,
                    'end' => $end,
                    'select' => $select,
                    'name' => $name,
                    'select' => $request['myselect'],
                ]);
            }
        } else {

            $select = $request['myselect'];
            $start = $request['startdate'];
            $end = $request['enddate'];
            $name = $request['name'];

            $hiscredit = DB::table('history_credit')
                ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
                ->join('users', 'credit.user_id', '=', 'users.id')
                ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
                ->orderBy('history_credit.created_at', 'DESC')
                ->paginate(6);

            return view('admin/showtopuppaycredit', [
                'hiscredit' => $hiscredit,
                'start' => $start,
                'end' => $end,
                'select' => $select,
                'name' => $name,
                'select' => $request['myselect'],
            ]);
        }
    }

    //ประวัติการเติมเงินทุก account -- not use
    public function showtopuppaycreditadd()
    {
        $hiscredit = DB::table('history_credit')
            ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
            ->join('users', 'credit.user_id', '=', 'users.id')
            ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
            ->orderBy('history_credit.created_at', 'DESC')
            ->where('history_credit.typeCreate', '=', 'ADD')
            ->paginate(10);

        return view('admin/showtopuppaycreditadd', [
            'hiscredit' => $hiscredit,
        ]);
    }

    //ประวัติการใช้งานซื้อของเงินทุก account -- not use
    public function showtopuppaycredituse()
    {
        $hiscredit = DB::table('history_credit')
            ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
            ->join('users', 'credit.user_id', '=', 'users.id')
            ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
            ->orderBy('history_credit.created_at', 'DESC')
            ->where('history_credit.typeCreate', '=', 'USED')
            ->paginate(10);

        return view('admin/showtopuppaycredituse', [
            'hiscredit' => $hiscredit,
        ]);
    }

    //ประวัติการใช้ change เงินทุก account -- not use
    public function showtopuppaycreditchange()
    {
        $hiscredit = DB::table('history_credit')
            ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
            ->join('users', 'credit.user_id', '=', 'users.id')
            ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
            ->orderBy('history_credit.created_at', 'DESC')
            ->where('history_credit.typeCreate', '=', 'CHENGE')
            ->get();

        return view('admin/showtopuppaycreditchange', [
            'hiscredit' => $hiscredit,
        ]);
    }

    // search ประวัติการใช้เงิน --not use
    public function searchtopuppaycredit(Request $request)
    {

        $start = null;
        $end = null;
        $select = null;
        $name = $request['name'];

        $hiscredit = DB::table('history_credit')
            ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
            ->join('users', 'credit.user_id', '=', 'users.id')
            ->select('history_credit.create_by', 'history_credit.hiscredit_id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate', 'history_credit.credit_id')
            ->where('name', 'LIKE', '%' . $request->name . '%')
            ->orWhere('credit.credit_id', 'LIKE', '%' . $request->name . '%')
            ->orderBy('history_credit.hiscredit_id', 'DESC')
            ->orderBy('history_credit.created_at', 'DESC')
            ->get();

        return view('admin/showtopuppaycredit', [
            'hiscredit' => $hiscredit,
            'start' => $start,
            'end' => $end,
            'select' => $select,
            'name' => $name,
        ]);
    }

    //save change money
    public function savechangmoneybyadmin(Request $request, $id)
    {
        // dd($request->all());
        $credit = credit::find($id);

        $validator = Validator::make($request->all(), [
            'current' => ['required', 'integer', 'min:0'],
        ]);

        $current = $request['current'];
        $after = $credit->after;
        $name = Auth::user()->name;
        $surname = Auth::user()->surname;

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_code7', 7)->with('credit', $credit->credit_id);
        } else {
            if ($after >= $current) {
                $credit->update([
                    'current' => (int) $current,
                    'after' => ((int) $after - (int) $current),
                    'before' => ((int) $after),
                    'update_by' => $name . " " . $surname,
                    'typeCreate' => "CHENGE",
                ]);

                historycredit::create([
                    'change' => (int) $current,
                    'create_by' => $name . " " . $surname,
                    'typeCreate' => "CHENGE",
                    'credit_id' => $id,
                ]);
                return redirect()->back()->with('status', 'Change Money Success');
            } else {
                return redirect()->back()->with('alert', 2);
            }
        }
    }
}
