@if (session()->has('message'))
<div class="col-12 mt-2">
    <div class="alert alert-{{ session('message')['class'] }} alert-dismissible fade show" role="alert">
        <strong>{{ session('message')['text'] }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif