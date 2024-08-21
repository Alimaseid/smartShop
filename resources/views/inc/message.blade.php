
@if($errors->any())
    <script>
      onload = function() {
        swal.fire({
        icon:"error",title:"Oops...",text:"Something went wrong!",confirmButtonColor:"#3bafda",
        footer:`<a href="">@foreach ($errors->all() as $error)<li style="color:red">{{ $error }}@endforeach</li>`,
      })
      }
    </script>
@endif


@if(session('success'))
<script>
    onload = function() {
     swal.fire({
          position:"top-end",icon:"success",title:"{{session('success')}}",showConfirmButton:!1,timer:1500
        })
     }
 </script>
@endif


@if(session('error'))
<script>
    onload = function() {
      swal.fire({
      icon:"error",title:"Oops...",text:"{{session('error')}}",confirmButtonColor:"#3bafda",
    })
    }
  </script>
@endif
