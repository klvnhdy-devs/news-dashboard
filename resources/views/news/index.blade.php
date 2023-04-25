@extends('layouts.main')
@section('main-content')
@if(Session::has('message'))
<div class="toastify on  toastify-right toastify-top" style="transform: translate(0px, 0px); top: 15px;">
    <div id="success-notification-content" class="toastify-content flex"> <i class="text-success" data-lucide="check-circle"></i>
        <div class="ml-4 mr-4">
            <div class="font-medium">Berhasil Hapus Data!</div>
        </div>
        <span class="toast-close" onclick="closeToast()">✖</span>
    </div> 
 </div> 
 @endif

<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Data News
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <div class="dropdown">
                            <a href="{{ route('news.add') }}" class="dropdown-toggle btn btn-primary shadow-md flex items-center"> Add </a>
                        </div>
                    </div>
                </div>
<div class="overflow-x-auto mt-10">
     <table class="table table-sm">
         <thead>
             <tr>
                 <th class="whitespace-nowrap">#</th>
                 <th class="whitespace-nowrap">Title</th>
                 <th class="whitespace-nowrap">Short Desc</th>
                 <th class="whitespace-nowrap"> action </th>
             </tr>
         </thead>
         <tbody>
            @php($no=1)
            @foreach($data as $news)
             <tr>
                 <td>{{ $no }}</td>
                 <td>{{ $news->title }}</td>
                 <td>{{ $news->short_desc }}</td>
                 <td>  
                 <button class="btn btn-primary shadow-md p-0 " onclick="showImage('{{ $news->image }}')" data-tw-toggle="modal" data-tw-target="#basic-modal-preview" > <i data-lucide="image"></i> </button>
                 <button class="btn btn-danger shadow-md  p-0 " onclick="deleteData('{{ $news->id }}')" data-tw-toggle="modal" data-tw-target="#delete-modal-preview"> <i data-lucide="trash"></i> </button>
                 <a href="{{ route('news.edit',[$news->id]) }}" class="p-0 text-white btn btn-warning shadow-md"> <i data-lucide="pencil"></i>  </a>

                 </td>
             </tr>
             @php($no++)
             @endforeach
         </tbody>
     </table>
 </div>

 <div id="basic-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content" id="detailImage"> <a data-tw-dismiss="modal" href="javascript:;"> <i data-lucide="x" class="w-8 h-8 text-slate-400"></i> </a>
             
         </div>
     </div>
 </div> 

 <div id="delete-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-body p-0">
                <form action="{{ route('news.delete') }}" method="post" >
                    @csrf
                    <div class="p-5 text-center"> <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <input type="hidden" name="id" id="id_news">
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-slate-500 mt-2">Do you really want to delete these records? <br>This process cannot be undone.</div>
                    </div>
                    <div class="px-5 pb-8 text-center"> 
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button> <button type="submit" class="btn btn-danger w-24">Delete</button> </div>
                </form>             
             </div>
         </div>
     </div>
 </div> 

 <script>
    
    var base_url = "http://localhost:8000/img/";

    function deleteData(val){
        $("#id_news").val(val)
    }

    function showImage(val){
        var img = '<img src="'+base_url+val+'" id="imageDetail" alt="">';
        $("#detailImage").html(img);
    }

    function closeToast(){
        $(".toastify").removeClass("on")
    }
 </script>

@endsection