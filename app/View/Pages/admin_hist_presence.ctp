<div class="row">
    <div class="container" ng-controller="PresenceController">
        <h1><i class="fa fa-history"></i> Historique des présences</h1><hr>
        <div class="form-group">
            <div class="input-group-addon" style="width: auto;position: absolute;border-radius: 3px 0 0 3px;padding: 12px 15px;"><i class="fa fa-filter" style="font-size: 16px;"></i></div>
            <select style="padding-left: 50px;" name="users" id="users" class="form-control" ng-model="unom">
                <option value="">Selectionner un employé</option>
                <option ng-repeat="pres in presences" ng-model="unom" value="{{pres.User._id}}" ng-if="pres.User.prenom !== 'Administrateur'">{{pres.User.prenom}} {{pres.User.nom}}</option>
            </select>
        </div>
        <div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-calendar"></i> Dates de présence</h3>
                </div>
                <div class="panel-body" style="overflow-y: auto;" ng-controller="HitoriquePresenceController">
                    <span ng-if="hist.Presence.created !== auj" style="display: block;" ng-repeat="hist in histpres | filter: unom">{{hist.User.User.prenom}}&nbsp;{{hist.User.User.nom}} <span> est présent le <strong>{{hist.Presence.created}}</strong></span><hr></span>
                </div>
            </div>
        </div> 
    </div>
</div>