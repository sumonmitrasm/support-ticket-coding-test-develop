<div class="form-group categorysection">
    {{-- <label for="exampleInputName">Select category URL</label> --}}
    <select hidden id="url" name="url" class="form-control">
      @if(!empty($getCategories))
        @foreach($getCategories as $parentcategory)
        <option @if(!empty($politics['category_id']) && $politics['category_id']== $parentcategory['id']) selected="" @endif value="{{$parentcategory['url']}}">{{$parentcategory['url']}}</option>
        @if(!empty($parentcategory['subcategories']))
        @foreach($parentcategory['subcategories'] as $subcategory)
        <option @if(!empty($politics['url']) && $politics['url']== $subcategory['url']) selected="" @endif value="{{$subcategory['url']}}">&nbsp;&raquo;&nbsp;{{$subcategory['url']}}</option>
        @endforeach
        @endif
        @endforeach
      @endif
    </select>
</div>