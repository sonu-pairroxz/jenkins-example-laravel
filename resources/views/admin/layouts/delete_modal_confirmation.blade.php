<div class="modal-header">
    <h4 class="title" id="smallModalLabel">{{$model}}</h4>
</div>
<div class="modal-body">
    @if($error)
        <div>{!! $error !!}</div>
    @else
        Are you sure to delete this Record?
    @endif
</div>
<div class="modal-footer">
    @if(!$error)
        <a href="{{ $confirm_route }}" type="button" class="btn btn-primary">Confirm</a>
    @endif
    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
</div>