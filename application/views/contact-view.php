<?php
/**
 * @category views
 * @package contact-view
 * view name : 'contact-view'
 */
?>
<?php
$this->loadView('header');
?>
<div id="contentpane">
    <!--Content Section Starts-->
    <div class="content-wrapper">
        <div class="content-inner-wrapper">
            <div class="container">
                <div class="dashboard-box">
                    <div class="heading">View Address<div style="float:right;color: #0B55C4;padding-right: 10px;">
                            <a href="<?=$this->getApplicationUrl();?>/contact/home?page=<?=$this->getParam('page','1');?>">
                                Back To Address Book
                            </a>
                        </div></div>
                   

                    <div style="width:400px; margin:0 auto;">
                        <div class="wrapper">

                            <div class="PageEmptySpacer">&nbsp;</div>
                            <table class="adminlist" cellspacing="0" cellpadding="0" border="0" >
                                <?php
                                if (isset($row->firstname)) {
                                ?>
                                    <tr>
                                        <td>First Name</td>
                                        <td> <?= $row->firstname; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>

                                <?php
                                if (isset($row->lastname)) {
                                ?>
                                    <tr>
                                        <td>Last Name</td>
                                        <td> <?= $row->lastname; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>

                                <?php
                                if (isset($row->city)) {
                                ?>
                                    <tr>
                                        <td>City</td>
                                        <td> <?= $row->city; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>

                                <?php
                                if (isset($row->state)) {
                                ?>
                                    <tr>
                                        <td>State</td>
                                        <td> <?= $row->state; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <?php
                                if (isset($row->zip)) {
                                ?>
                                    <tr>
                                        <td>zip</td>
                                        <td> <?= $row->zip; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <?php
                                if (isset($row->interests)) {
                                ?>
                                    <tr>
                                        <td>Interests</td>
                                        <td> <?= $row->interests; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>


                            </table>
                            <?php
                                if (count($images) != 0) {
                                    echo '<h3>Related Images</h3><br>';
                                    foreach ($images as $title=>$src) {
                            ?>
                                        <img src="<?= $src ?>" alt="<?=$title;?>"/>
<?php
                                    }
                                }
?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Content Section Ends-->
    </div>

<?php
                                $this->loadView('footer');
?>