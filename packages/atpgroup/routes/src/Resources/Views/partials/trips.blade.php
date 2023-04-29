<ul class="nav nav-tabs nav-top-border no-hover-bg">
  @foreach ($routeSchedules as $schedule)    
    <li class="nav-item">
      <a class="nav-link @if($loop->first) active @endif" id="base-tab-{{ $loop->index }}" data-toggle="tab" aria-controls="tab-{{ $loop->index }}" href="#tab-{{ $loop->index }}" aria-expanded="true">{{ Carbon\Carbon::parse($schedule->start_time)->format(config('helpers.timeFormat')) }}</a>
    </li>
  @endforeach

  <li class="nav-item">
    <a class="nav-link" id="base-tab-manual" data-toggle="tab" aria-controls="tab-manual" href="#tab-manual" aria-expanded="false">Manual</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" id="base-tab-modified" data-toggle="tab" aria-controls="tab-modified" href="#tab-modified" aria-expanded="false">Modified</a>
  </li>
</ul>
<div class="tab-content px-1 pt-1">
  @foreach ($routeSchedules as $schedule)
    <div role="tabpanel" class="tab-pane @if($loop->first) active @endif" id="tab-{{ $loop->index }}" aria-expanded="true" aria-labelledby="base-tab-{{ $loop->index }}">
      <livewire:trips-table :routeId="$route->id" :scheduleId="$schedule->id" />
    </div>
  @endforeach
  
  <div class="tab-pane" id="tab-manual" aria-labelledby="base-tab-manual">
    <livewire:trips-table :routeId="$route->id" :scheduleType="App\Enums\RouteType::SCHEDULE_MANUAL" />
  </div>

  <div class="tab-pane" id="tab-modified" aria-labelledby="base-tab-modified">
    <livewire:trips-table :routeId="$route->id" :scheduleType="App\Enums\RouteType::SCHEDULE_MODIFIED" />
  </div>
</div>