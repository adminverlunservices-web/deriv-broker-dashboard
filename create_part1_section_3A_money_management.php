<?php
/* Part 1 - Section 3A : Money Management */
?>
<div class="row mt-4">
<div class="col-12">
<div class="card shadow-sm border-0">
<div class="card-header bg-white">
<h5><i class="fa-solid fa-wallet me-2"></i>Money Management</h5>
</div>
<div class="card-body">
<div class="row g-3">
<div class="col-md-4">
<label class="form-label">Money Management Strategy</label>
<select id="mm_strategy" class="form-select">
<option value="fixed">Fixed Stake</option>
<option value="martingale">Martingale</option>
<option value="anti_martingale">Anti-Martingale</option>
<option value="fibonacci">Fibonacci</option>
<option value="dalembert">D'Alembert</option>
</select>
</div>
<div class="col-md-4">
<label class="form-label">Initial Stake</label>
<input id="initial_stake" type="number" step="0.01" value="1.00" class="form-control">
</div>
<div class="col-md-4">
<label class="form-label">Multiplier / Step</label>
<input id="stake_multiplier" type="number" step="0.1" value="2.0" class="form-control">
</div>

<div class="col-md-3">
<label class="form-label">Take Profit</label>
<input id="take_profit" type="number" class="form-control" value="20">
</div>

<div class="col-md-3">
<label class="form-label">Stop Loss</label>
<input id="stop_loss" type="number" class="form-control" value="20">
</div>

<div class="col-md-3">
<label class="form-label">Max Stake</label>
<input id="max_stake" type="number" class="form-control" value="100">
</div>

<div class="col-md-3">
<label class="form-label">Reset After Win</label>
<select id="reset_after_win" class="form-select">
<option value="1">Yes</option>
<option value="0">No</option>
</select>
</div>
</div>

<hr>

<div class="alert alert-secondary">
<strong>Summary</strong>
<ul class="mb-0">
<li><span id="mmSummary">Fixed Stake</span></li>
<li>Initial Stake: <span id="stakeSummary">$1.00</span></li>
<li>Take Profit: <span id="tpSummary">$20</span></li>
<li>Stop Loss: <span id="slSummary">$20</span></li>
</ul>
</div>
</div>
</div>
</div>
</div>

<script>
function updateMoneySummary(){
document.getElementById('mmSummary').textContent=
document.getElementById('mm_strategy').selectedOptions[0].text;
document.getElementById('stakeSummary').textContent='$'+document.getElementById('initial_stake').value;
document.getElementById('tpSummary').textContent='$'+document.getElementById('take_profit').value;
document.getElementById('slSummary').textContent='$'+document.getElementById('stop_loss').value;
}
['mm_strategy','initial_stake','take_profit','stop_loss'].forEach(id=>{
document.getElementById(id).addEventListener('input',updateMoneySummary);
document.getElementById(id).addEventListener('change',updateMoneySummary);
});
updateMoneySummary();
</script>

<!-- SECTION 3B STARTS BELOW -->
