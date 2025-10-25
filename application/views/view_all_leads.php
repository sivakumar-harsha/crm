<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
.swal2-select {
    min-width: 50%;
    max-width: 100%;
    padding: 0.375em 0.625em;
    background: inherit;
    color: inherit;
    font-size: 2.125em !important;
}
 .nav-tabs-custom {
    margin-bottom: 6px !important;
    background: #fff;
    box-shadow: 0 1px 1px rgb(0 0 0 / 10%);
    border-radius: 3px;
}

.nav-tabs-custom>.nav-tabs {
    margin: 0;
    border-bottom-color: #f4f4f4;
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
    height: 44px !important;
}

.nav>li>a {
    position: relative;
    display: block;
}

.content {
    min-height: 250px;
    padding: 5px !important;
    margin-right: auto;
    margin-left: auto;
    padding-left: 15px;
    padding-right: 15px;
}

table.dataTable thead th, table.dataTable thead td {
    padding: 10px 18px;
    border-bottom: 1px solid #111;
    font-weight:unset !important;
}

label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: unset !important;
}

.nav-tabs-custom {
    margin-bottom: 6px !important;
    background: #fff;
    box-shadow: 0 1px 1px rgb(0 0 0 / 10%);
    border-radius: 3px;
    overflow-x: auto;
    overflow-y: hidden;
    flex-wrap: nowrap;
}

    </style>
    
</style>

