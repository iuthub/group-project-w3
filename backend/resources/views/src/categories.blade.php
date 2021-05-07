@extends('layouts.pages')

@section('content')
{{-- Modals --}}


  {{-- Main Content --}}

<div class="ui-container-large">
  <div class="container">
    <form id="searchForm" action="{{ url('post/search') }}" method="post">
      <div class="d-flex flex-row-reverse">
          @csrf
          <div class="flex-row">
              <div class="btn btn-primary btn-sm"
              onclick="document.getElementById('searchForm').submit()"
              ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg></div>
              <div class="btn btn-success btn-sm addCategoryButton"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill mr-2" viewBox="0 0 16 16">
                  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
                </svg>Qo'shish</div>
              {{-- <div class="btn btn-primary btn-sm">Paste</div> --}}
          </div>
              <div class="m-2">
                  <input type="text" name="title"  placeholder="Post qidirish" class="input-style-1"
                  @if (!empty($request['title']))
                      value="{{ $request['title'] }}"
                  @endif
                  >
              </div>
            </div>
          </form>
  </div>
    <hr>
    <div class="container ">
        {{-- Create Category Moldal --}}
        <div id="ex1" class="createModal mymodal modal">
            <form action="{{route('category.store')}}" id="categoryCreate" method="post">
                @csrf
            <div class="kulrang py-1" style="text-align: center;font-size:20px;">Kategoriya qo'shish</div>
            <div class="content mx-3 mt-3 d-flex flex-column">
                <div class="text-design1 ui-text-5x">Kategoriya nomini kiriting:</div>
               <input type="text" name="category" id="category"  class="input-style-1 mt-2" >
            </div>
            <div class="mt-5">
            <hr>
            <div class="d-flex justify-content-around">
                    <div class="btn btn-danger close_modal">Chiqish</div>
                    <div class="btn btn-primary" onclick="document.getElementById('categoryCreate').submit()">Saqlash</div>
            </div>
             </div>
            </form>
          </div>
          {{-- Edit Category Moldal --}}
        <div id="ex1" class="updateModal mymodal modal">
            <form action="{{url('category/updateCategory')}}" id="categoryUpdate" method="post">
                @csrf
            <div class="kulrang py-1" style="text-align: center;font-size:20px;">Kategoriya qo'shish</div>
            <div class="content mx-3 mt-3 d-flex flex-column">
                <div class="text-design1 ui-text-5x">Kategoriya nomini kiriting:</div>
                <input type="hidden" name="id" id="category_id">
               <input type="text" name="category" id="category_edit"  class="input-style-1 mt-2" >
            </div>
            <div class="mt-5">
            <hr>
            <div class="d-flex justify-content-around">
                    <div class="btn btn-danger close_modal">Chiqish</div>
                    <div class="btn btn-primary" onclick="document.getElementById('categoryUpdate').submit()">Yangilash</div>
            </div>
             </div>
            </form>
          </div>
           {{-- Delete Category Moldal --}}
        <div id="ex1" class="deleteModal mymodal modal">
            <form action="{{url('category/deleteCategory')}}" id="categoryDelete" method="post">
                @csrf
            <div class="kulrang py-1" style="text-align: center;font-size:20px;">Kategoriyani O'chirmoqchimisiz?</div>
            
            <div class="mt-5">
            <input type="hidden" name="id" id="category_delete">
            <div class="d-flex justify-content-around">
                    <div class="btn btn-primary close_modal">Chiqish</div>
                    <div class="btn btn-danger" onclick="document.getElementById('categoryDelete').submit()">O'chirish</div>
            </div>
             </div>
            </form>
          </div>

          {{-- End of Modals --}}

          @if ($categories->count() != 0)
          <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action" style="background-color: black;color:white">
              Kategoriyalar
            </a>
            
                @foreach ($categories as $category)
            <a href="#" class="list-group-item list-group-item-action">
                <div class="row">
                    <div class="col-10">{{$category->title}}</div>
                    <div class="col-2 row">
                            <button type="button" class="btn btn-primary btn-sm col"  onclick="editCategory({{$category->id}})" ><i class="fas fa-edit"></i></button> 
                          <button type="button" class="btn btn-danger btn-sm col" onclick="deleteCategory({{$category->id}})"><i class="fas fa-trash-alt"></i></button>
                      
                    </div>
                </div>
              </a>
                @endforeach
                
            
          </div>
      
     
          @else
          <div class="d-flex justify-content-center m-5" style="font-size: 25px;color:grey">No data</div>
          @endif
          
    </div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<style>
      
 .large-table-data-style{
    width:800px;text-align:left!important;
 }     
.input-style-1 {
    height:30px;
    border: none;
    background: hsl(0 0% 93%);
    border-radius: .25rem;
    &[type="submit"] {
      background: hotpink;
      color: white;
      box-shadow: 0 .75rem .5rem -.5rem hsl(0 50% 80%);
    }
    
  }
  .input-style-1:focus{
    outline: none !important;
    border:1px solid rgb(224, 224, 224);
  }
  .createModal{
      max-height:250px!important;
  }
  .updateModal{
      max-height:250px!important;
  }
  .deleteModal{
      max-height:50px!important;
  }

</style>

@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script>
$('.addCategoryButton').click(function(event) {
  $('.createModal').modal();
});
function editCategory(id){
    $.ajax({
        type: 'POST',
    data: {
     'id': id,
     '_token':"{{ csrf_token() }}" //pass CSRF
          },
    enctype: 'multipart/form-data',
    url: "{{url('category/getById')}}",
    success: function (data) {
        console.log(data.id);   
        $('#category_id').val(id);
         $('#category_edit').val(data.title);
         $('.updateModal').modal();
    }
});

};

function deleteCategory(id){
    $('#category_delete').val(id);
    $('.deleteModal').modal();
}
$('.category').addClass('active');
$('.new_badge').text('{{$new_count}}');
    </script>
@endsection
