<div>
    <div class="table-responsive">
        <table class="table-striped table-bordered table">
            <thead>
                <tr>
                    @can('route.showTrip')
                        <th>#</th>
                    @endcan
                    <th>{{ __('route::language.field.tripTable.date') }}</th>
                    <th>{{ __('route::language.field.tripTable.driver') }}</th>
                    <th>{{ __('route::language.field.tripTable.vehicle') }}</th>
                    <th>{{ __('route::language.field.tripTable.vehicleType') }}</th>
                    <th>{{ __('route::language.field.tripTable.status') }}</th>
                    <th>{{ __('route::language.field.tripTable.capacity') }}</th>
                    <th>{{ __('route::language.field.tripTable.clientPrice') }}</th>
                    @if (auth()->user()->compant_id)
                        <th>{{ __('route::language.field.tripTable.driverPrice') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($trips as $row)
                    <tr>
                        @can('route.showTrip')
                            <td> <a href="{{ route('route.showTrip', $row->_id) }}">{{ $row->_id }}</a></td>
                        @endcan
                        <td>{{ $row->trip_date_time }}</td>
                        <td>{{ $row->driver['name'] }}</td>
                        <td>{{ $row->vehicle['plate_number'] }}</td>
                        <td>{{ $row->vehicle_type_with_model }}</td>
                        <td>
                            <x-route-trip-html-status :status="$row->status" />
                            <br />
                            <span class="text-danger">{{ $row->arrival_allowance_diff_time }}</span>
                        </td>
                        <td>{{ $row->capacity }}</td>
                        <td>{{ $row->client_price_formated }}</td>
                        @if (auth()->user()->compant_id)
                            <td>{{ $row->driver_price_formated }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $trips->links() }}
</div>
