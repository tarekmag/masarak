<label>{{ __('route::language.field.days') }} @if ($required) <span class="danger">*</span> @endif</label>

<div class="row skin skin-line">
    @foreach ($weekdays as $day)
        <div class="col-md-1">
            <input type="checkbox" class="weekdays" id="input-{{ $loop->index }}" name="{{ $name }}[]"
                value="{{ $day }}" {!! checked($day, $days) !!} >
            <label for="input-{{ $loop->index }}">{{ __('route::language.field.weekdays.' . $day) }}</label>
        </div>
    @endforeach
</div>

@push('js')
    <script>
        $(document).ready(function() {
        });
        icheckboxWeekDays();

        function icheckboxWeekDays() {
            $(".weekdays").each(function(index, row) {
                var checkInput = $(row).is(':checked');
                if (checkInput) {
                    $(row).closest('div').attr('class', 'icheckbox_line-green checked');
                } else {
                    $(row).closest('div').attr('class', 'icheckbox_line-red');
                }
            });


            $('.weekdays').on('ifChecked', function() {
                var me = $(this);
                me.closest('div').attr('class', 'icheckbox_line-green checked');
            });

            $('.weekdays').on('ifUnchecked', function() {
                var me = $(this);
                me.closest('div').attr('class', 'icheckbox_line-red');
            });
        }
    </script>
@endpush
