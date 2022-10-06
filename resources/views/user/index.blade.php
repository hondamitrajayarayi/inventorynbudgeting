@extends('dashboard')
@section('nav_active_user','active')


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                
                <div class="card">
                    
                    <div class="card-body">
                        <h6 class="card-title"><i class="bx bx-info-circle" style="font-size:15px"></i> Manajemen Pengguna</h6>
                        <br>                         
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="myInput" autocomplete="off" placeholder="Search..." >
                                        <div class="input-group-append">
                                          <span class="input-group-text"><i class="fa fa-search"></i></span>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-5">
                                    
                                </div>

                                <div class="col-4" align="right">                                    
                                    <button class="btn btn-success" id="btntambahuser"><i class="fas fa-user-plus"></i> Tambah Pengguna</button>
                                </div>
                            </div>                                            
                                                 
                            <br>
                        <table id="datatable-buttons" onkeyup="myFunction()" class="table table-striped table-bordered dt-responsive nowrap data-table" style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size: 12px;">
                            <thead>
                            <tr>
                                <th>Id </th>
                                <th>Nama Pengguna</th>
                                <th>Cabang</th>
                                <th>Grup</th>
                                <th>Last Login</th>
                                <th>Status Pengguna</th>
                            </tr>
                            </thead>

                            <tbody id='mytable'>                                               
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        <!-- </form> -->
        <form>
            <div id="modaladdusr" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel"><i class="mdi mdi-plus"></i> Tambah User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <br>                            
                        
                            <div class="form-group row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Username</label>
                                <div class="col-md-5">
                                    <input class="form-control" type="text" name="username" id="username" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Password</label>
                                <div class="col-md-5">
                                    <input class="form-control" type="text" name="password" id="password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Nama</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="name" id="name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Cabang</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="cabang" id="cabang" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Grup </label>
                                <div class="col-md-10">
                                    <select class="form-control" name="group_usr" id="group_usr">
                                        @foreach($grup as $grp)
                                            <option value="{{ $grp->group_id }}">{{ $grp->group_name }} | {{ $grp->group_descr }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success waves-effect btn-label waves-light" id="btnmodaladdgrp"><i class="bx bxs-save label-icon" ></i> Simpan Perubahan</button>
                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </form>
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->


@endsection

@push('scripts')

<script type="text/javascript">
$(document).ready(function(){
    load_data();
    function load_data() {
        
        $('#datatable-buttons').DataTable({
            "bSearch": false,
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": true,
            "bAutoWidth": false,
            // "order": [[ 4, "desc" ]],
            processing: true,
            serverSide: true,
            ajax: {
                url:'{{ route("mnj_users") }}',
                // data:{from_date:from_date, to_date:to_date}
            },
            columns: [
                {data: 'user_id', name: 'user_id', render:function(data, type, row){
                    return "<a href='/mnj_users/"+ row.user_id +"'>" + row.user_id + "</a>"
                }},
                {data: 'user_descr', name: 'user_descr'},
                {data: 'branch_id', name:'branch_id'},
                {data: 'group_descr', name:'group_descr'},
                {data: 'last_login', name: 'last_login'},
                {data: 'status'},
            ]
        });
    }

    $('#btntambahuser').click(function(){
        $('#modaladdusr').modal('toggle');
        $('#modaladdusr').modal('show'); 
    });

    $('#btnmodaladdgrp').click(function(){
        var username = $('#username').val();
        var password = $('#password').val();
        var nama = $('#name').val();
        var cabang = $('#cabang').val();
        var e = document.getElementById("group_usr");
        var group = e.value;
        let _token   = $('meta[name="csrf-token"]').attr('content'); 

        Swal.fire({
            title: "Permintaan sedang diproses !",
            html: "Tunggu beberapa saat.",
            allowOutsideClick: false,
            onBeforeOpen: function() {
                Swal.showLoading()
            }
        }),
        $.ajax({
            url:"{{ route('adduser')}}",
            type:"POST",
            data:{
                    username:username,
                    password:password,
                    nama:nama,
                    cabang:cabang,
                    group:group,
                    _token: _token
                },
            dataType: "json",
            success: function(results){
                

                if (results.success === true) {
                    Swal.fire({  
                        type: "success",
                        title: "Berhasil !",  
                        html: "Data Berhasil Ditambah.",                        
                        showConfirmButton: false,
                        timer: 1000
                    }).then(function(t) {
                        t.dismiss === Swal.DismissReason.timer && console.log("Sukses !")
                    }),
                    $('#datatable-buttons').DataTable().destroy();
                    $('#mytable').empty();
                    load_data();
                } else {
                    swal("Error!", results.message, "error");
                    $('#datatable-buttons').DataTable().destroy();
                    $('#mytable').empty();
                    load_data();
                }             
            },
            error: function(results){
                Swal.fire({  
                    type: "warning",
                    title: "Request Time Out !", 
                    html: "Silahkan Proses Ulang",                         
                    showConfirmButton: false,
                    timer: 5000
                }).then(function(t) {
                    t.dismiss === Swal.DismissReason.timer && console.log("gagal !")
                }),
                $('#datatable-buttons').DataTable().destroy();
                $('#mytable').empty();
                load_data();
            }        
        });        
    });

});

</script>


<script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>
@endpush
