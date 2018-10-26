@extends('layouts.admin')

@section('title')
    <i class="fas fa-star"></i> Campaigns
@endsection

@section('content')

    <div class="block block-rounded block-bordered">
        <div class="block-table">
            <table class="table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Goal</th>
                    <th>Raised</th>
                    <th class="text-center">Created</th>
                    <th class="text-center">Updated</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        {{ dd($item) }}
                        <td>{{ $item->first_name . ' ' . $item->last_name }}</td>
                        <td>${{ number_format($item->goal, 2, '.', ',') }}</td>
                        <td>${{ number_format($item->donations()->sum('amount'), 2, '.', ',') }}</td>
                        <td class="text-center">{{ $item->created_at }}</td>
                        <td class="text-center">{{ $item->updated_at }}</td>
                        <td class="text-right">
                            <a target="_blank" href="{{ route('campaign.show', ['campaign' => $item->slug]) }}"><i class="fas fa-eye"></i> </a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <div class="progress progress-mini" style="margin: 0">
                                @php
                                    $percent = (($item->donations()->sum('amount') / $item->goal) * 100);
                                    $color = 'danger';
                                    if ($percent > 33)  $color = 'warning';
                                    if ($percent >= 66) $color = 'success';

                                @endphp
                                <div class="progress-bar progress-bar-{{$color}}" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: {{ $percent }}%;"></div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection()
