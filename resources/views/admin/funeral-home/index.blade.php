@extends('layouts.admin')

@section('title')
    <i class="fas fa-building"></i> Funeral Homes
@endsection

@section('content')
    <a id="import-funeral-homes" href="">Import From Excel</a>
    <input id="fh-excel" type="file" name="fh-excel" accept=".xlsx, .xls" style="display: none"/>
    
    <button style="display: none;" id="fh-import-modal" type="button" class="btn btn-primary" data-toggle="modal" data-target=".import-fh">Small modal</button>
    <div class="modal fade import-fh" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    
    <div class="block block-rounded block-bordered">
        <div class="block-table">
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact Name</th>
                    <th>Contact Email</th>
                    <th class="text-center">Created</th>
                    <th class="text-center">Updated</th>
                    {{--<th></th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>
                            @if ($item->user_id)
                                <i class="fas fa-briefcase"></i>&nbsp;
                            @endif
                            {{ $item->name }}
                        </td>
                        <td>{{ $item->contact_name }}</td>
                        <td>{{ $item->email }}</td>
                        <td class="text-center">{{ $item->created_at }}</td>
                        <td class="text-center">{{ $item->updated_at }}</td>
                        {{--<td class="text-right">--}}
                        {{--<a href=""><i class="fas fa-eye"></i> </a>--}}
                        {{--</td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $items->links() }}
@endsection
@push('stack-script')
    <script>
        var $importButton = $('#import-funeral-homes');
        var $fileInput = $('#fh-excel');
        var $modalButton = $('#fh-import-modal');
        $(document).ready(function (){
            
            $importButton.on('click', function (e){
                e.preventDefault();
                $fileInput.click();
            });
            
            $fileInput.on('change', function (e){
                var file = e.target.files[0];
                saveFile(file);
            });
        });
        
        function saveFile(file)
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            
            var data = new FormData();
            data.append('_token', CSRF_TOKEN);
            data.append('file', file);
            
            $.ajax({
                type: 'POST', url: '{!! route('admin.funeral-home.save-import-file') !!}', processData: false, contentType: false, data: data, success: function (response){
                    $modalButton.click();
                    readFile(response);
                }
            });
        }
        
        
        var file = {
            skipRows: 0, takeRows: 0
        };
        
        function readFile(path)
        {
            $.ajax({
                type: 'GET', url: '{!! route('admin.funeral-home.import') !!}', data: {
                    path: path, skipRows: file.skipRows, takeRows: file.takeRows
                }, success: function (response){
                    console.log(response);
                }
            });
        }
    </script>
@endpush

