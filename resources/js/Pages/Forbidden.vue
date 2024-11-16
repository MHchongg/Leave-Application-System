<script setup>

</script>

<template>
    <div id="forbidden">
		<div class="forbidden">
			<div class="forbidden-403">
				<h3>Forbidden</h3>
				<h1><span>4</span><span>0</span><span>3</span></h1>
			</div>
			<h2>You do not have permission to access this page.</h2>
		</div>
	</div>
</template>

<style scoped>
#forbidden {
  position: relative;
  height: 100vh;
}

#forbidden .forbidden {
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
}

.forbidden {
  max-width: 520px;
  width: 100%;
  line-height: 1.4;
  text-align: center;
}

.forbidden .forbidden-403 {
  position: relative;
  height: 240px;
}

.forbidden .forbidden-403 h1 {
  font-family: 'Montserrat', sans-serif;
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
  font-size: 252px;
  font-weight: 900;
  margin: 0px;
  color: #262626;
  text-transform: uppercase;
  letter-spacing: -40px;
  margin-left: -20px;
}

.forbidden .forbidden-403 h1>span {
  text-shadow: -8px 0px 0px #fff;
}

.forbidden .forbidden-403 h3 {
  font-family: 'Cabin', sans-serif;
  position: relative;
  font-size: 16px;
  font-weight: 700;
  text-transform: uppercase;
  color: #262626;
  margin: 0px;
  letter-spacing: 3px;
  padding-left: 6px;
}

.forbidden h2 {
  font-family: 'Cabin', sans-serif;
  font-size: 20px;
  font-weight: 400;
  text-transform: uppercase;
  color: #000;
  margin-top: 0px;
  margin-bottom: 25px;
}

@media only screen and (max-width: 767px) {
  .forbidden .forbidden-403 {
    height: 200px;
  }
  .forbidden .forbidden-403 h1 {
    font-size: 200px;
  }
}

@media only screen and (max-width: 480px) {
  .forbidden .forbidden-403 {
    height: 162px;
  }
  .forbidden .forbidden-403 h1 {
    font-size: 162px;
    height: 150px;
    line-height: 162px;
  }
  .forbidden h2 {
    font-size: 16px;
  }
}
</style>