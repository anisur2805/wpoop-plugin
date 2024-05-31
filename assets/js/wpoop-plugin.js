window.addEventListener("load", function () {
   var tabs = document.querySelectorAll('.nav-tabs > li')

   for( i = 0; i < tabs.length; i++ ) {
      tabs[i].addEventListener('click', switchTab);
   }

   function switchTab( e ) {
    e.preventDefault();
    
      var clickedTab = e.currentTarget;
      var anchor = e.target;
      var activePaneID =  anchor.getAttribute('href');

      document.querySelector('.nav-tabs > li.active').classList.remove('active');
      document.querySelector('.tab-content .tab-pane.active').classList.remove('active');

      clickedTab.classList.add('active');
      document.querySelector(activePaneID).classList.add('active');

   }
});
