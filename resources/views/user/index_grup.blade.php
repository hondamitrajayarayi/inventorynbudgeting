@extends('dashboard')
@section('nav_active_grup','active')


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                
                <div class="card">
                    
                    <div class="card-body">
                        <h6 class="card-title"><i class="bx bx-info-circle" style="font-size:15px"></i> Manajemen Grup</h6>
                        <br>
                           

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="myInputgrp" autocomplete="off" placeholder="Search..." >
                                        <div class="input-group-append">
                                          <span class="input-group-text"><i class="fa fa-search"></i></span>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-5">
                                    
                                </div>

                                <div class="col-4" align="right">                                    
                                    <button class="btn btn-success" id="btntambahgrp"><i class="bx bx-group"></i> Tambah Grup</button>
                                </div>
                            </div>                                            
                                                 
                            <br>
                        <table id="datatable-grp" onkeyup="myFunction()" class="table table-striped table-bordered dt-responsive nowrap data-table" style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size: 12px;">
                            <thead>
                            <tr>
                                <th>Grup</th>
                                <th>Deskripsi</th>
                                <th>Status Grup</th>
                            </tr>
                            </thead>

                            <tbody id='tabelgrp'>                                               
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        <!-- </form> -->
        <form>
            <div id="modaladdgrp" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel"><i class="mdi mdi-plus"></i> Tambah Grup</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <br>                            
                        
                           
                            <div class="form-group row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Nama Grup :</label>
                                <div class="col-md-5">
                                    <input class="form-control" type="text" name="group_name" id="group_name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Deskripsi Grup :</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="group_descr" id="group_descr" required>
                                </div>
                            </div>
                            <hr><br>
                            <div>
                                    
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Tambah Izin Menu :</label>
                                    </div>
                                    

                                    <div class="col-5">
                                        
                                    </div>

                                    <div class="col-4" align="right">                                    
                                        <div class="input-group">
                                        <input type="text" class="form-control" id="myInputmenu" autocomplete="off" placeholder="Cari Menu..." >
                                        <div class="input-group-append">
                                          <span class="input-group-text"><i class="fa fa-search"></i></span>
                                        </div>
                                      </div>
                                    </div>
                                </div> 
                                <table id="datatable-menu" class="table table-striped table-bordered dt-responsive nowrap data-table" style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size: 12px;">
                                    <thead>
                                    <tr>
                                        <th>Pilih</th>
                                        <th>Nama Menu</th>
                                        <th>Deskripsi</th>
                                        <th>Status Menu</th>
                                    </tr>
                                    </thead>

                                    <tbody id='tabelmenu'>                                               
                                    </tbody>
                                </table>
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
    load_data_menu();

    function load_data() {
        
        $('#datatable-grp').DataTable({
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
                url:'{{ route("mnj_grup") }}'
            },
            columns: [
                {data: 'group_name', name: 'group_name', render:function(data, type, row){
                    return "<a href='/mnj_grup/detailgroup/"+ row.group_id +"'>" + row.group_name + "</a>"
                }},
                // {data: 'group_id', name: 'group_id'},
                // {data: 'group_name', name: 'group_name'},
                {data: 'group_descr', name: 'group_descr'},
                {data: 'status'},
            ]
        });
    }

    $('#btntambahgrp').click(function(){
        $('#modaladdgrp').modal('toggle');
        $('#modaladdgrp').modal('show'); 
    });

    function load_data_menu() {
        $('#datatable-menu').DataTable({
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
                url:'/mnj_grup/datamenu',
            },
            columns: [
                {data: 'check'},
                {data: 'menu_name', name: 'menu_name'},
                {data: 'menu', name: 'menu'},
                {data: 'status_menu'},
            ]
        });
    }

    $('#btnmodaladdgrp').click(function(){
        var menu_id = [];
        $('.selectaddmenu:checked').each(function(i){
              menu_id[i] = $(this).val();
        });
        // var group_id    = $('#group_id').val();
        var group_name  = $('#group_name').val();
        var group_descr = $('#group_descr').val();

        console.log(group_name);
       
        let _token   = $('meta[name="csrf-token"]').attr('content'); 
     
        if(menu_id.length === 0){
            console.log('Pilih !');            
            Swal.fire({
                title: "Oops...",
                text: "Pilih minimal satu menu !",
                type: "warning"
            })
        }else if(group_name === '' || group_id === '' || group_descr === ''){
            console.log('Pilih !');            
            Swal.fire({
                title: "Oops...",
                text: "Data Harus dilengkapi !",
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
                url:"{{ route('addnewgroup')}}",
                type:"POST",
                data:{
                        menu_id:menu_id,
                        // group_id:group_id,
                        group_name:group_name,
                        group_descr:group_descr,
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
                        $('#datatable-grp').DataTable().destroy();
                        $('#tabelmenu').empty();
                        $('#tabelgrp').empty();
                        $('#modaladdgrp').modal('hide');
                        // $('#group_id').val('');
                        $('#group_name').val('');
                        $('#group_descr').val('');
               
                        load_data();
                        load_data_menu();
                    } else {
                        swal("Error!", results.message, "error");
                        $('#datatable-menu').DataTable().destroy();
                        $('#datatable-grp').DataTable().destroy();
                        $('#tabelmenu').empty();
                        $('#tabelgrp').empty();
                        $('#modaladdgrp').modal('hide');
                        // $('#group_id').val('');
                        $('#group_name').val('');
                        $('#group_descr').val('');

                        load_data();
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
                    $('#datatable-grp').DataTable().destroy();
                    $('#tabelmenu').empty();
                    $('#tabelgrp').empty();
                    $('#modaladdgrp').modal('hide');
                    // $('#group_id').val('');
                    $('#group_name').val('');
                    $('#group_descr').val('');

                    load_data();
                    load_data_menu();
                }        

            });        

        }
    });


});

</script>


<script>
    $(document).ready(function(){
      $("#myInputmenu").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tabelmenu tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>
<script>
    $(document).ready(function(){
      $("#myInputgrp").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tabelgrp tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>
@endpush
