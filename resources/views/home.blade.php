@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Url Shortner</h1>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                            <span class="text-bold text-lg">Enter Link</span>
                            </p>
                        </div>
                        <form id="urlsubmit" >
                            <div class="row">
                                <div class="col-lg-3">
                                    <input id="title" type="text" class="form-control" placeholder="Enter Title" required>
                                </div>
                                <div class="col-lg-7">
                                    <input id="url" type="url" class="form-control" placeholder="Enter url" required>
                                </div>
                                <div class="col-lg-2">
                                    <button id="submit" class="btn btn-block btn-primary btn-flat">Shorten</button>
                                </div>                  
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                            <span class="text-bold text-lg">Short Links</span>
                            </p>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                <tr>
                                <th>Title</th>
                                <th>Url</th>
                                <th>Short url</th>
                                <th>Date</th>
                                <th>Copy</th>
                                </tr>
                                </thead>
                                <tbody id="url-list">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

$( document ).ready(function() {

    allUrls();
});
function addLinks(){
    title = $('#title').val();
    url = $('#url').val();
    //alert(url);
    $.ajax({
      url: "/store",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        title:title,
        org_url:url,
      },
      success:function(response){
          if(response['success'] == 1 ){
            allUrls();
            $("input").val("");
          }else{
              
          }
      },
    });
}
function allUrls(){
    $.ajax({
      url: "/index",
      type:"GET",
      success:function(response){
          if(response['success'] == 1 ){
            var items = response['payload'];
            $('#url-list').find("tr").remove();
            items.forEach(function (item){
                $('#url-list').append('<tr><td>'+item.title+'</td><td>'+item.org_url+'</td><td>'+item.short_url+'<input id="'+item.id+'" type="text"  style="display: none;" value="'+item.short_url+'"></td><td>'+item.formatted_dob+'</td><td><button name="'+item.id+'" id='+item.short_url+' class="btn btn-block btn-info btn-sm" onclick="copy(this.name)">Copy Link</button></td></tr>');
            });
          }else{
              
          }
      },
    });
}
function copy(id){
    var copyText = document.getElementById(id);
    const el = document.createElement('textarea');
    el.value = copyText.value;
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
    alert("Copied the link: " + copyText.value);
}
$('#urlsubmit').on('submit',function(event){
    //alert("hi");
    event.preventDefault();
    addLinks();
});
  </script>
@endsection
