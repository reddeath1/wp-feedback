<?php
/**
 * Created by PhpStorm.
 * User: reddeath
 * Date: 11/7/2018
 * Time: 11:36 PM
 */
wp_head();
?>

<div class="container">
    <div class="row">

        <section class="content">
            <h1>Feed Back</h1>
            <div class="col-sm-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-filter" data-target="pagado">Approved</button>
                                <button type="button" class="btn btn-warning btn-filter" data-target="pendiente">Pending</button>
                                <button type="button" class="btn btn-danger btn-filter" data-target="cancelado">Deleted</button>
                                <button type="button" class="btn btn-default btn-filter" data-target="all">All</button>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="table table-filter">
                                <tbody>
                                <tr data-status="pagado">
                                    <td>
                                        <div class="ckbox">
                                            <input type="checkbox" id="checkbox1">
                                            <label for="checkbox1"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="javascript:;" class="star">
                                            <i class="glyphicon glyphicon-star"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="media">
                                            <a href="#" class="pull-left">
                                                <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                            </a>
                                            <div class="media-body">
                                                <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                <h4 class="title">
                                                    Lorem Impsum
                                                    <span class="pull-right pagado">(Pagado)</span>
                                                </h4>
                                                <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr data-status="pendiente">
                                    <td>
                                        <div class="ckbox">
                                            <input type="checkbox" id="checkbox3">
                                            <label for="checkbox3"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="javascript:;" class="star">
                                            <i class="glyphicon glyphicon-star"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="media">
                                            <a href="#" class="pull-left">
                                                <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                            </a>
                                            <div class="media-body">
                                                <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                <h4 class="title">
                                                    Lorem Impsum
                                                    <span class="pull-right pendiente">(Pendiente)</span>
                                                </h4>
                                                <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr data-status="cancelado">
                                    <td>
                                        <div class="ckbox">
                                            <input type="checkbox" id="checkbox2">
                                            <label for="checkbox2"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="javascript:;" class="star">
                                            <i class="glyphicon glyphicon-star"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="media">
                                            <a href="#" class="pull-left">
                                                <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                            </a>
                                            <div class="media-body">
                                                <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                <h4 class="title">
                                                    Lorem Impsum
                                                    <span class="pull-right cancelado">(Cancelado)</span>
                                                </h4>
                                                <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr data-status="pagado" class="selected">
                                    <td>
                                        <div class="ckbox">
                                            <input type="checkbox" id="checkbox4" checked>
                                            <label for="checkbox4"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="javascript:;" class="star star-checked">
                                            <i class="glyphicon glyphicon-star"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="media">
                                            <a href="#" class="pull-left">
                                                <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                            </a>
                                            <div class="media-body">
                                                <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                <h4 class="title">
                                                    Lorem Impsum
                                                    <span class="pull-right pagado">(Pagado)</span>
                                                </h4>
                                                <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr data-status="pendiente">
                                    <td>
                                        <div class="ckbox">
                                            <input type="checkbox" id="checkbox5">
                                            <label for="checkbox5"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="javascript:;" class="star">
                                            <i class="glyphicon glyphicon-star"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="media">
                                            <a href="#" class="pull-left">
                                                <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                            </a>
                                            <div class="media-body">
                                                <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                <h4 class="title">
                                                    Lorem Impsum
                                                    <span class="pull-right pendiente">(Pendiente)</span>
                                                </h4>
                                                <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
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