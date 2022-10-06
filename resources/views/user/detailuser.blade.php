@extends('dashboard')
@section('nav_active_user','active')


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                
                <div class="card">
                    
                    <div class="card-body">
                        
                        <h6 class="card-title"><i class="bx bx-info-circle" style="font-size:15px"></i> Detail Manajemen Pengguna</h6><br>
                        <div class="crypto-buy-sell-nav">
                            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#info" role="tab">
                                        Info Pengguna
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#sell" role="tab">
                                        Permissions
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content crypto-buy-sell-nav-content p-4">
                                <div class="tab-pane active" id="info" role="tabpanel">
                                    <form>
                                        @foreach($data as $result)
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Username</label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="text" value="{{$result->user_id}}" id="user_id" name="user_id" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Nama</label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="text" value="{{$result->user_descr}}" id="name" name="name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Password</label>
                                            <div class="col-md-10">
                                                <button type="button" class="btn btn-info" id="setpsswd"><i class="mdi mdi-shield-key-outline"></i> Ubah Password</button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Login terakhir</label>
                                            <div class="col-md-5">
                                                <input class="form-control" type="text" name="lastlogin" value="{{$result->last_login}}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Tanggal Bergabung</label>
                                            <div class="col-md-5">
                                                <input class="form-control" type="text" name="lastlogin" value="{{$result->create_date}}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Status Pengguna</label>
                                            <div class="col-md-5">
                                               <div class="form-check mb-3">
                                                    <input class="form-check-input" type="radio" name="status" id="sttsaktif" value="1" {{ $result->user_status == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="sttsaktif">
                                                        Aktif
                                                    </label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="radio" name="status" id="sttsnonaktif" value="0" {{ $result->user_status == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="sttsnonaktif">
                                                        Tidak Aktif
                                                    </label>
                                                </div>                                                    
                                            </div>
                                        </div>
                                        @endforeach
                                        <hr>
                                        <div class="text-left mt-4">
                                            <button type="button" class="btn btn-success" id="btnPengguna" name="btnPengguna"><i class="fa fa-save"></i> Simpan Perubahan</button>
                                            <a href="/mnj_users" type="button" class="btn btn-secondary">Kembali</a>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="sell" role="tabpanel">
                                    <form>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Grup Pengguna :</label>
                                            <div class="col-md-4">
                                                <select class="form-control" name="group_usr" id="group_usr">
                                                    @foreach($datagrp as $grp)
                                                        <option value="{{ $grp->group_id }}" {{ ( $group_id == $grp->group_id) ? 'selected' : '' }}>{{ $grp->group_name }} | {{ $grp->group_descr }}</option>
                                                    @endforeach
                                                </select>
                                                <input class="form-control" type="text" value="{{ $userID}}" id="userID" name="userID" hidden>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Izin Pengguna :</label>
                                            <div class="col-md-10">
                                                <table id="datatable-prv" onkeyup="myFunction()" class="table table-striped table-bordered dt-responsive nowrap data-table" style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size: 12px;">
                                                    <thead>
                                                    <tr>
                                                        <th>Menu</th>
                                                        <th>Deskripsi</th>
                                                        <th>Status Menu</th>
                                                        <th>Izin</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody id='tabelprv'>
                                                    
                                                    <!-- <tr>
                                                        <td colspan="3" align="center"><button type="button" class="btn btn-primary btn-sm" id="tambahmenu"><i class="mdi mdi-plus"></i> Tambah Menu</button></td>
                                                    </tr>   -->                                             
                                                    </tbody>
                                                </table>
                                                <!-- <button type="button" class="btn btn-primary btn-sm" id="tambahmenu"><i class="mdi mdi-plus"></i> Tambah Izin Menu</button> -->
                                            </div>
                                        </div>
                                      
                                        <hr>
                                        <div class="text-left mt-4">
                                            <button type="button" class="btn btn-success" id="btnPrv" name="btnPrv"><i class="fa fa-save"></i> Simpan Perubahan</button>
                                            <a href="/mnj_users" type="button" class="btn btn-secondary">Batal</a>
                                        </div>
                                    
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        <!-- </form> -->
        <form>
            <div id="modalpsswd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel"><i class="mdi mdi-shield-key-outline"></i> Ubah Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                            <h5>Password Baru<i style="color: red;">*</i></h5>
                            <div>
                                <input class="form-control" type="text" value="{{ $userID}}" id="userID" name="userID" hidden>
                                <input type="text" name="password" id="password" class="form-control" autocomplete="off">
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success waves-effect btn-label waves-light" id="btnsavepsswd"><i class="bx bxs-save label-icon" ></i> Simpan Perubahan</button>
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
    $('#setpsswd').click(function(){
        console.log('modal ganti password');
        console.log($('#userID').val());

        $('#modalpsswd').modal('toggle');
        $('#modalpsswd').modal('show'); 
    });

    $('#btnsavepsswd').click(function(){
        var userID = $('#userID').val();
        var psswd = $('#password').val();
        let _token   = $('meta[name="csrf-token"]').attr('content'); 

        if (psswd === ''){
            Swal.fire({
                title: "Oops...",
                text: "Password Baru Tidak Boleh Kosong !",
                type: "warning"
            })
        }else if(psswd.length < 6){
            Swal.fire({
                title: "Oops...",
                text: "Minimal 7 Karakter !",
                type: "warning"
            })
        }else{
            console.log(psswd);
            Swal.fire({
                title: "Permintaan sedang diproses !",
                html: "Tunggu beberapa saat.",
                allowOutsideClick: false,
                onBeforeOpen: function() {
                    Swal.showLoading()
                }
            }),
            $.ajax({
                url:"{{ route('editPassword')}}",
                type:"POST",
                data:{
                        userID:userID,
                        psswd:psswd,
                        _token: _token
                    },
                dataType: "json",
                success: function(results){
                    

                    if (results.success === true) {
                        Swal.fire({  
                            type: "success",
                            title: "Berhasil !",  
                            html: "Data Berhasil Diubah.",                        
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function(t) {
                            t.dismiss === Swal.DismissReason.timer && console.log("Sukses !")
                        }),               
                        $('#modalpsswd').modal('hide');
                        $('#password').val('');
                    } else {
                        swal("Error!", results.message, "error");
                        
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
                    $('#modalpsswd').modal('hide');
                    $('#password').val('');
                }
            }); 
        }

        
    });
</script>

<script type="text/javascript">
    $('#btnPengguna').click(function(){
        var user_id = $('#user_id').val();
        var name = $('#name').val();
        var status = $('input[name="status"]:checked').val();
        let _token   = $('meta[name="csrf-token"]').attr('content'); 
        console.log(user_id, name, status);

        Swal.fire({
            title: "Permintaan sedang diproses !",
            html: "Tunggu beberapa saat.",
            allowOutsideClick: false,
            onBeforeOpen: function() {
                Swal.showLoading()
            }
        }),
        $.ajax({
            url:"{{ route('editUser')}}",
            type:"POST",
            data:{
                    user_id:user_id,
                    name:name,
                    status:status,
                    _token: _token
                },
            dataType: "json",
            success: function(results){
                

                if (results.success === true) {
                    Swal.fire({  
                        type: "success",
                        title: "Berhasil !",  
                        html: "Data Berhasil Diubah.",                        
                        showConfirmButton: false,
                        timer: 1000
                    }).then(function(t) {
                        t.dismiss === Swal.DismissReason.timer && console.log("Sukses !")
                    }),
                    window.location.href = "/mnj_users";
                } else {
                    swal("Error!", results.message, "error");
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
                })
            }        
        });        
    });
</script>


<script type="text/javascript">

    $('#group_usr').on('change', function (e) {
        // var optionSelected = $("option:selected", this);
        var grupID = this.value;
        var userID = $('#userID').val();

        console.log(grupID);
        $('#datatable-prv').DataTable().destroy();
        $('#tabelprv').empty();
        $('#datatable-prv').DataTable({
            "bSearch": false,
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": false,
            "bInfo": false,
            "bAutoWidth": false,

            processing: true,
            serverSide: true,
            ajax: {
                url:'/mnj_users/g/'+grupID,
                data:{
                    'grupID' : grupID,
                    'userID' : userID,
                }
            },
            columns: [
                {data: 'menu'},
                {data: 'desc'},
                {data: 'status_menu'},
                {data: 'izin'},
                // {data: 'hapus'},
            ]
        });
        
    });

    load_data_prv();
    load_data_menu();

    function load_data_prv() {
        // console.log($('#userID').val());
        var userID = $('#userID').val();
        $('#datatable-prv').DataTable({
            "bSearch": false,
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": false,
            "bInfo": false,
            "bAutoWidth": false,

            processing: true,
            serverSide: true,
            ajax: {
                url:'/mnj_users/'+userID,
            },
            columns: [
                {data: 'menu'},
                {data: 'desc'},
                {data: 'status_menu'},
                {data: 'izin'},
                // {data: 'hapus'},
            ]
        });
    }

    function load_data_menu() {
        var userID = $('#userID').val();
        $('#datatable-menu').DataTable({
            "bSearch": false,
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": false,
            "bInfo": true,
            "bAutoWidth": false,
            processing: true,
            serverSide: true,
            ajax: {
                url:'/mnj_users/'+userID+'/detailusermenu',
            },
            columns: [
                {data: 'check'},
                {data: 'menu', name: 'menu'},
                {data: 'status_menu'},
            ]
        });
    }


    $('#tambahmenu').click(function(){
        // var data[] = $('#idMenu').val();
        console.log($('#userID').val());
        $('#modalmenu').modal('toggle');
        $('#modalmenu').modal('show'); 
    });


    $('#btnPrv').click(function(){
        var izinprv = [];
        var izinprvC = [];
        var userID = $('#userID').val();
        var e = document.getElementById("group_usr");
        var group_usr = e.value;

        $('.selectprv:not(:checked)').each(function(i){
              izinprv[i] = $(this).val();
        });

        $('.selectprv:checked').each(function(i){
              izinprvC[i] = $(this).val();
        });
        console.log(izinprv);
        let _token   = $('meta[name="csrf-token"]').attr('content'); 


        if(izinprvC.length === 0){
            console.log('Pilih !');            
            Swal.fire({
                title: "Oops...",
                text: "Pilih minimal satu menu !",
                type: "warning"
            })
        }else{
            Swal.fire({
                title: "Permintaan sedang diproses !",
                html: "Tunggu beberapa saat.",
                allowOutsideClick: false,
                onBeforeOpen: function() {
                    Swal.showLoading()
                }
            }),
            $.ajax({
                url:"{{ route('editmenuprv')}}",
                type:"POST",
                data:{
                        userID:userID,
                        izinprv:izinprv,
                        izinprvC:izinprvC,
                        group_usr:group_usr,
                        _token: _token
                    },
                dataType: "json",
                success: function(results){                
                    console.log(userID);
                    if (results.success === true) {
                        Swal.fire({  
                            type: "success",
                            title: "Berhasil !",  
                            html: "Menu Berhasil Diubah.",                        
                            showConfirmButton: false,
                            timer: 1000
                        }).then(function(t) {
                            t.dismiss === Swal.DismissReason.timer && console.log("Sukses !")
                        }),
                      
                        $('#datatable-menu').DataTable().destroy();
                        $('#datatable-prv').DataTable().destroy();
                        $('#tabelmenu').empty();
                        $('#tabelprv').empty();
                        $('#modalmenu').modal('hide');
                        console.log(userID);
                        load_data_prv();
                        load_data_menu();
                    } else {
                        swal("Error!", results.message, "error");
                        $('#datatable-menu').DataTable().destroy();
                        $('#datatable-prv').DataTable().destroy();
                        $('#tabelmenu').empty();
                        $('#tabelprv').empty();
                        $('#modalmenu').modal('hide');
                        load_data_prv();
                        load_data_menu();
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
                    $('#datatable-menu').DataTable().destroy();
                    $('#datatable-prv').DataTable().destroy();
                    $('#tabelmenu').empty();
                    $('#tabelprv').empty();
                    $('#modalmenu').modal('hide');
                    load_data_prv();
                    load_data_menu();
                }        

            }); 
        }
    });
</script>





<script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tabelmenu tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>
@endpush
