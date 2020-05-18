<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\withHeadings;

class resellerExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $user = DB::table('credit')
            ->join('users', 'credit.user_id', '=', 'users.id')
            ->select('users.id', 'credit.credit_id', 'users.name', 'users.surname', 'users.tel', 'users.email', 'users.typeUser', 'users.created_at', 'credit.before', 'credit.current', 'credit.after')
            ->orderBy('users.id', 'ASC')
            ->get();
        return $user;
    }

    public function headings(): array
    {
        return [
            'USER ID',
            'CREDIT ID',
            'NAME',
            'SURNAME',
            'TEL',
            'EMAIL',
            'TYPE USER',
            'CREATED AT',
            'ก่อนเติมเงิน',
            'เติมล่าสุด',
            'ยอดเงินคงเหลือ',
        ];
    }
}
