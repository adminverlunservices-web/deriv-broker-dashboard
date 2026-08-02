<?php /* Section 4 */ ?>
<div class="row mt-4">
<div class="col-lg-8">
<div class="card shadow-sm border-0">
<div class="card-header bg-white"><h5><i class="fa-solid fa-diagram-project me-2"></i>Strategy Workflow</h5></div>
<div class="card-body">
<p class="text-muted">Arrange your strategy steps. (UI scaffold)</p>
<div id="workflowCanvas" class="border rounded p-4" style="min-height:280px;background:#fafafa">
<div class="badge bg-primary m-1">START</div>
<div class="badge bg-secondary m-1">ENTRY CONDITIONS</div>
<div class="badge bg-success m-1">BUY</div>
<div class="badge bg-warning text-dark m-1">MONEY MANAGEMENT</div>
<div class="badge bg-danger m-1">EXIT</div>
</div>
</div></div>
</div>
<div class="col-lg-4">
<div class="card shadow-sm border-0">
<div class="card-header bg-white"><h5>Bot Summary</h5></div>
<div class="card-body">
<ul class="list-group mb-3">
<li class="list-group-item d-flex justify-content-between"><span>Name</span><strong id="sumBotName">-</strong></li>
<li class="list-group-item d-flex justify-content-between"><span>Market</span><strong id="sumMarket">-</strong></li>
<li class="list-group-item d-flex justify-content-between"><span>Symbol</span><strong id="sumSymbol2">-</strong></li>
<li class="list-group-item d-flex justify-content-between"><span>Strategy</span><strong id="sumStrategy">-</strong></li>
</ul>
<div class="d-grid gap-2">
<button class="btn btn-outline-secondary" id="saveDraft">Save Draft</button>
<button class="btn btn-success" id="saveLaunch">Save & Launch</button>
</div>
</div></div>
</div>
</div>
<script>
function updateBotSummary(){
 if(document.getElementById('bot_name'))sumBotName.textContent=bot_name.value||'-';
 if(document.getElementById('market'))sumMarket.textContent=market.options[market.selectedIndex]?.text||'-';
 if(document.getElementById('symbol'))sumSymbol2.textContent=symbol.value||'-';
 if(document.getElementById('mm_strategy'))sumStrategy.textContent=mm_strategy.options[mm_strategy.selectedIndex].text;
}
['bot_name','market','symbol','mm_strategy'].forEach(id=>{
 const el=document.getElementById(id);
 if(el){el.addEventListener('input',updateBotSummary);el.addEventListener('change',updateBotSummary);}
});
updateBotSummary();
</script>

</div><!-- container-fluid -->
</div><!-- main-wrapper -->
</div><!-- app -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/builder.js"></script>
</body>
</html>
