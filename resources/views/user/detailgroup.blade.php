@extends('dashboard')
@section('nav_active_grup','active')


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                
                <div class="card">
                    
                    <div class="card-body">
                        
                        <h6 class="card-title"><i class="bx bx-info-circle" style="font-size:15px"></i> Detail Manajemen Grup</h6><br>
                        <div class="crypto-buy-sell-nav">
                            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#info" role="tab">
                                        Info Grup
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
                                       
                                            
                                        <input class="form-control" type="text" value="{{$result->group_id}}" id="group_id" name="group_id" readonly disabled hidden>
                                            
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Nama Grup</label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="text" value="{{$result->group_name}}" id="group_name" name="group_name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Deskripsi Grup</label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="text" value="{{$result->group_descr}}" id="group_descr" name="group_descr">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Status Grup</label>
                                            <div class="col-md-5">
                                               <div class="form-check mb-3">
                                                    <input class="form-check-input" type="radio" name="status" id="sttsaktif" value="1" {{ $result->status == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="sttsaktif">
                                                        Aktif
                                                    </label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="radio" name="status" id="sttsnonaktif" value="0" {{ $result->status == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="sttsnonaktif">
                                                        Tidak Aktif
                                                    </label>
                                                </div>                                                    
                                            </div>
                                        </div>
                                        @endforeach
                                        <hr>
                                        <div class="text-left mt-4">
                                            <button type="button" class="btn btn-success" id="btngrup" name="btngrup"><i class="fa fa-save"></i> Simpan Perubahan</button>
                                            <a href="/mnj_grup" type="button" class="btn btn-secondary">Batal</a>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="sell" role="tabpanel">
                                    <form>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Izin Grup :</label>
                                            <div class="col-md-10">
                                                <table id="datatable-prv" onkeyup="myFunction()" class="table table-striped table-bordered dt-responsive nowrap data-table" style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size: 12px;">
                                                    <thead>
                                                    <tr>
                                                        <th>Menu</th>
                                                        <th>Status Menu</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody id='tabelprv'>
                                                    
                                                    <tr>
                                                        <!-- <td colspan="3" align="center"><button type="button" class="btn btn-primary btn-sm" id="tambahmenu"><i class="mdi mdi-plus"></i> Tambah Menu</button></td> -->
                                                    </tr>                                               
                                                    </tbody>
                                                </table>
                                                <input class="form-control" type="text" value="{{ $id_group}}" id="id_group" name="id_group" hidden>
                                                <button type="button" class="btn btn-primary btn-sm" id="tambahmenu"><i class="mdi mdi-plus"></i> Tambah Izin Menu</button>
                                            </div>
                                        </div>
                                        
                                        <hr>
                                        <div class="text-left mt-4">
                                            <button type="button" class="btn btn-success" id="btnPrv" name="btnPrv"><i class="fa fa-save"></i> Simpan Perubahan</button>
                                            <a href="/mnj_grup" type="button" class="btn btn-secondary">Batal</a>
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
            <div id="modalmenu" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel"><i class="mdi mdi-plus"></i> Tambah Izin Menu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row">
                                <div class="col-sm-5">
                                  <div class="input-group">
                                    <input type="text" class="form-control" id="myInput" autocomplete="off" placeholder="Cari Menu..." >
                                    <div class="input-group-append">
                                      <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <br>
                            <div>
                               <table id="datatable-menu" class="table table-striped table-bordered dt-responsive nowrap data-table" style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size: 12px;">
                                    <thead>
                                    <tr>
                                        <th>Pilih</th>
                                        <th>Menu</th>
                                        <th>Status Menu</th>
                                    </tr>
                                    </thead>

                                    <tbody id='tabelmenu'>                                               
                                    </tbody>
                                </table>
                                <input class="form-control" type="text" value="{{ $id_group}}" id="id_group" name="id_group" hidden>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success waves-effect btn-label waves-light" id="btnmodalmenu"><i class="bx bxs-save label-icon" ></i> Simpan Perubahan</button>
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
    $('#btngrup').click(function(){
        var group_id = $('#id_group').val();
        var group_name = $('#group_name').val();
        var group_descr = $('#group_descr').val();
        var status = $('input[name="status"]:checked').val();
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
            url:"{{ route('editGrup')}}",
            type:"POST",
            data:{
                    group_id:group_id,
                    group_name:group_name,
                    group_descr:group_descr,
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
                    window.location.href = "/mnj_grup";
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



    load_data_prv();
    load_data_menu();

    function load_data_prv() {
        var id_group = $('#id_group').val();
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
                url:'/mnj_grup/detailgroup/'+id_group,
            },
            columns: [
                {data: 'menu'},
                {data: 'status_menu'},
                {data: 'hapus'},
            ]
        });
    }

    function load_data_menu() {
        var id_group = $('#id_group').val();
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
                url:'/mnj_grup/detailgroup/add/'+id_group,
            },
            columns: [
                {data: 'check'},
                {data: 'menu', name: 'menu'},
                {data: 'status_menu'},
            ]
        });
    }

    function hapus(menu_id){
        var id_group = $('#id_group').val();
        let _token   = $('meta[name="csrf-token"]').attr('content'); 

        Swal.fire({
          title: 'Yakin menghapus izin menu ?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
            console.log(result.value);
            if (result.value === true) {
                Swal.fire({
                    title: "Permintaan sedang diproses !",
                    html: "Tunggu beberapa saat.",
                    allowOutsideClick: false,
                    onBeforeOpen: function() {
                        Swal.showLoading()
                    }
                }),
                $.ajax({
                    url:"{{ route('hapusmenugrp')}}",
                    type:"POST",
                    data:{
                            id_group:id_group,
                            menu_id:menu_id,
                            _token: _token
                        },
                    dataType: "json",
                    success: function(results){                
                       
                        if (results.success === true) {
                            Swal.fire({  
                                type: "success",
                                title: "Berhasil !",  
                                html: "Izin menu telah dihapus.",                        
                                showConfirmButton: false,
                                timer: 1000
                            }).then(function(t) {
                                t.dismiss === Swal.DismissReason.timer && console.log("Sukses !")
                            }),
                          
                            $('#datatable-menu').DataTable().destroy();
                            $('#datatable-prv').DataTable().destroy();
                            $('#tabelmenu').empty();
                            $('#tabelprv').empty();
                           
                            load_data_prv();
                            load_data_menu();
                        } else {
                            swal("Error!", results.message, "error");
                            $('#datatable-menu').DataTable().destroy();
                            $('#datatable-prv').DataTable().destroy();
                            $('#tabelmenu').empty();
                            $('#tabelprv').empty();
                            
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
                        load_data_prv();
                        load_data_menu();
                    }        

                });   
            }
        });
    }

    $('#tambahmenu').click(function(){
        // var data[] = $('#idMenu').val();
        console.log($('#id_group').val());
        $('#modalmenu').modal('toggle');
        $('#modalmenu').modal('show'); 
    });

    $('#btnmodalmenu').click(function(){
        var menu_id = [];
        var id_group = $('#id_group').val();
        $('.selectaddmenu:checked').each(function(i){
              menu_id[i] = $(this).val();
        });
       
        let _token   = $('meta[name="csrf-token"]').attr('content'); 
     
        if(menu_id.length === 0){
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
                url:"{{ route('addnewmenugrp')}}",
                type:"POST",
                data:{
                        id_group:id_group,
                        menu_id:menu_id,
                        _token: _token
                    },
                dataType: "json",
                success: function(results){                
                  
                    if (results.success === true) {
                        Swal.fire({  
                            type: "success",
                            title: "Berhasil !",  
                            html: "Menu Berhasil Ditambah.",                        
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
