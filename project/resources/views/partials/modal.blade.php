
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Ajax jquery insert</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="frmadd">
          @csrf
        <div class="modal-body">
      
         <div class="form-group">
            <label for="name">Name</label>
            <input id="name" class="form-control"  type="text" name="name" >
         </div>
         <div class="form-group">
            <label for="last_name">Last name</label>
            <input id="last_name" class="form-control" type="text" name="last_name" >
         </div>
         <div class="form-group">
            <label for="address">Address</label>
            <input id="address" class="form-control" type="text" name="address" >
         </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary b">Save changes</button>
        </div>
      </div>
    </div>
  </div>
 {{--Edit modal--}}
 <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajax jquery Edit Update</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="frmedit">
      {{-- @method('PUT')--}}
        @csrf
      <div class="modal-body">
    <input type="text" id="edit_id">
       <div class="form-group">
          <label for="edit_name">Name</label>
          <input id="edit_name" class="form-control"  type="text" name="name" >
       </div>
       <div class="form-group">
          <label for="edit_last_name">Last name</label>
          <input id="edit_last_name"  class="form-control" type="text" name="last_name" >
       </div>
       <div class="form-group">
          <label for="edit_address">Address</label>
          <input id="edit_address"  class="form-control" type="text" name="address" >
       </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary update">update</button>
      </div>
    </div>
  </div>
</div>
 {{--Edit modal end--}}
 @section('scripts')
 <script>
   
   $(document).ready(function () {
    fetch_data();
   function fetch_data(){
      $.ajax({
      type: "get",
      url: "/fetch",
     // data: 'data',
      dataType: "json",
      success: function (response) {
        console.log(response.data);
        $('tbody').html("");
       $.each(response.data, function (key, value) { 
      
         $('tbody').append('<tr>\
          <td>'+value.id+'</td>\
          <td>'+value.name+'</td>\
          <td>'+value.last_name+'</td>\
          <td>'+value.address+'</td>\
          <td><button type="submit" value="'+value.id+'"  class="edit_btn btn btn-primary ">Edit</button></td>\
          <td><button type="submit" value="'+value.id+'" class="delete btn btn-primary">Delete</button></td>\
         </tr>');
       
          });
        }
      });
    
  }
 
 
    

$(document).on('click','.edit_btn',function (e) { 
  e.preventDefault();
  var data=$(this).val();
  $('#edit_modal').modal("show");
  $.ajax({
    type: "get",
    url: "/edit_data/"+data,
   /* data: "data",
    dataType: "json",*/
    success: function (response) {
     // console.log(response.member);
      //console.log($('#name'));
      $('#edit_name').val(response.member.name);
      $('#edit_last_name').val(response.member.last_name);
      $('#edit_address').val(response.member.address);
      $("#edit_id").val(data);
    }
  });
});
 
   $('.update').click(function (e) { 
    e.preventDefault();
    //alert('nenad');
    var id=$('#edit_id').val();
    var data=$('#frmedit').serialize();
   //console.log(data);
    $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
 });
 $.ajax({
  type: "put",
  url: "update_data/"+id,
  data: data,
  dataType: "json",
 
  success: function (response) {
    $("#edit_modal").modal("hide");
   fetch_data();
    console.log(response.member)
  }
 });

   });
$(document).on('click','.delete',function (e) { 
  e.preventDefault();
  var data=$(this).val();
  //console.log(data);
  $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
 });
 $.ajax({
  type: "delete",
  url: "delete/"+data,
 // data: "data",
 // dataType: "json",
  
  success: function (response) {
   //$('tbody').html("");
    fetch_data();
    console.log(response)
   
  }
 });
});
    $('.b').click(function (e){ 
     e.preventDefault();
     //location.reload();
     var data=$("#frmadd").serialize();
   console.log(data);
   
 // console.log(data);
   $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
 });
     $.ajax({
         type: "post",
         url: "show_member",
         data: data,
       dataType: "json",
   
         success: function (response) {
          console.log(response.data)
          $('#exampleModal').modal("hide");
          $('#examplemodal').find("input").val("");
          //$('#exampleModal')[0].reset();
          fetch_data();
         
             }         
     });
   
    });
  
});
  </script>
  @endsection

</html>