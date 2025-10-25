<div class="content-wrapper">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #337ab7 !important;
    border: 1px solid #fff;
    border-radius: 4px;
    cursor: default;
    color: #fff;
    float: left;
    margin-right: 5px;
    margin-top: 5px;
    padding: 0 5px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff !important;
    cursor: pointer;
    display: inline-block;
    font-weight: bold;
    margin-right: 2px;
}
        .year_select
        {
            padding-bottom:4px;
            padding-left:10px;
            width:60px;
            height:28px;
            border-radius: 3px;
            -webkit-appearance: none;
        }
        .agent_select
        {
            padding-bottom:4px;
            padding-left:10px;
            padding-right:10px;
            height:28px;
            border-radius: 3px;
            -webkit-appearance: none;
        }
        .box-header 
        {
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 10px;
            padding-bottom: 0px;
        }
        .bg-info1{
            background-color:#eee;
        }
        .select2 .select2-container .select2-container--default .select2-container--focus
        {
            margin-top: 10px !important;
        }
        
        .nav-tabs-custom {
    margin-bottom: 0px !important;
    background: #fff;
    box-shadow: 0 1px 1px rgb(0 0 0 / 10%);
    border-radius: 3px;
}

.nav-tabs-custom>.nav-tabs {
    margin: 0;
    border-bottom-color: #f4f4f4;
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
    height: 29px !important;
}
.nav-tabs
{
    border-bottom: none;
}
.nav>li>a {
    position: relative;
    display: block;
}
.nav-tabs>li>a
{
    line-height: 1;
}
.nav-tabs-custom>.nav-tabs>li {
    border-top: 0px;
}
.content-header 
{
    position: relative;
    padding: 2px 2px 0 15px;
}
.nav-tabs-custom>.nav-tabs
{
 margin: 0;   
}
table.dataTable thead th, table.dataTable thead td {
    padding: 5px 10px !important;
    border-bottom: 1px solid #111;
    font-weight:unset !important;
}
table.dataTable tbody th, table.dataTable tbody td {
    padding: 5px 10px !important;
}
    </style>
    
    <!-- Content Header (Page header) -->
    <?php if(isset($_GET["id"]))
            { 
                 $agent_id = $_GET["id"];
            }
            else
            {
                redirect("home");
            }
     ?>
     
    <section class="content-header">
        
        
         <div class="nav-tabs-custom">
        	    <ul class="nav nav-tabs bg-info1">
    		        <li class="active" id="open_tab"><a href="#open_followup_content" data-toggle="tab" aria-expanded="false">Open</a></li>
    		        <li class="" id="followup_tab"><a href="#open_followup_content" data-toggle="tab" aria-expanded="false">Follow up</a></li>
                <select class="agent_select pull-right" id="type_select" style="margin-left:10px;width: 359px;">
                    <option value="lead" selected>Lead</option>
                    <option value="graph">Graph</option>
                </select>
                <div class="pull-right">
                    <select class="agent_select select2 pull-right" style="margin-top: 10px !important" id="agent_select">
                        <?php foreach($staff as $a){ ?>
                        <?php if($a->id  == $agent_id){ ?>
                            <option value="<?php echo $a->id; ?>" selected><?php echo $a->name; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $a->id; ?>"><?php echo $a->name; ?></option>
                        <?php } } ?>
                    </select>
                </div>
                <select class="agent_select pull-right" id="order_category" style="margin-right:10px;width: 359px;">
                    <option value="upcoming">Upcoming</option>
                    <option value="overdue">Back Date</option>
                    <option value="no_due_date">No Due Date</option>
                </select>
        
    		    </ul>
    		   
            </div>
      </section>
        <!--<button data-toggle="modal" data-target="#add_model" style="margin-left:10px;" class="btn btn-primary btn-sm pull-right">View</button>-->
        <!--<button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right">Edit</button>-->
      
      <div id="lead_content" style="padding-left:15px;padding-right:15px;">
            <div class="box" style="margin-bottom: 0px;" id="open_followup_content">
                <div class="box-body">
                    <div id="table_view">
                        
                    </div>
                </div><!-- /.box-body -->        
            </div><!-- /.box -->
      </div>
      
    <div class="row hidden" id="graph_content" style="margin:10px;">
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header">
                <i class="fa fa-th"></i>
                <h3 class="box-title">Completed Lead Graph</h3>
                <label style="height:10px;width:10px;background-color:blue !important;margin-left:10px;margin-bottom:-1px;"></label>
                <label>Lead</label>
                <label style="height:10px;width:10px;background-color:green !important;margin-left:10px;margin-bottom:-1px;"></label>
                <label>Completed</label>
                <label style="height:10px;width:10px;background-color:red !important;margin-left:10px;margin-bottom:-1px;"></label>
                <label>Lost</label>
                <div class="box-tools pull-right">
                    
                    <select id="chart_class_select" class="year_select">
                        <option value="all">All</option>
                        <?php foreach($class as $c){ ?>
                        <option value="<?php echo $c->id; ?>"><?php echo $c->class; ?></option>
                        <?php } ?>
                    </select>
                    <select id="chart_year_select" class="year_select">
                        <option><?php echo date("Y"); ?></option>
                        <option><?php echo date("Y",strtotime("-1 years")); ?></option>
                        <option><?php echo date("Y",strtotime("-2 years")); ?></option>
                        <option><?php echo date("Y",strtotime("-3 years")); ?></option>
                        <option><?php echo date("Y",strtotime("-4 years")); ?></option>
                        <option><?php echo date("Y",strtotime("-5 years")); ?></option>
                    </select>
                <button type="button" class="btn btn-sm" style="background-color:white;" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-sm" style="background-color:white;" data-widget="remove"><i class="fa fa-times"></i>
                </button>
                </div>
                </div>
                <div class="box-body border-radius-none">
                <div class="chart" id="line-chart" style="height: 300px;">
                </div>
                </div>
        
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-header">
                <i class="fa fa-th"></i>
                <h3 class="box-title">Policy Types</h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-sm" style="background-color:white;" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-sm" style="background-color:white;" data-widget="remove"><i class="fa fa-times"></i>
                </button>
                </div>
                </div>
                <div class="box-body border-radius-none">
                <div id="policyChart" style="width:100%; max-width:300px; height:300px;">
                </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-solid" style="height:350px;">
                <div class="box-header">
                <i class="fa fa-th"></i>
                <h3 class="box-title">Policy Details</h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-sm" style="background-color:white;" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-sm" style="background-color:white;" data-widget="remove"><i class="fa fa-times"></i>
                </button>
                </div>
                </div>
                <div class="box-body border-radius-none" id="compare_Chart_div">
                    <canvas id="compare_Chart" style="width:100%;max-width:300px;height:300px;"></canvas>
                </div>
                </div>
        
            </div>
        </div>
    </div>
    
    <!--model-->
    
    <div class="modal fade in" id="edit_model">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center" style="color:white;">Edit Follow Up</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Follow up-Concluded</label> <span id="add_name_error" style="color: red;">*</span>
                  <select class="form-control" name="follow_up_concluded" id="follow_up_concluded">
                      <option value="">--Select--</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                  </select>
                </div>
                
                 <div class="form-group">
                  <label>Reason</label> <span id="add_name_error" style="color: red;">*</span>
                  <select class="form-control" name="follow_up_reason" id="follow_up_reason">
                      <option value="">--Select--</option>
                      <option value="Call not answered">Call not answered</option>
                      <option value="Invalid Phone number">Invalid Phone number</option>
                      <option value="New Follow up">New Follow up</option>
                      <option value="Phone Unreachable">Phone Unreachable</option>
                      <option value="Rescheduled">Rescheduled</option>
                  </select>
                </div>
                
                 <div class="form-group">
                  <label>Next Follow up date</label> <span id="add_name_error" style="color: red;">*</span>
                  <input type="Date" class="form-control" name="enter_next_follow_date" id="enter_next_follow_date">
                </div>
                
                <div class="form-group">
                  <label>Next Follow up Time</label> <span id="add_name_error" style="color: red;">*</span>
                  <input type="time" class="form-control" name="enter_next_follow_time" id="enter_next_follow_time">
                </div>
                
                 <div class="form-group">
                  <label>Comment</label> <span id="add_name_error" style="color: red;"></span>
                  <textarea class="form-control" name="follow_comment" id="follow_comment"></textarea>
                </div>
                
                <input type="hidden" id="edit_id">
                <input type="hidden" id="edit_lead_id">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary"  id="edit_follow_up_btn">Add</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>
  
  
  <div id="followup_log_mod" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Follow up details</h4>
      </div>
      <div class="modal-body">
        
        <table class="table table-responsive">
            <thead>
                <th>Date</th>
                <th>Time</th>
                <th>Reason</th>
                <th>Comment</th>
            </thead>
            <tbody id="follow_up_id">
                
            </tbody>
        </table>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
    
