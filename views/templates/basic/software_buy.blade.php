@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="all-sections pt-60">
    <div class="container-fluid p-max-sm-0">
        <div class="sections-wrapper d-flex flex-wrap justify-content-center">
            <article class="main-section">
                <div class="section-inner">
                    <div class="item-section">
                        <div class="container">
                            <div class="row justify-content-center mb-30-none">
                                <div class="col-xl-9 col-lg-9 mb-30">
                                    <div class="item-details-area">
                                        <div class="item-card-wrapper border-0 p-0 list-view">
                                            @if($software->product_type==1)
                                            
                                            @foreach($software->verities as $verity)
                                            <div class="item-card">
                                                <div class="item-card-content">
                                                    <div class="item-card-content-top">
                                                        <div class="left">
                                                            <input type="hidden" id="verity_id" value="{{$verity->id}}" />
                                                            <div class="author-content">
                                                                <input type="checkbox" id="prd_vrt_{{$verity->id}}" name="prd_vrt" value="{{$verity->id}}" style="margin-left: -400px;margin-top: 6px;position: absolute;">
                                                                <span style="width:400px;" id="prd_name_{{$verity->id}}">{{ $verity->name }}</span>
                                                                <span style="color:#2cdd9b;">{{ $verity->inventory}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="right flex-wrap align-items-center">
                                                            <div class="item-tags order-3" style="margin-top:0px;">
                                                                <button id="my-button_{{$verity->id}}" onclick="less({{$verity->id}})">-</button>
                                                                <p id="count_{{$verity->id}}">1</p>
                                                                <button id="my-button2_{{$verity->id}}" onclick="more({{$verity->id}},{{$verity->inventory}})">+</button>
                                                                <div class="item-amount" id="price_{{$verity->id}}">{{$general->cur_sym}}{{showAmount($software->amount)}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                           
                                            @endforeach
                                            <div class="item-tags order-3" style="margin-top:0px;">
                                                    <a href="javascript:void(0)">Return</a>
                                                    <a href="javascript:void(0)">Free Delivery</a>
                                                    <a href="javascript:void(0)">Supplier Delivery</a>
                                            </div>
                                            
                                            <div class="form order-4 mt-5">
                                                <form class="buyer-details-form" method="post" action="">
                                                @csrf                               
                                                    <div class="row justify-content-center mb-10-none">
                                                        <div class="col-lg-12 col-md-12 form-group">
                                                            <label for="fullname">Full Name</label>
                                                            <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Enter name" required="">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label for="fullname">Brand</label>
                                                            <input type="text" name="brand" id="brand" class="form-control" placeholder="Enter brand" required="required">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label for="fullname">Mobile</label>
                                                            <div class="input-group country-code">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text mobile-code">
                                                                        
                                                                    </span>
                                                                    <input type="hidden" name="mobile_code">
                                                                    <input type="hidden" name="country_code">
                                                                </div>
                                                                <input type="number" name="mobile" id="mobile" value="" class="form-control form--control checkUser" placeholder="@lang('Your Phone Number')">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label for="fullname">Shipping Type</label>
                                                            <select name="shipping_type" id="shipping_type" class="form-control" required="required">
                                                            @foreach($shippingTypes as $type)
                                                                <option value="{{ $type }}" {{($type!='Self Shipping') ? 'disabled' : '' }} {{ ($type==$software->shipping_type) ? 'selected' : '' }}>{{ $type}}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 form-group" >
                                                            <label for="fullname">Country</label>
                                                            <select name="country" id="country" class="form-control" required="required">
                                                            @foreach($countries as $key => $country)
                                                                @if(in_array($country->country,explode(',',$software->available_in_country)))
                                                                <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}" data-code="{{ $key }}">{{ __($country->country) }}</option>
                                                                @endif
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label for="fullname">City</label>
                                                            <input type="text" name="city" id="city" class="form-control" placeholder="Enter City Name" required="required">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label for="fullname">Address(Stree - Building - Appartment)</label>
                                                            <input type="text" name="address"  id="address" class="form-control" placeholder="Enter address" required="required">
                                                        </div>
                                                        <div class="col-lg-12 form-group">
                                                            <label for="fullname">Notes to the Delivery Person</label>
                                                            <textarea name="notes" id="notes" ></textarea>
                                                        </div>
                                                        
                                                    </div>
                                                </form>
                                            </div>
                                            @else
                                            <div class="item-card">
                                                <div class="item-card-thumb">
                                                    <img src="{{getImage('assets/images/software/'.$software->image, imagePath()['software']['size']) }}" alt="@lang('Product Image')">
                                                </div>
                                                <div class="item-card-content">
                                                    <div class="item-card-content-top">
                                                        <div class="left">
                                                            <div class="author-thumb">
                                                                  <img src="{{ userDefaultImage(imagePath()['profile']['user']['path'].'/'. $software->user->image,'profile_image') }}" alt="{{__($software->user->username)}}">
                                                            </div>
                                                            <div class="author-content">
                                                                <h5 class="name"><a href="{{route('profile', $software->user->username)}}">{{__($software->user->username)}}</a> <span class="level-text"> {{__(@$software->user->rank->label)}}</span></h5>
                                                                <div class="ratings">
                                                                    <i class="fas fa-star"></i>
                                                                    <span class="rating me-2">{{__($software->rating)}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="right d-flex flex-wrap align-items-center">
                                                            <div class="item-amount">{{$general->cur_sym}}{{showAmount($software->amount)}}</div>
                                                        </div>
                                                    </div>
                                                    <h3 class="item-card-title"><a href="{{route('software.details', [slug($software->title), encrypt($software->id)])}}">{{__($software->title)}}</a></h3>
                                                </div>
                                                <div class="item-card-footer">
                                                    <div class="left">
                                                        <a href="javascript:void(0)" class="item-love me-2 loveHeartActionSoftware" data-softwareid="{{$software->id}}"><i class="fas fa-heart"></i> <span
                                                                class="give-love-amount">({{$software->favorite}})</span></a>
                                                        <a href="javascript:void(0)" class="item-like"><i class="las la-thumbs-up"></i> ({{$software->likes}})</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        @if($software->product_type!=1)
                                        <div class="product-desc mt-80">
                                            <div class="product-desc-content pt-0">
                                                @php echo $software->description @endphp
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 mb-30">
                                    <div class="sidebar">
                                        <div class="widget custom-widget mb-30">
                                            <h3 class="widget-title">@lang('Order Summary')</h3>
                                            <ul class="details-list">
                                                <li><span>@lang('Product Price') :</span> <span>{{$general->cur_sym}}{{getAmount($software->amount)}}</span>
                                                </li>
                                               
                                                <li><span>@lang('Subtotal') :</span> <span>{{$general->cur_sym}}{{getAmount($software->amount)}}</span>
                                                </li>

                                                <div id="discount">
                                                    
                                                </div>
                                                @if($software->product_type==1)
                                                <li><span>@lang('Shipping Charge') :</span> <span>{{$general->cur_sym}}{{getAmount($software->shipping_charge)}}</span>
                                                </li>
                                                @endif

                                            </ul>
                                            <div class="total-price-area d-flex flex-wrap align-items-center justify-content-between">
                                                <div class="left">
                                                    <h4 class="title">@lang('Total') :</h4>
                                                </div>
                                                <div class="right">
                                                    <h4 class="title">{{$general->cur_sym}}<span id="paymentPrice">{{getAmount($software->amount + $software->shipping_charge)}}</span></h4>
                                                </div>
                                            </div>
                                            @if($coupon)
                                                <form class="coupon-form mt-20">
                                                    <input type="text" class="form-control" id="couponCode" placeholder="@lang('Coupon Code')">
                                                    <button type="button" class="coupon-form-btn" id="couponApply"><i class="las la-angle-right"></i></button>
                                                </form>
                                            @endif
                                            <div class="widget-btn mt-20">
                                                @if($software->product_type==1)
                                                <a href="javascript:void(0)" id="real_checkout_btn" class="btn--base w-100"><i class="las la-sign-in-alt"></i> @lang('Checkout')</a>
                                                @else
                                                <a href="javascript:void(0)"  data-bs-toggle="modal" data-bs-target="#serviceModal" class="btn--base w-100"><i class="las la-sign-in-alt"></i> @lang('Checkout')</a>
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
@include($activeTemplate.'partials.end_ad')

<div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">@lang('Payment You Order')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('user.software.buy.store')}}">
                        @csrf
                            <input type="hidden" name="software_id" value="{{$software->id}}">
                            <div class="form-group">
                                <h5>@lang('How you want to pay')</h5>
                                <select class="form-control" name="payment">
                                    <option value="wallet">{{__($general->sitename)}} @lang('wallet')</option>
                                    <option value="checkout">@lang('Checkout')</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn--base" style="width:100%;">@lang('Confirm')</button>
                            </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger btn-rounded text-white" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
        </div>
    </div>
</div>
<div class="modal fade" id="serviceModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">@lang('Confirm Your product and Payment options')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('user.software.buy.real')}}">
                        @csrf
                            <input type="hidden" name="software_id" value="{{$software->id}}">
                            <div class="form-group">
                                <ul class="details-list" id="list"></ul>
                                <ul class="details-list">
                                    <li>
                                        <span>@lang('Shipping Charge') :</span> 
                                        <span>{{$general->cur_sym}}{{getAmount($software->shipping_charge)}}</span>
                                    </li>
                                    <li>
                                        <span>@lang('Subtotal') :</span> 
                                        <span id="popup_total"></span>
                                    </li>
                                </ul>
                                 
                            </div>
                            <div class="form-group">
                                <h5>@lang('How you want to pay')</h5>
                                <select class="form-control" name="payment">
                                    <option value="wallet">{{__($general->sitename)}} @lang('wallet')</option>
                                    <option value="checkout">@lang('Checkout')</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn--base" style="width:100%;">@lang('Confirm')</button>
                            </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger btn-rounded text-white" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
        </div>
    </div>
