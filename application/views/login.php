<?php
/**
 * @category views
 * @package login
 * view name : 'login'
 */
?>
<?php
$this->loadView('header');
?>
<div id="contentpane">
    <!--Content Section Starts-->

    <div class="" style="width:400px; margin:0 auto;">

        <div class="wrapper">
            <div class="loginfields-content">
                <div class="heading">
                    <div  id="message" align="center">
                        <?php
                        if (isset($message)) {
                            print $message;
                        }
                        ?>
                    </div>
                </div>
                <form id="login" action="<?= $this->getApplicationUrl(); ?>/index/login" method="post" >
                    <div id="row1" >

                        <div class="col2"> User Name &nbsp;
                            <span id="username">
                                <input type="text" name="username" id="username"  class="logina-bg" style="width:70%; height:25px;"  />
                            </span>
                        </div>
                    </div>

                    <div id="row1">

                        <div class="col2">Password &nbsp;<span id="password-bg"><input type="password" name="password" id="password"  maxlength="15"  style="width:70%; height:25px; margin:0 0 0 7px;" />
                            </span></div>
                    </div>

                    <div id="row1"></div>

                    <div id="row3"></div>
                    <input type="submit" name="entersite" style="float:right" id="entersite" value="Login" class="login-but"  />
                    <input type="reset" name="entersite" style="float:right"  id="register" value=" Cancel" class="reset-but"  />
                    <div id="row1"></div>

                    <div id="row3"></div>
                </form>
            </div>
        </div>

    </div>

    <!--Content Section Ends-->
</div>
<?php
                        $this->loadView('footer');
?>