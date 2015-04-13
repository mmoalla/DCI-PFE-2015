<div class="col-lg-2 dci-sidebar">
    <?php if ($this->Session->read('group.Group.name') === 'docteur' || $this->Session->read('group.Group.name') === 'bureau admission'): ?>
        <ul class="nav">
            <li>
                <a class="active" href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'home')); ?>"><i class="fa fa-home"></i><?php echo __(" Accueil "); ?></a>
            </li>
            <li>
                <a class="active" href="<?php echo $this->Html->url(array('controller' => 'consultations', 'action' => 'index')); ?>"><i class="fa fa-calendar"></i><?php echo __(" Planning "); ?></a>
            </li>
            <li>
                <a class="active" href="<?php echo $this->Html->url(array('controller' => 'patients', 'action' => 'index', 'home' => true)); ?>"><i class="fa fa-user"></i><?php echo __(" Patient"); ?></a>
            </li>
            <?php if ($this->Session->read('group.Group.name') === 'docteur'): ?>
                <li>
                    <a class="active" id="reclam" href="#"><i class="fa fa-warning"></i> Signaler une panne<span class="caret" style="position: absolute;top: 20px;right: 10px;border-top: 5px solid;border-right: 5px solid transparent;border-left: 5px solid transparent;"></span></a>
                </li>
                <li>
                    <ul class="dropdown-claim" id="claim">
                        <li>
                            <?php
                            echo $this->Form->create('Reclamation', array('inputDefaults' =>
                                array('div' => false, 'label' => false), 'class' => 'form-horizontal', 'url' => array('controller' => 'pages', 'action' => 'reclamation')));
                            ?>
                            <div class="form-group" style="margin: 0 0 10px 0;">
                                <label for="avatar" class="control-label" id="lblavatar">Réclamation&nbsp;&ast;</label>
                                <?php echo $this->Form->input('nom', array('class' => 'form-control', 'required' => true)); ?>
                                <?php echo $this->Form->input('user_id', array('class' => 'form-control', 'type' => 'hidden')); ?>
                            </div>
                            <?php
                            echo $this->Form->submit(__('Enregistrer'), array('class' => 'btn btn btn-success', 'div' => false, 'style' => 'width:100%;outline:none;'));
                            echo $this->Form->end();
                            ?>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    <?php elseif ($this->Session->read('group.Group.name') === 'pharmacien'): ?>
        <ul class="nav">
            <li>
                <a class="active" href="<?php echo $this->Html->url(array('controller' => 'stocks', 'action' => 'index')); ?>"><span><i class="fa fa-home"></i></span><?php echo __(" Accueil "); ?></a>
            </li>
            
            <li>
                <a class="active" id="reclam" href="#"><i class="fa fa-warning"></i> Signaler une panne<span class="caret" style="position: absolute;top: 20px;right: 10px;border-top: 5px solid;border-right: 5px solid transparent;border-left: 5px solid transparent;"></span></a>
            </li>
            <li>
                <ul class="dropdown-claim" id="claim">
                    <li>
                        <?php
                        echo $this->Form->create('Reclamation', array('inputDefaults' =>
                            array('div' => false, 'label' => false), 'class' => 'form-horizontal', 'url' => array('controller' => 'pages', 'action' => 'reclamation')));
                        ?>
                        <div class="form-group" style="margin: 0 0 10px 0;">
                            <label for="avatar" class="control-label" id="lblavatar">Réclamation&nbsp;&ast;</label>
                            <?php echo $this->Form->input('nom', array('class' => 'form-control', 'required' => true)); ?>
                            <?php echo $this->Form->input('user_id', array('class' => 'form-control', 'type' => 'hidden')); ?>
                        </div>
                        <?php
                        echo $this->Form->submit(__('Enregistrer'), array('class' => 'btn btn btn-success', 'div' => false, 'style' => 'width:100%;outline:none;'));
                        echo $this->Form->end();
                        ?>
                    </li>
                </ul>
            </li>
        </ul>
    <?php endif; ?>
    <div class="dci-copyright">
        <span>&COPY; DCI - 2015</span>
        <?php //echo $this->Html->link($this->Html->image('dev.jpg', array('style' => 'max-width: 100%;width: 45px;height: auto;border-radius:50%;')), 'http://www.largestinfo.pro/', array('escape' => false, 'target' => '_blank', 'style' => 'display: inline-block;margin-left: 15px;margin-bottom: 10px;'));   ?>
    </div>
</div>