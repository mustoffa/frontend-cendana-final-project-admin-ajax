<div class="content-wrapper">
    <section class="content">
        <h1>Data Nilai</h1><br />

        <button class="btn btn-success" onclick="add_nilai()"><i class="glyphicon glyphicon-plus"></i> Add Nilai</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button><br /><br />
        
        <table id="table" class="table-hover table-bordered table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr class="info">
                    <th>Nama</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Grade</th>
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
	            <tr class="info">
	                <th colspan="5">&nbsp</th>
	            </tr>
            </tfoot>
        </table>
   	</section>
</div>

<script type="text/javascript">
	var save_method; //for save method string
	var table;
	$(document).ready(function() {
	    //datatables
	    table = $('#table').DataTable({ 
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo site_url('nilai/nilai_list')?>",
	            "type": "POST"
	        },
	        //Set column definition initialisation properties.
	        "columnDefs": [
		        { 
		            "targets": [ -1 ], //last column
		            "orderable": false, //set not orderable
		        },
	        ],
	    });

	    //set input/textarea/select event when change value, remove class error and remove text help block 
	    $("input").change(function(){
	        $(this).parent().parent().removeClass('has-error');
	        $(this).next().empty();
	    });
	    $("textarea").change(function(){
	        $(this).parent().parent().removeClass('has-error');
	        $(this).next().empty();
	    });
	    $("select").change(function(){
	        $(this).parent().parent().removeClass('has-error');
	        $(this).next().empty();
	    });
	});

	function add_nilai()
	{
	    save_method = 'add';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $('#modal_form').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Add Nilai'); // Set Title to Bootstrap modal title
	}

	function show_detail(id_nilai, nama_mhs)
	{
	 	save_method = 'show';
	    $('#form_show')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo site_url('nilai/detail_show/')?>/" + id_nilai,
	        type: "GET",
	        dataType: "JSON",
	        success: function(datas)
	        {
	        	var strHTML;
	        	jQuery.each( datas, function( i, data ) {
				  strHTML += "<tr>";
					  strHTML += "<td>" + data.matkul + "</td>";
					  strHTML += "<td>" + data.kelas + "</td>";
					  strHTML += "<td>" + data.ruang + "</td>";
					  strHTML += "<td>" + data.sks + "</td>";
					  strHTML += "<td>" + data.grade + "</td>";
				  strHTML += "</tr>";
				});
				$("#tableResult").find("tbody").html(strHTML);
	            $('#modal_show').modal('show'); // show bootstrap modal when complete loaded
	            $('.modal-title').text(nama_mhs); // Set title to Bootstrap modal title
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from nilai');
	        }
	    });   
	}
	
	function edit_nilai(id_nilai)
	{
	    save_method = 'update';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo site_url('nilai/nilai_edit/')?>/" + id_nilai,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
	            $('[name="id_nilai"]').val(data.id_nilai);
	            $('[name="nim"]').val(data.nim);
	            $('[name="id_matkul"]').val(data.id_matkul);
	            $('[name="id_grade"]').val(data.id_grade);
	            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
	            $('.modal-title').text('Edit Nilai'); // Set title to Bootstrap modal title
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from nilai');
	        }
	    });
	}

	function delete_nilai(id_nilai)
	{
	    if(confirm('Are you sure delete this data?'))
	    {
	        // ajax delete data to database
	        $.ajax({
	            url : "<?php echo site_url('nilai/nilai_delete')?>/"+id_nilai,
	            type: "POST",
	            dataType: "JSON",
	            success: function(data)
	            {
	                //if success reload ajax table
	                $('#modal_form').modal('hide');
	                reload_table();
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                alert('Error deleting data');
	            }
	        });
	    }
	}
	
	function reload_table()
	{
	    table.ajax.reload(null,false); //reload datatable ajax 
	}

	function save()
	{
	    $('#btnSave').text('saving...'); //change button text
	    $('#btnSave').attr('disabled',true); //set button disable 
	    var url;
	    if(save_method == 'show') {
	        url = "<?php echo site_url('nilai/detail_show')?>";
	    } else if(save_method == 'add') {
	        url = "<?php echo site_url('nilai/nilai_add')?>";
	    } else {
	        url = "<?php echo site_url('nilai/nilai_update')?>";
	    }
	    // ajax adding data to database
	    $.ajax({
	        url : url,
	        type: "POST",
	        data: $('#form').serialize(),
	        dataType: "JSON",
	        success: function(data)
	        {
	            if(data.status) //if success close modal and reload ajax table
	            {
	                $('#modal_form').modal('hide');
	                reload_table();
	            }
	            else
	            {
	                for (var i = 0; i < data.inputerror.length; i++) 
	                {
	                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
	                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
	                }
	            }
	            $('#btnSave').text('save'); //change button text
	            $('#btnSave').attr('disabled',false); //set button enable 
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error adding / update data');
	            $('#btnSave').text('save'); //change button text
	            $('#btnSave').attr('disabled',false); //set button enable 
	        }
	    });
	}
</script>

<!-- Modal Show Detail -->
<div class="modal fade" id="modal_show" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title"></h3>
            </div>

            <div class="modal-body form">
                <form action="#" id="form_show" class="form-horizontal">
	                <table id="tableResult" class="table-hover table-bordered table table-striped" cellspacing="0" width="100%">
			            <thead>
			                <tr class="info">
			                    <th>Matkul</th>
			                    <th>Kelas</th>
			                    <th>Ruang</th>
			                    <th>SKS</th>
			                    <th>Grade</th>
			                </tr>
			            </thead>
			            <tbody>
			            </tbody>
			            <tfoot>
				            <tr class="info">
				                <th colspan="5">&nbsp</th>
				            </tr>
			            </tfoot>
			        </table>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                	Close
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


<!-- Modal Show edit -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title"></h3>
            </div>

            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <div class="form-body">
                    	
                    	<input type="hidden" value="" name="id_nilai"/> 
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama</label>
                            <div class="col-md-9">
                                <select name="nim" class="form-control">
                                	<option value="">--Select Mahasiswa--</option>
						          	<?php foreach ($data_mhs as $mhs) { ?>
						          	<option value="<?=$mhs->nim?>"><?=$mhs->nama?></option>
						            <?php } ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Mata Kuliah</label>
                            <div class="col-md-9">
                                <select name="id_matkul" class="form-control">
                                	<option value="">--Select Mata Kuliah--</option>
						          	<?php foreach ($data_matkul as $matkul) { ?>
						          	<option value="<?=$matkul->id_matkul?>"><?=$matkul->matkul?></option>
						            <?php } ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Grade</label>
                            <div class="col-md-9">
                                <select name="id_grade" class="form-control">
                                	<option value="">--Select Grade--</option>
						          	<?php foreach ($data_grade as $grade) { ?>
						          	<option value="<?=$grade->id_grade?>"><?=$grade->grade?></option>
						            <?php } ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">
                	Save
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                	Cancel
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<!-- Modal Show add -->