<script>

var xValues = ["january","February","March","April","May","June","July","August","September","October","November","December"];
var lost_data = [];
var lead_data = [];
var complete_data = [];
var id = <?php echo $agent_id; ?>;
var chart_year = "<?php echo date("Y"); ?>";
var class_select = "all";
var is_open_show = true;
//load_chart();
get_agent_details();
fetch_all_leads();
google.charts.load('current', {'packages':['corechart']});

function load_policy_chart(mot_val,health_val,travel_val,title_val) {
var data = google.visualization.arrayToDataTable([
  ['Contry', 'Mhl'],
  ['Motor',mot_val],
  ['Health',health_val],
  ['Travel',travel_val]
]);

var options = {
  title:title_val,
  is3D:true
};

var chart = new google.visualization.PieChart(document.getElementById('policyChart'));
  chart.draw(data, options);
}

function edit_data(id)
    {
        $.ajax({
             url : "fetch_edit_follow_up",
             method : "POST",
             data : {id:id},
             success:function(response)
             {
                 var obj = jQuery.parseJSON(response);
                 $("#follow_up_concluded").val(obj.follow_up_status);
                 $("#follow_up_reason").val(obj.reason);
                 $("#enter_next_follow_date").val(obj.next_follow_up_date);
                 $("#enter_next_follow_time").val(obj.next_follow_up_time);
                 $("#follow_comment").val(obj.comment);
                 $("#edit_lead_id").val(obj.lead_id);
                 $("#edit_id").val(id);
                 $("#edit_model").modal("toggle");
             }
              
        });
    }
    
    function follow_up_log(id)
    {
        $.ajax({
            url : "fetch_followup_log",
            method : "POST",
            data : {id:id},
            success:function(response)
            {
                $("#follow_up_id").html(response);
                $("#followup_log_mod").modal("toggle");
            }
        });
    }

