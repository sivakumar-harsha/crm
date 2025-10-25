<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php if($this->session->userdata('session_company_type') == "jayantha")   { echo $project_info->project_name; }else { echo "Unicorn";} ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <?php if($project_info->server == "CDN"){ ?>

    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.0/css/AdminLTE.min.css"/>
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.0/css/skins/_all-skins.min.css" />
    
    <!-- jQuery 2.1.4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <?php }else{ ?>

    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="https://harshainfotech.net/themes/AdminLTE/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://harshainfotech.net/themes/AdminLTE/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="https://harshainfotech.net/themes/AdminLTE/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="https://harshainfotech.biz/themes/AdminLTE/dist/css/skins/_all-skins.min.css">
    <!-- jQuery 2.1.4 -->
    <script src="https://harshainfotech.net/themes/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php } ?>
    <link rel="stylesheet" href="./datas/css/additional_css.css">
    <script src="./datas/js/additional_js.js"></script>
    
    
    <style type="text/css">
    
    
    
    @media only screen and (min-width:468px) and (max-width:991px)
    {
          .nav>li>a {
            position: relative;
            display: block;
            padding: 10px 8px !important;
        }
        
    }

      .title-boar
      {
        margin-right:500px;
        margin-top:4px;
      }
      
       .navbar-brand {
    float: left;
    height: 50px;
    padding: 9px 15px;
    font-size: 15px !important;
    line-height: 20px;
      }
      
    
      
        .d_menu {
    position: absolute;
    top: 100%;
    left: 10px;
    z-index: 100;
    display: none;
    float: inline-start;
    min-width: 144px;
    padding: 5px 0;
    margin: 2px -128px 0 !important;
    font-size: 14px;
    text-align: left;
    list-style: none;
    background-color: #fff;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1pxsolidrgba(0,0,0,.15);
    border-radius: 4px;
    -webkit-box-shadow: 0 6px 12px rgb(0 0 0 / 18%);
    box-shadow: 0 6px 12pxrgba(0,0,0,.175);
}
    </style>
    <div id="snackbar"></div>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <?php

$dashboard = "";

$example = "";
$menu1 = "";
$menu2 = "";
$brand = "";
$master = "";
$main_master = "";
$lead_tab = "";
$model = "";
$fuel_type = "";
$varient = "";
$bike_brand = "";
$bike_master = "";
$bike_model = "";
$bike_varient = "";
$gc_brand = "";
$gc_model = "";
$gc_varient = "";
$pc_brand = "";
$pc_model = "";
$pc_varient = "";
$misc_brand = "";
$misc_model = "";
$misc_varient = "";
$create_users="";
$reigion = "";
$district = "";
$create_agent = "";
$create_pos = "";
$create_agent = "";
$policy_type = "";
$smedetails = "";
$temp = "";


$create_lead = "";
$leads = "";
$customers = "";
$follow_ups = "";
$email = "";
$pet_breed = "";
$insurance_company = "";
$bank_name = "";


$claim = "";
$claim_view ="";
$create_claims = "";
$view_claims = "";

$commission = "";
$motor_category ="";
$products = "";
$commission_category = "";

$premium_cover_type = "";
$commission_state = "";
$payout_commission ="";


$g_policy = "";



$e_two_w_brand = "";
$e_two_w_model = "";
$e_two_w_varient = "";

$scooter_brand = "";
$scooter_model = "";
$scooter_varient = "";


$agent_business_report = "";

$motor_master = "";

$renewallead = "";
$acctree = "";
$commission_ac = "";
$general_receipt = "";
$cheque_book = "";
$cheque_entry = "";
$main_cash_voucher = "";




if($this->uri->segment(1) == "home")
{
    $dashboard = "active";
}
if($this->uri->segment(1) == "menu1")
{
    $example = "active";
    $menu1 = "active";
}
if($this->uri->segment(1) == "menu2")
{
    $example = "active";
    $menu2 = "active";
}
if($this->uri->segment(1) == "brand")
{
    $brand = "active";
    $motor_master = "active";
}
if($this->uri->segment(1) == "fuel_type")
{
    $fuel_type = "active";
    $motor_master = "active";
}
if($this->uri->segment(1) == "model")
{
    $model = "active";
    $motor_master = "active";
}
if($this->uri->segment(1) == "varient")
{
    $varient = "active";
    $motor_master = "active";
}
if($this->uri->segment(1) == "bike_brand")
{
    $bike_brand = "active";
    $motor_master = "active";
}

if($this->uri->segment(1) == "bike_model")
{
    $bike_model = "active";
    $motor_master = "active";
}

if($this->uri->segment(1) == "bike_varient")
{
    $bike_varient = "active";
    $motor_master = "active";
}

// scooter

if($this->uri->segment(1) == "scooter_brand")
{
    $scooter_brand = "active";
    $motor_master = "active";
}
if($this->uri->segment(1) == "scooter_model")
{
    $scooter_model = "active";
    $motor_master = "active";
}
if($this->uri->segment(1) == "scooter_varient")
{
    $scooter_varient = "active";
    $motor_master = "active";
}


if($this->uri->segment(1) == "electric_two_wheeler_brand")
{
    $e_two_w_brand = "active";
    $motor_master = "active";
}
if($this->uri->segment(1) == "electric_two_wheeler_model")
{
    $e_two_w_model = "active";
    $motor_master = "active";
}
if($this->uri->segment(1) == "electric_two_wheeler_varient")
{
    $e_two_w_varient = "active";
    $motor_master = "active";
}


if($this->uri->segment(1) == "gc_brand")
{
    $gc_brand = "active";
    $motor_master = "active";
}

if($this->uri->segment(1) == "gc_model")
{
    $gc_model = "active";
    $motor_master = "active";
}

if($this->uri->segment(1) == "gc_varient")
{
    $gc_varient = "active";
    $motor_master = "active";
}

if($this->uri->segment(1) == "pc_brand")
{
    $pc_brand = "active";
    $motor_master = "active";
}

if($this->uri->segment(1) == "pc_model")
{
    $pc_model = "active";
    $motor_master = "active";
}

if($this->uri->segment(1) == "pc_varient")
{
    $pc_varient = "active";
    $motor_master = "active";
}

if($this->uri->segment(1) == "misc_brand")
{
    $misc_brand = "active";
    $motor_master = "active";
}

if($this->uri->segment(1) == "misc_model")
{
    $misc_model = "active";
    $motor_master = "active";
}

if($this->uri->segment(1) == "misc_varient")
{
    $misc_varient = "active";
    $motor_master = "active";
}

if($this->uri->segment(1) == "reigion")
{
    $reigion = "active";
    $main_master = "active";
}
if($this->uri->segment(1) == "district")
{
    $district = "active";
    $main_master = "active";
}

if($this->uri->segment(1) == "create_users")
{
    $create_users = "active";
    $main_master = "active";
}

if($this->uri->segment(1) == "create_pos")
{
    $create_pos = "active";
    $main_master = "active";
}

if($this->uri->segment(1) == "create_agent")
{
    $create_agent = "active";
    $main_master = "active";
}
if($this->uri->segment(1) == "policy_type")
{
    $policy_type = "active";
    $main_master = "active";
}
if($this->uri->segment(1) == "policy_type")
{
    $policy_type = "active";
    $main_master = "active";
}

if($this->uri->segment(1) == "policy_type")
{
    $email = "active";
    $main_master = "active";
}

if($this->uri->segment(1) == "create_lead")
{
    $create_lead = "active";
    $lead_tab = "active";
}

if($this->uri->segment(1) == "leads")
{
    $leads = "active";
    $lead_tab="active";
}

if($this->uri->segment(1) == "temp_lead")
{
    $temp = "active";
    $lead_tab="active";
}

if($this->uri->segment(1) == "followups")
{
    $follow_ups = "active";
    $lead_tab="active";
}
if($this->uri->segment(1) == "customers")
{
    $customers = "active";
    $lead_tab="active";
}

if($this->uri->segment(1) == "pet_breed")
{
    $pet_breed = "active";
    $main_master = "active";
}

if($this->uri->segment(1) == "insurance_company")
{
    $insurance_company = "active";
    $master = "active";
}

// $this->uri->segment(1) == "bank" 2023-08-12
if($this->uri->segment(1) == "bank_name") 
{
    $bank_name = "active";
    $master = "active";
}

if($this->uri->segment(1) == "claim_view")
{
    $claim_view = "active";
    $create_claims = "active";
}



if($this->uri->segment(1) == "claim")
{
    
    if(isset($_GET["tab"]))
    {
        $create_claims = "active";
        $claim = "active";
    }
    else
    {
    $view_claims = "active";
    $claim = "active";
    }
    
}

if($this->uri->segment(1) == "motor_category")
{
    $motor_category = "active";
    $commission = "active";
}
if($this->uri->segment(1) == "motor_gvw")
{
    $products = "active";
    $commission = "active";
}
if($this->uri->segment(1) == "commission_category")
{
    $commission_category = "active";
    $main_master = "active";
}

if($this->uri->segment(1) == "premium_cover_type")
{
    $premium_cover_type = "active";
    $main_master = "active";
}

if($this->uri->segment(1) == "commission_state")
{
    $commission_state = "active";
    $main_master = "active";
}

if($this->uri->segment(1) == "payout_commission")
{
    $payout_commission = "active";
    $commission = "active";
}

if($this->uri->segment(1) == "manual_generate_policy")
{
    $manual_generate_policy = "active";
    $g_policy = "active";
}

$generate_policy1 = "";
$manual_generate_policy = "";
$business_complete = "";

if($this->uri->segment(1) == "manual_generate_policy")
{
    $manual_generate_policy = "active";
    $g_policy = "active";
}

if($this->uri->segment(1) == "generate_policy1")
{
    $generate_policy1 = "active";
    $g_policy = "active";
}


if($this->uri->segment(1) == "business_complete")
{
    $business_complete = "active";
    $g_policy = "active";
}



$agent_commission_report = "";
$reports = "";


$agent_voucher_payment = "";

$agent_bank_transaction_entry = "";



$pcv_seating = "";

if($this->uri->segment(1) == "agent_commission_report")
{
    $agent_commission_report = "active";
    $reports = "active";
}



if($this->uri->segment(1) == "agent_voucher_payment")
{
    $agent_voucher_payment = "active";
    $commission = "active";
}





if($this->uri->segment(1) == "pcv_seating")
{
    $pcv_seating = "active";
    $main_master = "active";
}

$active_policy_report = "";

if($this->uri->segment(1) == "active_policy_report")
{
    $active_policy_report = "active";
    $reports = "active";
}


if($this->uri->segment(1) == "agent_business_report")
{
    $agent_business_report = "active";
    $reports = "active";
}

$policy_failure_report = "";

if($this->uri->segment(1) == "policy_failure_report")
{
    $policy_failure_report = "active";
    $reports = "active";
}


$trigger_commissions = "";
$mismatching_list = "";

if($this->uri->segment(1) == "trigger_commissions")
{
    $trigger_commissions = "active";
    $commission = "active";
}

if($this->uri->segment(1) == "mismatching_list")
{
    $mismatching_list = "active";
    $commission = "active";
}




if($this->uri->segment(1) == "renewallead")
{
    $renewallead = "active";
    $lead_tab = "active";
}


$joinecall = "";
if($this->uri->segment(1) == "joinecall")
{
    $joinecall = "active";
    $lead_tab = "active";
}

if($this->uri->segment(1) == "smedetails")
{
    $smedetails ="active";
    $lead_tab = "active";
}

$ai_performance_report = "";

if($this->uri->segment(1) == "ai_performance_report")
{
    $ai_performance_report = "active";
    $lead_tab = "active";
}

$ai_performance_report = "";

if($this->uri->segment(1) == "ai_performance_report")
{
    $ai_performance_report = "active";
    $lead_tab = "active";
}

$failurelead = "";
if($this->uri->segment(1) == "failurelead")
{
    $failurelead = "active";
    $lead_tab = "active";
}

$renewallead = "";
if($this->uri->segment(1) == "renewallead")
{
    $renewallead = "active";
    $lead_tab = "active";
}


$dealers = "";
if($this->uri->segment(1) == "dealers")
{
    $main_master = "active";
    $main_master = "active";
}

$institutions = "";
if($this->uri->segment(1) == "Institution")
{
    $main_master = "active";
    $institutions = "active";
}

$bundel_master = "";
if($this->uri->segment(1) == "bundel_master")
{
    $main_master = "active";
    $bundel_master = "active";
}

$accounts = "";
$agent_advance = "";
$agent_payment_details = "";

if($this->uri->segment(1) == "agent_payment_details")
{
    $accounts = "active";
    $agent_payment_details = "active";
}
if($this->uri->segment(1) == "agent_advance")
{
    $accounts = "active";
    $agent_advance = "active";
}
if($this->uri->segment(1) == "Accounttree")
{
    $accounts = "active";
    $acctree = "active";
}


if($this->uri->segment(1) == "view_accounts_ledger")
{
    $accounts = "active";
    $commission_ac = "active";
}

$company_commission_ac = "";
if($this->uri->segment(1) == "view_company_ledger")
{
    $accounts = "active";
    $company_commission_ac = "active";
}

$agent_commission_ac = "";
if($this->uri->segment(1) == "view_agent_ledger")
{
    $accounts = "active";
    $agent_commission_ac = "active";
}

$agent_ledger_ac = "";
if($this->uri->segment(1) == "agent_ledger_view")
{
    $accounts = "active";
    $agent_ledger_ac = "active";
}

if($this->uri->segment(1) == "general_receipt")
{
    $accounts = "active";
    $general_receipt = "active";
}

if($this->uri->segment(1) == "cheque_book")
{
    $accounts = "active";
    $cheque_book = "active";
}

if($this->uri->segment(1) == "cheque_entry")
{
    $accounts = "active";
    $cheque_entry = "active";
}
if($this->uri->segment(1) == "main_cash_voucher")
{
    $accounts = "active";
    $main_cash_voucher = "active";
}

$ambulance_brand = "";

if($this->uri->segment(1) == "ambulance_brand")
{
    $ambulance_brand = "active";
    $motor_master = "active";
}

$ambulance_model = "";

if($this->uri->segment(1) == "ambulance_model")
{
    $ambulance_model = "active";
    $motor_master = "active";
}

$ambulance_varient = "";

if($this->uri->segment(1) == "ambulance_varient")
{
    $ambulance_varient = "active";
    $motor_master = "active";
}


$agentvoucher = "";
$agent_commission_closure = "";
$agent_vocher_generation = "";
$pending_vouchers = "";

$agent_voucher_report = "";

if($this->uri->segment(1) == "agent_commission_closure")
{
    $agentvoucher = "active";
    $agent_commission_closure = "active";
}

if($this->uri->segment(1) == "agent_vocher_generation")
{
    $agentvoucher = "active";
    $agent_vocher_generation = "active";
}

if($this->uri->segment(1) == "agent_voucher_pending")
{
    $agentvoucher = "active";
    $pending_vouchers = "active";
}

if($this->uri->segment(1) == "agent_vouchar_report")
{
    $agentvoucher = "active";
    $agent_voucher_report = "active";
}

$companyinvoice = "";
$company_invoice = "";
if($this->uri->segment(1) == "insurance_invoice_generation")
{
    $companyinvoice = "active";
    $company_invoice = "active";
}

$Mnholdrelease = ($this->uri->segment(1) == "policy_cancel_report") ? "active" : "";

$agentvoucher = ($Mnholdrelease == "active") ? "active" : $agentvoucher;

$Mninvoicereport = ($this->uri->segment(1) == "company_invoice_report") ? "active" : "";
$companyinvoice = ($Mninvoicereport == "active") ? "active" : $companyinvoice;


$policy_bill_hold_release   = ($this->uri->segment(1) == "policy-bill-hold-release") ? "active" : "";
$policy_billing_select      = ($this->uri->segment(1) == "policy-billing-select") ? "active" : "";


$companyinvoice = (($policy_bill_hold_release == "active") || ($policy_billing_select == "active")) ? "active" : $policy_bill_hold_release;

if($this->uri->segment(1) == "agent_bank_transact_entry")
{
    $agent_bank_transaction_entry = "active";
    $accounts = "active";
}

// 2023-08-12
$fixed_deposit = "";
if($this->uri->segment(1) == "fixed_deposit")
{
    $fixed_deposit = "active";
    $accounts = "active";
}

// 2023-08-12
$bank_deposit = "";
if($this->uri->segment(1) == "bank_deposit")
{
    $bank_deposit = "active";
    $accounts = "active";
}

// 2023-08-12
$bank_entries = "";
if($this->uri->segment(1) == "bank_entries")
{
    $bank_entries = "active";
    $accounts = "active";
}

// 2023-08-12
$tds_entries = "";
if($this->uri->segment(1) == "tds_entries")
{
    $tds_entries = "active";
    $accounts = "active";
}

// 2023-08-12
$jv_entries = "";
if($this->uri->segment(1) == "journalvoucher")
{
    $jv_entries = "active";
    $accounts = "active";
}

// 2023-08-12
$jvlist = "";
if($this->uri->segment(1) == "jvlist")
{
    $jvlist = "active";
    $accounts = "active";
}

$invoice_payment_receivable      = ($this->uri->segment(1) == "invoice_payment_receivable") ? "active" : "";

$accounts = ($invoice_payment_receivable == "active") ? "active" : $companyinvoice;



?>




<style>
    .nav>li>a {
        position: relative;
        display: block;
        padding: 10px 9px;
    }
    
    .container {
        width: 1570px;
    }
    .container {
        padding-top:15px;
        padding-right: 15px;
        padding-left: 15px;
        /* margin-right: auto; */
        /* margin-left: auto; */
    }
    
    @media (min-width: 1200px)
</style>


  <body class="hold-transition layout-top-nav <?php echo $this->session->userdata('session_company_type') == "unicorn"?"skin-green":"skin-blue" ?>">
    <!-- Site wrapper -->
    <div class="wrapper">

      
         <header class="main-header">
            <nav class="navbar navbar-static-top bg-primary">
              <div class="container">
                  
                <div class="navbar-header" id="title">
                  <a href="" class="navbar-brand"><p style="font-size:15px;"><?php if($this->session->userdata('session_company_type') == "jayantha")   { echo $project_info->project_name; }else { echo "Unicorn";}?></p></a>
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                  </button>
                  <!--<img src = "./datas/Logo/jayantha-logo2.png" style="height:50px;width:50px;">-->
                </div>
        
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                
                <?php if($this->session->userdata('session_role') == "admin")   { ?>    
                  <ul class="nav navbar-nav">
                    <li><a href="<?=base_url('home')?>">Dashboard</a></li>
                       
                        <li class="dropdown <?php echo $main_master; ?>">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-cogs" aria-hidden="true"></i> Master <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" role="menu">
                            <li class="<?php echo $district; ?>"><a href="district">Add District </a></li>
                            <li class="<?php echo $reigion; ?>"><a href="reigion">Add Reigion </a></li>
                            <li class="<?php echo $create_users; ?>"><a href="create_users">Create FOE / AI </a></li>
                            <li class="<?php echo $create_pos; ?>"><a href="create_pos">Create POS </a></li>
                            <li class="<?php echo $create_agent; ?>"><a href="create_agent">Create Agent </a></li>
                            <li class="<?php echo $insurance_company; ?>"><a href="insurance_company">Insurance Company</a></li>
                            <li class="<?php echo $policy_type; ?>"><a href="policy_type">Policy Type </a></li>
                            <li class="<?php echo $policy_type; ?>"><a href="email_template">Email Templates </a></li>
                            <li class="<?php echo $pet_breed; ?>"><a href="pet_breed">Pet Breed</a></li>
                            <li class="<?php echo $bank_name; ?>"><a href="bank_name">Bank Name</a></li>
                            <li class="<?php echo $premium_cover_type; ?>"><a href="premium_cover_type"> <i class="fa fa-plus" aria-hidden="true"></i> Premium Cover Type</a></li>
                            <li class="<?php echo $commission_state; ?>"><a href="commission_state"><i class="fa fa-plus" aria-hidden="true"></i> State</a></li>   
                             
                             
                             <li class="<?php echo $products; ?>">
                             <a href="motor_gvw"><i class="fa fa-plus" aria-hidden="true"></i>Motor Classification(CC/T)</a></li>
                            <li class="<?php echo $commission_category; ?>"><a href="commission_category"><i class="fa fa-plus" aria-hidden="true"></i>Payout Category</a></li>
                              
                               <li class="<?php echo $pcv_seating; ?>">
                             <a href="pcv_seating"><i class="fa fa-plus" aria-hidden="true"></i>PCV Seating</a></li>
                             
                            <li class="<?php echo $dealers; ?>"><a href="dealers"><i class="fa fa-car" aria-hidden="true"></i> Dealers</a></li> 
                            
                            <li class="<?php echo $institutions; ?>"><a href="Institution"><i class="fa fa-university" aria-hidden="true"></i> Institutions</a></li>
                            
                            <li class="<?php echo $bundel_master; ?>"><a href="bundel_master"><i class="fa fa-university" aria-hidden="true"></i> Bundel</a></li>
                          </ul>
                        </li> 
                        
                        <li class="dropdown <?php echo $motor_master; ?>">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-car" aria-hidden="true"></i> Motor Master <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" role="menu">
                              
                            <li class="<?php echo $brand; ?>"><a href="brand"> Car Brand </a></li>
                            <li class="<?php echo $model; ?>"><a href="model"> Car Model </a></li>
                            <li class="<?php echo $varient; ?>"><a href="varient"> Car Varient </a></li>
                            <li class="<?php echo $fuel_type; ?>"><a href="fuel_type">Fuel Types </a></li>
                            <li class="<?php echo $bike_brand; ?>"><a href="bike_brand"> Bike Brand </a></li>
                            <li class="<?php echo $bike_model; ?>"><a href="bike_model"> Bike Model </a></li>
                            <li class="<?php echo $bike_varient; ?>"><a href="bike_varient"> Bike Varient </a></li>
                            <li class="<?php echo $scooter_brand; ?>"><a href="scooter_brand"> Scooter Brand </a></li>
                            <li class="<?php echo $scooter_model; ?>"><a href="scooter_model"> Scooter Model </a></li>
                            <li class="<?php echo $scooter_varient; ?>"><a href="scooter_varient"> Scooter Varient </a></li>
                             <li class="<?php echo $e_two_w_brand; ?>"><a href="electric_two_wheeler_brand"> E-Two Wheeler Brand </a></li>
                            <li class="<?php echo $e_two_w_model; ?>"><a href="electric_two_wheeler_model">  E-Two Wheeler Model </a></li>
                            <li class="<?php echo $e_two_w_varient; ?>"><a href="electric_two_wheeler_varient">  E-Two Wheeler Varient </a></li>
                            <li class="<?php echo $gc_brand; ?>"><a href="gc_brand"> Goods Carrying Brand </a></li>
                            <li class="<?php echo $gc_model; ?>"><a href="gc_model"> Goods Carrying Model </a></li>
                            <li class="<?php echo $gc_varient; ?>"><a href="gc_varient"> Goods Carrying Varient </a></li>
                            <li class="<?php echo $pc_brand; ?>"><a href="pc_brand"> Passengers Carrying Brand </a></li>
                            <li class="<?php echo $pc_model; ?>"><a href="pc_model"> Passengers Carrying Model </a></li>
                            <li class="<?php echo $pc_varient; ?>"><a href="pc_varient"> Passengers Carrying Varient </a></li>
                            <li class="<?php echo $misc_brand; ?>"><a href="misc_brand"> Misc-D Brand </a></li>
                            <li class="<?php echo $misc_model; ?>"><a href="misc_model"> Misc-D Model </a></li>
                            <li class="<?php echo $misc_varient; ?>"><a href="misc_varient"> Misc-D Varient </a></li>
                            <li class="<?php echo $ambulance_brand; ?>"><a href="ambulance_brand">Ambulance Brand </a></li>
                            <li class="<?php echo $ambulance_model; ?>"><a href="ambulance_model"> Ambulance Model </a></li>
                            <li class="<?php echo $ambulance_varient; ?>"><a href="ambulance_varient">Ambulance Varient </a></li>
                          </ul>
                          </li>
    
                        <li class="dropdown <?php echo $lead_tab; ?>">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bullseye" aria-hidden="true"></i> Lead <span class="caret"></span>
                          </a>
                          
                          <ul class="dropdown-menu" role="menu">
                              
                            <li class="<?php echo $create_lead; ?>">
                             <a href="create_lead"><i class="fa fa-plus" aria-hidden="true"></i>Create Lead</a></li>
                             
                             <li class="<?php echo $temp; ?>"><a href="temp_lead"><i class="fa fa-external-link" aria-hidden="true"></i> Create Lead(Min.dtls) </a></li>
                            <li class="<?php echo $follow_ups; ?>"><a href="followups"><i class="fa fa-bell" aria-hidden="true"></i> Follow Ups </a></li>
                            
                            <li class="<?php echo $leads; ?>"><a href="leads"><i class="fa fa-bullseye" aria-hidden="true"></i> View Leads </a></li>
                            
                            <li class="<?php echo $customers; ?>"><a href="customers"><i class="fa fa-users" aria-hidden="true"></i> View Customers </a></li>
                            
                             <li class="<?php echo $renewallead; ?>"><a href="renewallead"><i class="fa fa-refresh" aria-hidden="true"></i> Renewal Leads </a></li>
                              
                            <li class="<?php echo $failurelead; ?>"><a href="failurelead"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Failure Leads </a></li>
                            
                              <li class="<?php echo $smedetails; ?>"><a href="smedetails"><i class="fa fa-briefcase" aria-hidden="true"></i>SME Policy </a></li>
                              
                               <li class="<?php echo $joinecall; ?>"><a href="jointcall"><i class="fa fa-phone" aria-hidden="true"></i> Business Calls </a></li>
                              
                                 <li class="<?php echo $ai_performance_report; ?>"><a href="ai_performance_report"><i class="fa fa-file" aria-hidden="true"></i> AI performance </a></li>
                                 
                                 <li class="<?php echo $claim; ?>"><a href="claim"><i class="fa fa-plus" aria-hidden="true"></i> Add Claim </a></li>
                                 
                                 <li class="<?php echo $claim_view; ?>"><a href="claim_view"><i class="fa fa-eye" aria-hidden="true"></i> View Claim  </a></li>
                              
                          </ul>
                        </li> 
                        
                        <li class="dropdown <?php echo $g_policy; ?>">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-shield" aria-hidden="true"></i> Policy <span class="caret"></span>
                          </a>
                          
                          <ul class="dropdown-menu" role="menu">
                              
                            <li class="<?php echo $manual_generate_policy; ?>"></li>
                            
                          <li class="<?php echo $business_complete; ?>"><a href="business_complete"><i class="fa fa-file-text-o" aria-hidden="true"></i>Business Complete</a></li>
                            
                            <li class="<?php echo $generate_policy1; ?>"><a href="generate_policy1"><i class="fa fa-file-text-o" aria-hidden="true"></i>Active Policy </a></li>
                            
                            
                          </ul>
                          
                        </li>
                        
                        <li class="dropdown <?php echo $commission; ?>">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-money" aria-hidden="true"></i>&nbsp; Commission <span class="caret"></span>
                          </a>
                              <ul class="dropdown-menu" role="menu">
                            <li class="<?php echo $payout_commission; ?>"><a href="payout_entry"><i class="fa fa-plus" aria-hidden="true"></i>Payout Commission</a></li>
                             <!--<li class="<?php echo $trigger_commissions; ?>"><a href="trigger_commissions"><i class="fa fa-plus" aria-hidden="true"></i>Trigger Commissions</a>-->
                            <li class="<?php echo $mismatching_list; ?>"><a href="mismatching_list"><i class="fa fa-plus" aria-hidden="true"></i>Mismatching Commissions List</a>
                            
                            
                            <li class="<?php echo $Mnholdrelease; ?>"><a href="policy_cancel_report"><i class="fa fa-plus" aria-hidden="true"></i>Hold / Cancel Release</a>
                            </li>
                            
                            <!--<li class="<?php echo $agent_voucher_payment; ?>"><a href="agent_voucher_payment"><i class="fa fa-plus" aria-hidden="true"></i>Agent Voucher Payment</a>-->
                            <!--</li>-->
                             
                            
                            
                            
                           
                            
                          </ul>
                        </li>
                        
                        <li class="dropdown <?php echo $reports; ?>">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="fa fa-file-text-o" aria-hidden="true"></i> Reports <span class="caret"></span>
                          </a>
                          
                          
                          
                          <ul class="dropdown-menu" role="menu">
                         
                          
                            <li class="<?php echo $agent_commission_report; ?>">
                             <a href="agent_commission_report"><i class="fa fa-file-o" aria-hidden="true"></i> Agent Commission Report</a></li>
                             
                             <li class="<?php echo $active_policy_report; ?>">
                             <a href="active_policy_report"><i class="fa fa-file-o" aria-hidden="true"></i> Active Policy Report</a></li>
                             
        
                             
                              <li class="<?php echo $agent_business_report; ?>">
                              <a href="agent_business_report"><i class="fa fa-file-o" aria-hidden="true"></i>Business Report</a></li>
                              
                              
                              <li class="<?php echo $policy_failure_report; ?>">
                              <a href="policy_failure_report"><i class="fa fa-file-o" aria-hidden="true"></i>Policy Failure Report</a></li>
                             
                          </ul>
                        </li>





                        <li class="dropdown <?php echo $agentvoucher; ?>">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="fa fa-book" aria-hidden="true"></i> Agent Voucher <span class="caret"></span>
                          </a>
                          
                          <ul class="dropdown-menu" role="menu">
                             
                            <li class="<?php echo $agent_commission_closure; ?>"><a href="agent_commission_closure"><i class="fa fa-sort-amount-desc" aria-hidden="true"></i>Agent Commission Closure</a>
                            </li>
                            
                            <li class="<?php echo $Mnholdrelease; ?>"><a href="policy_cancel_report"><i class="fa fa-pause" aria-hidden="true"></i>Hold / Cancel Release</a>
                            </li>
                            
                            <li class="<?php echo $agent_vocher_generation; ?>"><a href="agent_vocher_generation"><i class="fa fa-users" aria-hidden="true"></i>Agent Voucher Generation</a>
                            </li>
                            
                            <li class="<?php echo $pending_vouchers; ?>"><a href="agent_voucher_pending"><i class="fa fa-refresh" aria-hidden="true"></i>Agent Pending Vouchers</a>
                            </li>
                            
                            <li class="<?php echo $agent_voucher_report; ?>">
                             <a href="agent_vouchar_report"><i class="fa fa-file-o" aria-hidden="true"></i> Agent Vouchar Report</a>
                             </li>
                            
                           
                          </ul>
                        </li>




                        <li class="dropdown <?php echo $companyinvoice; ?>">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="fa fa-building-o" aria-hidden="true"></i> Company Invoice <span class="caret"></span>
                          </a>
                          
                            <ul class="dropdown-menu" role="menu">
                                <li class="<?php echo $policy_billing_select; ?>">
                                    <a href="policy-billing-select">
                                        <i class="fa fa-print" aria-hidden="true"></i>Invoice Policy Select
                                    </a>
                                </li>
                                
                                <li class="<?php echo $policy_bill_hold_release; ?>">
                                    <a href="policy-bill-hold-release">
                                        <i class="fa fa-print" aria-hidden="true"></i>Invoice Policy Hold Release
                                    </a>
                                </li>
                                
                                <li class="<?php echo $company_invoice; ?>">
                                    <a href="insurance_invoice_generation">
                                        <i class="fa fa-print" aria-hidden="true"></i>Company Invoice Generation
                                    </a>
                                </li>
                            
                                <li class="<?php echo $Mninvoicereport; ?>">
                                    <a href="company_invoice_report">
                                        <i class="fa fa-file-text" aria-hidden="true"></i> Company Invoice Report
                                    </a>
                                </li>
                           
                            </ul>
                        </li>



                        
                        <li class="dropdown <?php echo $accounts; ?>">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="fa fa-book" aria-hidden="true"></i> Accounts <span class="caret"></span>
                          </a>
                          
                            <ul class="dropdown-menu" role="menu">
                                <li class="<?php echo $acctree; ?>">
                                    <a href="Accounttree"><i class="fa fa-tree" aria-hidden="true"></i>Accounts tree</a>
                                </li>
                             
                                <li class="<?php echo $commission_ac; ?>">
                                    <a href="view_accounts_ledger"><i class="fa fa-money" aria-hidden="true"></i>Commission A/C</a>
                                </li>
                                
                                <li class="<?php echo $company_commission_ac; ?>">
                                    <a href="view_company_ledger"><i class="fa fa-money" aria-hidden="true"></i> Company Commission Ledger </a>
                                </li>
                                
                                <li class="<?php echo $agent_commission_ac; ?>">
                                    <a href="view_agent_ledger"><i class="fa fa-money" aria-hidden="true"></i> Agent Commission Ledger </a>
                                </li>
                                
                                <li class="<?php echo $agent_ledger_ac; ?>">
                                    <a href="agent_ledger_view"><i class="fa fa-money" aria-hidden="true"></i> Agent Ledger </a>
                                </li>
                                
                                <li class="<?php echo $general_receipt; ?>">
                                <a href="general_receipt"><i class="fa fa-sticky-note" aria-hidden="true"></i>General Receipt</a></li>
                                
                                <li class="<?php echo $cheque_book; ?>">
                                <a href="cheque_book"><i class="fa fa-money" aria-hidden="true"></i>Cheque Book </a></li>
                                
                                <li class="<?php echo $cheque_entry; ?>">
                                <a href="cheque_entry"><i class="fa fa-list-alt" aria-hidden="true"></i>Cheque Entry </a></li>
                                
                                <li class="<?php echo $main_cash_voucher; ?>">
                                <a href="main_cash_voucher"><i class="fa fa-list-alt" aria-hidden="true"></i>Cash Voucher </a></li>
                                
                                <li class="<?php echo $agent_payment_details; ?>"><a href="agent_payment_details"><i class="fa fa-money" aria-hidden="true"></i>Agent Payment Details</a></li>
                                
                                <li class="<?php echo $agent_advance; ?>"><a href="agent_advance"><i class="fa fa-cc" aria-hidden="true"></i>Agent Advance Payment</a>
                                </li>
                                
                                <li class="<?php echo $agent_voucher_payment; ?>"><a href="agent_voucher_payment"><i class="fa fa-money" aria-hidden="true"></i>Single Agent Voucher Payment</a>
                                </li>
                                
                                <li class="<?php echo $agent_bank_transaction_entry; ?>"><a href="agent_bank_transact_entry"><i class="fa fa-bank" aria-hidden="true"></i>Agent Payment Entry</a>
                                </li>
                                
                                <li class="<?php echo $invoice_payment_receivable; ?>">
                                    <a href="invoice_payment_receivable">
                                        <i class="fa fa-bank" aria-hidden="true"></i>Invoice Payment Receivable
                                    </a>
                                </li>
                                
                                <?php if(1 == 2):?>
                                    <li class="<?php echo $fixed_deposit; ?>">
                                        <a href="fixed_deposit">
                                            <i class="fa fa-bank" aria-hidden="true"></i>Fixed Deposits
                                        </a>
                                    </li>
                                    <li class="<?php echo $bank_deposit; ?>">
                                        <a href="bank_deposit">
                                            <i class="fa fa-bank" aria-hidden="true"></i>Bank Deposits
                                        </a>
                                    </li>
                                    <li class="<?php echo $bank_entries; ?>">
                                        <a href="bank_entries">
                                            <i class="fa fa-bank" aria-hidden="true"></i>Bank Entry
                                        </a>
                                    </li>
                                    <li class="<?php echo $tds_entries; ?>">
                                        <a href="tds_entries">
                                            <i class="fa fa-bank" aria-hidden="true"></i>T.D.S Entry
                                        </a>
                                    </li>
                                    <li class="<?php echo $jv_entries; ?>">
                                        <a href="journalvoucher">
                                            <i class="fa fa-bank" aria-hidden="true"></i>Journal Voucher
                                        </a>
                                    </li>
                                    <li class="<?php echo $jvlist; ?>">
                                        <a href="jvlist">
                                            <i class="fa fa-bank" aria-hidden="true"></i>JV List
                                        </a>
                                    </li>
                                <?php endif;?>
                            
                            </ul>
                        </li>
                     
                        
                     
                        <!--<li class="dropdown">-->
                        <!--  <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
                        <!--    <i class="fa fa-sliders"></i>-->
                        <!--    <span>Settings</span>-->
                        <!--      <span class="caret"></span>-->
                        <!--  </a>-->
                        <!--  <ul class="dropdown-menu" role="menu">-->
                        <!--    <li><a data-toggle="modal" data-target="#per_chg_pass">Change Password</a></li>-->
                        <!--     <li><a href="<?php echo site_url('logout');?>"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>-->
                        <!--  </ul>-->
                        <!--</li>-->
                        
                        
                
                    </ul>
                    
               <?php 
                }
                else
                {
               ?>
                
                <style>
                    p {
                       margin: 0px 88px 10px !important;
                      }
                </style>
                <ul class="nav navbar-nav">
                     <li><a href="home">Dashboard</a></li>
                     
                        <li class="dropdown <?php echo $lead_tab; ?>">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bullseye" aria-hidden="true"></i> Lead <span class="caret"></span>
                          </a>
                    
                          <ul class="dropdown-menu" role="menu">
                        
                        
                      <?php if($this->session->userdata('session_role') == "user")   { ?>   
                            <li class="<?php echo $create_pos; ?>"><a href="create_pos"><i class="fa fa-plus" aria-hidden="true"></i>Create POS </a></li>
                            <li class="<?php echo $create_agent; ?>"><a href="create_agent"><i class="fa fa-plus" aria-hidden="true"></i>Create Agent </a></li>  
                          <?php } ?>
                            <?php if($this->auth->can_access('Create Leads')):?>
                                <li class="<?php echo $create_lead; ?>">
                                    <a href="create_lead"><i class="fa fa-plus" aria-hidden="true"></i>Create Lead</a>
                                </li>
                            <?php endif;?>
                            <?php if($this->auth->can_access('Create Temp Lead')):?>
                                <li class="<?php echo $temp; ?>">
                                    <a href="temp_lead"><i class="fa fa-external-link" aria-hidden="true"></i> Create Lead(Min.dtls) </a>
                                </li>
                            <?php endif;?>
                            <?php if($this->auth->can_access('List Follow Ups')):?>
                                <li class="<?php echo $follow_ups; ?>">
                                    <a href="followups"><i class="fa fa-bell" aria-hidden="true"></i> Follow Ups </a>
                                </li>
                            <?php endif;?>
                            <?php if($this->auth->can_access('List Leads')):?>
                                <li class="<?php echo $leads; ?>">
                                    <a href="leads"><i class="fa fa-bullseye" aria-hidden="true"></i> View Leads </a>
                                </li>
                            <?php endif;?>
                            <?php if($this->auth->can_access('List Customer')):?>
                                <li class="<?php echo $customers; ?>">
                                    <a href="customers"><i class="fa fa-users" aria-hidden="true"></i> View Customers </a>
                                </li>
                            <?php endif;?>
                            
                            <?php if($this->session->userdata('session_role') == "user")   { ?>  
                                <?php if($this->auth->can_access('Renewal Leads')):?>  
                                    <li class="<?php echo $renewallead; ?>">
                                        <a href="renewallead"><i class="fa fa-refresh" aria-hidden="true"></i> Renewal Leads </a>
                                    </li>
                                <?php endif;?>
                                <?php if($this->auth->can_access('Failure Leads')):?>
                                    <li class="<?php echo $failurelead; ?>">
                                        <a href="failurelead"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Failure Leads </a>
                                    </li>
                                <?php endif;?>
                                <?php if($this->auth->can_access('List Business Calls')):?>
                                    <li class="<?php echo $joinecall; ?>">
                                        <a href="jointcall"><i class="fa fa-phone" aria-hidden="true"></i> Business Calls </a>
                                    </li>
                                <?php endif;?>
                              
                              <?php } ?>
                                <li class="<?php echo $ai_performance_report; ?>"><a href="ai_performance_report"><i class="fa fa-file" aria-hidden="true"></i> AI performance </a></li>
                                <?php if($this->auth->can_access('Create Claim')):?>
                                    <li class="<?php echo $claim; ?>"><a href="claim"><i class="fa fa-plus" aria-hidden="true"></i> Add Claim </a></li>
                                <?php endif; ?>
                                <?php if($this->auth->can_access('List Claim')):?>
                                    <li class="<?php echo $claim_view; ?>"><a href="claim_view"><i class="fa fa-eye" aria-hidden="true"></i> View Claim  </a></li>
                                <?php endif;?>
                                
                          </ul>
                        </li> 
                        
                        <li class="dropdown <?php echo $g_policy; ?>">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-shield" aria-hidden="true"></i> Policy <span class="caret"></span>
                          </a>
                          
                          <ul class="dropdown-menu" role="menu">
                            <li class="<?php echo $manual_generate_policy; ?>"></li>
                            <?php if( $this->auth->can_access('Business Complete') ):?>
                                <li class="<?php echo $business_complete; ?>">
                                    <a href="business_complete"><i class="fa fa-file-text-o" aria-hidden="true"></i>Business Complete</a>
                                </li>
                            <?php endif;?>
                            <?php if( $this->auth->can_access('List Policy') ):?>
                                <li class="<?php echo $generate_policy1; ?>">
                                    <a href="generate_policy1"><i class="fa fa-file-text-o" aria-hidden="true"></i>Active Policy </a>
                                </li>
                            <?php endif;?>
                          </ul>
                        </li>
                        
                         <li class="dropdown <?php echo $reports; ?>">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="fa fa-file-text-o" aria-hidden="true"></i> Reports <span class="caret"></span>
                          </a>
                          
                            <ul class="dropdown-menu" role="menu">
                                <?php if( $this->auth->can_access('Agent Commission Report') ):?>
                                    <li class="<?php echo $agent_commission_report; ?>">
                                        <a href="agent_commission_report"><i class="fa fa-file-o" aria-hidden="true"></i> Agent Commission Report</a>
                                    </li>
                                <?php endif;?>
                                <?php if( $this->auth->can_access('Active Policy Report') ):?>
                                    <li class="<?php echo $active_policy_report; ?>">
                                        <a href="active_policy_report"><i class="fa fa-file-o" aria-hidden="true"></i> Active Policy Report</a>
                                    </li>
                                <?php endif;?>
                                
                                <?php if( $this->auth->can_access('Agent Business Report') ):?>
                                    <li class="<?php echo $agent_business_report; ?>">
                                        <a href="agent_business_report"><i class="fa fa-file-o" aria-hidden="true"></i>Business Report</a>
                                    </li>
                                <?php endif;?>
                                <?php if( $this->auth->can_access('Policy Failure Report') ):?>
                                    <li class="<?php echo $policy_failure_report; ?>">
                                        <a href="policy_failure_report"><i class="fa fa-file-o" aria-hidden="true"></i>Policy Failure Report</a>
                                    </li>
                                <?php endif;?>
                          </ul>
                        </li>
               
               
               </ul>
               
               <?php } ?>
                    
                  <div class="navbar-custom-menu">   
                     <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                  <img src="./datas/images/userimg.jpg" class="user-image" alt="User Image">
                                  <span class="hidden-xs"></span>
                                </a>
                                <ul class="dropdown-menu">
                                  <!-- User image -->
                                  <li class="user-header">
                                    <img src="./datas/images/userimg.jpg" class="img-circle" alt="User Image">
                                    <p>
                                      <?php echo $this->session->userdata('session_name'); ?>
                                      <small><?php echo $this->session->userdata('session_role'); ?></small>
                                    </p>
                                  </li>                  
                                  <!-- Menu Footer-->
                                  <li class="user-footer">
                                    <div class="pull-left">
                                      <a href="profile_admin" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                      <a href="<?php echo site_url('logout');?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                  </li>
                                </ul>
                              </li>
                     </ul>
                  </div>
                  
              </div>
              <!-- /.container-fluid -->
              </div>
            </nav>
          </header>
          
          
          <script>
              
              $(document).ready(function(){
                  
                if(window.matchMedia('(min-width: 468px)').matches && window.matchMedia('(max-width: 991px)').matches)
                {
                     $("#title").addClass("hidden");
                }
            });
          </script>
   
      
    