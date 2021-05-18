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
                  <input type="text" name="title"  placeholder="Sarlavha bo'yicha" class="input-style-1"
                  @if (!empty($request['title']))
                      value="{{ $request['title'] }}"
                  @endif
                  >
              </div>
              <div class="m-2">
                  <input type="text" name="author"  placeholder="Avtor bo'yicha" class="input-style-1"
                  @if (!empty($request['author']))
                  value="{{ $request['author'] }}"
              @endif
                  >
              </div>
              <div class="m-2">
                <select name="category" class="input-style-1">
                  <option value="0" selected>Kategoriya bo'yicha</option>
                  <optgroup label="Kategoriyalar">
                    @if (!empty($request['category']))
                      @foreach ($categories as $category)
                      <option value="{{$category->id}}"
                        @if ($category->id == $request['category'])
                            selected
                        @endif
                        >{{$category->title}}</option>
                      @endforeach
                    @else
                      @foreach ($categories as $category)
                      <option value="{{$category->id}}">{{$category->title}}</option>
                      @endforeach
                    @endif
                  </optgroup>
                
                </select>
               </div>
            </div>
          </form>
  </div>
    <hr>
    <div class="container ">
        {{-- Create Category Moldal --}}
        
        <div id="ex1" class="createModal mymodal modal">
            <form action="{{route('post.store')}}" id="categoryCreate" method="post" enctype="multipart/form-data">
                @csrf
            <div class="kulrang py-1" style="text-align: center;font-size:20px;">Post qo'shish</div>
            <div class="content mx-3 mt-3 d-flex flex-column">
              <div class="row col">
                <div class="text-design1 ui-text-5x col-4 mt-2">Sarlavha:</div>
                <input type="text" name="title" id="title"  class="input-style-1 mt-2 col-8" >
              </div>
               <div class="row col">
                <div class="text-design1 ui-text-5x col-4 mt-2">Subheading:</div>
                <input type="text" name="subheading" id="subheading"  class="input-style-1 mt-2 col-8" >
               </div>
               <div class="row col">
                <div class="text-design1 ui-text-5x col-4 mt-2">Avtor:</div>
                <input type="text" name="author" id="author"  class="input-style-1 mt-2 col-8" >
               </div>
             
              
               <div class="row col">
                <div class="text-design1 ui-text-5x col-4 mt-2">Kategoriyasi:</div>
                <select name="category_id" id="category_id" class="input-style-1 mt-2 col-8">
                  @foreach ($categories as $category)
                  <option value="{{$category->id}}">{{$category->title}}</option>
                  @endforeach
                </select>
               </div>

               <div class="row col">
                <div class="text-design1 ui-text-5x col-4 mt-2">Rasm:</div>
                <input type="file" name="sample" id="sample"  class="input-style-1 mt-2 col-8" >
               </div>

            </div>
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
            <form action="{{url('post/updatePost')}}" id="postUpdate" method="post"  enctype="multipart/form-data" >
                @csrf
                <input type="hidden" name="id" id="id_edit">
            <div class="kulrang py-1" style="text-align: center;font-size:20px;">Postni Tahrirlash</div>
            <div class="content mx-3 mt-3 d-flex flex-column">
              <div class="row col">
                <div class="text-design1 ui-text-5x col-4 mt-2">Sarlavha:</div>
                <input type="text" name="title" id="title_edit"  class="input-style-1 mt-2 col-8" >
              </div>
               <div class="row col">
                <div class="text-design1 ui-text-5x col-4 mt-2">Subheading:</div>
                <input type="text" name="subheading" id="subheading_edit"  class="input-style-1 mt-2 col-8" >
               </div>
               <div class="row col">
                <div class="text-design1 ui-text-5x col-4 mt-2">Avtor:</div>
                <input type="text" name="author" id="author_edit"  class="input-style-1 mt-2 col-8" >
               </div>
              
               
               <div class="row col">
                <div class="text-design1 ui-text-5x col-4 mt-2">Kategoriyasi:</div>
                <select name="category_id" id="category_id_edit" class="input-style-1 mt-2 col-8">
                  @foreach ($categories as $category)
                  <option value="{{$category->id}}">{{$category->title}}</option>
                  @endforeach
                </select>
               </div>

               <div class="row col">
                <div class="text-design1 ui-text-5x col-4 mt-2">Fayl:</div>
                <input type="file" name="sample" id="sample_edit"  class="input-style-1 mt-2 col-8" >
               </div>

            </div>
            <div >
            <hr>
            <div class="d-flex justify-content-around">
                    <div class="btn btn-danger close_modal">Chiqish</div>
                    <div class="btn btn-primary" onclick="document.getElementById('postUpdate').submit()">Yangilash</div>
            </div>
             </div>
            </form>
          </div>
           {{-- Delete Category Moldal --}}
        <div id="ex1" class="deleteModal mymodal modal">
            <form action="{{url('post/deletePost')}}" id="postDelete" method="post">
                @csrf
            <div class="kulrang py-1" style="text-align: center;font-size:20px;">Postni O'chirmoqchimisiz?</div>
            
            <div class="mt-5">
            <input type="hidden" name="id" id="post_delete">
            <div class="d-flex justify-content-around">
                    <div class="btn btn-primary close_modal">Chiqish</div>
                    <div class="btn btn-danger" onclick="document.getElementById('postDelete').submit()">O'chirish</div>
            </div>
             </div>
            </form>
          </div>

          {{-- End of Modals --}}

          @if ($posts->count() != 0)
          <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action" style="background-color: black;color:white">
              Postlar
            </a>
            
                @foreach ($posts as $post)
            <a class="list-group-item list-group-item-action myElementsList">
                <div class="row">
                    <div class="col-10 ml-2" onclick="location.href='{{ route('post.show',$post->id) }}'" >
                        <div class="row font-weight-bold">{{$post->title}}</div>
                        <div class="row">
                            @if (strlen($post->body) == 0)
                                Postda Kontent qo'yilmagan
                            @else
                                {{substr($post->body, 0, 90)}}...
                            @endif
                        </div>
                        <div class="row">
                            <div class="col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-person-fill text-secondary" viewBox="0 0 16 16"><path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                  </svg>
                              <span class="mr-3 ml-1 text-secondary" style="font-size: 12px;">{{$post->author}}</span>

                              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-calendar-event text-secondary" viewBox="0 0 16 16">
                                <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                              </svg>
                              <span class="mr-3 ml-1 text-secondary" style="font-size: 12px;">{{$post->created_at}}</span>

                             
                            </div>
                       
                        </div>
                    </div>
                    <div class="col-2 row buttonEdits">
                      <button type="button"   
                      @if (!empty($post->sample))
                      class="btn btn-success btn-sm col"
                      onclick="location.href='{{ asset('storage/'.$post->sample) }}'"
                      @else
                      class="btn btn-secondary btn-sm col"
                      @endif
                      ><i class="far fa-file-alt"></i></button> 
                            <button type="button" class="btn btn-primary btn-sm col"  onclick="editPost({{$post->id}})" ><i class="fas fa-edit"></i></button> 
                          <button type="button" class="btn btn-danger btn-sm col" onclick="deletePost({{$post->id}})"><i class="fas fa-trash-alt"></i></button>
                      
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
  .modal{
      max-height:250px!important;
  }

  .createModal{
      max-height:460px!important;
  }
  .updateModal{
      max-height:460px!important;
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

function editPost(id){
    $.ajax({
        type: 'POST',
    data: {
     'id': id,
     '_token':"{{ csrf_token() }}" //pass CSRF
          },
    enctype: 'multipart/form-data',
    url: "{{url('post/getById')}}",
    success: function (data) {
      console.log(data.id);   
        $('#id_edit').val(id);
         $('#title_edit').val(data.title);
         $('#subheading_edit').val(data.subheading);
         $('#author_edit').val(data.author);
         $('#category_id_edit').val(data.category_id).change();

         if(data.sample==""){
          $('#sample_edit').val(data.sample);
}
        
         $('.updateModal').modal();
    }
});

};

function deletePost(id){
    $('#post_delete').val(id);
    $('.deleteModal').modal();
}
$('.new_badge').text('{{$new_count}}');
$('.post').addClass('active');
    </script>
@endsection
