<?php
/* Part 1 - Section 2B.2A : Contract Configuration */
?>
<div class="row mt-4">
  <div class="col-12">
    <div class="card shadow-sm border-0 bot-card">
      <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fa-solid fa-file-contract text-primary me-2"></i>Contract Configuration</h5>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Contract Type</label>
            <select id="contract_type" class="form-select" disabled>
              <option value="">Select a symbol first...</option>
            </select>
            <small class="text-muted">Loaded from /api/contracts.php</small>
          </div>

          <div class="col-md-4">
            <label class="form-label">Trade Basis</label>
            <select id="basis" class="form-select">
              <option value="stake" selected>Stake</option>
              <option value="payout">Payout</option>
            </select>
          </div>

          <div class="col-md-4">
            <label class="form-label">Currency</label>
            <select id="currency" class="form-select">
              <option>USD</option>
              <option>EUR</option>
              <option>GBP</option>
              <option>AUD</option>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">Duration</label>
            <input id="duration" type="number" min="1" value="5" class="form-control">
          </div>

          <div class="col-md-3">
            <label class="form-label">Duration Unit</label>
            <select id="duration_unit" class="form-select" disabled>
              <option value="">Waiting...</option>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">Amount</label>
            <input id="amount" type="number" step="0.01" min="0.35" value="1.00" class="form-control">
          </div>

          <div class="col-md-3">
            <label class="form-label">Barrier</label>
            <input id="barrier" class="form-control" placeholder="Shown if required" disabled>
          </div>
        </div>

        <hr>

        <div class="alert alert-info mb-0">
          <strong>API status:</strong>
          <span id="contract_status">Waiting for market and symbol selection.</span>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
async function loadContracts(symbol){
  const status=document.getElementById('contract_status');
  status.textContent='Loading contracts...';
  const r=await fetch('/api/contracts.php?symbol='+encodeURIComponent(symbol));
  const data=await r.json();

  const ct=document.getElementById('contract_type');
  const du=document.getElementById('duration_unit');
  ct.innerHTML='';
  du.innerHTML='';
  ct.disabled=false;
  du.disabled=false;

  (data.contracts||[]).forEach(c=>{
    ct.add(new Option(c.label,c.value));
  });

  (data.duration_units||[]).forEach(u=>{
    du.add(new Option(u.label,u.value));
  });

  document.getElementById('barrier').disabled=!data.requires_barrier;
  status.textContent='Contract information loaded.';
}
window.BotBuilder=window.BotBuilder||{};
window.BotBuilder.loadContracts=loadContracts;
</script>

<!-- SECTION 2B.2B STARTS BELOW -->
