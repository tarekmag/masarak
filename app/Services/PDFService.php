<?php

namespace App\Services;

use Carbon\Carbon;
use PDF;

class PDFService
{
    /**
     * Export PDF File
     */
    public function export($fromDate, $toDate, $result, $viewPath, $filename = null)
    {
        if (!$filename) {
            $filename = now()->format('Y_m_d_h_i_A');
        }

        $data = [
            'user_name' => auth()->user()->name,
            'date' => now()->format(config('helpers.exportDateFormat')),
            'from_date' => Carbon::parse($fromDate)->format(config('helpers.exportDateFormat')),
            'to_date' => Carbon::parse($toDate)->format(config('helpers.exportDateFormat')),
            'total_trips' => count($result),
            'result' => $result
        ];

        $config = ['instanceConfigurator' => function ($mpdf) {
            $mpdf->SetAuthor('Transic App');
            $mpdf->SetTitle('Print PDF');
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->SetDirectionality('ltr');
        }, 'format' => 'A4-P'];

        $pdf = PDF::loadView($viewPath, $data, [], $config);

        // return $pdf->stream($filename . '.pdf');
        return $pdf->download($filename . '.pdf');
    }
}
