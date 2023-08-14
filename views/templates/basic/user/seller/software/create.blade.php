@extends($activeTemplate.'layouts.master')
@section('content')
<section class="all-sections ptb-60">
    <div class="container-fluid">
        <div class="section-wrapper">
            <div class="row justify-content-center mb-30-none">
                @include($activeTemplate . 'partials.seller_sidebar')
                <div class="col-xl-9 col-lg-12 mb-30">
                    <div class="dashboard-sidebar-open"><i class="las la-bars"></i> @lang('Menu')</div>
                    <form class="user-profile-form" action="{{route('user.software.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card custom--card">
                            <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                                <h4 class="card-title mb-0">
                                    @lang('Add Product')
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="card-form-wrapper">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-12 col-lg-12 form-group">
                                            <label>@lang('Product Type')*</label>
                                            <select class="form-control bg--gray" name="product_type" id="product_type">
                                                    <option selected="" disabled="">@lang('Select Product Type')</option>
                                                @foreach($productTypes as $proType)
                                                    <option value="{{__($proType->id)}}">{{__($proType->name)}}</option>
                                                @endforeach
                                            </select>
                                            <p style="color: red;" id="product_type_empty"></p>    
                                        </div>
                                         
                                        <div class="col-xl-6 col-lg-6 form-group conditional-div">
                                            <div class="image-upload">
                                                <div class="thumb">
                                                    <div class="avatar-preview">
                                                        <div class="profilePicPreview bg_img" data-background="{{ getImage('/') }}">
                                                            <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="avatar-edit">
                                                        <input type="file" class="profilePicUpload" name="image" id="profilePicUpload2" accept=".png, .jpg, .jpeg"
                                                            required="">
                                                        <label for="profilePicUpload2" class="text-light">@lang('Image')</label>
                                                        <small>@lang('Supported files'): @lang('jpeg'), @lang('jpg'), @lang('png'). @lang('Image will be resized into 590x300 px')</small>
                                                        <p style="color: red;" id="image_empty"></p>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group conditional-div" id="screen_div" >
                                            <div class="card custom--card p-0 mb-3">
                                                <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                                                    <h4 class="card-title mb-0" id="screenshot_title">
                                                        @lang('Screenshot')
                                                    </h4>
                                                    <div class="card-btn">
                                                        <button type="button" class="btn--base addExtraImage"><i class="las la-plus"></i> @lang('Add New')</button>
                                                    </div>
                                                </div>
                                                <div class="card-body addImage">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="col-xl-12 col-lg-12 form-group conditional-div">
                                            <label>@lang('Title')*</label>
                                            <input type="text" name="title" id="title" maxlength="255" value="{{old('title')}}" class="form-control" placeholder="@lang("Enter Title")" required="">
                                            <p style="color: red;" id="title_empty"></p>  
                                        </div>
                                        
                                        <div class="col-xl-6 col-lg-6 form-group conditional-div">
                                            <label>@lang('Category')*</label>
                                            <select class="form-control bg--gray" name="category" id="category">
                                                    <option selected="" disabled="">@lang('Select Category')</option>
                                                @foreach($categorys as $category)
                                                    <option value="{{__($category->id)}}">{{__($category->name)}}</option>
                                                @endforeach
                                            </select>
                                            <p style="color: red;" id="category_empty"></p>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 form-group conditional-div">
                                            <label for="subCategorys">@lang('Sub Category')</label>
                                                <select name="subcategory" class="form-control mySubCatgry" id="subCategorys">
                                                </select>
                                             <p style="color: red;" id="subcategory_empty"></p>
                                        </div>
                                    
                                        <div class="col-xl-6 col-lg-6 form-group conditional-div">
                                            <label>@lang('Price')*</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="amount"  name="amount" value="{{old('amount')}}" placeholder="@lang('Enter Price')" required="">
                                            <span class="input-group-text" id="basic-addon2">{{__($general->cur_text)}}</span>
                                            <p style="color: red;" id="amount_empty"></p>
                                        </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group select2Tag">
                                            <p>Select any one input field from the list below.</p>
                                            <select id="mySelect" class="form-control " onchange="myField()">
                                                <option value="">Click to Select</option>
                                                <option value="tag">Tag</option>
                                                <option value="skill">Skill</option>
                                                <option value="file">File Include</option>
                                      
                                            </select>
                                            
                                    </div>    
                                                                            
                                    <div class="col-xl-6 col-lg-6 form-group select2Tag" id="tag" style="display: none;">
                                        <label>@lang('Tag')*</label>
                                        <select class="form-control select2" id="tag" name="tag[]"  required="">
                                            <option value="">Select Below</option>
                                             <option value="">Tag-1</option>
                                             <option value="">Tag-2</option>
                                             <option value="">Tag-3</option><br>

                                        </select>
                                        <small>@lang('Tag and enter press')</small>
                                        <p style="color: red;" id="tag_empty"></p>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 form-group conditional-div select2Tag" id="file_div"  style="display: none;">
                                        <label>@lang('File Include')*</label>
                                        <select class="form-control select2" id="file" name="file_include[]"  >
                                            <option value="">Select Below</option>
                                            <option value="">File-1</option>
                                            <option value="">File-2</option>
                                            <option value="">File-3</option><br>
                                       
                                        </select>
                                        <small>@lang('File and enter press')</small>
                                        <p style="color: red;" id="file_empty"></p>
                                    </div>
                                    
                                    <div class="col-xl-6 col-lg-6 form-group select2Tag" id="skill" style="display: none;">
                                        <label>@lang('Skill')*</label>
                                        <select class="form-control select2" name="skill[]" id="Skill"  required="">
                                             <option value="">Select Below</option>
                                             <option value="">Skill-1</option>
                                             <option value="">Skill-2</option>
                                             <option value="">Skill-3</option><br>
                                        </select>
                                        <small>@lang('Tag and enter press')</small>
                                        <p style="color: red;" id="skill_empty"></p>
                                    </div>


                                        <div class="col-xl-6 col-lg-6 form-group conditional-div" id="demo_div">
                                            <label>@lang('Demo Url')*</label>
                                            <input type="text" name="url" id="url" maxlength="255" value="{{old('url')}}" class="form-control" placeholder="@lang("Enter url")" >
                                            <small>@lang('https://example.com/')</small>
                                            <p style="color: red;" id="url_empty"></p>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group conditional-div" id="document_div">
                                            <label>@lang('Documentation File')*</label>
                                            <div class="custom-file-wrapper">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="document" id="customFile" >
                                                    <label class="custom-file-label" for="customFile">@lang('Choose file')</label>
                                                </div>
                                                <small>@lang('Supported file: only pdf file')</small>
                                                <p style="color: red;" id="document_empty"></p>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 form-group conditional-div" id="zip_div">
                                            <label>@lang('Add Product')*</label>
                                            <div class="custom-file-wrapper">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="uploadSoftware" id="uploadSoftware" >
                                                    <label class="custom-file-label" for="customFile">@lang('Choose file')</label>
                                                </div>
                                                <small>@lang('Supported file: only zip file')</small>
                                                <p style="color: red;" id="uploadSoftwaret_empty"></p>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 form-group conditional-div" id="verities_div" style="display:none;">
                                            <div class="card custom--card p-0 mb-3">
                                                <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                                                    <h4 class="card-title mb-0">
                                                        @lang('Product Verities(Verities in different size and color)')
                                                    </h4>
                                                    <div class="card-btn">
                                                        <button type="button" class="btn--base addExtraVerities"><i class="las la-plus"></i> @lang('Add New')</button>
                                                    </div>
                                                </div>
                                                <div class="card-body addVerities">
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 form-group conditional-div">
                                            <label>@lang('Description')*</label>
                                            <textarea class="form-control bg--gray nicEdit" id="description" name="description">{{old('description')}}</textarea>
                                            <p style="color: red;" id="description_empty"></p>
                                        </div>
                                         

                                        <div class="col-xl-12 form-group conditional-div">
                                            <button type="submit" onclick=" return check()" class="submit-btn mt-20 w-100">@lang('Add Product')</button>
                                        </div>
                                        
                                        <div id="coming_soon" style="display:none">
                                            <h4 class="card-title mb-0">
                                                @lang('Coming Soon...')
                                            </h4>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('style')
