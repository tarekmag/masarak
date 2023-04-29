<?php

namespace ATPGroup\Routes\Exports;

use App\Services\TripService;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TripExportExcel implements FromCollection, Responsable, WithHeadings, ShouldAutoSize
{
    use Exportable;

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'trip.xlsx';

    /**
     * Optional Writer Type
     */
    private $writerType = Excel::XLSX;

    /*
     * Optional headers
     */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    /**
     * Headings
     */
    public function headings(): array
    {
        return [
            'From Date',
            'To Date',
            'Route',
            'Riders',
            'Trip Date Time',
            'R-Q',
            'Price',
        ];
    }

    /**
     * Array
     */
    public function collection()
    {
        $request = request();
        return app(TripService::class)->exportQuery($request);
    }
}
