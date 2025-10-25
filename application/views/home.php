
<style>
    .box-body 
    {
    border-bottom-right-radius: 0px;
    border-bottom-left-radius: 0px;
    padding: 0px;
    }
    .td_class 
    {
        padding:0px;
        margin:0px;
    }
    .info-box 
    {
        min-height: 50px !important;
    }
    .info-box-icon 
    {
        height: 54px !important;
        line-height: 50px !important;
    }
.no_mar_pad
{
    margin-top:0px;
    margin-bottom:0px;
    padding-top:0px !important;
    padding-bottom:0px !important;
}
.box-header {
    padding: 4px;
}
.box-header>.box-tools {
    top: 0px;
}
.padd_left_right{
    padding-right: 10px;
    padding-left: 10px;
}
.scroll_table{
    max-height:255px;
}
table.dataTable thead th, table.dataTable thead td {
    padding: 1px 1px !important;
}
table.dataTable tbody th, table.dataTable tbody td {
    padding: 1px 1px !important;
}
.dataTables_wrapper .dataTables_filter input {
    padding: 0px !important;
}
.dataTables_wrapper .dataTables_length select {
    padding: 0px !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0em 0em !important;
}
.others {
    color:red;
}
.open_lead{
    cursor:pointer;
}
.open_prospect{
    cursor:pointer;
}

/*Calendar styles add by kgk on 2023-02-11*/
.calendar {
    display: flex;
    flex-flow: column;
}
.calendar .header .month-year {
    font-size: 20px;
    font-weight: bold;
    color: #636e73;
    padding: 20px 0;
}
.calendar .days {
    display: flex;
    flex-flow: wrap;
}
.calendar .days .day_name {
    width: calc(100% / 7);
    border-right: 1px solid #2c7aca;
    padding: 20px;
    text-transform: uppercase;
    font-size: 12px;
    font-weight: bold;
    color: #818589;
    color: #fff;
    background-color: #448cd6;
}
.calendar .days .day_name:nth-child(7) {
    border: none;
}
.calendar .days .day_num {
    display: flex;
    flex-flow: column;
    width: calc(100% / 7);
    border-right: 1px solid #e6e9ea;
    border-bottom: 1px solid #e6e9ea;
    padding: 15px;
    font-weight: bold;
    color: #7c878d;
    cursor: pointer;
    min-height: 100px;
}
.calendar .days .day_num span {
    display: inline-flex;
    width: 30px;
    font-size: 14px;
}
.calendar .days .day_num .event {
    margin-top: 10px;
    font-weight: 500;
    font-size: 14px;
    padding: 3px 6px;
    border-radius: 4px;
    background-color: #f7c30d;
    color: #fff;
    word-wrap: break-word;
}
.calendar .days .day_num .event.green {
    background-color: #51ce57;
}
.calendar .days .day_num .event.blue {
    background-color: #518fce;
}
.calendar .days .day_num .event.red {
    background-color: #ce5151;
}
.calendar .days .day_num:nth-child(7n+1) {
    border-left: 1px solid #e6e9ea;
}
.calendar .days .day_num:hover {
    background-color: #fdfdfd;
}
.calendar .days .day_num.ignore {
    background-color: #fdfdfd;
    color: #ced2d4;
    cursor: inherit;
}
.calendar .days .day_num.selected {
    background-color: #f1f2f3;
    cursor: inherit;
}
/* end calendar style*/

