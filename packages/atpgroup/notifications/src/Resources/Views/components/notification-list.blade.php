<div>
  <li class="dropdown dropdown-notification nav-item">
      <a class="nav-link nav-link-label label-notify" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i>
          @if ($countUnRead)
          <span class="badge badge-pill badge-default badge-danger badge-default badge-up have-new-notify">{{$countUnRead}}</span>
          @endif
      </a>
      <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
          <li class="dropdown-menu-header">
              <h6 class="dropdown-header m-0">
                  <span class="grey darken-2">{{__('menu.Notifications')}}</span>
              </h6>
              @if ($countUnRead)
              <span class="notification-tag badge badge-default badge-danger float-right m-0 ">{{$countUnRead}}
                  {{__('notification::language.page.new')}}</span>
              @endif
          </li>
          <li class="scrollable-container media-list w-100 mt-1" id="notificationResult">

              @foreach ($result as $item)
              <a href="javascript:void(0)" class="markAsRead" data-id="{{$item['id']}}" data-data="{{$item['data']}}">
                  <div class="media @if($item['read_at'] == null) bg-grey @endif">
                      <div class="media-left align-self-center">
                          <i class="ft-plus-square icon-bg-circle bg-cyan"></i>
                      </div>
                      <div class="media-body">
                          <h6 class="media-heading">{{$item['title']}}</h6>
                          <p class="notification-text font-small-3 text-muted">{!! $item['body'] !!}</p>
                          <small class="left"><time datetime="2015-06-11T18:29:20+08:00"
                                  class="media-meta text-muted">{{$item['calculate_time']}}</time></small><br>
                      </div>
                  </div>
              </a>
              @endforeach

          <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center loadMoreNotify"
                  data-current-page="{{$currentPage}}"
                  href="javascript:void(0)">{{__('notification::language.page.loadMoreNotifications')}}</a></li>
  </li>
  </ul>
  </li>
</div>

@push('js')
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
$(document).ready(function(){
  $(document).on('click', '.markAsRead', function(e){
      e.preventDefault();
      e.stopPropagation();
      let _this = $(this);
      let notify_id = _this.data('id');
      let notify_data = _this.data('data');
      $.ajax({
          method: "POST",
          url: '{{route("notification.markAsRead")}}',
          dataType: 'json',
          data: {
              _token: "{{ csrf_token() }}",
              notify_id: notify_id
          },
          success: function (response)
          {
            if(response.status == 'ok')
            {
                _this.find('.media').removeClass('bg-grey');
                if(notify_data.route)
                {
                    window.location.href = notify_data.route;
                }
            }
          }
      });
  });

  $(".loadMoreNotify").on('click', function(e){
      e.preventDefault();
      e.stopPropagation();
      let _this = $(this);
      let currentPage = _this.data('current-page') +1;
      $.ajax({
          method: "GET",
          url: '{{route("notification.loadMoreNotify")}}',
          dataType: 'json',
          data: {
              page: currentPage
          },
          success: function (response)
          {
              if(response.status == 'ok'){
                  if(response.hasMorePages == false){
                      _this.closest('li').remove();
                  }
                  $.each(response.result, function(index, value){
                      let color = '';
                      if(value.read_at == null){
                          color = 'bg-grey';
                      }
                      $("#notificationResult").append('<a href="javascript:void(0)" class="markAsRead" data-id="'+value.id+'" data-data="'+value.data+'">\n\
                          <div class="media '+color+'">\n\
                              <div class="media-left align-self-center">\n\
                                  <i class="ft-plus-square icon-bg-circle bg-cyan"></i>\n\
                              </div>\n\
                              <div class="media-body">\n\
                                  <h6 class="media-heading">'+value.title+'</h6>\n\
                                  <p class="notification-text font-small-3 text-muted">'+value.body+'</p>\n\
                                  <small class="left"><time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">'+value.calculate_time+'</time></small><br>\n\
                              </div>\n\
                          </div>\n\
                      </a>');
                  });
              }
          }
      });
  });

//   function playNotificationsSound() {
//       let audio = new Audio('{{asset("notifications.mp3")}}');
//       let playPromise = audio.play();
//   }


  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = false;

  var pusher = new Pusher("{{env('PUSHER_APP_KEY')}}", {
      cluster: 'eu'
  });

  var channel = pusher.subscribe('channel-notification');
  channel.bind('event-notification', function(data) {
    data = JSON.stringify(data);
    item = jQuery.parseJSON(data);
    var user_id = "{{ auth()->id() }}";

    if(user_id != item.notify.user_id)
    {
        return false;
    }

    let countNotify = $(".have-new-notify").text();
    if(countNotify == undefined || countNotify == ''){
        countNotify = 0;
    }
    countNotify = parseInt(countNotify) + 1;
    $(".label-notify").html('<i class="ficon ft-bell"></i> <span class="badge badge-pill badge-default badge-danger badge-default badge-up have-new-notify">'+countNotify+'</span>');

    

    $("#notificationResult").prepend('<a href="javascript:void(0)" class="markAsRead" data-id="'+item.notify.id+'" data-data="'+item.notify.data+'">\n\
        <div class="media bg-grey">\n\
            <div class="media-left align-self-center">\n\
                <i class="ft-plus-square icon-bg-circle bg-cyan"></i>\n\
            </div>\n\
            <div class="media-body">\n\
                <h6 class="media-heading">'+item.notify.title+'</h6>\n\
                <p class="notification-text font-small-3 text-muted">'+item.notify.body+'</p>\n\
                <small class="left"><time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">'+item.notify.calculate_time+'</time></small><br>\n\
            </div>\n\
        </div>\n\
    </a>');
  });
});
</script>
@endpush
