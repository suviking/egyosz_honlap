document.addEventListener('DOMContentLoaded', function(){
    $.material.init();
  }, false)

  $(document).ready(function() {
      $("body").tooltip({ selector: '[data-toggle=tooltip]' });
  });
