<?php
    
    
?>
<style>
    #push{
        padding-bottom:220px;
    }
</style>
<form method="POST" action="download.php">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Dashboard <small>Battery Data Logger</small>
        </h1>
        <ol class="breadcrumb">
            <li>
               <a href="main,php?page_id=dashboard&pack_id=1">
                    <i class="fa fa-dashboard"></i> Dashboard
               </a>
            </li>
            <li class="active">Configuration</li>
        </ol>
    </div>
</div>

<div class="row">
	<div class="col-lg-3">
		&nbsp;
	</div>
    <div class="col-lg-6">
        <table class="table">
            <thead>
                <tr>
                    <td>
                        <h3>DATE LOG</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        DATE FROM
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-calendar" aria-hidden="true"></i>
                            </span>
                            <input type="date" class="form-control" name="fr" value="<?=date("Y-m-d")?>" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        DATE TO
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </span>
                            <input type="date" class="form-control" name="to" value="<?=date("Y-m-d")?>" />
                        </div>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
    <div class="col-lg-3">
		&nbsp;
	</div>
</div>
<br>
<div class="row">
    <div class="col-lg-12 text-center">
        <input type="submit" class="btn btn-primary" value="DOWNLOAD" name="update">
    </div>    
</div>
<div id="push"></div>
</form>
