@extends($activeTemplate.'layouts.master')
@section('content')
<section class="all-sections ptb-60">
    <div class="container-fluid">
        <div class="section-wrapper">
            <div class="row justify-content-center mb-30-none">
                @include($activeTemplate . 'partials.buyer_sidebar')
                <div class="col-xl-9 col-lg-12 mb-30">
                    <div class="dashboard-sidebar-open"><i class="las la-bars"></i> @lang('Menu')</div>
                    <form class="user-profile-form" action="{{route('user.job.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card custom--card">
                            <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                                <h4 class="card-title mb-0">
                                    {{__($pageTitle)}}
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="card-form-wrapper">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-12 col-lg-12 form-group">
                                            <label>@lang('Title')*</label>
                                            <input type="text" name="title" id="title" maxlength="255" value="{{old('title')}}" class="form-control" placeholder="@lang("Enter Title")" required="">
                                            <p style="color: red;" id="title_empty"></p>  
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group">
                                            <label>@lang('Category')*</label>
                                            <select class="form-control bg--gray" name="category" id="category" required="">
                                                    <option selected="" disabled="">@lang('Select Category')</option>
                                                @foreach($categorys as $category)
                                                    <option value="{{__($category->id)}}">{{__($category->name)}}</option>
                                                @endforeach
                                            </select>
                                            <p style="color: red;" id="category_empty"></p>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group">
                                            <label for="subCategorys">@lang('Sub Category')</label>
                                                <select name="subcategory" class="form-control mySubCatgry" id="subCategorys">
                                                </select>
                                                <p style="color: red;" id="subcategory_empty"></p>
                                        </div>

                                       
                                        <div class="col-xl-6 col-lg-6 form-group">
                                            <label>@lang('Budget')*</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="amount" name="amount" value="{{old('amount')}}" placeholder="@lang('Enter Budget')" required="">
                                              <span class="input-group-text" id="basic-addon2">{{__($general->cur_text)}}</span>
                                              <p style="color: red;" id="amount_empty"></p>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group">
                                            <label>@lang('Delivery Time')</label>
                                                <div class="input-group mb-3">
                                                  <input type="text" class="form-control" id="delivery" name="delivery" value="{{old('delivery')}}" placeholder="@lang('Delivery Time')" required="">
                                                  <span class="input-group-text" id="basic-addon2">@lang('Days')</span>
                                                  <p style="color: red;" id="delivery_empty"></p>
                                                </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group">
                                            <label>@lang('Image')</label>
                                            <div class="custom-file-wrapper removeImage">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="image" id="customFile" required>
                                                    <label class="custom-file-label" for="customFile">@lang('Choose file')</label>
                                                    <small>@lang('Supported files: jpeg, jpg, png. Image will be resized into 590x300 px')</small>
                                                    <p style="color: red;" id="document_empty"></p>
                                                </div>
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
                                            <select class="form-control select2" name="tag[]"  required="">
                                                <option value="">Select Below</option>
                                                 <option value="">Tag-1</option>
                                                 <option value="">Tag-2</option>
                                                 <option value="">Tag-3</option><br>

                                            </select>
                                            <small>@lang('Tag and enter press')</small>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 form-group conditional-div select2Tag" id="file_div"  style="display: none;">
                                            <label>@lang('File Include')*</label>
                                            <select class="form-control select2" name="file_include[]"  >
                                                <option value="">Select Below</option>
                                                <option value="">File-1</option>
                                                <option value="">File-2</option>
                                                <option value="">File-3</option><br>
                                           
                                            </select>
                                            <small>@lang('File and enter press')</small>
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
                                        </div>

                                        <div class="col-xl-12 col-lg-12 form-group">
                                            <label>@lang('Description')*</label>
                                            <textarea class="form-control bg--gray nicEdit" id="description" name="description">{{old('description')}}</textarea>
                                            <p style="color: red;" id="description_empty"></p>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 form-group">
                                            <label>@lang('Requirement')*</label>
                                            <textarea class="form-control bg--gray nicEdit" id="requirement" name="requirement">{{old('requirement')}}</textarea>
                                            <p style="color: red;" id="requirement_empty"></p>
                                        </div>

                                        <div class="col-xl-12 form-group">
                                            <button type="submit" onclick=" return check()" class="submit-btn mt-20 w-100">@lang('CREATE JOB')</button>
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
    $(document).ready(function() {
        $('.select2').select2({
            tags: true
        });
    });
    bkLib.onDomLoaded(function() {
        $( ".nicEdit" ).each(function( index ) {
            $(this).attr("id","nicEditor"+index);
            new nicEditor({fullPanel : true}).panelInstance('nicEditor'+index,{hasPanel : true});
        });
    });

    $(document).on("change",".custom-file-input",function(){
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    $('#category').on('change', function(){
        var category = $(this).val();
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
var title = document.getElementById('title').value;
var category = document.getElementById('category').value;
var subCategorys = document.getElementById('subCategorys').value;
var amount = document.getElementById('amount').value;
var delivery = document.getElementById('delivery').value;
var customFile = document.getElementById('customFile').value;
var requirement = document.getElementById('requirement').value;
var description = document.getElementById('description').value;

 

if (title == null || title == "") {
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

 else if (delivery == null || delivery == "") {
        document.getElementById('delivery_empty').innerHTML = "*DElivery Time cant be left blank!";
        return false
      }

 else if (customFile == null || customFile == "") {
        document.getElementById('document_empty').innerHTML = "*File cant be left blank!";
        return false
      }
 else if (requirement || requirement == "") {
        document.getElementById('requirement_empty').innerHTML = "* Requirement  cant be left blank!";
        return false
      }
 else if (description == null || description == "") {
        document.getElementById('description_empty').innerHTML = "*Description cant be left blank!";
        return false
      }
     
}
</script>   
@endpush