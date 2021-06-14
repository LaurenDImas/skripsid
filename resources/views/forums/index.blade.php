@extends('layouts.app')


@section('content')


    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                Forum Activity
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href=""  data-toggle="modal" data-target="#forumModal">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <circle fill="#000000" cx="9" cy="15" r="6" />
                            <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>Mulai Diskusi</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            
            <div class="card-forum">

            </div>
            <!--begin: Datatable-->
        
        </div>
    </div>

    <!-- Modal-->
    <div class="modal fade" id="forumModal" tabindex="-1" role="dialog" aria-labelledby="forumLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forumLabel">Modal Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                        <!--begin::Form-->
                    <form method="post" id="forum">
                        <div class="form-group mb-1">
                            <label for="exampleTextarea">Mulai Diskusi<span class="text-danger">*</span></label>
                            <textarea class="form-control" id="komentar" name="komentar" rows="2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary font-weight-bold forum-submit">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" type="text/javascript"></script>
    <script>
    
    // alert(2);
    var pusher = new Pusher('e5b0d441d469491b2888', {
        encrypted: true,
        cluster: "ap1"
    });

    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('priority');

    // Bind a function to a Event (the full Laravel class)
    channel.bind('App\\Events\\Priority', function(data) {
        load();
    });

    
    $(document).on('click','.reply-comment',function() {
        // alert()
        var e = $(this),
            test = e.data('comment');
            $('.refresh').attr('data-get',test);
    });


    $(document).ready(function() {
        load();
        var form2 = $("#forum");
        form2.validate({
            errorClass: "my-error-class",
            validClass: "my-valid-class",
            onkeyup: false,
            rules: {
                'komentar' : {
                    required: true
                }            
            },
            messages : {
            },
            highlight: function(element) {
            $(element).removeClass('is-valid').addClass('is-invalid');
            },
            unhighlight: function(element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
            }
        });
    
        $('.forum-submit').click(function(e){
            e.preventDefault();
            if (!form2.valid()) {
                return;
            }
            var token = $("meta[name='csrf-token']").attr("content");
            var formData = new FormData($("#forum")[0]);

            $.ajax({
                url:'{{ route("forums.store") }}',
                method:'post',
                data: formData,              
                processData: false,
                contentType: false,
                headers : {'X-CSRF-TOKEN':token},
                beforeSend:function(){
                    Swal.fire({
                        type: 'info',
                        title: 'Harap Menunggu',
                        text: 'Forum sedang dibuat',
                        // timer: 3000,
                        showCancelButton: false,
                        showConfirmButton: false
                    })
                },
                success:function(data)
                {
                    swal.close()
                    load();
                    $('#forumModal').modal('toggle');
                    $('#komentar').val('');
                }
            })
        });
        
    });  
    $(document).on('click', '.btn-delete-record-forum', function() {
        var dataUrl = $(this).data('url');
        Swal.fire({
            title: "Confirm to delete the data!",
            icon: 'warning',
            confirmButtonText: 'Delete',
            confirmButtonColor: '#FFA800',
            showCancelButton: true,
        }).then(function(result) {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'DELETE',
                    url: dataUrl,
                    beforeSend: function() {
                        Swal.fire({
                            title: "Processing The Request.",
                            onOpen: function() {
                                Swal.showLoading()
                            }
                        })
                    },
                }).done(function(rsp) {
                    // load();
                    Swal.close();
                    if (rsp.response != 200) {
                        Swal.fire("Failed!", "Something Went Wrong!", "warning");
                        return false;
                    }
                });
            }
        })
    })
    

    $(document).on('click','.forum-reply-submit',function(e) {
        e.preventDefault();
        
        var a       = $(this),
            open  = a.attr('data-open'),
            reply  = a.attr('data-reply'),
            token = $("meta[name='csrf-token']").attr("content"),
            formData = new FormData($(".reply-forum-parent-"+reply)[0]);
            
            $('.refresh').attr('data-get',reply);
            $.ajax({
                url:'{{ route("forums.store") }}',
                method:'post',
                data: formData,              
                processData: false,
                contentType: false,
                headers : {'X-CSRF-TOKEN':token},
                beforeSend:function(){
                    KTApp.block($("#reply"+reply),{
                        size: 'lg',
                        opacity: 0.0,
                        state: 'primary'
                    });
                },
                success:function(data)
                {
                    KTApp.unblock($("#reply"+reply),{});
                    $('#komentar-'+reply).val('');
                    // load(open);
                }
            });
    });
    function load(reply){
        $.ajax({
            url : "{{ route('forums.index') }}",
            dataType : "json",
            type : 'get',
            beforeSend : function(){
            },
            success : function(e){
                var results = e.results;
                html     = "",
                bodyInternal     = $('.card-forum');
                dataForm(results,html,bodyInternal);
                $("#reply-comment-"+reply).addClass('show');
            },
        })
    }
    
  
    function formate(date) {
        if (typeof date == "string")
            date = new Date(date);
        var day = (date.getDate() <= 9 ? "0" + date.getDate() : date.getDate());
        var month = (date.getMonth() + 1 <= 9 ? "0" + (date.getMonth() + 1) : (date.getMonth() + 1));
        var dateString = day + "/" + month + "/" + date.getFullYear() + " " + date.getHours() + ":" + date.getMinutes();

        return dateString;
    }
    function dataForm(results,html,bodyInternal){
        
        $.each(results, function(key,item){
            
            html +='<div class="d-flex forum mb-4">'
                +'<img src="{{asset('assets/media/icons/user.png')}}" width="30px" height="30px" alt="">&nbsp;'
                +'<div class="start-forum" style="width:100%">'
                    +'<div class="user-comment m-0 p-0">'
                        +'<div class="row">'
                            +'<div class="col-md-10">'
                                +'<h6>'+item.user.name+'</h6>'
                                +'<p>'+item.komentar+'</p>'
                            +'</div>';
                            if(item.user.id=={{Auth::user()->id}}){
                                html += deleteUtama(item.id);
                            }
                        html+='</div>'
                    +'</div>'
                    +'<div class="icon-comment">'
                        +'<span><i class="fas fa-clock mr-2"></i>'+formate(item.updated_at)+'</span>'
                        +'<span class="reply-comment" data-comment="'+item.id+'"><i class="fas fa-comment mr-2 ml-3 "  data-toggle="collapse" href="#reply-comment-'+item.id+'" role="button" aria-expanded="false"></i>'+item.comment.length+'</span>'
                        +'<span><i class="fas fas fa-reply mr-2 ml-3" data-toggle="collapse" href="#reply'+item.id+'" role="button" aria-expanded="false"></i>Reply</span>'
                    +'</div>'
                    +'<div class="collapse" id="reply'+item.id+'" >'
                        +'<form method="post" class="reply-forum-parent-'+item.id+'">'
                            +'<input type="hidden" name="parent_id" value="'+item.id+' " >'
                            +'<input type="text" name="komentar" id="komentar-'+item.id+'" class="form-control mt-3" placeholder="Add Reply" value="@'+item.user.name+' ">'
                            +'<div class="reply-button mt-3 d-flex flex-row-reverse">'
                                +'<button type="reset" class="btn btn-secondary">Cancel</button>'
                                +'<button type="button" class="btn btn-primary mr-2 forum-reply-submit" data-open="'+item.id+'" data-reply="'+item.id+'">Balas</button>'
                            +'</div>'
                        +'</form>'
                    +'</div>'
                    +'<hr>'
                    +'<div class="collapse" id="reply-comment-'+item.id+'">';
                        $.each(item.comment, function(key2,item2){
                            html+='<div class="d-flex mb-4" >'
                                    +'<img src="{{asset('assets/media/icons/user.png')}}" width="30px" height="30px" alt="">&nbsp;'
                                    +'<div class="start-forum" style="width:100%">'
                                        +'<div class="user-comment mb-3">'
                                            +'<div class="row">'
                                                +'<div class="col-md-10">'
                                                    +'<h6>'+item2.user.name+'</h6>'
                                                    +'<p>'+item2.komentar+'</p>'
                                                +'</div>';
                                                if(item2.user.id=={{Auth::user()->id}}){
                                                    html += deleteUtama(item2.id);
                                                }
                                            html+='</div>'
                                        +'</div>'
                                        +'<div class="icon-comment">'
                                            +'<span><i class="fas fa-clock m-0"></i>&nbsp;&nbsp;&nbsp;Posted&nbsp;&nbsp;</span>'
                                            +'<span><i class="fas fas fa-reply m-0" data-toggle="collapse" href="#parent-reply'+item2.id+'" role="button" aria-expanded="false"></i>&nbsp;&nbsp;&nbsp;Reply&nbsp;&nbsp;</span>'
                                        +'</div>'
                                        +'<div class="collapse" id="parent-reply'+item2.id+'">'
                                            +'<form method="post" class="reply-forum-parent-'+item2.id+'">'
                                                +'<input type="hidden" name="parent_id" value="'+item.id+' ">'
                                                +'<input type="text" class="form-control mt-3" name="komentar"  id="komentar-'+item2.id+'" placeholder="Add Reply" value="@'+item2.user.name+' ">'
                                                +'<div class="reply-button mt-3 d-flex flex-row-reverse">'
                                                    +'<button type="reset" class="btn btn-secondary">Cancel</button>'
                                                    +'<button type="button" class="btn btn-primary mr-2 forum-reply-submit" data-open="'+item.id+'" data-reply="'+item2.id+'">Submit</button>'
                                                +'</div>'
                                            +'</form>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>';
                        });
                    html+='</div>'
                +'</div>'
            +'</div>'; 
        
        });
        bodyInternal.html(html);
        // load();
    }
    function deleteUtama(dataUrl){
        html = ""; 
        html +='<div class="col-md-2">'
                +'<div class="dropdown text-right">'
                    +'<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">'
                        +'<i class="la la-cog" ></i>'
                    +'</a>'
                    +'<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">'
                        +'<ul class="nav nav-hoverable flex-column">'
                            +'<li class="nav-item"><a class="nav-link btn-delete-record-forum" href="javascript:;" data-url="forums/'+dataUrl+'"><i class="nav-icon la la-trash "></i><span  class="nav-text">Delete</span></a></li>'
                        +'</ul>'
                    +'</div>'
                +'</div>'
            +'</div>';
            return html;
    }
    </script>
@endsection