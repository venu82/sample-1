<?php
/**
 * @category views
 * @package header
 * view name : 'header'
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1CBDDE8/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Address Application</title>

        <style type="text/css">
            @import "<?= $this->getBaseUrl(); ?>/public/css/style.css";
        </style>
         <script src="http://code.jquery.com/jquery-1.6.min.js"></script>
          <script src="<?= $this->getBaseUrl(); ?>/public/js/functions.js"></script>
    </head>
    <body>
        <div id="pagewrapper">
            <div id="pagewrapper-innermargin">

                <div id="headerpane">
                    <!--Header Section Starts-->
                    <div class="row1">
                        <div class="lleft"> <a href="<?=$this->getApplicationUrl();?>">Address Book</a> </div>
                        <div class="lright">
                            <div class="user-list">
                                <?php
                                if ($this->isLoggedIn()) {
                                ?>

                                    <ul id="user-preference">

                                        <li class="user">Welcome <strong><?=$this->getUserName(); ?></strong></li>
                                        <li>|</li>
                                        <li class="logout"><a href="<?=$this->getApplicationUrl();?>/index/logout" title="">Logout</a></li>
                                    </ul>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!--Header Section Ends-->
                </div>