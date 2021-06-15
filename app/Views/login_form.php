<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login Form</title>
        <link href="<?php echo base_url('/templates/sbadmin'); ?>/css/styles.css" rel="stylesheet" />
        <link href="<?php echo base_url('/lib'); ?>/font-awesome-4/css/font-awesome.min.css" rel="stylesheet"/>
        <link href="<?php echo base_url('/lib'); ?>/bootstrap-4/css/bootstrap.min.css" rel="stylesheet"/>
        
        
        <script src="<?php echo base_url('/lib/jquery-ui/external/jquery'); ?>/jquery.js" type="text/javascript"></script>
        <script src="<?php echo base_url('/lib/bootstrap-4'); ?>/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url('/templates/sbadmin'); ?>/js/scripts.js" type="text/javascript"></script>
        
    </head>
    <body class="sb-nav-fixed bg-secondary">
        <div class="container">
            <div class="row" style="padding-top:120px">
                <div class="col-6" style="margin:0 auto;">
                    <div class="card">
                        <div class="card-header"> Login System</div>
                        <div class="card-body">
                            <form id="formLogin">
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" class="form-control" name="email"  placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label >Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>

                                
                            </form>
                        </div>
                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-primary">Sign In</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>