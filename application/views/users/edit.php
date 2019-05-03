<section class="panel">
    <header class="panel-heading">
        <div class="row align-items-center">
			<div class="col-sm-8">
                <h2 class="panel-title"><span class="va-middle"><?= $header?></span></h2>
			</div>
		</div>
    </header>
	<div class="panel-body">
        <div class="col-sm-12">
            <?php echo form_open('kalab/users/update/' . $edit_user->id); ?>
                <div class="form-group">
                    <label class="control-label col-2" for="code">Kode<span class="required">*</span></label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="code" name="code" placeholder="Input user's initial" required value="<?= isset($edit_user)? $edit_user->inisial : '' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-2">Name<span class="required">*</span></label>
                    <div class="col-10">
                        <input type="text" class="form-control" name="name" placeholder="Input user's name" required value="<?= isset($edit_user)? $edit_user->name : '' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-2">Username<span class="required">*</span></label>
                    <div class="col-10">
                        <input type="text" class="form-control" name="username" placeholder="Input user's username" required value="<?= isset($edit_user)? $edit_user->username : '' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-2">Group/Role<span class="required">*</span></label>
                    <div class="col-10">
                        <select name="group" class="form-control">
                            <?php $len_group = count($groups); foreach($groups as $i => $group): ?>
                                <option value="<?= $group->id ?>" <?= (!isset($edit_user) && $len_group - 1 == $i) || (isset($edit_user) && $edit_user->groups[0]->id == $group->id)? 'selected' : '' ?>><?= $group->description ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="random_password" id="random_password">
                            <label class="form-check-label" for="random_password">Reset password (random)</label>
                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> 
                            Update
                        </button>
                        <a class="btn btn-secondary text-white" href="<?= base_url('kalab/users') ?>"><i class="fa fa-times"></i> Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
