<li class="nav-item">
  <a class="nav-link" href="{{ route('events.index') }}">
      Event
      @if ($totalEvent)
        <span class="badge badge-success badge-pill">
          {{ $totalEvent}}
        </span>
      @endif
     
  </a>
</li>