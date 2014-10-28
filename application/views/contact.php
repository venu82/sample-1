<?php
/**
 * @category views
 * @package contact
 * view name : 'contact'
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
                    <div class="heading">Address List<div style="float:right;color: #0B55C4;padding-right: 10px;"><a href="<?=$this->getApplicationUrl();?>/contact/add">Add Address</a></div></div>
                    
                    <?php
                    if($message=$this->getParam('message')){
                    ?>
                    <div class="heading">
                        <div align="center">
                           <?=$message;?>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <?php
                    if(count($rows)==0){
                    ?>
                    <div class="heading">
                        <div align="center">
                            There are no Contacts, <a href="<?=$this->getApplicationUrl();?>contact/add">Click here to add contacts</a>
                        </div>
                    </div>
                    <?php
                    }
                    else{
                    ?>

                    <div class="grid-wrapper">
                        <div class="table-list">
                            <table class="adminlist" cellspacing="0" cellpadding="0" border="0" >
                                <thead>
                                    <tr >
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Zip</th>
                                        <th>Interests</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $count = $pagination->offset() + 1;
                                    foreach ($rows as $row) {
                                    ?>
                                        <tr class="row0">
                                            <td><?= $count++; ?></td>
                                            <td><a href="<?= $this->getBaseUrl(); ?>index.php/contact/view?id=<?= $row->id; ?>&page=<?=$this->getParam('page','1');?>">
                                            <?= $row->firstname; ?> <?= $row->lastname; ?>
                                               </a>
                                               </td>

                                               <td><?= $row->city; ?></td>
                                               <td><?= $row->state; ?></td>
                                               <td><?= $row->zip; ?></td>
                                               <td><?= $row->interests; ?></td>
                                               <td>
                                               <a href="<?= $this->getBaseUrl(); ?>index.php/contact/edit?id=<?= $row->id; ?>&page=<?=$this->getParam('page','1');?>">
                                               <img src="<?= $this->getBaseUrl(); ?>public/images/edit-icon.gif" alt="" title="" />
                                            </a>
                                            <a href="<?= $this->getBaseUrl(); ?>index.php/contact/delete?id=<?= $row->id; ?>&page=<?=$this->getParam('page','1');?>">
                                                <img src="<?= $this->getBaseUrl(); ?>public/images/delete-icon.gif" alt="" title="" />
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>

                                    </tbody>
                                </table>
                                <div>
                                <?php
                                        $this->loadView('pagination-view',
                                                array(
                                                    'pagination' => $pagination,
                                                    'link' => $link
                                        ));
                                ?>
                                    </div>

                                </div>
                            </div>
                    <?php
                    }
                    ?>
                        </div>
                    </div>
                </div>
            </div>
            <!--Content Section Ends-->
        </div>

<?php
                                        $this->loadView('footer');
?>