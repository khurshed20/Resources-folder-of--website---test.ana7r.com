@extends($activeTemplate.'layouts.master')
@section('content')
<section class="all-sections ptb-60">
    <div class="container-fluid">
        <div class="section-wrapper">
            <div class="row justify-content-center mb-30-none">
                @include($activeTemplate . 'partials.seller_sidebar')
                <div class="col-xl-9 col-lg-12 mb-30">
                    <div class="dashboard-sidebar-open"><i class="las la-bars"></i> @lang('Menu')</div>
                    <div class="table-section">
                        <div class="row justify-content-center">
                            <div class="col-xl-12">
                                <div class="table-area">
                                    <div class="col-md-2">
                                        <a href="{{route('user.service.create')}}" class="btn btn-sm btn--success box--shadow1 text--small"style="background-color: #198754; color: #ffffff; border-radius: 5px; ><i class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
                                    </div>
                                    <table class="custom-table">
                                        <thead>
                                            <tr>
                                                <th>@lang('Title')</th>
                                                <th>@lang('Category')</th>
                                                <th>@lang('Amount')</th>
                                                <th>@lang('Delivery Time')</th>
                                                <th>@lang('Status')</th>
                                                <th>@lang('Last Update')</th>
                                                <th>@lang('Action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($services as $service)
                                                <tr>
                                                    <td data-label="@lang('Title')" class="text-start">
                                                        <div class="author-info">
                                                            <div class="thumb">
                                                                <img src="{{getImage('assets/images/service/'.$service->image,'590x300') }}" alt="@lang('Service Image')">
                                                            </div>
                                                            <div class="content">
                                                                @if($service->status==1)
                                                                <a href="{{route('service.details', [slug($service->title), encrypt($service->id)])}}" title="">{{__(str_limit($service->title, 30))}}</a>
                                                                @else
                                                                <a href="#" title="">{{__(str_limit($service->title, 30))}}</a>
                                                                @endif
                                                            </div>
                                                    </td>
                                                    <td data-label="@lang('Category')">{{__($service->category->name)}}</td>
                                                    <td data-label="@lang('Amount')">{{showAmount($service->price)}} {{$general->cur_text}}</td>
                                                    <td data-label="@lang('Delivery Time')">{{$service->delivery_time}} @lang('Days')</td>
                                                    <td data-label="@lang('Status')">
                                                        @if($service->status == 1)
                                                            <span class="badge badge--success">@lang('Approved')</span>
                                                            <br>
                                                            {{diffforhumans($service->created_at)}}
                                                        @elseif($service->status == 2)
                                                            <span class="badge badge--danger">@lang('Cancel')</span>
                                                            <br>
                                                            {{diffforhumans($service->created_at)}}
                                                        @else
                                                            <span class="badge badge--primary">@lang('Pending')</span>
                                                            <br>
                                                            {{diffforhumans($service->created_at)}}
                                                        @endif
                                                        </td>
                                                    <td data-label="@lang('Last Update')">
                                                        {{showDateTime($service->updated_at)}}
                                                        <br>
                                                        {{diffforhumans($service->updated_at)}}
                                                    </td>
                                                    <td data-label="Action">
                                                        <a href="{{route('user.service.edit', [$service->id, slug($service->title)])}}" class="btn btn--primary text-white"><i class="fa fa-pencil-alt"></i></a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="100%">{{ __($emptyMessage) }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    {{$services->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
