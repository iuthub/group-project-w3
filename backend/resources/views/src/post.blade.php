@extends('layouts.pages')

@section('content')
{{-- Modals --}}


  {{-- Main Content --}}

<div class="ui-container-large">
  <form id="changeStatusPost" action="{{ url('post/changeStatus')}}" method="post">
    @csrf
  <input type="hidden" name="id" value="{{ $post->id }}">
  <input type="hidden" name="status" value="{{ $post->status }}">
  </form>
    <div class="container">
        <div class="d-flex flex-row-reverse">
            <div class="flex-row">
                {{-- <div class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                  </svg></div> --}}
                  <div onclick="window.history.back()" class="btn btn-warning btn-sm showView"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace-fill mr-2" viewBox="0 0 16 16">
                    <path d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2V3zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8 5.829 5.854z"/>
                  </svg>Orqaga</div>
{{-- Edit page back button --}}
                  <div onclick="show_page()" class="btn btn-warning btn-sm editView d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace-fill mr-2" viewBox="0 0 16 16">
                    <path d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2V3zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8 5.829 5.854z"/>
                  </svg>Orqaga</div>

                  @if ($post->status=="active")
                  <div class="btn btn-outline-info btn-sm showView" onclick="document.getElementById('changeStatusPost').submit()">
                    Unpublish
                    </div>
                  @else
                  <div class="btn btn-info btn-sm showView" onclick="document.getElementById('changeStatusPost').submit()">
                    Publish
                    </div>
                  @endif

                  <div 
                  @if (!empty($post->sample))
                  class="btn btn-success btn-sm"
                  onclick="location.href='{{ asset('storage/'.$post->sample) }}'"
                  @else
                  class="btn btn-secondary btn-sm "
                  @endif
                  ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-fill" viewBox="0 0 16 16">
                    <path d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3z"/>
                  </svg></div>

                  <div class="btn btn-info btn-sm showView" onclick="editPost({{$post->id}})"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg></div>
                  <div class="btn btn-danger btn-sm showView" onclick="deletePost({{$post->id}})"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                  </svg></div>
                  
                  <div onclick="edit_page()" class="btn btn-primary btn-sm showView"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill mr-2" viewBox="0 0 16 16">
                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                  </svg>Matnni O'zgartirish</div>
                    
                    <div  class="btn btn-success btn-sm editView d-none updatepost"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill mr-2" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
                      </svg>Saqlash</div>
                  
                {{-- <div class="btn btn-primary btn-sm">Paste</div> --}}
            </div>
                {{-- <div class="m-2">
                    <input type="text" placeholder="Name" class="input-style-1">
                </div>
                <div class="m-2">
                    <input type="text" placeholder="Name" class="input-style-1">
                </div>
                <div class="m-2">
                    <input type="text" placeholder="Name" class="input-style-1">
                </div>
                 --}}
            
        </div>
    </div>
    <hr>
    <div class="container ">
         
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
          <div class="kulrang py-1" style="text-align: center;font-size:20px;">Kategoriyani O'chirmoqchimisiz?</div>
          
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
       
          <input type="hidden" name="data" id="old_data" value="{{ $post->body }}">

          <div class="editView d-none">
            <form id="postUpdateBody" action="{{ url('post/updateEntities') }}" method="post">
                @csrf
                <input type="hidden" name="id" id="post_id" value="{{ $post->id }}">
                <h5>Tags:</h5>
                <input name="post_tags" class="mb-2" placeholder="Add tags" value="{{$tags}}">
                <h5>Post body:</h5>
                <input type="hidden" name="tags" id="all_tags">
            <div id="post_body"></div>
            <div class="btn btn-primary updatepost">Update</div>
           </form>
          </div>
          
          <div class="showView">
            <div class="card text-center">
                <div class="card-body">
                  <h5 class="card-title">{{$post->title}}</h5>
                  <p class="card-text"></p>
                  <a href="#" class="btn btn-primary" onclick="edit_page()">Post matnini o'zgartirish</a>
                </div>
              </div>
          </div>
          
          
        {{-- <div class="d-flex justify-content-center m-5" style="font-size: 25px;color:grey">No data</div> --}}
    </div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<link href="{{ URL::asset('assets/css/trumbowyg.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/js/tag/tagify.css') }}" rel="stylesheet" />
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
<script src="{{ URL::asset('assets/js/textarea/trumbowyg.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/textarea/plugins/cleanpaste/trumbowyg.cleanpaste.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/textarea/plugins/upload/trumbowyg.upload.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/textarea/plugins/pasteimage/trumbowyg.pasteimage.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/tag/tagify.min.js') }}"></script>
    <script>
$('.addCategoryButton').click(function(event) {
  $('.mymodal').modal();
});

var input = document.querySelector('input[name=post_tags]'),
tagify =new Tagify( input );
//tagify.addTags({{$tags}});
$('#all_tags').val(JSON.stringify(tagify.value));
$('input[name=post_tags]').change(function(event) {
 $('#all_tags').val(JSON.stringify(tagify.value));
});
$('.updatepost').click(function(event) {
 $('#postUpdateBody').submit();
});
$('#post_body').trumbowyg({
    btnsDef: {
        // Create a new dropdown
        image: {
            dropdown: ['insertImage', 'upload'],
            ico: 'insertImage'
        }
    },
    btns: [
        ['viewHTML'],
        ['formatting'],
        ['strong', 'em', 'del'],
        ['superscript', 'subscript'],
        ['link'],
        ['image'], // Our fresh created dropdown
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen']
    ],
    plugins: {
        // Add imagur parameters to upload plugin for demo purposes
        upload: {
            serverPath: 'https://api.imgbb.com/1/upload',
            fileFieldName: 'image',
            data: [{name: 'key', value: '91014f339e4918341543d55f314b764d'}],
            urlPropertyName: 'data.url',
            imageWidthModalEdit: true 
        }
    },
    autogrow: true,
   
});
$('#post_body').trumbowyg('html', $('#old_data').val());
$('.card-text').html($('#old_data').val());

function edit_page(){
    $('.showView').addClass('d-none');
  $('.editView').removeClass('d-none');

}
function show_page(){
    $('.showView').removeClass('d-none');
  $('.editView').addClass('d-none');

}


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
$('.post').addClass('active');
$('.new_badge').text('{{$new_count}}');
    </script>
@endsection