</div>
@endsection
@push('style')
<style>
    #count {
  display: inline;
  margin: 15px;
}
</style>
@endpush
@push('script')
<script>
    'use strict';
    $("#couponApply").on("click", function(){
        var couponCode = $("#couponCode").val();
        var softwareId = {{$software->id}};
        if(couponCode)
        {
            $.ajax({
                type:"GET",
                url:"{{route('user.software.coupon.apply')}}",
                data : {couponCode : couponCode, softwareId: softwareId}, 
                success:function(response){
                    if(response.error){
                        notify('error', response.error)
                    }else{
                        notify('success',response.success);
                        $("#discount").html(`
                            <li>
                              <span>Discount (${response.code})</span>
                              <span>{{$general->cur_sym}}${parseFloat(response.amount.toFixed(8))}</span>
                            </li>
                            `)
                        var discountAmount = response.amount;
                        var shipping_charge = @php echo ($software->shipping_charge) ?? 0; @endphp;
                        var totalPrice = $("#paymentPrice").text();
                        var final = parseFloat(totalPrice) - parseFloat(discountAmount) + parseFloat(shipping_charge);
                        $("#paymentPrice").text(`${parseFloat(final.toFixed(8))}`);
                    }
                }
            });
        }
        else{
            notify('error', "Please Enter Coupon Code");
        }
    });

    $("#real_checkout_btn").on("click",function (){
        var prd_vrt = $("#prd_vrt").prop('checked'); 
        var verity = []; 
        var qty = [];
        var price = [];
        var pname = [];
        $("input:checkbox[name=prd_vrt]:checked").each(function(){
            var id = $(this).val();
            verity.push($(this).val());
            qty.push($("#count_"+id).html());
            price.push($("#price_"+id).html().replace("$", ""));
            pname.push($("#prd_name_"+id).text());
        });
        var fullname = $("#fullname").val();
        var brand = $("#brand").val();
        var mobile = $("#mobile").val();
        var shipping_type = $("#shipping_type").val();
        var country = $("#country").val();
        var city = $("#city").val();
        var address = $("#address").val();
        var notes = $("#notes").val();
        $('#fullname').css('border-color', '#e1e7ec');
        $('#brand').css('border-color', '#e1e7ec');
        $('#mobile').css('border-color', '#e1e7ec');
        $('#shipping_type').css('border-color', '#e1e7ec');
        $('#country').css('border-color', '#e1e7ec');
        $('#city').css('border-color', '#e1e7ec');
        $('#address').css('border-color', '#e1e7ec');
        $('#notes').css('border-color', '#e1e7ec');
        
        if(verity.length==0){
            alert("Please select at least one product");
        }else
        if(fullname.length==0){
            $("#fullname").focus();
            $('#fullname').css('border-color', 'red');
        }else
        if(brand.length==0){
            $("#brand").focus();
            $('#brand').css('border-color', 'red');
        }else
        if(mobile.length==0){
            $("#mobile").focus();
            $('#mobile').css('border-color', 'red');
        }else
        if(shipping_type.length==0){
            $("#shipping_type").focus();
            $('#shipping_type').css('border-color', 'red');
        }else
        if(country.length==0){
            $("#country").focus();
            $('#country').css('border-color', 'red');
        }else
        if(city.length==0){
            $("#city").focus();
            $('#city').css('border-color', 'red');
        }else
        if(address.length==0){
            $("#address").focus();
            $('#address').css('border-color', 'red');
        }else
        if(notes.length==0){
            $("#notes").focus();
            $('#notes').css('border-color', 'red');
        }else{
            
            var licount = qty.length;
            var totalPrice = 0;
            for (var i = 0; i < licount; i++) {
                var prd_qty = qty[i];
                var prd_name = pname[i];
                var prd_price = price[i];
                var total_price = parseInt(prd_qty)*parseFloat(prd_price);
                totalPrice+=total_price;
                $("#list").append("<input type='hidden' name='ids[]' value='"+verity[i]+"' /><input type='hidden' name='qtys[]' value='"+qty[i]+"' /><li><span>@lang('"+prd_name+"') :</span> <span>"+prd_qty+" x "+prd_price+"</span><span>{{$general->cur_sym}}"+total_price+"</span></li>");
            }
            var shipping_charge = @php echo ($software->shipping_charge) ?? 0; @endphp;
            var final = parseFloat(totalPrice) + parseFloat(shipping_charge);
            $("#popup_total").text('$'+parseFloat(final.toFixed(8)));
            $("#serviceModal2").modal('show');
        }
    });
    

    $('select[name=country]').change(function(){
        $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
        $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
        $('.mobile-code').text('+'+$('select[name=country] :selected').data('mobile_code'));
    });
    $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
    $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
    $('.mobile-code').text('+'+$('select[name=country] :selected').data('mobile_code'));

    function less(id){
        var count = $("#count_"+id).text();
        count--
        
        if(count <= 1){
            count++
            $("#my-button_"+id).prop('disabled', true);
            $("#my-button2_"+id).prop('disabled', false);
        }else{
            $("#my-button_"+id).prop('disabled', false);
            $("#my-button2_"+id).prop('disabled', false);
        }
        $("#count_"+id).text(count);
    }

    function more(id,max){
        var count = $("#count_"+id).text();
        count++
        $("#count_"+id).text(count);
        $("#my-button2_"+id).prop('disabled', false);
        if(count==max){
            $("#my-button_"+id).prop('disabled', false);
            $("#my-button2_"+id).prop('disabled', true);
        }else{
            $("#my-button_"+id).prop('disabled', false);
        }
    }
</script>
@endpush