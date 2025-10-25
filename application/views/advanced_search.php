<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
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

  <div class="content-wrapper">
    <section class="content-header">
      <div class="row">
          
          <div class="col-md-2">
           <div class="pull-right">
    		      <select class="form-control" name="search_type" style="width:200px;" id="search_type">
    		        <option valur="">Select Search</option>  
                    <option value="search_by_client">Search Claim</option>
                    <option value="search_by_agent">Search Agent</option>
                    <option value="search_by_areaincharge">Search Area Incharge</option>
                </select>
            </div>
      
              </h1>
          </div>
          
<div class="hidden" id="search_by_client">

          <div class="col-md-2">
              
              <input type="text" class="form-control" id="search_client_name" placeholder="Client Name">
            
          </div>
          
          <div class="col-md-2">
                     <input type="text" class="form-control" id="search_policy" placeholder="Policy NO">
            </div>
          
          <div class="col-md-2">
                   <input type="text" class="form-control" id="search_vehicle" placeholder=" TN-00-AB-0000 ">
          </div>
          
 
 </div>
     
          
          
          
<div class="hidden" id="search_by_agent">


          <div class="col-md-2">
              
              <input type="text" class="form-control" id="search_agent_name" placeholder="Agent Name">
            
          </div>
          
          <div class="col-md-2">
                     <input type="text" class="form-control" id="search_agent_id" placeholder="Agent ID">
            </div>
          
          <div class="col-md-2">
                   <input type="text" class="form-control" id="search_agent_number" placeholder=" Phone Number ">
          </div>
 

</div> 

  
          
<div class="hidden" id="search_by_areaincharge">
    

          <div class="col-md-2">
              
              <input type="text" class="form-control" id="search_incharge" placeholder=" Area Incharge Name">

          </div>
          
          <div class="col-md-2">
                     <input type="text" class="form-control" id="search_incharge_number" placeholder="Phone Number">
            </div>
          
          <div class="col-md-2">
                   <input type="text" class="form-control" id="search_incharge_email" placeholder=" EMAIL ID ">
          </div>
          
   </div>
   
     <div class="col-md-2">
                   <button data-toggle="modal" data-target="#interviewlist_excel"  class=" btn btn-primary btn-sm pull-right fa fa-search"onclick='search_data()'>Search</button>
        
              </div>
              
              

          </div> 
      </section>
      

<!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          <div id="table_view"></div>
        </div>       
      </div>
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

    <script>
        
        
          $(document).ready(function(){
              
              
         $("#search_type").change(function(){
                 
            var search_type = $("#search_type").val();
                 
                 
            if(search_type == "search_by_client")
           {
            $("#search_by_client").removeClass("hidden");
            $("#search_by_agent").addClass("hidden");
            $("#search_by_areaincharge").addClass("hidden");
              
           }
           else if(search_type == "search_by_agent")
            {
            $("#search_by_agent").removeClass("hidden");
            $("#search_by_client").addClass("hidden");
            $("#search_by_areaincharge").addClass("hidden");
            }
            else if(search_type == "search_by_areaincharge")
            {
            $("#search_by_areaincharge").removeClass("hidden");   
            $("#search_by_agent").addClass("hidden");
            $("#search_by_client").addClass("hidden");
            }
                 
    }); 
   
              
});
  

  
function search_data()
    {
        var search_type = $("#search_type").val();
        var search_client_name = $("#search_client_name").val();
        var search_policy = $("#search_policy").val();
        var search_vehicle = $("#search_vehicle").val();
        var search_agent_name = $("#search_agent_name").val();
        var search_agent_id = $("#search_agent_id").val();
        var search_agent_number = $("#search_agent_number").val();
        var search_incharge = $("#search_incharge").val();
        var search_incharge_number  = $("#search_incharge_number").val();
        var search_incharge_email = $("#search_incharge_email").val();
        
            $.ajax({
            url:"search_report",
            method:"POST",
            data : {search_type:search_type,
                     search_client_name:search_client_name,
                    search_policy:search_policy,
                    search_vehicle:search_vehicle,
                    search_agent_name:search_agent_name,
                    search_agent_id:search_agent_id,
                    search_agent_number :search_agent_number,
                    search_incharge:search_incharge,
                    search_incharge_number:search_incharge_number,
                    search_incharge_email:search_incharge_email,
            },
            success:function(response){
               {
                         $("#table_view").html(response);
               }
               
               
            }
      });

}

        
        
    </script>
    