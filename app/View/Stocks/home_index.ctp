<?php $this->Html->css('../js/select2/select2', array('inline' => false)); ?>
<?php $this->Html->css('../js/select2/select2-metronic', array('inline' => false)); ?>
<div ng-controller="StocksController">
    <div class="alert alert-dismissable alert-warning" id="alert" style="display: none;">
        <p style="text-align: center; font-size: 20px;font-weight: bold;"><i class="fa fa-exclamation-circle"></i> La pharmacie risque une rupture de stock.</p>
    </div>
    <a class="btn btn-primary btn-sm" href="<?php echo $this->Html->url(array('controller' => 'stocks', 'action' => 'ajouter_stock')); ?>"><i class="fa fa-plus"></i> Alimenter le stock</a>
    <a class="btn btn-default btn-sm" href="" id="advanced" style="margin-left: 10px;"><i class="fa fa-filter"></i> Recherche Avancée</a>
    <div id="search" style="display: block;margin-top: 10px;">
        <div class="form-group" style="width: 340px;">
            <label class="control-label">Code pct</label>
            <select ng-model="codePct" class="form-control">
                <option value="">Selectionner le code PCT</option>
                <option ng-repeat="stk in stocks" ng-model="codePct">{{stk.Medicament.code_pct}}</option>
            </select>
        </div>
<!--        <div class="form-group" style="width: 340px;">
            <label class="control-label">Nom médicament</label>
            <select class="form-control" disabled ng-model="codePct">
                <option value="">Médicament du code PCT selectionné</option>
                <option ng-selected="codePct" ng-repeat="stk in stocks | filter:codePct">{{stk.Medicament.nom_commercial}}</option>
            </select>
        </div> -->
    </div>
    <table id="listStock" class="table table-bordered table-condensed table-hover table-responsive table-striped" style="margin-top: 30px">
        <thead>
            <th>Référence</th>
            <th>Nom commercial</th>
            <th>Quantité</th>
            <th>Prix d'achat</th>
        </thead>
        <tbody>
            <tr ng-repeat="stk in stocks | filter:codePct">
                <td>{{stk.Medicament.code_pct}}</td>
                <td>{{stk.Medicament.nom_commercial}}</td>
                <td id="qte"><div id="stock" value="{{stk.Stock._id}}">{{stk.Stock.stock}}</div><span id="add"></span></td>
                <td>{{stk.Stock.last_unit_price}}</td>
            </tr>
        </tbody>
    </table>
</div>
<?php $this->Html->scriptStart(array('inline' => false)); ?>
$(document).on('ready',function(){
    $("#search").hide('fast');
    $("#search").hide();
    $("#advanced").on('click',function(e){
        e.preventDefault();
        $("#search").toggle();
    });
    setInterval(function(){
        $("td#qte").each(function() {
            if ($(this).text() <= 20) {
                //$("#alert").addClass("animated pulse").css('-webkit-animation-iteration-count', 'infinite').show();
                $(this).css('font-weight', 'bold').css('width','16%');
                $("#stock",this).addClass("stock-animated animated pulse").css('width', '123px').css('display','inline-block').css('margin-right', '10px');
                var idm = $("#stock",this).attr('value');
                $("#add",this).html('<a href="#" id="charger" class="btn btn-primary btn-xs" data-id="'+idm+'">Charger</a>');
                $("#charger",this).attr('href',"/DCI/home/stocks/modifier_stock/" + idm); 
            }
        });
    },3000);
});
<?php $this->Html->scriptEnd(); ?>