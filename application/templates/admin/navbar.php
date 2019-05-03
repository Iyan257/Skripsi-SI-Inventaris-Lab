<!-- start: header -->
<header class="header">
    <div class="logo-container">
        <a href="../" class="logo">
            <img src="<?php echo base_url('assets/images/logoInformatika.jpg')?>" height="35" alt="JSOFT Admin" />
        </a>
        <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <!-- start: search & user box -->
    <div class="header-right">
        <span class="separator"></span>

        <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
                <figure class="profile-picture">
                    <img src="<?php echo base_url('assets/images/!sample-user.jpg')?>" alt="Joseph Doe" class="img-circle" data-lock-picture="<?php echo base_url('assets/images/!sample-user.jpg')?>" />
                </figure>
                <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com">
                    <span class="name">
                        <?php if(isset($user)) {
                            echo $user->name;
                        }else echo 'User'; 
                        ?>
                    </span>
                    <span class="role">
                        <?php if ($this->ion_auth->in_group('kalab')){
                           echo 'Kepala lab';
                        }else if ($this->ion_auth->in_group('input_admin')){
                            echo 'Super admin';
                        }else{
                           echo 'Admin';
                        }?>
                    </span>
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled">
                    <li class="divider"></li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="<?= base_url('profile') ?>"><i class="fa fa-user"></i> My Profile</a>
                    </li>
                    <?php if($this->ion_auth->in_group('kalab')): ?>
                        <li>
                            <a role="menuitem" tabindex="-1" href="<?= base_url('kalab/users') ?>" style="padding-left:7px;"><i class="fa fa-users"></i> Users</a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a role="menuitem" tabindex="-1"  href="<?= base_url('auth/logout') ?>"><i class="fa fa-power-off"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end: search & user box -->
</header>
<!-- end: header -->