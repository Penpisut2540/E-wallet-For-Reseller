<?php

namespace App\Exports;

use App\Order;
use App\Product;
use App\Orderproduct;
use DB;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\withHeadings;
class creditExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $hiscredit = DB::table('history_credit')
                    ->join('credit', 'history_credit.credit_id', '=', 'credit.credit_id')
                    ->join('users', 'credit.user_id', '=', 'users.id')
                    ->select('history_credit.credit_id', 'users.id', 'users.name', 'users.surname', 'history_credit.topup', 'history_credit.pay', 'history_credit.change', 'history_credit.created_at', 'history_credit.typeCreate')
                    ->orderBy('history_credit.created_at', 'ASC')
                    ->get();

        return $hiscredit;
    }

    public function headings(): array
    {
        return [
            'CREDIT ID',
            'USER ID',
            'NAME',
            'SERNAME',
            'TOPUP',
            'PAY',
            'CHANGE',
            'CREATED AT',
            'TYPE CREATED'
        ];
    }
}
