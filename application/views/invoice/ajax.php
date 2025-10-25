<div class="">
    <table class='table' border='0'>
        <thead>
            <tr>
                <th style='font-size:16px;'>
                    Insurance Name : <?=$company_name?>
                </th>
                <th style='font-size:16px;'>
                    Total no policies : <?=count($invoicelist)?>
                </th>
                <th>&nbsp;</th>
            </tr>    
            <tr>
                  <th>Policy Type</th>
                  <th>Policy Count</th>
                  <th>Own Commisison</th>
            </tr>
        </thead>
        <tbody>
            <?php if( isset( $policyTypes ) && !empty( $policyTypes ) ):?>
                <?php foreach( $policyTypes as $policyType ):?>
                    <?php $own_commission = $policy_count = $irdi_commission = 0; ?>
                    <?php $own_commission = (isset( $invoicelist[$policyType] ) && !empty( $invoicelist[$policyType] ) ) ? array_sum($invoicelist[$policyType]) : 0; ?>
                    <?php $policy_count   = (isset( $invoicelist[$policyType] ) && !empty( $invoicelist[$policyType] ) ) ? count($invoicelist[$policyType]) : 0; ?>
                    <tr>
                        <td><?=$policyType?></td>
                        <td style='text-align:right'><?=($policy_count)?></td>
                        <td style='text-align:right'><?=number_format(floor($own_commission),2)?></td>
                    </tr>
                    
                <?php endforeach;?>
            <?php endif;?>
        </tbody>
        <tfoot>
            <tr>
                <td style='text-align:right'><b>Total</b></td>
                <td style='text-align:right'><b><?=number_format(floor($total_count))?></b></td>
                <td style='text-align:right'><b><?=number_format(floor($total_amount),2)?></b></td>
            </tr>
            <!--<tr>
                <td colspan="3" style='text-align:right'>
                    <button type="button" value="Revisied" class="btn btn-primary" onclick="invoice_revisied()">Invoice Revisied</button>
                </td>
            </tr>-->
        </tfoot>
    </table>    
</div>