<style>
    .select2Tag input{
        background-color: transparent !important;
        padding: 0 !important;
    }
</style>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/select2.min.css')}}">
@endpush
@push('script-lib')
    <script src="{{asset($activeTemplateTrue.'frontend/js/select2.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/nicEdit.js')}}"></script>
@endpush


@push('script')
<script>
    "use strict";
    function proPicURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var preview = $(input).parents('.preview-thumb').find('.profilePicPreview');
                $(preview).css('background-image', 'url(' + e.target.result + ')');
                $(preview).addClass('has-image');
                $(preview).hide();
                $(preview).fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".profilePicUpload").on('change', function () {
        proPicURL(this);
    });

    
    $(document).ready(function() {
        $('.select2').select2({
            tags: true
        });
    });

    $(".remove-image").on('click', function () {
        $(".profilePicPreview").css('background-image', 'none');
        $(".profilePicPreview").removeClass('has-image');
    })

    $(document).on('click', '.removeBtn', function () {
        $(this).closest('.extraServiceRemove').remove();
    });

    $('.addExtraImage').on('click',function(){
        var html = `
                <div class="custom-file-wrapper removeImage">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="screenshot[]" id="customFile" required>
                        <label class="custom-file-label" for="customFile">@lang('Choose file')</label>
                    </div>
                    <button class="btn btn--danger text-white border--rounded removeExtraImage"><i class="fa fa-times"></i></button>
                </div>`;
        $('.addImage').append(html);
    });

    $(document).on('click', '.removeExtraImage', function (){
        $(this).closest('.removeImage').remove();
    });

    $('.addExtraVerities').on('click',function(){
        var html = `
                <div class="custom-file-wrapper removeVerities">
                    <div class="col-xl-7 col-lg-7">
                        <input type="text" name="product_name[]" maxlength="255" value="{{old('product_name')}}" class="form-control" placeholder="@lang("Product Name")" required="">
                    </div>
                    <div class="col-xl-3 col-lg-3">
                        <input type="text" name="inventory[]" maxlength="255" value="{{old('inventory')}}" class="form-control" placeholder="@lang("Inventory")" required="">
                    </div>
                    <div class="col-xl-2 col-lg-2">
                        <button class="btn btn--danger text-white border--rounded removeExtraVerities"><i class="fa fa-times"></i></button>
                    </div>
                </div>`;
        $('.addVerities').append(html);
    });

    $(document).on('click', '.removeExtraVerities', function (){
        $(this).closest('.removeVerities').remove();
    });

    bkLib.onDomLoaded(function() {
        $( ".nicEdit" ).each(function( index ) {
            $(this).attr("id","nicEditor"+index);
            new nicEditor({fullPanel : true}).panelInstance('nicEditor'+index,{hasPanel : true});
        });
    });

    (function($){
        $( document ).on('mouseover ', '.nicEdit-main,.nicEdit-panelContain',function(){
            $('.nicEdit-main').focus();
        });
    })(jQuery);


    $(document).on("change",".custom-file-input",function(){
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });


    $('#category').on('change', function(){
        var category = $(this).val();
        console.log(category);
            $.ajax({
                type:"GET",
                url:"{{route('user.category')}}",
                data: {category : category},
                success:function(data){
                    var html = '';
                    if(data.error){
                        $("#subCategorys").empty(); 
                        html += `<option value="" selected disabled>${data.error}</option>`;
                        $(".mySubCatgry").html(html);
                    }
                    else{
                        $("#subCategorys").empty(); 
                        html += `<option value="" selected disabled>@lang('Select Sub Category')</option>`;
                        $.each(data, function(index, item) {
                            html += `<option value="${item.id}">${item.name}</option>`;
                            $(".mySubCatgry").html(html);
                        });
                    }
                }
        });   
    });
    $('#product_type').on('change', function(){
        var product_type = $(this).val();
        console.log(product_type);
        if(product_type==1){
            $(".conditional-div").css("display", "block");
            $("#screenshot_title").text("Pictures and Media");
            $("#feature_div").css("display", "none");
            $("#tag_div").css("display", "none");
            $("#file_div").css("display", "none");
            $("#demo_div").css("display", "none");
            $("#document_div").css("display", "none");
            $("#zip_div").css("display", "none");
            $("#verities_div").css("display","block");
            $("#coming_soon").css("display", "none");
        }else if(product_type==2){
            $(".conditional-div").css("display", "block");
            $("#screenshot_title").text("Screenshot");
            $("#feature_div").css("display", "block");
            $("#tag_div").css("display", "block");
            $("#file_div").css("display", "block");
            $("#demo_div").css("display", "block");
            $("#document_div").css("display", "block");
            $("#zip_div").css("display", "block");
            $("#verities_div").css("display","none");
            $("#coming_soon").css("display", "none");
        }else if(product_type==3){
            $(".conditional-div").css("display", "none");
            $("#coming_soon").css("display", "block");
        }else if(product_type==4){
            $(".conditional-div").css("display", "none");
            $("#coming_soon").css("display", "block");
        }
            
    });