function fetch_all_leads()
{
    var order_category = $("#order_category").val();
    //alert(id);
  var content = "";
  content += "<div class='table-responsive'>";
  content += "<table id='table_id' class='table table-hover table-bordered'>"; 
  content += "<thead><th>S.No</th><th>Client name</th><th>Mobile Number</th><th>Class</th><th>Policy Type</th><th>Business type</th><th>Area</th><th>Lead Type</th><th>Agent</th><th>AI</th><th>Due Date</th><th>Action</th></thead>";
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
	            'url':'fetch_all_leads_dashboard_staff',
	            'data':{
                	id: id,
                	order_category:order_category,
                },
	        }
   });
}

function fetch_followups()
{
  var content = "";
  content += "<div class='table-responsive'>";
  content += "<table id='table_id' class='table table-hover table-bordered'>"; 
  content += "<thead><th>S.No</th><th>Client name</th><th>Mobile Number</th><th>Next Follow up Date</th><th>Next Follow up Time</th><th>Lead Generated Date</th><th>Reason</th><th>Action</th></thead>";
  content += "<tbody></tbody>";
  content += "</table>";
  content += "</div>";
  
  $("#table_view").html(content);

  $("#table_id").DataTable({
      "processing": true,
      "serverSide": false,
      "ordering": false,
      "pageLength": 25,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "ajax":{
        'url':'fetch_all_follow_ups_dashboard_staff',
        'method' : "POST",
        'data':{id:id},
      }
  });      
}

