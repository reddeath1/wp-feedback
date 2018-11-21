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
                                <button type="button" class="btn btn-default btn-filter" data-target="all">All</button>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="table table-filter">
                                <tbody class="post-container">
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


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary send">Send</button>
                </div>
            </div>
        </div>
    </div>

</div>

<?php wp_footer(); ?>