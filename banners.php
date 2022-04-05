<?php
    if (isset($_GET['created']) && $_GET['created'] === 'failure') { ?>
    <div class="failure-alert">
        <strong>News could not be created</strong>
    </div>
    <?php } if (isset($_GET['created']) && $_GET['created'] === 'success'){ ?>
    <div class="success-alert">
        <strong>News was successfully created!</strong>
    </div>
    <?php } ?>

    <?php if (isset($_GET['deleted']) && $_GET['deleted'] === 'failure') { ?>
        <div class="failure-alert">
            <strong>News could not be deleted</strong>
        </div>
    <?php } if (isset($_GET['deleted']) && $_GET['deleted'] === 'success'){ ?>
        <div class="success-alert">
            <strong>News was successfully deleted!</strong>
        </div>
    <?php } ?>

    <?php if (isset($_GET['edited']) && $_GET['edited'] === 'failure') { ?>
        <div class="failure-alert">
            <strong>News could not be edited</strong>
        </div>
    <?php } if (isset($_GET['edited']) && $_GET['edited'] === 'success'){ ?>
        <div class="success-alert">
            <strong>News was successfully edited!</strong>
        </div>
    <?php } ?>
