<?php
/* Part 1 - Section 2B.2B */
?>
<div class="row mt-4">
<div class="col-lg-8">
<div class="card shadow-sm border-0">
<div class="card-header bg-white"><h5>Validation & Proposal Preview</h5></div>
<div class="card-body">
<div id="validationErrors" class="alert alert-danger d-none"></div>
<div class="mb-3">
<label class="form-label">Estimated Payout</label>
<input id="estimated_payout" class="form-control" readonly>
</div>
<button id="btnPreviewProposal" class="btn btn-primary">Preview Proposal</button>
<span id="proposalLoader" class="ms-2 d-none">Loading...</span>
</div></div></div>
<div class="col-lg-4">
<div class="card shadow-sm border-0">
<div class="card-header bg-white"><h5>Trade Summary</h5></div>
<div class="card-body">
<ul class="list-group">
<li class="list-group-item d-flex justify-content-between"><span>Symbol</span><strong id="sumSymbol">--</strong></li>
<li class="list-group-item d-flex justify-content-between"><span>Contract</span><strong id="sumContract">--</strong></li>
<li class="list-group-item d-flex justify-content-between"><span>Amount</span><strong id="sumAmount">--</strong></li>
<li class="list-group-item d-flex justify-content-between"><span>Duration</span><strong id="sumDuration">--</strong></li>
</ul>
</div></div></div></div>
<script>
async function previewProposal(){
 const loader=document.getElementById('proposalLoader');
 loader.classList.remove('d-none');
 const payload={
  symbol:document.getElementById('symbol').value,
  contract_type:document.getElementById('contract_type').value,
  amount:document.getElementById('amount').value,
  basis:document.getElementById('basis').value,
  duration:document.getElementById('duration').value,
  duration_unit:document.getElementById('duration_unit').value,
  currency:document.getElementById('currency').value,
  barrier:document.getElementById('barrier').value
 };
 const r=await fetch('/api/proposal.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)});
 const data=await r.json();
 loader.classList.add('d-none');
 if(!data.success){const e=document.getElementById('validationErrors');e.textContent=data.message||'Proposal failed';e.classList.remove('d-none');return;}
 document.getElementById('estimated_payout').value=data.payout;
 document.getElementById('sumSymbol').textContent=payload.symbol;
 document.getElementById('sumContract').textContent=payload.contract_type;
 document.getElementById('sumAmount').textContent=payload.amount+' '+payload.currency;
 document.getElementById('sumDuration').textContent=payload.duration+' '+payload.duration_unit;
}
document.getElementById('btnPreviewProposal').addEventListener('click',previewProposal);
</script>
