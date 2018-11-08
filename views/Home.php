<?php
/**
 * Created by PhpStorm.
 * User: reddeath
 * Date: 11/7/2018
 * Time: 11:36 PM
 */
wp_head();

global $wpdb;
?>

<div class="container">
    <div class="row">

        <section class="content">
            <h1>Feed Back</h1>
            <div class="col-sm-12 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-filter" data-target="approved">Approved</button>
                                <button type="button" class="btn btn-warning btn-filter" data-target="pending">Pending</button>
                                <button type="button" class="btn btn-danger btn-filter" data-target="cancelled">Deleted</button>
                                <button type="button" class="btn btn-default btn-filter" data-target="all">All</button>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="table table-filter">
                                <tbody>
                                <?php echo get_feed_back();?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="content-footer">
                    <p>
                        Feedback © - <?php echo date("Y")?><br>
                        Powered By <a href="http://frankgalos.herokuapp.com" target="_blank">Frank Galos</a>
                    </p>
                </div>
            </div>
        </section>

    </div>
</div>

<?php wp_footer(); ?>