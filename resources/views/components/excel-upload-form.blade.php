<form action="{{url('users/import/user-xlsx')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="type" value="{{$type}}">
    <div class="form-group">
        <input type="file" name="file">
    </div>
    <button type="submit" class="btn btn-default btn-xs"><i class="material-icons">backup</i> @lang('Upload')</button>
</form>
