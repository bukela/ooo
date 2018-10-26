@extends('layouts.admin')

@section('content')
    <div class="col-xs-6 col-lg-3">
        <a class="block block-link-hover1" href="{{ route('admin.users.index') }}">
            <div class="block-content block-content-full clearfix">
                <div class="pull-right push-15-t push-15">
                    <i class="fa fa-users fa-2x text-primary"></i>
                </div>
                <div class="h2 text-primary" data-toggle="countTo" data-to="{{ $users }}">{{ $users }}</div>
                <div class="text-uppercase font-w600 font-s12 text-muted">{{ str_plural('User', $users) }}</div>
            </div>
        </a>
    </div>
@endsection
