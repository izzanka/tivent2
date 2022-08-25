<li class="nav-item">
  <a class="nav-link" href="">
      Cart
      @if ($totalOrder)
        <span class="badge badge-success badge-pill">
          {{ $totalOrder }}
        </span>
      @endif
   
  </a>
</li>