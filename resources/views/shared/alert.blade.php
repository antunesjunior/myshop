<div class="container-sm">
    <div class="row">
        <div class="col-8">
            <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
                @switch($type)
                    @case('success')
                        <i class="fas fa-check-circle"></i>
                        @break
                    @case('danger')
                        <i class="fas fa-times-circle"></i>
                        @break
                    @case('warning')
                        <i class="fas fa-exclamation-triangle"></i>
                        @break
                    @default
                        <i class="fas fa-exclamation-circle"></i>
                @endswitch
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>