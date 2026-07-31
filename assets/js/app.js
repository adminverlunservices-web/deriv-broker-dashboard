document.addEventListener('DOMContentLoaded',()=>{
 const btn=document.getElementById('menu-toggle');
 const sidebar=document.querySelector('.sidebar');
 if(btn && sidebar){
   btn.addEventListener('click',()=>sidebar.classList.toggle('show'));
 }
 console.log('Trading Terminal UI v1.0.0');
});