</script>
@endpush

@push('script')
<script>
    function myField() {
      var x = document.getElementById("mySelect").value;
          
      if (x == "tag") 
        {
            document.getElementById("tag").style.display = "block";
        }
        else
        {
            document.getElementById("tag").style.display = "none";
        }
        if (x == "skill")
        {
            document.getElementById("skill").style.display = "block";
        }
        else
        {
            document.getElementById("skill").style.display = "none";
        }
        if (x == "file")
        {
            document.getElementById("file_div").style.display = "block";
        }
        else
        {
            document.getElementById("file_div").style.display = "none";
        }
    } 
 </script>
      
    
 @endpush
 
 @push('script')
 <script>
    function check(){
var product_type = document.getElementById("product_type").value;           
var profilePicUpload2 = document.getElementById("profilePicUpload2").value; 
var title = document.getElementById('title').value;
var category = document.getElementById('category').value;
var subCategorys = document.getElementById('subCategorys').value;
var amount = document.getElementById('amount').value;
var url = document.getElementById('url').value;
var customFile = document.getElementById('customFile').value;
var uploadSoftware = document.getElementById('uploadSoftware').value;
var description = document.getElementById('description').value;

 
if (product_type == null || product_type == "") {
document.getElementById('product_empty').innerHTML = "* Product TYpe cant be left blank!";
return false
}
else if (profilePicUpload2 == null || profilePicUpload2 == "") {
document.getElementById('image_empty').innerHTML = "* Image cant be left blank!";
return false
}
else if (title == null || title == "") {
document.getElementById('title_empty').innerHTML = "* Title cant be left blank!";
return false
}
else if (category == null || category == "") {
document.getElementById('category_empty').innerHTML = "* Category cant be left blank!";
return false
}
else if (subCategorys == null || subCategorys == "") {
    document.getElementById('subcategory_empty').innerHTML = "*Sub Category cant be left blank!";
    return false
    }
else if (amount == null || amount == "") {
       document.getElementById('amount_empty').innerHTML = "* Amount cant be left blank!";
       return false
     }   

 else if (url == null || url == "") {
        document.getElementById('url_empty').innerHTML = "*URL cant be left blank!";
        return false
      }

 else if (customFile == null || customFile == "") {
        document.getElementById('document_empty').innerHTML = "*Document cant be left blank!";
        return false
      }
 else if (uploadSoftware == null || uploadSoftware == "") {
        document.getElementById('uploadSoftwaret_empty').innerHTML = "* File Upload  cant be left blank!";
        return false
      }
 else if (description == null || description == "") {
        document.getElementById('description_empty').innerHTML = "*Description cant be left blank!";
        return false
      }
     
}
</script>   
@endpush