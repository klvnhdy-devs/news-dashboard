@extends('layouts.main')
@section('main-content')
@if($errors->any())
    <div class="alert alert-danger alert-dismissible show flex items-center mb-2 mt-5" role="alert"> <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> {{$errors->first()}} <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x" class="w-4 h-4"></i> </button> </div>
@endif
@if(Session::has('message'))
<div class="toastify on  toastify-right toastify-top" style="transform: translate(0px, 0px); top: 15px;">
    <div id="success-notification-content" class="toastify-content flex"> <i class="text-success" data-lucide="check-circle"></i>
        <div class="ml-4 mr-4">
            <div class="font-medium">Berhasil Update!</div>
        </div>
        <span class="toast-close" onclick="closeToast()">✖</span>
    </div> 
 </div> 
 @endif

            <form action="{{ route('news.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Update Post
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <div class="dropdown">
                            <button type="submit" class="dropdown-toggle btn btn-primary shadow-md flex items-center" aria-expanded="false" data-tw-toggle="dropdown"> Update <i class="w-4 h-4 ml-2" data-lucide="chevron-down"></i> </button>
                        </div>
                    </div>
                </div>
                <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
                    <!-- BEGIN: Post Content -->

                        <div class="intro-y col-span-12 lg:col-span-8">
                            <input type="hidden" name="id" value="{{ $data->id }}" class="intro-y form-control py-3 px-4 box pr-10" placeholder="Title">
                            <input type="text" name="title" required value="{{ $data->title }}" class="intro-y form-control py-3 px-4 box pr-10" placeholder="Title">
                            <input type="text" name="short_desc" required value="{{ $data->short_desc }}" class="intro-y form-control py-3 px-4 box pr-10 mt-5" placeholder="Short Description">
                            <div class="post intro-y overflow-hidden box mt-5">
                                <ul class="post__tabs nav nav-tabs flex-col sm:flex-row bg-slate-200 dark:bg-darkmode-800" role="tablist">
                                    <li class="nav-item">
                                        <button title="Fill in the article content" data-tw-toggle="tab" data-tw-target="#content" class="nav-link tooltip w-full sm:w-40 py-4 active" id="content-tab" role="tab" aria-controls="content" aria-selected="true"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Description </button>
                                    </li>
                                </ul>
                                <div class="post__content tab-content">
                                    <div id="content" class="tab-pane p-5 active" role="tabpanel" aria-labelledby="content-tab">
                                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                            <div class="font-medium flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5"> <i data-lucide="chevron-down" class="w-4 h-4 mr-2"></i> Text Content </div>
                                            <div class="mt-5">
                                                <textarea name="desc" id="" class="editor" >{{ $data->desc }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5 mt-5">
                                    <div class="mt-5">
                                        <div class="mt-3">
                                            <label class="form-label">Upload Image</label>
                                            <div class="flex flex-wrap px-4" id="addingImage">
                                            <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                <img class="rounded-md"  src="{{asset('img/')}}/{{$data->image}}" alt="Midone - HTML Admin Template" >
                                                <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2" onclick="deleteImage()"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                                </div>
                                            </div>
                                            <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                                    <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">Upload a file</span> or drag and drop 
                                                    <input type="file" id="imgInp" required name="image" class="w-full h-full top-0 left-0 absolute opacity-0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-span-12 lg:col-span-4">
                            <div class="intro-y box p-5">
                                <div>
                                    <label class="form-label">Written By</label>
                                    <div class="dropdown">
                                        <div class="dropdown-toggle btn w-full btn-outline-secondary dark:bg-darkmode-800 dark:border-darkmode-800 flex items-center justify-start" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                                            <div class="w-6 h-6 image-fit mr-3">
                                                <img class="rounded" alt="Midone - HTML Admin Template" src="{{asset('dist/images/profile-2.jpg')}}">
                                            </div>
                                            <div class="truncate">{{ Auth::user()->name }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="post-form-2" class="form-label">Post Date</label>
                                    <input type="text" value="{{ $data->created_at }}" class="datepicker form-control" id="post-form-2" data-single-mode="true" disabled>
                                </div>
                            </div>
                        </div>
                        <!-- END: Post Info -->
                    </div>
                </form>

<script>
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            var templ = '<div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">'+
                        '<img class="rounded-md"  src="'+URL.createObjectURL(file)+'" alt="Midone - HTML Admin Template" >'+
                        '<div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2" onclick="deleteImage()"> <i data-lucide="x" class="w-4 h-4"></i> </div>'+
                        '</div>';
            $("#addingImage").html(templ);
        }
        }

        function deleteImage(){
            $("#addingImage").html("");
        }

        function closeToast(){
            $(".toastify").removeClass("on")
        }
</script>
@endsection