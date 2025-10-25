 <style>
 
   .form-control {
    display: block;
    width: 100%;
    height: 29px;
    padding: 4px 10px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}

 .change_pet_gender
    {
        background-color: #12b48b !important;
        color: white !important;
    }

.form-check-input:checked {
    background-color: #0d6efd !important;
    border-color: #0d6efd !important;
}
.form-check-input{
    border-color: 1px solid #D3CFC8 !important;
}

label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: unset;
    font-size: 14px;
}

.btn {
    border-radius: 1px;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: 1px solid transparent;
}
.save_model{
    margin-right:-70px;
}
@media only screen and (max-width: 600px) {
  .save_model {
     margin-right:0px;
  }
}
input[type=checkbox], input[type=radio] {
    margin: 9px 0px 0;
    margin-top: 1px\9;
    line-height: normal;
}

.modal-lg {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
  z-index:10000000 !important;
}

.no_mar_pad {
    margin-top: 0px;
    margin-bottom: 0px;
    padding-top: 8px !important;
    padding-bottom: 0px !important;
    color :#5b6379 !important;
}

.modal-lg-content {
  height: auto;
  width:auto;
  min-height: 100%;
  border-radius: 0;
}

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

 .drag-area{
  border: 2px dashed #fff;
  height: 500px;
  width: 700px;
  border-radius: 5px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}
.drag-area.active{
  border: 2px solid #fff;
}
.drag-area .icon{
  font-size: 100px;
  color: #fff;
}
.drag-area header{
  font-size: 30px;
  font-weight: 500;
  color: #fff;
}
.drag-area span{
  font-size: 25px;
  font-weight: 500;
  color: #fff;
  margin: 10px 0 15px 0;
}
.drag-area button{
  padding: 10px 25px;
  font-size: 20px;
  font-weight: 500;
  border: none;
  outline: none;
  background: #fff;
  color: #5256ad;
  border-radius: 5px;
  cursor: pointer;
}
.drag-area img{
  height: 100%;
  width: 100%;
  object-fit: cover;
  border-radius: 5px;
}

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

.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background-color: #fff !important;
    opacity: 1;
}

.modal {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1050;
    display: none;
    overflow: auto !important;
    -webkit-overflow-scrolling: touch;
    outline: 0;
}

.form-check-input {
    width: 2em;
    height: 1.5em;
    background-color: #fff;
    background-repeat: no-repeat;
    border: 1px solid rgba(0,0,0,.25);
}
*, ::after, ::before {
    box-sizing: border-box;
}

input[type=checkbox], input[type=radio] {
    margin: 5px 0px 0 !important;
    line-height: normal;
}

