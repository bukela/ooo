@extends('layouts.admin')

@section('title')
    <i class="fas fa-calendar-alt"></i> New Event
@endsection

@section('subtitle', 'Create')

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-content">
            <form id="events-create-form" action="{{ route('admin.events.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="question">Title</label>
                    <input type="text" name="title" class="form-control input-lg{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}">
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="answer">Content</label>
                    <textarea name="content" id="editor">{{ old('content') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="start_date">Start Date <i class="fas fa-calendar-alt"></i></label>
                    <div class="control">
                        <input class="date" name="start_date" type="date" placeholder="Start date"></input>
                    </div>
                </div>

                <div class="form-group">
                    <label for="file">Flyer</label>
                    <input name="flyer" type="file" accept="image/*">
                </div>


                <div class="form-group">
                    <a class="btn btn-danger" href="{{ route('admin.events.index') }}"><i class="fas fa-times-circle"></i> Cancel</a>
                    <button type="submit" form="events-create-form" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection()

@section('script')
    @include('admin._summernote')
@endsection
