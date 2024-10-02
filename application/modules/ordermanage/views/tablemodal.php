  <style>
        .modal-inner {
            max-width: 1270px;
            width: 100%;
        }

        .info_part {
            margin-bottom: 30px;
        }



        .table-topper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .table-modal tr th {
            text-align: center;
        }

        .table-modal tr td .btn-del {
            padding: 0;
            background: transparent;
        }

        .table-modal tr td .btn i {
            font-size: 17px;
            color: #ff6e6e;
        }

        .table-info>tbody>tr>td {
            vertical-align: middle;
            text-align: center;
            font-size: 14px;
        }

        .table-title>tbody>tr>td {
            border: 0;
            font-size: 14px;
            padding: 2px;
            color: #676767;
            font-weight: 500;
            line-height: 15px;
        }

        .table-title>tbody>tr>td:last-child {
            text-align: right;
        }

        .table-img {
            max-width: 75px;
            margin: 0;
        }

        .btn-clear {
            min-width: 75px;
            background: #37a000;
            color: #fff;
            line-height: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .btn-clear:hover {
            background: #00a047;
            color: #fff;
        }

        .table-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 0;
            max-width: 135px;
        }

        .modal-inner .modal-header,
        .modal-inner .modal-body,
        .modal-inner .modal-footer {
            padding: 15px 30px;
        }

        .table-bordered>thead>tr>td,
        .table-bordered>thead>tr>th {
            text-align: center;
            font-size: 12px;
        }


        .table-info {
            background: #f1f1f1;
            border: solid 1px #dcdbd9;
            border-spacing: 0;
        }

        .table-info tr {
            width: 100%;
            display: table;
            table-layout: fixed;
        }

        .table-info tr th,
        .table-info tr td {
            display: table-cell;
            padding: 0.5rem;
            text-align: left;
        }

        .table-info thead {
            display: table;
            width: 100%;
        }

        .table-info thead.ws {
            width: calc(100% - 17px);
        }

        .table-info thead th {
            border-bottom: solid 1px #dcdbd9;
            color: #4e4e4e;
            font-weight: bold;
            line-height: 1rem;
            text-transform: uppercase;
        }

        .table-info tbody {
            display: block;
            max-height: 12rem;
            overflow: auto;
        }

        .table-info tbody tr {
            background-color: white;
        }


        .table-info tbody tr:nth-child(even) {
            background-color: #fcfcfc;
        }

        .table-info tbody tr:not(:last-child) {
            border-bottom: solid 1px #ddd;
        }

        .table-info tbody tr td {
            color: #4e4e4e;
            line-height: 2rem;
                border: 1px solid #ddd;
        }

        .add_form {
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex;
            max-width: 200px;
        }

        .add_input {
            border: 1px solid #dcdbd9;
            border-radius: 0;
        }

        .add_input:focus {
            border-color: #333333;
            outline: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .add_btn {
            border-radius: 0;
            margin-left: 5px;
            font-size: 12px;
            background-color: #333;
            border: 1px solid #333;
            color: #fff;
        }

        .add_btn:focus,
        .add_btn:hover {
            background-color: #37a000;
            border: 1px solid #37a000;
            color: #fff;
        }

        .extra_elem {
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
         .booked .table-info {
            background: #de2222;
            border: solid 1px #de2222;
        }
        
        .booked .table-bordered>thead>tr>th{
            color: #fff;
        }
        
        .booked .table-info tbody tr td {
            border: 1px solid #de2222;
        }

    </style>


            <div id="payprint_marge" class="modal-dialog modal-inner" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><ul class="nav nav-tabs" role="tablist">
                        	<?php 
							if(!empty($tablefloor)){
							$f=0;	
							foreach($tablefloor as $floor){
							$f++;	
							?>
                        	<li class="<?php if($f==1){ echo "active";}?>"> <a href="#floor<?php echo $floor->tbfloorid;?>" id="florlist<?php echo $f;?>" role="tab" data-toggle="tab" class="home" onclick="showfloor(<?php echo $floor->tbfloorid;?>)"><?php echo $floor->floorName;?></a> </li>
                            <?php } } ?>
                        </ul><?php //echo display('table_map');?></h4>
                    </div>
                    <div class="modal-body">
                    	
                         <div class="tab-content">
                         	<?php 
							if(!empty($tablefloor)){
							$a=0;	
							foreach($tablefloor as $floor){
							$a++;	
							?>
        					<div class="tab-pane fade <?php if($a==1){echo "active in";}?>" id="floor<?php echo $floor->tbfloorid;?>"></div>
                            <?php } } ?>
                         </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="multi_table()"class="btn btn-success btn-md"><?php echo display('submit')?></button>
                        <button type="button" class="btn btn-danger btn-md" data-dismiss="modal"><?php echo display('cancel')?></button>
                    </div>
                </div>
            </div>
            <script>
            $(document).ready(function(){
    			$("#florlist1").trigger("click");
			});
	</script>
	
});
