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
        <h4 style="color:darkturquoise" class="card-title">Secound Photo Details</h4>
    </div>
    <div class="mb-3">
      <label for="pwd" class="form-label">Photo  << ||>> <span style="color:darkcyan"> Recommended Image Size: Width:768px; Height:432px</span></label>
      <input id="img" type="file" class="form-control" id="image" name="photo">
      @if (!empty($post['photo']))
          <div>
              <img style="width: 80px; height: 50px; margin-top: 5px;" src="{{ asset('admin/admin_images/post/large/' . $post['photo']) }}" alt=""> &nbsp;
              <a target="_blank" href="{{ asset('admin/admin_images/post/large/' . $post['photo']) }}"> <span style="color:green">Click Hare</span></a> &nbsp;&nbsp;
          </div>
      @endif
  </div>
  <div id="selectedBanner"></div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Photo Description</label>
        <textarea type="text" class="form-control" id="description_photo" name="description_photo" placeholder="Enter About Donar">@if (!empty($post['description_photo'])){{ $post['description_photo'] }}@else{{ old('description_photo') }}@endif</textarea>
    </div>
</div>