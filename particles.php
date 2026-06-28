		  
<!-- particles.js container -->
<div id="particles-js"></div>

<!-- scripts -->
<script src="js/particles/particles.min.js"></script>
<script src="js/particles/app.js"></script>

<script>
  var count_particles, stats, update;
  stats = new Stats;
  stats.setMode(0);
  stats.domElement.style.position = 'absolute';
  stats.domElement.style.left = '0px';
  stats.domElement.style.top = '0px';
  document.body.appendChild(stats.domElement);
  count_particles = document.querySelector('.js-count-particles');
  update = function() {
    stats.begin();
    stats.end();
    if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
      count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
    }
    requestAnimationFrame(update);
  };
  requestAnimationFrame(update);
</script>
			  
			  
		<style>

#particles-js{
z-index:0;
  position:absolute;
  background-color: ;
  background-image: url('');
  background-size: cover;
  background-position: 50% 50%;
  background-repeat: no-repeat;
}
</style>	  
			  
			  
			  