function load_chart()
{
    var leadColors = ["blue", "blue","blue","blue","blue", "blue","blue","blue","blue", "blue","blue","blue"];
    var completeColors = ["green", "green","green","green","green", "green","green","green","green", "green","green","green"];
    var lostColors = ["red", "red","red","red","red", "red","red","red","red", "red","red","red"];
        var yValues = [1,2,3,4,5,6,7,8,9,10,11,12];
        new Chart("myChart", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          data: lead_data,
          backgroundColor: leadColors,
        },{
          data: complete_data,
          backgroundColor: completeColors,
        },{
          data: lost_data,
          backgroundColor: lostColors,
        }]
      },
      options: {
        legend: {display: false}
      }
    });
}
function load_compare_chart(name,ag_val,ot_val,title)
{
    var xValues1 = ["Others", name];
    var yValues1 = [ag_val, ot_val];
    var barColors1 = [
      "#00aba9",
      "#e8c3b9"
    ];
    
new Chart("compare_Chart", {
  type: "doughnut",
  data: {
    labels: xValues1,
    datasets: [{
      backgroundColor: barColors1,
      data: yValues1
    }]
  },
  options: {
    title: {
      display: true,
      text: title
    }
  }
});

}
function get_agent_details()
{
    $.ajax({
        url:"get_staff_full_details",
        method:"POST",
        data:{
         id:id,
         chart_year:chart_year,
         class_select:class_select,
        },
        success:function(response){
             obj = jQuery.parseJSON(response);
             complete_obj = obj["complete_data"];
             lead_obj = obj["lead_data"];
             lost_obj = obj["lost_data"];
             class_obj = obj["class_data"];
             compare_obj = obj["compare_data"];
             complete_data = [complete_obj["jan"],complete_obj["feb"],complete_obj["mar"],complete_obj["apr"],complete_obj["may"],complete_obj["jun"],complete_obj["jul"],complete_obj["aug"],complete_obj["sep"],complete_obj["oct"],complete_obj["nov"],complete_obj["dec"]];
             lead_data = [lead_obj["jan"],lead_obj["feb"],lead_obj["mar"],lead_obj["apr"],lead_obj["may"],lead_obj["jun"],lead_obj["jul"],lead_obj["aug"],lead_obj["sep"],lead_obj["oct"],lead_obj["nov"],lead_obj["dec"]];
             lost_data = [lost_obj["jan"],lost_obj["feb"],lost_obj["mar"],lost_obj["apr"],lost_obj["may"],lost_obj["jun"],lost_obj["jul"],lost_obj["aug"],lost_obj["sep"],lost_obj["oct"],lost_obj["nov"],lost_obj["dec"]];
            //yValues = [1,3,2,4,5,0,6,7,4,2,1,2];
            var add = '<canvas id="myChart" style="height: 300px;width:100%;max-width:600px;color:white;"></canvas>';
            $('#line-chart').children().remove();
            $("#line-chart").append(add);
            load_chart();
            google.charts.setOnLoadCallback(load_policy_chart(class_obj["mot_count"],class_obj["health_count"],class_obj["travel_count"],class_obj["title"]));
            load_compare_chart(compare_obj["name"],compare_obj["ag_val"],compare_obj["ot_val"],compare_obj["title"]);
        },
        error:function(code){
          alert(code.statusText);  
        },
    });
    
}

function get_agent_chart_details()
{
     $.ajax({
        url:"get_agent_full_details",
        method:"POST",
        data:{
         id:id,
         chart_year:chart_year,
         class_select:class_select,
        },
        success:function(response){
             obj = jQuery.parseJSON(response);
             complete_obj = obj["complete_data"];
             lead_obj = obj["lead_data"];
             lost_obj = obj["lost_data"];
             class_obj = obj["class_data"]
              complete_data = [complete_obj["jan"],complete_obj["feb"],complete_obj["mar"],complete_obj["apr"],complete_obj["may"],complete_obj["jun"],complete_obj["jul"],complete_obj["aug"],complete_obj["sep"],complete_obj["oct"],complete_obj["nov"],complete_obj["dec"]];
              lead_data = [lead_obj["jan"],lead_obj["feb"],lead_obj["mar"],lead_obj["apr"],lead_obj["may"],lead_obj["jun"],lead_obj["jul"],lead_obj["aug"],lead_obj["sep"],lead_obj["oct"],lead_obj["nov"],lead_obj["dec"]];
              lost_data = [lost_obj["jan"],lost_obj["feb"],lost_obj["mar"],lost_obj["apr"],lost_obj["may"],lost_obj["jun"],lost_obj["jul"],lost_obj["aug"],lost_obj["sep"],lost_obj["oct"],lost_obj["nov"],lost_obj["dec"]];
            //yValues = [1,3,2,4,5,0,6,7,4,2,1,2];
            var add = '<canvas id="myChart" style="height: 300px;width:100%;max-width:600px;color:white;"></canvas>';
            $('#line-chart').children().remove();
            $("#line-chart").append(add);
            load_chart();
            //google.charts.setOnLoadCallback(load_policy_chart(class_obj["mot_count"],class_obj["health_count"],class_obj["travel_count"]));
            //$("#mot_per").val(obj["mot"]);
            //$("#health_per").val(obj["health"]);
            //$("#travel_per").val(obj["travel"]);
        },
        error:function(code){
          alert(code.statusText);  
        },
    });

}

