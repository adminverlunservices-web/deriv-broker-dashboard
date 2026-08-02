/**
 * builder.js - Main controller
 */
class BotBuilderController{
 constructor(){
  this.state={conditions:[]};
  this.bind();
 }
 bind(){
  const save=document.getElementById('saveDraft');
  if(save) save.addEventListener('click',()=>this.save(false));
  const launch=document.getElementById('saveLaunch');
  if(launch) launch.addEventListener('click',()=>this.save(true));
  const symbol=document.getElementById('symbol');
  if(symbol) symbol.addEventListener('change',()=>this.loadContracts());
 }
 async loadContracts(){
  const symbol=document.getElementById('symbol')?.value;
  if(!symbol) return;
  const data=await window.BotAPI.getContracts(symbol);
  const sel=document.getElementById('contract_type');
  if(sel){
    sel.innerHTML='';
    (data.contracts||[]).forEach(c=>sel.add(new Option(c.display||c.label,c.value)));
  }
 }
 collect(){
  return {
    bot_name:document.getElementById('bot_name')?.value,
    market:document.getElementById('market')?.value,
    symbol:document.getElementById('symbol')?.value,
    contract_type:document.getElementById('contract_type')?.value,
    amount:document.getElementById('amount')?.value,
    conditions:window.BotBuilder?.conditions||[]
  };
 }
 validate(d){
  if(!d.bot_name) throw Error('Bot name required');
  if(!d.symbol) throw Error('Symbol required');
 }
 async save(run){
  try{
   const data=this.collect();
   this.validate(data);
   const res=await window.BotAPI.saveBot({...data,run_after_save:run});
   alert(res.message||'Bot saved');
  }catch(e){alert(e.message);}
 }
}
document.addEventListener('DOMContentLoaded',()=>window.builder=new BotBuilderController());
