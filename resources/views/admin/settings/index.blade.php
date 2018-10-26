@extends('layouts.admin')

@section('title')
    <i class="fas fa-cogs"></i> Settings
@endsection
@section('subtitle', 'Edit')

@section('content')
    <form id="news-update-form" action="{{ route('admin.settings.store') }}" method="post">
        {{ csrf_field() }}
        <div class="col-md-12">
            <div class="block block-rounded block-bordered">
                <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs">
                    <li class="active">
                        <a href="#btabs-alt-static-site"><i class="fa fa-globe"></i> Site</a>
                    </li>
                    <li>
                        <a href="#btabs-alt-static-social"><i class="fa fa-share-square"></i> Social Media</a>
                    </li>
                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="btabs-alt-static-site">
                        <div class="form-group">
                            <label for="settings[site_title]">Site Title</label>
                            <input type="text" name="settings[site_title]" class="form-control" value="{{ old('settings[site_title]', $settings->get('site_title')) }}">
                        </div>

                        <div class="form-group">
                            <label for="settings[custom_script]">Custom JavaScript (eg: google analytics code)</label>
                            <textarea type="text" name="settings[custom_script]" class="form-control">{{ old('settings[custom_script]', $settings->get('custom_script')) }}</textarea>
                        </div>
                    </div>

                    <div class="tab-pane" id="btabs-alt-static-social">
                        <div class="form-group">
                            <label for="settings[facebook]">Facebook</label>
                            <input type="text" name="settings[facebook]" class="form-control" value="{{ old('settings[facebook]', $settings->get('facebook')) }}">
                        </div>

                        <div class="form-group">
                            <label for="settings[google_plus]">Google Plus</label>
                            <input type="text" name="settings[google_plus]" class="form-control" value="{{ old('settings[google_plus]', $settings->get('facebook')) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="block block-rounded block-bordered">
                <div class="block-content">
                    <div class="form-group">
                        <button type="submit" form="news-update-form" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection()
