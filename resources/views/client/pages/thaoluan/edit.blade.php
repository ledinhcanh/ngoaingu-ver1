@extends('client.pages.thaoluan')
@section('thaoluan')


<form action="{{ route('thaoluan.update',$thaoluan->id) }}" method="POST" role="form" enctype="multipart/form-data">
    @csrf
    <div class="modal-header">
        <h4 class="modal-title">Cập nhật bài thảo luận</h4>
    </div>
    <div class="modal-body">

        <div class="form-group">
            <label for="">Tiêu đề</label>
            <input name="title" type="text" class="form-control" id="title-add" placeholder="Nhập tiêu đề" value="{{ $thaoluan->title }}">
            @if($errors->has('title'))
            <div class="text-danger">{{ $errors->first('title') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="tag">Tags</label>
            <select name="tags[]" multiple id="tag" class="form-control" style="height: 100px !important;">
                @foreach($tags as $tag)
                <option 
                {{ $list->contains($tag->id) ? 'selected' : '' }}
                value="{{ $tag->id}}">{{$tag->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Nội dung</label>
            <textarea id="my-editor" name="content" cols="5" rows="5" class="form-control">{{ $thaoluan->content }}</textarea>
            @if($errors->has('content'))
            <div class="text-danger">{{ $errors->first('content') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="image">File</label>
            <div style="padding-bottom: 12px;">{{ $thaoluan->file }}</div>
            <input type="file" name="file">
            @if($errors->has('file'))
            <div class="text-danger">{{ $errors->first('file') }}</div>
            @endif
        </div>
    </div>
    <hr style="margin: 0">
    <div class="modal-footer" style="float: left;border-top: none;">
        <a href="{{ route('thaoluan.index') }}" class="btn btn-primary" style="border-radius: 4px;"><i class="fa fa-arrow-left"
                aria-hidden="true"></i> Trở về</a>
        <button type="submit" class="btn btn-success" style="border-radius: 4px;"><i class="fa fa-save"></i> Lưu</button>
    </div>
</form>
@endsection
@section('script')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
  var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
</script>
<script>
  if($("textarea").length > 0){
      CKEDITOR.replace('my-editor', options);
  }
</script>
@endsection