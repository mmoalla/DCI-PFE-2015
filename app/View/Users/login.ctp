<div class="container">
    <div class="dci-home">
        <?php echo $this->Html->image('logo-dci.png', array('style' => 'max-width: 100%;height: auto;width: 75%;margin: 0px 35px 25px;')); ?>
        <div class="panel panel-default" style="margin-top: 20px;">
            <div class="panel-heading">
                <h2 class="dci-signin-heading"><?php echo __("Connexion à DCI"); ?></h2>
            </div>
            <div class="panel-body">
                <?php
                echo $this->Form->create('User', array(
                    'inputDefaults' => array('div' => false, 'label' => false),
                    'url' => array('controller' => 'users', 'action' => 'login')
                ));
                ?>
                <div class="form-group">
                    <label for="username" class="control-label" style="cursor: pointer;"><?php echo __("Nom d'utilisateur"); ?></label>
                    <div class="input-group-addon" style="width: auto;position: absolute;border-radius: 3px 0 0 3px;padding: 13px;"><i class="fa fa-user"></i></div>
                    <?php
                    echo $this->Form->input('username', array(
                        'class' => 'form-control', 'id' => 'username',
                        'autofocus' => true,
                        'style' => 'padding-left: 50px;'
                    ));
                    ?>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label" style="cursor: pointer;"><?php echo __("Mot de passe"); ?></label>
                    <div class="input-group-addon" style="width: auto;position: absolute;border-radius: 3px 0 0 3px;padding: 13px;"><i class="fa fa-lock"></i></div>
                    <?php
                    echo $this->Form->input('password', array(
                        'class' => 'form-control', 'id' => 'password',
                        'style' => 'padding-left: 50px;'
                    ));
                    ?>
                </div>
                <?php
                echo $this->Form->submit(__('Se connecter'), array(
                    'class' => 'btn btn-success',
                    'div' => false, 'style' => 'width:100%;'
                ));
                echo $this->Form->end();
                ?>
            </div>
            <div class="panel-footer" style="text-align: center;">
                Produit par <?php echo $this->Html->link($this->Html->image('Largest-info.png', array('style' => 'max-width: 100%;width: 100px;height: auto;')), 'http://www.largestinfo.pro/', array('escape' => false, 'target' => '_blank')); ?>
            </div>
        </div>
    </div>
</div>