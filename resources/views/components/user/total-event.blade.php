<li class="nav-item">
  <a class="nav-link" href="{{ route('events.index') }}">
      Events
      <span class="badge badge-success badge-pill">
        {{ $totalEvents ?? 0 }}
      </span>
  </a>
</li>