<div class="row">
    <div class="container" ng-controller="PresenceController">
        <h1><i class="fa fa-check"></i> Gestion de la présence</h1><hr>
        <div class="col-lg-10">
            <div class="form-group" style="margin-bottom: 20px;">
                <div class="input-group-addon" style="width: auto;position: absolute;border-radius: 3px 0 0 3px;padding: 12px 15px;"><i class="fa fa-filter" style="font-size: 16px;"></i></div>
                <input id="name" type="text" class="form-control" ng-model="userName" style="padding-left: 50px;" placeholder="Rechercher les docteurs par leur nom ou prénom" autocomplete="off" />
            </div>
        </div>
        <div class="col-lg-2">
            <a href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'admin_hist_presence')); ?>" class="btn btn-default">Historique présence</a>
        </div>
        <table class="table table-bordered table-condensed table-hover table-responsive table-striped">
            <thead>
            <th style="width: 50%;">Nom</th>
            <th style="width: 50%;">Prénom</th>
            <th style="width: 10%;">Présence</th>
            </thead>
            <tbody>
                <tr id="employee" ng-repeat="pres in presences | filter: userName" ng-if="pres.User.prenom !== 'Administrateur'">
                    <td>{{pres.User.nom}}</td>
                    <td>{{pres.User.prenom}}</td>
                    <td>
                        <form action="/DCI/admin/pages/add_presence">
                            <input type="hidden" value="{{pres.User._id}}" id="userID" />   
                            <input type="checkbox" id="presence" name="data[Presence][state]" ng-if="!pres.Presence.Presence"/>
                            <input type="checkbox" id="presence" name="data[Presence][state]" ng-if="pres.Presence.Presence && pres.Presence.Presence.created !== today"/>
                            <i class="fa fa-check" ng-if="pres.Presence.Presence && pres.Presence.Presence.state === 'true' && pres.Presence.Presence.created === today"></i>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php $this->Html->scriptStart(array('inline' => false)); ?>
$(document).ready(function (){
    $("tbody").on('change', '#presence', function(){
        var data = {
            "Presence": {
                "state": $("#presence").prop('checked'),
                "created": new Date().toJSON().slice(0, 10),
                "user_id": $(this).parent().children().val()
            }
        }
        $.ajax({
            url : '<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'add_presence', 'admin' => true), true); ?>',
            type : 'POST',
            data: data,
            success : function(response){
            console.log(response);
                if (response) {
                    window.location.href = "http://localhost/DCI/admin/pages/presence";
                }
            }
        });
    });
});
<?php $this->Html->scriptEnd(); ?>