@extends('layouts.admin')

@section('title')
    <i class="fas fa-calendar-alt"></i> Event edit
@endsection

@section('subtitle', 'Edit')

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-content">
            <form id="event-update-form" action="{{ route('admin.events.update', ['event' => $event->id]) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group">
                    <label for="question">Title</label>
                    <input type="text" name="title" class="form-control input-lg{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title', $event->title) }}">
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="answer">Content</label>
                    <textarea name="content" id="editor">{{ old('body', $event->content) }}</textarea>
                </div>
                
                <div class="form-group">
                    @if ($event->flyer)
                        <img src="/{{ $event->flyer }}" height="100">
                    @endif
                    <label for="file">Image</label>
                    <input name="flyer" type="file" accept="image/*">
                </div>
                
                <div class="form-group">
                    <a class="btn btn-danger" href="{{ route('admin.events.index') }}"><i class="fas fa-times-circle"></i> Cancel</a>
                    <button type="submit" form="event-update-form" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection()

@section('script')
    @include('admin._summernote')
@endsection