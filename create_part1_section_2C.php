<?php
/* Part 1 - Section 2C : Entry Conditions */
?>
<div class="row mt-4">
 <div class="col-12">
  <div class="card shadow-sm border-0">
   <div class="card-header bg-white">
    <h5><i class="fa-solid fa-filter me-2"></i>Entry Conditions</h5>
   </div>
   <div class="card-body">
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">Primary Condition</label>
        <select id="condition_type" class="form-select">
          <option value="last_digit">Last Digit</option>
          <option value="rsi">RSI</option>
          <option value="macd">MACD</option>
          <option value="ma">Moving Average</option>
          <option value="bollinger">Bollinger Bands</option>
          <option value="tick_direction">Tick Direction</option>
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Operator</label>
        <select id="condition_operator" class="form-select">
          <option value="eq">Equals</option>
          <option value="gt">Greater Than</option>
          <option value="lt">Less Than</option>
          <option value="cross_up">Crosses Above</option>
          <option value="cross_down">Crosses Below</option>
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Value</label>
        <input id="condition_value" class="form-control" placeholder="e.g. 30 or Even">
      </div>
      <div class="col-md-3">
        <label class="form-label">Logic</label>
        <select id="logic_join" class="form-select">
          <option>AND</option><option>OR</option>
        </select>
      </div>
      <div class="col-md-9 d-flex align-items-end">
        <button class="btn btn-outline-primary" id="addCondition">Add Condition</button>
      </div>
    </div>
    <hr>
    <table class="table table-bordered align-middle">
      <thead><tr><th>#</th><th>Condition</th><th>Logic</th><th></th></tr></thead>
      <tbody id="conditionsTable"></tbody>
    </table>
   </div>
  </div>
 </div>
</div>
<script>
const conditions=[];
function renderConditions(){
 const tb=document.getElementById('conditionsTable');
 tb.innerHTML='';
 conditions.forEach((c,i)=>{
  tb.innerHTML+=`<tr>
   <td>${i+1}</td>
   <td>${c.type} ${c.op} ${c.val}</td>
   <td>${c.logic}</td>
   <td><button class="btn btn-sm btn-danger" onclick="removeCondition(${i})">Remove</button></td>
  </tr>`;
 });
}
function removeCondition(i){conditions.splice(i,1);renderConditions();}
document.getElementById('addCondition').addEventListener('click',()=>{
 conditions.push({
  type:condition_type.value,
  op:condition_operator.value,
  val:condition_value.value,
  logic:logic_join.value
 });
 renderConditions();
});
window.BotBuilder=window.BotBuilder||{};
window.BotBuilder.conditions=conditions;
</script>

<!-- SECTION 3 STARTS BELOW -->
