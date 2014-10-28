<?php
/**
 * @category views
 * @package contact-form
 * view name : 'contact-form'
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
                    <div class="heading">Add/Edit Address <div style="float:right;color: #0B55C4;padding-right: 10px;"><a href="<?= $this->getApplicationUrl(); ?>/contact/home?page=<?= $this->getParam('page', '1'); ?>">Back To Address Book</a></div></div>

                    <div class="heading">
                        <div align="center" id="message">

                        </div>
                    </div>

                    <div style="width:400px; margin:0 auto;">
                        <div class="wrapper">
                            <form id="contact" action="<?= $this->getBaseUrl(); ?>index.php/contact/save" method="POST">
                                <div class="PageEmptySpacer">&nbsp;</div>

                                <div class="FormInnerWrapper">
                                    <div class="FormCol1">
                                        <label>First Name</label>
                                    </div>
                                    <div class="FormCol2">
                                        <input type="text" name="firstname" id="firstname" class="InputField" value="<?php
if (isset($row->firstname))
    echo $row->firstname;
?>" />
                                    </div>

                                </div>

                                <div class="FormInnerWrapper">
                                    <div class="FormCol1">
                                        <label>Last Name</label>
                                    </div>
                                    <div class="FormCol2">
                                        <input type="text" name="lastname" id="lastname" class="InputField" value="<?php
                                               if (isset($row->lastname))
                                                   echo $row->lastname;
?>" />
                                    </div>

                                </div>

                                <div class="FormInnerWrapper">
                                    <div class="FormCol1">
                                        <label>City</label>
                                    </div>
                                    <div class="FormCol2">
                                        <input type="text" name="city" id="city" class="InputField" value="<?php
                                               if (isset($row->city))
                                                   echo $row->city;
?>" />
                                    </div>

                                </div>



                                <div class="FormInnerWrapper">
                                    <div class="FormCol1">
                                        <label>State</label>
                                    </div>
                                    <div class="FormCol2">
                                        <input type="text" name="state" id="state" class="InputField" value="<?php
                                               if (isset($row->state))
                                                   echo $row->state;
?>" />
                                    </div>
                                   
                                </div>

                                <div class="FormInnerWrapper">
                                    <div class="FormCol1">
                                        <label>Zip</label>
                                    </div>
                                    <div class="FormCol2">
                                        <input type="text" name="zip" id="zip" class="InputField" value="<?php
                                               if (isset($row->zip))
                                                   echo $row->zip;
?>" />
                                    </div>
                                  
                                </div>
                                <div class="FormInnerWrapper">
                                    <div class="FormCol1">
                                        <label>Interests</label>
                                    </div>
                                    <div class="FormCol2">
                                        <input type="text" name="interests"  id="interests" class="InputField" value="<?php
                                               if (isset($row->interests))
                                                   echo $row->interests;
?>" />
                                    </div>
                                    
                                </div>
                                <div class="FormInnerWrapper">
                                    <div class="FormCol1">
                                        &nbsp;
                                    </div>
                                    <div class="FormCol2" style="" >
                                        <input type="hidden" name="id" value="<?php
                                               if (isset($row->id))
                                                   echo $row->id;
?>" class="InputField"   />
                                        <input type="hidden" name="page" value="<?php
                                               echo $this->getParam('page', '1');
?>" class="InputField"   />
                                        <input type="button" value="Reset" class="button" />
                                        <input type="submit" value="Save" class="button" />
                                    </div>

                                </div>
                            </form>
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