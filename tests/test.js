$().ready(function() {
          function toggleTheToggled() {
          $('.toggled').toggleClass('hidden');
          }
          
        $('.toggle-btn').on('click', toggleTheToggled);
});
