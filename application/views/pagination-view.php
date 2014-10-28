<?php
/**
 * @category views
 * @package pagination-view
 * view name : 'pagination-view'
 */
?>
<?php

if ($pagination->totalpages() > 1) {
?>

    <ul class="pagination">
    <?php
    if ($pagination->has_prevpage()) {
    ?>
        <li>
            <a href="<?php echo $link . "?page=" . $pagination->prevpage(); ?>">
                &lt;&lt;Prev</a>
        </li>
    <?php
    }

    for ($i = 1; $i <= $pagination->totalpages(); $i++) {
        if ($i == $pagination->current_page) {
    ?>
            <li class="current">
        <?php echo " " . $i; ?>
        </li>
    <?php
        } else {
    ?>
            <li>
                <a href="<?php echo $link . "?page=$i"; ?>"> <?php echo $i; ?></a>
            </li>
    <?php
        }
    }
    if ($pagination->has_nextpage()) {
    ?>
        <li>
            <a href="<?php echo $link . "?page=" . $pagination->nextpage(); ?>">
                Next&gt;&gt;</a>
        </li>
    <?php
   }
    ?>

</ul>
<?php
}
?>