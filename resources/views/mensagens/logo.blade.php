@if (count($errors) > 0)
@if ($errors->has('logomarca'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ $errors->first('logomarca') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@endif


                                    
                                    