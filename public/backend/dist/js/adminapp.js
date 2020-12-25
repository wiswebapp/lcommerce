topbar.config({
    autoRun      : false, 
    barThickness : 5,
    barColors    : {
      '0'        : 'rgba(26,  188, 156, .7)',
      '.3'       : 'rgba(41,  128, 185, .7)',
      '1.0'      : 'rgba(231, 76,  60,  .7)'
    },
    shadowBlur   : 5,
    shadowColor  : 'rgba(0, 0, 0, .5)',
    className    : 'topbar',
  })
  topbar.show();
  (function step() {
    setTimeout(function() {  
      if (topbar.progress('+.01') < 10) step()
    }, 16)
})();
$(document).ready(function(){

    topbar.hide();

});