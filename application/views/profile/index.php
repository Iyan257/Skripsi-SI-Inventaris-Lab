<section class="panel">
    <header class="panel-heading">
        <div class="row align-items-center">
			<div class="col-sm-8">
                <h2 class="panel-title"><span class="va-middle"><?= $header ?></span></h2>
			</div>
		</div>
    </header>
    <div class="panel-body">
        <?= form_open('profile/update') ?>
            <div class="col-sm-12">
                <div><b>Configure Account Information</b></div>
                <hr>
                <div class="form-group">
                    <label class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                        <input class="form-control" value="<?= $user->username ?>" readonly="readonly"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="Input your name" name="name" required value="<?= $user->name ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-form-label">Inisial</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="Input your inisial" name="inisial" required value="<?= $user->inisial ?>" maxlength="3">
                    </div>
                </div>
                <div class="form-group text-right mb-0">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Update</button>
                </div>
            </div>
        </form>
        
    </div>
    <div class="panel-body" style="margin-top:20px;">
        <?= form_open('profile/update') ?>
            <div class="col-sm-12">
                <div><b>Change Password</b></div>
                <hr>
                <div class="form-group">
                    <label class="col-sm-3 col-form-label">Old password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" placeholder="Input your old password" name="old" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-form-label">New password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" placeholder="Input your new password" name="new" pattern="'^.{'.<?= $min_password_length ?>.'}.*$'" required>
                        <small class="form-text text-muted">New password must be <?= $min_password_length ?> characters length.</small>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-form-label">Confirm new password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" placeholder="Confirm your new password" name="new_confirm" pattern="'^.{'.<?= $min_password_length ?>.'}.*$'" required>
                    </div>
                </div>
                <div class="form-group text-right mb-0">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Update</button>
                </div>
            </div>
        </form>
    </div>
</section>



