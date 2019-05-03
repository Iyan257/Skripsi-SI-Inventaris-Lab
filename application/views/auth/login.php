<!doctype HTML>
<html lang="en" class="fixed">
    <head>
        <title>Inventaris Lab TIF &middot; Admin <?= isset($subtitle)? "&middot; $subtitle" : '' ?></title>
        <?php $this->layout->section('admin/header'); ?>
    </head>
    <body>
        <section class="body">
            <section class="body-sign">
                <div class="center-sign">
                    <div class="panel panel-sign">
                        <div class="panel-title-sign mt-xl text-right">
                            <h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
                        </div>
                        <div class="panel-body">
                            <?= form_open('auth/login'); ?>
                                <img src="<?= base_url('assets/images/logoInformatika.jpg')?>" height="44" alt="Logo Informatika" />
                                
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-lg-12">
                                    <?php if($this->session->flashdata('message') != null): ?>
                                        <div class="alert alert-success">
                                            <b>Success!</b> <?= $this->session->flashdata('message') ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php $errors = $this->session->flashdata('errors'); $len_error = is_array($errors)? count($errors) : 0; ?>
                                    <?php if($errors!=null):?>
                                        <div class="alert alert-danger">
                                            <b>Error!</b> <?= $len_error <= 1? (is_array($errors)? $errors[0] : $errors) : ''?>
                                            <?php if($len_error > 1): ?>
                                                <ul class="mb-0">
                                                    <?php foreach($errors as $error): ?>
                                                        <li><?= $error ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group mb-lg">
                                    <label>Username</label>
                                    <div class="input-group input-group-icon">
                                        <input type="text" class="form-control input-lg" name="username" placeholder="username"/ autofocus> 
                                        <span class="input-group-addon">
                                            <span class="icon icon-lg">
                                                <i class="fa fa-user"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group mb-lg">
                                    <div class="clearfix">
                                        <label class="pull-left">Password</label>
                                    </div>
                                    <div class="input-group input-group-icon">
                                        <input type="password" class="form-control input-lg" name="password" placeholder="password"/>
                                        <span class="input-group-addon">
                                            <span class="icon icon-lg">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4 col-sm-offset-8 text-right">
                                        <button name="submit" type="submit" class="btn btn-primary">Sign In</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2018. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                </div>
            </section>
        </section>
        
        <?php $this->layout->section('admin/footer'); ?>pt>
    </body>
</html>