$(document).ready(function(){
     $('.select2').select2();
     $("#graph_content").addClass("hidden");
    $("#lead_content").removeClass("hidden");
     $("#chart_class_select").change(function(){
         class_select = $("#chart_class_select").val();
         get_agent_chart_details();
     });
     $("#order_category").change(function(){
         fetch_all_leads();
     });
    $("#agent_select").change(function(){
        id = $("#agent_select").val();
        get_agent_details();
        if(is_open_show)
        {
            fetch_all_leads();
        }
        else
        {
            fetch_followups();
        }
    });
    $("#chart_year_select").change(function(){
        chart_year = $("#chart_year_select").val();
        get_agent_chart_details();
    });
    $("#type_select").change(function(){
       type = $("#type_select").val();
       if(type == "lead")
       {
           $("#graph_content").addClass("hidden");
            $("#lead_content").removeClass("hidden");
       }
       else
       {
            $("#lead_content").addClass("hidden");
            $("#graph_content").removeClass("hidden");
       }
    });
    $("#open_tab").click(function(){
        is_open_show = true;
        fetch_all_leads();
        $("#order_category").removeClass("hidden");
    });
     $("#followup_tab").click(function(){
         is_open_show = false;
        fetch_followups();
        $("#order_category").addClass("hidden");
    });
    
    //edit followup
     $("#edit_follow_up_btn").click(function(){
           
           var id = $("#edit_id").val();
           var lead_id = $("#edit_lead_id").val();
           var follow_up_status = $("#follow_up_concluded").val();
           var follow_up_reason = $("#follow_up_reason").val();
           var enter_next_follow_date = $("#enter_next_follow_date").val();
           var enter_next_follow_time = $("#enter_next_follow_time").val();
           var follow_comment = $("#follow_comment").val();
           
           var check = 0;
           
           if(follow_up_status == "")
           {
               check = 1;
                    Swal.fire(
                    'Select Follow Up Concluded ?',
                    '',
                    'question'
                    )
           }
           else if(follow_up_reason === "")
           {
               check = 1;
               Swal.fire(
                    'Select Reason ?',
                    '',
                    'question'
                    )
           }
           else if(enter_next_follow_date == "")
           {
               check = 1;
               
                Swal.fire(
                    'Select Next Follow Up Date ?',
                    '',
                    'question'
                    )
           }
          else if(enter_next_follow_time == "")
           {
               check = 1;
               
               Swal.fire(
                    'Select Next Follow Up Time ?',
                    '',
                    'question'
                    )
           }
           else if(check != 1)
           {
            $.ajax({
                url : "edit_follow_up_details",
                method : "POST",
                data :{id:id,lead_id:lead_id,follow_up_status:follow_up_status,follow_up_reason:follow_up_reason,enter_next_follow_date:enter_next_follow_date,enter_next_follow_time:enter_next_follow_time,follow_comment:follow_comment},
                beforeSend:function(){
                  $("#add_follow_up_btn").attr("disabled",true);  
                },
                success:function(response)
                {
                        Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Follow up has been added successfully',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    $("#edit_follow_up_btn").attr("disabled",false);  
                    $("#edit_model").modal("toggle");
                    $("#follow_up_concluded").val("");
                    $("#follow_up_reason").val("");
                    $("#enter_next_follow_date").val("");
                    $("#enter_next_follow_time").val("");
                    $("#follow_comment").val("");
                    
                    fetch_followups();
           }
           
       });
           }
       });
    
});
</script>