/*  Property    */
  
  .change_house_type
    {
        background-color: #12b48b !important;
        color: white !important;
    }
    .change_owner
    {
        background-color: #12b48b !important;
        color: white !important;
    }
    .business_change_owner
    {
        background-color: #12b48b !important;
        color: white !important;
    }
    
    .img_style{
        height:50px;
        width:50px;
    }
     
    </style>
  <div class="content-wrapper">
      
      
     <section class="content-header">
          <div class="pull-right">
                    <button class="btn btn-success btn-sm pull-right" id="save_btn"><i class="fa fa-save"></i> Save</button>
           </div>
           <br>
    </section>
     <section class="content">
            
        <div class="box">
            <div class="box-header with-border" style="background:#f4f4f48c;">
                <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-user" aria-hidden="true"></i> &nbsp;&nbsp;SME Details</h3>
                
                <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                      <i class="fa fa-minus"></i></button>
                </div>
            </div>
      
            <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
                
                <div class="row">
                       <div class="col-md-6">
                            <div class="form-group">
                                    <div class="row">   
                                       <div class="col-md-4">
                                            <label>SME Policy</label>
                                       </div>
                                       <div class="col-md-8">
                                            <select class="form-control" name="sme_policy" id="sme_policy">
                                                <option value="">--select--</option>
                                                <?php foreach($smepolicy as $da){ ?>
                                                  <option value="<?php echo $da->id ?>"><?php echo $da->policy_type ?></option>
                                                <?php } ?>
                                            </select>
                                       </div>
                                     </div>
                                </div>   
                            <div class ="hidden" id="marine">  
                                      
                              <div class="form-group">
                                            <div class="row">   
                                               <div class="col-md-4">
                                                    <label>Period of Insurance</label>
                                               </div>
                                            <div class="col-md-4">
                                               <input type="date" class="form-control" name="from_date" id="from_date">
                                            </div>
                                                
                                           <div class="col-md-4">
                                               <input type="date" class="form-control" name="to_date" id="to_date">
                                            </div>
                                        </div>
                                    </div>      
                    
                                <div class="form-group">
                                    <div class="row">   
                                       <div class="col-md-4">
                                            <label>Commodity/ Interest</label>
                                       </div>
                                       <div class="col-md-8">
                                           <input type="text" class="form-control" name="commodity_interest" id="commodity_interest" value = "Industrial Oil, Furnace Oil, Fuel oil , low and High density oil,industrial mixed solvent , Base Oil , Low aromatic white spirit">
                                       </div>
                                     </div>
                                </div>    
                             
                                <div class="form-group">
                                    <div class="row">   
                                            <div class="col-md-4">
                                             <label>Basis of Valuation</label>
                                               </div>
                                           </div>  
                                           <div class ="row">
                                               <div class="col-md-4">
                                                   <label>Import</label>
                                                   <textarea class="form-control" name="b_valuation_import" id="b_valuation_import" rows="3" >C&F / FOB / Exworks / CIF) + 10% + Duty at Actuals</textarea>
                                               </div>
                                               
                                                <div class="col-md-4">
                                                    <label>Export</label>
                                                   <textarea class="form-control" name="b_valuation_export" id="b_valuation_export" rows="3"  >CIF + 10%, FOB + 20%</textarea>
                                               </div>
                                               
                                                <div class="col-md-3">
                                                    <label>Inland</label>
                                                   <textarea  class="form-control" name="b_valuation_inland" id="b_valuation_inland" rows="3" >Invoice + 10% Interdepot /Interunit Transfers (Stock Transfer Note Value / InvoiceValue / Consignment Note Value) + Freight at Actuals</textarea>
                                               </div>
                                             </div>
                                        </div>  
                                        
                                <div class="form-group">
                                        <div class="row">   
                                              <div class="col-md-4">
                                            <label>Annual Sales Turnover</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="add_turnover" id="add_turnover">
                                            </div>
                                        </div>
                                </div> 
                             
                                <div class="row">   
                                   <div class="col-md-4">
                                        <label style ="color:#2E86C1;" >Sales:</label>
                                   </div>
                                 </div> 
                                 
                               <div class="form-group">
                                <div class="row">   
                                      <div class="col-md-4">
                                    <label>Domestic</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="add_domestic" id="add_domestic">
                                    </div>
                                </div>
                            </div>
                             
                               <div class="row">
                                       <div class="col-md-4">
                                            <label style ="color:#2E86C1;">Purchase:</label>
                                       </div>
                                </div>
        
                                 <div class="form-group">
                                        <div class="row">   
                                              <div class="col-md-4">
                                            <label>Import</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="add_import" id="add_import">
                                            </div>
                                        </div>
                                    </div> 
                            
                                  <div class="form-group">
                                    <div class="row">   
                                        <div class="col-md-4">
                                           <label>Per Bottom Limit (Inland)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="bottom_inland_limit" id="bottom_inland_limit">
                                       </div>
                                    </div>
                                   </div>
                                
                                 <div class="form-group">
                                    <div class="row">   
                                          <div class="col-md-4">
                                        <label>Per Location Limit (Inland)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="location_inland" id="location_inland">
                                        </div>
                                    </div>
                                  </div>
                               
                                <div class="form-group">
                                  <div class="row">   
                                     <div class="col-md-4">
                                          <label>Covering Clauses</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class='row'>
                                           <div class="col-md-8">
                                             <input type="text" style="margin:5px; width:97%;" id="covering_clauses" class="form-control coveringclauses">
                                             <div id="add_covering_clauses">
                                            </div>
                                        </div>
                                          <div class="col-md-4">
                                              <button id="sub_covering_btn" class="btn btn-info btn-sm pull-right"> - </button>
                                              <button id="add_covering_btn" class="btn btn-info btn-sm pull-right" style="margin-right:5px;"> + </button>
                                          </div>
                                       </div>
                                   </div>
                               </div>
                           </div> 
                              
                                <div class="form-group">
                                        <div class="row">   
                                           <div class="col-md-4">
                                                <label>Date</label>
                                           </div>
                                           <div class="col-md-8">
                                               <input type="date" class="form-control" name="date" id="date">
                                           </div>
                                         </div>
                                    </div>
                            
                             </div>  
                             
                 <div class ="hidden" id="bharat_griha_raksha_remove">

             
             <table class = "table table-bordered" style="width:100%">
                 
                 <tr>
                     <th colspan='4' class='text-center'>Employee Details</th>
                 </tr>
                 
                   <tr>
                     <th colspan='2'>Details</th>
                     <th>Previous Year</th>
                     <th>Current Year</th>
                 </tr>
                 
                   <tr>
                     <th colspan='2'>Number of Employee</th>
                     <th><input type="text" class="form-control" name="pre_no_of_emp" id="pre_no_of_emp"></th>
                     <th><input type="text" class="form-control" name="cur_no_of_emp" id="cur_no_of_emp"></th>
                 </tr>
                 
             </table>
                   <div class="form-group">
                         <div class="row">   
                          <div class="col-md-4">
                           <label>Number of Employee</label>
                         </div>
                          <div class="col-md-8">
                             <input type="text" class="form-control" name="risk_location" id="risk_location">
                          </div>
                      </div>
                  </div>
                  
                   <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Policy period</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="policy_period" id="policy_period">
                           </div>
                         </div>
                    </div>
                  
                 <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>No of floors</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="no_floors" id="no_floors">
                           </div>
                         </div>
                    </div> 
                    
                    
                     <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Claim Experience</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="claim_experience" id="claim_experience">
                           </div>
                         </div>
                    </div> 
                    
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Occupation</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="occupation" id="occupation">
                           </div>
                         </div>
                    </div>     
                                
                                
                            </div>
                            
               <div class ="hidden employee_policy">
                   
                        <div class="form-group">
                            <div class="row">   
                                <div class="col-md-4">
                                  <label>Name of Insured</label>
                                </div>
                                <div class="col-md-8">
                              <input type="text" class="form-control" name="name_insured" id="name_insured">
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">   
                                <div class="col-md-4">
                                  <label>Address</label>
                                </div>
                                <div class="col-md-8">
                              <input type="text" class="form-control" name="address" id="address">
                                </div>
                            </div>
                        </div>
                   
                   
                    <div class="form-group">
                            <div class="row">   
                                <div class="col-md-4">
                                  <label>Location of Insured</label>
                                </div>
                                <div class="col-md-8">
                              <input type="text" class="form-control" name="location_insured" id="location_insured">
                                </div>
                            </div>
                        </div>
                      
                         <div class="form-group">
                             <div class="row">   
                                <div class="col-md-4">
                                <label style ="color:#2E86C1;">Number of Employee</label>
                                    </div>
                                </div>  
                       <div class ="row">
                                   <div class="col-md-4">
                                       <label>Last Year</label>
                                         <input type="text" class="form-control" name="last_year" id="last_year">
                                </div>

                                    <div class="col-md-4">
                                        <label>Current Year</label>
                                      <input type="text" class="form-control" name="current_year" id="current_year">
                                </div>
                                
                                </div>
                            </div>
                            
                              <div class="form-group">
                                    <div class="row">   
                                            <div class="col-md-4">
                                             <label>Clauses to be attached</label>
                                               </div>
                                           </div>  
                                           <div class ="row">
                                               <div class="col-md-3">
                                                   <textarea class="form-control" name="b_valuation_import" id="b_valuation_import" rows="2" >Table-A: Indemnity against legal liability for accident to employees under</textarea>
                                               </div>
                                               
                                                <div class="col-md-3">
                                                   <textarea class="form-control" name="b_valuation_export" id="b_valuation_export" rows="2"  >Fatal Accident Act 1855</textarea>
                                               </div>
                                               
                                                <div class="col-md-3">
                                                   <textarea  class="form-control" name="b_valuation_inland" id="b_valuation_inland" rows="2" >Common Law</textarea>
                                               </div>
                                               
                                               
                                                <div class="col-md-3">
                                                   <textarea class="form-control" name="b_valuation_export" id="b_valuation_export" rows="2"  >Without Medical Extension</textarea>
                                               </div>
                                             </div>
                                        </div>         
                            
                            
                     
                     <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Wages Per Employee Per Month</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="add_employee_month" id="add_employee_month">
                           </div>
                         </div>
                    </div>  
                   
            </div>     
            
            
              <div class="hidden" id="office_package_polciy">
                   
                      <div class="form-group">
                             <div class="row">   
                              <div class="col-md-4">
                             <label>Name of the Insured</label>
                            </div>
                         <div class="col-md-8">
                             <input type="text" class="form-control" name="add_name_insured" id="add_name_insured">
                             </div>
                        </div>
                     </div>
                     
                     
                     <div class="form-group">
                         <div class="row">   
                              <div class="col-md-4">
                             <label>Period of Insurance</label>
                            </div>
                         <div class="col-md-8">
                             <input type="text" class="form-control" name="period_of_insurance" id="period_of_insurance">
                             </div>
                        </div>
                     </div>
                     
                     
                <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Age of Building</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="age_of_building" id="age_of_building">
                           </div>
                         </div>
                    </div> 
                     
                
                   
                  
              </div>
                            
                             
                        </div>
               
                        
             <div class="col-md-6">
             <div class="hidden" id="marine_remove">
                         
                              <div class="form-group">
                                <div class="row">   
                                   <div class="col-md-4">
                                        <label>Packing</label>
                                   </div>
                                   <div class="col-md-8">
                                       <input type="text" class="form-control" name="packing" id="packing">
                                   </div>
                                 </div>
                            </div>  
                     
                            <div class="form-group">
                                <div class="row">   
                                   <div class="col-md-4">
                                        <label>Occupancy</label>
                                   </div>
                                   <div class="col-md-8">
                                         <input type="text" class="form-control" name="occupancy" id="occupancy">
                                   </div>
                                 </div>
                            </div>
                            
                       
                            <div class="form-group">
                                <div class="row">   
                                   <div class="col-md-4">
                                        <label>Mode of Transport</label>
                                   </div>
                                   <div class="col-md-8">
                                       <select class = "form-control" name="transport" id="transport">
                                            <option value = "">--Select--</option>
                                            <option value = "Rail">Rail</option>
                                            <option value = "Road">Road</option>
                                            <option value = "Air">Air</option>
                                            <option value = "Sea">Sea</option>
                                       </select>
                                   </div>
                                 </div>
                            </div>
                     
                            <div class="form-group">
                                <div class="row">   
                                   <div class="col-md-4">
                                        <label>Voyage</label>
                                   </div>
                               </div>  
                               
                                <div class ="row">
                                   <div class="col-md-4">
                                       <label>Import</label>
                                          <textarea class="form-control" name="voyage_import" id="voyage_import" rows="3">From: Anywhere in India To: Anywhere in the World</textarea>
                                   </div>
                                   
                                    <div class="col-md-4">
                                        <label>Export</label>
                                      <textarea class="form-control" name="voyage_export" id="voyage_export" rows="3">From: Anywhere in the World To: Anywhere in India</textarea>
                                   </div>
                                   
                                    <div class="col-md-4">
                                        <label>Inland</label>
                                       <textarea class="form-control" name="voyage_inland" id="voyage_inland" rows="3">From: Anywhere in India To: Anywhere in India</textarea>
                                   </div>
                                 </div>
                            </div> 
                            
                       
                        
                    <div class="form-group">
                            <div class="row">   
                                  <div class="col-md-4">
                                <label>Initial Sum Insured Required</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="initial_sum_insured" id="initial_sum_insured">
                                </div>
                            </div>
                        </div>
                        
                       <div class="row">
                               <div class="col-md-4">
                                    <label style ="color:#2E86C1;">Insurer:</label>
                               </div>
                        </div>
                      
                       <div class="form-group">
                            <div class="row">   
                               <div class="col-md-4">
                                    <label>Current Insurer</label>
                               </div>
                               <div class="col-md-8">
                                   <input type="text" class="form-control" name="current_insurer" id="current_insurer">
                               </div>
                             </div>
                        </div>
                        
                        <div class="row">
                               <div class="col-md-4">
                                    <label style ="color:#2E86C1;"></label>
                               </div>
                        </div>
                       
                        <div class="form-group">
                           <div class="row">   
                                  <div class="col-md-4">
                                <label>Domestic</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="purchase_domestic" id="purchase_domestic">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">   
                                  <div class="col-md-4">
                                <label>Per Bottom Limit (Import)</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="bottom_import_limit" id="bottom_import_limit">
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">   
                                  <div class="col-md-4">
                                <label>Per Location Limit (Import)</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="location_import_limit" id="location_import_limit">
                                </div>
                            </div>
                        </div>
                    
                         <div class="form-group">
                                <div class="row">   
                                   <div class="col-md-4">
                                        <label>Claim History</label>
                                   </div>
                                   <div class="col-md-8">
                                       <textarea class="form-control" name="claim_history" id="claim_history" rows="3"></textarea>
                                   </div>
                                 </div>
                            </div> 
                            
                          
                           </div>  
                           
             <div class ="hidden" id="bharat_griha_raksha">
               
                      <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Occupancy/ Particular of Work</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="wc_occupancy" id="wc_occupancy">
                           </div>
                         </div>
                    </div>
                    
                    
                     <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Age of Building</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="building_age" id="building_age">
                           </div>
                         </div>
                    </div>  
                     
                     <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Safty Measures available</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="safty_measures" id="safty_measures">
                           </div>
                         </div>
                    </div> 
                    
                    
                      <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Phone Number</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="phone_number" id="phone_number">
                           </div>
                         </div>
                     </div> 
                     
                          
                       </div> 
        
               <div class="hidden employee_policy_month" >
                   
                      <div class="form-group">
                            <div class="row">   
                                <div class="col-md-4">
                                  <label>Policy Period</label>
                                </div>
                                <div class="col-md-8">
                              <input type="text" class="form-control" name="policy_period" id="policy_period">
                                </div>
                            </div>
                        </div>
                        
                        
                         <div class="form-group">
                            <div class="row">   
                                <div class="col-md-4">
                                  <label>Occupancy/ Particular of Work</label>
                                </div>
                                <div class="col-md-8">
                              <input type="text" class="form-control" name="occupancy_particular" id="occupancy_particular">
                                </div>
                            </div>
                        </div>
                        
                        
                         <div class="row">   
                            <div class="col-md-4">
                                <label style ="color:#2E86C1;" >Claim Details:</label>
                                   </div>
                                 </div> 
                                 
                    <div class="form-group">
                            <div class="row">   
                                <div class="col-md-4">
                                  <label>Claim Paid</label>
                                </div>
                                <div class="col-md-8">
                              <input type="text" class="form-control" name="claim_paid" id="claim_paid">
                                </div>
                            </div>
                        </div>
                        
                 <div class="form-group">
                            <div class="row">   
                                <div class="col-md-4">
                                  <label>Outstanding Claim</label>
                                </div>
                                <div class="col-md-8">
                              <input type="text" class="form-control" name="outstanding_claim" id="outstanding_claim">
                                </div>
                            </div>
                        </div>   
                        
                         <div class="form-group">
                            <div class="row">   
                                <div class="col-md-4">
                                  <label>Total Claim</label>
                                </div>
                                <div class="col-md-8">
                              <input type="text" class="form-control" name="total_claim" id="total_claim">
                                </div>
                            </div>
                        </div>  
                        
                        <div class="form-group">
                            <div class="row">   
                                <div class="col-md-4">
                                  <label>Last Three Years Claims</label>
                                </div>
                                <div class="col-md-8">
                              <input type="text" class="form-control" name="last_year_claims" id="last_year_claims">
                                </div>
                            </div>
                        </div>   
                        
                        <div class="form-group">
                            <div class="row">   
                                <div class="col-md-4">
                                  <label>Premium Paid</label>
                                </div>
                                <div class="col-md-8">
                              <input type="text" class="form-control" name="premium_paid" id="premium_paid">
                                </div>
                            </div>
                        </div>  
                        
                        
                <div class="form-group">
                    <div class="row">   
                         <div class="col-md-4">
                            <label>Declared Wages for 12 Month</label>
                          </div>
                          <div class="col-md-8">
                              <input type="text" class="form-control" name="add_declared_month" id="add_declared_month">
                          </div>
                        </div>
                  </div>
                  
                  
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Wages Per Month</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="add_wages_month" id="add_wages_month">
                           </div>
                         </div>
                    </div>

               </div>    
               
               
               <div class="hidden" id="office_package_polciy_2">
                   
                    <div class="form-group">
                         <div class="row">   
                            <div class="col-md-4">
                                 <label>Address of the Insured</label>
                             </div>
                            <div class="col-md-8">
                            <textarea class="form-control" name="address_of_insured" id="address_of_insured" rows="3"></textarea>
                                   </div>
                                 </div>
                            </div> 
                            
                       <div class="form-group">
                         <div class="row">   
                            <div class="col-md-4">
                             <label>Location Address</label>
                            </div>
                         <div class="col-md-8">
                             <input type="text" class="form-control" name="location_address" id="location_address">
                             </div>
                        </div>
                     </div>
                     
                      <div class="form-group">
                         <div class="row">   
                            <div class="col-md-4">
                             <label>No of floors</label>
                            </div>
                         <div class="col-md-8">
                             <input type="text" class="form-control" name="location_address" id="location_address">
                             </div>
                        </div>
                     </div>
                     
                   
                   
               </div>
                       
                         
                    </div>                     
                </div>
                    
                    <div class = "row hidden fire_div">
                        <div class ="col-md-6">
                              <div class="hidden fire_div">
                                        <div class="form-group">
                                                <div class="row">   
                                                   <div class="col-md-4">
                                                        <label>Period of Insurance</label>
                                                   </div>
                                                <div class="col-md-4">
                                                   <input type="date" class="form-control" name="fire_from_date" id="fire_from_date">
                                                </div>
                                                    
                                               <div class="col-md-4">
                                                   <input type="date" class="form-control" name="fire_to_date" id="fire_to_date">
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                                <div class="row">   
                                                   <div class="col-md-4">
                                                        <label>Financial Institution</label>
                                                   </div>
                                                <div class="col-md-8">
                                                   <input type="text" class="form-control" name="financial_institution" id="financial_institution">
                                                </div>
                                            </div>
                                        </div> 
                                 </div>
                        </div>
                        
                        <div class = "col-md-6 hidden fire_div">
                           <div class="form-group">
                                <div class="row">   
                                   <div class="col-md-4">
                                        <label>Occupancy</label>
                                   </div>
                                   <div class="col-md-8">
                                         <input type="text" class="form-control" name="fire_occupancy" id="fire_occupancy">
                                   </div>
                                 </div>
                            </div>
                      </div> 
                    </div>
                    
                    <div class = "row hidden fire_div">
                      <div class = "col-md-12">
                         <table class = "table table-bordered" style="width:100%">
                                 <tr>
                                     <td rowspan="4">Sum Insured</td>
                                     <td>
                                        <div class="form-group">
                                            <label>Particulars</label>
                                            <textarea class="form-control" name="fire_particulars_1" id="fire_particulars_1"></textarea>
                                        </div>
                                     </td>
                                     <td>
                                        <div class="form-group">
                                            <label>Fire Sum Insured (In Lacs)</label>
                                             <input type="text" class="form-control" name="fire_sum_ins_1" id="fire_sum_ins_1">
                                        </div>
                                     </td>
                                     <td>
                                        <div class="form-group">
                                            <label>Fire Sum Insured (In Lacs)</label>
                                             <input type="text" class="form-control" name="burglary_sum_ins_1" id="burglary_sum_ins_1">
                                        </div>
                                     </td>
                                 </tr>
                                 
                                 <tr>
                                     <td>
                                        <div class="form-group">
                                            <label>Particulars</label>
                                            <textarea class="form-control" name="fire_particulars_2" id="fire_particulars_2"></textarea>
                                        </div>
                                     </td>
                                     <td>
                                        <div class="form-group">
                                            <label>Fire Sum Insured (In Lacs)</label>
                                             <input type="text" class="form-control" name="fire_sum_ins_2" id="fire_sum_ins_2">
                                        </div>
                                     </td>
                                     <td>
                                        <div class="form-group">
                                            <label>Fire Sum Insured (In Lacs)</label>
                                             <input type="text" class="form-control" name="burglary_sum_ins_2" id="burglary_sum_ins_2">
                                        </div>
                                     </td>
                                 </tr>
                                 
                                 <tr>
                                     <td>
                                        <div class="form-group">
                                            <label>Particulars</label>
                                            <textarea class="form-control" name="fire_particulars_3" id="fire_particulars_3"></textarea>
                                        </div>
                                     </td>
                                     <td>
                                        <div class="form-group">
                                            <label>Fire Sum Insured (In Lacs)</label>
                                             <input type="text" class="form-control" name="fire_sum_ins_3" id="fire_sum_ins_3">
                                        </div>
                                     </td>
                                     <td>
                                        <div class="form-group">
                                            <label>Fire Sum Insured (In Lacs)</label>
                                             <input type="text" class="form-control" name="burglary_sum_ins_3" id="burglary_sum_ins_3">
                                        </div>
                                     </td>
                                 </tr>
                                 
                                 <tr>
                                     <td>
                                        <div class="form-group">
                                            <label>Particulars</label>
                                            <textarea class="form-control" name="fire_particulars_4" id="fire_particulars_4"></textarea>
                                        </div>
                                     </td>
                                     <td>
                                        <div class="form-group">
                                            <label>Fire Sum Insured (In Lacs)</label>
                                             <input type="text" class="form-control" name="fire_sum_ins_4" id="fire_sum_ins_4">
                                        </div>
                                     </td>
                                     <td>
                                        <div class="form-group">
                                            <label>Fire Sum Insured (In Lacs)</label>
                                             <input type="text" class="form-control" name="burglary_sum_ins_4" id="burglary_sum_ins_4">
                                        </div>
                                     </td>
                                 </tr>
                           </table>
                       </div>
                       
                      <div class = "col-md-6">
                            <div class="form-group">
                                  <div class="row">   
                                       <div class="col-md-4">
                                            <label>Extension or Clause's Required under Burglary</label>
                                       </div>
                                    <div class="col-md-8">
                                        <select class = "form-control" name="clause_under_burglary" id="clause_under_burglary">
                                            <option value = "RSMD">RSMD</option>
                                            <option value = "Theft Extension">Theft Extension</option>
                                            <option value = "Goods Held in Trust">Goods Held in Trust</option>
                                        </select>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group">
                                 <div class="row">   
                                       <div class="col-md-4">
                                            <label>Expiring Insurer</label>
                                       </div>
                                    <div class="col-md-8">
                                       <input type = "text" class = "form-control" name ="fire_expiry_insurer" id="fire_expiry_insurer">
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group">
                                 <div class="row">   
                                       <div class="col-md-4">
                                            <label>Date</label>
                                       </div>
                                    <div class="col-md-8">
                                       <input type = "date" class = "form-control" name ="fire_date" id="fire_date">
                                    </div>
                                </div>
                            </div> 
                      </div>
               
                     <div class = "col-md-6">
                           <div class="form-group">
                                 <div class="row">   
                                       <div class="col-md-4">
                                            <label> Claims Experience</label>
                                       </div>
                                    <div class="col-md-8">
                                        <input type = "text" class = "form-control" name ="claim_exprience" id="claim_exprience">
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group">
                                 <div class="row">   
                                       <div class="col-md-4">
                                            <label>Information</label>
                                       </div>
                                    <div class="col-md-8">
                                        <input type = "text" class = "form-control" name ="fire_information" id="fire_information">
                                    </div>
                                </div>
                            </div> 
                      </div>
                      
                      
                    </div>
              </div>
        </div>
     </section>
 </div>                  
                    
      
                  <!-- <div class ="hidden" id="sum_insured_rs" >          
       <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Fire Sum Insured (In Lacs)</label>
                           </div>
                          <div class="col-md-8">
                              <input type="text" class="form-control" name="suminsured_lacs" id="suminsured_lacs">
                          </div>
                    </div>
                </div>
        </div>-->                       
                    
       <!-- <div class="hidden" id="marine_Details" > 
        
                  <div class="form-group">
                      <div class="row">
                           <div class="col-md-4">
                                <label style ="color:#2E86C1;">Purchase:</label>
                           </div>
                         </div>
                    </div>  
            
              <div class="form-group">
                    <div class="row">   
                          <div class="col-md-4">
                        <label>Import</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="add_import" id="add_import">
                        </div>
                    </div>
                </div> 
                
                <div class="form-group">
                   <div class="row">   
                          <div class="col-md-4">
                        <label>Domestic</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="add_domestic" id="add_domestic">
                        </div>
                    </div>
                </div>
                
                 <div class="form-group">
                    <div class="row">   
                          <div class="col-md-4">
                        <label>Per Location Limit (Inland)</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="location_inland" id="location_inland">
                        </div>
                    </div>
                </div>
                
    
                   <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Current Insurer</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="current_insurer" id="current_insurer">
                           </div>
                         </div>
                    </div>
                    
                    
                 <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Date</label>
                           </div>
                           <div class="col-md-8">
                               <input type="date" class="form-control" name="date" id="date">
                           </div>
                         </div>
                    </div>
                    
             <!--    <div class="form-group">
                         <div class="row">   
                               <div class="col-md-4">
                                     <label>Current Status</label>
                               </div>
                               <div class="col-md-8">
                                   <select class="form-control" name="source" id="current_status">
                                        <option value="">--select--</option>
                                    <option value="Fresh"> Fresh</option>
                                   <option value="Renewal">Renewal </option>
                
                                        
                                    </select>
                               </div>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Information</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="information" id="information">
                           </div>
                         </div>
                    </div>  
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Hypothecation</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="hypothecation" id="hypothecation">
                           </div>
                         </div>
                    </div>
       
                   
            <div class="form-group">
                <div class="row">   
                    <div class="col-md-4">
                       <label>Salary site Engineer Per Month</label>
                    </div>
                      <div class="col-md-8">
                         <input type="text" class="form-control" name="supervisor_salary_month" id="supervisor_salary_month">
                         </div>
                     </div>
                   </div> 
                   
                     <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>No of Employees</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="add_employees" id="add_employees">
                           </div>
                         </div>
                    </div>  
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>No of supervisor</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="add_supervisor" id="add_supervisor">
                           </div>
                         </div>
                    </div>  
             
                
  
                <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Age of Building</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="building_age" id="building_age">
                           </div>
                         </div>
                    </div>  
                    
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Safty Measures available</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="safty_measures" id="safty_measures">
                           </div>
                         </div>
                    </div>  
                
     
                    


                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Covering Clauses</label>
                           </div>
                    <div class="col-md-8">
                        <div class='row'>
                            <div class="col-md-8">
                                <input type="text" style="margin:5px; width:97%;" id="covering_clauses" class="form-control coveringclauses">
                                <div id="add_covering_clauses">
                                   
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button id="sub_covering_btn" class="btn btn-info btn-sm pull-right"> - </button>
                                <button id="add_covering_btn" class="btn btn-info btn-sm pull-right" style="margin-right:5px;"> + </button>
                            </div>
                        </div>
                  </div>
                </div>
            </div>
            
    </div>-->       
    
            
            <!--<div class="hidden" id="marine_Details_remove">
                
            
                <div class="form-group">
                    <div class="row">   
                          <div class="col-md-4">
                        <label>Per Bottom Limit (Inland)</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="bottom_limit" id="bottom_limit">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">   
                          <div class="col-md-4">
                        <label>Per Bottom Limit (Import)</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="bottom_import" id="bottom_import">
                        </div>
                    </div>
                </div>
                
                
                <div class="form-group">
                    <div class="row">   
                          <div class="col-md-4">
                        <label>Per Location Limit (Import)</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="location_import" id="location_import">
                        </div>
                    </div>
                </div>
                
                
                    <div class="form-group">
                          <div class="row">   
                             <div class="col-md-4">
                                  <label>Covering Clauses</label>
                              </div>
                        <div class="col-md-8">
                            <div class='row'>
                               <div class="col-md-8">
                                 <input type="text" style="margin:5px; width:97%;" id="covering_clauses" class="form-control coveringclauses">
                                 <div id="add_covering_clauses">
                                </div>
                            </div>
                              <div class="col-md-3">
                                  <button id="sub_covering_btn" class="btn btn-info btn-sm pull-right"> - </button>
                                  <button id="add_covering_btn" class="btn btn-info btn-sm pull-right" style="margin-right:5px;"> + </button>
                              </div>
                           </div>
                       </div>
                   </div>
               </div> 
               
                 <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Claim History</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="claim_history" id="claim_history">
                           </div>
                         </div>
                    </div> 
             
        
                    
                   <!--  <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Mode of Transport</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="transport" id="transport">
                           </div>
                         </div>
                    </div>  -->
                    
             
                    
            <!--   <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Sum Insured</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="burglary_sum_Insured" id="sum_insured">
                           </div>
                         </div>
                    </div>   
                    
                    
                     <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Upload file</label>
                           </div>
                           <div class="col-md-8">
                               <input type="file" class="form-control" name="upload_file" id="upload_file">
                           </div>
                         </div>
                    </div>
                    
                     <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>File Name</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="file_name" id="file_name">
                           </div>
                         </div>
                    </div>
     
              <div class="form-group">
                <div class="row">   
                    <div class="col-md-4">
                       <label>Salary Per supervisor Per Month</label>
                    </div>
                      <div class="col-md-8">
                         <input type="text" class="form-control" name="supervisor_salary" id="supervisor_salary">
                         </div>
                     </div>
                   </div> 
                   
                  <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>No of site Engineer </label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="add_site_engineer" id="add_site_engineer">
                           </div>
                         </div>
                    </div> 
                   
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Clauses to be attached</label>
                           </div>
                                   <div class="col-md-8">
                        <div class='row'>
                            <div class="col-md-8">
                                <input type="text" style="margin:5px; width:97%;" id="clauses_attached" class="form-control clausesattched">
                                <div id="add_clauses_attached">
                                   
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button id="sub_file_btn" class="btn btn-info btn-sm pull-right"> - </button>
                                <button id="add_file_btn" class="btn btn-info btn-sm pull-right" style="margin-right:5px;"> + </button>
                            </div>
                        </div>
                  </div>
                </div>
            </div> 
            
                   <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>No of floors</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="no_floors" id="no_floors">
                           </div>
                         </div>
                    </div> 
          
          
               <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Period of Insurance</label>
                           </div>
                        <div class="col-md-4">
                           <input type="date" class="form-control" name="from_date" id="from_date">
                        </div>
                            
                       <div class="col-md-4">
                           <input type="date" class="form-control" name="to_date" id="to_date">
                        </div>
                    </div>
                </div>
                
    </div>-->  
    
  
    
    <script>
  
      $(document).ready(function(){
            $('#add_covering_btn').click(function(){
                var add = '<input type="text" style="margin:5px; width:97%;" class="form-control coveringclauses">';
                $("#add_covering_clauses").append(add);
            });
             $('#sub_covering_btn').click(function(){
			  $('#add_covering_clauses').children().last().remove();
		   });
		   
		   $('#add_file_btn').click(function(){
                var add = '<input type="text" style="margin:5px; width:97%;" class="form-control clausesattched">';
                $("#add_clauses_attached").append(add);
            });
            $('#sub_file_btn').click(function(){
			  $('#add_clauses_attached').children().last().remove();
		   });
		   
		$("#sme_policy").change(function(){
		    alert("hi");
		    
        var smepolicy = $("#sme_policy").val();
        alert(smepolicy);
         if(smepolicy == 74)
         {
              $("#marine_remove").removeClass("hidden");
              $("#marine").removeClass("hidden");
              $("#bharat_griha_raksha_remove").addClass("hidden");
              $("#bharat_griha_raksha").addClass("hidden");
              $(".employee_policy").addClass("hidden");
              $(".employee_policy_month").addClass("hidden");
               $(".fire_div").addClass("hidden");
              $(".fire_div").addClass("hidden");
         }
         else if(smepolicy == 3)
         {
              $("#marine").addClass("hidden");
              $("#marine_remove").addClass("hidden");
              $(".fire_div").removeClass("hidden");
              $(".fire_div").removeClass("hidden");
              $("#bharat_griha_raksha_remove").addClass("hidden");
              $("#bharat_griha_raksha").addClass("hidden");
              $(".employee_policy").addClass("hidden");
              $(".employee_policy_month").addClass("hidden");
              
         }
         else if(smepolicy == 4)
         {
          $("#marine").addClass("hidden");
          $("#marine_remove").addClass("hidden");
          $("#marine_Details_remove").addClass("hidden");
          $("#marine_Details").addClass("hidden");
          $("#sum_insured_lacs").addClass("hidden");
          $("#sum_insured_rs").addClass("hidden");
          $("#bharat_griha_raksha_remove").addClass("hidden");
          $("#bharat_griha_raksha").addClass("hidden");
          $("#building_property").addClass("hidden");
          $("#building_property_floors").addClass("hidden");
          $(".employee_policy").addClass("hidden");
          $(".employee_policy_month").addClass("hidden");
          $(".fire_div").addClass("hidden");
          $(".fire_div").addClass("hidden");
         }
        else if(smepolicy == 5)
         {
          $("#marine").addClass("hidden");
          $("#marine_remove").addClass("hidden");
          $("#marine_Details_remove").addClass("hidden");
          $("#marine_Details").addClass("hidden");
          $("#sum_insured_lacs").addClass("hidden");
          $("#sum_insured_rs").addClass("hidden");
          $(".employee_policy").addClass("hidden");
          $(".employee_policy_month").addClass("hidden");
          $("#bharat_griha_raksha_remove").removeClass("hidden");
          $("#bharat_griha_raksha").removeClass("hidden");
          $(".fire_div").addClass("hidden");
         $(".fire_div").addClass("hidden");
         }
         else if(smepolicy == 6)
         {
          $("#marine").addClass("hidden");
          $("#marine_remove").addClass("hidden");
          $(".fire_div").addClass("hidden");
         $(".fire_div").addClass("hidden");
          $("#marine_Details_remove").addClass("hidden");
          $("#marine_Details").addClass("hidden");
          $("#sum_insured_lacs").addClass("hidden");
          $("#sum_insured_rs").addClass("hidden");
          $(".employee_policy").removeClass("hidden");
          $(".employee_policy_month").removeClass("hidden");
          $("#building_property").addClass("hidden");
          $("#building_property_floors").addClass("hidden");
          $("#bharat_griha_raksha_remove").addClass("hidden");
          $("#bharat_griha_raksha").addClass("hidden");
          
         }
	});

   $("#save_btn").click(function(){
        var smepolicy =$("#sme_policy").val();
        var ins_period_from = $("#from_date").val();
        var ins_period_todate = $("#to_date").val();
        var occupancy = $("#occupancy").val();
        var commodity = $("#commodity_interest").val();
        var transport = $("#transport").val();
        var b_valuation_import = $("#b_valuation_import").val();
        var b_valuation_export = $("#b_valuation_export").val();
        var b_valuation_inland = $("#b_valuation_inland").val();
        var packing = $("#packing").val();
        var voyage_export =$("#voyage_export").val();
        var voyage_import =$("#voyage_import").val();
        var voyage_inland =$("#voyage_inland").val();
        var turnover =$("#add_turnover").val();
        var initial_sum_insured =$("#initial_sum_insured").val();
        var sales_domestic =$("#add_domestic").val();
        var purchase_import =$("#add_import").val();
        var purchase_domestic =$("#purchase_domestic").val();
        var bottomlimit =$("#bottom_inland_limit").val();
        var locationimport =$("#location_inland").val();
        var bottom_import_limit =$("#bottom_import_limit").val();
        var location_import_limit =$("#location_import_limit").val();
        var currentinsurer =$("#current_insurer").val();
        var claim_history =$("#claim_history").val();
        var date =$("#date").val();
        var packing = $("#packing").val();
        var voyage_export =$("#voyage_export").val();
        var voyage_import =$("#voyage_import").val();
        var voyage_inland =$("#voyage_inland").val();
        var turnover =$("#add_turnover").val();
        var initial_sum_insured =$("#initial_sum_insured").val();
        
        // Fire
        var smepolicy =$("#sme_policy").val();
        var fire_from_date = $("#fire_from_date").val();
        var fire_to_date = $("#fire_to_date").val();
        var fire_occupancy = $("#fire_occupancy").val();
        var commodity = $("#commodity_interest").val();
        var financial_institution = $("#financial_institution").val();
        var fire_particulars_1 = $("#fire_particulars_1").val();
        var fire_sum_ins_1 = $("#fire_sum_ins_1").val();
        var burglary_sum_ins_1 = $("#burglary_sum_ins_1").val();
        var fire_particulars_2 = $("#fire_particulars_2").val();
        var fire_sum_ins_2 = $("#fire_sum_ins_2").val();
        var burglary_sum_ins_2 = $("#burglary_sum_ins_2").val();
        var fire_particulars_3 = $("#fire_particulars_3").val();
        var fire_sum_ins_3 = $("#fire_sum_ins_3").val();
        var burglary_sum_ins_3 = $("#burglary_sum_ins_3").val();
        var fire_particulars_4 = $("#fire_particulars_4").val();
        var fire_sum_ins_4 = $("#fire_sum_ins_4").val();
        var burglary_sum_ins_4 = $("#burglary_sum_ins_4").val();
        var clause_under_burglary = $("#clause_under_burglary").val();
        var fire_expiry_insurer = $("#fire_expiry_insurer").val();
        var fire_date = $("#fire_date").val();
     
        var coveringclauses = [];
        var formdata = new FormData();
       $(".coveringclauses").each(function(){
            formdata.append("coveringclauses[]",this.value);
        });
        
        formdata.append("ins_period_from",ins_period_from);
        formdata.append("ins_period_todate",ins_period_todate);
        formdata.append("occupancy",occupancy);
        formdata.append("commodity",commodity);
        formdata.append("transport",transport);
        formdata.append("packing",packing);
        formdata.append("b_valuation_import",b_valuation_import);
        formdata.append("b_valuation_export",b_valuation_export);
        formdata.append("b_valuation_inland",b_valuation_inland);
        formdata.append("voyage_export",voyage_export);
        formdata.append("voyage_import",voyage_import);
        formdata.append("voyage_inland",voyage_inland);
        formdata.append("turnover",turnover);
        formdata.append("initial_sum_insured",initial_sum_insured);
        formdata.append("sales_domestic",sales_domestic);
        formdata.append("purchase_import",purchase_import);
        formdata.append("purchase_domestic",purchase_domestic);
        formdata.append("bottomlimit",bottomlimit);
        formdata.append("locationimport",locationimport);
        formdata.append("bottom_import_limit",bottom_import_limit);
        formdata.append("location_import_limit",location_import_limit);
        formdata.append("current_insurer",current_insurer);
        formdata.append("claim_history",claim_history);
        formdata.append("date",date);
        
        
        formdata.append("smepolicy",sme_policy);
        formdata.append("fire_from_date",fire_from_date);
        formdata.append("fire_to_date",fire_to_date);
        formdata.append("fire_occupancy",fire_occupancy);
        formdata.append("commodity",commodity_interest);
        formdata.append("financial_institution",financial_institution);
        formdata.append("fire_particulars_1",fire_particulars_1);
        formdata.append("fire_sum_ins_1",fire_sum_ins_1);
        formdata.append("burglary_sum_ins_1",burglary_sum_ins_1);
        formdata.append("fire_particulars_2",fire_particulars_2);
        formdata.append("fire_sum_ins_2",fire_sum_ins_2);
        formdata.append("burglary_sum_ins_2",burglary_sum_ins_2);
        formdata.append("fire_particulars_3",fire_particulars_3);
        formdata.append("fire_sum_ins_3",fire_sum_ins_3);
        formdata.append("burglary_sum_ins_3",burglary_sum_ins_3);
        formdata.append("fire_particulars_4",fire_particulars_4);
        formdata.append("fire_sum_ins_4",fire_sum_ins_4);
        formdata.append("burglary_sum_ins_4",burglary_sum_ins_4);
        formdata.append("clause_under_burglary",clause_under_burglary);
        formdata.append("fire_expiry_insurer",fire_expiry_insurer);
        formdata.append("fire_date",fire_date);
     
        
        
        $.ajax({
            url:"add_smedetails",
            method:"POST",
            data:formdata,
             method:"POST",
             processData:false,  
             contentType:false,
             cache:false,
             dataType:'text',
            beforeSend:function(){
                $("#save_btn").attr("disabled",true);
            },
            success:function(response){
                $(".form_control").val("");
                $("#save_btn").attr("disabled",false);
            },
            error: function(code) {   
                alert(code.statusText);
            },
          });
      });
});  
</script>
        
        