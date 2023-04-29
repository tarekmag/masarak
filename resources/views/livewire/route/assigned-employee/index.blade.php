<div>
    @include('livewire.route.assigned-employee.create')

    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>{{ __('route::language.field.employee') }}</th>
                <th>{{ __('route::language.field.station') }}</th>
                <th>{{ __('partials.Settings') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employeesTable as $value)
                <tr>
                    <td>{!! optional($value->employee)->employee_name !!}</td>
                    <td>{{ optional($value->station)->name }}</td>
                    <td>
                        <button wire:click="deleteId({{ $value->id }})" class="btn btn-sm btn-outline-danger"
                            data-tooltip="tooltip" data-placement="top" title="{{ __('partials.Delete') }}"
                            data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">{{__('partials.YesDeleteIt')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{__('partials.AreYouSure')}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">{{__('partials.NoCancel')}}</button>
                    <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal"
                        data-dismiss="modal">{{__('partials.YesDeleteIt')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<x-message />
