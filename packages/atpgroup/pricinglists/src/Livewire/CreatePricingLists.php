<?php

namespace ATPGroup\PricingLists\Livewire;

use Livewire\Component;
use ATPGroup\Companies\Models\Company;
use ATPGroup\PricingLists\Models\PricingList;

class CreatePricingLists extends Component
{
    public $companies;
    public $company_id = [];
    public $station_from = [], $station_to = [];
    public $client_single_cost = [], $client_waiting_cost = [], $driver_single_cost = [], $driver_waiting_cost = [];
    public $inputs = [];
    public $i = 0;

    public function mount()
    {
        $this->companies = Company::parent()->get();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        return view('pricingList::livewire.pricing-list');
    }

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function savePricing()
    {
        foreach ($this->inputs as $input) {
            $this->validate([
                'company_id' => 'required|present|array',
                'station_from' => 'required|present|array',
                'station_to' => 'required|present|array',
                'client_single_cost' => 'required|present|array',
                'driver_single_cost' => 'required|present|array',
                'client_waiting_cost' => 'required|present|array',
                'driver_waiting_cost' => 'required|present|array',

                'company_id.' . $input => 'required|numeric|filled',
                'station_from.' . $input => 'required|filled',
                'station_to.' . $input => 'required|filled',
                'client_single_cost.' . $input => 'required|filled|regex:/^\d+(\.\d{1,2})?$/',
                'driver_single_cost.' . $input => 'required|filled|regex:/^\d+(\.\d{1,2})?$/',
                'client_waiting_cost.' . $input => 'required|filled|regex:/^\d+(\.\d{1,2})?$/',
                'driver_waiting_cost.' . $input => 'required|filled|regex:/^\d+(\.\d{1,2})?$/',
            ], [
                'company_id.required' => __('pricingList::language.validation.company_id.required'),
                'station_from.required' => __('pricingList::language.validation.station_from.required'),
                'station_to.required' => __('pricingList::language.validation.station_to.required'),
                'client_single_cost.required' => __('pricingList::language.validation.client_single_cost.required'),
                'driver_single_cost.required' => __('pricingList::language.validation.driver_single_cost.required'),
                'client_waiting_cost.required' => __('pricingList::language.validation.client_waiting_cost.required'),
                'driver_waiting_cost.required' => __('pricingList::language.validation.driver_waiting_cost.required'),

                'company_id.' . $input . '.required' => __('pricingList::language.validation.company_id.required'),
                'station_from.' . $input . '.required' => __('pricingList::language.validation.station_from.required'),
                'station_to.' . $input . '.required' => __('pricingList::language.validation.station_to.required'),
                'client_single_cost.' . $input . '.required' => __('pricingList::language.validation.client_single_cost.required'),
                'driver_single_cost.' . $input . '.required' => __('pricingList::language.validation.driver_single_cost.required'),
                'client_waiting_cost.' . $input . '.required' => __('pricingList::language.validation.client_waiting_cost.required'),
                'driver_waiting_cost.' . $input . '.required' => __('pricingList::language.validation.driver_waiting_cost.required'),
            ]);
        }

        $data = collect();
        foreach ($this->inputs as $key => $value) {
            $data->push([
                'company_id' => (isset($this->company_id[$value])) ? $this->company_id[$value] : '',
                'station_from' => (isset($this->station_from[$value])) ? $this->station_from[$value] : '',
                'station_to' => (isset($this->station_to[$value])) ? $this->station_to[$value] : '',
                'client_single_cost' => (isset($this->client_single_cost[$value])) ? $this->client_single_cost[$value] : '',
                'driver_single_cost' => (isset($this->driver_single_cost[$value])) ? $this->driver_single_cost[$value] : '',
                'client_waiting_cost' => (isset($this->client_waiting_cost[$value])) ? $this->client_waiting_cost[$value] : '',
                'driver_waiting_cost' => (isset($this->driver_waiting_cost[$value])) ? $this->driver_waiting_cost[$value] : '',
            ]);
        }

        PricingList::insert($data->toArray());

        session()->flash('message', __('pricingList::language.message.created'));

        $this->resetForm();
    }

    public function resetForm()
    {
        unset($this->inputs);
        $this->inputs = [];
        $this->company_id = '';
        $this->station_from = '';
        $this->station_to = '';
        $this->client_single_cost = '';
        $this->driver_single_cost = '';
        $this->client_waiting_cost = '';
        $this->driver_waiting_cost = '';
    }
}
