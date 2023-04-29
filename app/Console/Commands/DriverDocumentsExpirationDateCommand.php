<?php

namespace App\Console\Commands;

use App\Enums\DriverType;
use App\Services\NotifyService;
use Illuminate\Console\Command;
use ATPGroup\Drivers\Models\DriverDocument;

class DriverDocumentsExpirationDateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'driver:check-documents-expiration-date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'set is_expired true and, notify Admin before expiring data (30 days)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $daysNumber = DriverType::LICENSE_EXPIRED_AFTER_DAYS;
        DriverDocument::whereDate('expiration_date', '<=', now()->subDays($daysNumber)->format(config('helpers.dateFormat')))
            ->where('is_expired', false)
            ->whereHas('driver', function ($query) {
                return $query->active();
            })
            ->with('driver')
            ->chunk(500, function ($documents) use ($daysNumber) {
                $this->output->progressStart($documents->count());
                foreach ($documents as $document) {
                    $options = [
                        'document_type' => __('driver::language.field.documentType.' . $document->type),
                        'days_number' => $daysNumber,
                        'driver_name' => $document->driver->name_with_supplier,
                        'driver_phone' => $document->driver->mobile_number,
                    ];
                    app(NotifyService::class)->pushTypeNotify('driverDocumentIsExpired', $document, $options);

                    $document->is_expired = true;
                    $document->save();

                    $this->output->progressAdvance();
                }
                $this->output->progressFinish();
            });
    }
}
