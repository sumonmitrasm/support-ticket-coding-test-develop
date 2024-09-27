<span class="addnewshow-seoxx-fieldxxx" style="float: right; cursor:pointer; color:darkcyan"></span>
<div class="addnewssseosection">
    
    <div class="mb-3 mt-3">
        <label for="exampleInputEmail1" class="form-label">URL Structure</label>
        <input type="text" class="form-control" id="url_structure" name="url_structure" @if(!empty($post['url_structure'])) value="{{$post['url_structure']}}" @else value="{{old('url_structure')}}" @endif placeholder="Enter Seo Title">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Heading Tags</label>
        <input type="text" class="form-control" id="heading_tag" name="heading_tag" @if(!empty($post['heading_tag'])) value="{{$post['heading_tag']}}" @else value="{{old('heading_tag')}}" @endif placeholder="Enter Heading Tag">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Schema Markup</label>
        <input type="text" class="form-control" id="schema_markup" name="schema_markup" @if(!empty($post['schema_markup'])) value="{{$post['schema_markup']}}" @else value="{{old('schema_markup')}}" @endif placeholder="Enter Schema Markup">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Meta Title</label>
        <input type="text" class="form-control" id="meta_title" name="meta_title" @if(!empty($post['meta_title'])) value="{{$post['meta_title']}}" @else value="{{old('meta_title')}}" @endif placeholder="Enter Meta Title">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Meta data</label>
        <input type="text" class="form-control" id="meta_data" name="meta_data" @if(!empty($post['meta_data'])) value="{{$post['meta_data']}}" @else value="{{old('meta_data')}}" @endif placeholder="Enter Meta Data">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Meta Description</label>
         <textarea type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Enter Description">@if (!empty($post['meta_description'])){{ $post['meta_description'] }}@else{{ old('meta_description') }}@endif</textarea>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Meta Image << ||>> <span style="color:darkcyan"> Recommended Image Size: Width:768px; Height:432px</span></label>
        <input type="file" class="form-control" id="image" name="meta_image">
        @if (!empty($post['meta_image']))
            <div>
                <img style="width: 80px; height: 50px; margin-top: 5px;" src="{{ asset('admin/admin_images/post/large/' . $post['meta_image']) }}" alt=""> &nbsp;
                <a target="_blank" href="{{ asset('admin/admin_images/post/large/' . $post['meta_image']) }}"> <span style="color:green">Click Hare</span></a> &nbsp;&nbsp;
            </div>
        @endif
    </div>
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Meta Keywords</label>
    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" @if(!empty($post['meta_keywords'])) value="{{$post['meta_keywords']}}" @else value="{{old('meta_keywords')}}" @endif placeholder="Enter Meta Keywords">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Meta robots</label>
        <input type="text" class="form-control" id="meta_robot" name="meta_robot" @if(!empty($post['meta_robot'])) value="{{$post['meta_robot']}}" @else value="{{old('meta_robot')}}" @endif placeholder="Enter Meta Robot">
    </div>
</div>