<?php 
   
   if(isset($_GET["status"]) && $_GET["status"]='customer')
   {?>
   
 <?php } ?>
 
 <?php 
   $tab = "";
   if(isset($_GET["tab"]))
   {
       if($_GET["tab"] =='prospect'){
           $tab = "prospect";
       }
       else if($_GET["tab"] =='warm')
       {
           $tab = "warm";
       }
       else if($_GET["tab"] =='cold')
       {
           $tab = "cold";
       }
   ?>
   
 <?php } ?>

  <div class="content-wrapper">
  
    <section class="content">
      <div class="nav-tabs-custom">
		<ul class="nav nav-tabs bg-info">
		    <?php if($tab == ""){ ?>
        		    <li class="active" id="hot_tab" value="1"><a href="#tab_content" data-toggle="tab" aria-expanded="true" onclick="fetch_all_leads('0','1','1','0','')">Hot</a></li>
    		  <?php }else{ ?>
    		        <li class="" id="hot_tab" value="1"><a href="#tab_content" data-toggle="tab" aria-expanded="true" onclick="fetch_all_leads('0','1','1','0','')">Hot</a></li>
    		  <?php } ?>
    		  <?php if($tab == "warm"){ ?>
    		        <li class="active" id="warm_tab" value="2"><a href="#tab_content" data-toggle="tab" aria-expanded="true" onclick="fetch_all_leads('0','2','1','0','')">Warm</a></li>
    		  <?php }else{ ?>
    		        <li class="" id="warm_tab" value="2"><a href="#tab_content" data-toggle="tab" aria-expanded="true" onclick="fetch_all_leads('0','2','1','0','')">Warm</a></li>
    		  <?php } ?>
    		  <?php if($tab == "cold"){ ?>
    		        <li class="active" id="cool_tab" value="3"><a href="#tab_content" data-toggle="tab" aria-expanded="true" onclick="fetch_all_leads('0','3','1','0','')">Cold</a></li>
    		  <?php }else{ ?>
    		        <li class="" id="cool_tab" value="3"><a href="#tab_content" data-toggle="tab" aria-expanded="true" onclick="fetch_all_leads('0','3','1','0','')">Cold</a></li>
    		  <?php } ?>
    		  <?php if($tab == "prospect"){ ?>
    		        <li class="active" id="propect_tab"><a href="#tab_content" data-toggle="tab" aria-expanded="false" onclick="fetch_all_leads('1','1','1','0','')">Prospects</a></li>
    		  <?php }else{ ?>
    		        <li class="" id="propect_tab"><a href="#tab_content" data-toggle="tab" aria-expanded="false" onclick="fetch_all_leads('1','1','1','0','')">Prospects</a></li>
    		  <?php } ?>
    		 
        	<li class="" id="bulk_tab"><a href="#tab_content" data-toggle="tab" aria-expanded="false" onclick="fetch_all_leads('0','2','1','1','')">Bulk Upload</a></li>
        	
        	
        		<li class="" id="temp_tab"><a href="#tab_content" data-toggle="tab" aria-expanded="false" onclick="fetch_temp_lead('0','2','1','1','')">Lead(Min.dtls)</a></li>
        	

                  <li class="pull-right"><a href="direct_renewals" style="font-size:10px;" class="btn btn-info btn-sm pull-right"><i class="fa fa-hand-o-left"></i> Renewals</a></li>
                  
                  <li class="pull-right"><a onclick='export_excel()' style="font-size:10px;" class="btn btn-info btn-sm pull-right"><i class="fa fa-file-excel-o"></i> Export Excel</a></li>
                  
                  
                  <li class="pull-right">
        		      <input type="text" class="form-control" id="search_vechicle" style="text-transform:uppercase" placeholder="TN-XX-BC-XXXX">
        		  </li>
                  

        		  <li class="pull-right">
        		       <select class="form-control" name="filter_category" id="filter_category">
                        <option value="all">All</option>
                        <?php foreach($class as $da){?>
                          <option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>
                        <?php } ?>
                        </select>
		            </li>
        		  <li class="pull-right">
        		      <select class="form-control" name="order_category" style="width:120px;" id="order_category">
                        <option value="upcoming">Upcoming</option>
                        <option value="overdue">Back Date</option>
                        <option value="no_due_date">No Due Date</option>
                    </select>
        		  </li>
        		  	 <li class="pull-right">
        		      <input type="text" class="form-control" id="search_text" placeholder="Search Leads">
        		  </li>
        		  
		</ul>
	</div>

       <div class="modal fade in" id="template_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Quotation send</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Content</label> <span id="add_name_error" style="color: red;">*</span>
                  <textarea class="form-control" id="content" rows="5"></textarea>
                </div>
            </div>
            
            <input type="hidden" id="mobile_no">
            <input type="hidden" id="lead_id">
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="confirm_btn">Confirm</button>
            </div>
        </div>
    </div>
   </div>

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          <div id="table_view"></div>
        </div><!-- /.box-body -->        
      </div><!-- /.box -->

    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  
  
  <div id="view_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color:#33b781;color:#fff;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
          
        <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true" style="background-color:#3c8dbc;color:#fff;padding: 8px;border-color: #fff;">Personal Info</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false" style="background-color:#3c8dbc;color:#fff;padding: 8px;border-color: #fff;"><span id="second_tab">vehicle Informations</span></a></li>
                <li><a href="#tab_3" data-toggle="tab" style="background-color:#3c8dbc;color:#fff;padding: 8px;border-color: #fff;">Policy Info</a></li>
                <li><a href="#tab_4" data-toggle="tab" style="background-color:#3c8dbc;color:#fff;padding: 8px;border-color: #fff;">Upload Flie</a></li>
              </ul>
              <div class="tab-content">
                  
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">   
                                       <div class="col-md-4">
                                            <label>Client Name</label><span></span>
                                       </div>
                                       <div class="col-md-8">
                                            <p name="client_name" id="client_name"></p>
                                       </div>
                                     </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">   
                                       <div class="col-md-4">
                                            <label>Mobile No</label><span></span>
                                       </div>
                                       <div class="col-md-8">
                                            <p name="v_mobile_no" id="v_mobile_no"></p>
                                       </div>
                                     </div>
                                </div>
                           
                            <div class="form-group">
                                <div class="row">   
                                   <div class="col-md-4">
                                        <label>Landline no</label>
                                   </div>
                                   <div class="col-md-8">
                                       <p  name="landline_no" id="landline_no"></p>
                                   </div>
                                 </div>
                            </div>
                                
                                 <div class="form-group">
                                        <div class="row">   
                                           <div class="col-md-4">
                                                 <label>Address</label>
                                           </div>
                                           <div class="col-md-8">
                                               <p name="address" id="address" rows="2"></p>
                                           </div>
                                         </div>
                                 </div>
                            </div>
                            
                            <div class="col-md-6">
                                
                                 <div class="form-group">
                                      <div class="row">   
                                           <div class="col-md-4">
                                                <label>Email Id</label>
                                           </div>
                                           <div class="col-md-8">
                                               <p  name="email_id" id="email_id"></p>
                                           </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                  <div class="row">   
                                       <div class="col-md-4">
                                           <label>Date of Birth</label>
                                       </div>
                                        <div class="col-md-8">
                                            <p name="dob" id="dob"></p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">   
                                       <div class="col-md-4">
                                           <label>Age</label>
                                       </div>
                                        <div class="col-md-8">
                                            <p name="age" id="age"></p>
                                        </div>
                                    </div>
                                </div>
                                
                                 <div class="form-group">
                                     <div class="row">   
                                       <div class="col-md-4">
                                            <label>Area</label>
                                       </div>
                                        <div class="col-md-8">
                                            <p name="area" id="area"></p>
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="tab-pane" id="tab_2">
                        <div id="v_info"></div>
                        <div id="v_docs"></div>
                    </div>
                    
                    <div class="tab-pane" id="tab_3">
                            <div id="policy_info"></div>
                            <div id="policy_docs"></div>
                    </div>
                    
                    
                     <div class="tab-pane" id="tab_4">
                         
                         
             <div class = "row">
                 <div class = "col-md-6">
                     <div class = "form-group">
                         <label>Upload Flie</label> 
                           <input type="file" name="gallery_image" id="gallery_image" class="form-control" multiple="">
                     </div>
                 </div>       
                 
                 <div class = "col-md-6">
                      <div class = "form-group">
                         <label>File Type</label>
                           <input type="text" name="file_type" id="file_type" class="form-control">
                     </div>
                 </div>
            
                </div>
            </div>
          </div>
        </div>
      </div>
      
             <div class="modal-footer">
                    <input type="hidden" id="view_id">
                    <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" id="upload_btn" class="btn btn-sm btn-primary">Submit</button>
            </div>
    </div>

  </div>
