{include file="header.tpl"}
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-4 col-sm-offset-3">
            <form class="form-horizontal clearfix"   method="post" action="install.php">
                <div class="row">
                    <div class="form-group col-md-7">
                        <label for="ServerName">Server Name</label><br>
                        <input type="text" class="form-control" id="ServerName" name="ServerName" placeholder="Server Name" value="">
                    </div>
                    <div class="form-group col-md-7">
                        <label for="UserName">User name:</label><br>
                        <input type="text" class="form-control" id="UserName" name="UserName" placeholder="User Name" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-7">
                        <label for="Password">Password</label><br>
                        <input type="password" class="form-control" id="Password" name="Password" placeholder="Password" value="">
                    </div>
                    <div class="form-group col-md-7">
                        <label for="Database">Database:</label><br>
                        <input type="text" class="form-control" id="Database" name="Database" placeholder="Database" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <input type="submit" class="btn btn-info" style="width:100%" id="form_submit" value="INSTALL" name="INSTALL">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{include file="footer.tpl"}
