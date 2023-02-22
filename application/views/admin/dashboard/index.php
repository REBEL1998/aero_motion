<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="row">
    <!-- [ Data widgets ] Start -->
    <!-- Data card 2 Start -->

    <?php  if (!empty($arrContactDetails)) { ?>
        <div class="col-xl-4 col-md-12">
            <div class="card ui-messages ">
                <h4 class="card-header">Latest Inquiry</h4>
                <div class="card-body ps ps--active-y" id="messages" >
                <?php foreach($arrContactDetails as $tempData) { 
                    $tempDate = date("d/m/Y h:i A", strtotime($tempData['dateadded']));
                    ?>
                    <div class="row mt-3">
                        <div class="col">
                            <h5 class="mb-2"><?php echo  $tempData['contactname']; ?> <span class="text-muted float-right small"><?php echo  $tempDate; ?></span></h5>
                            <span class="tag badge badge-success"><i class="feather icon-mail"></i>&nbsp;&nbsp;&nbsp;<?php echo  $tempData['email']; ?></span>
                            <span class="tag badge badge-primary"><i class="feather icon-phone-call"></i>&nbsp;&nbsp;&nbsp;<?php echo  $tempData['phone']; ?></span>
                            <p class="text-muted mb-0 mt-1">Subject :: <?php echo  $tempData['subject']; ?></p>
                        </div>
                    </div>
                    <hr class="mb-2 mt-2">
                <?php  } ?>
            </div>
        </div>
    <?php  } ?>
    <!-- Data card 2 End -->
</div>