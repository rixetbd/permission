@extends('backend.master')
@section('page_title', 'Permission')
@section('custom_style')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}/css/jsgrid.css">
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}/css/datatables.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}/css/lightbox.min.css">

@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Permission List <span class="float-end"><a href="{{route('admin.permissions.create')}}" class="btn btn-primary" id="add_permission"> <i
                                    class="fa fa-plus"></i> Create Permission</a></span></h5>
                    <span>All Permission Information</span>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTableStyle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Picture</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table_data">
                                @forelse ($permissions as $key=>$item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td class="text-center">
                                        <button class="border-0 btn-sm btn-info me-2" onclick="cat_edit('{{$item->id}}')"><i class="fa fa-edit"></i></button>
                                        <form action="{{route('admin.permissions.destroy', $item->id)}}" method="post" onsubmit="return confirm('Are you sure ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="border-0 btn-sm btn-danger me-2" type="submit"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom_script')
<!-- Plugins JS start-->
<script src="{{asset('assets/backend')}}/js/jsgrid/jsgrid.min.js"></script>
<script src="{{asset('assets/backend')}}/js/jsgrid/griddata.js"></script>
<script src="{{asset('assets/backend')}}/js/jsgrid/jsgrid.js"></script>
<!-- Plugins JS start-->
<script src="{{asset('assets/backend')}}/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/backend')}}/js/datatable/datatables/datatable.custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<script>

    $('#img_box_100').click(() => {
        $('#picture').click();
    });


    // $('#add_permission').click(() => {
    //     $('#user_pic').attr('src', 'https://i.ibb.co/p4GJX7d/default.png');
    //     $('input').val('');
    //     $('#CategoryEditModal').modal('show');
    // });

    $('#name').on('change', function(){
        $.ajax({
            url:``,
            method:'POST',
            data:{'id':$('#name').val()},
            success:function(data){
                $('#email').val(data.user.email);
                if(data.user.avatar != ''){
                    $('#user_pic').attr('src', `application/uploads/users/${data.user.avatar}`);
                }else{
                    $('#user_pic').attr('src', `https://i.ibb.co/p4GJX7d/default.png`);
                }
            },
            error:function(request, status, error){

            }
        });
    });


$('#dataTableStyle').DataTable();

</script>
{{--
<script>
    $('#dataTableStyle').DataTable({
        ajax: {
            url: `{{route('backend.users.allusers')}}`,
            dataSrc: ''
        },
        columns: [{
                data: null,
                className: "text-center",
                render: function (data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                "data": function (data, type) {
                    return `<a href="application/uploads/users/` + data.avatar + `" data-lightbox="roadtrip"><img class="img-thumbnail w-50" src="application/uploads/users/` + data.avatar + `" itemprop="thumbnail" alt="Image description"></a>`;
                }
            },
            {
                data: 'name'
            },
            {
                data: 'email'
            },
            {
                data: 'role'
            },
            {
                "data": null, // (data, type, row)
                className: "text-center",
                render: function (data) {
                    return `<button class="border-0 btn-sm btn-info me-2" onclick="cat_edit('` +
                        data.id + `','` + data.name + `')"><i class="fa fa-edit"></i></button>` +
                        `<button class="border-0 btn-sm btn-danger me-2" onclick="cat_distroy('` +
                        data.id + `')"><i class="fa fa-trash"></i></button>`;
                },
            },
        ],
        error: function (request, status, error) {
            notyf.error('No data available in table');
        }
    });


    function cat_edit(id) {
        $.ajax({
            type: "POST",
            url: ``,
            data: {
                "id": id,
            },
            success: function (data) {
                $('#permissionAdd input').val( );

                $('#user_pic').attr('src', `./application/uploads/employee/${data.employee.picture}`);
                $('#employeeID').val(data.employee.id);
                $('#name').val(data.employee.name);
                $('#email').val(data.employee.email);
                $('#phone').val(data.employee.phone);
                $('#salary').val(data.employee.salary);
                $('#city').val(data.employee.city);
                $('#experience').val(data.employee.experience);
                $('#nid_no').val(data.employee.nid_no);
                $('#vacation').val(data.employee.vacation);
                $('#address').val(data.employee.address);
            },
            error: function (request, status, error) {
                notyf.error('Permission Delete Unsuccessfully!');
            }
        });
        $('#CategoryEditModal').modal('show');
    }

    function cat_distroy(id) {
        let formUrlData = ``;
        $.ajax({
            type: "POST",
            url: `${formUrlData}`,
            data: {
                "id": id,
            },
            success: function (data) {
                $('#dataTableStyle').DataTable().ajax.reload();
                notyf.success("Permission Delete Successfully!");
            },
            error: function (request, status, error) {
                notyf.error('Permission Delete Unsuccessfully!');
            }
        });
    }



</script> --}}

<script>
    $('#permissionAdd').on('submit', function (e) {
        e.preventDefault();
        // alert('Ho');
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            dataType: 'json',
            processData: false,
            contentType: false,
            // beforeSend: function () {
            //     $('#percentComplete').html('0');
            // },
            // xhr: function() {
            //     var xhr = new window.XMLHttpRequest();
            //     xhr.upload.addEventListener("progress", function(evt) {
            //         if (evt.lengthComputable) {
            //             var percentComplete = ((evt.loaded / evt.total) * 100);
            //             $('#percentComplete').width(percentComplete + '%');
            //             $('#percentComplete').html(percentComplete+'%');
            //         }
            //     }, false);
            //     return xhr;
            // },
            success: function (data) {
                $('input[type=text]').val('');
                $('#dataTableStyle').DataTable().ajax.reload();
                $('#CategoryEditModal').modal('hide');
                notyf.success("Permission Add Successfully!");
            },
            error: function (request, status, error) {
                notyf.error(request.responseJSON.message);
            }
        });
    });

</script>

@endsection
