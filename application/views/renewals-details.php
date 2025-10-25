	
    <div class="modal fade in" id="scrollmodal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Date</th>
                            <th colspan="2"><?=$fromdate?></th>
                            <th>Class</th>
                            <th colspan="2"><?=strtoupper($policy)?></th>
                            <th>Status</th>
                            <th colspan="2"><?=strtoupper($type)?></th>
                        </tr>
                    </table>
                    <table id="table_id" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Client Name</th>
                                <th>Mobile No</th>
                                <th>Business Type</th>
                                <th>Policy Type</th>
                                <th>Policy No</th>
                                <th>Area</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if( isset( $results ) && !empty( $results ) ):?>
                                <?php $sl = 1;?>
                                <?php foreach( $results as $row ):?>
                                    <tr>
                                        <td><?=($sl++)?></td>
                                        <td><?=$row->client_name?></td>
                                        <td><?=$row->mobile_no?></td>
                                        <td><?=$row->bussiness_type?></td>
                                        <td><?=$row->policy_type_name?></td>
                                        <td><?=$row->policy_no?></td>
                                        <td><?=$row->area?></td>
                                        <td><?=$row->date?></td>
                                    </tr>
                                <?php endforeach;?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


  <script>
    $(document).ready(function(){
        $('#scrollmodal').modal('show');
        $('#table_id').DataTable();
    });
    
  </script>