</div>


    <div class="modal fade in" id="due_date_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Due Date</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Due Date</label> <span id="add_due_date_error" style="color: red;">*</span>
                  <input type="date" name="due_date" id="due_date" class="form-control">
                  
                </div>
            </div>
            
            <input type="hidden" id="due_id">
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="due_btn">Confirm</button>
            </div>
        </div>
    </div>
   </div>


  
  <script>
  var filter_category = "all";
  var lead_type=0;
  var classification=1;
  var new_classification = 1;
  
  var search = "";
  var search_vechicle ="";
  
  var bulk_status = "";
  
  $(document).ready(function(){
              <?php 
                   if(isset($_GET["status"]) && $_GET["status"]='customer')
                   {
              ?>       
                            fetch_all_leads(2,1,1);
                        $("#propect_tab").removeClass("active");
                        $("#hot_tab").removeClass("active");
                        $("#warm_tab").removeClass("active");
                        $("#cool_tab").removeClass("active");
                        $("#bulk_tab").removeClass("active");
                        
             <?php 
               }
             else
             {
             ?>
                    <?php if($tab == "prospect"){ ?>   
                        fetch_all_leads('1','1','1','0',search,search_vechicle)
                        <?php }else if($tab == "warm"){ ?>
                        fetch_all_leads('0','2','1','0',search,search_vechicle); 
                        <?php }else if($tab == "cold"){ ?>
                        fetch_all_leads('0','3','1','0',search,search_vechicle);
                    <?php }else{ ?>
                        fetch_all_leads(0,1,filter_category,'0',search,search_vechicle);
                     <?php } ?>
            <?php 
             }
             ?>
      
      $("#order_category").change(function(){
          
          filter_category = $("#filter_category").val();
          
          if($('#hot_tab').hasClass('active'))
          {
               fetch_all_leads(lead_type,1,filter_category,0,search,search_vechicle);
          }
          else if($('#warm_tab').hasClass('active'))
          {
              fetch_all_leads(lead_type,2,filter_category,0,search,search_vechicle);
          }
          else if($('#cool_tab').hasClass('active'))
          {
              fetch_all_leads(lead_type,3,filter_category,0,search,search_vechicle);
          }
          else if($("#propect_tab").hasClass('active'))
          {
              fetch_all_leads(1,1,filter_category,0,search,search_vechicle);
          }
          else if($("#bulk_tab").hasClass('active'))
          {
              fetch_all_leads(0,2,filter_category,1,search,search_vechicle);
          }
      });
      
      $("#filter_category").change(function(){
          
          filter_category = $("#filter_category").val();
          
          if($('#hot_tab').hasClass('active'))
          {
               fetch_all_leads(lead_type,1,filter_category,0,search,search_vechicle);
          }
          else if($('#warm_tab').hasClass('active'))
          {
              fetch_all_leads(lead_type,2,filter_category,0,search,search_vechicle);
          }
          else if($('#cool_tab').hasClass('active'))
          {
              fetch_all_leads(lead_type,3,filter_category,0,search,search_vechicle);
          }
          else if($("#propect_tab").hasClass('active'))
          {
              fetch_all_leads(1,1,filter_category,0,search,search_vechicle);
          }
          else if($("#bulk_tab").hasClass('active'))
          {
              fetch_all_leads(0,2,filter_category,1,search,search_vechicle);
          }
       
      });
      
      
      $("#confirm_btn").click(function(){
         var content = $("#content").val();
         var mobile_no = $("#mobile_no").val();
         var lead_id = $("#lead_id").val();
         
         $.ajax({
                    url : "update_quote_status",
                    method : "POST",
                    data : {lead_id:lead_id},
                    beforeSend:function()
                    {
                       $("#confirm_btn").attr("disabled",true); 
                    },
                    success:function(response)
                    {
                        $("#confirm_btn").attr("disabled",false); 
                        $("#template_modal").modal("toggle");
                        $("#filter_category").trigger("change");
                        window.open("https://api.whatsapp.com/send?phone="+mobile_no+"&text="+content+"", "_blank");
                    }
         });
      });
      
        $("#due_btn").click(function(){
            
            
          var duedate = $("#due_date").val();
          var id = $("#due_id").val();
            
            
            $.ajax({
            url:"add_due_date",
            method:"POST",
            data:{duedate:duedate,id:id},
             beforeSend:function(){
                $("#due_btn").attr("disabled",true);
            },
             success:function(response){
                // alert(response);
                fetch_all_leads();
                $("#due_date").val("");
               $("#due_btn").attr("disabled",false);
                $("#due_date_modal").modal("hide");

            }
            
 });
            
        });
      
      
         $("#upload_btn").click(function(){
          var document_type = $("#file_type").val();
          var id = $("#view_id").val();
          
          var files = $("#gallery_image").prop('files')[0];
          var formdata = new FormData();
          
            
               var check = 0 ;
            
            if(document_type === "")
            {
                check = 1;
                    Swal.fire(
                    'Select Document Type ?',
                    'That thing is still around?',
                    'question'
                    )
            }
            else if(check != 1)
            {
            
                formdata.append('id',id);
                formdata.append('document_type',document_type);
                formdata.append('file',files);
         
         
           $.ajax({
            url:"add_lead_files",
            dmethod:"POST",
            data:formdata,
             method:"POST",
             processData:false,  
             contentType:false,
             cache:false,
             dataType:'text',
            beforeSend:function(){
                $("#upload_btn").attr("disabled",true);
            },
             success:function(response){
                // alert(response);
                fetch_all_leads();
                $("#file_type").val("");
                $("#gallery_image").val("");
                $("#upload_btn").attr("disabled",false);
                $("#view_modal").modal("hide");
            },
            error: function(code) {   
                alert(code.statusText);
            },
          });
            }
      });
      
      
      
      $("#search_text").keyup(function(){ 
          
          search = $("#search_text").val();
          fetch_all_leads(lead_type,classification,filter_category,bulk_status,search,search_vechicle)
      });
      
      $("#search_vechicle").keyup(function(){
          search_vechicle = $("#search_vechicle").val();
          fetch_all_leads(lead_type,classification,filter_category,bulk_status,search,search_vechicle)
      });
      
      
       $('#remove_upload_btn').click(function(){
              $('#multi_images').children().last().remove();
        });
        
        
         $('#add_upload_btn').click(function(){
                var content = "<div class ='row'>";
                content += '<div class="form-group col-md-6">';
                content += ' <label>Upload File</label>';
                content += '<input type="file" name ="gallery_image[]" class="form-control" required>'; 
                content += ' </div>';
          
                content  +='<div class="form-group col-md-6">';
                content  +='<label>File type </label>';
                content  +='<input name="file_type[]" type="text" class="form-control" required >';
                content += ' </div>';
                 content += ' </div>';
                 $("#multi_images").append(content);
            });
      
  });
  
   
  
        function fetch_all_leads(lead_type,classification,filter_category,bulk_status,text,search_vechicle)
        {
          new_classification = classification;
          var order_category = $("#order_category").val();
          var content = "";
          content += "<div class='table-responsive'>";
          content += "<table id='table_id' class='table table-hover table-bordered'>"; 
          content += "<thead><th>S.No</th><th>Client name</th><th>Mobile Number</th><th>Class</th><th>Policy Type</th><th>Business type</th><th>Area</th><th>Agn Name</th><th>User</th><th>AI</th><th>Due Date</th><th>Action_Records_buttons</th></thead>";
          content += "<tbody></tbody>";
          content += "</table>";
          content += "</div>";
          
          $("#table_view").html(content);
    
           $("#table_id").DataTable({
    		       "processing": true,
    		        "serverSide": true,
    		        "ordering": false,
    		        "pageLength": 10,
    		        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    		        "ajax":{
    		            'type': 'POST',
    		            'url':'fetch_all_leads',
    		            'data':{
    	                	lead_type: lead_type,
    	                	classification:classification,
    	                	category:filter_category,
    	                	bulk_status : bulk_status,
    	                	order_category:order_category,
    	                	text : text,
    	                	search_vechicle:search_vechicle
    	                	
    	                },
    		        }
	       });
        }
        
        
        
        function fetch_temp_lead()
        {
           new_classification = classification;
          var content = "";
          content += "<div class='table-responsive'>";
          content += "<table id='table_id' class='table table-hover table-bordered'>"; 
          content += "<thead><th>S.No</th><th>Client name</th><th>Mobile Number</th><th>Class</th><th>Policy Type</th><th>Business type</th><th>Area</th><th>Agn Name</th><th>User</th><th>AI</th><th>Due Date</th><th>Action_Records_buttons</th></thead>";
          content += "<tbody></tbody>";
          content += "</table>";
          content += "</div>";
          
          $("#table_view").html(content);
    
           $("#table_id").DataTable({
    		       "processing": true,
    		        "serverSide": true,
    		        "ordering": false,
    		        "pageLength": 10,
    		        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    		        "ajax":{
    		            'type': 'POST',
    		            'url':'fetch_temp_lead',
    		            'data':{
    		                lead_type: lead_type,
    	                	classification:classification,
    	                	search_vechicle:search_vechicle},
    		        }
	       });
        }
            
        function move_prospect(id)
        {
            Swal.fire({
              title: 'Are you sure?',
              text: "Do you want convert this Lead to Prospect ?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes'
            }).then((result) => {
              if (result.isConfirmed) {
                    $.ajax({
                            url : "move_lead_to_prospect",
                            method : "POST",
                            data : {id:id},
                            success:function(response)
                            {
                                fetch_all_leads(1,1,filter_category,0);
                                $("#propect_tab").addClass("active");
                                $("#hot_tab").removeClass("active");
                                $("#warm_tab").removeClass("active");
                                $("#cool_tab").removeClass("active");
                            }
                            
                        });
                  }
            })
        }
        
        function move_to_lead(id)
        {
            
            Swal.fire({
              title: 'Are you sure?',
              text: "Do you want convert this Prospect to Lead ?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes'
            }).then((result) => {
              if (result.isConfirmed) {
                        $.ajax({
                            url : "move_to_lead",
                            method : "POST",
                            data : {id:id},
                            success:function(response)
                            {
                                fetch_all_leads(0,1,filter_category,0);
                                $("#propect_tab").removeClass("active");
                                $("#hot_tab").addClass("active");
                                $("#warm_tab").removeClass("active");
                                $("#cool_tab").removeClass("active");
                            }
                            
                        });
                  }
            })
        }
        
        function move_classfication(id)
        {
                 const { value: category } =  Swal.fire({
                  title: 'Select Category',
                  input: 'select',
                  inputOptions: {
                    'category': {
                      Hot: 'Hot',
                      Warm: 'Warm',
                      Cool: 'Cool',
                      NextYear: 'NextYear'
                    },
                  },
                  inputPlaceholder: 'Select a category',
                  showCancelButton: true,
                  inputValidator: (value) => {
                    return new Promise((resolve) => 
                    {
                      if (value === 'Hot') 
                      {
                         var val = 1;
                         
                         $.ajax({
                             url : "move_classification",
                             method : "POST",
                             data :{id:id,val:val},
                             success:function(response)
                             {
                                 Swal.fire(`success`)
                                 fetch_all_leads(0,1,filter_category,0);
                                 $("#hot_tab").addClass("active");
                                 $("#warm_tab").removeClass("active");
                                 $("#cool_tab").removeClass("active");
                             }
                         });
                      } 
                      else if(value === 'Warm')
                      {
                          var val = 2;
                       $.ajax({
                             url : "move_classification",
                             method : "POST",
                             data :{id:id,val:val},
                             success:function(response)
                             {
                                 Swal.fire(`success`)
                                 fetch_all_leads(0,2,filter_category,0);
                                  $("#hot_tab").removeClass("active");
                                 $("#warm_tab").addClass("active");
                                 $("#cool_tab").removeClass("active");
                             }
                         });
                      }
                      else if(value === 'Cool')
                      {
                          var val = 3;
                          $.ajax({
                             url : "move_classification",
                             method : "POST",
                             data :{id:id,val:val},
                             success:function(response)
                             {
                                   Swal.fire(`success`)
                                   fetch_all_leads(0,3,filter_category,0);
                                  $("#hot_tab").removeClass("active");
                                 $("#warm_tab").removeClass("active");
                                 $("#cool_tab").addClass("active");
                             }
                         });
                      }
                      else if(value === 'NextYear')
                      {
                          var val = 4;
                          $.ajax({
                             url : "move_classification",
                             method : "POST",
                             data :{id:id,val:val},
                             success:function(response)
                             {
                                   Swal.fire(`success`)
                                   fetch_all_leads(0,new_classification,filter_category,0);
                             }
                         });
                      }
                    })
                  }
               })
        }
        
        function move_to_nextyear(id)
        {
            var val = 4;
            Swal.fire({
              title: 'Are you sure?',
              text: "Do you want This Lead Change to Next Year ?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes'
                }).then((result) => {
                  $.ajax({
                     url : "move_classification",
                     method : "POST",
                     data :{id:id,val:val},
                     success:function(response)
                     {
                           Swal.fire(`success`)
                           fetch_all_leads(0,new_classification,filter_category,0);
                     }
                 });
            })
        }
        
        function export_excel()
        {
             var order_category = $("#order_category").val();
            $.ajax({
                     url : "download_leads_excel",
                     method : "POST",
                     data : {order_category:order_category},
                     success:function(response)
                     {
                         window.location.href= response;
                     }
                     
            });
        }
        
        function send_quote(id,lclass)
        {
            $.ajax({
                        url : "get_client_details_by_lead_id",
                        method : "POST",
                        data : {lead_id:id},
                        success:function(response)
                        {
                            var obj = jQuery.parseJSON(response);
                            $("#content").html("Jayanthainsurance.com.Hello "+obj.client_name+" .We Have Attached Quotation For Your "+lclass+" Insurance Policy.So feel free to check them out.");
                            $("#mobile_no").val(obj.mobile_no);
                            $("#lead_id").val(id);
                            $("#template_modal").modal("toggle");
                        }
            });
        }
        
        
    function view_data(id)
    {
        $.ajax({
                   url : "view_business_complete_details",
                   method : "POST",
                   data : {id:id},
                   success:function(response)
                   {
                       var obj = jQuery.parseJSON(response);
                       
                       $("#v_info").html("");
                       $("#v_docs").html("");
                       $("#policy_info").html("");  
                       $("#policy_docs").html("");  
                       
                        $(".modal-title").html(obj["p_info"].client_name + " - Customer Details");
                        $("#client_name").html(obj["p_info"].client_name);
                        $("#v_mobile_no").html(obj["p_info"].mobile_no);
                        $("#other_contact_details").html(obj["p_info"].other_contact_details);
                        $("#landline_no").html(obj["p_info"].landline_no);
                        $("#address").html(obj["p_info"].address);
                        $("#email_id").html(obj["p_info"].email);
                        $("#cont_person_name").html(obj["p_info"].contact_person_name);
                        $("#cont_person_des").html(obj["p_info"].contact_person_designation);
                        $("#dob").html(obj["p_info"].date_of_birth);
                        $("#age").html(obj["p_info"].age);
                        $("#area").html(obj["p_info"].area);
                        $("#view_id").val(id);
                        
                        if(obj["v_info"] == "")
                        {
                            var html = "";
                            html +='<div class="row">';
                            html +='<div class="col-md-6">';
                            html +='<div class="form-group">';
                            html +='<div class="row">';
                            html +='<div class="col-md-4">';
                            html +='<label>Make/Model/Varient</label>';
                            html +='</div>';
                            html +='<div class="col-md-8">';
                            html +='<p name="view_make_model" id="view_make_model" >'+obj["v_info"].brand_name+" /"+obj["v_info"].model_name+"/ "+obj["v_info"].varient_name+'</p>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            html +='<div class="form-group">';
                            html +='<div class="row">';
                            html +='<div class="col-md-4">';
                            html +='<label>Engine no</label>';
                            html +='</div>';
                            html +='<div class="col-md-8">';
                            html +='<p name="view_engine_no" id="view_engine_no" >'+obj["v_info"].vechi_engine_num+'</p>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            
                            html +='<div class="col-md-6">';
                            html +='<div class="form-group">';
                            html +='<div class="row">';
                            html +='<div class="col-md-4">';
                            html +='<label>Registration no</label>';
                            html +='</div>';
                            html +='<div class="col-md-8">';
                            html +='<p name="view_regn_no" id="view_regn_no" >'+obj["v_info"].vechi_register_no+'</p>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            
                            html +='<div class="form-group">';
                            html +='<div class="row">';
                            html +='<div class="col-md-4">';
                            html +='<label>Chassis No</label>';
                            html +='</div>';
                            html +='<div class="col-md-8">';
                            html +='<p name="view_chassis" id="view_chassis" >'+obj["v_info"].vechi_chassis_num+'</p>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            
                            $("#v_info").html(html);
                            $("#v_docs").html(obj["docs"]);
                        }
                        
                        if(obj["policy_info"] != "")
                        {
                            $("#policy_info").html(obj["policy_info"]);
                        }
                        
                        if(obj["policy_docs"] != "")
                        {
                          $("#policy_docs").html(obj["policy_docs"]);  
                        }
                        
                        if(obj["sme_quote"] != "")
                        {
                             $("#second_tab").html("");
                             $("#second_tab").html("Policy Quotes");
                             $("#v_info").html(obj["sme_quote"]);
                        }
                       
                       $("#view_modal").modal("toggle");
                      
                   }
        });
    }
    
function due_date_extern(id)
   {
          $("#due_date_modal").modal("show");
          $("#due_id").val(id);
    }
    
  </script>