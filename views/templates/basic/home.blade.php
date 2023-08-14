@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="all-sections pt-60">
    <div class="container-fluid p-max-sm-0">
        <div class="sections-wrapper d-flex flex-wrap justify-content-center">
            <article class="main-section">
                <div class="section-inner">
                    <div class="item-section">
                        <div class="container">
                            <div class="item-top-area d-flex flex-wrap justify-content-between align-items-center">
                                <div style="display: none !important" class="item-wrapper d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="item-wrapper-left d-flex flex-wrap align-items-center">
                                        <div class="item-sorting">
                                            <form action="{{route('service.filter')}}" method="GET">
                                                <div class="input-group item-widget-select mb-0">
                                                    <select class="chosen-select" name="default" id="defaultSearch">
                                                        @if(@$filterSearch == "default")
                                                            <option value="default" selected>@lang('SORT BY') (@lang('DEFAULT'))</option>
                                                            <option value="priceHighToLow">@lang('Price') (@lang('high to low'))</option>
                                                            <option value="priceLowToHigh">@lang('Price') (@lang('low to high'))</option>
                                                            <option value="service">@lang('Service')</option>
                                                            <option value="software">@lang('Product')</option>
                                                            <option value="job">@lang('Job')</option>
                                                        @elseif(@$filterSearch == "priceHighToLow")
                                                            <option value="default">@lang('SORT BY') (@lang('DEFAULT'))</option>
                                                            <option value="priceHighToLow" selected>@lang('Price') (@lang('high to low'))</option>
                                                            <option value="priceLowToHigh">@lang('Price') (@lang('low to high'))</option>
                                                            <option value="service">@lang('Service')</option>
                                                            <option value="software">@lang('Product')</option>
                                                            <option value="job">@lang('Job')</option>
                                                        @elseif(@$filterSearch == "priceLowToHigh")
                                                            <option value="default">@lang('SORT BY') (@lang('DEFAULT'))</option>
                                                            <option value="priceHighToLow">@lang('Price') (@lang('high to low'))</option>
                                                            <option value="priceLowToHigh" selected>@lang('Price') (@lang('low to high'))</option>
                                                            <option value="service">@lang('Service')</option>
                                                            <option value="software">@lang('Product')</option>
                                                            <option value="job">@lang('Job')</option>
                                                        @else
                                                            <option value="default">@lang('SORT BY') (@lang('DEFAULT'))</option>
                                                            <option value="priceHighToLow">@lang('Price') (@lang('high to low'))</option>
                                                            <option value="priceLowToHigh">@lang('Price') (@lang('low to high'))</option>
                                                            <option value="service">@lang('Service')</option>
                                                            <option value="software">@lang('Product')</option>
                                                            <option value="job">@lang('Job')</option>
                                                        @endif
                                                    </select>
                                                    <button type="button" class="btn btn-toggle">
                                                        <i class="fas fa-caret-down"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="item-value">
                                            <span>@lang('Showing item'):&nbsp <span class="result">1 of {{$services->count()}}</span></span>
                                        </div>
                                    </div>
                                    <ul class="view-btn-list">
                                        <li><button type="button" class="grid-view-btn list-btn"><i class="lab la-buromobelexperte"></i></button></li>
                                        <li class="active"><button type="button" class="list-view-btn list-btn"><i class="las la-list"></i></button></li>
                                    </ul>
                                </div>
                                <div class="item-wrapper-right" style="">
                                    <form class="search-from" action="{{route('service.search')}}" method="GET">
                                    @csrf
                                        <input type="search" name="search" class="form-control" value="{{@$search}}" placeholder="@lang('Search here')..." autocomplete="off">
                                        <button type="submit"><i class="las la-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div id="main-data-section">
                               
                            </div>
                        
                            <div class="data-loding-loader" style="display: none;">@lang('loading')</div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
@include($activeTemplate.'partials.end_ad')
@endsection
@push('script')
    <script>
        'use strict';
        $('#defaultSearch').on('change', function(){
            this.form.submit();
        });
    </script>
    <script>
    let currentPage = 0;
    let isLoading = false;

    function loadMoreData(searchText = false) {
        if (isLoading) return;

        isLoading = true;
        $('.data-loding-loader').show();
        url = '{{ route('load-more-data') }}';
        if(searchText)
        url = url+'?searchText='+searchText;
        console.log(url)
        $.ajax({
            url: url,
            type: 'GET',
            data: { page: currentPage + 1 },
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    currentPage++;
                    $('#main-data-section').append(response.html);
                    $('.data-loding-loader').hide();
                } else {
                    // No more data to load
                    $(window).off('scroll', onScroll);
                     $('.data-loding-loader').hide();
                }
            },
            complete: function () {
                isLoading = false;
                $('.loading').hide();
            }
        });
    }

    function onScroll() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 200) {
            loadMoreData();
        }
    }

    $(document).ready(function () {
        loadMoreData();
        $(window).on('scroll', onScroll);
    });
</script>

@endpush

