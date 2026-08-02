<?php /* Section 3B Risk Management */ ?>
<div class="row mt-4">
<div class="col-12">
<div class="card shadow-sm border-0">
<div class="card-header bg-white"><h5><i class="fa-solid fa-shield-halved me-2"></i>Advanced Risk Management</h5></div>
<div class="card-body">
<div class="row g-3">
<div class="col-md-3"><label>Daily Profit Target</label><input id="daily_profit" type="number" class="form-control" value="100"></div>
<div class="col-md-3"><label>Daily Loss Limit</label><input id="daily_loss" type="number" class="form-control" value="50"></div>
<div class="col-md-3"><label>Max Trades</label><input id="max_trades" type="number" class="form-control" value="100"></div>
<div class="col-md-3"><label>Cooldown (sec)</label><input id="cooldown" type="number" class="form-control" value="5"></div>
<div class="col-md-3"><label>Max Wins</label><input id="max_wins" type="number" class="form-control" value="10"></div>
<div class="col-md-3"><label>Max Losses</label><input id="max_losses" type="number" class="form-control" value="5"></div>
<div class="col-md-3"><label>Trading Hours</label><input id="trading_hours" class="form-control" placeholder="00:00-23:59"></div>
<div class="col-md-3"><label>Auto Stop</label><select id="auto_stop" class="form-select"><option>Enabled</option><option>Disabled</option></select></div>
</div>
<hr>
<div class="progress mb-2"><div id="riskMeter" class="progress-bar" role="progressbar" style="width:25%">Low Risk</div></div>
<div class="alert alert-warning mb-0" id="riskMessage">Current settings indicate a low risk profile.</div>
</div>
</div>
</div>
</div>
<script>
function updateRisk(){
 let score=0;
 if(+daily_loss.value>100)score+=40;
 if(+max_trades.value>200)score+=20;
 if(+max_losses.value>10)score+=20;
 if(+cooldown.value<2)score+=20;
 const bar=riskMeter;
 let txt='Low Risk';
 if(score>=40){txt='Medium Risk';}
 if(score>=70){txt='High Risk';}
 bar.style.width=Math.max(score,25)+'%';
 bar.textContent=txt;
 riskMessage.textContent='Current settings indicate a '+txt.toLowerCase()+' profile.';
}
['daily_loss','max_trades','max_losses','cooldown'].forEach(id=>{
 document.getElementById(id).addEventListener('input',updateRisk);
});
updateRisk();
</script>

<!-- SECTION 4 STARTS BELOW -->