@media only screen and (max-width: 600px) {
.box-header>.fa, .box-header>.glyphicon, .box-header>.ion, .box-header .box-title {
    display: inline-block;
    font-size: 14px;
    margin: 0;
    line-height: 1;
}
}
</style>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!--<section class="content-header">-->
        <!--  <h1>-->
        <!--    Dashboard-->
        <!--    <small> Summary</small>-->
        <!--  </h1>-->
        <!--  <ol class="breadcrumb">-->
        <!--    Summary Period-->
        <!--  </ol>-->
        <!--</section>-->
        <!-- Main content -->
        <section class="content">
        
          <!-- Default box -->
          <div class="row">
               <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-blue open_lead">
                    <span class="info-box-icon"><i class="fa fa-bullseye"></i></span>
                    <div class="info-box-content">
                    <!--<span class="info-box-text">Likes</span>-->
                    <span class="info-box-number"><?php echo $open_lead_count ." &  ".$open_new_lead_count; ?></span>
                    <!--<div class="progress">-->
                    <!--<div class="progress-bar" style="width: 70%"></div>-->
                    <!--</div>-->
                    <span class="progress-description">
                    Open Leads Next 30 Days & New Business
                    </span>
                    </div>
                    
                    </div>
                    
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-green open_prospect">
                    <span class="info-box-icon"><i class="fa fa-diamond"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-number"><?php echo $open_prospect_count." ( ".$open_prospect_renewal_count." )"; ?></span>
                    <span class="progress-description">
                    Open Prospect (Renewals)
                    </span>
                    </div>
                    
                    </div>
                    
                </div> 
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box" id="active_policy_div" style="background-color:#00c0ef;color:#fff;">
                    <span class="info-box-icon"><i class="fa fa-file"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-number"><?php echo $active_policy_count; ?></span>
                    <span class="progress-description">
                    Active Policies
                    </span>
                    </div>
                    
                    </div>
                    
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-purple" id="active_customer_div">
                    <span class="info-box-icon"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-number"><?php echo $active_policy_count; ?></span>
                    <span class="progress-description">
                    Active Clients
                    </span>
                    </div>
                    
                    </div>
                    
                </div>
            </div>
          <div class="box">
            <div class="box-body" style="background-color: #ecf0f5;">
                <div class="row">
                    <div class="col-md-6 padd_left_right">
                      <div class="box box-info" style="max-height: 290px;">
                        <div class="box-header with-border">
                        <h3 class="box-title">Today Followups</h3>
                        <div class="box-tools pull-right">
                        <a href="followups" class="btn btn-xs btn-info"><i class="fa fa-eye"></i>
                        View all</a> 
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        </div>
                        
                        <div class="box-body">
                        <div class="table-responsive scroll_table">
                        <table class="table no-margin">
                        <tbody>
                            <?php $classification = ""; foreach($followup_dashboard as $fd){ ?>
                            <?php if($fd->lead_type == "1"){ $classification = "prospect"; } else if($fd->classfication == 1){ $classification = "hot"; } else if($fd->classfication == 2){ $classification = "warm"; } else if($fd->classfication == 3){ $classification = "cool"; }?>
                                <tr>
                                    <td class = "no_mar_pad"><i class="fa fa-diamond" style="padding-right:10px;" aria-hidden="true"></i><a href="followups"><span style="color:black">You have a followup with <?php echo $classification; ?> </span> <?php echo " ".$fd->client_name; ?>  <span style="color:black"><?php echo " at ".date("h:i a", strtotime($fd->next_follow_up_time)); ?> ( Reason: <?php echo $fd->reason; ?> ) </span></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        </table>
                        </div>
                        
                        </div>
                        
                        </div>
                        
                        <!--Lead summary-->
                        
                        <div class="box box-info">
                        <div class="box-header with-border">
                        <h3 class="box-title">Lead Summary</h3>
                        <div class="box-tools pull-right">
                            <label id="lead_filter_date"></label>
                            <select id="lead_select">
                                <option value="Noduedate">No Due Date</option>
                                <option value="Overdue">Overdue</option>
                                <option value="All" selected>All</option>
                                <option value="Today">Today</option>
                                <option value="Tommorrow">Tommorrow</option>
                                <option value="Next 7 days">Next 7 days</option>
                                <option value="Next 30 days">Next 30 days</option>
                                <option value="This month">This month</option>
                                <!--<option value="Last month">Last month</option>-->
                                <option value="Next 3 months">Next 3 months</option>
                                <option value="custom">Custom Range</option>
                            </select>
                            <a href="leads" class="btn btn-xs btn-info"><i class="fa fa-eye"></i>
                        View details</a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        </div>
                        <div class="box-body">
                        <div class="table-responsive">
                        <table class="table no-margin">
                        <thead>
                        <tr>
                            <th class = "no_mar_pad" style="width:70%;">Classification</th>
                            <th class = "no_mar_pad" style="width:10%; text-align: right;">Open</th>
                            <th class = "no_mar_pad" style="width:10%; text-align: right;">Followup</th>
                            <th class = "no_mar_pad" style="text-align: right;">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                       
                        <tr>
                            <td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="leads">Hot</a></td>
                            <td class = "no_mar_pad" style="text-align: right;"><a href="leads" id="hot_open" style="color:black;"><?php echo $hot_open_count; ?></a></td>
                            <td class = "no_mar_pad" style="text-align: right;"><a href="leads" id="hot_followup" style="color:black;"><?php echo $hot_followup_count; ?></a></td>
                            <td class = "no_mar_pad" style="text-align: right;"><a href="leads" id="hot_total" style="color:black;"><?php echo $hot_open_count + $hot_followup_count; ?></a></td>
                        </tr>
                        
                        <tr>
                            <td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="leads?tab=warm">Warm</a></td>
                            <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="warm_open" href="leads"><?php echo $warm_open_count; ?></a></td>
                            <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="warm_followup" href="leads"><?php echo $warm_followup_count; ?></a></td>
                            <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="warm_total" href="leads"><?php echo $warm_open_count + $warm_followup_count; ?></a></td>
                        </tr>
                        <tr>
                            <td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="leads?tab=cold">Cold</a></td>
                            <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="cold_open" href="leads"><?php echo $cold_open_count; ?></a></td>
                            <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="cold_followup" href="leads"><?php echo $cold_followup_count; ?></a></td>
                            <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="cold_total" href="leads"><?php echo $cold_open_count + $cold_followup_count; ?></a></td>
                        </tr>
                        <tr>
                            <td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="leads?tab=prospect">Prospect</a></td>
                            <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="prospect_open" href="leads"><?php echo $prospect_open_count; ?></a></td>
                            <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="prospect_followup" href="leads"><?php echo $prospect_followup_count; ?></a></td>
                            <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="prospect_total" href="leads"><?php echo $prospect_open_count + $prospect_followup_count; ?></a></td>
                        </tr>
                        <tr>
                            <td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="generate_policy1">Completed</a></td>
                            <td></td><td></td><td class = "no_mar_pad" style="text-align: right;"><a id="completed_total" style="color:black;" href="leads"><?php echo $completed; ?></a></td>
                        </tr>
                        </tbody>
                        </table>
                        </div>
                        </div>
                        </div>
                        
                        
              
               <?php if($this->session->has_userdata('logged_in')) 
                {
                        if(($this->session->userdata('session_role') == "admin") || ($this->session->userdata('session_role') == "user")){
                ?>
                        <!--Staff-->
                         <div class="box box-info">
                        <div class="box-header with-border">
                        <h3 class="box-title">FOE</h3> 
                        <div class="box-tools pull-right">
                            <button class="btn btn-xs btn-info" onclick="load_staff_date_filter_data()" >Load >></button>
                            <label id="staff_filter_date"></label>
                            <select id="staff_date_filter_select">
                               <option value="Noduedate">No Due Date</option>
                                <option value="Overdue">Overdue</option>
                                <option value="All" selected>All</option>
                                <option value="Today">Today</option>
                                <option value="Tommorrow">Tommorrow</option>
                                <option value="Next 7 days">Next 7 days</option>
                                <option value="Next 30 days">Next 30 days</option>
                                <option value="This month">This month</option>
                                <option value="Next month">Next month</option>
                                <option value="Next 3 months">Next 3 months</option>
                                <option value="custom">Custom Range</option>
                            </select>
                            <a href="leads" id="staff_href" class="btn btn-xs btn-info"><i class="fa fa-eye"></i>
                        View details</a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        </div>
                        <div class="box-body">
                        <div class="table-responsive">
                        <table class="table no-margin">
                        <thead>
                        <tr>
                        <th class = "no_mar_pad" style="width:50%;">FOE</th>
                        <th class = "no_mar_pad" style="width:10%; text-align: right;">Open</th>
                        <th class = "no_mar_pad" style="width:10%; text-align: right;">Followup</th>
                        <th class = "no_mar_pad" style="width:10%; text-align: right;">Completed</th>
                        <th class = "no_mar_pad" style="width:10%; text-align: right;">Lost</th>
                        <th class = "no_mar_pad" style="text-align: right;">Total</th>
                        </tr>
                        </thead>
                        <tbody id="staff_tbody">
                        <?php //echo $staff_dash; ?>
                        </tbody>
                        <tfoot>
                            <?php //if($is_staff_load_more_available){ ?>
                                <!--<tr><td><button class='btn btn-xs btn-info' id='load_more_staff_btn'> Loadmore </button></td></tr>-->
                            <?php // } else { ?>
                                <tr><td><button class='btn btn-xs btn-info hidden' id='load_more_staff_btn'> Loadmore </button></td></tr>
                            <?php //} ?>
                        </tfoot>
                        </table>
                        </div>
                        </div>
                        </div>
                        <!--Staff-->
                        
                    <?php 
                        }}
                    ?>
                
                <?php if($this->session->has_userdata('logged_in')) 
                {
                        if(($this->session->userdata('session_role') == "admin") || ($this->session->userdata('session_role') == "user")){
                ?>
                        
                        <!--Area incharge-->
                
                         <div class="box box-info">
                        <div class="box-header with-border">
                        <h3 class="box-title">Area Incharge</h3>
                        <div class="box-tools pull-right">
                            <input type="hidden" id="ai_offset" name="ai_offset" value="0" />
                            <button class="btn btn-xs btn-info" onclick="load_ai_date_filter_data('init')" >Load >></button>
                            <label id="ai_filter_date"></label>
                            <select id="ai_date_filter_select">
                                 <option value="Noduedate">No Due Date</option>
                                <option value="Overdue">Overdue</option>
                                <option value="All" selected>All</option>
                                <option value="Today">Today</option>
                                <option value="Tommorrow">Tommorrow</option>
                                <option value="Next 7 days">Next 7 days</option>
                                <option value="Next 30 days">Next 30 days</option>
                                <option value="This month">This month</option>
                                <option value="Next month">Next month</option>
                                <option value="Next 3 months">Next 3 months</option>
                                <option value="custom">Custom Range</option>
                            </select>
                            <a href="leads" id="ai_href" class="btn btn-xs btn-info"><i class="fa fa-eye"></i>
                        View details</a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        </div>
                        <div class="box-body">
                        <div class="table-responsive">
                        <table class="table no-margin">
                        <thead>
                        <tr>
                        <th class = "no_mar_pad" style="width:50%;">AI</th>
                        <th class = "no_mar_pad" style="width:10%; text-align: right;">Open</th>
                        <th class = "no_mar_pad" style="width:10%; text-align: right;">Followup</th>
                        <th class = "no_mar_pad" style="width:10%; text-align: right;">Completed</th>
                        <th class = "no_mar_pad" style="width:10%; text-align: right;">Lost</th>
                        <th class = "no_mar_pad" style="text-align: right;">Total</th>
                        </tr>
                        </thead>
                        <tbody id="ai_tbody">
                        <?php //echo $ai_dash; ?>
                        </tbody>
                        <tfoot>
                            <?php //if($is_ai_load_more_available){ ?>
                                <!--<tr><td><button class='btn btn-xs btn-info' id='load_more_ai_btn'> Loadmore </button></td></tr>-->
                            <?php //} else { ?>
                                <tr><td><button class='btn btn-xs btn-info hidden' id='load_more_ai_btn'> Loadmore </button></td></tr>
                            <?php // } ?>
                        </tfoot>
                        </table>
                        </div>
                        </div>
                        </div>
                        
                      <?php 
                        }
                        else if($this->session->userdata('session_role') == "AI"){
                       ?>
                            <!--Area incharge-->
                
                         <div class="box box-info">
                        <div class="box-header with-border">
                        <h3 class="box-title">Area Incharge</h3>
                        <div class="box-tools pull-right">
                            <label id="ai_filter_date"></label>
                            <select id="ai_date_filter_select">
                                 <option value="Noduedate">No Due Date</option>
                                <option value="Overdue">Overdue</option>
                                <option value="All" selected>All</option>
                                <option value="Today">Today</option>
                                <option value="Tommorrow">Tommorrow</option>
                                <option value="Next 7 days">Next 7 days</option>
                                <option value="Next 30 days">Next 30 days</option>
                                <option value="This month">This month</option>
                                <option value="Next month">Next month</option>
                                <option value="Next 3 months">Next 3 months</option>
                                <option value="custom">Custom Range</option>
                            </select>
                            <a href="leads" id="ai_href" class="btn btn-xs btn-info"><i class="fa fa-eye"></i>
                        View details</a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        </div>
                        <div class="box-body">
                        <div class="table-responsive">
                        <table class="table no-margin">
                        <thead>
                        <tr>
                        <th class = "no_mar_pad" style="width:50%;" id="agent_pos_th">User</th>
                        <th class = "no_mar_pad" style="width:10%; text-align: right;">Open</th>
                        <th class = "no_mar_pad" style="width:10%; text-align: right;">Followup</th>
                        <th class = "no_mar_pad" style="width:10%; text-align: right;">Completed</th>
                        <th class = "no_mar_pad" style="width:10%; text-align: right;">Lost</th>
                        <th class = "no_mar_pad" style="text-align: right;">Total</th>
                        </tr>
                        </thead>
                        <tbody id="ai_tbody">
                        <?php //echo $ai_dash; ?>
                        </tbody>
                        <tfoot>
                            <?php //if($is_ai_load_more_available){ ?>
                                <!--<tr><td><button class='btn btn-xs btn-info' id='load_more_ai_btn'> Loadmore </button></td></tr>-->
                            <?php //} else { ?>
                                <tr><td><button class='btn btn-xs btn-info hidden' id='load_more_ai_btn'> Loadmore </button></td></tr>
                            <?php //} ?>
                        </tfoot>
                        </table>
                        </div>
                        </div>
                        </div>
                        <?php }
                      }
                      ?>
                      
                      <!--Area incharge-->
                    </div>
                    <div class="col-md-6 padd_left_right">
                        <div class="box box-info" style="max-height: 290px;">
                        <div class="box-header with-border">
                        <select id="prospect_select">
                            <option value="psv">Prospect summary view</option>
                            <option value="pdv">Lead detail view</option>
                        </select>
                        <div class="box-tools pull-right">
                            <label class="hidden" id="prospect_due_select_label">Due date</label>
                            <select class="hidden" id="prospect_due_date_select">
                                <option value="All" selected>All</option>
                                <option value="Overdue">Overdue</option>
                                <option value="7 days">7 days</option>
                                <option value="8-15 days">8-15 days</option>
                                <option value="16-30 days">16-30 days</option>
                                <option value="31-45 days">31-45 days</option>
                            </select>
                            <label id="prospect_lead_filter_date"></label>
                            <select id="prospect_lead_select">
                                <option value="All" selected>All</option>
                                <option value="Today">Today</option>
                                <option value="Yesterday">Yesterday</option>
                                <option value="Last 7 days">Last 7 days</option>
                                <option value="Last 30 days">Last 30 days</option>
                                <option value="This month">This month</option>
                                <option value="Last month">Last month</option>
                                <option value="Last 3 months">Last 3 months</option>
                                <option value="custom">Custom Range</option>
                            </select>
                            <a href="leads" class="btn btn-xs btn-info"><i class="fa fa-eye"></i>
                        View details</a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        </div>
                        <div class="box-body">
                        <div class="table-responsive" id="prospect_summary_div">
                        <table class="table no-margin">
                        <thead>
                        <tr>
                        <th class = "no_mar_pad" style="width:32%;">Prospect Status</th>
                        <th class = "no_mar_pad" style="width:17%; text-align: right;">Renewal</th>
                        <th class = "no_mar_pad" style="width:17%; text-align: right;">Rollover</th>
                        <th class = "no_mar_pad" style="width:17%; text-align: right;">New Bussiness</th>
                        <th class = "no_mar_pad" style="text-align: right;">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        <td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="leads?tab=prospect">Interest Open</a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a href="leads" id="interest_renewal" style="color:black;"><?php echo $prospect_open_renewal_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a href="leads" id="interest_rollover" style="color:black;"><?php echo $prospect_open_rollover_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a href="leads" id="interest_new_bussiness" style="color:black;"><?php echo $prospect_open_new_bussiness_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a href="leads" id="interest_total" style="color:black;"><?php echo $prospect_open_count = $prospect_open_renewal_count + $prospect_open_rollover_count + $prospect_open_new_bussiness_count; ?></a></td>
                        </tr>
                        <tr>
                        <td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="followups">Followup</a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="followup_renewal" href="leads"><?php echo $prospect_followup_renewal_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="followup_rollover" href="leads"><?php echo $prospect_followup_rollover_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="followup_new_bussiness" href="leads"><?php echo $prospect_followup_new_bussiness_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="followup_total" href="leads"><?php echo $prospect_followup_count = $prospect_followup_renewal_count + $prospect_followup_rollover_count + $prospect_followup_new_bussiness_count; ?></a></td>
                        </tr>
                        <!--<tr>-->
                        <!--<td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="leads?tab=prospect">Quatation Generated</a></td>-->
                        <!--<td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" href="leads">0</a></td>-->
                        <!--<td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" href="leads">0</a></td>-->
                        <!--<td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" href="leads">0</a></td>-->
                        <!--<td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" href="leads">0</a></td>-->
                        <!--</tr>-->
                        <tr>
                        <td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="leads?tab=prospect">Quotation Sent</a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" href="leads"><?php echo $quote_policy_renewal_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" href="leads"><?php echo $quote_policy_rollover_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" href="leads"><?php echo $quote_policy_new_bussiness_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" href="leads"><?php echo $total_quote = $quote_policy_renewal_count+$quote_policy_rollover_count+$quote_policy_new_bussiness_count; ?></a></td>
                        </tr>
                        <!--<tr>-->
                        <!--<td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="leads?tab=prospect">Payment Collection</a></td>-->
                        <!--<td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" href="leads"><?php echo $prospect_policy_renewal_count; ?></a></td>-->
                        <!--<td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" href="leads"><?php echo $prospect_policy_rollover_count; ?></a></td>-->
                        <!--<td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" href="leads"><?php echo $prospect_policy_new_bussiness_count; ?></a></td>-->
                        <!--<td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" href="leads"><?php echo $prospect_policy_count = $prospect_policy_new_bussiness_count + $prospect_policy_renewal_count + $prospect_policy_rollover_count; ?></a></td>-->
                        <!--</tr>-->
                        <tr>
                        <td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="leads?tab=prospect">Payment Collected</a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" href="leads"><?php echo $prospect_complete_renewal_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" href="leads"><?php echo $prospect_complete_rollover_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" href="leads"><?php echo $prospect_lost_new_bussiness_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" href="leads"><?php echo $prospect_complete_count = $prospect_complete_new_bussiness_count + $prospect_complete_renewal_count + $prospect_complete_rollover_count; ?></a></td>
                        </tr>
                        
                        <!--<tr>-->
                        <!--<td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="generate_policy1">Policy Generated</a></td>-->
                        <!--<td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="policy_renewal" href="leads"><?php echo $prospect_policy_renewal_count; ?></a></td>-->
                        <!--<td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="policy_rollover" href="leads"><?php echo $prospect_policy_rollover_count; ?></a></td>-->
                        <!--<td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="policy_new_bussiness" href="leads"><?php echo $prospect_policy_new_bussiness_count; ?></a></td>-->
                        <!--<td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="policy_total" href="leads"><?php echo $prospect_policy_count = $prospect_policy_new_bussiness_count + $prospect_policy_renewal_count + $prospect_policy_rollover_count; ?></a></td>-->
                        <!--</tr>-->
                        
                        <tr>
                        <td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="generate_policy1">Bussiness Complete</a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="complete_renewal" href="leads"><?php echo $prospect_policy_renewal_count + $prospect_complete_renewal_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="complete_rollover" href="leads"><?php echo $prospect_policy_rollover_count + $prospect_complete_rollover_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="complete_new_bussiness" href="leads"><?php echo $prospect_policy_new_bussiness_count + $prospect_complete_new_bussiness_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="complete_total" href="leads"><?php echo $prospect_policy_renewal_count + $prospect_policy_rollover_count + $prospect_policy_new_bussiness_count + $prospect_complete_count = $prospect_complete_new_bussiness_count + $prospect_complete_renewal_count + $prospect_complete_rollover_count; ?></a></td>
                        </tr>
                        
                        <tr>
                        <td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="leads?tab=prospect">Lost</a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="lost_renewal" href="leads"><?php echo $prospect_lost_renewal_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="lost_rollover" href="leads"><?php echo $prospect_lost_rollover_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="lost_new_bussiness" href="leads"><?php echo $prospect_lost_new_bussiness_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="lost_total" href="leads"><?php echo $prospect_lost_count = $prospect_lost_new_bussiness_count + $prospect_lost_renewal_count + $prospect_lost_rollover_count; ?></a></td>
                        </tr>
                        <tr>
                        <td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="leads">Total</a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="renewal_total" href="leads"><?php echo $prospect_open_renewal_count + $prospect_followup_renewal_count + $prospect_complete_renewal_count + $prospect_policy_renewal_count + $prospect_lost_renewal_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="rollover_total" href="leads"><?php echo $prospect_open_rollover_count + $prospect_followup_rollover_count + $prospect_policy_rollover_count + $prospect_complete_rollover_count + $prospect_lost_rollover_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="new_bussiness_total" href="leads"><?php echo $prospect_open_new_bussiness_count + $prospect_followup_new_bussiness_count + $prospect_policy_new_bussiness_count + $prospect_complete_new_bussiness_count + $prospect_lost_new_bussiness_count; ?></a></td>
                        <td class = "no_mar_pad" style="text-align: right;"><a style="color:black;" id="total_total" href="leads"><?php echo $prospect_open_count + $prospect_followup_count + $prospect_complete_count + $prospect_policy_count + $prospect_lost_count; ?></a></td>
                        </tr>
                        </tbody>
                        </table>
                        </div>
                        <div id="prospect_datatable" style="padding:5px;" >
                        </div>
                        </div>
                        </div>
                        <!--Agent POS-->
                         <div class="box box-info">
                        <div class="box-header with-border">
                        <h3 class="box-title">Agent / POS</h3>
                        <div class="box-tools pull-right">
                            <input type="hidden" id="offset" name="offset" value="0" />
                            <button class="btn btn-xs btn-info" onclick="document.getElementById('offset').value=0;load_agent_date_filter_data()" >Load >></button>
                            <label id="agent_filter_date"></label>
                            <select id="agent_date_filter_select">
                                 <option value="Noduedate">No Due Date</option>
                                <option value="Overdue">Overdue</option>
                                <option value="All" selected>All</option>
                                <option value="Today">Today</option>
                                <option value="Tommorrow">Tommorrow</option>
                                <option value="Next 7 days">Next 7 days</option>
                                <option value="Next 30 days">Next 30 days</option>
                                <option value="This month">This month</option>
                                <option value="Next month">Next month</option>
                                <option value="Next 3 months">Next 3 months</option>
                                <option value="custom">Custom Range</option>
                            </select>
                            <select id="agent_pos_select">
                                <option value="agent" selected>Agent</option>
                                <option value="pos">POS</option>
                            </select>
                            <a href="create_agent" id="agent_pos_href" class="btn btn-xs btn-info"><i class="fa fa-eye"></i>
                        View details</a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        </div>
                        <div class="box-body">
                        <div class="table-responsive">
                        <table class="table no-margin">
                        <thead>
                        <tr>
                        <th class = "no_mar_pad" style="width:50%;" id="agent_pos_th">Agent</th>
                        <th class = "no_mar_pad" style="width:10%; text-align: right;">Open</th>
                        <th class = "no_mar_pad" style="width:10%; text-align: right;">Followup</th>
                        <th class = "no_mar_pad" style="width:10%; text-align: right;">Completed</th>
                        <th class = "no_mar_pad" style="width:10%; text-align: right;">Lost</th>
                        <th class = "no_mar_pad" style="text-align: right;">Total</th>
                        </tr>
                        </thead>
                        <tbody id="agent_pos_tbody">
                        <?php //echo $agent_dash; ?>
                        </tbody>
                        <tfoot>
                            <?php //if($is_load_more_available){ ?>
                                <!--<tr><td><button class='btn btn-xs btn-info' id='load_more_agent_btn'> Loadmore </button></td></tr>-->
                            <?php //} else { ?>
                                <tr><td><button class='btn btn-xs btn-info hidden' id='load_more_agent_btn'> Loadmore </button></td></tr>
                            <?php //} ?>
                        </tfoot>
                        </table>
                        </div>
                        </div>
                        </div>
                        <!--Agent POS-->
                         
                    </div>
                    <div class="col-md-6 padd_left_right">
                        <!--Renewals-->
                         <div class="box box-info">
                        <div class="box-header with-border">
                        <h3 class="box-title">Renewals</h3>
                        <div class="box-tools pull-right">
                            <input type="hidden" id="renewals_offset" name="renewals_offset" value="0" />
                            <button class="btn btn-xs btn-info" onclick="document.getElementById('renewals_offset').value=0;load_renewals_info()">Load >></button>
                            <label id="filter_date"></label>
                            <select id="filter_type">
                                <option value="Today">Today</option>
                                <option value="Tommorrow">Tommorrow</option>
                                <option value="Next 7 days">Next 7 days</option>
                                <option value="Next 30 days">Next 30 days</option>
                                <option value="This month">This month</option>
                                <option value="Next month">Next month</option>
                                <option value="Next 3 months">Next 3 months</option>
                                <!--<option value="custom">Custom Range</option>-->
                            </select>
                            <select id="filter_role">
                                <option value="agent" selected>Agent</option>
                                <option value="pos">POS</option>
                            </select>
                            <a href="#" id="renewals_href" class="btn btn-xs btn-info"><i class="fa fa-eye"></i>
                        View details</a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        </div>
                        <div class="box-body">
                        <div class="table-responsive">
                        <table class="table no-margin">
                        <thead>
                        <tr>
                        <th class = "no_mar_pad" style="width:50%;" id="renewals_th">Name</th>
                        <th class = "no_mar_pad" style="width:50%; text-align: left;">Renewals</th>                                               
                        </tr>
                        </thead>
                        <tbody id="renewals_tbody">
                        <?php //echo $agent_dash; ?>
                        </tbody>
                        <tfoot>
                            <?php //if($is_load_more_available){ ?>
                                <!--<tr><td><button class='btn btn-xs btn-info' id='load_more_agent_btn'> Loadmore </button></td></tr>-->
                            <?php //} else { ?>
                                <tr><td><button class='btn btn-xs btn-info hidden' id='load_more_renewals'> Loadmore </button></td></tr>
                            <?php //} ?>
                        </tfoot>
                        </table>
                        </div>
                        </div>
                        </div>
                        <!--renewals-->
                    </div>
                    
                    <div class="col-md-6 padd_left_right">
                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Renewals Calender //-->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Renewals Calendar</h3>
                                <div class="box-tools">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                       <div class="form-group" style="padding:5px;">
                                            <label for="month">
                                                Month
                                            </label>
                                            <select class="form-control" id="month" name="month" style="width:50%" onchange="displayCalendar()">
                                                <option value="">Select Month</option>
                                                <?php if( isset( $monthlist ) && !empty( $monthlist ) ):?>
                                                    <?php foreach( $monthlist as $month => $month_name ):?>
                                                        <option value="<?=$month?>" <?=($current_month == $month) ? "selected" : ""?>><?=$month_name?></option>
                                                    <?php endforeach;?>
                                                <?php endif;?>
                                            </select>
                                        </div> 
                                    </div>
                                    <?php if($this->session->userdata('session_role') == "admin"):?>
                                    <div class="col-md-4">
                                        <div class="form-group" style="padding:5px;">
                                            <label for="search_by">
                                                Search By
                                            </label>
                                            <select class="form-control" id="search_by" name="search_by" style="width:50%" onchange="getSearchBy(this.value)">
                                                <option value="">Select </option>
                                                <?php if( isset( $searchbylist ) && !empty( $searchbylist ) ):?>
                                                    <?php foreach( $searchbylist as $searchby => $searchby_name ):?>
                                                        <option value="<?=$searchby?>"><?=$searchby_name?></option>
                                                    <?php endforeach;?>
                                                <?php endif;?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" style="padding:5px;">
                                            <label for="search_id">
                                                Search
                                            </label>
                                            <br/>
                                            <select class="form-control select2" id="search_id" name="search_id" style="width:50%" onchange="displayCalendar()">
                                            </select>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                </div>
                                <div class="col-md-12">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                            
                        </div>                            
                       <!-- end calendar //-->
                    </div>
                </div>
            </div><!-- /.box-body -->   
            
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
     <!--date filter model-->
     <div class="modal fade in" id="date_filter_model">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Select Summary period</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>From Date</label>
                    <input type="date" class="form-control pull-right" id="from_date_filter">
                </div>
                <div class="form-group">
                    <label>To Date</label>
                    <input type="date" class="form-control pull-right" id="to_date_filter">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" id="date_filter_submit">Submit</button>
                <button type="button" class="btn btn-sm btn-danger pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>
  
  <!-- Renewals Details Model by kgk on 20223-02-14//-->
  <div id="model-result"></div>
      
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

      <script>
      var lead_select = "";
      var filter_date_click = "";
      var staff_filter_date_click = false;
      var ai_filter_date_click = false;
      var prospect_select = "";
      var agent_date_filter_select = "All";
      var staff_date_filter_select = "All";
      var ai_date_filter_select = "All";
      //load_agent_date_filter_data();
      //load_staff_date_filter_data();
      
      var renewals_date_filter_select = "Today";
      
    <?php if($this->session->userdata("session_role") == "AI")
    { ?>
      load_ai_date_filter_data('init');
    <?php } ?>
      var agent_filter_date_click = false;
      var from_date = "";
      var to_date = "";
      var formated_from_date = "";
      var formated_to_date = "";
      var agent_from_date = "all";
      var agent_to_date = "all";
      var agent_formated_from_date = "";
      var agent_formated_to_date = "";
      
      var staff_from_date = "all";
      var staff_to_date = "all";
      var staff_formated_from_date = "";
      var staff_formated_to_date = "";
      
      var ai_from_date = "all";
      var ai_to_date = "all";
      var ai_formated_from_date = "";
      var ai_formated_to_date = "";
      
      var prospect_due_date = "All";
      var agent_page_no = 1;
      var staff_page_no = 1;
      var ai_page_no = 1;
      
      function load_lead_filter_data()
      {
            $.ajax({
               url:"lead_summary_with_date",
               data:{
                   lead_select:lead_select,
                   from_date:from_date,
                   to_date:to_date,
               },
               method:"POST",
               success:function(response){
                   var obj = jQuery.parseJSON(response);
                   $("#hot_open").html(obj["data"].hot_open_count);
                   $("#hot_followup").html(obj["data"].hot_followup_count);
                   $("#hot_total").html(obj["data"].hot_open_count + obj["data"].hot_followup_count);
                   $("#warm_open").html(obj["data"].warm_open_count);
                   $("#warm_followup").html(obj["data"].warm_followup_count);
                   $("#warm_total").html(obj["data"].warm_open_count + obj["data"].warm_followup_count);
                   $("#cold_open").html(obj["data"].cold_open_count);
                   $("#cold_followup").html(obj["data"].cold_followup_count);
                   $("#cold_total").html(obj["data"].cold_open_count + obj["data"].cold_followup_count);
                   $("#prospect_open").html(obj["data"].prospect_open_count);
                   $("#prospect_followup").html(obj["data"].prospect_followup_count);
                   $("#prospect_total").html(obj["data"].prospect_open_count + obj["data"].prospect_followup_count);
                   $("#completed_total").html(obj["data"].completed);
                   if(lead_select == "custom")
                   {
                        formated_from_date = obj["from_date"];
                        formated_to_date = obj["to_date"];
                        $("#lead_filter_date").html(formated_from_date+" - "+formated_to_date);
                   }
                   else
                   {
                       $("#lead_filter_date").html("");
                   }
               },
               error:function(code){
                 alert(code.statusText);  
               },
            });
      }
      
      function load_prospect_filter_data()
      {
          $.ajax({
               url:"prospect_summary_with_date",
               data:{
                   prospect_select:prospect_select,
                   from_date:from_date,
                   to_date:to_date,
               },
               method:"POST",
               success:function(response){
                   var obj = jQuery.parseJSON(response);
                   var open_total = obj["data"].prospect_open_renewal_count + obj["data"].prospect_open_rollover_count + obj["data"].prospect_open_new_bussiness_count;
                   var followup_total = obj["data"].prospect_followup_renewal_count + obj["data"].prospect_followup_rollover_count + obj["data"].prospect_followup_new_bussiness_count;
                   var complete_total = obj["data"].prospect_complete_renewal_count + obj["data"].prospect_complete_rollover_count + obj["data"].prospect_complete_new_bussiness_count;
                   var lost_total = obj["data"].prospect_lost_renewal_count + obj["data"].prospect_lost_rollover_count + obj["data"].prospect_lost_new_bussiness_count;
                   var policy_total = obj["data"].prospect_policy_renewal_count + obj["data"].prospect_policy_rollover_count + obj["data"].prospect_policy_new_bussiness_count; 
                   $("#interest_renewal").html(obj["data"].prospect_open_renewal_count);
                   $("#interest_rollover").html(obj["data"].prospect_open_rollover_count);
                   $("#interest_new_bussiness").html(obj["data"].prospect_open_new_bussiness_count);
                   $("#interest_total").html(open_total);
                   $("#followup_renewal").html(obj["data"].prospect_followup_renewal_count);
                   $("#followup_rollover").html(obj["data"].prospect_followup_rollover_count);
                   $("#followup_new_bussiness").html(obj["data"].prospect_followup_new_bussiness_count);
                   $("#followup_total").html(followup_total);
                   
                  $("#complete_renewal").html(obj["data"].prospect_complete_renewal_count);
                  $("#complete_rollover").html(obj["data"].prospect_complete_rollover_count);
                  $("#complete_new_bussiness").html(obj["data"].prospect_complete_new_bussiness_count);
                  $("#complete_total").html(complete_total);
                  
                  $("#lost_renewal").html(obj["data"].prospect_lost_renewal_count);
                  $("#lost_rollover").html(obj["data"].prospect_lost_rollover_count);
                  $("#lost_new_bussiness").html(obj["data"].prospect_lost_new_bussiness_count);
                  $("#lost_total").html(lost_total);
                   
                  $("#policy_renewal").html(obj["data"].prospect_policy_renewal_count);
                  $("#policy_rollover").html(obj["data"].prospect_policy_rollover_count);
                  $("#policy_new_bussiness").html(obj["data"].prospect_policy_new_bussiness_count);
                  $("#policy_total").html(policy_total);
                   
                   $("#renewal_total").html(obj["data"].prospect_open_renewal_count + obj["data"].prospect_followup_renewal_count + obj["data"].prospect_complete_renewal_count + obj["data"].prospect_policy_renewal_count);
                   $("#rollover_total").html(obj["data"].prospect_open_rollover_count + obj["data"].prospect_followup_rollover_count + obj["data"].prospect_complete_rollover_count + obj["data"].prospect_policy_rollover_count);
                   $("#new_bussiness_total").html(obj["data"].prospect_open_new_bussiness_count + obj["data"].prospect_followup_new_bussiness_count + obj["data"].prospect_complete_new_bussiness_count + obj["data"].prospect_policy_new_bussiness_count);
                   $("#total_total").html(open_total + followup_total + complete_total + policy_total + lost_total);
                  if(prospect_select == "custom")
                   {
                        formated_from_date = obj["from_date"];
                        formated_to_date = obj["to_date"];
                        $("#prospect_lead_filter_date").html(formated_from_date+" - "+formated_to_date);
                   }
                   else
                   {
                       $("#prospect_lead_filter_date").html("");
                   }
               },
               error:function(code){
                 alert(code.statusText);  
               },
            });
      }
      
      function load_staff_date_filter_data()
      {
            staff_date_filter_select = $("#staff_date_filter_select").val();
            
            $.ajax({
               url:"staff_dashboard",
               method:"POST",
               data:{
                   staff_date_filter_select:staff_date_filter_select,
                   staff_from_date:staff_from_date,
                   staff_to_date:staff_to_date
               },
               success:function(response){
                   obj = jQuery.parseJSON(response);
                   $("#staff_tbody").html(obj["html"]);
                   staff_formated_from_date = obj["from_date"];
                   staff_formated_to_date = obj["to_date"];
                   
                   if(obj["is_load_more_available"])
                   {
                       $("#load_more_staff_btn").removeClass("hidden");
                   }
                   else
                   {
                       $("#load_more_staff_btn").addClass("hidden");
                   }
                   if(staff_date_filter_select == "custom")
                   {
                       $("#staff_filter_date").html(staff_formated_from_date + " - " + staff_formated_to_date);
                   }
                   else
                   {
                       $("#staff_filter_date").html("");
                   }
               },
               error:function(code){
                 alert(code.statusText);  
               },
            });
      }
      
      function load_ai_date_filter_data(opt)
      {
            ai_date_filter_select = $("#ai_date_filter_select").val();
            var offset = (opt == 'init') ? 0 : $('#ai_offset').val();
            $.ajax({
               url:"ai_dashboard",
               method:"POST",
               data:{
                   ai_date_filter_select:ai_date_filter_select,
                   ai_from_date:ai_from_date,
                   ai_to_date:ai_to_date,
                   offset: offset
               },
               success:function(response){
                   obj = jQuery.parseJSON(response);
                   $("#ai_tbody").html(obj["html"]);
                   ai_formated_from_date = obj["from_date"];
                   ai_formated_to_date = obj["to_date"];
                   $('#ai_offset').val(obj["offset"]);
                   if(obj["is_load_more_available"])
                   {
                       $("#load_more_ai_btn").removeClass("hidden");
                   }
                   else
                   {
                       $("#load_more_ai_btn").addClass("hidden");
                   }
                   if(ai_date_filter_select == "custom")
                   {
                       $("#ai_filter_date").html(ai_formated_from_date + " - " + ai_formated_to_date);
                   }
                   else
                   {
                       $("#ai_filter_date").html("");
                   }
               },
               error:function(code){
                 alert(code.statusText);  
               },
            });
      }
      
      function load_agent_date_filter_data()
      {
            var agent_pos_select = $("#agent_pos_select").val();
            agent_date_filter_select = $("#agent_date_filter_select").val();
            var offset = $('#offset').val();
            if(agent_pos_select == "pos")
            {
                $("#agent_pos_href").attr("href","create_pos");
                $("#agent_pos_th").html("POS");
            }
            else
            {
                $("#agent_pos_href").attr("href","create_agent");
                $("#agent_pos_th").html("Agent");
            }
            $.ajax({
               url:"agent_pos_dashboard",
               method:"POST",
               data:{
                   agent_pos_select:agent_pos_select,
                   agent_date_filter_select:agent_date_filter_select,
                   agent_from_date:agent_from_date,
                   agent_to_date:agent_to_date,
                   offset:offset
               },
               success:function(response){
                   obj = jQuery.parseJSON(response);
                   $("#agent_pos_tbody").html(obj["html"]);
                   agent_formated_from_date = obj["from_date"];
                   agent_formated_to_date = obj["to_date"];
                   $('#offset').val(obj["offset"]);
                   if(obj["is_load_more_available"])
                   {
                       $("#load_more_agent_btn").removeClass("hidden");
                   }
                   else
                   {
                       $("#load_more_agent_btn").addClass("hidden");
                   }
                   if(agent_date_filter_select == "custom")
                   {
                       $("#agent_filter_date").html(agent_formated_from_date + " - " + agent_formated_to_date);
                   }
                   else
                   {
                       $("#agent_filter_date").html("");
                   }
               },
               error:function(code){
                 alert(code.statusText);  
               },
            });
      }
      
    function getSearchBy(searchby) {
        var tag = $('#search_id');
        tag.find('option').remove();
        if(searchby) {
            $.ajax({
                url:"<?=base_url('Main/getsearchby')?>",
                data:{
                    searchby:searchby
                },
                dataType: "json",
                success:function(response){
                    var size = Object.keys(response).length;
                    // console.log(size);
                    if(size > 0){
                        $.each(response, function(index, data){
                            // console.log(data);
                            tag.append('<option value="'+data.id+'">'+data.name+'</option>')
                        })
                    }
                },
                error:function(code){
                    alert(code.statusText);  
                },
            });
        } else {
            displayCalendar();
        }
    }
    // show renewals calender by kgk on 2023-02-11
    function displayCalendar() {
        var month = $('#month').val();
        if(month == "") {
          alert("Select Month");
          $("#calendar").html("");
          return;
        }
      
        if(month){
            $("#calendar").html("");
            $.ajax({
                url:"<?=base_url('Main/renewals_calendar')?>",
                data:{
                    month:month,
                    searchCol: $('#search_by').val(),
                    searchVal: $('#search_id').val()
                },
                success:function(response){
                    $("#calendar").html(response).show('slow');
                },
                error:function(code){
                    alert(code.statusText);  
                },
            });
        }
    }
      //kgk
      function load_renewals_info()
      {
            var filter_role = $("#filter_role").val();
            var filter_type = $("#filter_type").val();
            var offset      = $('#renewals_offset').val();
            
            if(filter_role == "pos")
            {
                $("#renewals_href").attr("href","create_pos");
                $("#renewals_th").html("POS");
            }
            else
            {
                $("#renewals_href").attr("href","create_agent");
                $("#renewals_th").html("Agent");
            }
            $.ajax({
               url:"renewals_info_dashboard",
               method:"POST",
               data:{
                   filter_role:filter_role,
                   filter_type:filter_type,
                   offset:offset
               },
               
               success:function(response){
                   obj = jQuery.parseJSON(response);
                   $("#renewals_tbody").html(obj["html"]);
                   
                   $('#renewals_offset').val(obj["offset"]);
                   if(response.is_load_more_available)
                   {
                       $("#load_more_renewals_btn").removeClass("hidden");
                   }
                   else
                   {
                       $("#load_more_agent_btn").addClass("hidden");
                   }
                   if(filter_type == "custom")
                   {
                       $("#filter_date").html(obj["fromdate"] + " - " + obj["todate"]);
                   }
                   else
                   {
                       $("#filter_date").html("");
                   }
               },
               error:function(code){
                 alert(code.statusText);  
               },
            });
      }
      
      //page load call renewals calendar by kgk on 2023-02-11
      $(document).ready(function(){
          displayCalendar();
          if($('.select2').length){
              $('.select2').select2();
          }
      });
      
    function getRenewalsDetails(duedate, type, policy)
    {
        $('#model-result').empty();
        if(duedate) {
            $.ajax({
               url:"<?=base_url('Renewalcontrol/getRenewalsDetails/')?>",
               data:{
                   date: duedate,
                   type: type,
                   policy: policy,
                   searchCol: $('#search_by').val(),
                   searchVal: $('#search_id').val()
               },
               success:function(response){
                   $('#model-result').html(response);
               },
               error:function(code){
                 alert(code.statusText);  
               },
            });
        }
    }
      
        $(document).ready(function(){
            $(".open_lead").click(function(){
               window.location.replace("leads"); 
            });
            $(".open_prospect").click(function(){
                window.location.replace("leads?tab=prospect");
            });
            $("#active_policy_div").click(function(){
                window.location.replace("generate_policy1");
            });
            $("#active_customer_div").click(function(){
                window.location.replace("customers");
            });
            $("#date_filter_submit").click(function(){
                if(agent_filter_date_click)
                {
                    agent_filter_date_click = false; 
                    agent_from_date = $("#from_date_filter").val();
                    agent_to_date = $("#to_date_filter").val();
                    if(agent_from_date == "")
                    {
                        snackbar_show("Select From Date");
                    }
                    else if(agent_to_date == "")
                    {
                        snackbar_show("Select To Date");
                    }
                    else if(agent_from_date > agent_to_date)
                    {
                        snackbar_show("To date is older than from date");
                    }
                    else
                    {
                        $("#offset").val('0');
                        load_agent_date_filter_data();
                        $("#date_filter_model").modal("hide");   
                    }
                    
                }
                else if(staff_filter_date_click)
                {
                    staff_filter_date_click = false; 
                    staff_from_date = $("#from_date_filter").val();
                    staff_to_date = $("#to_date_filter").val();
                    if(staff_from_date == "")
                    {
                        snackbar_show("Select From Date");
                    }
                    else if(staff_to_date == "")
                    {
                        snackbar_show("Select To Date");
                    }
                    else if(staff_from_date > staff_to_date)
                    {
                        snackbar_show("To date is older than from date");
                    }
                    else
                    {
                        load_staff_date_filter_data();
                        $("#date_filter_model").modal("hide");   
                    }
                }
                else if(ai_filter_date_click)
                {
                    ai_filter_date_click = false; 
                    ai_from_date = $("#from_date_filter").val();
                    ai_to_date = $("#to_date_filter").val();
                    if(ai_from_date == "")
                    {
                        snackbar_show("Select From Date");
                    }
                    else if(ai_to_date == "")
                    {
                        snackbar_show("Select To Date");
                    }
                    else if(ai_from_date > ai_to_date)
                    {
                        snackbar_show("To date is older than from date");
                    }
                    else
                    {
                        load_ai_date_filter_data('init');
                        $("#date_filter_model").modal("hide");   
                    }
                }
                else
                {
                     from_date = $("#from_date_filter").val();
                    to_date = $("#to_date_filter").val();
                    if(from_date == "")
                    {
                        snackbar_show("Select From Date");
                    }
                    else if(to_date == "")
                    {
                        snackbar_show("Select To Date");
                    }
                    else if(from_date > to_date)
                    {
                        snackbar_show("To date is older than from date");
                    }
                    else
                    {
                        if(filter_date_click == "lead")
                        {
                            load_lead_filter_data();
                        }
                        else if(filter_date_click == "prospect")
                        {
                            load_prospect_filter_data();
                        }
                        $("#date_filter_model").modal("hide");   
                    }
                }
            });
            
            $("#lead_select").change(function(){
                filter_date_click = "lead";
                lead_select = $("#lead_select").val();
                if(lead_select != "custom"){
                    load_lead_filter_data();
                }
                else
                {
                    $("#date_filter_model").modal("show");
                }
            });
            
            $("#lead_filter_date").click(function(){
                filter_date_click = "lead";
                lead_select = $("#lead_select").val();
                if(lead_select != "custom"){
                    //load_lead_filter_data();
                }
                else
                {
                    $("#date_filter_model").modal("show");
                }
            });
            
            
            
            $("#prospect_lead_select").change(function(){
            filter_date_click  = "prospect";
            prospect_select = $("#prospect_lead_select").val();
            if(prospect_select != "custom")
            {
                load_prospect_filter_data();
            }
            else
            {
                $("#date_filter_model").modal("show");
            }
          });
          
          $("#prospect_lead_filter_date").click(function(){
            filter_date_click  = "prospect";
            prospect_select = $("#prospect_lead_select").val();
            if(prospect_select != "custom")
            {
                //load_prospect_filter_data();
            }
            else
            {
                $("#date_filter_model").modal("show");
            }
          });
         
          
          $("#staff_filter_date").click(function(){
              
              staff_date_filter_select = $("#staff_date_filter_select").val();
              if(staff_date_filter_select != "custom")
            {
                //load_prospect_filter_data();
            }
            else
            {
                staff_filter_date_click = true;
                $("#date_filter_model").modal("show");
            }
          });
          
          $("#staff_date_filter_select").change(function(){
                staff_date_filter_select = $("#staff_date_filter_select").val();
                if(staff_date_filter_select != "custom"){
                    load_staff_date_filter_data();
                }
                else
                {
                    staff_filter_date_click = true;
                    $("#date_filter_model").modal("show");
                }
            });
            
            $("#ai_filter_date").click(function(){
              
              ai_date_filter_select = $("#ai_date_filter_select").val();
              if(ai_date_filter_select != "custom")
            {
                //load_prospect_filter_data();
            }
            else
            {
                ai_filter_date_click = true;
                $("#date_filter_model").modal("show");
            }
          });
          
          $("#ai_date_filter_select").change(function(){
                ai_date_filter_select = $("#ai_date_filter_select").val();
                if(ai_date_filter_select != "custom"){
                    load_ai_date_filter_data('init');
                }
                else
                {
                    ai_filter_date_click = true;
                    $("#date_filter_model").modal("show");
                }
            });
          
          $("#agent_date_filter_select").change(function(){
                agent_filter_date_click = true;
                agent_date_filter_select = $("#agent_date_filter_select").val();
                if(agent_date_filter_select != "custom"){
                    $("#offset").val('0');
                    load_agent_date_filter_data();
                }
                else
                {
                    $("#date_filter_model").modal("show");
                }
            });
            
            //kgk
            $("#filter_type").change(function(){
                //agent_filter_date_click = true;
                filter_type = $("#filter_type").val();
                if(filter_type != "custom"){
                    $("#renewals_offset").val('0');
                    load_renewals_info();
                }
                else
                {
                    $("#date_filter_model").modal("show");
                }
            });
            
            
            
            $("#agent_filter_date").click(function(){
                agent_date_filter_select = $("#lead_select").val();
                if(agent_date_filter_select != "custom"){
                    $("#offset").val('0');
                    load_agent_date_filter_data();
                }
                else
                {
                     agent_filter_date_click = true;
                    $("#date_filter_model").modal("show");
                }
            });
          
          
          $("#prospect_select").change(function(){
          var pros_select = $("#prospect_select").val();
          if(pros_select == "pdv")
          {
              $("#prospect_summary_div").addClass("hidden");
              $("#prospect_lead_filter_date").addClass("hidden");
              $("#prospect_lead_select").addClass("hidden");
              $("#prospect_due_select_label").removeClass("hidden");
              $("#prospect_due_date_select").removeClass("hidden");
              var content = "";
              content += "<div class='table-responsive'>";
              content += "<table id='table_id' class='table table-hover table-bordered'>"; 
              content += "<thead><th>S.No</th><th>Class</th><th>Customer name</th><th>Assigned User</th><th>Due date</th><th>Status</th></thead>";
              content += "<tbody></tbody>";
              content += "</table>";
              content += "</div>";
              
              $("#prospect_datatable").html(content);
        
              $("#table_id").DataTable({
                    scrollY:        '27vh',
                    scrollCollapse: true,
                  "processing": true,
                  "serverSide": false,
                  "ordering": false,
                  "pageLength": 10,
                  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                  "ajax":{
                    'url':'fetch_prospect_dashboard',
                    'method':"POST",
                    'data':{prospect_due_date:prospect_due_date},
                  }
              });      
          }
          else
          {
              $("#prospect_summary_div").removeClass("hidden");
              $("#prospect_lead_filter_date").removeClass("hidden");
              $("#prospect_lead_select").removeClass("hidden");
              $("#prospect_due_date_select").addClass("hidden");
              $("#prospect_due_select_label").addClass("hidden");
              $("#prospect_datatable").html("");
          }
        });
        $("#load_more_agent_btn").click(function(){
            load_agent_date_filter_data();
            // comment by kgk on 2023-02-04
            /*
            var agent_pos_select = $("#agent_pos_select").val();
            agent_date_filter_select = $("#agent_date_filter_select").val();
            if(agent_pos_select == "pos")
            {
                $("#agent_pos_href").attr("href","create_pos");
                $("#agent_pos_th").html("POS");
            }
            else
            {
                $("#agent_pos_href").attr("href","create_agent");
                $("#agent_pos_th").html("Agent");
            }
            $.ajax({
               url:"agent_pos_load_more",
               method:"POST",
               data:{
                   agent_pos_select:agent_pos_select,
                   agent_date_filter_select:agent_date_filter_select,
                   agent_from_date:agent_from_date,
                   agent_to_date:agent_to_date,
                   agent_page_no:agent_page_no,
               },
               success:function(response){
                   agent_page_no++;
                   obj = jQuery.parseJSON(response);
                   var html = $("#agent_pos_tbody").html();
                   $("#agent_pos_tbody").html("");
                   $("#agent_pos_tbody").html(html + obj["html"]);
                   agent_formated_from_date = obj["from_date"];
                   agent_formated_to_date = obj["to_date"];
                   if(obj["is_load_more_available"])
                   {
                       $("#load_more_agent_btn").removeClass("hidden");
                   }
                   else
                   {
                       $("#load_more_agent_btn").addClass("hidden");
                   }
                   if(agent_date_filter_select == "custom")
                   {
                       $("#agent_filter_date").html(agent_formated_from_date + " - " + agent_formated_to_date);
                   }
                   else
                   {
                       $("#agent_filter_date").html("");
                   }
               },
               error:function(code){
                 alert(code.statusText);  
               },
            });
            
            */
        });
        
        $("#load_more_staff_btn").click(function(){
            staff_date_filter_select = $("#staff_date_filter_select").val();
            $.ajax({
               url:"staff_load_more",
               method:"POST",
               data:{
                   staff_date_filter_select:staff_date_filter_select,
                   staff_from_date:staff_from_date,
                   staff_to_date:staff_to_date,
                   staff_page_no:staff_page_no,
               },
               success:function(response){
                   staff_page_no++;
                   obj = jQuery.parseJSON(response);
                   var html = $("#staff_tbody").html();
                   $("#staff_tbody").html("");
                   $("#staff_tbody").html(html + obj["html"]);
                   staff_formated_from_date = obj["from_date"];
                   staff_formated_to_date = obj["to_date"];
                   if(obj["is_load_more_available"])
                   {
                       $("#load_more_staff_btn").removeClass("hidden");
                   }
                   else
                   {
                       $("#load_more_staff_btn").addClass("hidden");
                   }
                   if(staff_date_filter_select == "custom")
                   {
                       $("#staff_filter_date").html(staff_formated_from_date + " - " + staff_formated_to_date);
                   }
                   else
                   {
                       $("#staff_filter_date").html("");
                   }
               },
               error:function(code){
                 alert(code.statusText);  
               },
            });
        });
        $("#load_more_ai_btn").click(function(){
            load_ai_date_filter_data('more');
            /*
            ai_date_filter_select = $("#ai_date_filter_select").val();
            $.ajax({
               url:"ai_load_more",
               method:"POST",
               data:{
                   ai_date_filter_select:ai_date_filter_select,
                   ai_from_date:ai_from_date,
                   ai_to_date:ai_to_date,
                   ai_page_no:ai_page_no,
               },
               success:function(response){
                   ai_page_no++;
                   obj = jQuery.parseJSON(response);
                   var html = $("#ai_tbody").html();
                   $("#ai_tbody").html("");
                   $("#ai_tbody").html(html + obj["html"]);
                   ai_formated_from_date = obj["from_date"];
                   ai_formated_to_date = obj["to_date"];
                   if(obj["is_load_more_available"])
                   {
                       $("#load_more_ai_btn").removeClass("hidden");
                   }
                   else
                   {
                       $("#load_more_ai_btn").addClass("hidden");
                   }
                   if(ai_date_filter_select == "custom")
                   {
                       $("#ai_filter_date").html(ai_formated_from_date + " - " + ai_formated_to_date);
                   }
                   else
                   {
                       $("#ai_filter_date").html("");
                   }
               },
               error:function(code){
                 alert(code.statusText);  
               },
            });
            
            */
        });
        $("#prospect_due_date_select").change(function(){
              prospect_due_date = $("#prospect_due_date_select").val();
              $("#prospect_summary_div").addClass("hidden");
              $("#prospect_lead_filter_date").addClass("hidden");
              $("#prospect_lead_select").addClass("hidden");
              var content = "";
              content += "<div class='table-responsive'>";
              content += "<table id='table_id' class='table table-hover table-bordered'>"; 
              content += "<thead><th>S.No</th><th>Class</th><th>Customer name</th><th>Assigned User</th><th>Due date</th><th>Status</th></thead>";
              content += "<tbody></tbody>";
              content += "</table>";
              content += "</div>";
              
              $("#prospect_datatable").html(content);
        
              $("#table_id").DataTable({
                    scrollY:        '27vh',
                    scrollCollapse: true,
                  "processing": true,
                  "serverSide": false,
                  "ordering": false,
                  "pageLength": 10,
                  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                  "ajax":{
                    'url':'fetch_prospect_dashboard',
                    'method':"POST",
                    'data':{prospect_due_date:prospect_due_date},
                  }
              });
          });
        
            $("#agent_pos_select").change(function(){
                $("#offset").val('0');
                load_agent_date_filter_data();
            });
            
            //kgk
            $("#filter_role").change(function(){
                $("#renewals_offset").val('0');
                load_renewals_info();
            });
        });
        
      </script>
