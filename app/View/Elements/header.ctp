<div class="navbar navbar-default navbar-fixed-top" style="height: 60px;">
    <div class="container-fluid">
        <div class="navbar-header">
            <?php
            echo $this->Html->link($this->Html->image('logo-dci.png', array('style' => 'width:50px;position: absolute;top: 5px;')) . '<span style="margin-left: 65px;">' . __('DCI') . '</span>', array('controller' => 'pages', 'action' => 'home'), array('class' => 'navbar-brand', 'style' => 'line-height: 25px;', 'escape' => false));
            ?>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav navbar-right">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="logout" style="font-size: 16px;">
                            <?php
                            if ($this->Session->read('Auth.User.sexe') == 'Homme'):
                                echo $this->Html->image('male.png', array('style' => 'max-width:100%;width:21px;margin-top: -3px;'));
                            elseif ($this->Session->read('Auth.User.sexe') == 'Femme'):
                                echo $this->Html->image('female.png', array('style' => 'max-width:100%;width:21px;margin-top: -3px;'));
                            endif;
                            ?>
                            <?php echo $this->Session->read('Auth.User.prenom') . " " . $this->Session->read('Auth.User.nom'); ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="logout">
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'logout', 'home' => FALSE)); ?>"><span class="fa fa-sign-out"></span><?php echo __(" Déconnexion"); ?></a></li>
                        </ul>
                    </li>
                </ul>
            </ul>
        </div>
    </div>
</div>
