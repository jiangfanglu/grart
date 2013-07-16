<?php
/*Artist Products*/
defined('_JEXEC') or die('Restricted access');
?>
<?php include('/includes/user_header.php');?>
<div class="container">
    <div id="info_alert" class="alert alert-success" style="">
        <button type="button" class="close" data-dismiss="alert" onclick="return closeInfoAlert();">×</button>
        <span id="info_text">
            Your payment will be made on a monthly base. Frequent transactions of your payment will end up increasing your fee to PayPal. If you wish to find out more about the details, please read 
            <a target="_blank" href="https://cms.paypal.com/au/cgi-bin/marketingweb?cmd=_render-content&content_ID=ua/FeesPolicy_full&locale.x=en_AU">PayPal Fee Policy</a>
        </span>
</div>
    <p>
        The following account balance is calculated based on the Commission Rate. 
        <a href="">Check your Commission Rate table here</a>
    </p>
    <div id="sales_summary" class="acount_full_width">
        <div class="heading">Your Products' Sales Summary</div>
        <table>
            <thead>
                <tr>
                    <th>Your Receivable</th>
                    <th>Total Sales</th>
                    <th>Total Paid</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo '$'.number_format(($this -> balance),2,'.',','); ?></td>
                    <td><?php echo '$'.number_format($this -> salesTotal,2,'.',','); ?></td>
                    <td><?php echo '$'.number_format($this -> total_payment,2,'.',','); ?></td>
                </tr>
            </tbody>
        </table>
        
<!--        <div class="label">Your Receivable:</div>
        <div class="text"><?php echo '$'.number_format(($this -> balance),2,'.',','); ?></div>
        <div class="label">Total Sales</div>
        <div class="text"><?php echo '$'.number_format($this -> salesTotal,2,'.',','); ?></div>
        <div class="label">Total Paid:</div>
        <div class="text"><?php echo '$'.number_format($this -> total_payment,2,'.',','); ?></div>-->
    </div>
    
    <div id="a_product_list" class="acount_full_width">
        <div class="heading">Your Products' Sales Details</div>
        <table>
            <thead class="a_product_item_heading">
                <tr>
                    <th class="image_thumbs">Product</th>
                    <th>Title</th>
                    <th>Total Sold</th>
                    <th>Sales Total</th>
                </tr>
            </thead>
            <tbody class="a_product_item">
                <?php $n=0 ?>
                <?php foreach($this->products as $p){ ?>
                <tr class='<?php echo $n%2 ==0 ? 'alt' : '' ?>'>
                    <td class="image_thumbs"><a href="<?php echo JUri::base()."index.php?option=com_opencart&route=product/product&product_id=".$p->product_id ?>" target="_blank"><?php echo '<img src="'.Juri::base().'media/uploaded_artwork/'.$this->user->id.'/200/'.$p->filename.'"/>'?></a></td>
                    <td style="width:250px;"><?php echo $p->title ?></td>
                    <td><?php echo $p->total_sales_number ?></td>
                    <td><?php echo "$".number_format(($p-> sales_total_amount),2,'.',',') ?></td>
                </tr>
                <?php $n++ ?>
                 <?php } ?>
            </tbody>
        </table>
       
    </div>
     
    <div class="acount_full_width">
        <a href="" >
            &gt;&gt; Contact us if you have any payment issues
        </a>
    </div>
     
</div>


