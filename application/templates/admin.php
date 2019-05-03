<!doctype html>
<!--<html lang="en" class="fixed sidebar-left-collapsed">-->
<html lang="en" class="fixed">
<head>
	<title>Inventaris Lab TIF &middot; Admin <?= isset($subtitle)? "&middot; $subtitle" : '' ?></title>
	<?php $this->layout->section('admin/header'); ?>
</head>
<body>
    <section class="body">
        <?php $this->layout->section('admin/navbar') ?>
        <div class="inner-wrapper">
            <?php $this->layout->section('admin/sidebar') ?>

            <section role="main" class="content-body">
                <header class="page-header">
                    <h2><?= isset($subtitle)? $subtitle:'' ?></h2>
                
                    <div class="right-wrapper pull-right">
                        <ol class="breadcrumbs">
                            <li>
                                <a href="<?= base_url('home')?>">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <?php if(isset($pages)):?>
                                <?php foreach($pages as $page => $href):?>
                                    <li><a href="<?= base_url($href)?>" style="text-decoration:none;"> <?= $page ?> </a></li>
                                <?php endforeach; ?>
                            <?php endif;?>
                        </ol>
                
                        <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
                    </div>
                </header>
                <?php $this->layout->section('general/messages') ?>
                <?php $this->layout->content(); ?>
            </section>
        </div>

    </section>
	
	<?php $this->layout->section('admin/footer'); ?>
    <?php $this->layout->section('admin/script') ?>
</body>
</html>
