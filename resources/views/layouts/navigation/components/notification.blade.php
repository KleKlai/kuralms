<li class="nav-item dropdown">
    <a class="nav-link count-indicator" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
      <i class="mdi mdi-bell-outline"></i>
      <span class="count">{{ auth()->user()->unreadNotifications->count() }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
        <a class="dropdown-item py-3">
            @if(auth()->user()->unreadNotifications->count() > 0)
            <a href="{{ route('markAllAsRead') }}" class="font-weight-medium float-left">
                <i class="mdi mdi-check"></i> Mark all as read
            </a>
            @else
            <p class="font-weight-medium float-left">You have {{ auth()->user()->unreadNotifications->count() }} unread notification. </p>
            @endif
        </a>
        {{--  <div class="dropdown-divider"></div>  --}}
        @forelse (auth()->user()->unreadNotifications as $notification)
            <a class="dropdown-item preview-item">
                <div class="preview-item-content flex-grow py-2">
                <p class="text-dark">{{ $notification->data['data'] }}</p>
                <p class="font-weight-light small-text">{{ $notification->created_at->diffForHumans() }}</p>
                </div>
            </a>
        @empty
            <a class="dropdown-item preview-item">
                <div class="preview-item-content flex-grow py-2">
                <p class="preview-subject ellipsis font-weight-medium text-dark">{{ "There's nothing here left here" }}</p>
                </div>
            </a>
        @endforelse
    </div>
</li>
