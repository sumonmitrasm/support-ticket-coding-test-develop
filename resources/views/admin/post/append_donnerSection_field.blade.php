<script
src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
crossorigin="anonymous"
></script>
<script>
var selDiv = "";
var storedFiles = [];
$(document).ready(function () {
  $("#img").on("change", handleFileSelect);
  selDiv = $("#selectedBanner");
});

function handleFileSelect(e) {
  var files = e.target.files;
  var filesArr = Array.prototype.slice.call(files);
  filesArr.forEach(function (f) {
    if (!f.type.match("image.*")) {
      return;
    }
    storedFiles.push(f);

    var reader = new FileReader();
    reader.onload = function (e) {
      var html =
        '<img src="' +
        e.target.result +
        "\" data-file='" +
        f.name +
        "alt='Category Image' height='150px' width='150px' border-radius='10px'>";
      selDiv.html(html);
    };
    reader.readAsDataURL(f);
  });
}
</script>
<div class="addnewssseosectgion1">
    <div class="card-header">
        <h4 style="color:darkturquoise" class="card-title">Secound Details</h4>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Date odf Birth</label>
        <input type="date" class="form-control" id="date" name="date" @if(!empty($post['date'])) value="{{$post['date']}}" @else value="{{old('date')}}" @endif placeholder="Enter Date">
        <script type="text/javascript">
            var today = new Date().toISOString().split('T')[0];
            document.getElementsByName("date")[0].setAttribute('min',today);
        </script>
    </div>
    {{-- <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Last Donate</label>
        <input type="date" class="form-control" id="last_donate" name="last_donate" @if(!empty($post['last_donate'])) value="{{$post['last_donate']}}" @else value="{{old('last_donate')}}" @endif placeholder="Enter Last Donate">
        <script type="text/javascript">
            var today = new Date().toISOString().split('T')[0];
            document.getElementsByName("last_donate")[0].setAttribute('max',today);
        </script>
    </div> --}}
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">description_extra2</label>
        <textarea type="text" class="form-control" id="description_extra2" name="description_extra2" placeholder="Enter About Donar">@if (!empty($post['description_extra2'])){{ $post['description_extra2'] }}@else{{ old('description_extra2') }}@endif</textarea>
    </div>
    <div id="selectedBanner"></div>
    <div class="mb-3">
        <label for="pwd" class="form-label">Description Image << ||>> <span style="color:darkcyan"> Recommended Image Size: Width:768px; Height:432px</span></label>
        <input id="img" type="file" class="form-control" id="image" name="donner_image">
        @if (!empty($post['donner_image']))
            <div>
                <img style="width: 80px; height: 50px; margin-top: 5px;" src="{{ asset('admin/admin_images/post/donner_image/' . $post['donner_image']) }}" alt=""> &nbsp;
                <a target="_blank" href="{{ asset('admin/admin_images/post/donner_image/' . $post['donner_image']) }}"> <span style="color:green">Click Hare</span></a> &nbsp;&nbsp;
            </div>
        @endif
    </div>
</div>